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

            // Role based redirect
            if ($user->role?->role_name === 'Customer') {
                return redirect()->route('customer.home')
                ->withInput($request->only(['from_location', 'to_location','from_datetime','to_datetime']));
            }

            if ($user->role?->role_name === 'Driver') {
                return redirect()->intended('driver/home');
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
