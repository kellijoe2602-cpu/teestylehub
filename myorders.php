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

<body class="bg-gray-100 min-h-screen flex flex-col">
<main class="flex-grow">
	<h2 class="text-3xl font-bold text-center my-8"><i class="fas fa-box-open mr-2"></i>My Orders</h2>
	<?php
	
	$customeremail = mysqli_real_escape_string( $conn, $_SESSION[ 'email' ] );
	$query = "SELECT * \n"
    . "FROM `orders` \n"
    . "INNER JOIN `products` ON orders.product_id = products.productID AND orders.customer_email = '$customeremail' \n"
	. "ORDER BY `date_added` DESC";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	$count = mysqli_num_rows($result);
	if ($count == 0) exit('<p class="text-center text-lg">You have not ordered yet!</p>'); 
	
	//calculate number of items in cart
	$x = 0;
	for( $x=0; $x < $count; ++$x){
		$x =+ $x; 
	}
	?>
	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mx-10">
			<?php
			date_default_timezone_set('Asia/Kolkata'); //change this according to your location
			while ($row = mysqli_fetch_array($result)) {
				
			?>
				<div class="bg-white rounded-lg shadow-lg p-6 flex items-center space-x-4 hover:shadow-xl transition duration-300">
					<!-- START OF single item box -->
					<div> <img src="<?php echo basename('uploads/') . "/" .  $row['product_image']; ?>" class="w-24 h-24 object-cover rounded"> </div>
					<div class="flex-1">
						<p class="font-semibold"><?php echo $row['productname'] ?> </p>
						<p class="text-red-600 font-bold"><?php echo "PAID INR " . $row['price'] ?></p>
						<p class="text-green-600"><i class="fas fa-calendar-alt mr-1"></i>Ordered on: <?php echo date_format(new DateTime($row['date_added']), "Y-M-d H:i")  ?></p>
					</div>
					
				</div>
				<!-- END OF single item box -->
		<?php
			}
		?>
		</div>
</main>
</br>
</br>
	<?php include("includes/footer.php"); ?>
</body>
</html>