<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionProjectFile extends Model { protected $fillable=['production_project_id','uploaded_by_id','uploaded_by_type','path','filename','mime_type','size','title']; }
