<?php 
include 'includes/header.php';
include 'config/database.php';

$database = new Database();
$db = $database->getConnection();
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Our Services</h1>
    
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4 service-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Regular Service</h4>
                            <p>Includes engine oil change, oil filter replacement, air filter cleaning, brake adjustment, chain adjustment, and basic checkup.</p>
                            <ul>
                                <li>Engine Oil Change</li>
                                <li>Oil Filter Replacement</li>
                                <li>Air Filter Cleaning</li>
                                <li>Brake Adjustment</li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-end">
                            <h3 class="text-success">₹499</h3>
                            <button class="btn btn-primary mt-3" onclick="bookService(1)">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 service-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Repair Service</h4>
                            <p>Professional repair for engine issues, electrical problems, starting trouble, and other mechanical repairs.</p>
                            <ul>
                                <li>Engine Troubleshooting</li>
                                <li>Electrical Repairs</li>
                                <li>Starting Issues</li>
                                <li>Mechanical Repairs</li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-end">
                            <h3 class="text-success">₹299</h3>
                            <small class="text-muted">+ parts cost</small>
                            <button class="btn btn-primary mt-3" onclick="bookService(2)">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 service-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Premium Service</h4>
                            <p>Complete bike detailing, advanced checkup, carburetor cleaning, spark plug replacement, and premium treatment.</p>
                            <ul>
                                <li>Complete Detailing</li>
                                <li>Carburetor Cleaning</li>
                                <li>Spark Plug Replacement</li>
                                <li>Advanced Checkup</li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-end">
                            <h3 class="text-success">₹799</h3>
                            <button class="btn btn-primary mt-3" onclick="bookService(3)">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function bookService(serviceId) {
    window.location.href = 'booking.php?service_id=' + serviceId;
}
</script>

<?php include 'includes/footer.php'; ?>