-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 03:22 AM
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
-- Database: `eratrans`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_mobil` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id`, `jenis_mobil`, `created_at`, `updated_at`) VALUES
(1, 'Manual', '2025-12-21 04:10:34', '2025-12-21 04:10:34'),
(2, 'Matic', '2025-12-21 04:10:40', '2025-12-21 04:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id`, `nama`, `alamat`, `no_telp`, `no_rek`, `created_at`, `updated_at`) VALUES
(1, 'Eratrans', 'Komplek Ruko Grand City Regency, Jl. Rungkut Madya B-21, Central Rungkut, Gunung Anyar, Surabaya', '0811311190', '0000001', '2025-12-21 04:39:00', '2025-12-21 04:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `merek_mobil`
--

CREATE TABLE `merek_mobil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merek_mobil` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merek_mobil`
--

INSERT INTO `merek_mobil` (`id`, `merek_mobil`, `created_at`, `updated_at`) VALUES
(1, 'Honda', '2025-12-21 04:16:21', '2025-12-21 04:16:21'),
(2, 'Toyota', '2025-12-21 04:16:25', '2025-12-21 04:16:25'),
(3, 'Suzuki', '2025-12-21 04:16:29', '2025-12-21 04:16:29'),
(4, 'Daihatsu', '2025-12-21 04:16:33', '2025-12-21 04:16:33');

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
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_06_07_143814_create_roles_table', 1),
(5, '2024_06_07_144337_create_profile_table', 1),
(6, '2024_06_07_144406_add_column_role_id_to_users_table', 1),
(7, '2024_06_07_144447_create_kantor_table', 1),
(8, '2024_06_07_144530_create_jenis_mobil_table', 1),
(9, '2024_06_07_144605_create_merek_mobil_table', 1),
(10, '2024_06_07_144622_create_mobil_table', 1),
(11, '2024_06_07_144807_create_supir_table', 1),
(12, '2024_06_07_144827_add_column_to_mobil_table', 1),
(13, '2024_06_07_144847_create_pesanan_table', 1),
(14, '2024_06_07_145025_add_column_no_telp_to_kantor_table', 1),
(15, '2024_06_07_145044_create_transaksi_pembayaran_table', 1),
(16, '2024_06_07_145105_add_column_status_bayar_to_pesanan_table', 1),
(17, '2024_06_07_145130_create_pengembalian_table', 1),
(18, '2024_06_07_145153_add_column_status_mobil_to_mobil_table', 1),
(19, '2024_06_07_145210_add_column_status_supir_to_supir_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mobil` varchar(255) NOT NULL,
  `merek_mobil_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_mobil_id` bigint(20) UNSIGNED NOT NULL,
  `no_polisi` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `tahun_mobil` varchar(4) NOT NULL,
  `harga_per_hari` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status_mobil` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga_dengan_supir` int(11) NOT NULL,
  `kecepatan` varchar(255) NOT NULL,
  `bahan_bakar` varchar(255) NOT NULL,
  `ac` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id`, `nama_mobil`, `merek_mobil_id`, `jenis_mobil_id`, `no_polisi`, `warna`, `jumlah_penumpang`, `tahun_mobil`, `harga_per_hari`, `foto`, `status_mobil`, `created_at`, `updated_at`, `harga_dengan_supir`, `kecepatan`, `bahan_bakar`, `ac`) VALUES
(1, 'Ayla', 2, 2, 'W 854 BL', 'Putih', 4, '2019', 300000, '1766315905.png', 0, '2025-12-21 04:18:25', '2025-12-21 04:18:25', 350000, 'Matic', 'Bensin', 'YA'),
(3, 'Brio', 1, 2, 'W 233 BO', 'Putih', 4, '2019', 325000, '1766316276.png', 0, '2025-12-21 04:24:36', '2025-12-21 04:27:05', 400000, 'Matic', 'Bensin', 'YA'),
(4, 'Xenia', 4, 2, 'W 156 WB', 'Putih', 6, '2019', 325000, '1766316504.png', 0, '2025-12-21 04:28:24', '2025-12-21 04:28:24', 400000, 'Matic', 'Bensin', 'YA'),
(5, 'Karimun', 3, 1, 'W 709 WB', 'Hijau', 4, '2017', 300000, '1766316590.png', 0, '2025-12-21 04:29:50', '2025-12-21 04:29:50', 350000, 'Manual', 'Bensin', 'YA'),
(6, 'Agya', 2, 2, 'L 965 BO', 'Kuning', 4, '2019', 325000, '1766316662.png', 0, '2025-12-21 04:31:02', '2025-12-21 04:49:49', 400000, 'Matic', 'Bensin', 'YA'),
(7, 'Calya', 2, 2, 'W 268 WB', 'Putih', 6, '2019', 325000, '1766316758.png', 0, '2025-12-21 04:32:38', '2025-12-21 04:32:38', 400000, 'Matic', 'Bensin', 'YA'),
(8, 'Sienta', 2, 2, 'W 632 KY', 'Putih', 6, '2018', 375000, '1766316862.png', 0, '2025-12-21 04:34:22', '2025-12-21 04:34:22', 450000, 'Matic', 'Bensin', 'YA'),
(9, 'Ertiga', 3, 2, 'W 095 LB', 'Hitam', 6, '2018', 375000, '1766316978.png', 0, '2025-12-21 04:36:18', '2025-12-21 04:36:18', 450000, 'Matic', 'Bensin', 'YA'),
(10, 'Ayla', 4, 1, 'L 1234 AB', 'Putih', 5, '2021', 275000, '1766574331.png', 0, '2025-12-24 04:05:31', '2025-12-24 04:08:00', 425000, '65 HP', 'Bensin', 'YA'),
(11, 'Ayla', 4, 2, 'L 2234 CD', 'Hitam', 5, '2022', 300000, '1766574459.png', 0, '2025-12-24 04:07:39', '2025-12-24 04:07:39', 450000, '65 HP', 'Bensin', 'YA'),
(12, 'Brio', 1, 1, 'L 3345 EF', 'Merah', 5, '2021', 325000, '1766574619.png', 0, '2025-12-24 04:10:19', '2025-12-24 04:10:19', 475000, '90 HP', 'Bensin', 'YA'),
(13, 'Brio New', 1, 2, 'L 4456 GH', 'Putih', 5, '2023', 375000, '1766575948.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:32:28', 525000, '90', 'Bensin', 'YA'),
(14, 'Avanza', 2, 1, 'L 5567 IJ', 'Silver', 7, '2021', 300000, '1766575887.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:31:27', 450000, '104', 'Bensin', 'YA'),
(15, 'Avanza', 2, 2, 'L 6678 KL', 'Hitam', 7, '2022', 325000, '1766575846.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:30:46', 475000, '104', 'Bensin', 'YA'),
(16, 'Xenia New', 4, 2, 'L 7789 MN', 'Abu-abu', 7, '2023', 400000, '1766575753.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:29:13', 550000, '104', 'Bensin', 'YA'),
(17, 'Ertiga', 3, 1, 'L 8890 OP', 'Putih', 7, '2022', 350000, '1766575686.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:30:05', 500000, '104', 'Bensin', 'YA'),
(18, 'BRV New', 1, 2, 'L 9901 QR', 'Hitam', 7, '2023', 500000, '1766575637.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:27:17', 650000, '121', 'Bensin', 'YA'),
(19, 'Innova Reborn', 2, 2, 'L 1023 ST', 'Hitam', 7, '2022', 550000, '1766575529.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:29:27', 700000, '149', 'Diesel', 'YA'),
(20, 'Zenix Hybrid', 2, 2, 'L 1124 UV', 'Putih', 7, '2024', 750000, '1766575483.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:29:57', 900000, '186', 'Hybrid', 'YA'),
(21, 'Fortuner', 2, 2, 'L 1225 WX', 'Hitam', 7, '2022', 900000, '1766575392.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:29:39', 1100000, '201', 'Diesel', 'YA'),
(22, 'Hiace Premio', 3, 1, 'L 1326 YZ', 'Putih', 12, '2021', 1500000, '1766575349.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:22:29', 1500000, '134', 'Diesel', 'YA'),
(23, 'Alphard', 3, 2, 'L 1427 AA', 'Hitam', 7, '2022', 0, '1766575263.png', 0, '2025-12-24 11:19:03', '2025-12-24 04:21:03', 2500000, '182', 'Bensin', 'YA'),
(24, 'Ayla', 4, 1, 'L B001 AB', 'Putih', 5, '2021', 133000, '1766577366.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:56:06', 225000, '65', 'Bensin', 'YA'),
(25, 'Ayla', 4, 2, 'L B002 CD', 'Hitam', 5, '2021', 143000, '1766577312.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:55:12', 235000, '65', 'Bensin', 'YA'),
(26, 'Karimun', 3, 1, 'L B003 EF', 'Silver', 5, '2021', 133000, '1766577250.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:54:10', 225000, '75', 'Bensin', 'YA'),
(27, 'Avanza / Xenia 2014', 4, 1, 'L B004 GH', 'Putih', 7, '2014', 143000, '1766577200.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:53:20', 260000, '104', 'Bensin', 'YA'),
(28, 'Avanza / Xenia 2014', 4, 2, 'L B005 IJ', 'Putih', 7, '2014', 153000, '1766577144.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:52:24', 270000, '104', 'Bensin', 'YA'),
(29, 'Avanza / Xenia 2016 Up', 4, 1, 'L B006 KL', 'Abu-abu', 7, '2016', 157000, '1766577101.jpg', 0, '2025-12-24 11:40:17', '2025-12-24 04:51:41', 275000, '104', 'Bensin', 'YA'),
(30, 'Avanza / Xenia 2019 Up', 4, 1, 'L B007 MN', 'Hitam', 7, '2019', 167000, '1766577024.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:50:24', 285000, '104', 'Bensin', 'YA'),
(31, 'Avanza / Xenia 2019 Up', 2, 2, 'L B008 OP', 'Hitam', 7, '2019', 177000, '1766576952.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:49:12', 295000, '104', 'Bensin', 'YA'),
(32, 'Brio', 1, 2, 'L B009 QR', 'Merah', 5, '2020', 177000, '1766576900.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:48:20', 275000, '90', 'Bensin', 'YA'),
(33, 'Brio New', 1, 2, 'L B010 ST', 'Putih', 5, '2020', 200000, '1766576853.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:47:33', 300000, '90', 'Bensin', 'YA'),
(34, 'Ertiga', 3, 1, 'L B011 UV', 'Putih', 7, '2020', 200000, '1766576776.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:46:16', 325000, '104', 'Bensin', 'YA'),
(35, 'Fortuner', 2, 2, 'L B012 WX', 'Hitam', 7, '2020', 500000, '1766576647.png', 0, '2025-12-24 11:40:17', '2025-12-24 04:44:07', 700000, '201', 'Diesel', 'YA'),
(36, 'Hiace Premio', 2, 2, 'L B013 YZ', 'Putih', 12, '2020', 733000, '1766576552.png', 1, '2025-12-24 11:40:17', '2025-12-29 22:13:53', 950000, '134', 'Diesel', 'YA');

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
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `telat` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `mobil_id` bigint(20) UNSIGNED NOT NULL,
  `supir` varchar(255) NOT NULL,
  `supir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_bayar` varchar(255) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `profile_id`, `mobil_id`, `supir`, `supir_id`, `tanggal_pemesanan`, `tanggal_pengembalian`, `total_harga`, `status_bayar`, `jumlah_hari`, `total_bayar`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'TIDAK', NULL, '2025-12-21', '2025-12-22', 325000, 'unpaid', 1, 325000, 'Silahkan melakukan pembayaran !.', '2025-12-21 04:25:33', '2025-12-21 04:27:05'),
(2, 2, 6, 'TIDAK', NULL, '2025-12-21', '2025-12-22', 325000, 'unpaid', 1, 325000, 'Silahkan melakukan pembayaran !.', '2025-12-21 04:39:37', '2025-12-21 04:49:49'),
(3, 3, 36, 'TIDAK', NULL, '2025-12-30', '2025-12-31', 733000, 'pending', 1, 733000, 'Silahkan melakukan pembayaran !.', '2025-12-29 22:13:53', '2025-12-29 22:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'profile.jpg',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `no_ktp`, `nama`, `jenis_kelamin`, `no_telp`, `alamat`, `foto`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '123645387', 'Eratrans Admin', 'Laki-laki', '+62 811-311-190', 'Komplek Ruko Grand City Regency, Jl. Rungkut Madya B-21, Central Rungkut, Gunung Anyar, Surabaya', 'profile.jpg', 1, '2025-12-21 03:59:21', '2025-12-21 03:59:21'),
(2, '1222223333', 'kazuma', 'Laki-laki', '0198667384948', 'Ketintang timur', 'profile.jpg', 2, '2025-12-21 04:25:15', '2025-12-21 04:25:15'),
(3, '2581206565', 'Mama', 'Perempuan', '08125779452', 'Surabaya', 'profile.jpg', 3, '2025-12-24 04:57:49', '2025-12-24 04:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'member', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status_supir` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'admin@gmail.com', '$2y$12$kgzCdyZCfvowuDMWrzoLn.zoXe9nXFaqvHSyufhA5BY.uwsVdHYtK', '2025-12-21 03:59:21', '2025-12-21 03:59:21', 1),
(2, 'sampurno2005@gmail.com', '$2y$12$ADu/7j2AdVjkYZCPm5Glxu7/9rpfU0qxcXBk5uIBu/qXF8mxck/CS', '2025-12-21 04:24:59', '2025-12-21 04:24:59', 2),
(3, 'halo@example.com', '$2y$12$0bfYBo/yTIWun/odSPCRh.LJYj.nzGEx9utRxEsdruMQWnGnSe/G6', '2025-12-24 04:57:20', '2025-12-24 04:57:20', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merek_mobil`
--
ALTER TABLE `merek_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobil_no_polisi_unique` (`no_polisi`),
  ADD KEY `mobil_merek_mobil_id_foreign` (`merek_mobil_id`),
  ADD KEY `mobil_jenis_mobil_id_foreign` (`jenis_mobil_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_profile_id_foreign` (`profile_id`),
  ADD KEY `pesanan_mobil_id_foreign` (`mobil_id`),
  ADD KEY `pesanan_supir_id_foreign` (`supir_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_pembayaran_pesanan_id_foreign` (`pesanan_id`);

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
-- AUTO_INCREMENT for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merek_mobil`
--
ALTER TABLE `merek_mobil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_jenis_mobil_id_foreign` FOREIGN KEY (`jenis_mobil_id`) REFERENCES `jenis_mobil` (`id`),
  ADD CONSTRAINT `mobil_merek_mobil_id_foreign` FOREIGN KEY (`merek_mobil_id`) REFERENCES `merek_mobil` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_mobil_id_foreign` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`),
  ADD CONSTRAINT `pesanan_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `pesanan_supir_id_foreign` FOREIGN KEY (`supir_id`) REFERENCES `supir` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD CONSTRAINT `transaksi_pembayaran_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
