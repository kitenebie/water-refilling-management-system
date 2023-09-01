-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 04:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_refilling_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_fees`
--

CREATE TABLE `address_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Address` text NOT NULL,
  `Fee` text NOT NULL,
  `RefillFee` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address_fees`
--

INSERT INTO `address_fees` (`id`, `Address`, `Fee`, `RefillFee`, `created_at`, `updated_at`) VALUES
(4, 'Bulawan, Irosin, Sorsogon', '15', '10', '2023-08-18 03:40:39', '2023-08-18 03:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `all_sales`
--

CREATE TABLE `all_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Account_SaleID` text NOT NULL,
  `ProductID` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_sales`
--

INSERT INTO `all_sales` (`id`, `Account_SaleID`, `ProductID`, `Quantity`, `Amount`, `created_at`, `updated_at`) VALUES
(74, '05-2023-25607', 'product-0002', 2, '691.50', '2023-08-18 03:47:30', '2023-08-18 03:47:30'),
(76, '05-2023-25607', 'product-0001', 4, '1281.00', '2023-08-18 03:53:28', '2023-08-18 03:53:28'),
(77, '08-2023-18302', 'product-0002', 2, '701.50', '2023-08-18 04:05:21', '2023-08-18 04:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_postings`
--

CREATE TABLE `announcement_postings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announce_Code` text NOT NULL,
  `annoucements_content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement_postings`
--

INSERT INTO `announcement_postings` (`id`, `announce_Code`, `annoucements_content`, `created_at`, `updated_at`) VALUES
(13, '7S28wpX7hK', 'ANNOUNCEMENT!!! We regret to inform you that there will be water refilling interruptions on August 20, 2023, due to some unforeseen circumstances. The interruption will affect all areas of the city. We apologize for the inconvenience and will do our best to restore water as soon as possible. We will provide updates on the situation as they become available. Thank you for your understanding.', '2023-08-18 09:41:02', '2023-08-18 09:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `log_in_models`
--

CREATE TABLE `log_in_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reseller_id` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `Birthday` text NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_authe` text NOT NULL,
  `Status` text NOT NULL,
  `Token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_in_models`
--

INSERT INTO `log_in_models` (`id`, `reseller_id`, `firstname`, `lastname`, `Birthday`, `address`, `contact`, `username`, `password`, `user_authe`, `Status`, `Token`, `created_at`, `updated_at`) VALUES
(1, '05-2023-25607', 'Administrator', 'Administrator', '2023-05-25', 'Bulan', '09789456123', 'admin@admin.com', '64e1b8d34f425d19e1ee2ea7236d3028', 'Admin', 'Active', '', '2023-05-24 20:19:04', '2023-05-24 20:19:04'),
(15, '08-2023-18302', 'Kenneth', 'Gimpao', '2001-03-28', 'Bulawan, Irosin, Sorsogon', '09563455230', 'codego14328@gmail.com', 'bfbdb7a99cce3edefefca429857cc1e4', 'Reseller', 'Active', '', '2023-08-18 03:42:03', '2023-08-18 03:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_03_15_025334_create_log_in_models_table', 1),
(3, '2023_03_22_095829_create_orders_table', 1),
(4, '2023_03_22_234209_create_products_table', 1),
(5, '2023_05_13_222432_create_reseller_requests_table', 1),
(6, '2023_05_21_063408_create_reseller__addresses_table', 1),
(7, '2023_05_25_033726_create_all_sales_table', 1),
(8, '2023_05_25_060548_create_refill_sales_table', 2),
(9, '2023_06_01_002948_create_client_stocks_table', 3),
(10, '2023_06_18_015444_create_reseller_products_table', 4),
(11, '2023_06_21_021041_create_refill_requests_table', 5),
(12, '2023_06_24_101909_create_notifications_table', 5),
(13, '2023_07_02_000944_create_announcement_postings_table', 5),
(14, '2023_08_06_184521_create_address_fees_table', 6),
(15, '2023_08_18_181425_create_refill_costs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `ntime` datetime NOT NULL,
  `repeat` int(11) NOT NULL,
  `nloop` int(11) NOT NULL,
  `username` text NOT NULL,
  `publish_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `ntime`, `repeat`, `nloop`, `username`, `publish_date`, `created_at`, `updated_at`) VALUES
(21, 'Jonel\'s Refilling Station', 'product-0002 is out of Stocks, Remaining Stocks: 0', '2023-08-18 17:31:17', 1, 1, 'codego14328@gmail.com', '2023-08-18 17:31:17', '2023-08-18 09:31:17', '2023-08-18 09:31:17'),
(22, 'Jonel\'s Refilling Station', 'product-0001 is out of Stocks, Remaining Stocks: 4', '2023-08-18 17:31:17', 1, 1, 'codego14328@gmail.com', '2023-08-18 17:31:17', '2023-08-18 09:31:17', '2023-08-18 09:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reseller_ID` text NOT NULL,
  `product_ID` text NOT NULL,
  `order` int(11) NOT NULL,
  `Amount` double NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `reseller_ID`, `product_ID`, `order`, `Amount`, `status`, `created_at`, `updated_at`) VALUES
(57, '08-2023-18302', 'product-0002', 2, 691.5, 'Completed', '2023-08-18 03:45:57', '2023-08-18 03:47:30'),
(58, '08-2023-18302', 'product-0001', 4, 1281, 'Completed', '2023-08-18 03:53:02', '2023-08-18 03:53:28'),
(59, '08-2023-18302', 'product-0002', 5, 1728.75, 'Pending', '2023-08-18 09:31:30', '2023-08-18 09:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `User_ID` text NOT NULL,
  `product_id` text NOT NULL,
  `product_Name` text NOT NULL,
  `stocks` text NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `User_ID`, `product_id`, `product_Name`, `stocks`, `price`, `created_at`, `updated_at`) VALUES
(9, '05-2023-25607', 'product-0001', 'Sample Product 1', '496', 320.25, '2023-08-18 03:44:42', '2023-08-18 03:53:25'),
(10, '05-2023-25607', 'product-0002', 'Sample Product 2', '598', 345.75, '2023-08-18 03:45:16', '2023-08-18 03:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `refill_costs`
--

CREATE TABLE `refill_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `RefillCost` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refill_costs`
--

INSERT INTO `refill_costs` (`id`, `RefillCost`, `created_at`, `updated_at`) VALUES
(2, '35', '2023-08-18 11:12:46', '2023-08-18 11:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `refill_requests`
--

CREATE TABLE `refill_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Reseller_ID` text NOT NULL,
  `NumberOfGallon` int(11) NOT NULL,
  `RefillCost` double NOT NULL,
  `RefillShipFee` double NOT NULL,
  `TotalCost` double NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refill_requests`
--

INSERT INTO `refill_requests` (`id`, `Reseller_ID`, `NumberOfGallon`, `RefillCost`, `RefillShipFee`, `TotalCost`, `status`, `created_at`, `updated_at`) VALUES
(10, '08-2023-18302', 5, 35, 10, 225, 'Pending', '2023-08-18 09:34:32', '2023-08-18 09:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `refill_sales`
--

CREATE TABLE `refill_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Account_SaleID` text NOT NULL,
  `Refill_ID` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refill_sales`
--

INSERT INTO `refill_sales` (`id`, `Account_SaleID`, `Refill_ID`, `Quantity`, `Amount`, `created_at`, `updated_at`) VALUES
(16, '08-2023-18302', 'erpzLfBTpxJX', 1, '35.00', '2023-08-18 04:34:03', '2023-08-18 04:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `reseller_products`
--

CREATE TABLE `reseller_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `User_ID` text NOT NULL,
  `product_ID` text NOT NULL,
  `Price` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `limit_stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reseller_products`
--

INSERT INTO `reseller_products` (`id`, `User_ID`, `product_ID`, `Price`, `Quantity`, `limit_stock`, `created_at`, `updated_at`) VALUES
(3, '08-2023-18302', 'product-0002', 350.75, 0, 20, '2023-08-18 03:47:30', '2023-08-18 03:54:10'),
(4, '08-2023-18302', 'product-0001', 335, 4, 15, '2023-08-18 03:53:28', '2023-08-18 03:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `reseller_requests`
--

CREATE TABLE `reseller_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reseller_ID` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reseller__addresses`
--

CREATE TABLE `reseller__addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reseller_ID` text NOT NULL,
  `Address` text NOT NULL,
  `ShipFee` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_fees`
--
ALTER TABLE `address_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_sales`
--
ALTER TABLE `all_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_postings`
--
ALTER TABLE `announcement_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_in_models`
--
ALTER TABLE `log_in_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refill_costs`
--
ALTER TABLE `refill_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refill_requests`
--
ALTER TABLE `refill_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refill_sales`
--
ALTER TABLE `refill_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller_products`
--
ALTER TABLE `reseller_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller_requests`
--
ALTER TABLE `reseller_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller__addresses`
--
ALTER TABLE `reseller__addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_fees`
--
ALTER TABLE `address_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `all_sales`
--
ALTER TABLE `all_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `announcement_postings`
--
ALTER TABLE `announcement_postings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `log_in_models`
--
ALTER TABLE `log_in_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `refill_costs`
--
ALTER TABLE `refill_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `refill_requests`
--
ALTER TABLE `refill_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `refill_sales`
--
ALTER TABLE `refill_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reseller_products`
--
ALTER TABLE `reseller_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reseller_requests`
--
ALTER TABLE `reseller_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reseller__addresses`
--
ALTER TABLE `reseller__addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
