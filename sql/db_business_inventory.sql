-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2021 at 04:19 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_business_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `series_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` varchar(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_id`, `user_name`, `password`, `email`, `series_id`, `remember_token`, `expires`, `admin_type`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'superadmin', '$2y$10$K2ZsZPRnRO8dqepsDVQ4huzAcb7So/GIbbWO4BOuWQYy0MJhYA4OK', '', 'IJGPDUG5Y8kVZqHT', '$2y$10$LZihwdPrc5WLrqy5eXr6YucML2zCzg/KcR/0ag/yZ2KVLVbm0YD5K', '2020-05-29 21:13:21', 'super', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_inventory_details`
--

CREATE TABLE `business_inventory_details` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` text,
  `product_quantity` int(11) DEFAULT NULL,
  `product_purchase_date` date DEFAULT NULL,
  `product_expiry_date` date DEFAULT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` text NOT NULL,
  `product_damage_status` int(1) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_inventory_details`
--

INSERT INTO `business_inventory_details` (`id`, `timestamp`, `user_id`, `product_id`, `product_name`, `product_description`, `product_quantity`, `product_purchase_date`, `product_expiry_date`, `supplier_name`, `supplier_address`, `product_damage_status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(33, '2021-04-25 03:56:48', 1, '1', 'book1', 'robin sharma', 1, '2021-05-01', '2100-01-01', 'amazon', 'amazon india\r\ntamilnadu', 0, '1', '30-04-2021 09:34:36', '1', '30-04-2021 09:34:36', 1),
(34, '2021-04-28 01:33:12', 1, '1', 'book1', 'robin sharma', 1, '2021-05-01', '2100-01-01', 'amazon', 'amazon india\r\ntamilnadu', 0, '1', '30-04-2021 09:34:36', '1', '30-04-2021 09:34:36', 1),
(35, '2021-04-28 02:52:23', 1, '1', 'book1', 'robin sharma', 1, '2021-05-01', '2100-01-01', 'amazon', 'amazon india\r\ntamilnadu', 0, '1', '30-04-2021 09:34:36', '1', '30-04-2021 09:34:36', 1),
(36, '2021-04-30 03:41:13', 1, '1', 'book1', 'robin sharma', 1, '2021-05-01', '2100-01-01', 'amazon salem', 'amazon india\r\ntamilnadu', 0, '1', '30-04-2021 09:38:36', '1', '30-04-2021 09:38:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `localhost_logs`
--

CREATE TABLE `localhost_logs` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `localhost_logs`
--

INSERT INTO `localhost_logs` (`id`, `timestamp`, `message`) VALUES
(1, '2021-04-25 01:38:15', ' logged in as d1'),
(2, '2021-04-25 01:39:05', 'd1 logged in as karthi'),
(3, '2021-04-25 08:26:34', 'd1 logged in as d1'),
(4, '2021-04-28 01:32:16', 'd1 logged in as kumar'),
(5, '2021-04-28 02:41:05', 'superadmin logged in as admin'),
(6, '2021-04-28 02:51:52', 'd2 logged in as karthi'),
(7, '2021-04-28 02:52:38', 'superadmin logged in as s'),
(8, '2021-04-28 13:56:56', 'superadmin logged in as 1234'),
(9, '2021-04-28 14:32:16', 'superadmin logged in as kartih'),
(10, '2021-04-30 03:08:24', 'superadmin logged in as super');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `business_inventory_details`
--
ALTER TABLE `business_inventory_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localhost_logs`
--
ALTER TABLE `localhost_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `business_inventory_details`
--
ALTER TABLE `business_inventory_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `localhost_logs`
--
ALTER TABLE `localhost_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
