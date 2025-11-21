<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-motorcycle"></i> MotorServ</h5>
                <p>Professional motorcycle servicing at your doorstep. Quality service, convenience, and trust.</p>
                <div class="social-links">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h6>Services</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">Regular Service</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Repair Service</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Premium Service</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6>Company</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Contact</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact Info</h6>
                <p class="mb-1"><i class="fas fa-phone me-2"></i> +91 9876543210</p>
                <p class="mb-1"><i class="fas fa-envelope me-2"></i> support@motorserv.com</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Mumbai, India</p>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2024 MotorServ. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white-50 text-decoration-none me-3">Privacy Policy</a>
                <a href="#" class="text-white-50 text-decoration-none">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Form validation and interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Service price update
    const serviceSelect = document.querySelector('select[name="service_id"]');
    if(serviceSelect) {
        serviceSelect.addEventListener('change', function() {
            const prices = {1: 499, 2: 299, 3: 799};
            const priceDisplay = this.parentElement.querySelector('.price-display');
            if(priceDisplay) {
                priceDisplay.textContent = '₹' + prices[this.value];
            }
        });
    }

    // Date validation - disable past dates
    const dateInput = document.querySelector('input[type="date"]');
    if(dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
    }
});
</script>
</body>
</html>