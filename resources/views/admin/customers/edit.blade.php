@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Customer</h2>

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

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $customer->name) }}" required>
        </div>
        </div>

        <!-- Mobile Number -->
         <div class="mb-3 row">
        <div class="col-sm-4">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                   value="{{ old('mobile_number', $customer->mobile_number) }}" required>
        </div>
        </div>

        <!-- Password -->
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
</div>
@endsection