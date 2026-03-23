@include('partials.links')
@include('partials.location_style')
@include('partials.location_script')

<body>
    @include('partials.navbar')
    @include('partials.slide_image')
    
    @can('guest-home')
    <div class="container booking-section">
        <div class="row justify-content-center g-4">
            <!-- Customer Form -->
             <div class="col-lg-5 col-md-6">
                <div class="booking-card">
                    <h4 class="card-title">🧑‍✈️ Do You Wanna A driver</h4>
                    <form action="{{ route('login') }}" method="GET">
                        <div class="mb-3 position-relative">
                            <label class="form-label">Pickup Location</label>
                            <input type="text" name="from_location" id="from_location" class="form-control modern-input"
                            autocomplete="off" placeholder="Enter pickup location" required>
                            <div id="from_suggestions"></div>
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <label class="form-label">Destination</label>
                            <input type="text" name="to_location" id="to_location" class="form-control modern-input"
                            autocomplete="off" placeholder="Enter destination" required>
                            <div id="to_suggestions"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary booking-btn w-100">Find Driver</button>
                    </form>
                </div>
            </div>
            
            <!-- Driver Form -->
             <div class="col-lg-5 col-md-6">
                <div class="booking-card">
                    <h4 class="card-title">🚗 Do You Wanna A Trip</h4>
                    <form action="{{ route('driver.home') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">From Time</label>
                            <input type="datetime-local" name="from_date_time" class="form-control modern-input"
                            autocomplete="off" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">To Time</label>
                            <input type="datetime-local" name="to_date_time" class="form-control modern-input"
                            autocomplete="off" required>
                        </div>
                        
                        <button class="btn btn-success booking-btn w-100"> Accept Trip </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partials.guest')
@endcan

@include('partials.footer')
</body>

<style>
.booking-section{
    margin-top:70px;
    margin-bottom:60px;

     background-image:url("{{ asset('storage/image/driver-customer.png') }}");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    padding:80px 20px;
    border-radius:15px;

    position:relative;
}

.booking-section::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;

    background:rgba(0,0,0,0.45); /* overlay */

    border-radius:15px;
}

.booking-card{
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
    transition:0.3s;
}

.booking-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
}

.card-title{
    font-weight:600;
    margin-bottom:25px;
    color:#333;
    text-align:center;
}

.form-label{
    font-weight:500;
    margin-bottom:6px;
}

.modern-input{
    height:46px;
    border-radius:8px;
    border:1px solid #ddd;
    padding-left:12px;
}

.modern-input:focus{
    border-color:#0d6efd;
    box-shadow:0 0 0 0.15rem rgba(13,110,253,0.15);
}

.booking-btn{
    padding:12px;
    font-weight:600;
    border-radius:8px;
    margin-top:10px;
}

.booking-btn:hover{
    transform:scale(1.02);
}

.booking-section .row{
    position:relative;
    z-index:2;
}

.booking-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(6px);
}
@media (max-width:480px){

.booking-card{
    padding:18px;
}

.card-title{
    font-size:16px;
}

.booking-btn{
    font-size:13px;
}
.booking-section{
    padding:40px 15px;
}
}
</style>