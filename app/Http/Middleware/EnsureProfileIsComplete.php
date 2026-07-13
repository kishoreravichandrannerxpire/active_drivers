<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user->isProfileComplete()) {
            if ($user->role && $user->role->role_name === 'Customer') {
                return redirect()->route('customer.profile.completion');
            }

            if ($user->role && $user->role->role_name === 'Driver') {
                return redirect()->route('driver.availability.form');
            }
        }

        return $next($request);
    }
}
