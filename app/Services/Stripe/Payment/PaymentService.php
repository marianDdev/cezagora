<?php

namespace App\Services\Stripe\Payment;

use App\Models\Campaign;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Services\Campaign\CampaignServiceInterface;
use App\Services\Stripe\StripeService;
use Carbon\Carbon;
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

    public function createPaymentIntent(Order $order, string $paymentMethodId): PaymentIntent
    {
        $paymentData = [
            'amount'         => $order->total_price,
            'currency'       => Setting::DEFAULT_CURRENCY_VALUE,
            'transfer_group' => $order->id,
        ];

        $paymentIntent = $this->stripeClient->paymentIntents->create($paymentData);

        $order->update(['payment_method' => $paymentMethodId]);

        return $paymentIntent;
    }

    public function confirmPaymentIntent(string $intentId, string $paymentMethodId): void
    {
        $this->stripeClient->paymentIntents->confirm(
            $intentId,
            ['payment_method' => $paymentMethodId]
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
            $amount         = $item->total;
            $sellerStripeId = $item->seller->user->stripe_account_id;
            $transferData   = $this->getTransferData($item->seller, $sellerStripeId, $order->id, $amount);

            $this->stripeClient->transfers->create($transferData);

            $this->createInvoice($item, $sellerStripeId, $stripeCustomer->id, $amount);

            $order->status = Order::STATUS_COMPLETED;
            $order->save();
        }
    }

    private function calculateAmount(Company $company, int $amount): int
    {
        $feeAmount = $this->calculateFee($company, $amount);

        return ($amount - $feeAmount);
    }

    /**
     * @throws ApiErrorException
     */
    private function createInvoice(
        OrderItem $item,
        string    $sellerStripeId,
        string    $stripeCustomerId,
        int       $amount
    ): void
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
                    'currency'    => Setting::DEFAULT_CURRENCY_VALUE,
                ]
            );

        $invoice = $this->stripeClient
            ->invoices
            ->create(
                [
                    'on_behalf_of'  => $sellerStripeId,
                    'transfer_data' => ['destination' => $sellerStripeId],
                    'customer'      => $stripeCustomerId,
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

    private function calculateFee(Company $company, int $amount): float|int
    {
        $companyCampaigns    = $company->campaigns;
        $signupBonusCampaign = Campaign::where('name', CampaignServiceInterface::SIGNUP_BONUS)->first();

        if ($companyCampaigns->count() > 0) {
            $signupBonusCampaignNotFinished = is_null($signupBonusCampaign->end_at) || $signupBonusCampaign->end_at->gt(Carbon::today());
            foreach ($companyCampaigns as $campaign) {

                $shouldUseSignupBonus = $signupBonusCampaign->id === $campaign->campaign_id &&
                                        $signupBonusCampaignNotFinished &&
                                        $signupBonusCampaign->limit > $campaign->count;

                if ($shouldUseSignupBonus) {
                    $campaign->update(['count' => $campaign->count + 1]);

                    return 0;
                }
            }
        }

        return $amount * $this->percentage / 100;
    }

    private function getTransferData(Company $company, string $sellerStripeId, int $orderId, int $amount): array
    {
        return [
            'amount'         => $this->calculateAmount($company, $amount),
            'currency'       => Setting::DEFAULT_CURRENCY_VALUE,
            'destination'    => $sellerStripeId,
            'transfer_group' => $orderId,
            'description'    => sprintf(
                'Transfer %d for order with id %d to %s that has account id: %s',
                $amount,
                $orderId,
                $company->name,
                $sellerStripeId
            ),
        ];
    }
}
