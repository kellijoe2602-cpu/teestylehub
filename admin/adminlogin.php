<?php
ob_start();
session_start();
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Login - Teestyle Hub</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen flex items-center justify-center">
	<div class="w-full max-w-md">
		<!-- Logo/Header Section -->
		<div class="text-center mb-8">
			<div class="inline-block bg-white rounded-full p-4 mb-4 shadow-lg">
				<i class="fas fa-shield-alt text-3xl text-blue-600"></i>
			</div>
			<h1 class="text-4xl font-bold text-white mb-2">Teestyle Hub</h1>
			<p class="text-gray-300">Admin Dashboard</p>
		</div>

		<!-- Login Form Card -->
		<div class="bg-white rounded-2xl shadow-2xl p-8">
			<h2 class="text-2xl font-bold text-center mb-2 text-gray-800">Admin Login</h2>
			<p class="text-center text-gray-600 mb-6">Enter your credentials to access the dashboard</p>

			<?php
			$msg = '';

			if (
				isset($_POST['login']) && !empty($_POST['username']) &&
				!empty($_POST['password'])
			) {

				if (
					$_POST['username'] == 'admin' &&
					$_POST['password'] == 'admin123'
				) {
					$_SESSION['valid'] = true;
					$_SESSION['admin'] = 'admin';

					//Access granted! take me to Admin Dashboard.
					header('location: vieworders.php');
				} else {
					$msg = '<div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded"><i class="fas fa-exclamation-circle mr-2"></i>Wrong username or password, Try Again!</div>';
				}
			}
			echo $msg;
			?>

			<form action="adminlogin.php" method="post" enctype="multipart/form-data">
				<div class="mb-6">
					<label for="username" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-user mr-2 text-blue-600"></i>Username</label>
					<input type="text" name="username" maxlength="20" placeholder="Enter your username" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
				</div>

				<div class="mb-6">
					<label for="password" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lock mr-2 text-blue-600"></i>Password</label>
					<input type="password" name="password" maxlength="20" placeholder="Enter your password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
				</div>

				<div class="text-center mb-4">
					<input type="submit" name="login" value="LOGIN" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 cursor-pointer">
				</div>
			</form>

			<!-- Footer Links -->
			<div class="text-center pt-4 border-t border-gray-200">
				<p class="text-gray-600">Go back to <a href="../index.php" class="text-blue-600 hover:text-blue-700 font-semibold transition duration-300"><i class="fas fa-home mr-1"></i>Store Home</a></p>
			</div>
		</div>

		<!-- Additional Info -->
		<div class="mt-6 text-center text-gray-400 text-sm">
			<p><i class="fas fa-info-circle mr-2"></i>Admin access only. Unauthorized use prohibited.</p>
		</div>
	</div>
</body>

</html>