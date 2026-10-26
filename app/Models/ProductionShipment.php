<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionShipment extends Model { protected $fillable=['production_project_id','carrier','tracking_number','tracking_url','shipment_date','expected_delivery_date','package_details','notes','status']; protected $casts=['shipment_date'=>'date','expected_delivery_date'=>'date']; public function histories(){return $this->hasMany(ProductionShipmentHistory::class)->latest();} }
