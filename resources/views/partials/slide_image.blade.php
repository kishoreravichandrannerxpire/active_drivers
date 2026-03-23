<style>
/* Wrapper */
.banner-wrapper {
    width: 100%;
    overflow: hidden;
}

/* Banner Image */
.banner-img {
    height: 650px;
    object-fit: cover;
}

/* Dark overlay for better text visibility */
.carousel-item {
    position: relative;
}

.carousel-item::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

/* Caption Styling */
.carousel-caption {
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%); /* KEY */
    text-align: center;
    width: 100%;
    z-index: 2;
}

.carousel-caption h1 {
    font-size: 40px;
    font-weight: bold;
}

.carousel-caption p {
    font-size: 18px;
}

/* Indicators (Dots) */
.carousel-indicators {
    bottom: 20px;
}

.carousel-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #fff;
    opacity: 0.5;
    margin: 0 5px;
}

.carousel-indicators .active {
    opacity: 1;
    transform: scale(1.2);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .banner-img {
        height: 600px;
    }

    .carousel-caption {
        bottom: 10%;
        padding: 10px;
    }

    .carousel-caption h1 {
        font-size: 18px;
    }

    .carousel-caption p {
        font-size: 12px;
    }
}
  </style>
<body>

<div class="banner-wrapper">

@if($banners->count())
<div id="bannerCarousel"
     class="carousel slide carousel-fade"
     data-bs-ride="carousel"
     data-bs-interval="3000"
     data-bs-wrap="true">

    <!-- Slides -->
    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            
            <img src="{{ asset('storage/' . $banner->image) }}" 
                 class="d-block w-100 banner-img" 
                 alt="{{ $banner->title }}">

            <!-- Caption -->
            <div class="carousel-caption text-center">
                <h1>{{ $banner->title }}</h1>
                <p>{{ $banner->description }}</p>
            </div>

        </div>
        @endforeach
    </div>

    <!-- Bottom Dots -->
    <div class="carousel-indicators">
        @foreach($banners as $index => $banner)
        <button type="button"
                data-bs-target="#bannerCarousel"
                data-bs-slide-to="{{ $index }}"
                class="{{ $index == 0 ? 'active' : '' }}"
                aria-current="{{ $index == 0 ? 'true' : 'false' }}">
        </button>
        @endforeach
    </div>

</div>
@endif

</div>

</body>
</html>