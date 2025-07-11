<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\Stripe\BillingPortal\BillingPortalServiceInterface;
use App\Services\Stripe\Customer\CustomerServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StripePortalController extends Controller
{
    use AuthUser;

    public function createSession(
        BillingPortalServiceInterface $billingPortalService,
        CustomerServiceInterface      $customerService
    ): RedirectResponse|View
    {
        try {
            $user       = $this->authUser();
            $customerId = $user->stripe_customer_id;

            if (is_null($customerId)) {
                $customer   = $customerService->createCustomer($user);
                $customerId = $customer->id;
                $user->update(['stripe_customer_id' => $customerId]);
            }

            $billingPortalService->createConfiguration($user);
            $session = $billingPortalService->createSession($user);

            return redirect($session->url);
        } catch (Exception $e) {
            return view(
                'portal.error',
                [
                    'error' => $e->getMessage(),
                ]
            );
        }

    }
}
