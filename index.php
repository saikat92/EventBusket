<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid bg-primary text-white">
  <div class="container text-center">
    <h1 class="display-4">Your Perfect Event Starts Here</h1>
    <p class="lead">Discover the best venues, services, and vendors for your special occasions</p>
  </div>
</div>

<!-- Search Bar for Date and Location -->
<div class="container mb-5 py-4 shadow rounded bg-light">
  <h3 class="text-center mb-4">Find Your Perfect Event Space</h3>
  <form class="form-inline justify-content-center">
    <div class="form-group mx-2">
      <label for="start-date" class="mr-2 font-weight-bold">Start Date</label>
      <input type="date" id="start-date" class="form-control shadow-sm">
    </div>
    <div class="form-group mx-2">
      <label for="end-date" class="mr-2 font-weight-bold">End Date</label>
      <input type="date" id="end-date" class="form-control shadow-sm">
    </div>
    <div class="form-group mx-2">
      <label for="location" class="mr-2 font-weight-bold">Location</label>
      <input type="text" id="location" class="form-control shadow-sm" placeholder="Enter city or area">
    </div>
    <button type="submit" class="btn btn-primary mx-2 shadow"><i class="fas fa-search mr-2"></i> Search</button>
  </form>
</div>

<!-- Featured Events Carousel -->
<div class="container mb-5">
  <h3 class="text-center mb-4">Featured Events</h3>
  <div id="eventCarousel" class="carousel slide shadow-lg" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#eventCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#eventCarousel" data-slide-to="1"></li>
      <li data-target="#eventCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner rounded">
      <div class="carousel-item active">
        <img src="https://floodlightz.com/wp-content/uploads/2023/09/Untitled-design-1-1024x427.png" class="d-block w-100" alt="Event 1">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Grand Wedding Celebration</h5>
          <p>Experience luxury wedding planning with our top vendors</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://eventplannerinlahore.pk/wp-content/uploads/2023/10/Marriage-Hall.jpg" class="d-block w-100" alt="Event 2">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Elegant Banquet Halls</h5>
          <p>Find the perfect venue for your special occasion</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://content.jdmagicbox.com/comp/rourkela/r7/9999px661.x661.230331133050.l8r7/catalogue/oneindia-events-jail-road-rourkela-event-organisers-05s4ufw4k2.jpg" class="d-block w-100" alt="Event 3">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Corporate Events</h5>
          <p>Professional event planning for businesses</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#eventCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#eventCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Services Cards -->
<div class="container mb-5">
  <h3 class="text-center mb-4">Our Services</h3>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-primary shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-university fa-3x mb-3 text-primary"></i>
          <h4 class="card-title">Banquet Halls</h4>
          <p class="card-text">Book the best venues for your weddings, parties, and corporate events with our verified partners.</p>
          <a href="pages/services.php?category=banquet" class="btn btn-outline-primary stretched-link">Book Now</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-success shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-gem fa-3x mb-3 text-success"></i>
          <h4 class="card-title">Decoration</h4>
          <p class="card-text">Stunning themes and designs for your events by top decorators with customizable packages.</p>
          <a href="pages/services.php?category=decoration" class="btn btn-outline-success stretched-link">View Options</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-warning shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-utensils fa-3x mb-3 text-warning"></i>
          <h4 class="card-title">Catering</h4>
          <p class="card-text">Delicious cuisine and menu planning to suit every occasion and dietary requirement.</p>
          <a href="pages/services.php?category=catering" class="btn btn-outline-warning stretched-link">Explore Menus</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-info shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-lightbulb fa-3x mb-3 text-info"></i>
          <h4 class="card-title">Lighting</h4>
          <p class="card-text">Ambient and professional lighting solutions to transform your event space.</p>
          <a href="pages/services.php?category=lighting" class="btn btn-outline-info stretched-link">View Packages</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-secondary shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-praying-hands fa-3x mb-3 text-secondary"></i>
          <h4 class="card-title">Puja Materials</h4>
          <p class="card-text">Complete kits and individual items for all your spiritual and religious ceremonies.</p>
          <a href="pages/services.php?category=puja" class="btn btn-outline-secondary stretched-link">Browse Items</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-dark shadow-sm hover-effect">
        <div class="card-body text-center">
          <i class="fas fa-user-tie fa-3x mb-3 text-dark"></i>
          <h4 class="card-title">Priest Services</h4>
          <p class="card-text">Experienced priests for all traditional rituals, available in multiple languages.</p>
          <a href="pages/services.php?category=priest" class="btn btn-outline-dark stretched-link">Book a Priest</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Testimonials -->
<div class="container mb-5 py-4 bg-light rounded">
  <h3 class="text-center mb-4">What Our Customers Say</h3>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="text-warning mb-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="card-text">"The banquet hall we booked through Event Shop was perfect for our wedding. The process was so smooth!"</p>
          <footer class="blockquote-footer">Rahul Sharma</footer>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="text-warning mb-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <p class="card-text">"Their decoration team transformed our venue beyond expectations. Highly recommended!"</p>
          <footer class="blockquote-footer">Priya Patel</footer>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="text-warning mb-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="card-text">"The catering service provided delicious food and excellent service for our corporate event."</p>
          <footer class="blockquote-footer">Amit Desai</footer>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Why Choose Us -->
<div class="container mb-5 text-center">
  <div class="bg-primary text-white py-4 rounded shadow">
    <h3 class="mb-3">Why Choose Us?</h3>
    <div class="row">
      <div class="col-md-4 mb-3">
        <i class="fas fa-check-circle fa-2x mb-2"></i>
        <h5>Verified Vendors</h5>
        <p>All our partners are carefully vetted for quality and reliability</p>
      </div>
      <div class="col-md-4 mb-3">
        <i class="fas fa-calendar-check fa-2x mb-2"></i>
        <h5>Easy Booking</h5>
        <p>Simple online booking with instant confirmation</p>
      </div>
      <div class="col-md-4 mb-3">
        <i class="fas fa-headset fa-2x mb-2"></i>
        <h5>24/7 Support</h5>
        <p>Dedicated support team available anytime you need help</p>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
  .hover-effect:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  .carousel-item img {
    height: 400px;
    object-fit: cover;
  }
  .jumbotron {
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    border-radius: 0 !important;
  }
</style>