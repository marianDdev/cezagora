<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use App\Services\Carrier\CarrierServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Order\OrdersServiceInterface;
use App\Traits\AuthUser;
use Illuminate\View\View;

class CarrierController
{
    use AuthUser;
    public function showDummyCarrierData(CarrierServiceInterface $carrierService): View
    {
        $token = $carrierService->getAuthToken();
        $couriers = $carrierService->getCouriers();
        $services = $carrierService->getServices();
        $senderAddress = $carrierService->getSenderAddresses();
        $countries = $carrierService->getCountries();
        $country = $carrierService->getCountry(189);
        $counties = $carrierService->getCounties();
        $citiesByCounty = $carrierService->getCounties(29);

        $countryCodeMap = collect($countries)->keyBy('code');
        $userCountry = $countryCodeMap->get($this->authUserCompany()->address->country_code);

        $order = Order::find(32);
        $groupedItems = $order->items
            ->groupBy('seller_id')
            ->map(function ($items) {
                $totalWeightInGrams = $items->reduce(function ($carry, $item) {
                    $weightInGrams = in_array($item->unit, IngredientServiceInterface::VARIANT_UNITS_MACRO) ? $item->weight * 1000 : $item->weight;
                    return $carry + $weightInGrams;
                }, 0);

                return [
                    'total_weight_grams' => $totalWeightInGrams,
                    'items' => $items,
                    'seller' => $items->first()->seller
                ];
            });

        return view(
            'carriers_dummy_views.account',
            [
                'token' => $token['token'],
                'couriers' => $couriers,
                'services' => $services,
                'address' => $senderAddress,
                'countries' => $countries,
                'counties' => $counties,
                'userCountry' => $userCountry,
                'country' => $country,
                'cities' => $citiesByCounty,
                'groupedItems' => $groupedItems
            ]
        );
    }
}
