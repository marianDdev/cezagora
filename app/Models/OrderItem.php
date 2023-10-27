<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int        $price
 * @property int        $quantity
 * @property Order      $order
 * @property Company    $seller
 * @property string     $name
 * @property int        $seller_id
 * @property int        $item_id
 * @property string     $item_type
 * @property Ingredient $ingredient
 * @property string     $status
 * @property int        $total
 */
class OrderItem extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const INGREDIENT_TYPE = 'ingredient';
    public const PRODUCT_TYPE    = 'product';
    private const TYPES           = [
        self::INGREDIENT_TYPE,
        self::PRODUCT_TYPE,
    ];

    protected $fillable = [
        'order_id',
        'seller_id',
        'shipping_id',
        'item_id',
        'item_type',
        'price',
        'quantity',
        'name',
        'total',
        'status',
    ];

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes['quantity'] * $this->attributes['price'],
            set: fn(int $value) => $value
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'seller_id', 'id');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function ingredient(): ?Ingredient
    {
        return Ingredient::find($this->attributes['item_id']);
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'item_id', 'id');
    }
}
