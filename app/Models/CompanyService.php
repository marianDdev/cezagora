<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyService extends Pivot
{
    use HasFactory;

    protected $fillable = [
      'company_id',
      'service_id',
      'price',
    ];

    public $timestamps = false;

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function service(): HasOne
    {
        return $this->hasOne(Service::class);
    }
}
