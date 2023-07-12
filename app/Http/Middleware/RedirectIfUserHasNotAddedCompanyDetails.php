<?php

namespace App\Http\Middleware;

use App\Traits\AuthUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUserHasNotAddedCompanyDetails
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
        if (is_null($this->authUserCompany()) || !$this->authUserCompany()->has_details_completed) {
            return redirect()->route('companies.create');
        }

        return $next($request);
    }
}
