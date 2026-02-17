<style>
.navbar-overlay {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 10;
}

.carousel-item img {
    height: 630px;
    object-fit: cover;
}
/* NAVBAR initial state */
#mainNavbar {
  transition: all 0.4s ease;
  background: transparent;
  
}
/* NAVBAR after scroll */
#mainNavbar.scrolled {
  background: #fff;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}
/* Text color switch */
#mainNavbar.scrolled .nav-link,
#mainNavbar.scrolled .navbar-brand {
  color: #333 !important;
}

#mainNavbar.scrolled .btn {
  border-color: #333;
  color: #333;
}

.carousel-caption  {
    margin-bottom: 275px;
    color: #fff;
}
</style>

<body>
 <div class="banner-wrapper">
  
 <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-overlay navbar-brand" id="mainNavbar">
      <div class="container ">
            <h2 class="text-dark fw-bold m-0">ACTIVE DRIVERS</h2>
            @can('guest-home')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link text-dark ms-5" href="#">Home</a>
                <a class="nav-link text-dark ms-5" href="#">Our Services</a>
                <a class="nav-link text-dark ms-5" href="{{ route('signup') }}">Sign Up</a>
                <a class="nav-link text-dark ms-5" href="{{ route('login') }}">Login</a>
            </div>
            @endcan

            @can('customer-home')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link text-dark ms-5" href="#">Home</a>
                <a class="nav-link text-dark ms-5" href="#">My Bookings</a>
                <a class="nav-link text-dark ms-5" href="{{ route('customer.myprofile') }}">My Profile</a>
                 <form method="POST" action="{{ route ('logout') }}" class="ms-5">
                    @csrf
                    <button class="btn nav-link text-dark p-0">Logout</button>
                </form>
            </div>
            @endcan

            @can('isDriver')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link text-dark ms-5" href="#">Home</a>
                <a class="nav-link text-dark ms-5" href="#">My Trip</a>
                <a class="nav-link text-dark ms-5" href="{{ route('driver.profile') }}">Profile</a>
                 <form method="POST" action="{{ route ('logout') }}" class="ms-5">
                    @csrf
                    <button class="btn nav-link text-dark p-0">Logout</button>
                </form>
            </div>
            @endcan
        </div>
    </nav>

    <!-- CAROUSEL -->

        @php
          $banners = \App\Models\Banner::where('status', 1)->get();
        @endphp
     @if($banners->count())
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $banner->image)}}"
                         class="d-block w-100"
                         alt="{{ $banner->title }}">
                         <div class="carousel-caption d-none d-md-block text-center">
                          <h1>{{ $banner->title }}</h1>
                          <p>{{ $banner->description }}</p>
                        </div>
                      </div>
                      @endforeach
                    </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
  </div>
@endif


</body>
<script>
  const navbar = document.getElementById("mainNavbar");
    window.addEventListener("scroll", () => {
    if (window.scrollY > 80) 
      {navbar.classList.add("scrolled");
      
    } else {
    navbar.classList.remove("scrolled");

    }

  });
</script>
