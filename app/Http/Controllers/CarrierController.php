<?php

namespace App\Http\Controllers;

use App\Services\Carrier\CarrierServiceInterface;
use Illuminate\View\View;

class CarrierController
{
    public function showDummyCarrierData(CarrierServiceInterface $carrierService): View
    {
        $token = $carrierService->getAuthToken();
        $couriers = $carrierService->getCouriers();
        $services = $carrierService->getServices();
        $senderAddress = $carrierService->getSenderAddresses();
        $countries = $carrierService->getCountries();
        $counties = $carrierService->getCounties();

        return view(
            'carriers_dummy_views.account',
            [
                'token' => $token['token'],
                'couriers' => $couriers,
                'services' => $services,
                'address' => $senderAddress,
                'countries' => $countries,
                'counties' => $counties,
            ]
        );
    }
}
