<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionMilestone extends Model { protected $fillable=['production_project_id','title','description','due_date','assigned_user_id','assigned_user_type','status','notes','completed_at']; protected $casts=['due_date'=>'date','completed_at'=>'datetime']; }
