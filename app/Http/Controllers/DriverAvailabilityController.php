<?php

namespace App\Http\Controllers;

use App\Models\DriverAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverAvailabilityController extends Controller
{
    // Create a new availability entry
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'drivers_id'      => 'required|exists:drivers,id',
            'available_date' => 'required|date',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'drivers_id',
            'available_date',
            'start_time',
            'end_time'
        ]);
        $data['status'] = 1;

        DriverAvailability::create($data);

        return redirect()->back()->with('success', 'Driver availability created successfully!');
    }

    // Show all availability entries
    public function index()
    {
        $availabilities = DriverAvailability::with('driver')->get();
        return view('driver_availability.index', compact('availabilities'));
    }

    // Update a specific availability entry
    public function update(Request $request, $id)
    {
        $availability = DriverAvailability::find($id);

        if (!$availability) {
            return redirect()->back()->with('error', 'Availability not found!');
        }

        $validator = Validator::make($request->all(), [
            'available_date' => 'date',
            'start_time'     => 'date_format:H:i',
            'end_time'       => 'date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'available_date',
            'start_time',
            'end_time'
        ]);

        if (!empty($data['available_date']) && !empty($data['start_time']) && !empty($data['end_time'])) {
            $data['status'] = 1;
        }

        $availability->update($data);

        return redirect()->back()->with('success', 'Availability updated successfully!');
    }
}
