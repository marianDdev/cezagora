<?php

namespace App\Services\Stripe\Account;

use App\Services\Stripe\StripeService;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeAccountService extends StripeService implements StripeAccountServiceInterface
{
    public function create(): Account
    {
        //
    }

    /**
     * @throws ApiErrorException
     */
    public function retrieve(string $id): Account
    {
        return $this->stripeClient->accounts->retrieve(
            $id
            []
        );
    }
}
