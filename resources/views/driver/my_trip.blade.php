@include('partials.links')
@include('partials.navbar')
<div class="container mt-4">
    <div class="card p-4">
        <h3>My Trips</h3>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
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
                            <td>{{ $booking->customer?->first_name ?? 'N/A' }} {{ $booking->customer?->last_name ?? '' }}</td>
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
                            <td colspan="9" class="text-center text-muted">No trips assigned yet.</td>
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