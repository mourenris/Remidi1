-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2026 pada 05.40
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
-- Database: `smartflood_sensor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lokasi_sungai` varchar(100) NOT NULL,
  `waktu_pengukuran` datetime NOT NULL,
  `tinggi_air` int(11) NOT NULL,
  `status_banjir` enum('Aman','Waspada','Bahaya') DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monitoring`
--

INSERT INTO `monitoring` (`id`, `user_id`, `lokasi_sungai`, `waktu_pengukuran`, `tinggi_air`, `status_banjir`, `deskripsi`, `foto_bukti`) VALUES
(1, 1, 'Citayem', '2026-05-10 19:04:59', 50, 'Aman', 'Banjir', '1778414699_Screenshot 2026-02-05 134600.png'),
(2, 1, 'Tanjung Priok', '2026-05-10 19:06:40', 1000, 'Bahaya', 'BBBAAAAAAAANNNNNNNNJJJJJIIIRRRRRR', '1778414800_Screenshot 2026-02-05 190605.png'),
(3, 1, 'test', '2026-05-10 19:31:42', 1, 'Aman', 'test', '1778416302_Screenshot 2026-02-05 134104.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Morris', 'mourenris@gmail.com', '$2y$10$/YbRE47grB3hu96qj.w96Oe5fM9n1ZV4BeLKacSQPNxGZJe1YUwPW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `monitoring_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
