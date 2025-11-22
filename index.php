<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home | Teestyle Hub</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	
	<style>
		/* Magical Animations */
		@keyframes float {
			0%, 100% { transform: translateY(0px); }
			50% { transform: translateY(-20px); }
		}
		
		@keyframes glow {
			0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
			50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(147, 51, 234, 0.3); }
		}
		
		@keyframes rainbow {
			0% { background-position: 0% 50%; }
			50% { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}
		
		@keyframes sparkle {
			0%, 100% { opacity: 0; transform: scale(0.5); }
			50% { opacity: 1; transform: scale(1); }
		}
		
		@keyframes slideInUp {
			from { transform: translateY(50px); opacity: 0; }
			to { transform: translateY(0); opacity: 1; }
		}
		
		@keyframes bounceIn {
			0% { transform: scale(0.3); opacity: 0; }
			50% { transform: scale(1.05); }
			70% { transform: scale(0.9); }
			100% { transform: scale(1); opacity: 1; }
		}
		
		.float-animation { animation: float 3s ease-in-out infinite; }
		.glow-animation { animation: glow 2s ease-in-out infinite; }
		.rainbow-bg { background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); background-size: 400% 400%; animation: rainbow 15s ease infinite; }
		.sparkle { animation: sparkle 2s ease-in-out infinite; }
		.slide-in-up { animation: slideInUp 0.8s ease-out; }
		.bounce-in { animation: bounceIn 0.8s ease-out; }
		
		/* Magical hover effects */
		.magical-hover {
			transition: all 0.3s ease;
			position: relative;
			overflow: hidden;
		}
		
		.magical-hover::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
			transition: left 0.5s;
		}
		
		.magical-hover:hover::before {
			left: 100%;
		}
		
		.magical-hover:hover {
			transform: translateY(-10px);
			box-shadow: 0 20px 40px rgba(0,0,0,0.1);
		}
		
		/* Particle effect */
		.particles {
			position: absolute;
			width: 100%;
			height: 100%;
			pointer-events: none;
			overflow: hidden;
		}
		
		.particle {
			position: absolute;
			width: 4px;
			height: 4px;
			background: rgba(255,255,255,0.8);
			border-radius: 50%;
			animation: sparkle 3s linear infinite;
		}
	</style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
	<?php include("includes/navbar.php"); ?>
	<main class="flex-grow">
		<!-- Hero Section -->
		<section class="relative rainbow-bg text-white py-20 overflow-hidden">
			<div class="particles">
				<div class="particle" style="left: 10%; animation-delay: 0s;"></div>
				<div class="particle" style="left: 20%; animation-delay: 1s;"></div>
				<div class="particle" style="left: 30%; animation-delay: 2s;"></div>
				<div class="particle" style="left: 40%; animation-delay: 0.5s;"></div>
				<div class="particle" style="left: 50%; animation-delay: 1.5s;"></div>
				<div class="particle" style="left: 60%; animation-delay: 2.5s;"></div>
				<div class="particle" style="left: 70%; animation-delay: 0.8s;"></div>
				<div class="particle" style="left: 80%; animation-delay: 1.8s;"></div>
				<div class="particle" style="left: 90%; animation-delay: 2.8s;"></div>
			</div>
			<div class="container mx-auto px-4 text-center relative z-10">
				<div class="float-animation mb-6">
					<i class="fas fa-magic text-6xl text-yellow-300 mb-4 sparkle"></i>
				</div>
				<h1 class="text-6xl font-bold mb-4 slide-in-up">
					<i class="fas fa-store text-yellow-300 mr-2 glow-animation"></i>
					<span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-purple-300 bg-clip-text text-transparent">
						Welcome to Teestyle Hub
					</span>
				</h1>
				<p class="text-xl mb-8 slide-in-up" style="animation-delay: 0.2s;">Discover the latest trends in men's fashion. Quality garments for every occasion.</p>
				<div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 bounce-in" style="animation-delay: 0.4s;">
					<?php 
					if(!isset($_SESSION["email"])){
						echo '<a href="register.php" class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 hover:from-yellow-500 hover:via-orange-500 hover:to-red-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-110 magical-hover"><i class="fas fa-magic mr-2"></i>Join Now</a>';
					}
					?>
					<a href="categories.php" class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 hover:from-purple-600 hover:via-pink-600 hover:to-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-110 magical-hover"><i class="fas fa-shopping-bag mr-2"></i>Shop Now</a>
				</div>
			</div>
		</section>

		<!-- Featured Categories -->
		<section class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
			<div class="container mx-auto px-4">
				<h2 class="text-4xl font-bold text-center mb-12 text-gray-800 slide-in-up">
					<i class="fas fa-stars text-purple-600 mr-2"></i>
					<span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Explore Our Collections</span>
				</h2>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-purple-100">
						<div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg p-6 mb-4 float-animation">
							<i class="fas fa-tshirt text-6xl text-white mb-4"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-blue-800">T-Shirts</h3>
						<p class="text-gray-600 mb-4">Comfortable and stylish t-shirts for everyday wear.</p>
						<a href="categoryview.php?category=tshirts" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white py-2 px-4 rounded-lg transition duration-300 inline-block transform hover:scale-105">
							<i class="fas fa-arrow-right mr-2"></i>View Collection
						</a>
					</div>
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-green-100">
						<div class="bg-gradient-to-br from-green-400 to-green-600 rounded-lg p-6 mb-4 float-animation" style="animation-delay: 1s;">
							<i class="fas fa-user-tie text-6xl text-white mb-4"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-green-800">Shirts</h3>
						<p class="text-gray-600 mb-4">Formal and casual shirts for all occasions.</p>
						<a href="categoryview.php?category=shirts" class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white py-2 px-4 rounded-lg transition duration-300 inline-block transform hover:scale-105">
							<i class="fas fa-arrow-right mr-2"></i>View Collection
						</a>
					</div>
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-red-100">
						<div class="bg-gradient-to-br from-red-400 to-red-600 rounded-lg p-6 mb-4 float-animation" style="animation-delay: 2s;">
							<i class="fas fa-socks text-6xl text-white mb-4"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-red-800">Pants</h3>
						<p class="text-gray-600 mb-4">High-quality pants for comfort and style.</p>
						<a href="categoryview.php?category=pants" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white py-2 px-4 rounded-lg transition duration-300 inline-block transform hover:scale-105">
							<i class="fas fa-arrow-right mr-2"></i>View Collection
						</a>
					</div>
				</div>
			</div>
		</section>

		<!-- Men's Garments Section -->
		<section class="py-16 bg-gradient-to-r from-purple-900 via-blue-900 to-indigo-900 relative overflow-hidden">
			<div class="absolute inset-0 bg-black opacity-20"></div>
			<div class="particles">
				<div class="particle" style="left: 15%; top: 20%; animation-delay: 0.5s;"></div>
				<div class="particle" style="left: 35%; top: 40%; animation-delay: 1.5s;"></div>
				<div class="particle" style="left: 55%; top: 30%; animation-delay: 2.5s;"></div>
				<div class="particle" style="left: 75%; top: 50%; animation-delay: 1s;"></div>
				<div class="particle" style="left: 85%; top: 25%; animation-delay: 2s;"></div>
			</div>
			<div class="container mx-auto px-4 relative z-10">
				<h2 class="text-4xl font-bold text-center mb-12 text-white slide-in-up">
					<i class="fas fa-crown text-yellow-400 mr-2"></i>
					<span class="bg-gradient-to-r from-yellow-400 via-pink-400 to-purple-400 bg-clip-text text-transparent">
						Men's Garments Collection
					</span>
				</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
					<div class="bg-white rounded-lg shadow-xl overflow-hidden magical-hover bounce-in">
						<div class="bg-gradient-to-br from-blue-500 to-purple-600 h-48 flex items-center justify-center">
							<i class="fas fa-tshirt text-6xl text-white float-animation"></i>
						</div>
						<div class="p-6">
							<h3 class="text-xl font-semibold mb-2 text-blue-800">Casual T-Shirts</h3>
							<p class="text-gray-600 mb-4">Soft cotton t-shirts perfect for daily wear.</p>
							<p class="text-transparent bg-gradient-to-r from-red-500 to-pink-500 bg-clip-text font-bold text-lg">From INR 500</p>
						</div>
					</div>
					<div class="bg-white rounded-lg shadow-xl overflow-hidden magical-hover bounce-in" style="animation-delay: 0.1s;">
						<div class="bg-gradient-to-br from-green-500 to-teal-600 h-48 flex items-center justify-center">
							<i class="fas fa-user-tie text-6xl text-white float-animation" style="animation-delay: 1s;"></i>
						</div>
						<div class="p-6">
							<h3 class="text-xl font-semibold mb-2 text-green-800">Formal Shirts</h3>
							<p class="text-gray-600 mb-4">Elegant shirts for office and events.</p>
							<p class="text-transparent bg-gradient-to-r from-green-500 to-teal-500 bg-clip-text font-bold text-lg">From INR 800</p>
						</div>
					</div>
					<div class="bg-white rounded-lg shadow-xl overflow-hidden magical-hover bounce-in" style="animation-delay: 0.2s;">
						<div class="bg-gradient-to-br from-red-500 to-pink-600 h-48 flex items-center justify-center">
							<i class="fas fa-socks text-6xl text-white float-animation" style="animation-delay: 2s;"></i>
						</div>
						<div class="p-6">
							<h3 class="text-xl font-semibold mb-2 text-red-800">Jeans & Pants</h3>
							<p class="text-gray-600 mb-4">Durable and stylish pants for all seasons.</p>
							<p class="text-transparent bg-gradient-to-r from-red-500 to-pink-500 bg-clip-text font-bold text-lg">From INR 1200</p>
						</div>
					</div>
					<div class="bg-white rounded-lg shadow-xl overflow-hidden magical-hover bounce-in" style="animation-delay: 0.3s;">
						<div class="bg-gradient-to-br from-purple-500 to-indigo-600 h-48 flex items-center justify-center">
							<i class="fas fa-hat-cowboy text-6xl text-white float-animation" style="animation-delay: 3s;"></i>
						</div>
						<div class="p-6">
							<h3 class="text-xl font-semibold mb-2 text-purple-800">Caps & Accessories</h3>
							<p class="text-gray-600 mb-4">Complete your look with trendy accessories.</p>
							<p class="text-transparent bg-gradient-to-r from-purple-500 to-indigo-500 bg-clip-text font-bold text-lg">From INR 300</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Why Choose Us -->
		<section class="py-16 bg-gradient-to-br from-yellow-50 via-orange-50 to-red-50">
			<div class="container mx-auto px-4">
				<h2 class="text-4xl font-bold text-center mb-12 text-gray-800 slide-in-up">
					<i class="fas fa-sparkles text-orange-600 mr-2"></i>
					<span class="bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent">
						Why Choose Teestyle Hub?
					</span>
				</h2>
				<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-orange-100 bounce-in">
						<div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 glow-animation">
							<i class="fas fa-shipping-fast text-3xl text-white"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-blue-800">Fast Shipping</h3>
						<p class="text-gray-600">Get your orders delivered quickly and safely with our express delivery service.</p>
					</div>
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-green-100 bounce-in" style="animation-delay: 0.1s;">
						<div class="bg-gradient-to-br from-green-500 to-emerald-500 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 glow-animation" style="animation-delay: 1s;">
							<i class="fas fa-shield-alt text-3xl text-white"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-green-800">Quality Guarantee</h3>
						<p class="text-gray-600">We ensure the highest quality in all our products with 100% satisfaction guarantee.</p>
					</div>
					<div class="text-center magical-hover bg-white rounded-xl p-8 shadow-lg border border-purple-100 bounce-in" style="animation-delay: 0.2s;">
						<div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 glow-animation" style="animation-delay: 2s;">
							<i class="fas fa-headset text-3xl text-white"></i>
						</div>
						<h3 class="text-2xl font-semibold mb-2 text-purple-800">24/7 Support</h3>
						<p class="text-gray-600">Our dedicated team is here to help you anytime with friendly customer support.</p>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include("includes/footer.php"); ?>
</body>
</html>