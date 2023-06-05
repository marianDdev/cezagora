<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'continent',
        'country',
        'state',
        'city',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
