<?php

namespace App\Models\Pivots;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyCompanyCategory extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['company_id', 'category_id'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CompanyCategory::class, 'category_id', 'id');
    }
}
