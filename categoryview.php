<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<?php include("includes/header.php"); ?>


<?php include("includes/navbar.php"); ?>


<body class="bg-gray-100 min-h-screen flex flex-col">
	<main class="flex-grow">
		<?php
		global $conn;
		if (!isset($_GET['category']) || empty(trim($_GET['category']))) {
			header("location: categories.php");
		} else {
			$category = htmlspecialchars(stripslashes(strip_tags($_GET['category'])));
			$category = mysqli_real_escape_string($conn, $category);
			$_SESSION['category'] = $category;

			$query = "SELECT * FROM `products` WHERE category = '$category'";
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			$count = mysqli_num_rows($result);

			// Category Hero Section
			$categoryTitle = ucfirst($category);
			$categoryColors = [
				'tshirts' => 'from-blue-500 to-blue-600',
				'shirts' => 'from-green-500 to-green-600',
				'pants' => 'from-red-500 to-red-600',
				'shoes' => 'from-purple-500 to-purple-600',
				'caps' => 'from-yellow-500 to-yellow-600',
				'bags' => 'from-indigo-500 to-indigo-600',
				'chains' => 'from-pink-500 to-pink-600',
				'shorts' => 'from-teal-500 to-teal-600'
			];
			$bgColor = $categoryColors[$category] ?? 'from-gray-500 to-gray-600';
			?>

			<!-- Category Hero Section -->
			<section class="bg-gradient-to-r <?php echo $bgColor; ?> text-white py-12">
				<div class="container mx-auto px-4">
					<div class="flex items-center justify-between">
						<div>
							<h1 class="text-4xl font-bold mb-2">
								<i class="fas fa-tag mr-2"></i><?php echo $categoryTitle; ?> Collection
							</h1>
							<p class="text-xl opacity-90">Discover our premium <?php echo $category; ?> collection</p>
						</div>
						<a href="categories.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white py-2 px-4 rounded-lg transition duration-300 backdrop-blur-sm">
							<i class="fas fa-arrow-left mr-2"></i>Back to Categories
						</a>
					</div>
				</div>
			</section>

			<!-- Products Section -->
			<section class="py-16 bg-white">
				<div class="container mx-auto px-4">
					<?php if ($count == 0) { ?>
						<!-- Empty State -->
						<div class="text-center py-16">
							<i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
							<h3 class="text-2xl font-semibold text-gray-600 mb-2">No Products Found</h3>
							<p class="text-gray-500 mb-6">We're working on adding more <?php echo $category; ?> to our collection.</p>
							<a href="categories.php" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition duration-300 inline-flex items-center">
								<i class="fas fa-th-large mr-2"></i>Browse Other Categories
							</a>
						</div>
					<?php } else { ?>
						<!-- Products Count -->
						<div class="flex justify-between items-center mb-8">
							<h2 class="text-3xl font-bold text-gray-800">
								<i class="fas fa-list mr-2"></i><?php echo $categoryTitle; ?> Products
								<span class="text-lg font-normal text-gray-600">(<?php echo $count; ?> items)</span>
							</h2>
							<div class="text-sm text-gray-600">
								<i class="fas fa-eye mr-1"></i>Showing all products
							</div>
						</div>

						<!-- Products Grid -->
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
							<?php while ($row = mysqli_fetch_array($result)) { ?>
								<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
									<!-- Product Image -->
									<div class="relative overflow-hidden">
										<img src="<?php echo basename('uploads/') . "/" . $row['product_image']; ?>"
											 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300"
											 alt="<?php echo htmlspecialchars($row['productname']); ?>"
											 onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
										<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
											<div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
												<?php if (!isset($_SESSION['email'])) { ?>
													<button onclick="taketoLogin()" class="bg-white text-gray-800 py-2 px-4 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
														<i class="fas fa-eye mr-2"></i>View Details
													</button>
												<?php } else { ?>
													<a href="addtocart.php?id=<?php echo $row['productID'] ?>" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg font-semibold transition duration-300 inline-flex items-center">
														<i class="fas fa-cart-plus mr-2"></i>Add to Cart
													</a>
												<?php } ?>
											</div>
										</div>
										<!-- New Badge -->
										<div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold py-1 px-2 rounded-full">
											<i class="fas fa-star mr-1"></i>NEW
										</div>
									</div>

									<!-- Product Info -->
									<div class="p-6">
										<h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2"><?php echo htmlspecialchars($row['productname']); ?></h3>
										<div class="flex items-center justify-between mb-4">
											<div class="text-2xl font-bold text-red-600">
												INR <?php echo number_format($row['price'], 0); ?>
											</div>
											<div class="flex items-center text-yellow-400">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half-alt"></i>
												<span class="text-gray-600 text-sm ml-1">(4.5)</span>
											</div>
										</div>

										<!-- Action Button -->
										<?php if (!isset($_SESSION['email'])) { ?>
											<button onclick="taketoLogin()" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105">
												<i class="fas fa-cart-plus mr-2"></i>Add to Cart
											</button>
										<?php } else { ?>
											<a href="addtocart.php?id=<?php echo $row['productID'] ?>" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105 inline-flex items-center justify-center">
												<i class="fas fa-cart-plus mr-2"></i>Add to Cart
											</a>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</section>
		<?php } ?>
	</main>

	<script type="application/javascript">
		function taketoLogin() {
			window.alert("Please login first to add items to cart!");
			window.location.replace("login.php");
		}
	</script>

	<?php include("includes/footer.php"); ?>
</body>
</html>