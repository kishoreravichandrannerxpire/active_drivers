<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile</title>
</head>

<body class="bg-light">

@include('partials.links')
@include('partials.navbar')

<div class="container py-5" style="margin-top:80px;">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


<div class="row justify-content-center">

<div class="col-lg-6 col-md-8">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-body p-5">

<div class="text-center mb-4">

<div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;">
<i class="bi bi-person fs-3"></i>
</div>

<h4 class="fw-bold mb-0">My Profile</h4>
<p class="text-muted small">Manage your personal information</p>

</div>


<hr class="mb-4">


<div class="d-flex justify-content-between mb-3">
<span class="text-muted">First Name</span>
<span class="fw-semibold">{{ $customer->first_name }}</span>
</div>

<div class="d-flex justify-content-between mb-3">
<span class="text-muted">Last Name</span>
<span class="fw-semibold">{{ $customer->last_name }}</span>
</div>

<div class="d-flex justify-content-between mb-3">
<span class="text-muted">Email</span>
<span class="fw-semibold">{{ $customer->email }}</span>
</div>

<div class="d-flex justify-content-between mb-4">
<span class="text-muted">Mobile Number</span>
<span class="fw-semibold">{{ $customer->mobile_number }}</span>
</div>


<hr class="mb-4">


<div class="d-grid gap-2">

<a href="{{ route('customer.mycars.index') }}" class="btn btn-dark rounded-pill">
<i class="bi bi-car-front"></i> View My Cars
</a>

<button class="btn btn-outline-primary rounded-pill"
data-bs-toggle="modal"
data-bs-target="#editProfileModal">

<i class="bi bi-pencil"></i> Edit Profile

</button>

</div>

</div>

</div>

</div>

</div>

</div>


<!-- Edit Profile Modal -->

<div class="modal fade" id="editProfileModal">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content rounded-4 border-0 shadow">

<div class="modal-header border-0">
<h5 class="modal-title fw-semibold">Edit Profile</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form method="POST" action="{{ route('customer.profile.update', $customer->id) }}">
@csrf

<div class="modal-body">

<div class="mb-3">
<label class="form-label">First Name</label>
<input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}" required>
</div>

<div class="mb-3">
<label class="form-label">Last Name</label>
<input type="text" class="form-control" name="last_name" value="{{ $customer->last_name }}" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
</div>

<div class="mb-3">
<label class="form-label">Mobile Number</label>
<input type="text" class="form-control" name="mobile_number" value="{{ $customer->mobile_number }}" required>
</div>

</div>

<div class="modal-footer border-0">

<button class="btn btn-secondary" data-bs-dismiss="modal">
Cancel
</button>

<button class="btn btn-primary">
Save Changes
</button>

</div>

</form>

</div>

</div>

</div>

</body>
</html>