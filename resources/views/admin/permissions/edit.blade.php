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
            <select name="module" id="module" class="form-select">
    <option value="">--Select--</option>
    <option value="*" {{ old('module', $permissions->module ?? '') == '*' ? 'selected' : '' }}>*</option>
    <option value="show-own-profile" {{ old('module', $permissions->module ?? '') == 'show-own-profile' ? 'selected' : '' }}>Show-own-profile</option>
    <option value="create-own-profile" {{ old('module', $permissions->module ?? '') == 'create-own-profile' ? 'selected' : '' }}>Create-own-profile</option>
    <option value="edit-own-profile" {{ old('module', $permissions->module ?? '') == 'edit-own-profile' ? 'selected' : '' }}>Edit-own-profile</option>
    <option value="show-own-car" {{ old('module', $permissions->module ?? '') == 'show-own-car' ? 'selected' : '' }}>Show-own-car</option>
    <option value="create-own-car" {{ old('module', $permissions->module ?? '') == 'create-own-car' ? 'selected' : '' }}>Create-own-car</option>
    <option value="edit-own-car" {{ old('module', $permissions->module ?? '') == 'edit-own-car' ? 'selected' : '' }}>Edit-own-car</option>
    <option value="show-journey" {{ old('module', $permissions->module ?? '') == 'show-journey' ? 'selected' : '' }}>Show-journey</option>
    <option value="create-journey" {{ old('module', $permissions->module ?? '') == 'create-journey' ? 'selected' : '' }}>Create-journey</option>
    <option value="edit-journey" {{ old('module', $permissions->module ?? '') == 'edit-journey' ? 'selected' : '' }}>Edit-journey</option>
</select>

        </div>
        <div class="col-sm-4">
            <label class="form-label">Effect *</label>
             <select name="effect" id="effect" class="form-select">
                <option value="">--Select--</option>
                <option value="1" {{old('effect', $permissions->effect ?? '') == '1' ? 'selected' : '' }}>Allow</option>
                <option value="0" {{old('effect', $permissions->effect ?? '') == '0' ? 'selected' : '' }}>Deny</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Permission</button>
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@endsection