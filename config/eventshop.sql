-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2025 at 07:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Banquet Halls', 'banquet-halls', 'Beautiful venues for weddings and events', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18'),
(2, 'Decor', 'decor', 'Event decoration services', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18'),
(3, 'Catering', 'catering', 'Food and beverage services', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18'),
(4, 'Lighting', 'lighting', 'Professional lighting setups', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18'),
(5, 'Puja Materials', 'puja-materials', 'Religious ceremony supplies', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18'),
(6, 'Priest Services', 'priest-services', 'Experienced priests for ceremonies', NULL, 1, '2025-07-07 15:34:18', '2025-07-07 15:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `account_status` enum('active','inactive','suspended','pending') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `address_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `address_type` enum('home','work','billing','shipping','other') NOT NULL DEFAULT 'home',
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_preferences`
--

CREATE TABLE `customer_preferences` (
  `preference_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `notification_email` tinyint(1) NOT NULL DEFAULT 1,
  `notification_sms` tinyint(1) NOT NULL DEFAULT 1,
  `notification_push` tinyint(1) NOT NULL DEFAULT 1,
  `marketing_consent` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `timezone` varchar(50) NOT NULL DEFAULT 'UTC',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_security`
--

CREATE TABLE `customer_security` (
  `security_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_method` enum('sms','email','authenticator_app','none') NOT NULL DEFAULT 'none',
  `password_changed_at` datetime DEFAULT NULL,
  `last_password_reset_at` datetime DEFAULT NULL,
  `failed_login_attempts` int(11) NOT NULL DEFAULT 0,
  `account_locked_until` datetime DEFAULT NULL,
  `security_questions_set` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_social_logins`
--

CREATE TABLE `customer_social_logins` (
  `social_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `provider` enum('google','facebook','twitter','apple','linkedin','github') NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `access_token` varchar(512) DEFAULT NULL,
  `refresh_token` varchar(512) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `location` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_verifications`
--

CREATE TABLE `otp_verifications` (
  `otp_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `otp_code` varchar(10) NOT NULL,
  `otp_type` enum('email_verification','mobile_verification','password_reset','account_recovery') NOT NULL,
  `expires_at` datetime NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `token_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `cost_per_item` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_digital` tinyint(1) DEFAULT 0 COMMENT 'For digital products',
  `download_url` varchar(255) DEFAULT NULL COMMENT 'For digital products',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `vendor_id`, `category_id`, `name`, `slug`, `description`, `location`, `price`, `compare_price`, `cost_per_item`, `sku`, `barcode`, `quantity`, `is_visible`, `is_featured`, `is_digital`, `download_url`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Bridal Silk Saree', 'bridal-silk-saree', 'Pure Kanjeevaram silk saree for bridal wear', 'Mumbai', 12500.00, 15000.00, 8000.00, 'SA001', '8901234567891', 25, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(2, 2, 1, 'Designer Lehenga', 'designer-lehenga', 'Hand-embroidered wedding lehenga with dupatta', 'Jaipur', 18500.00, 22000.00, 12000.00, 'LEH002', '8901234567892', 18, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(3, 2, 1, 'Groom Sherwani', 'groom-sherwani', 'Royal embroidered sherwani for groom', 'Delhi', 15900.00, 19900.00, 9500.00, 'SHER003', '8901234567893', 15, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(4, 2, 1, 'Bridal Jewelry Set', 'bridal-jewelry-set', '22k gold-plated temple jewelry set', 'Chennai', 8500.00, 12000.00, 5000.00, 'JWL004', '8901234567894', 30, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(5, 2, 1, 'Wedding Invitation Cards', 'wedding-invitation-cards', 'Premium embossed wedding cards (pack of 50)', 'Kolkata', 3500.00, 4500.00, 2000.00, 'INV005', '8901234567895', 100, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(6, 2, 1, 'Mandap Decoration Kit', 'mandap-decoration-kit', 'Complete floral mandap decoration package', 'Udaipur', 27500.00, 35000.00, 18000.00, 'MAN006', '8901234567896', 8, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(7, 2, 1, 'Mehndi Artist Kit', 'mehndi-artist-kit', 'Professional henna cones and tools set', 'Lucknow', 1200.00, 1800.00, 700.00, 'MEH007', '8901234567897', 50, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(8, 2, 1, 'Wedding Favors Pack', 'wedding-favors-pack', 'Elegant return gifts (pack of 25)', 'Ahmedabad', 4500.00, 6000.00, 3000.00, 'FAV008', '8901234567898', 40, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(9, 2, 1, 'Bridal Makeup Kit', 'bridal-makeup-kit', 'Luxury bridal makeup products set', 'Pune', 9800.00, 12500.00, 6500.00, 'MKP009', '8901234567899', 12, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(10, 2, 1, 'Wedding Stage Backdrop', 'wedding-stage-backdrop', 'Customizable floral stage backdrop', 'Goa', 18500.00, 22500.00, 12000.00, 'STG010', '8901234567900', 5, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(11, 4, 5, 'Silver Puja Thali', 'silver-puja-thali', 'Pure silver puja plate with accessories', 'Varanasi', 4500.00, 5500.00, 3000.00, 'THA011', '8901234567901', 35, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(12, 4, 5, 'Brass Temple Bell', 'brass-temple-bell', 'Handcrafted brass temple bell', 'Haridwar', 1200.00, 1500.00, 800.00, 'BEL012', '8901234567902', 60, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(13, 4, 5, 'Sandook for Puja', 'sandook-for-puja', 'Wooden puja box with carvings', 'Ayodhya', 3800.00, 4500.00, 2500.00, 'SAN013', '8901234567903', 20, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(14, 4, 5, 'Copper Kalash Set', 'copper-kalash-set', 'Set of 2 pure copper kalash', 'Rishikesh', 2800.00, 3500.00, 1800.00, 'KAL014', '8901234567904', 25, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(15, 4, 5, 'Rudraksha Mala', 'rudraksha-mala', 'Authentic 108 bead rudraksha mala', 'Nashik', 3200.00, 4000.00, 2000.00, 'MAL015', '8901234567905', 30, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(16, 4, 5, 'Ghee Diya Set', 'ghee-diya-set', 'Set of 11 brass diyas for puja', 'Mathura', 850.00, 1200.00, 500.00, 'DIY016', '8901234567906', 80, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(17, 4, 5, 'Havan Samagri Kit', 'havan-samagri-kit', 'Complete ingredients for havan (500g)', 'Dwarka', 650.00, 850.00, 400.00, 'HAV017', '8901234567907', 100, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(18, 4, 5, 'Vastu Pyramid', 'vastu-pyramid', 'Copper pyramid for positive energy', 'Amritsar', 2200.00, 2800.00, 1500.00, 'VAS018', '8901234567908', 15, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(19, 4, 5, 'Navgraha Yantra', 'navgraha-yantra', 'Brass yantra for planetary harmony', 'Tirupati', 1800.00, 2200.00, 1200.00, 'YAN019', '8901234567909', 18, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(20, 4, 5, 'Puja Book Set', 'puja-book-set', 'Set of 5 puja books with mantras', 'Shirdi', 950.00, 1200.00, 600.00, 'BOK020', '8901234567910', 40, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(21, 3, 3, 'Silver Plated Thali Set', 'silver-plated-thali-set', '26-piece silver plated serving set', 'Delhi', 12500.00, 15000.00, 8500.00, 'TPL021', '8901234567911', 10, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(22, 3, 3, 'Stainless Steel Lunch Box', 'stainless-steel-lunch-box', '3-tier stainless steel tiffin box', 'Gurgaon', 850.00, 1100.00, 500.00, 'TIF022', '8901234567912', 50, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(23, 3, 3, 'Banquet Serving Spoon Set', 'banquet-serving-spoon-set', 'Set of 12 large serving spoons', 'Noida', 2200.00, 2800.00, 1500.00, 'SPN023', '8901234567913', 25, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(24, 3, 3, 'Disposable Leaf Plates', 'disposable-leaf-plates', 'Pack of 100 eco-friendly plates', 'Faridabad', 450.00, 600.00, 300.00, 'LEF024', '8901234567914', 200, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(25, 3, 3, 'Water Dispenser Stand', 'water-dispenser-stand', 'Stainless steel water dispenser', 'Ghaziabad', 3800.00, 4500.00, 2500.00, 'WAT025', '8901234567915', 8, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(26, 3, 3, 'Chafing Dish Set', 'chafing-dish-set', 'Set of 3 buffet chafing dishes', 'Chandigarh', 6500.00, 7500.00, 4500.00, 'CHA026', '8901234567916', 12, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(27, 3, 3, 'Thermal Coffee Urn', 'thermal-coffee-urn', '5-liter commercial coffee urn', 'Dehradun', 4200.00, 5000.00, 2800.00, 'COF027', '8901234567917', 6, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(28, 3, 3, 'Decorative Table Cloth', 'decorative-table-cloth', 'Premium banquet table cloth (6x4 feet)', 'Shimla', 1200.00, 1500.00, 800.00, 'TBL028', '8901234567918', 30, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(29, 3, 3, 'Glass Juice Jug Set', 'glass-juice-jug-set', 'Set of 2 tempered glass jugs', 'Manali', 950.00, 1200.00, 600.00, 'JUG029', '8901234567919', 20, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(30, 3, 3, 'Steel Ice Bucket', 'steel-ice-bucket', 'Stainless steel champagne bucket', 'Dharamshala', 1800.00, 2200.00, 1200.00, 'ICE030', '8901234567920', 15, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(31, 3, 2, 'Floral Centerpiece', 'floral-centerpiece', 'Artificial flower arrangement', 'Bangalore', 1200.00, 1500.00, 800.00, 'FLR031', '8901234567921', 40, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(32, 3, 2, 'LED String Lights', 'led-string-lights', '20m warm white LED string lights', 'Mysore', 850.00, 1100.00, 500.00, 'LED032', '8901234567922', 60, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(33, 3, 2, 'Wedding Arch Decor', 'wedding-arch-decor', 'Fabric drape with flowers for arch', 'Coorg', 6500.00, 7500.00, 4500.00, 'ARC033', '8901234567923', 5, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(34, 3, 2, 'Chair Covers Set', 'chair-covers-set', 'Set of 10 satin chair covers', 'Mangalore', 2200.00, 2800.00, 1500.00, 'CHR034', '8901234567924', 25, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(35, 3, 2, 'Stage Carpet', 'stage-carpet', 'Red carpet for stage (20x10 feet)', 'Hubli', 3800.00, 4500.00, 2500.00, 'CRP035', '8901234567925', 8, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(36, 3, 2, 'Candle Stand Set', 'candle-stand-set', 'Set of 5 brass candle stands', 'Belgaum', 1800.00, 2200.00, 1200.00, 'CAN036', '8901234567926', 15, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(37, 3, 2, 'Photo Booth Backdrop', 'photo-booth-backdrop', 'Customizable photo backdrop', 'Hyderabad', 4200.00, 5000.00, 2800.00, 'PHO037', '8901234567927', 6, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(38, 3, 2, 'Balloon Garland Kit', 'balloon-garland-kit', 'Complete kit for balloon garlands', 'Secunderabad', 950.00, 1200.00, 600.00, 'BAL038', '8901234567928', 20, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(39, 3, 2, 'Table Runner Set', 'table-runner-set', 'Set of 5 satin table runners', 'Vijayawada', 1200.00, 1500.00, 800.00, 'RUN039', '8901234567929', 30, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(40, 3, 2, 'Decorative Lanterns', 'decorative-lanterns', 'Set of 3 metal lanterns', 'Visakhapatnam', 1800.00, 2200.00, 1200.00, 'LAN040', '8901234567930', 15, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(41, 2, NULL, 'Wedding Photo Album', 'wedding-photo-album', 'Premium leather photo album', 'Kochi', 2500.00, 3000.00, 1800.00, 'ALB041', '8901234567931', 20, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(42, 2, NULL, 'Bridal Bouquet', 'bridal-bouquet', 'Fresh flower bridal bouquet', 'Thiruvananthapuram', 1800.00, 2200.00, 1200.00, 'BOU042', '8901234567932', 15, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(43, 2, NULL, 'Groom Safa', 'groom-safa', 'Embroidered groom turban', 'Kozhikode', 1200.00, 1500.00, 800.00, 'SAF043', '8901234567933', 30, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(44, 2, NULL, 'Wedding Cake Topper', 'wedding-cake-topper', 'Custom couple figurine', 'Nagpur', 850.00, 1100.00, 500.00, 'CAK044', '8901234567934', 50, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(45, 2, NULL, 'Confetti Cannon Set', 'confetti-cannon-set', 'Set of 6 wedding confetti cannons', 'Bhopal', 650.00, 850.00, 400.00, 'CON045', '8901234567935', 100, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(46, 2, NULL, 'Guest Book', 'guest-book', 'Elegant wedding guest book', 'Indore', 950.00, 1200.00, 600.00, 'GST046', '8901234567936', 40, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(47, 2, NULL, 'Ring Pillow', 'ring-pillow', 'Silk ring bearer pillow', 'Gwalior', 650.00, 850.00, 400.00, 'RIN047', '8901234567937', 60, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(48, 2, NULL, 'Wedding Program Fans', 'wedding-program-fans', 'Set of 50 hand fans', 'Raipur', 2200.00, 2800.00, 1500.00, 'FAN048', '8901234567938', 25, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(49, 2, NULL, 'Baraat Horse Decor', 'baraat-horse-decor', 'Complete decoration set for baraat horse', 'Patna', 3800.00, 4500.00, 2500.00, 'HRS049', '8901234567939', 8, 1, 1, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32'),
(50, 2, NULL, 'Wedding Timeline Planner', 'wedding-timeline-planner', 'Customizable wedding planner book', 'Ranchi', 1200.00, 1500.00, 800.00, 'PLN050', '8901234567940', 30, 1, 0, 0, NULL, '2025-07-07 16:25:19', '2025-07-07 16:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_bookings`
--

CREATE TABLE `product_bookings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `alt_text` varchar(100) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_name` varchar(50) NOT NULL COMMENT 'e.g., "Color", "Size"',
  `attribute_value` varchar(50) NOT NULL COMMENT 'e.g., "Red", "XL"',
  `price_adjustment` decimal(10,2) DEFAULT 0.00,
  `sku_suffix` varchar(10) DEFAULT NULL COMMENT 'Appends to main SKU (e.g., "-RED")',
  `quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `attribute_name`, `attribute_value`, `price_adjustment`, `sku_suffix`, `quantity`) VALUES
(1, 1, 'Color', 'Red', 0.00, '-RED', 10),
(2, 1, 'Color', 'Green', 0.00, '-GRN', 8),
(3, 1, 'Color', 'Gold', 1500.00, '-GLD', 7),
(4, 2, 'Size', 'S', 0.00, '-S', 5),
(5, 2, 'Size', 'M', 0.00, '-M', 6),
(6, 2, 'Size', 'L', 0.00, '-L', 4),
(7, 2, 'Size', 'XL', 1000.00, '-XL', 3),
(8, 3, 'Color', 'Ivory', 0.00, '-IVY', 6),
(9, 3, 'Color', 'Gold', 2000.00, '-GLD', 5),
(10, 3, 'Color', 'Maroon', 0.00, '-MRN', 4),
(11, 4, 'Type', 'Necklace Set', 0.00, '-NS', 15),
(12, 4, 'Type', 'Complete Set', 2500.00, '-CS', 15),
(13, 5, 'Language', 'English', 0.00, '-ENG', 50),
(14, 5, 'Language', 'Hindi', 0.00, '-HIN', 30),
(15, 5, 'Language', 'Bilingual', 500.00, '-BIL', 20),
(16, 6, 'Theme', 'Floral', 0.00, '-FLR', 4),
(17, 6, 'Theme', 'Royal', 5000.00, '-RYL', 2),
(18, 6, 'Theme', 'Modern', 3000.00, '-MOD', 2),
(19, 7, 'Size', 'Small (5 cones)', 0.00, '-SML', 20),
(20, 7, 'Size', 'Medium (10 cones)', 500.00, '-MED', 20),
(21, 7, 'Size', 'Large (20 cones)', 1000.00, '-LRG', 10),
(22, 8, 'Type', 'Chocolate Box', 0.00, '-CHC', 15),
(23, 8, 'Type', 'Silver Coin', 1500.00, '-SIL', 15),
(24, 8, 'Type', 'Plant Sapling', 500.00, '-PLT', 10),
(25, 9, 'Skin Tone', 'Fair', 0.00, '-FAR', 4),
(26, 9, 'Skin Tone', 'Medium', 0.00, '-MED', 4),
(27, 9, 'Skin Tone', 'Deep', 0.00, '-DEP', 4),
(28, 10, 'Size', '10x8 feet', 0.00, '-10', 3),
(29, 10, 'Size', '12x10 feet', 3000.00, '-12', 2),
(30, 11, 'Weight', '200g', 0.00, '-200', 15),
(31, 11, 'Weight', '300g', 1500.00, '-300', 10),
(32, 11, 'Weight', '500g', 3000.00, '-500', 10),
(33, 12, 'Size', 'Small (6\")', 0.00, '-SML', 25),
(34, 12, 'Size', 'Medium (9\")', 400.00, '-MED', 20),
(35, 12, 'Size', 'Large (12\")', 800.00, '-LRG', 15),
(36, 13, 'Wood', 'Sheesham', 0.00, '-SHM', 10),
(37, 13, 'Wood', 'Rosewood', 1000.00, '-RSW', 5),
(38, 13, 'Wood', 'Sandalwood', 2000.00, '-SDL', 5),
(39, 14, 'Size', 'Small (8\")', 0.00, '-SML', 15),
(40, 14, 'Size', 'Large (12\")', 800.00, '-LRG', 10),
(41, 15, 'Bead Size', '6mm', 0.00, '-6', 10),
(42, 15, 'Bead Size', '8mm', 1000.00, '-8', 10),
(43, 15, 'Bead Size', '10mm', 2000.00, '-10', 10),
(44, 16, 'Type', 'Plain', 0.00, '-PLN', 40),
(45, 16, 'Type', 'Engraved', 300.00, '-ENG', 40),
(46, 17, 'Purpose', 'General', 0.00, '-GEN', 50),
(47, 17, 'Purpose', 'Wedding', 200.00, '-WED', 30),
(48, 17, 'Purpose', 'Griha Pravesh', 200.00, '-GRI', 20),
(49, 18, 'Material', 'Copper', 0.00, '-COP', 8),
(50, 18, 'Material', 'Brass', -300.00, '-BRS', 7),
(51, 19, 'Size', 'Small (6\")', 0.00, '-SML', 10),
(52, 19, 'Size', 'Medium (9\")', 400.00, '-MED', 5),
(53, 19, 'Size', 'Large (12\")', 800.00, '-LRG', 3),
(54, 20, 'Language', 'Hindi', 0.00, '-HIN', 20),
(55, 20, 'Language', 'English', 0.00, '-ENG', 15),
(56, 20, 'Language', 'Sanskrit', 200.00, '-SNK', 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vendor_id`, `category`, `title`, `description`, `price`, `image`) VALUES
(1, 1, 'Banquet Halls', 'Grand Ballroom', 'Elegant ballroom with capacity for 500 guests', 150000.00, 'grand-ballroom.jpg'),
(2, 1, 'Banquet Halls', 'Royal Garden', 'Outdoor garden venue with natural beauty', 120000.00, 'royal-garden.jpg'),
(3, 1, 'Banquet Halls', 'Emerald Hall', 'Luxurious hall with emerald theme decor', 180000.00, 'emerald-hall.jpg'),
(4, 2, 'Decor', 'Floral Decor Package', 'Complete floral decoration for weddings', 75000.00, 'floral-decor.jpg'),
(5, 2, 'Decor', 'Theme Wedding Setup', 'Custom theme-based wedding decoration', 95000.00, 'theme-wedding.jpg'),
(6, 3, 'Catering', 'Premium Buffet Service', 'Luxury buffet with 25 dishes', 850.00, 'premium-buffet.jpg'),
(7, 3, 'Catering', 'Traditional Thali Service', 'Authentic thali meals served traditionally', 650.00, 'traditional-thali.jpg'),
(8, 2, 'Lighting', 'LED Lighting Package', 'Professional LED lighting for events', 45000.00, 'led-lighting.jpg'),
(9, 4, 'Puja Materials', 'Complete Puja Kit', 'All necessary items for religious ceremonies', 5000.00, 'puja-kit.jpg'),
(10, 4, 'Priest Services', 'Pandit Ramesh Sharma', 'Experienced priest for all ceremonies', 15000.00, 'pandit-ramesh.jpg'),
(11, 4, 'Priest Services', 'Pandit Arun Joshi', 'Vedic scholar for traditional rituals', 12000.00, 'pandit-arun.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','vendor','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin User', 'admin@eventshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(2, 'Rajesh Sharma', 'rajesh@sharmaevents.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vendor'),
(3, 'Priya Patel', 'priya@royaldecor.in', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vendor'),
(4, 'Vikram Singh', 'vikram@spicetrail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vendor'),
(5, 'Anjali Joshi', 'anjali@divinepuja.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vendor'),
(6, 'Arun Kumar', 'arun.kumar@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
(7, 'Meera Desai', 'meera.desai@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
(8, 'Rahul Gupta', 'rahul.gupta@outlook.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
(9, 'Neha Reddy', 'neha.reddy@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
(10, 'Sanjay Verma', 'sanjay.verma@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Links to users table for vendor accounts',
  `business_name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0 COMMENT 'Admin approval status',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `business_name`, `location`, `slug`, `description`, `contact_email`, `contact_phone`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 2, 'Grand Venues India', 'Kolkata', 'grand-venues', 'Premium banquet halls across India', 'info@grandvenues.com', '9876543210', 1, '2025-07-07 16:20:05', '2025-07-07 17:05:17'),
(2, 3, 'Royal Decorators', 'Kolkata', 'royal-decor', 'Professional event decoration', 'contact@royaldecor.in', '8765432109', 1, '2025-07-07 16:20:05', '2025-07-07 17:05:24'),
(3, 4, 'Spice Trail Catering', 'Kolkata', 'spice-trail', 'Authentic Indian catering services', 'catering@spicetrail.com', '7654321098', 1, '2025-07-07 16:20:05', '2025-07-07 17:05:27'),
(4, 5, 'Divine Puja Services', 'Delhi', 'divine-puja', 'Complete puja solutions', 'puja@divine.com', '6543210987', 1, '2025-07-07 16:20:05', '2025-07-07 17:05:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `idx_email` (`email`),
  ADD UNIQUE KEY `idx_mobile` (`mobile`),
  ADD KEY `idx_account_status` (`account_status`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `idx_customer` (`customer_id`);

--
-- Indexes for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  ADD PRIMARY KEY (`preference_id`),
  ADD UNIQUE KEY `idx_customer` (`customer_id`);

--
-- Indexes for table `customer_security`
--
ALTER TABLE `customer_security`
  ADD PRIMARY KEY (`security_id`),
  ADD UNIQUE KEY `idx_customer` (`customer_id`);

--
-- Indexes for table `customer_social_logins`
--
ALTER TABLE `customer_social_logins`
  ADD PRIMARY KEY (`social_id`),
  ADD UNIQUE KEY `idx_provider` (`provider`,`provider_id`),
  ADD KEY `idx_customer` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  ADD PRIMARY KEY (`otp_id`),
  ADD KEY `idx_customer` (`customer_id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_mobile` (`mobile`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `idx_customer` (`customer_id`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_bookings`
--
ALTER TABLE `product_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `address_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  MODIFY `preference_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_security`
--
ALTER TABLE `customer_security`
  MODIFY `security_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_social_logins`
--
ALTER TABLE `customer_social_logins`
  MODIFY `social_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  MODIFY `otp_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `token_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_bookings`
--
ALTER TABLE `product_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `fk_address_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_preferences`
--
ALTER TABLE `customer_preferences`
  ADD CONSTRAINT `fk_preference_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_security`
--
ALTER TABLE `customer_security`
  ADD CONSTRAINT `fk_security_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_social_logins`
--
ALTER TABLE `customer_social_logins`
  ADD CONSTRAINT `fk_social_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  ADD CONSTRAINT `fk_otp_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `fk_token_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_bookings`
--
ALTER TABLE `product_bookings`
  ADD CONSTRAINT `product_bookings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
