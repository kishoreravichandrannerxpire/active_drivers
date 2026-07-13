@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Customer Form</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- First Name -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ old('first_name') }}">
                       @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <!-- Last Name -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ old('last_name') }}">
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}">
            </div>

            <!-- Phone Number -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="mobile_number" class="form-control"
                       value="{{ old('mobile_number') }}">
                          @error('mobile_number')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="row">
            <!-- Password -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control">
                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Create Customer
        </button>
    </form>
</div>
@endsection
