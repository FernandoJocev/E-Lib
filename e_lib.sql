-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 04:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e\lib`
--

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
-- Table structure for table `master_data_buku`
--

CREATE TABLE `master_data_buku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jlh_halaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_buku` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_data_buku`
--

INSERT INTO `master_data_buku` (`id`, `nama_buku`, `jlh_halaman`, `cover_buku`, `penulis`, `penerbit`, `isbn`, `created_at`, `updated_at`) VALUES
(2, 'Buku 1', '100', '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IQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQAADgVGUIAABwqjIEAAA4VRkCAACcqgwBAABOVYYAAACnKkMAAIBTlSEAAMCpyhAAAOBUZQgAAHCqMgQAADhVGQIAAJyqDAEAAE5VhgAAAKcqQwAAgFOVIQAAwKnKEAAA4FRlCAAAcKoyBAAAOFUZAgAAnKoMAQAATlWGAAAApypDAACAU5UhAADAqcoQ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', 'Penulis', 'Penerbit', '123456789012', '2023-01-26 23:10:13', '2023-01-26 23:10:13');

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
(5, '2023_01_25_080837_create_master_data_buku_table', 1);

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
-- Indexes for table `master_data_buku`
--
ALTER TABLE `master_data_buku`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `master_data_buku`
--
ALTER TABLE `master_data_buku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
