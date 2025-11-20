<?php
include_once '../config/database.php';
include_once '../classes/Movie.php';
include_once '../includes/auth.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);
$movie->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Movie ID not found.');

if($movie->readSingle()) {
    $shows = $movie->getShows();
} else {
    die('ERROR: Movie not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $movie->title; ?> - BookMyShow Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <div class="movie-detail">
            <div class="movie-poster">
                <img src="<?php echo $movie->poster_url; ?>" alt="<?php echo $movie->title; ?>">
            </div>
            <div class="movie-info-detail">
                <h1><?php echo $movie->title; ?></h1>
                <div class="movie-meta">
                    <span><i class="fas fa-clock"></i> <?php echo $movie->duration; ?> mins</span>
                    <span><i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($movie->release_date)); ?></span>
                    <span><i class="fas fa-language"></i> <?php echo $movie->language; ?></span>
                    <span><i class="fas fa-star"></i> <?php echo $movie->rating; ?>/10</span>
                </div>
                <p class="movie-description"><?php echo $movie->description; ?></p>
                <div class="genre-tags">
                    <?php $genres = explode(',', $movie->genre); ?>
                    <?php foreach($genres as $genre): ?>
                        <span class="genre-tag"><?php echo trim($genre); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="shows-section">
            <h2>Available Shows</h2>
            <?php if($shows->rowCount() > 0): ?>
                <div class="shows-list">
                    <?php while($show = $shows->fetch(PDO::FETCH_ASSOC)): ?>
                        <div class="show-card">
                            <div class="show-info">
                                <h3><?php echo $show['theater_name']; ?></h3>
                                <p><?php echo $show['location']; ?></p>
                                <div class="show-time">
                                    <span><?php echo date('M d, Y', strtotime($show['show_date'])); ?></span>
                                    <span><?php echo date('h:i A', strtotime($show['show_time'])); ?></span>
                                </div>
                                <p class="price">₹<?php echo $show['price']; ?> per ticket</p>
                                <p class="seats-available"><?php echo $show['available_seats']; ?> seats available</p>
                            </div>
                            <div class="show-actions">
                                <a href="booking.php?show_id=<?php echo $show['id']; ?>" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="no-shows">No shows available for this movie.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>