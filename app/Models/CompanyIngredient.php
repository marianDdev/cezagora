<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $quantity
 */
class CompanyIngredient extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'ingredient_id',
        'price',
        'quantity',
    ];

    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
