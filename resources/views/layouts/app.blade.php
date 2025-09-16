<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banner Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Active Drivers</a>
            <!-- <a class="nav-link text-white" href="{{ route('banners.index') }}">Banners</a> -->
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
