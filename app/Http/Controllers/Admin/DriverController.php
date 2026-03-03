<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;    
use App\Models\Drivers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    // Show all drivers
    public function index()
    {
        $drivers = Drivers::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    // Show create form
    public function create()
    {
        return view('admin.drivers.driver-form');
    }

    // Handle form submission (store new driver)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        // USER TABLE
            'first_name'     => 'required|string|max:255',
            'email'          => 'nullable|email|unique:users,email',
            'mobile_number'  => 'required|string|max:15|unique:users,mobile_number',
            'password'       => 'required|string|min:6',
        // DRIVER TABLE (all optional for submission)
            'age'            => 'nullable|integer|min:18',
            'driver_license_number' => 'nullable|string|max:50|unique:drivers,driver_license_number',
            'driver_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'         => 'nullable|boolean',
            'total_experience_years' => 'nullable|integer|min:0',
            'hill_experience'        => 'nullable|boolean',
            'accident_history'       => 'nullable|boolean',
            'luxury_car_experience'  => 'nullable|boolean',
            'address'                => 'nullable|string|max:500',
            'pincode'                => 'nullable|string|max:10',
        ]);

       if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();

    try {
        // ✅ 1. Create USER
        $user = User::create([
            'roles_id'       => 2, 
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'password'      => Hash::make($request->password),
        ]);

        // ✅ 2. Handle image upload
        $driverImagePath = null;
        if ($request->hasFile('driver_image')) {
            $driverImagePath = $request->file('driver_image')->store('drivers', 'public');
        }

        // ✅ 3. Create DRIVER (linked with user_id)
        Drivers::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'status' => $request->status,
            'driver_license_number' => $request->driver_license_number,
            'driver_image' => $driverImagePath,
            'total_experience_years' => $request->total_experience_years,
            'hill_experience' => $request->hill_experience,
            'accident_history' => $request->accident_history ?? 0,
            'luxury_car_experience' => $request->luxury_car_experience,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);

        DB::commit();

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Driver & User created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back() ->with('error', 'Something went wrong!')->withInput();
    }
}
    // Show edit form
    public function edit(Drivers $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    
    public function update(Request $request, Drivers $driver)
    {
        $request->validate([
           // USER TABLE
            'email'          => ['nullable','email', Rule::unique('users','email')->ignore($driver->user_id)],
            'mobile_number'  => ['required','string','max:15', Rule::unique('users','mobile_number')->ignore($driver->user_id)],
            'password'       => ['nullable','string','min:6'],
        // DRIVER TABLE (all optional for update)
            'first_name'     => 'required|string|max:255',
            'age'            => 'nullable|integer|min:18',
            'driver_license_number' => ['nullable','string','max:50', Rule::unique('drivers','driver_license_number')->ignore($driver->id)],
            'driver_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'         => 'nullable|boolean',
            'total_experience_years' => 'nullable|integer|min:0',
            'hill_experience'        => 'nullable|boolean',
            'accident_history'       => 'nullable|boolean',
            'luxury_car_experience'  => 'nullable|boolean',
            'address'                => 'nullable|string|max:500',
            'pincode'                => 'nullable|string|max:10',
        ]);

        DB::beginTransaction();

     try {
        // 1. Update USER
        $user = User::findOrFail($driver->user_id);
        $userData = [
            'roles_id' => 2,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
        ];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        // 2. Handle image upload (keep old if none uploaded)
        $driverImagePath = $driver->driver_image;
        if ($request->hasFile('driver_image')) {
            $driverImagePath = $request->file('driver_image')->store('drivers', 'public');
        }

        // 3. Update DRIVER (use the model instance)
        $driver->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'status' => $request->status,
            'driver_license_number' => $request->driver_license_number,
            'driver_image' => $driverImagePath,
            'total_experience_years' => $request->total_experience_years,
            'hill_experience' => $request->hill_experience,
            'accident_history' => $request->accident_history ?? 0,
            'luxury_car_experience' => $request->luxury_car_experience,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);

        DB::commit();

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Driver & User updated successfully!');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back() ->with('error', 'Something went wrong!')->withInput();
    }
    }

    // Delete driver
    public function destroy(Drivers $driver)
{
    DB::beginTransaction();

    try {

        // soft delete driver
        $driver->delete();

        // soft delete related user
        $driver->user->delete();

        DB::commit();

        return redirect()
            ->route('admin.drivers.index')
            ->with('success', 'Driver & User deleted successfully!');

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->with('error', $e->getMessage());
    }
}
        }