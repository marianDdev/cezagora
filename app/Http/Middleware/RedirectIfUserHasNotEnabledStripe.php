<?php

namespace App\Http\Middleware;

use App\Traits\AuthUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUserHasNotEnabledStripe
{
    use AuthUser;
    /**
     * Handle an incoming request.
     *
     * @param Request                      $request
     * @param Closure(Request): (Response) $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->authUser()->stripe_account_enabled) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
