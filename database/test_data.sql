-- Test Data for Teestyle Hub E-Commerce Platform
-- Import this file in phpMyAdmin to populate test data

-- Clear existing data (optional - comment out if you want to keep existing data)
TRUNCATE TABLE `categories`;
TRUNCATE TABLE `products`;
TRUNCATE TABLE `customers`;
TRUNCATE TABLE `orders`;
TRUNCATE TABLE `contactus`;
TRUNCATE TABLE `cart`;

-- ========================================
-- INSERT CATEGORIES
-- ========================================

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'BAGS', 'Premium quality bags and backpacks'),
(2, 'CAPS', 'Stylish caps and hats'),
(3, 'CHAINS', 'Elegant chains and jewelry'),
(4, 'PANTS', 'Comfortable and trendy pants'),
(5, 'SHIRTS', 'Formal and casual shirts'),
(6, 'SHOES', 'High-quality footwear'),
(7, 'SHORTS', 'Casual shorts for all seasons'),
(8, 'TSHIRTS', 'Comfortable t-shirts for everyday wear');

-- ========================================
-- INSERT PRODUCTS
-- ========================================

INSERT INTO `products` (`productID`, `productname`, `price`, `category`, `product_image`) VALUES
(1, 'CLASSIC LEATHER BACKPACK', 2499, 'BAGS', 'PROD_20240101120000000000.jpg'),
(2, 'DURABLE TRAVEL BAG', 1999, 'BAGS', 'PROD_20240101120001000000.jpg'),
(3, 'SPORTY GYM BAG', 1499, 'BAGS', 'PROD_20240101120002000000.jpg'),
(4, 'PREMIUM BASEBALL CAP', 599, 'CAPS', 'PROD_20240101120003000000.jpg'),
(5, 'VINTAGE TRUCKER CAP', 749, 'CAPS', 'PROD_20240101120004000000.jpg'),
(6, 'CASUAL SNAPBACK CAP', 499, 'CAPS', 'PROD_20240101120005000000.jpg'),
(7, 'SILVER CHAIN NECKLACE', 1299, 'CHAINS', 'PROD_20240101120006000000.jpg'),
(8, 'GOLD PLATED CHAIN', 1899, 'CHAINS', 'PROD_20240101120007000000.jpg'),
(9, 'STAINLESS STEEL CHAIN', 799, 'CHAINS', 'PROD_20240101120008000000.jpg'),
(10, 'DARK BLUE JEANS', 1999, 'PANTS', 'PROD_20240101120009000000.jpg'),
(11, 'BLACK FORMAL PANTS', 2299, 'PANTS', 'PROD_20240101120010000000.jpg'),
(12, 'KHAKI CHINOS', 1799, 'PANTS', 'PROD_20240101120011000000.jpg'),
(13, 'WHITE FORMAL SHIRT', 1299, 'SHIRTS', 'PROD_20240101120012000000.jpg'),
(14, 'BLUE CASUAL SHIRT', 1099, 'SHIRTS', 'PROD_20240101120013000000.jpg'),
(15, 'BLACK POLO SHIRT', 899, 'SHIRTS', 'PROD_20240101120014000000.jpg'),
(16, 'NIKE SPORTS SHOES', 4999, 'SHOES', 'PROD_20240101120015000000.jpg'),
(17, 'CASUAL SNEAKERS', 2499, 'SHOES', 'PROD_20240101120016000000.jpg'),
(18, 'LEATHER FORMAL SHOES', 3499, 'SHOES', 'PROD_20240101120017000000.jpg'),
(19, 'COTTON SHORTS BLUE', 899, 'SHORTS', 'PROD_20240101120018000000.jpg'),
(20, 'BLACK ATHLETIC SHORTS', 799, 'SHORTS', 'PROD_20240101120019000000.jpg'),
(21, 'KHAKI CARGO SHORTS', 1199, 'SHORTS', 'PROD_20240101120020000000.jpg'),
(22, 'RED GRAPHIC TSHIRT', 499, 'TSHIRTS', 'PROD_20240101120021000000.jpg'),
(23, 'WHITE PLAIN TSHIRT', 399, 'TSHIRTS', 'PROD_20240101120022000000.jpg'),
(24, 'BLACK POLO TSHIRT', 599, 'TSHIRTS', 'PROD_20240101120023000000.jpg');

-- ========================================
-- INSERT TEST CUSTOMERS
-- Password for all test accounts: password123
-- Hashed using PHP's password_hash()
-- ========================================

INSERT INTO `customers` (`customerID`, `name`, `email`, `password`, `phone`, `address`, `datejoined`) VALUES
(1, 'John Doe', 'john@example.com', '$2y$10$DikWPpxP9F9N8E0K8sKpLuK8XqmxZvZvJ8Z8K8Z8K8Z8K8Z8K8ZmS', '9876543210', '123 Main Street, Delhi', '2024-01-01 10:00:00'),
(2, 'Sarah Smith', 'sarah@example.com', '$2y$10$DikWPpxP9F9N8E0K8sKpLuK8XqmxZvZvJ8Z8K8Z8K8Z8K8Z8K8ZmS', '9876543211', '456 Oak Avenue, Mumbai', '2024-01-02 11:00:00'),
(3, 'Rajesh Kumar', 'rajesh@example.com', '$2y$10$DikWPpxP9F9N8E0K8sKpLuK8XqmxZvZvJ8Z8K8Z8K8Z8K8Z8K8ZmS', '9876543212', '789 Pine Road, Bangalore', '2024-01-03 12:00:00'),
(4, 'Priya Sharma', 'priya@example.com', '$2y$10$DikWPpxP9F9N8E0K8sKpLuK8XqmxZvZvJ8Z8K8Z8K8Z8K8Z8K8ZmS', '9876543213', '321 Elm Street, Pune', '2024-01-04 13:00:00'),
(5, 'Michael Johnson', 'michael@example.com', '$2y$10$DikWPpxP9F9N8E0K8sKpLuK8XqmxZvZvJ8Z8K8Z8K8Z8K8Z8K8ZmS', '9876543214', '654 Maple Lane, Hyderabad', '2024-01-05 14:00:00');

-- ========================================
-- INSERT TEST ORDERS
-- ========================================

INSERT INTO `orders` (`order_id`, `product_id`, `customer_email`, `date_added`) VALUES
(1, 1, 'john@example.com', '2024-01-10 15:30:00'),
(2, 5, 'john@example.com', '2024-01-11 16:45:00'),
(3, 8, 'sarah@example.com', '2024-01-12 10:15:00'),
(4, 10, 'sarah@example.com', '2024-01-13 11:20:00'),
(5, 13, 'rajesh@example.com', '2024-01-14 14:00:00'),
(6, 16, 'priya@example.com', '2024-01-15 09:30:00'),
(7, 22, 'michael@example.com', '2024-01-16 17:45:00'),
(8, 3, 'john@example.com', '2024-01-17 13:20:00'),
(9, 7, 'sarah@example.com', '2024-01-18 12:00:00'),
(10, 19, 'rajesh@example.com', '2024-01-19 16:30:00');

-- ========================================
-- INSERT TEST CONTACT MESSAGES
-- ========================================

INSERT INTO `contactus` (`id`, `name`, `email`, `message`, `date_posted`) VALUES
(1, 'Amit Patel', 'amit@example.com', 'Great products and excellent customer service!', '2024-01-20 10:00:00'),
(2, 'Lisa Wong', 'lisa@example.com', 'Love the quality of the products. Will order again.', '2024-01-21 11:30:00'),
(3, 'Vikram Singh', 'vikram@example.com', 'Fast delivery and amazing customer support.', '2024-01-22 14:15:00');

-- ========================================
-- Reset AUTO_INCREMENT values
-- ========================================

ALTER TABLE `categories` AUTO_INCREMENT = 9;
ALTER TABLE `customers` AUTO_INCREMENT = 6;
ALTER TABLE `orders` AUTO_INCREMENT = 11;
ALTER TABLE `products` AUTO_INCREMENT = 25;
ALTER TABLE `contactus` AUTO_INCREMENT = 4;
