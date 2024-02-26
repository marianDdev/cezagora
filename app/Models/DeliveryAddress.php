<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'country_code', //string
        'zipcode', //string
        'city', //string
        'cityId', //int
        'street', //string
        'additionalInfo', //nullable
        'region', //judet
        'regionCode', //nullable
        'regionId', //int
        'timezone', //string
        'customFields', //array, can be empty
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
