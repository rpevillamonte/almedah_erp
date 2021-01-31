-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2021 at 07:06 AM
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
-- Database: `almedah_erp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bom_production_process`
--

CREATE TABLE `bom_production_process` (
  `mfg_order_no` int(11) NOT NULL,
  `bom_product_name` varchar(30) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `customer_id` int(6) NOT NULL,
  `product_stock_location` varchar(50) NOT NULL,
  `launch_quantity` int(6) NOT NULL,
  `stock_location_produced_products` varchar(50) NOT NULL,
  `stock_move_realize_order_select` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `env_materials_categories`
--

CREATE TABLE `env_materials_categories` (
  `category_id` varchar(50) NOT NULL,
  `category_title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_materials_categories`
--

INSERT INTO `env_materials_categories` (`category_id`, `category_title`, `description`, `quantity`) VALUES
('Item_Stone', 'Stone', 'Stoners for the world', 20);

-- --------------------------------------------------------

--
-- Table structure for table `env_raw_materials`
--

CREATE TABLE `env_raw_materials` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `unit_price` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `rm_status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_raw_materials`
--

INSERT INTO `env_raw_materials` (`id`, `item_code`, `item_name`, `item_image`, `category_id`, `unit_price`, `total_amount`, `rm_status`, `created_at`, `updated_at`) VALUES
(1, 'ASD', 'Papername1', 'paperimage1', 'Item_Stone', '80', '90', '100', NULL, NULL),
(2, 'QWE', 'stonename', 'stoneimage', 'Item_Stone', '60', '70', '80', NULL, NULL),
(3, 'ZXC', 'Stone Brick', 'C:fakepathEE.png', 'Item_Stone', '600', '10', '50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `env_reoder_level`
--

CREATE TABLE `env_reoder_level` (
  `reorder_id` varchar(50) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `reorder_qty` int(11) NOT NULL,
  `reorder_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_reoder_level`
--

INSERT INTO `env_reoder_level` (`reorder_id`, `category_id`, `reorder_qty`, `reorder_level`) VALUES
('Stone_reorder', 'Item_Stone', 20, '20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `man_categorization`
--

CREATE TABLE `man_categorization` (
  `ACCOUNTING_FAMILY` varchar(20) NOT NULL,
  `PRODUCT_CATEGORY` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `man_categorization`
--

INSERT INTO `man_categorization` (`ACCOUNTING_FAMILY`, `PRODUCT_CATEGORY`) VALUES
('Raw Material', 'Food Processing'),
('Equipment', 'Food Service');

-- --------------------------------------------------------

--
-- Table structure for table `man_products`
--

CREATE TABLE `man_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_price_wt` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `man_products`
--

INSERT INTO `man_products` (`id`, `product_code`, `product_name`, `product_category`, `product_type`, `sales_price_wt`, `unit`, `internal_description`, `bar_code`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'CODE-123', 'Emulsifier Adjusting Cap', 'Food Processing', 'Product', '1000.0', 'KG', 'Products that made Mr. Benjamin Almedah Sr. renowned as the Father of Filipino Investors', '2147483647', 'uploads/0HDwWN9JafXmoqNwwxIaZ2n7m2iBIAfyIH2PSn92.jpg', NULL, '2021-01-28 19:04:23'),
(2, 'CODE-12312', 'Meat Grinder', 'Food Processing', 'Product', '1000.0', 'KG', 'Sample Description', '2147483647', 'uploads/aqM9FQkQGyN7VTsW25BQQQfmgl7OFL3r6pWucfDj.jpg', NULL, '2021-01-28 19:43:38'),
(3, 'CODE-456', 'Emulsifier Blade Housing', 'Food Processing', 'Product', '1000.0', 'KG', 'Products that made Mr. Benjamin Almedah Sr. renowned as the Father of Filipino Investors', '111222333', 'uploads/8HwJnseCvdDuZwnE9jjanOh8FAG6lZNrp2APkkXu.png', NULL, '2021-01-28 19:44:29'),
(125, '34543', '5435', 'Food Processing', 'Raw', '345', 'MM', '345345', '345', 'uploads/Ged8aphLrl1KEwuK8UAJR01PcnSl3JnyOvkuUJjg.png', '2021-01-28 20:29:20', '2021-01-28 20:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `man_products_typology`
--

CREATE TABLE `man_products_typology` (
  `PRODUCT_TYPE` varchar(20) NOT NULL,
  `PRODUCT_SUBTYPE` varchar(20) NOT NULL,
  `PROCUREMENT_METHOD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `man_products_typology`
--

INSERT INTO `man_products_typology` (`PRODUCT_TYPE`, `PRODUCT_SUBTYPE`, `PROCUREMENT_METHOD`) VALUES
('Product', 'Component', 'Buy');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_28_085136_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jerone', 'jeronealimpia@gmail.com', NULL, '$2y$10$ODh4myQeFA8Y8s9BKrNLY.9essWlAP4rmITHxyFdHg3PXtUWHkdWO', NULL, '2021-01-28 04:35:36', '2021-01-28 04:35:36'),
(2, 'juan@gmail.com', 'juan@gmail.com', NULL, '$2y$10$kiCmSBww9x.jwXzmcaXE7Oxuv02dFH.qFwJEx2r.H53Ge5pS13p7y', NULL, '2021-01-28 21:32:02', '2021-01-28 21:32:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bom_production_process`
--
ALTER TABLE `bom_production_process`
  ADD PRIMARY KEY (`mfg_order_no`);

--
-- Indexes for table `env_materials_categories`
--
ALTER TABLE `env_materials_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `env_raw_materials`
--
ALTER TABLE `env_raw_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `env_reoder_level`
--
ALTER TABLE `env_reoder_level`
  ADD PRIMARY KEY (`reorder_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `man_categorization`
--
ALTER TABLE `man_categorization`
  ADD PRIMARY KEY (`PRODUCT_CATEGORY`);

--
-- Indexes for table `man_products`
--
ALTER TABLE `man_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bom_production_process`
--
ALTER TABLE `bom_production_process`
  MODIFY `mfg_order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `env_raw_materials`
--
ALTER TABLE `env_raw_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `man_products`
--
ALTER TABLE `man_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `env_raw_materials`
--
ALTER TABLE `env_raw_materials`
  ADD CONSTRAINT `env_raw_materials_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `env_materials_categories` (`category_id`);

--
-- Constraints for table `env_reoder_level`
--
ALTER TABLE `env_reoder_level`
  ADD CONSTRAINT `env_reoder_level_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `env_materials_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
