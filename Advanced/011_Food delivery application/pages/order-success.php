<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$orderId = $_GET['order_id'] ?? null;

if (!$orderId) {
    header('Location: menu.php');
    exit;
}

// Get order details
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header('Location: menu.php');
    exit;
}

// Get order items
$stmt = $pdo->prepare("
    SELECT mi.name, mi.image_url, oi.quantity, oi.price 
    FROM order_items oi 
    JOIN menu_items mi ON oi.menu_item_id = mi.id 
    WHERE oi.order_id = ?
");
$stmt->execute([$orderId]);
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="success-page">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Order Placed Successfully!</h1>
        <p class="success-message">Thank you for your order! We're preparing your food with love and it will be delivered to your doorstep soon.</p>
        
        <div class="order-details-card">
            <h2><i class="fas fa-receipt"></i> Order Details</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label">Order ID:</span>
                    <span class="detail-value">#<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Customer Name:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order['customer_name']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order['customer_email']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order['customer_phone']); ?></span>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Delivery Address:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order['customer_address']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value price">$<?php echo number_format($order['total_amount'], 2); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Order Status:</span>
                    <span class="detail-value status status-<?php echo $order['status']; ?>">
                        <i class="fas fa-clock"></i> <?php echo ucfirst($order['status']); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="order-items">
            <h3>Order Items</h3>
            <div class="items-list">
                <?php foreach ($orderItems as $item): ?>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>
                        <div class="item-info">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                        </div>
                        <div class="item-price">
                            $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="delivery-estimate">
            <div class="estimate-card">
                <i class="fas fa-shipping-fast"></i>
                <div class="estimate-info">
                    <h4>Estimated Delivery Time</h4>
                    <p>25-35 minutes</p>
                </div>
            </div>
        </div>
        
        <div class="success-actions">
            <a href="menu.php" class="btn btn-primary">
                <i class="fas fa-utensils"></i> Order Again
            </a>
            <a href="../index.php" class="btn btn-outline">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>

        <div class="support-notice">
            <p><i class="fas fa-headset"></i> Need help? Contact our support team at +1 (555) 123-4567</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>