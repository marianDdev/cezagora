<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

/**
 * @property boolean    $is_admin
 * @property int        $company_id
 * @property string     $first_name
 * @property string     $last_name
 * @property Company    $companies
 * @property boolean    $stripe_account_enabled
 * @property int        $id
 * @property string        $stripe_account_id
 * @property string        $stripe_customer_id
 * @property string     $email
 * @property Company|null $company
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles, HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'stripe_account_id',
        'stripe_customer_id',
        'stripe_account_enabled',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'completed_stripe_onboarding' => 'bool'
    ];

    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function products(): HasMany
    {
        return $this->hasManyThrough(Product::class, Company::class);
    }

    public function addresses(): BelongsToMany
    {
        return $this->hasManyThrough(Address::class, Company::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin == true;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }
}
