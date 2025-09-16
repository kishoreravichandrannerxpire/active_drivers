<!DOCTYPE html>
<html>
<head>
    <title>Driver Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success text-white text-center rounded-top-4">
            <h2 class="mb-0">Driver Registration Form</h2>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('driver.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                        @error('age')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
                        @error('mobile_number')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password</label>
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
                        @error('driver_image')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Total Experience (Years)</label>
                        <input type="number" name="total_experience_years" class="form-control" value="{{ old('total_experience_years') }}">
                        @error('total_experience_years')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Hill Experience</label>
                        <select name="hill_experience" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('hill_experience') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('hill_experience') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('hill_experience')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Accident History</label>
                        <select name="accident_history" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('accident_history') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('accident_history') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('accident_history')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Luxury Car Experience</label>
                        <select name="luxury_car_experience" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('luxury_car_experience') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('luxury_car_experience') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('luxury_car_experience')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Pincode</label>
                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}">
                        @error('pincode')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">Submit Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
