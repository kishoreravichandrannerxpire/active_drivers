<div class="text-center my-5" style="font-family: Arial, sans-serif; color: rgb(0, 10, 70);" id="services">
<h1>OUR SERVICES</h1>

<div class="container mt-4">
<div class="row row-cols-1 row-cols-md-2 g-4">

<div class="col">
<div class="service-card">
<img src="{{ asset('storage/image/24-hours-services.png') }}" alt="24/7">

<div class="service-overlay">
<h5>Our drivers are available round the clock to ensure you reach your destination safely anytime, anywhere.</h5>
</div>

</div>
</div>


<div class="col">
<div class="service-card">
<img src="{{ asset('storage/image/alcohol-check.png') }}" alt="alcohol">

<div class="service-overlay">
<h5>Every driver undergoes alcohol testing to guarantee a safe and responsible driving experience.</h5>
</div>

</div>
</div>


<div class="col">
<div class="service-card">
<img src="{{ asset('storage/image/ride-safe.png') }}" alt="safe ride">

<div class="service-overlay">
<h5>All drivers are background verified and professionally trained for your safety and comfort.</h5>
</div>

</div>
</div>


<div class="col">
<div class="service-card">
<img src="{{ asset('storage/image/trust-safety.png') }}" alt="trust safety">

<div class="service-overlay">
<h5>We ensure dependable service with skilled drivers who prioritize safety on every trip.</h5>
</div>

</div>
</div>

</div>
</div>
</div>

  <style>
    .service-card{
    position:relative;
    overflow:hidden;
    border-radius:12px;
    cursor:pointer;
}

.service-card img{
    width:100%;
    height:320px;
    object-fit:cover;
    transition:transform .5s ease;
}

.service-overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0, 0, 0, 0.90);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:20px;

    opacity:0;
    transition:opacity .4s ease;
}

.service-overlay h5{
    transform:translateY(20px);
    transition:.4s;
    font-family: Arial, sans-serif;
}

/* hover effects */

.service-card:hover img{
    transform:scale(1.1);
}

.service-card:hover .service-overlay{
    opacity:1;
}

.service-card:hover .service-overlay p{
    transform:translateY(0);
}
</style>