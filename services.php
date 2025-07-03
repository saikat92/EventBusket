<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid bg-primary text-white">
  <div class="container text-center">
    <h1 class="display-4">Our Event Services</h1>
    <p class="lead">Everything you need to make your event memorable</p>
  </div>
</div>

<!-- Service Filter -->
<div class="container mb-5 py-4 shadow rounded bg-light">
  <h3 class="text-center mb-4">Browse Services</h3>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="input-group mb-3 shadow-sm">
        <input type="text" class="form-control" placeholder="Search services..." id="serviceSearch">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center">
    <div class="btn-group flex-wrap" role="group">
      <a href="services.php" class="btn btn-outline-primary">All</a>
      <a href="services.php?category=banquet" class="btn btn-outline-primary">Banquet Halls</a>
      <a href="services.php?category=decoration" class="btn btn-outline-success">Decoration</a>
      <a href="services.php?category=catering" class="btn btn-outline-warning">Catering</a>
      <a href="services.php?category=lighting" class="btn btn-outline-info">Lighting</a>
      <a href="services.php?category=puja" class="btn btn-outline-secondary">Puja Materials</a>
      <a href="services.php?category=priest" class="btn btn-outline-dark">Priest Services</a>
    </div>
  </div>
</div>

<!-- Service Listings -->
<div class="container mb-5">
  <?php
  // Get category from URL
  $category = isset($_GET['category']) ? $_GET['category'] : 'all';
  
  // Service data (in a real app, this would come from a database)
  $services = [
    'banquet' => [
      ['name' => 'Grand Ballroom', 'price' => '₹25,000', 'location' => 'Mumbai', 'rating' => 4.8, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'],
      ['name' => 'Royal Garden', 'price' => '₹18,000', 'location' => 'Delhi', 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'],
      ['name' => 'Emerald Hall', 'price' => '₹30,000', 'location' => 'Bangalore', 'rating' => 4.9, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ],
    'decoration' => [
      ['name' => 'Floral Decor Package', 'price' => '₹12,000', 'location' => 'Pune', 'rating' => 4.7, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'],
      ['name' => 'Theme Wedding Setup', 'price' => '₹25,000', 'location' => 'Hyderabad', 'rating' => 4.9, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ],
    'catering' => [
      ['name' => 'Premium Buffet Service', 'price' => '₹800 per plate', 'location' => 'Chennai', 'rating' => 4.6, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'],
      ['name' => 'Traditional Thali Service', 'price' => '₹500 per plate', 'location' => 'Ahmedabad', 'rating' => 4.4, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ],
    'lighting' => [
      ['name' => 'LED Lighting Package', 'price' => '₹8,000', 'location' => 'Kolkata', 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ],
    'puja' => [
      ['name' => 'Complete Puja Kit', 'price' => '₹2,500', 'location' => 'Varanasi', 'rating' => 4.8, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ],
    'priest' => [
      ['name' => 'Pandit Ramesh Sharma', 'price' => '₹5,000', 'location' => 'Jaipur', 'rating' => 4.9, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'],
      ['name' => 'Pandit Arun Joshi', 'price' => '₹4,500', 'location' => 'Lucknow', 'rating' => 4.7, 'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80']
    ]
  ];
  
  // Determine which services to display
  $displayServices = ($category === 'all') ? array_merge(...array_values($services)) : $services[$category];
  
  // Display category title
  $categoryTitles = [
    'all' => 'All Services',
    'banquet' => 'Banquet Halls',
    'decoration' => 'Decoration Services',
    'catering' => 'Catering Services',
    'lighting' => 'Lighting Services',
    'puja' => 'Puja Materials',
    'priest' => 'Priest Services'
  ];
  ?>
  
  <h3 class="mb-4"><?php echo $categoryTitles[$category]; ?></h3>
  
  <div class="row">
    <?php foreach ($displayServices as $service): ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm hover-effect">
        <img src="<?php echo $service['image']; ?>" class="card-img-top" alt="<?php echo $service['name']; ?>" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h5 class="card-title"><?php echo $service['name']; ?></h5>
            <span class="badge bg-primary"><?php echo $service['price']; ?></span>
          </div>
          <p class="text-muted"><i class="fas fa-map-marker-alt"></i> <?php echo $service['location']; ?></p>
          <div class="mb-2">
            <?php 
            $fullStars = floor($service['rating']);
            $halfStar = ($service['rating'] - $fullStars) >= 0.5;
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
            
            for ($i = 0; $i < $fullStars; $i++) {
              echo '<i class="fas fa-star text-warning"></i>';
            }
            if ($halfStar) {
              echo '<i class="fas fa-star-half-alt text-warning"></i>';
            }
            for ($i = 0; $i < $emptyStars; $i++) {
              echo '<i class="far fa-star text-warning"></i>';
            }
            ?>
            <span class="ml-1"><?php echo $service['rating']; ?></span>
          </div>
          <a href="#" class="btn btn-primary">View Details</a>
          <a href="#" class="btn btn-outline-secondary">Add to Cart</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- How It Works -->
<div class="container mb-5 py-4 bg-light rounded shadow">
  <h3 class="text-center mb-4">How It Works</h3>
  <div class="row text-center">
    <div class="col-md-4 mb-3">
      <div class="p-3">
        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
          <i class="fas fa-search fa-2x"></i>
        </div>
        <h5 class="mt-3">1. Browse Services</h5>
        <p>Explore our wide range of event services and vendors</p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="p-3">
        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
          <i class="fas fa-calendar-check fa-2x"></i>
        </div>
        <h5 class="mt-3">2. Book & Confirm</h5>
        <p>Select your preferred options and confirm your booking</p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="p-3">
        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
          <i class="fas fa-glass-cheers fa-2x"></i>
        </div>
        <h5 class="mt-3">3. Enjoy Your Event</h5>
        <p>Relax and enjoy your perfectly planned event.</p>
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
  .jumbotron {
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    border-radius: 0 !important;
  }
  .btn-group .btn {
    margin: 2px;
  }
</style>