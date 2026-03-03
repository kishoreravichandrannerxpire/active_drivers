<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverAvailability;
use App\Models\Drivers;
use Illuminate\Http\Request;

class DriverAvailabilityController extends Controller
{
    
    public function index(Request $request)
    {
        $driver_id = $request->driver_id;

        if ($driver_id) {
            $drivers = DriverAvailability::with('driver')
                ->where('drivers_id', $driver_id)
                ->get();
        } else {
            $drivers = DriverAvailability::with('driver')->get();
        }

        return view('admin.drivers.driver-availability', compact('drivers'));
    }       
    public function create(Request $request)
    {
         $selectedDriverId= $request->driver_id;
        if ($selectedDriverId) {
            $drivers = Drivers::where('id', $selectedDriverId)->get();
        } else {
            $drivers = Drivers::all();
        }

        return view('admin.drivers.driver-availability-form', compact('drivers', 'selectedDriverId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'drivers_id' => 'required|exists:drivers,id',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
        ]);

        DriverAvailability::create([
            'drivers_id' => $request->drivers_id,
            'from_date_time' => $request->from_date_time,
            'to_date_time' => $request->to_date_time,
        ]);

        return redirect()->back()->with('success', 'Driver availability added successfully.');
    }

    public function edit($id)
    {
        $availability = DriverAvailability::findOrFail($id);
        $drivers = Drivers::all();

        return view('admin.drivers.driver-availability-edit', compact('availability', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'drivers_id' => 'required|exists:drivers,id',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
        ]);

        $availability = DriverAvailability::findOrFail($id);

        $availability->update([
            'drivers_id' => $request->drivers_id,
            'from_date_time' => $request->from_date_time,
            'to_date_time' => $request->to_date_time,
        ]);

        return redirect()->route('admin.availability.index')
            ->with('success', 'Driver availability updated successfully.');
    }

    public function destroy($id)
    {
        $availability = DriverAvailability::findOrFail($id);
        $availability->delete();

        return redirect()->back()->with('success', 'Driver availability deleted successfully.');
    }
}
