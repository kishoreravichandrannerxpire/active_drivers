<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\CustomerHistory;
use App\Models\User;
use App\Models\UserHistory;
use App\Models\Cars;
use App\Models\CarHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // show all customers
    public function index()
    {
        $customers = Customers::with('user')->get();
        return view('admin.customers.index', compact('customers'));
    }

    // show create form
    public function create()
    {
        return view('admin.customers.customer-form');
    }

    // store customer + user
    public function store(Request $request)
{
    $request->validate([
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'nullable|string|max:255',
        'email'         => 'nullable|email|unique:users,email',
        'mobile_number' => 'required|size:10|unique:users,mobile_number',
        'password'      => 'required|min:6',
    ]);

    DB::transaction(function () use ($request) {

        // 1. Create user
        $user = User::create([
            'roles_id'      => 3, // customer role
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'password'      => Hash::make($request->password),
        ]);

        // 2. Create customer
        Customers::create([
            'user_id'    => $user->id,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
        ]);
    });

    return redirect()->route('admin.customers.index')
           ->with('success', 'Customer created successfully!');
}

    // edit
    public function edit(Customers $customer)
    {
        $customer->load('user');
        return view('admin.customers.edit', compact('customer'));
    }

    // update both tables
    public function update(Request $request, Customers $customer)
    {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'email'          => 'nullable|email|unique:users,email,' . $customer->user_id,
            'mobile_number'  => 'required|size:10|unique:users,mobile_number,' . $customer->user_id,
            'password'       => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request, $customer) {

            // update user table
            $user = $customer->user;
            $user->email = $request->email;
            $user->mobile_number = $request->mobile_number;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // update customers table
            $customer->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
            ]);
        });

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully!');
    }

    // delete both tables safely
    public function destroy(Customers $customer)
{
    DB::transaction(function () use ($customer) {

        // 1. Get all cars of this customer
        $cars = Cars::where('customers_id', $customer->id)->get();

        // 2. Store each car in cars_history
        foreach ($cars as $car) {
            CarHistory::create([
                'cars_id' => $car->id,
                'car_model' => $car->car_model,
                'car_type' => $car->car_type,
                'car_number' => $car->car_number,
                'insurance' => $car->insurance,
                'fastag' => $car->fastag,
                'transmission_type' => $car->transmission_type,
                'fuel_type' => $car->fuel_type,
                'action' => 'deleted',
            ]);
        }

        // 3. Soft delete all cars first
        Cars::where('customers_id', $customer->id)->delete();

        // 4. Soft delete customer
        $customer->delete();

        // 5. Delete related user
        $customer->user->delete();
    });

    return redirect()->route('admin.customers.index')
        ->with('success', 'Customer deleted successfully with car history stored!');
}


}