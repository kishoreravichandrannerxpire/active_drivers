<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;

class CustomerProfile extends Controller
{
    //show all customers
    public function index()
    {
        $customers = Customers::all();
        return view('customer.profile.index', compact('customers'));
    }

    //show create form
    public function create()
    {
        return view('customer.profile.create_form');
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'mobile_number'  => 'required|string|max:10|unique:customers,mobile_number',
            'password'       => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Customers::create($request->all());
        return redirect()->route('customer.profile.index')->with('success', 'Customer created successfully!');
    }

    public function edit(Customers $customer)
    {
        return view('customer.profile.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $profile = Customers::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email,' . $profile->user_id,
            'mobile_number'      => 'required|string|max:20|unique:users,mobile_number,' . $profile->user_id,
            'car_model'          => 'required|string|max:255',
            'car_type'           => 'required|string|max:255',
            'car_number'         => 'required|string|max:255',
            'insurance'          => 'nullable|string|max:255',
            'fastag'             => 'nullable|string|max:255',
            'transmission_type'  => 'nullable|string|max:255',
            'fuel_type'          => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update Customer
        $profile->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
        ]);

        // Update User
        $profile->user->update([
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);

        // Update or Create Car (assuming one car per customer)
        $car = $profile->cars()->first();
        if ($car) {
            $car->update([
                'car_model'         => $request->car_model,
                'car_type'          => $request->car_type,
                'car_number'        => $request->car_number,
                'insurance'         => $request->insurance,
                'fastag'            => $request->fastag,
                'transmission_type' => $request->transmission_type,
                'fuel_type'         => $request->fuel_type,
            ]);
        } else {
            $profile->cars()->create([
                'car_model'         => $request->car_model,
                'car_type'          => $request->car_type,
                'car_number'        => $request->car_number,
                'insurance'         => $request->insurance,
                'fastag'            => $request->fastag,
                'transmission_type' => $request->transmission_type,
                'fuel_type'         => $request->fuel_type,
            ]);
        }

        return redirect()->route('customer.home')->with('success', 'Profile updated successfully!');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('customer.profile.index')->with('success', 'Customer deleted successfully!');
    }

    public function show()
    {
        $customer = Customers::where('user_id', auth()->id())->first();
        if (!$customer) {
            // Create customer record if it doesn't exist
            $customer = Customers::create([
                'user_id' => auth()->id(),
                'first_name' => '', // Or get from user name if available
                'last_name' => '',
            ]);
        }
        return view('customer.myprofile', compact('customer'));
    }

    public function completion()
    {
        $customer = Customers::where('user_id', auth()->id())->first();
        if (!$customer) {
            $customer = Customers::create([
                'user_id' => auth()->id(),
                'first_name' => '',
                'last_name' => '',
            ]);
        }
        return view('customer.profilecompletion', compact('customer'));
    }
 
    // Store profile completion data (route name: customer.profile.store)
    public function storeProfile(Request $request)
    {
        $profile = Customers::where('user_id', auth()->id())->firstOrFail();
 
        $validator = Validator::make($request->all(), [
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email,' . $profile->user_id,
            'mobile_number'      => 'required|string|max:20|unique:users,mobile_number,' . $profile->user_id,
            'car_model'          => 'required|string|max:255',
            'car_type'           => 'required|string|max:255',
            'car_number'         => 'required|string|max:255',
            'insurance'          => 'nullable|string|max:255',
            'fastag'             => 'nullable|string|max:255',
            'transmission_type'  => 'nullable|string|max:255',
            'fuel_type'          => 'nullable|string|max:255',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
 
        // Update Customer
        $profile->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
        ]);
 
        // Update User
        $user = $profile->user ?? auth()->user();
        $user->update([
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);
 
        // Update or Create Car (assuming one car per customer)
        $car = $profile->cars()->first();
        if ($car) {
            $car->update([
                'car_model'         => $request->car_model,
                'car_type'          => $request->car_type,
                'car_number'        => $request->car_number,
                'insurance'         => $request->insurance,
                'fastag'            => $request->fastag,
                'transmission_type' => $request->transmission_type,
                'fuel_type'         => $request->fuel_type,
            ]);
        } else {
            $profile->cars()->create([
                'car_model'         => $request->car_model,
                'car_type'          => $request->car_type,
                'car_number'        => $request->car_number,
                'insurance'         => $request->insurance,
                'fastag'            => $request->fastag,
                'transmission_type' => $request->transmission_type,
                'fuel_type'         => $request->fuel_type,
            ]);
        }
 
        return redirect()->route('home')->with('success', 'Profile completed successfully!');
    }
}
