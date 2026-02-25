<section class="py-5 py-lg-8 reveal">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-12">
        <h2 class="display-5 fw-bold mb-3"> Do You Wanna Driver?</h2>
        <div class="bg-dark text-white rounded-4 p-4 p-lg-5">
          <div class="row align-items-center g-4">

            <!-- FORM -->
            <div class="col-lg-6 col-12">
              <form action="{{ route('customer.driver-availability') }}" method="POST">
                @csrf

                <div class="mb-3 position-relative">
                    <label>From </label>
                    <input type="text" name="from_location" id="from_location" class="form-control" value="{{ old('from_location') }}" autocomplete="off" required>
                    <div id="from_suggestions"></div>
                </div>
                <div class="mb-3 position-relative">
                    <label>To</label>
                    <input type="text" name="to_location" id="to_location" class="form-control" value="{{ old('to_location') }}" autocomplete="off" required>
                    <div id="to_suggestions"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100"> Choose Driver </button>
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
</body>
</html>

@include('partials.location_style')
@include('partials.location_script')