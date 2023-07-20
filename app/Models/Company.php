<?php

namespace App\Models;

use App\Traits\AuthUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use mysql_xdevapi\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int             $id
 * @property Collection      $products
 * @property Collection      $services
 * @property Collection      $ingredients
 * @property Collection      $addresses
 * @property CompanyCategory $companyCategory
 * @property string          $name
 * @property boolean         $has_details_completed
 * @property Collection      $orders
 * @property Collection      $sales
 * @property string          $email
 * @property User            $user
 * @property string          $mcc
 * @property string          $product_description
 * @property string          $phone
 * @property string          $website
 * @property string           $tax_id
 * @property string           $vat_id
 */
class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, AuthUser;

    protected $fillable = [
        'company_category_id',
        'name',
        'email',
        'phone',
        'has_details_completed',
        'slug',
        'product_description',
        'website',
        'tax_id',
        'vat_id',
        'mcc',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->getAttributes());
    }

    public function companyCategory(): BelongsTo
    {
        return $this->belongsTo(CompanyCategory::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity', 'price');
    }

    public function packingProducts(): HasMany
    {
        return $this->hasMany(PackingProduct::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Order::class, 'seller_id', 'id');
    }

    public function getPendingOrder(): ?Order
    {
        return self::$orders->where('status', Order::STATUS_PENDING)->first();
    }
}
