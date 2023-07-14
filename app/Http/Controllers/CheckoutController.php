<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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
        $pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)
                             ->where('status', Order::STATUS_PENDING)
                             ->first();

        return view(
            'cart.show',
            [
                'order' => $pendingOrder,
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
    public function createCheckoutSession(
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
}

