<?php
session_start();
session_unset();
session_destroy();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Logged Out | Teestyle Hub</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
	<?php include("includes/navbar.php"); ?>
	<main class="flex-grow flex items-center justify-center">
		<div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg text-center">
			<i class="fas fa-sign-out-alt text-4xl text-red-500 mb-4"></i>
			<p class="text-lg text-gray-700">You have logged out. Redirecting you...</p>
		</div>
	</main>
	<?php include("includes/footer.php"); ?>
</body>
</html>