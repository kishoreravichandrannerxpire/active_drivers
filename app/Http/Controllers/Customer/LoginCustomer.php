<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginCustomer extends Controller
{
    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('customer.dashboard');
        }
        // Fetch customer from DB
        $customer = DB::table('users')->where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Store session
            session(['customer' => $customer->id]);
            return redirect()->route('customer.dashboard');
        }

        return back()->with(['error' => 'Invalid email or password'])->withInput();
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('customer.login');
    }
}
