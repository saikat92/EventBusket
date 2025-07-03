<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .navbar {
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .navbar-brand {
      font-weight: 600;
    }
    .profile-dropdown {
      margin-left: 15px;
    }
    .profile-img {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(255,255,255,0.3);
    }
    .dropdown-menu {
      border: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .nav-link {
      font-weight: 500;
      padding: 8px 15px !important;
    }
    .nav-item.active .nav-link {
      color: #fff !important;
      background-color: rgba(255,255,255,0.2);
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-birthday-cake mr-2"></i>Event Shop
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php">Services</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li> -->
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-cart"></i>
              <span class="badge badge-light ml-1">3</span>
            </a>
          </li>
          
          <!-- Profile Dropdown -->
          <li class="nav-item dropdown profile-dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
              <img src="https://ui-avatars.com/api/?name=User&background=random" alt="Profile" class="profile-img">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
              <div class="dropdown-header text-center">
                <img src="https://ui-avatars.com/api/?name=User&background=random" alt="Profile" class="profile-img mb-2" style="width: 48px; height: 48px;">
                <h6 class="mt-2 mb-0">Welcome User</h6>
                <small>user@example.com</small>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="pages/profile.php">
                <i class="fas fa-user-circle mr-2"></i>My Profile
              </a>
              <a class="dropdown-item" href="pages/bookings.php">
                <i class="fas fa-calendar-alt mr-2"></i>My Bookings
              </a>
              <a class="dropdown-item" href="pages/settings.php">
                <i class="fas fa-cog mr-2"></i>Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="login.php">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
              </a>
              <a class="dropdown-item" href="logout.php">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">