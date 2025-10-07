@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Cars List</h2>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-2">Add New Car</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Car Model</th>
                <th>Car Type</th>
                <th>Car Number</th>
                <th>Insurance</th>
                <th>Fastag</th>
                <th>Transmission Type</th>
                <th>Fuel Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->customer ? $car->customer->name : 'N/A' }}</td>
                <td>{{ $car->car_model }}</td>
                <td>{{ $car->car_type }}</td>
                <td>{{ $car->car_number }}</td>
                <td>{{ $car->insurance }}</td>
                <td>{{ $car->fastag }}</td>
                <td>{{ $car->transmission_type }}</td>
                <td>{{ $car->fuel_type }}</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No cars found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- DataTables JS and CSS link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function () {
        $('#table').DataTable(
            {
                info: false,
            }
        );
    });
</script>

@endsection