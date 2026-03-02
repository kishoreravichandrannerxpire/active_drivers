@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body">

        <h6 class="fw-semibold mb-3">Your Availability</h6>

        <table class="table align-middle" id="drivertable">
            <thead class="table-light">
                <!-- row with per-column search inputs -->
                <tr class="filters">
                    <th>
                        <input type="text" class="form-control form-control-sm" placeholder="Search Start">
                    </th>
                    <th>
                        <input type="text" class="form-control form-control-sm" placeholder="Search End">
                    </th>
                    <th></th>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>End</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($availabilities as $availability)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($availability->from_date_time)->format('d M Y, h:i A') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($availability->to_date_time)->format('d M Y, h:i A') }}
                        </td>
                        <td class="text-end">
                            <a href="#"
                               class="btn btn-sm btn-outline-primary edit-availability-btn"
                               data-id="{{ $availability->id }}"
                               data-from="{{ $availability->from_date_time }}"
                               data-to="{{ $availability->to_date_time }}"
                               data-update-url="{{ route('driver.availability.update', $availability) }}"
                               data-bs-toggle="modal"
                               data-bs-target="#editAvailabilityModal">
                                Edit
                            </a>

                            <form action="{{ route('driver.availability.destroy', $availability) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this availability?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No availability added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- edit modal form -->
<div class="modal fade" id="editAvailabilityModal" tabindex="-1" aria-labelledby="editAvailabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAvailabilityModalLabel">Edit Availability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editAvailabilityForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Start</label>
                        <input type="datetime-local" class="form-control form-control-lg" name="from_date_time" id="editFromDateTime" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">End</label>
                        <input type="datetime-local" class="form-control form-control-lg" name="to_date_time" id="editToDateTime" required>
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>  
            </form>
        </div>
    </div>            
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = document.getElementById('editAvailabilityModal');
            if (!editModal) return;

            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                if (!button) return;

                var from = button.getAttribute('data-from');
                var to = button.getAttribute('data-to');
                var updateUrl = button.getAttribute('data-update-url');

                function toLocalDateTime(val) {
                    if (!val) return '';
                    if (val.indexOf('T') !== -1) return val.slice(0,16);
                    var d = new Date(val);
                    if (isNaN(d)) return '';
                    var tzOffset = d.getTimezoneOffset()*60000;
                    var local = new Date(d - tzOffset);
                    return local.toISOString().slice(0,16);
                }

                document.getElementById('editFromDateTime').value = toLocalDateTime(from);
                document.getElementById('editToDateTime').value = toLocalDateTime(to);

                var form = document.getElementById('editAvailabilityForm');
                if (updateUrl) form.action = updateUrl;
            });
        });
    </script>