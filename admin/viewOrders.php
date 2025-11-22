<?php
ob_start();
session_start();
if ( !isset( $_SESSION[ 'admin' ] ) ) {
	echo "<script>alert('Please login first!') </script>";
	echo "<script>open('adminlogin.php', '_self') </script>";
}
include( '../connections/localhost.php' );
?>

<!doctype html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>Admin Dashboard - View Orders</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

	<!-- Navigation Bar -->
	<nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
		<div class="container mx-auto px-4 py-4">
			<div class="flex justify-between items-center">
				<div class="text-2xl font-bold flex items-center">
					<i class="fas fa-shield-alt mr-2"></i>Admin Dashboard
				</div>
				<div class="flex gap-6 items-center">
					<a href="addproducts.php" class="hover:text-blue-200 transition duration-300 flex items-center"><i class="fas fa-plus-circle mr-1"></i>Products</a>
					<a href="vieworders.php" class="hover:text-blue-200 transition duration-300 flex items-center"><i class="fas fa-orders mr-1"></i>Orders</a>
					<a href="adminlogout.php" class="hover:text-blue-200 transition duration-300 flex items-center"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="flex-grow container mx-auto px-4 py-8">
		<!-- Page Title -->
		<div class="mb-8">
			<h1 class="text-4xl font-bold text-gray-800 flex items-center"><i class="fas fa-shopping-cart text-blue-600 mr-3"></i>Order Management</h1>
			<p class="text-gray-600 mt-2">View and manage customer orders</p>
		</div>

		<!-- Orders Table Section -->
		<div class="bg-white rounded-lg shadow-lg overflow-hidden">
			<div class="p-8 border-b border-gray-200">
				<h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-list text-green-600 mr-2"></i>Orders Placed</h2>
			</div>

			<?php
			
			$query = "SELECT * \n"
			. "FROM `orders` \n"
			. "INNER JOIN `products` ON orders.product_id = products.productID \n"
			. "ORDER BY `date_added` DESC";
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			$count = mysqli_num_rows($result);
			if ($count == 0) {
				echo '<div class="p-8 text-center"><p class="text-gray-600 text-lg"><i class="fas fa-inbox text-gray-400 mr-2 text-3xl"></i>No Orders Placed Yet!</p></div>';
				exit;
			}
			
			?>

			<!-- Orders Table -->
			<div class="overflow-x-auto">
				<table class="w-full">
					<thead>
						<tr class="bg-gradient-to-r from-green-600 to-green-700 text-white">
							<th class="px-6 py-4 text-left font-semibold">#</th>
							<th class="px-6 py-4 text-left font-semibold">Customer Email</th>
							<th class="px-6 py-4 text-left font-semibold">Product Name</th>
							<th class="px-6 py-4 text-left font-semibold">Amount (₹)</th>
							<th class="px-6 py-4 text-left font-semibold">Order Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						global $i; 
						$i = 0; //counter
						date_default_timezone_set('Asia/Kolkata'); //changed to Kolkata for INR
						$rowCount = 0;
						while ($row = mysqli_fetch_array($result)) {
							$i = ++$i;
							$bgClass = $rowCount % 2 == 0 ? 'bg-gray-50' : 'bg-white';
							$rowCount++;
						?>
						<tr class="<?= $bgClass ?> border-b border-gray-200 hover:bg-green-50 transition duration-200">
							<td class="px-6 py-4 text-gray-700 font-bold text-center bg-gray-100"><?= $i ?></td>
							<td class="px-6 py-4 text-gray-700"><span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm"><?= $row['customer_email'] ?></span></td>
							<td class="px-6 py-4 text-gray-700 font-semibold"><?= $row['productname'] ?></td>
							<td class="px-6 py-4">
								<span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-bold text-lg">₹<?= $row['price'] ?></span>
							</td>
							<td class="px-6 py-4 text-gray-700">
								<span class="flex items-center"><i class="fas fa-calendar-alt text-gray-500 mr-2"></i><?= date_format(new DateTime($row['date_added']), "M d, Y H:i")  ?></span>
							</td>
						</tr>
						<?php  }	?>
					</tbody>
				</table>
			</div>

			<!-- Summary Section -->
			<div class="p-8 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
				<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
					<div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-600">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-gray-600 text-sm">Total Orders</p>
								<p class="text-3xl font-bold text-gray-800"><?= $count ?></p>
							</div>
							<i class="fas fa-shopping-bag text-blue-600 text-4xl opacity-20"></i>
						</div>
					</div>

					<div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-600">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-gray-600 text-sm">Total Revenue</p>
								<?php
								$revenueQuery = "SELECT SUM(products.price) as total FROM `orders` INNER JOIN `products` ON orders.product_id = products.productID";
								$revenueResult = mysqli_query($conn, $revenueQuery);
								$revenueRow = mysqli_fetch_array($revenueResult);
								$totalRevenue = $revenueRow['total'] ? $revenueRow['total'] : 0;
								?>
								<p class="text-3xl font-bold text-green-600">₹<?= $totalRevenue ?></p>
							</div>
							<i class="fas fa-wallet text-green-600 text-4xl opacity-20"></i>
						</div>
					</div>

					<div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-600">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-gray-600 text-sm">Avg Order Value</p>
								<?php
								$avgValue = $count > 0 ? round($totalRevenue / $count, 2) : 0;
								?>
								<p class="text-3xl font-bold text-purple-600">₹<?= $avgValue ?></p>
							</div>
							<i class="fas fa-chart-line text-purple-600 text-4xl opacity-20"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>