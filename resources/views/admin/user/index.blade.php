@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>User List</h2>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-2">Add User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

     <table class="table table-bordered table-striped" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->mobile_number }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role ? $user->role->role_name : 'N/A'}}</td>
            <td>
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="5" class="text-center">No Users Found</td></tr>
        @endforelse
        </tbody>
     </table>
</div>

@endsection

@section('scripts')
  @include('partials.datatables')
@endsection
