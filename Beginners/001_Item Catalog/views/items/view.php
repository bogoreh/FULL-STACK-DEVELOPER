<?php include_once 'views/layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="fas fa-eye"></i> Item Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Name:</div>
                    <div class="col-sm-9"><?php echo htmlspecialchars($this->item->name); ?></div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Category:</div>
                    <div class="col-sm-9">
                        <span class="badge bg-primary"><?php echo htmlspecialchars($this->item->category); ?></span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Price:</div>
                    <div class="col-sm-9">
                        <h5 class="text-success">$<?php echo htmlspecialchars($this->item->price); ?></h5>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Description:</div>
                    <div class="col-sm-9">
                        <p class="lead"><?php echo nl2br(htmlspecialchars($this->item->description)); ?></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3 fw-bold">Added:</div>
                    <div class="col-sm-9 text-muted">
                        <?php echo date('F j, Y \a\t g:i A', strtotime($this->item->created_at)); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="index.php?action=items" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                    <a href="index.php?action=edit&id=<?php echo $this->item->id; ?>" class="btn btn-warning me-md-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="index.php?action=delete&id=<?php echo $this->item->id; ?>" class="btn btn-danger"
                       onclick="return confirm('Are you sure you want to delete this item?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/layout/footer.php'; ?>