<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('driver_form'); // Blade file
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'age'            => 'required|integer|min:18',
            'mobile_number'  => 'required|string|max:20|unique:drivers,mobile_number',
            'password' => 'required|string|min:6',
            'driver_license_number' => 'required|string|max:50|unique:drivers,driver_license_number',
            'driver_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total_experience_years' => 'required|integer|min:0',
            'hill_experience' => 'required|boolean',
            'accident_history' => 'boolean',
            'luxury_car_experience' => 'required|boolean',
            'address' => 'required|string|max:500',
            'pincode' => 'required|string|max:10',
        ]);
        // dd( $request->all());
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name','age','mobile_number','password','driver_license_number', 'driver_image','total_experience_years','hill_experience','accident_history','luxury_car_experience','address','pincode']);
        
        // Handle image upload
    if ($request->hasFile('driver_image')) {
        $imagePath = $request->file('driver_image')->store('drivers', 'public');
        $data['driver_image'] = $imagePath;
    }

        Drivers::create($data);

        return redirect()->back()->with('success', 'Driver submitted successfully!');
    }
}
?>