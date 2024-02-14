<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int     $id
 * @property Company $company
 */
class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'common_name',
        'description',
        'function',
    ];

    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->getAttributes());
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(IngredientVariant::class);
    }
}

