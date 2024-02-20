<?php

namespace App\Services\Carrier;

use App\Models\Company;

/**
 *@deprecated  replaced with DeliveryServiceInterface
 */
interface CarrierServiceInterface
{
    public function getAuthToken(): array;

    public function  getCouriers(): array;

    public function  getServices(): array;

    public function  getSenderAddresses(): array;

    public function  getCountries(): array;
    public function  getCountry(int $id): array;

    public function getCounties(): array;

    public function getCityByName(string $name);

    public function getOrderPrices( Company $sender, Company $receiver, int $receiverAddressId, int $weight): array;

    public function createAndGetAddressId(Company $company): int;
}
