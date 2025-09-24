@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Car</h2>

     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="customers_id" class="form-label">Customer</label>
            <select name="customers_id" id="customers_id" class="form-select">
                <option value="">-- Select Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customers_id', $car->customers_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="car_model" class="form-label">Car Model</label>
            <input type="text" class="form-control" placeholder="Eg: Toyota Corolla" id="car_model" name="car_model" value="{{ old('car_model', $car->car_model) }}">
        </div>
        <div class="mb-3">
            <label for="car_type" class="form-label">Car Type</label>
            <select name="car_type" id="car_type" class="form-select">
                <option value="">-- Select --</option>
                <option value="Sedan-4" {{ old('car_type', $car->car_type) == 'Sedan-4' ? 'selected' : '' }}>Sedan (4-Seater)</option>
                <option value="Sedan-5" {{ old('car_type', $car->car_type) == 'Sedan-5' ? 'selected' : '' }}>Sedan (5-Seater)</option>
                <option value="SUV-5" {{ old('car_type', $car->car_type) == 'SUV-5' ? 'selected' : '' }}>SUV (5-Seater)</option>
                <option value="SUV-7" {{ old('car_type', $car->car_type) == 'SUV-7' ? 'selected' : '' }}>SUV (7-Seater)</option>
                <option value="MUV-7" {{ old('car_type', $car->car_type) == 'MUV-7' ? 'selected' : '' }}>MUV (7-Seater)</option>
                <option value="MUV-8" {{ old('car_type', $car->car_type) == 'MUV-8' ? 'selected' : '' }}>MUV (8-Seater)</option>
                <option value="Hatchback-4" {{ old('car_type', $car->car_type) == 'Hatchback-4' ? 'selected' : '' }}>Hatchback (4-Seater)</option>
                <option value="Hatchback-5" {{ old('car_type', $car->car_type) == 'Hatchback-5' ? 'selected' : '' }}>Hatchback (5-Seater)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="car_number" class="form-label">Car Number</label>
            <input type="text" class="form-control" placeholder="Eg: TN 01 AB 1234" id="car_number" name="car_number" value="{{ old('car_number', $car->car_number) }}">
        </div>
        <div class="mb-3">
            <label for="insurance" class="form-label">Insurance</label>
            <select name="insurance" id="insurance" class="form-select">
                <option value="">-- Select --</option>
                <option value="1" {{ old('insurance', $car->insurance) == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('insurance', $car->insurance) == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fastag" class="form-label">Fastag</label>
            <select name="fastag" id="fastag" class="form-select">
                <option value="">-- Select --</option>
                <option value="1" {{ old('fastag', $car->fastag) == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('fastag', $car->fastag) == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="transmission_type" class="form-label">Transmission Type</label>
            <select name="transmission_type" id="transmission_type" class="form-select">
                <option value="">-- Select --</option>
                <option value="Automatic" {{ old('transmission_type', $car->transmission_type) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                <option value="Manual" {{ old('transmission_type', $car->transmission_type) == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fuel_type" class="form-label">Fuel Type</label>
            <select name="fuel_type" id="fuel_type" class="form-select">
                <option value="">-- Select --</option>
                <option value="Petrol" {{ old('fuel_type', $car->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="Diesel" {{ old('fuel_type', $car->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="Electric" {{ old('fuel_type', $car->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                <option value="Hybrid" {{ old('fuel_type', $car->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection