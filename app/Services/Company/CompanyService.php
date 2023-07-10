<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanyService implements CompanyServiceInterface
{
    public function create(array $validated): Company
    {
        return Company::create(
            [
                'company_category_id' => (int)$validated['company_category_id'],
                'name'                => $validated['name'],
                'email'               => $validated['email'],
                'phone'               => $validated['phone'],
                'slug' => Str::slug($validated['name'])
            ]
        );
    }
}
