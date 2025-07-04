<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-credit-card mr-2"></i>Checkout</h3>
                </div>
                <div class="card-body">
                    <!-- Progress Steps -->
                    <ul class="nav nav-pills nav-fill mb-4" id="checkoutSteps">
                        <li class="nav-item">
                            <span class="nav-link active"><i class="fas fa-user-circle mr-2"></i>Details</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link disabled"><i class="fas fa-truck mr-2"></i>Delivery</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link disabled"><i class="fas fa-credit-card mr-2"></i>Payment</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link disabled"><i class="fas fa-check-circle mr-2"></i>Complete</span>
                        </li>
                    </ul>

                    <!-- Customer Information -->
                    <h5 class="mb-3"><i class="fas fa-user mr-2"></i>Your Information</h5>
                    <form id="checkoutForm">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <h5 class="mb-3"><i class="fas fa-calendar-alt mr-2"></i>Event Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="eventDate" class="form-label">Event Date</label>
                                <input type="date" class="form-control" id="eventDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="specialRequests" class="form-label">Special Requests</label>
                                <textarea class="form-control" id="specialRequests" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <h5 class="mb-3"><i class="fas fa-credit-card mr-2"></i>Payment Method</h5>
                        <div class="payment-methods mb-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label" for="creditCard">
                                    <i class="fab fa-cc-visa mr-2"></i>Credit/Debit Card
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                <label class="form-check-label" for="paypal">
                                    <i class="fab fa-cc-paypal mr-2"></i>PayPal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer">
                                <label class="form-check-label" for="bankTransfer">
                                    <i class="fas fa-university mr-2"></i>Bank Transfer
                                </label>
                            </div>
                        </div>

                        <!-- Card Details (shown by default) -->
                        <div id="cardDetails">
                            <div class="row mb-3">
                                <div class="col-12 mb-3">
                                    <label for="cardNumber" class="form-label">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="123">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="cardName" class="form-label">Name on Card</label>
                                    <input type="text" class="form-control" id="cardName">
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-lock mr-2"></i>Complete Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="cart-items mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Grand Ballroom</span>
                            <span>₹25,000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Floral Decor Package</span>
                            <span>₹12,000</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>₹37,000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (5%):</span>
                        <span>₹1,850</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Service Fee:</span>
                        <span>₹500</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total:</h5>
                        <h5>₹39,350</h5>
                    </div>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>Your payment is secure
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
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>This is where your terms and conditions would appear...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<style>
    #checkoutSteps .nav-link {
        color: #6c757d;
        padding: 0.75rem 0.5rem;
    }
    
    #checkoutSteps .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
    }
    
    #checkoutSteps .nav-link.disabled {
        color: #6c757d;
    }
    
    .payment-methods .form-check-label {
        display: flex;
        align-items: center;
    }
    
    .sticky-top {
        z-index: 1;
    }
    
    @media (max-width: 768px) {
        #checkoutSteps .nav-item {
            margin-bottom: 0.5rem;
        }
    }
</style>

<script>
    // Toggle payment method details
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const cardDetails = document.getElementById('cardDetails');
            if (this.id === 'creditCard') {
                cardDetails.style.display = 'block';
            } else {
                cardDetails.style.display = 'none';
            }
        });
    });
    
    // Form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // In a real implementation, you would validate and process the payment
        alert('Payment would be processed here in a real implementation');
    });
</script>

<?php include 'includes/footer.php'; ?>