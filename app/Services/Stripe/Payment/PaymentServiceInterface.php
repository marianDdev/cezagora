<?php

namespace App\Services\Stripe\Payment;

use App\Models\Order;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

interface PaymentServiceInterface
{
    public const PAYMENT_METHOD_CARD_VISA = 'pm_card_visa';

    /**
     * @throws ApiErrorException
     */
    public function createPaymentIntent(Order $order, string $paymentMethodId): PaymentIntent;

    /**
     * @throws ApiErrorException
     */
    public function getPaymentIntent(int $id): PaymentIntent;

    public function confirmPaymentIntent(string $intentId, string $paymentMethodId): void;

    public function executeTransfers(Order $order, Customer $stripeCustomer);
}
