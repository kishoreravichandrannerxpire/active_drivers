@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Driver</h2>

    <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
        <!-- Name -->
        <div class="col-sm-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                   value="{{ old('first_name', $driver->first_name) }}" >
                   @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="col-sm-4">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                   value="{{ old('last_name', $driver->last_name) }}" >
        </div>
        <!-- Age -->
        <div class="col-sm-4">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age"
                   value="{{ old('age', $driver->age) }}" >
        </div>
        </div>

        <div class="mb-3 row">
        <!-- Mobile -->
        <div class="col-sm-4">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                   value="{{ old('mobile_number', $driver->mobile_number) }}" >
                     @error('mobile_number')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <!-- Email -->
        <div class="col-sm-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email', $driver->email) }}" >
        </div>

        <!-- Password -->
        <div class="col-sm-4">
            <label for="password" class="form-label">Password (leave blank to keep old)</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        </div>

        <div class="mb-3 row">
        <!-- License -->
        <div class="col-sm-4">
            <label for="driver_license_number" class="form-label">Driver License Number</label>
            <input type="text" class="form-control" id="driver_license_number" name="driver_license_number"
                   value="{{ old('driver_license_number', $driver->driver_license_number) }}" >
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
        
        <!-- Experience -->
        <div class="col-sm-4">
            <label for="total_experience_years" class="form-label">Total Experience (Years)</label>
            <input type="number" class="form-control" id="total_experience_years" name="total_experience_years"
                   value="{{ old('total_experience_years', $driver->total_experience_years) }}" >
        </div>
        </div>

       <div class="mb-3 row">
        <!-- Hill Driving -->
        <div class="col-sm-4">
            <label class="form-label">Hill Driving Experience</label>
            <select class="form-select" name="hill_experience" >
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

        <!-- Luxury Car -->
        <div class="col-sm-4">
            <label class="form-label">Luxury Car Experience</label>
            <select class="form-select" name="luxury_car_experience" >
                <option value="1" {{ $driver->luxury_car_experience ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$driver->luxury_car_experience ? 'selected' : '' }}>No</option>
            </select>
        </div>
        </div>

         <div class="mb-3 row">
        <!-- Address -->
        <div class="col-sm-4">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" >{{ old('address', $driver->address) }}</textarea>
        </div>

        <!-- Pincode -->
        <div class="col-sm-4">
            <label for="pincode" class="form-label">Pincode</label>
            <input type="text" class="form-control" id="pincode" name="pincode"
                   value="{{ old('pincode', $driver->pincode) }}" >
        </div>
        <div class= "col-sm-4">
            <label class="form-label">Status</label>
            <select class="form-select" name="status" >
                <option value="1" {{ $driver->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$driver->status ? 'selected' : '' }}>Inactive</option>
            </select>
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