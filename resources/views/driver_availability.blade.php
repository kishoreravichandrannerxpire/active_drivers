<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    #background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    #form {
        opacity: 0.9;
    }
</style>
<body class="bg-light" id="background">

<div class="container d-flex justify-content-center align-items-center mt-5">
    <div style="color:white">
        <h2 class="mb-4">Driver Availability</h2>

        {{-- ✅ Success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ❌ Error message --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- 🔔 Validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('availability.store') }}" method="POST" class="form-responsive" id="form">
            @csrf

            <!-- <div class="mb-3">
                <label for="drivers_id" class="form-label">Driver ID</label>
                <input type="number" name="drivers_id" id="drivers_id" class="form-control" required>
            </div> -->

            <div class="mb-3">
                <label for="available_date" class="form-label">Available Date</label>
                <input type="date" name="available_date" id="available_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark" style="color:white">Submit Availability</button>
        </form>
    </div>
</div>

</body>
</html>
