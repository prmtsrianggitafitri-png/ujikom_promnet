-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2025 pada 01.20
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
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `nama_penulis` varchar(50) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `jumlah_halaman` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `id_kategori`, `nama_buku`, `nama_penulis`, `judul_buku`, `jumlah_halaman`, `penerbit`, `stok`, `gambar`) VALUES
(1, 2, '', 'RA Kartini', 'Habislah Gelap Terbitlah Terang', '234', 'Gramedia', 70, 'Habislah Gelap Terbitlah Terang_RA Kartini.jpg'),
(2, 12, '', 'Tan Malaka', 'Madilog', '654', 'Gramedia', 67, 'Madilog_Tan Malaka.jpg'),
(3, 12, '', 'Kartini', 'Habislah Gelap Terbitlah Terang', '453', 'Gramedia', 78, 'Habislah Gelap Terbitlah Terang_Kartini.jpg'),
(4, 3, '', 'Raditya Dika', 'Marmut Merah Jambu', '346', 'Gramedia', 76, 'Marmut Merah Jambu_Raditya Dika.jpg'),
(5, 12, '', 'Bapak', 'Iqro', '120', 'Gramedia', 80, 'Iqro_Bapak.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kategori`
--

CREATE TABLE `data_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_kategori`
--

INSERT INTO `data_kategori` (`id_kategori`, `nama_kategori`, `tanggal_input`) VALUES
(1, 'Fiksi Aja Bos', '2025-11-28 16:32:24'),
(3, 'Komedi Lucu', '2025-11-28 16:32:49'),
(4, 'Horor', '2025-11-28 16:33:50'),
(5, 'Psikologi', '2025-11-28 16:34:03'),
(7, 'romansa', '2025-11-28 17:20:51'),
(10, 'Religius', '2025-11-29 00:49:07'),
(11, 'Bismillah Cumlaude', '2025-11-29 01:53:44'),
(12, 'Sejarah', '2025-11-29 06:48:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(2, 'coba', 'cb@gmail.com', '$2y$10$BRaejKdUJCliE3S01o.Bj.4hRLoRRMEBVnYhaiyROdE'),
(3, 'hacipuyu', 'hcpy@gmail.com', '$2y$10$phpk8jmvf6M.Icrm32mkz.UUTp6444de.uqNkLG4XMj'),
(4, 'salwa ', 'salwa@gmail.com', '$2y$10$vzMg7jhV4tm0f68.kWHHd.118AhIPti1ytIyYPGQhwd'),
(5, 'anggita fitri', 'anggita@gmail.com', '$2y$10$gczgn7ha5HjE2L/RY6rgIOGkg5Aq9Ka5MwJmNy9QjWr'),
(6, 'syalalala', 'sy@gmail.com', '$2y$10$h7WpOYy8mhdZkiqdFIpKreKDz5INrx13mUXoATVVvD0'),
(7, 'pinkan', 'pk@gmail.com', '$2y$10$qyVtHCXBIRb1gEmKs32wgeFMfkd8vKQ5TuPXZdg6keD'),
(8, 'bismillah', 'bismillah@gmail.com', '$2y$10$feVl3XFvfFfQFEOnx0wQOOLfWahtSvHIg8qHR/R8/dxuaA8ZnESw6'),
(9, 'ya allah ', 'ya@gmail.com', '$2y$10$xXiZenqdlvovQ2ZpKOedQeJvfL.LlOZlf0qQKV7iym5uhWjxzpcAu'),
(10, 'akudaftar', 'ad@gmail.com', '$2y$10$Tib3DnvZkdOJk92KorB.B.m2B/q2qV01ZgVtZgEkjxGvlnGu7Y/X.'),
(11, 'janlup', 'janlup@gmail.com', '$2y$10$IFGx08ET.Ze3SUe1tMSDUOZI77/hmoOIV5949/XcPwqPjYyhBrUfG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `data_kategori`
--
ALTER TABLE `data_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_kategori`
--
ALTER TABLE `data_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
