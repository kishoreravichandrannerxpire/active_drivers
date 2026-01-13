<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RetroRide – Car Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #faf7f2;
            color: #2f2f2f;
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e5e5e5;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Carousel */
        .carousel-item {
            height: 70vh;
            background-size: cover;
            background-position: center;
        }

        .carousel-overlay {
            background: rgba(0,0,0,0.45);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        /* Banner */
        .cta-section {
            background-color: #fff;
            border-radius: 24px;
            padding: 4rem 2rem;
            margin-top: -80px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .cta-section h2 {
            font-weight: 700;
        }

        .btn-retro {
            background-color: #3a7f7a;
            color: #fff;
            border-radius: 999px;
            padding: 0.6rem 1.8rem;
        }

        .btn-retro-outline {
            border: 2px solid #3a7f7a;
            color: #3a7f7a;
            border-radius: 999px;
            padding: 0.6rem 1.8rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">RetroRide</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- SLIDER -->
<div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active"
             style="background-image: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70');">
            <div class="carousel-overlay">
                <div>
                    <h1 class="fw-bold">Drive Retro. Ride Smooth.</h1>
                    <p class="mt-3">Classic comfort with modern service</p>
                </div>
            </div>
        </div>

        <div class="carousel-item"
             style="background-image: url('https://images.unsplash.com/photo-1549924231-f129b911e442');">
            <div class="carousel-overlay">
                <div>
                    <h1 class="fw-bold">Your Journey, Our Cars</h1>
                    <p class="mt-3">Reliable rentals & servicing</p>
                </div>
            </div>
        </div>

    </div>
</div>
<br>
<!-- BANNER / CTA -->
<div class="container">
    <div class="cta-section text-center">
        <h2>Do you want a driver?</h2>
        <p class="text-muted mt-3">
            Book a ride, service your vehicle, or explore classic comfort — all in one place.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="#" class="btn btn-retro">Book Now</a>
            <a href="#" class="btn btn-retro-outline">View Cars</a>
        </div>
    </div>
</div>

<div class="py-8 ">
<div class="container">
<div class="row">
<div class="offset-lg-2 col-lg-8 col-md-12 col-12 text-center">
<span class="fs-4 text-warning ls-md text-uppercase
 fw-semibold">wanna go on a ride but not in the mood to drive?

</span>
<!-- heading  -->
<h2 class="display-3 mt-4 mb-3  fw-bold">Join us and get a driver</h2>
 <!-- para  -->
<p class="lead  px-lg-8 mb-6">Designed for people who wanna get around in their terms.</p>
<a href="#" class="btn btn-primary">What are you waiting for?</a>
</div>
</div>
</div>
</div>
<br>
<section class="py-lg-8">
  <div class="container">
    <div class="row">
      <div class="col-xl-10 offset-xl-1 col-md-12 col-12">
        <div class="bg-primary py-6 px-6 px-xl-0 rounded-4">
          <div class="row align-items-center">

            <!-- FORM SIDE -->
            <div class="offset-xl-1 col-xl-5 col-md-6 col-12">
              <div>
                <h2 class="h1 text-white mb-4">Do you want to add a car?</h2>

                <form>
                  <div class="mb-3">
                    <label class="form-label text-white">Car Model</label>
                    <input type="text" name="car_model" class="form-control"
                           placeholder="Eg: Honda City">
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-white">Car Type</label>
                    <select name="car_type" class="form-select">
                      <option selected disabled>Select type</option>
                      <option value="sedan">Sedan</option>
                      <option value="suv">SUV</option>
                      <option value="hatchback">Hatchback</option>
                      <option value="electric">Electric</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label class="form-label text-white">Car Number</label>
                    <input type="text" name="car_number" class="form-control"
                           placeholder="TN 01 AB 1234">
                  </div>

                  <button type="submit" class="btn btn-dark px-4">
                    Add Car
                  </button>
                </form>
              </div>
            </div>

            <!-- IMAGE SIDE -->
            <div class="col-xl-6 col-md-6 col-12">
              <div class="text-center">
                <img src="../assets/images/car/car.png"
                     alt="car"
                     class="img-fluid">
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<br>
<h2 class="h1 mb-3">Do you want to add a car?</h2>
<p class="fs-5 mb-4">Save your vehicle details for faster bookings.</p>

<button class="btn btn-dark px-4"
        data-bs-toggle="modal"
        data-bs-target="#addCarModal">
    Add Car
</button>
<br>
<section class="py-5">
  <div class="container">
    <div class="row g-5">

      <!-- LEFT : CONVERSATION FORM -->
      <div class="col-lg-7">
        <h2 class="mb-3">Let's Start a Conversation</h2>
        <p class="text-muted mb-4">
          Tell us about your requirements and we’ll get back to you shortly.
        </p>

        <form>
          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label text-uppercase small">Name</label>
              <input type="text" class="form-control border-0 border-bottom rounded-0"
                     placeholder="Your Name">
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label text-uppercase small">Email</label>
              <input type="email" class="form-control border-0 border-bottom rounded-0"
                     placeholder="Your Email">
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label text-uppercase small">Phone</label>
              <input type="text" class="form-control border-0 border-bottom rounded-0"
                     placeholder="Your Phone">
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label text-uppercase small">Subject</label>
              <input type="text" class="form-control border-0 border-bottom rounded-0"
                     placeholder="Subject">
            </div>

            <div class="col-12 mb-4">
              <label class="form-label text-uppercase small">Message</label>
              <textarea rows="4"
                        class="form-control border-0 border-bottom rounded-0"
                        placeholder="Tell us about your project"></textarea>
            </div>

            <div class="col-12">
              <button class="btn btn-outline-dark px-5 py-3">
                Send Message →
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- RIGHT : CONTACT INFO -->
      <div class="col-lg-5">
        <div class="bg-light p-4 p-lg-5 h-100 rounded-3">

          <h4 class="mb-4">Get in Touch</h4>
          <p class="text-muted mb-4">
            Reach us through the details below or send us a message.
          </p>

          <div class="d-flex mb-4">
            <div class="me-3 text-warning fs-4">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div>
              <h6 class="mb-1">Address</h6>
              <p class="mb-0 text-muted">
                892 Park Avenue, Manhattan<br>
                New York, NY 10075
              </p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="me-3 text-warning fs-4">
              <i class="bi bi-envelope"></i>
            </div>
            <div>
              <h6 class="mb-1">Email</h6>
              <p class="mb-0 text-muted">hello@businessdemo.com</p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="me-3 text-warning fs-4">
              <i class="bi bi-telephone"></i>
            </div>
            <div>
              <h6 class="mb-1">Phone</h6>
              <p class="mb-0 text-muted">+1 (555) 789-2468</p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="me-3 text-warning fs-4">
              <i class="bi bi-clock"></i>
            </div>
            <div>
              <h6 class="mb-1">Hours</h6>
              <p class="mb-0 text-muted">
                Mon–Fri: 9AM – 6PM<br>
                Sat: 10AM – 4PM
              </p>
            </div>
          </div>

          <hr>

          <h6 class="text-uppercase mb-3">Connect with us</h6>
          <div class="d-flex gap-3 fs-5">
            <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="text-dark"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
<br>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
