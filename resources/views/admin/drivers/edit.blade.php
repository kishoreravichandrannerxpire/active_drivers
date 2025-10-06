@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Driver</h2>

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

    <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
        <!-- Name -->
        <div class="col-sm-4">
            <label for="name" class="form-label">Driver Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $driver->name) }}" required>
        </div>

        <!-- Age -->
        <div class="col-sm-4">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age"
                   value="{{ old('age', $driver->age) }}" required>
        </div>

        <!-- Mobile -->
        <div class="col-sm-4">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                   value="{{ old('mobile_number', $driver->mobile_number) }}" required>
        </div>
        </div>

        <div class="mb-3 row">
        <!-- Password -->
        <div class="col-sm-4">
            <label for="password" class="form-label">Password (leave blank to keep old)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- License -->
        <div class="col-sm-4">
            <label for="driver_license_number" class="form-label">Driver License Number</label>
            <input type="text" class="form-control" id="driver_license_number" name="driver_license_number"
                   value="{{ old('driver_license_number', $driver->driver_license_number) }}" required>
        </div>

        <!-- Image -->
        <div class="col-sm-4">
            <label for="driver_image" class="form-label">Driver Image</label>
            <input type="file" class="form-control" id="driver_image" name="driver_image">
            @if($driver->driver_image)
                <img src="{{ asset('storage/' . $driver->driver_image) }}" 
                     alt="Driver Image" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        </div>

        <div class="mb-3 row">
        <!-- Experience -->
        <div class="col-sm-4">
            <label for="total_experience_years" class="form-label">Total Experience (Years)</label>
            <input type="number" class="form-control" id="total_experience_years" name="total_experience_years"
                   value="{{ old('total_experience_years', $driver->total_experience_years) }}" required>
        </div>

        <!-- Hill Driving -->
        <div class="col-sm-4">
            <label class="form-label">Hill Driving Experience</label>
            <select class="form-select" name="hill_experience" required>
                <option value="1" {{ $driver->hill_experience ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$driver->hill_experience ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Accident History -->
        <div class="col-sm-4">
            <label class="form-label">Accident History</label>
            <select class="form-select" name="accident_history">
                <option value="1" {{ $driver->accident_history ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$driver->accident_history ? 'selected' : '' }}>No</option>
            </select>
        </div>
        </div>

        <div class="mb-3 row">
        <!-- Luxury Car -->
        <div class="col-sm-4">
            <label class="form-label">Luxury Car Experience</label>
            <select class="form-select" name="luxury_car_experience" required>
                <option value="1" {{ $driver->luxury_car_experience ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$driver->luxury_car_experience ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Address -->
        <div class="col-sm-4">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $driver->address) }}</textarea>
        </div>

        <!-- Pincode -->
        <div class="col-sm-4">
            <label for="pincode" class="form-label">Pincode</label>
            <input type="text" class="form-control" id="pincode" name="pincode"
                   value="{{ old('pincode', $driver->pincode) }}" required>
        </div>
        </div>

        <div class="col-sm-12 mb-3">
        <!-- Submit -->
        <button type="submit" class="btn btn-success">Update Driver</button>
        <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
