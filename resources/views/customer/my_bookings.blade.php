@include('partials.links')
@include('partials.navbar')

<div class="container" style="margin-top:100px;">
     <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Bookings</h2>
        <a href="{{ route('customer.driver-availability') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Booking
</a>
    </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Driver</th>
                        <th>Car</th>
                        <th>Pickup</th>
                        <th>Drop</th>
                        <th>Pickup Time</th>
                        <th>Passengers</th>
                        <th>Fare</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->driver?->first_name ?? 'N/A' }} {{ $booking->driver?->last_name ?? '' }}</td>
                            <td>{{ $booking->car?->car_model ?? 'N/A' }}</td>
                            <td>{{ $booking->pickup_location }}</td>
                            <td>{{ $booking->drop_location }}</td>
                            <td>{{ optional($booking->pickup_date_time)->format('M d, Y @ h:i A') }}</td>
                            <td>{{ $booking->passengers }}</td>
                            <td>{{ $booking->fare ?? 'N/A' }}</td>
                            <td>{{ $booking->status ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">You have no bookings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    body {
    padding-top: 60px;
    }
</style>    