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