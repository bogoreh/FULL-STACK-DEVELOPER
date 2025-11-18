<?php
// Create uploads directory if it doesn't exist
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

// Allowed file types
$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
$max_file_size = 5 * 1024 * 1024; // 5MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        header('Location: index.php?error=Please select a valid image file');
        exit;
    }

    $file = $_FILES['image'];
    $file_type = $file['type'];
    $file_size = $file['size'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];

    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        header('Location: index.php?error=Only JPG, PNG, and GIF files are allowed');
        exit;
    }

    // Validate file size
    if ($file_size > $max_file_size) {
        header('Location: index.php?error=File size must be less than 5MB');
        exit;
    }

    // Generate unique filename
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_filename = uniqid() . '_' . date('Y-m-d') . '.' . $file_extension;

    // Move uploaded file
    $destination = 'uploads/' . $new_filename;
    
    if (move_uploaded_file($file_tmp, $destination)) {
        header('Location: index.php?success=1');
        exit;
    } else {
        header('Location: index.php?error=Failed to upload file. Please try again.');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>