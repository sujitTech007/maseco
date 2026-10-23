<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $casts = [
        'is_certified' => 'boolean',
    ];
    protected $fillable = [
        'supplier_id',
        'manufacturer_id',
        'name',
        'sku',
        'category',
        'sub_category',
        'description',
        'grade',
        'strength',
        'size',
        'weight',
        'unit',
        'price',
        'moq',
        'stock',
        'supplier',
        'location',
        'lead_time',
        'certification',
        'safety',
        'image',
        'datasheet',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
