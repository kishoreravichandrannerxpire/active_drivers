@include('partials.links')
@include('partials.location_style')
@include('partials.location_script')
  <body>
  
    @include('partials.navbar')
    @include('partials.slide_image')
    @can('guest-home')
      <div class="container mt-5">
    <div class="row">
        
        <div class="col-md-6">
            <form action="{{ route('login') }}" method="GET">
                <h4>Do You Wanna A driver </h4>
                <div class="mb-3 position-relative">
                    <label>From </label>
                    <input type="text" name="from_location" id="from_location" class="form-control" autocomplete="off" required>
                    <div id="from_suggestions"></div>
                </div>
                <div class="mb-3 position-relative">
                    <label>To</label>
                    <input type="text" name="to_location" id="to_location" class="form-control" autocomplete="off" required>
                    <div id="to_suggestions"></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{ route('driver.home') }}" method="GET">
                <h4>Do You Want A Trip</h4>
                <div class="mb-3">
                    <label>From Time</label>
                    <input type="datetime-local" name="from_date_time" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label>To Time</label>
                    <input type="datetime-local" name="to_date_time" class="form-control" autocomplete="off" required>
                </div>
                <button class="btn btn-success w-100">Submit</button>
            </form>
        </div>

    </div>
</div>

@include('partials.guest')
    @endcan

    @include('partials.footer')


</body>