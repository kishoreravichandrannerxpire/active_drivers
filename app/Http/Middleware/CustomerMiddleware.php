<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in → redirect to customer login
        if (!Auth::check()) {
            session()->put('url.intended', $request->fullUrl());
            return redirect()->route('customer.login')->with('error', 'Please login to access Customer Portal');
        }

        // Logged in but role not Customer or Admin → forbid access
        if (!Auth::user()->role || !in_array(Auth::user()->role->role_name, ['Customer', 'Admin'])) {
            abort(403, 'Unauthorized action.');
        }

        // Logged in and Customer → allow request
        return $next($request);
    }
}
