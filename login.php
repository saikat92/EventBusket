<?php include 'includes/header.php'; ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <h3 class="text-center mb-0">Welcome Back</h3>
        </div>
        <div class="card-body p-5">
          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <?php echo htmlspecialchars($_GET['error']); ?>
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>
          <?php endif; ?>
          
          <form method="post" action="../process/login_process.php" class="needs-validation" novalidate>
            <div class="form-group">
              <label for="email">Email Address</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                <div class="invalid-feedback">
                  Please provide a valid email address.
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <div class="invalid-feedback">
                  Please enter your password.
                </div>
              </div>
            </div>
            
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember me</label>
              <a href="forgot_password.php" class="float-right">Forgot password?</a>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">
              <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
            
            <div class="text-center mt-4">
              <p class="mb-2">Don't have an account? <a href="register.php">Sign up</a></p>
              <p class="text-muted">or login with</p>
              <div>
                <a href="#" class="btn btn-outline-primary mr-2"><i class="fab fa-google"></i></a>
                <a href="#" class="btn btn-outline-primary mr-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-outline-primary"><i class="fab fa-twitter"></i></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  body {
    background: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.05)), url('https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
  }
  .card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
  }
  .card-header {
    padding: 1.5rem;
  }
  .input-group-text {
    background-color: #f8f9fa;
  }
  .btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
  }
  .btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
  }
</style>

<script>
// Form validation
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php include 'includes/footer.php'; ?>