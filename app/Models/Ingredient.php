<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 */
class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description',
      'function'
    ];

    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->getAttributes());
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}

