<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
?>
<?php include 'includes/header.php'; ?>

<div class="hero-section">
    <div class="hero-content">
        <h1>Delicious Food Delivered to Your Door</h1>
        <p>Fast delivery, restaurant-quality meals, and prices that will make you smile. Order now and taste the difference!</p>
        <div class="hero-buttons">
            <a href="pages/menu.php" class="btn btn-primary"><i class="fas fa-utensils"></i> Order Now</a>
            <a href="pages/menu.php" class="btn btn-outline"><i class="fas fa-eye"></i> View Menu</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&h=400&fit=crop" alt="Delicious Food">
    </div>
</div>

<div class="container">
    <section class="features-section">
        <h2>Why Choose FoodExpress?</h2>
        <p class="section-subtitle">We're not just delivering food, we're delivering happiness</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Lightning Fast</h3>
                <p>Average delivery time under 30 minutes. We value your time as much as you do.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Fresh Ingredients</h3>
                <p>Only the freshest ingredients make it to your plate. Quality is our promise.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <h3>Best Prices</h3>
                <p>Gourmet quality at fast-food prices. Great value without compromise.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Premium Quality</h3>
                <p>Every dish is prepared with care and attention to detail by our expert chefs.</p>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <h2>Popular Categories</h2>
        <p class="section-subtitle">Explore our delicious offerings</p>
        <div class="categories-grid">
            <a href="pages/menu.php?category=Pizza" class="category-card">
                <div class="category-image">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=300&h=200&fit=crop" alt="Pizza">
                    <div class="category-overlay">
                        <h3>Pizza</h3>
                        <p>From classic Margherita to gourmet specialties</p>
                    </div>
                </div>
            </a>
            <a href="pages/menu.php?category=Burgers" class="category-card">
                <div class="category-image">
                    <img src="https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?w=300&h=200&fit=crop" alt="Burgers">
                    <div class="category-overlay">
                        <h3>Burgers</h3>
                        <p>Juicy, flavorful, and perfectly crafted</p>
                    </div>
                </div>
            </a>
            <a href="pages/menu.php?category=Salads" class="category-card">
                <div class="category-image">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300&h=200&fit=crop" alt="Salads">
                    <div class="category-overlay">
                        <h3>Salads</h3>
                        <p>Fresh, crisp, and full of flavor</p>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">5000+</div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">15 min</div>
                <div class="stat-label">Avg. Delivery Time</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Menu Items</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Service Available</div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>