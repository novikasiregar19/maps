-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2021 at 06:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maps`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_al` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `status` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_kar` int(11) NOT NULL,
  `nama_kar` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_k` int(11) NOT NULL,
  `nama_keg` varchar(100) NOT NULL,
  `status` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(250) NOT NULL,
  `id_kar` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `tanggal_log` datetime NOT NULL,
  `aktivitas` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id_m` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `nama_merk` varchar(250) NOT NULL,
  `status_m` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id_p` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem` varchar(100) NOT NULL,
  `status_pem` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan_bul`
--

CREATE TABLE `pemeliharaan_bul` (
  `id_p_b` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem_bul` varchar(100) NOT NULL,
  `status_pem_bul` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan_ming`
--

CREATE TABLE `pemeliharaan_ming` (
  `id_p_m` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem_ming` varchar(100) NOT NULL,
  `status_pem_ming` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sign`
--

CREATE TABLE `sign` (
  `id_sign` int(11) NOT NULL,
  `id_kar` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trans_tot`
--

CREATE TABLE `trans_tot` (
  `id_tot` int(250) NOT NULL,
  `id_m` int(250) NOT NULL,
  `id_p` varchar(250) NOT NULL,
  `type_p` int(111) NOT NULL,
  `datetime_a` varchar(250) NOT NULL,
  `datetime_update` varchar(250) NOT NULL,
  `day1` int(11) NOT NULL,
  `day2` int(11) NOT NULL,
  `day3` int(11) NOT NULL,
  `day4` int(11) NOT NULL,
  `day5` int(11) NOT NULL,
  `day6` int(11) NOT NULL,
  `day7` int(11) NOT NULL,
  `day8` int(11) NOT NULL,
  `day9` int(11) NOT NULL,
  `day10` int(11) NOT NULL,
  `day11` int(11) NOT NULL,
  `day12` int(11) NOT NULL,
  `day13` int(11) NOT NULL,
  `day14` int(11) NOT NULL,
  `day15` int(11) NOT NULL,
  `day16` int(11) NOT NULL,
  `day17` int(11) NOT NULL,
  `day18` int(11) NOT NULL,
  `day19` int(11) NOT NULL,
  `day20` int(11) NOT NULL,
  `day21` int(11) NOT NULL,
  `day22` int(11) NOT NULL,
  `day23` int(11) NOT NULL,
  `day24` int(11) NOT NULL,
  `day25` int(11) NOT NULL,
  `day26` int(11) NOT NULL,
  `day27` int(11) NOT NULL,
  `day28` int(11) NOT NULL,
  `day29` int(11) NOT NULL,
  `day30` int(11) NOT NULL,
  `day31` int(11) NOT NULL,
  `ket_p` text NOT NULL,
  `status_set` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trans_tot_verify`
--

CREATE TABLE `trans_tot_verify` (
  `id_tot_verifiy` int(250) NOT NULL,
  `id_m` int(250) NOT NULL,
  `id_al` varchar(250) NOT NULL,
  `datetime_a` varchar(250) NOT NULL,
  `datetime_update` varchar(250) NOT NULL,
  `day1` int(11) NOT NULL,
  `day2` int(11) NOT NULL,
  `day3` int(11) NOT NULL,
  `day4` int(11) NOT NULL,
  `day5` int(11) NOT NULL,
  `day6` int(11) NOT NULL,
  `day7` int(11) NOT NULL,
  `day8` int(11) NOT NULL,
  `day9` int(11) NOT NULL,
  `day10` int(11) NOT NULL,
  `day11` int(11) NOT NULL,
  `day12` int(11) NOT NULL,
  `day13` int(11) NOT NULL,
  `day14` int(11) NOT NULL,
  `day15` int(11) NOT NULL,
  `day16` int(11) NOT NULL,
  `day17` int(11) NOT NULL,
  `day18` int(11) NOT NULL,
  `day19` int(11) NOT NULL,
  `day20` int(11) NOT NULL,
  `day21` int(11) NOT NULL,
  `day22` int(11) NOT NULL,
  `day23` int(11) NOT NULL,
  `day24` int(11) NOT NULL,
  `day25` int(11) NOT NULL,
  `day26` int(11) NOT NULL,
  `day27` int(11) NOT NULL,
  `day28` int(11) NOT NULL,
  `day29` int(11) NOT NULL,
  `day30` int(11) NOT NULL,
  `day31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_file`
--

CREATE TABLE `upload_file` (
  `id` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tanggal_up` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_al`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_kar`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_k`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `id_kar` (`id_kar`,`level`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_m`);

--
-- Indexes for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_p` (`id_p`);

--
-- Indexes for table `pemeliharaan_bul`
--
ALTER TABLE `pemeliharaan_bul`
  ADD PRIMARY KEY (`id_p_b`),
  ADD KEY `id_p` (`id_p_b`);

--
-- Indexes for table `pemeliharaan_ming`
--
ALTER TABLE `pemeliharaan_ming`
  ADD PRIMARY KEY (`id_p_m`),
  ADD KEY `id_p` (`id_p_m`);

--
-- Indexes for table `sign`
--
ALTER TABLE `sign`
  ADD PRIMARY KEY (`id_sign`);

--
-- Indexes for table `trans_tot`
--
ALTER TABLE `trans_tot`
  ADD PRIMARY KEY (`id_tot`),
  ADD UNIQUE KEY `id_m` (`id_m`,`id_p`,`type_p`,`datetime_a`),
  ADD KEY `id_tot` (`id_tot`);

--
-- Indexes for table `trans_tot_verify`
--
ALTER TABLE `trans_tot_verify`
  ADD PRIMARY KEY (`id_tot_verifiy`),
  ADD UNIQUE KEY `id_m` (`id_m`,`id_al`,`datetime_a`),
  ADD KEY `id_tot_verifiy` (`id_tot_verifiy`) USING BTREE;

--
-- Indexes for table `upload_file`
--
ALTER TABLE `upload_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_al` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_kar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_m` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id_p` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeliharaan_bul`
--
ALTER TABLE `pemeliharaan_bul`
  MODIFY `id_p_b` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeliharaan_ming`
--
ALTER TABLE `pemeliharaan_ming`
  MODIFY `id_p_m` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sign`
--
ALTER TABLE `sign`
  MODIFY `id_sign` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_tot`
--
ALTER TABLE `trans_tot`
  MODIFY `id_tot` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_tot_verify`
--
ALTER TABLE `trans_tot_verify`
  MODIFY `id_tot_verifiy` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_file`
--
ALTER TABLE `upload_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
