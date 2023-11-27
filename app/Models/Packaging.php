<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Packaging extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'packaging_category_id',
        'name',
        'description',
        'slug',
        'price',
        'capacity',
        'colour',
        'material',
        'neck_size',
        'bottom_shape',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PackagingCategory::class);
    }
}
