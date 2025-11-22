<?php
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
  echo "<script>alert('Please login first!') </script>";
  echo "<script>open('adminlogin.php', '_self') </script>";
}
include('../connections/localhost.php');

// Get product ID from URL
$productID = isset($_GET['product']) ? (int)$_GET['product'] : 0;

if ($productID <= 0) {
  echo "<script>alert('Invalid product ID!'); window.open('addproducts.php', '_self');</script>";
  exit;
}

// Fetch existing product data
$query = "SELECT * FROM `products` WHERE `productID` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $productID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  echo "<script>alert('Product not found!'); window.open('addproducts.php', '_self');</script>";
  exit;
}

$product = $result->fetch_assoc();
?>

<!doctype html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Admin Dashboard - Edit Product</title>
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
      <h1 class="text-4xl font-bold text-gray-800 flex items-center"><i class="fas fa-edit text-blue-600 mr-3"></i>Edit Product</h1>
      <p class="text-gray-600 mt-2">Update product information and details</p>
    </div>

    <!-- Edit Product Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800"><i class="fas fa-pencil-alt text-orange-600 mr-2"></i>Edit Product Details</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Product Name -->
          <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-tag text-blue-600 mr-2"></i>Product Name</label>
            <input name="name" type="text" maxlength="30" required placeholder="Enter product name" value="<?php echo htmlspecialchars($product['productname']); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-rupee-sign text-green-600 mr-2"></i>Price (INR)</label>
            <input name="price" type="text" size="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="4" required placeholder="Enter price" value="<?php echo htmlspecialchars($product['price']); ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
          </div>

          <!-- Category -->
          <div>
            <label for="category" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-list text-purple-600 mr-2"></i>Category</label>
            <select name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300">
              <option value="">-- Select Category --</option>
              <?php
              // Query distinct categories from products table
              $catQuery = "SELECT DISTINCT `category` FROM `products` ORDER BY `category` ASC;";
              $catResult = mysqli_query($conn, $catQuery);
              if ($catResult && mysqli_num_rows($catResult) > 0) {
                while ($catRow = mysqli_fetch_array($catResult)) {
                  $selected = ($catRow['category'] == $product['category']) ? 'selected' : '';
                  echo '<option value="' . htmlspecialchars($catRow['category']) . '" ' . $selected . '>' . htmlspecialchars($catRow['category']) . '</option>';
                }
              } else {
                // If no products exist yet, provide default categories
                $defaultCategories = ['SHIRTS', 'SHORTS', 'TSHIRTS'];
                foreach ($defaultCategories as $cat) {
                  $selected = ($cat == $product['category']) ? 'selected' : '';
                  echo '<option value="' . $cat . '" ' . $selected . '>' . $cat . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <!-- Current Product Image -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2"><i class="fas fa-image text-orange-600 mr-2"></i>Current Image</label>
            <div class="flex items-center space-x-4">
              <img src="../uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Current product image" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
              <div class="text-sm text-gray-600">
                <p><strong>Current:</strong> <?php echo htmlspecialchars($product['product_image']); ?></p>
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
              </div>
            </div>
          </div>

          <!-- New Product Image (Optional) -->
          <div class="md:col-span-2">
            <label for="product_image" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-camera text-orange-600 mr-2"></i>Upload New Image (Optional)</label>
            <input name="MAX_FILE_SIZE" value="2000000" type="hidden">
            <input name="product_image" type="file" accept=".jpg, .jpeg, .png" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-orange-600 file:text-white file:cursor-pointer hover:file:bg-orange-700">
            <p class="text-sm text-gray-500 mt-1">Max file size: 2MB. Supported formats: JPG, JPEG, PNG. Leave empty to keep current image.</p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-between items-center">
          <a href="addproducts.php" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
          </a>
          <button type="submit" name="update" value="Update Product" class="bg-orange-600 hover:bg-orange-700 active:bg-orange-800 text-white font-bold py-4 px-12 rounded-lg shadow-xl transition duration-300 transform hover:scale-105 flex items-center gap-2 text-lg cursor-pointer">
            <i class="fas fa-save"></i>Update Product
          </button>
        </div>
      </form>

      <!-- Update Status Message -->
      <div class="mt-6">
        <?php
        if (isset($_POST['update'])) {
          $productname = mysqli_real_escape_string($conn, $_POST['name']);
          $price = mysqli_real_escape_string($conn, $_POST['price']);
          $category = mysqli_real_escape_string($conn, $_POST['category']);

          $productname = strtoupper(trim($productname)); //converts to UPPER CASE

          $updateFields = "`productname` = ?, `price` = ?, `category` = ?";
          $updateParams = [$productname, $price, $category];
          $paramTypes = "sis";

          // Check if new image is uploaded
          if (!empty($_FILES['product_image']['name'])) {
            //-----------------------------START image file upload process -----------//
            $fileName = $_FILES['product_image']['name'];
            $filetype = $_FILES['product_image']['type'];
            $fileTemp = $_FILES['product_image']['tmp_name'];
            $fileSize = $_FILES['product_image']['size'];
            $uploadError = $_FILES['product_image']['error'];

            if ($uploadError != 0) {
              if ($uploadError == 2) echo ("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-exclamation-circle mr-2'></i>Sorry, your file size exceeds limit.</div>");
              exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Upload failed.</div>");
            }

            // Check if file is an actual image/photo file
            if (exif_imagetype($fileTemp) != IMAGETYPE_JPEG && exif_imagetype($fileTemp) != IMAGETYPE_PNG) {
              exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Invalid file type. Upload failed.</div>");
            }

            //CHECKS file type by extension
            if ($filetype != "image/jpeg" && $filetype != "image/png") {
              exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Invalid file type. Upload failed.</div>");
            }

            // check file size
            if ($fileSize > 2000000) {
              die("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Sorry, file is over 2MB. Upload failed</div>");
            }

            // Generate new filename
            $date = date_create("now", new DateTimeZone("Asia/Shanghai"));
            $newFileName = "PROD_" . date_format($date, "Ymdhisu") . "." . pathinfo($fileName, PATHINFO_EXTENSION);

            // Move file to final destination
            move_uploaded_file($fileTemp, "../uploads/$newFileName") or die("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Upload failed</div>");

            // Add image to update query
            $updateFields .= ", `product_image` = ?";
            $updateParams[] = $newFileName;
            $paramTypes .= "s";
          }

          // Update product in database
          $updateQuery = "UPDATE `products` SET $updateFields WHERE `productID` = ?";
          $updateParams[] = $productID;
          $paramTypes .= "i";

          if ($stmt = $conn->prepare($updateQuery)) {
            $stmt->bind_param($paramTypes, ...$updateParams);
            if ($stmt->execute()) {
              echo "<div class='p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded'><i class='fas fa-check-circle mr-2'></i>Product updated successfully!</div>";
              echo "<script>setTimeout(function(){ window.open('addproducts.php','_self') }, 2000);</script>";
            } else {
              echo "<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Update failed: " . mysqli_error($conn) . "</div>";
            }
          } else {
            echo "<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Update failed: " . mysqli_error($conn) . "</div>";
          }
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>