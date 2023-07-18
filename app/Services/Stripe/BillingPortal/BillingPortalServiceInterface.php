<?php

namespace App\Services\Stripe\BillingPortal;

use App\Models\User;
use Stripe\BillingPortal\Session;

interface BillingPortalServiceInterface
{
    public function createSession(User $user): Session;
}
