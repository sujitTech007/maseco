<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionDeliveryHistory extends Model { protected $fillable=['delivery_id','previous_date','new_date','changed_by_id','changed_by_type','note']; protected $casts=['previous_date'=>'date','new_date'=>'date']; }
