<style>

.navbar-overlay{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 10;
}

/* NAVBAR initial state */
#mainNavbar{
  transition: all 0.4s ease;
  background: transparent;
}

/* Default text color on banner */
#mainNavbar .nav-link,
#mainNavbar .navbar-brand{
  font-family: 'Poppins', sans-serif;
}

/* NAVBAR after scroll */
#mainNavbar.scrolled{
  background:#fff;
  box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* Text color switch after scroll */
#mainNavbar.scrolled .nav-link,
#mainNavbar.scrolled .navbar-brand{
  color:#333 !important;
}

.navbar-logo{
  height:120px;
  width:auto;
  object-fit:contain;
}

</style>

<body>
  
 <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-overlay navbar-brand" id="mainNavbar">
      <div class="container ">
           <a class="navbar-brand">
            <img src="{{ asset('storage/image/logo.png') }}" class="navbar-logo" alt="Active Drivers Logo">
          </a>
            @can('guest-home')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link ms-5" href="{{ route('home') }}">Home</a>
                <a class="nav-link ms-5" href="#services">Our Services</a>
                <a class="nav-link ms-5" href="{{ route('signup') }}">Sign Up</a>
                <a class="nav-link ms-5" href="{{ route('login') }}">Login</a>
            </div>
            @endcan

            @can('customer-home')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link ms-5" href="{{ route('customer.home') }}">Home</a>
                <a class="nav-link ms-5" href="{{ route('customer.mycars.index') }}">My Cars</a>
                <a class="nav-link ms-5" href="{{ route('customer.my-bookings') }}">My Bookings</a>
                <a class="nav-link ms-5" href="{{ route('customer.myprofile') }}">My Profile</a>
                 <form method="POST" action="{{ route ('logout') }}" class="ms-5">
                    @csrf
                    <button class="btn nav-link p-0">Logout</button>
                </form>
            </div>
            @endcan

            @can('isDriver')
            <div class="ms-auto d-flex align-items-center">
                <a class="nav-link ms-5" href="{{ route('driver.home') }}">Home</a>
                <a class="nav-link ms-5" href="{{ route('driver.my-trip') }}">My Trip</a>
                <a class="nav-link ms-5" href="{{ route('driver.profile') }}">Profile</a>
                 <form method="POST" action="{{ route ('logout') }}" class="ms-5">
                    @csrf
                    <button class="btn nav-link p-0">Logout</button>
                </form>
            </div>
            @endcan
        </div>
    </nav>

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
