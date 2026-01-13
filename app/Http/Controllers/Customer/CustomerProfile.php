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

    public function update(Request $request, Customers $customer)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'mobile_number'  => 'required|string|max:10|unique:customers,mobile_number,' . $customer->id,
            'password'       => 'nullable|string|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        if (empty($data['password'])) {
            unset($data['password']); // Don't update password if not provided
        }

        $customer->update($data);
        return redirect()->route('customer.profile.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('customer.profile.index')->with('success', 'Customer deleted successfully!');
    }
}
