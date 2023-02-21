-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Feb 2023 pada 14.05
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--
CREATE DATABASE IF NOT EXISTS `skripsi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `skripsi`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

DROP TABLE IF EXISTS `bobot`;
CREATE TABLE `bobot` (
  `id` int(11) NOT NULL,
  `nama_bobot` varchar(255) NOT NULL,
  `nilai_bobot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id`, `nama_bobot`, `nilai_bobot`) VALUES
(1, 'SANGAT BAIK', '1'),
(2, 'BAIK', '0,75'),
(3, 'CUKUP', '0,50'),
(4, 'KURANG', '0,25'),
(5, 'SANGAT KURANG', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nama_lengkap`, `handphone`, `email`, `jabatan_id`, `pengguna_id`) VALUES
(1, '63100', 'Ahmad Misradi Surya, M.Pd', '0821', 'msurya@gmail.com', 2, 2),
(2, '63200', 'Fitriani, S.Pd', '0821', 'fitriani@gmail.com', 1, 2),
(3, '6398', 'Rizky Septiani, S.Pd.', '0821', 'rizki@gmail.com', 3, 2),
(4, '63567', 'Sry Hartati,S.Pd.l', '0821', 'tati230@gmail.com', 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'GURU BK'),
(2, 'GURU MATEMATIKA'),
(3, 'GURU IPA'),
(4, 'GURU IPS'),
(5, 'GURU PENJASORKES'),
(6, 'GURU PRAKARYA'),
(7, 'GURU SENI BUDAYA'),
(8, 'GURU PENDIDIKAN AGAMA ISLAM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_guru`
--

DROP TABLE IF EXISTS `jabatan_guru`;
CREATE TABLE `jabatan_guru` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan_guru`
--

INSERT INTO `jabatan_guru` (`id`, `guru_id`, `jabatan_id`, `tanggal_mulai`) VALUES
(1, 1, 2, '0000-00-00'),
(2, 2, 8, '0000-00-00'),
(3, 1, 5, '0000-00-00'),
(4, 1, 5, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`) VALUES
(1, 'Menguasai Karakteristik Peserta Didik'),
(2, 'Menguasai Teori Belajar dengan Prinsip yang mendidik'),
(3, 'Pengembangan Kurikulum'),
(4, 'Komunikasi peserta Didik'),
(5, 'Penilaian dan Evaluasi'),
(6, 'Etos Kerja dan rasa tanggung jawab '),
(7, 'Bersifat inklusif , bertindak obyektif , dan tidak diskriminatif '),
(8, 'Komunikasi dengan sesama guru dan tenaga pendidikan , orang tua , dan murid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` enum('ADMIN','USER') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `peran`) VALUES
(1, 'ADMIN', '$2y$10$baqQ4zTS37tzcjXzcU9GjO5.a.IIvc1OX1.kwHleKXxjVo9dZXDK2', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_guru`
--
ALTER TABLE `jabatan_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jabatan_guru`
--
ALTER TABLE `jabatan_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
