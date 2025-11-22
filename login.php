<?php
ob_start();
session_start();
include('connections/localhost.php');

?>

<?php include("includes/header.php");
?>

<?php include("includes/navbar.php");
?>

<body class="bg-gray-100 min-h-screen flex flex-col">
<main class="flex-grow">
	<!-- Hero Section -->
	<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16">
		<div class="container mx-auto px-4 text-center">
			<h1 class="text-5xl font-bold mb-4">
				<i class="fas fa-sign-in-alt text-yellow-300 mr-2"></i>Welcome Back
			</h1>
			<p class="text-xl mb-8">Sign in to your account to continue shopping</p>
		</div>
	</section>

	<!-- Login Form Section -->
	<section class="py-16 bg-gray-100">
		<div class="container mx-auto px-4">
			<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
				<h1 class="text-3xl font-bold text-center mb-8 text-indigo-600"><i class="fas fa-sign-in-alt mr-2"></i>User Login</h1>
				<form action="login.php" method="post" enctype="multipart/form-data">
					<div class="mb-6">
						<label for="email" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-envelope mr-1"></i>Your Email</label>
						<input name="email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300" maxlength="30" required placeholder="Enter your email">
					</div>
					<div class="mb-6">
						<label for="password" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lock mr-1"></i>Password</label>
						<input name="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300" maxlength="30" placeholder="Enter your password" required>
					</div>
					<div class="text-center mb-6">
						<input class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 w-full" name="login" type="submit" value="LOGIN">
					</div>
				</form>
				<p class="text-center">Don't have an account? <a href="register.php" class="text-indigo-500 hover:text-indigo-600 font-semibold transition duration-300"><i class="fas fa-user-plus mr-1"></i>Register here</a>.</p>
			</div>
		</div>
	</section>
</main>

<div class="container mx-auto px-4 mb-8">
	<?php
	if (isset($_POST['login'])) {
		global $conn;

		$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
		$password = trim(mysqli_real_escape_string($conn, $_POST['password']));

		if (empty($email) || empty($password)) {
			echo '<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Must fill all fields</p></div>';
			exit;
		}

		filter_var($email, FILTER_VALIDATE_EMAIL) or die('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Email not valid</p></div>');
		$query = "SELECT `password` FROM `customers` WHERE `email`= '$email'";
		$query_run = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($query_run);
		
		if (!$row) {
			exit('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">User does not exist</p></div>');
		}
		
		$result = $row["password"];

		// Check if password is hashed (starts with $2y$ or $2a$ or $2b$) or plain text
		if (strpos($result, '$2') === 0) {
			// Password is hashed, use password_verify
			$passwordMatch = password_verify($password, $result);
		} else {
			// Password is plain text, compare directly
			$passwordMatch = ($password === $result);
		}

		if (!$passwordMatch) {
			exit('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Wrong email or password!...Try again.</p></div>');
		} else {
			$getname = "SELECT `name` FROM `customers` WHERE `email`='$email'";
			$query_two = mysqli_query($conn, $getname);
			$name = mysqli_fetch_assoc($query_two)["name"];

			$_SESSION['valid'] = true;
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;

			if (isset($_SESSION['category'])) {
				// take us back to where we were (before logged in)
				$categoryName = stripslashes(strip_tags($_SESSION['category']));
				unset($_SESSION['category']);
				header("location:categoryview.php?category=$categoryName");
			} else {
				//otherwise take us to our dashboard.
				header("location:myaccount.php");
			}
		}
	}
	?>
</div>


<?php include("includes/footer.php"); ?>
</body>

</html>