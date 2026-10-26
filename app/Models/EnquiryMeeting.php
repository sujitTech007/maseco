<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryMeeting extends Model
{
    protected $fillable = ['enquiry_id', 'title', 'starts_at', 'meeting_url', 'created_by_id', 'created_by_type'];
    protected $casts = ['starts_at' => 'datetime'];

    public function enquiry() { return $this->belongsTo(Enquiry::class); }
}
