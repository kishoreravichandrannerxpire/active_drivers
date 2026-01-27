<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-4">Login</h4>

        <!-- LOGIN FORM -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- ROLE SELECTION -->
                <div class="mb-4">
                    <label class="form-label">Select Your Role:</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="roleCustomer" 
                                   value="customer" required onchange="showRegisterForm()">
                            <label class="form-check-label" for="roleCustomer">
                                Customer (Book services & manage orders)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="roleDriver" 
                                   value="driver" required onchange="showRegisterForm()">
                            <label class="form-check-label" for="roleDriver">
                                Driver (Accept jobs & track earnings)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- REGISTRATION FORM -->
                <form action="{{ route('admin.user.store') }}" method="POST" id="registerForm" style="display: none;">
                    @csrf

                    <!-- Hidden field to store role_id based on selection -->
                    <input type="hidden" name="roles_id" id="rolesIdField" value="">

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
        if (selectedRole) {
            document.getElementById('registerForm').style.display = 'block';
            // Set roles_id: 3 for customer, 2 for driver
            const rolesIdField = document.getElementById('rolesIdField');
            if (selectedRole.value === 'customer') {
                rolesIdField.value = '3';
            } else if (selectedRole.value === 'driver') {
                rolesIdField.value = '2';
            }
        }
    }
</script>

</body>
</html>
