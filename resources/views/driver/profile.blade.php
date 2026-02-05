<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<body>
    @include('partials.navbar')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-semibold text-center mb-4">
                        My Profile
                    </h4>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">First Name</span>
                        <span>{{ $driver?->first_name }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Last Name</span>
                        <span>{{ $driver?->last_name }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Mobile Number</span>
                        <span>{{ $driver?->mobile_number }}</span>
                    </div>
                    
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <span>{{ $driver?->email }}</span>
                    </div>    

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Age</span>
                        <span>{{ $driver?->age }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span>{{ $driver?->status }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">License Number</span>
                        <span>{{ $driver?->driver_license_number }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Image</span>
                        <span>{{ $driver?->driver_image }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Total Experience Years</span>
                        <span>{{ $driver?->total_experience_years }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Hill Experience</span>
                        <span>{{ $driver?->hill_experience }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Accident History</span>
                        <span>{{ $driver?->accident_history }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Luxury Car Experience</span>
                        <span>{{ $driver?->luxury_car_experience }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Address</span>
                        <span>{{ $driver?->address }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Pincode</span>
                        <span>{{ $driver?->pincode }}</span>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="button" class="btn btn-outline-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            Edit Profile
                        </button>
                    </div>

                </div>
            </div>
        </div>
        </div>

        <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('driver.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $driver?->first_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $driver?->last_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', auth()->user()->mobile_number) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>    
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $driver?->age) }}" required>
                        </div>
                        <select name="status" class="form-control">
    <option value="1" {{ old('status',$driver?->status)==1?'selected':'' }}>Active</option>
    <option value="0" {{ old('status',$driver?->status)==0?'selected':'' }}>Inactive</option>
</select>

                        <div class="mb-3">
                            <label for="driver_license_number" class="form-label">Driver License Number</label>
                            <input type="text" class="form-control" id="driver_license_number" name="driver_license_number" value="{{ old('driver_license_number', $driver?->driver_license_number) }}" required>
                        </div>
                        <div class="mb-3">
    <label for="driver_image" class="form-label">Driver Image</label>

    <input type="file"
           class="form-control"
           id="driver_image"
           name="driver_image"
           accept="image/*">

    @if($driver?->driver_image)
        <small class="text-muted">
            Current: {{ $driver->driver_image }}
        </small>
    @endif
</div>

                        <div class="mb-3">
                            <label for="total_experience_years" class="form-label">Total Experience Years</label>
                            <input type="number" class="form-control" id="total_experience_years" name="total_experience_years" value="{{ old('total_experience_years', $driver?->total_experience_years) }}" required>
                        </div>
                        <div class="mb-3">
    <label for="hill_experience" class="form-label">Hill Experience</label>

    <select class="form-control" id="hill_experience" name="hill_experience">
        <option value="">-- Select --</option>

        <option value="1"
            {{ old('hill_experience', $driver?->hill_experience) == '1' ? 'selected' : '' }}>
            Yes
        </option>

        <option value="0"
            {{ old('hill_experience', $driver?->hill_experience) == '0' ? 'selected' : '' }}>
            No
        </option>
    </select>
</div>

                        <div class="mb-3">
    <label for="accident_history" class="form-label">Accident History</label>

    <select class="form-control" id="accident_history" name="accident_history">
        <option value="">-- Select --</option>

        <option value="1"
            {{ old('accident_history', $driver?->accident_history) == '1' ? 'selected' : '' }}>
            Yes
        </option>

        <option value="0"
            {{ old('accident_history', $driver?->accident_history) == '0' ? 'selected' : '' }}>
            No
        </option>
    </select>
</div>

                        <div class="mb-3">
    <label for="luxury_car_experience" class="form-label">Luxury Car Experience</label>

    <select class="form-control" id="luxury_car_experience" name="luxury_car_experience">
        <option value="">-- Select --</option>

        <option value="1"
            {{ old('luxury_car_experience', $driver?->luxury_car_experience) == '1' ? 'selected' : '' }}>
            Yes
        </option>

        <option value="0"
            {{ old('luxury_car_experience', $driver?->luxury_car_experience) == '0' ? 'selected' : '' }}>
            No
        </option>
    </select>
</div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $driver?->address) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode', $driver?->pincode) }}" required>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
                    

</body>
</html>