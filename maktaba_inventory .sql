-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2024 at 08:10 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maktaba_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `invt_categories`
--

CREATE TABLE `invt_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `invt_categories`
--

INSERT INTO `invt_categories` (`category_id`, `category_name`) VALUES
(1, 'Books'),
(2, 'Booklet'),
(3, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `invt_customers`
--

CREATE TABLE `invt_customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `open_balance` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invt_misc`
--

CREATE TABLE `invt_misc` (
  `misc_id` int(11) NOT NULL,
  `misc_prod_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invt_picklist`
--

CREATE TABLE `invt_picklist` (
  `picklist_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invt_products`
--

CREATE TABLE `invt_products` (
  `item_id` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `misc_id` varchar(11) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invt_purchase`
--

CREATE TABLE `invt_purchase` (
  `purchase_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `retail_price` decimal(10,2) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invt_sales`
--

CREATE TABLE `invt_sales` (
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `retail_price` decimal(10,2) DEFAULT NULL,
  `discount_1` int(11) DEFAULT NULL,
  `discount_2` int(11) DEFAULT 0,
  `cost_price` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `picklist_id` int(11) DEFAULT NULL,
  `delivery_fee` varchar(255) DEFAULT '0',
  `process_fee` varchar(255) DEFAULT '0',
  `other_fee` varchar(255) DEFAULT '0',
  `grand_total` varchar(255) DEFAULT NULL,
  `invoice_details` text DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `inv_generator` int(11) DEFAULT 100,
  `status` varchar(255) NOT NULL DEFAULT '''Pending''',
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invt_suppliers`
--

CREATE TABLE `invt_suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_status` tinyint(4) NOT NULL DEFAULT 1,
  `user_role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_status`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'aazaz.raza', 'e10adc3949ba59abbe56e057f20f883e', 1, '1', '2022-01-13 13:57:12', NULL),
(4, 'farwa.javed', 'e10adc3949ba59abbe56e057f20f883e', 1, '2', NULL, NULL),
(5, 'meerab', 'e10adc3949ba59abbe56e057f20f883e', 1, '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_detail`
--

CREATE TABLE `users_detail` (
  `user_detail_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users_detail`
--

INSERT INTO `users_detail` (`user_detail_id`, `first_name`, `last_name`, `contact_number`, `user_email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Aazaz', 'Raza', '03116794400', 'aazaz@gmail.com', 1, '2022-01-13 13:57:12', '2023-07-07 02:46:43'),
(4, 'Farwa', 'maryum', NULL, 'farwa@gmail.com', 4, NULL, NULL),
(5, 'Meerab', 'eman', NULL, 'meerab@gmaiil.com', 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invt_categories`
--
ALTER TABLE `invt_categories`
  ADD PRIMARY KEY (`category_id`) USING BTREE;

--
-- Indexes for table `invt_customers`
--
ALTER TABLE `invt_customers`
  ADD PRIMARY KEY (`customer_id`) USING BTREE;

--
-- Indexes for table `invt_misc`
--
ALTER TABLE `invt_misc`
  ADD PRIMARY KEY (`misc_id`) USING BTREE;

--
-- Indexes for table `invt_picklist`
--
ALTER TABLE `invt_picklist`
  ADD PRIMARY KEY (`picklist_id`);

--
-- Indexes for table `invt_products`
--
ALTER TABLE `invt_products`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- Indexes for table `invt_purchase`
--
ALTER TABLE `invt_purchase`
  ADD PRIMARY KEY (`purchase_id`) USING BTREE,
  ADD KEY `invt_purchase_ibfk_1` (`supplier_id`) USING BTREE;

--
-- Indexes for table `invt_sales`
--
ALTER TABLE `invt_sales`
  ADD PRIMARY KEY (`sales_id`) USING BTREE;

--
-- Indexes for table `invt_suppliers`
--
ALTER TABLE `invt_suppliers`
  ADD PRIMARY KEY (`supplier_id`) USING BTREE;

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Indexes for table `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`user_detail_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invt_categories`
--
ALTER TABLE `invt_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invt_customers`
--
ALTER TABLE `invt_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_misc`
--
ALTER TABLE `invt_misc`
  MODIFY `misc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_picklist`
--
ALTER TABLE `invt_picklist`
  MODIFY `picklist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_products`
--
ALTER TABLE `invt_products`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_purchase`
--
ALTER TABLE `invt_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_sales`
--
ALTER TABLE `invt_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invt_suppliers`
--
ALTER TABLE `invt_suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `user_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invt_purchase`
--
ALTER TABLE `invt_purchase`
  ADD CONSTRAINT `invt_purchase_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `invt_suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
