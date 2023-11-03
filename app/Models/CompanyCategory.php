<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 */
class CompanyCategory extends Model
{
    use HasFactory;

    public const MANUFACTURER         = 'manufacturer';
    public const DISTRIBUTOR          = 'distributor';
    public const WHOLESALER           = 'wholesaler';
    public const RETAILER             = 'retailer';
    public const LABORATORY           = 'laboratory';
    public const INGREDIENTS_SUPPLIER = 'ingredients supplier';
    public const PACKAGING_SUPPLIER   = 'packaging supplier';
    public const LEGAL_CONSULTANT     = 'legal consultant';
    public const MARKETING_AGENCY     = 'marketing agency';
    public const CONSUMER = 'consumer';
    public const CARRIER = 'carrier';

    public const TYPES = [
        self::CARRIER,
        self::CONSUMER,
        self::DISTRIBUTOR,
        self::INGREDIENTS_SUPPLIER,
        self::LABORATORY,
        self::LEGAL_CONSULTANT,
        self::MANUFACTURER,
        self::MARKETING_AGENCY,
        self::PACKAGING_SUPPLIER,
        self::RETAILER,
        self::WHOLESALER,
    ];

    protected $fillable = ['name'];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}
