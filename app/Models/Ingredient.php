<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property int     $id
 * @property Company $company
 */
class Ingredient extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'company_id',
        'name',
        'common_name',
        'description',
        'function',
    ];

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

    public function searchableAs(): string
    {
        return 'ingredients_index';
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}

