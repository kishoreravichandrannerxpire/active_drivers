@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Customer</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- First Name -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name"
                       value="{{ old('first_name', $customer->first_name) }}">
             @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <!-- Last Name -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name"
                       value="{{ old('last_name', $customer->last_name) }}">
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                       value="{{ old('email', $customer->user->email ?? '') }}">
            </div>

            <!-- Mobile Number -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile_number"
                       value="{{ old('mobile_number', $customer->user->mobile_number ?? '') }}">
             @error('mobile_number')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="row">
            <!-- Password -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Password (leave blank to keep old)</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Customer
        </button>
    </form>
</div>
@endsection