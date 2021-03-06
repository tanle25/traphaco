<?php

namespace App\Http\Middleware;

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
        if (Auth::check() && Auth::user()->is_admin !== 1) {
            return redirect()->route('admin.home');
        }

        if (Auth::check() && Auth::user()->is_admin !== 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}