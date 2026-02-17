<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myprofile</title>
</head>
<body>
    @include('partials.links')
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
                        <span>{{ $customer->first_name }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Last Name</span>
                        <span>{{ $customer->last_name }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <span>{{ $customer->email }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Mobile Number</span>
                        <span>{{ $customer->mobile_number }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Car Model</span>
                        <span class="text-end">{{ $customer->car_model }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Car Type</span>
                        <span>{{ $customer->car_type }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Car Number</span>
                        <span>{{ $customer->car_number }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Insurance</span>
                        <span>{{ $customer->insurance }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Fastag</span>
                        <span>{{ $customer->fastag }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Transmission Type</span>
                        <span>{{ $customer->transmission_type }}</span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="text-muted">Fuel Type</span>
                        <span>{{ $customer->fuel_type }}</span>
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
                <form method="POST" action="{{ route('customer.profile.update', $customer->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $customer->mobile_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_model" class="form-label">Car Model</label>
                            <input type="text" class="form-control" id="car_model" name="car_model" value="{{ $customer->car_model }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_type" class="form-label">Car Type</label>
                            <input type="text" class="form-control" id="car_type" name="car_type" value="{{ $customer->car_type }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_number" class="form-label">Car Number</label>
                            <input type="text" class="form-control" id="car_number" name="car_number" value="{{ $customer->car_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="insurance" class="form-label">Insurance</label>
                            <input type="text" class="form-control" id="insurance" name="insurance" value="{{ $customer->cars->first()->insurance ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="fastag" class="form-label">Fastag</label>
                            <input type="text" class="form-control" id="fastag" name="fastag" value="{{ $customer->cars->first()->fastag ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="transmission_type" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" id="transmission_type" name="transmission_type" value="{{ $customer->cars->first()->transmission_type ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="fuel_type" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ $customer->cars->first()->fuel_type ?? '' }}">
                        </div>
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