@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Booking List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Car</th>
                <th>Driver</th>
                <th>Passengers</th>
                <th>Journey Type</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>From Postcode</th>
                <th>To Postcode</th>
                <th>Pickup Date & Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->customer ? $booking->customer->name : 'N/A' }}</td>
                    <td>{{ $booking->car ? $booking->car->car_model : 'N/A' }}</td>
                    <td>{{ $booking->driver ? $booking->driver->name : 'N/A'}}</td>
                    <td>{{ $booking->passengers }}</td>
                    <td>{{ $booking->journey_type}}</td>
                    <td>{{ $booking->pickup_location }}</td>
                    <td>{{ $booking->drop_location }}</td>
                    <td>{{ $booking->from_postcode }}</td>
                    <td>{{ $booking->to_postcode }}</td>
                    <td>{{ $booking->pickup_date_time }}</td>
                    <td>
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button> 
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No bookings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
