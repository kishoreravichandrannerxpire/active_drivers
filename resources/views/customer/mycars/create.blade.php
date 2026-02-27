@include('partials.links')
@include('partials.navbar')

<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-3 p-lg-5">

                        {{-- Success Message --}}

                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-primary text-white mb-3">
                                <i class="bi bi-car-front-fill"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Add New Car</h4>
                            <p class="text-muted small mb-0">
                                Enter your vehicle details below
                            </p>
                        </div>

                        <form action="{{ route('customer.mycars.store') }}" method="POST">
                            @csrf

                            {{-- Validation Errors --}}
                            @if($errors->any())
                                <div class="alert alert-danger shadow-sm">
                                    <ul class="mb-0 small">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Car Model -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Car Model</label>
                                <input type="text"
                                       name="car_model"
                                       value="{{ old('car_model') }}"
                                       class="form-control form-control-lg"
                                       placeholder="Eg: Toyota Corolla"
                                       required>
                            </div>

                            <!-- Car Type -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Car Type</label>
                                <select name="car_type"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Car Type</option>
                                    <option value="Sedan (4-Seater)" {{ old('car_type')=='Sedan (4-Seater)'?'selected':'' }}>Sedan (4-Seater)</option>
                                    <option value="Sedan (5-Seater)" {{ old('car_type')=='Sedan (5-Seater)'?'selected':'' }}>Sedan (5-Seater)</option>
                                    <option value="SUV (5-Seater)" {{ old('car_type')=='SUV (5-Seater)'?'selected':'' }}>SUV (5-Seater)</option>
                                    <option value="SUV (7-Seater)" {{ old('car_type')=='SUV (7-Seater)'?'selected':'' }}>SUV (7-Seater)</option>
                                    <option value="MUV (7-Seater)" {{ old('car_type')=='MUV (7-Seater)'?'selected':'' }}>MUV (7-Seater)</option>
                                    <option value="MUV (8-Seater)" {{ old('car_type')=='MUV (8-Seater)'?'selected':'' }}>MUV (8-Seater)</option>
                                    <option value="Hatchback (4-Seater)" {{ old('car_type')=='Hatchback (4-Seater)'?'selected':'' }}>Hatchback (4-Seater)</option>
                                    <option value="Hatchback (5-Seater)" {{ old('car_type')=='Hatchback (5-Seater)'?'selected':'' }}>Hatchback (5-Seater)</option>
                                </select>
                            </div>

                            <!-- Car Number -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Car Number</label>
                                <input type="text"
                                       name="car_number"
                                       value="{{ old('car_number') }}"
                                       class="form-control form-control-lg text-uppercase"
                                       placeholder="TN 01 AB 1234"
                                       required>
                            </div>

                            <!-- Transmission -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Transmission Type</label>
                                <select name="transmission_type"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Transmission</option>
                                    <option value="Manual" {{ old('transmission_type')=='Manual'?'selected':'' }}>Manual</option>
                                    <option value="Automatic" {{ old('transmission_type')=='Automatic'?'selected':'' }}>Automatic</option>
                                </select>
                            </div>

                            <!-- Fuel -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Fuel Type</label>
                                <select name="fuel_type"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" {{ old('fuel_type')=='Petrol'?'selected':'' }}>Petrol</option>
                                    <option value="Diesel" {{ old('fuel_type')=='Diesel'?'selected':'' }}>Diesel</option>
                                    <option value="Electric" {{ old('fuel_type')=='Electric'?'selected':'' }}>Electric</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between gap-3">
                                <a href="{{ route('customer.mycars.index') }}"
                                   class="btn btn-light w-50">
                                    Back
                                </a>

                                <button type="submit"
                                        class="btn btn-primary w-50 shadow-sm">
                                    <i class="bi bi-check-circle"></i> Add Car
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin: 0 auto;
}

.card {
    border-radius: 18px;
}

.form-control:focus,
.form-select:focus {
    box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
}

</style>