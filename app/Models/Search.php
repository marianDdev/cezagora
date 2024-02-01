<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'keyword',
        'count'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
