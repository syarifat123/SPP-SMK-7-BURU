-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Sep 2024 pada 09.07
-- Versi server: 8.0.30
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_app_spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bayar`
--

CREATE TABLE `tbl_bayar` (
  `id_bayar` int NOT NULL,
  `tgl_bayar` date NOT NULL,
  `no_bayar` varchar(20) NOT NULL,
  `id_siswa` int NOT NULL,
  `total_bayar` int NOT NULL,
  `keterangan` text NOT NULL,
  `jenis_pembayaran` varchar(20) NOT NULL,
  `bukti_bayar` varchar(150) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengingat`
--

CREATE TABLE `tbl_pengingat` (
  `id_pengingat` int NOT NULL,
  `tgl_pengingat` date NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data untuk tabel `tbl_pengingat`
--

INSERT INTO `tbl_pengingat` (`id_pengingat`, `tgl_pengingat`, `id_user`) VALUES
(1, '2024-09-22', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int NOT NULL,
  `nisn_siswa` varchar(100) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jk_siswa` varchar(100) NOT NULL,
  `biaya_spp` varchar(100) NOT NULL,
  `id_wali_siswa` int NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_spp`
--

CREATE TABLE `tbl_spp` (
  `id_spp` int NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `bulan_spp` varchar(100) NOT NULL,
  `no_bayar` varchar(100) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah_bayar` varchar(100) NOT NULL,
  `status_bayar` varchar(100) NOT NULL,
  `id_user` int NOT NULL,
  `id_siswa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `alamat_user` varchar(100) NOT NULL,
  `nohp_user` varchar(100) NOT NULL,
  `jabatan_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `alamat_user`, `nohp_user`, `jabatan_user`, `email_user`, `password_user`) VALUES
(1, 'Ari Bahtiar S.pd M.pd', 'Jl. Soekarno Hatta No 7', '08813', 'Kepala Sekolah', 'kepsek@gmail.com', '12345'),
(2, 'Aldi Masuku', 'Jl. Ahmad Yani', '08776', 'Staff TU', 'tu@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_wali_siswa`
--

CREATE TABLE `tbl_wali_siswa` (
  `id_wali_siswa` int NOT NULL,
  `nik_wali_siswa` varchar(100) NOT NULL,
  `nama_wali_siswa` varchar(100) NOT NULL,
  `alamat_wali_siswa` varchar(100) NOT NULL,
  `nohp_wali_siswa` varchar(100) NOT NULL,
  `email_wali_siswa` varchar(100) NOT NULL,
  `password_wali_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bayar`
--
ALTER TABLE `tbl_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tbl_pengingat`
--
ALTER TABLE `tbl_pengingat`
  ADD PRIMARY KEY (`id_pengingat`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tbl_spp`
--
ALTER TABLE `tbl_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_wali_siswa`
--
ALTER TABLE `tbl_wali_siswa`
  ADD PRIMARY KEY (`id_wali_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bayar`
--
ALTER TABLE `tbl_bayar`
  MODIFY `id_bayar` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengingat`
--
ALTER TABLE `tbl_pengingat`
  MODIFY `id_pengingat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_spp`
--
ALTER TABLE `tbl_spp`
  MODIFY `id_spp` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_wali_siswa`
--
ALTER TABLE `tbl_wali_siswa`
  MODIFY `id_wali_siswa` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
