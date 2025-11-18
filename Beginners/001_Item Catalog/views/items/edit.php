<?php include '../views/header.php'; ?>

<h2><i class="fas fa-edit me-2"></i>Edit Item</h2>

<div class="card">
    <div class="card-body">
        <form action="index.php?action=edit" method="POST">
            <input type="hidden" name="id" value="<?php echo $item->id; ?>">
            
            <div class="mb-3">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?php echo htmlspecialchars($item->name); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="3" required><?php echo htmlspecialchars($item->description); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" 
                       value="<?php echo htmlspecialchars($item->price); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Electronics" <?php echo $item->category == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                    <option value="Clothing" <?php echo $item->category == 'Clothing' ? 'selected' : ''; ?>>Clothing</option>
                    <option value="Books" <?php echo $item->category == 'Books' ? 'selected' : ''; ?>>Books</option>
                    <option value="Home & Garden" <?php echo $item->category == 'Home & Garden' ? 'selected' : ''; ?>>Home & Garden</option>
                    <option value="Sports" <?php echo $item->category == 'Sports' ? 'selected' : ''; ?>>Sports</option>
                    <option value="Other" <?php echo $item->category == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Item
                </button>
                <a href="index.php?action=items" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Items
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../views/footer.php'; ?>