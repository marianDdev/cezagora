<?php

namespace App\Services\Stripe\Payment;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Services\Stripe\StripeService;
use Exception;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

class PaymentService extends StripeService implements PaymentServiceInterface
{
    private int $percentage;

    public function __construct()
    {
        parent::__construct();

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
                    'currency'       => self::CURRENCY_RON,
                    'transfer_group' => $order->id,
                ]
            );

        return $this->stripeClient->paymentIntents->confirm(
            $paymentIntent->id,
            ['payment_method' => self::PAYMENT_METHOD_CARD_VISA]
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
     * @throws Exception
     */
    public function executeTransfers(Order $order, Customer $stripeCustomer): void
    {
        if ($order->status !== Order::STATUS_PAYMENT_COLLECTED) {
            throw new Exception('customer was not charged for this order.');
        }

        $orderItems = $order->items;

        /** @var OrderItem $item */
        foreach ($orderItems as $item) {
            $amount         = $item->price * $item->quantity;
            $sellerStripeId = $item->seller->user->stripe_account_id;

            $this->stripeClient
                ->transfers
                ->create(
                    [
                        'amount'         => $this->calculateAmount($amount),
                        'currency'       => 'ron',
                        'destination'    => $sellerStripeId,
                        'transfer_group' => $order->id,
                    ]
                );

            $this->createInvoice(
                $item,
                $sellerStripeId,
                $stripeCustomer->id,
                $amount
            );

            $order->status = Order::STATUS_COMPLETED;
            $order->save();
        }
    }

    private function calculateAmount(int $amount): int
    {
        $feeAmount = $amount * $this->percentage / 100;

        return $amount - $feeAmount;
    }

    /**
     * @throws ApiErrorException
     */
    private function createInvoice(
        OrderItem $item,
        string $sellerStripeId,
        string $stripeCustomerId,
        int $amount): void
    {
        $product = $this->stripeClient
            ->products
            ->create(
            [
                'name' => $item->name,
            ]
        );

        $price = $this->stripeClient
            ->prices
            ->create(
            [
                'product'     => $product->id,
                'unit_amount' => $item->price,
                'currency'    => 'ron',
            ]
        );

        $invoice = $this->stripeClient
            ->invoices
            ->create(
                [
                    'on_behalf_of'           => $sellerStripeId,
                    'transfer_data'          => ['destination' => $sellerStripeId],
                    'customer'               => $stripeCustomerId,
                ]
            );

        $this->stripeClient
            ->invoiceItems
            ->create(
                [
                    'customer' => $stripeCustomerId,
                    'price'    => $price->id,
                    'invoice'  => $invoice->id,
                    ]
            );

        $this->stripeClient
            ->invoices
            ->finalizeInvoice($invoice->id, []);
    }
}
