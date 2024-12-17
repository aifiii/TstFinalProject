-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 10:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vote1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `fullname`, `password`) VALUES
(0, 'wida@gmail.com', 'wida', 'wida'),
(1, 'k.prawidan@gmail.com', 'admin', 'admin'),
(2, 'wida@gmail.com', 'wida', 'wida');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(11) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `visi` varchar(100) NOT NULL,
  `misi` varchar(100) NOT NULL,
  `suara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `fullname`, `foto`, `visi`, `misi`, `suara`) VALUES
(1, 'prowowo', 'calon1.jpg', 'perubahan', 'perubahan', 1),
(2, 'prabowo', 'calon2.jpg', 'makan siang', 'makan siang slepet', 2),
(3, 'ganjar', 'calon3.jpg', 'balala', 'balala', 3);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` enum('belum voting','sudah voting') NOT NULL,
  `suara` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `fullname`, `kelas`, `token`, `status`, `suara`) VALUES
(0, 'widasnya', '', '', 'sudah voting', 1),
(1, 'bapak', '11', '', 'sudah voting', 2),
(232, 'widas', '12', '6b8121dfea', 'sudah voting', 1),
(233, 'wida', '10', '40f07036b7', 'sudah voting', 1),
(234, 'wd', '9', 'b00a6c8859', 'belum voting', 1),
(236, 'dicky', '10', '5264f8a8f5', 'sudah voting', 1),
(237, 'prawidana kurniawan', '13', '577ce577bc', 'sudah voting', 1),
(238, 'dicky', '12', '06ddf2e9c8', 'sudah voting', 1),
(239, 'dicky', '10', '4dffbae58e', 'sudah voting', 1),
(241, 'bapak', '12', '5a62617bd1', 'sudah voting', 1),
(242, 'bapak', '12', 'aa955ccf59', 'sudah voting', 3),
(243, 'bapak', '12', '2deb66cf1d', 'sudah voting', 2),
(244, 'bapak', '12', 'e6aa14aacb', 'sudah voting', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
