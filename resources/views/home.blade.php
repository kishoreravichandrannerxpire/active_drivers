@include('partials.links')
  <body>
    @include('partials.navbar')
    
    @can('guest-home')
      <div class="container mt-5">
    <div class="row">
        
        <div class="col-md-6">
            <form id="guestDriverForm" onsubmit="event.preventDefault(); redirectToLogin();">
                <h4>Do You Wanna A driver </h4>
                <div class="mb-3">
                    <label>From </label>
                    <input type="text" id="guest_from" class="form-control" >
                </div>
                <div class="mb-3">
                    <label>To</label>
                    <input type="text" id="guest_to" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="col-md-6">
            <form>
                <h4>Do You Want A Trip</h4>
                <div class="mb-3">
                    <label>From Time</label>
                    <input type="time" class="form-control">
                </div>
                <div class="mb-3">
                    <label>To Time</label>
                    <input type="time" class="form-control">
                </div>
                <button class="btn btn-success w-100">Submit</button>
            </form>
        </div>

    </div>
</div>

@include('partials.guest')
    @endcan

    @can('customer-home')
      @include('partials.customer.driver_booking_form')
      @include('partials.customer.addcar_form')
      @include('partials.conversation')
    @endcan 

    @can('isDriver')
      @include('partials.conversation')
    @endcan
</body>
 
@include('partials.footer')
 
   
    <script>
        function redirectToLogin() {
            const from = document.getElementById('guest_from').value.trim();
            const to = document.getElementById('guest_to').value.trim();
            if (!from || !to) 
                { 
                    alert('Please fill both From and To');
                     return; 
                }
            window.location = '{{ route('login') }}?from=' + encodeURIComponent(from) + '&to=' + encodeURIComponent(to);
        }
    </script>
