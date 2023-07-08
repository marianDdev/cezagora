<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'item_type',
        'item_id',
        'name',
        'price',
        'quantity',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
