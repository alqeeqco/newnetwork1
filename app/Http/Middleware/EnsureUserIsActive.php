<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {

        if (! $request->user() || ! $request->user()->isActive()) {
            return redirect()->route('login');
//            return error_response(Response::HTTP_UNAUTHORIZED, 'Current user has inactive account');
        }

        return $next($request);
    }
}
