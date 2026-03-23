<table class="table table-bordered table-striped" id="table">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Driver</th>
            <th>Car</th>
            <th>Pickup</th>
            <th>Drop</th>
            <th>Pickup Date & Time</th>
            <th>Completed Date & Time</th>
            <th>Fare</th>
            <th>Payment Status</th>
            <th>Journey Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>

                <td>{{ $booking->customer->first_name ?? 'N/A' }}</td>
                <td>{{ $booking->driver->first_name ?? 'N/A' }}</td>
                <td>{{ $booking->car->car_model ?? 'N/A' }}</td>

                <td>{{ $booking->pickup_location }}</td>
                <td>{{ $booking->drop_location }}</td>

                <td>{{ \Carbon\Carbon::parse($booking->pickup_date_time)->format('d-m-Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->completed_date_time)->format('d-m-Y H:i') }}</td>

                <td>₹{{ $booking->fare }}</td>

                <td>
                    {{ $booking->payment_status ? 'Unpaid' : 'Paid' }}
                </td>
                <td>
                    @php
                        $rawStatus = strtolower(trim($booking->status ?? ''));
                        $statusClass = 'secondary';

                        if ($rawStatus === 'completed') {
                            $statusClass = 'success';
                        } elseif ($rawStatus === 'cancelled') {
                            $statusClass = 'danger';
                        } elseif (in_array($rawStatus, ['accepted','confirmed'], true)) {
                            $statusClass = 'info';
                        } elseif ($rawStatus === 'pending') {
                            $statusClass = 'warning';
                        }
                    @endphp
                    <span class="badge bg-{{ $statusClass }}">
                        {{ $rawStatus ? ucfirst($rawStatus) : 'N/A' }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">No bookings found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@section('scripts')
  @include('partials.datatables')
@endsection