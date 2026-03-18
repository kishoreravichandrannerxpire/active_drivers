<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-4">Login</h4>

        <!-- LOGIN FORM -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <input type="hidden" name="from_location" value="{{ request('from_location', '') }}">
            <input type="hidden" name="to_location" value="{{ request('to_location', '') }}">

            <div class="mb-3">
                <label class="form-label">Mobile or Email</label>
                <input type="text" name="login" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100 mb-3">
                Login
            </button>
        </form>

        <div class="text-center">
            <small>
                Not yet registered?
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Click here
                </a>
            </small>
        </div>
    </div>
</div>

<!-- REGISTRATION MODAL -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- ROLE SELECTION -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-center d-block mb-3">
                        Select Your Role
                    </label>

                    <div class="row g-3">

                        <!-- CUSTOMER -->
                        <div class="col-12 col-md-6">
                            <label for="roleCustomer" class="border rounded p-3 d-flex align-items-center gap-3 h-100">
                                
                                <input type="radio" name="role" id="roleCustomer"
                                       value="customer"
                                       class="form-check-input"
                                       onchange="showRegisterForm()">

                                <i class="bi bi-person fs-4"></i>

                                <div>
                                    <div class="fw-semibold">Customer</div>
                                    <small class="text-muted">Book services & manage orders</small>
                                </div>

                            </label>
                        </div>

                        <!-- DRIVER -->
                        <div class="col-12 col-md-6">
                            <label for="roleDriver" class="border rounded p-3 d-flex align-items-center gap-3 h-100">
                                
                                <input type="radio" name="role" id="roleDriver"
                                       value="driver"
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
                </div>

                <!-- REGISTRATION FORM -->
                <form action="{{ route('signup.store') }}" method="POST"
                      id="registerForm"
                      class="card border-0 shadow-sm p-4 mx-auto"
                      style="display: none; max-width: 420px;">
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

                    <button type="submit" class="btn btn-success w-100">
                        Register
                    </button>
                </form>

            </div>

        </div>
    </div>
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