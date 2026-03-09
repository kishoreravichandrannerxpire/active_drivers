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
        // By default, do not show any drivers unless a date range is provided
        $drivers = collect();

        // If form was submitted, redirect to GET with query params (PRG pattern)
        if ($request->isMethod('post')) {
            $params = $request->only(['from_location', 'to_location', 'from_datetime', 'to_datetime']);
            // Redirect to the prefixed customer URL so the GET route exists
            return redirect()->to('/customer/driver-availability?' . http_build_query($params));
        }

        // For GET requests, check query parameters for filtering
        $fromDatetime = $request->query('from_datetime');
        $toDatetime = $request->query('to_datetime');

        if ($fromDatetime && $toDatetime) {
            // Find drivers with availability that overlaps the requested period
            // Overlap condition: driver's from <= customer's to AND driver's to >= customer's from
            $drivers = Drivers::whereHas('availabilities', function ($query) use ($fromDatetime, $toDatetime) {
                $query->where('from_date_time', '<=', $toDatetime)
                      ->where('to_date_time', '>=', $fromDatetime)
                      ->where('status', 1); // Only active availability records
            })->get();
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
