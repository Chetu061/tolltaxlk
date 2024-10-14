-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 12:59 PM
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
-- Database: `tax`
--

-- --------------------------------------------------------

--
-- Table structure for table `axes`
--

CREATE TABLE `axes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `axelno` varchar(255) DEFAULT NULL,
  `deletestatus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax_rate` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `axes`
--

INSERT INTO `axes` (`id`, `axelno`, `deletestatus`, `created_at`, `updated_at`, `tax_rate`) VALUES
(5, '54', 1, '2024-10-01 11:59:52', '2024-10-01 11:59:52', 10.00),
(6, '85', 1, '2024-10-01 12:00:46', '2024-10-01 12:00:46', 15.00);

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
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `deletestatus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `city`, `deletestatus`, `created_at`, `updated_at`, `latitude`, `longitude`) VALUES
(9, 'Nagpur', 1, '2024-10-01 11:40:55', '2024-10-01 11:40:55', 21.14663300, 79.08886000),
(10, 'Kolkata', 1, '2024-10-01 11:41:25', '2024-10-01 11:41:25', 22.57264500, 88.36389200);

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
(5, '2024_10_01_104507_create_tolls_table', 2),
(6, '2024_10_01_121718_create_locations_table', 3),
(7, '2024_10_01_121817_create_axes_table', 3),
(8, '2024_10_01_161901_add_distance_to_tolls_table', 4),
(9, '2024_10_01_162630_add_latitude_longitude_to_locations_table', 5),
(10, '2024_10_01_164848_create_tolls_table', 6),
(11, '2024_10_01_172339_add_tax_rate_to_axes_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `newtolls`
--

CREATE TABLE `newtolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `axel_no` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newtolls`
--

INSERT INTO `newtolls` (`id`, `from`, `to`, `axel_no`, `total`, `created_at`, `updated_at`) VALUES
(13, '9', '10', 85, 300.00, '2024-10-02 04:43:52', '2024-10-02 05:03:10'),
(14, '9', '10', 54, 1600.00, '2024-10-02 04:44:12', '2024-10-02 05:21:04');

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
-- Table structure for table `relatedtolls`
--

CREATE TABLE `relatedtolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `newtoll_id` varchar(255) NOT NULL,
  `tollname` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relatedtolls`
--

INSERT INTO `relatedtolls` (`id`, `newtoll_id`, `tollname`, `price`, `created_at`, `updated_at`) VALUES
(25, '10', 'kolkata', 300.00, '2024-10-02 04:00:13', '2024-10-02 04:00:13'),
(26, '11', 'kolkata', 300.00, '2024-10-02 04:38:07', '2024-10-02 04:38:07'),
(27, '11', 'birbhum', 600.00, '2024-10-02 04:38:07', '2024-10-02 04:38:07'),
(38, '13', 'kolkata', 300.00, '2024-10-02 05:03:10', '2024-10-02 05:03:10'),
(40, '14', 'kolkata', 500.00, '2024-10-02 05:21:04', '2024-10-02 05:21:04'),
(41, '14', 'bankura', 600.00, '2024-10-02 05:21:04', '2024-10-02 05:21:04'),
(42, '14', 'medinipur', 500.00, '2024-10-02 05:21:04', '2024-10-02 05:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `tolls`
--

CREATE TABLE `tolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `carno` varchar(255) NOT NULL,
  `aadhar` varchar(255) NOT NULL,
  `intime` time NOT NULL,
  `outtime` time NOT NULL,
  `from` bigint(20) UNSIGNED NOT NULL,
  `to` bigint(20) UNSIGNED NOT NULL,
  `axeid1` bigint(100) DEFAULT NULL,
  `axeid` bigint(20) UNSIGNED DEFAULT NULL,
  `total_tax` varchar(255) DEFAULT NULL,
  `distance_km` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tolls`
--

INSERT INTO `tolls` (`id`, `carno`, `aadhar`, `intime`, `outtime`, `from`, `to`, `axeid1`, `axeid`, `total_tax`, `distance_km`, `tax`, `created_at`, `updated_at`) VALUES
(18, '89', '54545454545', '17:52:00', '15:56:00', 9, 10, 54, NULL, '1600.00', 970.05, 0.00, '2024-10-02 04:53:32', '2024-10-02 05:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `contact`, `photo`, `city`, `gender`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'priti', 'priti@gmail.com', NULL, '$2y$12$//H7pi4MK30/7rgjnUFZ6u.hUdUXwZYchKCU976X6TX3sxn3MaQUe', NULL, NULL, NULL, NULL, NULL, 'user', 'Nu4t0cxmqJj5Mft4i9vlnNzQi0rkKZ3rj6lp1J2QhPtzO1IdU2paUcd09t5A', '2024-10-01 02:58:48', '2024-10-01 02:58:48'),
(2, 'priyanka', 'priyankaa@gmail.com', NULL, '$2y$12$gv1X8y6z1OZYO35hX07YPemHqYdDyxP040bPYK6S5utAZpTCmntx.', NULL, '7798285032', '202410010946download.jpg', NULL, NULL, 'user', NULL, '2024-10-01 03:49:57', '2024-10-01 04:16:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `axes`
--
ALTER TABLE `axes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_city_unique` (`city`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newtolls`
--
ALTER TABLE `newtolls`
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
-- Indexes for table `relatedtolls`
--
ALTER TABLE `relatedtolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tolls`
--
ALTER TABLE `tolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tolls_from_foreign` (`from`),
  ADD KEY `tolls_to_foreign` (`to`),
  ADD KEY `tolls_axeid_foreign` (`axeid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `axes`
--
ALTER TABLE `axes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `newtolls`
--
ALTER TABLE `newtolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relatedtolls`
--
ALTER TABLE `relatedtolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tolls`
--
ALTER TABLE `tolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tolls`
--
ALTER TABLE `tolls`
  ADD CONSTRAINT `tolls_axeid_foreign` FOREIGN KEY (`axeid`) REFERENCES `axes` (`id`),
  ADD CONSTRAINT `tolls_from_foreign` FOREIGN KEY (`from`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `tolls_to_foreign` FOREIGN KEY (`to`) REFERENCES `locations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
