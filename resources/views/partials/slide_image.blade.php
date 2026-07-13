<style>

/* Wrapper */
.banner-wrapper {
    width: 100%;
    overflow: hidden;
}

/* Banner Image */
.banner-img,
.carousel-item img {
    height: 650px;
    object-fit: cover;
}

/* Carousel item */
.carousel-item {
    position: relative;
}

/* Overlay (merged both styles) */
.carousel-item::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.60); /* cleaner overlay */
}

/* Caption container */
.carousel-caption {
<<<<<<< HEAD
    bottom: 20%;
    text-align: center;
=======
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%); /* KEY */
    text-align: center;
    width: 100%;
    z-index: 2;
>>>>>>> b2f83b9 (fix admin portal all bookings)
}

/* Heading style */
.carousel-caption h1 {
    margin-bottom: 20px;
    font-family: 'Arial Black', Arial, sans-serif;
     background: linear-gradient(90deg, #ff810b, #f8fafc, #06032e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Optional paragraph text */
.carousel-caption p {
    font-family: 'Arial Black', Arial, sans-serif;
     background: linear-gradient(to top, #ff7c01, #f8fafc, #161436);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Responsive fix */
@media (max-width: 768px) {
<<<<<<< HEAD
    .banner-img,
    .carousel-item img {
        height: 400px;
=======
    .banner-img {
        height: 600px;
>>>>>>> b2f83b9 (fix admin portal all bookings)
    }

    .carousel-caption {
        bottom: 10%;
    }

    .carousel-caption h1 {
        font-size: 22px;
    }
}

</style>
<body>
   
       <div class="banner-wrapper">
     
    @if($banners->count())
    <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($banners as $index => $banner)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <img src="{{ asset('storage/' . $banner->image)}}" class="d-block w-100" alt="{{ $banner->title }}">
          <div class="carousel-caption text-center">
            <h1>{{ $banner->title }}</h1>
            <p>{{ $banner->description }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
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