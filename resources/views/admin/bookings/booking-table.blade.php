<table class="table table-bordered table-striped" id="{{ $tableId ?? 'table' }}">
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
                <td> {{ !empty($booking->completed_date_time)
                ? \Carbon\Carbon::parse($booking->completed_date_time)->format('d-m-Y H:i')
                : 'N/A' }}</td>

                <td>₹{{ $booking->fare }}</td>

                <td>
                    {{ $booking->payment_status ? 'Paid' : 'Unpaid' }}
                </td>
                <td>
                    <span class="badge bg-{{ 
                        $booking->status == 'completed' ? 'success' :
                        ($booking->status == 'cancelled' ? 'danger' :
                        ($booking->status == 'accepted' ? 'info' : 'secondary'))
                    }}">
                        {{ ucfirst($booking->status) }}
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