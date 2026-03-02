@include('partials.links')
@include('partials.navbar')

<!-- Add Car Modal -->
<div class="modal fade" id="addCarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent">

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <!-- Card Header -->
                <div class="card-header bg-white border-0 text-center py-4 position-relative">
                    <button type="button"
                            class="btn-close position-absolute end-0 top-0 m-3"
                            data-bs-dismiss="modal"></button>

                    <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                        <i class="bi bi-car-front-fill"></i>
                    </div>

                    <h5 class="fw-bold mb-1">Add New Car</h5>
                    <small class="text-muted">Enter your vehicle details below</small>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('customer.mycars.store') }}" method="POST">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">

                            <!-- Car Model -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Car Model</label>
                                <input type="text"
                                       name="car_model"
                                       value="{{ old('car_model') }}"
                                       class="form-control form-control-sm"
                                       placeholder="Eg: Toyota Corolla"
                                       required>
                            </div>

                            <!-- Car Number -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Car Number</label>
                                <input type="text"
                                       name="car_number"
                                       value="{{ old('car_number') }}"
                                       class="form-control form-control-sm text-uppercase"
                                       placeholder="TN 01 AB 1234"
                                       required>
                            </div>

                            <!-- Car Type -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Car Type</label>
                                <select name="car_type"
                                        class="form-select form-select-sm"
                                        required>
                                    <option value="">Select Car Type</option>
                                    <option value="Sedan (4-Seater)" {{ old('car_type')=='Sedan (4-Seater)'?'selected':'' }}>Sedan (4-Seater)</option>
                                    <option value="SUV (5-Seater)" {{ old('car_type')=='SUV (5-Seater)'?'selected':'' }}>SUV (5-Seater)</option>
                                    <option value="SUV (7-Seater)" {{ old('car_type')=='SUV (7-Seater)'?'selected':'' }}>SUV (7-Seater)</option>
                                    <option value="Hatchback (5-Seater)" {{ old('car_type')=='Hatchback (5-Seater)'?'selected':'' }}>Hatchback (5-Seater)</option>
                                </select>
                            </div>

                            <!-- Transmission -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Transmission</label>
                                <select name="transmission_type"
                                        class="form-select form-select-sm"
                                        required>
                                    <option value="">Select Transmission</option>
                                    <option value="Manual" {{ old('transmission_type')=='Manual'?'selected':'' }}>Manual</option>
                                    <option value="Automatic" {{ old('transmission_type')=='Automatic'?'selected':'' }}>Automatic</option>
                                </select>
                            </div>

                            <!-- Fuel -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Fuel Type</label>
                                <select name="fuel_type"
                                        class="form-select form-select-sm"
                                        required>
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" {{ old('fuel_type')=='Petrol'?'selected':'' }}>Petrol</option>
                                    <option value="Diesel" {{ old('fuel_type')=='Diesel'?'selected':'' }}>Diesel</option>
                                    <option value="Electric" {{ old('fuel_type')=='Electric'?'selected':'' }}>Electric</option>
                                </select>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button"
                                    class="btn btn-light btn-sm"
                                    data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit"
                                    class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-check-circle"></i> Add Car
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<style>
    .icon-circle {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.card {
    border-radius: 18px;
}

.form-control,
.form-select {
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.form-control:focus,
.form-select:focus {
    box-shadow: none;
    border-color: #0d6efd;
}
</style>