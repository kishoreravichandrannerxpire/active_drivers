<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-4">

                    <h6 class="text-uppercase text-muted mb-1">
                        Availability
                    </h6>
                    <h5 class="fw-semibold mb-3">
                        Set Your Working Time
                    </h5>

                    <form method="POST" action="{{ route('driver.availability.store') }}">
                        @csrf

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label small text-muted">
                                    Start
                                </label>
                                <input type="datetime-local"
                                       class="form-control form-control-lg @error('from_date_time') is-invalid @enderror"
                                       name="from_date_time"
                                       value="{{ old('from_date_time') }}"
                                       required>

                                @error('from_date_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label small text-muted">
                                    End
                                </label>
                                <input type="datetime-local"
                                       class="form-control form-control-lg @error('to_date_time') is-invalid @enderror"
                                       name="to_date_time"
                                       value="{{ old('to_date_time') }}"
                                       required>

                                @error('to_date_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                Save Availability
                            </button>
                        </div>

                        <p class="text-muted small text-center mt-3 mb-0">
                            You can add multiple dates separately.
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>