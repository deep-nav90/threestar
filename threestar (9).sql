-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2024 at 07:27 AM
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
-- Table structure for table `claim_rewards`
--

CREATE TABLE `claim_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reward_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claim_rewards`
--

INSERT INTO `claim_rewards` (`id`, `reward_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 7, 1, NULL, '2024-12-20 22:44:41', '2024-12-20 22:44:41'),
(2, 7, 1, NULL, '2024-12-20 23:06:00', '2024-12-20 23:06:00');

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
(8, '2024_11_30_080859_create_wallets_table', 4),
(9, '2024_12_19_161613_create_rewards_table', 5),
(10, '2024_12_21_005511_create_reward_images_table', 6),
(11, '2024_12_21_040503_create_claim_rewards_table', 7);

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
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reward_level` bigint(20) NOT NULL DEFAULT 0,
  `reward_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `reward_level`, `reward_name`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'TABLE TENNIS', NULL, NULL, '2024-12-20 19:52:16', '2024-12-20 19:52:16'),
(2, 6, 'TABLE TENNIS', NULL, NULL, '2024-12-20 19:53:53', '2024-12-20 19:53:53'),
(3, 6, 'TABLE TENNIS', NULL, NULL, '2024-12-20 19:54:09', '2024-12-20 19:54:09'),
(4, 6, 'TABLE TENNIS', NULL, NULL, '2024-12-20 19:54:22', '2024-12-20 19:54:22'),
(5, 4, 'TABLE TENNIS', NULL, NULL, '2024-12-20 19:55:36', '2024-12-20 20:56:47'),
(6, 2, 'TTFD', NULL, NULL, '2024-12-20 21:05:59', '2024-12-20 21:05:59'),
(7, 3, 'L3 FF', NULL, '2024-12-20 23:22:04', '2024-12-20 21:32:11', '2024-12-20 23:22:04'),
(8, 3, 'L3', NULL, '2024-12-20 23:19:35', '2024-12-20 21:33:25', '2024-12-20 23:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `reward_images`
--

CREATE TABLE `reward_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reward_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reward_images`
--

INSERT INTO `reward_images` (`id`, `reward_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, '12212024012422676618c610598.jpg', NULL, '2024-12-20 19:54:22', '2024-12-20 19:54:22'),
(2, 4, '12212024012422676618c6106d3.jpeg', NULL, '2024-12-20 19:54:22', '2024-12-20 19:54:22'),
(4, 5, '122120240125366766191060144.jpeg', NULL, '2024-12-20 19:55:36', '2024-12-20 19:55:36'),
(5, 5, '1221202402265967662773599f6.jpeg', NULL, '2024-12-20 20:56:59', '2024-12-20 20:56:59'),
(6, 6, '122120240235596766298f53598.jpg', NULL, '2024-12-20 21:05:59', '2024-12-20 21:05:59'),
(7, 7, '1221202403021167662fb3c53b6.jpg', NULL, '2024-12-20 21:32:11', '2024-12-20 21:32:11'),
(8, 7, '1221202403022967662fc5cb607.jpeg', NULL, '2024-12-20 21:32:29', '2024-12-20 21:32:29'),
(9, 7, '1221202403022967662fc5cb6e7.jpeg', NULL, '2024-12-20 21:32:29', '2024-12-20 21:32:29'),
(10, 7, '1221202403022967662fc5cb73e.jpg', NULL, '2024-12-20 21:32:29', '2024-12-20 21:32:29'),
(11, 8, '1221202403032567662ffd8262d.jpg', NULL, '2024-12-20 21:33:25', '2024-12-20 21:33:25'),
(12, 8, '1221202403032567662ffd82869.jpg', NULL, '2024-12-20 21:33:25', '2024-12-20 21:33:25');

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
(1, 1, 1, 106, '1', 200000, NULL, '2024-12-16 17:34:45', '2024-12-16 17:34:45'),
(2, 1, 106, 107, '1,106', 200000, NULL, '2024-12-17 02:51:39', '2024-12-17 02:51:39'),
(3, 1, 1, 108, '1', 200000, NULL, '2024-12-17 02:59:47', '2024-12-17 02:59:47'),
(4, 1, 1, 109, '1', 200000, NULL, '2024-12-17 03:05:41', '2024-12-17 03:05:41'),
(5, 108, 108, 110, '1,108', 200000, NULL, '2024-12-17 03:10:52', '2024-12-17 03:10:52'),
(6, 109, 109, 111, '1,109', 200000, NULL, '2024-12-17 05:02:01', '2024-12-17 05:02:01'),
(7, 109, 109, 112, '1,109', 200000, NULL, '2024-12-17 05:09:27', '2024-12-17 05:09:27'),
(8, 109, 109, 113, '1,109', 200000, NULL, '2024-12-17 05:13:42', '2024-12-17 05:13:42'),
(9, 108, 108, 114, '1,108', 200000, NULL, '2024-12-17 06:35:32', '2024-12-17 06:35:32'),
(10, 108, 108, 115, '1,108', 200000, NULL, '2024-12-17 06:47:18', '2024-12-17 06:47:18'),
(11, 106, 106, 116, '1,106', 200000, NULL, '2024-12-17 06:51:26', '2024-12-17 06:51:26'),
(12, 106, 106, 117, '1,106', 200000, NULL, '2024-12-17 06:54:16', '2024-12-17 06:54:16'),
(13, 113, 113, 118, '1,109,113', 200000, NULL, '2024-12-17 07:37:14', '2024-12-17 07:37:14'),
(14, 113, 113, 119, '1,109,113', 200000, NULL, '2024-12-17 14:09:10', '2024-12-17 14:09:10'),
(15, 113, 113, 120, '1,109,113', 200000, NULL, '2024-12-17 14:11:33', '2024-12-17 14:11:33'),
(16, 112, 112, 121, '1,109,112', 200000, NULL, '2024-12-17 14:20:03', '2024-12-17 14:20:03'),
(17, 112, 112, 122, '1,109,112', 200000, NULL, '2024-12-17 14:22:20', '2024-12-17 14:22:20'),
(18, 112, 122, 123, '1,109,112,122', 200000, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(19, 111, 111, 124, '1,109,111', 200000, NULL, '2024-12-17 14:27:02', '2024-12-17 14:27:02'),
(20, 111, 124, 125, '1,109,111,124', 200000, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(21, 111, 125, 126, '1,109,111,124,125', 200000, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(22, 1, 107, 127, '1,106,107', 200000, NULL, '2024-12-17 15:50:49', '2024-12-17 15:50:49'),
(23, 114, 114, 128, '1,108,114', 200000, NULL, '2024-12-17 16:12:25', '2024-12-17 16:12:25'),
(24, 108, 114, 129, '1,108,114', 200000, NULL, '2024-12-17 16:17:30', '2024-12-17 16:17:30'),
(25, 1, 107, 130, '1,106,107', 200000, NULL, '2024-12-17 11:38:10', '2024-12-17 11:38:10'),
(26, 107, 107, 131, '1,106,107', 200000, NULL, '2024-12-20 21:21:00', '2024-12-20 21:21:00'),
(27, 116, 116, 132, '1,106,116', 200000, NULL, '2024-12-20 21:21:53', '2024-12-20 21:21:53'),
(28, 116, 116, 133, '1,106,116', 200000, NULL, '2024-12-20 21:22:20', '2024-12-20 21:22:20'),
(29, 116, 116, 134, '1,106,116', 200000, NULL, '2024-12-20 21:22:44', '2024-12-20 21:22:44'),
(30, 117, 117, 135, '1,106,117', 200000, NULL, '2024-12-20 21:23:40', '2024-12-20 21:23:40'),
(31, 117, 117, 136, '1,106,117', 200000, NULL, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
(32, 117, 117, 137, '1,106,117', 200000, NULL, '2024-12-20 21:24:15', '2024-12-20 21:24:15'),
(33, 110, 110, 138, '1,108,110', 200000, NULL, '2024-12-20 21:24:45', '2024-12-20 21:24:45'),
(34, 110, 110, 139, '1,108,110', 200000, NULL, '2024-12-20 21:25:07', '2024-12-20 21:25:07'),
(35, 110, 110, 140, '1,108,110', 200000, NULL, '2024-12-20 21:25:36', '2024-12-20 21:25:36'),
(36, 114, 114, 141, '1,108,114', 200000, NULL, '2024-12-20 21:26:09', '2024-12-20 21:26:09'),
(37, 115, 115, 142, '1,108,115', 200000, NULL, '2024-12-20 21:27:03', '2024-12-20 21:27:03'),
(38, 115, 115, 143, '1,108,115', 200000, NULL, '2024-12-20 21:27:23', '2024-12-20 21:27:23'),
(39, 115, 115, 144, '1,108,115', 200000, NULL, '2024-12-20 21:27:43', '2024-12-20 21:27:43'),
(40, 111, 111, 145, '1,109,111', 200000, NULL, '2024-12-20 21:28:34', '2024-12-20 21:28:34'),
(41, 111, 111, 146, '1,109,111', 200000, NULL, '2024-12-20 21:29:04', '2024-12-20 21:29:04'),
(42, 112, 112, 147, '1,109,112', 200000, NULL, '2024-12-20 21:31:31', '2024-12-20 21:31:31');

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
  `balance_amount` bigint(11) NOT NULL DEFAULT 0,
  `winnig_reward` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `custom_user_id`, `name`, `dob`, `s_w_d`, `swd_name`, `nomination_name`, `nomination_dob`, `country_code`, `mobile_number`, `email`, `adhar_number`, `pan_number`, `bank_account_number`, `bank_name`, `bank_ifsc_code`, `bank_branch_name`, `address`, `country`, `city`, `state`, `zip_code`, `password`, `device_type`, `device_token`, `refresh_token`, `is_block`, `remember_token`, `is_super_admin`, `user_level`, `balance_amount`, `winnig_reward`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TS000', 'Super Admin', '1994-11-11', 'Son Off', NULL, 'SUPER ADMIN', NULL, '+91', '9876543210', 'superadmin@yopmail.com', '000000000000', '000000000', '00000000000', 'NONE', 'NONE', 'NONE', 'NONE', '', NULL, NULL, NULL, '$2y$12$nXLHSbB0SL0qdP0y0KigLO15iWISZAKMj2aZm4pGd95lJSpRRn63S', NULL, NULL, NULL, 0, 'cQx1OB20bHNVkL3YSwiVZsuuYJSUT4ZM', 1, 3, 521000, 2, '2024-11-11 21:00:12', '2024-12-20 22:44:41', NULL),
(106, 'TS001', 'Shubdeep Singh', '2006-12-05', 'Son Off', 'Charanjeet Singh', 'Prabjot Kaur', '2012-12-11', '+91', '6467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '04783', '$2y$12$088bYjV9sDtGeClTKJ.KFOLeag2LLALuoOCrTfcotTX.Cu.8RT6Ne', NULL, NULL, NULL, 0, 'GpAlG2Q6RdWzgsFsmkWPtuqccvS9LpjS', 0, 1, 175000, 0, '2024-12-16 17:34:45', '2024-12-20 21:24:15', NULL),
(107, 'TS002', 'He singh', '2006-12-17', 'Son Off', 'So singh', 'Hi k', '2012-12-15', '+91', '9632580741', 'singhgurdev05650@gmail.com', '987654321012', 'Df', 'Hg', 'Hg', 'Hg', 'Hg', 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$V5MRMz78JqffLzoBZWa0U.2xgQwuBnG0uTo.Mfb9ieUeMKIorejPy', NULL, NULL, NULL, 0, 'nr9SjJ2ZOmLUgJu7vnQjAdF20MJOYbpl', 0, 1, 65000, 0, '2024-12-17 02:51:39', '2024-12-20 21:21:00', NULL),
(108, 'TS003', 'Harjit', '2006-12-17', 'Son Off', 'Gajan', 'Surjit', '2012-12-12', '+91', '9632587410', 'singhgurdev05650@gmail.co', '987654321123', 'Gs87654', '12345654', 'Bh', 'Gfd', 'Hgd', 'Hfdsguug', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$cGWD5ux9kpXq.SzXDaH3Fefkp/crtuqIqYkyuB1TI7Ge26pNukwTW', NULL, NULL, NULL, 0, 'ylSjLQV8gCwd4ZUTHFxHhZLovw7mqRP4', 0, 1, 215000, 0, '2024-12-17 02:59:47', '2024-12-20 21:27:43', NULL),
(109, 'TS004', 'Herjit', '2006-12-17', 'Son Off', 'Gurjit', 'Harmit', '2012-12-04', '+91', '1472583690', 'singhgurdev05650@gmail.com', '123456789056', 'Gh67899', '123568⁸', 'Pnb', 'Pnji', 'Pnbv', 'Cgdhkcjjj', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$5CCI47AYCW7O7F1V8dIyp.Vr5A4NlAkJ2IlwWhkGfsl/1tPCR.tvy', NULL, NULL, NULL, 0, 'S55ZW15CZ1sdxvp9U3ppN27ZzqAe7ob5', 0, 1, 221000, 0, '2024-12-17 03:05:41', '2024-12-20 21:31:31', NULL),
(110, 'TS005', 'Gurmit', '2006-12-17', 'Son Off', 'Sani', 'Hani', '2012-12-06', '+91', '8523697410', 'gurdevsingh05650@gmail.com', '987654321234', 'Gh7890', '56', 'Pnb', 'Pnb45', 'Pnb', 'Gfghhjj', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$Fv0wo0KeJymKJfs76dh.9.kHMZ3eI09p3.iEMbXfgKKwEci86E2T6', NULL, NULL, NULL, 0, NULL, 0, 1, 105000, 0, '2024-12-17 03:10:52', '2024-12-20 21:25:36', NULL),
(111, 'TS006', 'Prsbhjit', '2006-12-17', 'Son Off', 'Harjit', 'Gurdeep', '2012-12-13', '+91', '7532146980', 'singhgurdev05650@gmail.com', '987654321123', NULL, '5688', 'Pnb', 'Pnb56', 'Lud pnb', 'Gfdssfgh', 'Ghuff', 'Ffg', 'Guujj', '234556', '$2y$12$tK8mM6PiMGfyHjiQ/.KXTejFByWch1.Ug2ONlRwEUEeCAflCuadnS', NULL, NULL, NULL, 0, NULL, 0, 1, 164000, 0, '2024-12-17 05:02:01', '2024-12-20 21:29:04', NULL),
(112, 'TS007', 'Gurdial', '2006-12-17', 'Son Off', 'Harjap', 'Manny', '2012-12-07', '+91', '3578962410', 'singhgurdev05650@gmail.com', '987654321123', 'HG9876', '1234556', 'Pnb', 'Punb345', 'Verka', 'Dfghvvcfyiu', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$cRS/w0JZ03lQ5ax4bsdiEeAB6aWvWfqR5ZAuRMKNe9Wt.Q.qMIBQS', NULL, NULL, NULL, 0, NULL, 0, 1, 135000, 0, '2024-12-17 05:09:27', '2024-12-20 21:31:31', NULL),
(113, 'TS008', 'Shubas', '2006-12-17', 'Son Off', 'Rakesh', 'Sunny', '2012-12-06', '+91', '0325096147', 'singhgurdev05650@gmail.com', '765432156789', 'Hg786', '456788', 'Pnb', 'Pnj567', 'Verka', 'Hhhkklo', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$UEcCopAk5HLjUAL8.m5m1.voz5XzGdk7WYgF1uMWh8f7flT8dLXiG', NULL, NULL, NULL, 0, NULL, 0, 1, 105000, 0, '2024-12-17 05:13:42', '2024-12-17 14:11:33', NULL),
(114, 'TS009', 'Mehak', '2006-12-17', 'Son Off', 'Gurdev', 'Baban', '2012-11-15', '+91', '8699351962', 'gurdevsingh05650@gmail.com', '098765432112', 'Hg8765', '456788', 'Pnb', 'Punb56', 'Bhalapind', 'Dgjkbhj', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$NlMyiyFfjXjzTdg7Aowj7ORFc4TSBUbrCTs6loSaVCewfSvomGNkK', NULL, NULL, NULL, 0, NULL, 0, 1, 85000, 0, '2024-12-17 06:35:32', '2024-12-20 21:26:09', NULL),
(115, 'TS0010', 'GURMEHAK KAUR', '2006-12-17', 'Son Off', 'Gurjit', 'Hani', '2012-12-02', '+91', '6541239807', 'gurdevsingh05650@gmail.com', '987654321123', 'Hg78', '45677', 'Ghjg', 'Fghh67', 'Chjt', 'Dggyyh', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$wdjosBgbAGkFLHb3juwGpevbNk9wfPAQiXr5rOV2MjJLv4AnUiNoO', NULL, NULL, NULL, 0, NULL, 0, 1, 105000, 0, '2024-12-17 06:47:18', '2024-12-20 21:27:43', NULL),
(116, 'TS0011', 'Gurtej', '2006-12-17', 'Son Off', 'Gurdev', 'Baban', '2012-12-02', '+91', '0852369741', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Fhhhhhb', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$C4k4SvwFWRVSdffWjBbD.ejHq.RcNpo4z/cM7hl70nOwQbBBdXZqe', NULL, NULL, NULL, 0, NULL, 0, 1, 105000, 0, '2024-12-17 06:51:26', '2024-12-20 21:22:44', NULL),
(117, 'TS0012', 'Gurbir', '2006-12-17', 'Son Off', 'Heera', 'Dhir', '2012-11-07', '+91', '2563987410', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Gyyy', 'India', 'Amritsar', 'Punjab', '423565', '$2y$12$k5QVwzQ99ZwEEzQjZbdg1.ElTcc2OG4lQRh7ho6ZH.HTjk.ccfZ.m', NULL, NULL, NULL, 0, NULL, 0, 1, 105000, 0, '2024-12-17 06:54:16', '2024-12-20 21:24:15', NULL),
(118, 'TS0013', 'Kuldip', '2006-12-17', 'Son Off', 'Lal', 'Harjit', '2012-10-17', '+91', '1237895640', 'gurdevsingh05650@gmail.com', '786903456789', 'Gh677', 'E45678', 'Pnb', 'Pnb56', 'BhalPind', 'Dfghjkk', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$4sX7sDGQm3hR/VPT72NRQ.A3shIjbzL0SxiqUGSIwL7JTtmYbVOgi', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 07:37:14', '2024-12-17 07:37:14', NULL),
(119, 'TS0014', 'NAVNOOR KAUR', '2006-12-17', 'Son Off', 'Gajan', 'Baban', '2012-12-13', '+91', '3578962411', 'singhgurdev05650@gmail.com', '987654321123', 'Gs87654', NULL, NULL, NULL, NULL, 'Fgjiuh', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$x1ver8NDMHPBLweCuyn0KeRUQXtXAhyF299fpwL4PbsPDYQFryA9S', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 14:09:10', '2024-12-17 14:09:10', NULL),
(120, 'TS0015', 'Ramandeep kaur', '2006-12-17', 'Son Off', 'So singh', 'Hani', '2012-10-12', '+91', '0852367941', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$EPa5A0xIEGX7uVHvRuPKD.uvEORHHf/TDmYuHmpDodOlRdYovulWq', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 14:11:33', '2024-12-17 14:11:33', NULL),
(121, 'TS0016', 'Tandeep kaur', '2006-12-17', 'Son Off', 'Harjap', 'Hani', '2012-10-17', '+91', '2598634107', 'singhgurdev05650@gmail.com', '987654321012', 'Gh7890', NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$vyBaEJL0Hg5Qmh7uYpPc0.5SyawqpMVg/txouu6IeS2SHqXJys0GO', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 14:20:03', '2024-12-17 14:20:03', NULL),
(122, 'TS0017', 'Nisha', '2006-12-17', 'Son Off', 'Gajan', 'Hi k', '2012-09-13', '+91', '2635980741', 'gurdevsingh05650@gmail.com', '987654321234', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$n.C9uPEXpfOc2RV.oiS0n.6X7SYNa/0o.MGiPFuShlXuEBLMDbzRW', NULL, NULL, NULL, 0, NULL, 0, 0, 15000, 0, '2024-12-17 14:22:20', '2024-12-17 14:25:07', NULL),
(123, 'TS0018', 'He singh', '2006-12-17', 'Son Off', 'Gurjit', 'Baban', '2012-12-12', '+91', '2635890741', 'gurdevsingh05650@gmail.com', '098765432112', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$rxJwbqDNlUCAT6eDbgkKc.syK4/YH6xvzpHc72u/RnSOChF70JMni', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 14:25:07', '2024-12-17 14:25:07', NULL),
(124, 'TS0019', 'GURMEHAK KAUR', '2006-12-17', 'Son Off', 'So singh', 'Hani', '2012-12-06', '+91', '2965837410', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$M3tvHQCTdjidxkGgTOab.OK0WxT7DgGdqKo9yaz76EL/iJhWAOIke', NULL, NULL, NULL, 0, NULL, 0, 0, 25000, 0, '2024-12-17 14:27:02', '2024-12-17 14:30:49', NULL),
(125, 'TS0020', 'Nisha', '2006-12-17', 'Son Off', 'Gajan', 'Hani', '2012-12-13', '+91', '2937145680', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$mM8ZkILEfTYNDpjPocHuv.TvI6641dY4XW9MyW91HgdPqLZlzdj4W', NULL, NULL, NULL, 0, NULL, 0, 0, 15000, 0, '2024-12-17 14:28:58', '2024-12-17 14:30:49', NULL),
(126, 'TS0021', 'GURMEHAK KAUR', '2006-12-17', 'Son Off', 'Gurjit', 'Hani', '2012-12-11', '+91', '2580963471', 'singhgurdev05650@gmail.com', '987654321123', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$xs20WuH6VFyXSUWnZEJDAOuo3KfiMR6JXUombbDDqL2TPeC.33zLy', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 14:30:49', '2024-12-17 14:30:49', NULL),
(127, 'TS0022', 'NAVNOOR KAUR', '2006-12-17', 'Son Off', 'Gajan', 'Surjit', '2012-09-13', '+91', '0852316497', 'singhgurdev05650@gmail.com', '987654321012', NULL, NULL, NULL, NULL, NULL, 'Hfdsguug', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$qvDAhB9ahaV1PIG/WqiTiOCkEtd4h7ZYnAKSJava3BAG0zuvbhIlO', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 15:50:49', '2024-12-17 15:50:49', NULL),
(128, 'TS0023', 'NAVNOOR KAUR', '2006-12-17', 'Son Off', 'Harjap', 'Hi k', '2011-09-15', '+91', '3571590852', 'gurdevsingh05650@gmail.com', '987654321012', NULL, NULL, NULL, NULL, NULL, 'Dfghvvcfyiu', 'India', 'Amritsar', 'Punjab', '567⁷89', '$2y$12$YeQmMFbVYS/emjiPat5e..OfUu73T9fAHciRohPk9T827PfZ5DCzG', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 16:12:25', '2024-12-17 16:12:25', NULL),
(129, 'TS0024', 'He singh', '2006-12-17', 'Son Off', 'Sani', 'Hani', '2012-07-11', '+91', '2935687401', 'gurdevsingh05650@gmail.com', '987654321012', NULL, NULL, NULL, NULL, NULL, 'Dfghhkkkkl', 'India', 'Amritsar', 'Punjab', '143102', '$2y$12$Jt/W0Nsi5IA2ihvN/aUQF.gNTR2N8kgYRGine0Mnh/06lYp17Js3O', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 16:17:30', '2024-12-17 16:17:30', NULL),
(130, 'TS0025', 'Host Testing', '2006-12-17', 'Son Off', 'sss', 'ABC', NULL, '+91', '6467023123', NULL, '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$2ke3Gpd9F26HZUuq6m6RbO4I.NKTaGmTJiddfeBv5inFnSiL9oFT.', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-17 11:38:10', '2024-12-17 11:38:10', NULL),
(131, 'TS0026', 'A1', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023891', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$K44g6V0GYt6dYCxDavhhJemJq4MHgPl.BmgHfGpMpX3Rfo83w/xCO', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:21:00', '2024-12-20 21:21:00', NULL),
(132, 'TS0027', 'Shubdeep Singh', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023892', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$UaufOfmcxumndB1vkZqGH..9V5loj1OP9ODiPZAHFWj2QyGV/8XFO', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:21:53', '2024-12-20 21:21:53', NULL),
(133, 'TS0028', 'A2', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023893', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$nl6rjNJaDfoBDEA6snUY7.gpJ4jRM0loxkXBIs38B5lk7uMasnpOi', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:22:20', '2024-12-20 21:22:20', NULL),
(134, 'TS0029', 'B1', '2006-12-21', 'Son Off', 'sgsd', 'ABC', NULL, '+91', '0646702384', 'aman@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'India', 'Kotda', 'Gujarat', 'ts000', '$2y$12$FiAQN2Qp7FBXsGyFwjohLOY/7WHPjksAJTTfCi5DWR.9BPlbkYaxe', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:22:44', '2024-12-20 21:22:44', NULL),
(135, 'TS0030', 'x1', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023895', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$QjukKJHlFlv8fs5SmXlnVODlwgXj6A/x2aGscocd3IRN2lLGLloDC', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:23:40', '2024-12-20 21:23:40', NULL),
(136, 'TS0031', 'x2', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023896', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$f/oDU2Hn40KeCEblCS9UP.NnNGXt4lPIMMYvSbFqZlPbtmviP6fV.', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:23:56', '2024-12-20 21:23:56', NULL),
(137, 'TS0032', 'x3', '2006-12-21', 'Son Off', 'sgsd', NULL, NULL, '+91', '6467023897', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$1vQ/pkd8SC5nW.utARBOiu.auTNHkbuXtrZC7vzkr4OBFSLSCmusW', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:24:15', '2024-12-20 21:24:15', NULL),
(138, 'TS0033', 'q1', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6467023898', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$HygF8om6mMjUSDynX3S2qOgD7c4S3eXZpbodF9FESTCXr.T9YTf3.', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:24:45', '2024-12-20 21:24:45', NULL),
(139, 'TS0034', 'q2', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023899', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$iI5i1X.JiacMmDiImQq3CuDUJi3qc2XKAecALem7gnhZQyrv42Mo.', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:25:07', '2024-12-20 21:25:07', NULL),
(140, 'TS0035', 'q3', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '1467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$7UqsVLn5jAHMeuQvdoKGvOmu3aDCznP3BzpVnzh4XrAowc0gr70HS', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:25:36', '2024-12-20 21:25:36', NULL),
(141, 'TS0036', 'm1', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '2467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$oYQmDhq33t7QOQMfv5vsVOjFQvUND5tdg7UMAWOfK653FcKvCuzqO', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:26:09', '2024-12-20 21:26:09', NULL),
(142, 'TS0037', 'g1', '2006-12-21', 'Son Off', 'sgsd', NULL, NULL, '+91', '3467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$oHPHjES8DC0FrLbsz7MoV.ykLNF1khbYPv8CTJMERJsPl/5XlpbYe', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:27:03', '2024-12-20 21:27:03', NULL),
(143, 'TS0038', 'g2', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '4467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$Guv/t.0pbU2kKyC7kviGreF67FdsU5MabWEC4Qt3vxiDsjV0Cxkbu', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:27:23', '2024-12-20 21:27:23', NULL),
(144, 'TS0039', 'g3', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '5467023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$B77MrMtlUdewqY5Yni2W3eqzCT/x4pxSZWVWns.U.Ub.c1aY0OKza', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:27:43', '2024-12-20 21:27:43', NULL),
(145, 'TS0040', 'p1', '2006-12-21', 'Son Off', 'ABC', NULL, NULL, '+91', '6477023890', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$qrWTwZFa493BjFNV/uFoV.UCBDyHnkjXdHcpA78Mu5tVGFu57wDp2', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:28:34', '2024-12-20 21:28:34', NULL),
(146, 'TS0041', 'p2', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '6467023812', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', 'ts000', '$2y$12$cC9RMeHi6at9UFL61LS4PeqCdd7T6ouDNakXViTlbTNJ7cNEr4yuK', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:29:04', '2024-12-20 21:29:04', NULL),
(147, 'TS0042', 'AV Testing', '2006-12-21', 'Son Off', 'ABC', 'ABC', NULL, '+91', '0646702312', 'aman@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'India', 'Kotda', 'Gujarat', 'ts000', '$2y$12$dmVL/Ui/qMTLG1RGC5PQ/O5ppURv1S3iNcc/e4aj5zIba4mfbsPai', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, '2024-12-20 21:31:31', '2024-12-20 21:31:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credit_user_id` bigint(20) UNSIGNED NOT NULL,
  `upline_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentage` double NOT NULL DEFAULT 0,
  `total_amount` bigint(20) NOT NULL,
  `credit_user_amount` bigint(20) NOT NULL,
  `type_of_credit` enum('By Tree','By Sponser','By Debit') NOT NULL,
  `debit_amount` bigint(20) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `credit_user_id`, `upline_id`, `user_id`, `percentage`, `total_amount`, `credit_user_amount`, `type_of_credit`, `debit_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 106, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-16 17:34:45', '2024-12-16 17:34:45'),
(2, 1, 1, 106, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-16 17:34:45', '2024-12-16 17:34:45'),
(3, 1, 106, 107, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 02:51:39', '2024-12-17 02:51:39'),
(4, 1, 106, 107, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 02:51:39', '2024-12-17 02:51:39'),
(5, 106, 106, 107, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 02:51:39', '2024-12-17 02:51:39'),
(6, 1, 1, 108, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 02:59:47', '2024-12-17 02:59:47'),
(7, 1, 1, 108, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 02:59:47', '2024-12-17 02:59:47'),
(8, 1, 1, 109, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 03:05:41', '2024-12-17 03:05:41'),
(9, 1, 1, 109, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 03:05:41', '2024-12-17 03:05:41'),
(10, 108, 108, 110, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 03:10:52', '2024-12-17 03:10:52'),
(11, 1, 108, 110, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 03:10:52', '2024-12-17 03:10:52'),
(12, 108, 108, 110, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 03:10:52', '2024-12-17 03:10:52'),
(13, 109, 109, 111, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 05:02:01', '2024-12-17 05:02:01'),
(14, 1, 109, 111, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 05:02:01', '2024-12-17 05:02:01'),
(15, 109, 109, 111, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 05:02:01', '2024-12-17 05:02:01'),
(16, 109, 109, 112, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 05:09:27', '2024-12-17 05:09:27'),
(17, 1, 109, 112, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 05:09:27', '2024-12-17 05:09:27'),
(18, 109, 109, 112, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 05:09:27', '2024-12-17 05:09:27'),
(19, 109, 109, 113, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 05:13:42', '2024-12-17 05:13:42'),
(20, 1, 109, 113, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 05:13:42', '2024-12-17 05:13:42'),
(21, 109, 109, 113, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 05:13:42', '2024-12-17 05:13:42'),
(22, 108, 108, 114, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 06:35:32', '2024-12-17 06:35:32'),
(23, 1, 108, 114, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 06:35:32', '2024-12-17 06:35:32'),
(24, 108, 108, 114, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 06:35:32', '2024-12-17 06:35:32'),
(25, 108, 108, 115, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 06:47:18', '2024-12-17 06:47:18'),
(26, 1, 108, 115, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 06:47:18', '2024-12-17 06:47:18'),
(27, 108, 108, 115, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 06:47:18', '2024-12-17 06:47:18'),
(28, 106, 106, 116, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 06:51:26', '2024-12-17 06:51:26'),
(29, 1, 106, 116, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 06:51:26', '2024-12-17 06:51:26'),
(30, 106, 106, 116, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 06:51:26', '2024-12-17 06:51:26'),
(31, 106, 106, 117, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 06:54:16', '2024-12-17 06:54:16'),
(32, 1, 106, 117, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 06:54:16', '2024-12-17 06:54:16'),
(33, 106, 106, 117, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 06:54:16', '2024-12-17 06:54:16'),
(34, 113, 113, 118, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 07:37:14', '2024-12-17 07:37:14'),
(35, 1, 113, 118, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 07:37:14', '2024-12-17 07:37:14'),
(36, 109, 113, 118, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 07:37:14', '2024-12-17 07:37:14'),
(37, 113, 113, 118, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 07:37:14', '2024-12-17 07:37:14'),
(38, 113, 113, 119, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:09:10', '2024-12-17 14:09:10'),
(39, 1, 113, 119, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:09:10', '2024-12-17 14:09:10'),
(40, 109, 113, 119, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:09:10', '2024-12-17 14:09:10'),
(41, 113, 113, 119, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:09:10', '2024-12-17 14:09:10'),
(42, 113, 113, 120, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:11:33', '2024-12-17 14:11:33'),
(43, 1, 113, 120, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:11:33', '2024-12-17 14:11:33'),
(44, 109, 113, 120, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:11:33', '2024-12-17 14:11:33'),
(45, 113, 113, 120, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:11:33', '2024-12-17 14:11:33'),
(46, 112, 112, 121, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:20:03', '2024-12-17 14:20:03'),
(47, 1, 112, 121, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:20:03', '2024-12-17 14:20:03'),
(48, 109, 112, 121, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:20:03', '2024-12-17 14:20:03'),
(49, 112, 112, 121, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:20:03', '2024-12-17 14:20:03'),
(50, 112, 112, 122, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:22:20', '2024-12-17 14:22:20'),
(51, 1, 112, 122, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:22:20', '2024-12-17 14:22:20'),
(52, 109, 112, 122, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:22:20', '2024-12-17 14:22:20'),
(53, 112, 112, 122, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:22:20', '2024-12-17 14:22:20'),
(54, 112, 122, 123, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(55, 1, 122, 123, 4, 200000, 8000, 'By Tree', 0, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(56, 109, 122, 123, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(57, 112, 122, 123, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(58, 122, 122, 123, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:25:07', '2024-12-17 14:25:07'),
(59, 111, 111, 124, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:27:02', '2024-12-17 14:27:02'),
(60, 1, 111, 124, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:27:02', '2024-12-17 14:27:02'),
(61, 109, 111, 124, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:27:02', '2024-12-17 14:27:02'),
(62, 111, 111, 124, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:27:02', '2024-12-17 14:27:02'),
(63, 111, 124, 125, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(64, 1, 124, 125, 4, 200000, 8000, 'By Tree', 0, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(65, 109, 124, 125, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(66, 111, 124, 125, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(67, 124, 124, 125, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:28:58', '2024-12-17 14:28:58'),
(68, 111, 125, 126, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(69, 1, 125, 126, 3.5, 200000, 7000, 'By Tree', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(70, 109, 125, 126, 4, 200000, 8000, 'By Tree', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(71, 111, 125, 126, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(72, 124, 125, 126, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(73, 125, 125, 126, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 14:30:49', '2024-12-17 14:30:49'),
(74, 1, 107, 127, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 15:50:49', '2024-12-17 15:50:49'),
(75, 1, 107, 127, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 15:50:49', '2024-12-17 15:50:49'),
(76, 106, 107, 127, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 15:50:49', '2024-12-17 15:50:49'),
(77, 107, 107, 127, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 15:50:49', '2024-12-17 15:50:49'),
(78, 114, 114, 128, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 16:12:25', '2024-12-17 16:12:25'),
(79, 1, 114, 128, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 16:12:25', '2024-12-17 16:12:25'),
(80, 108, 114, 128, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 16:12:25', '2024-12-17 16:12:25'),
(81, 114, 114, 128, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 16:12:25', '2024-12-17 16:12:25'),
(82, 108, 114, 129, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 16:17:30', '2024-12-17 16:17:30'),
(83, 1, 114, 129, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 16:17:30', '2024-12-17 16:17:30'),
(84, 108, 114, 129, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 16:17:30', '2024-12-17 16:17:30'),
(85, 114, 114, 129, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 16:17:30', '2024-12-17 16:17:30'),
(86, 1, 107, 130, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-17 11:38:10', '2024-12-17 11:38:10'),
(87, 1, 107, 130, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-17 11:38:10', '2024-12-17 11:38:10'),
(88, 106, 107, 130, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-17 11:38:10', '2024-12-17 11:38:10'),
(89, 107, 107, 130, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-17 11:38:10', '2024-12-17 11:38:10'),
(90, 107, 107, 131, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:21:00', '2024-12-20 21:21:00'),
(91, 1, 107, 131, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:21:00', '2024-12-20 21:21:00'),
(92, 106, 107, 131, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:21:00', '2024-12-20 21:21:00'),
(93, 107, 107, 131, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:21:00', '2024-12-20 21:21:00'),
(94, 116, 116, 132, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:21:53', '2024-12-20 21:21:53'),
(95, 1, 116, 132, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:21:53', '2024-12-20 21:21:53'),
(96, 106, 116, 132, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:21:53', '2024-12-20 21:21:53'),
(97, 116, 116, 132, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:21:53', '2024-12-20 21:21:53'),
(98, 116, 116, 133, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:22:20', '2024-12-20 21:22:20'),
(99, 1, 116, 133, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:22:20', '2024-12-20 21:22:20'),
(100, 106, 116, 133, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:22:20', '2024-12-20 21:22:20'),
(101, 116, 116, 133, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:22:20', '2024-12-20 21:22:20'),
(102, 116, 116, 134, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:22:44', '2024-12-20 21:22:44'),
(103, 1, 116, 134, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:22:44', '2024-12-20 21:22:44'),
(104, 106, 116, 134, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:22:44', '2024-12-20 21:22:44'),
(105, 116, 116, 134, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:22:44', '2024-12-20 21:22:44'),
(106, 117, 117, 135, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:23:40', '2024-12-20 21:23:40'),
(107, 1, 117, 135, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:23:40', '2024-12-20 21:23:40'),
(108, 106, 117, 135, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:23:40', '2024-12-20 21:23:40'),
(109, 117, 117, 135, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:23:40', '2024-12-20 21:23:40'),
(110, 117, 117, 136, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
(111, 1, 117, 136, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
(112, 106, 117, 136, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
(113, 117, 117, 136, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:23:56', '2024-12-20 21:23:56'),
(114, 117, 117, 137, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:24:15', '2024-12-20 21:24:15'),
(115, 1, 117, 137, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:24:15', '2024-12-20 21:24:15'),
(116, 106, 117, 137, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:24:15', '2024-12-20 21:24:15'),
(117, 117, 117, 137, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:24:15', '2024-12-20 21:24:15'),
(118, 110, 110, 138, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:24:45', '2024-12-20 21:24:45'),
(119, 1, 110, 138, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:24:45', '2024-12-20 21:24:45'),
(120, 108, 110, 138, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:24:45', '2024-12-20 21:24:45'),
(121, 110, 110, 138, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:24:45', '2024-12-20 21:24:45'),
(122, 110, 110, 139, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:25:07', '2024-12-20 21:25:07'),
(123, 1, 110, 139, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:25:07', '2024-12-20 21:25:07'),
(124, 108, 110, 139, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:25:07', '2024-12-20 21:25:07'),
(125, 110, 110, 139, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:25:07', '2024-12-20 21:25:07'),
(126, 110, 110, 140, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:25:36', '2024-12-20 21:25:36'),
(127, 1, 110, 140, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:25:36', '2024-12-20 21:25:36'),
(128, 108, 110, 140, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:25:36', '2024-12-20 21:25:36'),
(129, 110, 110, 140, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:25:36', '2024-12-20 21:25:36'),
(130, 114, 114, 141, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:26:09', '2024-12-20 21:26:09'),
(131, 1, 114, 141, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:26:09', '2024-12-20 21:26:09'),
(132, 108, 114, 141, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:26:09', '2024-12-20 21:26:09'),
(133, 114, 114, 141, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:26:09', '2024-12-20 21:26:09'),
(134, 115, 115, 142, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:27:03', '2024-12-20 21:27:03'),
(135, 1, 115, 142, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:27:03', '2024-12-20 21:27:03'),
(136, 108, 115, 142, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:27:03', '2024-12-20 21:27:03'),
(137, 115, 115, 142, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:27:03', '2024-12-20 21:27:03'),
(138, 115, 115, 143, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:27:23', '2024-12-20 21:27:23'),
(139, 1, 115, 143, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:27:23', '2024-12-20 21:27:23'),
(140, 108, 115, 143, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:27:23', '2024-12-20 21:27:23'),
(141, 115, 115, 143, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:27:23', '2024-12-20 21:27:23'),
(142, 115, 115, 144, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:27:43', '2024-12-20 21:27:43'),
(143, 1, 115, 144, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:27:43', '2024-12-20 21:27:43'),
(144, 108, 115, 144, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:27:43', '2024-12-20 21:27:43'),
(145, 115, 115, 144, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:27:43', '2024-12-20 21:27:43'),
(146, 111, 111, 145, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:28:34', '2024-12-20 21:28:34'),
(147, 1, 111, 145, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:28:34', '2024-12-20 21:28:34'),
(148, 109, 111, 145, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:28:34', '2024-12-20 21:28:34'),
(149, 111, 111, 145, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:28:34', '2024-12-20 21:28:34'),
(150, 111, 111, 146, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:29:04', '2024-12-20 21:29:04'),
(151, 1, 111, 146, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:29:04', '2024-12-20 21:29:04'),
(152, 109, 111, 146, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:29:04', '2024-12-20 21:29:04'),
(153, 111, 111, 146, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:29:04', '2024-12-20 21:29:04'),
(154, 112, 112, 147, 0, 200000, 20000, 'By Sponser', 0, NULL, '2024-12-20 21:31:31', '2024-12-20 21:31:31'),
(155, 1, 112, 147, 4.5, 200000, 9000, 'By Tree', 0, NULL, '2024-12-20 21:31:31', '2024-12-20 21:31:31'),
(156, 109, 112, 147, 5, 200000, 10000, 'By Tree', 0, NULL, '2024-12-20 21:31:31', '2024-12-20 21:31:31'),
(157, 112, 112, 147, 7.5, 200000, 15000, 'By Tree', 0, NULL, '2024-12-20 21:31:31', '2024-12-20 21:31:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim_rewards`
--
ALTER TABLE `claim_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claim_rewards_reward_id_foreign` (`reward_id`),
  ADD KEY `claim_rewards_user_id_foreign` (`user_id`);

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
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_images`
--
ALTER TABLE `reward_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reward_images_reward_id_foreign` (`reward_id`);

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
-- AUTO_INCREMENT for table `claim_rewards`
--
ALTER TABLE `claim_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reward_images`
--
ALTER TABLE `reward_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `under_take_users`
--
ALTER TABLE `under_take_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim_rewards`
--
ALTER TABLE `claim_rewards`
  ADD CONSTRAINT `claim_rewards_reward_id_foreign` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`),
  ADD CONSTRAINT `claim_rewards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reward_images`
--
ALTER TABLE `reward_images`
  ADD CONSTRAINT `reward_images_reward_id_foreign` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`);

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
