<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Not logged in → redirect to admin login
    if (!Auth::check()) {
        session()->put('url.intended', $request->fullUrl());
        return redirect()->route('admin.login')->with('error','Please login to accesss Admin Portal');
    }

    // Logged in but role not Admin → forbid access
    if (!Auth::user()->role || !in_array(Auth::user()->role->role_name, ['Admin'])) {
        abort(403, 'Unauthorized action.');
    }

    // Logged in and Admin → allow request
    return $next($request);
}

}