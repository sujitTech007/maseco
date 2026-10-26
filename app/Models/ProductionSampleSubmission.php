<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionSampleSubmission extends Model { protected $fillable=['production_project_id','product_sample_id','submitted_by_id','submitted_by_type','revision','status','submission_notes']; public function sample(){return $this->belongsTo(ProductSample::class,'product_sample_id');} public function reviews(){return $this->hasMany(ProductionSampleReview::class,'submission_id')->latest();} }
