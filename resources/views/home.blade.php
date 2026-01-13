<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Drivers</title>
   
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"integrity="sha512-aW3DgN8w0M0JqTX4yTgjYlS1tFy1D1i6SHe0T6SmUhy9xOaXvjpx6vIikCqB7+/DbGhQmF3a2pDx8VzKjv1Cfw=="crossorigin="anonymous"referrerpolicy="no-referrer">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
     <script> new WOW().init(); </script>
 <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
 
  <style>
  .carousel-item img {
    width: 100%;      /* make image span full width */
    height: 400px;    /* fixed height */
    object-fit: contain; /* fills container, crops if needed */
  }
  </style>
  <body>
    <nav class="nav-responsive">
     <div class="container-fluid text-white wow fadeIn" data-wow-delay="0.1s" style="background: rgb(12 ,12 ,46);">
      <div class="container py-3">
        <div class="d-flex align-items-center">
          <h2 class="text-white fw-bold m-0">ACTIVE DRIVERS</h2>
          <div class="ms-auto d-flex align-items-center">
            <!-- hide content info on small screens-->
            <div class ="d-none d-lg-flex menu-links">
              <small class="nav-link-custom ms-4">Home</small>
              <small class="nav-link-custom ms-4">My Bookings</small>
            </div>
            <!-- Always visible -->
            <a href="{{url ('admin/login') }}" class="btn btn-outline-light ms-4">LOGIN</a>
          </div>
        </div>
      </div>
    </div>
   </nav>
    <div>
    <!-- Carousel Image -->
    @include('partials.slide_image')
    </div>
    
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6 border-end">
          {{-- Left form --}}
          @include('driver_availability')
      </div>
      <div class="col-md-6">
         {{-- Right form --}}
         @include('customer_availability')
      </div>
    </div>
  </div>
 
  <div class="text-center my-5" style="font-family: Arial, sans-serif; color: #ff8801ff; ">
    <h1>OUR SERVICES</h1>
    <div class="container mt-4">
      <div class="row row-cols-1 row-cols-md-2 g-4" >
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Acting Driver</h5> <hr>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
       
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">24 Hours Service</h5> <hr>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
       
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Available Drivers</h5> <hr>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
       
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5> <hr>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  @extends('partials.footer')
</body>
</html>
 
 