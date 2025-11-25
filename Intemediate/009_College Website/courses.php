<?php 
$pageTitle = "Courses";
include 'includes/header.php'; 

// Sample courses data
$courses = [
    [
        'title' => 'Computer Science',
        'description' => 'Learn programming, algorithms, and software development',
        'duration' => '4 years',
        'image' => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ],
    [
        'title' => 'Business Administration',
        'description' => 'Master business principles and management strategies',
        'duration' => '3 years',
        'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ],
    [
        'title' => 'Mechanical Engineering',
        'description' => 'Study mechanical systems and engineering principles',
        'duration' => '4 years',
        'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ],
    [
        'title' => 'Psychology',
        'description' => 'Explore human behavior and mental processes',
        'duration' => '3 years',
        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ],
    [
        'title' => 'Graphic Design',
        'description' => 'Develop creative design skills and visual communication',
        'duration' => '2 years',
        'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ],
    [
        'title' => 'Environmental Science',
        'description' => 'Study environmental systems and sustainability',
        'duration' => '4 years',
        'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
    ]
];
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Our Courses</h1>
    
    <div class="row">
        <?php foreach($courses as $course): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card course-card h-100">
                <img src="<?php echo $course['image']; ?>" class="card-img-top" alt="<?php echo $course['title']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $course['title']; ?></h5>
                    <p class="card-text"><?php echo $course['description']; ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary"><?php echo $course['duration']; ?></span>
                        <button class="btn btn-outline-primary btn-sm">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>