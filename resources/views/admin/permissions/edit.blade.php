@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Permission Update Form</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.permissions.update', $permissions->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Role *</label>
            <select name="roles_id" class="form-control">
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $permissions->roles_id == $role->id ? 'selected': ''}}> {{ $role->role_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <label class="form-label">Permission *</label>
            <input type="text" name="permission" class="form-control" value="{{ old('permission', $permissions->permission) }}" required>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Module *</label>
            <input type="text" name="module" class="form-control" value="{{ old('module', $permissions->module) }}" required>
        </div>
        <div class="col-sm-4">
            <label class="form-label">Effect *</label>
            <input type="text" name="effect" class="form-control" value="{{ old('effect', $permissions->effect) }}" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Permission</button>
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@endsection