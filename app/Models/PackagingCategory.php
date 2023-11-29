<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackagingCategory extends Model
{
    use HasFactory;

    public function packingProducts(): HasMany
    {
        return $this->hasMany(Packaging::class);
    }
}
