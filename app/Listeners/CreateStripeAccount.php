<?php

namespace App\Listeners;

use App\Models\Company;
use App\Services\Stripe\Account\StripeAccountServiceInterface;

class CreateStripeAccount
{
    private StripeAccountServiceInterface $stripeAccountService;

    /**
     * Create the event listener.
     */
    public function __construct(StripeAccountServiceInterface $stripeAccountService)
    {
        $this->stripeAccountService = $stripeAccountService;
    }

    public function handle(object $event): void
    {
        /** @var Company $company */
        $company = $event->company;
        $account = $this->stripeAccountService->create($company);
        $company->user->update(
            [
                'stripe_account_id' => $account->id,
                //'stripe_account_enabled' => true,
            ]
        );
    }
}
