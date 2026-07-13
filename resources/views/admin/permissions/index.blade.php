@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Permission List</h2>
        <a href="{{route('admin.permissions.create') }}" class="btn btn-primary mb-2">Add Permission</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif

    <table class="table table-bordered table-stripped" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Module</th>
                <th>Effect</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->role ? $permission->role->role_name : 'N/A'}}</td>
                <td>{{ $permission->permission }}</td>
                <td>{{ $permission->module }}</td>
                <td>{{ $permission->effect ? 'Allow' : 'Deny'}}</td>
                <td>
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method ="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No permissions found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
  @include('partials.datatables')
@endsection
