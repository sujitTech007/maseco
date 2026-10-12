<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'amount', 'status', 'provider', 'transaction_id', 'meta'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
