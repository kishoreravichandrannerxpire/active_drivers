@extends('layouts.app')
@section('content')
<h3>Manage Bookings</h3>
@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

@include('admin.bookings.booking-tabs')

@endsection