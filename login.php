<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <h3 class="text-center mb-0">Secure Login</h3>
        </div>
        <div class="card-body p-5">
          <!-- Error/Success Messages -->
          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <?php echo htmlspecialchars($_GET['error']); ?>
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>
          <?php endif; ?>
          
          <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
              <?php echo htmlspecialchars($_GET['success']); ?>
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>
          <?php endif; ?>
          
          <!-- Login Tabs -->
          <ul class="nav nav-tabs mb-4" id="loginTabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="password-tab" data-toggle="tab" href="#password-login" role="tab">
                <i class="fas fa-key mr-1"></i> Password
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="otp-tab" data-toggle="tab" href="#otp-login" role="tab">
                <i class="fas fa-mobile-alt mr-1"></i> OTP
              </a>
            </li>
          </ul>
          
          <div class="tab-content" id="loginTabsContent">
            <!-- Password Login Tab -->
            <div class="tab-pane fade show active" id="password-login" role="tabpanel">
              <form method="post" action="../process/login_process.php" class="needs-validation" novalidate>
                <input type="hidden" name="login_type" value="password">
                
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
              </form>
            </div>
            
            <!-- OTP Login Tab -->
            <div class="tab-pane fade" id="otp-login" role="tabpanel">
              <form method="post" action="../process/otp_process.php" class="needs-validation" novalidate id="otpForm">
                <input type="hidden" name="login_type" value="otp">
                
                <!-- Step 1: Enter Mobile Number -->
                <div id="otpStep1">
                  <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                      </div>
                      <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
                      <div class="invalid-feedback">
                        Please provide a valid mobile number.
                      </div>
                    </div>
                  </div>
                  
                  <button type="button" class="btn btn-primary btn-block btn-lg mt-4" id="sendOtpBtn">
                    <i class="fas fa-paper-plane mr-2"></i> Send OTP
                  </button>
                </div>
                
                <!-- Step 2: Enter OTP (initially hidden) -->
                <div id="otpStep2" style="display: none;">
                  <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> OTP sent to <span id="mobileDisplay"></span>
                  </div>
                  
                  <div class="form-group">
                    <label for="otp">Enter 6-digit OTP</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                      </div>
                      <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" pattern="\d{6}" maxlength="6" required>
                      <div class="invalid-feedback">
                        Please enter the 6-digit OTP.
                      </div>
                    </div>
                    <small class="form-text text-muted">
                      OTP valid for 5 minutes. <a href="#" id="resendOtp">Resend OTP</a>
                    </small>
                  </div>
                  
                  <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">
                    <i class="fas fa-sign-in-alt mr-2"></i> Verify & Login
                  </button>
                </div>
              </form>
            </div>
          </div>
          
          <div class="text-center mt-4">
            <p class="mb-2">Don't have an account? <a href="register.php">Sign up</a></p>
            <p class="text-muted">or login with</p>
            <div>
              <a href="#" class="btn btn-outline-primary mr-2"><i class="fab fa-google"></i></a>
              <a href="#" class="btn btn-outline-primary mr-2"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="btn btn-outline-primary"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
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
  .nav-tabs .nav-link {
    color: #495057;
    font-weight: 500;
  }
  .nav-tabs .nav-link.active {
    color: #4e73df;
    font-weight: 600;
  }
  #otpForm .form-group {
    margin-bottom: 1.5rem;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
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

  // OTP Flow
  $('#sendOtpBtn').click(function() {
    var mobileInput = $('#mobile');
    var mobile = mobileInput.val().trim();
    
    // Simple validation
    if (mobile.length < 10) {
      mobileInput.addClass('is-invalid');
      return;
    }
    
    // Show loading state
    var btn = $(this);
    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Sending OTP...');
    
    // Simulate API call (replace with actual AJAX call)
    setTimeout(function() {
      // On success
      $('#mobileDisplay').text(mobile);
      $('#otpStep1').hide();
      $('#otpStep2').show();
      btn.prop('disabled', false);
      btn.html('<i class="fas fa-paper-plane mr-2"></i> Send OTP');
      
      // Start OTP timer (5 minutes)
      startOtpTimer();
    }, 1500);
  });
  
  // Resend OTP
  $('#resendOtp').click(function(e) {
    e.preventDefault();
    $('#sendOtpBtn').click();
  });
  
  // OTP Timer
  function startOtpTimer() {
    var minutes = 4;
    var seconds = 59;
    var timerElement = $('#resendOtp');
    
    timerElement.parent().html('OTP valid for <span id="otpTimer">5:00</span>. <a href="#" id="resendOtp">Resend OTP</a>');
    
    var timer = setInterval(function() {
      if (seconds < 10) {
        seconds = "0" + seconds;
      }
      
      $('#otpTimer').text(minutes + ":" + seconds);
      
      if (seconds == 0) {
        if (minutes == 0) {
          clearInterval(timer);
          $('#otpTimer').parent().html('OTP expired. <a href="#" id="resendOtp">Resend OTP</a>');
          return;
        }
        minutes--;
        seconds = 59;
      } else {
        seconds--;
      }
    }, 1000);
  }
  
  // Auto-tab between OTP digits
  $('#otp').on('input', function() {
    if (this.value.length === 6) {
      $(this).removeClass('is-invalid');
    }
  });
});
</script>


</div> <!-- container -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>