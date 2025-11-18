<?php include 'config.php'; 

// Get event ID from URL
$eventId = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Find the event (in real app, this would be a database query)
$event = null;
foreach($events as $ev) {
    if($ev['id'] == $eventId) {
        $event = $ev;
        break;
    }
}

// If event not found, redirect to events page
if(!$event) {
    header('Location: events.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['title']; ?> - EventHub</title>
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
                        <a href="events.php" class="nav-link">All Events</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Event Detail -->
    <section class="event-detail">
        <div class="container">
            <div class="event-detail-content">
                <div class="event-detail-image">
                    <img src="<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
                </div>
                <div class="event-detail-info">
                    <span class="event-category"><?php echo $event['category']; ?></span>
                    <h1><?php echo $event['title']; ?></h1>
                    <p class="event-description"><?php echo $event['description']; ?></p>
                    
                    <div class="event-details-meta">
                        <div class="detail-meta-item">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <strong>Date</strong>
                                <span><?php echo date('l, F j, Y', strtotime($event['date'])); ?></span>
                            </div>
                        </div>
                        <div class="detail-meta-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Time</strong>
                                <span><?php echo $event['time']; ?></span>
                            </div>
                        </div>
                        <div class="detail-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Location</strong>
                                <span><?php echo $event['location']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="event-actions">
                        <button class="btn btn-primary btn-large">
                            <i class="fas fa-ticket-alt"></i> Register Now
                        </button>
                        <button class="btn btn-secondary">
                            <i class="fas fa-share"></i> Share Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 EventHub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>