<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Drivers;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    // Show bookings assigned to authenticated driver
    public function index(Request $request)
    {
        $driver = Drivers::where('user_id', Auth::id())->first();
        if (! $driver) {
            $bookings = collect();
        } else {
            $bookings = Bookings::with(['customer', 'car'])
                ->where('drivers_id', $driver->id)
                ->latest()
                ->get();
        }

        return view('driver.my_trip', compact('bookings'));
    }
}
