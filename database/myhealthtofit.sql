-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2025 at 05:17 PM
-- Server version: 8.0.35-0ubuntu0.23.04.1
-- PHP Version: 8.1.12-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhealthtofit`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_upgrade_request`
--

CREATE TABLE `activation_upgrade_request` (
  `id` int NOT NULL,
  `package_id` int NOT NULL,
  `package_amount` bigint NOT NULL,
  `paid_amount` bigint NOT NULL,
  `proof` varchar(225) DEFAULT NULL,
  `utr_no` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `request_date` datetime NOT NULL,
  `approve_reject_date` datetime DEFAULT NULL,
  `customer_id` varchar(20) NOT NULL,
  `request_type` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `admin_transaction_master`
--

CREATE TABLE `admin_transaction_master` (
  `id` int NOT NULL,
  `transaction_type` varchar(30) NOT NULL COMMENT 'deduct or transfer from users different wallet',
  `transaction_amount` double NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `cart_master`
--

CREATE TABLE `cart_master` (
  `cart_id` int NOT NULL,
  `user_id` varchar(20) NOT NULL COMMENT 'customer user id',
  `product_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 - cart 1-saved for later 3-wishlist',
  `purchase_type` int NOT NULL DEFAULT '0' COMMENT '1 activation 2 repurchase',
  `price` double DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `category_id` int NOT NULL,
  `under_category_id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `type` varchar(1) NOT NULL DEFAULT 'p',
  `user_id` int NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`category_id`, `under_category_id`, `category_name`, `status`, `type`, `user_id`, `create_date`, `avatar`) VALUES
(1, 0, 'Primary', 1, 'p', 1, '2023-03-03 17:11:24', NULL),
(2, 1, 'Combo', 1, 'p', 0, '2025-08-01 14:42:54', NULL),
(3, 1, 'Juice', 1, 'p', 0, '2025-08-01 11:46:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `combo_product_master`
--

CREATE TABLE `combo_product_master` (
  `id` int NOT NULL,
  `combo_id` int DEFAULT '0',
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `added_on` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1'
);

--
-- Dumping data for table `combo_product_master`
--

INSERT INTO `combo_product_master` (`id`, `combo_id`, `product_id`, `quantity`, `added_on`, `status`) VALUES
(1, 4, 1, 1, '2025-08-01 17:11:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email2` varchar(200) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `twitter` text NOT NULL,
  `youtube_link` text,
  `whatsapp` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL
);

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `phone`, `phone2`, `email`, `email2`, `facebook`, `instagram`, `twitter`, `youtube_link`, `whatsapp`, `address`, `customer_id`) VALUES
(1, '7000000000', '7000000000', 'info@myhealthtofit.com', 'myhealthtofit@gmail.com', 'https://facebook.com', 'https://www.instagram.com', 'https://twitter.com', 'https://youtube.com', '7000000000', 'Guwahati', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `id` int NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sponsor_id` varchar(30) NOT NULL,
  `dowline_id` varchar(20) NOT NULL,
  `position` int NOT NULL COMMENT '1 right 0 left',
  `epin` varchar(30) DEFAULT NULL,
  `pan` varchar(20) NOT NULL,
  `package_id` varchar(30) DEFAULT NULL,
  `bv` bigint NOT NULL DEFAULT '0',
  `main_wallet` double NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0' COMMENT '0-pending 1-active 2-blocked	 3-upgrade',
  `reject_reason` varchar(500) NOT NULL,
  `registration_date` datetime NOT NULL,
  `activation_date` datetime DEFAULT NULL,
  `requested_date` datetime DEFAULT NULL,
  `wallet_income` double NOT NULL DEFAULT '0',
  `sponsor_bonus` double NOT NULL DEFAULT '0',
  `matching_bonus` double NOT NULL,
  `repurchase_bonus` double NOT NULL,
  `reward_rank_id` int DEFAULT '0',
  `member_reason` text,
  `profile` varchar(200) NOT NULL,
  `activation_status` int NOT NULL DEFAULT '1' COMMENT '1 active 0 pending',
  `transaction_no` varchar(50) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `repurchase_right_bv` double NOT NULL,
  `repurchase_left_bv` double NOT NULL
);

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`id`, `customer_id`, `name`, `sponsor_id`, `dowline_id`, `position`, `epin`, `pan`, `package_id`, `bv`, `main_wallet`, `status`, `reject_reason`, `registration_date`, `activation_date`, `requested_date`, `wallet_income`, `sponsor_bonus`, `matching_bonus`, `repurchase_bonus`, `reward_rank_id`, `member_reason`, `profile`, `activation_status`, `transaction_no`, `proof`, `repurchase_right_bv`, `repurchase_left_bv`) VALUES
(1, 'MHTF100000', 'Administrator', '', '', 3, '', '', '1', 0, 0, 1, '', '2023-02-22 11:36:32', '2023-10-17 15:19:59', NULL, 0, 0, 0, 0, 0, NULL, '', 1, NULL, NULL, 0, 0),
(2, 'MHTF000001', 'myhealthtofit', 'MHTF100000', 'MHTF100000', 1, 'EPIN1867492305', '', '1', 0, 0, 1, '', '2024-01-09 12:37:03', '2024-01-09 12:46:14', NULL, 0, 0, 0, 0, 0, '', '', 1, NULL, NULL, 0, 0),
(417, 'MHTF985406', 'Member', 'MHTF000001', 'MHTF000001', 0, NULL, 'ASDFF1234R', NULL, 0, 0, 0, '', '2025-07-16 10:45:12', NULL, NULL, 0, 0, 0, 0, 0, 'Remark', '', 1, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_transaction_master`
--

CREATE TABLE `customer_transaction_master` (
  `id` int NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `vc_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` varchar(500) DEFAULT NULL,
  `package_id` int NOT NULL DEFAULT '0',
  `income_type_id` int NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `deduction_transfer_master`
--

CREATE TABLE `deduction_transfer_master` (
  `id` int NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `wallet_id` int NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `remarks` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deduct` int NOT NULL DEFAULT '1' COMMENT '1-deduct 0-transfer'
);

-- --------------------------------------------------------

--
-- Table structure for table `epins`
--

CREATE TABLE `epins` (
  `id` int NOT NULL,
  `epin` varchar(200) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `used` int DEFAULT '0' COMMENT '0 for unused, 1 for used',
  `generated_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `transfer_status` int NOT NULL DEFAULT '0',
  `package_id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `epin_transfer_history`
--

CREATE TABLE `epin_transfer_history` (
  `id` int NOT NULL,
  `epin` varchar(200) DEFAULT NULL,
  `transfered_from` varchar(200) DEFAULT NULL,
  `transfered_to` varchar(200) DEFAULT NULL,
  `transfered_date` datetime DEFAULT NULL,
  `package_id` int NOT NULL,
  `status` int DEFAULT '1' COMMENT '2 transfer, 3 used'
);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `gallery_category` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `galler_category`
--

CREATE TABLE `galler_category` (
  `id` int NOT NULL,
  `gallery_category` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `income_type_master`
--

CREATE TABLE `income_type_master` (
  `income_type_id` int NOT NULL,
  `income_name` varchar(30) NOT NULL,
  `remarks` varchar(200) NOT NULL
);

--
-- Dumping data for table `income_type_master`
--

INSERT INTO `income_type_master` (`income_type_id`, `income_name`, `remarks`) VALUES
(1, 'Sponsoring Bonus', '20%'),
(2, 'Repurchase Bonus', '20%'),
(3, 'Matching Bonus', '12%'),
(4, 'Rank Reward', '');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_master`
--

CREATE TABLE `kyc_master` (
  `id` int NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `ifsc_code` varchar(15) NOT NULL,
  `payee_name` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0-pending 1-approved  2-reject',
  `customer_id` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `login_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `login_time` time DEFAULT NULL,
  `status` int DEFAULT '1'
);

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `user_role`, `os`, `browser`, `ip`, `login_date`, `login_time`, `status`) VALUES
(1, 2, '2', 'Linux', 'Chrome', '::1', '2025-07-10 16:24:05', '16:24:05', 1),
(2, 1, '1', 'Linux', 'Chrome', '::1', '2025-07-14 10:32:51', '10:32:51', 1),
(3, 1, '1', 'Linux', 'Chrome', '::1', '2025-07-16 10:08:33', '10:08:33', 1),
(4, 417, '2', 'Linux', 'Chrome', '::1', '2025-07-16 10:45:40', '10:45:40', 1),
(5, 417, '2', 'Linux', 'Chrome', '::1', '2025-07-16 11:11:53', '11:11:53', 1),
(6, 1, '1', 'Linux', 'Chrome', '::1', '2025-08-01 10:25:09', '10:25:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `notification` varchar(200) NOT NULL,
  `show_until` date NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `user_type_id` int NOT NULL COMMENT 'usrtype_id',
  `member_id` varchar(20) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `bv` double NOT NULL,
  `grand_total` double NOT NULL,
  `address` text NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `order_status` int NOT NULL COMMENT '1 repurchase	',
  `added_on` datetime NOT NULL,
  `transaction_no` varchar(100) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `payment_status` int NOT NULL DEFAULT '0',
  `delivery_status` int NOT NULL DEFAULT '0',
  `approval_date` date DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `package_master`
--

CREATE TABLE `package_master` (
  `package_id` int NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `pv` double NOT NULL DEFAULT '0',
  `referral_income_percentage` double NOT NULL DEFAULT '0',
  `matching_income_percentage` double NOT NULL DEFAULT '0',
  `weekly_capping` double NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1' COMMENT '1- active 2-block',
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `package_master`
--

INSERT INTO `package_master` (`package_id`, `package_name`, `pv`, `referral_income_percentage`, `matching_income_percentage`, `weekly_capping`, `status`, `entry_date`) VALUES
(1, 'Silver Package', 2000, 10, 10, 35000, 1, '2025-08-01 11:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `package_upgrade_master`
--

CREATE TABLE `package_upgrade_master` (
  `id` int NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `pre_package_id` int NOT NULL,
  `new_package_id` int NOT NULL,
  `added_date` datetime NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `page_status`
--

CREATE TABLE `page_status` (
  `id` int NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
);

--
-- Dumping data for table `page_status`
--

INSERT INTO `page_status` (`id`, `page_name`, `status`) VALUES
(1, 'Website', 1),
(2, 'Login', 1),
(3, 'Signup', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pair_master`
--

CREATE TABLE `pair_master` (
  `id` int NOT NULL,
  `total_pair` int NOT NULL,
  `joining_bonus` int NOT NULL
);

--
-- Dumping data for table `pair_master`
--

INSERT INTO `pair_master` (`id`, `total_pair`, `joining_bonus`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payout_days`
--

CREATE TABLE `payout_days` (
  `id` int NOT NULL,
  `days` varchar(20) NOT NULL,
  `status` int NOT NULL DEFAULT '0'
);

--
-- Dumping data for table `payout_days`
--

INSERT INTO `payout_days` (`id`, `days`, `status`) VALUES
(1, 'Sunday', 0),
(2, 'Monday', 0),
(3, 'Tuesday', 1),
(4, 'Wednesday', 1),
(5, 'Thursday', 0),
(6, 'Friday', 0),
(7, 'Saturday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payout_request`
--

CREATE TABLE `payout_request` (
  `id` int NOT NULL,
  `req_amt` bigint NOT NULL,
  `processing_amt` bigint NOT NULL,
  `final_amount` bigint NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `req_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve_request_date` datetime DEFAULT NULL,
  `reason` text,
  `status` int NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int NOT NULL,
  `HSN_code` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int NOT NULL,
  `mrp` double NOT NULL,
  `selling_price` double NOT NULL COMMENT 'price including gst',
  `discount` double NOT NULL,
  `final_price` double NOT NULL,
  `gst` int NOT NULL COMMENT '%',
  `product_image_one` varchar(255) DEFAULT NULL,
  `product_image_two` varchar(255) DEFAULT NULL,
  `product_image_three` varchar(255) DEFAULT NULL,
  `product_image_four` varchar(255) DEFAULT NULL,
  `product_image_five` varchar(255) DEFAULT NULL,
  `product_image_six` varchar(255) DEFAULT NULL,
  `pv` double NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active 0-inactive'
);

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `HSN_code`, `product_name`, `category_id`, `mrp`, `selling_price`, `discount`, `final_price`, `gst`, `product_image_one`, `product_image_two`, `product_image_three`, `product_image_four`, `product_image_five`, `product_image_six`, `pv`, `added_date`, `status`) VALUES
(1, '123456', 'New Product', 3, 100, 80, 0, 80, 0, 'a4a3e88864b9add77759a57dd55aaf45.jpg', 'e64dc54735c345d3ecbbf70b7463185a.png', NULL, NULL, NULL, NULL, 2000, '2025-08-01 12:25:43', 1),
(4, '1000', 'New 100', 2, 1000, 1000, 0, 1000, 3, '38229136a843d0b6320bf10e6fc38c6e.png', '7b247c7349ec50bd7ff803ec44d94b12.jpg', NULL, NULL, NULL, NULL, 0, '2025-08-01 17:11:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank_history`
--

CREATE TABLE `rank_history` (
  `rank_history_id` int NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `rank_reward_id` int NOT NULL,
  `matching_bonus` double NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gift_received` varchar(255) NOT NULL,
  `approve_reject_date` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `rank_master`
--

CREATE TABLE `rank_master` (
  `id` int NOT NULL,
  `rank` varchar(100) NOT NULL,
  `matching_bonus` varchar(200) NOT NULL,
  `reward` varchar(100) NOT NULL,
  `added_date` datetime NOT NULL
);

--
-- Dumping data for table `rank_master`
--

INSERT INTO `rank_master` (`id`, `rank`, `matching_bonus`, `reward`, `added_date`) VALUES
(1, 'STAR EXECUTIVE', 'MATCHING BONUS 5000', 'COMPANY ATTIRE', '2024-01-07 22:22:53'),
(2, 'SILVER EXECUTIVE', 'MATCHING BONUS 10K', '1DAY TRAINING WITH LUNCH', '2024-01-07 22:23:33'),
(3, 'SAPHIRE EXECUTIVE', 'MATCHING BONUS 50K', 'BRANDED BLAZER WITH RS. 5000/-', '2024-01-07 22:23:33'),
(4, 'RUBY EXECUTIVE', 'MATCHING BONUS 1.50L', 'LABTOP FUN RS. 25,000', '2024-01-07 22:25:49'),
(5, 'GOLD EXECUTIVE', 'MATCHING BONUS 2.5L', 'PROJECTOR RS. 35,000', '2024-01-07 22:25:49'),
(6, 'EMERALD EXECUTIVE', 'MATCHING BONUS 5L', 'BIKE FUND RS. 1,20,000', '2024-01-07 22:31:28'),
(7, 'DIAMOND EXECUTIVE', 'MATCHING BONUS 7.5L', 'CAR FUND RS. 2,00,000', '2024-01-07 22:31:28'),
(8, 'BLUE DIAMOND EXECUTIVE', 'MATCHING BONUS 15L', 'CAR FUND RS. 3,00,000', '2024-01-07 22:32:32'),
(9, 'PRESIDENT TEAM', 'MATCHING BONUS 20L', 'CAR FUND RS. 4,00,000', '2024-01-07 22:32:32'),
(10, 'AMBASSADOR', 'MATCHING BONUS 30L', 'CAR FUND RS. 7,00,000', '2024-01-07 22:33:19'),
(11, 'ROYAL AMBASSADOR', 'MATCHING BONUS 30L', 'CAR FUND RS. 10,00,000', '2024-01-07 22:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `repurchase_bv_upgrade`
--

CREATE TABLE `repurchase_bv_upgrade` (
  `id` int NOT NULL,
  `right_bv` double NOT NULL,
  `left_bv` double NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `added_date` date NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int NOT NULL,
  `tds` double NOT NULL,
  `pan` double NOT NULL,
  `admIn_charge` double NOT NULL,
  `min_withdrawal_amt` bigint NOT NULL
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
  `id` int NOT NULL,
  `from_customer_id` varchar(20) NOT NULL COMMENT 'customer_id',
  `to_customer_id` varchar(20) NOT NULL DEFAULT '',
  `subject` varchar(200) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `sent_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `transaction_password` varchar(255) NOT NULL,
  `create_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int NOT NULL DEFAULT '1',
  `user_type` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT ' 0-pending approval 1- active , 2-inactive  3-reject',
  `designation` varchar(30) NOT NULL,
  `profile` varchar(100) NOT NULL
);

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `customer_id`, `user_name`, `user_email`, `user_phone`, `password`, `transaction_password`, `create_date_time`, `role_id`, `user_type`, `status`, `designation`, `profile`) VALUES
(1, 'MHTF100000', 'Administrator', 'admin@gmail.com', '1234567890', '00f50be1466d5057d653d867ab8df193a068133aaffc8e68e000a60ef56f8d32634b13a83a47ecac53a1f418e9306a3621f9cc1761121c7cba224fc02b04f7945X363YMTm3xkQ9S/SjWYY+VGfKQYk+GHiHj+z/Y476Q=', '00f50be1466d5057d653d867ab8df193a068133aaffc8e68e000a60ef56f8d32634b13a83a47ecac53a1f418e9306a3621f9cc1761121c7cba224fc02b04f7945X363YMTm3xkQ9S/SjWYY+VGfKQYk+GHiHj+z/Y476Q=', '2023-01-31 10:48:11', 1, 1, 1, '', ''),
(2, 'MHTF000001', 'myhealthtofit', '', '1234567890', '00f50be1466d5057d653d867ab8df193a068133aaffc8e68e000a60ef56f8d32634b13a83a47ecac53a1f418e9306a3621f9cc1761121c7cba224fc02b04f7945X363YMTm3xkQ9S/SjWYY+VGfKQYk+GHiHj+z/Y476Q=', '1b7eb97a60db3cdd5621d38677639df84915ace597af1b6e279a9418294463c7e91558092262a59bd84cc205d490d35d8c880fd79e4b4897a7104f0fbf892c54H6pgtR3CCPGchX8rXfxQ362po47WBsH6K3vITEA9NvA=', '2024-01-09 12:37:03', 1, 2, 1, '', ''),
(417, 'MHTF985406', 'Member', 'nikucharimuthia@gmail.com', '7002779799', '3ec52644455c0cb2b07cb61f20b62959c66ad0252c24c905e23d3368b6e86f2f3ebcb970d893695011f0c68d7c9ba038f245450580b8ce5571c6da601282d69dTBs+Pq8JmIIeDpa9tbthU/RvAqBy8HEKcBkKzd+lTos=', '1ee1a82a09d5da99b91bf63269359816ab45dec58119d5942dcbb02b3f64508c538fd9551ba405d91d94d219d9e3a1227bc4d385f3a5a2526c076a48fbbe8680FNPL0nPS5e0H2u1k7rxWGFtpK7Q4kMDMabtD+1L3430=', '2025-07-16 10:45:12', 1, 2, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int NOT NULL,
  `type` varchar(20) NOT NULL
);

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_master`
--

CREATE TABLE `wallet_master` (
  `id` int NOT NULL,
  `wallet` varchar(30) NOT NULL
);

--
-- Dumping data for table `wallet_master`
--

INSERT INTO `wallet_master` (`id`, `wallet`) VALUES
(1, 'Main Wallet'),
(2, 'Sponsor Wallet'),
(3, 'Hybrid Wallet'),
(4, 'Life Maker Wallet'),
(5, 'Rank Wallet'),
(6, 'Topup Wallet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_upgrade_request`
--
ALTER TABLE `activation_upgrade_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_transaction_master`
--
ALTER TABLE `admin_transaction_master`
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
-- Indexes for table `epins`
--
ALTER TABLE `epins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epin_transfer_history`
--
ALTER TABLE `epin_transfer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_category` (`gallery_category`);

--
-- Indexes for table `galler_category`
--
ALTER TABLE `galler_category`
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
-- Indexes for table `package_upgrade_master`
--
ALTER TABLE `package_upgrade_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_status`
--
ALTER TABLE `page_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pair_master`
--
ALTER TABLE `pair_master`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `rank_history`
--
ALTER TABLE `rank_history`
  ADD PRIMARY KEY (`rank_history_id`);

--
-- Indexes for table `rank_master`
--
ALTER TABLE `rank_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repurchase_bv_upgrade`
--
ALTER TABLE `repurchase_bv_upgrade`
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
-- Indexes for table `wallet_master`
--
ALTER TABLE `wallet_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_upgrade_request`
--
ALTER TABLE `activation_upgrade_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_transaction_master`
--
ALTER TABLE `admin_transaction_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_master`
--
ALTER TABLE `cart_master`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `combo_product_master`
--
ALTER TABLE `combo_product_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `customer_transaction_master`
--
ALTER TABLE `customer_transaction_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deduction_transfer_master`
--
ALTER TABLE `deduction_transfer_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epins`
--
ALTER TABLE `epins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epin_transfer_history`
--
ALTER TABLE `epin_transfer_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galler_category`
--
ALTER TABLE `galler_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_type_master`
--
ALTER TABLE `income_type_master`
  MODIFY `income_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kyc_master`
--
ALTER TABLE `kyc_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_master`
--
ALTER TABLE `package_master`
  MODIFY `package_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_upgrade_master`
--
ALTER TABLE `package_upgrade_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_status`
--
ALTER TABLE `page_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pair_master`
--
ALTER TABLE `pair_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payout_days`
--
ALTER TABLE `payout_days`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payout_request`
--
ALTER TABLE `payout_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rank_history`
--
ALTER TABLE `rank_history`
  MODIFY `rank_history_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rank_master`
--
ALTER TABLE `rank_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `repurchase_bv_upgrade`
--
ALTER TABLE `repurchase_bv_upgrade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_master`
--
ALTER TABLE `support_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `wallet_master`
--
ALTER TABLE `wallet_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`gallery_category`) REFERENCES `galler_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
