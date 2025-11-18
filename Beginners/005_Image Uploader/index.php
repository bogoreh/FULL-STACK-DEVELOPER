<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Image Uploader</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="upload-card">
            <h1>🌙 Image Uploader</h1>
            <p class="subtitle">Upload your images securely in dark mode</p>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert success">
                    ✅ Image uploaded successfully!
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert error">
                    ❌ <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-form">
                <div class="file-input-wrapper">
                    <input type="file" name="image" id="image" accept="image/*" required>
                    <label for="image" class="file-label">
                        <span class="file-button">Choose Image</span>
                        <span class="file-name" id="file-name">No file chosen</span>
                    </label>
                </div>
                
                <button type="submit" class="upload-btn">
                    <span>Upload Image</span>
                </button>
            </form>

            <div class="features">
                <div class="feature">
                    <span>🖼️</span>
                    <p>Supports JPG, PNG, GIF</p>
                </div>
                <div class="feature">
                    <span>📏</span>
                    <p>Max 5MB file size</p>
                </div>
                <div class="feature">
                    <span>🔒</span>
                    <p>Secure uploads</p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>