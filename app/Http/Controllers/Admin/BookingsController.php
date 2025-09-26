<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Customers;
use App\Models\Cars;
use App\Models\Drivers;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Bookings::all();
        return view('admin.bookings.index' , compact('bookings'));
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
            'from_postcode'   => 'nullable|string|max:20',
            'to_postcode'     => 'nullable|string|max:20',
            'pickup_date_time'=> 'required|date',
            'passengers'      => 'required|integer|min:1',
            'cars_id'         => 'required|exists:cars,id',
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
        $request->validate([
            'customers_id'    => 'required|exists:customers,id',
            'drivers_id'      => 'required|exists:drivers,id',
            'journey_type'    => 'required|string|max:100',
            'pickup_location' => 'required|string|max:255',
            'drop_location'   => 'required|string|max:255',
            'from_postcode'   => 'nullable|string|max:20',
            'to_postcode'     => 'nullable|string|max:20',
            'pickup_date_time'=> 'required|date',
            'passengers'      => 'required|integer|min:1',
            'cars_id'         => 'required|exists:cars,id',
        ]);

        $booking = Bookings::findOrFail($id);
        $booking->update($request->all());
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
