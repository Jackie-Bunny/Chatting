-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 12:03 AM
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
-- Database: `chatify_messages`
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `sender_id` varchar(255) DEFAULT NULL,
  `reciever_id` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `message_file` varchar(255) DEFAULT NULL,
  `message_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `sender_id`, `reciever_id`, `message`, `message_file`, `message_time`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2', 'Hi ! hello james...', NULL, NULL, '0', '2024-05-08 01:17:47', '2024-05-08 01:17:47'),
(2, '2', '2', '1', 'Hi, heloo jimy. How are you doing today ?', NULL, NULL, '0', '2024-05-09 04:00:59', '2024-05-09 04:00:59'),
(3, '2', '2', '1', 'Yes what\'s going on buddy ?', NULL, NULL, '0', '2024-05-09 04:04:25', '2024-05-09 04:04:25'),
(4, '1', '1', '2', 'Nothing, just want to visit zoo today !', NULL, NULL, '0', '2024-05-09 04:53:07', '2024-05-09 04:53:07'),
(5, '1', '1', '2', 'Est sint quisquam u', NULL, NULL, '0', '2024-05-09 04:59:32', '2024-05-09 04:59:32'),
(6, '1', '1', '2', 'So, whats the plan tomorrow ?', NULL, NULL, '0', '2024-05-09 05:09:40', '2024-05-09 05:09:40'),
(7, '2', '2', '1', 'Hi, this is message for socket testing !', NULL, NULL, '0', '2024-05-09 05:19:07', '2024-05-09 05:19:07'),
(8, '1', '1', '2', 'Ok, but why are you testing this socket ?', NULL, NULL, '0', '2024-05-09 05:22:34', '2024-05-09 05:22:34'),
(9, '2', '2', '1', 'Just checking the real time messages !', NULL, NULL, '0', '2024-05-10 04:30:48', '2024-05-10 04:30:48'),
(10, '2', '2', '1', 'sdasd', NULL, NULL, '0', '2024-05-10 04:55:01', '2024-05-10 04:55:01'),
(11, '1', '1', '2', 'Hi Jimmy, how are you doing today ?', NULL, NULL, '0', '2024-05-10 05:01:40', '2024-05-10 05:01:40');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_06_230003_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `name`, `email`, `password`, `status`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, '1715037134.jpg', 'Jimy', 'jimy@gmail.com', '$2y$10$F58oCB2w1oyu/BFz1l4QSuNEfX8cr1Ump8SQbr8JwMMVZxCM6C9bC', '1', NULL, NULL, '2024-05-07 06:12:14', '2024-05-10 05:00:54'),
(2, '1715037131.jpg', 'James', 'james@gmail.com', '$2y$10$F58oCB2w1oyu/BFz1l4QSuNEfX8cr1Ump8SQbr8JwMMVZxCM6C9bC', '1', NULL, NULL, '2024-05-07 06:12:14', '2024-05-10 04:26:18');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `messages_message_unique` (`message`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
