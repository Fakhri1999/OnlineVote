-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2019 at 08:20 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onvot`
--

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `id_pilihan` varchar(8) NOT NULL,
  `kode_room` varchar(5) NOT NULL,
  `nama_pilihan` varchar(50) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`id_pilihan`, `kode_room`, `nama_pilihan`, `foto`) VALUES
('akGE39sG', 'lBESm', 'Fakhri', ''),
('aUm7Jc8m', 'RHPOL', 'Jokowi', ''),
('bSGN9d2C', 'RHPOL', 'Prabowo', ''),
('gPsamkkO', 'lBESm', 'Aldi', ''),
('s4Jk3f83', 'lBESm', 'Ilham', '');

-- --------------------------------------------------------

--
-- Table structure for table `recovery`
--

CREATE TABLE `recovery` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kode` varchar(60) DEFAULT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` text,
  `kode_room` varchar(5) NOT NULL,
  `waktu_pembuatan` date DEFAULT NULL,
  `waktu_akhir` date DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `id_user`, `judul`, `deskripsi`, `kode_room`, `waktu_pembuatan`, `waktu_akhir`, `active`) VALUES
(6, 3, 'Pemilihan Presiden BEM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'lBESm', '2019-04-22', '2019-04-26', b'0'),
(7, 3, 'Pemilihan Presiden RI 2019-2024', 'pilihlah presiden dengan bijak, jangan golput', 'RHPOL', '2019-04-22', '2019-04-25', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `email`) VALUES
(2, 'fakhri', 'Muhammad Fakhri Imaduddin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'fakhriimaduddin19@gmail.com'),
(3, 'aldiwildan', 'Muhammad Wildan Aldiansyah', '8e756c9f2b15da6a63f84852fc39667617523133', 'aldiwild77@gmail.com'),
(4, 'hamandil', 'Ilham Andriansah', '8e756c9f2b15da6a63f84852fc39667617523133', 'ilhamandri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `id_voter` int(11) NOT NULL,
  `id_pilihan` varchar(8) NOT NULL,
  `kode_room` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`id_voter`, `id_pilihan`, `kode_room`, `id_user`) VALUES
(3, 'gPsamkkO', 'lBESm', 4),
(4, 'gPsamkkO', 'lBESm', 3),
(5, 'bSGN9d2C', 'RHPOL', 3),
(6, 'aUm7Jc8m', 'RHPOL', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`id_pilihan`),
  ADD KEY `kode_room` (`kode_room`);

--
-- Indexes for table `recovery`
--
ALTER TABLE `recovery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD UNIQUE KEY `kode_room` (`kode_room`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id_voter`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_room` (`kode_room`),
  ADD KEY `id_pilihan` (`id_pilihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recovery`
--
ALTER TABLE `recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `id_voter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pilihan_ibfk_1` FOREIGN KEY (`kode_room`) REFERENCES `room` (`kode_room`);

--
-- Constraints for table `recovery`
--
ALTER TABLE `recovery`
  ADD CONSTRAINT `recovery_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `voter`
--
ALTER TABLE `voter`
  ADD CONSTRAINT `voter_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `voter_ibfk_2` FOREIGN KEY (`kode_room`) REFERENCES `room` (`kode_room`),
  ADD CONSTRAINT `voter_ibfk_3` FOREIGN KEY (`id_pilihan`) REFERENCES `pilihan` (`id_pilihan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
