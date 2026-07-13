<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<style>
    body {
        background-color: #223a53ff;
    }
    .login-box {
        background: #bb763dff;
        margin-top: 100px;
            border-radius: 12px;
    }
</style>
    

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="card login-box p-4">
            <h4 class="text-center text-dark mb-1">Welcome Back</h4>
            <p class="text-center text-muted mb-4">Login to your admin account</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                {{-- Email field --}}
                <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password field --}}
                <div class="mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit button --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark w-100 btn-lg">Login</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>


</body>
</html>