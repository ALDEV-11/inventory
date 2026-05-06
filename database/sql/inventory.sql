-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 05, 2026 at 11:06 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int UNSIGNED NOT NULL,
  `id_kategori` int UNSIGNED NOT NULL,
  `id_lokasi` int UNSIGNED DEFAULT NULL,
  `kode_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` decimal(14,2) NOT NULL,
  `harga_jual` decimal(14,2) NOT NULL,
  `stok_min` int NOT NULL,
  `stok_saat_ini` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `id_lokasi`, `kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `harga_jual`, `stok_min`, `stok_saat_ini`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'ELK-001', 'Laptop Lenovo', 'unit', 8000000.00, 9000000.00, 2, 17, 'barang/2t8F6QeBG7X4swQGm6dfOTbGAA9fpJQdGA68W7hd.jpg', '2026-02-24 20:28:54', '2026-03-09 02:11:37'),
(2, 1, NULL, 'ELK-002', 'Printer Epson', 'unit', 2000000.00, 2500000.00, 1, 16, 'barang/865hOPkSZhJfgVFir1CecL2me0cqzlyjC6V9rMZh.jpg', '2026-02-24 20:28:54', '2026-03-09 02:11:26'),
(3, 2, NULL, 'ALT-001', 'Pulpen Pilot', 'pcs', 5000.00, 7000.00, 20, 83, 'barang/2kr1wwZR8hQMn5gsa8CtQXFivzkqgiU0BY5vtUHB.jpg', '2026-02-24 20:28:54', '2026-03-11 04:09:32'),
(4, 2, NULL, 'ALT-002', 'Buku Tulis Sidu', 'pcs', 3000.00, 5000.00, 30, 469, 'barang/u6jaARFmmqEJ8sjNV20jc36TbkV6QvGExuzIs7yS.jpg', '2026-02-24 20:28:54', '2026-03-09 06:54:17'),
(5, 3, NULL, 'BBK-001', 'Kertas HVS', 'rim', 40000.00, 50000.00, 10, 116, 'barang/lz5dhyJhNLHxybr2rd69lAMMr7txT3CyVPbsMZ1a.jpg', '2026-02-24 20:28:54', '2026-03-09 02:10:53'),
(6, 3, NULL, 'BBK-002', 'Tinta Printer', 'botol', 60000.00, 75000.00, 5, 65, 'barang/W9vjwSKvvF1ZdU9ZOscMhjebn8sIHazG2h9Sppa7.jpg', '2026-02-24 20:28:54', '2026-03-09 02:10:38'),
(7, 4, NULL, 'PRL-001', 'Obeng Set', 'set', 25000.00, 35000.00, 3, 0, 'barang/Lk94c3aj703D5vh1hN3gbUWRozrfV6DX24Mj0oOI.jpg', '2026-02-24 20:28:54', '2026-03-12 03:01:42'),
(8, 4, NULL, 'PRL-002', 'Tang Kombinasi', 'pcs', 18000.00, 25000.00, 4, 3, 'barang/zxUeRtl4ua04nQK619skUsvnG1vyrXZzQZYiDwjZ.jpg', '2026-02-24 20:28:54', '2026-03-12 03:12:18'),
(9, 5, NULL, 'LNN-001', 'Masker Kain', 'pcs', 2000.00, 4000.00, 50, 400, 'barang/BeLOIvX2ysrLFAOZJ2FPtyfFruo3hMGmDfNgj4TT.jpg', '2026-02-24 20:28:54', '2026-03-09 02:08:42'),
(10, 5, NULL, 'LNN-002', 'Sarung Tangan', 'pasang', 5000.00, 8000.00, 30, 100, 'barang/uy2ykHr3GUw4ydOzwtcmKBwiB5R8rNBGDYWqSsl7.jpg', '2026-02-24 20:28:54', '2026-03-09 02:08:23'),
(12, 1, NULL, 'BRG-003', 'Laptop ASUS TUF GAMING', 'unit', 8800000.00, 11000000.00, 2, 18, 'barang/JLt7VsycD3jVR2b13oVPZiucmr4MoWp4xIiYNn6Q.jpg', '2026-02-25 21:02:30', '2026-03-07 01:55:15'),
(13, 4, 2, 'BRG-004', 'Baut 12', 'Pcs', 2000.00, 25000.00, 35, 80, 'barang/AMG4k7Ja7i3Nlsdn5WU07EogdnBstAFD9sDbnbSt.jpg', '2026-03-07 01:39:37', '2026-03-12 03:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nomor_keluar` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tujuan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `total_nilai` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_user`, `nomor_keluar`, `tanggal`, `tujuan`, `keterangan`, `total_nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BK-20260226-001', '2026-02-26', 'Ekspor ke China', NULL, 27000000.00, '2026-02-26 00:44:22', '2026-02-26 00:44:22', NULL),
(2, 3, 'BK-20260226-002', '2026-02-26', 'Ekspor ke Jepang', NULL, 2500000.00, '2026-02-26 02:08:01', '2026-02-26 02:08:01', NULL),
(3, 1, 'BK-20260227-001', '2026-02-27', 'Produksi pabrik kertas', 'Barang dipesan', 100000.00, '2026-02-26 20:58:49', '2026-02-26 20:58:49', NULL),
(4, 1, 'BK-20260227-002', '2026-02-27', 'Pabrik ASUS', 'Barang cacat', 44000000.00, '2026-02-26 21:07:36', '2026-02-26 21:07:36', NULL),
(5, 1, 'BK-20260227-003', '2026-02-27', 'Ekspor ke bengkel', 'Dibeli bengkel', 250000.00, '2026-02-26 21:15:41', '2026-02-26 21:15:41', NULL),
(6, 1, 'BK-20260305-001', '2026-03-05', 'Jakarta motor', NULL, 350000.00, '2026-03-05 02:24:49', '2026-03-05 02:24:49', NULL),
(7, 2, 'BK-20260307-001', '2026-03-07', 'Stock Jakarta Motor', NULL, 1250000.00, '2026-03-07 02:08:09', '2026-03-07 02:08:09', NULL),
(8, 2, 'BK-20260311-001', '2026-03-11', 'pabrik', NULL, 46900000.00, '2026-03-11 04:09:32', '2026-03-11 04:09:32', NULL),
(9, 1, 'BK-20260312-001', '2026-03-12', 'bengkel', NULL, 175000.00, '2026-03-12 03:01:42', '2026-03-12 03:01:42', NULL),
(10, 1, 'BK-20260312-002', '2026-03-12', 'bengkel', NULL, 1325000.00, '2026-03-12 03:12:18', '2026-03-12 03:12:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int UNSIGNED NOT NULL,
  `id_supplier` int UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nomor_po` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('draft','disetujui','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `total_nilai` decimal(14,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `barcode_verification_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path ke file barcode yang sudah di-scan untuk approval',
  `approval_method` enum('manual','barcode_scan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual' COMMENT 'Metode approval: manual atau scan barcode',
  `barcode_verified_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu barcode di-verifikasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_supplier`, `id_user`, `nomor_po`, `tanggal`, `status`, `total_nilai`, `keterangan`, `approved_by`, `approved_at`, `barcode_verification_path`, `approval_method`, `barcode_verified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'PO-20260226-001', '2026-02-26', 'diterima', 44000000.00, NULL, 1, '2026-02-25 23:29:36', NULL, 'manual', NULL, '2026-02-25 23:28:12', '2026-03-10 21:02:01', '2026-03-10 21:02:01'),
(2, 1, 1, 'PO-20260226-002', '2026-02-26', 'diterima', 6000000.00, NULL, 1, '2026-02-26 02:45:08', NULL, 'manual', NULL, '2026-02-26 02:44:07', '2026-02-26 02:45:11', NULL),
(4, 1, 1, 'PO-20260227-001', '2026-02-27', 'diterima', 88000000.00, 'Laptop masuk 10 unit', 1, '2026-02-26 21:18:36', NULL, 'manual', NULL, '2026-02-26 21:18:25', '2026-02-26 21:18:40', NULL),
(5, 1, 2, 'PO-20260227-002', '2026-02-27', 'diterima', 72000000.00, 'Laptop Lenovo masuk 9 unit', 1, '2026-02-26 21:21:37', NULL, 'manual', NULL, '2026-02-26 21:21:00', '2026-03-10 21:02:01', '2026-03-10 21:02:01'),
(6, 2, 1, 'PO-20260304-001', '2026-03-04', 'diterima', 250000.00, 'barang masuk', 1, '2026-03-03 20:58:51', NULL, 'manual', NULL, '2026-03-03 20:37:46', '2026-03-03 20:59:01', NULL),
(7, 1, 1, 'PO-20260304-002', '2026-03-04', 'diterima', 56000000.00, NULL, 1, '2026-03-03 23:27:23', NULL, 'manual', NULL, '2026-03-03 23:19:29', '2026-03-04 02:21:34', NULL),
(8, 1, 1, 'PO-20260304-003', '2026-03-04', 'diterima', 16000000.00, NULL, 1, '2026-03-04 02:30:26', NULL, 'manual', NULL, '2026-03-04 02:29:18', '2026-03-04 02:31:29', NULL),
(9, 3, 1, 'PO-20260304-004', '2026-03-04', 'diterima', 2640000.00, NULL, 1, '2026-03-04 08:31:50', NULL, 'manual', NULL, '2026-03-04 08:26:21', '2026-03-04 19:01:57', NULL),
(10, 3, 1, 'PO-20260305-001', '2026-03-05', 'diterima', 200000.00, NULL, 1, '2026-03-04 19:03:46', NULL, 'manual', NULL, '2026-03-04 19:02:49', '2026-03-04 19:06:39', NULL),
(11, 2, 1, 'PO-20260305-002', '2026-03-05', 'diterima', 2700000.00, NULL, 1, '2026-03-04 19:07:27', NULL, 'manual', NULL, '2026-03-04 19:06:55', '2026-03-04 19:10:57', NULL),
(12, 3, 1, 'PO-20260305-003', '2026-03-05', 'diterima', 972000.00, NULL, 1, '2026-03-05 02:21:14', NULL, 'manual', NULL, '2026-03-05 02:20:05', '2026-03-05 02:33:58', NULL),
(13, 2, 1, 'PO-20260305-004', '2026-03-05', 'diterima', 600000.00, NULL, 1, '2026-03-05 03:17:50', NULL, 'manual', NULL, '2026-03-05 03:17:18', '2026-03-10 21:08:21', '2026-03-10 21:08:21'),
(14, 1, 2, 'PO-20260307-001', '2026-03-07', 'diterima', 61600000.00, NULL, 2, '2026-03-07 01:31:44', NULL, 'manual', NULL, '2026-03-07 01:18:55', '2026-03-10 20:57:03', '2026-03-10 20:57:03'),
(15, 3, 2, 'PO-20260307-002', '2026-03-07', 'diterima', 100000.00, NULL, 2, '2026-03-07 01:41:10', NULL, 'manual', NULL, '2026-03-07 01:40:13', '2026-03-10 20:57:03', '2026-03-10 20:57:03'),
(16, 3, 1, 'PO-20260307-003', '2026-03-07', 'diterima', 60000.00, NULL, 2, '2026-03-07 01:54:58', NULL, 'manual', NULL, '2026-03-07 01:44:40', '2026-03-10 21:08:21', '2026-03-10 21:08:21'),
(17, 3, 1, 'PO-20260309-001', '2026-03-09', 'diterima', 100000.00, NULL, 1, '2026-03-09 02:12:58', NULL, 'manual', NULL, '2026-03-09 02:12:31', '2026-03-10 21:08:21', '2026-03-10 21:08:21'),
(18, 2, 1, 'PO-20260309-002', '2026-03-09', 'diterima', 267000.00, NULL, 1, '2026-03-09 06:39:56', NULL, 'manual', NULL, '2026-03-09 06:39:36', '2026-03-09 06:54:17', NULL),
(19, 3, 1, 'PO-20260309-003', '2026-03-09', 'disetujui', 216000.00, NULL, 1, '2026-03-11 03:40:10', NULL, 'manual', NULL, '2026-03-09 06:41:30', '2026-03-11 03:40:10', NULL),
(20, 3, 1, 'PO-20260311-001', '2026-03-11', 'disetujui', 270000.00, NULL, 1, '2026-03-11 03:41:49', NULL, 'manual', NULL, '2026-03-11 03:40:32', '2026-03-11 03:41:49', NULL),
(21, 12, 1, 'PO-20260311-002', '2026-03-11', 'disetujui', 90000.00, NULL, 1, '2026-03-18 12:55:24', NULL, 'manual', NULL, '2026-03-11 04:04:53', '2026-03-18 12:55:24', NULL),
(22, 3, 1, 'PO-20260504-001', '2026-05-04', 'draft', 3600000.00, NULL, NULL, NULL, NULL, 'manual', NULL, '2026-05-03 22:02:54', '2026-05-03 22:02:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_keluar`
--

CREATE TABLE `detail_barang_keluar` (
  `id_detail` int UNSIGNED NOT NULL,
  `id_keluar` int UNSIGNED NOT NULL,
  `id_barang` int UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(14,2) NOT NULL,
  `subtotal` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_barang_keluar`
--

INSERT INTO `detail_barang_keluar` (`id_detail`, `id_keluar`, `id_barang`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 9000000.00, 27000000.00, '2026-02-26 00:44:22', '2026-02-26 00:44:22'),
(2, 2, 2, 1, 2500000.00, 2500000.00, '2026-02-26 02:08:01', '2026-02-26 02:08:01'),
(3, 3, 4, 20, 5000.00, 100000.00, '2026-02-26 20:58:49', '2026-02-26 20:58:49'),
(4, 4, 12, 4, 11000000.00, 44000000.00, '2026-02-26 21:07:36', '2026-02-26 21:07:36'),
(5, 5, 8, 10, 25000.00, 250000.00, '2026-02-26 21:15:41', '2026-02-26 21:15:41'),
(6, 6, 7, 10, 35000.00, 350000.00, '2026-03-05 02:24:49', '2026-03-05 02:24:49'),
(7, 7, 13, 50, 25000.00, 1250000.00, '2026-03-07 02:08:09', '2026-03-07 02:08:09'),
(8, 8, 3, 67, 700000.00, 46900000.00, '2026-03-11 04:09:32', '2026-03-11 04:09:32'),
(9, 9, 7, 5, 35000.00, 175000.00, '2026-03-12 03:01:42', '2026-03-12 03:01:42'),
(10, 10, 8, 53, 25000.00, 1325000.00, '2026-03-12 03:12:18', '2026-03-12 03:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_masuk`
--

CREATE TABLE `detail_barang_masuk` (
  `id_detail` int UNSIGNED NOT NULL,
  `id_masuk` int UNSIGNED NOT NULL,
  `id_barang` int UNSIGNED NOT NULL,
  `id_lokasi` int UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(14,2) NOT NULL,
  `subtotal` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_barang_masuk`
--

INSERT INTO `detail_barang_masuk` (`id_detail`, `id_masuk`, `id_barang`, `id_lokasi`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 2, 5, 8800000.00, 44000000.00, '2026-02-25 23:28:12', '2026-02-25 23:28:12'),
(2, 2, 2, 2, 3, 2000000.00, 6000000.00, '2026-02-26 02:44:07', '2026-02-26 02:44:07'),
(4, 4, 12, 2, 10, 8800000.00, 88000000.00, '2026-02-26 21:18:25', '2026-02-26 21:18:25'),
(5, 5, 1, 2, 9, 8000000.00, 72000000.00, '2026-02-26 21:21:00', '2026-02-26 21:21:00'),
(6, 6, 3, 3, 50, 5000.00, 250000.00, '2026-03-03 20:37:46', '2026-03-03 20:37:46'),
(7, 7, 1, 2, 7, 8000000.00, 56000000.00, '2026-03-03 23:19:29', '2026-03-03 23:19:29'),
(8, 8, 2, 3, 8, 2000000.00, 16000000.00, '2026-03-04 02:29:18', '2026-03-04 02:29:18'),
(9, 9, 5, 4, 66, 40000.00, 2640000.00, '2026-03-04 08:26:21', '2026-03-04 08:26:21'),
(10, 10, 9, 5, 100, 2000.00, 200000.00, '2026-03-04 19:02:49', '2026-03-04 19:02:49'),
(11, 11, 6, 3, 45, 60000.00, 2700000.00, '2026-03-04 19:06:55', '2026-03-04 19:06:55'),
(12, 12, 8, 4, 54, 18000.00, 972000.00, '2026-03-05 02:20:05', '2026-03-05 02:20:05'),
(13, 13, 4, 3, 200, 3000.00, 600000.00, '2026-03-05 03:17:18', '2026-03-05 03:17:18'),
(14, 14, 12, 2, 7, 8800000.00, 61600000.00, '2026-03-07 01:18:55', '2026-03-07 01:18:55'),
(15, 15, 13, 3, 50, 2000.00, 100000.00, '2026-03-07 01:40:13', '2026-03-07 01:40:13'),
(16, 16, 13, 3, 30, 2000.00, 60000.00, '2026-03-07 01:44:40', '2026-03-07 01:44:40'),
(17, 17, 13, 3, 50, 2000.00, 100000.00, '2026-03-09 02:12:32', '2026-03-09 02:12:32'),
(18, 18, 4, 2, 89, 3000.00, 267000.00, '2026-03-09 06:39:36', '2026-03-09 06:39:36'),
(19, 19, 8, 4, 12, 18000.00, 216000.00, '2026-03-09 06:41:30', '2026-03-09 06:41:30'),
(20, 20, 4, 3, 90, 3000.00, 270000.00, '2026-03-11 03:40:32', '2026-03-11 03:40:32'),
(21, 21, 8, 3, 5, 18000.00, 90000.00, '2026-03-11 04:04:53', '2026-03-11 04:04:53'),
(22, 22, 5, 1, 90, 40000.00, 3600000.00, '2026-05-03 22:02:54', '2026-05-03 22:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur`
--

CREATE TABLE `detail_retur` (
  `id_detail` int UNSIGNED NOT NULL,
  `id_retur` int UNSIGNED NOT NULL,
  `id_barang` int UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(14,2) NOT NULL,
  `subtotal` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_retur`
--

INSERT INTO `detail_retur` (`id_detail`, `id_retur`, `id_barang`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 2500000.00, 2500000.00, '2026-02-26 20:23:14', '2026-02-26 20:23:14'),
(2, 2, 1, 5, 1000.00, 5000.00, '2026-02-26 20:26:52', '2026-02-26 20:26:52'),
(3, 3, 1, 3, 1000.00, 3000.00, '2026-02-26 20:29:50', '2026-02-26 20:29:50');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'Barang-barang elektronik', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(2, 'Alat Tulis', 'Perlengkapan alat tulis kantor', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(3, 'Bahan Baku', 'Bahan baku produksi', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(4, 'Peralatan', 'Peralatan kerja', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(5, 'Lainnya', 'Kategori lainnya', '2026-02-24 20:28:54', '2026-02-24 20:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int UNSIGNED NOT NULL,
  `kode_rak` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `kode_rak`, `nama_lokasi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'RAK-A1', 'Rak A1', 'Rak bagian depan A1', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(2, 'RAK-A2', 'Rak A2', 'Rak bagian depan A2', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(3, 'RAK-B1', 'Rak B1', 'Rak bagian tengah B1', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(4, 'RAK-B2', 'Rak B2', 'Rak bagian tengah B2', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(5, 'RAK-C1', 'Rak C1', 'Rak bagian belakang C1', '2026-02-24 20:28:54', '2026-02-26 02:45:56');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_25_000000_create_user_table', 1),
(5, '2026_02_25_020640_create_notifications_table', 1),
(6, '2026_02_25_020641_create_lokasi_table', 1),
(7, '2026_02_25_020641_create_supplier_table', 1),
(8, '2026_02_25_020642_create_kategori_barang_table', 1),
(9, '2026_02_25_020643_create_barang_table', 1),
(10, '2026_02_25_020644_create_barang_masuk_table', 1),
(11, '2026_02_25_020645_create_detail_barang_masuk_table', 1),
(12, '2026_02_25_020650_create_barang_keluar_table', 1),
(13, '2026_02_25_020651_create_detail_barang_keluar_table', 1),
(14, '2026_02_25_020652_create_retur_barang_table', 1),
(15, '2026_02_25_020653_create_detail_retur_table', 1),
(16, '2026_02_26_043523_update_status_enum_in_barang_masuk_table', 2),
(17, '2026_03_07_092313_add_deleted_at_to_notifications_table', 3),
(18, '2026_03_10_150016_add_soft_delete_to_transaksi_tables', 4),
(19, '2026_03_11_034858_add_soft_delete_to_transaksi_tables', 5),
(20, '2026_03_12_102935_add_id_lokasi_to_barang_table', 5),
(21, '2026_03_12_103524_add_id_lokasi_to_barang_table', 6),
(22, '2026_05_04_050721_add_barcode_verification_to_barang_masuk_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
('12d8e8e5-3167-46c6-8a7a-c10a1467d113', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 3, '{\"type\":\"stok_minimum\",\"id_barang\":13,\"nama_barang\":\"Baut 12\",\"stok_saat_ini\":30,\"stok_min\":35,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/13\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Baut 12 telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-07 02:08:09', '2026-03-07 02:08:09', NULL),
('180a5e74-e1b3-4435-8717-115379e69e7b', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 1, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":2,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', '2026-03-01 19:24:45', '2026-02-26 21:15:41', '2026-03-10 21:37:02', '2026-03-10 21:37:02'),
('1b6334b8-fe97-4599-90b5-44b829a0de59', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 1, '{\"type\":\"stok_minimum\",\"id_barang\":13,\"nama_barang\":\"Baut 12\",\"stok_saat_ini\":30,\"stok_min\":35,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/13\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Baut 12 telah mencapai atau berada di bawah batas minimum.\"}', '2026-03-09 01:58:41', '2026-03-07 02:08:09', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('1d8ed431-f2fb-4141-a5df-b3ede2f2b512', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":8,\"nomor_po\":\"PO-20260304-003\",\"pesan\":\"PO PO-20260304-003 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/8\"}', '2026-03-04 02:31:41', '2026-03-04 02:30:26', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('30eabbbf-a927-4bea-9255-fa7280b753db', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 1, '{\"type\":\"stok_minimum\",\"id_barang\":7,\"nama_barang\":\"Obeng Set\",\"stok_saat_ini\":0,\"stok_min\":3,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/7\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Obeng Set telah mencapai atau berada di bawah batas minimum.\"}', '2026-05-03 22:01:48', '2026-03-12 03:01:42', '2026-05-03 22:01:48', NULL),
('32ea30fd-94dc-4ca5-9446-53d5690ea28a', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 2, '{\"type\":\"stok_minimum\",\"id_barang\":13,\"nama_barang\":\"Baut 12\",\"stok_saat_ini\":30,\"stok_min\":35,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/13\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Baut 12 telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-07 02:08:09', '2026-03-07 02:08:09', NULL),
('437cd152-4ca9-4d59-9b99-37df11cc8e19', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 2, '{\"type\":\"stok_minimum\",\"id_barang\":7,\"nama_barang\":\"Obeng Set\",\"stok_saat_ini\":0,\"stok_min\":3,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/7\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Obeng Set telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-12 03:01:42', '2026-03-12 03:01:42', NULL),
('45648ef8-3bed-4b94-81b4-97d1f8653ab2', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260305-003 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260305-003\",\"id_masuk\":12,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 972.000\",\"approved_by\":\"admin\",\"approved_at\":\"05\\/03\\/2026 09:21\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/12\",\"tipe\":\"po_disetujui\"}', '2026-03-09 01:58:41', '2026-03-05 02:21:14', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('532d4c4b-4392-4674-bf9a-c020e0b3ad49', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 3, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":3,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-12 03:12:18', '2026-03-12 03:12:18', NULL),
('6544c048-1e47-40c9-88be-05cbea374f00', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260311-001 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260311-001\",\"id_masuk\":20,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 270.000\",\"approved_by\":\"admin\",\"approved_at\":\"11\\/03\\/2026 10:41\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/20\",\"tipe\":\"po_disetujui\"}', '2026-05-03 22:01:48', '2026-03-11 03:41:49', '2026-05-03 22:01:48', NULL),
('73248d45-e7af-4b81-9de7-c04598065133', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":10,\"nomor_po\":\"PO-20260305-001\",\"pesan\":\"PO PO-20260305-001 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/10\"}', '2026-03-04 19:12:02', '2026-03-04 19:03:46', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('7a8954e2-4b9b-4fcf-9049-e6c485493910', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 2, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":3,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-12 03:12:18', '2026-03-12 03:12:18', NULL),
('8e189b12-c4fa-4ade-bc56-f2797a7ad5ea', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":6,\"nomor_po\":\"PO-20260304-001\",\"pesan\":\"PO PO-20260304-001 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/6\"}', '2026-03-03 20:59:18', '2026-03-03 20:58:51', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('9b41e7a7-d9a3-49de-9166-d1c4b2c61341', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":11,\"nomor_po\":\"PO-20260305-002\",\"pesan\":\"PO PO-20260305-002 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/11\"}', '2026-03-04 19:12:02', '2026-03-04 19:07:27', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('9d6b2ef4-32af-491f-8a8d-90575ea8e0b1', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260309-003 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260309-003\",\"id_masuk\":19,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 216.000\",\"approved_by\":\"admin\",\"approved_at\":\"11\\/03\\/2026 10:40\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/19\",\"tipe\":\"po_disetujui\"}', '2026-05-03 22:01:48', '2026-03-11 03:40:10', '2026-05-03 22:01:48', NULL),
('9da412f1-d986-4a5e-9c48-73b4a47b5607', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 3, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":2,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', '2026-02-26 21:16:23', '2026-02-26 21:15:41', '2026-02-26 21:16:23', NULL),
('a5f5d2e1-295a-4bb0-bc5d-d76cd653d022', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 8, '{\"type\":\"stok_minimum\",\"id_barang\":13,\"nama_barang\":\"Baut 12\",\"stok_saat_ini\":30,\"stok_min\":35,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/13\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Baut 12 telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-07 02:08:09', '2026-03-07 02:08:09', NULL),
('a7f32fbf-d025-40bf-b4a2-e87cc8a72112', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 1, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":3,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', '2026-05-03 22:01:48', '2026-03-12 03:12:18', '2026-05-03 22:01:48', NULL),
('a8c03869-6e27-4d67-9322-79f460aa13a6', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 2, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260307-001 dari supplier PT Sumber Elektronik telah disetujui.\",\"nomor_po\":\"PO-20260307-001\",\"id_masuk\":14,\"supplier\":\"PT Sumber Elektronik\",\"total_nilai\":\"Rp 61.600.000\",\"approved_by\":\"petugas\",\"approved_at\":\"07\\/03\\/2026 08:31\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/14\",\"tipe\":\"po_disetujui\"}', '2026-03-07 02:07:29', '2026-03-07 01:31:44', '2026-03-07 02:07:29', NULL),
('c1a94f70-20ae-4588-96c9-faf6c5e65200', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260307-003 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260307-003\",\"id_masuk\":16,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 60.000\",\"approved_by\":\"petugas\",\"approved_at\":\"07\\/03\\/2026 08:54\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/16\",\"tipe\":\"po_disetujui\"}', '2026-03-09 01:58:41', '2026-03-07 01:54:58', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('c271eacb-cfad-480a-a356-2018438a9fa0', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 3, '{\"type\":\"stok_minimum\",\"id_barang\":7,\"nama_barang\":\"Obeng Set\",\"stok_saat_ini\":0,\"stok_min\":3,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/7\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Obeng Set telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-12 03:01:42', '2026-03-12 03:01:42', NULL),
('c89b5ace-f79f-4984-8ec4-5bac71507dd4', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":9,\"nomor_po\":\"PO-20260304-004\",\"pesan\":\"PO PO-20260304-004 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/9\"}', '2026-03-04 18:56:01', '2026-03-04 08:31:50', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('ce6abb5a-98b8-4398-b1ea-2f41f6144467', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 9, '{\"type\":\"stok_minimum\",\"id_barang\":13,\"nama_barang\":\"Baut 12\",\"stok_saat_ini\":30,\"stok_min\":35,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/13\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Baut 12 telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-03-07 02:08:09', '2026-03-07 02:08:09', NULL),
('d8a131d6-0a5e-4149-acef-1fc8fcbaeffa', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"id_masuk\":7,\"nomor_po\":\"PO-20260304-002\",\"pesan\":\"PO PO-20260304-002 telah disetujui.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/7\"}', '2026-03-03 23:27:46', '2026-03-03 23:27:23', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('e0e82d57-fedc-4c28-a014-bfde9074f127', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260311-002 dari supplier PT Tekno Maju Bersama telah disetujui.\",\"nomor_po\":\"PO-20260311-002\",\"id_masuk\":21,\"supplier\":\"PT Tekno Maju Bersama\",\"total_nilai\":\"Rp 90.000\",\"approved_by\":\"admin\",\"approved_at\":\"18\\/03\\/2026 19:55\",\"url\":\"http:\\/\\/127.0.0.1:8001\\/barang-masuk\\/21\",\"tipe\":\"po_disetujui\"}', '2026-05-03 22:01:48', '2026-03-18 12:55:24', '2026-05-03 22:01:48', NULL),
('e635eb1a-91c4-4f6f-8604-31c340af06a3', 'App\\Notifications\\StokMinimumNotification', 'App\\Models\\User', 9, '{\"type\":\"stok_minimum\",\"id_barang\":8,\"nama_barang\":\"Tang Kombinasi\",\"stok_saat_ini\":2,\"stok_min\":4,\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang\\/8\",\"judul\":\"Peringatan Stok Minimum\",\"pesan\":\"Stok Tang Kombinasi telah mencapai atau berada di bawah batas minimum.\"}', NULL, '2026-02-26 21:15:41', '2026-02-26 21:15:41', NULL),
('f09d7dea-0e52-45cb-92bb-7bc48772f798', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 2, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260307-002 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260307-002\",\"id_masuk\":15,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 100.000\",\"approved_by\":\"petugas\",\"approved_at\":\"07\\/03\\/2026 08:41\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/15\",\"tipe\":\"po_disetujui\"}', '2026-03-07 02:07:29', '2026-03-07 01:41:10', '2026-03-07 02:07:29', NULL),
('f4c366a4-86a5-40ae-8f25-065402c61b08', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260309-002 dari supplier CV Alat Tulis Jaya telah disetujui.\",\"nomor_po\":\"PO-20260309-002\",\"id_masuk\":18,\"supplier\":\"CV Alat Tulis Jaya\",\"total_nilai\":\"Rp 267.000\",\"approved_by\":\"admin\",\"approved_at\":\"09\\/03\\/2026 13:39\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/18\",\"tipe\":\"po_disetujui\"}', '2026-03-10 21:27:58', '2026-03-09 06:39:56', '2026-03-10 21:37:02', '2026-03-10 21:37:02'),
('f80c6182-98af-4fb8-be85-733c00f1562c', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260305-004 dari supplier CV Alat Tulis Jaya telah disetujui.\",\"nomor_po\":\"PO-20260305-004\",\"id_masuk\":13,\"supplier\":\"CV Alat Tulis Jaya\",\"total_nilai\":\"Rp 600.000\",\"approved_by\":\"admin\",\"approved_at\":\"05\\/03\\/2026 10:17\",\"url\":\"https:\\/\\/claud-genethlialogical-insupportably.ngrok-free.dev\\/barang-masuk\\/13\",\"tipe\":\"po_disetujui\"}', '2026-03-09 01:58:41', '2026-03-05 03:17:50', '2026-03-09 01:58:54', '2026-03-09 01:58:54'),
('fba0bf64-6f47-476e-8499-976ed13dd6ae', 'App\\Notifications\\PoDisetujuiNotification', 'App\\Models\\User', 1, '{\"judul\":\"Purchase Order Disetujui\",\"pesan\":\"PO PO-20260309-001 dari supplier UD Bahan Baku Makmur telah disetujui.\",\"nomor_po\":\"PO-20260309-001\",\"id_masuk\":17,\"supplier\":\"UD Bahan Baku Makmur\",\"total_nilai\":\"Rp 100.000\",\"approved_by\":\"admin\",\"approved_at\":\"09\\/03\\/2026 09:12\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/barang-masuk\\/17\",\"tipe\":\"po_disetujui\"}', '2026-03-10 21:27:58', '2026-03-09 02:12:58', '2026-03-10 21:33:21', '2026-03-10 21:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nomor_retur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `total_nilai` decimal(14,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retur_barang`
--

INSERT INTO `retur_barang` (`id_retur`, `id_user`, `nomor_retur`, `jenis`, `tanggal`, `alasan`, `total_nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'RTR-20260227-001', 'Dari Pelanggan', '2026-02-27', 'Barang tidak sesuai', 2500000.00, '2026-02-26 20:23:14', '2026-02-26 20:23:14', NULL),
(2, 1, 'RTR-TEST-001', 'Dari Pelanggan', '2026-02-27', 'Pengembalian rusak', 5000.00, '2026-02-26 20:26:52', '2026-02-26 20:26:52', NULL),
(3, 1, 'RTR-TEST-002', 'Ke Supplier', '2026-02-27', 'Pengembalian ke produsen', 3000.00, '2026-02-26 20:29:50', '2026-02-26 20:29:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LePWEuJXFbR7N6LDXLbeiPhBJmvmf2k1IOcEQQqo', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienZUWHp1WDdUQTc3UzJRcW85TExwQXcySDlJQkVWOEROaDFiNHpiSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iYXJhbmctbWFzdWsvMjIiO3M6NToicm91dGUiO3M6MTc6ImJhcmFuZy1tYXN1ay5zaG93Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1777872789);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int UNSIGNED NOT NULL,
  `kode_supplier` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `alamat`, `no_telp`, `email`, `pic`, `created_at`, `updated_at`) VALUES
(1, 'SUP-001', 'PT Sumber Elektronik', 'Jl. Merdeka No. 1, Jakarta', '0211234567', 'info@sumberelektronik.com', 'Budi Santoso', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(2, 'SUP-002', 'CV Alat Tulis Jaya', 'Jl. Sudirman No. 10, Bandung', '0227654321', 'admin@alattulisjaya.co.id', 'Siti Aminah', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(3, 'SUP-003', 'UD Bahan Baku Makmur', 'Jl. Diponegoro No. 5, Surabaya', '0319988776', 'kontak@bahanbakumakmur.com', 'Andi Wijaya', '2026-02-24 20:28:54', '2026-02-24 20:28:54'),
(12, 'SUP-004', 'PT Tekno Maju Bersama', 'Jl. Ahmad Yani No. 22, Semarang', '0241234567', 'info@teknomaju.co.id', 'Dian Pratama', '2026-03-08 12:11:08', '2026-03-08 12:11:08'),
(13, 'SUP-005', 'CV Karya Mandiri', 'Jl. Gatot Subroto No. 8, Yogyakarta', '0274876543', 'cs@karyamandiri.com', 'Rini Wulandari', '2026-03-08 12:11:08', '2026-03-08 12:11:08'),
(14, 'SUP-006', 'PT Global Logistik', 'Jl. Raya Bogor No. 45, Bogor', '02519876543', 'order@globallogistik.id', 'Hendra Kusuma', '2026-03-08 12:11:08', '2026-03-08 12:11:08'),
(15, 'SUP-007', 'UD Sejahtera Abadi', 'Jl. Pahlawan No. 3, Malang', '0341654321', 'admin@sejahteraabadi.com', 'Tono Hariyanto', '2026-03-08 12:11:08', '2026-03-08 12:11:08'),
(16, 'SUP-008', 'PT Nusantara Supplies', 'Jl. Imam Bonjol No. 17, Medan', '0614567890', 'sales@nusantarasupplies.co.id', 'Sri Hartati', '2026-03-08 12:11:08', '2026-03-08 12:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','kepala') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gudang.com', '$2y$12$ek2L4A/68HUNF4i1i2hHh.by9uW09H9e4F3OV0iGIdhaLkI.B1NsW', 'admin', NULL, NULL, '2026-02-24 20:28:54', '2026-02-24 20:48:57'),
(2, 'petugas', 'petugas@gudang.com', '$2y$12$QmgwCg2h0GmxAm4SI2oxWujGsO2QGTvL32ZiGw9kkeOHU2erEBfWu', 'petugas', NULL, NULL, '2026-02-24 20:28:54', '2026-02-24 20:48:57'),
(3, 'kepala', 'kepala@gudang.com', '$2y$12$T3x6PMuhy4jkvr..N/EvSOuY1/MxjW/hJTeSqcokGU/WcemGtkxNG', 'kepala', NULL, NULL, '2026-02-24 20:28:54', '2026-02-24 20:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-02-24 20:28:53', '$2y$12$Rfct6TlnIhuHG5cEOpYnOOWw2dVNzIcArXMJWzjU.H9EnwFe9cs.2', 'q0sSzEFQ0P', '2026-02-24 20:28:54', '2026-02-24 20:28:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_id_kategori_index` (`id_kategori`),
  ADD KEY `barang_id_lokasi_foreign` (`id_lokasi`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `barang_keluar_id_user_index` (`id_user`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_approved_by_foreign` (`approved_by`),
  ADD KEY `barang_masuk_id_supplier_index` (`id_supplier`),
  ADD KEY `barang_masuk_id_user_index` (`id_user`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_barang_keluar_id_keluar_index` (`id_keluar`),
  ADD KEY `detail_barang_keluar_id_barang_index` (`id_barang`);

--
-- Indexes for table `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_barang_masuk_id_masuk_index` (`id_masuk`),
  ADD KEY `detail_barang_masuk_id_barang_index` (`id_barang`),
  ADD KEY `detail_barang_masuk_id_lokasi_index` (`id_lokasi`);

--
-- Indexes for table `detail_retur`
--
ALTER TABLE `detail_retur`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_retur_id_retur_index` (`id_retur`),
  ADD KEY `detail_retur_id_barang_index` (`id_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD UNIQUE KEY `lokasi_kode_rak_unique` (`kode_rak`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_index` (`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `retur_barang_id_user_index` (`id_user`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `supplier_kode_supplier_unique` (`kode_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  MODIFY `id_detail` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  MODIFY `id_detail` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_retur`
--
ALTER TABLE `detail_retur`
  MODIFY `id_detail` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE SET NULL;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barang_masuk_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD CONSTRAINT `detail_barang_keluar_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_barang_keluar_id_keluar_foreign` FOREIGN KEY (`id_keluar`) REFERENCES `barang_keluar` (`id_keluar`) ON DELETE CASCADE;

--
-- Constraints for table `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD CONSTRAINT `detail_barang_masuk_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_barang_masuk_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_barang_masuk_id_masuk_foreign` FOREIGN KEY (`id_masuk`) REFERENCES `barang_masuk` (`id_masuk`) ON DELETE CASCADE;

--
-- Constraints for table `detail_retur`
--
ALTER TABLE `detail_retur`
  ADD CONSTRAINT `detail_retur_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_retur_id_retur_foreign` FOREIGN KEY (`id_retur`) REFERENCES `retur_barang` (`id_retur`) ON DELETE CASCADE;

--
-- Constraints for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD CONSTRAINT `retur_barang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
