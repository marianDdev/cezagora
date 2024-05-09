<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\Pivots\CompanyCompanyCategory;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CompanyService implements CompanyServiceInterface
{
    use AuthUser;

    public function create(array $validated): Company
    {
        $validated['slug'] = Str::slug($validated['name']);
        $company           = Company::create($validated);

        if ($this->authUser()->hasRole(UserServiceInterface::ROLE_SELLER)) {
            $companyId     = $company->id;
            $categoriesIds = $validated['company_categories'];
            $categoryData  = [];

            foreach ($categoriesIds as $categoryId) {
                $categoryData[] = [
                    'company_id'          => $companyId,
                    'company_category_id' => $categoryId,
                ];
            }

            CompanyCompanyCategory::insert($categoryData);
        }


        return $company;
    }

    public function toggleActive(User $user, bool $activate): void
    {
        $company            = $user->company;
        $company->is_active = $activate;
        $company->save();
    }

    public function update(array $validated): void
    {
        /** @var Company $company */
        $company = Company::find($validated['company_id']);

        if (array_key_exists('mcc', $validated) && $validated['mcc'] === 'Select your merchant category code') {
            $validated['mcc'] = null;
        }

        if (array_key_exists('company_categories', $validated)) {
            $categoryIds = $validated['company_categories'];
            $company->categories()->sync($categoryIds);
        }

        $company->address->update($validated);
        $company->update($validated);
    }
}
