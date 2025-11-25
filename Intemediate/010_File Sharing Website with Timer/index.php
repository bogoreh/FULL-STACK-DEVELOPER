<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileShare - Simple File Sharing</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>FileShare</h1>
            <p>Share files with expiration timer</p>
        </header>

        <div class="upload-section">
            <h2>Upload a File</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="form-group">
                    <label for="file">Select File:</label>
                    <input type="file" name="file" id="file" required>
                </div>
                
                <div class="form-group">
                    <label for="expire_time">File Expires After:</label>
                    <select name="expire_time" id="expire_time" required>
                        <option value="1">1 Hour</option>
                        <option value="6">6 Hours</option>
                        <option value="24" selected>1 Day</option>
                        <option value="168">1 Week</option>
                    </select>
                </div>
                
                <button type="submit" id="uploadBtn">Upload File</button>
            </form>
        </div>

        <div class="download-section">
            <h2>Download a File</h2>
            <form action="download.php" method="get" id="downloadForm">
                <div class="form-group">
                    <label for="access_code">Enter Access Code:</label>
                    <input type="text" name="code" id="access_code" placeholder="Enter access code" required>
                </div>
                <button type="submit">Download File</button>
            </form>
        </div>

        <?php
        // Display success/error messages
        if (isset($_GET['message'])) {
            $message = htmlspecialchars($_GET['message']);
            $type = isset($_GET['type']) ? $_GET['type'] : 'info';
            echo "<div class='message $type'>$message</div>";
        }
        ?>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>