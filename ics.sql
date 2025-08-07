-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2025 pada 12.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `atk_datang`
--

CREATE TABLE `atk_datang` (
  `id_atk_datang` varchar(25) NOT NULL,
  `id_barang_atk` varchar(25) NOT NULL,
  `qty` int(25) NOT NULL,
  `harga` int(10) NOT NULL,
  `tgl_datang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `atk_keluar`
--

CREATE TABLE `atk_keluar` (
  `id_trx_keluar` varchar(25) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `id_barang_atk` varchar(25) NOT NULL,
  `qty` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` varchar(25) NOT NULL,
  `nama_departemen` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(25) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `bagian` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

CREATE TABLE `lembur` (
  `id_spl` varchar(25) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `total_lembur` int(10) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `approve_1` datetime NOT NULL,
  `approve_2` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_user`
--

CREATE TABLE `login_user` (
  `id` int(10) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `bagian` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `tgl_tambah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_user`
--

INSERT INTO `login_user` (`id`, `nik`, `nama_karyawan`, `bagian`, `jabatan`, `password`, `tgl_tambah`) VALUES
(5, '123', 'Satria Putra Sabana', 'Admin', 'SPV', '$2y$10$qAwNGf8ma1Yuv.kms8A7KekyjePfvWZgQzP4SB9Rjx2mPH1Bq9Qu6', '2025-08-02'),
(6, '2015496800', 'Satria Putra Sabana', 'Admin', 'SPV', '$2y$10$aqU.1XksQ0BpRGNP9pUOnOsLmKD7bxPsJmxyyeaJVAln8PT17CAXe', '2025-08-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_atk`
--

CREATE TABLE `master_atk` (
  `id_barang_atk` varchar(25) NOT NULL,
  `nama_barang` varchar(25) DEFAULT NULL,
  `harga` int(25) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  `tgl_tambah` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_atk`
--

INSERT INTO `master_atk` (`id_barang_atk`, `nama_barang`, `harga`, `satuan`, `tgl_tambah`) VALUES
('adsf', 'aku', 111, 'sdf', '2025-08-02'),
('galsdkjf', 'lkasdf', 1, 'g', '2025-08-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `password_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `password_user`) VALUES
(1, 'satria', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
--

CREATE TABLE `voucher` (
  `plu` varchar(25) NOT NULL,
  `nama_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `atk_datang`
--
ALTER TABLE `atk_datang`
  ADD PRIMARY KEY (`id_atk_datang`);

--
-- Indeks untuk tabel `atk_keluar`
--
ALTER TABLE `atk_keluar`
  ADD PRIMARY KEY (`id_trx_keluar`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id_spl`);

--
-- Indeks untuk tabel `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_atk`
--
ALTER TABLE `master_atk`
  ADD PRIMARY KEY (`id_barang_atk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`plu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
