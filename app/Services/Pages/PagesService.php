<?php

namespace App\Services\Pages;

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
        $companyBusinessTextMap = $this->getBusinessTitleMap();

        $productsTitle = '';
        $items         = null;

        $categoriesIds = [];

        if ($company && $company->categories) {
            $categoriesNames = [];
            $itemsText       = [];
            foreach ($company->categories as $category) {
                $categoriesNames[] = $companyBusinessTextMap[$category->name];
                $itemsText[]       = $companyBusinessMap[$category->name];
            }

            $productsTitle = implode(',', $categoriesNames);
            $items         = implode(',', $itemsText);
            $categoriesIds = $company->categories->pluck('id')->toArray();
        }

        return [
            'account'            => $user->stripe_account_id ? $stripeAccountService->retrieve($this->authUser()->stripe_account_id) : null,
            'user'               => $user,
            'company'            => $company ?? null,
            'productsTitle'      => $productsTitle,
            'items'              => $items,
            'categories'         => CompanyCategory::all(),
            'mccs'               => $stripeAccountService->getShortMccList(),
            'companyCategoryIds' => $categoriesIds,
        ];
    }

    public function getProductAndServicesData(): array
    {
        $user = $this->authUser();

        return [
            'user'             => $user,
            'ingredientsCount' => $user->company ? $user->company->ingredients->count() : 0,
            'productsCount'    => $user->company ? $user->company->products->count() : 0,
            'packagingCount'   => $user->company ? $user->company->packagings->count() : 0,
            'servicesCount'    => $user->company ? $user->company->services->count() : 0,
        ];
    }


    private function getBusinessMap(): array
    {
        return [
            CompanyCategory::CARRIER              => $company->services ?? null,
            CompanyCategory::CONSUMER             => null,
            CompanyCategory::DISTRIBUTOR          => $company->services ?? null,
            CompanyCategory::INGREDIENTS_SUPPLIER => $company->ingredients ?? null,
            CompanyCategory::LABORATORY           => $company->services ?? null,
            CompanyCategory::LEGAL_CONSULTANT     => $company->services ?? null,
            CompanyCategory::MANUFACTURER         => $company->products ?? null,
            CompanyCategory::MARKETING_AGENCY     => $company->services ?? null,
            CompanyCategory::PACKAGING_SUPPLIER   => $company->products ?? null,
            CompanyCategory::RETAILER             => $company->products ?? null,
            CompanyCategory::WHOLESALER           => $company->products ?? null,
        ];
    }

    private function getBusinessTitleMap(): array
    {
        return [
            CompanyCategory::CARRIER              => 'Services',
            CompanyCategory::CONSUMER             => '',
            CompanyCategory::DISTRIBUTOR          => 'Services',
            CompanyCategory::INGREDIENTS_SUPPLIER => 'Ingredients',
            CompanyCategory::LABORATORY           => 'Services',
            CompanyCategory::LEGAL_CONSULTANT     => 'Services',
            CompanyCategory::MANUFACTURER         => 'Products',
            CompanyCategory::MARKETING_AGENCY     => 'Services',
            CompanyCategory::PACKAGING_SUPPLIER   => 'Products',
            CompanyCategory::RETAILER             => 'Products',
            CompanyCategory::WHOLESALER           => 'Products',
        ];
    }
}
