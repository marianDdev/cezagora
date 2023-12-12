<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'type',
        'name',
        'description',
        'price',
        'additional_info'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
