<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    @include('partials.links')
</head>
<body>
    @include('partials.navbar')
    @include('customer.mycars.create')

    <div class="container" style="margin-top:150px;">
        <div class="card p-4">
            <h3>Confirm Booking</h3>

            <form action="{{ route('customer.booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="drivers_id" value="{{ $data['driver_id'] ?? '' }}">

                <div class="row mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Pickup Location</label>
                        <input type="text" class="form-control" name="pickup_location" value="{{ $data['from_location'] ?? '' }}" readonly required>
                        @error('pickup_location')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Drop Location</label>
                        <input type="text" class="form-control" name="drop_location" value="{{ $data['to_location'] ?? '' }}" readonly required>
                        @error('drop_location')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Pickup Date & Time</label>
                        <input type="datetime-local" class="form-control" name="pickup_date_time" value="{{ isset($data['from_datetime']) ? \Carbon\Carbon::parse($data['from_datetime'])->format('Y-m-d\\TH:i') : '' }}" required>
                        @error('pickup_date_time')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">From Postcode</label>
                        <input type="text" class="form-control" name="from_postcode" value="{{ $data['from_postcode'] ?? '' }}" required>
                        @error('from_postcode')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">To Postcode</label>
                        <input type="text" class="form-control" name="to_postcode" value="{{ $data['to_postcode'] ?? '' }}" required>
                        @error('to_postcode')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Passengers</label>
                        <input type="number" name="passengers" class="form-control" min="1" value="1" required>
                        @error('passengers')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Car</label>
                        @if($cars->count() == 0)
                            <div class="alert alert-warning">No cars available for the selected driver.</div>
                        @else
                            <select name="cars_id" class="form-select">
                                <option value="">Select Your Car</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->car_model }} ({{ $car->car_type }}) (Reg: {{ $car->car_number }})</option>
                                @endforeach
                            </select>
                        @endif
                        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addCarModal">
            <i class="bi bi-plus-circle"></i> Add New Car
        </button>
                        @error('cars_id')<small class="text-danger">{{ $message }}</small>@enderror
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
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Fare (optional)</label>
                        <input type="number" step="0.01" name="fare" class="form-control" value="{{ $data['fare'] ?? '' }}">
                        @error('fare')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 col-md-8">
                        <label class="form-label">Driver</label>
                        <input type="text" class="form-control" value="{{ $driver ? $driver->first_name . ' ' . $driver->last_name : 'N/A' }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start">
                        <button type="submit" class="btn btn-primary px-4">Confirm Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>