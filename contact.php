<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact | Teestyle Hub</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
<?php include("includes/navbar.php"); ?>

<main class="flex-grow">
	<!-- Hero Section -->
	<section class="bg-gradient-to-r from-green-600 to-teal-600 text-white py-16">
		<div class="container mx-auto px-4 text-center">
			<h1 class="text-5xl font-bold mb-4">
				<i class="fas fa-envelope text-yellow-300 mr-2"></i>Get in Touch
			</h1>
			<p class="text-xl mb-8">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
		</div>
	</section>

	<!-- Contact Info Section -->
	<section class="py-16 bg-white">
		<div class="container mx-auto px-4">
			<h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Contact Information</h2>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
				<div class="text-center bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
					<i class="fas fa-map-marker-alt text-4xl text-red-600 mb-4"></i>
					<h3 class="text-xl font-semibold mb-2">Address</h3>
					<p class="text-gray-600">L&T Byepass<br>SIET, Coimbatore-62</p>
				</div>
				<div class="text-center bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
					<i class="fas fa-phone text-4xl text-blue-600 mb-4"></i>
					<h3 class="text-xl font-semibold mb-2">Phone</h3>
					<p class="text-gray-600">+91 96006 334811</p>
				</div>
				<div class="text-center bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
					<i class="fas fa-envelope text-4xl text-green-600 mb-4"></i>
					<h3 class="text-xl font-semibold mb-2">Email</h3>
					<p class="text-gray-600">kellijoe2602@gmail.com</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact Form Section -->
	<section class="py-16 bg-gray-100">
		<div class="container mx-auto px-4">
			<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
				<h3 class="text-3xl font-bold text-center mb-4"><i class="fas fa-envelope mr-2 text-blue-600"></i>Contact Form</h3>
				<h4 class="text-center text-gray-600 mb-8">Write to us if you have any questions</h4>
				<form id="contact" action="https://formsubmit.co/kellijoe2602@gmail.com" method="POST">
					<!-- Hidden fields for formsubmit.co -->
					<input type="hidden" name="_captcha" value="false">
					<input type="hidden" name="_next" value="http://localhost/TeestlyeHub/contact.php?success=true">
					<input type="hidden" name="_subject" value="New Contact Form Message - TeeStyle Hub">
					<input type="hidden" name="_template" value="table">
					<input type="text" name="_honey" style="display:none">
					<div class="mb-6">
						<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
						<input name="name" placeholder="Your name (required)" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" tabindex="1" maxlength="20" required autofocus>
					</div>
					<div class="mb-6">
						<label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
						<input name="email" placeholder="Your Email Address (required)" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" maxlength="50" tabindex="2" required>
					</div>
					<div class="mb-6">
						<label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
						<textarea name="message" id="messageInput" placeholder="Type your message here...." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 resize-none" rows="5" maxlength="200" onKeyUp="countChars()" tabindex="5" required></textarea>
					</div>
					<p class="text-right text-sm text-gray-500 mb-6" id="charLeft">200 characters left</p>
					<div class="text-center">
						<button name="submit" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
							<i class="fas fa-paper-plane mr-2"></i>Send Message
						</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</main>

<div class="container mx-auto px-4 mb-8">
	<?php
	// Check for success message from formsubmit.co
	if (isset($_GET['success']) && $_GET['success'] == 'true') {
		echo '<div class="max-w-2xl mx-auto"><p class="text-green-500 text-center bg-green-100 p-4 rounded-lg shadow">Thank you! Your message has been sent successfully.</p></div>';
	}
	?>
</div>

<?php include("includes/footer.php"); ?>

<script type="application/javascript">
	function countChars() {
		//for displaying number of characters left for Message
		var val = document.getElementById("messageInput").value;
		var charCounter = 200 - val.length;
		document.getElementById("charLeft").innerHTML = charCounter + ' characters left';

	}
</script>


</body>

</html>

</html>