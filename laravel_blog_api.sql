-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221207.ce5ce76a8d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 06:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_blog_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_description`, `long_description`, `image`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Sports', 'Explore the strategies and stories that redefine the world of sports, uncovering the secrets of athletic prowess.', 'Delve into the world of sports excellence as we unravel the strategies, dedication, and innovations that propel athletes to greatness. From legendary comebacks to the science behind peak performance, this blog celebrates the dynamic and inspiring world of sports.', '1701799729.jpg', 7, 5, '2023-12-05 12:38:49', '2023-12-06 12:48:21'),
(2, 'Science', 'Journey into the fascinating realm of science, where everyday phenomena become extraordinary wonders.', 'Unlock the mysteries of the universe through the lens of everyday wonders. This blog explores the marvels of science, from the intricacies of the natural world to groundbreaking discoveries in various scientific disciplines. Join us on a journey of curiosity and exploration.', '1701800040.jpg', 7, 2, '2023-12-05 12:44:00', '2023-12-05 12:44:00'),
(3, 'Politics', 'Gain valuable insights into global affairs and political landscapes, exploring the forces shaping our collective future.', 'Navigate the complex world of politics with a critical lens on global affairs. This blog offers in-depth analyses, thought-provoking commentary, and interviews with key figures, providing a nuanced understanding of the political forces that shape our world.', '1701800096.jpg', 7, 3, '2023-12-05 12:44:56', '2023-12-05 12:44:56'),
(4, 'Entertainment', 'Dive into the world of entertainment beyond the screen, from the latest trends to the timeless classics.', 'Immerse yourself in the vast and dynamic world of entertainment. From film and television to music, gaming, and beyond, this blog offers a comprehensive exploration of cultural phenomena, emerging trends, and the timeless classics that captivate audiences worldwide.', '1701800153.jpg', 7, 5, '2023-12-05 12:45:53', '2023-12-05 12:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_likes`
--

INSERT INTO `blog_likes` (`id`, `user_id`, `blog_id`, `created_at`, `updated_at`) VALUES
(3, 7, 1, '2023-12-06 13:10:39', '2023-12-06 13:10:39'),
(4, 7, 4, '2023-12-06 13:12:06', '2023-12-06 13:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sports', 'Sports', 1, '2023-12-05 11:12:48', '2023-12-05 12:29:08'),
(2, 'Science', 'Science', 1, '2023-12-05 11:13:52', '2023-12-05 11:13:52'),
(3, 'Politices', 'Politices', 1, '2023-12-05 11:16:30', '2023-12-05 12:02:41'),
(5, 'Entertainment', 'Entertainment', 1, '2023-12-05 12:06:17', '2023-12-05 12:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `user_id`, `blog_id`, `created_at`, `updated_at`) VALUES
(1, 'something that you say or write that expresses your opinion: I don\'t want any comments on/about my new haircut, thank you! He made negative comments to the press. I suppose his criticism was fair comment (= a reasonable opinion). She was asked about the pay increase but made no comment (= did not give an opinion).', 7, 3, '2023-12-07 11:38:47', '2023-12-07 12:13:19'),
(2, 'The phrase \"give some comments\" is correct and usable in written English. It can be used when you would like to ask someone to provide feedback or opinions ...', 7, 1, '2023-12-07 11:41:58', '2023-12-07 11:41:58'),
(3, 'The phrase \"give some comments\" is correct and usable in written English. It can be used when you would like to ask someone to provide feedback or opinions ...', 7, 2, '2023-12-07 11:42:09', '2023-12-07 11:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2021_07_24_082740_create_categories_table', 1),
(6, '2021_07_24_082805_create_blogs_table', 1),
(7, '2021_08_04_084703_create_comments_table', 1),
(8, '2021_08_10_030016_create_blog_likes_table', 1),
(9, '2021_08_18_145215_add_some_columns_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth-token', 'f58874ee961ccd3d27f7c942b617173bd1806398c95cf8589ec2a36629c01614', '[\"*\"]', NULL, '2023-12-01 10:24:29', '2023-12-01 10:24:29'),
(2, 'App\\Models\\User', 1, 'auth-token', 'edbf2b11752a442e235d6f6130eba258dc36665a892ff8ecaec1985c0a994728', '[\"*\"]', NULL, '2023-12-01 10:24:46', '2023-12-01 10:24:46'),
(4, 'App\\Models\\User', 1, 'auth-token', '3791004198aa27fe63808dbd4141f0ba7d155373faa2cc26e61a1962b013174b', '[\"*\"]', '2023-12-01 10:36:07', '2023-12-01 10:35:51', '2023-12-01 10:36:07'),
(6, 'App\\Models\\User', 7, 'auth-token', 'fa43697299dd4c0ea5c169646f03334fc2d66373fa9228fc341fa4631c2c0484', '[\"*\"]', NULL, '2023-12-03 13:34:10', '2023-12-03 13:34:10'),
(7, 'App\\Models\\User', 7, 'auth-token', '16bae7dfd21b95d76c9170378310d19a5a3a87c7264556fd3ac8f553615ff31f', '[\"*\"]', NULL, '2023-12-03 13:34:41', '2023-12-03 13:34:41'),
(8, 'App\\Models\\User', 7, 'auth-token', '384c0437038e08f9a1004e639ddc1c1d8c9eab480cd4e0a4d063c1dc7a002f23', '[\"*\"]', NULL, '2023-12-03 13:35:45', '2023-12-03 13:35:45'),
(9, 'App\\Models\\User', 7, 'auth-token', '0e4647dde381290249072b3a936b0f6b629c19173c86299681fb626d550d01ff', '[\"*\"]', NULL, '2023-12-03 13:37:20', '2023-12-03 13:37:20'),
(10, 'App\\Models\\User', 7, 'auth-token', 'bf7c16d9eed1a620bcfe6670711c2ea00cb3fe27057256b52d6f910e0b3ffb76', '[\"*\"]', NULL, '2023-12-03 13:38:04', '2023-12-03 13:38:04'),
(11, 'App\\Models\\User', 7, 'auth-token', '5f539ea7304bf559cbb6d7d6fe359e8be332250933580b4271e00dfa9677eba9', '[\"*\"]', NULL, '2023-12-03 13:38:29', '2023-12-03 13:38:29'),
(12, 'App\\Models\\User', 7, 'auth-token', 'cac059c419ad134e5b810fb595ec63500e7524e7a7c0b8eb7eff0c684a112d49', '[\"*\"]', NULL, '2023-12-03 13:39:50', '2023-12-03 13:39:50'),
(13, 'App\\Models\\User', 7, 'auth-token', '7ab7f66fd1cb50fa0c2d62f5a85ba9e77a636d763eba335ca661b4b39a426d8a', '[\"*\"]', NULL, '2023-12-03 13:40:34', '2023-12-03 13:40:34'),
(14, 'App\\Models\\User', 7, 'auth-token', '2ac4715c3fda8c85b7a8a4b2a0af411587c8ca9b5ac3a17685e6436f275fb840', '[\"*\"]', NULL, '2023-12-03 13:41:08', '2023-12-03 13:41:08'),
(15, 'App\\Models\\User', 7, 'auth-token', 'e25239036b4ba3174eac967ee8f1303ee38d085f42aa0478e6f25211cfa4910d', '[\"*\"]', NULL, '2023-12-03 13:41:27', '2023-12-03 13:41:27'),
(19, 'App\\Models\\User', 7, 'auth-token', '2c88b501b3f82679948096c8a75b064d4af36d19a3736687ea49d4632d0c0cc7', '[\"*\"]', '2023-12-03 14:11:06', '2023-12-03 14:00:10', '2023-12-03 14:11:06'),
(21, 'App\\Models\\User', 7, 'auth-token', '4186e721f3f337d3b6b80c9877874e75d9fe3b4bd4a388d3f7ea854afccdbe37', '[\"*\"]', '2023-12-05 12:45:53', '2023-12-04 11:53:31', '2023-12-05 12:45:53'),
(22, 'App\\Models\\User', 7, 'auth-token', '0ab879662a5fe47feeae57a3c01fe95683b250e84c69fb72072fa649cf7553d5', '[\"*\"]', NULL, '2023-12-04 13:33:55', '2023-12-04 13:33:55'),
(23, 'App\\Models\\User', 7, 'auth-token', '02f4f13671a0a18765dfccf640d420c3b789a16e14b514740397860e72539858', '[\"*\"]', '2023-12-08 10:08:03', '2023-12-05 13:03:39', '2023-12-08 10:08:03'),
(24, 'App\\Models\\User', 7, 'auth-token', 'ad2becb408af67ddceea4e0c9dc1b12fe3e05c3edf6d52d3e39af58e44409234', '[\"*\"]', NULL, '2023-12-07 12:55:02', '2023-12-07 12:55:02'),
(25, 'App\\Models\\User', 7, 'auth-token', 'bb12c4da7ff8b02ef8b7dc42d48154a1e397ad53d1f8433731499a7760bed0ca', '[\"*\"]', '2023-12-08 10:14:56', '2023-12-08 10:08:17', '2023-12-08 10:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_photo`, `profession`) VALUES
(7, 'Abulqasim', 'abulqasim@gmail.com', NULL, '$2y$10$J6KNYLzwMDEe0w4LDcQ.t.w6wn/m9TcAHMT614/LgXXQbXqUa5tVO', NULL, '2023-12-03 13:11:49', '2023-12-08 10:12:02', NULL, NULL),
(8, 'Ram', 'ram@gmail.com', NULL, '$2y$10$ret.HaySRLze1slQx88N8.P6dfestFmNNSXxCAT/OWhrS/Yb/5yZK', NULL, '2023-12-05 13:01:51', '2023-12-05 13:01:51', NULL, 'Web Dev\'s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_likes_user_id_foreign` (`user_id`),
  ADD KEY `blog_likes_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_blog_id_foreign` (`blog_id`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD CONSTRAINT `blog_likes_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
