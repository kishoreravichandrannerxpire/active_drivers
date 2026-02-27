@include('partials.links')
@include('partials.navbar')

<section class="py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 fw-semibold text-dark">Edit Car Details</h6>
                            <a href="{{ route('customer.mycars.index') }}" class="btn btn-light btn-sm">
                                Back
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success py-2 small">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('customer.mycars.update', $car->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                <!-- Car Model -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Car Model</label>
                                    <input type="text"
                                           name="car_model"
                                           value="{{ old('car_model', $car->car_model) }}"
                                           class="form-control form-control-sm"
                                           placeholder="Eg: Toyota Corolla">
                                    @error('car_model')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Car Type -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Car Type</label>
                                    <select name="car_type" class="form-select form-select-sm">
                                        <option value="">Select</option>
                                        <option value="Sedan-4" {{ old('car_type', $car->car_type) == 'Sedan-4' ? 'selected' : '' }}>Sedan (4-Seater)</option>
                                        <option value="Sedan-5" {{ old('car_type', $car->car_type) == 'Sedan-5' ? 'selected' : '' }}>Sedan (5-Seater)</option>
                                        <option value="SUV-5" {{ old('car_type', $car->car_type) == 'SUV-5' ? 'selected' : '' }}>SUV (5-Seater)</option>
                                        <option value="SUV-7" {{ old('car_type', $car->car_type) == 'SUV-7' ? 'selected' : '' }}>SUV (7-Seater)</option>
                                        <option value="MUV-7" {{ old('car_type', $car->car_type) == 'MUV-7' ? 'selected' : '' }}>MUV (7-Seater)</option>
                                        <option value="MUV-8" {{ old('car_type', $car->car_type) == 'MUV-8' ? 'selected' : '' }}>MUV (8-Seater)</option>
                                        <option value="Hatchback-4" {{ old('car_type', $car->car_type) == 'Hatchback-4' ? 'selected' : '' }}>Hatchback (4-Seater)</option>
                                        <option value="Hatchback-5" {{ old('car_type', $car->car_type) == 'Hatchback-5' ? 'selected' : '' }}>Hatchback (5-Seater)</option>
                                    </select>
                                    @error('car_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Car Number -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Car Number</label>
                                    <input type="text"
                                           name="car_number"
                                           value="{{ old('car_number', $car->car_number) }}"
                                           class="form-control form-control-sm"
                                           placeholder="Eg: TN 01 AB 1234">
                                    @error('car_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Transmission -->
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Transmission</label>
                                    <select name="transmission_type" class="form-select form-select-sm">
                                        <option value="">Select</option>
                                        <option value="Automatic" {{ old('transmission_type', $car->transmission_type) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Manual" {{ old('transmission_type', $car->transmission_type) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    </select>
                                </div>

                                <!-- Fuel Type -->
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Fuel Type</label>
                                    <select name="fuel_type" class="form-select form-select-sm">
                                        <option value="">Select</option>
                                        <option value="Petrol" {{ old('fuel_type', $car->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="Diesel" {{ old('fuel_type', $car->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Electric" {{ old('fuel_type', $car->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="Hybrid" {{ old('fuel_type', $car->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                    Update
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
    box-shadow: 0 0 0 0.15rem rgba(255, 193, 7, 0.35);
}
</style>