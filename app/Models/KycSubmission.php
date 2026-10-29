<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycSubmission extends Model
{
    protected $fillable = [
        'account_type', 'account_id', 'identity_document', 'address_document',
        'business_document', 'tax_document', 'status', 'admin_note', 'submitted_at', 'reviewed_at',
        'document_back', 'selfie_document', 'profile_photo', 'document_type', 'document_number', 'form_data',
    ];

    protected $casts = ['submitted_at' => 'datetime', 'reviewed_at' => 'datetime', 'form_data' => 'array'];

    public function account()
    {
        $model = match ($this->account_type) {
            'supplier' => Supplier::class,
            'manufacturer' => Manufacturer::class,
            default => User::class,
        };

        return $model::find($this->account_id);
    }
}
