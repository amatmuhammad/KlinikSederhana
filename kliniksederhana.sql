-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Bulan Mei 2025 pada 15.04
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kliniksederhana`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `datadokter`
--

CREATE TABLE `datadokter` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datapoli_id` bigint UNSIGNED NOT NULL,
  `spesialis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `datadokter`
--

INSERT INTO `datadokter` (`id`, `nama_dokter`, `datapoli_id`, `spesialis`, `created_at`, `updated_at`) VALUES
(1, 'dr. Sitti Rahma', 1, NULL, '2025-05-19 11:38:46', '2025-05-22 06:41:57'),
(2, 'drg. Andika Putra', 2, NULL, '2025-05-19 11:38:53', '2025-05-22 06:42:23'),
(3, 'dr. Dini Pratiwi', 3, NULL, '2025-05-19 11:45:20', '2025-05-22 06:42:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapoli`
--

CREATE TABLE `datapoli` (
  `id` bigint UNSIGNED NOT NULL,
  `poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `datapoli`
--

INSERT INTO `datapoli` (`id`, `poli`, `created_at`, `updated_at`) VALUES
(1, 'Poli Umum', '2025-05-19 11:38:32', '2025-05-19 11:38:32'),
(2, 'Poli Gigi', '2025-05-19 11:38:37', '2025-05-19 11:38:37'),
(3, 'Poli Mata', '2025-05-22 06:41:35', '2025-05-22 06:41:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_05_18_114541_create_users_table', 1),
(5, '2025_05_18_114550_create_pasien_table', 1),
(6, '2025_05_18_120800_create_datapoli_table', 1),
(7, '2025_05_18_123011_create_datadokter_table', 1),
(8, '2025_05_18_123108_create_riwayat_kunjungan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nik`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(8, '3174010101010000', 'Andi Saputra', '1985-02-14', 'L', 'Jl. Melati No. 23, Jakarta', '1747924448.png', '2025-05-22 06:34:08', '2025-05-22 06:34:08'),
(9, '3205050202020000', 'Rina Kusuma', '1992-07-07', 'P', 'Jl. Kenanga No. 12, Bandung', '1747924750.png', '2025-05-22 06:39:10', '2025-05-22 06:39:10'),
(10, '3378060303030000', 'Fajar Hidayat', '1990-08-22', 'L', 'Jl. Anggrek No. 88, Semarang', '1747924860.png', '2025-05-22 06:41:00', '2025-05-22 06:41:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_kunjungan`
--

CREATE TABLE `riwayat_kunjungan` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `dokter_id` bigint UNSIGNED NOT NULL,
  `poli_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `diagnosa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_kunjungan`
--

INSERT INTO `riwayat_kunjungan` (`id`, `pasien_id`, `dokter_id`, `poli_id`, `tanggal`, `diagnosa`, `tindakan`, `obat`, `biaya`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 1, '2024-10-12', 'Demam Tinggi', 'Pemeriksaan Fisik', 'Paracetamol, Oralit', 150000.00, '2025-05-22 06:44:01', '2025-05-22 06:44:01'),
(7, 8, 1, 1, '2025-01-25', 'Batuk dan Flu', 'Pemeriksaan Fisik', 'OBH, Vitamin C', 175000.00, '2025-05-22 06:45:02', '2025-05-22 06:45:02'),
(8, 9, 2, 2, '2024-11-30', 'Gigi Berlubang', 'Tambal Gigi', 'Amoxicillin, Asam Mefenamat', 350000.00, '2025-05-22 06:46:27', '2025-05-22 06:46:27'),
(9, 9, 2, 2, '2025-03-12', 'Karang Gigi', 'Scaling Gigi', '-', 400000.00, '2025-05-22 06:47:36', '2025-05-22 06:47:36'),
(10, 10, 3, 3, '2025-04-15', 'Rabun Jauh', 'Pemeriksaan Refraksi', 'Vitamin A', 200000.00, '2025-05-22 06:48:59', '2025-05-22 06:48:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@example.com', '$2y$12$XzCC6J2kAsUJ4fy48shN9O3LyZ/l40.HwCelQ8Lk85eL.13Oj4Y9O', 'admin', NULL, '2025-05-21 08:53:24', '2025-05-21 08:53:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `datadokter`
--
ALTER TABLE `datadokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datadokter_datapoli_id_foreign` (`datapoli_id`);

--
-- Indeks untuk tabel `datapoli`
--
ALTER TABLE `datapoli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `riwayat_kunjungan`
--
ALTER TABLE `riwayat_kunjungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_kunjungan_pasien_id_foreign` (`pasien_id`),
  ADD KEY `riwayat_kunjungan_dokter_id_foreign` (`dokter_id`),
  ADD KEY `riwayat_kunjungan_poli_id_foreign` (`poli_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `datadokter`
--
ALTER TABLE `datadokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `datapoli`
--
ALTER TABLE `datapoli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_kunjungan`
--
ALTER TABLE `riwayat_kunjungan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `datadokter`
--
ALTER TABLE `datadokter`
  ADD CONSTRAINT `datadokter_datapoli_id_foreign` FOREIGN KEY (`datapoli_id`) REFERENCES `datapoli` (`id`);

--
-- Ketidakleluasaan untuk tabel `riwayat_kunjungan`
--
ALTER TABLE `riwayat_kunjungan`
  ADD CONSTRAINT `riwayat_kunjungan_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `datadokter` (`id`),
  ADD CONSTRAINT `riwayat_kunjungan_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `riwayat_kunjungan_poli_id_foreign` FOREIGN KEY (`poli_id`) REFERENCES `datapoli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
