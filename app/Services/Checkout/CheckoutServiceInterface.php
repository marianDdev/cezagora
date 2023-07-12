<?php

namespace App\Services\Checkout;

use Illuminate\Support\Collection;

interface CheckoutServiceInterface
{
    public const PAYMENT_MODE = 'payment';

    public function prepareCheckoutData(Collection $cartItems, int $orderId, ?int $feePercentage = 0): array;
}
