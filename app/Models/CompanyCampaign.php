<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'campaign_id',
        'count', //current times a company benefited from the promotion
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
