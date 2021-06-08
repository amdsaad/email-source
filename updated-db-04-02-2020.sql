-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2020 at 12:58 PM
-- Server version: 5.7.25-28-log
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtxs35vraufxr`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_tokens`
--

CREATE TABLE `api_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transient` tinyint(4) NOT NULL DEFAULT '0',
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companyinfodata`
--

CREATE TABLE `companyinfodata` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toll_free_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_info` text COLLATE utf8mb4_unicode_ci,
  `email_template_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companyinfodata`
--

INSERT INTO `companyinfodata` (`id`, `user_id`, `logo`, `name`, `email`, `mobile`, `address`, `toll_free_no`, `website`, `company_info`, `email_template_token`, `created_at`, `updated_at`) VALUES
(2, 6, '1577746053.png', 'Steven', 'info@westcoastmovers.ca', '778 736 0425', 'Relocation Consultant', '778 736 0425', 'https://westcoastmovers.ca/', '<p>Relocation Consultant</p>', NULL, '2019-12-30 22:47:33', '2019-12-30 22:47:33'),
(3, NULL, '1576498283.png', 'BIGREWA', 'info@bigrewa.com', '8596385296', 'Relocation Consultant', '1-855-235-8298', 'https://bigrewa.com', '<p>We at WestCoast Movers help you move your home/offices from one place to the other. We are best Vancouver movers as we take complete responsibility of your belongings, from packing the goods to delivering the goods, and our prices are best when compared to services included.</p>\r\n\r\n<p>The purpose of hiring a moving and packing company for shifting is to you can sit back and relax, as we take care of all your worries. You just need to explain about everything to the hired people. This also eases up your stress of shifting from one place to another.</p>\r\n\r\n<p>&nbsp;</p>', NULL, '2019-12-16 14:00:58', '2019-12-16 14:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `customdata`
--

CREATE TABLE `customdata` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `emailtemplate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `fromname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `background_color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template_token` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `user_id`, `title`, `logo`, `description`, `background_color`, `email_template_token`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Mail Template', NULL, '<h1><span style=\"color:#e74c3c\">Dear {customerName}&nbsp;</span></h1>\r\n\r\n<p>Below are your quotation and full breakdown for your move, with an estimated weight according to your residence size.<br />\r\nQuote based on: {estimatedWeight} lbs<br />\r\n&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\" style=\"background-color:#e74c3c; border-color:#e74c3c\"><span style=\"color:#ffffff\">Charges Break Down</span></th>\r\n			<th scope=\"col\" style=\"background-color:#e74c3c; border-color:#e74c3c\"><span style=\"color:#ffffff\">Details</span></th>\r\n			<th scope=\"col\" style=\"background-color:#e74c3c; border-color:#e74c3c\"><span style=\"color:#ffffff\">Cost Amount</span></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>First 500 lbs. (if less than 2000 lbs.)</td>\r\n			<td>$800.00</td>\r\n			<td>${first500}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Estimated Weight Charges -497 lbs</td>\r\n			<td>${estimatedWeight}/ Pound</td>\r\n			<td>${estimatedWeightCharges}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Origin Surcharge</td>\r\n			<td>{originSurcharge}</td>\r\n			<td>${originSurchargeCost}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Destination Surcharge</td>\r\n			<td>{destinationSurcharge}</td>\r\n			<td>${destinationSurchargeCost}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Scale Fee</td>\r\n			<td>{origin}</td>\r\n			<td>${scaleFee}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Fuel Charge</td>\r\n			<td>N.A</td>\r\n			<td>${fuelCharge}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Custom Fee</td>\r\n			<td>N.A</td>\r\n			<td>${customFee}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Storage</td>\r\n			<td>{storageDuratoin}</td>\r\n			<td>{storageIncluded}</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>Total</td>\r\n			<td>${total}</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>*The quote above is an estimate and does not reflect the final invoice.<br />\r\n*The final invoice will be based on the government certified scales which will have the accurate weight of your shipment.<br />\r\n*Other factors impacting the cost of your move may include minimum weights &amp; professional packing or relocating these items:<br />\r\nappliances, pianos, motorcycles, motor vehicles, overweight items etc.<br />\r\n&nbsp;</p>\r\n\r\n<h2>The services that are included with your relocation are as follows:</h2>\r\n\r\n<ul>\r\n	<li>Complete door to door &amp; room to room service</li>\r\n	<li>Loading, transportation &amp; offloading of belongings</li>\r\n	<li>Dissemble of basic furniture</li>\r\n	<li>Coded tags for each item &amp; inventory list</li>\r\n	<li>{storageDuratoin} of Storage</li>\r\n	<li>Standard insurance for goods in transit</li>\r\n	<li>Floor protection (runners)</li>\r\n	<li>Cargo insurance coverage up to $250,000.00</li>\r\n	<li>Insured movers up to $2 million</li>\r\n</ul>\r\n\r\n<p>Talk to our Relocation Consultant for your discount ( Early Reservations, Seniors, Veteran, Students)</p>\r\n\r\n<p><span style=\"color:#cc0000\">Must-Have Valid Proof</span></p>', 'blue', NULL, 'Active', '2019-12-15 09:27:23', '2020-01-14 09:33:43'),
(2, 1, 'new template', NULL, '<p>new template</p>', NULL, NULL, 'Inactive', '2019-12-21 20:23:45', '2019-12-21 20:27:34'),
(3, 7, 'new templat', NULL, '<p>heloo workjkaljsfl;kaasdf&nbsp;</p>', NULL, NULL, 'Inactive', '2020-01-12 00:21:22', '2020-01-14 05:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `extra_field`
--

CREATE TABLE `extra_field` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_type` varchar(255) DEFAULT NULL,
  `sorted` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_field`
--

INSERT INTO `extra_field` (`id`, `user_id`, `field_name`, `field_type`, `sorted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Field One', 'text', 0, '2020-02-01 16:43:19', '2020-02-01 16:43:19'),
(2, 8, 'test', 'number', 0, '2020-02-02 05:35:36', '2020-02-02 05:35:36'),
(3, 1, 'field two', 'text', 0, '2020-02-02 05:39:07', '2020-02-02 05:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `googlesmtp`
--

CREATE TABLE `googlesmtp` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `access_token` text,
  `expires_in` int(11) DEFAULT NULL,
  `scope` text,
  `token_type` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `refresh_token` text,
  `email` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `googlesmtp`
--

INSERT INTO `googlesmtp` (`id`, `user_id`, `access_token`, `expires_in`, `scope`, `token_type`, `created`, `refresh_token`, `email`, `created_at`, `updated_at`) VALUES
(9, 1, 'ya29.ImG8B0mtcXFC5jxkgZtol4ee11F_8k3e5_43DmFSJrEglfYqApV-ON4StfwoSF4wZbIv8_0l8mGS5Fzj97ZBpJfbzNwbVrKYBUHUJASx6ObT1WqB7v3hzc1-s4HrOT4j-Cp2', 1580759615, 'https://www.googleapis.com/auth/gmail.modify https://www.googleapis.com/auth/gmail.readonly', 'Bearer', 1577425184, '1//04SeeCRv-NwQQCgYIARAAGAQSNwF-L9Ir5vTXG7aDElcL7gHYWb1eQkv4aTs6ApGXUbbC4Y43pCmU66aDaY1zWBNOFafpL7J9AA4', 'info@cargomoverscanada.com', '2019-12-27 05:39:44', '2020-02-03 18:53:36'),
(10, 3, 'ya29.Il-3BwzGnnPkSJYUd_v54ny8dHHvwe4aFtLeg756rAhEVVwSCESGOWD28ISk6A9oHhVaabx9FF9St3pSv5KLcsM6IxexUV_t3o3esozAmba49LaAR0G6TsTMaSXFLOMa2Q', 1577552807, 'https://www.googleapis.com/auth/gmail.readonly https://www.googleapis.com/auth/gmail.modify', 'Bearer', 1577544214, '1//04ngGklnom0LsCgYIARAAGAQSNwF-L9IrdHNXYPI-ZJ2etGev9QQT3BLe9NIdoB7TOSyC9xBOHMDXlx6S4sw9MFSFYwEy0uqXwS0', 'rahulnagar8772@gmail.com', '2019-12-28 14:43:34', '2019-12-28 16:06:47'),
(11, 6, 'ya29.Il-3B3v4l24c4ywZhsk5cPv9G0uxYBvRw4JdcRjVEZyCJEu_GZPPTTpuRl4cEiAQ_sVmuu-YyMxY2qq7JVPuer05r2pdNR8NbX1pO4klsWiFjaohrakLxm0cfmydJSBW1g', 1577749694, 'https://www.googleapis.com/auth/gmail.modify https://www.googleapis.com/auth/gmail.readonly', 'Bearer', 1577746094, '1//04yDXmHoVAilbCgYIARAAGAQSNwF-L9IrlxjsWnkExS_agg7KiZTtyhl9qDPVNd6Ngi3-W2ym0IzZlW2F9_wINizYj3WtOKdtZwE', 'info@westcoastmovers.ca', '2019-12-30 22:48:14', '2019-12-30 22:48:14'),
(12, 7, 'ya29.ImC5ByJKVV1DvVoS-oyTPTuBB3YbjTwXJQ6nOQ2jWxhz1Qc6XGb0cOMvNxriQ5opEK0_IhhoNl1wKzNGNwQd4P8TvbKFRAlrpsbv95E9xpxZ_RTc6L75evxN0_ID1KLvXmo', 1578984268, 'https://www.googleapis.com/auth/gmail.readonly https://www.googleapis.com/auth/gmail.modify', 'Bearer', 1578788272, '1//04CjSbUzM4m3DCgYIARAAGAQSNwF-L9IrfwPm8rHsDikAQRwXVAcjBThNotmDQ-ZLGN1RTwxI5oLWgcFK2tXrF9cArOW4ctFrjyU', 'info@cargomoverscanada.com', '2020-01-12 00:17:52', '2020-01-14 05:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `team_id` int(10) UNSIGNED DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailservicedata`
--

CREATE TABLE `mailservicedata` (
  `id` bigint(20) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeeName` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerEmail` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimatedWeight` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costPerPound` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `originSurcharge` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destinationSurcharge` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selectStorageDuration` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optradio` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mailservicedata`
--

INSERT INTO `mailservicedata` (`id`, `user_id`, `subject`, `employeeName`, `customerName`, `customerEmail`, `estimatedWeight`, `costPerPound`, `origin`, `originSurcharge`, `destination`, `destinationSurcharge`, `selectStorageDuration`, `optradio`, `created_at`, `updated_at`) VALUES
(2, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '4', '4', '4', '4', '4', '4', '4', 'yes', '2019-12-21 20:25:20', '2019-12-21 20:25:20'),
(3, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '4', '4', '4', '4', '4', '4', '4', 'yes', '2019-12-21 20:26:00', '2019-12-21 20:26:00'),
(4, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '4', '4', '4', '4', '4', '4', '4', 'yes', '2019-12-21 20:26:39', '2019-12-21 20:26:39'),
(5, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-21 20:27:52', '2019-12-21 20:27:52'),
(6, 1, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '4', '4', '4', '4', '4', '4', '4', 'yes', '2019-12-21 20:28:47', '2019-12-21 20:28:47'),
(7, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '303', '3', '3', 'yes', '2019-12-23 20:14:52', '2019-12-23 20:14:52'),
(9, 1, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-26 15:29:37', '2019-12-26 15:29:37'),
(12, 1, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '3', '3', '3', '3', '3', '3', 'yes', '2019-12-26 15:38:23', '2019-12-26 15:38:23'),
(14, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:12:27', '2019-12-26 18:12:27'),
(15, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:14:10', '2019-12-26 18:14:10'),
(16, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:16:35', '2019-12-26 18:16:35'),
(17, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:18:31', '2019-12-26 18:18:31'),
(18, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:39:51', '2019-12-26 18:39:51'),
(19, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:42:04', '2019-12-26 18:42:04'),
(20, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:42:18', '2019-12-26 18:42:18'),
(21, 1, 'Quote For Your Upcoming Move', 'Rahul Dhakad', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '34', '34', '34', '34', '34', '34', '34', 'yes', '2019-12-26 18:54:18', '2019-12-26 18:54:18'),
(22, 1, 'Quote For Your Upcoming Move', 'Tenzin Rawang', 'Tenzin Rawang', 'yhicknyan97@gmail.com', '1', '1', '1', '1', '1', '1', '1', 'yes', '2019-12-27 05:36:31', '2019-12-27 05:36:31'),
(23, 1, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '34', '3', '30', '3', '3', 'yes', '2019-12-27 12:20:50', '2019-12-27 12:20:50'),
(24, 1, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 12:22:29', '2019-12-27 12:22:29'),
(25, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Dhakad', 'rahulnagar8772@gmail.com', '3', '3', '3', '3', '3', '3', '3', 'yes', '2019-12-27 12:50:49', '2019-12-27 12:50:49'),
(26, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 12:55:33', '2019-12-27 12:55:33'),
(27, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 12:57:55', '2019-12-27 12:57:55'),
(28, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 12:59:55', '2019-12-27 12:59:55'),
(29, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 13:18:17', '2019-12-27 13:18:17'),
(30, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 13:18:49', '2019-12-27 13:18:49'),
(31, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 13:36:29', '2019-12-27 13:36:29'),
(32, 3, 'Quote For Your Upcoming Move', 'Rahul Nagar', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '3', '32', '3', '3', '3', '3', '3', 'yes', '2019-12-27 15:24:37', '2019-12-27 15:24:37'),
(33, 7, 'Quote For Your Upcoming Move', 'Tenzin Yhicknyan Rawang', 'Tenzin Yhicknyan Rawang', 'rahulnagar8772@gmail.com', '2000', '0.5', '1', '1', '1', '1', '1', 'yes', '2020-01-14 05:44:29', '2020-01-14 05:44:29'),
(34, 7, 'Quote For Your Upcoming Move', 'Steven', 'Rahul Nagar', 'rahulnagar8772@gmail.com', '2000', '0.5', 'Calgary', '100', 'Edmonton', '100', '0', 'no', '2020-01-14 05:45:34', '2020-01-14 05:45:34'),
(35, 7, 'Moving', 'Steven', 'Rahul Nagar2', 'rahulnagar8772@gmail.com', '2000', '0.5', 'yyc', '1', '1', '1', '1', 'yes', '2020-01-14 05:46:27', '2020-01-14 05:46:27'),
(36, 7, 'Quote For Your Upcoming Move', 'Steven', 'Nagar Rahul', 'rahulnagar8772@gmail.com', '2000', '0.5', 'yyc', '1', 'Edmonton', '1', '0', 'no', '2020-01-14 05:48:11', '2020-01-14 05:48:11'),
(37, 7, 'Moving', 'steven', 'Nagar Rahul', 'leads@leadspro.net', '2000', '0.5', 'yyc', '1', 'Edmonton', '1', '0', 'no', '2020-01-14 05:50:29', '2020-01-14 05:50:29'),
(38, 1, 'just testingQuote For Your Upcoming Move', 'rahul nagar123', 'rahul nagar123', 'rahul98765@gmail.com', '0', '14', 'indore', '0', 'indore', '0', '0', 'yes', '2020-01-14 07:45:50', '2020-01-14 07:45:50'),
(39, 1, 'Quote For Your Upcoming Move', 'Employee Name', 'Customer Name', 'rahulnagar8772@gmail.com', '2', '2', '2', '2', '2', '2', '2', 'yes', '2020-01-14 15:53:26', '2020-01-14 15:53:26'),
(40, 1, 'Quote For Your Upcoming Move', 'Employee Name', 'Customer Name', 'rahulnagar8772@gmail.com', '34', '4', '4', '4', '4', '4', '4', 'yes', '2020-01-14 15:58:02', '2020-01-14 15:58:02'),
(41, 1, 'Quote For Your Upcoming Move', 'Employee Name', 'Customer Name', 'rahulnagar8772@gmail.com', '443', '4', '4', '4', '4', '4', '4', 'yes', '2020-01-14 15:59:51', '2020-01-14 15:59:51'),
(42, 1, 'Quote For Your Upcoming Move', 'Employee Name', 'Customer Name', 'rahulnagar8772@gmail.com', '8000', '98', '3', '3', '3', '3', '3', 'yes', '2020-02-03 18:53:36', '2020-02-03 18:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `mailservice_extrafield`
--

CREATE TABLE `mailservice_extrafield` (
  `id` int(11) NOT NULL,
  `mailservice_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_value` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailservice_extrafield`
--

INSERT INTO `mailservice_extrafield` (`id`, `mailservice_id`, `field_name`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 42, 'Field One', '3', '2020-02-03 18:53:36', '2020-02-03 18:53:36'),
(2, 42, 'field two', '3', '2020-02-03 18:53:36', '2020-02-03 18:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_09_194047_create_performance_indicators_table', 1),
(2, '2019_12_09_194048_create_announcements_table', 1),
(3, '2019_12_09_194050_create_users_table', 1),
(4, '2019_12_09_194053_create_password_resets_table', 1),
(5, '2019_12_09_194057_create_api_tokens_table', 1),
(6, '2019_12_09_194102_create_subscriptions_table', 1),
(7, '2019_12_09_194108_create_invoices_table', 1),
(8, '2019_12_09_194115_create_notifications_table', 1),
(9, '2019_12_09_194123_create_teams_table', 1),
(10, '2019_12_09_194132_create_team_users_table', 1),
(11, '2019_12_09_194142_create_invitations_table', 1),
(12, '2019_12_13_155257_create_companyinfodata_table', 1),
(13, '2019_12_13_155306_create_customdata_table', 1),
(14, '2019_12_13_155316_create_email_template_table', 1),
(15, '2019_12_13_155326_create_mailservicedata_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rahulnagar8772@gmail.com', '$2y$10$F2XBPHSPZ1pnJ.l1gmelYOSA3yBw0ZMKoHWPz78blhrdSEQcabwUq', '2019-12-14 13:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicators`
--

CREATE TABLE `performance_indicators` (
  `id` int(10) NOT NULL,
  `monthly_recurring_revenue` decimal(8,2) NOT NULL,
  `yearly_recurring_revenue` decimal(8,2) NOT NULL,
  `daily_volume` decimal(8,2) NOT NULL,
  `new_users` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `name`, `stripe_id`, `stripe_plan`, `quantity`, `trial_ends_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'default', 'sub_GQplhmxJEiXVVd', 'yearly-pro', 1, NULL, '2021-02-03 06:58:17', '2019-12-26 15:18:03', '2020-02-03 06:58:24'),
(2, 8, 'default', 'sub_GfJtgcQYDkEgpj', 'monthly-pro', 1, NULL, NULL, '2020-02-03 07:22:21', '2020-02-03 07:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_subscriptions`
--

CREATE TABLE `team_subscriptions` (
  `id` int(10) NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_users`
--

CREATE TABLE `team_users` (
  `team_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `uses_two_factor_auth` tinyint(4) NOT NULL DEFAULT '0',
  `authy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_reset_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` int(11) DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `last_read_announcements_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `photo_url`, `uses_two_factor_auth`, `authy_id`, `country_code`, `phone`, `two_factor_reset_code`, `current_team_id`, `stripe_id`, `current_billing_plan`, `card_brand`, `card_last_four`, `card_country`, `billing_address`, `billing_address_line_2`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `vat_id`, `extra_billing_information`, `trial_ends_at`, `last_read_announcements_at`, `created_at`, `updated_at`) VALUES
(1, 'Rahul Nagar', 'rahulnagar8772@gmail.com', '2019-12-21 20:18:58', '$2y$10$WbcVlywOt5HpTzjocu6dIeZp6jlrOv0c3BrYn1qZJ8rHGyBG.7yrG', '0yN0u1phlf5hlxC9aqN8hkpvkQOH39zWgRYpzP4qDYnqbBikFkhKIe4HAmhT', 'https://bigrewa.com/storage/profiles/7yZWD72pWkrWz9CWfOWkwbiAW6JgXjCGvcdqvJPA.jpeg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-29 16:13:43', '2019-12-21 20:17:29', '2020-02-03 06:58:24'),
(2, 'Tenzin Yhicknyan Rawang', 'javatutor59@gmail.com', '2019-12-24 22:53:46', '$2y$10$g8TqYZzOmv0Diug3Jj0SxeDjh0E/J13qE3TKhPn6zFmGxsvJs.Bme', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-31 22:52:01', '2019-12-24 22:52:01', '2019-12-24 22:52:01', '2019-12-24 22:53:46'),
(3, 'Rahul Nagar', 'nagarrahul370@gmail.com', '2019-12-27 12:36:00', '$2y$10$H0Rgvm7u43DC6cokBJSwdOTgokqGEUANZ5zhHQJa5e33jEPnQ.RV2', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-03 12:23:27', '2019-12-27 12:23:27', '2019-12-27 12:23:27', '2019-12-27 12:36:00'),
(4, 'Rahul Nagar', 'rahul.narmadatech@gmail.com', NULL, '$2y$10$MSiZPPolRslv6XEIMCu7UOfAS87Cl6QZBCwbVWG0OUlyGNB0U8Szi', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-03 12:26:59', '2019-12-27 12:26:59', '2019-12-27 12:26:59', '2019-12-27 12:26:59'),
(5, 'John Cena', 'm94p2c@mbox.re', '2019-12-28 20:36:56', '$2y$10$t75KDijrxeZ1PfhosVuxbORSLoGixjRH/3iAMvNA5iZTOAavHDhlO', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-04 20:36:33', '2019-12-28 20:36:33', '2019-12-28 20:36:33', '2019-12-28 20:36:56'),
(6, 'Steven', 'info@westcoastmovers.ca', '2019-12-30 22:44:20', '$2y$10$JjThm9fKDhHerdkxu.Ppw.IZKBqDb73CIGX.eVo6jizjLnR9ZSN.W', NULL, 'https://bigrewa.com/storage/profiles/m0lJs6DcTgIYWYDUGhxvAWPnsaC06jYEXgWwcSVE.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-06 22:41:08', '2019-12-30 22:41:08', '2019-12-30 22:41:08', '2019-12-30 22:54:09'),
(7, 'tenzin rawang', 'yhicknyan97@gmail.com', '2020-01-12 00:15:44', '$2y$10$k1DITazjC1OwPwjca67y/OyxGkMd1Dk0uAOJ/4stcvIbby0NKjzru', NULL, 'https://bigrewa.com/storage/profiles/8DghhgMrVanINZjKHZUceAdiLVUQca8WgCFncbYP.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-19 00:13:48', '2020-01-12 00:13:48', '2020-01-12 00:13:48', '2020-01-12 00:20:35'),
(8, 'United Movers Canada', 'info@unitedmoverscanada.com', '2020-01-31 07:15:48', '$2y$10$dFwGwELyzGvAhK/WrB.hYetnmn.WIoo1wHUx6gWw8h4GBxjdQvyXi', '7XY3twIgrUFXuGEuDQW7C8ikF6Zbis6DXHajlukQ8JCaKSvzboLYBYlMmbrm', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'cus_GfJtNNp3chAsIX', 'monthly-pro', 'Visa', '7349', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-31 07:14:34', '2020-01-31 07:14:34', '2020-02-03 07:22:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_tokens_token_unique` (`token`),
  ADD KEY `api_tokens_user_id_expires_at_index` (`user_id`,`expires_at`);

--
-- Indexes for table `companyinfodata`
--
ALTER TABLE `companyinfodata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyinfodata_user_id_index` (`user_id`);

--
-- Indexes for table `customdata`
--
ALTER TABLE `customdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customdata_user_id_index` (`user_id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_template_user_id_index` (`user_id`);

--
-- Indexes for table `extra_field`
--
ALTER TABLE `extra_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `googlesmtp`
--
ALTER TABLE `googlesmtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitations_token_unique` (`token`),
  ADD KEY `invitations_team_id_index` (`team_id`),
  ADD KEY `invitations_user_id_index` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_created_at_index` (`created_at`),
  ADD KEY `invoices_user_id_index` (`user_id`),
  ADD KEY `invoices_team_id_index` (`team_id`);

--
-- Indexes for table `mailservicedata`
--
ALTER TABLE `mailservicedata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mailservicedata_user_id_index` (`user_id`);

--
-- Indexes for table `mailservice_extrafield`
--
ALTER TABLE `mailservice_extrafield`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `performance_indicators`
--
ALTER TABLE `performance_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_indicators_created_at_index` (`created_at`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_subscriptions`
--
ALTER TABLE `team_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companyinfodata`
--
ALTER TABLE `companyinfodata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customdata`
--
ALTER TABLE `customdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extra_field`
--
ALTER TABLE `extra_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `googlesmtp`
--
ALTER TABLE `googlesmtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailservicedata`
--
ALTER TABLE `mailservicedata`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `mailservice_extrafield`
--
ALTER TABLE `mailservice_extrafield`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_indicators`
--
ALTER TABLE `performance_indicators`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_subscriptions`
--
ALTER TABLE `team_subscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
