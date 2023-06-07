<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyCategory extends Model
{
    use HasFactory;

    public const MANUFACTURER         = 'manufacturer';
    public const DISTRIBUTOR          = 'distributor';
    public const WHOLESALER           = 'wholesaler';
    public const RETAILER             = 'retailer';
    public const LABORATORY           = 'laboratory';
    public const INGREDIENTS_SUPPLIER = 'ingredients supplier';
    public const PACKING_SUPPLIER     = 'packing supplier';
    public const LEGAL_CONSULTANT     = 'legal consultant';
    public const MARKETING_AGENCY     = 'marketing agency';
    public const CONSUMER = 'consumer';
    public const CARRIER = 'carrier';

    public const TYPES = [
        self::MANUFACTURER,
        self::DISTRIBUTOR,
        self::WHOLESALER,
        self::RETAILER,
        self::LABORATORY,
        self::INGREDIENTS_SUPPLIER,
        self::PACKING_SUPPLIER,
        self::LEGAL_CONSULTANT,
        self::MARKETING_AGENCY,
        self::CARRIER,
        self::CONSUMER,
    ];

    protected $fillable = ['name'];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
