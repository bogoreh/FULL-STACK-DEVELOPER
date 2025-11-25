<?php 
$pageTitle = "Contact Us";
include 'includes/header.php'; 
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-5">Contact Us</h1>
            
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <div class="contact-form">
                <form action="contact-process.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                </form>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                    <h5>Address</h5>
                    <p>123 Education Street<br>City, State 12345</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                    <h5>Phone</h5>
                    <p>+1 (555) 123-4567</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                    <h5>Email</h5>
                    <p>info@university.edu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>