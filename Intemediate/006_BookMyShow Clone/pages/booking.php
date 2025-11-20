<?php
include_once '../config/database.php';
include_once '../classes/Booking.php';
include_once '../includes/auth.php';

redirectIfNotLoggedIn();

$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);

if($_POST) {
    $booking->user_id = $_SESSION['user_id'];
    $booking->show_id = $_POST['show_id'];
    $booking->seats = $_POST['seats'];
    $booking->total_amount = $_POST['total_amount'];
    
    if($booking->create()) {
        header("Location: profile.php?booking_success=1");
    } else {
        echo "<div class='alert alert-danger'>Unable to create booking.</div>";
    }
}

$show_id = isset($_GET['show_id']) ? $_GET['show_id'] : die('ERROR: Show ID not found.');

// Fetch show details
$query = "SELECT s.*, m.title, t.name as theater_name, t.location 
          FROM shows s 
          JOIN movies m ON s.movie_id = m.id 
          JOIN theaters t ON s.theater_id = t.id 
          WHERE s.id = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $show_id);
$stmt->execute();
$show = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$show) {
    die('ERROR: Show not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets - BookMyShow Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1 class="page-title">Book Tickets</h1>
        
        <div class="booking-container">
            <div class="booking-summary">
                <h2>Booking Summary</h2>
                <div class="summary-details">
                    <h3><?php echo $show['title']; ?></h3>
                    <p><strong>Theater:</strong> <?php echo $show['theater_name']; ?></p>
                    <p><strong>Location:</strong> <?php echo $show['location']; ?></p>
                    <p><strong>Date:</strong> <?php echo date('M d, Y', strtotime($show['show_date'])); ?></p>
                    <p><strong>Time:</strong> <?php echo date('h:i A', strtotime($show['show_time'])); ?></p>
                    <p><strong>Price per ticket:</strong> ₹<?php echo $show['price']; ?></p>
                </div>
            </div>

            <div class="booking-form">
                <h2>Select Seats</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="show_id" value="<?php echo $show_id; ?>">
                    
                    <div class="form-group">
                        <label for="seats">Number of Seats:</label>
                        <select name="seats" id="seats" required>
                            <option value="">Select seats</option>
                            <?php for($i = 1; $i <= min(10, $show['available_seats']); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> seat(s)</option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Total Amount:</label>
                        <div id="totalAmount">₹0</div>
                        <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        document.getElementById('seats').addEventListener('change', function() {
            const seats = this.value;
            const price = <?php echo $show['price']; ?>;
            const total = seats * price;
            document.getElementById('totalAmount').textContent = '₹' + total;
            document.getElementById('totalAmountInput').value = total;
        });
    </script>
</body>
</html>