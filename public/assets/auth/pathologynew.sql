-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 03:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pathologynew`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `study_name` varchar(255) NOT NULL,
  `study_description` text NOT NULL,
  `upload_date` date DEFAULT NULL,
  `study_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `result_url` varchar(1024) DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0->no, 1->yes',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0->no, 1->yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `study_name`, `study_description`, `upload_date`, `study_id`, `file_name`, `file_type_id`, `file_path`, `user_id`, `result_url`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'samplepathofiles', 'N/A', '2025-06-19', '3-190620253051', '3-190620253051-samplepathofiles_3051.webp', 1, 'public/patho/upload/slides/samplepathofiles_3051_3051/3-190620253051-samplepathofiles_3051.webp', 3, 'http://3.13.59.127/colo-s-l1/{z}/{x}/{y}.png', '1', '0', '2025-06-18 22:00:51', '2025-06-18 22:00:51'),
(2, 'samplepathofiles', 'N/A', '2025-06-19', '3-190620253051', '3-190620253051-samplepathofiles_3051.webp', 2, 'public/patho/upload/slides/samplepathofiles_3051_3051/3-190620253051-samplepathofiles_3051.webp', 3, 'http://3.13.59.127/colo-a-l1/{z}/{x}/{y}.png', '1', '0', '2025-06-18 22:00:51', '2025-06-18 22:00:51'),
(3, 'samplepathofiles_3224', 'N/A', '2025-06-19', '3-190620253224', '3-190620253224-samplepathofiles_3224.webp', 1, 'public/patho/upload/slides/samplepathofiles_3224_3224/3-190620253224-samplepathofiles_3224.webp', 3, NULL, '1', '0', '2025-06-18 22:02:24', '2025-06-18 22:02:24'),
(4, 'samplepathofiles_3224', 'N/A', '2025-06-19', '3-190620253224', '3-190620253224-samplepathofiles_3224.webp', 2, 'public/patho/upload/slides/samplepathofiles_3224_3224/3-190620253224-samplepathofiles_3224.webp', 3, NULL, '1', '0', '2025-06-18 22:02:24', '2025-06-18 22:02:24'),
(5, 'samplepathofiles_3456', 'N/A', '2025-06-22', '3-220620253456', '3-220620253456-samplepathofiles_3456.webp', 1, 'public/patho/upload/slides/samplepathofiles_3456/3-220620253456-samplepathofiles_3456.webp', 3, NULL, '1', '0', '2025-06-22 02:04:57', '2025-06-22 02:04:57'),
(6, 'samplepathofiles_3457', 'N/A', '2025-06-22', '3-220620253456', '3-220620253456-samplepathofiles_3457.webp', 2, 'public/patho/upload/slides/samplepathofiles_3457/3-220620253456-samplepathofiles_3457.webp', 3, NULL, '1', '0', '2025-06-22 02:04:57', '2025-06-22 02:04:57'),
(7, 'samplepathofiles_0753', 'N/A', '2025-06-22', '3-220620250753', '3-220620250753-samplepathofiles_0753.webp', 1, 'public/patho/upload/slides//samplepathofiles/3-220620250753-samplepathofiles_0753.webp', 3, NULL, '1', '0', '2025-06-22 05:37:55', '2025-06-22 05:37:55'),
(8, 'samplepathofiles_0753', 'N/A', '2025-06-22', '3-220620250753', '3-220620250753-samplepathofiles_0753.webp', 2, 'public/patho/upload/slides//samplepathofiles/3-220620250753-samplepathofiles_0753.webp', 3, NULL, '1', '0', '2025-06-22 05:37:55', '2025-06-22 05:37:55'),
(9, 'file1_4202', 'N/A', '2025-06-22', '3-220620254202', '3-220620254202-file1_4202.tiff', 1, 'public/patho/upload/slides//file1/3-220620254202-file1_4202.tiff', 3, NULL, '1', '0', '2025-06-22 07:12:08', '2025-06-22 07:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `file_jobs`
--

CREATE TABLE `file_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `study_id` varchar(255) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1->Pending, 2->Inprogress, 3->Completed, 4->Error',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_jobs`
--

INSERT INTO `file_jobs` (`id`, `user_id`, `study_id`, `status`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 3, '3-190620253051', '3', NULL, '2025-06-20 09:33:46', '2025-06-18 22:00:51', '2025-06-18 22:00:51'),
(2, 3, '3-190620253224', '1', NULL, NULL, '2025-06-18 22:02:24', '2025-06-18 22:02:24'),
(3, 3, '3-220620253456', '1', NULL, NULL, '2025-06-22 02:04:57', '2025-06-22 02:04:57'),
(4, 3, '3-220620250753', '1', NULL, NULL, '2025-06-22 05:37:53', '2025-06-22 05:37:53'),
(5, 3, '3-220620254202', '1', NULL, NULL, '2025-06-22 07:12:07', '2025-06-22 07:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `file_to_region_activity`
--

CREATE TABLE `file_to_region_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_coordination` varchar(255) NOT NULL,
  `date_created` date DEFAULT NULL,
  `action` enum('1','2') NOT NULL DEFAULT '1' COMMENT '01>Created, 1->Deleted',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_to_report`
--

CREATE TABLE `file_to_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `study_id` bigint(20) UNSIGNED DEFAULT NULL,
  `her2` varchar(255) NOT NULL,
  `ki67` varchar(255) NOT NULL,
  `er` varchar(255) NOT NULL,
  `pgr` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_types`
--

CREATE TABLE `file_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_types`
--

INSERT INTO `file_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'H&E', '', NULL, NULL),
(2, 'HER2', '', NULL, NULL),
(3, 'Ki-67', '', NULL, NULL),
(4, 'ER', '', NULL, NULL),
(5, 'PGR', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layers`
--

CREATE TABLE `layers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `study_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `geojson` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`geojson`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layers`
--

INSERT INTO `layers` (`id`, `study_id`, `name`, `geojson`, `created_at`, `updated_at`) VALUES
(2, '3-090620251029', 'layer 1', '\"{\\\"type\\\":\\\"Feature\\\",\\\"properties\\\":{},\\\"geometry\\\":{\\\"type\\\":\\\"Polygon\\\",\\\"coordinates\\\":[[[40.704997,-31.925781],[40.704997,-20.988281],[63.262737,-20.988281],[63.262737,-31.925781],[40.704997,-31.925781]]]}}\"', '2025-06-16 19:41:03', '2025-06-16 19:41:03'),
(3, '3-090620251322', 'new layer he', '\"{\\\"type\\\":\\\"Feature\\\",\\\"properties\\\":{},\\\"geometry\\\":{\\\"type\\\":\\\"Polygon\\\",\\\"coordinates\\\":[[[120.596141,-33.168945],[120.596141,-28.668945],[131.968763,-28.668945],[131.968763,-33.168945],[120.596141,-33.168945]]]}}\"', '2025-06-17 10:30:57', '2025-06-17 10:30:57'),
(4, '3-190620253051', 'layer save', '\"{\\\"type\\\":\\\"Feature\\\",\\\"properties\\\":{},\\\"geometry\\\":{\\\"type\\\":\\\"Polygon\\\",\\\"coordinates\\\":[[[131.289063,-30.061768],[131.289063,-28.815674],[133.613281,-28.815674],[133.613281,-30.061768],[131.289063,-30.061768]]]}}\"', '2025-06-22 07:03:56', '2025-06-22 07:03:56');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_13_025337_create_personal_access_tokens_table', 1),
(5, '2025_05_13_025337_create_sessions_table', 1),
(6, '2025_05_21_100530_create_file_types_table', 1),
(7, '2025_05_21_100531_create_file_table', 1),
(8, '2025_05_21_100532_create_file_jobs_table', 1),
(9, '2025_05_21_100532_create_user_credits_table', 1),
(10, '2025_05_21_100533_create_file_to_region_table', 1),
(11, '2025_05_21_100534_create_file_to_region_activity_table', 1),
(12, '2025_05_21_100534_create_file_to_report_table', 1),
(13, '2025_06_09_115658_create_layers_table', 1),
(14, '2025_06_15_115658_add_study_id_to_layer_table', 2),
(15, '2025_06_21_141419_create_password_resets_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ecvijay08@gmail.com', 'ZgLxajZRU8vjYGD7TmfxDQit4nNAiOEuQYEmBziQCRWRmLD6bG1LHLSSNLr8iIPN', '2025-06-22 08:05:20'),
('ecvijay08@gmail.com', 'JKmpo33alunNfFbGVVW9NYPzQSCUTSk8IiDe0yJyY8FGZsLiQJuAkI7cN7G9BnEJ', '2025-06-22 08:30:58');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_file_to_region`
--

CREATE TABLE `table_file_to_region` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_coordination` varchar(255) NOT NULL,
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_user_credits`
--

CREATE TABLE `table_user_credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_of_credits` bigint(20) UNSIGNED NOT NULL,
  `valid_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(20) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `profile_image_path` varchar(255) DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0->no, 1->yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `roles`, `remember_token`, `mobile`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `profile_image_path`, `active`, `created_at`, `updated_at`) VALUES
(3, 'vijay', 'range', 'ecvijay08@gmail.com', '2025-06-21 07:33:06', '$2y$12$67szG.u2C/rH3gTOTlvvJOzITrHN7A/XZRlK2dc8z2o5WcqOTNf9K', '', NULL, '9176066556', 'sddaf', 'r', 'ELIMBAH', 'Tamil Nadu', 'vijay', 'India', 'public/patho/profileImages/3-vijay.jpg', '1', '2025-05-08 03:46:12', '2025-06-21 07:33:06'),
(5, 'admin', NULL, 'admin@gmail.com', NULL, '$2y$12$K.cXChFjrlPLGokB/EtyS.TqYSIqw/A7s3ERLAt6ZqdlisE234zvu', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-05-08 13:39:27', '2025-05-08 13:39:27'),
(6, 'User', '2', 'user2@gmail.com', NULL, '$2y$12$PGCjIe1v9xjxQwsAAT9c6.HNASniwGXnL1SDeG4Ebgh78gvtSAPXO', 'consumers', NULL, '', '', '', '', '', '', '', NULL, '1', '2025-06-11 09:38:13', '2025-06-11 09:38:13'),
(8, 'Admin', '2', 'admin2@gmail.com', NULL, '$2y$12$RZKfCDrxdFQgt6i7Ohs3k.UGmCMXaxEszWhQ5GcybEruknxxn4VDK', 'consumers', NULL, '', '', '', '', '', '', '', NULL, '1', '2025-06-11 09:41:51', '2025-06-11 09:41:51'),
(9, 'User', '3', 'user3@gmail.com', NULL, '$2y$12$NAQ3BCvPOz/fnmiAIo8ake070ixy3ACq/GMEO.0DR5F7h0gAZhb2S', 'consumers', NULL, '', '', '', '', '', '', '', NULL, '0', '2025-06-11 09:43:00', '2025-06-11 10:27:01'),
(10, 'Admin', '3', 'admin3@gmail.com', NULL, '$2y$12$LGm1xLDyy9l39QqpSRJcJ.yr7S22znVUyaabOuJqh2E96BElCre5G', 'consumers', NULL, '', '', '', '', '', '', '', NULL, '0', '2025-06-11 09:43:46', '2025-06-11 10:26:50'),
(11, 'Vijay', NULL, 'vijay@gmail.com', NULL, '$2y$12$KWB8Bmp/o8KVwFom2RFLteW5DrfOABT4Rv1TsnnrVqOt1V/JLHvJu', 'consumers', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-06-20 10:36:24', '2025-06-20 10:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_study_id_file_type_id_unique` (`study_id`,`file_type_id`),
  ADD KEY `file_file_type_id_foreign` (`file_type_id`),
  ADD KEY `file_user_id_foreign` (`user_id`),
  ADD KEY `file_study_id_index` (`study_id`);

--
-- Indexes for table `file_jobs`
--
ALTER TABLE `file_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_jobs_study_id_unique` (`study_id`),
  ADD KEY `file_jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `file_to_region_activity`
--
ALTER TABLE `file_to_region_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_to_region_activity_file_id_foreign` (`file_id`),
  ADD KEY `file_to_region_activity_user_id_foreign` (`user_id`);

--
-- Indexes for table `file_to_report`
--
ALTER TABLE `file_to_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_types`
--
ALTER TABLE `file_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layers`
--
ALTER TABLE `layers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `layers_study_id_unique` (`study_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_file_to_region`
--
ALTER TABLE `table_file_to_region`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_file_to_region_sequence_unique` (`sequence`),
  ADD KEY `table_file_to_region_file_id_foreign` (`file_id`);

--
-- Indexes for table `table_user_credits`
--
ALTER TABLE `table_user_credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_user_credits_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `file_jobs`
--
ALTER TABLE `file_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file_to_region_activity`
--
ALTER TABLE `file_to_region_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_to_report`
--
ALTER TABLE `file_to_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_types`
--
ALTER TABLE `file_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `layers`
--
ALTER TABLE `layers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_file_to_region`
--
ALTER TABLE `table_file_to_region`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_user_credits`
--
ALTER TABLE `table_user_credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_file_type_id_foreign` FOREIGN KEY (`file_type_id`) REFERENCES `file_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `file_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `file_jobs`
--
ALTER TABLE `file_jobs`
  ADD CONSTRAINT `file_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `file_to_region_activity`
--
ALTER TABLE `file_to_region_activity`
  ADD CONSTRAINT `file_to_region_activity_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `file_to_region_activity_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_file_to_region`
--
ALTER TABLE `table_file_to_region`
  ADD CONSTRAINT `table_file_to_region_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_user_credits`
--
ALTER TABLE `table_user_credits`
  ADD CONSTRAINT `table_user_credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
