<?php
require_once 'config.php';

// Handle form submission for adding new locations
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_location'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $type = $_POST['type'];
    
    $insertQuery = $pdo->prepare("INSERT INTO locations (name, address, lat, lng, type) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->execute([$name, $address, $lat, $lng, $type]);
    
    header('Location: index.php');
    exit;
}

// Handle location deletion
if (isset($_GET['delete_id'])) {
    $deleteQuery = $pdo->prepare("DELETE FROM locations WHERE id = ?");
    $deleteQuery->execute([$_GET['delete_id']]);
    
    header('Location: index.php');
    exit;
}

// Get all locations
$locationsQuery = $pdo->query("SELECT * FROM locations ORDER BY name");
$locations = $locationsQuery->fetchAll(PDO::FETCH_ASSOC);

// Convert locations to JSON for JavaScript
$locations_json = json_encode($locations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neighborhood Map</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&libraries=places"></script>
</head>
<body>
    <div class="container">
        <header>
            <h1>🗺️ Neighborhood Explorer</h1>
            <p>Discover and manage locations in your neighborhood</p>
        </header>

        <div class="main-content">
            <div class="sidebar">
                <div class="add-location-form">
                    <h3>Add New Location</h3>
                    <form method="POST" id="locationForm">
                        <input type="text" name="name" placeholder="Location Name" required>
                        <input type="text" name="address" id="autocomplete" placeholder="Address" required>
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">
                        <select name="type" required>
                            <option value="">Select Type</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Park">Park</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Hospital">Hospital</option>
                            <option value="School">School</option>
                            <option value="Library">Library</option>
                            <option value="Sports">Sports</option>
                            <option value="Community">Community</option>
                        </select>
                        <button type="submit" name="add_location">Add Location</button>
                    </form>
                </div>

                <div class="locations-list">
                    <h3>Locations</h3>
                    <div class="filter-controls">
                        <select id="filterType">
                            <option value="">All Types</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Park">Park</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Hospital">Hospital</option>
                            <option value="School">School</option>
                            <option value="Library">Library</option>
                            <option value="Sports">Sports</option>
                            <option value="Community">Community</option>
                        </select>
                        <input type="text" id="searchLocation" placeholder="Search locations...">
                    </div>
                    <div id="locationsContainer">
                        <?php foreach ($locations as $location): ?>
                            <div class="location-item" data-type="<?php echo $location['type']; ?>" data-name="<?php echo strtolower($location['name']); ?>">
                                <div class="location-info">
                                    <strong><?php echo htmlspecialchars($location['name']); ?></strong>
                                    <span class="location-type <?php echo strtolower($location['type']); ?>"><?php echo $location['type']; ?></span>
                                    <small><?php echo htmlspecialchars($location['address']); ?></small>
                                </div>
                                <div class="location-actions">
                                    <button class="view-btn" onclick="focusOnLocation(<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>, '<?php echo $location['name']; ?>')">View</button>
                                    <a href="?delete_id=<?php echo $location['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="map-container">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script>
        // Pass PHP data to JavaScript
        const locations = <?php echo $locations_json; ?>;
    </script>
    <script src="js/script.js"></script>
</body>
</html>