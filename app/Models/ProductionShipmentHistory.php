<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionShipmentHistory extends Model { protected $fillable=['shipment_id','status','changed_by_id','changed_by_type','notes']; }
