@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Drivers List</h2>
        <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary mb-2">Add New Driver</a>
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
                <th>Last Name</th>
                <th>License No</th>
                <th>Image</th>
                <th>Experience</th>
                <th>Pincode</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($drivers as $driver)
            <tr>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->first_name }}</td>
                <td>{{ $driver->last_name }}</td>
                <td>{{ $driver->driver_license_number }}</td>
                <td>
                    @if($driver->driver_image)
                        <img src="{{ asset('storage/' . $driver->driver_image) }}" width="80" height="80" style="object-fit:cover;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $driver->total_experience_years }} years</td>
                <td>{{ $driver->pincode }}</td>
                <td><a href="{{ route('admin.availability.index', ['driver_id' => $driver->id]) }}" class="btn btn-sm btn-info">View Availability</a>
                    <a href="{{ route('admin.availability.create', ['driver_id' => $driver->id, 'source' => 'drivers']) }}" class="btn btn-sm btn-danger">Add Availability</a>
                 </td>
                <td>
                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">No Drivers Found</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
  @include('partials.datatables')
@endsection

