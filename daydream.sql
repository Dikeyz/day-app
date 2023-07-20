-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 03:26 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daydream`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `nama_akun` varchar(255) NOT NULL,
  `no_reff` int(10) NOT NULL,
  `ket_akun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`nama_akun`, `no_reff`, `ket_akun`) VALUES
('101-KAS DI TANGAN', 101, 'DEBIT'),
('105-KAS DI BANK', 105, 'KREDIT'),
('126-PERSEDIAAN', 126, 'DEBIT'),
('129-SEWA BAYAR DI MUKA', 129, 'DEBIT'),
('130-ASURANSI BAYAR DIMUKA', 130, 'DEBIT'),
('153-PERLENGKAPAN/ PERALATAN', 153, 'DEBIT'),
('154-PENUSUTAN PERALATAN', 154, 'DEBIT'),
('200-UTANG WESEL', 200, 'KREDIT'),
('201-HUTANG', 201, 'KREDIT'),
('209-PENDAPATAN DITERIMA DI MUKA', 209, 'KREDIT'),
('212-HUTANG GAJI', 212, 'KREDIT'),
('230-HUTANG BUNGA', 230, 'KREDIT'),
('311-MODAL', 311, 'KREDIT'),
('332-DIVIDEN', 332, 'KREDIT'),
('400-PENDAPATAN JASA', 400, 'KREDIT'),
('610-BEBAN IKLAN', 610, 'DEBIT'),
('621-BEBAN PENYUSUTAN PERALATAN', 621, 'DEBIT'),
('631-BEBAN PERSEDIAAN', 631, 'DEBIT'),
('726-BEBAN GAJI', 726, 'DEBIT'),
('729-BEBAN SEWA', 729, 'DEBIT'),
('730-BEBAN ASURANSI', 730, 'DEBIT'),
('731-BIAYA UTILITAS', 731, 'DEBIT'),
('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN', 735, 'DEBIT'),
('740-BIAYA BENSIN', 740, 'DEBIT'),
('741-BEBAN BUNGA', 741, 'DEBIT');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tgl_transaksi` varchar(20) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_akun` int(10) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `saldo` int(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tgl_transaksi`, `keterangan`, `no_akun`, `nama_akun`, `saldo`, `jenis`, `user_id`) VALUES
(117, '12/19/2021', 'Bayar uang asuransi', 101, 'Pilih Nama Akun', 2460000, 'Kredit', 36),
(118, '12/19/2021', 'Bayar uang asuransi', 130, 'Pilih Nama Akun', 2460000, 'Debit', 36),
(119, '12/15/2021', 'Uang Beasiswa Aktivitas Kemahasiswaan', 105, '105-KAS DI BANK', 1500000, 'Kredit', 37),
(120, '12/15/2021', 'Uang Beasiswa Aktivitas Kemahasiswaan', 101, '101-KAS DI TANGAN', 1500000, 'Debit', 37),
(121, '12/17/2021', 'Belajar Saham Edisi #1', 105, '311-MODAL', 130900, 'Kredit', 37),
(122, '12/17/2021', 'Belajar Saham Edisi #1', 332, '332-DIVIDEN', 130900, 'Debit', 37),
(123, '12/20/2021', 'Studi Kasus 01', 101, '101-KAS DI TANGAN', 250000, 'Debit', 37),
(124, '12/20/2021', 'Studi Kasus 01', 105, '105-KAS DI BANK', 250000, 'Kredit', 37),
(125, '12/21/2021', 'Studi Kasus 02', 105, '105-KAS DI BANK', 78900, 'Debit', 37),
(126, '12/21/2021', 'Studi Kasus 02', 101, '101-KAS DI TANGAN', 78900, 'Kredit', 37);

-- --------------------------------------------------------

--
-- Table structure for table `user2`
--

CREATE TABLE `user2` (
  `nama` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `umkm` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user2`
--

INSERT INTO `user2` (`nama`, `username`, `pass`, `email`, `user_id`, `umkm`, `no_hp`) VALUES
(' Ruben Onsu', 'geprekbensu', '$2y$10$OhRFVJsLvb3Yz9bK/RY5CuKQj9TCkaXbWIx6zI1/lCOIZ9S4ibKS2', 'geprekbensu@gmail.com', 34, 'Ayam Geprek Bensu', '089765465342'),
('admin', 'admin', '$2y$10$cjYdqT23jiKzlUjoPVYE4OXWD1JIDcPYtcGVxNNF3ivcXiM5Z2Z86', 'admin@gmail.com', 35, 'admin', '098789789765'),
('Jason Ranti Dea', 'jason', '$2y$10$59SxlySRLt4Ps3gaay6xxucHVFidGFVYlLWiyxVGqsTeGbl3TTH62', 'jasonrantideaananda@gmail.com', 36, 'Bengkel Pak Jason Ranti', '140998'),
('Dea Ananda Gunawan', 'deaanandagnw', '$2y$10$azBihJgrme3Wtk3Que0yYe3flVnJUtBpkoS8fLXPfgQb7zv6mEtO.', 'deaanandagunawan@gmail.com', 37, 'Hotel California', '083157206433');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_reff`),
  ADD KEY `nama_akun` (`nama_akun`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tgl_transaksi` (`tgl_transaksi`),
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `nama_akun` (`nama_akun`),
  ADD KEY `saldo` (`saldo`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user2`
--
ALTER TABLE `user2`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_reff`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user2` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
