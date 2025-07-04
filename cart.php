<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i>Your Event Cart</h3>
                </div>
                <div class="card-body">
                    <!-- Cart Items -->
                    <div class="cart-items">
                        <!-- Sample Cart Item 1 -->
                        <div class="cart-item border-bottom pb-3 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" 
                                         alt="Banquet Hall" class="img-fluid rounded">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="mb-1">Grand Ballroom</h5>
                                    <p class="mb-1 text-muted">Banquet Hall</p>
                                    <p class="mb-1"><small>Date: Sat, 15 Jul 2023</small></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                        <input type="text" class="form-control text-center quantity" value="1" readonly>
                                        <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h5 class="mb-0">₹25,000</h5>
                                    <button class="btn btn-sm btn-outline-danger mt-2"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sample Cart Item 2 -->
                        <div class="cart-item border-bottom pb-3 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://images.unsplash.com/photo-1555244162-803834f70033?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" 
                                         alt="Decoration" class="img-fluid rounded">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="mb-1">Floral Decor Package</h5>
                                    <p class="mb-1 text-muted">Decoration</p>
                                    <p class="mb-1"><small>Date: Sat, 15 Jul 2023</small></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                        <input type="text" class="form-control text-center quantity" value="1" readonly>
                                        <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h5 class="mb-0">₹12,000</h5>
                                    <button class="btn btn-sm btn-outline-danger mt-2"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Empty Cart Message (hidden by default) -->
                    <div class="empty-cart text-center py-5" style="display: none;">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h4>Your cart is empty</h4>
                        <p class="text-muted">Browse our services to add items to your cart</p>
                        <a href="services.php" class="btn btn-primary mt-3">Explore Services</a>
                    </div>
                </div>
            </div>
            
            <!-- Coupon Code -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tag mr-2"></i>Apply Coupon</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter coupon code">
                        <button class="btn btn-success" type="button">Apply</button>
                    </div>
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
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>₹37,000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount:</span>
                        <span class="text-success">-₹2,000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (5%):</span>
                        <span>₹1,750</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Delivery Fee:</span>
                        <span>₹500</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total:</h5>
                        <h5>₹37,250</h5>
                    </div>
                    <a href="checkout.php" class="btn btn-primary btn-lg w-100 py-3">
                        <i class="fas fa-credit-card mr-2"></i>Proceed to Checkout
                    </a>
                    <p class="text-center text-muted mt-3">
                        <i class="fas fa-lock mr-2"></i>Secure payment processing
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cart-item {
        transition: all 0.3s ease;
    }
    
    .cart-item:hover {
        background-color: #f8f9fa;
    }
    
    .quantity {
        max-width: 50px;
    }
    
    .minus-btn, .plus-btn {
        width: 40px;
    }
    
    .sticky-top {
        z-index: 1;
    }
    
    .empty-cart {
        display: none !important;
    }
    
    @media (max-width: 768px) {
        .cart-item .col-md-2 {
            margin-bottom: 1rem;
        }
    }
</style>

<script>
    // Quantity adjustment functionality
    document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('.quantity');
            input.value = parseInt(input.value) + 1;
            updateCartTotal();
        });
    });
    
    document.querySelectorAll('.minus-btn').forEach(button => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('.quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateCartTotal();
            }
        });
    });
    
    // Remove item functionality
    document.querySelectorAll('.btn-outline-danger').forEach(button => {
        button.addEventListener('click', (e) => {
            e.target.closest('.cart-item').remove();
            checkEmptyCart();
            updateCartTotal();
        });
    });
    
    // Check if cart is empty
    function checkEmptyCart() {
        const cartItems = document.querySelectorAll('.cart-item');
        const emptyCart = document.querySelector('.empty-cart');
        
        if (cartItems.length === 0) {
            emptyCart.style.display = 'block';
        } else {
            emptyCart.style.display = 'none';
        }
    }
    
    // Update cart total (simplified for demo)
    function updateCartTotal() {
        // In a real implementation, you would calculate based on actual prices
        console.log('Cart updated');
    }
</script>

<?php include 'includes/footer.php'; ?>