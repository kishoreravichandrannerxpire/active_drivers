<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

                @php
                  $from = old('from', session('from_location', ''));
                  $to = old('to', session('to_location', ''));
                @endphp

                <div class="mb-3">
                  <label class="form-label">From Location *</label>
                  <input type="text" id="customer_from" name="from" class="form-control" value="{{ $from }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">To Location *</label>
                  <input type="text" id="customer_to" name="to" class="form-control" value="{{ $to }}" required>
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