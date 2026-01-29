<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
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
</html>