<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">
            <i class="bi bi-list-task"></i>
            All Bookings
            <span class="badge bg-primary">{{ $allCount }}</span>
        </button>
    </li>

    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#today">
            <i class="bi bi-calendar-event"></i>
            Today's Bookings
            <span class="badge bg-warning">{{ $todayCount }}</span>
        </button>
    </li>

    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed">
            <i class="bi bi-check-circle"></i>
            Completed
            <span class="badge bg-success">{{ $completedCount }}</span>
        </button>
    </li>
</ul>

<div class="tab-content mt-3">

    <!-- All -->
    <div class="tab-pane fade show active" id="all">
        @include('admin.bookings.booking-table', ['bookings' => $allBookings])
    </div>

    <!-- Today -->
    <div class="tab-pane fade" id="today">
        @include('admin.bookings.booking-table', ['bookings' => $todayBookings])
    </div>

    <!-- Completed -->
    <div class="tab-pane fade" id="completed">
        @include('admin.bookings.booking-table', ['bookings' => $completedBookings])
    </div>

</div>
