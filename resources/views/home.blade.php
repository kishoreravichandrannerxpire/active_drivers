<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Drivers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-aW3DgN8w0M0JqTX4yTgjYlS1tFy1D1i6SHe0T6SmUhy9xOaXvjpx6vIikCqB7+/DbGhQmF3a2pDx8VzKjv1Cfw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
  new WOW().init();
</script>
 <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<style>
    .carousel-item img {
    width: 100%;      /* make image span full width */
    height: 400px;    /* fixed height */
    object-fit: cover; /* fills container, crops if needed */
}
</style>
<body>
    <div class="container-fluid text-white d-none d-lg-flex wow fadeIn" data-wow-delay="0.1s" style="background: rgb(12 ,12 ,46);">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                    <h2 class="text-white fw-bold m-0">ACTIVE DRIVERS</h2>
                <div class="ms-auto d-flex align-items-center">
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i>nerxpire@gmail.com</small>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i>+91 123456789</small>
                    <a href="" class="btn btn-outline-light ms-4">LOGIN</a>
                </div>
            </div>
        </div>
    </div>
@php
    $banners = \App\Models\Banner::where('status', 1)->get();
@endphp

@if($banners->count())
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $banner->image) }}" 
                     class="d-block w-100 img-fluid" 
                     alt="{{ $banner->title }}" >
            </div>
        @endforeach

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

    
</body>
</html>