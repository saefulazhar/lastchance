-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2025 at 04:44 AM
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
-- Database: `marketing_apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int NOT NULL,
  `nama_fasilitas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `created_at`) VALUES
(1, 'Wi-Fi', '2025-05-07 20:59:24'),
(2, 'AC', '2025-05-07 21:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `foto_kosan`
--

CREATE TABLE `foto_kosan` (
  `id` int NOT NULL,
  `kosan_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `foto_kosan`
--

INSERT INTO `foto_kosan` (`id`, `kosan_id`, `path`, `created_at`) VALUES
(6, 7, '75993c0c09f1ccb23c8b922e8ac48300.png', '2025-05-07 21:37:08'),
(7, 7, '66741b3fa7a297bc057144944ca49821.png', '2025-05-07 21:37:08'),
(8, 7, 'a1ac8d140d27dba4fbb56147b48c49ca.jpg', '2025-05-07 21:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `kosan`
--

CREATE TABLE `kosan` (
  `id` int NOT NULL,
  `pemilik_id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `google_maps_link` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text,
  `tipe` enum('putra','putri','campur') NOT NULL,
  `kepribadian` enum('introvert','extrovert','ambivert') NOT NULL,
  `status` enum('tersedia','disewa') DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_kamar` int NOT NULL DEFAULT '0',
  `kamar_tersedia` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`id`, `pemilik_id`, `nama`, `alamat`, `kecamatan`, `desa`, `google_maps_link`, `harga`, `deskripsi`, `tipe`, `kepribadian`, `status`, `created_at`, `jumlah_kamar`, `kamar_tersedia`) VALUES
(7, 11, 'Kodok Kentung', 'Gunung Myoboku', 'konoha', 'Daun', 'https://maps.app.goo.gl/ytkXCFdhuS9JYbgm8', '700000.00', 'Isinya anak informatika semua', 'putra', '', 'tersedia', '2025-05-07 21:37:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kosan_fasilitas`
--

CREATE TABLE `kosan_fasilitas` (
  `kosan_id` int NOT NULL,
  `fasilitas_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kosan_fasilitas`
--

INSERT INTO `kosan_fasilitas` (`kosan_id`, `fasilitas_id`) VALUES
(7, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('baru','diproses','selesai') DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perpanjangan_sewa`
--

CREATE TABLE `perpanjangan_sewa` (
  `id` int NOT NULL,
  `sewa_id` int NOT NULL,
  `durasi` int NOT NULL,
  `status` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int NOT NULL,
  `kosan_id` int NOT NULL,
  `penyewa_id` int NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('menunggu','aktif','selesai','ditolak') DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int NOT NULL,
  `kosan_id` int NOT NULL,
  `penyewa_id` int NOT NULL,
  `ulasan` text,
  `rating` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pemilik','penyewa') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `email`, `no_hp`, `foto_profil`, `created_at`) VALUES
(5, 'admin1', '$2y$10$r0ozFw4jxU5C6p9FO0dGd.xJq3QUpgkeYmz4KACy4zoKM.6Lj1dIa', 'admin', 'Admin', 'adminkos@gmail.com', NULL, NULL, '2025-05-03 07:28:25'),
(11, 'davina_karamoy', '$2y$10$70SYX0D8y74xudav/LsEAu1NS8SUFz2p3OhYrOZo0KDldtCaT.txG', 'pemilik', 'Davina Karamoy', 'davinakaramoy@gmail.com', '08310873073', 'fcc3f84df9c842f53b4879056ddf7dd8.jpeg', '2025-05-07 13:45:46'),
(12, 'master_ful', '$2y$10$CQaGVacNpFDjFTrEUXvBaus5Cg9nUWxfhVpC9Kfa/G/fRowDn4nXC', 'penyewa', 'Master Ful', 'masterful@gmail.com', '0880808080', '16ae5fdb9eb33e5ec79d170e67e03c7d.png', '2025-05-07 13:52:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_kosan`
--
ALTER TABLE `foto_kosan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kosan_id` (`kosan_id`);

--
-- Indexes for table `kosan`
--
ALTER TABLE `kosan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemilik_id` (`pemilik_id`);

--
-- Indexes for table `kosan_fasilitas`
--
ALTER TABLE `kosan_fasilitas`
  ADD PRIMARY KEY (`kosan_id`,`fasilitas_id`),
  ADD KEY `fasilitas_id` (`fasilitas_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `perpanjangan_sewa`
--
ALTER TABLE `perpanjangan_sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewa_id` (`sewa_id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kosan_id` (`kosan_id`),
  ADD KEY `penyewa_id` (`penyewa_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kosan_id` (`kosan_id`),
  ADD KEY `penyewa_id` (`penyewa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foto_kosan`
--
ALTER TABLE `foto_kosan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kosan`
--
ALTER TABLE `kosan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perpanjangan_sewa`
--
ALTER TABLE `perpanjangan_sewa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto_kosan`
--
ALTER TABLE `foto_kosan`
  ADD CONSTRAINT `foto_kosan_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`);

--
-- Constraints for table `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `kosan_ibfk_1` FOREIGN KEY (`pemilik_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kosan_fasilitas`
--
ALTER TABLE `kosan_fasilitas`
  ADD CONSTRAINT `kosan_fasilitas_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`),
  ADD CONSTRAINT `kosan_fasilitas_ibfk_2` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `perpanjangan_sewa`
--
ALTER TABLE `perpanjangan_sewa`
  ADD CONSTRAINT `perpanjangan_sewa_ibfk_1` FOREIGN KEY (`sewa_id`) REFERENCES `sewa` (`id`);

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`),
  ADD CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
