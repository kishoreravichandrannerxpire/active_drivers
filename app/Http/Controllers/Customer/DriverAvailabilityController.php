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
        // Store from and to locations in session if provided
        if ($request->has('from') && $request->has('to')) {
            session(['from_location' => $request->from, 'to_location' => $request->to]);
        }

        $drivers = Drivers::all();
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
