@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Driver Availability List</h2>
        <a href="{{ route('admin.availability.create') }}" class="btn btn-primary mb-2">Add Driver Availability</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($drivers as $driver)
            <tr>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->driver->first_name }}</td>
                <td>{{ $driver->from_date_time }}</td>
                <td>{{ $driver->to_date_time }}</td>
                <td>
                    <a href="{{ route('admin.availability.edit', $driver->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.availability.destroy', $driver->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">No driver availability found.</td>
            </tr>
        @endforelse
    </table>
</div>

@endsection

@section('scripts')
  @include('partials.datatables')
@endsection