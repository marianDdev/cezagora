<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Equipment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'company_id',
        'type',
        'name',
        'description',
        'price',
        'additional_info',
        'quantity',
        'availability',
        'available_at',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function searchableAs(): string
    {
        return 'equipment_index';
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
