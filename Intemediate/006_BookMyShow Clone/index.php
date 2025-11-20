<?php
include_once 'config/database.php';
include_once 'classes/Movie.php';
include_once 'includes/auth.php';

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
    <title>BookMyShow Clone - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="hero-section">
        <div class="hero-content">
            <h1>Book Your Movie Tickets</h1>
            <p>Discover the latest movies and book your seats in advance</p>
            <a href="pages/movies.php" class="btn btn-primary">Browse Movies</a>
        </div>
    </div>

    <div class="container">
        <h2 class="section-title">Now Showing</h2>
        <div class="movies-grid">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="movie-card">
                <img src="<?php echo $row['poster_url']; ?>" alt="<?php echo $row['title']; ?>">
                <div class="movie-info">
                    <h3><?php echo $row['title']; ?></h3>
                    <p class="genre"><?php echo $row['genre']; ?></p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <span><?php echo $row['rating']; ?>/10</span>
                    </div>
                    <a href="pages/movie-details.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">View Details</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>