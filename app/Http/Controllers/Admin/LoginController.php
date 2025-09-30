<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
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
            return redirect()->route('admin.dashboard');
        }
        // Fetch admin from DB
        $admin = DB::table('users')->where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Store session
            session(['admin' => $admin->id]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['msg' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('admin.login');
    }
}
