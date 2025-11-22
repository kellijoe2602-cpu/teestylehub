<?php
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
  echo "<script>alert('Please login first!') </script>";
  echo "<script>open('adminlogin.php', '_self') </script>";
}
include('../connections/localhost.php');
?>

<!doctype html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Admin Dashboard - Add Products</title>
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
      <h1 class="text-4xl font-bold text-gray-800 flex items-center"><i class="fas fa-box-open text-blue-600 mr-3"></i>Product Management</h1>
      <p class="text-gray-600 mt-2">Add, view, and manage your products</p>
    </div>

    <!-- Add Product Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800"><i class="fas fa-plus text-green-600 mr-2"></i>Add New Product</h2>
      
      <form action="" method="post" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Product Name -->
          <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-tag text-blue-600 mr-2"></i>Product Name</label>
            <input name="name" type="text" maxlength="30" required placeholder="Enter product name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-rupee-sign text-green-600 mr-2"></i>Price (INR)</label>
            <input name="price" type="text" size="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="4" required placeholder="Enter price" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300">
          </div>

          <!-- Category -->
          <div>
            <label for="category" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-list text-purple-600 mr-2"></i>Category</label>
            <select name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300">
              <option value="">-- Select Category --</option>
              <?php
              // Query distinct categories from products table
              $query = "SELECT DISTINCT `category` FROM `products` ORDER BY `category` ASC;";
              $result = mysqli_query($conn, $query);
              if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  echo '<option value="' . htmlspecialchars($row['category']) . '">' . htmlspecialchars($row['category']) . '</option>';
                }
              } else {
                // If no products exist yet, provide default categories
                $defaultCategories = ['SHIRTS', 'SHORTS', 'TSHIRTS'];
                foreach ($defaultCategories as $cat) {
                  echo '<option value="' . $cat . '">' . $cat . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <!-- Product Image -->
          <div>
            <label for="product_image" class="block text-gray-700 font-semibold mb-2"><i class="fas fa-image text-orange-600 mr-2"></i>Product Image (Max 2 MB)</label>
            <input name="MAX_FILE_SIZE" value="2000000" type="hidden">
            <input name="product_image" type="file" accept=".jpg, .jpeg, .png" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-orange-600 file:text-white file:cursor-pointer hover:file:bg-orange-700">
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 flex justify-center">
          <button type="submit" name="insert" value="Add Product" class="bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-bold py-4 px-12 rounded-lg shadow-xl transition duration-300 transform hover:scale-110 flex items-center gap-2 text-lg cursor-pointer">
            <i class="fas fa-plus-circle"></i>Add Product
          </button>
        </div>
      </form>

      <!-- Upload Status Message -->
      <div class="mt-6">
        <?php

        global $conn;
        if (isset($_POST['insert'])) {

          $productname = mysqli_real_escape_string($conn, $_POST['name']);
          $price = mysqli_real_escape_string($conn, $_POST['price']);
          $category = mysqli_real_escape_string($conn, $_POST['category']);

          $productname = strtoupper(trim($productname)); //converts to UPPER CASE


          //-----------------------------here below START image file upload process -----------//
          $fileName = $_FILES['product_image']['name'];
          $filetype = $_FILES['product_image']['type'];
          $fileTemp = $_FILES['product_image']['tmp_name'];
          $fileSize = $_FILES['product_image']['size'];
          $uploadError = $_FILES['product_image']['error'];


          if ($uploadError != 0) {
            if ($uploadError == 2) echo ("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-exclamation-circle mr-2'></i>Sorry, your file size exceeds limit.</div>");
            exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Upload failed.</div>");
          }

          // Check if file is an actual image/photo file. VERY INTELLIGENT & ACCURATE. 
          //  USE this if PHOTOS are the only file uploads required. WON'T work with PDF, DOC etc.
          if (exif_imagetype($fileTemp) != IMAGETYPE_JPEG && exif_imagetype($fileTemp) != IMAGETYPE_PNG) {
            exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Invalid file type. Upload failed.</div>");
          }

          //CHECKS file type by simply reading the file extension. QUICK, BUT NOT RECOMMENDED.
          // This Can be fooled easily if User modifies file extension before upload.
          if ($filetype != "image/jpeg" && $filetype != "image/png") {
            exit("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Invalid file type. Upload failed.</div>");
          }


          $target_dir = "../uploads/";
          $target_file = $target_dir . basename($fileName);

          //check if file exists
          if (file_exists($target_file)) {
            die("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Sorry, File already exists. Upload failed.</div>");
          }

          // check file size
          if ($fileSize > 2000000) {
            // In bytes.  Adjust the amount as you wish
            die("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Sorry, file is over 2MB. Upload failed</div>");
          } else {
            // everything is OK. Can now proceed to save the file.

            // FIRST, remove all special characters and spaces in file name
            $pattern = "/[^ 0-9a-zA-Z_\.]+/";
            $date = date_create("now", new DateTimeZone("Asia/Shanghai"));
            $newFileName = "PROD_" . date_format($date, "Ymdhisu") . "." . pathinfo($fileName, PATHINFO_EXTENSION);

            // THEN, move file to final destination
            move_uploaded_file($fileTemp, "../uploads/$newFileName") or die("<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Upload failed</div>");

            //----------------- here above END of file upload process--------//

            // FINALLY add everything you got into database:
            $insert_product = "INSERT INTO `products`(`productname`, `price`, `category`, `product_image`) VALUES ( ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($insert_product)) {
              //all is good, proceed.
              $stmt->bind_param("siss", $productname, $price, $category, $newFileName);
              $stmt->execute();
              echo "<div class='p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded'><i class='fas fa-check-circle mr-2'></i>Product added successfully!</div>";
              echo "<script>window.open('addproducts.php','_self')</script>";
            } else {
              echo "<div class='p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded'><i class='fas fa-times-circle mr-2'></i>Upload failed: " . mysqli_error($conn) . "</div>";
            }
          }
        }
        ?>
      </div>
    </div>

    <!-- Products List Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="p-8 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800"><i class="fas fa-list text-blue-600 mr-2"></i>Product List</h2>
      </div>

      <?php

      global $conn;
      //find out how many products in DB
      $sql = "SELECT COUNT(*) as count from `products`";
      $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      $totalcount = (int) mysqli_fetch_assoc($result)["count"];

      //decide how many items to show per page.
      $result_per_page = 10;
      $num_of_pages = ceil($totalcount / $result_per_page);

      ?>

      <!-- Pagination -->
      <div class="px-8 py-4 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-wrap gap-2 items-center">
          <span class="text-gray-700 font-semibold">Pages:</span>
          <?php
          //get current page from URL params
          if (!isset($_GET['page']) || !is_numeric($_GET['page'])) {
            $currentpage = 1;
          } else {
            $currentpage = (int) $_GET['page'];
          }

          // print all page numbers, horizontally ---->
          for ($i = 1; $i <= $num_of_pages; $i++) {
            if ($i === $currentpage) {
              echo '<span class="px-3 py-1 bg-blue-600 text-white rounded-lg font-bold">' . $i . '</span>';
              continue;
            }
          ?>
            <a href="addproducts.php?page=<?= $i ?>" class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-blue-100 transition duration-300"><?= $i ?></a>
          <?php   } ?>
        </div>
      </div>

      <!-- Products Table -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
              <th class="px-6 py-4 text-left font-semibold">#</th>
              <th class="px-6 py-4 text-left font-semibold">Product Name</th>
              <th class="px-6 py-4 text-left font-semibold">Category</th>
              <th class="px-6 py-4 text-left font-semibold">Price (₹)</th>
              <th class="px-6 py-4 text-center font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // retrieve results from using LIMIT and OFFSET
            $start_from = ($currentpage - 1) * $result_per_page;
            $sql = "SELECT * FROM `products` LIMIT $start_from, $result_per_page";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $rowCount = 0;
            while ($row = mysqli_fetch_array($result)) {
              $rowCount++;
              $bgClass = $rowCount % 2 == 0 ? 'bg-gray-50' : 'bg-white';
            ?>
              <tr class="<?= $bgClass ?> border-b border-gray-200 hover:bg-blue-50 transition duration-200">
                <td class="px-6 py-4 text-gray-700 font-semibold"><?= $row['productID'] ?></td>
                <td class="px-6 py-4 text-gray-700"><?= $row['productname'] ?></td>
                <td class="px-6 py-4"><span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold"><?= $row['category'] ?></span></td>
                <td class="px-6 py-4 text-gray-700 font-semibold text-green-600">₹<?= $row['price'] ?></td>
                <td class="px-6 py-4 text-center">
                  <div class="flex gap-2 justify-center">
                    <a href="editproducts.php?product=<?= $row['productID'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center"><i class="fas fa-edit mr-1"></i>Edit</a>
                    <button onclick="return confirmDelete()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center"><i class="fas fa-trash mr-1"></i><a href="deleteproducts.php?product=<?= $row['productID'] ?>">Delete</a></button>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this product?");
    }
  </script>

</body>

</html>