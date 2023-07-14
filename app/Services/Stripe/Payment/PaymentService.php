<?php

namespace App\Services\Stripe\Payment;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class PaymentService implements PaymentServiceInterface
{
    private StripeClient $stripeClient;
    private int $percentage;

    public function __construct()
    {
        $this->stripeClient = new StripeClient(config('stripe.secret'));
        $this->percentage = (int) Setting::where('name', Setting::TRANSACTION_FEE_PERCENTAGE)->first()->value;
    }

    /**
     * @throws ApiErrorException
     */
    public function createPaymentIntent(Order $order): PaymentIntent
    {
        $paymentIntent = $this->stripeClient
            ->paymentIntents
            ->create(
                [
                    'amount'         => $order->total_price,
                    'currency'       => 'ron',
                    'transfer_group' => $order->id,
                ]
            );

        return $this->stripeClient->paymentIntents->confirm(
            $paymentIntent->id,
            ['payment_method' => 'pm_card_visa']
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function getPaymentIntent(int $id): PaymentIntent
    {
        return $this->stripeClient->paymentIntents->retrieve($id);
    }

    /**
     * @throws ApiErrorException
     */
    public function executeTransfers(Order $order, Customer $stripeCustomer)
    {
        $orderItems = $order->items;

        /** @var OrderItem $item */
        foreach ($orderItems as $item) {
            $amount         = $item->price * $item->quantity;
            $sellerStripeId = $item->seller->user->stripe_account_id;

            $this->stripeClient
                ->transfers
                ->create(
                    [
                        'amount'         => $this->applyFee($amount),
                        'amount'         => $amount,
                        'currency'       => 'ron',
                        'destination'    => $sellerStripeId,
                        'transfer_group' => $order->id,
                    ]
                );

            $this->createInvoice($sellerStripeId, $stripeCustomer->id, $amount);

        }
    }

    public function applyFee(int $amount): int
    {
        $feeAmount = $this->getFeeAmount($amount);

        return $amount - $feeAmount;
    }

    public function getFeeAmount(int $amount): int
    {
        return $amount * $this->percentage / 100;
    }

    /**
     * @throws ApiErrorException
     */
    private function createInvoice(string $sellerStripeId, string $stripeCustomerId, int $amount)
    {
        $this->stripeClient
            ->invoices
            ->create(
                [
                    'on_behalf_of'           => $sellerStripeId,
                    'application_fee_amount' => $this->getFeeAmount($amount),
                    'transfer_data'          => ['destination' => $sellerStripeId],
                    'customer'               => $stripeCustomerId,
                ]
            );
    }
}
