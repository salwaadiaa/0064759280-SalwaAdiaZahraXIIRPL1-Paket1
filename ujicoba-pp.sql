-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2024 at 03:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujicoba-pp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`buku_id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `gambar`, `created_at`, `updated_at`, `kategori_id`) VALUES
('BUKU-0001', 'Galaxy', 'Poppy Pertiwi', 'Coconut Books', 2021, '1705238508.jfif', '2024-01-14 06:21:48', '2024-01-14 06:21:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_bukus`
--

CREATE TABLE `kategori_bukus` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_bukus`
--

INSERT INTO `kategori_bukus` (`kategori_id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2024-01-14 01:37:08', '2024-01-14 07:44:20'),
(2, 'Majalah', '2024-01-14 01:37:19', '2024-01-14 01:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku_relasis`
--

CREATE TABLE `kategori_buku_relasis` (
  `kategoribuku_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadis`
--

CREATE TABLE `koleksi_pribadis` (
  `koleksi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(189, '2014_10_12_000000_create_users_table', 1),
(190, '2014_10_12_100000_create_password_resets_table', 1),
(191, '2019_08_19_000000_create_failed_jobs_table', 1),
(192, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(193, '2024_01_14_060849_create_bukus_table', 1),
(194, '2024_01_14_061504_create_koleksi_pribadis_table', 1),
(195, '2024_01_14_063700_create_peminjamen_table', 1),
(196, '2024_01_14_064348_create_ulasan_bukus_table', 1),
(197, '2024_01_14_064951_create_kategori_bukus_table', 1),
(198, '2024_01_14_065415_create_kategori_buku_relasis_table', 1),
(199, '2024_01_14_083426_add_kategori_id_to_bukus', 1);

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
-- Table structure for table `peminjamen`
--

CREATE TABLE `peminjamen` (
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` enum('Diajukan','Dipinjam','Sudah Kembali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Diajukan',
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamen`
--

INSERT INTO `peminjamen` (`peminjaman_id`, `user_id`, `buku_id`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `denda`, `created_at`, `updated_at`) VALUES
(1, 'US-0003', 'BUKU-0001', '2024-01-14', '2024-01-28', 'Sudah Kembali', '260000.00', '2024-01-14 06:36:12', '2024-01-14 06:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_bukus`
--

CREATE TABLE `ulasan_bukus` (
  `ulasan_id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `peminjaman_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan_bukus`
--

INSERT INTO `ulasan_bukus` (`ulasan_id`, `user_id`, `buku_id`, `ulasan`, `rating`, `peminjaman_id`, `created_at`, `updated_at`) VALUES
(1, 'US-0003', 'BUKU-0001', 'cakep', 1, 1, '2024-01-14 07:33:58', '2024-01-14 07:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','petugas','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `alamat`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `avatar`, `created_at`, `updated_at`) VALUES
('A001', 'admin', 'admin', 'rumah', 'admin@mail.com', NULL, '$2y$10$e6Oh8Ie258Ft8Fo.9c1sh.mEGtf4gWpBu1ORuILdnRimBKHcmfQ.m', NULL, 'admin', 'avatar.png', NULL, NULL),
('P001', 'petugas', 'petugas', 'rumah', 'user@mail.com', NULL, '$2y$10$tenCkDsEy/vpEI3M.tRBXO25dNk9MOCGjsiqcZAalG5rvVhrzPuhi', NULL, 'petugas', 'avatar.png', NULL, NULL),
('US-0003', 'salwa', 'salwa zhr', 'tajur', 'salwa@gmail.com', NULL, '$2y$10$aTeoJ6ioGKQ0K8EyiH8OJOkE12sgIszM/OQqysTxbPXOi5kCWgu0q', NULL, 'user', 'avatar.png', '2024-01-14 06:29:21', '2024-01-14 06:29:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `bukus_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  ADD PRIMARY KEY (`kategoribuku_id`),
  ADD KEY `kategori_buku_relasis_kategori_id_foreign` (`kategori_id`),
  ADD KEY `kategori_buku_relasis_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD PRIMARY KEY (`koleksi_id`),
  ADD KEY `koleksi_pribadis_user_id_foreign` (`user_id`),
  ADD KEY `koleksi_pribadis_buku_id_foreign` (`buku_id`);

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
-- Indexes for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD PRIMARY KEY (`peminjaman_id`),
  ADD KEY `peminjamen_user_id_foreign` (`user_id`),
  ADD KEY `peminjamen_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  ADD PRIMARY KEY (`ulasan_id`),
  ADD KEY `ulasan_bukus_user_id_foreign` (`user_id`),
  ADD KEY `ulasan_bukus_buku_id_foreign` (`buku_id`),
  ADD KEY `ulasan_bukus_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  MODIFY `kategoribuku_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  MODIFY `koleksi_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `peminjamen`
--
ALTER TABLE `peminjamen`
  MODIFY `peminjaman_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  MODIFY `ulasan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_bukus` (`kategori_id`);

--
-- Constraints for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  ADD CONSTRAINT `kategori_buku_relasis_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kategori_buku_relasis_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_bukus` (`kategori_id`) ON DELETE CASCADE;

--
-- Constraints for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD CONSTRAINT `koleksi_pribadis_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `koleksi_pribadis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD CONSTRAINT `peminjamen_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  ADD CONSTRAINT `ulasan_bukus_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_bukus_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamen` (`peminjaman_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ulasan_bukus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
