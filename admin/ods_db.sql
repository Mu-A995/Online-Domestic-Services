-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ods.tbl_categories
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_icon` varchar(255) NOT NULL DEFAULT '',
  `cat_status` varchar(50) NOT NULL DEFAULT '',
  `created_at` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` (`cat_id`, `cat_name`, `cat_icon`, `cat_status`, `created_at`) VALUES
	(1, 'Cleaning', 'fa fa-user', 'active', '5/7/2022'),
	(2, 'Home Move', 'fa fa-home', 'active', '5/7/2022'),
	(3, 'Electronics', 'fa fa-user', 'active', '08/05/2022');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_customers
CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(50) NOT NULL DEFAULT '0',
  `cust_email` varchar(50) DEFAULT NULL,
  `cust_password` varchar(50) DEFAULT NULL,
  `cust_mobile` varchar(50) DEFAULT NULL,
  `cust_gender` varchar(50) DEFAULT NULL,
  `forget_token` varchar(50) DEFAULT NULL,
  `cust_status` varchar(50) DEFAULT NULL,
  `cust_role` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_customers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_customers` DISABLE KEYS */;
INSERT INTO `tbl_customers` (`cust_id`, `cust_name`, `cust_email`, `cust_password`, `cust_mobile`, `cust_gender`, `forget_token`, `cust_status`, `cust_role`, `created_at`) VALUES
	(1, 'Ayesha Sultan', 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', '03006031333', 'female', NULL, 'active', 'user', '7/6/2022');
/*!40000 ALTER TABLE `tbl_customers` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_faqs
CREATE TABLE IF NOT EXISTS `tbl_faqs` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_question` mediumtext NOT NULL,
  `faq_answer` mediumtext NOT NULL,
  `faq_status` varchar(50) NOT NULL DEFAULT '',
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_faqs: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_faqs` DISABLE KEYS */;
INSERT INTO `tbl_faqs` (`faq_id`, `faq_question`, `faq_answer`, `faq_status`, `created_at`) VALUES
	(2, 'How to write the changelog for theme updates?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'active', '2/4/2022'),
	(3, 'What happens when my license expires?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'active', '2/4/2022');
/*!40000 ALTER TABLE `tbl_faqs` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_payment
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_amount` double(10,2) DEFAULT NULL,
  `payment_currency` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `payer_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_payment: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_payment` DISABLE KEYS */;
INSERT INTO `tbl_payment` (`id`, `item_number`, `item_name`, `payment_status`, `payment_amount`, `payment_currency`, `txn_id`, `payer_id`, `user_id`, `created_at`) VALUES
	(25, '15', 'Grow your business at low cost from us', 'paid', 10.00, 'USD', '4CV02652UL245193V', 'P3WCUJ4U9MF6E', '35', '14/05/2022'),
	(26, '15', 'Grow your business at low cost from us', 'paid', 10.00, 'USD', '6A528561KG458060Y', 'P3WCUJ4U9MF6E', '35', '14/05/2022'),
	(27, '16', 'Painting & Renovation Service From Us', 'paid', 5.00, 'USD', '73476158NN9869810', 'P3WCUJ4U9MF6E', '35', '14/05/2022');
/*!40000 ALTER TABLE `tbl_payment` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_paypal_config
CREATE TABLE IF NOT EXISTS `tbl_paypal_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_email` varchar(50) DEFAULT NULL,
  `cancel_url` varchar(50) DEFAULT NULL,
  `success_url` varchar(50) DEFAULT NULL,
  `sandbox` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_paypal_config: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_paypal_config` DISABLE KEYS */;
INSERT INTO `tbl_paypal_config` (`id`, `business_email`, `cancel_url`, `success_url`, `sandbox`) VALUES
	(1, 'kvs3944-facilitator@gmail.com', 'http://ods_live.test/cancel_payment.php', 'http://ods_live.test/success_payment.php', 'sandbox');
/*!40000 ALTER TABLE `tbl_paypal_config` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_services
CREATE TABLE IF NOT EXISTS `tbl_services` (
  `srvs_id` int(11) NOT NULL AUTO_INCREMENT,
  `srvc_title` mediumtext,
  `srvc_overview` longtext,
  `srvc_package` mediumtext,
  `srvc_price` varchar(50) DEFAULT NULL,
  `srvc_photo` varchar(50) DEFAULT NULL,
  `srvc_status` varchar(50) DEFAULT NULL,
  `svrc_category` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`srvs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_services: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_services` DISABLE KEYS */;
INSERT INTO `tbl_services` (`srvs_id`, `srvc_title`, `srvc_overview`, `srvc_package`, `srvc_price`, `srvc_photo`, `srvc_status`, `svrc_category`, `created_at`) VALUES
	(15, 'Grow your business at low cost from us', 'Grow your business at low cost from us.', 'Grow your business at low cost from us.', '2000', 'services-15.jpg', 'active', '2', '08/05/2022'),
	(16, 'Painting & Renovation Service From Us', 'Painting & Renovation Service From Us At Affordable Price', 'Painting & Renovation Service From Us At Affordable Price', '1000', 'services-16.jpg', 'active', '3', '08/05/2022');
/*!40000 ALTER TABLE `tbl_services` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_settings
CREATE TABLE IF NOT EXISTS `tbl_settings` (
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
  `g_recaptcha_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ods.tbl_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_settings` DISABLE KEYS */;
INSERT INTO `tbl_settings` (`id`, `site_title`, `site_footer`, `web_phone`, `web_email`, `web_address_location`, `web_currency`, `dollar_exchange_rate`, `g_recaptcha_site_key`, `g_recaptcha_secret_key`, `g_recaptcha_status`) VALUES
	(1, 'ODH', 'Copyright 2022 Online Domestic Service, All rights Reserved', '+923000000000', 'simhackerz12@gmail.com', 'Main Bazar Bhalwal, Pakistan', 'PKR', '200', '6LdK8b4fAAAAAKtlyIXCAm-SqlUocrMbGP91i2Nx', '6LdK8b4fAAAAABgw90XhsHyAvQjmI_mPvu4U-y_U', 'inactive');
/*!40000 ALTER TABLE `tbl_settings` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_smtp
CREATE TABLE IF NOT EXISTS `tbl_smtp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_username` varchar(50) DEFAULT NULL,
  `smtp_password` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT NULL,
  `smtp_secure` varchar(10) DEFAULT NULL,
  `smtp_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_smtp: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_smtp` DISABLE KEYS */;
INSERT INTO `tbl_smtp` (`id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_secure`, `smtp_status`) VALUES
	(1, 'smtp.gmail.com', 'licenseguardnoreply@gmail.com', '', '465', 'ssl', 'inactive');
/*!40000 ALTER TABLE `tbl_smtp` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_subscribers
CREATE TABLE IF NOT EXISTS `tbl_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ods.tbl_subscribers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_subscribers` ENABLE KEYS */;

-- Dumping structure for table ods.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `forget_token` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_login_timestamp` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ods.tbl_users: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `username`, `fullname`, `email`, `mobile_no`, `password`, `forget_token`, `role`, `photo`, `created_at`, `gender`, `last_login_ip`, `last_login_timestamp`, `status`, `comment`) VALUES
	(35, 'airamtut', 'airam tutorial', 'user@user.com', '03000000000', 'e10adc3949ba59abbe56e057f20f883e', '', 'user', 'user-35.jpg', '1619669322', 'male', '::1', '1619774879', 'active', 'hahahaha'),
	(48, 'ewfwe', 'Aqib', 'admin@admin.com', '123', 'e10adc3949ba59abbe56e057f20f883e', '', 'admin', 'admin-48.jpg', '1619700574', 'female', '::1', '1619700589', 'active', '');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
