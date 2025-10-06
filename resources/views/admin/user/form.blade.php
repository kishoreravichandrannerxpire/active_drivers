@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>User Management</h2>

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

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <div class="col-sm-4">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        </div>

        <div class="mb-3">
            <div class="col-sm-4">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        </div>

        <div class="mb-3">
            <div class="col-sm-4">
            <label class="form-label">Role *</label>
            <select name="roles_id" class="form-control" value="{{ old('roles_id') }}" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('roles_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="mb-3">
            <div class="col-sm-4">
            <label class="form-label">Password *</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@endsection
