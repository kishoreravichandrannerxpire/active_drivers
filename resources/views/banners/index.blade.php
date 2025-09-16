@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Banners</h2>
        <a href="{{ route('banners.create') }}" class="btn btn-primary">+ Add Banner</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                    <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline">
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
@endsection
