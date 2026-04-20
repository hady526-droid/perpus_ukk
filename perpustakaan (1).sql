-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 09:29 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nis`, `nama`, `kelas`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(10, '56789', 'wildan', 'XII PPLG', 'bekasi', '0863728292', '2026-04-17 08:36:41', '2026-04-17 09:18:44'),
(11, '55555', 'deden', 'XII PPLG', 'cfghj', '0854398', '2026-04-17 09:17:11', '2026-04-17 09:17:11'),
(12, '222222', 'wahyu', 'XII TIK', 'tanggerang', '87642315', '2026-04-17 09:26:03', '2026-04-17 09:26:03'),
(13, '111111', 'dwi', 'XII PPLG', 'cilodong', '08453211', '2026-04-17 09:33:29', '2026-04-17 09:33:29'),
(14, '999999', 'kante', 'XII TIK', 'citayem', '09876789', '2026-04-17 09:58:25', '2026-04-17 09:58:25'),
(15, '444444', 'hady', 'XXI PPLG', 'serab', '08456789', '2026-04-17 10:39:21', '2026-04-17 10:39:21'),
(16, '000000', 'hadi', 'XII PPLG', 'serab', '08438765', '2026-04-17 13:53:24', '2026-04-17 13:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 1,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `stok`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'BK001', 'melangkah', 'J.S. Khairen', 'TransMediaPustaka', 2005, 'Novel', 4, '', '2026-01-29 10:42:48', '2026-04-17 14:21:45'),
(2, 'BK002', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'Novel', 3, 'Novel sejarah tentang perjuangan melawan kolonialisme', '2026-01-29 10:42:48', '2026-04-17 10:36:07'),
(3, 'BK003', 'maling kundang', 'apriala dwi', 'mulia jaya surabaya', 2009, 'Novel', 10, 'anak yang durhaka', '2026-01-29 10:42:48', '2026-04-17 10:20:40'),
(4, 'BK004', 'burung kenari', 'aisya', 'Erlangga', 2020, 'Novel', 7, '', '2026-01-29 10:42:48', '2026-04-20 13:26:47'),
(5, 'BK005', 'WWII', 'Rizem Aizid.', ' DIVA Press.', 2008, 'Sejarah', 3, 'Sejarah perang dunia\r\n', '2026-01-29 10:42:48', '2026-04-17 14:20:59'),
(6, 'BK006', 'ini arahnya kemana', 'sukitman', 'hady', 2026, 'Lainnya', 3, '', '2026-01-29 14:18:18', '2026-04-17 13:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan','terlambat') NOT NULL DEFAULT 'dipinjam',
  `denda` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_anggota`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_dikembalikan`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(17, 13, 6, '2026-04-17', '2026-04-24', NULL, 'dipinjam', 0, '2026-04-17 09:44:57', '2026-04-17 09:44:57'),
(18, 14, 2, '2026-04-17', '2026-04-24', '2026-04-17', 'dikembalikan', 0, '2026-04-17 10:05:15', '2026-04-17 10:36:07'),
(20, 16, 6, '2026-04-17', '2026-04-24', NULL, 'dipinjam', 0, '2026-04-17 13:53:52', '2026-04-17 13:53:52'),
(21, 16, 5, '2026-04-17', '2026-04-24', NULL, 'dipinjam', 0, '2026-04-17 14:20:59', '2026-04-17 14:20:59'),
(22, 14, 4, '2026-04-20', '2026-04-27', NULL, 'dipinjam', 0, '2026-04-20 13:26:47', '2026-04-20 13:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL DEFAULT 'siswa',
  `id_anggota` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `id_anggota`, `created_at`, `updated_at`) VALUES
(7, 'admin', '$2y$10$eAnYIo1LSYKU9G890MXQaO2I0gKQ1aHatIr7vHrMVeeNa.wBie6aO', 'admin', NULL, '2026-01-29 10:52:39', '2026-01-29 10:56:00'),
(16, '111111', '$2y$10$sCI.xCuSxBfVonHkA.Es1O6rVBNWJyVvpBFcSg/wSbyS/kQHfFlxq', 'siswa', 13, '2026-04-17 09:33:30', '2026-04-17 09:33:30'),
(17, '999999', '$2y$10$aNcxbe2/ieMXTQs2T4kCKe73YdwZ0HJ0Qkl20NED0n2hUaC3vKre6', 'siswa', 14, '2026-04-17 09:58:25', '2026-04-17 09:58:25'),
(18, '444444', '$2y$10$lqTN1xvGRePaDvig2v8SE.x6AxTB4cGRdqSxXSGhuWAR.gnlPRi3y', 'siswa', 15, '2026-04-17 10:39:22', '2026-04-17 10:39:22'),
(19, '000000', '$2y$10$CWJyWQoRRgY0g6TUmfkDDepwbOata9HSRU5edJmT/Qd6u/XrkOMzu', 'siswa', 16, '2026-04-17 13:53:24', '2026-04-17 13:53:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
