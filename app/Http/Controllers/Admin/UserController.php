<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Customers;
use App\Models\Drivers;
use App\Models\Bookings;
use App\Models\UserHistory;
use App\Models\CustomerHistory;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('admin.user.index', compact('users'));
    }
    public function create() 
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.user.form', compact('roles','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roles_id' => 'required|exists:roles,id',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'mobile_number' => 'required|string|size:10|unique:users,mobile_number',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'roles_id' => $request->roles_id,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => bcrypt($request->password),
        ]);

        // Login the user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role_id
        if($request->roles_id == 3){
            // Persist booking from/to if provided (guest -> signup)
            return redirect()->route('customer.home')
                ->withInput($request->only(['from_location', 'to_location','from_datetime','to_datetime']));
        }
        if($request->roles_id == 2){
            return redirect()->intended('driver/home');
        } 
        else {
            return redirect()->route('admin.user.index')->with('success', 'User created successfully!');
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // get all roles for dropdown
        return view('admin.user.edit', compact('user', 'roles'));
    }   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'roles_id' => 'required|exists:roles,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile_number' => 'required|string|size:10|unique:users,mobile_number,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->roles_id = $request->roles_id;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
{
    DB::transaction(function () use ($id) {

        $user = User::findOrFail($id);

        // get related customer
        $customer = $user->customer;   // relationship method in User model

        // get related driver
        $driver = Drivers::where('user_id', $id)->first();

        // delete child records first
        if ($customer) {
            $customer->delete();
        }

        if ($driver) {
            $driver->delete();
        }

        // then delete parent
        $user->delete();
    });

    return redirect()->route('admin.user.index')
        ->with('success', 'User deleted successfully!');
}

}
