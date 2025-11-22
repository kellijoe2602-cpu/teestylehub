<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
	echo "<script>alert('Please login first!') </script>";
	echo "<script>open('login.php', '_self') </script>";
}
include('connections/localhost.php');

// Get user information
$userEmail = mysqli_real_escape_string($conn, $_SESSION['email']);
$userQuery = "SELECT * FROM customers WHERE email = '$userEmail'";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_array($userResult);

// Get order statistics
$ordersQuery = "SELECT COUNT(*) as total_orders FROM orders WHERE customer_email = '$userEmail'";
$ordersResult = mysqli_query($conn, $ordersQuery);
$ordersData = mysqli_fetch_array($ordersResult);

// Get cart items count
$cartQuery = "SELECT COUNT(*) as cart_items FROM cart WHERE customer_email = '$userEmail'";
$cartResult = mysqli_query($conn, $cartQuery);
$cartData = mysqli_fetch_array($cartResult);

// Get recent orders (last 5)
$recentOrdersQuery = "SELECT orders.*, products.productname, products.price
                     FROM orders
                     INNER JOIN products ON orders.product_id = products.productID
                     WHERE orders.customer_email = '$userEmail'
                     ORDER BY orders.date_added DESC LIMIT 5";
$recentOrdersResult = mysqli_query($conn, $recentOrdersQuery);
?>

<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<body class="bg-gray-50 min-h-screen flex flex-col">
<main class="flex-grow">
	<!-- Hero Section -->
	<section class="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 text-white py-16">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-between">
				<div>
					<h1 class="text-4xl font-bold mb-2">
						<i class="fas fa-user-circle mr-3"></i>Welcome back, <?php echo htmlspecialchars($_SESSION['name']); ?>!
					</h1>
					<p class="text-xl opacity-90">Manage your account and track your orders</p>
				</div>
				<div class="hidden md:block">
					<div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-4">
						<div class="text-center">
							<i class="fas fa-calendar-alt text-2xl mb-2"></i>
							<p class="text-sm opacity-90">Member since</p>
							<p class="font-semibold"><?php echo date('M Y', strtotime($userData['datejoined'])); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Dashboard Content -->
	<section class="py-12">
		<div class="container mx-auto px-4">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
				<!-- Main Dashboard -->
				<div class="lg:col-span-2 space-y-8">
					<!-- Account Overview -->
					<div class="bg-white rounded-xl shadow-lg p-6">
						<h2 class="text-2xl font-bold text-gray-800 mb-6">
							<i class="fas fa-tachometer-alt mr-2 text-blue-600"></i>Account Overview
						</h2>
						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg text-center">
								<i class="fas fa-box-open text-3xl mb-3"></i>
								<h3 class="text-2xl font-bold"><?php echo $ordersData['total_orders']; ?></h3>
								<p class="text-blue-100">Total Orders</p>
							</div>
							<div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg text-center">
								<i class="fas fa-shopping-cart text-3xl mb-3"></i>
								<h3 class="text-2xl font-bold"><?php echo $cartData['cart_items']; ?></h3>
								<p class="text-green-100">Items in Cart</p>
							</div>
							<div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg text-center">
								<i class="fas fa-heart text-3xl mb-3"></i>
								<h3 class="text-2xl font-bold">0</h3>
								<p class="text-purple-100">Wishlist Items</p>
							</div>
						</div>
					</div>

					<!-- Recent Orders -->
					<div class="bg-white rounded-xl shadow-lg p-6">
						<div class="flex justify-between items-center mb-6">
							<h2 class="text-2xl font-bold text-gray-800">
								<i class="fas fa-history mr-2 text-green-600"></i>Recent Orders
							</h2>
							<a href="myorders.php" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-300">
								View All <i class="fas fa-arrow-right ml-1"></i>
							</a>
						</div>

						<?php if (mysqli_num_rows($recentOrdersResult) > 0): ?>
							<div class="space-y-4">
								<?php while ($order = mysqli_fetch_array($recentOrdersResult)): ?>
									<div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
										<div class="flex items-center space-x-4">
											<div class="bg-blue-100 p-3 rounded-lg">
												<i class="fas fa-box text-blue-600"></i>
											</div>
											<div>
												<h4 class="font-semibold text-gray-800"><?php echo htmlspecialchars($order['productname']); ?></h4>
												<p class="text-sm text-gray-600">INR <?php echo number_format($order['price'], 0); ?> • <?php echo date('M d, Y', strtotime($order['date_added'])); ?></p>
											</div>
										</div>
										<div class="text-right">
											<span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
												<i class="fas fa-check-circle mr-1"></i>Delivered
											</span>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						<?php else: ?>
							<div class="text-center py-8">
								<i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
								<p class="text-gray-600">No orders yet. Start shopping to see your order history here!</p>
								<a href="categories.php" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-300">
									Browse Products
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="space-y-6">
					<!-- Profile Information -->
					<div class="bg-white rounded-xl shadow-lg p-6">
						<h3 class="text-xl font-bold text-gray-800 mb-4">
							<i class="fas fa-user mr-2 text-purple-600"></i>Profile Information
						</h3>
						<div class="space-y-3">
							<div class="flex justify-between">
								<span class="text-gray-600">Name:</span>
								<span class="font-semibold"><?php echo htmlspecialchars($userData['name']); ?></span>
							</div>
							<div class="flex justify-between">
								<span class="text-gray-600">Email:</span>
								<span class="font-semibold"><?php echo htmlspecialchars($userData['email']); ?></span>
							</div>
							<div class="flex justify-between">
								<span class="text-gray-600">Phone:</span>
								<span class="font-semibold"><?php echo htmlspecialchars($userData['phone']); ?></span>
							</div>
							<div class="flex justify-between">
								<span class="text-gray-600">Address:</span>
								<span class="font-semibold text-right"><?php echo htmlspecialchars($userData['address'] ?? 'Not provided'); ?></span>
							</div>
						</div>
						<button class="w-full mt-4 bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition duration-300">
							<i class="fas fa-edit mr-2"></i>Edit Profile
						</button>
					</div>

					<!-- Quick Actions -->
					<div class="bg-white rounded-xl shadow-lg p-6">
						<h3 class="text-xl font-bold text-gray-800 mb-4">
							<i class="fas fa-bolt mr-2 text-yellow-600"></i>Quick Actions
						</h3>
						<div class="space-y-3">
							<a href="cart.php" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-shopping-cart text-blue-600 mr-3"></i>
								<span class="font-medium">View Cart</span>
								<?php if ($cartData['cart_items'] > 0): ?>
									<span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
										<?php echo $cartData['cart_items']; ?>
									</span>
								<?php endif; ?>
							</a>
							<a href="myorders.php" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-box-open text-green-600 mr-3"></i>
								<span class="font-medium">My Orders</span>
							</a>
							<a href="contact.php" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-headset text-purple-600 mr-3"></i>
								<span class="font-medium">Support</span>
							</a>
							<a href="#" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-heart text-red-600 mr-3"></i>
								<span class="font-medium">Wishlist</span>
							</a>
						</div>
					</div>

					<!-- Account Settings -->
					<div class="bg-white rounded-xl shadow-lg p-6">
						<h3 class="text-xl font-bold text-gray-800 mb-4">
							<i class="fas fa-cog mr-2 text-gray-600"></i>Account Settings
						</h3>
						<div class="space-y-3">
							<button class="w-full text-left p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-key mr-3 text-blue-600"></i>Change Password
							</button>
							<button class="w-full text-left p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-bell mr-3 text-yellow-600"></i>Notifications
							</button>
							<button class="w-full text-left p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-300">
								<i class="fas fa-credit-card mr-3 text-green-600"></i>Payment Methods
							</button>
						</div>
					</div>

					<!-- Logout -->
					<div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 text-center">
						<h3 class="text-xl font-bold mb-2">Ready to leave?</h3>
						<p class="text-red-100 mb-4 text-sm">Come back anytime to continue shopping</p>
						<a href="logout.php" class="inline-block bg-white text-red-600 font-bold py-3 px-6 rounded-lg hover:bg-gray-100 transition duration-300">
							<i class="fas fa-sign-out-alt mr-2"></i>Logout
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include("includes/footer.php"); ?>