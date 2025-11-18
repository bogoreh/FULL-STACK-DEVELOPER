<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'neighborhood_map');
define('DB_USER', 'root');
define('DB_PASS', '');

// Google Maps API Key (you need to get this from Google Cloud Console)
define('GOOGLE_MAPS_API_KEY', 'YOUR_GOOGLE_MAPS_API_KEY_HERE');

// Create database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create locations table if it doesn't exist
$createTableQuery = "
CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    lat DECIMAL(10, 8) NOT NULL,
    lng DECIMAL(11, 8) NOT NULL,
    type VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$pdo->exec($createTableQuery);

// Insert sample data if table is empty
$checkDataQuery = "SELECT COUNT(*) FROM locations";
$count = $pdo->query($checkDataQuery)->fetchColumn();

if ($count == 0) {
    $sampleData = [
        ['Central Park', 'Central Park, New York, NY', 40.785091, -73.968285, 'Park'],
        ['Public Library', '455 5th Ave, New York, NY', 40.752726, -73.982451, 'Library'],
        ['City Mall', '100 W 33rd St, New York, NY', 40.750504, -73.990282, 'Shopping'],
        ['Community Center', '321 E 111th St, New York, NY', 40.793076, -73.940048, 'Community'],
        ['Main Hospital', '622 W 168th St, New York, NY', 40.841747, -73.939948, 'Hospital'],
        ['Downtown Cafe', '241 W 72nd St, New York, NY', 40.779054, -73.984472, 'Restaurant'],
        ['Sports Complex', '1 E 161st St, Bronx, NY', 40.829643, -73.926175, 'Sports']
    ];
    
    $insertQuery = $pdo->prepare("INSERT INTO locations (name, address, lat, lng, type) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($sampleData as $data) {
        $insertQuery->execute($data);
    }
}
?>