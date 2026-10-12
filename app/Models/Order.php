<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}


