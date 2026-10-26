<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionProgressHistory extends Model { protected $fillable=['production_project_id','previous_progress','new_progress','previous_status','new_status','user_id','user_type','notes']; }
