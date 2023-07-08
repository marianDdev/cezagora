<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingProductCategory extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'bottles',
        'jars',
        'roll-on',
        'airless packaging',
        'tubes',
        'other',
        'sprays',
        'caps closures',
        'dosing pumps',
        'triggers',
    ];

    public function packingProducts(): HasMany
    {
        return $this->hasMany(PackingProduct::class);
    }
}
