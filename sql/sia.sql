-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 03:12 AM
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
(5, '1011', 'Kas', 'Debit', '40000000', NULL, NULL),
(6, '1102', 'Piutang Usaha', 'Debit', '0', NULL, '2022-08-09 06:07:25'),
(7, '1103', 'Persediaan', 'Debit', '20000000', NULL, NULL),
(8, '1201 ', 'Peralatan Perusahaan', 'Debit', '100000000', NULL, NULL),
(9, '1202', 'Akumulasi Penyusutan - Peralatan Usaha', 'Kredit', '22000000', NULL, NULL),
(10, '2101', 'Utang Usaha', 'Kredit', '0', NULL, NULL),
(11, '3101 ', 'Modal', 'Kredit', '150000000', NULL, NULL),
(12, '3102', 'Prive', 'Debit', '0', NULL, NULL),
(13, '3103', 'Ikhtisar Laba Rugi', 'Kredit', '0', NULL, NULL),
(15, '4101', 'Penjualan', 'Kredit', '0', NULL, NULL),
(16, '4102', 'Pendapatan Jasa', 'Kredit', '0', NULL, NULL),
(17, '5101', 'Harga Pokok Penjualan', 'Debit', '0', NULL, NULL),
(18, '6101', 'Beban Gaji', 'Debit', '0', NULL, NULL),
(19, '6102', 'Beban Listrik', 'Debit', '0', NULL, NULL),
(20, '6103', 'Beban Penyusutan Peralatan Usaha', 'Debit', '0', NULL, NULL),
(21, '6104', 'Beban Jasa', 'Debit', '0', NULL, NULL);

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
(4, 'BRG0001', 'Insektisida', 95, '2000000', '1000000', '2022-06-10 10:30:52', '2022-07-19 07:17:50'),
(5, 'BRG0002', 'Algasida', 100, '2000000', '1000000', '2022-06-10 10:31:05', '2022-06-10 10:31:05'),
(6, 'BRG0003', 'Alvisida', 100, '800000', '500000', '2022-06-10 10:31:26', '2022-06-10 10:32:56'),
(7, 'BRG0004', 'Bakterisida', 25, '4000000', '300000', '2022-06-10 10:31:44', '2022-06-10 10:50:15'),
(8, 'BRG0005', 'Fungisida', 75, '9000000', '7500000', '2022-06-10 10:32:08', '2022-06-10 10:32:08'),
(9, 'BRG0006', 'Herbisida', 150, '5000000', '5000000', '2022-06-10 10:32:28', '2022-06-10 10:53:18'),
(10, 'BRG007', 'Insektisida', 45, '1200000', '1000000', '2022-06-10 10:34:05', '2022-06-10 10:34:09'),
(11, 'BRG0008', 'Molluskisida', 150, '800000', '5000000', '2022-06-10 10:34:28', '2022-06-10 10:34:28');

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
(1, 'BB-0001', '2022-06-17', 'Beban Penyusutan Peralatan Usaha', '3000000', 'Beban Penyusutan', '2022-06-16 07:50:44', '2022-06-16 07:50:44'),
(2, 'BB-0002', '2022-06-16', 'Beban Penyusutan Peralatan Usaha', '300000', 'Beban Penyusutan', '2022-06-16 07:55:00', '2022-06-16 07:55:00'),
(4, 'BB-0003', '2022-08-10', 'Beban Gaji', '10000000', 'Beban Gaji', '2022-08-09 14:28:12', '2022-08-10 14:32:17');

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
(34, '2022_05_30_211247_add_harga_to_pembelian', 21);

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
(13, 'FP-1654883571', '1', '2022-06-11', 'Tunai', '', 'Reymon Rizki', '9', 'Pembelian Herbisida', '50', '5000000', '2022-06-10 10:53:18', '2022-06-10 10:53:18');

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
(64, 'FJ-1654883342', '1', '2022-06-11', 'Tunai', '', '', 'Cairan Bakterisida', 'Andi Panjaitan (Dumai)', '7', '0', '0', '25', '2022-06-10 10:50:15', '2022-06-10 10:50:15'),
(65, 'FJ-1658240229', '1', '2022-06-19', 'Tunai', '', '', 'Jual Barang', 'Rendi', '4', '0', '0', '5', '2022-07-19 07:17:50', '2022-07-19 07:17:50');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `beban`
--
ALTER TABLE `beban`
  MODIFY `id_beban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
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
