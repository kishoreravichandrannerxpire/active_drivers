<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drivers;
use Illuminate\Support\Facades\Validator;

class DriverProfileController extends Controller
{
    // Show profile
    public function show()
    {
        $driver = Drivers::where('user_id', auth()->id())->firstOrFail();
        session()->keep(['from_date_time', 'to_date_time']);
        return view('driver.profile', compact('driver'));
    }
    // Update profile
    public function update(Request $request)
    {
        $driver = Drivers::where('user_id', auth()->id())->firstOrFail();

        $validator = Validator::make($request->all(), [

            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'mobile_number' => 'required|string|max:20|unique:users,mobile_number,' . auth()->id(),

            'age' => 'required|integer|min:18',

            'status' => 'required|in:0,1',

            'driver_license_number' =>
                'required|string|unique:drivers,driver_license_number,' . $driver->id,

            'driver_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'total_experience_years' => 'required|integer|min:0',

            'hill_experience' => 'nullable|in:0,1',
            'accident_history' => 'nullable|in:0,1',
            'luxury_car_experience' => 'nullable|in:0,1',

            'address' => 'required|string',

            'pincode' => 'required|string|max:10',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        /* ---------- Upload Image ---------- */

        if ($request->hasFile('driver_image')) {

            $image = $request->file('driver_image');

            $name = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('uploads/drivers'), $name);

            $driver->driver_image = 'uploads/drivers/' . $name;
        }


        /* ---------- Update Driver ---------- */

        $driver->update([

            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,

            'age' => $request->age,
            'status' => $request->status,

            'driver_license_number' => $request->driver_license_number,

            'total_experience_years' => $request->total_experience_years,

            'hill_experience' => $request->hill_experience,
            'accident_history' => $request->accident_history,
            'luxury_car_experience' => $request->luxury_car_experience,

            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);


        /* ---------- Update User ---------- */

        auth()->user()->update([

            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);


        return back()->with('success', 'Profile updated successfully!');
    }
}
