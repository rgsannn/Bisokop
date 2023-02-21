-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Feb 2023 pada 10.24
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bisokop_final`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `films`
--

CREATE TABLE `films` (
  `film_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_rating` enum('R 13+','R 17+','R 18+','R 21+','SU','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_trailer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('publish','unpublish') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `films`
--

INSERT INTO `films` (`film_id`, `title`, `description`, `duration`, `thumbnail`, `cover`, `rating`, `genre`, `director`, `age_rating`, `url_trailer`, `status`, `created_at`, `updated_at`) VALUES
('3W4Z3SG9B9HILP7A', 'PARA BETINA PENGIKUT IBLIS', 'SUMI mengurus ayahnya, KARTO yang sakit. Untuk bertahan hidup ia membuka warung gulai dari daging manusia. Bahan gulai dari mayat yang baru dikubur hingga mayat segar. Sementara SARI kembali menjadi dukun teluh dan meneror desa, saat adiknya, NINGRUM mati dibunuh dan mayatnya hilang dari kuburan. Mereka terhasut dan menjadi budak IBLIS.', 90, '2ca9c0f1-9540-4e93-8abf-d2c3aaa760ac.jpeg', 'jpDyo4FT7xCPs9Enx0B6dIeP85e.jpg', 4.5, 'Horror', 'Rako Prijanto', 'R 21+', 'https://www.youtube.com/watch?v=FqPKs4oyq_g', 'publish', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('9WSRL5ED4K5L6YEW', 'ANT-MAN AND THE WASP: QUANTUMANIA', 'Scott Lang (Paul Rudd), Hope Van Dyne (Evangeline Lilly) Dr. Hank Pym (Michael Douglas) dan Janet Van Dyne (Michelle Pfeiffer) menjelajahi Alam Kuantum, tempat mereka bertemu dengan makhluk aneh dan memulai petualangan yang melampaui batas yang mereka pikir mungkin.', 124, 'vg2U7rgpfBFw35Hj83NSLJFOfcycNiPlfUbLc0On.jpg', 'dhfD2HrIw6trsMsmmYSSaNeBB2XSSJwI8BnPy5jj.jpg', 4.5, 'Adventure/Action', 'Peyton Reed', 'R 17+', 'https://www.youtube.com/watch?v=ZlNFpri-Y40', 'publish', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('P9QRJL5ISEO6OT9O', 'OPERATION FORTUNE: RUSE DE GUERRE', 'Agen khusus Orson Fortune (Jason Statham) harus melacak dan menghentikan penjualan senjata berteknologi baru yang mematikan oleh pialang senjata dan miliarder, Greg Simmonds. Bekerja sama dengan beberapa agent terbaik dunia, Fortune dan krunya merekrut bintang film terbesar Hollywood Danny Francesco (Josh Hartnett) untuk membantu mereka dalam misi penyamaran untuk menyelamatkan dunia.', 114, 'eb618c2e-9554-42e4-8c22-4a07f65bd710.jpeg', '6ZZjNFjTlO9F25467CruIibwuxl.jpg', 4.5, 'Action/Comedy', 'Guy Ritchie', 'R 13+', 'https://www.youtube.com/watch?v=W8Sqk1GcqxY', 'publish', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('S9B11Q0WH971ZOJQ', 'ARGANTARA', 'Kehidupan SYERA, seorang siswi SMA berusia 16 tahun mendadak berubah ketika ia menikah muda dengan ARGANTARA, seorang cowok bandel yang dibencinya di sekolah dan juga ketua geng Agberos. Sifat dan sikap keduanya yang bertolak belakang membuat rumah tangga mereka penuh pertengkaran. Arga pun sering tidak ada di rumah kerena teman gengnya terbunuh ketika tawuran besar-besaran dengan geng lain bernama Baron.\r\n\r\n                Pernikahan Argantara dan Syera dirahasiakan dari sekolah. Tidak ada satu pun teman mereka yang tahu. Mereka harus berhati-hati karena kalau sampai rahasia ini terbongkar, mereka bisa dikeluarkan dari sekolah. Tapi tiba-tiba Syera hamil! Sampai kapan rahasia mereka bisa tersimpan? Apakah pernikahan dan kehamilan dengan segala tanggung jawabnya adalah sesuatu yang bisa mereka jalani di usia 16 tahun?', 161, '60bf68fa-0679-45a1-bef8-3111a978a2c5.jpeg', 'k3sU9wEQMSoTpU0EwLp2DeOndw5.jpg', 4.5, 'Romance', 'Guntur Soeharjanto', 'R 17+', 'https://www.youtube.com/watch?v=6tIDpvkohQI', 'publish', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_02_16_120415_create_staff_table', 1),
(3, '2023_02_16_120441_create_users_table', 1),
(4, '2023_02_16_120449_create_theater_table', 1),
(5, '2023_02_16_120456_create_theater_seat_table', 1),
(6, '2023_02_16_120515_create_films_table', 1),
(7, '2023_02_16_120521_create_payment_method_table', 1),
(8, '2023_02_16_120527_create_schedules_table', 1),
(9, '2023_02_16_120528_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Not Active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_method`
--

INSERT INTO `payment_method` (`payment_id`, `name`, `account_number`, `account_name`, `status`, `icon`, `created_at`, `updated_at`) VALUES
('A69M2PXWLYLYZ3J4', 'GOPAY', '081210110328', 'Rifqi Galih Nur Ikhsan', 'Active', 'gopay.jpg', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('EUIGRFWSQNNLGTLH', 'OVO', '081210110328', 'Rifqi Galih Nur Ikhsan', 'Active', 'ovo.jpg', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('G9P8ZEKVFEXFCMHW', 'Bank BCA', '7772276187', 'Rifqi Galih Nur Ikhsan', 'Active', 'bca.jpg', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('I6FQQ5DHEPSVBZOK', 'DANA', '081210110328', 'Rifqi Galih Nur Ikhsan', 'Active', 'dana.jpg', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('YAPMWEYSBDDMWSNF', 'SHOPEE PAY', '081210110328', 'Rifqi Galih Nur Ikhsan', 'Active', 'shopeepay.jpg', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theater_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `film_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `theater_id`, `film_id`, `date`, `time`, `created_at`, `updated_at`) VALUES
('0OIE06ZHRDLP7BIG', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('1XYUAAEEESF6XEXN', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('1YVRPSWQOX1X3VJ0', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('1ZBNUIAC5YKVXA8W', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('2LEKL2SQ0DHBFWQM', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('2TEZDZFZFTEZQFOM', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('2XY2IHJFDICYKWNY', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('4NCXJJS5JMLEBPJY', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('60OXRU7OXPM5YJGJ', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('66WTCCEL8W10ULW1', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('7DUJHRA2SUQC49QH', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('8AXEHYYFGO7IMWEL', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('8HWR8HBV3JDVXLDQ', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('9I3JAADCSUC9WUTT', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('BBNG2LMONFXWEBBP', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('BMJMPMNUEAWGSXQV', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('BNDDMTNJ2JSWDVGK', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('BNO0MJPPQTJ5JREJ', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('BVCEVO5T5R3P5QVD', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('CJWANZIJXWQFTKJM', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('CPKT1GJZZSYAOVCN', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('D2CUMA9AOJ5T51IK', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('EFLGDE3GTADVKYDU', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('EPB3LQXTVAFYEZ2N', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('FGMXST0VXNVCML5O', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('GCVF0QKWSWPV2R0J', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('GGMFPQNWRDAKEKT7', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('GMFXOQILHM3UQLUC', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HGZUHVRYKYD41SDA', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HHWDVZJSTPL7KCB2', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HLXVASOPI3YH4R8P', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HMVID6STH29ZQOSK', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HN3XXS6NXF8OVO4Y', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('IG0LSS8PUEMOFMGP', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('J2C5CWMIXLMBOU5Z', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('JAECTHPMKUUUEOTL', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('JN1I3LT1MQPNTOBQ', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('JV6FQETSRDVMBNOX', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('K3TY12A5ONYXUH6R', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('KCMFCHWRYHAFTYND', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('KFONWXQT3VLDDPZF', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('KUFSQRORDHFDIOGF', 'UM24YN2KO2HIGDV6', '3W4Z3SG9B9HILP7A', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('LIBHSSLMNV38GNCL', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('LXJAKRB5D9ELDIVF', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('M1AX7G57HVGKXIHC', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('M30I1HSAVH4IDTKR', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('MLA6BL48V21EUNGZ', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('MYBK3X14XCLMD71Z', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('NJXJ5EGJ91QGAJIF', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('NUNF2EZZ5WGMDNIL', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('O2MBNJNU2POTVNNK', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('OLNU1W7EEYDDQCII', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('OO0FKKHDVULAQDCL', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('PCUMU9RF4ZMNBJIP', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('PDQSYKUJBSVZ4J44', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('PRWROB1ALCIGBGAE', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('Q1GOWWAVYUL7ZKBT', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('QSMFVDV9YRB11UCR', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('QWXAVUXW9LTMHISG', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('RLGDSLNVMJY90YIU', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('RXB7LBNYESPGZ9ZT', 'UM24YN2KO2HIGDV6', '9WSRL5ED4K5L6YEW', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('SZVUXGPRIOKN8ZWJ', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('TEEL0G30AL09OZ3I', 'ELO6Z8JOURJ6YSF9', '3W4Z3SG9B9HILP7A', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('TRY4TFS8DCGM7GOM', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('U1MDXKQUBYKJUU7H', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('U8WWM5CT2AXIPCOZ', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('UFIZJCNENJ1UB4OP', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-25', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('UYXIWHTPORSGODJD', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('VATKL8NYXKOE5N8Y', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-24', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('VEBUQIYWPQMURZJM', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('W1BVACXYC6CDXHPG', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('WRMZKO2GHPF4SYMP', 'UM24YN2KO2HIGDV6', 'P9QRJL5ISEO6OT9O', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('WSW4OY29VN0AQGHM', 'ELO6Z8JOURJ6YSF9', 'S9B11Q0WH971ZOJQ', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('WUDJDGHMYJVBFZXR', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('X2P0YOOJLOZB4E9I', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('X9807NUSSJCIJXMO', 'UM24YN2KO2HIGDV6', 'S9B11Q0WH971ZOJQ', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('XGHJFL8HALPWB0M2', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-26', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('XLL4ICYOBSFVXUWY', 'CT89FRHACZXIXBQB', '3W4Z3SG9B9HILP7A', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('YHU5E2GQYQ0OQKHV', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-21', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('YHXMMNFHBXESWFAN', 'CT89FRHACZXIXBQB', 'P9QRJL5ISEO6OT9O', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('YNRIHHWDS5TELGPK', 'ELO6Z8JOURJ6YSF9', 'P9QRJL5ISEO6OT9O', '2023-02-22', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('Z0HGLTBNQPZ08N6A', 'CT89FRHACZXIXBQB', 'S9B11Q0WH971ZOJQ', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('Z7BYKLNZX5RQZYYI', 'ELO6Z8JOURJ6YSF9', '9WSRL5ED4K5L6YEW', '2023-02-23', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('ZMLWKD9F8FHCWWGC', 'CT89FRHACZXIXBQB', '9WSRL5ED4K5L6YEW', '2023-02-27', '[\"08:00\",\"09:30\",\"11:00\",\"12:30\",\"14:00\",\"15:30\",\"17:00\",\"18:30\",\"20:00\",\"21:30\"]', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Cashier') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('ES3E8IGDNVPJADLX', 'Bisokop Admin', 'admin@bisokop.im-rgsan.com', '$2y$10$fQh7BPqgxdyQktofUYBTPu3yMfu4UIFkuwpgE2Gt6FZxvkq3HiI8m', 'Admin', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('HEXJCU2DMEFKFAWW', 'Bisokop Cashier', 'cashier@bisokop.im-rgsan.com', '$2y$10$R/8bDtRL6WEPdlLA1hxEJ.jKNkuETyUKxwZSdTGhRrHNWO6/W7Kly', 'Cashier', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `theater`
--

CREATE TABLE `theater` (
  `theater_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Silver Class','Gold Class','Platinum Class') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `theater`
--

INSERT INTO `theater` (`theater_id`, `type`, `name`, `created_at`, `updated_at`) VALUES
('CT89FRHACZXIXBQB', 'Platinum Class', 'Majestic Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('ELO6Z8JOURJ6YSF9', 'Silver Class', 'Axel Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('J0GCNX1L5Q3HJSM5', 'Silver Class', 'Russell Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('UM24YN2KO2HIGDV6', 'Gold Class', 'Cozy Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('XWM0BCLH7K38ISPZ', 'Gold Class', 'Ancestral Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
('YNWC8XK5NA0T4O4B', 'Platinum Class', 'Cygnet Theatre', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `theater_seat`
--

CREATE TABLE `theater_seat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `theater_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `type` enum('Sweetbox','Economy','Executive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `theater_seat`
--

INSERT INTO `theater_seat` (`id`, `theater_id`, `row`, `price`, `type`, `created_at`, `updated_at`) VALUES
(1, 'ELO6Z8JOURJ6YSF9', '[\"A\"]', 35000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(2, 'ELO6Z8JOURJ6YSF9', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 30000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(3, 'ELO6Z8JOURJ6YSF9', '[\"I\",\"J\"]', 25000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(4, 'J0GCNX1L5Q3HJSM5', '[\"A\"]', 35000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(5, 'J0GCNX1L5Q3HJSM5', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 30000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(6, 'J0GCNX1L5Q3HJSM5', '[\"I\",\"J\"]', 25000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(7, 'UM24YN2KO2HIGDV6', '[\"A\"]', 40000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(8, 'UM24YN2KO2HIGDV6', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 35000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(9, 'UM24YN2KO2HIGDV6', '[\"I\",\"J\"]', 30000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(10, 'XWM0BCLH7K38ISPZ', '[\"A\"]', 40000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(11, 'XWM0BCLH7K38ISPZ', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 35000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(12, 'XWM0BCLH7K38ISPZ', '[\"I\",\"J\"]', 30000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(13, 'YNWC8XK5NA0T4O4B', '[\"A\"]', 45000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(14, 'YNWC8XK5NA0T4O4B', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 40000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(15, 'YNWC8XK5NA0T4O4B', '[\"I\",\"J\"]', 30000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(16, 'CT89FRHACZXIXBQB', '[\"A\"]', 45000, 'Sweetbox', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(17, 'CT89FRHACZXIXBQB', '[\"B\",\"C\",\"D\",\"E\",\"F\",\"G\",\"H\"]', 40000, 'Executive', '2023-02-21 08:51:03', '2023-02-21 08:51:03'),
(18, 'CT89FRHACZXIXBQB', '[\"I\",\"J\"]', 30000, 'Economy', '2023-02-21 08:51:03', '2023-02-21 08:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `status` enum('Waiting for payment','Payment Received','Payment Canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `printed` int(11) NOT NULL,
  `confirmation_transfer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`film_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedules_theater_id_foreign` (`theater_id`),
  ADD KEY `schedules_film_id_foreign` (`film_id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_email_unique` (`email`);

--
-- Indeks untuk tabel `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theater_id`);

--
-- Indeks untuk tabel `theater_seat`
--
ALTER TABLE `theater_seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater_seat_theater_id_foreign` (`theater_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_schedule_id_foreign` (`schedule_id`),
  ADD KEY `transactions_payment_id_foreign` (`payment_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `theater_seat`
--
ALTER TABLE `theater_seat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`film_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theater` (`theater_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `theater_seat`
--
ALTER TABLE `theater_seat`
  ADD CONSTRAINT `theater_seat_theater_id_foreign` FOREIGN KEY (`theater_id`) REFERENCES `theater` (`theater_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`payment_id`),
  ADD CONSTRAINT `transactions_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
