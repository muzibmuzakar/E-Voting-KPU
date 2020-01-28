-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2020 pada 12.47
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kpu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_urut` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_CaGub` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_CaWaGub` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `no_urut`, `nama_CaGub`, `nama_CaWaGub`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, '01', 'aceng', 'dadang', 'madeeppp', 'skuy', '2020-01-27 10:44:27', '2020-01-27 10:44:27'),
(2, '02', 'aan', 'tatang', 'halah', 'hilih', '2020-01-27 10:45:04', '2020-01-27 10:45:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pasangan1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_suara_pasangan1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasangan2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_suara_pasangan2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_suara_masuk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_01_27_085210_create_users_teble', 1),
(2, '2020_01_27_103637_create_calon_table', 2),
(3, '2020_01_27_120908_create_tps_table', 3),
(4, '2020_01_27_124724_create_voter_table', 4),
(5, '2020_01_28_040820_add_role_to_users', 5),
(6, '2020_01_28_050830_create_pilihan_table', 6),
(7, '2020_01_28_051624_create_pilihan_table', 7),
(8, '2020_01_28_065807_create_hasil_table', 8),
(9, '2020_01_28_072135_create_hasil_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tps`
--

CREATE TABLE `tps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_tps` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua_kpps` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tps`
--

INSERT INTO `tps` (`id`, `no_tps`, `alamat`, `ketua_kpps`, `created_at`, `updated_at`) VALUES
(1, '1', 'ciwaruga', 1, '2020-01-27 12:15:08', '2020-01-27 12:15:08'),
(2, '2', 'cilame', 1, '2020-01-27 12:15:26', '2020-01-27 12:18:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','kpps1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$eSqRxelNUAXBvbRhiuMHdunnn6f199JeLneaqfnJ1BOnTyvR1RGJ2', '2020-01-27 09:42:19', '2020-01-27 09:42:19', 'admin'),
(2, 'dadang', 'dadang@gmail.com', '$2y$10$XG3Yjn56FX8apJUTuxs0luH7ILqeVw0VHhQRZDWk/Bdd6PvFfiE5q', '2020-01-28 04:22:33', '2020-01-28 04:22:33', 'kpps1'),
(3, 'ajat', 'ajat@gmail.com', '$2y$10$kopc7wg16wqNNw1N0fSfvuxCPSsU5UuLQZgM7VXI0NlXZwHMCAJga', '2020-01-28 04:39:49', '2020-01-28 04:39:49', 'kpps1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vote`
--

CREATE TABLE `vote` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_voter` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pilihan` enum('calon1','calon2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vote`
--

INSERT INTO `vote` (`id`, `id_voter`, `pilihan`, `created_at`, `updated_at`) VALUES
(1, '1', 'calon1', '2020-01-28 05:28:12', '2020-01-28 05:28:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voter`
--

CREATE TABLE `voter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NIK` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_tps` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `voter`
--

INSERT INTO `voter` (`id`, `NIK`, `nama`, `tgl_lahir`, `id_tps`, `created_at`, `updated_at`) VALUES
(1, '3214527369284763', 'ajat', '1945-08-17', 2, '2020-01-27 12:55:19', '2020-01-27 12:55:19'),
(2, '3214527369211763', 'carl jhonson', '1919-08-17', 1, '2020-01-27 12:56:02', '2020-01-27 12:56:02'),
(4, '3218729463549786', 'jajang', '1988-01-01', 1, '2020-01-28 07:12:09', '2020-01-28 07:12:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id_foreign` (`ketua_kpps`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indeks untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tps_foreign` (`id_tps`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon`
--
ALTER TABLE `calon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tps`
--
ALTER TABLE `tps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vote`
--
ALTER TABLE `vote`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `voter`
--
ALTER TABLE `voter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
