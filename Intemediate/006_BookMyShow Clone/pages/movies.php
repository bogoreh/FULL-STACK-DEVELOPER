<?php
include_once '../config/database.php';
include_once '../classes/Movie.php';
include_once '../includes/auth.php';

$database = new Database();
$db = $database->getConnection();
$movie = new Movie($db);
$stmt = $movie->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Movies - BookMyShow Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1 class="page-title">All Movies</h1>
        
        <div class="filters">
            <select id="genreFilter">
                <option value="">All Genres</option>
                <option value="Action">Action</option>
                <option value="Comedy">Comedy</option>
                <option value="Drama">Drama</option>
                <option value="Thriller">Thriller</option>
            </select>
            
            <select id="languageFilter">
                <option value="">All Languages</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Tamil">Tamil</option>
                <option value="Telugu">Telugu</option>
            </select>
        </div>

        <div class="movies-grid">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="movie-card" data-genre="<?php echo $row['genre']; ?>" data-language="<?php echo $row['language']; ?>">
                <img src="<?php echo $row['poster_url']; ?>" alt="<?php echo $row['title']; ?>">
                <div class="movie-info">
                    <h3><?php echo $row['title']; ?></h3>
                    <p class="genre"><?php echo $row['genre']; ?> • <?php echo $row['language']; ?></p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <span><?php echo $row['rating']; ?>/10</span>
                    </div>
                    <a href="movie-details.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Book Tickets</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>