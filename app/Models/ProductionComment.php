<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionComment extends Model { protected $fillable=['production_project_id','author_id','author_type','body']; }
