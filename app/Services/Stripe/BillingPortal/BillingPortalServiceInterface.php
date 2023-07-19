<?php

namespace App\Services\Stripe\BillingPortal;

use App\Models\User;
use Stripe\BillingPortal\Configuration;
use Stripe\BillingPortal\Session;

interface BillingPortalServiceInterface
{
    public function createConfiguration(User $user): Configuration;

    public function createSession(User $user): Session;
}
