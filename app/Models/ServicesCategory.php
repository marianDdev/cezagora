<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ServicesCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const LEGAL_SERVICE        = 'legal_service';
    public const LABORATORY_SERVICE   = 'laboratory_service';
    public const MARKETING_SERVICE    = 'marketing_service';
    public const DISTRIBUTION_SERVICE = 'distribution_service';
    public const DELIVERY_SERVICE     = 'delivery_service';

    public const CATEGORIES = [
        self::LEGAL_SERVICE,
        self::LABORATORY_SERVICE,
        self::MARKETING_SERVICE,
        self::DISTRIBUTION_SERVICE,
        self::DELIVERY_SERVICE,
    ];

    protected $fillable = ['name'];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
