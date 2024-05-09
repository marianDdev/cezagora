<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Packaging extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'company_id',
        'packaging_category_id',
        'name',
        'description',
        'price',
        'capacity',
        'colour',
        'material',
        'neck_size',
        'bottom_shape',
        'quantity',
        'availability',
        'available_at',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PackagingCategory::class, 'packaging_category_id');
    }

    public function searchableAs(): string
    {
        return 'packaging_index';
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
