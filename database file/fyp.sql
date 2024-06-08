-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 12:50 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_icon` varchar(255) NOT NULL DEFAULT '',
  `cat_status` varchar(50) NOT NULL DEFAULT '',
  `created_at` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `cat_name`, `cat_icon`, `cat_status`, `created_at`) VALUES
(1, 'Cleaning', 'fa fa-user', 'active', '9/4/2023'),
(2, 'Home Move', 'fa fa-home', 'active', '9/4/2023'),
(3, 'Electronics', 'fa fa-user', 'active', '9/4/2023'),
(4, 'Handyman services', 'fa fa user', 'active', '11/04/2023'),
(5, 'Gardening services', 'fa fa-tree', 'active', '11/04/2023'),
(6, 'Child care services', 'fa fa-child', 'active', '11/04/2023'),
(7, 'House sitting services', 'fa fa-cog', 'active', '11/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `faq_id` int(11) NOT NULL,
  `faq_question` mediumtext NOT NULL,
  `faq_answer` mediumtext NOT NULL,
  `faq_status` varchar(50) NOT NULL DEFAULT '',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`faq_id`, `faq_question`, `faq_answer`, `faq_status`, `created_at`) VALUES
(2, 'How to write the changelog for theme updates?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'active', '2/4/2022'),
(3, 'What happens when my license expires?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'active', '2/4/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `fb_id` int(11) NOT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_email` varchar(255) DEFAULT NULL,
  `c_phone` varchar(255) DEFAULT NULL,
  `c_feedback` varchar(255) DEFAULT NULL,
  `c_message` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`fb_id`, `c_name`, `c_email`, `c_phone`, `c_feedback`, `c_message`, `created_at`) VALUES
(1, 'asa', 'aq@g.com', '221313', 'Bug Report', 'q3eqdr', '04/04/2023'),
(2, 'aq', 'aq@gmail.com', '032162156', 'Bug Report', 'asda', '04/04/2023'),
(3, 'asdfa', 'asf@g.com', '32432432', 'Feedback', 'vxvxv', '04/04/2023'),
(4, 'ali', 'ali@gmail.com', '03222222', 'Bug Report', 'testing', '11/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `item_number` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_amount` double(10,2) DEFAULT NULL,
  `inputTime` varchar(255) DEFAULT NULL,
  `inputDate` varchar(255) DEFAULT NULL,
  `inputPaymentMethod` varchar(255) DEFAULT NULL,
  `payment_attachment` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `address` tinytext DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `item_number`, `item_name`, `payment_status`, `payment_amount`, `inputTime`, `inputDate`, `inputPaymentMethod`, `payment_attachment`, `user_id`, `address`, `created_at`) VALUES
(43, 4, 'Personal chef services', 'pending', 5.36, '18:03', '2023-04-19', 'easypaisa', 'booking_c4ad15.png', 2, 'bhalwal', '11/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requests`
--

CREATE TABLE `tbl_requests` (
  `provider_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` tinytext DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`provider_id`, `user_id`, `fullname`, `email`, `phone`, `address`, `price`, `category`, `resume`, `gender`, `role`, `status`, `created_at`) VALUES
(10, 52, 'zuni', 'zuni@gmail.com', '03027816061', 'bhalwal', '20', 2, 'service-1.png', 'male', 'user', 'pending', '11/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `review_by` int(11) NOT NULL,
  `review_for_provider` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `srvs_id` int(11) NOT NULL,
  `srvc_title` mediumtext DEFAULT NULL,
  `srvc_overview` longtext DEFAULT NULL,
  `srvc_package` mediumtext DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `srvc_price` varchar(50) DEFAULT NULL,
  `srvc_photo` varchar(50) DEFAULT NULL,
  `srvc_status` varchar(50) DEFAULT NULL,
  `svrc_category` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`srvs_id`, `srvc_title`, `srvc_overview`, `srvc_package`, `user_id`, `srvc_price`, `srvc_photo`, `srvc_status`, `svrc_category`, `created_at`) VALUES
(2, 'Cleaning Services', ' Professional cleaning services include tasks such as dusting, vacuuming, mopping, and disinfecting your home.', ' Professional cleaning services include tasks such as dusting, vacuuming, mopping, and disinfecting your home.', 2, '500', 'service-2.png', 'active', 1, '11/04/2023'),
(3, 'Laundry services', 'This includes washing, drying, ironing, folding and arranging your clothes.', 'This includes washing, drying, ironing, folding and arranging your clothes.', 2, '1000', 'service-3.png', 'active', 2, '11/04/2023'),
(4, 'Personal chef services', 'A personal chef will cook healthy meals for you in your own kitchen.', 'A personal chef will cook healthy meals for you in your own kitchen.', 1, '1500', 'service-4.png', 'active', 3, '11/04/2023'),
(5, 'Pet care services', ' Pet care services include pet sitting, dog walking, and feeding and cleaning up after your pets.', ' Pet care services include pet sitting, dog walking, and feeding and cleaning up after your pets.', 52, '2000', 'service-5.png', 'active', 2, '11/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(10) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_footer` varchar(255) NOT NULL,
  `web_phone` varchar(255) NOT NULL,
  `web_email` varchar(255) NOT NULL,
  `web_address_location` varchar(255) NOT NULL,
  `web_currency` varchar(10) NOT NULL,
  `dollar_exchange_rate` varchar(10) NOT NULL,
  `g_recaptcha_site_key` varchar(255) DEFAULT NULL,
  `g_recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `g_recaptcha_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `site_title`, `site_footer`, `web_phone`, `web_email`, `web_address_location`, `web_currency`, `dollar_exchange_rate`, `g_recaptcha_site_key`, `g_recaptcha_secret_key`, `g_recaptcha_status`) VALUES
(1, 'ODS', 'Copyright 2023 Online Domestic Service, All rights Reserved', '+923240027033', 'aqibansari.notes@gmail.com', 'Main Bazar Bhalwal, Pakistan', 'PKR', '280', '6LdK8b4fAAAAAKtlyIXCAm-SqlUocrMbGP91i2Nx', '6LdK8b4fAAAAABgw90XhsHyAvQjmI_mPvu4U-y_U', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp`
--

CREATE TABLE `tbl_smtp` (
  `id` int(11) NOT NULL,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_username` varchar(50) DEFAULT NULL,
  `smtp_password` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT NULL,
  `smtp_secure` varchar(10) DEFAULT NULL,
  `smtp_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_smtp`
--

INSERT INTO `tbl_smtp` (`id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_secure`, `smtp_status`) VALUES
(1, 'smtp.gmail.com', 'aqibansarireal@gmail.com', '', '465', 'ssl', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE `tbl_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subscribers`
--

INSERT INTO `tbl_subscribers` (`id`, `email`, `created_at`) VALUES
(10, 'sda@g.com', '04/04/2023'),
(11, 'sda@g.com', '04/04/2023'),
(12, 'aqib@gmail.com', '04/04/2023'),
(13, 'aqib@f.com', '04/04/2023'),
(14, 'a@g.com', '04/04/2023'),
(15, 'ali@ali.com', '04/04/2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `fullname`, `email`, `mobile_no`, `password`, `role`, `photo`, `created_at`, `gender`, `status`, `comment`) VALUES
(1, 'aqib', 'Aqib', 'admin@admin.com', '03240027033', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'admin-48.png', '09/10/2022', 'male', 'active', ''),
(2, 'user', 'aqib ansari', 'user@user.com', '03000000000', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'user-35.png', '09/10/2022', 'male', 'active', 'hahahaha'),
(52, NULL, 'zunaira', 'zuni@user.com', '03027816061', 'e10adc3949ba59abbe56e057f20f883e', 'provider', 'user-52.png', '11/04/2023', 'female', 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_number_fk` (`item_number`);

--
-- Indexes for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD PRIMARY KEY (`provider_id`) USING BTREE,
  ADD KEY `request_category_fk` (`category`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `by_user_fk` (`review_by`),
  ADD KEY `for_provider_fk` (`review_for_provider`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`srvs_id`),
  ADD KEY `service_category_fk` (`svrc_category`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp`
--
ALTER TABLE `tbl_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `srvs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_smtp`
--
ALTER TABLE `tbl_smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `item_number_fk` FOREIGN KEY (`item_number`) REFERENCES `tbl_services` (`srvs_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD CONSTRAINT `request_category_fk` FOREIGN KEY (`category`) REFERENCES `tbl_categories` (`cat_id`),
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `by_user_fk` FOREIGN KEY (`review_by`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `for_provider_fk` FOREIGN KEY (`review_for_provider`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD CONSTRAINT `service_category_fk` FOREIGN KEY (`svrc_category`) REFERENCES `tbl_categories` (`cat_id`),
  ADD CONSTRAINT `services_user_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
