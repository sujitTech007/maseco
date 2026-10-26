<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Order;
use App\Models\ProductSample;
use App\Models\SampleFile;
use App\Models\SampleMessage;
use App\Models\SampleOrder;
use App\Models\SampleOrderStatusLog;
use App\Notifications\SampleWorkflowNotification;
use App\Support\SubscriptionAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class SampleSystemController extends Controller
{
    private function notifyPurchaseParticipants(SampleOrder $purchase, string $event, string $message, ?string $only = null): void
    {
        try {
            if ($only !== 'seller') $purchase->buyer?->notify(new SampleWorkflowNotification($event,$message,route('user.samples.purchase.show',$purchase)));
            if ($only !== 'buyer') {
                $seller=$purchase->supplier_id ? \App\Models\Supplier::find($purchase->supplier_id) : \App\Models\Manufacturer::find($purchase->manufacturer_id);
                $type=$purchase->supplier_id ? 'seller' : 'manufacturer';
                if ($seller) $seller->notify(new SampleWorkflowNotification($event,$message,route($type.'.samples.purchase.show',$purchase)));
            }
        } catch (\Throwable $e) { report($e); }
    }

    private function notifyOrderOtherParty(Order $order, string $event, string $message, string $senderType): void
    {
        try {
            if ($senderType === 'buyer') {
                $seller=$order->supplier_id ? \App\Models\Supplier::find($order->supplier_id) : \App\Models\Manufacturer::find($order->manufacturer_id);
                $routeName=$order->supplier_id ? 'seller.orders.sharing' : 'manufacturer.orders.sharing';
                $seller?->notify(new SampleWorkflowNotification($event,$message,route($routeName,$order)));
            } else {
                $buyer=$order->user;
                $buyer?->notify(new SampleWorkflowNotification($event,$message,route('user.orders.sharing',$order)));
            }
        } catch (\Throwable $e) { report($e); }
    }

    private function actor(): array
    {
        foreach (['web'=>'buyer','supplier'=>'supplier','manufacturer'=>'manufacturer'] as $guard=>$type) {
            if (Auth::guard($guard)->check()) return [Auth::guard($guard)->user(), $type];
        }
        abort(403);
    }

    private function ownsMaterial(Material $material, string $type, int $id): bool
    {
        return $type === 'supplier' ? (int)$material->supplier_id === $id : ($type === 'manufacturer' && (int)$material->manufacturer_id === $id);
    }

    private function sellerQuery(string $type, int $id)
    {
        return ProductSample::query()->where($type.'_id', $id);
    }

    public function manage(Request $request)
    {
        [$actor,$type] = $this->actor(); abort_unless($type !== 'buyer', 403);
        $samples = $this->sellerQuery($type,$actor->id)->with(['material','files'])->latest()->paginate(15);
        $purchases = SampleOrder::where($type.'_id',$actor->id)->with(['sample','buyer','material'])->latest()->paginate(15,['*'],'purchases_page');
        $materials = Material::where($type.'_id',$actor->id)->orderBy('name')->get();
        return view('samples.manage', compact('samples','purchases','materials','type'));
    }

    public function storeSample(Request $request)
    {
        [$actor,$type] = $this->actor(); abort_unless($type !== 'buyer',403);
        $data=$request->validate(['material_id'=>'required|integer','name'=>'required|string|max:255','description'=>'nullable|string|max:10000','specifications'=>'nullable|string|max:10000','price'=>'required|numeric|min:0.01|max:999999999','shipping_fee'=>'required|numeric|min:0|max:999999999','stock_quantity'=>'required|integer|min:0|max:1000000','processing_days'=>'required|integer|min:0|max:365','status'=>'required|in:active,inactive','image'=>'nullable|image|max:5120']);
        $material=Material::findOrFail($data['material_id']); abort_unless($this->ownsMaterial($material,$type,$actor->id),403);
        $sample=new ProductSample(array_merge(collect($data)->except('image')->all(),['supplier_id'=>$type==='supplier'?$actor->id:null,'manufacturer_id'=>$type==='manufacturer'?$actor->id:null]));
        if ($request->hasFile('image')) $sample->image_path=$request->file('image')->store('sample-images','public');
        $sample->save(); return back()->with('success','Sample listing saved.');
    }

    public function updateSample(Request $request, ProductSample $sample)
    {
        [$actor,$type]=$this->actor(); abort_unless($type!=='buyer' && (int)$sample->{$type.'_id'}===(int)$actor->id,403);
        $data=$request->validate(['material_id'=>'required|integer','name'=>'required|string|max:255','description'=>'nullable|string|max:10000','specifications'=>'nullable|string|max:10000','price'=>'required|numeric|min:0.01|max:999999999','shipping_fee'=>'required|numeric|min:0|max:999999999','stock_quantity'=>'required|integer|min:0|max:1000000','processing_days'=>'required|integer|min:0|max:365','status'=>'required|in:active,inactive','image'=>'nullable|image|max:5120']);
        $material=Material::findOrFail($data['material_id']); abort_unless($this->ownsMaterial($material,$type,$actor->id),403);
        if ($request->hasFile('image')) { if($sample->image_path) Storage::disk('public')->delete($sample->image_path); $data['image_path']=$request->file('image')->store('sample-images','public'); }
        unset($data['image']); $sample->update($data); return back()->with('success','Sample listing updated.');
    }

    public function destroySample(ProductSample $sample)
    {
        [$actor,$type]=$this->actor(); abort_unless($type!=='buyer' && (int)$sample->{$type.'_id'}===(int)$actor->id,403);
        if (SampleOrder::where('product_sample_id',$sample->id)->exists()) {
            return back()->with('error','This sample has purchase history and cannot be deleted. Set it to Inactive instead.');
        }
        foreach ($sample->files as $file) {
            Storage::disk('local')->delete($file->file_path);
            $file->delete();
        }
        if ($sample->image_path) Storage::disk('public')->delete($sample->image_path);
        $sample->delete();
        return back()->with('success','Sample deleted.');
    }

    public function storeSampleDocument(Request $request, ProductSample $sample)
    {
        [$actor,$type]=$this->actor(); abort_unless($type!=='buyer' && (int)$sample->{$type.'_id'}===(int)$actor->id,403);
        $data=$request->validate(['title'=>'required|string|max:255','description'=>'nullable|string|max:2000','file'=>'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx,csv,txt']);
        $upload=$request->file('file'); $path=$upload->store('sample-documents/'.$sample->id,'local');
        SampleFile::create(['product_sample_id'=>$sample->id,'uploaded_by_id'=>$actor->id,'uploaded_by_type'=>$type,'recipient_type'=>'buyer','file_path'=>$path,'original_filename'=>$upload->getClientOriginalName(),'mime_type'=>$upload->getMimeType(),'file_size'=>$upload->getSize(),'title'=>$data['title'],'description'=>$data['description']??null]);
        return back()->with('success','Supporting document uploaded.');
    }

    public function buyerOrder(Order $order)
    {
        [$actor,$type]=$this->actor();
        abort_unless(($type==='buyer' && (int)$order->user_id===(int)$actor->id)||($type==='supplier' && (int)$order->supplier_id===(int)$actor->id)||($type==='manufacturer' && (int)$order->manufacturer_id===(int)$actor->id),403);
        $order->load(['material','supplier','manufacturer']);
        $samples=ProductSample::where('material_id',$order->material_id)->where('status','active')->where('stock_quantity','>',0)
            ->where(function($q)use($order){ if($order->supplier_id)$q->where('supplier_id',$order->supplier_id); elseif($order->manufacturer_id)$q->where('manufacturer_id',$order->manufacturer_id); else $q->whereRaw('1=0'); })->with(['material','supplier','manufacturer','files'])->paginate(12);
        $files=SampleFile::where('order_id',$order->id)->latest()->get(); $messages=SampleMessage::where('order_id',$order->id)->latest()->get();
        $purchases=$type==='buyer' ? SampleOrder::where('buyer_id',$actor->id)->where('original_order_id',$order->id)->with(['sample','statusLogs'])->latest()->get() : collect();
        return view('samples.buyer-order',compact('order','samples','files','messages','purchases','type'));
    }

    public function materialSamples(Material $material)
    {
        abort_unless(Auth::guard('web')->check(),401);
        $samples=ProductSample::where('material_id',$material->id)->where('status','active')->where('stock_quantity','>',0)
            ->with(['material','supplier','manufacturer','files'])->latest()->paginate(12);
        return view('samples.material-catalog',compact('material','samples'));
    }

    public function myPurchases()
    {
        $purchases=SampleOrder::where('buyer_id',Auth::id())->with(['sample','material','statusLogs'])->latest()->paginate(15);
        return view('samples.my-purchases',compact('purchases'));
    }

    public function uploadFile(Request $request, Order $order)
    {
        abort_unless((int)$order->user_id===(int)Auth::id(),403);
        $data=$request->validate(['title'=>'required|string|max:255','description'=>'nullable|string|max:2000','file'=>'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx,csv,txt']);
        $path=$request->file('file')->store('order-sharing/'.$order->id,'local');
        SampleFile::create(['order_id'=>$order->id,'uploaded_by_id'=>Auth::id(),'uploaded_by_type'=>'buyer','recipient_type'=>$order->supplier_id?'supplier':'manufacturer','recipient_id'=>$order->supplier_id?:$order->manufacturer_id,'file_path'=>$path,'original_filename'=>$request->file('file')->getClientOriginalName(),'mime_type'=>$request->file('file')->getMimeType(),'file_size'=>$request->file('file')->getSize(),'title'=>$data['title'],'description'=>$data['description']??null]);
        $this->notifyOrderOtherParty($order,'order_file','A new file was shared on order '.($order->uid??$order->id).'.','buyer');
        return back()->with('success','File shared with the seller.');
    }

    private function canAccessOrderFile(SampleFile $file): bool
    {
        [$actor,$type]=$this->actor();
        if ($file->product_sample_id) {
            $sample=ProductSample::findOrFail($file->product_sample_id);
            if ($type!=='buyer') return (int)$sample->{$type.'_id'}===(int)$actor->id;
            return $sample->status==='active';
        }
        if ($file->sample_order_id) { $purchase=SampleOrder::findOrFail($file->sample_order_id); return ($type==='buyer' && (int)$purchase->buyer_id===(int)$actor->id) || ($type!=='buyer' && (int)$purchase->{$type.'_id'}===(int)$actor->id); }
        $order=Order::findOrFail($file->order_id);
        return ($type==='buyer' && (int)$order->user_id===(int)$actor->id) || ($type==='supplier' && (int)$order->supplier_id===(int)$actor->id) || ($type==='manufacturer' && (int)$order->manufacturer_id===(int)$actor->id);
    }

    public function downloadFile(SampleFile $file) { abort_unless($this->canAccessOrderFile($file),403); abort_unless(Storage::disk('local')->exists($file->file_path),404); return Storage::disk('local')->download($file->file_path,$file->original_filename); }
    public function deleteFile(SampleFile $file) { [$actor,$type]=$this->actor(); abort_unless($type==='buyer' && $file->uploaded_by_type==='buyer' && (int)$file->uploaded_by_id===(int)$actor->id && $this->canAccessOrderFile($file),403); Storage::disk('local')->delete($file->file_path); $file->delete(); return back()->with('success','File deleted.'); }

    public function addOrderFile(Request $request, Order $order)
    {
        [$actor,$type]=$this->actor(); abort_unless($type!=='buyer' && (int)$order->{$type.'_id'}===(int)$actor->id,403);
        $data=$request->validate(['title'=>'required|string|max:255','description'=>'nullable|string|max:2000','file'=>'required|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx,csv,txt']);
        $path=$request->file('file')->store('order-sharing/'.$order->id,'local');
        SampleFile::create(['order_id'=>$order->id,'uploaded_by_id'=>$actor->id,'uploaded_by_type'=>$type,'recipient_type'=>'buyer','recipient_id'=>$order->user_id,'file_path'=>$path,'original_filename'=>$request->file('file')->getClientOriginalName(),'mime_type'=>$request->file('file')->getMimeType(),'file_size'=>$request->file('file')->getSize(),'title'=>$data['title'],'description'=>$data['description']??null]);
        $this->notifyOrderOtherParty($order,'order_file','The seller shared a file on order '.($order->uid??$order->id).'.',$type);
        return back()->with('success','File shared with buyer.');
    }

    public function orderMessage(Request $request, Order $order)
    {
        [$actor,$type]=$this->actor();
        abort_unless(($type==='buyer' && (int)$order->user_id===(int)$actor->id)||($type==='supplier' && (int)$order->supplier_id===(int)$actor->id)||($type==='manufacturer' && (int)$order->manufacturer_id===(int)$actor->id),403);
        $data=$request->validate(['message'=>'required|string|max:5000','sample_file_id'=>'nullable|integer']);
        $file=null; if(!empty($data['sample_file_id'])) { $file=SampleFile::where('order_id',$order->id)->findOrFail($data['sample_file_id']); abort_unless($this->canAccessOrderFile($file),403); }
        SampleMessage::create(['order_id'=>$order->id,'sender_id'=>$actor->id,'sender_type'=>$type,'message'=>$data['message'],'sample_file_id'=>$file?->id]);
        $this->notifyOrderOtherParty($order,'order_message','A new message was added to order '.($order->uid??$order->id).'.',$type);
        return back()->with('success','Message sent.');
    }

    public function purchase(Request $request)
    {
        if (!SubscriptionAccess::hasActive('buyer',(int)Auth::id())) {
            return redirect()->route('subscription.plan')->with('error','Please activate a subscription before placing a sample order.');
        }
        $data=$request->validate(['sample_id'=>'required|integer','quantity'=>'required|integer|min:1|max:1000','original_order_id'=>'nullable|integer','shipping_address'=>'required|string|max:3000']);
        $purchase=DB::transaction(function()use($data){
            $sample=ProductSample::where('status','active')->lockForUpdate()->findOrFail($data['sample_id']);
            abort_if($sample->stock_quantity<(int)$data['quantity'],422,'Requested quantity is unavailable.');
            $material=Material::findOrFail($sample->material_id);
            $original=null;
            if(!empty($data['original_order_id'])) { $original=Order::where('user_id',Auth::id())->findOrFail($data['original_order_id']); abort_unless((int)$original->material_id===(int)$sample->material_id && (($sample->supplier_id && (int)$original->supplier_id===(int)$sample->supplier_id)||($sample->manufacturer_id && (int)$original->manufacturer_id===(int)$sample->manufacturer_id)),403); }
            $qty=(int)$data['quantity']; $subtotal=round((float)$sample->price*$qty,2); $shipping=round((float)$sample->shipping_fee,2);
            abort_if(($subtotal+$shipping)>9999999999.99,422,'The calculated total exceeds the supported purchase amount.');
            $sample->decrement('stock_quantity',$qty);
            $purchase=SampleOrder::create(['reference'=>'SMP-'.Str::upper(Str::random(10)),'buyer_id'=>Auth::id(),'original_order_id'=>$original?->id,'product_sample_id'=>$sample->id,'material_id'=>$sample->material_id,'supplier_id'=>$sample->supplier_id,'manufacturer_id'=>$sample->manufacturer_id,'quantity'=>$qty,'unit_price'=>$sample->price,'subtotal'=>$subtotal,'shipping_fee'=>$shipping,'total_amount'=>$subtotal+$shipping,'shipping_address'=>$data['shipping_address'],'order_status'=>'awaiting_approval','payment_status'=>'pending']);
            SampleOrderStatusLog::create(['sample_order_id'=>$purchase->id,'new_status'=>'awaiting_approval','changed_by_id'=>Auth::id(),'changed_by_type'=>'buyer','note'=>'Sample purchase requested']);
            return $purchase;
        });
        $this->notifyPurchaseParticipants($purchase,'sample_requested','A buyer requested sample '.$purchase->reference.'.','buyer');
        return redirect()->route('user.samples.purchase.show',$purchase)->with('success','Sample request sent. The seller must approve it before payment.');
    }

    public function purchaseShow(SampleOrder $purchase)
    {
        [$actor,$type]=$this->actor(); $this->authorizePurchase($purchase,$actor,$type);
        $purchase->load(['sample','material','buyer','files','messages','statusLogs']);
        return view('samples.purchase-show',compact('purchase','type'));
    }

    private function authorizePurchase(SampleOrder $purchase,$actor,string $type): void { abort_unless(($type==='buyer' && (int)$purchase->buyer_id===(int)$actor->id)||($type!=='buyer' && (int)$purchase->{$type.'_id'}===(int)$actor->id),403); }

    public function sellerDecision(Request $request, SampleOrder $purchase)
    {
        [$actor,$type]=$this->actor(); $this->authorizePurchase($purchase,$actor,$type);
        $data=$request->validate(['decision'=>'required|in:approve,reject']); $target=$data['decision']==='approve'?'awaiting_payment':'rejected'; abort_unless(SampleOrder::canTransition($purchase->order_status,$target),409);
        if ($data['decision']==='approve' && !SubscriptionAccess::hasActive($type,(int)$actor->id)) return redirect()->route('subscription.plan')->with('error','Activate a subscription before approving sample orders.');
        DB::transaction(function()use($purchase,$actor,$type,$data){ $old=$purchase->order_status; $new=$data['decision']==='approve'?'awaiting_payment':'rejected'; $purchase->update(['order_status'=>$new]); if($new==='rejected') ProductSample::whereKey($purchase->product_sample_id)->increment('stock_quantity',$purchase->quantity); SampleOrderStatusLog::create(['sample_order_id'=>$purchase->id,'old_status'=>$old,'new_status'=>$new,'changed_by_id'=>$actor->id,'changed_by_type'=>$type]); });
        $decisionLabel=$data['decision']==='approve'?'approved':'rejected';
        $this->notifyPurchaseParticipants($purchase,'sample_'.$data['decision'],'The seller '.$decisionLabel.' sample request '.$purchase->reference.'.','seller');
        return back()->with('success','Sample request '.$decisionLabel.'.');
    }

    public function checkout(SampleOrder $purchase)
    {
        abort_unless((int)$purchase->buyer_id===(int)Auth::id(),403); abort_unless($purchase->order_status==='awaiting_payment' && $purchase->payment_status!=='paid',409);
        if(!config('services.stripe.secret')) return back()->with('info','Online payment is not configured. This purchase remains pending for the administrator payment confirmation workflow.');
        try { Stripe::setApiKey(config('services.stripe.secret')); $session=StripeSession::create(['mode'=>'payment','payment_method_types'=>['card'],'line_items'=>[['price_data'=>['currency'=>strtolower(config('services.stripe.currency','usd')),'product_data'=>['name'=>'Sample purchase '.$purchase->reference],'unit_amount'=>(int)round($purchase->total_amount*100)],'quantity'=>1]],'success_url'=>route('user.samples.checkout.success',['purchase'=>$purchase->id]).'?session_id={CHECKOUT_SESSION_ID}','cancel_url'=>route('user.samples.purchase.show',$purchase),'customer_email'=>Auth::user()->email,'metadata'=>['sample_order_id'=>(string)$purchase->id,'buyer_id'=>(string)Auth::id()]]); $purchase->update(['stripe_session_id'=>$session->id]); return redirect()->away($session->url); }
        catch(\Throwable $e) { report($e); return back()->with('error','Payment could not be started. Please try again later.'); }
    }

    public function checkoutSuccess(Request $request, SampleOrder $purchase)
    {
        abort_unless((int)$purchase->buyer_id===(int)Auth::id(),403); $sid=$request->query('session_id'); abort_unless($sid && hash_equals((string)$purchase->stripe_session_id,(string)$sid),403);
        try { Stripe::setApiKey(config('services.stripe.secret')); $session=StripeSession::retrieve($sid); abort_unless(($session->payment_status??null)==='paid' && (string)($session->metadata->sample_order_id??'')===(string)$purchase->id && (string)($session->metadata->buyer_id??'')===(string)Auth::id(),403);
            DB::transaction(function()use($purchase,$sid){ $p=SampleOrder::whereKey($purchase->id)->lockForUpdate()->firstOrFail(); if($p->payment_status==='paid')return; $p->update(['payment_status'=>'paid','transaction_id'=>$sid,'paid_at'=>now(),'order_status'=>'processing']); SampleOrderStatusLog::create(['sample_order_id'=>$p->id,'old_status'=>'awaiting_payment','new_status'=>'processing','changed_by_id'=>Auth::id(),'changed_by_type'=>'buyer','note'=>'Payment verified by Stripe']); });
            $this->notifyPurchaseParticipants($purchase,'sample_paid','Payment was verified for sample purchase '.$purchase->reference.'.','buyer');
            return redirect()->route('user.samples.purchase.show',$purchase)->with('success','Payment verified and sample is processing.');
        } catch(\Throwable $e) { report($e); return redirect()->route('user.samples.purchase.show',$purchase)->with('error','Payment verification failed.'); }
    }

    public function status(Request $request, SampleOrder $purchase)
    {
        [$actor,$type]=$this->actor(); $this->authorizePurchase($purchase,$actor,$type);
        $data=$request->validate(['status'=>'required|in:processing,shipped,delivered,cancelled','tracking_number'=>'nullable|string|max:255','courier'=>'nullable|string|max:255','shipping_document'=>'nullable|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx']);
        if($type==='buyer') abort_unless($data['status']==='delivered' && $purchase->order_status==='shipped',403);
        else { abort_unless($purchase->payment_status==='paid' || $data['status']==='cancelled',403); abort_unless(SampleOrder::canTransition($purchase->order_status,$data['status']),409); }
        if($data['status']==='cancelled' && $purchase->payment_status==='paid') abort(409,'Paid sample orders require an administrator refund review.');
        $old=$purchase->order_status; $update=['order_status'=>$data['status']]; $shipmentFile=null; if($type!=='buyer'){ $update['tracking_number']=$data['tracking_number']??$purchase->tracking_number; $update['courier']=$data['courier']??$purchase->courier; if($request->hasFile('shipping_document')) { $upload=$request->file('shipping_document'); $update['shipping_document_path']=$upload->store('sample-shipping/'.$purchase->id,'local'); $shipmentFile=['path'=>$update['shipping_document_path'],'upload'=>$upload]; } }
        DB::transaction(function()use($purchase,$actor,$type,$old,$data,$update,$shipmentFile){$purchase->update($update); if($data['status']==='cancelled') ProductSample::whereKey($purchase->product_sample_id)->increment('stock_quantity',$purchase->quantity); if($shipmentFile){$u=$shipmentFile['upload'];SampleFile::create(['sample_order_id'=>$purchase->id,'uploaded_by_id'=>$actor->id,'uploaded_by_type'=>$type,'recipient_type'=>'buyer','recipient_id'=>$purchase->buyer_id,'file_path'=>$shipmentFile['path'],'original_filename'=>$u->getClientOriginalName(),'mime_type'=>$u->getMimeType(),'file_size'=>$u->getSize(),'title'=>'Shipping document']);} SampleOrderStatusLog::create(['sample_order_id'=>$purchase->id,'old_status'=>$old,'new_status'=>$data['status'],'changed_by_id'=>$actor->id,'changed_by_type'=>$type]);});
        $this->notifyPurchaseParticipants($purchase,'sample_status','Sample purchase '.$purchase->reference.' is now '.str_replace('_',' ',$data['status']).'.',$type==='buyer'?'buyer':'seller');
        return back()->with('success','Sample purchase status updated.');
    }

    public function message(Request $request, SampleOrder $purchase)
    {
        [$actor,$type]=$this->actor(); $this->authorizePurchase($purchase,$actor,$type); $data=$request->validate(['message'=>'required|string|max:5000','file'=>'nullable|file|max:20480|mimes:pdf,png,jpg,jpeg,webp,doc,docx,xls,xlsx,csv,txt']);
        $file=null; if($request->hasFile('file')){$upload=$request->file('file');$path=$upload->store('sample-sharing/'.$purchase->id,'local');$file=SampleFile::create(['sample_order_id'=>$purchase->id,'uploaded_by_id'=>$actor->id,'uploaded_by_type'=>$type,'file_path'=>$path,'original_filename'=>$upload->getClientOriginalName(),'mime_type'=>$upload->getMimeType(),'file_size'=>$upload->getSize(),'title'=>'Message attachment']);}
        SampleMessage::create(['sample_order_id'=>$purchase->id,'sender_id'=>$actor->id,'sender_type'=>$type,'message'=>$data['message'],'sample_file_id'=>$file?->id]); $this->notifyPurchaseParticipants($purchase,'sample_message','A new message was added to '.$purchase->reference.'.',$type==='buyer'?'buyer':'seller'); return back()->with('success','Message sent.');
    }

    public function manualPaymentConfirmed(SampleOrder $purchase)
    {
        // Protected by the existing admin.auth middleware; no browser-side payment claim is accepted.
        abort_unless($purchase->payment_status==='pending' && $purchase->order_status==='awaiting_payment',409);
        $admin=Auth::guard('admin')->user();
        DB::transaction(function()use($purchase,$admin){$p=SampleOrder::whereKey($purchase->id)->lockForUpdate()->firstOrFail();$p->update(['payment_status'=>'paid','paid_at'=>now(),'order_status'=>'processing']);SampleOrderStatusLog::create(['sample_order_id'=>$p->id,'old_status'=>'awaiting_payment','new_status'=>'processing','changed_by_id'=>$admin->id,'changed_by_type'=>'admin','note'=>'Manually confirmed by admin']);});
        return back()->with('success','Payment confirmed; sample can now be prepared.');
    }

    public function adminPurchases()
    {
        $purchases=SampleOrder::with(['sample','material','buyer'])->latest()->paginate(25);
        return view('samples.admin-purchases',compact('purchases'));
    }
}
