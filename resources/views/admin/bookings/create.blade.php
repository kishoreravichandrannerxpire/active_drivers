@extends('layouts.app')

@section('content') 
<h2>Booking Form</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form action="{{ route('admin.bookings.store') }}" method="POST">
@csrf

<div class="row mb-3">
    <div class="col-12 col-md-4">
        <label class="form-label">Customer</label>
        <select name="customers_id" id="customers_id" class="form-select">
            <option value="">-- Select Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
            @endforeach
        </select>
        @error('customers_id')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">Car</label>
        <select name="cars_id" id="cars_id" class="form-select">
            <option value="">Select Your Car</option>
        </select>
        @error('cars_id')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">Driver</label>
        <select name="drivers_id" class="form-select">
            <option value="">Choose Driver</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->first_name }}</option>
            @endforeach
        </select>
        @error('drivers_id')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-md-4">
        <label class="form-label">Passengers</label>
        <input type="number" name="passengers" class="form-control" min="1">
        @error('passengers')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">Journey Type</label>
        <select name="journey_type" class="form-select">
            <option value="">-- Select --</option>
            <option value="1">One Way</option>
            <option value="0">Two Way</option>
        </select>
        @error('journey_type')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    @can('permissions')
    <div class="col-12 col-md-4">
        <label class="form-label">Fare</label>
        <input type="number" step="1" name="fare" class="form-control">
        @error('fare')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    @endcan
</div>

<div class="row mb-3">
    <div class="col-12 col-md-4">
        <label class="form-label">Pickup Date & Time</label>
        <input type="datetime-local" name="pickup_date_time" class="form-control">
        @error('pickup_date_time')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">Pickup Location</label>
        <input type="text" name="pickup_location" class="form-control">
        @error('pickup_location')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">Drop Location</label>
        <input type="text" name="drop_location" class="form-control">
        @error('drop_location')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-md-4">
        <label class="form-label">From Postcode</label>
        <input type="text" name="from_postcode" class="form-control">
        @error('from_postcode')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-12 col-md-4">
        <label class="form-label">To Postcode</label>
        <input type="text" name="to_postcode" class="form-control">
        @error('to_postcode')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <!-- empty column to balance row -->
    <div class="col-12 col-md-4"></div>
</div>

<div class="row">
    <div class="col-12 text-start">
        <button type="submit" class="btn btn-primary px-4">Create Booking</button>
    </div>
</div>

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#customers_id').on('change', function() {
        loadCars($(this).val());
    });

    //Run once on page load in case old customer/car exists
    var initialCustomerId = $('#customers_id').val();
    if(initialCustomerId) {
        loadCars(initialCustomerId);
    }

    function loadCars(customerId) {
        var $carSelect = $('#cars_id');
        var oldCarId = $('#old_cars_id').val();
        $carSelect.empty().append('<option value="">Select Your Car</option>');

        if(customerId) {
            $.ajax({
                url: '/admin/customers/' + customerId + '/cars',
                type: 'GET',
                success: function(cars) {
                    if(cars.length > 0){
                        $.each(cars, function(index, car){
                            var selected = (car.id == oldCarId) ? 'selected' : '';
                            $carSelect.append('<option value="'+car.id+'" '+selected+'>'+car.name+'</option>');
                        });

                        // If no old car selected, select the first car by default
                        if(!oldCarId) {
                            $carSelect.val(cars[0].id); 
                        }
                    }
                },
                error: function() {
                    $carSelect.empty().append('<option value="">  </option>');
                }
            });
        }
    }
});
</script>

@endsection