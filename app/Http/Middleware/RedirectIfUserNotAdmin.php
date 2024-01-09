<?php

namespace App\Http\Middleware;

use App\Traits\AuthUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUserNotAdmin
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
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        if (!$this->authUser()->isAdmin()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
