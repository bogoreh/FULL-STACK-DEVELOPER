<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $expire_hours = intval($_POST['expire_time']);
    
    // Validate file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        header("Location: index.php?message=File upload failed&type=error");
        exit;
    }
    
    // Check file size
    if ($file['size'] > MAX_FILE_SIZE) {
        header("Location: index.php?message=File is too large&type=error");
        exit;
    }
    
    // Check file type
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($file_extension, ALLOWED_TYPES)) {
        header("Location: index.php?message=File type not allowed&type=error");
        exit;
    }
    
    // Generate unique filename and access code
    $unique_name = uniqid() . '_' . time() . '.' . $file_extension;
    $access_code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    
    // Calculate expiration time
    $expire_time = date('Y-m-d H:i:s', strtotime("+$expire_hours hours"));
    
    // Move uploaded file
    $file_path = UPLOAD_DIR . $unique_name;
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Save file info to database
        $stmt = $pdo->prepare("INSERT INTO files (filename, original_name, file_path, file_size, expire_time, access_code) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$unique_name, $file['name'], $file_path, $file['size'], $expire_time, $access_code]);
        
        header("Location: index.php?message=File uploaded successfully! Your access code is: $access_code&type=success");
    } else {
        header("Location: index.php?message=Failed to save file&type=error");
    }
} else {
    header("Location: index.php");
}
?>