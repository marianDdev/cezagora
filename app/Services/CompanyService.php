<?php

namespace App\Services;

use App\Models\Company;

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
            ]
        );
    }
}
