<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
	echo "<script>alert('Please login first!') </script>";
	echo "<script>open('login.php', '_self') </script>";
}
include('connections/localhost.php');
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<body class="bg-gray-50 min-h-screen flex flex-col">
<main class="flex-grow">
	<?php
	$customeremail = mysqli_real_escape_string($conn, $_SESSION['email']);
	$query = "SELECT *
    FROM `cart`
    INNER JOIN `products` ON cart.product_id = products.productID AND cart.customer_email = '$customeremail'
	ORDER BY `date_added` DESC";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);
	$totalCost = 0;

	// Calculate total cost
	if ($count > 0) {
		mysqli_data_seek($result, 0); // Reset result pointer
		while ($row = mysqli_fetch_array($result)) {
			$totalCost += (int)$row['price'];
		}
		mysqli_data_seek($result, 0); // Reset result pointer again
	}
	?>

	<!-- Cart Hero Section -->
	<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-between">
				<div>
					<h1 class="text-4xl font-bold mb-2">
						<i class="fas fa-shopping-cart mr-2"></i>Shopping Cart
					</h1>
					<p class="text-xl opacity-90">
						<?php if ($count > 0): ?>
							You have <?php echo $count; ?> item<?php echo $count > 1 ? 's' : ''; ?> in your cart
						<?php else: ?>
							Your cart is waiting for some amazing products
						<?php endif; ?>
					</p>
				</div>
				<a href="categories.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white py-2 px-4 rounded-lg transition duration-300 backdrop-blur-sm">
					<i class="fas fa-plus mr-2"></i>Continue Shopping
				</a>
			</div>
		</div>
	</section>

	<!-- Cart Content -->
	<section class="py-12">
		<div class="container mx-auto px-4">
			<?php if ($count == 0): ?>
				<!-- Empty Cart State -->
				<div class="text-center py-20">
					<div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
						<i class="fas fa-shopping-cart text-6xl text-gray-300 mb-6"></i>
						<h3 class="text-3xl font-bold text-gray-800 mb-4">Your Cart is Empty</h3>
						<p class="text-gray-600 mb-8 text-lg">Looks like you haven't added any items to your cart yet. Start shopping to fill it up!</p>
						<div class="space-y-4">
							<a href="categories.php" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition duration-300 transform hover:scale-105 inline-flex items-center text-lg">
								<i class="fas fa-shopping-bag mr-3"></i>Start Shopping
							</a>
							<p class="text-sm text-gray-500">Free shipping on orders over INR 999</p>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
					<!-- Cart Items -->
					<div class="lg:col-span-2 space-y-6">
						<div class="bg-white rounded-xl shadow-lg overflow-hidden">
							<div class="bg-gray-50 px-6 py-4 border-b">
								<h2 class="text-xl font-semibold text-gray-800">
									<i class="fas fa-box mr-2 text-blue-600"></i>Cart Items (<?php echo $count; ?>)
								</h2>
							</div>
							<div class="divide-y divide-gray-100">
								<?php while ($row = mysqli_fetch_array($result)): ?>
									<div class="p-6 hover:bg-gray-50 transition duration-200">
										<div class="flex items-center space-x-4">
											<!-- Product Image -->
											<div class="flex-shrink-0">
												<img src="<?php echo basename('uploads/') . "/" . $row['product_image']; ?>"
													 class="w-20 h-20 object-cover rounded-lg shadow-sm"
													 alt="<?php echo htmlspecialchars($row['productname']); ?>"
													 onerror="this.src='https://via.placeholder.com/80x80?text=No+Image'">
											</div>

											<!-- Product Details -->
											<div class="flex-1 min-w-0">
												<h3 class="text-lg font-semibold text-gray-900 truncate">
													<?php echo htmlspecialchars($row['productname']); ?>
												</h3>
												<p class="text-sm text-gray-600 mb-2">
													Category: <span class="font-medium"><?php echo ucfirst($row['category']); ?></span>
												</p>
												<div class="flex items-center space-x-2">
													<span class="text-2xl font-bold text-red-600">
														INR <?php echo number_format($row['price'], 0); ?>
													</span>
													<span class="text-sm text-gray-500">per item</span>
												</div>
											</div>

											<!-- Quantity & Actions -->
											<div class="flex flex-col items-end space-y-3">
												<div class="flex items-center space-x-2 bg-gray-100 rounded-lg px-3 py-1">
													<span class="text-sm font-medium text-gray-700">Qty:</span>
													<span class="bg-white px-2 py-1 rounded text-sm font-semibold">1</span>
												</div>
												<a href="removefromcart.php?del=<?php echo $row['cart_id'] ?>"
												   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 transform hover:scale-105 inline-flex items-center"
												   onclick="return confirm('Are you sure you want to remove this item from your cart?')">
													<i class="fas fa-trash mr-2"></i>Remove
												</a>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</div>

						<!-- Continue Shopping -->
						<div class="text-center">
							<a href="categories.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition duration-300 inline-flex items-center">
								<i class="fas fa-arrow-left mr-2"></i>Continue Shopping
							</a>
						</div>
					</div>

					<!-- Cart Summary -->
					<div class="lg:col-span-1">
						<div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
							<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
								<i class="fas fa-receipt mr-2 text-green-600"></i>Order Summary
							</h2>

							<div class="space-y-4">
								<div class="flex justify-between items-center py-2 border-b border-gray-200">
									<span class="text-gray-600">Subtotal (<?php echo $count; ?> items)</span>
									<span class="font-semibold">INR <?php echo number_format($totalCost, 0); ?></span>
								</div>

								<div class="flex justify-between items-center py-2 border-b border-gray-200">
									<span class="text-gray-600">Shipping</span>
									<span class="font-semibold text-green-600">
										<?php echo $totalCost >= 999 ? 'FREE' : 'INR 99'; ?>
									</span>
								</div>

								<?php if ($totalCost < 999): ?>
									<div class="bg-blue-50 p-3 rounded-lg">
										<p class="text-sm text-blue-800">
											<i class="fas fa-info-circle mr-1"></i>
											Add INR <?php echo number_format(999 - $totalCost, 0); ?> more for free shipping!
										</p>
									</div>
								<?php endif; ?>

								<div class="flex justify-between items-center py-3 border-t-2 border-gray-300 text-lg font-bold">
									<span class="text-gray-800">Total</span>
									<span class="text-red-600">
										INR <?php echo number_format($totalCost + ($totalCost >= 999 ? 0 : 99), 0); ?>
									</span>
								</div>
							</div>

							<div class="mt-8 space-y-3">
								<a href="checkout.php" class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-6 rounded-xl transition duration-300 transform hover:scale-105 inline-flex items-center justify-center text-lg">
									<i class="fas fa-credit-card mr-3"></i>Proceed to Checkout
								</a>

								<div class="text-center">
									<p class="text-sm text-gray-500 mb-2">We accept</p>
									<div class="flex justify-center space-x-2">
										<i class="fab fa-cc-visa text-2xl text-blue-600"></i>
										<i class="fab fa-cc-mastercard text-2xl text-red-600"></i>
										<i class="fab fa-cc-paypal text-2xl text-blue-700"></i>
										<i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
									</div>
								</div>
							</div>

							<div class="mt-6 pt-6 border-t border-gray-200">
								<div class="flex items-center text-sm text-gray-600">
									<i class="fas fa-shield-alt mr-2 text-green-600"></i>
									<span>Secure checkout with SSL encryption</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php $_SESSION['totalCost'] = $totalCost + ($totalCost >= 999 ? 0 : 99); ?>
</main>

<?php include("includes/footer.php"); ?>
</body>
</html>