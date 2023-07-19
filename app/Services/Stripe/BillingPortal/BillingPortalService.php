<?php

namespace App\Services\Stripe\BillingPortal;

use App\Models\User;
use App\Services\Stripe\StripeService;
use Stripe\BillingPortal\Configuration;
use Stripe\BillingPortal\Session;
use Stripe\Exception\ApiErrorException;

class BillingPortalService extends StripeService implements BillingPortalServiceInterface
{
    public function createConfiguration(User $user): Configuration
    {
        return $this->stripeClient->billingPortal->configurations->create(
            [
                'business_profile' => [
                    'headline' => 'Cactus Practice partners with Stripe for simplified billing.',
                    'privacy_policy_url' => 'https://www.example.com',
                    'terms_of_service_url' => 'https://www.example.com',
                ],
                'features' => [
                    'invoice_history' => [
                        'enabled' => true
                    ],
                    'customer_update' => [
                        'enabled' => true,
                        'allowed_updates' => ['name', 'email', 'address', 'shipping', 'phone', 'tax_id']
                    ],
                    'payment_method_update' => [
                        'enabled' => true,
                    ],
                    'subscription_cancel' => [
                        'enabled' => false,
                    ],
                    'subscription_pause' => [
                        'enabled' => false,
                    ],
                ],
                'default_return_url' => 'https://www.cezagora.com',
                'login_page' => [
                    'enabled' => true
                ]
            ],
            [
                'stripe_account' => $user->stripe_account_id
            ]
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function createSession(User $user): Session
    {
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
