<?php

namespace App\Services\Pages;

use App\Services\Stripe\Account\StripeAccountServiceInterface;

interface PagesServiceInterface
{
    public function getDashboardData(StripeAccountServiceInterface $stripeAccountService): array;
    public function getProductAndServicesData(): array;
}
