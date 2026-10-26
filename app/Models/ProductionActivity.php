<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionActivity extends Model { protected $fillable=['production_project_id','actor_id','actor_type','event','description']; }
