-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 09:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kelas`
--

CREATE TABLE `daftar_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_kelas`
--

INSERT INTO `daftar_kelas` (`id`, `kelas`) VALUES
(11, 'xii-rpl 1'),
(16, 'xii-rpl 2');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_pelajaran`
--

CREATE TABLE `daftar_pelajaran` (
  `id` int(11) NOT NULL,
  `pelajaran` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_pelajaran`
--

INSERT INTO `daftar_pelajaran` (`id`, `pelajaran`) VALUES
(3, 'matematika'),
(4, 'ipa'),
(6, 'pbo');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `jenis_kelamin` varchar(225) NOT NULL,
  `jabatan` varchar(225) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `jenis_kelamin`, `jabatan`, `no_hp`, `password`) VALUES
(3, 'guru 1', 'L', 'wali kelas', '0982742', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajaran`
--

CREATE TABLE `jadwal_pelajaran` (
  `id` int(11) NOT NULL,
  `kelas` varchar(225) NOT NULL,
  `hari` varchar(225) NOT NULL,
  `jadwal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_pelajaran`
--

INSERT INTO `jadwal_pelajaran` (`id`, `kelas`, `hari`, `jadwal`) VALUES
(46, 'xii-rpl 1', 'senin', 'pwpb,pwpb,B.inggris,,,,,pbo,,'),
(47, 'xii-rpl 1', 'selasa', ',,,,,,,,,'),
(48, 'xii-rpl 1', 'rabu', ',,,,,,,,,'),
(49, 'xii-rpl 1', 'kamis', ',,,,,,,,,'),
(50, 'xii-rpl 1', 'jumat', ',,,,,,,,,'),
(51, 'xii-rpl 1', 'sabtu', ',,,,,,,,,'),
(76, 'xii-rpl 2', 'senin', ',,,,,,,,,'),
(77, 'xii-rpl 2', 'selasa', ',,,,,,,,,'),
(78, 'xii-rpl 2', 'rabu', ',,,,,,,,,'),
(79, 'xii-rpl 2', 'kamis', ',,,,,,,,,'),
(80, 'xii-rpl 2', 'jumat', ',,,,,,,,,'),
(81, 'xii-rpl 2', 'sabtu', ',,,,,,,,,');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `jenis_kelamin` varchar(225) NOT NULL,
  `kelas` varchar(225) NOT NULL,
  `matematika` int(11) DEFAULT NULL,
  `ipa` int(11) DEFAULT NULL,
  `pbo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `jenis_kelamin`, `kelas`, `matematika`, `ipa`, `pbo`) VALUES
(1, 'test', 'L', 'XII-rpl 1', 80, 70, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_kelas`
--
ALTER TABLE `daftar_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_pelajaran`
--
ALTER TABLE `daftar_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_kelas`
--
ALTER TABLE `daftar_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `daftar_pelajaran`
--
ALTER TABLE `daftar_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
