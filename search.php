<?php
// Initialize search parameters
include 'includes/header.php';

// Get search parameters from both POST and GET
$location = isset($_REQUEST['location_name']) ? trim($_REQUEST['location_name']) : '';
$start_date = isset($_REQUEST['start_date']) ? trim($_REQUEST['start_date']) : '';
$end_date = isset($_REQUEST['end_date']) ? trim($_REQUEST['end_date']) : '';
$occasion = isset($_REQUEST['occasionDropdown']) ? trim($_REQUEST['occasionDropdown']) : '';
$guests = isset($_REQUEST['no_guests']) ? intval($_REQUEST['no_guests']) : 0;
$category = isset($_REQUEST['category']) ? urldecode($_REQUEST['category']) : '';
$min_price = isset($_REQUEST['min_price']) ? floatval($_REQUEST['min_price']) : 0;
$max_price = isset($_REQUEST['max_price']) ? floatval($_REQUEST['max_price']) : 50000;

try {
    // Build base query
    $sql = "SELECT p.*, v.business_name, v.contact_phone, v.location as vendor_location, 
                   c.name as category_name 
            FROM products p
            LEFT JOIN vendors v ON p.vendor_id = v.id
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.is_visible = 1";
    
    $params = [];
    $types = '';

    // Add filters
    if (!empty($location)) {
        $sql .= " AND (p.location LIKE ? OR v.location LIKE ? OR v.business_name LIKE ?)";
        $locationTerm = "%$location%";
        $params = array_merge($params, [$locationTerm, $locationTerm, $locationTerm]);
        $types .= 'sss';
    }

    if (!empty($category)) {
        $sql .= " AND c.name = ?";
        $params[] = $category;
        $types .= 's';
    }

    if (!empty($occasion)) {
        $sql .= " AND (p.description LIKE ? OR p.name LIKE ?)";
        $occasionTerm = "%$occasion%";
        $params = array_merge($params, [$occasionTerm, $occasionTerm]);
        $types .= 'ss';
    }

    if ($guests > 0) {
        $sql .= " AND p.quantity >= ?";
        $params[] = $guests;
        $types .= 'i';
    }

    // Price range filter
    $sql .= " AND p.price BETWEEN ? AND ?";
    $params = array_merge($params, [$min_price, $max_price]);
    $types .= 'dd';

    // Date availability filter (if dates are provided)
    if (!empty($start_date) && !empty($end_date)) {
        $sql .= " AND p.id NOT IN (
                    SELECT product_id FROM product_bookings 
                    WHERE (
                        (start_date BETWEEN ? AND ?)
                        OR (end_date BETWEEN ? AND ?)
                        OR (? BETWEEN start_date AND end_date)
                        OR (? BETWEEN start_date AND end_date)
                    )
                )";
        $params = array_merge($params, [$start_date, $end_date, $start_date, $end_date, $start_date, $end_date]);
        $types .= 'ssssss';
    }

    // Add sorting options
    $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'featured';
    switch($sort) {
        case 'price_low':
            $sql .= " ORDER BY p.price ASC";
            break;
        case 'price_high':
            $sql .= " ORDER BY p.price DESC";
            break;
        case 'newest':
            $sql .= " ORDER BY p.created_at DESC";
            break;
        case 'name':
            $sql .= " ORDER BY p.name ASC";
            break;
        default: // featured first
            $sql .= " ORDER BY p.is_featured DESC, p.name ASC";
    }

    // Execute query
    $stmt = $database->preparedQuery($sql, $params, $types);
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Get all categories for filter
    $categories = $database->preparedQuery("SELECT * FROM categories WHERE is_active = 1")->get_result()->fetch_all(MYSQLI_ASSOC);

    // Get min and max prices for filter range
    $price_range = $database->preparedQuery("SELECT MIN(price) as min_price, MAX(price) as max_price FROM products WHERE is_visible = 1")
                           ->get_result()->fetch_assoc();

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Calculate pagination
$per_page = 12;
$total_products = count($products);
$total_pages = ceil($total_products / $per_page);
$current_page = isset($_GET['page']) ? max(1, min($total_pages, intval($_GET['page']))) : 1;
$offset = ($current_page - 1) * $per_page;
$paginated_products = array_slice($products, $offset, $per_page);

?>

<div class="container mt-4">
    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="search-form" method="post" action="search.php">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="location_name" class="form-control" placeholder="Where is your event?" value="<?= htmlspecialchars($location) ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="start_date" class="form-control datepicker" placeholder="Start date" value="<?= htmlspecialchars($start_date) ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="end_date" class="form-control datepicker" placeholder="End date" value="<?= htmlspecialchars($end_date) ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <select name="occasionDropdown" class="form-control">
                            <option value="">All Occasions</option>
                            <option value="Wedding" <?= $occasion === 'Wedding' ? 'selected' : '' ?>>Wedding</option>
                            <option value="Birthday" <?= $occasion === 'Birthday' ? 'selected' : '' ?>>Birthday</option>
                            <option value="Corporate" <?= $occasion === 'Corporate' ? 'selected' : '' ?>>Corporate</option>

                               <option class="dropdown-item" value="Wedding" <?= $occasion === 'Wedding' ? 'selected' : '' ?>>Wedding</option>
                                <option class="dropdown-item" value="Corporate" <?= $occasion === 'Corporate' ? 'selected' : '' ?>>Corporate Event</option>
                                <option class="dropdown-item" value="Birthday" <?= $occasion === 'Birthday' ? 'selected' : '' ?>>Birthday Party</option>
                                <option class="dropdown-item" value="Conference" <?= $occasion === 'Conference' ? 'selected' : '' ?>>Conference</option>
                                <option class="dropdown-item" value="Exhibition" <?= $occasion === 'Exhibition' ? 'selected' : '' ?>>Exhibition</option>
                                <option class="dropdown-item"value="Social" <?= $occasion === 'Social' ? 'selected' : '' ?>>Social Gathering</option>
                                <option class="dropdown-item" value="Other" <?= $occasion === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="no_guests" class="form-control" placeholder="No. of guests" value="<?= $guests ?>">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="search_btn" class="btn btn-success btn-block"><i class="fas fa-search"></i>
</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Filter Results</h5>
                </div>
                <div class="card-body">
                    <h6>Categories</h6>
                    <div class="list-group">
                        <a href="search.php" class="list-group-item list-group-item-action <?= empty($category) ? 'active' : '' ?>">All Categories</a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="search.php?category=<?= urlencode($cat['name']) ?>" class="list-group-item list-group-item-action <?= $category === $cat['name'] ? 'active' : '' ?>">
                                <?= htmlspecialchars($cat['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <h6 class="mt-3">Price Range</h6>
                    <div class="price-range">
                        <input type="range" class="form-range" min="0" max="50000" step="1000" id="priceRange" value="50000">
                        <div class="d-flex justify-content-between">
                            <span>₹0</span>
                            <span>₹50k</span>
                        </div>
                    </div>

                    <h6 class="mt-3">Availability</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inStock" checked>
                        <label class="form-check-label" for="inStock">In Stock</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="col-md-9">
            <?php if (!empty($category)): ?>
                <h4 class="mb-4"><?= htmlspecialchars($category) ?> Products</h4>
            <?php endif; ?>

            <div class="row">
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 product-card">
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    <?= $product['is_featured'] ? 'Featured' : 'Sale' ?>
                                </div>
                                <img src="images/products/<?= htmlspecialchars($product['id']) ?>.jpg" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>" style="height: 180px; object-fit: cover;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                        <?php if ($product['compare_price'] > $product['price']): ?>
                                            <span class="text-danger"><del>₹<?= number_format($product['compare_price'], 0) ?></del></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card-text text-muted"><?= htmlspecialchars($product['business_name']) ?></p>
                                    <p class="card-text small"><?= htmlspecialchars(substr($product['description'], 0, 80)) ?>...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-primary"><?= htmlspecialchars($product['category_name'] ?? 'General') ?></span>
                                            <span class="ms-2 text-warning">★★★★☆</span>
                                        </div>
                                        <h5 class="text-success mb-0">₹<?= number_format($product['price'], 0) ?></h5>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex justify-content-between">
                                        <a href="tel:<?= htmlspecialchars($product['contact_phone']) ?>" class="btn btn-sm btn-outline-primary">Contact</a>
                                        <form action="cart.php" method="post">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">No products found matching your criteria. Please try different search parameters.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery UI for datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        // Initialize datepicker
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });

        // Live filter functionality
        $("#priceRange").on('change', function() {
            const maxPrice = $(this).val();
            $('.product-card').each(function() {
                const price = parseFloat($(this).find('.text-success').text().replace('₹', '').replace(',', ''));
                if (price <= maxPrice) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });

        // In stock filter
        $("#inStock").on('change', function() {
            if ($(this).is(':checked')) {
                $('.product-card').each(function() {
                    // In a real implementation, you would check actual stock levels
                    $(this).parent().show();
                });
            } else {
                $('.product-card').parent().show();
            }
        });
    });
</script>

<?php 
include 'includes/footer.php';
$database->closeConnection();
?>