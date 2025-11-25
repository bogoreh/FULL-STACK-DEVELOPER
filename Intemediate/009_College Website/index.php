<?php 
$pageTitle = "Home";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to University Campus</h1>
        <p class="lead">Empowering students through quality education and innovative learning</p>
        <a href="courses.php" class="btn btn-light btn-lg mt-3">Explore Courses</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Quality Education</h3>
                <p>Comprehensive curriculum designed by industry experts</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Expert Faculty</h3>
                <p>Learn from experienced professors and industry professionals</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-laptop-house"></i>
                </div>
                <h3>Modern Facilities</h3>
                <p>State-of-the-art labs and learning environments</p>
            </div>
        </div>
    </div>
</section>

<!-- Quick Info Section -->
<section class="py-5 about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>About Our University</h2>
                <p>Founded in 1990, University Campus has been at the forefront of providing exceptional education to students from around the world. Our commitment to academic excellence and student success makes us a premier choice for higher education.</p>
                <a href="about.php" class="btn btn-primary">Learn More</a>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                     alt="University Campus" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>