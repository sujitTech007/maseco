<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSample extends Model
{
    protected $fillable = ['material_id','supplier_id','manufacturer_id','name','description','specifications','price','shipping_fee','stock_quantity','processing_days','image_path','status'];
    protected $casts = ['price'=>'decimal:2','shipping_fee'=>'decimal:2'];
    public function material() { return $this->belongsTo(Material::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function manufacturer() { return $this->belongsTo(Manufacturer::class); }
    public function files() { return $this->hasMany(SampleFile::class); }
}
