<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/header.php';

$news = getNews(50);
?>

<div class="admin-header">
    <h1>Admin Panel</h1>
    <a href="add_news.php" class="btn btn-primary">Add New Article</a>
</div>

<div class="admin-news-list">
    <table class="news-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars($item['category']); ?></td>
                <td><?php echo date('M j, Y', strtotime($item['created_at'])); ?></td>
                <td class="actions">
                    <a href="../news/view.php?id=<?php echo $item['id']; ?>" class="btn btn-sm">View</a>
                    <a href="delete_news.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>