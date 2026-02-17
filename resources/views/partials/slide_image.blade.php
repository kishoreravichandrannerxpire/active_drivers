<style>
  .carousel-item img {
    width: 100%;      /* make image span full width */
    height: 450px;    /* fixed height */
    object-fit: cover; /* fills container, crops if needed */
  }
  </style>
<body>
   
        @php
          $banners = \App\Models\Banner::where('status', 1)->get();
        @endphp
     
    @if($banners->count())
    <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($banners as $index => $banner)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <img src="{{ asset('storage/' . $banner->image) }}"class="d-block w-100 "alt="{{ $banner->title }}" >
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