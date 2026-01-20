<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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
            'mobile_number' => 'required|string|max:10|unique:users,mobile_number',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'roles_id' => $request->roles_id,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully!');
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
            'moblie_number' => 'required|string|max:10|unique:users,moblie_number,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->roles_id = $request->roles_id;
        $user->email = $request->email;
        $user->moblie_number = $request->moblie_number;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
    }
}
