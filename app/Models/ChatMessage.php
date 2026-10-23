<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['enquiry_id', 'sender_type', 'sender_id', 'body', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
}
