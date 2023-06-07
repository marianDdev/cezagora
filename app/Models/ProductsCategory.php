<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductsCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name'];

    public const ORAL_CARE = 'oral care';
    public const SKIN_CARE = 'skin care';
    public const SUN_CARE = 'sun care';
    public const HAIR_CARE = 'hair care';
    public const DECORATIVE_COSMETICS = 'decorative cosmetics';
    public const BODY_CARE = 'body care';
    public const PERFUMES = 'perfumes';

    public const COSMETICS_CATEGORIES = [
        self::ORAL_CARE,
        self::SKIN_CARE,
        self::SUN_CARE,
        self::HAIR_CARE,
        self::DECORATIVE_COSMETICS,
        self::BODY_CARE,
        self::PERFUMES,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
