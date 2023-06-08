<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyIngredient extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'ingredient_id',
        'price',
    ];

    public $timestamps = false;

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class);
    }
}
