<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$cartItems = getCartItems();
$total = getCartTotal();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $itemId => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION['cart'][$itemId]);
            } else {
                $_SESSION['cart'][$itemId] = $quantity;
            }
        }
        header('Location: cart.php');
        exit;
    } elseif (isset($_POST['clear_cart'])) {
        clearCart();
        header('Location: cart.php');
        exit;
    }
}
?>
<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Your Shopping Cart</h1>
        <p class="section-subtitle">Review your items and proceed to checkout</p>
    </div>

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added any delicious items to your cart yet.</p>
            <div class="empty-cart-actions">
                <a href="menu.php" class="btn btn-primary"><i class="fas fa-utensils"></i> Browse Menu</a>
                <a href="../index.php" class="btn btn-outline"><i class="fas fa-home"></i> Back to Home</a>
            </div>
        </div>
    <?php else: ?>
        <form method="POST" class="cart-form">
            <div class="cart-items">
                <div class="cart-header">
                    <div class="header-product">Product</div>
                    <div class="header-price">Price</div>
                    <div class="header-quantity">Quantity</div>
                    <div class="header-total">Total</div>
                    <div class="header-action">Action</div>
                </div>
                
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="item-product">
                            <div class="product-image">
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            </div>
                            <div class="product-details">
                                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="product-category"><?php echo htmlspecialchars($item['category']); ?></p>
                            </div>
                        </div>
                        <div class="item-price">
                            $<?php echo number_format($item['price'], 2); ?>
                        </div>
                        <div class="item-quantity">
                            <input type="number" name="quantity[<?php echo $item['id']; ?>]" 
                                   value="<?php echo $item['quantity']; ?>" min="0" max="10"
                                   class="quantity-input">
                        </div>
                        <div class="item-total">
                            $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                        <div class="item-action">
                            <button type="submit" name="update_cart" class="btn-remove" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <div class="summary-card">
                    <h3><i class="fas fa-receipt"></i> Order Summary</h3>
                    <div class="summary-details">
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
                    
                    <div class="cart-actions">
                        <button type="submit" name="update_cart" class="btn btn-secondary">
                            <i class="fas fa-sync-alt"></i> Update Cart
                        </button>
                        <button type="submit" name="clear_cart" class="btn btn-outline" 
                                onclick="return confirm('Are you sure you want to clear your cart?')">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                        <a href="checkout.php" class="btn btn-primary btn-checkout">
                            <i class="fas fa-lock"></i> Proceed to Checkout
                        </a>
                    </div>
                    
                    <div class="security-notice">
                        <i class="fas fa-shield-alt"></i>
                        <span>Your payment information is secure and encrypted</span>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>