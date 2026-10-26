<?php

namespace App\Http\Controllers;

use App\Models\{Order, ProductionActivity, ProductionComment, ProductionDelivery, ProductionDeliveryHistory, ProductionMeeting, ProductionMilestone, ProductionProject, ProductionProjectFile, ProductionProgressHistory, ProductionSampleReview, ProductionSampleSubmission, ProductionShipment, ProductionShipmentHistory, ProductSample};
use App\Models\{Manufacturer, Supplier, User};
use App\Notifications\SampleWorkflowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Storage};

class ProductionController extends Controller
{
    private function actor(): array
    {
        foreach (['manufacturer','supplier','web'] as $guard) if (Auth::guard($guard)->check()) return [Auth::guard($guard)->user(), $guard==='web'?'buyer':$guard];
        abort(401);
    }
    private function access(ProductionProject $project, bool $sellerOnly=false): array
    {
        [$actor,$type]=$this->actor(); $order=$project->order;
        $allowed=($type==='buyer' && (int)$order->user_id===(int)$actor->id) || ($type==='supplier' && (int)$order->supplier_id===(int)$actor->id) || ($type==='manufacturer' && (int)$order->manufacturer_id===(int)$actor->id);
        abort_unless($allowed,403); if ($sellerOnly) abort_unless($type==='manufacturer' && (int)$order->manufacturer_id===(int)$actor->id,403);
        return [$actor,$type];
    }
    private function activity(ProductionProject $project,string $event,string $description,$actor=null,string $type=null): void
    {
        if (!$actor) [$actor,$type]=$this->actor(); ProductionActivity::create(['production_project_id'=>$project->id,'actor_id'=>$actor?->id,'actor_type'=>$type,'event'=>$event,'description'=>$description]);
        try {
            $order=$project->order; $recipients=[];
            if($order->user_id)$recipients[]=User::find($order->user_id);
            if($order->supplier_id)$recipients[]=Supplier::find($order->supplier_id);
            if($order->manufacturer_id)$recipients[]=Manufacturer::find($order->manufacturer_id);
            $routeType=$type==='supplier'?'seller':$type;
            foreach($recipients as $recipient) if($recipient && !($recipient->getKey()===$actor?->getKey() && get_class($recipient)===get_class($actor))) {
                $recipientRoute=$recipient instanceof User?'user':($recipient instanceof Supplier?'seller':'manufacturer');
                $recipient->notify(new SampleWorkflowNotification('production_'.$event,$description,route($recipientRoute.'.production.show',$project)));
            }
        } catch (\Throwable $e) { report($e); }
    }
    public function index()
    {
        [$actor,$type]=$this->actor();
        $orders=Order::query()->when($type==='buyer',fn($q)=>$q->where('user_id',$actor->id))->when($type==='supplier',fn($q)=>$q->where('supplier_id',$actor->id))->when($type==='manufacturer',fn($q)=>$q->where('manufacturer_id',$actor->id));
        $projects=ProductionProject::whereIn('order_id',$orders->select('id'))->with(['order.material','order.user','order.supplier','order.manufacturer','milestones','submissions'])->latest()->paginate(15);
        $availableOrders=in_array($type,['manufacturer','supplier'])?Order::where($type.'_id',$actor->id)->whereDoesntHave('productionProject')->with('material')->latest()->get():collect();
        $routePrefix=$type==='supplier'?'seller':$type;
        return view('production.index',compact('projects','type','availableOrders','routePrefix'));
    }
    public function create(Request $request)
    {
        [$actor,$type]=$this->actor(); abort_unless(in_array($type,['manufacturer','supplier']),403);
        $data=$request->validate(['order_id'=>'required|integer|exists:orders,id','start_date'=>'nullable|date','expected_completion_date'=>'nullable|date|after_or_equal:start_date']);
        $order=Order::findOrFail($data['order_id']); abort_unless((int)$order->{$type.'_id'}===(int)$actor->id,403);
        $project=DB::transaction(function()use($data,$order,$actor,$type){$p=ProductionProject::firstOrCreate(['order_id'=>$order->id],['created_by_id'=>$actor->id,'created_by_type'=>$type,'start_date'=>$data['start_date']??now()->toDateString(),'expected_completion_date'=>$data['expected_completion_date']??null,'stage'=>'Material Sourcing']); if($p->wasRecentlyCreated){foreach(['Material Sourcing','Sample Submission','Sample Approval','Production Started','Quality Inspection','Packaging','Shipment Preparation','Delivery'] as $i=>$title)$p->milestones()->create(['title'=>$title,'status'=>'pending','due_date'=>$data['expected_completion_date']??null]);} return $p;});
        $this->activity($project,'created','Production project created.',$actor,$type); return redirect()->route(($type==='supplier'?'seller':$type).'.production.show',$project)->with('success','Production project created.');
    }
    public function show(ProductionProject $project)
    {
        [$actor,$type]=$this->access($project); $project->load(['order.material','order.user','order.supplier','order.manufacturer','histories','milestones','submissions.sample.material','submissions.reviews','comments','files','deliveries.histories','shipments.histories','meetings','activities']);
        $samples=ProductSample::query()->where(function($q)use($project){$q->where('manufacturer_id',$project->order->manufacturer_id)->orWhere('supplier_id',$project->order->supplier_id);})->with('material')->latest()->get();
        $routePrefix=$type==='supplier'?'seller':$type;
        return view('production.show',compact('project','actor','type','samples','routePrefix'));
    }
    public function progress(Request $request,ProductionProject $project)
    {
        [$actor,$type]=$this->access($project,true); $data=$request->validate(['progress'=>'required|integer|min:0|max:100','status'=>'required|in:pending,in_progress,on_hold,completed,cancelled','stage'=>'nullable|string|max:160','notes'=>'nullable|string|max:3000']);
        DB::transaction(function()use($project,$actor,$type,$data){$old=(int)$project->progress;$oldStatus=$project->status;$project->update(['progress'=>$data['progress'],'status'=>$data['status'],'stage'=>$data['stage']??$project->stage]);ProductionProgressHistory::create(['production_project_id'=>$project->id,'previous_progress'=>$old,'new_progress'=>$data['progress'],'previous_status'=>$oldStatus,'new_status'=>$data['status'],'user_id'=>$actor->id,'user_type'=>$type,'notes'=>$data['notes']??null]);});
        $this->activity($project,'progress','Progress updated to '.$data['progress'].'% ('.$data['status'].').',$actor,$type); return back()->with('success','Production progress updated.');
    }
    public function milestone(Request $request,ProductionProject $project,?ProductionMilestone $milestone=null)
    {
        [$actor,$type]=$this->access($project); abort_unless($type!=='buyer',403);
        $data=$request->validate(['title'=>'required|string|max:180','description'=>'nullable|string|max:5000','due_date'=>'nullable|date','assigned_user_id'=>'nullable|integer','status'=>'required|in:pending,in_progress,completed,delayed','notes'=>'nullable|string|max:3000']);
        $data['assigned_user_type']=$type; $data['completed_at']=$data['status']==='completed'?now():null;
        if($milestone){abort_unless((int)$milestone->production_project_id===(int)$project->id,404);$milestone->update($data);}else $milestone=$project->milestones()->create($data);
        $project->update(['stage'=>$milestone->title]);$this->activity($project,'milestone',$milestone->title.' milestone '.$data['status'].'.',$actor,$type); return back()->with('success','Milestone saved.');
    }
    public function submitSample(Request $request,ProductionProject $project)
    {
        [$actor,$type]=$this->access($project); abort_unless($type!=='buyer',403); $data=$request->validate(['product_sample_id'=>'required|integer|exists:product_samples,id','submission_notes'=>'nullable|string|max:3000']);
        $sample=ProductSample::findOrFail($data['product_sample_id']); abort_unless(($type==='manufacturer' && (int)$sample->manufacturer_id===(int)$actor->id)||($type==='supplier' && (int)$sample->supplier_id===(int)$actor->id),403);
        $prior=$project->submissions()->where('product_sample_id',$sample->id)->latest()->first(); $submission=$project->submissions()->create(['product_sample_id'=>$sample->id,'submitted_by_id'=>$actor->id,'submitted_by_type'=>$type,'revision'=>$prior?->revision+1??1,'submission_notes'=>$data['submission_notes']??null]);$this->activity($project,'sample_submitted','Sample '.$sample->name.' submitted for approval.',$actor,$type);return back()->with('success','Sample submitted for review.');
    }
    public function reviewSample(Request $request,ProductionProject $project,ProductionSampleSubmission $submission)
    {
        [$actor,$type]=$this->access($project);abort_unless($type==='buyer' && (int)$submission->production_project_id===(int)$project->id,403);
        $data=$request->validate(['decision'=>'required|in:approved,changes_requested,rejected','feedback'=>'required_if:decision,changes_requested,rejected|nullable|string|max:3000']);
        DB::transaction(function()use($submission,$actor,$type,$data){$submission->update(['status'=>$data['decision']]);ProductionSampleReview::create(['submission_id'=>$submission->id,'reviewer_id'=>$actor->id,'reviewer_type'=>$type,'decision'=>$data['decision'],'feedback'=>$data['feedback']??null,'reviewed_at'=>now()]);});
        $this->activity($project,'sample_review','Sample review decision: '.str_replace('_',' ',$data['decision']).'.',$actor,$type);return back()->with('success','Sample review recorded.');
    }
    public function comment(Request $request,ProductionProject $project){[$actor,$type]=$this->access($project);$d=$request->validate(['body'=>'required|string|max:5000']);$project->comments()->create(['author_id'=>$actor->id,'author_type'=>$type,'body'=>$d['body']]);$this->activity($project,'comment','A project comment was added.',$actor,$type);return back()->with('success','Comment posted.');}
    public function file(Request $request,ProductionProject $project){[$actor,$type]=$this->access($project);$d=$request->validate(['title'=>'required|string|max:180','file'=>'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx,csv,txt']);$f=$request->file('file');$path=$f->store('production/'.$project->id,'local');$project->files()->create(['uploaded_by_id'=>$actor->id,'uploaded_by_type'=>$type,'path'=>$path,'filename'=>$f->getClientOriginalName(),'mime_type'=>$f->getMimeType(),'size'=>$f->getSize(),'title'=>$d['title']]);$this->activity($project,'document','A project document was shared.',$actor,$type);return back()->with('success','Document uploaded.');}
    public function download(ProductionProjectFile $file){$project=$file->productionProject;$this->access($project);abort_unless(Storage::disk('local')->exists($file->path),404);return Storage::disk('local')->download($file->path,$file->filename);}
    public function delivery(Request $request,ProductionProject $project,?ProductionDelivery $delivery=null){[$actor,$type]=$this->access($project);abort_unless($type!=='buyer',403);$d=$request->validate(['address'=>'required|string|max:3000','expected_date'=>'required|date','instructions'=>'nullable|string|max:3000','status'=>'required|in:scheduled,rescheduled,completed,delayed']);if($delivery)abort_unless((int)$delivery->production_project_id===(int)$project->id,404);else $delivery=new ProductionDelivery(['production_project_id'=>$project->id]);$old=$delivery->exists?$delivery->expected_date?->format('Y-m-d'):null;$delivery->fill($d+['responsible_user_id'=>$actor->id,'responsible_user_type'=>$type])->save();ProductionDeliveryHistory::create(['delivery_id'=>$delivery->id,'previous_date'=>$old,'new_date'=>$d['expected_date'],'changed_by_id'=>$actor->id,'changed_by_type'=>$type,'note'=>$d['instructions']??null]);$this->activity($project,'delivery','Delivery schedule '.$d['status'].' for '.$d['expected_date'].'.',$actor,$type);return back()->with('success','Delivery schedule saved.');}
    public function shipment(Request $request,ProductionProject $project,?ProductionShipment $shipment=null){[$actor,$type]=$this->access($project,true);$d=$request->validate(['carrier'=>'nullable|string|max:160','tracking_number'=>'nullable|string|max:255','tracking_url'=>'nullable|url|max:1000','shipment_date'=>'nullable|date','expected_delivery_date'=>'nullable|date','package_details'=>'nullable|string|max:3000','notes'=>'nullable|string|max:3000','status'=>'required|in:preparing,shipped,in_transit,delivered,delayed']);if($shipment)abort_unless((int)$shipment->production_project_id===(int)$project->id,404);else $shipment=new ProductionShipment(['production_project_id'=>$project->id]);$shipment->fill($d)->save();ProductionShipmentHistory::create(['shipment_id'=>$shipment->id,'status'=>$d['status'],'changed_by_id'=>$actor->id,'changed_by_type'=>$type,'notes'=>$d['notes']??null]);$this->activity($project,'shipment','Shipment status updated to '.$d['status'].'.',$actor,$type);return back()->with('success','Shipment updated.');}
    public function meeting(Request $request,ProductionProject $project){[$actor,$type]=$this->access($project);$d=$request->validate(['title'=>'required|string|max:180','starts_at'=>'required|date|after:now','meeting_url'=>'nullable|url|max:1000']);$project->meetings()->create($d+['created_by_id'=>$actor->id,'created_by_type'=>$type]);$this->activity($project,'meeting','Project meeting scheduled: '.$d['title'].'.',$actor,$type);return back()->with('success','Meeting saved.');}
    public function admin(Request $request){abort_unless(Auth::guard('admin')->check(),403);$filters=$request->validate(['status'=>'nullable|in:pending,in_progress,on_hold,completed,cancelled','from'=>'nullable|date','to'=>'nullable|date|after_or_equal:from']);$query=ProductionProject::with(['order.material','order.user','milestones','submissions','deliveries','shipments'])->when($filters['status']??null,fn($q,$status)=>$q->where('status',$status))->when($filters['from']??null,fn($q,$date)=>$q->whereDate('created_at','>=',$date))->when($filters['to']??null,fn($q,$date)=>$q->whereDate('created_at','<=',$date));$projects=$query->latest()->paginate(25)->withQueryString();$stats=['total'=>ProductionProject::count(),'in_progress'=>ProductionProject::where('status','in_progress')->count(),'completed'=>ProductionProject::where('status','completed')->count(),'overdue_milestones'=>\App\Models\ProductionMilestone::where('status','!=','completed')->whereDate('due_date','<',today())->count(),'pending_samples'=>ProductionSampleSubmission::where('status','pending')->count(),'delayed_deliveries'=>ProductionDelivery::where('status','delayed')->count(),'delayed_shipments'=>ProductionShipment::where('status','delayed')->count(),'orders'=>Order::count(),'paid_sales'=>\App\Models\Payment::where('status','paid')->sum('amount'),'rfqs'=>\App\Models\Enquiry::count(),'subscriptions'=>\App\Models\SubscriptionPurchase::count()+DB::table('manufacturer_subscription_purchases')->count(),'supplier_activity'=>DB::table('orders')->whereNotNull('supplier_id')->count(),'manufacturer_activity'=>DB::table('orders')->whereNotNull('manufacturer_id')->count(),'customer_messages'=>DB::table('chat_messages')->count()];return view('production.admin',compact('projects','stats','filters'));}
    public function adminExport(Request $request){abort_unless(Auth::guard('admin')->check(),403);$filters=$request->validate(['status'=>'nullable|in:pending,in_progress,on_hold,completed,cancelled','from'=>'nullable|date','to'=>'nullable|date|after_or_equal:from']);$query=ProductionProject::with(['order.material','order.user'])->when($filters['status']??null,fn($q,$s)=>$q->where('status',$s))->when($filters['from']??null,fn($q,$d)=>$q->whereDate('created_at','>=',$d))->when($filters['to']??null,fn($q,$d)=>$q->whereDate('created_at','<=',$d));$rows=$query->latest()->get();return response()->streamDownload(function()use($rows){$out=fopen('php://output','w');fputcsv($out,['Order','Product','Buyer','Progress','Status','Stage','Start date','Expected completion']);foreach($rows as $p)fputcsv($out,[$p->order->uid??'ORD'.$p->order_id,$p->order->material->name??'',$p->order->user->name??'',$p->progress,$p->status,$p->stage,$p->start_date?->format('Y-m-d'),$p->expected_completion_date?->format('Y-m-d')]);fclose($out);},'production-projects.csv',['Content-Type'=>'text/csv']);}
}
