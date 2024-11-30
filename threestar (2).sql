-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2024 at 12:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threestar`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `percentage` double NOT NULL,
  `level` int(11) NOT NULL,
  `number_of_users` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `percentage`, `level`, `number_of_users`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 7.5, 1, 3, NULL, NULL, NULL),
(2, 5, 2, 9, NULL, NULL, NULL),
(3, 4.5, 3, 27, NULL, NULL, NULL),
(4, 4, 4, 81, NULL, NULL, NULL),
(5, 3.5, 5, 243, NULL, NULL, NULL),
(6, 3, 6, 729, NULL, NULL, NULL),
(7, 2.5, 7, 2187, NULL, NULL, NULL),
(8, 2, 8, 6591, NULL, NULL, NULL),
(9, 1.5, 9, 19683, NULL, NULL, NULL),
(10, 1.25, 10, 59048, NULL, NULL, NULL),
(11, 1, 11, 177147, NULL, NULL, NULL),
(12, 0.75, 12, 531441, NULL, NULL, NULL),
(13, 0.5, 13, 1594323, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_11_15_175144_create_under_take_users_table', 2),
(7, '2024_11_30_011039_create_levels_table', 3),
(8, '2024_11_30_080859_create_wallets_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `under_take_users`
--

CREATE TABLE `under_take_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponser_id` bigint(20) UNSIGNED NOT NULL,
  `upline_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sequece_wise_user_added_record_ids` longtext DEFAULT NULL,
  `amount` bigint(20) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `under_take_users`
--

INSERT INTO `under_take_users` (`id`, `sponser_id`, `upline_id`, `user_id`, `sequece_wise_user_added_record_ids`, `amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(15, 1, 1, 19, '1', 200000, NULL, '2024-11-29 18:41:50', '2024-11-29 18:41:50'),
(16, 1, 19, 20, '1,19', 200000, NULL, '2024-11-29 18:44:12', '2024-11-29 18:44:12'),
(17, 1, 1, 21, '1', 200000, NULL, '2024-11-29 20:24:17', '2024-11-29 20:24:17'),
(18, 1, 1, 22, '1', 200000, NULL, '2024-11-29 20:24:58', '2024-11-29 20:24:58'),
(20, 1, 19, 24, '1,19', 200000, NULL, '2024-11-29 20:30:17', '2024-11-29 20:30:17'),
(21, 1, 20, 25, '1,19,20', 200000, NULL, '2024-11-29 20:32:38', '2024-11-29 20:32:38'),
(22, 1, 21, 26, '1,21', 200000, NULL, '2024-11-29 20:49:24', '2024-11-29 20:49:24'),
(23, 1, 24, 27, '1,19,24', 200000, NULL, '2024-11-29 21:46:16', '2024-11-29 21:46:16'),
(25, 1, 27, 29, '1,19,24,27', 200000, NULL, '2024-11-29 21:48:06', '2024-11-29 21:48:06'),
(26, 1, 26, 30, '1,21,26', 200000, NULL, '2024-11-29 21:49:43', '2024-11-29 21:49:43'),
(27, 1, 30, 31, '1,21,26,30', 200000, NULL, '2024-11-29 21:50:21', '2024-11-29 21:50:21'),
(28, 1, 19, 32, '1,19', 200000, NULL, '2024-11-29 22:19:07', '2024-11-29 22:19:07'),
(29, 1, 21, 33, '1,21', 200000, NULL, '2024-11-29 22:21:23', '2024-11-29 22:21:23'),
(30, 1, 21, 34, '1,21', 200000, NULL, '2024-11-29 22:21:57', '2024-11-29 22:21:57'),
(31, 1, 22, 35, '1,22', 200000, NULL, '2024-11-29 22:23:34', '2024-11-29 22:23:34'),
(32, 1, 22, 36, '1,22', 200000, NULL, '2024-11-29 22:24:02', '2024-11-29 22:24:02'),
(33, 1, 22, 37, '1,22', 200000, NULL, '2024-11-29 22:25:07', '2024-11-29 22:25:07'),
(34, 1, 20, 38, '1,19,20', 200000, NULL, '2024-11-29 22:32:11', '2024-11-29 22:32:11'),
(42, 1, 20, 46, '1,19,20', 200000, NULL, '2024-11-30 03:20:58', '2024-11-30 03:20:58'),
(43, 1, 24, 47, '1,19,24', 200000, NULL, '2024-11-30 05:28:12', '2024-11-30 05:28:12'),
(44, 1, 47, 48, '1,19,24,47', 200000, NULL, '2024-11-30 05:34:24', '2024-11-30 05:34:24'),
(45, 1, 32, 49, '1,19,32', 200000, NULL, '2024-11-30 05:41:29', '2024-11-30 05:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `s_w_d` enum('Son Off','Wife Off','Daughter Off') NOT NULL,
  `swd_name` varchar(255) DEFAULT NULL,
  `nomination_name` varchar(255) DEFAULT NULL,
  `nomination_dob` date DEFAULT NULL,
  `country_code` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adhar_number` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_ifsc_code` varchar(255) DEFAULT NULL,
  `bank_branch_name` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `device_type` enum('None','Ios','Android') DEFAULT NULL,
  `device_token` longtext DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `is_block` int(11) NOT NULL DEFAULT 0 COMMENT '0 => Not blocked, 1=> blocked',
  `remember_token` varchar(100) DEFAULT NULL,
  `is_super_admin` int(1) NOT NULL DEFAULT 0 COMMENT '1=> Super Admin, 0=> Not Super Admin',
  `user_level` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `custom_user_id`, `name`, `dob`, `s_w_d`, `swd_name`, `nomination_name`, `nomination_dob`, `country_code`, `mobile_number`, `email`, `adhar_number`, `pan_number`, `bank_account_number`, `bank_name`, `bank_ifsc_code`, `bank_branch_name`, `address`, `country`, `city`, `state`, `zip_code`, `password`, `device_type`, `device_token`, `refresh_token`, `is_block`, `remember_token`, `is_super_admin`, `user_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TS000', 'Super Admin', '1994-11-11', 'Son Off', NULL, 'SUPER ADMIN', NULL, '+91', '9876543210', 'superadmin@yopmail.com', '000000000000', '000000000', '00000000000', 'NONE', 'NONE', 'NONE', 'NONE', '', NULL, NULL, NULL, '$2y$12$qMgzlHJwqRpUjNzUBld//eDpCMDwfdMY4ZVzfVldq2iK5K/DulbA2', NULL, NULL, NULL, 0, 'Nhn1yVveDLE9p3Dfzux06c2bjr1V38Gm', 1, 2, '2024-11-11 21:00:12', '2024-11-30 02:15:20', NULL),
(19, 'TS001', '1B', '2012-11-11', 'Son Off', 'TEST', NULL, NULL, '+91', '6467023890', '1a@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '17762', '$2y$12$njxNXdhN7F/wDVnS.V5wUunK8UV1oaPpuWFz8LaiqJQp7..eUR16y', NULL, NULL, NULL, 0, NULL, 0, 1, '2024-11-29 18:41:50', '2024-11-29 22:19:07', NULL),
(20, 'TS002', '1J', '2012-11-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023891', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$izqYFkBDGBRd5cowOwe/UOhoWoxHS7IUN9cvp7Ut7q1R1mqGrBMuG', NULL, NULL, NULL, 0, 'EeZtNg7opZ8fjWbCm5uFLIDJGWdEfoYA', 0, 1, '2024-11-29 18:44:12', '2024-11-30 04:54:14', NULL),
(21, 'TS003', '1F', '2012-11-14', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023892', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$mfCtDpa9bUJjFc4asdnRG.R4PB2b7QWx1GalQUMuISQ4w9f5X2p4i', NULL, NULL, NULL, 0, NULL, 0, 1, '2024-11-29 20:24:17', '2024-11-29 22:21:57', NULL),
(22, 'TS004', '1L', '2012-11-14', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023893', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$gnyOOrhzMOGldO1b2BiJs.LfnhWkXY.p8pJ5PPi7di60COB.NbNLy', NULL, NULL, NULL, 0, NULL, 0, 1, '2024-11-29 20:24:58', '2024-11-29 22:25:07', NULL),
(24, 'TS005', '1C', '2012-11-06', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023894', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$qo0aoqepmNclIISxTR6rIeie6pz8ffz1OFfGd9fo8lKxYRo4PDBRm', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 20:30:17', '2024-11-29 20:30:17', NULL),
(25, 'TS006', '1M', '2012-11-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023895', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$stbUuX9auH4wf3N8VvPpr.tW38MYTuf8SngsxNZd3vHHiccnFRT8G', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 20:32:38', '2024-11-29 20:32:38', NULL),
(26, 'TS007', '1G', '2012-11-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023896', 'hosttesting@yopmail.com', '435345', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$CcKn2oZd8HwSLVftca1OpOI/IfuuRvIkZOLG.wj/T50bNDG3W7u62', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 20:49:24', '2024-11-29 20:49:24', NULL),
(27, 'TS008', '1D', '2012-11-08', 'Son Off', 'sgsd', NULL, NULL, '+91', '6467023897', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$alvfQ.SzkebaDn1ZqKoyReoWH4VQzpeqGylYJ/Sr7p2ztA6k8ole2', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 21:46:16', '2024-11-29 21:46:16', NULL),
(29, 'TS009', '1E', '2012-11-28', 'Son Off', 'ABC', 'sdfsdf', NULL, '+91', '6467023899', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$UNzwrCTQj5vSdsC2FVsblu88/JHHzB4djhsM6alRiSctpksPkgB.C', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 21:48:06', '2024-11-29 21:48:06', NULL),
(30, 'TS0010', '1H', '2012-11-14', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023812', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$7Z4gRx8nYgGcihBA.GyzuehZF5P47.QNV/pR90V/19FetnQEjByB6', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 21:49:43', '2024-11-29 21:49:43', NULL),
(31, 'TS0011', '1I', '2012-11-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023813', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$0ozQ2ieSQslRFde0T/tloOXyMGt2nnjeaR8MiArRXkS1EqvFmLZUK', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 21:50:21', '2024-11-29 21:50:21', NULL),
(32, 'TS0012', '1K', '2012-11-08', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023814', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$Tpxdv90L030v1oI8eJk3TO1B3CYR7U0nj1Ch70u87QImEwi9/fxYG', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:19:07', '2024-11-29 22:19:07', NULL),
(33, 'TS0013', '1U', '2012-11-15', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023815', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$WKoyeXgjRIor9lhakO0df.XHd/VvpgBjKtn79tmL88QKPVsMxn252', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:21:23', '2024-11-29 22:21:23', NULL),
(34, 'TS0014', '1V', '2012-11-14', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023816', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$gWm1Z.9JKRAM2M9TbinlouUQszqxmyc8qFZMuaapSIUeELR0ShxFW', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:21:57', '2024-11-29 22:21:57', NULL),
(35, 'TS0015', '1X', '2012-11-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023818', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$G73pEh5Gc2BHVhMR6anGu.aC1eIm9Nl1xP6tTZ5cwHoTVW1pIboJ6', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:23:34', '2024-11-29 22:23:34', NULL),
(36, 'TS0016', '1Z', '2012-11-22', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023811', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$oqhMfQnOec7gZxTChdt8V.CqzySSG4ogm4OjgVib1LVhjQm2tgf3e', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:24:02', '2024-11-29 22:24:02', NULL),
(37, 'TS0017', '1S', '2012-11-14', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023833', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$qyhXzvJpW.pHnu4VKHGQXO8dTkvY5kE6XgnRz8Vdm0iXfuDDe1jeK', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:25:07', '2024-11-29 22:25:07', NULL),
(38, 'TS0018', '1N', '2012-11-08', 'Son Off', 'ABC', NULL, NULL, '+91', '0646702312', 'aman@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'India', 'Kotda', 'Gujarat', 'ts000', '$2y$12$5A/rPNp9qS1hhL1mBs/dR.5B/eZGC2y8DXZaQE.BppIhDozDd2WVK', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-29 22:32:11', '2024-11-29 22:32:11', NULL),
(46, 'TS0019', 'SW', '2012-11-13', 'Son Off', 'sgsd', 'ABC', '2012-11-07', '+91', '6467023123', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$hFRhwpfrxYCrHRqKrgJI0O.owZp4Oeb1d9uqeqY2v/TS8YMVmlFla', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-30 03:20:58', '2024-11-30 03:20:58', NULL),
(47, 'TS0020', 'RRE', '2012-11-13', 'Son Off', 'sgsd', NULL, NULL, '+91', '6467023321', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$3y62YwCV4ALVyborCn.jG.eoH2kIt0/iV16tqhwkAZCREabyLC1hW', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-30 05:28:12', '2024-11-30 05:28:12', NULL),
(48, 'TS0021', 'TTS', '2012-11-13', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023544', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$1hRC045dTH/XJaT7xIv8HO.9X9JP0Y7eDAWPelNqWQoYhvyq7z4GS', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-30 05:34:24', '2024-11-30 05:34:24', NULL),
(49, 'TS0022', 'FRD', '2012-11-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023222', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$ZkE1fxAqFGb01W1kCW6QaOnmQT6Z/2oILMxamWK2Ud/0mYNQhUNAq', NULL, NULL, NULL, 0, NULL, 0, 0, '2024-11-30 05:41:29', '2024-11-30 05:41:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_user_id` bigint(20) UNSIGNED NOT NULL,
  `upline_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `percentage` double NOT NULL DEFAULT 0,
  `total_amount` bigint(20) NOT NULL,
  `credit_user_amount` bigint(20) NOT NULL,
  `type_of_credit` enum('By Tree','By Sponser') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `credit_user_id`, `upline_id`, `user_id`, `percentage`, `total_amount`, `credit_user_amount`, `type_of_credit`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 20, 46, 4.5, 200000, 9000, 'By Tree', NULL, '2024-11-30 03:20:58', '2024-11-30 03:20:58'),
(4, 19, 20, 46, 5, 200000, 10000, 'By Tree', NULL, '2024-11-30 03:20:58', '2024-11-30 03:20:58'),
(6, 20, 20, 46, 7.5, 200000, 15000, 'By Tree', NULL, '2024-11-30 03:20:58', '2024-11-30 03:20:58'),
(7, 1, 20, 46, 0, 200000, 200, 'By Sponser', NULL, '2024-11-30 03:20:58', '2024-11-30 03:20:58'),
(8, 1, 24, 47, 4.5, 200000, 9000, 'By Tree', NULL, '2024-11-30 05:28:12', '2024-11-30 05:28:12'),
(9, 19, 24, 47, 5, 200000, 10000, 'By Tree', NULL, '2024-11-30 05:28:12', '2024-11-30 05:28:12'),
(10, 24, 24, 47, 7.5, 200000, 15000, 'By Tree', NULL, '2024-11-30 05:28:13', '2024-11-30 05:28:13'),
(11, 1, 24, 47, 0, 200000, 200, 'By Sponser', NULL, '2024-11-30 05:28:13', '2024-11-30 05:28:13'),
(12, 1, 47, 48, 4.5, 200000, 9000, 'By Tree', NULL, '2024-11-30 05:34:24', '2024-11-30 05:34:24'),
(13, 19, 47, 48, 5, 200000, 10000, 'By Tree', NULL, '2024-11-30 05:34:24', '2024-11-30 05:34:24'),
(14, 1, 47, 48, 0, 200000, 200, 'By Sponser', NULL, '2024-11-30 05:34:24', '2024-11-30 05:34:24'),
(15, 1, 32, 49, 5, 200000, 10000, 'By Tree', NULL, '2024-11-30 05:41:29', '2024-11-30 05:41:29'),
(16, 19, 32, 49, 7.5, 200000, 15000, 'By Tree', NULL, '2024-11-30 05:41:29', '2024-11-30 05:41:29'),
(17, 1, 32, 49, 0, 200000, 200, 'By Sponser', NULL, '2024-11-30 05:41:29', '2024-11-30 05:41:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `under_take_users`
--
ALTER TABLE `under_take_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `under_take_users_sponser_id_foreign` (`sponser_id`),
  ADD KEY `under_take_users_upline_id_foreign` (`upline_id`),
  ADD KEY `under_take_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_credit_user_id_foreign` (`credit_user_id`),
  ADD KEY `wallets_upline_id_foreign` (`upline_id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `under_take_users`
--
ALTER TABLE `under_take_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `under_take_users`
--
ALTER TABLE `under_take_users`
  ADD CONSTRAINT `under_take_users_sponser_id_foreign` FOREIGN KEY (`sponser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `under_take_users_upline_id_foreign` FOREIGN KEY (`upline_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `under_take_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_credit_user_id_foreign` FOREIGN KEY (`credit_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wallets_upline_id_foreign` FOREIGN KEY (`upline_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
