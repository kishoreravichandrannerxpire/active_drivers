<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trial2</title>
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

/* hero just for spacing demo */
.hero {
  height: 100vh;
  background: url('/images/hero.jpg') center/cover no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

</style>
<body>
    <nav class="navbar fixed-top bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">RetroRide</a>
  </div>
</nav>

<section class="hero">
  <h1>Drive. Earn. Smile.</h1>
</section>

<section class="reveal">
  <h2>Add Your Car</h2>
  <p>Save your car details for faster bookings.</p>
</section>

<section class="reveal">
  <h2>Why Drive With Us</h2>
  <p>Flexible hours. Happy earnings.</p>
</section>

</body>

<script>
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