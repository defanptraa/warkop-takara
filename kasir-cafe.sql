-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Jun 2026 pada 12.58
-- Versi server: 8.4.3
-- Versi PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `kasir-cafe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_01_130120_create_products_table', 2),
(5, '2025_06_02_042734_create_transaksis_table', 3),
(6, '2025_06_07_061627_create_orders_table', 4),
(7, '2025_06_07_085046_orders_table', 5),
(8, '2025_06_10_030343_make_user_id_nullable_on_orders_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `nama`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(8, 'Espresso', 18000, '1749215136_Espresso.webp', '2025-06-06 05:03:27', '2025-06-06 05:05:36'),
(9, 'Americano', 20000, '1749215244_Iced Americano.jpg', '2025-06-06 05:03:27', '2025-06-06 05:07:24'),
(10, 'Cappuccino', 25000, '1749215712_Cappucino.png', '2025-06-06 05:03:27', '2025-06-06 05:15:12'),
(11, 'Caffè Latte', 26000, '1749215747_images.jpeg', '2025-06-06 05:03:27', '2025-06-06 05:15:47'),
(12, 'Caramel Macchiato', 28000, '1749216330_iced-caramel-macchiato-isolated-white-background_972841-72.png', '2025-06-06 05:03:27', '2025-06-06 05:25:30'),
(13, 'Vanilla Latte', 27000, '1749216344_delicious-quality-coffee-cup_23-2150691325.png', '2025-06-06 05:03:27', '2025-06-06 05:25:44'),
(14, 'Mocha', 29000, '1749217074_peppermint-mocha-in-a-white-cup-isolated-on-white-background-free-photo.jpg', '2025-06-06 05:03:27', '2025-06-06 05:37:54'),
(15, 'Flat White', 24000, '1749217133_sbx20190624-36949-flatwhite-onwhite-corelib-srgb.webp', '2025-06-06 05:03:27', '2025-06-06 05:38:53'),
(16, 'Cold Brew', 23000, '1749217238_cold-brew-iced-coffee.webp', '2025-06-06 05:03:27', '2025-06-06 05:40:38'),
(17, 'Kopi Susu Gula Aren', 22000, '1749217631_4679496e-149d-4328-8491-7a3df47746fd_Go-Biz_20241029_135233.jpeg', '2025-06-06 05:03:27', '2025-06-06 05:47:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EghybyBJ8Pll1A6PGfOpNOMUt4sm5v4tQLCTDLMS', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNTRvbVR0eDgzdmY5N0lqblJzN1JBeUFEV0JxRlhqTWdxb2tkNm82MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1781953329);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `total_harga`, `created_at`, `updated_at`) VALUES
(2, 2, 25000.00, '2025-06-01 20:48:24', '2025-06-01 20:48:24'),
(3, 2, 104420.00, '2025-05-31 01:16:00', '2025-06-04 06:06:49'),
(4, 2, 37272.00, '2025-06-01 12:49:00', '2025-06-04 06:06:49'),
(5, 2, 111827.00, '2025-05-29 03:27:00', '2025-06-04 06:06:49'),
(6, 2, 12139.00, '2025-05-29 03:29:00', '2025-06-04 06:06:49'),
(7, 2, 79321.00, '2025-05-30 00:14:00', '2025-06-04 06:06:49'),
(8, 2, 23815.00, '2025-06-03 05:20:00', '2025-06-04 06:06:49'),
(9, 2, 52798.00, '2025-06-03 10:18:00', '2025-06-04 06:06:49'),
(10, 2, 130292.00, '2025-05-31 01:19:00', '2025-06-04 06:06:49'),
(11, 2, 39739.00, '2025-05-29 12:12:00', '2025-06-04 06:06:49'),
(12, 2, 88534.00, '2025-05-31 05:59:00', '2025-06-04 06:06:49'),
(13, 2, 123229.00, '2025-05-31 00:48:00', '2025-06-04 06:06:49'),
(14, 2, 53943.00, '2025-05-30 06:08:00', '2025-06-04 06:06:49'),
(15, 2, 84481.00, '2025-05-31 03:45:00', '2025-06-04 06:06:49'),
(16, 2, 55825.00, '2025-06-03 05:37:00', '2025-06-04 06:06:49'),
(17, 2, 113958.00, '2025-06-04 12:17:00', '2025-06-04 06:06:49'),
(18, 2, 10928.00, '2025-05-29 09:21:00', '2025-06-04 06:06:49'),
(19, 2, 31761.00, '2025-06-02 02:46:00', '2025-06-04 06:06:49'),
(20, 2, 31594.00, '2025-05-31 04:09:00', '2025-06-04 06:06:49'),
(21, 2, 148371.00, '2025-06-04 12:51:00', '2025-06-04 06:06:49'),
(22, 2, 93153.00, '2025-06-03 00:43:00', '2025-06-04 06:06:49'),
(23, 2, 33592.00, '2025-05-30 01:03:00', '2025-06-04 06:06:49'),
(24, 2, 60774.00, '2025-05-30 06:49:00', '2025-06-04 06:06:49'),
(25, 2, 54989.00, '2025-06-04 00:48:00', '2025-06-04 06:06:49'),
(26, 2, 126945.00, '2025-06-01 12:58:00', '2025-06-04 06:06:49'),
(27, 2, 101942.00, '2025-06-01 06:24:00', '2025-06-04 06:06:49'),
(28, 2, 65066.00, '2025-06-02 06:13:00', '2025-06-04 06:06:49'),
(29, 2, 106455.00, '2025-06-02 09:36:00', '2025-06-04 06:06:49'),
(30, 2, 79217.00, '2025-06-04 07:32:00', '2025-06-04 06:06:49'),
(31, 2, 97981.00, '2025-05-29 11:00:00', '2025-06-04 06:06:49'),
(32, 2, 70057.00, '2025-06-01 02:32:00', '2025-06-04 06:06:49'),
(33, 2, 20420.00, '2025-06-06 19:26:08', '2025-06-06 21:53:08'),
(34, 2, 39753.00, '2025-06-06 17:00:08', '2025-06-06 21:53:08'),
(35, 2, 48080.00, '2025-06-06 19:27:08', '2025-06-06 21:53:08'),
(36, 2, 15690.00, '2025-06-06 18:15:08', '2025-06-06 21:53:08'),
(37, 2, 44198.00, '2025-06-06 18:23:08', '2025-06-06 21:53:08'),
(38, 2, 31675.00, '2025-06-06 21:11:08', '2025-06-06 21:53:08'),
(39, 2, 10953.00, '2025-06-06 19:30:08', '2025-06-06 21:53:08'),
(40, 2, 33324.00, '2025-06-06 20:40:08', '2025-06-06 21:53:08'),
(41, 2, 41019.00, '2025-06-06 20:29:08', '2025-06-06 21:53:08'),
(42, 2, 47820.00, '2025-06-06 18:37:08', '2025-06-06 21:53:08'),
(43, 2, 45586.00, '2025-06-06 17:02:08', '2025-06-06 21:53:08'),
(44, 2, 19222.00, '2025-06-06 21:04:08', '2025-06-06 21:53:08'),
(45, 2, 40701.00, '2025-06-06 18:10:08', '2025-06-06 21:53:08'),
(46, 2, 42330.00, '2025-06-06 20:54:08', '2025-06-06 21:53:08'),
(47, 2, 33633.00, '2025-06-06 17:18:08', '2025-06-06 21:53:08'),
(48, 2, 43758.00, '2025-06-06 21:03:08', '2025-06-06 21:53:08'),
(49, 2, 25136.00, '2025-06-06 18:35:08', '2025-06-06 21:53:08'),
(50, 2, 27703.00, '2025-06-06 20:54:08', '2025-06-06 21:53:08'),
(51, 2, 18492.00, '2025-06-06 18:35:08', '2025-06-06 21:53:08'),
(52, 2, 33959.00, '2025-06-06 19:38:08', '2025-06-06 21:53:08'),
(53, 2, 20000.00, '2025-06-06 22:24:26', '2025-06-06 22:24:26'),
(54, 2, 23000.00, '2025-06-06 22:24:37', '2025-06-06 22:24:37'),
(55, 2, 35192.00, '2025-06-07 02:23:42', '2025-06-07 02:23:42'),
(56, 2, 18683.00, '2025-06-07 02:37:24', '2025-06-07 02:37:24'),
(57, 2, 40162.00, '2025-06-09 18:48:38', '2025-06-09 18:48:38'),
(58, 2, 27562.00, '2025-06-09 18:48:49', '2025-06-09 18:48:49'),
(59, 2, 15324.00, '2025-06-09 18:48:49', '2025-06-09 18:48:49'),
(60, 2, 45647.00, '2025-06-09 18:48:57', '2025-06-09 18:48:57'),
(61, 2, 36588.00, '2025-06-09 18:48:58', '2025-06-09 18:48:58'),
(62, 2, 49500.00, '2025-06-09 18:49:01', '2025-06-09 18:49:01'),
(63, 2, 18000.00, '2025-06-09 19:25:16', '2025-06-09 19:25:16'),
(64, 2, 28000.00, '2025-06-09 19:27:31', '2025-06-09 19:27:31'),
(65, 2, 23000.00, '2025-06-09 19:29:07', '2025-06-09 19:29:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'eko', 'eko@kasir.com', NULL, '$2y$12$JROS1rhskKQUFElxM4LNSukg0hLyrwYYEzLEYWA3lIvtme8h.F0MO', '1j5Fa6zSzJokHDu1v9TykKPd1OpfUQ3DiSeoTsaMHx9rRuvwKMj9PYuBlV1B', '2025-06-01 05:15:39', '2025-06-01 05:15:39'),
(4, 'dewa', 'dewa@kasir.com', NULL, '$2y$12$pzNeY4.zmMTiqga5afq56uasI8L5oE7LDxcIWf23hzB7c.eIWhDgO', NULL, '2025-06-01 05:15:59', '2025-06-01 05:15:59'),
(5, 'admin', 'defanputra015@gmail.com', NULL, '$2y$12$5fOvIuJYmJf1JGQ8Fg36.u41Yga/2S2YXFBzEuOgYq8pF5TBMalnm', 'zWumAbupxBzqEuJYuaGrSLmasekoETGXEkMBCEoHCbC559i4hF915Mag25Xc', '2026-06-05 00:44:04', '2026-06-05 00:44:04');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
