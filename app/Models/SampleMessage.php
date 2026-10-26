<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleMessage extends Model
{
    protected $fillable = ['order_id','sample_order_id','sender_id','sender_type','message','sample_file_id'];
}
