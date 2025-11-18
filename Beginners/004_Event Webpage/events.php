<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events - EventHub</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <h2><i class="fas fa-calendar-alt"></i> EventHub</h2>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="events.php" class="nav-link active">All Events</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Events Section -->
    <section class="events-section">
        <div class="container">
            <h1 class="page-title">All Events</h1>
            <div class="events-grid">
                <?php foreach($events as $event): ?>
                <div class="event-card">
                    <div class="event-image">
                        <img src="<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
                        <span class="event-category"><?php echo $event['category']; ?></span>
                    </div>
                    <div class="event-content">
                        <h3><?php echo $event['title']; ?></h3>
                        <p><?php echo $event['description']; ?></p>
                        <div class="event-meta">
                            <div class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <span><?php echo date('F j, Y', strtotime($event['date'])); ?></span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span><?php echo $event['time']; ?></span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo $event['location']; ?></span>
                            </div>
                        </div>
                        <a href="event-detail.php?id=<?php echo $event['id']; ?>" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 EventHub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>