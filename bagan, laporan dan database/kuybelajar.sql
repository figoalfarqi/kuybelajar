-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 05:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuybelajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `email_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `foto_admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `email_admin`, `password_admin`, `nama_depan_admin`, `nama_belakang_admin`, `email_verified_at`, `foto_admin`, `no_hp_admin`, `alamat_admin`, `tipe_admin`, `created_at`, `updated_at`) VALUES
(48, 'yazid@gmail.com', 'asdasd', 'ziman', 'yazide', '2021-05-09 19:04:06', 'Gambar', '08893849384', 'jln jakarta', 'Admin', '2021-05-03 23:59:04', '2021-05-09 19:04:06'),
(71, 'figo@gmail', 'a8f5f167f44f4964e6c998dee827110c', 'figoa3', 'alfar', NULL, '910183014foto.png', '078545454334', 'asdssss', 'Admin', '2021-05-31 01:26:36', '2021-05-31 01:43:32'),
(72, 'figo@gmail.com', '887af41e547ac9f71e70aa16caa3abc3', 'figo', 'alfarqi', NULL, '2033820582BG Zoom-01 (1).jpg', '0896577766343', 'asdasdsssd', 'Super Admin', '2021-06-06 20:21:34', '2021-06-06 20:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `kelass`
--

CREATE TABLE `kelass` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_sampul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelass`
--

INSERT INTO `kelass` (`id_kelas`, `id_pengguna`, `nama_kelas`, `deskripsi`, `foto_sampul`, `created_at`, `updated_at`) VALUES
(1, 'hehe', 'hehe', 'hehe', 'hehe', '2021-04-28 20:58:34', '2021-04-28 20:58:34'),
(9, '4', '22', '32', 'asdasd1620785002BkPXFVDm.png', '2021-05-11 19:02:46', '2021-05-11 19:27:43'),
(13, '1', 'asd', 'zxczxc', 'asdasd16207902929k5j2dkz.jpg', '2021-05-11 19:53:57', '2021-05-11 20:31:32'),
(17, '4', 'zxczxczxc', '111', 'asdasd1620794153JToPtNEH.jpg', '2021-05-11 20:31:46', '2021-05-11 21:36:02'),
(18, '15', 'asdas22', 'asdasd22', '1937081824d78a569e-24e8-4ff4-9d87-c768a9b3c5b2.jpg', '2021-05-11 22:06:45', '2021-05-30 07:58:06'),
(19, '26', '1', '2', '1435271828foto.png', '2021-05-30 08:00:13', '2021-05-30 08:00:13'),
(20, '28', 'Kelas Figo', 'di kelas ini kita belajar pemrograman', '2106633489foto.png', '2021-06-02 00:11:30', '2021-06-02 21:01:01'),
(24, '29', 'Belajar Pythagoras', 'Pythagoras Pythagoras Pythagoras Pythagoras Pythagoras', '9904505385e620ebcfcff7eafe022a859_6 Online Coaching.png', '2021-06-03 09:05:16', '2021-06-03 09:05:16'),
(28, '32', 'Sonia class', 'kita belajar matematika dengan mudah dan gampang', '1950087952BG Zoom-01 (1).jpg', '2021-06-07 20:51:12', '2021-06-07 20:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id_komentar` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_postingan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_komentar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentars`
--

INSERT INTO `komentars` (`id_komentar`, `id_pengguna`, `id_postingan`, `isi_komentar`, `created_at`, `updated_at`) VALUES
(11, '29', '12', 'bagus sekali', '2021-06-03 08:41:35', '2021-06-03 08:41:35'),
(12, '28', '21', 'asdasdasdasd', '2021-06-07 02:29:35', '2021-06-07 02:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `nama_mata_pelajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id_mata_pelajaran`, `nama_mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Inggris', '2021-05-09 19:32:57', '2021-05-09 19:36:18'),
(3, 'Bahasa Indonesia', '2021-05-09 19:41:29', '2021-05-09 19:41:29'),
(9, 'Sejarah', '2021-05-09 19:47:11', '2021-05-09 19:47:26'),
(18, 'Biologi', NULL, NULL),
(19, 'Kimia', NULL, NULL),
(23, 'Fisika', NULL, NULL),
(25, 'Matematika', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mengikutis`
--

CREATE TABLE `mengikutis` (
  `id_mengikuti` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menontons`
--

CREATE TABLE `menontons` (
  `id_menonton` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_postingan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_menonton` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menontons`
--

INSERT INTO `menontons` (`id_menonton`, `id_pengguna`, `id_postingan`, `jumlah_menonton`, `created_at`, `updated_at`) VALUES
(2, '1', '2', 333, '2021-05-13 00:26:27', '2021-05-13 00:26:27'),
(3, '4', '4', 4545, '2021-05-13 00:26:35', '2021-05-13 00:26:35'),
(5, '26', '4', 1, '2021-05-30 22:09:19', '2021-05-30 22:09:28'),
(7, '28', '11', 14, '2021-06-02 07:58:39', '2021-06-02 21:17:50'),
(8, '28', '10', 32, '2021-06-02 08:04:09', '2021-06-07 00:56:09'),
(9, '28', '12', 7, '2021-06-02 21:03:08', '2021-06-07 02:09:32'),
(10, '', '12', 2, '2021-06-02 21:34:13', '2021-06-02 21:34:32'),
(12, '29', '14', 2, '2021-06-03 09:12:58', '2021-06-04 07:26:17'),
(13, '29', '18', 34, '2021-06-03 09:13:37', '2021-06-04 04:30:27'),
(14, '29', '19', 10, '2021-06-03 09:35:57', '2021-06-04 07:28:54'),
(15, '29', '10', 3, '2021-06-03 09:36:27', '2021-06-03 09:53:21'),
(16, '29', '17', 4, '2021-06-03 20:42:22', '2021-06-04 00:56:17'),
(17, '29', '20', 4, '2021-06-03 21:23:27', '2021-06-04 08:00:58'),
(18, '29', '15', 77, '2021-06-04 04:33:59', '2021-06-04 06:01:04'),
(19, '29', '21', 1, '2021-06-04 11:01:26', '2021-06-04 11:01:26'),
(20, '', '17', 5, '2021-06-07 00:25:54', '2021-06-07 00:27:33'),
(21, '', '21', 6, '2021-06-07 00:40:10', '2021-06-07 02:53:59'),
(22, '28', '20', 4, '2021-06-07 00:51:14', '2021-06-07 00:53:30'),
(23, '', '', 1, '2021-06-07 00:52:42', '2021-06-07 00:52:42'),
(24, '28', '21', 13, '2021-06-07 00:55:56', '2021-06-07 02:29:08'),
(25, '30', '21', 8, '2021-06-07 03:04:00', '2021-06-07 03:29:20'),
(26, '30', '20', 1, '2021-06-07 03:29:30', '2021-06-07 03:29:30'),
(27, '32', '24', 5, '2021-06-07 07:25:34', '2021-06-07 07:40:43'),
(28, '33', '20', 2, '2021-06-07 08:28:03', '2021-06-07 08:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `menyukais`
--

CREATE TABLE `menyukais` (
  `id_menyukai` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_postingan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menyukais`
--

INSERT INTO `menyukais` (`id_menyukai`, `id_pengguna`, `id_postingan`, `created_at`, `updated_at`) VALUES
(1, '4', '3', '2021-05-13 00:36:43', '2021-05-13 00:36:43'),
(2, '1', '2', '2021-05-13 00:36:50', '2021-05-13 00:36:58'),
(4, '15', '2', '2021-05-30 21:00:49', '2021-05-30 21:03:36'),
(7, '18', '4', '2021-05-30 21:01:32', '2021-05-30 21:01:44'),
(8, '25', '6', '2021-05-30 21:01:38', '2021-05-30 21:01:38'),
(23, '28', '10', '2021-06-02 08:44:45', '2021-06-02 08:44:45'),
(24, '28', '12', '2021-06-02 21:03:58', '2021-06-02 21:03:58'),
(25, '29', '12', '2021-06-03 08:42:46', '2021-06-03 08:42:46'),
(33, '28', '21', '2021-06-07 02:30:01', '2021-06-07 02:30:01'),
(34, '28', '21', '2021-06-07 02:30:01', '2021-06-07 02:30:01'),
(98, '30', '21', '2021-06-07 03:07:55', '2021-06-07 03:07:55'),
(99, '30', '20', '2021-06-07 03:29:31', '2021-06-07 03:29:31'),
(102, '32', '24', '2021-06-07 07:36:56', '2021-06-07 07:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE `penggunas` (
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penggunas`
--

INSERT INTO `penggunas` (`id_pengguna`, `email`, `email_verified_at`, `password`, `nama_depan`, `nama_belakang`, `foto`, `no_hp`, `created_at`, `updated_at`) VALUES
(28, 'figo@gmail.com', NULL, 'a8f5f167f44f4964e6c998dee827110c', 'figoaaja', 'alfarqie', '565584101foto.png', '08966588888', '2021-06-01 21:27:25', '2021-06-07 04:36:57'),
(29, 'zada@gmail.com', NULL, 'a8f5f167f44f4964e6c998dee827110c', 'zd', 'cvs', '3672043.jpg', '09876542224', '2021-06-02 21:19:53', '2021-06-04 07:26:12'),
(32, 'sonia@gmail.com', NULL, 'a8f5f167f44f4964e6c998dee827110c', 'sonia', 'cindi', '12277526sonia.jpg', '0896878475847', '2021-06-07 06:55:52', '2021-06-07 20:48:49'),
(33, 'soniac@gmail.com', NULL, 'a8f5f167f44f4964e6c998dee827110c', 'sonia', 'canda', '', '078564534343', '2021-06-07 07:51:24', '2021-06-07 07:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `postingans`
--

CREATE TABLE `postingans` (
  `id_postingan` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mata_pelajaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postingans`
--

INSERT INTO `postingans` (`id_postingan`, `id_kelas`, `id_mata_pelajaran`, `judul`, `kelas`, `deskripsi`, `video`, `created_at`, `updated_at`) VALUES
(10, '20', '9', 'alajar', '3 SMA', 'sulit sekali ', '1034711424video 7.mp4', '2021-06-02 04:26:29', '2021-06-02 04:44:12'),
(11, '20', '1', 'lbb', '3 SMA', 'sulit sekali', '1926704823video 1.mp4', '2021-06-02 04:27:32', '2021-06-02 04:27:32'),
(12, '20', '18', 'Ini pelajaran bbbbb', '3 SMA', 'ini pelajaran yang lumayan sulit ini pelajaran yang lumayan sulit ini pelajaran yang lumayan sulit ini pelajaran yang lumayan sulit ini pelajaran yang lumayan sulit ini pelajaran yang lumayan', '340600569video 9.mp4', '2021-06-02 21:02:04', '2021-06-02 21:02:04'),
(13, '24', '25', 'Belajar Pythagoras', '3 SMA', 'Pythagoras Pythagoras Pythagoras Pythagoras', '2121218786video 10.mp4', '2021-06-03 09:06:22', '2021-06-03 09:06:22'),
(14, '24', '25', 'Pythagoras dengan Cepat', '3 SMA', 'Pythagoras Cepat', '1124051284video 4.mp4', '2021-06-03 09:06:52', '2021-06-03 09:06:52'),
(15, '24', '25', 'Pythagoras Cepat', '3 SMA', 'Pythagoras sangat mudah', '1031666101video 1.mp4', '2021-06-03 09:08:19', '2021-06-03 09:08:19'),
(16, '24', '25', 'Pythagoras Mudah', '3 SMA', 'Mudah belajar bersama KuyBelajar', '337247117video 2.mp4', '2021-06-03 09:08:51', '2021-06-03 09:08:51'),
(17, '24', '25', 'Pythagoras mudah lo !!', '3 SMA', 'Belajar Pythagoras', '122112516video 6.mp4', '2021-06-03 09:09:29', '2021-06-03 09:09:29'),
(18, '24', '25', 'Pythagoras mudah dan cepat', '3 SMA', 'belajar Pythagoras keren', '1532241358video 3.mp4', '2021-06-03 09:10:30', '2021-06-03 09:10:30'),
(19, '24', '25', 'Pythagoras', '3 SMA', 'Pythagoras', '1580016220video 5.mp4', '2021-06-03 09:10:55', '2021-06-03 09:10:55'),
(20, '24', '25', 'Pythagoras cepat, mudah, dan terampil', '3 SMA', 'Dalam matematika, teorema Pythagorean, juga dikenal sebagai teorema Pythagoras, adalah hubungan mendasar dalam geometri Euclidean di antara tiga sisi segitiga siku-siku. Ini menyatakan bahwa ', '813480882video 2.mp4', '2021-06-03 21:23:12', '2021-06-03 21:23:12'),
(21, '24', '25', 'Pythagoras keren', '3 SMA', 'Belajar pythagoras di KuyBelajar', '1070752582video 10.mp4', '2021-06-04 11:01:17', '2021-06-04 11:01:17'),
(22, '25', '23', 'ssss asdasd asd', '3 SMA', 'asdasda asdasda sdasd', '1577527233Contoh Storyboard, Asa & Nita - Piket Kelas.mp4', '2021-06-07 03:00:24', '2021-06-07 03:00:24'),
(25, '28', '23', 'belajar fisika mudah', '3 SMA', 'mudah dan gampang', '1925695413Contoh Storyboard, Asa & Nita - Piket Kelas.mp4', '2021-06-07 21:00:56', '2021-06-07 21:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id_slideshow` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjudul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tombol_teks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tombol_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slideshows`
--

INSERT INTO `slideshows` (`id_slideshow`, `gambar`, `judul`, `subjudul`, `isi`, `tombol_teks`, `tombol_url`, `created_at`, `updated_at`) VALUES
(2, 'asdasd1620782421ydO17FWQ.jpg', 'a', 's', 'c', 'f', 'd', '2021-05-11 18:20:21', '2021-05-11 18:29:07'),
(4, 'asdasd1620782961D5FSl56a.jpg', 'as', 'as', 's', 'asd', 'asd', '2021-05-11 18:29:21', '2021-05-11 18:29:21'),
(6, '836078158BG Zoom-01 (1).jpg', 'a1', 's1', 'd1', 'f1', 'g1', '2021-05-30 06:24:11', '2021-05-30 06:24:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admins_email_admin_unique` (`email_admin`);

--
-- Indexes for table `kelass`
--
ALTER TABLE `kelass`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `kelass_nama_kelas_unique` (`nama_kelas`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id_mata_pelajaran`),
  ADD UNIQUE KEY `mata_pelajarans_nama_mata_pelajaran_unique` (`nama_mata_pelajaran`);

--
-- Indexes for table `menontons`
--
ALTER TABLE `menontons`
  ADD PRIMARY KEY (`id_menonton`);

--
-- Indexes for table `menyukais`
--
ALTER TABLE `menyukais`
  ADD PRIMARY KEY (`id_menyukai`);

--
-- Indexes for table `penggunas`
--
ALTER TABLE `penggunas`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `penggunas_email_unique` (`email`);

--
-- Indexes for table `postingans`
--
ALTER TABLE `postingans`
  ADD PRIMARY KEY (`id_postingan`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id_slideshow`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `kelass`
--
ALTER TABLE `kelass`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id_komentar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `menontons`
--
ALTER TABLE `menontons`
  MODIFY `id_menonton` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menyukais`
--
ALTER TABLE `menyukais`
  MODIFY `id_menyukai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `penggunas`
--
ALTER TABLE `penggunas`
  MODIFY `id_pengguna` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `postingans`
--
ALTER TABLE `postingans`
  MODIFY `id_postingan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id_slideshow` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
