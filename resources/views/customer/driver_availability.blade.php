<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Availability</title>
    @include('partials.links')
    @include('partials.location_style')
    @include('partials.location_script')
</head>
<style>
    body{
        padding-top: 70px;
    }
</style>
<body>
    @include('partials.navbar')

   <div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body py-3 px-4">

            <form action="{{ route('customer.driver-availability') }}" method="POST">
                @csrf

                <div class="row g-2 align-items-end">

                    <!-- From -->
                    <div class="col-md">
                        <label class="form-label mb-1">From</label>
                        <input type="text" id="from_location" name="from_location"
                            class="form-control form-control-sm"
                            value="{{ old('from_location') }}" autocomplete="off" required>
                        <div id="from_suggestions" class="position-absolute w-100"></div>
                    </div>

                    <!-- To -->
                    <div class="col-md">
                        <label class="form-label mb-1">To</label>
                        <input type="text" id="to_location" name="to_location"
                            class="form-control form-control-sm"
                            value="{{ old('to_location') }}" autocomplete="off" required>
                        <div id="to_suggestions" class="position-absolute w-100"></div>
                    </div>

                    <!-- From Date -->
                    <div class="col-md">
                        <label class="form-label mb-1">From Date</label>
                        <input type="datetime-local" name="from_datetime"
                            class="form-control form-control-sm"
                            value="{{ old('from_datetime') }}" required>
                    </div>

                    <!-- To Date -->
                    <div class="col-md">
                        <label class="form-label mb-1">To Date</label>
                        <input type="datetime-local" name="to_datetime"
                            class="form-control form-control-sm"
                            value="{{ old('to_datetime') }}" required>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-auto d-flex gap-2">
                        <button type="button" id="resetBtn"
                            class="btn btn-secondary btn-sm px-3">
                            Reset
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>



    <div class="container mt-5 mb-5">
        <div class="card shadow p-4">
            <h2 class="mb-4">
                <i class="bi bi-car-front"></i> Driver Availability
            </h2>

            {{-- Filter Buttons --}}
            <div class="mb-4">
                <button id="showAllBtn" class="btn btn-primary me-2">
                    <i class="bi bi-list"></i> Show All Drivers
                </button>
                <button id="showAvailableBtn" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Show Available Drivers (Active)
                </button>
            </div>

            {{-- Drivers Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="driversTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Experience (Years)</th>
                            <th>Hill Experience</th>
                            <th>Luxury Car Experience</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="driverTableBody">
                        @forelse($drivers as $driver)
                            <tr class="driver-row" data-status="{{ $driver->status }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $driver->first_name }} {{ $driver->last_name }}</strong>
                                </td>
                                <td>{{ $driver->age ?? 'N/A' }}</td>
                                <td>
                                    @if($driver->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $driver->total_experience_years ?? 'N/A' }}</td>
                                <td>
                                    @if($driver->hill_experience === 1 || $driver->hill_experience == '1')
                                        Yes
                                    @elseif($driver->hill_experience === 0 || $driver->hill_experience == '0')
                                        No
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($driver->luxury_car_experience === 1 || $driver->luxury_car_experience == '1')
                                        Yes
                                    @elseif($driver->luxury_car_experience === 0 || $driver->luxury_car_experience == '0')
                                        No
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="tooltip">
                                        Confirm
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No drivers found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Summary Info --}}
            <div class="alert alert-info mt-4" id="summaryAlert">
                Total Drivers: <strong id="totalCount">{{ count($drivers) }}</strong> | 
                Active Drivers: <strong id="activeCount">{{ $drivers->where('status', 1)->count() }}</strong>
            </div>
        </div>
    </div>

    
    <!-- SCRIPTS -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Show All Drivers
            $('#showAllBtn').click(function() {
                $('.driver-row').show();
                updateSummary();
                $(this).addClass('active');
                $('#showAvailableBtn').removeClass('active');
            });

            // Show Available Drivers (Status = 1)
            $('#showAvailableBtn').click(function() {
                $('.driver-row').each(function() {
                    if($(this).data('status') == 1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                updateSummary();
                $(this).addClass('active');
                $('#showAllBtn').removeClass('active');
            });

            function updateSummary() {
                const totalVisible = $('.driver-row:visible').length;
                const activeVisible = $('.driver-row:visible[data-status="1"]').length;
                $('#totalCount').text(totalVisible);
                $('#activeCount').text(activeVisible);
            }

            // Reset form button
            $('#resetBtn').click(function() {
                $('#from_location, #to_location').val('');
                $('#from_suggestions, #to_suggestions').empty();
            });
        });
    </script>

    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .btn.active {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .card {
            border-radius: 10px;
            border: none;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
    </style>


</body>
</html>
