-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 04:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sewa-tenant`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_types`
--

CREATE TABLE `tbl_account_types` (
  `account_type_id` int(2) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `account_type_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_types`
--

INSERT INTO `tbl_account_types` (`account_type_id`, `account_type`, `account_type_order`) VALUES
(1, 'Administrator', 1),
(2, 'Leasing', 2),
(3, 'Billing', 3),
(4, 'Collection', 4),
(5, 'Customer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(3) NOT NULL,
  `admin_employee_no` varchar(25) NOT NULL,
  `admin_fullname` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(75) NOT NULL,
  `admin_photo` varchar(50) NOT NULL,
  `admin_type_id` int(2) NOT NULL,
  `active_status` int(2) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(20) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_employee_no`, `admin_fullname`, `admin_email`, `admin_password`, `admin_photo`, `admin_type_id`, `active_status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, '1', 'Administrator', 'admin@admin.dev', '215e95f88936b204603dfcff01e9f614', '', 1, 1, 'system', '2021-03-19 12:48:27', 'system', '2021-03-19 12:48:27'),
(2, 'LS-20210323', 'Minami Hamabe', 'minami@admin.dev', '215e95f88936b204603dfcff01e9f614', '', 2, 1, 'Administrator', '2021-03-23 20:20:03', 'Minami Hamabe', '2021-03-23 20:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(2) NOT NULL,
  `status_code` int(2) NOT NULL,
  `status_name` varchar(20) NOT NULL,
  `status_category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_code`, `status_name`, `status_category`) VALUES
(1, 1, 'Menunggu Pembayaran', 'Pembayaran'),
(2, 2, 'Sudah Dibayar', 'Pembayaran'),
(3, 3, 'Dibatalkan', 'Pembayaran'),
(4, 1, 'Baru', 'Penyewaan'),
(5, 2, 'Perpanjangan', 'Penyewaan'),
(6, 3, 'Berakhir', 'Penyewaan'),
(7, 1, 'Aktif', 'Akun'),
(8, 0, 'Ditutup', 'Akun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tenants`
--

CREATE TABLE `tbl_tenants` (
  `tenant_id` int(3) NOT NULL,
  `tenant_name` varchar(25) NOT NULL,
  `tenant_size` varchar(25) NOT NULL,
  `tenant_image` varchar(50) NOT NULL,
  `tenant_location` varchar(25) NOT NULL,
  `tenant_price` int(11) NOT NULL,
  `tenant_info` varchar(250) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(20) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tenants`
--

INSERT INTO `tbl_tenants` (`tenant_id`, `tenant_name`, `tenant_size`, `tenant_image`, `tenant_location`, `tenant_price`, `tenant_info`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Main Tenant', '8 m x 15 m', '', 'Lantai LG', 12000000, '<i>Exclude</i> listrik dan air', 'admin', '2021-03-19 13:01:58', 'admin', '2021-03-19 13:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(5) NOT NULL,
  `transaction_number` varchar(20) NOT NULL,
  `transaction_tenant_id` int(3) NOT NULL,
  `transaction_customer_id` int(5) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `modified_by` varchar(20) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transaction_id`, `transaction_number`, `transaction_tenant_id`, `transaction_customer_id`, `transaction_date`, `modified_by`, `modified_date`) VALUES
(1, 'TRX001-19032021', 1, 1, '2021-03-19 12:59:01', 'Kanna Hashimoto', '2021-03-19 12:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(5) NOT NULL,
  `user_identity_no` varchar(25) NOT NULL,
  `user_taxpayer_id_no` varchar(25) NOT NULL,
  `user_business_license_no` varchar(25) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone_no` varchar(15) NOT NULL,
  `user_password` varchar(75) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_photo` varchar(50) NOT NULL,
  `user_type_id` int(2) NOT NULL,
  `user_registration_date` datetime NOT NULL,
  `active_status` int(2) NOT NULL,
  `modified_by` varchar(20) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_identity_no`, `user_taxpayer_id_no`, `user_business_license_no`, `user_fullname`, `user_email`, `user_phone_no`, `user_password`, `user_address`, `user_photo`, `user_type_id`, `user_registration_date`, `active_status`, `modified_by`, `modified_date`) VALUES
(1, '03021999', '03021999', '', 'Kanna Hashimoto', 'kanna@customer.dev', '', 'ae671ecd4ebee177c57dfbfbbf28cd83', '', '', 5, '2021-03-19 12:53:50', 1, 'Kanna Hashimoto', '2021-03-19 12:53:50'),
(2, '123456789', '123.456.789', 'AB.123456789', 'Edi Setiawan', 'edi@customer.dev', '0812 3456 789', 'ae671ecd4ebee177c57dfbfbbf28cd83', 'Jl. Maju Pantang Mundur No. 125, Kel. Maju, Kec. Pantang Mundur', '', 5, '2021-03-23 16:49:03', 1, 'Edi Setiawan', '2021-03-23 16:49:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_types`
--
ALTER TABLE `tbl_account_types`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_employee_no` (`admin_employee_no`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_tenants`
--
ALTER TABLE `tbl_tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_identity_no` (`user_identity_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_types`
--
ALTER TABLE `tbl_account_types`
  MODIFY `account_type_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_tenants`
--
ALTER TABLE `tbl_tenants`
  MODIFY `tenant_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
