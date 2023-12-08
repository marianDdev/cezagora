<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'testing_capabilities',
        'specializations',
        'accreditations',
        'certifications',
        'equipment',
        'operating_hours',
        'price',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
