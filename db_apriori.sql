-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 01:38 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apriori`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_faktur`
--

CREATE TABLE `tb_detail_faktur` (
  `id_detail_faktur` int(11) NOT NULL,
  `no_faktur` varchar(10) NOT NULL,
  `kode_obat` varchar(10) NOT NULL,
  `jumlah` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_faktur`
--

INSERT INTO `tb_detail_faktur` (`id_detail_faktur`, `no_faktur`, `kode_obat`, `jumlah`) VALUES
(1, 'F101217001', '1', 10),
(2, 'F101217001', '10', 11),
(3, 'F101217001', '11', 12),
(4, 'F101217001', '12', 13),
(5, 'F101217001', '13', 14),
(6, 'F101217001', '14', 15),
(7, 'F121217001', '1', 100),
(8, 'F121217001', '10', 100),
(9, 'F121217001', '11', 100),
(10, 'F121217001', '12', 100),
(11, 'F121217001', '13', 100),
(12, 'F121217001', '14', 100),
(13, 'F121217001', '15', 100),
(14, 'F121217001', '16', 100),
(15, 'F121217001', '17', 100),
(16, 'F121217001', '18', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `kode_obat` varchar(10) NOT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `no_transaksi`, `kode_obat`, `jumlah`) VALUES
(1, 'T101217001', '1', 9),
(2, 'T101217001', '14', 10),
(3, 'T111217001', '1', 1),
(4, 'T111217001', '10', 5),
(5, 'T111217001', '11', 9),
(6, 'T111217001', '12', 4),
(7, 'T111217001', '13', 7),
(8, 'T111217001', '14', 2),
(9, 'T121217001', '1', 5),
(10, 'T121217001', '10', 9),
(11, 'T121217001', '18', 10),
(12, 'T121217002', '13', 5),
(13, 'T121217002', '14', 4),
(14, 'T121217002', '15', 6),
(15, 'T121217002', '16', 2),
(16, 'T121217003', '10', 7),
(17, 'T121217003', '11', 1),
(18, 'T121217003', '14', 4),
(19, 'T121217003', '16', 8),
(20, 'T121217004', '12', 9),
(21, 'T121217004', '17', 8),
(22, 'T121217005', '12', 10),
(23, 'T121217005', '13', 14),
(24, 'T121217005', '15', 6),
(25, 'T121217006', '18', 8),
(26, 'T121217007', '11', 7),
(27, 'T121217007', '17', 10),
(28, 'T121217008', '11', 8),
(29, 'T121217008', '16', 1),
(30, 'T121217009', '1', 1),
(31, 'T121217009', '10', 5),
(32, 'T121217009', '18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_faktur`
--

CREATE TABLE `tb_faktur` (
  `no_faktur` varchar(10) NOT NULL,
  `kode_staff` varchar(10) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `waktu_faktur` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_faktur`
--

INSERT INTO `tb_faktur` (`no_faktur`, `kode_staff`, `tanggal_faktur`, `waktu_faktur`) VALUES
('F101217001', 'staff', '2017-12-10', '21:12:56'),
('F121217001', 'staff', '2017-12-12', '05:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasir`
--

CREATE TABLE `tb_kasir` (
  `kode_kasir` varchar(10) NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `no_laporan` varchar(20) NOT NULL,
  `kode_staff` varchar(10) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `tanggal_cetak` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `kode_obat` varchar(10) NOT NULL,
  `nama_obat` varchar(50) DEFAULT NULL,
  `jenis` varchar(20) NOT NULL,
  `ukuran` varchar(3) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`kode_obat`, `nama_obat`, `jenis`, `ukuran`, `harga`, `stok`) VALUES
('1', 'Cefadroxil Forte', 'Cair', 'ml', 25000, 94),
('10', 'Intranervit E', 'Kaplet', 'mg', 35000, 85),
('11', 'Kalnex', 'Kaplet', 'mg', 15000, 87),
('12', 'Leomoxyl', 'Kaplet', 'mg', 25000, 90),
('13', 'Megasonum', 'Kaplet', 'mg', 25000, 88),
('14', 'sabutamol', 'Kaplet', 'mg', 20000, 95),
('15', 'Erlamyctin salep mata', 'Salap', 'mg', 10000, 88),
('16', 'Betadin salep', 'Salap', 'mg', 15000, 89),
('17', 'Vitamin C', 'Kaplet', 'mg', 30000, 82),
('18', 'Vitamin B complex', 'Kaplet', 'mg', 20000, 81),
('19', 'Trifamol', 'Cair', 'ml', 25000, 0),
('2', 'Acyclovir', 'Kaplet', 'mg', 15000, 0),
('20', 'Molexflu', 'Cair', 'ml', 25000, 0),
('3', 'Bactoprim combi', 'Cair', 'ml', 20000, 0),
('4', 'Cefadroxil', 'Kaplet', 'mg', 15000, 0),
('5', 'Dionicol', 'Kaplet', 'mg', 15000, 0),
('6', 'Etadium', 'Kaplet', 'mg', 20000, 0),
('7', 'Farmalat', 'Kaplet', 'mg', 15000, 0),
('8', 'Hufaxol', 'Kaplet', 'mg', 15000, 0),
('9', 'Graprima', 'Kaplet', 'mg', 15000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `kode_staff` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_transaksi` varchar(10) NOT NULL,
  `kode_kasir` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `waktu_transaksi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `kode_kasir`, `tanggal_transaksi`, `waktu_transaksi`) VALUES
('T101217001', 'kasir', '2017-12-10', '21:12:41'),
('T111217001', 'kasir', '2017-12-11', '10:12:03'),
('T121217001', 'kasir', '2017-12-12', '05:12:44'),
('T121217002', 'kasir', '2017-12-12', '05:12:20'),
('T121217003', 'kasir', '2017-12-12', '05:12:47'),
('T121217004', 'kasir', '2017-12-12', '06:12:15'),
('T121217005', 'kasir', '2017-12-12', '06:12:34'),
('T121217006', 'kasir', '2017-12-12', '06:12:43'),
('T121217007', 'kasir', '2017-12-12', '06:12:01'),
('T121217008', 'kasir', '2017-12-12', '06:12:22'),
('T121217009', 'kasir', '2017-12-12', '06:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(40) DEFAULT NULL,
  `level` varchar(20) NOT NULL,
  `s_aktif` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `nama_lengkap`, `level`, `s_aktif`) VALUES
('kasir', '827ccb0eea8a706c4c34a16891f84e7b', 'kasir', 'kasir', 1),
('staff', '827ccb0eea8a706c4c34a16891f84e7b', 'staff', 'staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_faktur`
--
ALTER TABLE `tb_detail_faktur`
  ADD PRIMARY KEY (`id_detail_faktur`),
  ADD KEY `no_faktur` (`no_faktur`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `tb_faktur`
--
ALTER TABLE `tb_faktur`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `kode_staff` (`kode_staff`);

--
-- Indexes for table `tb_kasir`
--
ALTER TABLE `tb_kasir`
  ADD PRIMARY KEY (`kode_kasir`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`no_laporan`),
  ADD KEY `kode_staff` (`kode_staff`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`kode_staff`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `kode_staff` (`kode_kasir`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_faktur`
--
ALTER TABLE `tb_detail_faktur`
  MODIFY `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_faktur`
--
ALTER TABLE `tb_detail_faktur`
  ADD CONSTRAINT `tb_detail_faktur_ibfk_3` FOREIGN KEY (`kode_obat`) REFERENCES `tb_obat` (`kode_obat`);

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `tb_obat` (`kode_obat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
