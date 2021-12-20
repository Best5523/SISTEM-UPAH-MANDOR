-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 02:50 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upah`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE IF NOT EXISTS `akses` (
  `id` int(11) NOT NULL,
  `id_level` varchar(20) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `id_level`, `level`) VALUES
(1, '1', 'Administrator'),
(2, '2', 'Admin'),
(3, '3', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `area_proyek`
--

CREATE TABLE IF NOT EXISTS `area_proyek` (
  `id` int(20) NOT NULL,
  `kode_proyek` varchar(50) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `id_mandor` varchar(50) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mandor`
--

CREATE TABLE IF NOT EXISTS `mandor` (
  `id` int(20) NOT NULL,
  `id_mandor` int(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `bidang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_upah`
--

CREATE TABLE IF NOT EXISTS `master_upah` (
  `id` int(10) NOT NULL,
  `kode_upah` varchar(20) NOT NULL,
  `nama_upah` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opname`
--

CREATE TABLE IF NOT EXISTS `opname` (
  `id` int(20) NOT NULL,
  `kode_proyek` varchar(50) NOT NULL,
  `nama_proyek` varchar(50) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `kode_upah` int(50) NOT NULL,
  `nama_upah` varchar(50) NOT NULL,
  `id_mandor` varchar(50) NOT NULL,
  `nama_mandor` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE IF NOT EXISTS `proyek` (
  `id` int(20) NOT NULL,
  `kode_proyek` varchar(20) NOT NULL,
  `nama_proyek` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `kode_proyek`, `nama_proyek`, `alamat`) VALUES
(1, 'p.2001', 'HEAD OFFICE', 'Jl. Panjang no.55 Gedung Graha Multi'),
(2, 'p.2002', 'WAREHOUSE CAKUNG', '-'),
(3, 'p.2003', 'RS. CIKUPA CITRA RAYA', '-');

-- --------------------------------------------------------

--
-- Table structure for table `stok_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `stok_pekerjaan` (
  `id` int(20) NOT NULL,
  `kode_proyek` varchar(50) NOT NULL,
  `kode_upah` varchar(50) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `nik` varchar(20) COLLATE armscii8_bin NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `jabatan` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tlp` varchar(20) CHARACTER SET latin1 NOT NULL,
  `kode_proyek` varchar(20) CHARACTER SET latin1 NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_level` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `name`, `jabatan`, `tlp`, `kode_proyek`, `username`, `pass`, `id_level`) VALUES
(1, 'nik', 'Dedi Wibowo', 'Staff IT', '081558796392', 'p.2001', 'admin', 'admin', '1'),
(2, '1045.2006', 'Budijanto', 'Staff IT', '08551882035', 'p.2002', 'user', 'user', '2'),
(3, '3223.1025', 'Agung Wibowo', 'Staff IT', '085882826990', 'p.2003', 'admin', '123', '3'),
(28, '1234.1234', 'Abdu Rojak', 'Staff QS', '081558796392', 'p.2001', 'user', 'user', '3'),
(30, '1459.1804', 'Doni Setiawan', 'Costing', '08551881995', 'p.2001', 'doni-s', 'user', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
 ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `area_proyek`
--
ALTER TABLE `area_proyek`
 ADD PRIMARY KEY (`kode_proyek`,`id_mandor`);

--
-- Indexes for table `mandor`
--
ALTER TABLE `mandor`
 ADD PRIMARY KEY (`id_mandor`);

--
-- Indexes for table `master_upah`
--
ALTER TABLE `master_upah`
 ADD PRIMARY KEY (`kode_upah`);

--
-- Indexes for table `opname`
--
ALTER TABLE `opname`
 ADD PRIMARY KEY (`kode_proyek`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
 ADD PRIMARY KEY (`kode_proyek`);

--
-- Indexes for table `stok_pekerjaan`
--
ALTER TABLE `stok_pekerjaan`
 ADD PRIMARY KEY (`kode_proyek`,`kode_upah`), ADD KEY `kode_upah` (`kode_upah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`,`kode_proyek`,`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `stok_pekerjaan`
--
ALTER TABLE `stok_pekerjaan`
ADD CONSTRAINT `stok_pekerjaan_ibfk_1` FOREIGN KEY (`kode_upah`) REFERENCES `master_upah` (`kode_upah`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
