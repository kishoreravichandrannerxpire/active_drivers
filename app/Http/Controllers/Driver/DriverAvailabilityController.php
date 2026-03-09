<?php

namespace App\Http\Controllers\Driver;

use App\Models\DriverAvailability;
use App\Models\Drivers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverAvailabilityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
        ]);

        $driver = Drivers::where('user_id', auth()->id())->first();

        DriverAvailability::create([
            'drivers_id' => $driver->id,
            'from_date_time' => $request->from_date_time,
            'to_date_time' => $request->to_date_time,
        ]);

        session()->forget(['from_date_time', 'to_date_time']);

        return redirect()->route('driver.home')->with('success', 'Availability added successfully');
    }

    public function index(Request $request)
    {
    
    if ($request->from_date_time && $request->to_date_time) {
        session()->put('from_date_time', $request->from_date_time);
        session()->put('to_date_time', $request->to_date_time);       
    }

    $driver = Drivers::where('user_id', auth()->id())->first();

    if(!$driver) {
        return redirect()->route('driver.profile')->with('error', 'Driver profile not found. Please create your profile first.');
    }

    $availabilities = DriverAvailability::where('drivers_id', $driver->id)
        ->orderBy('from_date_time', 'asc')
        ->get();

    return view('driver.home', compact('availabilities'));
    }

    public function edit($id)
    {
        $availability = DriverAvailability::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
        ]);

        $availability = DriverAvailability::findOrFail($id);
        $availability->update([
            'from_date_time' => $request->from_date_time,
            'to_date_time' => $request->to_date_time,
        ]);

        session()->forget(['from_date_time', 'to_date_time']);

        return redirect()->route('driver.home')->with('success', 'Availability updated successfully');
    }

    public function destroy($id)
    {
        $availability = DriverAvailability::findOrFail($id);
        $availability->delete();

        return redirect()->route('driver.home')->with('success', 'Availability deleted successfully');
    }
}
