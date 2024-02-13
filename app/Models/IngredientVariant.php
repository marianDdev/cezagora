<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $quantity
 */
class IngredientVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'unit',
        'size',
        'price',
        'quantity',
        'availability',
        'available_at',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
