<?php
include 'config.php';

// Delete expired files
$stmt = $pdo->prepare("SELECT * FROM files WHERE expire_time <= NOW()");
$stmt->execute();
$expired_files = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($expired_files as $file) {
    if (file_exists($file['file_path'])) {
        unlink($file['file_path']);
    }
}

// Delete expired records from database
$stmt = $pdo->prepare("DELETE FROM files WHERE expire_time <= NOW()");
$stmt->execute();

echo "Expired files cleaned up successfully.";
?>