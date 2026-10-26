<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleOrder extends Model
{
    public static function canTransition(string $from, string $to): bool
    {
        $transitions = [
            'awaiting_approval' => ['awaiting_payment', 'rejected'],
            'awaiting_payment' => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped' => ['delivered'],
            'delivered' => [], 'rejected' => [], 'cancelled' => [],
        ];
        return in_array($to, $transitions[$from] ?? [], true);
    }

    protected $fillable = ['reference','buyer_id','original_order_id','product_sample_id','material_id','supplier_id','manufacturer_id','quantity','unit_price','subtotal','shipping_fee','tax_amount','discount_amount','total_amount','payment_status','order_status','shipping_address','tracking_number','courier','shipping_document_path','stripe_session_id','transaction_id','paid_at'];
    protected $casts = ['paid_at'=>'datetime','unit_price'=>'decimal:2','subtotal'=>'decimal:2','shipping_fee'=>'decimal:2','total_amount'=>'decimal:2'];
    public function sample() { return $this->belongsTo(ProductSample::class, 'product_sample_id'); }
    public function material() { return $this->belongsTo(Material::class); }
    public function buyer() { return $this->belongsTo(User::class, 'buyer_id'); }
    public function originalOrder() { return $this->belongsTo(Order::class, 'original_order_id'); }
    public function files() { return $this->hasMany(SampleFile::class); }
    public function messages() { return $this->hasMany(SampleMessage::class); }
    public function statusLogs() { return $this->hasMany(SampleOrderStatusLog::class); }
}
