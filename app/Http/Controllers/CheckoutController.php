<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Company;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Services\Checkout\CheckoutServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    use AuthUser;

    public function show(): View
    {
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)->where('status', Order::STATUS_PENDING)->first();

        if (is_null($pendingOrder)) {
            abort(404, 'There is no pending order for you');
        }

        $orderItems = $pendingOrder->items;

        return view(
            'cart.show',
            [
                'order' => $pendingOrder,
                'items' => $orderItems,
            ]
        );
    }

    public function showSucess(): View
    {
        return view('checkout.success');
    }

    /**
     * @throws ApiErrorException
     */
    public function execute(
        CheckoutServiceInterface $checkoutService,
        StripeClient             $stripeClient
    ): RedirectResponse
    {
        $percentage   = (int) Setting::where('name', Setting::TRANSACTION_FEE_PERCENTAGE)->first()->value;
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)->where('status', Order::STATUS_PENDING)->first();
        $admin        = User::where('is_admin', true)->first();

        if (is_null($pendingOrder)) {
            abort(404, 'There is no pending order for you');
        }

        $orderItems   = $pendingOrder->items;
        $checkoutData = $checkoutService->prepareCheckoutData($orderItems, $pendingOrder->id, $percentage);

        $response = $stripeClient->checkout
            ->sessions
            ->create(
                $checkoutData,
                [
                    'stripe_account' => $admin->stripe_account_id,
                    'api_key'        => env('STRIPE_SECRET'),
                ]
            );

        return redirect($response->url);
    }

    public function collectPayment()
    {
        $percentage   = (int) Setting::where('name', Setting::TRANSACTION_FEE_PERCENTAGE)->first()->value;
        $stripe       = new StripeClient(config('stripe.secret'));
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)->where('status', Order::STATUS_PENDING)->first();

        /** @var Company $customer */
        $customer = $pendingOrder->customer;

        /** @var Address $address */
        $address = $customer->addresses->first();

        if (is_null($pendingOrder)) {
            abort(404, 'There is no pending order for you');
        }

        $orderItems = $pendingOrder->items;

        $intentResponse = $stripe->paymentIntents->create([
                                                              'amount'         => $pendingOrder->total_price,
                                                              'currency'       => 'ron',
                                                              'transfer_group' => $pendingOrder->id,
                                                          ]);

        $stripe->paymentIntents->confirm(
            $intentResponse->id,
            ['payment_method' => 'pm_card_visa']
        );

        $stripeCustomer = $stripe->customers->create([
                                                         'address' => [
                                                             'city'    => $address->city,
                                                             'country' => $address->country,
                                                         ],
                                                         'email'   => $customer->email,
                                                         'name'    => $customer->name,

                                                     ]);

        foreach ($orderItems as $item) {
            $amount = $item->price * $item->quantity;
            $stripe->transfers->create([
                                           'amount'         => $amount - ($amount * $percentage / 100),
                                           'amount'         => $amount,
                                           'currency'       => 'ron',
                                           'destination'    => $item->seller->user->stripe_account_id,
                                           'transfer_group' => $pendingOrder->id,
                                       ]);


            $stripe->invoices->create([
                                          'on_behalf_of'           => $item->seller->user->stripe_account_id,
                                          'application_fee_amount' => $amount * $percentage / 100,
                                          'transfer_data'          => ['destination' => $item->seller->user->stripe_account_id],
                                          'customer'               => $stripeCustomer->id,
                                      ]);
        }

        return redirect(route('checkout.success'));
    }
}
