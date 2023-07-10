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
        $total = CartItem::sum('price');

        return view(
            'cart.show',
            [
                'items' => $cartItems,
                'total' => $total
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
        $fee       = (int)Setting::where('name', 'transaction_fee')->first()->value;
        $cartItems = CartItem::all();
        $accountId = $cartItems->first()->company->user->stripe_account_id;
        $checkoutData = $checkoutService->prepareCheckoutData($cartItems, $fee);

        $response = $stripeClient->checkout
            ->sessions
            ->create(
                $checkoutData,
                [
                    'stripe_account' => $accountId,
                    'api_key' => env('STRIPE_SECRET')
                ]
            );

        return redirect($response->url);
    }
}
