<?php
include('connections/localhost.php');
?>
<!-- Professional Navigation Bar -->
<nav class="bg-white shadow-xl sticky top-0 z-50 border-b border-gray-100">
	<div class="container mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between items-center py-3 sm:py-4">
			<!-- Logo -->
			<div class="flex items-center flex-shrink-0">
				<a href="index.php" class="flex items-center space-x-2 text-xl sm:text-2xl font-bold text-transparent bg-gradient-to-r from-orange-500 to-red-600 bg-clip-text hover:from-orange-600 hover:to-red-700 transition duration-300">
					<span class="hidden sm:inline">TeeStyle Hub</span>
					<span class="sm:hidden">TSH</span>
				</a>
			</div>

			<!-- Desktop Navigation -->
			<div class="hidden lg:flex items-center space-x-6 xl:space-x-8 ml-12">
				<a href="index.php" class="text-gray-700 hover:text-orange-600 font-medium transition duration-300 relative group py-2">
					<i class="fas fa-home mr-1"></i>Home
					<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
				</a>
				<a href="categories.php" class="text-gray-700 hover:text-orange-600 font-medium transition duration-300 relative group py-2">
					<i class="fas fa-th-large mr-1"></i>Categories
					<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
				</a>
				<a href="contact.php" class="text-gray-700 hover:text-orange-600 font-medium transition duration-300 relative group py-2">
					<i class="fas fa-envelope mr-1"></i>Contact Us
					<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
				</a>
			</div>

			<!-- User Actions -->
			<div class="flex items-center space-x-2 sm:space-x-4">
				<?php if (isset($_SESSION['email'])): ?>
					<?php
					// Get cart count
					$email = mysqli_real_escape_string($conn, $_SESSION['email']);
					$query = "SELECT COUNT(*) AS count FROM `cart` WHERE `customer_email`='$email'";
					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
					$cartCount = (int) mysqli_fetch_assoc($result)["count"];
					?>

					<!-- Cart -->
					<a href="cart.php" class="relative text-gray-700 hover:text-orange-600 transition duration-300 p-2 rounded-full hover:bg-orange-50 hidden sm:flex">
						<i class="fas fa-shopping-cart text-lg sm:text-xl"></i>
						<?php if ($cartCount > 0): ?>
							<span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
								<?php echo $cartCount; ?>
							</span>
						<?php endif; ?>
					</a>

					<!-- User Dropdown -->
					<div class="relative hidden sm:block" id="user-dropdown">
						<button id="user-menu-button" class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 transition duration-300 p-2 rounded-full hover:bg-orange-50">
							<i class="fas fa-user-circle text-lg sm:text-xl"></i>
							<i class="fas fa-chevron-down text-sm"></i>
						</button>

						<!-- Dropdown Menu -->
						<div id="user-menu" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 hidden z-50">
							<div class="p-4 border-b border-gray-100">
								<div class="flex items-center space-x-3">
									<div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
										<i class="fas fa-user text-white"></i>
									</div>
									<div>
										<p class="font-semibold text-gray-800"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
										<p class="text-sm text-gray-600"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
									</div>
								</div>
							</div>
							<div class="py-2">
								<a href="myaccount.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition duration-300">
									<i class="fas fa-tachometer-alt mr-3 w-5"></i>Dashboard
								</a>
								<a href="myorders.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition duration-300">
									<i class="fas fa-box-open mr-3 w-5"></i>My Orders
								</a>
								<a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition duration-300">
									<i class="fas fa-heart mr-3 w-5"></i>Wishlist
								</a>
								<a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition duration-300">
									<i class="fas fa-cog mr-3 w-5"></i>Settings
								</a>
								<div class="border-t border-gray-100 my-2"></div>
								<a href="logout.php" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition duration-300">
									<i class="fas fa-sign-out-alt mr-3 w-5"></i>Logout
								</a>
							</div>
						</div>
					</div>
				<?php else: ?>
					<!-- Login/Register for non-logged users -->
					<div class="hidden sm:flex items-center space-x-2">
						<a href="login.php" class="text-gray-700 hover:text-orange-600 font-medium transition duration-300 px-3 py-2 rounded-lg hover:bg-orange-50 text-sm">
							<i class="fas fa-sign-in-alt mr-1"></i>Login
						</a>
						<a href="register.php" class="bg-gradient-to-r from-orange-500 to-red-600 text-white font-medium px-4 py-2 rounded-lg hover:from-orange-600 hover:to-red-700 transition duration-300 transform hover:scale-105 text-sm">
							<i class="fas fa-user-plus mr-1"></i>Sign Up
						</a>
					</div>
				<?php endif; ?>

				<!-- Mobile Menu Button -->
				<button id="mobile-menu-button" class="text-gray-700 hover:text-orange-600 transition duration-300 p-2 rounded-lg hover:bg-orange-50 lg:hidden">
					<i class="fas fa-bars text-lg sm:text-xl"></i>
				</button>
			</div>
		</div>

		<!-- Mobile Search Bar -->
		<div class="md:hidden pb-4">
			<div class="relative">
				<input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300">
				<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
			</div>
		</div>
	</div>

	<!-- Mobile Menu -->
	<div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-100 overflow-hidden transition-all duration-300 ease-in-out max-h-0">
		<div class="px-4 py-6 space-y-4">
			<!-- Navigation Links -->
			<div class="space-y-2">
				<a href="index.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
					<i class="fas fa-home mr-3 w-5"></i>Home
				</a>
				<a href="categories.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
					<i class="fas fa-th-large mr-3 w-5"></i>Categories
				</a>
				<a href="contact.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
					<i class="fas fa-envelope mr-3 w-5"></i>Contact Us
				</a>
			</div>

			<?php if (isset($_SESSION['email'])): ?>
				<!-- User Section for Mobile -->
				<div class="border-t border-gray-200 pt-4 mt-4">
					<div class="flex items-center space-x-3 mb-4 p-3 bg-gray-50 rounded-lg">
						<div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
							<i class="fas fa-user text-white"></i>
						</div>
						<div class="flex-1 min-w-0">
							<p class="font-semibold text-gray-800 text-sm truncate"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
							<p class="text-xs text-gray-600 truncate"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
						</div>
					</div>

					<div class="space-y-2">
						<a href="myaccount.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
							<i class="fas fa-tachometer-alt mr-3 w-5"></i>Dashboard
						</a>
						<a href="myorders.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
							<i class="fas fa-box-open mr-3 w-5"></i>My Orders
						</a>
						<a href="cart.php" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
							<i class="fas fa-shopping-cart mr-3 w-5"></i>Cart
							<?php if ($cartCount > 0): ?>
								<span class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
									<?php echo $cartCount; ?>
								</span>
							<?php endif; ?>
						</a>
						<a href="#" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
							<i class="fas fa-heart mr-3 w-5"></i>Wishlist
						</a>
						<a href="#" class="flex items-center text-gray-700 hover:text-orange-600 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-orange-50">
							<i class="fas fa-cog mr-3 w-5"></i>Settings
						</a>
						<div class="border-t border-gray-200 my-3"></div>
						<a href="logout.php" class="flex items-center text-red-600 hover:text-red-700 font-medium transition duration-300 py-3 px-2 rounded-lg hover:bg-red-50">
							<i class="fas fa-sign-out-alt mr-3 w-5"></i>Logout
						</a>
					</div>
				</div>
			<?php else: ?>
				<!-- Auth Section for Mobile -->
				<div class="border-t border-gray-200 pt-4 mt-4 space-y-3">
					<a href="login.php" class="flex items-center justify-center w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition duration-300 py-3 px-4 rounded-lg">
						<i class="fas fa-sign-in-alt mr-2"></i>Login
					</a>
					<a href="register.php" class="flex items-center justify-center w-full bg-gradient-to-r from-orange-500 to-red-600 text-white font-medium transition duration-300 py-3 px-4 rounded-lg hover:from-orange-600 hover:to-red-700">
						<i class="fas fa-user-plus mr-2"></i>Sign Up
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</nav>
<!-- End of Navigation Bar -->

<script type="application/javascript">
	function loginFirst() {
		window.alert("Please login first!");
		window.location.replace("login.php");
	}

	// Mobile menu toggle with smooth animation
	document.getElementById('mobile-menu-button').addEventListener('click', function() {
		var menu = document.getElementById('mobile-menu');
		var button = document.getElementById('mobile-menu-button');
		var icon = button.querySelector('i');

		if (menu.classList.contains('max-h-0')) {
			menu.classList.remove('max-h-0');
			menu.classList.add('max-h-screen');
			icon.classList.remove('fa-bars');
			icon.classList.add('fa-times');
		} else {
			menu.classList.remove('max-h-screen');
			menu.classList.add('max-h-0');
			icon.classList.remove('fa-times');
			icon.classList.add('fa-bars');
		}
	});

	// User dropdown toggle
	<?php if (isset($_SESSION['email'])): ?>
	document.getElementById('user-menu-button').addEventListener('click', function() {
		var menu = document.getElementById('user-menu');
		menu.classList.toggle('hidden');
	});

	// Close dropdown when clicking outside
	document.addEventListener('click', function(event) {
		var userDropdown = document.getElementById('user-dropdown');
		var menu = document.getElementById('user-menu');
		if (!userDropdown.contains(event.target)) {
			menu.classList.add('hidden');
		}
	});
	<?php endif; ?>

	// Close mobile menu when clicking on a link
	document.querySelectorAll('#mobile-menu a').forEach(function(link) {
		link.addEventListener('click', function() {
			var menu = document.getElementById('mobile-menu');
			var button = document.getElementById('mobile-menu-button');
			var icon = button.querySelector('i');

			menu.classList.remove('max-h-screen');
			menu.classList.add('max-h-0');
			icon.classList.remove('fa-times');
			icon.classList.add('fa-bars');
		});
	});

	// Close mobile menu on window resize if desktop size
	window.addEventListener('resize', function() {
		var menu = document.getElementById('mobile-menu');
		var button = document.getElementById('mobile-menu-button');
		var icon = button.querySelector('i');

		if (window.innerWidth >= 1024) { // lg breakpoint
			menu.classList.remove('max-h-screen');
			menu.classList.add('max-h-0');
			icon.classList.remove('fa-times');
			icon.classList.add('fa-bars');
		}
	});
</script>