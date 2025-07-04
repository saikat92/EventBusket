<?php
session_start();
include 'config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get user data
$user = [];
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Get customer addresses
$addresses = [];
$stmt = $db->prepare("SELECT * FROM customer_addresses WHERE customer_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get order history
$orders = [];
$stmt = $db->prepare("SELECT id, order_date, total_amount, status FROM orders WHERE customer_id = ? ORDER BY order_date DESC LIMIT 5");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Sidebar -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" alt="Profile" class="rounded-circle mb-3">
                    <h4><?= htmlspecialchars($user['first_name'] . ' ' . htmlspecialchars($user['last_name'])) ?></h4>
                    <p class="text-muted">Member since <?= date('F Y', strtotime($user['created_at'])) ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="profile.php" class="text-dark">Dashboard</a></li>
                    <li class="list-group-item"><a href="orders.php" class="text-dark">My Orders</a></li>
                    <li class="list-group-item"><a href="addresses.php" class="text-dark">Addresses</a></li>
                    <li class="list-group-item"><a href="settings.php" class="text-dark">Account Settings</a></li>
                    <li class="list-group-item"><a href="logout.php" class="text-danger">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Profile Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Profile Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? 'Not provided') ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Default Address:</strong></p>
                            <?php if (!empty($addresses)): ?>
                                <?php $default_address = array_filter($addresses, fn($addr) => $addr['is_default'])[0] ?? $addresses[0]; ?>
                                <address>
                                    <?= htmlspecialchars($default_address['address_line1']) ?><br>
                                    <?= !empty($default_address['address_line2']) ? htmlspecialchars($default_address['address_line2']) . '<br>' : '' ?>
                                    <?= htmlspecialchars($default_address['city']) ?>, <?= htmlspecialchars($default_address['state']) ?><br>
                                    <?= htmlspecialchars($default_address['postal_code']) ?><br>
                                    <?= htmlspecialchars($default_address['country']) ?>
                                </address>
                            <?php else: ?>
                                <p>No address saved</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Recent Orders</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($orders)): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?= $order['id'] ?></td>
                                            <td><?= date('M d, Y', strtotime($order['order_date'])) ?></td>
                                            <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                            <td><span class="badge bg-<?= 
                                                $order['status'] === 'completed' ? 'success' : 
                                                ($order['status'] === 'processing' ? 'primary' : 'warning') 
                                            ?>"><?= ucfirst($order['status']) ?></span></td>
                                            <td><a href="order_details.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="orders.php" class="btn btn-primary">View All Orders</a>
                    <?php else: ?>
                        <p>You haven't placed any orders yet.</p>
                        <a href="products.php" class="btn btn-primary">Start Shopping</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>