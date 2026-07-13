@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Banner</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<span class="badge {{ $banner->status ? 'bg-success' : 'bg-secondary' }}">
    {{ $banner->status ? 'Active' : 'Inactive' }}
</span>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="col-sm-4">
            <label class="form-label">Type *</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="col-sm-4">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        </div>

        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="col-sm-4">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control">
        </div>

        <div class="col-sm-4">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control">
        </div>
        </div>

        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Status *</label>
            <select name="status" class="form-control" required>
                <option value="">---select---</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        </div>

        <button type="submit" class="btn btn-success">Save Banner</button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
