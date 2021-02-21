-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 04:55 AM
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
-- Table structure for table `env_employees`
--

CREATE TABLE `env_employees` (
  `employee_id` varchar(9) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_employees`
--

INSERT INTO `env_employees` (`employee_id`, `last_name`, `first_name`, `position`, `gender`, `contact_number`, `email`, `pass`) VALUES
('HUM378135', 'Marc', 'Dela Cruz', 'Human Resource', 'male', '09667230222', 'marc@gmail.com', '55a5560f37d5'),
('MAN555160', 'Jerone', 'Alimpia', 'Manufacturing', 'male', '09667230222', 'jeronealimpia@gmail.com', 'c7ad44cbad76');

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
  `item_code` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_image` varchar(50) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `unit_price` float NOT NULL,
  `total_amount` float NOT NULL,
  `rm_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_raw_materials`
--

INSERT INTO `env_raw_materials` (`item_code`, `item_name`, `item_image`, `category_id`, `unit_price`, `total_amount`, `rm_status`) VALUES
('Paper', 'Papername1', 'paperimage1', 'Item_Stone', 80, 90, '100'),
('stone', 'stonename', 'stoneimage', 'Item_Stone', 60, 70, '80'),
('Stone_Brick', 'Stone Brick', 'C:fakepathEE.png', 'Item_Stone', 600, 10, '50');

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
  `PICTURE` varchar(255) NOT NULL,
  `PRODUCT_CODE` varchar(10) NOT NULL,
  `PRODUCT_NAME` varchar(30) NOT NULL,
  `PRODUCT_CATEGORY` varchar(20) NOT NULL,
  `PRODUCT_TYPE` varchar(20) NOT NULL,
  `SALES_PRICE_WT` decimal(8,2) NOT NULL,
  `UNIT` varchar(6) NOT NULL,
  `INTERNAL_DESCRIPTION` varchar(300) NOT NULL,
  `BAR_CODE` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `man_products`
--

INSERT INTO `man_products` (`PICTURE`, `PRODUCT_CODE`, `PRODUCT_NAME`, `PRODUCT_CATEGORY`, `PRODUCT_TYPE`, `SALES_PRICE_WT`, `UNIT`, `INTERNAL_DESCRIPTION`, `BAR_CODE`) VALUES
('6007d7797c3cf2.72948853.jpeg', 'CODE-123', 'Emulsifier Adjusting Cap', 'Food Service', 'Product', '1000.00', 'Kilo', 'Products that made Mr. Benjamin Almedah Sr. renowned as the “Father of Filipino Investors”', 2147483647),
('6007dedeee5fe5.96361279.jpeg', 'CODE-12312', 'Meat Grinder', 'Food Service', 'Product', '1000.00', 'Kilo', 'Sample Description', 2147483647),
('6007d860e33324.83966840.jpeg', 'CODE-456', 'Emulsifier Blade Housing', 'Food Service', 'Product', '1000.00', '100', 'Products that made Mr. Benjamin Almedah Sr. renowned as the “Father of Filipino Investors”', 111222333);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `env_employees`
--
ALTER TABLE `env_employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `env_materials_categories`
--
ALTER TABLE `env_materials_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `env_raw_materials`
--
ALTER TABLE `env_raw_materials`
  ADD PRIMARY KEY (`item_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `env_reoder_level`
--
ALTER TABLE `env_reoder_level`
  ADD PRIMARY KEY (`reorder_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `man_categorization`
--
ALTER TABLE `man_categorization`
  ADD PRIMARY KEY (`PRODUCT_CATEGORY`);

--
-- Indexes for table `man_products`
--
ALTER TABLE `man_products`
  ADD PRIMARY KEY (`PRODUCT_CODE`),
  ADD KEY `PRODUCT_CATEGORY` (`PRODUCT_CATEGORY`),
  ADD KEY `PRODUCT_TYPE` (`PRODUCT_TYPE`);

--
-- Indexes for table `man_products_typology`
--
ALTER TABLE `man_products_typology`
  ADD PRIMARY KEY (`PRODUCT_TYPE`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `man_products`
--
ALTER TABLE `man_products`
  ADD CONSTRAINT `man_products_ibfk_1` FOREIGN KEY (`PRODUCT_CATEGORY`) REFERENCES `man_categorization` (`PRODUCT_CATEGORY`),
  ADD CONSTRAINT `man_products_ibfk_2` FOREIGN KEY (`PRODUCT_TYPE`) REFERENCES `man_products_typology` (`PRODUCT_TYPE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
