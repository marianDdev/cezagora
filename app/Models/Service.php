<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'company_id',
        'type',
        'name',
        'description',
        'price',
        'additional_info'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function searchableAs(): string
    {
        return 'services_index';
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
