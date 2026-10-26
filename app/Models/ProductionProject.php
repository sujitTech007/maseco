<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionProject extends Model
{
    protected $fillable=['order_id','created_by_id','created_by_type','progress','status','stage','start_date','expected_completion_date'];
    protected $casts=['start_date'=>'date','expected_completion_date'=>'date'];
    public function order(){return $this->belongsTo(Order::class);}
    public function histories(){return $this->hasMany(ProductionProgressHistory::class)->latest();}
    public function milestones(){return $this->hasMany(ProductionMilestone::class)->orderBy('due_date');}
    public function submissions(){return $this->hasMany(ProductionSampleSubmission::class)->latest();}
    public function comments(){return $this->hasMany(ProductionComment::class)->latest();}
    public function files(){return $this->hasMany(ProductionProjectFile::class)->latest();}
    public function deliveries(){return $this->hasMany(ProductionDelivery::class)->latest();}
    public function shipments(){return $this->hasMany(ProductionShipment::class)->latest();}
    public function meetings(){return $this->hasMany(ProductionMeeting::class)->orderBy('starts_at');}
    public function activities(){return $this->hasMany(ProductionActivity::class)->latest();}
}
