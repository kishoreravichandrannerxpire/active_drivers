@include('partials.links')
@include('partials.navbar')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Cars</h2>
        <a href="{{ route('customer.mycars.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Add New Car
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse($cars as $car)
            <div class="col-lg-4 col-md-6">
                <div class="card car-card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <!-- Car Title -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">
                                {{ $car->car_model }}
                            </h5>
                            <span class="badge bg-dark">
                                {{ $car->car_number }}
                            </span>
                        </div>

                        <!-- Car Details -->
                        <ul class="list-unstyled small text-muted mb-4">
                            <li><i class="bi bi-car-front me-2"></i> {{ $car->car_type }}</li>
                            <li><i class="bi bi-gear me-2"></i> {{ $car->transmission_type }}</li>
                            <li><i class="bi bi-fuel-pump me-2"></i> {{ $car->fuel_type }}</li>
                        </ul>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('customer.mycars.edit', $car->id) }}"
                               class="btn btn-outline-secondary btn-sm w-50 me-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('customer.mycars.destroy', $car->id) }}"
                                  method="POST" class="w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this car?')"
                                        class="btn btn-outline-danger btn-sm w-100">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center p-5">
                    <h5 class="fw-bold mb-3">No Cars Added Yet</h5>
                    <p class="text-muted">Start by adding your first car.</p>
                    <a href="{{ route('customer.mycars.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Car
                    </a>
                </div>
            </div>
        @endforelse
    </div>

</div>

<style>
    .car-card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.car-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.08);
}
</style>