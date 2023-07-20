<?php

namespace App\Services\Stripe\Account;

use App\Models\Company;
use App\Services\Stripe\StripeService;
use App\Traits\AuthUser;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;

class StripeAccountService extends StripeService implements StripeAccountServiceInterface
{
    use AuthUser;

    /**
     * @throws ApiErrorException
     */
    public function create(Company $company): Account
    {
        $address = $company->addresses->first();
        $countryCode = $company->addresses->first()->country_code;

        return $this->stripeClient
            ->accounts
            ->create([
                         'type'             => 'standard',
                         'country'          => $countryCode,
                         'email'            => $company->email,
                         "business_type"    => "company",
                         'business_profile' => [
                             //'mcc'                 => $company->mcc,
                             'name'                => $company->name,
                             'product_description' => $company->product_description,
                             'support_email'       => $company->email,
                             'support_phone'       => $company->phone,
                             'url'                 => $company->website,
                         ],
                         'company'          => [
                             'address' => [
                                 'city'    => $address->city,
                                 'country' => $countryCode,
                                 'state'   => $address->state,
                             ],
                             'tax_id'  => $company->tax_id,
                             'vat_id'  => $company->vat_id,
                         ],
                     ]);
    }

    /**
     * @throws ApiErrorException
     */
    public function retrieve(string $id): Account
    {
        return $this->stripeClient->accounts->retrieve(
            $id,
            []
        );
    }
}
