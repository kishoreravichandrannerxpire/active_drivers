@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <h2 class="float-start">Banners List</h2>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-2 mx-4 float-end">+ Add Banner</a>
        <a href="{{ route('admin.banners.view') }}" class="btn btn-secondary mb-2 float-end">View Banners</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td>{{ $banner->title }}</td>
                <td>{{ $banner->type }}</td>
                <td>
                    <span class="badge {{ $banner->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($banner->status) }}
                    </span>
                </td>
                <td>
                @if($banner->image)
                 <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text ?? 'Banner' }}" width="100">
                @else
                   No Image
                @endif
                </td>
                <td>
                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No banners found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div>
        {{ $banners->links() }}
    </div>
</div>

<!-- DataTables JS and CSS link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function () {
        if($('#table tbody tr').length > 1 || !$('#table tbody td').attr('colspan')) {
        $('#table').DataTable(
            {
                info: false,
            }
        );
    }
    });
</script>

@endsection
