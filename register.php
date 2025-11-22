<?php
ob_start();
session_start();
include('connections/localhost.php');

?>


<!doctype html>
<html lang="en">

<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<body class="bg-gray-100 min-h-screen flex flex-col">
<main class="flex-grow">
	<!-- Hero Section -->
	<section class="bg-gradient-to-r from-green-600 to-teal-600 text-white py-16">
		<div class="container mx-auto px-4 text-center">
			<h1 class="text-5xl font-bold mb-4">
				<i class="fas fa-user-plus text-yellow-300 mr-2"></i>Join Teestyle Hub
			</h1>
			<p class="text-xl mb-8">Create your account and start shopping for the latest fashion trends</p>
		</div>
	</section>

	<!-- Registration Form Section -->
	<section class="py-16 bg-gray-100">
		<div class="container mx-auto px-4">
			<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
				<h1 class="text-3xl font-bold text-center mb-8 text-teal-600"><i class="fas fa-user-plus mr-2"></i>Create Account</h1>
				<form action="register.php" method="post" enctype="multipart/form-data">
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-user mr-1"></i>Full Name</label>
						<input name="name" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-300" placeholder="Enter your full name" required>
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-phone mr-1"></i>Phone Number</label>
						<input name="phone" type="text" maxlength="11" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-300" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter your phone number" required>
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-envelope mr-1"></i>Email Address</label>
						<input name="email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-300" maxlength="30" placeholder="Enter your email" required>
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lock mr-1"></i>Create Password</label>
						<input name="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-300" pattern=".{8,}" title="8 characters minimum" maxlength="30" placeholder="8 characters or more" required>
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lock mr-1"></i>Confirm Password</label>
						<input name="confirmPass" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition duration-300" maxlength="30" pattern=".{8,}" title="8 characters minimum" placeholder="Repeat your password" required>
					</div>
					<div class="text-center mb-6">
						<input class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 w-full" name="register" type="submit" value="REGISTER">
					</div>
				</form>
				<p class="text-center">Already have an Account? <a href="login.php" class="text-teal-500 hover:text-teal-600 font-semibold transition duration-300"><i class="fas fa-sign-in-alt mr-1"></i>Login here</a></p>
			</div>
		</div>
	</section>
</main>

	<div class="container mx-auto px-4 mb-8">
		<?php
		// this code below for when someone presses the REGISTER button

		/** sanitize input */
		function cleanInput(string $data)
		{
			//this to clean and sanitize our input data
			$data = strip_tags(trim($data));
			$data = htmlspecialchars($data);
			$data = stripslashes($data);
			return ($data);
		}

		if (isset($_POST['register'])) {
			global $conn;

			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$phone =  mysqli_real_escape_string($conn, $_POST['phone']);
			$email =  mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$confirmPass = mysqli_real_escape_string($conn, $_POST['confirmPass']);

			$name = cleanInput($name);
			$phone = cleanInput($phone);
			$email = cleanInput($email);
			$password = cleanInput($password);

			filter_var($email, FILTER_VALIDATE_EMAIL) or die('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Email not valid</p></div>');
			if (strlen($password) < 8) exit('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Password requires 8 or more characters</p></div>');

			if ($password !== $confirmPass) {
				//this means passwords do not match
				exit('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Passwords do not match</p></div>');
			}

			$s = "SELECT COUNT(*) from `customers` where email= '$email'";
			$result = mysqli_query($conn, $s);
			$num = mysqli_fetch_row($result)[0];
		
 			if ($num > 0) {
				// this means the user already exists
				exit('<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">User already exists!</p></div>');
			} else {
				$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
				$reg = "INSERT INTO `customers`(`name`, `email`, `password`, `phone`, `datejoined`) 
						VALUES ('$name','$email','$hashedpassword', '$phone', NOW())";

				if (mysqli_query($conn, $reg)) {
					$_SESSION['valid'] = true;
					$_SESSION['name'] = $name;
					$_SESSION['email'] = $email;


					echo '<div class="max-w-md mx-auto"><p class="text-green-500 text-center bg-green-100 p-4 rounded-lg shadow"> Registration successful! Redirecting you... </p></div>';
					//header('Refresh: 1; URL = myaccount.php');
				} else {
					echo '<div class="max-w-md mx-auto"><p class="text-red-500 text-center bg-red-100 p-4 rounded-lg shadow">Sign up failed' . mysqli_error($conn) . '</p></div>';
				}
			}
		}
 
		?>
	</div>

	<?php include("includes/footer.php"); ?>
</body>

</html>
