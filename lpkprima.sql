-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 12:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpkprima`
--

-- --------------------------------------------------------

--
-- Table structure for table `datagaji`
--

CREATE TABLE `datagaji` (
  `no` int(11) NOT NULL,
  `idkar` varchar(30) DEFAULT NULL,
  `gapok` varchar(20) DEFAULT NULL,
  `bonus` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `datapeserta`
--

CREATE TABLE `datapeserta` (
  `no` int(11) NOT NULL,
  `idkursus` varchar(30) DEFAULT NULL,
  `untuk` varchar(30) DEFAULT NULL,
  `stp` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datapeserta`
--

INSERT INTO `datapeserta` (`no`, `idkursus`, `untuk`, `stp`, `tgl`) VALUES
(1, 'ID-0002', 'komreg', 'end', '2024-12-11');

--
-- Triggers `datapeserta`
--
DELIMITER $$
CREATE TRIGGER `ubah_stp_promo` AFTER UPDATE ON `datapeserta` FOR EACH ROW UPDATE promo SET stp=new.stp WHERE idkursus=old.idkursus
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `no` int(11) NOT NULL,
  `idkar` varchar(30) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tplahir` varchar(50) DEFAULT NULL,
  `tglahir` date DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `jk` varchar(30) DEFAULT NULL,
  `pendter` varchar(100) DEFAULT NULL,
  `alamat` text,
  `nohp` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`no`, `idkar`, `nama`, `tplahir`, `tglahir`, `agama`, `jk`, `pendter`, `alamat`, `nohp`, `tgl`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'LJpwozS', 'usman', 'banjarmasin', '2024-12-11', 'Islam', 'Laki-laki', 's1', 'sdas', '22', '2024-12-11');

--
-- Triggers `karyawan`
--
DELIMITER $$
CREATE TRIGGER `hapus_pengguna` AFTER DELETE ON `karyawan` FOR EACH ROW DELETE FROM pengguna WHERE idkar=OLD.idkar
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `no` int(11) NOT NULL,
  `namakegiatan` text NOT NULL,
  `foto` varchar(500) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`no`, `namakegiatan`, `foto`, `tgl`) VALUES
(15, 'cewecew', '1734456416_istockphoto-610259354-612x612.jpg', '2024-12-17'),
(16, 'asdwd', '1734465978_istockphoto-610259354-612x612.jpg', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `nilaipeserta`
--

CREATE TABLE `nilaipeserta` (
  `no` int(11) NOT NULL,
  `idkursus` varchar(30) DEFAULT NULL,
  `nilai1` varchar(20) DEFAULT NULL,
  `nilai2` varchar(20) DEFAULT NULL,
  `nilai3` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilaipeserta`
--

INSERT INTO `nilaipeserta` (`no`, `idkursus`, `nilai1`, `nilai2`, `nilai3`, `tgl`) VALUES
(1, 'ID-0002', '76', '76', '66', '2024-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int(11) NOT NULL,
  `idkursus` varchar(30) DEFAULT NULL,
  `biaya` varchar(30) DEFAULT NULL,
  `untuk` varchar(30) NOT NULL,
  `ket` text,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `idkursus`, `biaya`, `untuk`, `ket`, `tgl`) VALUES
(1, 'ID-0002', '445000', 'komreg', 'Promo Diskon 11% Berlaku Sampai Tanggal 17 Des 2024', '2024-12-11');

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `tambahkan_datapeserta` AFTER INSERT ON `pembayaran` FOR EACH ROW INSERT INTO datapeserta (idkursus, untuk, stp) VALUES (new.idkursus, new.untuk, 'ok')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `no` int(11) NOT NULL,
  `idkar` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`no`, `idkar`, `user`, `pass`, `level`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'LJpwozS', 'ID-002', 'LJpwozS', 'kurkom');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `no` int(11) NOT NULL,
  `idkursus` varchar(30) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tplahir` varchar(50) DEFAULT NULL,
  `tglahir` date DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `jk` varchar(30) DEFAULT NULL,
  `pendter` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `nohp` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`no`, `idkursus`, `foto`, `nama`, `tplahir`, `tglahir`, `agama`, `jk`, `pendter`, `pekerjaan`, `alamat`, `nohp`, `tgl`) VALUES
(2, 'ID-0001', '', 'ad', 'ada', '2024-12-11', 'Islam', 'Laki-laki', 'asdas', 'asdasd', 'dasdasdas', '0219999', '2024-12-11'),
(3, 'ID-0002', '', 'acasc', 'cacas', '2024-12-11', 'Islam', 'Laki-laki', 'csacas', 'casc', 'sacasc', 'cascas', '2024-12-11'),
(4, 'ID-0003', '', 'avsa', 'savsav', '2024-12-17', 'Islam', 'Laki-laki', 'savsa', 'asvav', 'savsa', 'savasv', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `no` int(11) NOT NULL,
  `idkursus` varchar(30) DEFAULT NULL,
  `kodepromo` varchar(50) DEFAULT NULL,
  `promo` varchar(50) DEFAULT NULL,
  `biaya` varchar(30) DEFAULT NULL,
  `tglakhir` date DEFAULT NULL,
  `untuk` varchar(30) DEFAULT NULL,
  `stp` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`no`, `idkursus`, `kodepromo`, `promo`, `biaya`, `tglakhir`, `untuk`, `stp`, `tgl`) VALUES
(3, NULL, 'TAIIkFU', '12', '500000', '2024-12-10', 'komreg', 'in', '2024-12-11'),
(4, 'ID-0002', 'uRAQjM8', '11', '500000', '2024-12-17', 'komreg', 'end', '2024-12-11'),
(5, 'ID-0003', 'HOoZu9c', '232', '750000', '2024-12-15', 'kompri', 'out', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `sarpra`
--

CREATE TABLE `sarpra` (
  `no` int(11) NOT NULL,
  `ket` text,
  `biaya` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datagaji`
--
ALTER TABLE `datagaji`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `datapeserta`
--
ALTER TABLE `datapeserta`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `nilaipeserta`
--
ALTER TABLE `nilaipeserta`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `sarpra`
--
ALTER TABLE `sarpra`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datagaji`
--
ALTER TABLE `datagaji`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datapeserta`
--
ALTER TABLE `datapeserta`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nilaipeserta`
--
ALTER TABLE `nilaipeserta`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sarpra`
--
ALTER TABLE `sarpra`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
