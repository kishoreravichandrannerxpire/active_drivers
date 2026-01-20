<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center">
    <div class="row w-100 shadow rounded overflow-hidden">

        <!-- CUSTOMER SIDE -->
        <div class="col-md-6 bg-white p-5 text-center border-end">
            <h3 class="mb-3">Customer</h3>
            <p class="text-muted mb-4">
                Book services, manage orders, track history.
            </p>

            <button class="btn btn-outline-primary w-100"
                    onclick="setRole('customer')">
                Register as Customer
            </button>
        </div>

        <!-- DRIVER SIDE -->
        <div class="col-md-6 bg-dark text-white p-5 text-center">
            <h3 class="mb-3">Driver</h3>
            <p class="text-muted mb-4">
                Accept jobs, manage trips, track earnings.
            </p>

            <button class="btn btn-outline-light w-100"
                    onclick="setRole('driver')">
                Register as Driver
            </button>
        </div>

    </div>
</div>

<!-- REGISTRATION FORM (COMMON) -->
<div class="container mt-5" id="registerForm" style="display:none;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Create Account</h4>

                    <form action="{{ route('admin.customers.store') }}" method="POST">
                        @csrf

                        <!-- ROLE -->
                        <input type="hidden" name="role" id="role">

                        <div class="mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text"
                                   name="mobile_number"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email (optional)</label>
                            <input type="email"
                                   name="email"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Register
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setRole(role) {
        document.getElementById('role').value = role;
        document.getElementById('registerForm').style.display = 'block';
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
</script>

</body>
</html>
