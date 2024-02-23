<?php

namespace App\Services\Delivery;

use App\Models\Company;
use Illuminate\Support\Facades\Http;

class DeliveryService implements DeliveryServiceInterface
{

    public function getQuotes(Company $sender, Company $receiver, array $data): array
    {
        $data = [
            "shipment"      => [
                "pickupAddress"   => [
                    "country" => $sender->address->country_code,
                    "zip"     => $sender->address->zipcode,
                    "city"    => $sender->address->city,
                    "street"  => $sender->address->street,
                ],
                "deliveryAddress" => [
                    "country" => $receiver->address->country_code,
                    "zip"     => $receiver->address->zipcode,
                    "city"    => $receiver->address->city,
                    "street"  => $receiver->address->street,
                ],
            ],
            "parcels"       => [
                "packages" => [
                    [
                        "parcelId" => $data['parcel_id'],
                        "quantity" => 1,
                        "width"    => 15,
                        "height"   => 11,
                        "length"   => 1,
                        "weight"   => $data['total_weight'],
                        "value"    => $data['total_price'],
                    ],
                ],
            ],
            "paymentMethod" => "credit",
            "currencyCode"  => "EUR",
            "serviceType"   => "selection",
        ];

        $response = Http::withHeaders(['x-api-key' => config('eurosender.api_key')])
                        ->post(sprintf('%s/quotes', config('eurosender.base_url')), $data);


        return $response->json();
    }
}
