<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<?php include( "includes/header.php" ); ?>

<?php include( "includes/navbar.php" ); ?>

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
	
	@keyframes magicalPulse {
		0%, 100% { transform: scale(1); }
		50% { transform: scale(1.05); }
	}
	
	.float-animation { animation: float 3s ease-in-out infinite; }
	.glow-animation { animation: glow 2s ease-in-out infinite; }
	.rainbow-bg { background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); background-size: 400% 400%; animation: rainbow 15s ease infinite; }
	.sparkle { animation: sparkle 2s ease-in-out infinite; }
	.slide-in-up { animation: slideInUp 0.8s ease-out; }
	.bounce-in { animation: bounceIn 0.8s ease-out; }
	.magical-pulse { animation: magicalPulse 2s ease-in-out infinite; }
	
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
		transform: translateY(-15px) scale(1.02);
		box-shadow: 0 25px 50px rgba(0,0,0,0.15);
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
	
	/* Category card magical effects */
	.category-card {
		background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
		backdrop-filter: blur(10px);
		border: 1px solid rgba(255,255,255,0.2);
		transition: all 0.3s ease;
	}
	
	.category-card:hover {
		background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,1));
		transform: translateY(-10px) scale(1.02);
		box-shadow: 0 20px 40px rgba(0,0,0,0.1), 0 0 30px rgba(99, 102, 241, 0.3);
	}
	
	.category-overlay {
		background: linear-gradient(45deg, rgba(99, 102, 241, 0.8), rgba(168, 85, 247, 0.8), rgba(236, 72, 153, 0.8));
		transition: all 0.3s ease;
	}
	
	.category-overlay:hover {
		background: linear-gradient(45deg, rgba(99, 102, 241, 0.9), rgba(168, 85, 247, 0.9), rgba(236, 72, 153, 0.9));
	}
</style>

<body class="bg-gray-100 min-h-screen flex flex-col">

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
				<i class="fas fa-th-large text-yellow-300 mr-2 glow-animation"></i>
				<span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-purple-300 bg-clip-text text-transparent">
					Explore Our Categories
				</span>
			</h1>
			<p class="text-xl mb-8 slide-in-up" style="animation-delay: 0.2s;">Discover a wide range of men's fashion items. From casual wear to accessories, find everything you need.</p>
			<div class="flex justify-center bounce-in" style="animation-delay: 0.4s;">
				<div class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white px-6 py-3 rounded-full magical-pulse">
					<i class="fas fa-star mr-2"></i>✨ Magical Collections ✨
				</div>
			</div>
		</div>
	</section>

	<!-- Categories Grid -->
	<section class="py-16 bg-white">
		<div class="container mx-auto px-4">
			<h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Shop by Category</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">


				<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
					<a href="categoryview.php?category=shirts" class="block">
						<div class="relative">
							<img src="categoryimages/shirts1.jpg" class="w-full h-48 object-cover" alt="Shirts">
							<div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300">
								<span class="text-white font-bold text-lg">Shop Shirts</span>
							</div>
						</div>
						<div class="p-6 text-center">
							<i class="fas fa-user-tie text-3xl text-indigo-600 mb-2"></i>
							<h3 class="text-xl font-semibold mb-2">Shirts</h3>
							<p class="text-gray-600 mb-4">Formal and casual shirts for every style.</p>
							<span class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-300 inline-block">Explore</span>
						</div>
					</a>
				</div>

				<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
					<a href="categoryview.php?category=shorts" class="block">
						<div class="relative">
							<img src="categoryimages/shorts1.jpg" class="w-full h-48 object-cover" alt="Shorts">
							<div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300">
								<span class="text-white font-bold text-lg">Shop Shorts</span>
							</div>
						</div>
						<div class="p-6 text-center">
							<i class="fas fa-tshirt text-3xl text-pink-600 mb-2"></i>
							<h3 class="text-xl font-semibold mb-2">Shorts</h3>
							<p class="text-gray-600 mb-4">Casual shorts for summer and leisure.</p>
							<span class="bg-pink-600 hover:bg-pink-700 text-white py-2 px-4 rounded-lg transition duration-300 inline-block">Explore</span>
						</div>
					</a>
				</div>

				<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
					<a href="categoryview.php?category=T-shirts" class="block">
						<div class="relative">
							<img src="categoryimages/tshirts10.jpg" class="w-full h-48 object-cover" alt="T-shirts">
							<div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300">
								<span class="text-white font-bold text-lg">Shop T-shirts</span>
							</div>
						</div>
						<div class="p-6 text-center">
							<i class="fas fa-tshirt text-3xl text-orange-600 mb-2"></i>
							<h3 class="text-xl font-semibold mb-2">T-shirts</h3>
							<p class="text-gray-600 mb-4">Comfortable t-shirts for everyday wear.</p>
							<span class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg transition duration-300 inline-block">Explore</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include( "includes/footer.php" ); ?>


    
</body>
</html>