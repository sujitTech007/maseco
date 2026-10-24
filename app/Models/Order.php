<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Order extends Model
{
    protected static function booted(): void
    {
        static::created(function (Order $order) {
            if (Schema::hasColumn('orders', 'uid')) {
                $order->forceFill([
                    'uid' => 'ORD' . str_pad((string) $order->getKey(), 4, '0', STR_PAD_LEFT),
                ])->saveQuietly();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'enquiry_id',
        'supplier_id',
        'manufacturer_id',
        'material_id',
        'quantity',
        'amount',
        'status',
        'payment_status',
        'tracking_number',
        'shipping_method',
        'estimated_delivery',
        'shipping_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}


