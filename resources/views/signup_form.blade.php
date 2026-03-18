<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <h2 class="text-center mb-4">Sign Up</h2>

<div class="mb-4">
    <label class="form-label fw-bold text-center d-block mb-3">
        Select Your Role
    </label>

    <div class="d-flex flex-column flex-md-row gap-3">

        <!-- CUSTOMER -->
        <label class="border rounded p-3 d-flex align-items-center gap-3 flex-fill">
            <input type="radio" name="role" value="customer"
                   class="form-check-input"
                   onchange="showRegisterForm()">

            <i class="bi bi-person fs-4"></i>

            <div>
                <div class="fw-semibold">Customer</div>
                <small class="text-muted">Book services & manage orders</small>
            </div>
        </label>

        <!-- DRIVER -->
        <label class="border rounded p-3 d-flex align-items-center gap-3 flex-fill">
            <input type="radio" name="role" value="driver"
                   class="form-check-input"
                   onchange="showRegisterForm()">

            <i class="bi bi-car-front fs-4"></i>

            <div>
                <div class="fw-semibold">Driver</div>
                <small class="text-muted">Accept jobs & track earnings</small>
            </div>
        </label>

    </div>
</div>

    <!-- FORM -->
    <form action="{{ route('signup.store') }}" method="POST"
          id="registerForm" style="display:none;"
          class=" card border-0 card shadow-sm p-4 mx-auto" style="max-width: 400px;">
        @csrf

        <input type="hidden" name="roles_id" id="rolesIdField">
        <input type="hidden" name="from_location" value="{{ request('from_location', '') }}">
        <input type="hidden" name="to_location" value="{{ request('to_location', '') }}">
        <input type="hidden" name="from_datetime" value="{{ request('from_datetime', '') }}">
        <input type="hidden" name="to_datetime" value="{{ request('to_datetime', '') }}">

        <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email (optional)</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Register</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function showRegisterForm() {
    const selectedRole = document.querySelector('input[name="role"]:checked');
    const form = document.getElementById('registerForm');
    const rolesIdField = document.getElementById('rolesIdField');

    if (!selectedRole) return;

    form.style.display = 'block';

    if (selectedRole.value === 'customer') {
        rolesIdField.value = 3;
    }

    if (selectedRole.value === 'driver') {
        rolesIdField.value = 2;
    }
}
</script>

</body>
</html>
