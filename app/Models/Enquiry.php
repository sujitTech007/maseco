<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'user_id', 'material_id', 'supplier_id', 'manufacturer_id', 'quantity', 'expected_price', 'subject', 'message', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
