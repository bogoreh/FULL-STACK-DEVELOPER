document.addEventListener('DOMContentLoaded', function() {
    const uploadForm = document.getElementById('uploadForm');
    const fileInput = document.getElementById('file');
    const uploadBtn = document.getElementById('uploadBtn');
    
    // File input change event
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Validate file size
            const maxSize = 50 * 1024 * 1024; // 50MB
            if (file.size > maxSize) {
                alert('File is too large. Maximum size is 50MB.');
                this.value = '';
                return;
            }
            
            // Validate file type
            const allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt', 'zip'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(fileExtension)) {
                alert('File type not allowed. Allowed types: ' + allowedTypes.join(', '));
                this.value = '';
                return;
            }
        }
    });
    
    // Form submission
    uploadForm.addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (!file) {
            e.preventDefault();
            alert('Please select a file to upload.');
            return;
        }
        
        // Show loading state
        uploadBtn.disabled = true;
        uploadBtn.textContent = 'Uploading...';
    });
    
    // Auto-hide messages after 5 seconds
    const messages = document.querySelectorAll('.message');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000);
    });
});