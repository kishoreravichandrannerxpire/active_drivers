<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            width: 220px;
        }
        /* Hide sidebar on small screens */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar (visible on desktop) -->
        <div class="sidebar bg-secondary text-white p-3 d-none d-lg-block">
           <h4> <a class="nav-link text-white mb-4" href="{{ url('customer/dashboard') }}">Dashboard</a> </h4>
            <ul class="nav flex-column">
                @can('customer')
                <li>
                    <a class="nav-link text-white" href="{{ url('admin/customers') }}"> Customers</a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{ url('customer/cars') }}"> Cars</a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{url('customer/bookings')}}">Bookings</a>
                </li>
                 @endcan
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                <div class="container-fluid">
                    <!-- Sidebar toggle button (only on mobile) -->
                    <button class="navbar-toggler d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"><span class="navbar-toggler-icon"></span> </button>

                    <a class="navbar-brand" href="{{ url('home/customer') }}">Active Drivers</a>
                    <a class="navbar-brand" href="{{ url('customer/logout') }}">Logout</a>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Offcanvas Sidebar (for mobile) -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Dashboard</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                @can('customer')
                <li>
                    <a class="nav-link text-white" href="{{ url('admin/customers') }}"> Customers</a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{ url('admin/cars') }}"> Cars</a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{url('admin/bookings')}}">Bookings</a>
                </li>
                @endcan
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@yield('scripts')
