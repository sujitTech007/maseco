<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchase extends Model
{
    protected $fillable = [
        'user_id', 'stripe_id', 'plan_name', 'price', 'commission', 'total_amount', 'commission_amount', 'start_date', 'end_date', 'is_active', 'payment_status',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
