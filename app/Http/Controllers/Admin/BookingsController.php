<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Customers;
use App\Models\Cars;
use App\Models\Drivers;
use Carbon\Carbon;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $customerId = $request->customer_id;
         if ($customerId) {
            $bookings = Bookings::where('customers_id', $customerId)->get();
        } else {
            $bookings = Bookings::all();
        }
        return view('admin.bookings.index' , compact('bookings'));
    }

    public function getAllBookings()
    {
        // All bookings
        $allBookings = Bookings::latest()->get();

        // Today bookings (based on pickup_date_time)
        $todayBookings = Bookings::whereDate('booking_time', Carbon::today())->latest()->get();

        // Completed bookings
        $completedBookings = Bookings::where('status', 'completed')->latest()->get();

        // Counts for badges
        $allCount = $allBookings->count();
        $todayCount = $todayBookings->count();
        $completedCount = $completedBookings->count();

        return view('admin.bookings.all-bookings', compact(
            'allBookings',
            'todayBookings',
            'completedBookings',
            'allCount',
            'todayCount',
            'completedCount'
        ));
    }

    public function create()
   {
        $customers = Customers::all();
        $drivers = Drivers::all();
        $cars = Cars::all();    
        return view('admin.bookings.create' , compact('customers', 'drivers', 'cars'));
   }
  public function getCustomerCars($id)
{
    $customer = Customers::with('cars')->find($id);
    if ($customer) {
        // Return cars with ID and name/type
        $cars = $customer->cars->map(function($car) {
            return [
                'id' => $car->id,
                'name' => $car->car_model . ' (' . $car->car_type . ')'.'('.'Reg No :' . $car->car_number . ')'
            ];
        });
        return response()->json($cars);
    }
    return response()->json([]);
}


public function store(Request $request)
    {
       $request->validate([
            'customers_id'    => 'required|exists:customers,id',
            'drivers_id'      => 'required|exists:drivers,id',
            'journey_type'    => 'required|string|max:100',
            'pickup_location' => 'required|string|max:255',
            'drop_location'   => 'required|string|max:255',
            'from_postcode'   => 'required|string|max:20',
            'to_postcode'     => 'required|string|max:20',
            'pickup_date_time'=> 'required|date',
            'passengers'      => 'required|integer|min:1',
            'cars_id'         => 'required|exists:cars,id',
            'fare'            => 'required|numeric|min:0',
        ]);

        Bookings::create($request->all());
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');

    }
    public function edit($id)
    {
        $booking = Bookings::findOrFail($id);
        $customers = Customers::all();
        $drivers = Drivers::all();
        $cars = Cars::all();    
        return view('admin.bookings.edit', compact('booking', 'customers', 'drivers', 'cars'));
    }
    public function update(Request $request, $id)
    {
    $validated = $request->validate([
        'customers_id'    => 'required|exists:customers,id',
        'drivers_id'      => 'required|exists:drivers,id',
        'journey_type'    => 'required|string|max:100',
        'pickup_location' => 'required|string|max:255',
        'drop_location'   => 'required|string|max:255',
        'from_postcode'   => 'required|string|max:20',
        'to_postcode'     => 'required|string|max:20',
        'pickup_date_time'=> 'required|date',
        'passengers'      => 'required|integer|min:1',
        'cars_id'         => 'required|exists:cars,id',
        'fare'            => 'required|numeric|min:0',
        'status'          => 'required|string|max:100',
        'payment_status'  => 'required|in:paid,unpaid',
    ]);

    $paymentMap = [
        'paid' => 0,
        'unpaid' => 1,
    ];

    $validated['payment_status'] = $paymentMap[$validated['payment_status']];

    $booking = Bookings::findOrFail($id);
    $booking->update($validated);

    return redirect()->route('admin.bookings.index')
        ->with('success', 'Booking updated successfully.');
}
    public function destroy($id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
    
}
