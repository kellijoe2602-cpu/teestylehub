<?php
session_start();
session_unset();
session_destroy();
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logged Out - Admin</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen flex items-center justify-center">
	<div class="w-full max-w-md text-center">
		<!-- Success Icon -->
		<div class="mb-8">
			<div class="inline-block bg-green-100 rounded-full p-6 mb-4 shadow-lg animate-pulse">
				<i class="fas fa-check-circle text-5xl text-green-600"></i>
			</div>
		</div>

		<!-- Logout Message Card -->
		<div class="bg-white rounded-2xl shadow-2xl p-8">
			<h1 class="text-3xl font-bold text-gray-800 mb-2">You Have Been Logged Out</h1>
			<p class="text-gray-600 mb-6">Your session has ended successfully. Redirecting you in a moment...</p>

			<div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded text-blue-700">
				<i class="fas fa-info-circle mr-2"></i>You will be redirected to the login page in 3 seconds.
			</div>

			<!-- Manual Redirect Link -->
			<a href="adminlogin.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
				<i class="fas fa-sign-in-alt mr-2"></i>Go to Admin Login
			</a>
		</div>

		<!-- Footer -->
		<div class="mt-6 text-gray-400 text-sm">
			<p><i class="fas fa-shield-alt mr-1"></i>Teestyle Hub Admin Panel</p>
		</div>
	</div>

	<script>
		// Auto-redirect after 3 seconds
		setTimeout(function() {
			window.location.href = 'adminlogin.php';
		}, 3000);
	</script>
</body>

</html>