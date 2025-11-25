<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$category = isset($_GET['category']) ? $_GET['category'] : null;
$menuItems = getMenuItems($category);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemId = $_POST['item_id'];
    $quantity = $_POST['quantity'] ?? 1;
    addToCart($itemId, $quantity);
    header('Location: menu.php' . ($category ? '?category=' . urlencode($category) : ''));
    exit;
}
?>
<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Our Delicious Menu</h1>
        <p class="section-subtitle">Fresh ingredients, amazing flavors, unforgettable experiences</p>
        <div class="category-filters">
            <a href="menu.php" class="filter-btn <?php echo !$category ? 'active' : ''; ?>">All Items</a>
            <a href="menu.php?category=Pizza" class="filter-btn <?php echo $category === 'Pizza' ? 'active' : ''; ?>"><i class="fas fa-pizza-slice"></i> Pizza</a>
            <a href="menu.php?category=Burgers" class="filter-btn <?php echo $category === 'Burgers' ? 'active' : ''; ?>"><i class="fas fa-hamburger"></i> Burgers</a>
            <a href="menu.php?category=Salads" class="filter-btn <?php echo $category === 'Salads' ? 'active' : ''; ?>"><i class="fas fa-leaf"></i> Salads</a>
            <a href="menu.php?category=Sides" class="filter-btn <?php echo $category === 'Sides' ? 'active' : ''; ?>"><i class="fas fa-french-fries"></i> Sides</a>
            <a href="menu.php?category=Drinks" class="filter-btn <?php echo $category === 'Drinks' ? 'active' : ''; ?>"><i class="fas fa-glass-whiskey"></i> Drinks</a>
        </div>
    </div>

    <?php if ($category): ?>
        <div class="category-header">
            <h2><?php echo htmlspecialchars($category); ?></h2>
            <p>Discover our amazing selection of <?php echo strtolower(htmlspecialchars($category)); ?></p>
        </div>
    <?php endif; ?>

    <div class="menu-grid">
        <?php if (empty($menuItems)): ?>
            <div class="no-items">
                <i class="fas fa-search"></i>
                <h3>No items found</h3>
                <p>We couldn't find any items in this category. Please try another category.</p>
                <a href="menu.php" class="btn btn-primary">View All Menu</a>
            </div>
        <?php else: ?>
            <?php foreach ($menuItems as $item): ?>
                <div class="menu-item">
                    <div class="item-image">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="item-badge">Popular</div>
                    </div>
                    <div class="item-info">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="item-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="item-meta">
                            <span class="item-category"><?php echo htmlspecialchars($item['category']); ?></span>
                            <span class="item-rating">
                                <i class="fas fa-star"></i> 4.5
                            </span>
                        </div>
                        <div class="item-footer">
                            <div class="item-price">$<?php echo number_format($item['price'], 2); ?></div>
                            <form method="POST" class="add-to-cart-form">
                                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                <div class="quantity-selector">
                                    <button type="button" class="qty-btn minus" onclick="decreaseQuantity(<?php echo $item['id']; ?>)">-</button>
                                    <input type="number" name="quantity" id="quantity_<?php echo $item['id']; ?>" value="1" min="1" max="10" readonly>
                                    <button type="button" class="qty-btn plus" onclick="increaseQuantity(<?php echo $item['id']; ?>)">+</button>
                                </div>
                                <button type="submit" name="add_to_cart" class="btn btn-primary add-to-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function increaseQuantity(itemId) {
    const input = document.getElementById('quantity_' + itemId);
    if (parseInt(input.value) < 10) {
        input.value = parseInt(input.value) + 1;
    }
}

function decreaseQuantity(itemId) {
    const input = document.getElementById('quantity_' + itemId);
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>

<?php include '../includes/footer.php'; ?>