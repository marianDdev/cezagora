<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanyService implements CompanyServiceInterface
{
    public function create(array $validated): Company
    {
        $website = $validated['website'];
        if (!str_starts_with($website, 'http')) {
            $website = sprintf('https://%s', $website);
        }
        return Company::create(
            [
                'company_category_id' => (int)$validated['company_category_id'],
                'name'                => $validated['name'],
                'email'               => $validated['email'],
                'phone'               => $validated['phone'],
                'slug' => Str::slug($validated['name']),
                'product_description' => $validated['product_description'],
                'website' => $website,
                'tax_id' => $validated['tax_id'],
                'vat_id' => $validated['vat_id'],
                'mcc' => $validated['mcc'],
            ]
        );
    }
}
