<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleOrderStatusLog extends Model
{
    protected $fillable = ['sample_order_id','old_status','new_status','changed_by_id','changed_by_type','note'];
}
