-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 12:32 PM
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
  `created_by` int(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(3) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_employee_no`, `admin_fullname`, `admin_email`, `admin_password`, `admin_photo`, `admin_type_id`, `active_status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, '1', 'Administrator', 'admin@admin.dev', '215e95f88936b204603dfcff01e9f614', '', 1, 1, 1, '2021-03-19 12:48:27', 1, '2021-03-19 12:48:27'),
(2, 'LS-20210323', 'Minami Hamabe', 'minami@admin.dev', '215e95f88936b204603dfcff01e9f614', '', 2, 1, 1, '2021-03-23 20:20:03', 1, '2021-03-23 20:20:03'),
(3, 'LS-20210324', 'Cindy Yuvia', 'cindy@admin.dev', '215e95f88936b204603dfcff01e9f614', '', 2, 1, 1, '2021-03-24 09:46:40', 1, '2021-03-24 09:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(5) NOT NULL,
  `payment_nominal` int(11) NOT NULL,
  `payment_method_id` int(2) NOT NULL,
  `payment_status_id` int(2) NOT NULL,
  `payment_transaction_no` varchar(20) NOT NULL,
  `payment_paymentslip_file` varchar(100) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `payment_nominal`, `payment_method_id`, `payment_status_id`, `payment_transaction_no`, `payment_paymentslip_file`, `payment_date`) VALUES
(1, 11500000, 1, 1, 'TRX-310321.001', '', '2021-04-02 17:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE `tbl_payment_methods` (
  `method_id` int(2) NOT NULL,
  `method_bank_name` varchar(15) NOT NULL,
  `method_bank_account` varchar(25) NOT NULL,
  `method_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_methods`
--

INSERT INTO `tbl_payment_methods` (`method_id`, `method_bank_name`, `method_bank_account`, `method_type`) VALUES
(1, 'BCA', '123456789', 'Bank Transfer'),
(2, 'Mandiri', '135792468', 'Bank Transfer'),
(3, 'BNI', '1122334455', 'Bank Transfer'),
(4, 'BCA', '123456789006', 'Akun Virtual'),
(5, 'Mandiri', '135792468006', 'Akun Virtual'),
(6, 'BNI', '1122334455006', 'Akun Virtual');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(2) NOT NULL,
  `status_code` int(2) NOT NULL,
  `status_name` varchar(20) NOT NULL,
  `status_category` varchar(15) NOT NULL,
  `status_category_code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_code`, `status_name`, `status_category`, `status_category_code`) VALUES
(1, 1, 'Menunggu Pembayaran', 'Pembayaran', 'PAYMENT'),
(2, 2, 'Sudah Dibayar', 'Pembayaran', 'PAYMENT'),
(3, 3, 'Dibatalkan', 'Pembayaran', 'PAYMENT'),
(4, 1, 'Belum Aktif', 'Masa Aktif Sewa', 'ACTIVE_PERIOD'),
(5, 2, 'Aktif / Berjalan', 'Masa Aktif Sewa', 'ACTIVE_PERIOD'),
(6, 3, 'Non-aktif / Berakhir', 'Masa Aktif Sewa', 'ACTIVE_PERIOD'),
(7, 1, 'Baru', 'Jenis Sewa', 'RENT_TYPE'),
(8, 2, 'Perpanjangan', 'Jenis Sewa', 'RENT_TYPE'),
(9, 1, 'Tersedia', 'Ketersediaan', 'AVAILABILITY'),
(10, 2, 'Tidak Tersedia', 'Ketersediaan', 'AVAILABILITY'),
(11, 1, 'Aktif', 'Akun', 'ACCOUNT'),
(12, 0, 'Ditutup', 'Akun', 'ACCOUNT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tenants`
--

CREATE TABLE `tbl_tenants` (
  `tenant_id` int(3) NOT NULL,
  `tenant_code` varchar(15) NOT NULL,
  `tenant_name` varchar(25) NOT NULL,
  `tenant_size` varchar(25) NOT NULL,
  `tenant_image` varchar(50) NOT NULL,
  `tenant_location` varchar(25) NOT NULL,
  `tenant_price` int(11) NOT NULL,
  `tenant_min_period` int(2) NOT NULL,
  `tenant_info` varchar(250) NOT NULL,
  `tenant_availability` int(2) NOT NULL,
  `created_by` int(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(3) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tenants`
--

INSERT INTO `tbl_tenants` (`tenant_id`, `tenant_code`, `tenant_name`, `tenant_size`, `tenant_image`, `tenant_location`, `tenant_price`, `tenant_min_period`, `tenant_info`, `tenant_availability`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, '', 'Main Tenant AZ', '8 m x 15 m', 'xps-7zwvnvsaafy-unsplash.jpg', 'Lantai LG', 11500000, 1, 'Exclude listrik dan air', 1, 1, '2021-03-19 13:01:58', 1, '2021-04-01 20:52:09'),
(2, '', 'Tenant Kecil', '5 m x 8 m', '', 'Lantai 1', 15000000, 6, 'Belum termasuk listrik dan air', 1, 1, '2021-03-24 17:41:42', 1, '2021-04-01 20:49:37'),
(3, '', 'Tenant Lebih Besar', '8 m x 10 m', '', 'Lantai 1', 20000000, 2, 'Belum termasuk listrik dan air', 1, 1, '2021-03-24 17:42:25', 1, '2021-03-30 11:32:50'),
(4, '', 'Tenant Bebas', '5 m x 5 m', '', 'Lantai 2', 10000000, 3, 'Belum termasuk listrik dan air', 1, 1, '2021-03-24 17:44:31', 1, '2021-03-30 11:32:57'),
(5, '', 'Tenant Bebas Lagi', '5 m x 5 m', '', 'Lantai 5', 10000000, 5, 'Belum termasuk listrik dan air', 1, 1, '2021-03-24 17:45:11', 1, '2021-03-30 11:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(5) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_tenant_id` int(3) NOT NULL,
  `transaction_rent_from` datetime NOT NULL,
  `transaction_rent_to` datetime NOT NULL,
  `transaction_type_of_business` varchar(50) NOT NULL,
  `transaction_company_name` varchar(50) NOT NULL,
  `transaction_note` varchar(250) NOT NULL,
  `transaction_rent_type_id` int(2) NOT NULL,
  `transaction_active_status_id` int(2) NOT NULL,
  `transaction_contract_file` varchar(100) NOT NULL,
  `transaction_customer_id` int(5) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `modified_by` int(5) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transaction_id`, `transaction_no`, `transaction_tenant_id`, `transaction_rent_from`, `transaction_rent_to`, `transaction_type_of_business`, `transaction_company_name`, `transaction_note`, `transaction_rent_type_id`, `transaction_active_status_id`, `transaction_contract_file`, `transaction_customer_id`, `transaction_date`, `modified_by`, `modified_date`) VALUES
(28, 'TRX-310321.001', 1, '2021-03-31 00:00:00', '2021-05-20 00:00:00', 'Makanan', 'PT Makanan Sehat', '', 1, 1, '', 1, '2021-03-31 13:37:15', 1, '2021-03-31 13:37:15');

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
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`);

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
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_tenants`
--
ALTER TABLE `tbl_tenants`
  MODIFY `tenant_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
