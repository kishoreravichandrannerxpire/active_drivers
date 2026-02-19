<style>
  .carousel-item img {
    height: 630px;
    object-fit: cover;
}

.carousel-caption  {
    margin-bottom: 275px;
    color: #fff;
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
          <div class="carousel-caption d-none d-md-block text-center">
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