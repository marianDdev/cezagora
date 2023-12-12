<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Qualification extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'company_id',
        'type',
        'name',
        'issuer',
        'certificate_number',
        'scope', //Details about what the credential covers or its scope (e.g., specific products, services, or processes).
        'url', //A path or URL to the digital copy of the credential document, if available.
        'verification_link',
        'additional_info',
        'issued_at',
        'expire_at',

    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
