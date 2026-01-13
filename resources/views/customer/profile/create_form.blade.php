<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container mt-4">
        <h2>Customer Form</h2>

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

    <form action="{{ route('customer.profile.store') }}" method="POST">
        @csrf
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        </div>
        
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Mobile Number *</label>
            <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" required>
        </div>
        </div>

        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Password *</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Customer</button>
    </form>
    </div>
    @endsection
</body>
</html>