@extends('layouts.app')

@section('content')

@if ($errors->any())
    <!-- <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> -->
@endif
<style>
    label{
        color: #020633ff;
    }
</style>

<div class="container mt-3">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-white text-center rounded-top-4" style="background: orange;">
            <h2 class="mb-0">Driver Registration Form</h2>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">First Name<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                        @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                     <div class="col-md-6">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mobile Number<span class="text-danger">*</span></label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
                        @error('mobile_number')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">License Number</label>
                        <input type="text" name="driver_license_number" class="form-control" value="{{ old('driver_license_number') }}">
                        @error('driver_license_number')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Driver Image</label>
                        <input type="file" name="driver_image" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Total Experience (Years)</label>
                        <input type="number" name="total_experience_years" class="form-control" value="{{ old('total_experience_years') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Hill Experience</label>
                        <select name="hill_experience" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('hill_experience') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('hill_experience') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Accident History</label>
                        <select name="accident_history" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('accident_history') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('accident_history') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Luxury Car Experience</label>
                        <select name="luxury_car_experience" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('luxury_car_experience') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('luxury_car_experience') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Pincode</label>
                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">status</label>
                        <select name="status" class="form-select">
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        </select>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5" style="background: orange;">Submit Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection