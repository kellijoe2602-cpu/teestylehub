<?php
ob_start();
session_start();
include("connections/localhost.php");

if (!isset($_SESSION['email']) || !isset($_SESSION['totalCost']) || (int)$_SESSION['totalCost'] <= 0) {
    header('Location: categories.php');
    exit();
}

$name = $_SESSION['name'];
$totalCost = $_SESSION['totalCost'];

// Get cart items for order summary
$email = mysqli_real_escape_string($conn, $_SESSION['email']);
$query = "SELECT cart.*, products.productname, products.price, products.product_image
          FROM cart
          INNER JOIN products ON cart.product_id = products.productID
          WHERE cart.customer_email = '$email'
          ORDER BY cart.date_added DESC";
$cartResult = mysqli_query($conn, $query);
$cartItems = mysqli_fetch_all($cartResult, MYSQLI_ASSOC);
$itemCount = count($cartItems);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout | TeeStyle Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<?php include("includes/navbar.php"); ?>

<body class="bg-gray-50 min-h-screen">
<main class="pt-8 pb-16">
    <!-- Checkout Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-2">
                    <i class="fas fa-credit-card mr-3"></i>Secure Checkout
                </h1>
                <p class="text-xl opacity-90">Complete your purchase safely and securely</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Summary -->
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-shopping-bag mr-2 text-blue-600"></i>Order Summary
                    </h2>

                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <img src="<?php echo basename('uploads/') . "/" . $item['product_image']; ?>"
                                     alt="<?php echo htmlspecialchars($item['productname']); ?>"
                                     class="w-12 h-12 object-cover rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm truncate">
                                        <?php echo htmlspecialchars($item['productname']); ?>
                                    </h4>
                                    <p class="text-gray-600 text-sm">INR <?php echo number_format($item['price'], 0); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Order Totals -->
                    <div class="border-t border-gray-200 pt-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Subtotal (<?php echo $itemCount; ?> items)</span>
                            <span class="font-semibold">INR <?php echo number_format($totalCost, 0); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-green-600">
                                <?php
                                $shipping = $totalCost >= 999 ? 0 : 99;
                                echo $shipping == 0 ? 'FREE' : 'INR ' . $shipping;
                                ?>
                            </span>
                        </div>
                        <?php if ($totalCost < 999): ?>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm text-blue-800">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Add INR <?php echo number_format(999 - $totalCost, 0); ?> more for free shipping!
                                </p>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between items-center text-lg font-bold border-t border-gray-300 pt-3">
                            <span class="text-gray-800">Total</span>
                            <span class="text-red-600">INR <?php echo number_format($totalCost + $shipping, 0); ?></span>
                        </div>
                    </div>

                    <!-- Security Badges -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                                <span>SSL Secured</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-lock text-blue-600 mr-2"></i>
                                <span>Encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="lg:col-span-2 order-1 lg:order-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-credit-card mr-2 text-green-600"></i>Payment Information
                    </h2>

                    <!-- Credit Card Preview -->
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <i class="fas fa-credit-card text-2xl opacity-80"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm opacity-80">Valid Thru</div>
                                    <div class="font-bold" id="card-expiry">MM/YY</div>
                                </div>
                            </div>
                            <div class="mb-6">
                                <div class="text-sm opacity-80 mb-1">Card Number</div>
                                <div class="font-mono text-lg tracking-wider" id="card-number">•••• •••• •••• ••••</div>
                            </div>
                            <div class="flex justify-between items-end">
                                <div>
                                    <div class="text-sm opacity-80 mb-1">Cardholder Name</div>
                                    <div class="font-semibold" id="card-name"><?php echo htmlspecialchars($name); ?></div>
                                </div>
                                <div class="flex space-x-2">
                                    <i class="fab fa-cc-visa text-2xl opacity-60"></i>
                                    <i class="fab fa-cc-mastercard text-2xl opacity-60"></i>
                                    <i class="fab fa-cc-amex text-2xl opacity-60"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="space-y-6">
                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1"></i>Customer Name
                                </label>
                                <input id="name" type="text" value="<?php echo htmlspecialchars($name); ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 bg-gray-50" disabled>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-1"></i>Email Address
                                </label>
                                <input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 bg-gray-50" disabled>
                            </div>
                        </div>

                        <!-- Card Details -->
                        <div class="space-y-6">
                            <div>
                                <label for="cardnumber" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-credit-card mr-1"></i>Card Number
                                </label>
                                <div class="relative">
                                    <input name="cardnumber" id="cardnumber" type="text" placeholder="1234 5678 9012 3456"
                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                           maxlength="16" inputmode="numeric"
                                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                    <i class="fas fa-credit-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>Use any random 16 digits for demo purposes
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="expirationdate" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-calendar mr-1"></i>Expiration Year
                                    </label>
                                    <select name="expirationdate" id="expirationdate"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                        <option value="">Select Year</option>
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear; $year <= $currentYear + 10; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="expmonth" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-calendar mr-1"></i>Expiration Month
                                    </label>
                                    <select name="expmonth" id="expmonth"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                        <option value="">Select Month</option>
                                        <?php
                                        $months = [
                                            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                        ];
                                        foreach ($months as $value => $name) {
                                            echo "<option value=\"$value\">$name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="securitycode" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-1"></i>Security Code (CVV)
                                </label>
                                <input id="securitycode" name="cvv" type="text"
                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                       maxlength="4" placeholder="123" value="123"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>3-4 digit code on the back of your card
                                </p>
                            </div>
                        </div>

                        <!-- Payment Button -->
                        <div class="pt-6 border-t border-gray-200">
                            <button name="pay" type="submit"
                                    class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-6 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-credit-card mr-3"></i>
                                Pay INR <?php echo number_format($totalCost + $shipping, 0); ?> Securely
                            </button>

                            <div class="flex items-center justify-center mt-4 space-x-6 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                                    <span>256-bit SSL</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-lock text-blue-600 mr-2"></i>
                                    <span>Secure Payment</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-purple-600 mr-2"></i>
                                    <span>Guaranteed</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Error/Success Messages -->
    <?php if (isset($_POST['pay'])): ?>
        <div class="container mx-auto px-4 mt-8">
            <?php
            $cardnumber = htmlspecialchars(strip_tags($_POST['cardnumber'] ?? ''));

            if (empty(trim($cardnumber))) {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Card number cannot be empty. Please enter a valid card number.
                      </div>';
            } else {
                echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg text-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Payment processed successfully! Redirecting to order confirmation...
                      </div>';
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "placeOrder.php";
                        }, 2000);
                      </script>';
            }
            ?>
        </div>
    <?php endif; ?>
</main>

<script>
// Real-time card preview updates
document.getElementById('cardnumber').addEventListener('input', function(e) {
    const value = e.target.value.replace(/\s/g, '');
    const formatted = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    e.target.value = formatted;

    // Update card preview
    const displayValue = value || '•••• •••• •••• ••••';
    document.getElementById('card-number').textContent = displayValue;
});

document.getElementById('expmonth').addEventListener('change', updateExpiry);
document.getElementById('expirationdate').addEventListener('change', updateExpiry);

function updateExpiry() {
    const month = document.getElementById('expmonth').value;
    const year = document.getElementById('expirationdate').value.slice(-2);
    const expiry = month && year ? `${month}/${year}` : 'MM/YY';
    document.getElementById('card-expiry').textContent = expiry;
}

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const cardNumber = document.getElementById('cardnumber').value.replace(/\s/g, '');
    const expiryMonth = document.getElementById('expmonth').value;
    const expiryYear = document.getElementById('expirationdate').value;
    const cvv = document.getElementById('securitycode').value;

    if (cardNumber.length !== 16) {
        e.preventDefault();
        alert('Please enter a valid 16-digit card number');
        return;
    }

    if (!expiryMonth || !expiryYear) {
        e.preventDefault();
        alert('Please select expiration month and year');
        return;
    }

    if (cvv.length < 3) {
        e.preventDefault();
        alert('Please enter a valid CVV code');
        return;
    }
});
</script>

<?php include("includes/footer.php"); ?>
</body>
</html>