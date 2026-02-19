<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<style>
    body{
        padding-top: 70px;
    }
</style>
<body>
    @include('partials.navbar')

    <div class="container mt-4">
        <div class="row">
    <div class="col-lg-6 col-12">
    <form action="{{ route('customer.driver-availability') }}" method="POST">
        @csrf

        @php
            $from = old('from', session('from_location', ''));
            $to = old('to', session('to_location', ''));
        @endphp

        <div class="row g-2 align-items-end">
            
            <div class="col">
                <label class="form-label">From *</label>
                <input type="text" id="customer_from" name="from" 
                       class="form-control" value="{{ $from }}" required>
            </div>

            <div class="col">
                <label class="form-label">To *</label>
                <input type="text" id="customer_to" name="to" 
                       class="form-control" value="{{ $to }}" required>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary" onclick="clearForm()">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
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

    <script>
        function redirectToLogin() {
            const from = document.getElementById('guest_from').value.trim();
            const to = document.getElementById('guest_to').value.trim();
            if (!from || !to) 
                { 
                    alert('Please fill both From and To');
                     return; 
                }
            window.location = '{{ route('login') }}?from=' + encodeURIComponent(from) + '&to=' + encodeURIComponent(to);
        }
        function clearForm() {
            document.getElementById('customer_from').value = '';
            document.getElementById('customer_to').value = '';
        }
    </script>
</body>
</html>
