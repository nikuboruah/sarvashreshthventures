-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2026 at 11:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarvashreshthventures`
--

-- --------------------------------------------------------

--
-- Table structure for table `bv_flush_history`
--

CREATE TABLE `bv_flush_history` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL,
  `flush_bv` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `cart_master`
--

CREATE TABLE `cart_master` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL COMMENT 'customer user id',
  `product_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - cart 1-saved for later 3-wishlist',
  `purchase_type` int(11) NOT NULL DEFAULT 0 COMMENT '1 activation 2 repurchase',
  `price` double DEFAULT NULL
);

--
-- Dumping data for table `cart_master`
--

INSERT INTO `cart_master` (`cart_id`, `user_id`, `product_id`, `date`, `qty`, `order_id`, `status`, `purchase_type`, `price`) VALUES
(1, 'SSVT306478', 1, '2026-03-08 11:26:06', 1, 'ORDR172891772949391', 1, 1, 2000),
(2, 'SSVT306478', 2, '2026-03-08 11:26:08', 1, 'ORDR172891772949391', 1, 1, 1500),
(3, 'SSVT340195', 1, '2026-03-08 11:27:13', 1, 'ORDR197251772949651', 1, 1, 2000),
(4, 'SSVT340195', 2, '2026-03-08 11:27:16', 1, 'ORDR197251772949651', 1, 1, 1500),
(5, 'SSVT573610', 1, '2026-03-08 11:53:47', 1, 'ORDR620491772951043', 1, 1, 2000),
(6, 'SSVT573610', 2, '2026-03-08 11:53:50', 1, 'ORDR620491772951043', 1, 1, 1500),
(7, 'SSVT725639', 1, '2026-03-08 11:55:23', 1, 'ORDR759131772951137', 1, 1, 2000),
(8, 'SSVT725639', 2, '2026-03-08 11:55:25', 1, 'ORDR759131772951137', 1, 1, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `category_id` int(11) NOT NULL,
  `under_category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` varchar(1) NOT NULL DEFAULT 'p',
  `user_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`category_id`, `under_category_id`, `category_name`, `status`, `type`, `user_id`, `create_date`, `avatar`) VALUES
(1, 0, 'Primary', 1, 'p', 1, '2023-03-03 17:11:24', NULL),
(2, 1, 'Combo', 1, 'p', 0, '2025-08-01 14:42:54', NULL),
(3, 1, 'Juice', 1, 'p', 0, '2025-08-01 11:46:23', NULL),
(5, 1, 'Household', 1, 'p', 0, '2026-03-01 15:55:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `combo_product_master`
--

CREATE TABLE `combo_product_master` (
  `id` int(11) NOT NULL,
  `combo_id` int(11) DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email2` varchar(200) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `twitter` text NOT NULL,
  `youtube_link` text DEFAULT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sponsor_id` varchar(30) NOT NULL,
  `dowline_id` varchar(20) NOT NULL,
  `position` int(11) NOT NULL COMMENT '1 right 0 left',
  `pan` varchar(20) NOT NULL,
  `package_id` varchar(30) DEFAULT NULL,
  `main_wallet` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-pending 1-active 2-blocked	 3-upgrade',
  `reject_reason` varchar(500) NOT NULL,
  `registration_date` datetime NOT NULL,
  `activation_date` datetime DEFAULT NULL,
  `requested_date` datetime DEFAULT NULL,
  `reward_rank_id` int(11) DEFAULT 0,
  `member_reason` text DEFAULT NULL,
  `profile` varchar(200) NOT NULL,
  `activation_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 active 0 pending',
  `transaction_no` varchar(50) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `match_left` int(11) NOT NULL DEFAULT 0,
  `match_right` int(11) NOT NULL DEFAULT 0,
  `total_points` int(11) NOT NULL DEFAULT 0,
  `left_pv` int(11) NOT NULL DEFAULT 0,
  `right_pv` int(11) NOT NULL DEFAULT 0,
  `left_activation_pv` int(11) NOT NULL DEFAULT 0,
  `right_activation_pv` int(11) NOT NULL DEFAULT 0,
  `team_star_date` date DEFAULT NULL,
  `team_builder_date` date DEFAULT NULL,
  `ldb1_status` int(11) NOT NULL DEFAULT 0,
  `ldb2_status` int(11) NOT NULL DEFAULT 0,
  `left_repurchase_bv` bigint(20) NOT NULL,
  `right_repurchase_bv` bigint(20) NOT NULL,
  `left_paid_bv` bigint(20) NOT NULL,
  `right_paid_bv` bigint(20) NOT NULL
);

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`id`, `customer_id`, `name`, `sponsor_id`, `dowline_id`, `position`, `pan`, `package_id`, `main_wallet`, `status`, `reject_reason`, `registration_date`, `activation_date`, `requested_date`, `reward_rank_id`, `member_reason`, `profile`, `activation_status`, `transaction_no`, `proof`, `match_left`, `match_right`, `total_points`, `left_pv`, `right_pv`, `left_activation_pv`, `right_activation_pv`, `team_star_date`, `team_builder_date`, `ldb1_status`, `ldb2_status`, `left_repurchase_bv`, `right_repurchase_bv`, `left_paid_bv`, `right_paid_bv`) VALUES
(1, 'SSVT100000', 'Administrator', '', '', 3, '', '1', 0, 1, '', '2023-02-22 11:36:32', '2023-10-17 15:19:59', NULL, 0, NULL, '', 1, NULL, NULL, 1, 1, 1, 1, 1, 2000, 2000, NULL, NULL, 0, 0, 0, 0, 0, 0),
(7, 'SSVT306478', 'm1', 'SSVT100000', 'SSVT100000', 0, 'asdfg1234r', '1', 0, 1, '', '2026-03-08 11:12:28', '2026-03-08 11:31:07', '2026-03-08 11:26:31', 0, 'asasas', '', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0),
(8, 'SSVT340195', 'm2', 'SSVT100000', 'SSVT100000', 1, 'asasa1234f', '1', 0, 1, '', '2026-03-08 11:13:09', '2026-03-08 11:31:26', '2026-03-08 11:30:51', 0, 'assas', '', 1, '1212121212', 'f0b2dab052402a43228d61b298abb815.png', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0),
(9, 'SSVT573610', 'm3', 'SSVT306478', 'SSVT306478', 0, 'asdfg3456y', '1', 0, 0, '', '2026-03-08 11:33:21', NULL, '2026-03-08 11:54:03', 0, 'wsewsew', '', 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0),
(10, 'SSVT725639', 'm4', 'SSVT306478', 'SSVT306478', 1, 'asdfg2346d', '1', 0, 0, '', '2026-03-08 11:52:12', NULL, '2026-03-08 11:55:37', 0, 'aasasas', '', 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0),
(11, 'SSVT832017', 'm5', 'SSVT725639', 'SSVT725639', 1, 'asxcv4567s', NULL, 0, 0, '', '2026-03-08 11:55:01', NULL, NULL, 0, 'asasas', '', 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_transaction_master`
--

CREATE TABLE `customer_transaction_master` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `debit` double NOT NULL DEFAULT 0,
  `credit` double NOT NULL DEFAULT 0,
  `vc_date` datetime NOT NULL DEFAULT current_timestamp(),
  `remark` varchar(500) DEFAULT NULL,
  `income_type_id` int(11) NOT NULL DEFAULT 0
);

-- --------------------------------------------------------

--
-- Table structure for table `deduction_transfer_master`
--

CREATE TABLE `deduction_transfer_master` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `remarks` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deduct` int(11) NOT NULL DEFAULT 1 COMMENT '1-deduct 0-transfer'
);

-- --------------------------------------------------------

--
-- Table structure for table `income_type_master`
--

CREATE TABLE `income_type_master` (
  `income_type_id` int(11) NOT NULL,
  `income_name` varchar(225) NOT NULL,
  `remarks` varchar(200) NOT NULL
);

--
-- Dumping data for table `income_type_master`
--

INSERT INTO `income_type_master` (`income_type_id`, `income_name`, `remarks`) VALUES
(1, 'Fast Start Bonus 1', '5000 5weeks'),
(2, 'Fast Start Bonus -2', '5000 6weeks'),
(3, 'LEADERSHIP DUPLICATION BONUS -1', '8000 16weeks'),
(4, 'LEADERSHIP DUPLICATION BONUS -2', '16000 16weeks'),
(5, 'Team Sales Bonus', '');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_master`
--

CREATE TABLE `kyc_master` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `ifsc_code` varchar(15) NOT NULL,
  `payee_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-pending 1-approved  2-reject',
  `customer_id` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `login_date` datetime DEFAULT current_timestamp(),
  `login_time` time DEFAULT NULL,
  `status` int(11) DEFAULT 1
);

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `user_role`, `os`, `browser`, `ip`, `login_date`, `login_time`, `status`) VALUES
(1, 1, '1', 'Windows 10', 'Chrome', '::1', '2026-03-08 11:13:32', '11:13:32', 1),
(2, 8, '2', 'Windows 10', 'Chrome', '::1', '2026-03-08 11:24:00', '11:24:00', 1),
(3, 9, '2', 'Windows 10', 'Chrome', '::1', '2026-03-08 11:27:10', '11:27:10', 1),
(4, 10, '2', 'Windows 10', 'Chrome', '::1', '2026-03-08 11:53:29', '11:53:29', 1),
(5, 11, '2', 'Windows 10', 'Chrome', '::1', '2026-03-08 11:55:20', '11:55:20', 1),
(6, 8, '2', 'Windows 10', 'Chrome', '::1', '2026-03-08 15:45:51', '15:45:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification` varchar(200) NOT NULL,
  `show_until` date NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `user_type_id` int(11) NOT NULL COMMENT 'usrtype_id',
  `member_id` varchar(20) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `bv` double NOT NULL,
  `grand_total` double NOT NULL,
  `address` text NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL COMMENT '1 repurchase	',
  `added_on` datetime NOT NULL,
  `transaction_no` varchar(100) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `delivery_status` int(11) NOT NULL DEFAULT 0,
  `approval_date` date DEFAULT NULL
);

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `order_id`, `bv`, `grand_total`, `address`, `payment_mode`, `customer_id`, `order_status`, `added_on`, `transaction_no`, `proof`, `payment_status`, `delivery_status`, `approval_date`) VALUES
(1, 'ORDR172891772949391', 2000, 3500, 'Hello', 'Cash', 'SSVT306478', 0, '2026-03-08 11:26:31', NULL, NULL, 1, 0, NULL),
(2, 'ORDR197251772949651', 2000, 3500, 'asasas', 'Bank', 'SSVT340195', 0, '2026-03-08 11:30:51', '1212121212', 'f0b2dab052402a43228d61b298abb815.png', 0, 0, NULL),
(3, 'ORDR620491772951043', 2000, 3500, 'asasasas', 'Cash', 'SSVT573610', 0, '2026-03-08 11:54:03', NULL, NULL, 1, 0, NULL),
(4, 'ORDR759131772951137', 2000, 3500, 'aasasas', 'Cash', 'SSVT725639', 0, '2026-03-08 11:55:37', NULL, NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_master`
--

CREATE TABLE `package_master` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `pv` double NOT NULL DEFAULT 0,
  `matching_income_percentage` double NOT NULL DEFAULT 0,
  `lesserleg_volume` bigint(20) NOT NULL,
  `weekly_capping` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1- active 2-block',
  `entry_date` datetime NOT NULL DEFAULT current_timestamp()
);

--
-- Dumping data for table `package_master`
--

INSERT INTO `package_master` (`package_id`, `package_name`, `pv`, `matching_income_percentage`, `lesserleg_volume`, `weekly_capping`, `status`, `entry_date`) VALUES
(1, 'New Package 1', 2000, 10, 5000, 25000, 1, '2026-03-08 11:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `payout_days`
--

CREATE TABLE `payout_days` (
  `id` int(11) NOT NULL,
  `days` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
);

--
-- Dumping data for table `payout_days`
--

INSERT INTO `payout_days` (`id`, `days`, `status`) VALUES
(1, 'Sunday', 1),
(2, 'Monday', 1),
(3, 'Tuesday', 1),
(4, 'Wednesday', 1),
(5, 'Thursday', 1),
(6, 'Friday', 1),
(7, 'Saturday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payout_request`
--

CREATE TABLE `payout_request` (
  `id` int(11) NOT NULL,
  `req_amt` bigint(20) NOT NULL,
  `processing_amt` bigint(20) NOT NULL,
  `final_amount` bigint(20) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `req_date` datetime NOT NULL DEFAULT current_timestamp(),
  `approve_request_date` datetime DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(11) NOT NULL,
  `HSN_code` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `mrp` double NOT NULL,
  `selling_price` double NOT NULL COMMENT 'price including gst',
  `discount` double NOT NULL,
  `final_price` double NOT NULL,
  `gst` int(11) NOT NULL COMMENT '%',
  `product_image_one` varchar(255) DEFAULT NULL,
  `product_image_two` varchar(255) DEFAULT NULL,
  `product_image_three` varchar(255) DEFAULT NULL,
  `product_image_four` varchar(255) DEFAULT NULL,
  `product_image_five` varchar(255) DEFAULT NULL,
  `product_image_six` varchar(255) DEFAULT NULL,
  `pv` double NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active 0-inactive'
);

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `HSN_code`, `product_name`, `category_id`, `mrp`, `selling_price`, `discount`, `final_price`, `gst`, `product_image_one`, `product_image_two`, `product_image_three`, `product_image_four`, `product_image_five`, `product_image_six`, `pv`, `added_date`, `status`) VALUES
(1, '12345678', 'Product 1', 3, 2000, 2000, 0, 2000, 3, 'dc8d738677712b53b9f3319d865394a9.png', NULL, NULL, NULL, NULL, NULL, 1000, '2026-03-08 11:22:36', 1),
(2, '154278', 'New Product 2', 5, 1500, 1500, 0, 1500, 3, '249b412af07086ed123424fc85e57abd.png', NULL, NULL, NULL, NULL, NULL, 1000, '2026-03-08 11:23:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank_master`
--

CREATE TABLE `rank_master` (
  `id` int(11) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `value_points` varchar(200) NOT NULL,
  `reward` varchar(100) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
);

--
-- Dumping data for table `rank_master`
--

INSERT INTO `rank_master` (`id`, `rank`, `value_points`, `reward`, `added_date`, `updated_on`) VALUES
(1, 'TEAM STAR', '5', '5000/- CASH BONUS 5 Weeks', '2024-01-07 22:22:53', '0000-00-00 00:00:00'),
(2, 'TEAM BUILDER', '10', '5000/- CASH BONUS+ T-SHIRT 6 Weeks', '2024-01-07 22:23:33', '0000-00-00 00:00:00'),
(3, 'TEAM CONSULTANT', '25', 'DOMESTIC HOLIDAY TRIP + EXECUTIVE BAG', '2024-01-07 22:23:33', '0000-00-00 00:00:00'),
(4, 'TEAM DIRECTOR', '50', 'RS 30000/- (LAPTOP FUND)', '2024-01-07 22:25:49', '0000-00-00 00:00:00'),
(5, 'RUBY DIRECTOR', '100', 'Rs60000/- CASH BONUS + DOMESTIC HOLIDAY TRIP', '2024-01-07 22:25:49', '0000-00-00 00:00:00'),
(6, 'EMERALD DIRECTOR', '250', 'Rs 80,000/- CB + INTERNATIONAL HOLIDAYTRIP', '2024-01-07 22:31:28', '0000-00-00 00:00:00'),
(7, 'SAPPHIRE DIRECTOR', '500', 'Rs 350,000/- ( CAR FUND)', '2024-01-07 22:31:28', '0000-00-00 00:00:00'),
(8, 'DIAMOND DIRECTOR', '1000', 'Rs 750,000/- ( LUXURY CAR FUND)', '2024-01-07 22:32:32', '0000-00-00 00:00:00'),
(9, 'BLACK DIAMOND DIR', '2500', 'Rs 1250000/- CASH BONUS', '2024-01-07 22:32:32', '0000-00-00 00:00:00'),
(10, 'BLUE DIAMOND DIR', '5000', 'Rs 2500000/- CASH BONUS', '2024-01-07 22:33:19', '0000-00-00 00:00:00'),
(11, 'PINK DIAMOND DIR', '10000', 'Rs 50,00,000/- CASH BONUS', '2024-01-07 22:33:19', '0000-00-00 00:00:00'),
(12, 'PRESIDENTIAL DIAMOND', '25000', 'Rs100,00000/- CASH BONUS', '2024-01-07 22:33:19', '0000-00-00 00:00:00'),
(13, 'GLOBAL DIAMOND', '50000', 'Rs 25000000/- cash bonus', '2024-01-07 22:33:19', '0000-00-00 00:00:00'),
(14, 'CROWN DIAMOND', '100000', 'Rs50000000/- cash bonus', '2024-01-07 22:33:19', '2026-03-02 14:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `tds` double NOT NULL,
  `pan` double NOT NULL,
  `admIn_charge` double NOT NULL,
  `min_withdrawal_amt` bigint(20) NOT NULL
);

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `tds`, `pan`, `admIn_charge`, `min_withdrawal_amt`) VALUES
(1, 2, 10, 10, 500);

-- --------------------------------------------------------

--
-- Table structure for table `support_master`
--

CREATE TABLE `support_master` (
  `id` int(11) NOT NULL,
  `from_customer_id` varchar(20) NOT NULL COMMENT 'customer_id',
  `to_customer_id` varchar(20) NOT NULL DEFAULT '',
  `subject` varchar(200) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `sent_date` datetime NOT NULL DEFAULT current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `transaction_password` varchar(255) NOT NULL,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` int(11) NOT NULL COMMENT '1 Admin 2 Member',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0-pending approval 1- active , 2-inactive  3-reject',
  `designation` varchar(30) NOT NULL,
  `profile` varchar(100) NOT NULL
);

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `customer_id`, `user_name`, `user_email`, `user_phone`, `password`, `transaction_password`, `create_date_time`, `user_type`, `status`, `designation`, `profile`) VALUES
(1, 'SSVT100000', 'Administrator', 'admin@gmail.com', '1234567890', '00f50be1466d5057d653d867ab8df193a068133aaffc8e68e000a60ef56f8d32634b13a83a47ecac53a1f418e9306a3621f9cc1761121c7cba224fc02b04f7945X363YMTm3xkQ9S/SjWYY+VGfKQYk+GHiHj+z/Y476Q=', '00f50be1466d5057d653d867ab8df193a068133aaffc8e68e000a60ef56f8d32634b13a83a47ecac53a1f418e9306a3621f9cc1761121c7cba224fc02b04f7945X363YMTm3xkQ9S/SjWYY+VGfKQYk+GHiHj+z/Y476Q=', '2023-01-31 10:48:11', 1, 1, '', ''),
(8, 'SSVT306478', 'm1', 'm1@gmail.com', '7002779701', 'a5df1adc798415d701a3193766ac2412b9d84c462d7fd249b679f1449e633a546829b2ef8faa74d4826b1f0d4cdc4a81e4c3c8c1a27f7596c7d2f4f0c78975faGAQEMlp6jh2Aw9Lg+r0mcu/E9z45NADRCkZoEfqp61o=', 'c59c165cd501e8217f2ce9f82553890b3597efee658290e63a409197b3597217989678d7fd02399ca6a8c7a4a441ae6c5b8479ea892966b7a4f34880f98ea79bkPwEnlpT8FEJl5xyxSbWV4Z7un+XfGIIsbJwiNQwomI=', '2026-03-08 11:12:28', 2, 1, '', ''),
(9, 'SSVT340195', 'm2', 'm2', '7002779702', '15c146e7ab8d27f6487e58ce11bf1d0754a09b25a5e0fc9c173e4f98390ca58bb56427591b5809d32c087121fee0ab121962574a3515af460e36b27c25cca9f2+DhJeYSZMRBY7BlIetcsrKxsfcbqi0Z94xdsmaH24J8=', '4501ff6961025fa055e99c91da1587b8542700428993bed80008b846997146e1cc806e95267ebdbd44cdccd799feee7edcbb37221f17abc2c50c50e20668fa96QxrjJJ+asBu8lBNgw+GUemslxHS7Hg0UvJH9NFq9Of8=', '2026-03-08 11:13:09', 2, 1, '', ''),
(10, 'SSVT573610', 'm3', 'm3@gmail.com', '7002779703', 'b2f3ec3cf8881b52a50ae4976c491f1cacd6922d78e3111c29b51dd2c9c4454116edef83bfb17a2df6e593d89e438b34768ed33b1dc3ad8d2aa312e5f3221415pFLD6Nt5/qVkYXAdzoiqB1y2YUrtDwjqmTCEjD9fwuc=', '910ee752bd6a3a77db21cafb0b8465c4d4c743c00d7bd7e09e50f3b3164426f8cedd589576f510add9fa8e6c1a55d2e9229740d8ee43c14d8adb7a057009dad5+DKlrhuwBsvTN+/F6VRJqs0xrcHi1VSY5stNqoJQanc=', '2026-03-08 11:33:21', 2, 1, '', ''),
(11, 'SSVT725639', 'm4', 'm4@gmail.com', '7002779704', '5ed78b5c01ef10c52c66be1be997d29b5061f2521ff21fb37b41649cab09729132d651d99cb908552b0118c8d3cf25d8fa5cd30e4d13ac30a8dd924af55116b37SXWtPleLm1Ht95zwKo/sTONEecfsxtuTEptIvGcVso=', '7d64c882acd39cc6d7dec232d4e9d651c6e7168c55aa602db4d17ea3b371b508823d9c897371d00bb3b0d4b00d29d847824074252c3901cfa157f6fce6144b84EiLvFRDo5iB7R3AviTGQ2gOTiHffNuYNEysN1jiVEvA=', '2026-03-08 11:52:12', 2, 1, '', ''),
(12, 'SSVT832017', 'm5', 'm5@gmail.com', '7002779705', 'ac09f3016121a7ac7852710c2af44f203ecbdbe86f47828464ff07f84c0102242f9d4cd3b73d6fcb634f83deffc36cd16cdde1246b574ba47be22e19ff34227dWJZcZD5EpTllAt4E3Qj3xTBNNPOZRvZ8FQM/HfBlZnQ=', 'b3d5b05ed6d457edbde90db0873eb345cd40db3ebfd50cbc6105c3153fe600a8937cdebfb715ac3331ebed035b98addb3400c2e48e8a1b8aff63c96a1754d123KTfTp4C7bb1gYlf9EHiVGto4FOGZGksXf3PChd4boJY=', '2026-03-08 11:55:01', 2, 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bv_flush_history`
--
ALTER TABLE `bv_flush_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_master`
--
ALTER TABLE `cart_master`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `combo_product_master`
--
ALTER TABLE `combo_product_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_transaction_master`
--
ALTER TABLE `customer_transaction_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction_transfer_master`
--
ALTER TABLE `deduction_transfer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_type_master`
--
ALTER TABLE `income_type_master`
  ADD PRIMARY KEY (`income_type_id`);

--
-- Indexes for table `kyc_master`
--
ALTER TABLE `kyc_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_master`
--
ALTER TABLE `package_master`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payout_days`
--
ALTER TABLE `payout_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_request`
--
ALTER TABLE `payout_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rank_master`
--
ALTER TABLE `rank_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_master`
--
ALTER TABLE `support_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bv_flush_history`
--
ALTER TABLE `bv_flush_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_master`
--
ALTER TABLE `cart_master`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `combo_product_master`
--
ALTER TABLE `combo_product_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer_transaction_master`
--
ALTER TABLE `customer_transaction_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deduction_transfer_master`
--
ALTER TABLE `deduction_transfer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_type_master`
--
ALTER TABLE `income_type_master`
  MODIFY `income_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kyc_master`
--
ALTER TABLE `kyc_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_master`
--
ALTER TABLE `package_master`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payout_days`
--
ALTER TABLE `payout_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payout_request`
--
ALTER TABLE `payout_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rank_master`
--
ALTER TABLE `rank_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_master`
--
ALTER TABLE `support_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
