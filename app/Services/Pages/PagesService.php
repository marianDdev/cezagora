<?php

namespace App\Services\Pages;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Traits\AuthUser;

class PagesService implements PagesServiceInterface
{
    use AuthUser;

    public function getDashboardData(StripeAccountServiceInterface $stripeAccountService): array
    {
        $user    = $this->authUser();
        $company = $this->authUserCompany();

        $companyBusinessMap     = $this->getBusinessMap();
        $companyBusinesstextMap = $this->getBusinessTitleMap();

        $productsTitle = '';
        $items         = null;

        if ($company && $company->categories) {
            $categoriesNames = [];
            $itemsText       = [];
            foreach ($company->categories as $category) {
                $categoriesNames[] = $companyBusinesstextMap[$category->name];
                $itemsText[]       = $companyBusinessMap[$category->name];
            }

            $productsTitle = implode(',', $categoriesNames);
            $items         = implode(',', $itemsText);
        }

        return [
            'account' => $user->stripe_account_id ? $stripeAccountService->retrieve($this->authUser()->stripe_account_id) : null,
            'user'    => $user,
            'company' => $company ?? null,
            'productsTitle'   => $productsTitle,
            'items'   => $items,
        ];
    }

    private function getBusinessMap(): array
    {
        return [
            CompanyCategory::MANUFACTURER         => $company->products ?? null,
            CompanyCategory::RETAILER             => $company->products ?? null,
            CompanyCategory::INGREDIENTS_SUPPLIER => $company->ingredients ?? null,
        ];
    }

    private function getBusinessTitleMap(): array
    {
        return [
            CompanyCategory::MANUFACTURER         => 'Products',
            CompanyCategory::RETAILER             => 'Products',
            CompanyCategory::INGREDIENTS_SUPPLIER => 'Ingredients',
        ];
    }
}
