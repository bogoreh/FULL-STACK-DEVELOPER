document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const fileName = document.getElementById('file-name');
    const uploadForm = document.querySelector('.upload-form');
    const uploadBtn = document.querySelector('.upload-btn');
    
    // File input change handler
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            fileName.textContent = file.name;
            
            // Add file size info
            const fileSize = (file.size / (1024 * 1024)).toFixed(2);
            fileName.textContent = `${file.name} (${fileSize} MB)`;
            
            // Validate file size visually
            if (file.size > 5 * 1024 * 1024) {
                fileName.style.color = '#f87171';
            } else {
                fileName.style.color = '#cbd5e1';
            }
        } else {
            fileName.textContent = 'No file chosen';
            fileName.style.color = '#cbd5e1';
        }
    });
    
    // Form submission handler
    uploadForm.addEventListener('submit', function(e) {
        if (fileInput.files.length === 0) {
            e.preventDefault();
            showError('Please select a file first!');
            return;
        }
        
        const file = fileInput.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        if (file.size > maxSize) {
            e.preventDefault();
            showError('File size must be less than 5MB!');
            return;
        }
        
        // Show loading state
        if (uploadBtn) {
            const originalText = uploadBtn.innerHTML;
            uploadBtn.innerHTML = '<div class="loading"></div> Uploading...';
            uploadBtn.disabled = true;
            
            // Revert after 5 seconds if still on page (fallback)
            setTimeout(() => {
                uploadBtn.innerHTML = originalText;
                uploadBtn.disabled = false;
            }, 5000);
        }
    });
    
    // Drag and drop functionality
    const fileLabel = document.querySelector('.file-label');
    
    fileLabel.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#6366f1';
        this.style.background = '#374151';
    });
    
    fileLabel.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#475569';
        this.style.background = '#2d3748';
    });
    
    fileLabel.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#475569';
        this.style.background = '#2d3748';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
    
    // Button hover effects
    if (uploadBtn) {
        uploadBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        uploadBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
    
    // Feature card hover effects
    const features = document.querySelectorAll('.feature');
    features.forEach(feature => {
        feature.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        feature.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Helper function to show error messages
    function showError(message) {
        // Remove existing alerts first
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new error alert
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert error';
        errorAlert.innerHTML = `❌ ${message}`;
        
        // Insert after subtitle
        const subtitle = document.querySelector('.subtitle');
        subtitle.parentNode.insertBefore(errorAlert, subtitle.nextSibling);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            errorAlert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                errorAlert.remove();
            }, 500);
        }, 5000);
    }
});