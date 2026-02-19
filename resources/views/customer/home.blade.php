@include('partials.links')  
<style>
  /* initial hidden state */
.reveal {
  opacity: 0;
  transform: translateY(40px);
  transition: all 0.9s ease;
}

/* when revealed */
.reveal.active {
  opacity: 1;
  transform: translateY(0);
}
 
</style>
<body>
    @include('partials.navbar')
    @include('partials.slide_image')

    <!-- DRIVER BOOKING FORM -->
  @can('customer-home')
    @include('partials.customer.driver_booking_form')
  @endcan
   
    <!-- ADD CAR  -->
  @can('customer-home')
    @include('partials.customer.addcar_form')
  @endcan
    
    <!-- CONVERSATION FORM -->
  @can('customer-home')
    @include('partials.conversation')
  @endcan
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