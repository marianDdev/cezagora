<?php

namespace App\Services\Stripe\Payment;

use App\Models\Order;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

interface PaymentServiceInterface
{
    /**
     * @throws ApiErrorException
     */
    public function createPaymentIntent(Order $order): PaymentIntent;

    /**
     * @throws ApiErrorException
     */
    public function getPaymentIntent(int $id): PaymentIntent;

    public function executeTransfers(Order $order, Customer $stripeCustomer);
}
