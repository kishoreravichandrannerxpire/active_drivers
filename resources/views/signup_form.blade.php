<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

    <!-- ROLE SELECTION -->
    <div class="mb-4 text-center">
        <label class="form-label fw-bold">Select Your Role</label>
        <div class="d-flex justify-content-center gap-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role"
                       value="customer" onchange="showRegisterForm()">
                <label class="form-check-label">
                     Customer (Book services & manage orders)
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="role"
                       value="driver" onchange="showRegisterForm()">
                <label class="form-check-label">
                    Driver (Accept jobs & track earnings)
                </label>
            </div>
        </div>
    </div>

    <!-- FORM -->
    <form action="{{ route('signup.store') }}" method="POST"
          id="registerForm" style="display:none;"
          class="card p-4 shadow mx-auto" style="max-width: 400px;">
        @csrf

        <input type="hidden" name="roles_id" id="rolesIdField">
        <input type="hidden" name="from_location" value="{{ request('from', '') }}">
        <input type="hidden" name="to_location" value="{{ request('to', '') }}">

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
