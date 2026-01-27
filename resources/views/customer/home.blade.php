<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
  /* initial hidden state */
.reveal {
  opacity: 0;
  transform: translateY(40px);
  transition: all 0.9s ease;
}

/* when revealed */
.reveal.active {
  opacity: 1;
  transform: translateY(0);
}
 
</style>
<body>
    @include('partials.navbar')
    
    @can('customer-home')
<section class="py-5 py-lg-8 reveal">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-12">
        <h2 class="display-5 fw-bold mb-3"> Do You Wanna Driver?</h2>
        <div class="bg-dark text-white rounded-4 p-4 p-lg-5">
          <div class="row align-items-center g-4">

            <!-- FORM -->
            <div class="col-lg-6 col-12">
              <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label class="form-label">Name *</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Mobile Number *</label>
                  <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Password *</label>
                  <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                  Create Customer
                </button>
              </form>
            </div>

            <!-- IMAGE -->
            <div class="col-lg-6 col-12 text-center">
              <div class="image-frame">
                <img src="{{ asset('storage/banners/car2.png') }}" alt="learning" class="img-fluid">
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endcan
<!-- ADD CAR  -->
 @can('customer-home')
<section class="py-5 py-lg-8 reveal">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-12">

        <div class="row align-items-center g-4">

          <!-- LEFT CONTENT -->
          <div class="col-lg-5 col-12">
            <h2 class="display-5 fw-bold mb-3">
              <u class="text-warning">
                <span class="text-dark">Add Your Car</span>
              </u>
            </h2>
            <button class="btn btn-outline-secondary" id="toggleBtn" onclick="showCarForm()">Add Car +</button>
          </div>
<!-- FORM -->
    <div class="col-lg-6 offset-lg-1 col-12" style="display:none;" id="carForm">
        <div class="p-4 bg-white rounded-4 shadow-sm">
          <form class="card shadow-sm border-0 p-4" style="max-width:520px;">
            <h5 class="mb-4 text-primary"><i class="bi bi-car-front-fill"></i> Car Information</h5>
            <div class="mb-3">
              <label class="form-label fw-semibold">Car Model</label>
              <input type="text" class="form-control" placeholder="Eg: Toyota Corolla">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Car Type</label>
              <select class="form-select">
                <option value="">Select Car Type</option>
                <option>Sedan (4-Seater)</option>
                <option>Sedan (5-Seater)</option>
                <option>SUV (5-Seater)</option>
                <option>SUV (7-Seater)</option>
                <option>MUV (7-Seater)</option>
                <option>MUV (8-Seater)</option>
                <option>Hatchback (4-Seater)</option>
                <option>Hatchback (5-Seater)</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Car Number</label>
              <input type="text" class="form-control" placeholder="Eg: TN 01 AB 1234">
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="reset" class="btn btn-light" onclick="hideCarForm()">Cancel</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Save </button>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endcan

@can('guest-home')
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
@endcan
<section class="py-5 reveal">
  <div class="container">
    <div class="row g-5">
 
      <!-- LEFT : CONVERSATION FORM -->
      <div class="col-lg-7">
        <h2 class="mb-3">Let's Start a Conversation</h2>
        <p class="text-muted mb-4">
          Tell us about your requirements and we'll get back to you shortly.
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
                Mon-Fri: 9AM-6PM<br>
                Sat: 10AM-4PM
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
 

</body>
<script>
  function showCarForm() {
    // Show the car form (you can implement this as needed)
    document.getElementById('carForm').style.display = 'block';
  }

  function hideCarForm() {
    // Hide the car form (you can implement this as needed)
    document.getElementById('carForm').style.display = 'none';
  }

  const reveals = document.querySelectorAll('.reveal');
 
  const observer = new IntersectionObserver(

    (entries) => {

      entries.forEach(entry => {

        if (entry.isIntersecting) {

          entry.target.classList.add('active');

          observer.unobserve(entry.target); // animate once

        }

      });

    },

    {

      threshold: 0.15

    }

  );
 
  reveals.forEach(el => observer.observe(el));
</script>

</html>