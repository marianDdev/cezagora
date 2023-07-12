<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Setting;
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
        $percentage = (int)Setting::where('name', 'transaction_fee')->first()->value;
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)->where('status', Order::STATUS_PENDING)->first();

        if (is_null($pendingOrder)) {
            abort(404, 'There is no pending order for you');
        }

        $orderItems = $pendingOrder->items;
        $checkoutData = $checkoutService->prepareCheckoutData($orderItems, $percentage);

        $response = $stripeClient->checkout
            ->sessions
            ->create(
                $checkoutData,
                [
                    'stripe_account' => $pendingOrder->seller->user->stripe_account_id,
                    'api_key' => env('STRIPE_SECRET')
                ]
            );

        return redirect($response->url);
    }

    public function trasnfers()
    {
        $stripe = new StripeClient(config('stripe.secret'));
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)->where('status', Order::STATUS_PENDING)->first();

        if (is_null($pendingOrder)) {
            abort(404, 'There is no pending order for you');
        }

        $orderItems = $pendingOrder->items;

        $stripe->paymentIntents->create([
                                            'amount' => $pendingOrder->total_price * 100,
                                            'currency' => 'ron',
                                            'transfer_group' => $pendingOrder->id,
                                        ]);

        $percentage = (int)Setting::where('name', Setting::TRANSACTION_FEE_PERCENTAGE)->first()->value;
        foreach ($orderItems as $item) {
            $amount = $item->price * $item->quantity * 100;
            $stripe->transfers->create([
                                           'amount' => $amount-($amount * $percentage / 100),
                                           'currency' => 'ron',
                                           'destination' => $item->seller->user->stripe_account_id,
                                           'transfer_group' => $pendingOrder->id,
                                       ]);
        }
    }
}
