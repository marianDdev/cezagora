<?php

namespace App\Services\Delivery;

use App\Models\Company;

interface DeliveryServiceInterface
{
    public function getQuotes(Company $sender, Company $receiver, array $data): array;
}
