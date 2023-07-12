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
        $percentage = (int)Setting::where('name', 'transaction_fee')->first()->value;
        $cartItems = CartItem::all();
        $checkoutData = $checkoutService->prepareCheckoutData($cartItems, $percentage);

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

    public function trasnfers()
    {
        $stripe = new StripeClient(config('stripe.secret'));
        $cartItems = CartItem::all();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        $stripe->paymentIntents->create([
                                            'amount' => $total,
                                            'currency' => 'usd',
                                            'transfer_group' => 'ORDER10',
                                        ]);

        $percentage = (int)Setting::where('name', 'transaction_fee')->first()->value;
        foreach ($cartItems as $item) {
            $amount = $item->price * $item->quantity;
            $stripe->transfers->create([
                                           'amount' => $amount-($amount * $percentage / 100),
                                           'currency' => 'usd',
                                           'destination' => $item->company->user->stripe_account_id,
                                           'transfer_group' => 'ORDER10',
                                       ]);
        }
    }
}
