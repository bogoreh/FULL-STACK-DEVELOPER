<?php
include 'config.php';

if (isset($_GET['code'])) {
    $access_code = $_GET['code'];
    
    // Find file by access code
    $stmt = $pdo->prepare("SELECT * FROM files WHERE access_code = ? AND expire_time > NOW()");
    $stmt->execute([$access_code]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($file) {
        // Update download count
        $stmt = $pdo->prepare("UPDATE files SET download_count = download_count + 1 WHERE id = ?");
        $stmt->execute([$file['id']]);
        
        // Serve file for download
        if (file_exists($file['file_path'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['original_name'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file['file_path']));
            readfile($file['file_path']);
            exit;
        } else {
            header("Location: index.php?message=File not found on server&type=error");
        }
    } else {
        header("Location: index.php?message=Invalid access code or file has expired&type=error");
    }
} else {
    header("Location: index.php");
}
?>