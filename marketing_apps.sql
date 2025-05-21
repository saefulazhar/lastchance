-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 09:48 PM
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
(4, 'Wi-Fi', '2025-05-19 16:56:57'),
(5, 'Ac', '2025-05-19 20:22:28'),
(6, 'Dapur', '2025-05-20 20:04:14');

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
(29, 25, '4d08d47e76070cbe7aaae1df72fd2bd3.jpg', '2025-05-21 06:35:48');

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
  `status` enum('aktif','menunggu','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_kamar` int NOT NULL DEFAULT '0',
  `kamar_tersedia` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`id`, `pemilik_id`, `nama`, `alamat`, `kecamatan`, `desa`, `google_maps_link`, `harga`, `deskripsi`, `tipe`, `kepribadian`, `status`, `created_at`, `jumlah_kamar`, `kamar_tersedia`) VALUES
(25, 14, 'fghgfhgfh', 'nbbmbnmn', 'mbnmbmb', 'bnmnbmnbm', '', '33423232.00', 'fgfgfgf', 'putra', 'introvert', 'aktif', '2025-05-21 06:35:48', 12, 11);

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
(25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kosan_id` int DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Diproses','Selesai') DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `status` enum('menunggu','aktif','selesai','ditolak','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `kosan_id`, `penyewa_id`, `tanggal_mulai`, `tanggal_selesai`, `status`, `created_at`) VALUES
(5, 25, 15, '2025-07-01', '2025-07-31', 'aktif', '2025-05-21 10:07:48');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sewa_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `kosan_id`, `penyewa_id`, `ulasan`, `rating`, `created_at`, `sewa_id`) VALUES
(1, 25, 15, 'mantap', 5, '2025-05-21 10:31:48', 5);

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
(5, 'admin1', '$2y$10$r0ozFw4jxU5C6p9FO0dGd.xJq3QUpgkeYmz4KACy4zoKM.6Lj1dIa', 'admin', 'Admin', 'adminkos@gmail.com', NULL, 'images1.jpeg', '2025-05-03 07:28:25'),
(14, 'oiwobo', '$2y$10$.rfiK4mP2dy1PJTw3xyjregoT9fwEBbgAJsB0l8VHRJaMe9JM8306', 'pemilik', 'Firdaus Oiwobo', 'firdausoiwobo@gmail.com', '083208459746', '2ab1120af7482bb8345c0ebc5fe4e967.jpg', '2025-05-20 19:34:55'),
(15, 'saeful_azhar', '$2y$10$jKbS/RxtH6h2W6wEq/NGduct22GIdWqrr33GOaQ6HUcoSCeq6opPm', 'penyewa', 'King Epul', 'masterful@gmail.com', '085278778787', '9f6cd8bbb58da91c4a49800dcbb06a0e.jpeg', '2025-05-20 22:35:08');

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kosan_id` (`kosan_id`);

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
  ADD KEY `penyewa_id` (`penyewa_id`),
  ADD KEY `fk_sewa_id` (`sewa_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foto_kosan`
--
ALTER TABLE `foto_kosan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kosan`
--
ALTER TABLE `kosan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perpanjangan_sewa`
--
ALTER TABLE `perpanjangan_sewa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto_kosan`
--
ALTER TABLE `foto_kosan`
  ADD CONSTRAINT `foto_kosan_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `kosan_ibfk_1` FOREIGN KEY (`pemilik_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kosan_fasilitas`
--
ALTER TABLE `kosan_fasilitas`
  ADD CONSTRAINT `kosan_fasilitas_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kosan_fasilitas_ibfk_2` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `perpanjangan_sewa`
--
ALTER TABLE `perpanjangan_sewa`
  ADD CONSTRAINT `perpanjangan_sewa_ibfk_1` FOREIGN KEY (`sewa_id`) REFERENCES `sewa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_sewa_id` FOREIGN KEY (`sewa_id`) REFERENCES `sewa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`kosan_id`) REFERENCES `kosan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`penyewa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
