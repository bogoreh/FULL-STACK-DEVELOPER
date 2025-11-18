<?php include 'views/header.php'; ?>

<div class="hero-section text-center py-5 bg-light rounded">
    <h1 class="display-4 text-primary">Welcome to Item Catalog</h1>
    <p class="lead">Manage your inventory with ease</p>
    <div class="mt-4">
        <a href="index.php?action=items" class="btn btn-primary btn-lg me-2">
            <i class="fas fa-list"></i> View All Items
        </a>
        <a href="index.php?action=create" class="btn btn-success btn-lg">
            <i class="fas fa-plus"></i> Add New Item
        </a>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-box fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Easy Management</h5>
                <p class="card-text">Add, edit, and delete items effortlessly</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-success mb-3"></i>
                <h5 class="card-title">Quick Search</h5>
                <p class="card-text">Find your items quickly and efficiently</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-chart-bar fa-3x text-warning mb-3"></i>
                <h5 class="card-title">Organized</h5>
                <p class="card-text">Keep your inventory well organized</p>
            </div>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>