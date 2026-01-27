<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in → redirect to driver login
        if (!Auth::check()) {
            return redirect()->route('driver.login')->with('error', 'Please login to access Driver Portal');
        }

        // Logged in but role not Driver → forbid access
        if (!Auth::user()->role || Auth::user()->role->role_name !== 'Driver') {
            abort(403, 'Unauthorized action.');
        }

        // Logged in and Driver → allow request
        return $next($request);
    }
}
