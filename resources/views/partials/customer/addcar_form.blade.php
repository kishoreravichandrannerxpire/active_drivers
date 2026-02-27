@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
          <form class="card shadow-sm border-0 p-4" style="max-width:520px;" action="{{ route('customer.mycars.store') }}" method="POST">
            @csrf
            <h5 class="mb-4 text-primary"><i class="bi bi-car-front-fill"></i> Car Information</h5>

            {{-- validation errors --}}
            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="mb-3">
              <label class="form-label fw-semibold">Car Model</label>
              <input type="text" name="car_model" value="{{ old('car_model') }}" class="form-control" placeholder="Eg: Toyota Corolla" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Car Type</label>
              <select name="car_type" class="form-select" required>
                <option value="">Select Car Type</option>
                <option value="Sedan (4-Seater)" {{ old('car_type')=='Sedan (4-Seater)'?'selected':'' }}>Sedan (4-Seater)</option>
                <option value="Sedan (5-Seater)" {{ old('car_type')=='Sedan (5-Seater)'?'selected':'' }}>Sedan (5-Seater)</option>
                <option value="SUV (5-Seater)" {{ old('car_type')=='SUV (5-Seater)'?'selected':'' }}>SUV (5-Seater)</option>
                <option value="SUV (7-Seater)" {{ old('car_type')=='SUV (7-Seater)'?'selected':'' }}>SUV (7-Seater)</option>
                <option value="MUV (7-Seater)" {{ old('car_type')=='MUV (7-Seater)'?'selected':'' }}>MUV (7-Seater)</option>
                <option value="MUV (8-Seater)" {{ old('car_type')=='MUV (8-Seater)'?'selected':'' }}>MUV (8-Seater)</option>
                <option value="Hatchback (4-Seater)" {{ old('car_type')=='Hatchback (4-Seater)'?'selected':'' }}>Hatchback (4-Seater)</option>
                <option value="Hatchback (5-Seater)" {{ old('car_type')=='Hatchback (5-Seater)'?'selected':'' }}>Hatchback (5-Seater)</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Car Number</label>
              <input type="text" name="car_number" value="{{ old('car_number') }}" class="form-control" placeholder="Eg: TN 01 AB 1234" required>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Transmission Type</label>
              <select name="transmission_type" class="form-select" required>
                <option value="">Select Transmission Type</option>
                <option value="Manual" {{ old('transmission_type')=='Manual'?'selected':'' }}>Manual</option>
                <option value="Automatic" {{ old('transmission_type')=='Automatic'?'selected':'' }}>Automatic</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold">Fuel Type</label>
              <select name="fuel_type" class="form-select" required>
                <option value="">Select Fuel Type</option>
                <option value="Petrol" {{ old('fuel_type')=='Petrol'?'selected':'' }}>Petrol</option>
                <option value="Diesel" {{ old('fuel_type')=='Diesel'?'selected':'' }}>Diesel</option>
                <option value="Electric" {{ old('fuel_type')=='Electric'?'selected':'' }}>Electric</option>
              </select>
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

  // if there were validation errors, show the form on page load
  @if($errors->any())
    document.getElementById('carForm').style.display = 'block';
  @endif

  // if old input exists (after redirect with errors), also display
  @if(old('car_model') || old('car_type') || old('car_number'))
    document.getElementById('carForm').style.display = 'block';
  @endif
  </script>