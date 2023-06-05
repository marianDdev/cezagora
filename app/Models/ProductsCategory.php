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

    public const CATEGORIES = [
        'skin cream',
        'skin emulsion',
        'skin lotion',
        'skin gel',
        'skin oil',
        'face mask',
        'tinted base',
        'powder',
        'after bath',
        'soap',
        'perfume',
        'toilet water',
        'eau de cologne',
        'bath salt',
        'bath foam',
        'bath oil',
        'bath gel',
        'shower foam',
        'shower oil',
        'shower gel',
        'depilatory',
        'deodorant',
        'antiperspirant',
        'hair colorant',
        'hair lotion',
        'hair powder',
        'shampoo',
        'hair conditioner',
        'shaving cream',
        'shaving foam',
        'shaving lotion',
        'make up',
        'make up removal',
        'for lips',
        'for teeth',
        'for nails',
        'for intimate hygiene',
        'sunbathing',
        'tanning',
        'skin whitening',
        'anti wrinkle',
    ];

    protected $fillable = ['name'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
