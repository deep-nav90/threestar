-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2024 at 07:40 AM
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
(6, '2024_11_15_175144_create_under_take_users_table', 2);

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `under_take_users`
--

INSERT INTO `under_take_users` (`id`, `sponser_id`, `upline_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, NULL, NULL, NULL),
(2, 3, 3, 4, NULL, '2024-11-16 05:52:09', '2024-11-16 05:52:09'),
(3, 3, 3, 5, NULL, '2024-11-16 06:32:42', '2024-11-16 06:32:42'),
(4, 1, 1, 6, NULL, '2024-11-16 06:35:42', '2024-11-16 06:35:42'),
(5, 1, 3, 7, NULL, '2024-11-16 07:32:35', '2024-11-16 07:32:35'),
(6, 1, 6, 8, NULL, '2024-11-17 01:10:15', '2024-11-17 01:10:15');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `custom_user_id`, `name`, `dob`, `s_w_d`, `swd_name`, `nomination_name`, `nomination_dob`, `country_code`, `mobile_number`, `email`, `adhar_number`, `pan_number`, `bank_account_number`, `bank_name`, `bank_ifsc_code`, `bank_branch_name`, `address`, `country`, `city`, `state`, `zip_code`, `password`, `device_type`, `device_token`, `refresh_token`, `is_block`, `remember_token`, `is_super_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TS000', 'Super Admin', '1994-11-11', 'Son Off', NULL, 'SUPER ADMIN', NULL, '+91', '9876543210', 'superadmin@yopmail.com', '000000000000', '000000000', '00000000000', 'NONE', 'NONE', 'NONE', 'NONE', '', NULL, NULL, NULL, '$2y$12$qMgzlHJwqRpUjNzUBld//eDpCMDwfdMY4ZVzfVldq2iK5K/DulbA2', NULL, NULL, NULL, 0, 'QN653OxIG5VG0IjupRMwzh91icvdzMpI', 1, '2024-11-11 21:00:12', '2024-11-17 00:56:19', NULL),
(3, 'TS001', 'Shilpa', '2012-11-06', 'Son Off', 'ABC', NULL, '2012-11-06', '+91', '562346567', 'hosttesting@yopmail.com', '3543543', '23424234', NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '9876543210', '$2y$12$KerkLO7q7l1yVIqhJNHX0OkD9PRUH5h.Ce9rMOtxhblWjYqC8tSai', NULL, NULL, NULL, 0, 'WtgWvZTXaCSaVGbxxXxNy8oCQv0Rvjvd', 0, '2024-11-16 02:25:25', '2024-11-16 05:51:10', NULL),
(4, 'TS002', 'JATIN', '2012-11-13', 'Son Off', 'jhf', NULL, NULL, '+91', '2233223322', 'hosttesting@yopmail.com', '3543543', '23424234', NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '04783', '$2y$12$cnbrR79Y2BZc1hF3AzeaPeiXOnj0agbquL./1auCK4mettgLAUkMC', NULL, NULL, NULL, 0, NULL, 0, '2024-11-16 05:52:09', '2024-11-16 05:52:09', NULL),
(5, 'TS003', 'ANGEL', '2012-11-13', 'Son Off', 'sdfsdf', NULL, NULL, '+91', '5435345345', 'hosttesting@yopmail.com', '3543543', '23424234', NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '04783', '$2y$12$IimvguPZbSz6XaRpOqgdYup9GYJyvEOrEh4UlFhSd7NfA4yS6cDMq', NULL, NULL, NULL, 0, NULL, 0, '2024-11-16 06:32:42', '2024-11-16 06:32:42', NULL),
(6, 'TS004', 'UPDER SUPER', '2012-11-13', 'Son Off', 'sdsdg', NULL, NULL, '+91', '435345345', 'hosttesting@yopmail.com', '345345345', '4534534', NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '9876543210', '$2y$12$9aeP6NEktzJ7vts4JeMJmOQ2l0Y6rDJGLVDKjVwZ3qouNw3VTjc.G', NULL, NULL, NULL, 0, NULL, 0, '2024-11-16 06:35:42', '2024-11-16 06:35:42', NULL),
(7, 'TS005', 'Kiran', '2012-11-06', 'Son Off', 'jhgfdgfh', NULL, NULL, '+91', '7765445564', 'hosttesting@yopmail.com', '3543543', '23424234', NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '9876543210', '$2y$12$M5lYAOSEeFZqXhtzIRvvCuIOJJ6Q9kSlpgGbRzW/Apw4rPdzvYqgi', NULL, NULL, NULL, 0, NULL, 0, '2024-11-16 07:32:35', '2024-11-16 07:32:35', NULL),
(8, 'TS006', 'Prabjot', '2012-11-06', 'Son Off', 'Rajinder', NULL, NULL, '+91', '5675765753', 'hosttesting@yopmail.com', '3543543', NULL, NULL, NULL, NULL, NULL, 'California Road', 'United States', 'Stockholm', 'Maine', '9876543210', '$2y$12$pR17MN/zsvZxoRETaHVh5eq8VRPgaDJUBp7NV1qlkHGzsEblSHyQK', NULL, NULL, NULL, 0, NULL, 0, '2024-11-17 01:10:15', '2024-11-17 01:10:15', NULL);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `under_take_users`
--
ALTER TABLE `under_take_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
