-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2022 at 07:49 PM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nemosofts_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_active_log`
--

CREATE TABLE `tbl_active_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'info.nemosofts@gmail.com', '1641207064_16d9f780de73a8d785d6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(10) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `color_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourite`
--

CREATE TABLE `tbl_favourite` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `notification_msg` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `notification_on` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `device_id` varchar(40) NOT NULL,
  `rate` int(11) NOT NULL,
  `message` text NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `report_msg` text NOT NULL,
  `report_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `app_terms` text NOT NULL,
  `account_delete_intruction` text NOT NULL,
  `envato_buyer_name` varchar(200) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_package_name` varchar(150) NOT NULL,
  `envato_api_key` varchar(255) NOT NULL,
  `onesignal_app_id` varchar(500) NOT NULL,
  `onesignal_rest_key` varchar(500) NOT NULL,
  `publisher_id` varchar(500) NOT NULL,
  `banner_ad` varchar(20) NOT NULL DEFAULT 'false',
  `banner_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `banner_ad_id` varchar(500) NOT NULL,
  `banner_facebook_id` text NOT NULL,
  `banner_startapp_id` text NOT NULL,
  `banner_unity_id` text NOT NULL,
  `banner_iron_id` text NOT NULL,
  `banner_size` varchar(255) NOT NULL DEFAULT 'BANNER',
  `banner_size_fb` varchar(255) NOT NULL DEFAULT 'BANNER_HEIGHT_50',
  `banner_size_iron` varchar(255) NOT NULL DEFAULT 'BANNER_HEIGHT_50',
  `interstital_ad` varchar(20) NOT NULL DEFAULT 'false',
  `interstital_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `interstital_ad_id` varchar(500) NOT NULL,
  `interstital_facebook_id` text NOT NULL,
  `interstital_startapp_id` text NOT NULL,
  `interstital_unity_id` text NOT NULL,
  `interstital_iron_id` text NOT NULL,
  `interstital_ad_click` int(10) NOT NULL DEFAULT 5,
  `native_ad` varchar(20) NOT NULL DEFAULT 'false',
  `native_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `native_ad_id` text NOT NULL,
  `native_facebook_id` text NOT NULL,
  `native_startapp_id` text NOT NULL,
  `native_unity_id` text NOT NULL,
  `native_iron_id` text NOT NULL,
  `native_position` int(10) NOT NULL DEFAULT 5,
  `ads_limits` varchar(20) NOT NULL DEFAULT 'true',
  `ads_count_click` int(10) NOT NULL DEFAULT 20,
  `custom_ads` varchar(20) NOT NULL DEFAULT 'false',
  `custom_ads_img` varchar(500) NOT NULL,
  `custom_ads_link` varchar(500) NOT NULL,
  `custom_ads_clicks` int(10) NOT NULL DEFAULT 12,
  `isRTL` varchar(255) NOT NULL DEFAULT 'false',
  `isVPN` varchar(255) NOT NULL DEFAULT 'false',
  `isAPK` varchar(255) NOT NULL DEFAULT 'false',
  `isMaintenance` varchar(255) NOT NULL DEFAULT 'false',
  `isScreenshot` varchar(255) NOT NULL DEFAULT 'true',
  `isLogin` varchar(255) NOT NULL DEFAULT 'true',
  `isGoogleLogin` varchar(255) NOT NULL DEFAULT 'true',
  `isSubscription` varchar(255) NOT NULL DEFAULT 'false',
  `app_update_status` varchar(10) NOT NULL DEFAULT 'false',
  `app_new_version` double NOT NULL DEFAULT 1,
  `app_update_desc` text NOT NULL,
  `app_redirect_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `app_email`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `app_terms`, `account_delete_intruction`, `envato_buyer_name`, `envato_purchase_code`, `envato_package_name`, `envato_api_key`, `onesignal_app_id`, `onesignal_rest_key`, `publisher_id`, `banner_ad`, `banner_ad_type`, `banner_ad_id`, `banner_facebook_id`, `banner_startapp_id`, `banner_unity_id`, `banner_iron_id`, `banner_size`, `banner_size_fb`, `banner_size_iron`, `interstital_ad`, `interstital_ad_type`, `interstital_ad_id`, `interstital_facebook_id`, `interstital_startapp_id`, `interstital_unity_id`, `interstital_iron_id`, `interstital_ad_click`, `native_ad`, `native_ad_type`, `native_ad_id`, `native_facebook_id`, `native_startapp_id`, `native_unity_id`, `native_iron_id`, `native_position`, `ads_limits`, `ads_count_click`, `custom_ads`, `custom_ads_img`, `custom_ads_link`, `custom_ads_clicks`, `isRTL`, `isVPN`, `isAPK`, `isMaintenance`, `isScreenshot`, `isLogin`, `isGoogleLogin`, `isSubscription`, `app_update_status`, `app_new_version`, `app_update_desc`, `app_redirect_url`) VALUES
(1, 'HD Wallpaper', '69319_logo.jpg', 'info.nemosofts@gmail.com', 'nemosofts', '+4524410510', 'nemosofts.com', 'Love this app? Let us Know in the Google Play Store how we can make it even better', 'nemosofts', '', '', '', '', '', '', '', '', '', '', 'true', 'admob', 'ca-app-pub-3940256099942544/6300978111', '3940256099942544', '99942544', '1033173712', '3940256', 'BANNER', 'BANNER_HEIGHT_50', 'BANNER_HEIGHT_50', 'true', 'admob', 'ca-app-pub-3940256099942544/1033173712', '3940256099942544', '99942544', '1033173712', '3940256', 5, 'true', 'admob', 'ca-app-pub-3940256099942544/2247696110', '3940256099942544', '99942544', '1033173712', '3940256', 6, 'true', 20, 'true', 'https://camo.envatousercontent.com/3d8dd23e375b2adec0a72a4a0a6bd12b80f6f474/68747470733a2f2f646f776e6c6f61642e746869766170726f2e636f6d2f696d6173652f465245452e6a7067', 'https://codecanyon.net/user/nemosofts', 12, 'false', 'true', 'true', 'false', 'false', 'true', 'true', 'true', 'true', 1, 'Its time to Upgrade to the latest version of our application to get the best experience.', 'https://play.google.com/store/apps/details?id=com.online.live.tv.new');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_type` varchar(20) NOT NULL DEFAULT 'server',
  `smtp_host` varchar(150) NOT NULL,
  `smtp_email` varchar(150) NOT NULL,
  `smtp_password` text NOT NULL,
  `smtp_secure` varchar(20) NOT NULL,
  `port_no` varchar(10) NOT NULL,
  `smtp_ghost` varchar(150) NOT NULL,
  `smtp_gemail` varchar(150) NOT NULL,
  `smtp_gpassword` text NOT NULL,
  `smtp_gsecure` varchar(20) NOT NULL,
  `gport_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_type`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`, `smtp_ghost`, `smtp_gemail`, `smtp_gpassword`, `smtp_gsecure`, `gport_no`) VALUES
(1, 'gmail', '', '', '', 'ssl', '465', 'smtp.gmail.com', '', '', 'tls', 587);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `duration` text NOT NULL,
  `price` text NOT NULL,
  `currency_code` text NOT NULL,
  `subscription_id` text NOT NULL,
  `base_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`id`, `name`, `duration`, `price`, `currency_code`, `subscription_id`, `base_key`) VALUES
(1, 'Starter', '30', '10', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe'),
(2, 'Advanced', '365', '50', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe'),
(4, 'Super Premium', '366', '99', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `end_date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'Normal',
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `user_password` text NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT '0',
  `auth_id` varchar(255) NOT NULL DEFAULT '0',
  `registered_on` varchar(200) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallpaper`
--

CREATE TABLE `tbl_wallpaper` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `wall_colors` text NOT NULL,
  `pay` varchar(255) NOT NULL DEFAULT 'free',
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` decimal(11,0) DEFAULT 0,
  `total_set` int(11) NOT NULL DEFAULT 0,
  `total_share` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_download` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallpaper_gif`
--

CREATE TABLE `tbl_wallpaper_gif` (
  `id` int(11) NOT NULL,
  `image_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `pay` varchar(255) NOT NULL DEFAULT 'free',
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` decimal(11,0) DEFAULT 0,
  `total_set` int(11) NOT NULL DEFAULT 0,
  `total_share` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_download` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallpaper_gif`
--
ALTER TABLE `tbl_wallpaper_gif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wallpaper_gif`
--
ALTER TABLE `tbl_wallpaper_gif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
