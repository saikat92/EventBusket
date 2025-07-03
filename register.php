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
    <div class="col-md-10 col-lg-8">
      <div class="card shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
          <h3 class="text-center mb-0">Create Your Account</h3>
          <p class="text-center mb-0">Join us in just a few steps</p>
        </div>
        
        <div class="card-body p-5">
          <!-- Progress Bar -->
          <div class="progress mb-5" style="height: 8px;">
            <div class="progress-bar bg-success" id="regProgress" role="progressbar" style="width: 33%"></div>
          </div>
          
          <!-- Registration Steps -->
          <form id="registrationForm" method="post" action="process/register_process.php" class="needs-validation" novalidate>
            <!-- Step 1: Basic Information -->
            <div class="registration-step" id="step1">
              <h4 class="mb-4 text-center"><i class="fas fa-user-circle mr-2"></i>Basic Information</h4>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" id="firstName" name="firstName" required>
                      <div class="invalid-feedback">Please enter your first name</div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" id="lastName" name="lastName" required>
                      <div class="invalid-feedback">Please enter your last name</div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" required>
                  <div class="invalid-feedback">Please enter a valid email</div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                  </div>
                  <input type="tel" class="form-control" id="mobile" name="mobile" required>
                  <div class="invalid-feedback">Please enter a valid mobile number</div>
                </div>
              </div>
              
              <div class="text-center mt-4">
                <button type="button" class="btn btn-primary btn-lg px-5" id="nextToStep2">
                  Continue <i class="fas fa-arrow-right ml-2"></i>
                </button>
              </div>
            </div>
            
            <!-- Step 2: Account Security -->
            <div class="registration-step" id="step2" style="display:none;">
              <h4 class="mb-4 text-center"><i class="fas fa-shield-alt mr-2"></i>Account Security</h4>
              
              <div class="form-group">
                <label for="password">Create Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" id="password" name="password" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                  <div class="invalid-feedback">Password must be at least 8 characters</div>
                </div>
                <div class="password-strength mt-2">
                  <div class="progress" style="height: 5px;">
                    <div class="progress-bar" id="passwordStrength" role="progressbar"></div>
                  </div>
                  <small class="text-muted" id="passwordStrengthText">Password strength: Weak</small>
                </div>
              </div>
              
              <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                  <div class="invalid-feedback">Passwords must match</div>
                </div>
              </div>
              
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">
                  I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a> and 
                  <a href="#" data-toggle="modal" data-target="#privacyModal">Privacy Policy</a>
                </label>
              </div>
              
              <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-secondary mr-3" id="backToStep1">
                  <i class="fas fa-arrow-left mr-2"></i> Back
                </button>
                <button type="button" class="btn btn-primary px-5" id="sendOtpBtn">
                  Send OTP <i class="fas fa-paper-plane ml-2"></i>
                </button>
              </div>
            </div>
            
            <!-- Step 3: OTP Verification -->
            <div class="registration-step" id="step3" style="display:none;">
              <h4 class="mb-4 text-center"><i class="fas fa-mobile-alt mr-2"></i>Mobile Verification</h4>
              
              <div class="alert alert-info">
                We've sent a 6-digit verification code to <strong id="displayMobile"></strong>
                <a href="#" id="changeMobile" class="float-right">Change</a>
              </div>
              
              <div class="form-group">
                <label for="otp">Enter Verification Code</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" id="otp" name="otp" maxlength="6" required>
                  <div class="invalid-feedback">Please enter the 6-digit code</div>
                </div>
                <small class="text-muted" id="otpTimer">Code expires in 05:00</small>
              </div>
              
              <div class="text-center mt-4">
                <button type="button" class="btn btn-outline-secondary mr-3" id="backToStep2">
                  <i class="fas fa-arrow-left mr-2"></i> Back
                </button>
                <button type="submit" class="btn btn-success px-5">
                  Complete Registration <i class="fas fa-check ml-2"></i>
                </button>
              </div>
              
              <div class="text-center mt-3">
                <p class="text-muted">Didn't receive code? <a href="#" id="resendOtp">Resend OTP</a></p>
              </div>
            </div>
          </form>
          
          <div class="text-center mt-4">
            <p>Already have an account? <a href="login.php">Sign In</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Terms of Service</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Terms content here -->
        <p>This is where your terms of service would appear...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">I Understand</button>
      </div>
    </div>
  </div>
</div>

<!-- Privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Privacy Policy</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Privacy policy content here -->
        <p>This is where your privacy policy would appear...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">I Understand</button>
      </div>
    </div>
  </div>
</div>
    </div> <!-- container -->

<style>
  body {
    background: #f8f9fa;
  }
  .card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
  }
  .card-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
  }
  .progress {
    border-radius: 10px;
  }
  .registration-step {
    padding: 0 1.5rem;
  }
  .input-group-text {
    background-color: #f8f9fa;
  }
  .toggle-password {
    cursor: pointer;
  }
  .password-strength .progress-bar {
    transition: width 0.3s ease, background-color 0.3s ease;
  }
  #passwordStrengthText {
    display: block;
    margin-top: 5px;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Password strength indicator
    $('#password').on('input', function() {
        var password = $(this).val();
        var strength = 0;
        
        // Length check
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        
        // Complexity checks
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 20;
        
        // Update UI
        var $bar = $('#passwordStrength');
        $bar.css('width', strength + '%');
        
        if (strength < 40) {
        $bar.removeClass('bg-success bg-warning').addClass('bg-danger');
        $('#passwordStrengthText').text('Password strength: Weak').removeClass('text-success text-warning').addClass('text-danger');
        } else if (strength < 70) {
        $bar.removeClass('bg-success bg-danger').addClass('bg-warning');
        $('#passwordStrengthText').text('Password strength: Moderate').removeClass('text-success text-danger').addClass('text-warning');
        } else {
        $bar.removeClass('bg-warning bg-danger').addClass('bg-success');
        $('#passwordStrengthText').text('Password strength: Strong').removeClass('text-warning text-danger').addClass('text-success');
        }
    });
    
    // Toggle password visibility
    $('.toggle-password').click(function() {
        var $input = $(this).closest('.input-group').find('input');
        var type = $input.attr('type') === 'password' ? 'text' : 'password';
        $input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
    
    // Form navigation
    $('#nextToStep2').click(function() {
        if ($('#step1')[0].checkValidity()) {
        $('#step1').hide();
        $('#step2').show();
        $('#regProgress').css('width', '66%');
        } else {
        $('#step1')[0].reportValidity();
        }
    });
    
    $('#backToStep1').click(function() {
        $('#step2').hide();
        $('#step1').show();
        $('#regProgress').css('width', '33%');
    });
    
    $('#backToStep2').click(function() {
        $('#step3').hide();
        $('#step2').show();
        $('#regProgress').css('width', '66%');
    });
    
    $('#changeMobile').click(function(e) {
        e.preventDefault();
        $('#step3').hide();
        $('#step1').show();
        $('#regProgress').css('width', '33%');
    });
    
    // OTP Flow
    $('#sendOtpBtn').click(function() {
        if ($('#step2')[0].checkValidity()) {
        // Verify passwords match
        if ($('#password').val() !== $('#confirmPassword').val()) {
            $('#confirmPassword').addClass('is-invalid');
            return;
        }
        
        // Verify terms are accepted
        if (!$('#terms').is(':checked')) {
            $('#terms').addClass('is-invalid');
            return;
        }
        
        // Show loading state
        var btn = $(this);
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span> Sending...');
        
        // Simulate OTP sending (replace with actual AJAX call)
        setTimeout(function() {
            // On success
            $('#displayMobile').text($('#mobile').val());
            $('#step2').hide();
            $('#step3').show();
            $('#regProgress').css('width', '100%');
            btn.prop('disabled', false);
            btn.html('Send OTP <i class="fas fa-paper-plane ml-2"></i>');
            
            // Start OTP timer
            startOtpTimer();
        }, 1500);
        } else {
        $('#step2')[0].reportValidity();
        }
    });
    
    // OTP Timer
    function startOtpTimer() {
        var minutes = 4;
        var seconds = 59;
        
        var timer = setInterval(function() {
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        
        $('#otpTimer').text('Code expires in ' + minutes + ":" + seconds);
        
        if (seconds == 0) {
            if (minutes == 0) {
            clearInterval(timer);
            $('#otpTimer').text('Code expired');
            return;
            }
            minutes--;
            seconds = 59;
        } else {
            seconds--;
        }
        }, 1000);
    }
    
    // Resend OTP
    $('#resendOtp').click(function(e) {
        e.preventDefault();
        $('#sendOtpBtn').click();
    });
    
    // Form submission
    $('#registrationForm').submit(function(e) {
        if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        }
        $(this).addClass('was-validated');
    });
    });
</script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>