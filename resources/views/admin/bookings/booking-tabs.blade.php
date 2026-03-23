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
    @include('admin.bookings.booking-table', [
        'bookings' => $allBookings,
        'tableId' => 'allTable'
    ])
</div>

<!-- Today -->
<div class="tab-pane fade" id="today">
    @include('admin.bookings.booking-table', [
        'bookings' => $todayBookings,
        'tableId' => 'todayTable'
    ])
</div>

<!-- Completed -->
<div class="tab-pane fade" id="completed">
    @include('admin.bookings.booking-table', [
        'bookings' => $completedBookings,
        'tableId' => 'completedTable'
    ])
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // 1️⃣ Check URL hash first (#today, #completed)
    let hash = window.location.hash;

    if (hash) {
        let triggerEl = document.querySelector(`[data-bs-target="${hash}"]`);
        if (triggerEl) {
            new bootstrap.Tab(triggerEl).show();
        }
    } else {
        // 2️⃣ Otherwise check localStorage
        let activeTab = localStorage.getItem("activeTab");

        if (activeTab) {
            let triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (triggerEl) {
                new bootstrap.Tab(triggerEl).show();
            }
        }
    }

    // 3️⃣ Save tab when changed
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener("shown.bs.tab", function (event) {
            let target = event.target.getAttribute("data-bs-target");

            // Save to localStorage
            localStorage.setItem("activeTab", target);

            // Update URL without reload
            history.replaceState(null, null, target);
        });
    });

});
</script>