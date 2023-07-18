<?php

namespace App\Services\Stripe\BillingPortal;

use App\Models\User;
use App\Services\Stripe\StripeService;
use Stripe\BillingPortal\Session;

class BillingPortalService extends StripeService implements BillingPortalServiceInterface
{
    public function createSession(User $user): Session
    {
        $this->stripeClient->billingPortal->configurations->create(
            [
                                                           'business_profile' => [
                                                               'headline' => 'Cactus Practice partners with Stripe for simplified billing.',
                                                           ],
                                                           'features' => ['invoice_history' => ['enabled' => true]],
                                                       ],
            [
                'stripe_account' => $user->stripe_account_id
            ]
        );

        return $this->stripeClient->billingPortal->sessions->create(
            [
                'customer' => $user->stripe_customer_id,
                'return_url' => route('onboarding.verify'),
            ],
            [
                'stripe_account' => $user->stripe_account_id
            ]
        );
    }
}
