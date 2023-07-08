<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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
        $cartItems = CartItem::all();
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
        Setting                  $setting,
        StripeClient             $stripeClient
    ): RedirectResponse
    {
        $fee       = $setting->transaction_fee;
        $cartItems = CartItem::all();

        if ($cartItems->count() === 0) {
            dd('cart empty');
        }

        $checkoutData = $checkoutService->prepareCheckoutData($cartItems, $fee);

        $response = $stripeClient->checkout
            ->sessions
            ->create(
                $checkoutData['data'],
                $checkoutData['stripe_account_ids']
            );

        return redirect($response->url);
    }
}
