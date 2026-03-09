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

            <form action="{{ url('/customer/driver-availability') }}" method="POST">
                @csrf

                <div class="row g-2 align-items-end">

                    <!-- From -->
                    <div class="col-md">
                        <label class="form-label mb-1">From</label>
                        <input type="text" id="from_location" name="from_location"
                            class="form-control form-control-sm"
                            value="{{ request('from_location') ?? old('from_location') }}" autocomplete="off" required>
                        <div id="from_suggestions" class="position-absolute w-100"></div>
                    </div>

                    <!-- To -->
                    <div class="col-md">
                        <label class="form-label mb-1">To</label>
                        <input type="text" id="to_location" name="to_location"
                            class="form-control form-control-sm"
                            value="{{ request('to_location') ?? old('to_location') }}" autocomplete="off" required>
                        <div id="to_suggestions" class="position-absolute w-100"></div>
                    </div>

                    <!-- From Date -->
                    <div class="col-md">
                        <label class="form-label mb-1">From Date</label>
                        <input type="datetime-local" id="from_datetime" name="from_datetime"
                            class="form-control form-control-sm"
                            value="{{ request('from_datetime') ?? old('from_datetime') }}" autocomplete="off" required>
                    </div>

                    <!-- To Date -->
                    <div class="col-md">
                        <label class="form-label mb-1">To Date</label>
                        <input type="datetime-local" id="to_datetime" name="to_datetime"
                            class="form-control form-control-sm"
                            value="{{ request('to_datetime') ?? old('to_datetime') }}" autocomplete="off" required>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            Search
                        </button>
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
                <i class="bi bi-car-front"></i> Available Drivers
            </h2>

            {{-- Show search criteria if form was submitted --}}
            @php
                $fromDisplay = request('from_datetime') ?? old('from_datetime');
                $toDisplay = request('to_datetime') ?? old('to_datetime');
            @endphp
            @if($fromDisplay && $toDisplay)
                <div class="alert alert-info mb-4" role="alert">
                    <strong>Search Results:</strong> Showing drivers available from 
                    <strong>{{ \Carbon\Carbon::parse($fromDisplay)->format('M d, Y @ h:i A') }}</strong> 
                    to 
                    <strong>{{ \Carbon\Carbon::parse($toDisplay)->format('M d, Y @ h:i A') }}</strong>
                </div>
            @endif

            {{-- Drivers Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="driversTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
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
                                    @php
                                        $query = http_build_query([
                                            'driver_id' => $driver->id,
                                            'from_location' => request('from_location'),
                                            'to_location' => request('to_location'),
                                            'from_datetime' => request('from_datetime'),
                                            'to_datetime' => request('to_datetime'),
                                        ]);
                                    @endphp
                                    <a href="{{ url('/customer/booking') }}?{{ $query }}" class="btn btn-sm btn-info">
                                        Confirm
                                    </a>
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

        </div>
    </div>

    
    <!-- SCRIPTS -->
    <script>

            // Reset form button
            $('#resetBtn').click(function() {
                $('#from_location, #to_location, #from_datetime, #to_datetime').val('');
                $('#from_suggestions, #to_suggestions, #from_datetime, #to_datetime').empty();
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
