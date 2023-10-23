<?php

namespace App\Services\Stripe\Payment;

use App\Models\Order;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

interface PaymentServiceInterface
{
    public const CURRENCY_RON = 'ron';
    public const PAYMENT_METHOD_CARD_VISA = 'pm_card_visa';

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
