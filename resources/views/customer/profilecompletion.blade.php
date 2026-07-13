<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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
            <div class="col-md-6">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold text-center mb-4">Complete Your Profile</h4>

                        <form method="POST" action="{{ route('customer.profile.update', $customer->id) }}">
                            @csrf

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $customer->mobile_number) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="car_model" class="form-label">Car Model</label>
                                <input type="text" class="form-control" id="car_model" name="car_model" value="{{ old('car_model', $customer->car_model) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="car_type" class="form-label">Car Type</label>
                                <input type="text" class="form-control" id="car_type" name="car_type" value="{{ old('car_type', $customer->car_type) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="car_number" class="form-label">Car Number</label>
                                <input type="text" class="form-control" id="car_number" name="car_number" value="{{ old('car_number', $customer->car_number) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="insurance" class="form-label">Insurance</label>
                                <input type="text" class="form-control" id="insurance" name="insurance" value="{{ old('insurance', $customer->cars->first()->insurance ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="fastag" class="form-label">Fastag</label>
                                <input type="text" class="form-control" id="fastag" name="fastag" value="{{ old('fastag', $customer->cars->first()->fastag ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="transmission_type" class="form-label">Transmission Type</label>
                                <input type="text" class="form-control" id="transmission_type" name="transmission_type" value="{{ old('transmission_type', $customer->cars->first()->transmission_type ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type</label>
                                <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ old('fuel_type', $customer->cars->first()->fuel_type ?? '') }}">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Continue to Home</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
