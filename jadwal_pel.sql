-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2021 pada 16.09
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal_pel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_al` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `status` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_al`, `nama_alat`, `status`) VALUES
(1, 'Mesin X-ray', 1),
(2, 'Flight Display', 1),
(4, 'CCTV', 1),
(5, 'deqd', 1),
(6, 'k', 1),
(7, 'i', 1),
(8, 'h', 1),
(9, 'p', 1),
(10, 'y', 1),
(11, 'x', 1),
(12, 'rklklk', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_kar` int(11) NOT NULL,
  `nama_kar` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_kar`, `nama_kar`, `jabatan`, `status`) VALUES
(1, 'Tommy Prakasa', 'Airport Technology Manager', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_k` int(11) NOT NULL,
  `nama_keg` varchar(100) NOT NULL,
  `status` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_k`, `nama_keg`, `status`) VALUES
(1, 'Safety Check', 1),
(2, 'Pembersihan', 1),
(3, 'Pemeriksaan Control Elements', 1),
(4, 'Pemeriksaan Supply Voltage', 1),
(5, 'Pemeriksaan Indicator Lamp', 1),
(6, 'Pemeriksaan Monitor', 1),
(7, 'K', 1),
(8, 'z', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(250) NOT NULL,
  `id_kar` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `id_kar`, `username`, `password`, `level`, `status`) VALUES
(1, '1', 'tomicu', 'bcc730c12ed0cc6c90f951b026bb6e2f', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `aktivitas` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_log`, `id_login`, `datetime`, `aktivitas`, `keterangan`) VALUES
(1, 1, '2021-10-28 11:35:58', 'Login', 'tomicu;;bcc730c12ed0cc6c90f951b026bb6e2f;;Login Sukses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id_m` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `nama_merk` varchar(250) NOT NULL,
  `status` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id_m`, `id_al`, `nama_merk`, `status`) VALUES
(1, 2, 'Pannasonic', 1),
(2, 1, 'Rapiscan', 1),
(3, 1, 'gatau', 1),
(4, 4, 'Pannasonic', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id_p` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem` varchar(100) NOT NULL,
  `status_pem` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeliharaan`
--

INSERT INTO `pemeliharaan` (`id_p`, `id_al`, `id_k`, `nama_pem`, `status_pem`) VALUES
(1, 1, 1, 'macul', 1),
(2, 1, 2, '0', 1),
(3, 1, 1, 'test', 1),
(4, 1, 3, '0', 1),
(5, 1, 4, '0', 1),
(6, 1, 5, '0', 1),
(7, 1, 6, '0', 1),
(8, 1, 2, '0', 1),
(9, 1, 3, '0', 1),
(10, 1, 4, '0', 1),
(11, 1, 5, '0', 1),
(12, 1, 6, '0', 1),
(13, 1, 1, '0', 1),
(14, 1, 2, '0', 1),
(15, 1, 3, '0', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan_bul`
--

CREATE TABLE `pemeliharaan_bul` (
  `id_p_b` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem_bul` varchar(100) NOT NULL,
  `status_pem_bul` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeliharaan_bul`
--

INSERT INTO `pemeliharaan_bul` (`id_p_b`, `id_al`, `id_k`, `nama_pem_bul`, `status_pem_bul`) VALUES
(1, 1, 2, 'apa ya', 1),
(2, 1, 3, 'y gatau', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan_ming`
--

CREATE TABLE `pemeliharaan_ming` (
  `id_p_m` int(250) NOT NULL,
  `id_al` int(250) NOT NULL,
  `id_k` int(250) NOT NULL,
  `nama_pem_ming` varchar(100) NOT NULL,
  `status_pem_ming` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeliharaan_ming`
--

INSERT INTO `pemeliharaan_ming` (`id_p_m`, `id_al`, `id_k`, `nama_pem_ming`, `status_pem_ming`) VALUES
(1, 1, 1, 'dvs', 1),
(2, 1, 1, 'svsbasfgv', 1),
(3, 1, 2, 'dsgsgge', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sign`
--

CREATE TABLE `sign` (
  `id_sign` int(11) NOT NULL,
  `id_kar` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sign`
--

INSERT INTO `sign` (`id_sign`, `id_kar`, `status`) VALUES
(1, 1, 1),
(2, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_tot`
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
  `day31` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_tot`
--

INSERT INTO `trans_tot` (`id_tot`, `id_m`, `id_p`, `type_p`, `datetime_a`, `datetime_update`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `day8`, `day9`, `day10`, `day11`, `day12`, `day13`, `day14`, `day15`, `day16`, `day17`, `day18`, `day19`, `day20`, `day21`, `day22`, `day23`, `day24`, `day25`, `day26`, `day27`, `day28`, `day29`, `day30`, `day31`) VALUES
(1, 2, '1', 1, '2021-10', '2021-10-27 11:53:39', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, '2', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, '3', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 2, '4', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 2, '5', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 2, '6', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, '7', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 2, '8', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 2, '9', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 2, '10', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 2, '11', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 2, '12', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 2, '13', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 2, '14', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 2, '15', 1, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 2, '1', 2, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 2, '2', 2, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 2, '3', 2, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 2, '1', 3, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 2, '2', 3, '2021-10', '2021-10-27 11:53:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 2, '1', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 2, '2', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 2, '3', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 2, '4', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 2, '5', 1, '2021-09', '2021-10-26 15:46:49', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 2, '6', 1, '2021-09', '2021-10-26 15:46:49', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 2, '7', 1, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 2, '8', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(89, 2, '9', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(90, 2, '10', 1, '2021-09', '2021-10-26 15:46:49', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(91, 2, '11', 1, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(92, 2, '12', 1, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(93, 2, '13', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(94, 2, '14', 1, '2021-09', '2021-10-26 15:46:48', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(95, 2, '15', 1, '2021-09', '2021-10-26 15:46:49', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(96, 2, '1', 2, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 2, '2', 2, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(98, 2, '3', 2, '2021-09', '2021-10-26 15:46:50', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(99, 2, '1', 3, '2021-09', '2021-10-26 15:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(100, 2, '2', 3, '2021-09', '2021-10-26 15:46:51', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_al`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_kar`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_k`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_m`);

--
-- Indeks untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_p` (`id_p`);

--
-- Indeks untuk tabel `pemeliharaan_bul`
--
ALTER TABLE `pemeliharaan_bul`
  ADD PRIMARY KEY (`id_p_b`),
  ADD KEY `id_p` (`id_p_b`);

--
-- Indeks untuk tabel `pemeliharaan_ming`
--
ALTER TABLE `pemeliharaan_ming`
  ADD PRIMARY KEY (`id_p_m`),
  ADD KEY `id_p` (`id_p_m`);

--
-- Indeks untuk tabel `sign`
--
ALTER TABLE `sign`
  ADD PRIMARY KEY (`id_sign`);

--
-- Indeks untuk tabel `trans_tot`
--
ALTER TABLE `trans_tot`
  ADD PRIMARY KEY (`id_tot`),
  ADD UNIQUE KEY `id_m` (`id_m`,`id_p`,`type_p`,`datetime_a`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_al` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_kar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id_m` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id_p` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pemeliharaan_bul`
--
ALTER TABLE `pemeliharaan_bul`
  MODIFY `id_p_b` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemeliharaan_ming`
--
ALTER TABLE `pemeliharaan_ming`
  MODIFY `id_p_m` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sign`
--
ALTER TABLE `sign`
  MODIFY `id_sign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `trans_tot`
--
ALTER TABLE `trans_tot`
  MODIFY `id_tot` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
