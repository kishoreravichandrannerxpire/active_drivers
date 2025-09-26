@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Banner</h2>

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

    <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Title *</label>
            <input type="text" name="title" value="{{ $banner->title }}" class="form-control" required>
        </div>

        <div class="col-sm-4">
            <label class="form-label">Type *</label>
            <input type="text" name="type" value="{{ $banner->type }}" class="form-control" required>
        </div>

        <div class="col-sm-4">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $banner->description }}</textarea>
        </div>
        </div>

        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Current Image</label><br>
            @if($banner->image)
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" width="120">
            @endif
        </div>

        <div class="col-sm-4">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="col-sm-4">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" value="{{ $banner->alt_text }}" class="form-control">
        </div>

        <div class="col-sm-4">
            <label class="form-label">Link</label>
            <input type="url" name="link" value="{{ $banner->link }}" class="form-control">
        </div>
        </div>

        <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="form-label">Status *</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $banner->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Banner</button>
        <a href="{{ route('banners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
