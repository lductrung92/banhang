-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2017 at 07:27 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `pid`, `name`, `icon`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Thời trang nữ', NULL, 'thoi-trang-nu', NULL, 1, '2017-08-11 08:43:23', '2017-08-12 00:57:35'),
(2, 1, 'Quần áo nữ', 'icon/small/dress1.png', 'do-bo-nu', NULL, 1, '2017-08-11 08:45:18', '2017-08-12 01:02:01'),
(3, 2, 'Áo nữ', 'icon/small/dress.png', 'ao-nu', NULL, 1, '2017-08-12 01:02:32', '2017-08-12 01:02:32'),
(4, 2, 'Quần nữ', NULL, 'quan-nu', NULL, 1, '2017-08-12 01:02:43', '2017-08-12 01:02:43'),
(5, 2, 'Bộ đồ nữ', NULL, 'bo-do-nu', NULL, 1, '2017-08-12 01:03:05', '2017-08-12 01:03:05'),
(6, 2, 'Đồ lót nữ', NULL, 'do-lot-nu', NULL, 1, '2017-08-12 01:03:15', '2017-08-12 01:03:15'),
(7, 0, 'Thời trang nam', NULL, 'thoi-trang-nam', NULL, 1, '2017-08-12 01:03:25', '2017-08-12 04:54:02'),
(8, 11, 'Áo nam', 'icon/small/shirt.png', 'ao-nam', NULL, 1, '2017-08-12 01:03:52', '2017-08-12 01:04:49'),
(9, 11, 'Quần nam', NULL, 'quan-nam', NULL, 1, '2017-08-12 01:03:59', '2017-08-12 01:04:49'),
(10, 11, 'Đồ lót nam', NULL, 'do-lot-nam', NULL, 1, '2017-08-12 01:04:09', '2017-08-12 01:04:49'),
(11, 7, 'Quần áo nam', NULL, 'quan-ao-nam', NULL, 1, '2017-08-12 01:04:22', '2017-08-12 05:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `proid` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isfirst` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `proid`, `name`, `isfirst`, `created_at`, `updated_at`) VALUES
(1, 1, 'aokhoacdunuformrongcatinh4ccd-626b7d8.jpg', 1, '2017-08-12 01:08:14', '2017-08-12 01:08:14'),
(2, 1, 'aokhoacdunuformrongcatinh8b00-632cf69.jpg', 1, '2017-08-12 01:08:14', '2017-08-12 01:08:14'),
(3, 1, 'aokhoacdunuformrongcatinh1471-355e9eb.jpg', 1, '2017-08-12 01:08:14', '2017-08-12 01:08:14'),
(4, 1, 'aokhoacdunuformrongcatinhca5c-4766f3b.jpg', 1, '2017-08-12 01:08:14', '2017-08-12 01:08:14'),
(5, 2, 'quanjeannutronphongcach34ee-b174499.jpg', 1, '2017-08-12 01:27:56', '2017-08-12 01:27:56'),
(6, 2, 'quanjeannutronphongcacha4c9-f953867.jpg', 1, '2017-08-12 01:27:56', '2017-08-12 01:27:56'),
(7, 2, 'quanjeannutronphongcachd112-9eaf2e8.jpg', 1, '2017-08-12 01:27:57', '2017-08-12 01:27:57'),
(9, 3, 'boshorthisexyphoirencotimb2975310-e0d1db0.jpg', 1, '2017-08-12 01:30:17', '2017-08-12 01:30:17'),
(10, 3, 'boshorthisexyphoirencotimb297b875-f47bcc4.jpg', 1, '2017-08-12 01:30:17', '2017-08-12 01:30:17'),
(11, 3, 'boshorthisexyphoirencotimb297cf95-52b1a3f.jpg', 1, '2017-08-12 01:30:17', '2017-08-12 01:30:17'),
(12, 4, 'aongucwannabephoirensangtrongan61357a0-b71b9aa.jpg', 1, '2017-08-12 01:32:32', '2017-08-12 01:32:32'),
(13, 4, 'aongucwannabephoirensangtrongan613b34f-a59799a.jpg', 1, '2017-08-12 01:32:32', '2017-08-12 01:32:32'),
(14, 4, 'aongucwannabephoirensangtrongan613f2d4-f6b1bce.jpg', 1, '2017-08-12 01:32:32', '2017-08-12 01:32:32'),
(15, 5, 'aosominamtaynganphoisocthoitrang0397-d5cd75b.jpg', 1, '2017-08-12 01:52:07', '2017-08-12 01:52:07'),
(16, 5, 'aosominamtaynganphoisocthoitrang6232-91ababe.jpg', 1, '2017-08-12 01:52:07', '2017-08-12 01:52:07'),
(17, 5, 'aosominamtaynganphoisocthoitrangb173-325a5ae.jpg', 1, '2017-08-12 01:52:07', '2017-08-12 01:52:07'),
(18, 6, 'quanshortnamrachnangdonge738-a5a448c.jpg', 1, '2017-08-12 01:53:10', '2017-08-12 01:53:10'),
(19, 6, 'quanshortnamrachnangdongf2ab-ea2618e.jpg', 1, '2017-08-12 01:53:10', '2017-08-12 01:53:10'),
(20, 7, 'combo4quanlotnamonymaxphoitruoc5d6e-f29d72d.jpg', 1, '2017-08-12 01:59:12', '2017-08-12 01:59:12'),
(21, 7, 'combo4quanlotnamonymaxphoitruoc456c-aea8368.jpg', 1, '2017-08-12 01:59:12', '2017-08-12 01:59:12'),
(22, 3, 'boshorthisexyphoirencotimb2975310-bcb3f17.jpg', 1, '2017-08-12 03:19:20', '2017-08-12 03:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_08_03_144725_create_categories_table', 1),
(2, '2017_08_05_211830_create_products_table', 1),
(3, '2017_08_07_192743_create_images_table', 1),
(4, '2017_08_09_135854_create_warehouses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `isnew` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cid`, `pid`, `name`, `title`, `slug`, `price`, `options`, `description`, `status`, `isnew`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'Áo khoác dù nữ form rộng cá tính SID63675', 'Áo khoác dù nữ form rộng cá tính SID63675', 'ao-khoac-du-nu-form-rong-ca-tinh-sid63675', '159000', '', '<p><strong>', 1, 0, '2017-08-12 01:08:13', '2017-08-12 01:08:13'),
(2, 4, NULL, 'Quần jean nữ trơn phong cách SID61053', 'Quần jean nữ trơn phong cách SID61053', 'quan-jean-nu-tron-phong-cach-sid61053', '349000', '', '<p><strong><strong>Quần jean nữ trơn phong c', 1, 0, '2017-08-12 01:27:56', '2017-08-12 01:27:56'),
(3, 5, NULL, 'Bộ short HISEXY phối ren cổ tim B297 SID65328', 'Bộ short HISEXY phối ren cổ tim B297 SID65328', 'bo-short-hisexy-phoi-ren-co-tim-b297-sid65328', '350000', '', '<p><strong>Bộ short HISEXY phối ren cổ tim B297</strong>: Chất liệu phi lụa mềm mịn, m</p>', 1, 0, '2017-08-12 01:30:17', '2017-08-12 03:13:48'),
(4, 6, NULL, 'Áo ngực WANNABE phối ren sang trọng AN613 SID61752', 'Áo ngực WANNABE phối ren sang trọng AN613 SID61752', 'ao-nguc-wannabe-phoi-ren-sang-trong-an613-sid61752', '600000', '', '<p><strong>', 1, 0, '2017-08-12 01:32:32', '2017-08-12 01:32:32'),
(5, 8, NULL, 'Áo sơ mi nam tay ngắn phối sọc thời trang SID63700', 'Áo sơ mi nam tay ngắn phối sọc thời trang SID63700', 'ao-so-mi-nam-tay-ngan-phoi-soc-thoi-trang-sid63700', '169000', '', '<p><strong>', 1, 0, '2017-08-12 01:52:07', '2017-08-12 01:52:07'),
(6, 9, NULL, 'Quần short nam rách năng động SID61452', 'Quần short nam rách năng động SID61452', 'quan-short-nam-rach-nang-dong-sid61452', '200000', '', '<p><strong><strong>Quần short nam r', 1, 0, '2017-08-12 01:53:10', '2017-08-12 01:53:10'),
(7, 10, NULL, 'Combo 4 quần lót nam Onymax', 'Combo 4 quần lót nam Onymax', 'combo-4-quan-lot-nam-onymax', '150000', '', '<p>Combo 4 quần l</p>', 0, 0, '2017-08-12 01:59:12', '2017-08-12 01:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `proid` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `exist` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `proid`, `total`, `exist`, `created_at`, `updated_at`) VALUES
(1, 1, 100, 100, '2017-08-12 01:08:14', '2017-08-12 01:08:14'),
(2, 2, 120, 120, '2017-08-12 01:27:57', '2017-08-12 01:27:57'),
(3, 3, 90, 90, '2017-08-12 01:30:17', '2017-08-12 01:30:17'),
(4, 4, 150, 150, '2017-08-12 01:32:32', '2017-08-12 01:32:32'),
(5, 5, 150, 150, '2017-08-12 01:52:07', '2017-08-12 01:52:07'),
(6, 6, 150, 150, '2017-08-12 01:53:10', '2017-08-12 01:53:10'),
(7, 7, 150, 150, '2017-08-12 01:59:12', '2017-08-12 01:59:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `images_name_unique` (`name`),
  ADD KEY `images_proid_foreign` (`proid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_cid_foreign` (`cid`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_proid_foreign` FOREIGN KEY (`proid`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
