<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Controller
{
    public function showLoginForm()
    {
        return view('login_form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ]);

        // detect email or mobile
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
                    ? 'email'
                    : 'mobile_number';

        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {

            $user = Auth::user();
            // store from/to in session if provided (so customer home can auto-fill)
            if ($request->filled('from_location')) {
                session()->flash('from_location', $request->input('from_location'));
            }
            if ($request->filled('to_location')) {
                session()->flash('to_location', $request->input('to_location'));
            }

            // Role based redirect
            if ($user->role?->role_name === 'Customer') {
                return redirect()->route('customer.home');
            }

            if ($user->role?->role_name === 'Driver') {
                return redirect()->route('driver.home');
            }

            Auth::logout();
            return back()->withErrors(['login' => 'Invalid role']);
        }

        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
