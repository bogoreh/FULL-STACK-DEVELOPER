<?php
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress - Delicious Food Delivery</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php"><i class="fas fa-utensils"></i> FoodExpress</a>
            </div>
            <div class="nav-menu">
                <a href="index.php" class="nav-link">Home</a>
                <a href="pages/menu.php" class="nav-link">Menu</a>
                <a href="pages/cart.php" class="nav-link cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    Cart <?php echo $cartCount > 0 ? "<span class='cart-count'>$cartCount</span>" : ""; ?>
                </a>
            </div>
        </div>
    </nav>

    <main class="main-content">