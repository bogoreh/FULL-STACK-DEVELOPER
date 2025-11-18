<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$news = getNewsById($_GET['id']);

if (!$news) {
    header("Location: index.php");
    exit();
}

require_once '../includes/header.php';
?>

<article class="news-detail">
    <div class="news-header">
        <span class="news-category"><?php echo htmlspecialchars($news['category']); ?></span>
        <h1 class="news-title"><?php echo htmlspecialchars($news['title']); ?></h1>
        <div class="news-meta">
            <span class="news-date">Published on <?php echo date('F j, Y', strtotime($news['created_at'])); ?></span>
        </div>
    </div>

    <?php if ($news['image_url']): ?>
    <div class="news-image-full">
        <img src="<?php echo htmlspecialchars($news['image_url']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
    </div>
    <?php endif; ?>

    <div class="news-content">
        <?php echo nl2br(htmlspecialchars($news['content'])); ?>
    </div>

    <div class="news-actions">
        <a href="index.php" class="btn btn-secondary">← Back to News</a>
    </div>
</article>

<?php require_once '../includes/footer.php'; ?>