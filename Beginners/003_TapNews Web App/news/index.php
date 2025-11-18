<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/header.php';

$news = getNews(20);
?>

<div class="page-header">
    <h1>All News</h1>
    <p>Stay updated with our latest articles</p>
</div>

<div class="news-list">
    <?php foreach ($news as $item): ?>
    <article class="news-item">
        <div class="news-item-content">
            <span class="news-category"><?php echo htmlspecialchars($item['category']); ?></span>
            <h2 class="news-title">
                <a href="view.php?id=<?php echo $item['id']; ?>">
                    <?php echo htmlspecialchars($item['title']); ?>
                </a>
            </h2>
            <p class="news-excerpt"><?php echo substr(htmlspecialchars($item['content']), 0, 150); ?>...</p>
            <div class="news-meta">
                <span class="news-date"><?php echo date('F j, Y', strtotime($item['created_at'])); ?></span>
                <a href="view.php?id=<?php echo $item['id']; ?>" class="read-more">Read Full Story</a>
            </div>
        </div>
        <?php if ($item['image_url']): ?>
        <div class="news-item-image">
            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
        </div>
        <?php endif; ?>
    </article>
    <?php endforeach; ?>
</div>

<?php require_once '../includes/footer.php'; ?>