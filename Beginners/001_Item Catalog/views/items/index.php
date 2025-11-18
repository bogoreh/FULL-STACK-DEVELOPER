<?php include '../views/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-boxes me-2"></i>All Items</h2>
    <a href="index.php?action=create" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Item
    </a>
</div>

<?php if(empty($items)): ?>
    <div class="alert alert-info text-center">
        <i class="fas fa-info-circle me-2"></i>No items found. <a href="index.php?action=create">Add your first item!</a>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach($items as $item): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 item-card">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="mb-2">
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($item['category']); ?></span>
                        </div>
                        <h6 class="text-success">$<?php echo number_format($item['price'], 2); ?></h6>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100">
                            <a href="index.php?action=edit&id=<?php echo $item['id']; ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?action=delete&id=<?php echo $item['id']; ?>" 
                               class="btn btn-outline-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include '../views/footer.php'; ?>