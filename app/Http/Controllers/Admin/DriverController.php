<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;    
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'name'           => 'required|string|max:255',
            'age'            => 'required|integer|min:18',
            'mobile_number'  => 'required|string|max:20|unique:drivers,mobile_number',
            'password'       => 'required|string|min:6',
            'driver_license_number' => 'required|string|max:50|unique:drivers,driver_license_number',
            'driver_image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total_experience_years' => 'required|integer|min:0',
            'hill_experience'        => 'required|boolean',
            'accident_history'       => 'boolean',
            'luxury_car_experience'  => 'required|boolean',
            'address'                => 'required|string|max:500',
            'pincode'                => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('driver_image')) {
            $data['driver_image'] = $request->file('driver_image')->store('drivers', 'public');
        }

        Drivers::create($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully!');
    }

    // Show edit form
    public function edit(Drivers $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    // Handle update
    public function update(Request $request, Drivers $driver)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'age'            => 'required|integer|min:18',
            'mobile_number'  => 'required|string|max:20|unique:drivers,mobile_number,' . $driver->id,
            'password'       => 'nullable|string|min:6',
            'driver_license_number' => 'required|string|max:50|unique:drivers,driver_license_number,' . $driver->id,
            'driver_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total_experience_years' => 'required|integer|min:0',
            'hill_experience'        => 'required|boolean',
            'accident_history'       => 'boolean',
            'luxury_car_experience'  => 'required|boolean',
            'address'                => 'required|string|max:500',
            'pincode'                => 'required|string|max:10',
        ]);

        $data = $request->all();

        if ($request->hasFile('driver_image')) {
            $data['driver_image'] = $request->file('driver_image')->store('drivers', 'public');
        }

        if (empty($data['password'])) {
            unset($data['password']); // don’t overwrite with null
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    // Delete driver
    public function destroy(Drivers $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver deleted successfully.');
    }
}
