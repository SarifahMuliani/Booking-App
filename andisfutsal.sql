-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 05:28 PM
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
-- Database: `andisfutsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `id_datauser` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `alamat_penyewa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`id_datauser`, `user_id`, `email`, `no_telp`, `jenis_kelamin`, `ktp`, `alamat_penyewa`) VALUES
(1, 10, 'ridhoahadi2003@gmail.com', '082390474397', 'Laki-Laki', '1212121212', 'Benayah'),
(2, 11, 'ridhoahadi2002@gmail.com', '082212121122', 'Laki-Laki', '1222111112222', 'SIAK'),
(3, 12, 'untung242@gmail.com', '082285840508', 'Laki-Laki', '123456676', 'jl. ampera'),
(4, 13, 'roby@email.com', '01830979142', 'Laki-Laki', '1379711946', 'SIAK'),
(5, 14, NULL, NULL, NULL, NULL, NULL),
(6, 15, NULL, NULL, NULL, NULL, NULL),
(7, 16, 'udin77@gmail.com', '087654321123', 'Laki-Laki', '123456789', 'jl. mustamindo 2');

-- --------------------------------------------------------

--
-- Table structure for table `data_sewa`
--

CREATE TABLE `data_sewa` (
  `id_sewa` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `lap_id` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `tempo` varchar(255) DEFAULT NULL,
  `jam_mulai` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `konfirmasi` varchar(255) NOT NULL,
  `bukti_tf` varchar(255) NOT NULL,
  `dokumen` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_sewa`
--

INSERT INTO `data_sewa` (`id_sewa`, `id_user`, `lap_id`, `tanggal`, `tempo`, `jam_mulai`, `jam_selesai`, `keterangan`, `konfirmasi`, `bukti_tf`, `dokumen`) VALUES
(4, 11, 2, '2023-12-31', '09:51:30', '10:00', '12:00', 'Selesai', 'Sudah di Konfirmasi', '6590d033902542023-12-17Android Large - 2.png', NULL),
(5, 10, 2, '2024-01-01', '12:46:06', '12:00', '13:00', '-', 'Sudah di Konfirmasi', '6590f93fa2f6b2023-12-17Android Large - 1 (2).png', NULL),
(6, 10, 2, '2024-01-03', '22:03:07', '10:00', '12:00', '-', 'Belum di Konfirmasi', '-', NULL),
(7, 10, 3, '2024-01-05', '03:01:04', '12:00', '13:00', 'Selesai', 'Belum di Konfirmasi', '-', NULL),
(8, 10, 4, '2024-01-05', '03:25:36', '06:00', '12:00', '-', 'Belum di Konfirmasi', '-', NULL),
(9, 12, 3, '2024-01-05', '13:02:36', '15:32', '16:32', 'Sedang di Cek', 'Belum di Konfirmasi', '6596431321e76laporan.png', NULL),
(10, 13, 13, '2024-01-20', '20:37:44', '16:00', '18:00', 'Selesai', 'Belum di Konfirmasi', '-', NULL),
(11, 10, 13, '2024-01-04', '21:20:14', '10:00', '11:00', 'Selesai', 'Sudah di Konfirmasi', '6596b7dea7994lp25.jpg', NULL),
(12, 10, 13, '2024-01-04', '21:20:14', '10:00', '11:00', 'Selesai', 'Sudah di Konfirmasi', '6596b8c855d88lp23.jpg', NULL),
(13, 10, 14, '2024-01-04', '21:28:58', '12:00', '14:00', 'Selesai', 'Sudah di Konfirmasi', '6596b9ae70f7blp24.jpg', NULL),
(14, 10, 13, '2024-01-04', '21:34:51', '11:00', '12:00', '-', 'Belum di Konfirmasi', '-', NULL),
(15, 10, 1, '2024-01-27', '20:33:45', '08:00', '10:59', 'Sedang di Cek', 'Belum di Konfirmasi', '6597fe58a6e3aPROFIL (1).png', NULL),
(16, 16, 1, '2024-01-06', '21:13:21', '15:30', '17:30', 'Sedang di Cek', 'Belum di Konfirmasi', '659807902c80dVisit LP1.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image_lapangan`
--

CREATE TABLE `image_lapangan` (
  `id_image` bigint(20) UNSIGNED NOT NULL,
  `lapangan_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_lapangan`
--

INSERT INTO `image_lapangan` (`id_image`, `lapangan_id`, `filename`, `path`, `updated_at`, `created_at`) VALUES
(1, 1, 'fdb0a74f7c1fd29208f4cab452e25baa', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\fdb0a74f7c1fd29208f4cab452e25baa', NULL, NULL),
(2, 1, '2501e667d089f3e8b68e1a486ce6c786', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\2501e667d089f3e8b68e1a486ce6c786', NULL, NULL),
(3, 1, 'cd027f24350a16bb9f270d96c2d482ef', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\cd027f24350a16bb9f270d96c2d482ef', NULL, NULL),
(7, 2, '07677d51093cad9774b2ea26ce299c32', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\07677d51093cad9774b2ea26ce299c32', NULL, NULL),
(8, 2, '5709ed99368ea08b0845e2be1b2198fa', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\5709ed99368ea08b0845e2be1b2198fa', NULL, NULL),
(9, 2, 'c81bcd8b34bc8f4c7b8211ac6bc5e0ed', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\c81bcd8b34bc8f4c7b8211ac6bc5e0ed', NULL, NULL),
(10, 3, 'b06e318cf014f541bf8a127381f3a597', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\b06e318cf014f541bf8a127381f3a597', NULL, NULL),
(11, 3, '968ca1d708c7089b26a51818d5980352', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\968ca1d708c7089b26a51818d5980352', NULL, NULL),
(12, 3, 'b92051ab28da2bcbd37b6c2890c6d7b5', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\b92051ab28da2bcbd37b6c2890c6d7b5', NULL, NULL),
(13, 4, '24cc3ed963b11e91c778cad108eb266f', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\24cc3ed963b11e91c778cad108eb266f', NULL, NULL),
(14, 4, '3adb4e1ae6d29074791406092eae873d', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\3adb4e1ae6d29074791406092eae873d', NULL, NULL),
(15, 4, '9987352aaf037d53bfdb4a5eb896dd87', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\9987352aaf037d53bfdb4a5eb896dd87', NULL, NULL),
(16, 5, '0bd62d089e6515c86c8281b3c8bf8b82', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\0bd62d089e6515c86c8281b3c8bf8b82', NULL, NULL),
(17, 5, '5d6cc4bc67a20284bc6d936a82101d0b', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\5d6cc4bc67a20284bc6d936a82101d0b', NULL, NULL),
(18, 6, 'ed21bb3bfb7aee101103a1d9dec07ee5', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\ed21bb3bfb7aee101103a1d9dec07ee5', NULL, NULL),
(19, 6, '3b0d5a5df3bfa2d62ad8d3f72d11b738', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\3b0d5a5df3bfa2d62ad8d3f72d11b738', NULL, NULL),
(22, 14, '1f53e02675c5f5ca2cd19e28b88fbd2d', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\1f53e02675c5f5ca2cd19e28b88fbd2d', NULL, NULL),
(23, 14, '93db5eb382dbeecd776e8c686ae1fbe1', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\93db5eb382dbeecd776e8c686ae1fbe1', NULL, NULL),
(25, 13, 'dba760be5c1f78552d26deccd9fbeb1e', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\dba760be5c1f78552d26deccd9fbeb1e', NULL, NULL),
(26, 13, '19804c82990350be00d665f61aab2bcc', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\19804c82990350be00d665f61aab2bcc', NULL, NULL),
(28, 18, 'fb08ac28c90a178ab182855b65d1b1df', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\fb08ac28c90a178ab182855b65d1b1df', NULL, NULL),
(29, 19, '7e2c1366d3ed5de3e7175bdc51218a4c', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\7e2c1366d3ed5de3e7175bdc51218a4c', NULL, NULL),
(31, 20, '9f313aacc0d16a47273c8a7926dcf619', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\9f313aacc0d16a47273c8a7926dcf619', NULL, NULL),
(32, 21, 'ef89c4aac33fbd5fe63cbfb32de927df', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\ef89c4aac33fbd5fe63cbfb32de927df', NULL, NULL),
(33, 21, '93db5eb382dbeecd776e8c686ae1fbe1', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\93db5eb382dbeecd776e8c686ae1fbe1', NULL, NULL),
(34, 20, 'e8b12619ee46491d43326f6a3046a2bc', 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/image\\e8b12619ee46491d43326f6a3046a2bc', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nama_lapangan`
--

CREATE TABLE `nama_lapangan` (
  `id_lapangan` bigint(20) UNSIGNED NOT NULL,
  `nama_lap` varchar(255) NOT NULL,
  `nama_jenis` varchar(250) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `det_lapangan` varchar(255) NOT NULL,
  `tgl` date DEFAULT NULL,
  `path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nama_lapangan`
--

INSERT INTO `nama_lapangan` (`id_lapangan`, `nama_lap`, `nama_jenis`, `harga`, `gambar`, `kegiatan`, `det_lapangan`, `tgl`, `path`) VALUES
(1, 'Lapangan 1', 'Matras Rumput', 100000, '9f313aacc0d16a47273c8a7926dcf619', 'Futsal', 'Lapangan Futsal, Dengan Dimensinya Yang Kompak Dan Menjadi Tempat Yang Ideal Untuk Merasakan Kegiatan Olahraga Sepak Bola Mini.', NULL, 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/gambar\\9f313aacc0d16a47273c8a7926dcf619'),
(2, 'Lapangan 2', 'Matras Rumput', 100000, 'bd2b1f8e726b326ebb8ec221d66e422c', 'Futsal', 'Lapangan Futsal, Dengan Dimensinya Yang Kompak Dan Menjadi Tempat Yang Ideal Untuk Merasakan Kegiatan Olahraga Sepak Bola Mini.', NULL, 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/gambar\\bd2b1f8e726b326ebb8ec221d66e422c'),
(3, 'Lapangan 3', 'Matras Rumput', 100000, 'a865eef0392078ad938dd7991dd26461', 'Futsal', 'Lapangan Futsal, Dengan Dimensinya Yang Kompak Dan Menjadi Tempat Yang Ideal Untuk Merasakan Kegiatan Olahraga Sepak Bola Mini.', NULL, 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/gambar\\a865eef0392078ad938dd7991dd26461'),
(4, 'Lapangan 4', 'Matras Rumput', 100000, 'cf0c201d7920cf41e5af059dbc255b04', 'Futsal', 'Lapangan Futsal, Dengan Dimensinya Yang Kompak Dan Menjadi Tempat Yang Ideal Untuk Merasakan Kegiatan Olahraga Sepak Bola Mini.', NULL, 'D:\\UIN SUSKA RIAU\\Semester 5\\RPLBO\\Andi\'s Futsal/public/gambar\\cf0c201d7920cf41e5af059dbc255b04');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` bigint(20) UNSIGNED NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `nama_rek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `no_rek`, `nama_rek`) VALUES
(1, '7174075969', 'RIDHO AHADI'),
(2, '717407591212', 'AHADRID'),
(3, '7174075969111', 'Yoga');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` bigint(20) UNSIGNED NOT NULL,
  `nama_profil` varchar(255) DEFAULT NULL,
  `jenis_apk` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `no_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_profil`, `jenis_apk`, `lokasi`, `no_profil`) VALUES
(1, 'Andi\'s Futsal', 'Penyewaan Lapangan Futsal', 'F9JF+34V, jl. kamboja belakang gedung putih, Simpang Baru, Kec. Tampan, Kota Pekanbaru, Riau 28292', '082289402962');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status_user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `status_user`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'ADMIN', '$2y$10$L3zygYVZMmAGqkwui6Q.0eiVvx03qBh0zf/fYov0kp/JPEiRroSg6', 'Admin', 'Aktif', NULL, NULL),
(10, 'Ridho Ahadi', 'ahadrid', '$2y$10$XHTGiU0bWhdg8MIaHXEvY.kOUE1NbJ4Lgef5dCb3CAGx4tYwoTQOm', 'Penyewa', 'Non-Aktif', '2023-12-31 01:43:26', '2023-12-31 01:43:26'),
(11, 'Ridho Ahadi', 'ridho', '$2y$10$VYTjgGPy2bR7OrogoXi8aONUUxtB561y/lXXnNL0t9c0LS7y5Qh.K', 'Penyewa', 'Aktif', '2023-12-31 02:11:06', '2023-12-31 02:11:06'),
(12, 'untung', 'untung', '$2y$10$ldXyXk/sbmUfSrVtM20/3uwcKB9UABSerz0NBJnS1ocnPQT9jUczq', 'Penyewa', 'Aktif', '2024-01-04 05:28:32', '2024-01-04 05:28:32'),
(13, 'Ridho Ahadi', 'roby@email.com', '$2y$10$qrjbAAXzVKa82hkBhlB4i.o4oNwndAY2e4eFXoDz2uAfvsXqwqpIu', 'Penyewa', 'Aktif', '2024-01-04 12:59:25', '2024-01-04 12:59:25'),
(14, 'robi', 'robi', '$2y$10$nBlWoEOAymqTvqPjP3KCReGpMIevZ3C53LEIYeOUnIcezLANUkZ5a', 'Penyewa', 'Aktif', '2024-01-04 14:24:57', '2024-01-04 14:24:57'),
(15, 'Yoga', 'yoga', '$2y$10$1u4AVK5sXsRwSl15MCOAAOLFknfaSUDK.ZRVEeCmeMn53NIZ24tCq', 'Penyewa', 'Aktif', '2024-01-04 14:30:40', '2024-01-04 14:30:40'),
(16, 'udin', 'udin', '$2y$10$0cR9j5V3ojkPkq3LX0jHK.dUJi0cu2A5ycxRbcBTVVRb.c2BKxB42', 'Penyewa', 'Aktif', '2024-01-05 13:39:43', '2024-01-05 13:39:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`id_datauser`);

--
-- Indexes for table `data_sewa`
--
ALTER TABLE `data_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `image_lapangan`
--
ALTER TABLE `image_lapangan`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `nama_lapangan`
--
ALTER TABLE `nama_lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datauser`
--
ALTER TABLE `datauser`
  MODIFY `id_datauser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_sewa`
--
ALTER TABLE `data_sewa`
  MODIFY `id_sewa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `image_lapangan`
--
ALTER TABLE `image_lapangan`
  MODIFY `id_image` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `nama_lapangan`
--
ALTER TABLE `nama_lapangan`
  MODIFY `id_lapangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
