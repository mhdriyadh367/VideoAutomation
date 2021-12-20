-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2021 at 12:11 AM
-- Server version: 8.0.23
-- PHP Version: 7.3.24-(to be removed in future macOS)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_28_123543_create_videos_table', 2),
(6, '2021_09_28_123614_create_photos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `video_id`, `photo`, `audio`, `video`, `text`, `created_at`, `updated_at`) VALUES
(1, 10, 'assets/photo/L7menhe6FwnLoEhWXIGIF6jd3ScaJMzu3NdGWQX5.jpg', 'assets/music/10052021031109615bc24d7cb18.mp3', 'assets/video/1633403501.675362_1.mp4', '1 2 3', '2021-10-04 19:11:09', '2021-10-04 19:11:09'),
(2, 11, 'assets/photo/Rg6x3zksBeZrK2HMPPwqRzTyxKEsFX8cPqGusRua.jpg', 'assets/music/10052021031611615bc37bbd05c.mp3', 'assets/video/1633403774.068844_2.mp4', '1 2 3', '2021-10-04 19:16:11', '2021-10-04 19:16:11'),
(3, 13, 'assets/photo/ZBMk0MbVuReUYcl03hW78l518quygqaXQyjCNg3d.jpg', 'assets/music/10072021020241615e5541e008f.mp3', 'assets/video/1633573919.527728_3.mp4', 'bismillah lagi mencoba', '2021-10-06 18:02:41', '2021-10-06 18:02:41'),
(4, 14, 'assets/photo/Athq4hJ8RlCxknKxqBPOjEFk2IM5jZLfVDhUxaFa.jpg', 'assets/music/10072021020308615e555c7c201.mp3', NULL, 'bismillah mencoba', '2021-10-06 18:03:08', '2021-10-06 18:03:08'),
(5, 15, 'assets/photo/iYc6bSuhdUGH9DhF4X6Smi3fBlAhn2dkcIoclv2B.jpg', 'assets/music/10072021020514615e55daae266.mp3', NULL, 'bismillah mencoba', '2021-10-06 18:05:14', '2021-10-06 18:05:14'),
(6, 16, 'assets/photo/QL745kFclu4cZ6v1zOVAHuxPmDkHO7REWP7p5Lvj.jpg', 'assets/music/10072021021054615e572e65536.mp3', NULL, 'bismillah mencoba', '2021-10-06 18:10:54', '2021-10-06 18:10:54'),
(7, 17, 'assets/photo/XbMgHdUraercdCBZIWDHIUitV8huVnptaIAQgnkb.jpg', 'assets/music/10072021021336615e57d09afa1.mp3', NULL, 'bismillah mencoba', '2021-10-06 18:13:36', '2021-10-06 18:13:36'),
(8, 18, 'assets/photo/ncVEhXKTWViYYIwGsp9gVuiD6PflPP7Igcez0yku.jpg', 'assets/music/10072021021622615e58768b71a.mp3', NULL, 'tes 1 2 3', '2021-10-06 18:16:22', '2021-10-06 18:16:22'),
(9, 19, 'assets/photo/TxUxfVcB5K0CBftA6mo0YeYkkp8laJyOQnYP6Doy.jpg', 'assets/music/10072021021819615e58ebb1818.mp3', NULL, 'tes coba 1 2 3', '2021-10-06 18:18:19', '2021-10-06 18:18:19'),
(10, 20, 'assets/photo/fi5HqmCuE1wYZSIiXLHhSvXyeBLxdSolWGWOKzDq.jpg', 'assets/music/10072021021836615e58fc9f8cc.mp3', NULL, 'tes coba 1 2 3', '2021-10-06 18:18:36', '2021-10-06 18:18:36'),
(11, 21, 'assets/photo/bYQNJ6dYke3QDnndecJe5sl4LTfv98zOBCVZWAb0.jpg', 'assets/music/10072021022420615e5a5494938.mp3', NULL, 'tes coba 1 2 3', '2021-10-06 18:24:20', '2021-10-06 18:24:20'),
(12, 22, 'assets/photo/w8su1jYfl4PHFcxzHKxL7Fqu9P2D1KtvOEG0Kr7h.jpg', 'assets/music/10072021022438615e5a66da3b2.mp3', NULL, 'coba 1 2 3', '2021-10-06 18:24:38', '2021-10-06 18:24:38'),
(13, 23, 'assets/photo/eLVFCQI32ZzuI4d8HqQuVt4xm8MCkvBug0YbzZf3.jpg', 'assets/music/10072021023042615e5bd273ae6.mp3', NULL, 'coba 1 2 3', '2021-10-06 18:30:42', '2021-10-06 18:30:42'),
(14, 24, 'assets/photo/bJCjMzpaZPSFRXI78SxKHZ9fcZbXOcIk3qdbb9a6.jpg', 'assets/music/10072021023511615e5cdf9315b.mp3', 'assets/video/1633574137.1559029_14.mp4', 'tes 1 2 3', '2021-10-06 18:35:11', '2021-10-06 18:35:11'),
(15, 25, 'assets/photo/SnQOVkv3p7eAaYXY4gLqDoYnhBgqx5x9YOeFnC97.jpg', 'assets/music/10072021023910615e5dce98eeb.mp3', 'assets/video/1633574354.104209_15.mp4', 'coba coba coba', '2021-10-06 18:39:10', '2021-10-06 18:39:10'),
(16, 26, 'assets/photo/rxTavBufNBYMZHPHQWvKqpIixUV8indmoPJPffTo.jpg', 'assets/music/10072021024141615e5e658e2b6.mp3', 'assets/video/1633574505.496874_16.mp4', 'coba coba coba', '2021-10-06 18:41:41', '2021-10-06 18:41:41'),
(17, 27, 'assets/photo/dB1IRRyrEXXYnk1JTPug9MSsyFaPdaPB0Iz9N3yF.jpg', 'assets/music/10072021025511615e618f6d1bb.mp3', 'assets/video/1633575316.157845_17.mp4', 'sekarang kita mencoba menggunakan google tts', '2021-10-06 18:55:11', '2021-10-06 18:55:11'),
(18, 28, 'assets/photo/Ory7QGtgFaTfiLUzPqGdCad9vPIRzrtT12xiSqSs.jpg', 'assets/music/10072021025655615e61f7249d2.mp3', 'assets/video/1633575418.1167161_18.mp4', 'sekarang kita mencoba menggunakan google tts', '2021-10-06 18:56:55', '2021-10-06 18:56:55'),
(19, 28, 'assets/photo/Qd9YvOsCKIA2QYHuwyaZhtmMOmUX5sal56qbPVhA.jpg', 'assets/music/10072021025658615e61fac0afb.mp3', 'assets/video/1633575422.666084_19.mp4', 'kita memasuki pelajaran matematika, disini kita belajar matematika', '2021-10-06 18:56:58', '2021-10-06 18:56:58'),
(20, 29, 'assets/photo/I2oxfGHe3tyejihGlGaGXbNwPLGuNIWlNcCLpj5y.png', 'assets/music/10072021030131615e630b5da01.mp3', 'assets/video/1633575700.111831_20.mp4', 'Assalamualaikum warahmatullah wabarakatuh, terima kasih atas waktunya bapak-bapak, disini saya akan menjelaskan mengenai journey saya dalam menghadapi problem di journey - journey proses yang selama ini terjadi di dalam operasional kita dengan tema yang saya bawakan adalah improvement proses developmen digitalisasi di hse and operation yang mempercepat proses digitalisasi dan memudahkan kita memahami pengguna kita dalam proses journey perubahan teknologi yang lebih smooth dan efektif', '2021-10-06 19:01:31', '2021-10-06 19:01:31'),
(21, 29, 'assets/photo/2OdGO1wd2hgqcCvd52W6hXbrGpMi5bK5yvsftFva.png', 'assets/music/10072021030142615e6316275d0.mp3', 'assets/video/1633575732.093885_21.mp4', 'Oke pertama, perkenalkan nama saya Abi Nubli Abadi, saya dari departemen mining technology sebagai data & mining technology specialist. Untuk background pendidikan saya, yaitu saya adalah Sarjana S1 jurusan sistem informasi its pada tahun 2017. selanjutnya pengalaman kerja saya adalah sebagai programmer di beberapa perusahaan yang memberikan kepercayaan kepada saya untuk mengembangkan platform aplikasi website dan mobile mereka. Nah berdasarkan background saya tersebut, mining technology merekrut saya guna membantu proses digitalisasi yang ada di berau coal sebagai pelaksana internal development dan agile project implementator.\nAdapun tugas saya yang pertama adalah support dalam proses sintesis web enhancement dan mobile dalam menggerakkan journey web sintesis menjadi mobile dengan fokus kontribusi saya adalah pengolahan data di database sintesis dan proses quality testing pada sistem aplikasi mobile yang telah dikembangkan.\n\nKemudian ada laporan sosialisasi mandiri, saya membuatkan sebuah halaman laporan hasil pekerjaan karyawan untuk memudahkan tim syst compliance memonitoring dan mengenforce pengerjaan refresh sop kerja karyawan pt berau coal sesuai departemennya masing-masing.\n\nSelanjutnya beproduction, yaitu sebuah proses workaround terhadap pain yang mereka hadapi dari pemanfaatan begesit untuk getting data produksi. Kontribusi yang saya lakukan yaitu proses development secara internal dan pada proses change managemen berperan sebagai teknikal advisor saat sosialisasi.\nBeShields, yang saat itu dept head melihat sebuah threat dari pandemi terhadap operasional di berau coal, sehingga melihat opportunity untuk melakukan pengembangan system yang early on untuk langkah awal preventif penyebaran covid19 di berau coal, beshields menggunakan mvp framework system program dari beproduction sehingga mengurangi waktu development secara signifikan dan saya juga menambahkan valuenya dari segi user experience dan interface yang lebih eye catching dan efektif.\nAda juga kemudian observasi area kritis dengan google sheet, sebuah workaround cepat terhadap problem proses pengawasan area kritis dengan google form, karena pengembangan di beats yang belum available akibat schedule pengembangan yang ketat, maka dari itu kita memanfaatkan pengembangan fitur yang ada pada google sheet untuk mendapatkan proses workaround yang fail fast and fail cheap, namun secara value yang utamanya bisa didapatkan.\nSelanjutnya ada job centre, yaitu konsep sidx, yaitu konsep sid karyawan kita punya saat ini yang akan kita bawa ke lingkup luar, case ini adalah ke masyarakat lokal berau, agar dapat mengembangkan calon tenaga kerja lokal lebih berkompeten dan siap kerja sehingga meningkatkan kualitas tenaga kerja lokal dan meningkatkan tingkat safety kerja di lingkup operational pt berau coal\nNah untuk lebih detailnya dari journey yang saya lakukan, selanjutnya akan saya jelaskan di dalam presentasi ini.', '2021-10-06 19:01:42', '2021-10-06 19:01:42'),
(22, 30, 'assets/photo/w5MmRD4FhopvX2XCNoKosTONHYkLBnwXVYDtWa3w.png', 'assets/music/10082021014711615fa31f17aa7.mp3', 'assets/video/1633657660.404462_22.mp4', 'Selamat atas pencapainnya para mentor kami yang terbaik', '2021-10-07 17:47:11', '2021-10-07 17:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `sid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_company` bigint NOT NULL,
  `id_department` bigint NOT NULL,
  `pjo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `struktural` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fungsional` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dedicated_site` int NOT NULL,
  `nama_site` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isactive` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sid`, `nik`, `nik_ktp`, `password`, `id_company`, `id_department`, `pjo`, `struktural`, `fungsional`, `nama`, `tanggal_lahir`, `telp`, `alamat`, `dedicated_site`, `nama_site`, `isactive`, `created_at`, `updated_at`) VALUES
(80268, 'S81UT', '11001571', '', '$2y$10$dr9w9Y6DarsZDvVmYCyRP.6Be3h8MUvR1p3hkXbm.HQA2eZDdBcBG', 5194, 1310, '', 'DATA & MINING TECHNOLOGY SPECIALIST', 'Engineer/Specialist', 'ABI NUBLI ABADI', '1993-06-15', '082140408052', 'KEPUTIH PERMAI BLOK B NO. 1', 111, 'HO', '1', '2021-10-06 00:54:02', '2021-10-06 00:54:02'),
(89551, '24K91', '18000071', '', '$2y$10$GY5XYeP2Mun0qRctMsDro.ISuiGB/daJNIiO.c3BEV.HV83Ex57iO', 5451, 1139, '', 'MAGANG', 'Crew', 'ELFARIAN DELA VIRDAUSA', '1999-04-13', '085203866513', 'JL. ASTA BARAT GG I NO 31\n', 111, 'HO', '1', '2021-10-03 02:07:23', '2021-10-07 17:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video`, `created_at`, `updated_at`) VALUES
(1, NULL, '2021-10-04 00:03:11', '2021-10-04 00:03:11'),
(2, NULL, '2021-10-04 18:54:27', '2021-10-04 18:54:27'),
(3, NULL, '2021-10-04 18:56:53', '2021-10-04 18:56:53'),
(4, NULL, '2021-10-04 18:57:54', '2021-10-04 18:57:54'),
(5, NULL, '2021-10-04 19:02:30', '2021-10-04 19:02:30'),
(6, NULL, '2021-10-04 19:03:18', '2021-10-04 19:03:18'),
(7, NULL, '2021-10-04 19:04:00', '2021-10-04 19:04:00'),
(8, NULL, '2021-10-04 19:05:30', '2021-10-04 19:05:30'),
(9, NULL, '2021-10-04 19:05:45', '2021-10-04 19:05:45'),
(10, 'assets/video/mv_10052021031147615bc273991a6.mp4.mp4', '2021-10-04 19:11:05', '2021-10-04 19:11:48'),
(11, 'assets/video/mv_10052021031619615bc38389377.mp4.mp4', '2021-10-04 19:16:07', '2021-10-04 19:16:20'),
(12, NULL, '2021-10-04 21:10:20', '2021-10-04 21:10:20'),
(13, NULL, '2021-10-06 18:02:41', '2021-10-06 18:02:41'),
(14, NULL, '2021-10-06 18:03:08', '2021-10-06 18:03:08'),
(15, NULL, '2021-10-06 18:05:14', '2021-10-06 18:05:14'),
(16, NULL, '2021-10-06 18:10:54', '2021-10-06 18:10:54'),
(17, NULL, '2021-10-06 18:13:36', '2021-10-06 18:13:36'),
(18, NULL, '2021-10-06 18:16:22', '2021-10-06 18:16:22'),
(19, NULL, '2021-10-06 18:18:19', '2021-10-06 18:18:19'),
(20, NULL, '2021-10-06 18:18:36', '2021-10-06 18:18:36'),
(21, NULL, '2021-10-06 18:24:20', '2021-10-06 18:24:20'),
(22, NULL, '2021-10-06 18:24:38', '2021-10-06 18:24:38'),
(23, NULL, '2021-10-06 18:30:42', '2021-10-06 18:30:42'),
(24, 'assets/video/mv_10072021023537615e5cf9e4ea6.mp4.mp4', '2021-10-06 18:35:11', '2021-10-06 18:35:38'),
(25, 'assets/video/mv_10072021023914615e5dd29eab7.mp4.mp4', '2021-10-06 18:39:10', '2021-10-06 18:39:15'),
(26, 'assets/video/mv_10072021024146615e5e6a17cdd.mp4.mp4', '2021-10-06 18:41:41', '2021-10-06 18:41:46'),
(27, 'assets/video/mv_10072021025516615e6194edbac.mp4.mp4', '2021-10-06 18:55:11', '2021-10-06 18:55:17'),
(28, 'assets/video/mv_10072021025703615e61ffc0bb2.mp4.mp4', '2021-10-06 18:56:55', '2021-10-06 18:57:04'),
(29, 'assets/video/mv_10072021030222615e633ee7cd9.mp4.mp4', '2021-10-06 19:01:31', '2021-10-06 19:02:23'),
(30, 'assets/video/mv_10082021014741615fa33d5740d.mp4.mp4', '2021-10-07 17:47:10', '2021-10-07 17:47:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_video_id_foreign` (`video_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89552;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
