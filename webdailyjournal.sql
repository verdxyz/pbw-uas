-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 09 Jan 2025 pada 11.56
-- Versi server: 8.0.30
-- Versi PHP: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `judul` text,
  `isi` text,
  `gambar` text,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
);

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(2, 'Judul Artikel 2', 'Isi artikel 2', 'img/gambar2.PNG', '2025-01-08 13:00:00', 'user2'),
(3, 'Alat Monitoring', 'Isi Penggunaannya mirip dengan margin bedanya, padding digunakan untuk membuat jarak didalam elemen.', 'img/alat1.jpg', '2025-01-08 12:00:00', 'admin'),
(4, 'judul apa ini', 'isi suka2 kamu aja', 'img/20250108132838.jpg', '2025-01-08 13:28:38', 'admin'),
(5, 'judul saya suka', 'wkwkwkw', 'img/20250108133505.jpg', '2025-01-08 13:35:05', 'admin'),
(6, 'judul saya suka22', 'fffff', 'img/20250108134820.jpg', '2025-01-08 13:48:20', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'gambar waru', 'img/20250108133505.jpg', '2025-01-09 10:53:09', '2025-01-09 10:53:09'),
(6, 'gambar siapa nih22', 'img/20250109084401.png', '2025-01-09 08:44:16', '2025-01-09 15:44:16'),
(7, 'gambar siapa nih344', 'img/20250109085359.png', '2025-01-09 08:53:59', '2025-01-09 15:53:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text NOT NULL
);

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `foto`) VALUES
(1, 'admin', 'pasarjohar', '2025-01-08 01:01:34', 'img/20250108132838.jpg'),
(4, 'nanda', 'tukarsandal', '2025-01-09 04:02:49', 'img/20250109110249.png'),
(5, 'halimalaziz', 'kudaponi', '2025-01-09 04:06:27', 'img/20250109110627.jpg'),
(8, 'qwwq', 'jaranhitam', '2025-01-09 04:07:59', 'img/20250109110759.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
