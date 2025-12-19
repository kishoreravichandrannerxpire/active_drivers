<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  body {
  background-color: #08344dff; 
}
</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow p-4 text-white" style="background-color : rgb(12,12,46)">
        
        <h2 class="mb-4">Customer Signup Form</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.customers.store') }}" method="POST" class="form-responsive">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile Number *</label>
            <input type="tel" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" required pattern="[0-9]{10,15}" title="Please enter a valid mobile number">
        </div>

        <div class="mb-3">
  <label class="form-label">Password *</label>
  <div class="input-group">
    <input id="password" 
           type="password" 
           name="password" 
           class="form-control" 
           minlength="6"
           pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{6,}$"
           title="Password must be at least 6 characters long, include an uppercase letter, a number, and a special character."
           required>

  <!-- 👁️ Show/Hide button -->
    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
      <i class="bi bi-eye"></i>
    </button>
  </div>
  
  <!-- Bootstrap Progress Bar -->
  <div class="progress mt-2" style="height: 8px;">
    <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
  </div>
  
  <small id="strengthText" class="form-text text-white"></small>
</div>

        <div class="mb-3">
  <label class="form-label">Re-enter Password *</label>
  <input type="password" id="confirmPassword" name="confirm_password" class="form-control" required>
  <small id="matchMessage" class="form-text text-light"></small>
</div>
        <button type="submit" class="btn btn-success">Create Your Account</button>
    </form>

    </div>
</div>
<script>
const pwInput = document.getElementById('password');
const bar = document.getElementById('strengthBar');
const text = document.getElementById('strengthText');
const toggleBtn = document.getElementById('togglePassword');
const toggleIcon = toggleBtn.querySelector('i');

// Strength meter
pwInput.addEventListener('input', function() {
  const val = this.value;
  let strength = 0;

  if (val.length >= 6) strength += 25;
  if (/[A-Z]/.test(val)) strength += 25;
  if (/[0-9]/.test(val)) strength += 25;
  if (/[^A-Za-z0-9]/.test(val)) strength += 25;

  bar.style.width = strength + '%';

  if (strength <= 25) {
    bar.className = 'progress-bar bg-danger';
    text.textContent = 'Weak';
  } else if (strength <= 50) {
    bar.className = 'progress-bar bg-warning';
    text.textContent = 'Moderate';
  } else if (strength <= 75) {
    bar.className = 'progress-bar bg-info';
    text.textContent = 'Strong';
  } else {
    bar.className = 'progress-bar bg-success';
    text.textContent = 'Very Strong';
  }

  if (val.length === 0) {
    bar.style.width = '0%';
    bar.className = 'progress-bar';
    text.textContent = '';
  }
});

// Show/Hide Password
toggleBtn.addEventListener('click', () => {
  const isHidden = pwInput.type === 'password';
  pwInput.type = isHidden ? 'text' : 'password';
  toggleIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
});
</script>
<script>
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirmPassword");
  const matchMessage = document.getElementById("matchMessage");

  // Listen to typing in both fields
  confirmPassword.addEventListener("input", checkPasswordMatch);
  password.addEventListener("input", checkPasswordMatch);

  function checkPasswordMatch() {
    if (confirmPassword.value === "") {
      matchMessage.textContent = "";
      return;
    }

    if (password.value === confirmPassword.value) {
      matchMessage.textContent = "✅ Passwords match";
      matchMessage.style.color = "lightgreen";
    } else {
      matchMessage.textContent = "❌ Passwords do not match";
      matchMessage.style.color = "salmon";
    }
  }

  // Prevent form submission if passwords do not match
  document.querySelector('form').addEventListener('submit', function(e) {
    if (password.value !== confirmPassword.value) {
      matchMessage.textContent = "❌ Passwords do not match";
      matchMessage.style.color = "salmon";
      confirmPassword.focus();
      e.preventDefault();
    }
  });
</script>

</body>
</html>