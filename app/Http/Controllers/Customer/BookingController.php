<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drivers;
use App\Models\Bookings;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show booking confirmation page populated from query params
    public function create(Request $request)
    {
        $driver = null;
        if ($request->query('driver_id')) {
            $driver = Drivers::find($request->query('driver_id'));
        }

        $data = $request->only(['from_location', 'to_location', 'from_datetime', 'to_datetime', 'driver_id']);

        // Get authenticated customer's record and cars
        $customer = Customers::where('user_id', Auth::id())->first();
        $cars = $customer ? $customer->cars : collect();

        return view('customer.booking', compact('driver', 'data', 'cars', 'customer'));
    }

    // Show authenticated customer's bookings
    public function index(Request $request)
    {
        $customer = Customers::where('user_id', Auth::id())->first();
        if (! $customer) {
            $bookings = collect();
        } else {
            $bookings = Bookings::with(['driver', 'car'])
                ->where('customers_id', $customer->id)
                ->latest()
                ->get();
        }

        return view('customer.my_bookings', compact('bookings'));
    }

    // Store booking
    public function store(Request $request)
    {
        // Resolve customer id from authenticated user
        $customer = Customers::where('user_id', Auth::id())->first();
        if (! $customer) {
            return back()->withErrors(['customer' => 'Customer profile not found.'])->withInput();
        }

        $validated = $request->validate([
            'drivers_id'      => 'required|exists:drivers,id',
            'journey_type'    => 'required|in:0,1',
            'pickup_location' => 'required|string|max:255',
            'drop_location'   => 'required|string|max:255',
            'from_postcode'   => 'nullable|string|max:20',
            'to_postcode'     => 'nullable|string|max:20',
            'pickup_date_time'=> 'required|date',
            'passengers'      => 'required|integer|min:1',
            'cars_id'         => 'required|exists:cars,id',
            'fare'            => 'nullable|numeric|min:0',
        ]);

        // Ensure journey_type is stored as integer
        $validated['journey_type'] = (int) $validated['journey_type'];

        $payload = $validated;
        $payload['customers_id'] = $customer->id;

        Bookings::create($payload);

        return redirect('/customer/my-bookings')->with('success', 'Booking confirmed.');
    }
}
