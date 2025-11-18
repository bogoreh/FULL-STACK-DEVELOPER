<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_POST) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = $_POST['category'] ?? '';
    $image_url = $_POST['image_url'] ?? '';

    if (!empty($title) && !empty($content) && !empty($category)) {
        if (addNews($title, $content, $category, $image_url)) {
            header("Location: index.php");
            exit();
        }
    }
}

require_once '../includes/header.php';
?>

<div class="admin-header">
    <h1>Add New Article</h1>
    <a href="index.php" class="btn btn-secondary">← Back to Admin</a>
</div>

<form method="POST" class="news-form">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category" name="category" required>
    </div>

    <div class="form-group">
        <label for="image_url">Image URL (optional)</label>
        <input type="url" id="image_url" name="image_url">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Publish Article</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php require_once '../includes/footer.php'; ?>