-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 04:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Table structure for table `akuns`
--

CREATE TABLE `akuns` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_normal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akuns`
--

INSERT INTO `akuns` (`id`, `kode_akun`, `nama_akun`, `saldo_normal`, `saldo_awal`, `created_at`, `updated_at`) VALUES
(5, '1011', 'Kas', 'Debit', '15000000', NULL, '2022-08-18 08:07:46'),
(6, '1102', 'Piutang Usaha', 'Debit', '0', NULL, '2022-08-09 06:07:25'),
(7, '1103', 'Persediaan', 'Debit', '12737400000', NULL, '2022-08-18 08:07:13'),
(8, '1201 ', 'Peralatan Perusahaan', 'Debit', '30000000', NULL, '2022-08-18 08:07:03'),
(9, '1202', 'Akumulasi Penyusutan - Peralatan Usaha', 'Kredit', '2000000', NULL, '2022-08-18 08:06:53'),
(10, '2101', 'Utang Usaha', 'Kredit', '0', NULL, NULL),
(11, '3101 ', 'Modal', 'Kredit', '32000000', NULL, '2022-08-18 08:06:42'),
(12, '3102', 'Prive', 'Debit', '0', NULL, NULL),
(15, '4101', 'Penjualan', 'Kredit', '0', NULL, NULL),
(16, '4102', 'Pendapatan Jasa', 'Kredit', '0', NULL, NULL),
(18, '6101', 'Beban Gaji', 'Debit', '0', NULL, NULL),
(19, '6102', 'Beban Utilitas', 'Debit', '0', NULL, NULL),
(20, '6103', 'Beban Penyusutan Peralatan Usaha', 'Debit', '0', NULL, NULL),
(22, '5101', 'HPP', 'Debit', '0', NULL, NULL),
(23, '2102', 'Hutang Biaya', 'Kredit', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asets`
--

CREATE TABLE `asets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `harga_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `jumlah_stok`, `harga_jual`, `harga_beli`, `created_at`, `updated_at`) VALUES
(4, 'BRG0001', 'Insektisida', 65, '2000000', '1000000', '2022-06-10 10:30:52', '2022-08-18 08:58:16'),
(5, 'BRG0002', 'Algasida', 73, '2000000', '1000000', '2022-06-10 10:31:05', '2022-08-21 11:22:35'),
(6, 'BRG0003', 'Alvisida', 75, '800000', '500000', '2022-06-10 10:31:26', '2022-08-14 17:50:40'),
(7, 'BRG0004', 'Bakterisida', 50, '4000000', '300000', '2022-06-10 10:31:44', '2022-08-14 17:53:57'),
(8, 'BRG0005', 'Fungisida', 45, '9000000', '7500000', '2022-06-10 10:32:08', '2022-08-14 17:48:52'),
(9, 'BRG0006', 'Herbisida', 125, '5000000', '5000000', '2022-06-10 10:32:28', '2022-08-14 17:46:27'),
(10, 'BRG007', 'Insektisida', 40, '1200000', '1000000', '2022-06-10 10:34:05', '2022-08-14 17:53:22'),
(11, 'BRG0008', 'Molluskisida', 125, '800000', '5000000', '2022-06-10 10:34:28', '2022-08-14 17:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `beban`
--

CREATE TABLE `beban` (
  `id_beban` bigint(20) UNSIGNED NOT NULL,
  `kode_beban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_beban` date NOT NULL,
  `serba_serbi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beban`
--

INSERT INTO `beban` (`id_beban`, `kode_beban`, `tgl_beban`, `serba_serbi`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(6, 'BB-0001', '2020-01-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:55:00', '2022-08-14 17:56:10'),
(7, 'BB-0007', '2020-02-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:55:38', '2022-08-14 17:55:38'),
(8, 'BB-0008', '2020-03-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:56:00', '2022-08-14 17:56:00'),
(9, 'BB-0009', '2020-04-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:56:30', '2022-08-14 17:56:30'),
(10, 'BB-0010', '2020-05-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:56:46', '2022-08-14 17:59:14'),
(11, 'BB-0011', '2020-06-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:57:11', '2022-08-14 17:59:06'),
(12, 'BB-0012', '2020-07-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:57:54', '2022-08-14 17:59:00'),
(13, 'BB-0013', '2020-08-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:58:09', '2022-08-14 17:58:54'),
(14, 'BB-0014', '2020-09-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:58:49', '2022-08-14 17:58:49'),
(15, 'BB-0015', '2020-10-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:59:33', '2022-08-14 17:59:33'),
(16, 'BB-0016', '2022-11-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 17:59:52', '2022-08-14 17:59:52'),
(17, 'BB-0017', '2022-12-01', 'Beban Gaji', '30000000', 'Pembayaran Gaji Karyawan', '2022-08-14 18:00:05', '2022-08-14 18:00:05'),
(18, 'BB-0018', '2020-06-01', 'Beban Listrik', '1200000', 'Pembayaran Listrik per 6 Bulan', '2022-08-14 18:01:28', '2022-08-14 18:01:28'),
(19, 'BB-0019', '2020-12-01', 'Beban Listrik', '1200000', 'Pembayaran Listrik per 6 Bulan', '2022-08-14 18:01:56', '2022-08-14 18:01:56'),
(20, 'BB-0020', '2019-08-19', 'Beban Gaji', '1000000', 'Beban Gaji', '2022-08-18 10:14:09', '2022-08-18 10:14:09'),
(21, 'BB-0021', '2019-08-25', 'Beban Utilitas', '2000000', 'Pembayaran Listril', '2022-08-21 10:27:32', '2022-08-21 10:27:32'),
(22, 'BB-0022', '2019-12-30', 'Beban Utilitas', '1500000', 'Beban Listrik', '2022-08-21 10:31:09', '2022-08-21 10:31:09'),
(24, 'BB-0023', '2019-12-30', 'Beban Penyusutan Peralatan Usaha', '23000000', 'Beban Penyusutan', '2022-08-21 10:41:53', '2022-08-21 10:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` bigint(20) UNSIGNED NOT NULL,
  `kode_jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `kode_jasa`, `nama_jasa`, `harga_jual`, `keterangan`, `updated_at`, `created_at`) VALUES
(8, 'JS-01', 'Fumigasi Area', '13000', 'Harga Jasa Fumigasi Rp.13.000 / m3', '2022-06-10 17:40:46', '2022-06-10 17:40:46'),
(9, 'JS-02', 'Treatment Pest Control', '20000', 'Harga Jasa Pest Control Rp 20.000 / m2', '2022-06-10 17:46:03', '2022-06-10 17:46:03'),
(10, 'JS-03', 'Fumigasi Arsip', '15000', 'Harga Jasa Fumigasi Arsip Rp.15.000 / m3', '2022-06-10 17:48:17', '2022-06-10 17:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama`, `alamat`, `telepon`, `jenis_kelamin`, `jabatan`, `gaji`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Martin HS Manalu', 'Jl.Singgalang No V', '082207558079', 'Pria', 'Manajer', '-', NULL, '2022-05-28 12:41:26', '2022-05-28 20:35:03'),
(2, 'Eko Widanto', 'Jl Umban Sari', '089932217543', 'Pria', 'Team Leader', '5000000', NULL, NULL, NULL);

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
(5, '2022_04_08_015015_create_akuns_table', 1),
(6, '2022_04_24_050241_karyawan', 1),
(7, '2022_04_24_163533_supplier', 1),
(8, '2022_04_24_163918_create_suppliers_table', 1),
(9, '2022_04_24_165156_supplier', 2),
(10, '2022_04_24_165255_supplier', 3),
(11, '2022_05_28_191454_add_jenis_kelamin_to_karyawans', 4),
(12, '2022_05_28_191939_create_stoks_table', 5),
(13, '2022_05_28_192126_create_transaksis_table', 5),
(14, '2022_05_28_193432_add_gaji_to_karyawans', 6),
(15, '2022_05_29_052656_drop_stoks', 7),
(16, '2022_05_29_052907_create_barangs_table', 8),
(17, '2022_05_29_053019_create_jasas_table', 8),
(18, '2022_05_29_054117_drop_jasas', 9),
(19, '2022_05_29_054136_drop_barangs', 10),
(20, '2022_05_29_054307_jasa', 11),
(21, '2022_05_29_054314_barang', 12),
(22, '2022_05_29_054118_drop_jasas', 13),
(23, '2022_05_29_054138_drop_barangs', 14),
(24, '2022_05_29_064444_add_update_at_to_jasa', 15),
(25, '2022_05_29_064500_add_created_at_to_jasa', 15),
(26, '2022_05_29_064445_add_update_at_to_jasa', 16),
(27, '2022_05_29_202312_create_penjualans_table', 17),
(28, '2022_05_29_202324_create_pembelians_table', 17),
(29, '2022_05_29_210436_create_detail_penjualans_table', 17),
(30, '2022_05_30_113504_add_kolom_to_penjualan', 18),
(31, '2022_05_30_181145_add_jasa_to_penjualan', 19),
(32, '2022_05_30_193604_pembelian', 20),
(33, '2022_05_30_201455_add_kolom_to_pembelian', 20),
(34, '2022_05_30_211247_add_harga_to_pembelian', 21),
(35, '2022_08_23_010520_create_table_akuns_periode', 22);

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
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_faktur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_beli` date NOT NULL,
  `cara_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `no_faktur`, `karyawan`, `tgl_beli`, `cara_beli`, `jatuh_tempo`, `supplier`, `barang`, `keterangan`, `jumlah`, `harga_beli`, `created_at`, `updated_at`) VALUES
(15, 'FP-1660524017', '1', '2020-01-10', 'Tunai', '', 'Jelly Harianja', '4', 'Pembelian Insektisida di Bulan Januari 2020', '10', '2000000', '2022-08-14 17:40:49', '2022-08-14 17:40:49'),
(16, 'FP-1660524056', '1', '2020-02-10', 'Tunai', '', 'Jelly Harianja', '5', 'Pembelian Algasida di Bulan Februari 2020', '15', '2000000', '2022-08-14 17:41:33', '2022-08-14 17:41:33'),
(17, 'FP-1660524152', '1', '2020-03-10', 'Tunai', '', 'Jelly Harianja', '4', 'Pembelian Insektisida di Bulan Maret 2020', '10', '2000000', '2022-08-14 17:43:32', '2022-08-14 17:43:32'),
(18, 'FP-1660524331', '1', '2020-04-10', 'Tunai', '', 'Jelly Harianja', '9', 'Pembelian Herbisida di Bulan April 2020', '10', '5000000', '2022-08-14 17:46:27', '2022-08-14 17:46:27'),
(19, 'FP-1660524413', '1', '2020-05-11', 'Tunai', '', 'Jelly Harianja', '7', 'Pembelian Bakterisida di Bulan Mei 2020', '20', '4000000', '2022-08-14 17:47:49', '2022-08-14 17:47:49'),
(20, 'FP-1660524470', '1', '2020-06-13', 'Tunai', '', 'Jelly Harianja', '8', 'Pembelian Fungisida di Bulan Juni 2020', '10', '9000000', '2022-08-14 17:48:52', '2022-08-14 17:48:52'),
(21, 'FP-1660524548', '1', '2020-07-09', 'Tunai', '', 'Jelly Harianja', '11', 'Pembelian Molluskisida di Bulan Juli 2020', '5', '800000', '2022-08-14 17:49:38', '2022-08-14 17:49:38'),
(22, 'FP-1660524597', '1', '2020-08-15', 'Tunai', '', 'Jelly Harianja', '6', 'Pembelian Alvisida di Bulan Agustus 2020', '5', '800000', '2022-08-14 17:50:40', '2022-08-14 17:50:40'),
(23, 'FP-1660524644', '1', '2020-09-14', 'Tunai', '', 'Jelly Harianja', '10', 'Pembelian Insektisida di Bulan September 2020', '5', '1200000', '2022-08-14 17:51:16', '2022-08-14 17:51:16'),
(24, 'FP-1660524683', '1', '2020-10-16', 'Tunai', '', 'Jelly Harianja', '7', 'Pembelian Bakterisida di Bulan Oktober 2020', '5', '4000000', '2022-08-14 17:52:33', '2022-08-14 17:52:33'),
(25, 'FP-1660524771', '1', '2020-11-15', 'Tunai', '', 'Jelly Harianja', '10', 'Pembelian Insektisida di Bulan November 2020', '10', '1200000', '2022-08-14 17:53:22', '2022-08-14 17:53:22'),
(26, 'FP-1660524804', '1', '2020-12-18', 'Tunai', '', 'Jelly Harianja', '7', 'Pembelian Bakterisida di Bulan Desember 2020', '10', '4000000', '2022-08-14 17:53:57', '2022-08-14 17:53:57'),
(28, 'FP-1661105934', '1', '2019-08-20', 'Tunai', '', 'Jelly Harianja', '5', 'Algasida', '5', '2000000', '2022-08-21 11:22:35', '2022-08-21 11:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_faktur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_jual` date NOT NULL,
  `cara_jual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_faktur`, `karyawan`, `tgl_jual`, `cara_jual`, `jatuh_tempo`, `jenis_barang`, `keterangan`, `customer`, `barang`, `jasa`, `diskon`, `jumlah`, `created_at`, `updated_at`) VALUES
(76, 'FJ-1660523250', '1', '2020-01-01', 'Tunai', '', '', 'Penjualan Insektisida dan Algasida di Bulan Januari 2020', 'Andi Setiawan', '5', '0', '0', '10', '2022-08-14 17:28:39', '2022-08-14 17:28:39'),
(77, 'FJ-1660523324', '1', '2020-02-01', 'Tunai', '', '', 'Penjualan Herbisida di Bulan Februari 2020', 'Andi Setiawan', '9', '0', '0', '10', '2022-08-14 17:29:20', '2022-08-14 17:29:20'),
(78, 'FJ-1660523400', '1', '2020-03-01', 'Tunai', '', '', 'Penjualan Insektisida dan Molluskisida di Bulan Maret 2020', 'Andi Setiawan', '10', '0', '0', '20', '2022-08-14 17:30:48', '2022-08-14 17:30:48'),
(81, 'FJ-1660523451', '1', '2020-04-01', 'Tunai', '', '', 'Penjualan Herbisida dan Bakterisida di Bulan April 2020', 'Andi Setiawan', '7', '0', '0', '5', '2022-08-14 17:31:30', '2022-08-14 17:31:30'),
(83, 'FJ-1660523497', '1', '2020-05-01', 'Tunai', '', '', 'Penjualan Bakterisida dan Insektisida di Bulan Mei 2020', 'Andi Setiawan', '4', '0', '0', '10', '2022-08-14 17:32:30', '2022-08-14 17:32:30'),
(84, 'FJ-1660523553', '1', '2020-06-01', 'Tunai', '', '', 'Penjualan Algasida di Bulan Juni 2020', 'Andi Setiawan', '5', '0', '0', '10', '2022-08-14 17:33:24', '2022-08-14 17:33:24'),
(85, 'FJ-1660523606', '1', '2020-07-01', 'Tunai', '', '', 'Pembelian Fungisida di Bulan Juli 2020', 'Andi Setiawan', '8', '0', '0', '20', '2022-08-14 17:34:08', '2022-08-14 17:34:08'),
(86, 'FJ-1660523650', '1', '2020-08-01', 'Tunai', '', '', 'Penjualan Fungisida di Bulan Agustus 2020', 'Andi Setiawan', '8', '0', '0', '10', '2022-08-14 17:34:40', '2022-08-14 17:34:40'),
(87, 'FJ-1660523683', '1', '2020-09-01', 'Tunai', '', '', 'Penjualan Herbisida di Bulan September 2020', 'Andi Setiawan', '9', '0', '0', '10', '2022-08-14 17:35:13', '2022-08-14 17:35:13'),
(88, 'FJ-1660523715', '1', '2020-10-01', 'Tunai', '', '', 'Penjualan Alvisida di Bulan Oktober 2020', 'Andi Setiawan', '6', '0', '0', '10', '2022-08-14 17:35:44', '2022-08-14 17:35:44'),
(89, 'FJ-1660523747', '1', '2020-11-01', 'Tunai', '', '', 'Penjualan Mollukisida di Bulan November 2020', 'Andi Setiawan', '11', '0', '0', '10', '2022-08-14 17:36:22', '2022-08-14 17:36:22'),
(90, 'FJ-1660523883', '1', '2020-12-01', 'Tunai', '', '', 'Penjualan Algasida di Bulan Desember 2020', 'Andi Setiawan', '5', '0', '0', '17', '2022-08-14 17:38:34', '2022-08-14 17:38:34'),
(92, 'FJ-1660837042', '1', '2019-07-18', 'Tunai', '', '', 'Penjualan Insektisida', 'Andi Setiawan', '4', '0', '0', '5', '2022-08-18 08:38:14', '2022-08-18 08:38:14'),
(93, 'FJ-1660838222', '1', '2019-08-18', 'Tunai', '', '', 'Pembelian Insektisida', 'Cust. A', '4', '0', '0', '5', '2022-08-18 08:58:16', '2022-08-18 08:58:16'),
(94, 'FJ-1660844399', '1', '2019-08-18', 'Tunai', '', '', 'Jasa Fumigasi', 'Cust. A', '0', '8', '0', '5', '2022-08-18 10:40:48', '2022-08-18 10:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `peralatan`
--

CREATE TABLE `peralatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_aset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_aset` date NOT NULL,
  `jumlah_aset` int(11) NOT NULL,
  `harga_aset` int(11) NOT NULL,
  `masa_manfaat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peralatan`
--

INSERT INTO `peralatan` (`id`, `nama_aset`, `tgl_aset`, `jumlah_aset`, `harga_aset`, `masa_manfaat`, `created_at`, `updated_at`) VALUES
(1, 'Mesin Printer 2', '2022-06-16', 1, 10000000, 3, '2022-06-15 20:43:46', '2022-06-16 08:07:25'),
(2, 'Mesin Printer', '2022-06-16', 2, 10000000, 3, '2022-06-15 20:42:59', '2022-06-16 08:03:34');

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
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `jenis_barang`, `telepon`, `created_at`, `updated_at`) VALUES
(5, 'Reymon Rizki', 'Jl Pancasila 3', 'Obat - Obatan / Racun Serangga', '085207558078', '2022-06-10 10:51:50', '2022-06-10 10:51:50'),
(6, 'Jelly Harianja', 'Jl Kesehatan V', 'Alat - Alat Fumigasi', '0546546345435', '2022-06-10 10:52:12', '2022-06-10 10:52:12'),
(7, 'Richard Juvanto', 'Jl Durian Sahil No 13', 'Obat - Obatan / Racun Serangga', '054654634521', '2022-06-10 10:52:37', '2022-06-10 10:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `table_akuns_periode`
--

CREATE TABLE `table_akuns_periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_normal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', NULL, 'admin123', 'wyeajdsYh5GUIxGluOSPct1gVVBWOJbtbTrkZqbu26cMwFM4GSHautRpCAoj', '2022-08-22 12:01:40', '2022-08-22 12:01:40'),
(2, 'User', 'user@email.com', NULL, '$2y$10$WJnOxXfMgYvog5Rd9R17U.2GnqCh2nK11Xtb621X/T/jS.G3/ZL8W', 'hUUsnmk8dAxwt0CzFA4cVsWRderIEDvFQGGSs2EyM3uyuYu36LV1LiFVWUk2', '2022-08-22 12:56:00', '2022-08-22 12:56:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuns`
--
ALTER TABLE `akuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id_beban`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
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
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_akuns_periode`
--
ALTER TABLE `table_akuns_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `akuns`
--
ALTER TABLE `akuns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `beban`
--
ALTER TABLE `beban`
  MODIFY `id_beban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `peralatan`
--
ALTER TABLE `peralatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `table_akuns_periode`
--
ALTER TABLE `table_akuns_periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
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
