<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

$news = getNews(3);
?>

<div class="hero-section">
    <div class="hero-content">
        <h1>Welcome to TapNews</h1>
        <p>Your trusted source for the latest news and updates</p>
        <a href="news/index.php" class="btn btn-primary">Explore News</a>
    </div>
</div>

<section class="featured-news">
    <h2 class="section-title">Latest News</h2>
    <div class="news-grid">
        <?php foreach ($news as $item): ?>
        <div class="news-card">
            <?php if ($item['image_url']): ?>
            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="news-image">
            <?php endif; ?>
            <div class="news-content">
                <span class="news-category"><?php echo htmlspecialchars($item['category']); ?></span>
                <h3 class="news-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                <p class="news-excerpt"><?php echo substr(htmlspecialchars($item['content']), 0, 100); ?>...</p>
                <a href="news/view.php?id=<?php echo $item['id']; ?>" class="read-more">Read More</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>