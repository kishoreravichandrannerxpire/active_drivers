<style>

.navbar-overlay{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 10;
}

/* Navbar Glass Style */
#mainNavbar{
  transition: all 0.4s ease;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

/* Navbar after scroll */
#mainNavbar.scrolled{
  background: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(12px);
  box-shadow:0 8px 25px rgba(0,0,0,0.1);
}

/* Text style */
#mainNavbar .nav-link,
#mainNavbar .navbar-brand{
  font-family:'Poppins', sans-serif;
  font-weight:600;
  color:#333 !important;
}

/* Logo */
.navbar-logo{
  height:80px;
  width:auto;
  object-fit:contain;
}

/* Mobile auth links */
.mobile-auth-links{
  display:flex;
  align-items:center;
}

.mobile-auth-links a{
  color:#333;
  font-size:14px;
  font-weight:500;
  text-decoration:none;
  /* border:1px solid #ff7a00;
  padding:3px 8px;
  border-radius:6px; */
}

.mobile-auth-links a:first-child{
  color:#333;
}

.mobile-auth-links .btn{
  background:#ff7a00;
  color:#fff !important;
  padding:5px 10px;
  border-radius:6px;
  font-size:13px;
  border:none;
}

/* Fix click / focus issue */
.mobile-auth-links .btn:focus,
.mobile-auth-links .btn:active{
  background:#ff7a00 !important;
  color:#fff !important;
  border:none !important;
  box-shadow:0 0 0 3px rgba(255,122,0,0.3);;
}

.mobile-auth-links .btn:hover{
  background:#e56f00;
  color:#fff;
}

/* Hamburger button */
.navbar-toggler{
  border:2px solid #333;
  padding:6px 10px;
  border-radius:8px;
  margin-right:15px;
}

/* Mobile adjustments */
@media (max-width:991px){

.navbar-logo{
  height:70px;
}

#navbarMenu{
  margin-top:10px;
  border-radius:12px;
  padding:10px 0;
}

.navbar-nav .nav-link{
  padding:14px 20px;
  font-size:16px;
  font-weight:500;
  color:#333 !important;
}

.navbar-nav .nav-link:hover{
  background:#f8f9fa;
}

}

</style>

<body>

<nav class="navbar navbar-expand-lg navbar-overlay" id="mainNavbar">

<div class="container d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a class="navbar-brand">
        <img src="{{ asset('storage/image/logo.png') }}" class="navbar-logo" alt="Active Drivers Logo">
    </a>

    <!-- Mobile Login / Signup -->
    @can('guest-home')
    <div class="d-lg-none mobile-auth-links">
        <a href="{{ route('login') }}" class="me-3">Log in</a>
        <a href="{{ route('signup') }}" class="btn btn-sm">Sign up</a>
    </div>
    @endcan

    <!-- Hamburger -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

</div>

<div class="container">
<div class="collapse navbar-collapse" id="navbarMenu">

    @can('guest-home')
    <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('home') }}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="#services">Our Services</a>
        </li>

        <!-- Desktop only -->
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link ps-lg-5" href="{{ route('signup') }}">Sign Up</a>
        </li>

        <li class="nav-item d-none d-lg-block">
            <a class="nav-link ps-lg-5" href="{{ route('login') }}">Login</a>
        </li>

    </ul>
    @endcan


    @can('customer-home')
    <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('customer.home') }}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('customer.mycars.index') }}">My Cars</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('customer.my-bookings') }}">My Bookings</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('customer.myprofile') }}">My Profile</a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn w-100 text-start ps-lg-5">Logout</button>
            </form>
        </li>

    </ul>
    @endcan


    @can('isDriver')
    <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('driver.home') }}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('driver.my-trip') }}">My Trip</a>
        </li>

        <li class="nav-item">
            <a class="nav-link ps-lg-5" href="{{ route('driver.profile') }}">Profile</a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn w-100 text-start ps-lg-5">Logout</button>
            </form>
        </li>

    </ul>
    @endcan

</div>
</div>

</nav>

</body>

<script>
const navbar = document.getElementById("mainNavbar");

window.addEventListener("scroll", () => {
    if (window.scrollY > 80) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
</script>