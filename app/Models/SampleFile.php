<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleFile extends Model
{
    protected $fillable = ['order_id','sample_order_id','product_sample_id','uploaded_by_id','uploaded_by_type','recipient_type','recipient_id','file_path','original_filename','mime_type','file_size','title','description','status'];
    public function order() { return $this->belongsTo(Order::class); }
}
