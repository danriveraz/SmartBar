<?php

namespace PocketByR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $userActual = Auth::user();
            if ($userActual->esAdmin) {
                return redirect('/WelcomeAdmin');
            }else{
                return redirect('/WelcomeTrabajador');
            }
        }

        return $next($request);
    }
}
