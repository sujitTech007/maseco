<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductionSampleReview extends Model { protected $fillable=['submission_id','reviewer_id','reviewer_type','decision','feedback','reviewed_at']; protected $casts=['reviewed_at'=>'datetime']; }
