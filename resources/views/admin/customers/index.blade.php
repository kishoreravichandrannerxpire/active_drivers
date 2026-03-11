@extends(Gate::allows('permissions') ? 'layouts.app' : 'layouts.customer')


@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Customers List</h2>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary mb-2">Add New Customer</a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Bookings</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->mobile_number }}</td>
                <td>{{ $customer->email }}</td>
                <td><a href="{{ route('admin.bookings.index', ['customer_id' => $customer->id]) }}" class="btn btn-sm btn-info">View Bookings</a></td>
                <td>
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No customers found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
  @include('partials.datatables')
@endsection
