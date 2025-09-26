@extends('layouts.app')

@section('content')

<h2>Booking Form</h2>
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
    @csrf 
    @method('PUT')
    <div class="mb-3 row">
    <div class="col-sm-4">
        <label for="customers_id" class="form-label">Customer</label>
            <select name="customers_id" id="customers_id" class="form-select">
                <option value="">-- Select Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customers_id', $booking->customers_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} 
                    </option>
                @endforeach
            </select>
        </div>
    <div class="col-sm-4">
    <label for="cars_id" class="form-label">Car</label>
    <select name="cars_id" id="cars_id" class="form-select">
        <option value="">Select Your Car</option>
        <!-- Options will be filled via AJAX -->
    </select>
    </div>
    </div>
    <div class="mb-3 row">
     <div class="col-sm-4">
            <label for="drivers_id">Drivers</label>
            <select name="drivers_id" id="drivers_id" class="form-select">
                <option value="">Choose Driver</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ old('drivers_id', $booking->drivers_id) == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }} 
                    </option>
                    @endforeach
            </select>
    </div>
    <div class="col-sm-4">
        <label for="">Passengers</label>
        <input type="number" name="passengers" class="form-control" value="{{ old('passengers', $booking->passengers) }}">
    </div>
    </div>
    <div class="mb-3 row">
    <div class="col-sm-4">
        <label for="" class="form-label">Journey Type</label>
             <select name="journey_type" id="journey_type" class="form-select">
                <option value="">-- Select --</option>
                <option value="1" {{ old('journey_type', $booking->journey_type) == '1' ? 'selected' : '' }}>One Way </option>
                <option value="0" {{ old('journey_type', $booking->journey_type) == '0' ? 'selected' : '' }}>Two Way</option>
            </select>
    </div>
    <div class="col-sm-4">
        <label for="">Pickup Date & Time</label>
        <input type="datetime-local" name="pickup_date_time" class="form-control" value="{{ old('pickup_date_time', $booking->pickup_date_time) }}">
    </div>
    </div>
    <div class="mb-3 row">
    <div class="col-sm-4">
        <label for="">Pickup Location</label>
        <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location', $booking->pickup_location) }}">
    </div>
    <div class="col-sm-4">
        <label for="">Drop Location</label>
        <input type="text" name="drop_location" class="form-control" value="{{ old('drop_location', $booking->drop_location) }}">
    </div>
    </div>
    <div class="mb-3 row">
    <div class="col-sm-4">
        <label for="">From Postcode</label>
        <input type="text" name="from_postcode" class="form-control" value="{{ old('from_postcode', $booking->from_postcode) }}">
    </div>
    <div class="col-sm-4">  
        <label for="">To Postcode</label>
        <input type="text" name="to_postcode" class="form-control" value="{{ old('to_postcode', $booking->to_postcode) }}">
    </div>
    </div>
     <button type="submit" class="btn btn-primary">Update Booking</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var $carSelect = $('#cars_id');
    var initialCustomerId = $('#customers_id').val();
    var selectedCarId = "{{ old('cars_id', $booking->cars_id) }}"; // booking's saved car

    function loadCars(customerId, selectedCarId = null) {
        $carSelect.empty().append('<option value="">Select Your Car</option>');

        if(customerId) {
            $.ajax({
                url: '/admin/customers/' + customerId + '/cars',
                type: 'GET',
                success: function(cars) {
                    if(cars.length > 0){
                        $.each(cars, function(index, car){
                            var selected = (parseInt(selectedCarId) === parseInt(car.id)) ? 'selected' : '';
                            $carSelect.append('<option value="'+car.id+'" '+selected+'>'+car.name+'</option>');
                        });

                        // If no car selected, default to first
                        if (!selectedCarId) {
                            $carSelect.val(cars[0].id);
                        }
                    }
                },
                error: function() {
                    $carSelect.empty().append('<option value="">Select Your Car</option>');
                }
            });
        }
    }

    // Load cars on page load (for edit mode)
    if (initialCustomerId) {
        loadCars(initialCustomerId, selectedCarId);
    }

    // Reload cars when customer changes
    $('#customers_id').on('change', function() {
        var customerId = $(this).val();
        loadCars(customerId); // don’t pass selectedCarId (reset cars when switching customer)
    });
});
</script>

@endsection