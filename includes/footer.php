<!-- Professional Footer -->
<footer class="bg-gray-900 text-white mt-auto">
    <!-- Main Footer Content -->
    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-store text-2xl text-orange-500"></i>
                        <span class="text-xl font-bold">TeeStyle Hub</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Your premier destination for men's fashion. Discover quality garments, trendy styles, and exceptional service for every occasion.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-orange-600 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-500 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Home</a></li>
                        <li><a href="categories.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Categories</a></li>
                        <li><a href="categoryview.php?category=tshirts" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">T-Shirts</a></li>
                        <li><a href="categoryview.php?category=shirts" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Shirts</a></li>
                        <li><a href="categoryview.php?category=pants" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Pants</a></li>
                        <li><a href="contact.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white">Customer Service</h3>
                    <ul class="space-y-2">
                        <?php if (isset($_SESSION['email'])): ?>
                            <li><a href="myaccount.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">My Account</a></li>
                            <li><a href="myorders.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">My Orders</a></li>
                            <li><a href="cart.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Shopping Cart</a></li>
                        <?php else: ?>
                            <li><a href="login.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Login</a></li>
                            <li><a href="register.php" class="text-gray-300 hover:text-orange-400 transition duration-300 text-sm">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Contact & Newsletter -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white">Stay Connected</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-orange-500 mt-1"></i>
                            <div>
                                <p class="text-gray-300 text-sm">L&T Byepass</p>
                                <p class="text-gray-300 text-sm">SIET, Coimbatore-62</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-orange-500"></i>
                            <p class="text-gray-300 text-sm">+91 96006 334811</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-orange-500"></i>
                            <p class="text-gray-300 text-sm">kellijoe2602@gmail.com</p>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="pt-4 border-t border-gray-700">
                        <p class="text-gray-300 text-sm mb-3">Subscribe to our newsletter</p>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 bg-gray-800 border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm">
                            <button class="bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-r-lg transition duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods & Bottom Bar -->
    <div class="border-t border-gray-800 py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Payment Methods -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400 text-sm font-medium">We Accept:</span>
                    <div class="flex items-center space-x-2">
                        <i class="fab fa-cc-visa text-2xl text-blue-400"></i>
                        <i class="fab fa-cc-mastercard text-2xl text-red-400"></i>
                        <i class="fab fa-cc-paypal text-2xl text-blue-600"></i>
                        <i class="fab fa-cc-amex text-2xl text-blue-500"></i>
                        <i class="fas fa-credit-card text-2xl text-gray-400"></i>
                    </div>
                </div>

                <!-- Copyright & Links -->
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-6 text-sm text-gray-400">
                    <p>&copy; 2025 TeeStyle Hub. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-orange-400 transition duration-300">Privacy Policy</a>
                        <a href="#" class="hover:text-orange-400 transition duration-300">Terms of Service</a>
                        <a href="admin/adminlogin.php" class="hover:text-orange-400 transition duration-300">
                            <i class="fas fa-cog mr-1"></i>Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-orange-600 hover:bg-orange-700 text-white p-3 rounded-full shadow-lg transition duration-300 transform opacity-0 translate-y-4">
        <i class="fas fa-arrow-up"></i>
    </button>
</footer>

<script>
    // Back to Top Button
    window.addEventListener('scroll', function() {
        const backToTop = document.getElementById('back-to-top');
        if (window.pageYOffset > 300) {
            backToTop.classList.remove('opacity-0', 'translate-y-4');
            backToTop.classList.add('opacity-100', 'translate-y-0');
        } else {
            backToTop.classList.remove('opacity-100', 'translate-y-0');
            backToTop.classList.add('opacity-0', 'translate-y-4');
        }
    });

    document.getElementById('back-to-top').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Newsletter Signup
    document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
        e.preventDefault();
        const email = this.previousElementSibling.value;
        if (email) {
            alert('Thank you for subscribing! We\'ll keep you updated with the latest fashion trends.');
            this.previousElementSibling.value = '';
        } else {
            alert('Please enter a valid email address.');
        }
    });
</script>