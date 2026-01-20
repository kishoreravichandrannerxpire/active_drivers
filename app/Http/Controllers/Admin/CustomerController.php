<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //show all customers
    public function index()
    {
        $customers = Customers::all();
        return view('admin.customers.index', compact('customers'));
    }

    //show create form
    public function create()
    {
        return view('admin.customers.customer-form');
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id'        => 'required|exists:users,id',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Customers::create($request->all());
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully!');
    }

    public function edit(Customers $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customers $customer)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id'        => 'required|exists:users,id',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $customer->update($data);
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully!');
    }
}
