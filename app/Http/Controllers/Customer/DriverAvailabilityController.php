<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Drivers;
use Illuminate\Http\Request;

class DriverAvailabilityController extends Controller
{
    /**
     * Display all drivers
     */
    public function index(Request $request)
    {
        $drivers = Drivers::all();
        
        // If form was submitted, redirect to preserve input for old() helper
        if ($request->isMethod('post')) {
            return redirect('customer/driver-availability')
            ->withInput($request->only(['from_location', 'to_location', 'from_datetime', 'to_datetime']));
        }
        
        return view('customer.driver_availability', compact('drivers'));
    }

    /**
     * Get available drivers (status = 1)
     */
    public function getAvailableDrivers()
    {
        $drivers = Drivers::where('status', 1)->get();
        return response()->json($drivers);
    }
}
