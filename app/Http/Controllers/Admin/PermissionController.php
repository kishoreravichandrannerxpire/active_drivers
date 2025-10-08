<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permissions::all();
        return view('admin.permissions.index', compact('permissions')); 
    }
    public function create()
    {
        $roles = Role::all();
        $permissions = Permissions::all();
        return view('admin.permissions.permissions-form', compact('roles','permissions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'roles_id' => 'required|exists:roles,id',
            'permission' => 'required|boolean',
            'module' => 'required|string',
            'effect' => 'required|string',
        ]);

        Permissions::create([
            'roles_id' => $request->roles_id,
            'permission' => $request->permission,
            'module' => $request->module,
            'effect' => $request->effect,
        ]);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully!');
    }
    public function edit($id)
    {
        $permissions = Permissions::findorFail($id);
        $roles = Role::all();
        return view('admin.permissions.edit', compact('roles', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $permissions = Permissions::findorFail($id);

        $request->validate([
            'roles_id' => 'required|exists:roles,id',
            'permission' => 'required|boolean',
            'module' => 'required|string',
            'effect' => 'required|string',
        ]);

        $permissions->roles_id = $request->roles_id;
        $permissions->permission = $request->permission;
        $permissions->module = $request->module;
        $permissions->effect = $request->effect;

        $permissions->save();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully');
    }
    public function destroy($id)
    {
        $permissions = Permissions::findorFail($id);
        $permissions->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully');
    }
}
