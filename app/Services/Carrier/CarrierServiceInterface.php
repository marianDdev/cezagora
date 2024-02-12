<?php

namespace App\Services\Carrier;

interface CarrierServiceInterface
{
    public function getAuthToken(): array;

    public function  getCouriers(): array;

    public function  getServices(): array;

    public function  getSenderAddresses(): array;

    public function  getCountries(): array;

    public function getCounties(): array;
}
