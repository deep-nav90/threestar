-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2024 at 10:48 AM
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
(1, 'TS000', 'Super Admin', '1994-11-11', 'Son Off', NULL, 'SUPER ADMIN', NULL, '+91', '9876543210', 'superadmin@yopmail.com', '000000000000', '000000000', '00000000000', 'NONE', 'NONE', 'NONE', 'NONE', '', NULL, NULL, NULL, '$2y$12$qMgzlHJwqRpUjNzUBld//eDpCMDwfdMY4ZVzfVldq2iK5K/DulbA2', NULL, NULL, NULL, 0, 'hfIjQ2iMzMrWv27FSM46ElOc2A76Xrl3', 1, 0, 0, 0, '2024-11-11 21:00:12', '2024-12-06 04:16:51', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
