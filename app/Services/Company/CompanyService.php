<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\CompanyCategoryCompany;
use App\Models\CompanyCompanyCategory;
use Illuminate\Support\Str;

class CompanyService implements CompanyServiceInterface
{
    public function create(array $validated): Company
    {
        $categoriesIds = $validated['company_categories'];
        $categoryData = [];


        $company = Company::create(
            [
                'name'                => $validated['name'],
                'email'               => $validated['email'],
                'phone'               => $validated['phone'],
                'slug' => Str::slug($validated['name']),
                'product_description' => $validated['product_description'],
                'website' => $validated['website'],
                'tax_id' => $validated['tax_id'],
                'vat_id' => $validated['vat_id'],
                'mcc' => $validated['mcc'],
            ]
        );

        $companyId = $company->id;

        foreach ($categoriesIds as $categoryId) {
            $categoryData[] = [
                'company_id' => $companyId,
                'company_category_id' => $categoryId,
            ];
        }

        CompanyCompanyCategory::insert($categoryData);

        return $company;
    }
}
