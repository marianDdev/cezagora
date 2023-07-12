<?php

namespace App\Http\Controllers;

use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeOnboardingController extends Controller
{
    use AuthUser;

    public function index(): View
    {
        return view('stripe.onboarding');
    }

    public function redirect(StripeClient $stripeClient): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = $this->authUser();

        $response = $stripeClient->accountLinks->create(
            [
                'account' => $user->stripe_account_id,
                'type' => 'account_onboarding',
                'refresh_url' => route('onboarding.redirect'),
                'return_url' => route('onboarding.verify'),
            ],
            [
                'api_key' => config('stripe.secret'),
            ]
        );

        return redirect($response->url);
    }

    /**
     * @throws ApiErrorException
     */
    public function verify(StripeClient $stripeClient): RedirectResponse
    {
        $user = $this->authUser();

        $response = $stripeClient->accounts->retrieve(
            $user->stripe_account_id,
            [],
            [
                'api_key' => config('stripe.secret')
            ]
        );

        $user->update([
                          'stripe_account_enabled' => $response->payouts_enabled,
                      ]);

        return redirect()->route('dashboard');
    }
}
