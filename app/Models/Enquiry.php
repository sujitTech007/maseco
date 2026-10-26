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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function meetings()
    {
        return $this->hasMany(EnquiryMeeting::class);
    }
}
