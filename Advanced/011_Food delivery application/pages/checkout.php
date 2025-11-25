<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$cartItems = getCartItems();
$total = getCartTotal();

if (empty($cartItems)) {
    header('Location: cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $notes = trim($_POST['notes'] ?? '');
    
    // Basic validation
    $errors = [];
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($phone)) $errors[] = "Phone number is required";
    if (empty($address)) $errors[] = "Delivery address is required";
    
    if (empty($errors)) {
        try {
            $deliveryFee = 2.99;
            $tax = $total * 0.085;
            $finalTotal = $total + $deliveryFee + $tax;
            
            // Insert order
            $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, total_amount) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $address, $finalTotal]);
            $orderId = $pdo->lastInsertId();
            
            // Insert order items
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($cartItems as $item) {
                $stmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
            }
            
            // Clear cart and redirect to success page
            clearCart();
            header('Location: order-success.php?order_id=' . $orderId);
            exit;
            
        } catch (PDOException $e) {
            $error = "Error placing order: " . $e->getMessage();
        }
    } else {
        $error = implode("<br>", $errors);
    }
}
?>
<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Checkout</h1>
        <p class="section-subtitle">Complete your order with delivery information</p>
    </div>

    <div class="checkout-layout">
        <div class="checkout-form">
            <h2><i class="fas fa-truck"></i> Delivery Information</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Full Name *</label>
                        <input type="text" id="name" name="name" required 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email Address *</label>
                        <input type="email" id="email" name="email" required
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Delivery Address *</label>
                    <textarea id="address" name="address" rows="4" required placeholder="Please include apartment number, floor, and any specific instructions"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="notes"><i class="fas fa-sticky-note"></i> Delivery Notes (Optional)</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Any special instructions for delivery?"><?php echo isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; ?></textarea>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane"></i> Place Order & Pay
                    </button>
                    <p class="security-guarantee">
                        <i class="fas fa-shield-alt"></i>
                        Your payment information is secure and encrypted
                    </p>
                </div>
            </form>
        </div>
        
        <div class="order-summary">
            <h2><i class="fas fa-receipt"></i> Order Summary</h2>
            <div class="summary-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="summary-item">
                        <div class="item-image">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>
                        <div class="item-details">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p>Qty: <?php echo $item['quantity']; ?> × $<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                        <div class="item-total">
                            $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="summary-totals">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Delivery Fee:</span>
                    <span>$2.99</span>
                </div>
                <div class="summary-row">
                    <span>Tax (8.5%):</span>
                    <span>$<?php echo number_format($total * 0.085, 2); ?></span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-row total">
                    <span>Total Amount:</span>
                    <span>$<?php echo number_format($total + 2.99 + ($total * 0.085), 2); ?></span>
                </div>
            </div>
            
            <div class="delivery-info">
                <h4><i class="fas fa-clock"></i> Estimated Delivery</h4>
                <p>25-35 minutes</p>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>