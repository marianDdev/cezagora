<?php

namespace App\Models;

use App\Traits\AuthUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int             $id
 * @property Collection      $products
 * @property Collection      $services
 * @property Collection      $ingredients
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
 * @property string          $tax_id
 * @property string          $vat_id
 * @property Collection      $categories
 * @property bool            $is_active
 * @property Address         $address
 * @property Collection      $packagings
 * @property Collection      $qualifications
 * @property Collection      $campaigns
 */
class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, AuthUser;

    protected $fillable = [
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
        'is_active',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->getAttributes());
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CompanyCategory::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function packagings(): HasMany
    {
        return $this->hasMany(Packaging::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'seller_id', 'id');
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function isActive(): bool
    {
        return $this->user->is_active;
    }

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function documents(): HasManyThrough
    {
        return $this->hasManyThrough(
            Document::class,
            Ingredient::class,
            'company_id',
            'ingredient_id',
            'id',
            'id'
        );
    }

    public function receivedRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'reviewee_id');
    }

    public function givenRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'reviewer_id');
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(CompanyCampaign::class);
    }

    /**
     * only searches without results
     */
    public function searches(): HasMany
    {
        return $this->hasMany(Search::class);
    }

    public function deliveryAddress(): HasOne
    {
        return $this->hasOne(DeliveryAddress::class);
    }
}
