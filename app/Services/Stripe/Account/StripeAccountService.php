<?php

namespace App\Services\Stripe\Account;

use App\Models\Company;
use App\Models\MerchantCategoryCode;
use App\Services\Stripe\StripeService;
use App\Traits\AuthUser;
use Illuminate\Support\Collection;
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
        $address = $company->address;
        $countryCode = $company->address->country_code;

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

    public function getShortMccList(): Collection
    {
        $allowedCodes = [5047, 5122, 5169, 59777, 5999, 7230, 7299, 5411, 5172, 5968, 5045, 7311, 7392, 8734];

        return MerchantCategoryCode::whereIn('code', $allowedCodes)->get();
    }
}

//Merchant Category Codes (MCCs) are used by credit card networks to categorize and manage transactions. Each business that accepts card payments is assigned an MCC that best describes the service or goods provided. Below are potential MCCs that might be relevant for your cosmetics manufacturing marketplace. These are general suggestions, as the actual codes can vary and new ones can be added over time:
//
//5047: Medical, Dental, Ophthalmic, and Hospital Equipment and Supplies — This could potentially include certain cosmetic laboratory equipment and supplies.
//5122: Drugs, Drug Proprietaries, and Druggist Sundries — This might include wholesale distributors of cosmetics.
//5999: Miscellaneous Specialty Retail — This broad category can encompass various types of retailers, possibly including cosmetic retailers.
//7230: Beauty and Barber Shops — While this is more service-oriented, some cosmetic retailers may fall under this category if they provide beauty services.
//7299: Miscellaneous Personal Services, Not Elsewhere Classified — This could include certain personal services related to cosmetics.
//Other categories not directly related to cosmetics but relevant to your marketplace could include:
//
//5411: Grocery Stores and Supermarkets — If you deal with retailers that sell cosmetics along with other products.
//5172: Petroleum and Petroleum Products — If your marketplace includes carriers or distributors that specialize in the transport of goods, they may fall under this category.
//5968: Direct Marketing - Continuity/Subscription Merchant — If there are businesses in your platform operating under a subscription model for cosmetic products.
//5045: Computers, Peripherals, and Software — For software companies or agencies that provide IT solutions for your marketplace.
//7311: Advertising Services — This would include marketing agencies that serve the cosmetic industry.
//7392: Management, Consulting, and Public Relations Services — For legal and consulting services related to the cosmetics industry.
