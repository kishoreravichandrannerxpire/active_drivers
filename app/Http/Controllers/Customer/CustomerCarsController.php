<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cars;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerCarsController extends Controller
{
    public function index()
    {
        $customer = Customers::where('user_id', Auth::id())->first();
        
        if (!$customer) {
        return redirect()->back()->with('error', 'Customer profile not found.');
        }
        
        $cars = $customer->cars;
        return view('customer.mycars.index', compact('cars'));
    }
    
    public function create()
    {
        $cars = new Cars();
        return view('customer.mycars.create', compact('cars'));
    }
    public function store(Request $request)
    {
        // Get authenticated user ID
        $userId = Auth::id();
        
        // Find customer by user_id
        $customer = Customers::where('user_id', $userId)->first();
        
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer profile not found.');
        }

        // Validate the request (customer id injected server-side)
        $validator = Validator::make($request->all(), [
            'car_model'         => 'required|string|max:255',
            'car_type'          => 'required|string|max:255',
            'car_number'        => 'required|string|max:20|unique:cars,car_number',
            'insurance'        => 'nullable|boolean',
            'fastag'           => 'nullable|boolean',
            'transmission_type' => 'required|in:Manual,Automatic',
            'fuel_type'        => 'required|in:Petrol,Diesel,Electric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
         
        // attach the customer id and other fields explicitly to avoid missing data
        Cars::create([
            'customers_id'      => $customer->id,
            'car_model'         => $request->car_model,
            'car_type'          => $request->car_type,
            'car_number'        => $request->car_number,
            'insurance'         => $request->insurance ?? false,
            'fastag'            => $request->fastag ?? false,
            'transmission_type' => $request->transmission_type,
            'fuel_type'         => $request->fuel_type,
        ]);

        return redirect()->route('customer.home')->with('success', 'Your Car added successfully');
    }

    public function edit($id)
    {
        $car = Cars::findOrFail($id);
        return view('customer.mycars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = Cars::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'car_model'         => 'required|string|max:255',
            'car_type'          => 'required|string|max:255',
            'car_number'        => 'required|string|max:20|unique:cars,car_number,' . $car->id,
            'insurance'         => 'nullable|boolean',
            'fastag'            => 'nullable|boolean',
            'transmission_type' => 'required|in:Manual,Automatic',  
            'fuel_type'         => 'required|in:Petrol,Diesel,Electric',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update car details
        $car->update($request->all());

        return redirect()->route('customer.mycars.index')->with('success', 'Car updated successfully');
    }

    public function destroy($id)
    {
        $car = Cars::findOrFail($id);
        $car->delete();

        return redirect()->route('customer.mycars.index')->with('success', 'Car deleted successfully');
    }
}
