<?php include_once 'views/layout/header.php'; ?>

<div class="hero-section bg-light py-5 mb-5">
    <div class="container text-center">
        <h1 class="display-4 text-primary">Welcome to Item Catalog</h1>
        <p class="lead">Manage your inventory with our simple and powerful catalog system</p>
        <a href="index.php?action=items" class="btn btn-primary btn-lg mt-3">
            <i class="fas fa-boxes"></i> Browse Items
        </a>
        <a href="index.php?action=create" class="btn btn-outline-primary btn-lg mt-3">
            <i class="fas fa-plus"></i> Add New Item
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <i class="fas fa-list fa-3x text-primary mb-3"></i>
                <h3 class="card-title">Easy Management</h3>
                <p class="card-text">Add, edit, and manage your items with our intuitive interface.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-success mb-3"></i>
                <h3 class="card-title">Quick Search</h3>
                <p class="card-text">Find your items quickly with our organized catalog system.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 text-center">
            <div class="card-body">
                <i class="fas fa-mobile-alt fa-3x text-info mb-3"></i>
                <h3 class="card-title">Responsive Design</h3>
                <p class="card-text">Access your catalog from any device, anywhere, anytime.</p>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/layout/footer.php'; ?>