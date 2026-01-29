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
</body>
</html>