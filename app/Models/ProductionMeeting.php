<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionMeeting extends Model { protected $fillable=['production_project_id','title','starts_at','meeting_url','created_by_id','created_by_type']; protected $casts=['starts_at'=>'datetime']; }
