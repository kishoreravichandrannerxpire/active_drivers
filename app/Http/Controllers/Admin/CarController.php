<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cars;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index()
    {
        $cars = Cars::with('customer')->get(); // Eager load to avoid N+1 queries
        return view('admin.cars.index', compact('cars'));
        
    }

    public function create()
    {
        $cars = new Cars();
        $customers = Customers::all();
        return view('admin.cars.car-form', compact('cars', 'customers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customers_id'     => 'required|exists:customers,id',
            'car_model'         => 'required|string|max:255',
            'car_type'          => 'required|string|max:255',
            'car_number'        => 'required|string|max:20|unique:cars,car_number',
            'insurance'        => 'nullable|boolean',
            'fastag'           => 'nullable|boolean',
            'transmission_type' => 'nullable|in:Automatic,Manual',
            'fuel_type'        => 'nullable|in:Petrol,Diesel,Electric,Hybrid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Cars::create($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Car created successfully.');
    }

    public function edit(Cars $car)
    {
        $customers = Customers::all();
        return view('admin.cars.edit', compact('car', 'customers'));
    }

    public function update(Request $request, Cars $car)
    {
        $validator = Validator::make($request->all(), [
            'customers_id'     => 'required|exists:customers,id',
            'car_model'         => 'required|string|max:255',
            'car_type'          => 'required|string|max:255',
            'car_number'        => 'required|string|max:20|unique:cars,car_number,' . $car->id,
            'insurance'        => 'nullable|boolean',
            'fastag'           => 'nullable|boolean',
            'transmission_type' => 'nullable|in:Automatic,Manual',
            'fuel_type'        => 'nullable|in:Petrol,Diesel,Electric,Hybrid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $car->update($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Cars $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }

}