-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 02:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengajuan_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`, `created_at`, `updated_at`) VALUES
('a001', 'buku', 4000, NULL, NULL),
('a002', 'pensil', 2500, NULL, NULL),
('a003', 'lakban', 7000, NULL, NULL),
('a004', 'pulpen', 5000, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_08_030541_create_roles_table', 1),
(6, '2024_02_08_030734_add_role_id_column_to_users_table', 1),
(8, '2024_02_08_115646_create_barang_table', 2),
(9, '2024_02_08_130808_create_transaksi_table', 3),
(11, '2024_02_08_132805_create_transaksi_item_table', 4),
(14, '2024_02_10_013202_add_status_column_to_transaksi', 5),
(15, '2024_02_10_225256_add_alasan_penolakan_manager_column_to_transaksi', 5),
(16, '2024_02_11_125122_add_status_from_finance_column_to_transaksi_table', 6),
(17, '2024_02_11_125553_add_alasan_penolakan_finance_column_to_transaksi_table', 6),
(20, '2024_02_11_162036_edit_total_harga_column_on_transaksi_table', 7),
(21, '2024_02_12_023048_add_image_column_to_transaksi_table', 7);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'officer', NULL, NULL),
(2, 'manager', NULL, NULL),
(3, 'finance', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pengajuan` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_from_manager` varchar(255) DEFAULT NULL,
  `alasan_penolakan_manager` varchar(255) DEFAULT NULL,
  `status_from_finance` varchar(255) DEFAULT NULL,
  `alasan_penolakan_finance` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_pengajuan`, `user_id`, `total_harga`, `created_at`, `updated_at`, `status_from_manager`, `alasan_penolakan_manager`, `status_from_finance`, `alasan_penolakan_finance`, `image`) VALUES
(1, '001', 1, 15000, NULL, '2024-02-11 22:18:03', 'diterima', NULL, 'diterima', NULL, '-1707715083.PNG'),
(2, '002', 1, 19000, NULL, '2024-02-11 05:44:57', 'ditolak', 'cash perusahaan bermasalah', NULL, NULL, NULL),
(3, '003', 1, 4000, NULL, '2024-02-11 06:14:49', 'diterima', NULL, 'ditolak', 'pengajuan tidak dipelukan karena barang masih tersedia', NULL),
(4, '004', 1, 50000, NULL, '2024-02-12 00:17:31', 'diterima', NULL, 'diterima', NULL, 'img1707722251.jpg'),
(5, '005', 1, 35000, NULL, '2024-02-11 18:24:00', 'diterima', NULL, 'diterima', NULL, NULL),
(6, '006', 1, 75000, NULL, '2024-02-11 18:12:57', 'ditolak', 'barang masih belum diperlukan', NULL, NULL, NULL),
(7, '007', 1, 37000, '2024-02-11 10:22:34', '2024-02-12 00:17:50', 'diterima', NULL, 'diterima', NULL, 'img1707722270.jpg'),
(8, '008', 1, 264000, '2024-02-11 12:45:36', '2024-02-11 18:13:25', 'ditolak', 'kabutuhan tidak sesuai', NULL, NULL, NULL),
(9, '009', 1, 178000, '2024-02-11 12:46:37', '2024-02-11 18:24:31', 'diterima', NULL, 'ditolak', 'cash perusahaan bermasalah', NULL),
(10, '010', 1, 16500, '2024-02-11 18:27:13', '2024-02-11 18:28:22', 'ditolak', 'kebutuhan tidak sesuai', NULL, NULL, NULL),
(11, '011', 1, 33000, '2024-02-11 18:29:25', '2024-02-11 18:32:10', 'diterima', NULL, 'ditolak', 'rekening perusahaan bermasalah', NULL),
(12, '012', 1, 25000, '2024-02-11 18:35:16', '2024-02-11 18:36:38', 'diterima', NULL, 'diterima', NULL, NULL),
(13, '013', 1, 125000, '2024-02-11 19:41:59', '2024-02-12 05:12:38', 'diterima', NULL, 'diterima', NULL, NULL),
(14, '014', 1, 100000, '2024-02-12 01:52:13', '2024-02-12 05:13:17', 'diterima', '', 'diterima', NULL, NULL),
(23, '015', 1, 476000, '2024-02-12 05:19:01', '2024-02-12 05:19:01', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_item`
--

CREATE TABLE `transaksi_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_item` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_item`
--

INSERT INTO `transaksi_item` (`id`, `id_transaksi`, `id_item`, `nama_barang`, `harga`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'a001', 'buku', 4000, 2, NULL, NULL),
(2, 1, 'a003', 'lakban', 7000, 1, NULL, NULL),
(3, 2, 'a001', 'buku', 4000, 3, NULL, NULL),
(4, 2, 'a003', 'lakban', 7000, 1, NULL, NULL),
(5, 3, 'a001', 'buku', 4000, 1, NULL, NULL),
(6, 4, 'a004', 'pulpen', 5000, 10, NULL, NULL),
(7, 5, 'a003', 'lakban', 7000, 5, NULL, NULL),
(8, 6, 'a004', 'pulpen', 5000, 10, NULL, NULL),
(9, 6, 'a002', 'pensil', 2500, 10, NULL, NULL),
(10, 7, 'a001', 'buku', 4000, 4, '2024-02-11 11:45:10', '2024-02-11 11:45:10'),
(11, 7, 'a003', 'lakban', 7000, 3, '2024-02-11 11:45:10', '2024-02-11 11:45:10'),
(12, 8, 'a002', 'pensil', 2500, 100, '2024-02-11 12:45:36', '2024-02-11 12:45:36'),
(13, 8, 'a003', 'lakban', 7000, 2, '2024-02-11 12:45:36', '2024-02-11 12:45:36'),
(14, 9, 'a001', 'buku', 4000, 12, '2024-02-11 12:46:37', '2024-02-11 12:46:37'),
(15, 9, 'a002', 'pensil', 2500, 52, '2024-02-11 12:46:37', '2024-02-11 12:46:37'),
(16, 10, 'a002', 'pensil', 2500, 1, '2024-02-11 18:27:13', '2024-02-11 18:27:13'),
(17, 10, 'a003', 'lakban', 7000, 2, '2024-02-11 18:27:13', '2024-02-11 18:27:13'),
(18, 11, 'a001', 'buku', 4000, 3, '2024-02-11 18:29:25', '2024-02-11 18:29:25'),
(19, 11, 'a003', 'lakban', 7000, 3, '2024-02-11 18:29:25', '2024-02-11 18:29:25'),
(20, 12, 'a004', 'pulpen', 5000, 5, '2024-02-11 18:35:16', '2024-02-11 18:35:16'),
(21, 13, 'a002', 'pensil', 2500, 50, '2024-02-11 19:41:59', '2024-02-11 19:41:59'),
(22, 14, 'a004', 'pulpen', 5000, 20, '2024-02-12 01:52:13', '2024-02-12 01:52:13'),
(33, 23, 'a003', 'lakban', 7000, 68, '2024-02-12 05:19:01', '2024-02-12 05:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'officer_1', 'officer@gmail.com', 1, NULL, '$2y$10$lF9RRPcX9XiAhMk2e.1DTePriOzDOEUizJERR1QHZpLX4DepeMGdm', NULL, NULL, NULL),
(2, 'manager_1', 'manager@gmail.com', 2, NULL, '$2y$10$qUKp7GIMqMnbLhBu.mMlL.BkZImlQNokW6878DRCMMqATNe2wDQYm', NULL, NULL, NULL),
(3, 'finance_1', 'finance@gmail.com', 3, NULL, '$2y$10$a268V1roDSTHRefXQkIm9.LvcOM/XaFQLoxlxATzxwwO9e5PIXvI6', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_kode_pengajuan_unique` (`kode_pengajuan`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_item_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD CONSTRAINT `transaksi_item_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
