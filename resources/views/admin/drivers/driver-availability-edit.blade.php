@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Edit Driver Availability</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.availability.update', $availability->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Driver -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Driver <span class="text-danger">*</span></label>
                <select name="drivers_id" class="form-control">
                    <option value="">Select Driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}"
                            {{ old('drivers_id', $availability->drivers_id) == $driver->id ? 'selected' : '' }}>
                            {{ $driver->first_name }}
                        </option>
                    @endforeach
                </select>
                @error('drivers_id')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <!-- Start Time -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">Start Time <span class="text-danger">*</span></label>
                <input type="datetime-local"
                       name="from_date_time"
                       value="{{ old('from_date_time', \Carbon\Carbon::parse($availability->from_date_time)->format('Y-m-d\TH:i')) }}"
                       class="form-control">
                @error('from_date_time')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <!-- End Time -->
            <div class="col-md-6 col-12 mb-3">
                <label class="form-label">End Time <span class="text-danger">*</span></label>
                <input type="datetime-local"
                       name="to_date_time"
                       value="{{ old('to_date_time', \Carbon\Carbon::parse($availability->to_date_time)->format('Y-m-d\TH:i')) }}"
                       class="form-control">
                @error('to_date_time')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('admin.availability.index') }}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>

@endsection