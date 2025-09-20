<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function showform()
    {
        $roles = Role::all(); // get all roles for dropdown
        return view('admin.user.form', compact('roles'));
    }

    public function submitform(Request $request)
    {
        $request->validate([
            'roles_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Create the user (hash password)
        User::create([
            'roles_id' => $request->roles_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }
}
