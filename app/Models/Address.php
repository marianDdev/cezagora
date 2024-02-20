<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $city
 * @property string $country
 * @property string $state
 * @property string $country_code
 * @property string $zipcode
 * @property string  $street
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'country',
        'country_code',
        'state',
        'city',
        'continent',
        'region',
        'street',
        'zipcode',
        'building',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
