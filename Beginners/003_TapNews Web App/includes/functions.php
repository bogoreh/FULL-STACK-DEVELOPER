<?php
function getNews($limit = 10) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM news ORDER BY created_at DESC LIMIT :limit";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNewsById($id) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM news WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addNews($title, $content, $category, $image_url = '') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO news (title, content, category, image_url) VALUES (:title, :content, :category, :image_url)";
    $stmt = $db->prepare($query);
    
    return $stmt->execute([
        ':title' => $title,
        ':content' => $content,
        ':category' => $category,
        ':image_url' => $image_url
    ]);
}

function deleteNews($id) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "DELETE FROM news WHERE id = :id";
    $stmt = $db->prepare($query);
    
    return $stmt->execute([':id' => $id]);
}
?>