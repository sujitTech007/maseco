<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionDelivery extends Model { protected $fillable=['production_project_id','address','expected_date','instructions','responsible_user_id','responsible_user_type','status']; protected $casts=['expected_date'=>'date']; public function productionProject(){return $this->belongsTo(ProductionProject::class);} public function histories(){return $this->hasMany(ProductionDeliveryHistory::class)->latest();} }
