-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2019 at 02:52 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kereta`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `idlogin` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','CEO','produksi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idlogin`, `username`, `password`, `level`) VALUES
(1, 'dhe', '123', 'produksi'),
(2, 'zak', '1234', 'CEO'),
(3, 'fir', '12345', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idPegawai` varchar(10) NOT NULL,
  `namaPegawai` varchar(20) DEFAULT NULL,
  `jabatan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idPegawai`, `namaPegawai`, `jabatan`) VALUES
('12336', 'jojko', 'Admin'),
('12345', 'Aedhelio', 'Produksi'),
('12346', 'Zaki', 'CEO'),
('12347', 'Firman', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `noKTP` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `asalNegara` varchar(20) DEFAULT NULL,
  `asalKota` varchar(100) DEFAULT NULL,
  `namaPerusahaan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`noKTP`, `nama`, `asalNegara`, `asalKota`, `namaPerusahaan`) VALUES
('1010', 'firmat', 'tokyo', 'newyork', 'kortttoooo'),
('1234567', 'jono', 'indo', 'palemb', 'PT kodok'),
('566', 'harum', 'thailand', 'bath', 'thai kere'),
('asd44', 'asdasdasda', 'c', 'c', 'c'),
('oaa1212', 'horor', 'koko', 'sdasf', 'zxcvzxv');

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `idSparepart` varchar(100) NOT NULL,
  `namaSpare` varchar(100) DEFAULT NULL,
  `jumlah` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`idSparepart`, `namaSpare`, `jumlah`) VALUES
('sp1', 'roda', 450),
('sp2', 'kaca', 200);

-- --------------------------------------------------------

--
-- Table structure for table `stockkereta`
--

CREATE TABLE `stockkereta` (
  `idStock` varchar(10) NOT NULL,
  `idPegawai` varchar(10) DEFAULT NULL,
  `namaKereta` varchar(20) DEFAULT NULL,
  `jenisKereta` varchar(100) DEFAULT NULL,
  `jumlahKereta` int(11) DEFAULT NULL,
  `hargaKereta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockkereta`
--

INSERT INTO `stockkereta` (`idStock`, `idPegawai`, `namaKereta`, `jenisKereta`, `jumlahKereta`, `hargaKereta`) VALUES
('K57', '12345', 'Kamandaka', 'Kereta Lokomotif', 3, 1000000),
('K58', '12345', 'Air Wals', 'Kereta Cepat', 10, 46000000),
('K59', '12345', 'trainMini', 'Kereta Mini', 10, 46000000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` varchar(10) NOT NULL,
  `idPegawai` varchar(10) DEFAULT NULL,
  `noKTP` varchar(10) DEFAULT NULL,
  `idStock` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `idPegawai`, `noKTP`, `idStock`, `jumlah`, `tanggal`, `status`) VALUES
('2iiq', '12345', '1234567', 'K57', 2, '2018-11-16', 'proses'),
('aaaa', '12345', '1234567', 'K57', 122, '2018-11-23', 'pending'),
('asdf', '12345', '1234567', 'K57', 122, '2018-10-21', 'proses'),
('ffff', '12347', '1010', 'K57', 2, '2018-12-19', 'terjual'),
('hoo', '12347', '1010', 'K57', 2, '2018-12-22', 'proses'),
('sad', '12345', '1234567', 'K57', 122, '2018-11-24', 'pending'),
('sdsda', '12345', '1234567', 'K57', 122, '2018-08-10', 'proses'),
('tttt', '12345', '1234567', 'K57', 122, '2018-11-08', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlogin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idPegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`noKTP`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`idSparepart`);

--
-- Indexes for table `stockkereta`
--
ALTER TABLE `stockkereta`
  ADD PRIMARY KEY (`idStock`),
  ADD KEY `idPegawai` (`idPegawai`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `idPegawai` (`idPegawai`),
  ADD KEY `noKTP` (`noKTP`),
  ADD KEY `idStock` (`idStock`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `idlogin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stockkereta`
--
ALTER TABLE `stockkereta`
  ADD CONSTRAINT `stockkereta_ibfk_1` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`noKTP`) REFERENCES `pelanggan` (`noKTP`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`idStock`) REFERENCES `stockkereta` (`idStock`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
