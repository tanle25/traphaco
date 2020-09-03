-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2020 at 03:32 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hocketoano_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$YDpmTYdPXRG1FmNCYtW3LeAdX1qw5INghlpVFTMS4myFFe6lEyv6G', 'Ek8AJ3ti0yqSZP4dIyzElTGkWFVEXUqtGqnGVnLNiENu7t0DRBJwl26b3IPU', NULL, NULL),
(2, 'nm.dung.1991@gmail.com', '$2y$10$RUQWSqwJ6I2MhyiCWQ9ZuOQ9CD9xgSq.b67cIkpPVMi/fBPuVxXGu', NULL, '2020-03-05 02:26:44', '2020-03-05 02:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Footer menu', '2020-03-08 03:31:45', '2020-03-08 03:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_items`
--

INSERT INTO `admin_menu_items` (`id`, `label`, `link`, `parent`, `sort`, `class`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'QUY ĐỊNH VÀ CHÍNH SÁCH', '#', 0, 0, NULL, 1, 0, '2020-03-08 03:32:18', '2020-03-08 03:32:29'),
(2, 'Chính sách bảo mật thông tin', '#', 1, 1, NULL, 1, 1, '2020-03-08 03:32:29', '2020-03-08 03:32:41'),
(3, 'Chính sách và quy định chung', '#', 1, 2, NULL, 1, 1, '2020-03-08 03:32:41', '2020-03-08 03:32:54'),
(4, 'HƯỚNG DẪN VÀ HỖ TRỢ', '#', 0, 3, NULL, 1, 0, '2020-03-08 03:32:54', '2020-03-08 03:32:54'),
(5, 'Hướng dẫn tương tác và hỏi đáp cùng giảng viên.', '#', 4, 4, NULL, 1, 1, '2020-03-08 03:33:09', '2020-03-08 03:33:16'),
(6, 'Giới thiệu', 'http://simbaviet.com/unica/gioi-thieu', 4, 5, NULL, 1, 1, '2020-03-10 23:51:50', '2020-03-10 23:51:56'),
(7, 'Tài liệu', 'http://simbaviet.com/unica/tai-lieu', 4, 6, NULL, 1, 1, '2020-03-11 00:30:04', '2020-03-11 00:30:09'),
(8, 'Baodv', 'https://canhme.com/', 0, 7, NULL, 1, 0, '2020-03-20 18:06:33', '2020-03-20 18:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_click` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cat_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `thumbnail`, `status`, `created_at`, `updated_at`, `cat_id`) VALUES
(1, 'Dịch vụ báo cáo tài chính thuế', 'dich-vu-bao-cao-tai-chinh-thue', '<h2>Lorem Ipsum l&agrave; g&igrave;?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;chỉ đơn giản l&agrave; một đoạn văn bản giả, được d&ugrave;ng v&agrave;o việc tr&igrave;nh b&agrave;y v&agrave; d&agrave;n trang phục vụ cho in ấn. Lorem Ipsum đ&atilde; được sử dụng như một văn bản chuẩn cho ng&agrave;nh c&ocirc;ng nghiệp in ấn từ những năm 1500, khi một họa sĩ v&ocirc; danh gh&eacute;p nhiều đoạn văn bản với nhau để tạo th&agrave;nh một bản mẫu văn bản. Đoạn văn bản n&agrave;y kh&ocirc;ng những đ&atilde; tồn tại năm thế kỉ, m&agrave; khi được &aacute;p dụng v&agrave;o tin học văn ph&ograve;ng, nội dung của n&oacute; vẫn kh&ocirc;ng hề bị thay đổi. N&oacute; đ&atilde; được phổ biến trong những năm 1960 nhờ việc b&aacute;n những bản giấy Letraset in những đoạn Lorem Ipsum, v&agrave; gần đ&acirc;y hơn, được sử dụng trong c&aacute;c ứng dụng d&agrave;n trang, như Aldus PageMaker.</p>\r\n\r\n<h2>Tại sao lại sử dụng n&oacute;?</h2>\r\n\r\n<p>Ch&uacute;ng ta vẫn biết rằng, l&agrave;m việc với một đoạn văn bản dễ đọc v&agrave; r&otilde; nghĩa dễ g&acirc;y rối tr&iacute; v&agrave; cản trở việc tập trung v&agrave;o yếu tố tr&igrave;nh b&agrave;y văn bản. Lorem Ipsum c&oacute; ưu điểm hơn so với đoạn văn bản chỉ gồm nội dung kiểu &quot;Nội dung, nội dung, nội dung&quot; l&agrave; n&oacute; khiến văn bản giống thật hơn, b&igrave;nh thường hơn. Nhiều phần mềm thiết kế giao diện web v&agrave; d&agrave;n trang ng&agrave;y nay đ&atilde; sử dụng Lorem Ipsum l&agrave;m đoạn văn bản giả, v&agrave; nếu bạn thử t&igrave;m c&aacute;c đoạn &quot;Lorem ipsum&quot; tr&ecirc;n mạng th&igrave; sẽ kh&aacute;m ph&aacute; ra nhiều trang web hiện vẫn đang trong qu&aacute; tr&igrave;nh x&acirc;y dựng. C&oacute; nhiều phi&ecirc;n bản kh&aacute;c nhau đ&atilde; xuất hiện, đ&ocirc;i khi do v&ocirc; t&igrave;nh, nhiều khi do cố &yacute; (xen th&ecirc;m v&agrave;o những c&acirc;u h&agrave;i hước hay th&ocirc;ng tục).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>N&oacute; đến từ đ&acirc;u?</h2>\r\n\r\n<p>Tr&aacute;i với quan điểm chung của số đ&ocirc;ng, Lorem Ipsum kh&ocirc;ng phải chỉ l&agrave; một đoạn văn bản ngẫu nhi&ecirc;n. Người ta t&igrave;m thấy nguồn gốc của n&oacute; từ những t&aacute;c phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước C&ocirc;ng Nguy&ecirc;n, nghĩa l&agrave; n&oacute; đ&atilde; c&oacute; khoảng hơn 2000 tuổi. Một gi&aacute;o sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan t&acirc;m tới một trong những từ la-tinh kh&oacute; hiểu nhất, &quot;consectetur&quot;, tr&iacute;ch từ một đoạn của Lorem Ipsum, v&agrave; đ&atilde; nghi&ecirc;n cứu tất cả c&aacute;c ứng dụng của từ n&agrave;y trong văn học cổ điển, để từ đ&oacute; t&igrave;m ra nguồn gốc kh&ocirc;ng thể chối c&atilde;i của Lorem Ipsum. Thật ra, n&oacute; được t&igrave;m thấy trong c&aacute;c đoạn 1.10.32 v&agrave; 1.10.33 của &quot;De Finibus Bonorum et Malorum&quot; (Đỉnh tối thượng của C&aacute;i Tốt v&agrave; C&aacute;i Xấu) viết bởi Cicero v&agrave;o năm 45 trước C&ocirc;ng Nguy&ecirc;n. Cuốn s&aacute;ch n&agrave;y l&agrave; một luận thuyết đạo l&iacute; rất phổ biến trong thời k&igrave; Phục Hưng. D&ograve;ng đầu ti&ecirc;n của Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot; được tr&iacute;ch từ một c&acirc;u trong đoạn thứ 1.10.32.</p>\r\n\r\n<p>Tr&iacute;ch đoạn chuẩn của Lorem Ipsum được sử dụng từ thế kỉ thứ 16 v&agrave; được t&aacute;i bản sau đ&oacute; cho những người quan t&acirc;m đến n&oacute;. Đoạn 1.10.32 v&agrave; 1.10.33 trong cuốn &quot;De Finibus Bonorum et Malorum&quot; của Cicero cũng được t&aacute;i bản lại theo đ&uacute;ng cấu tr&uacute;c gốc, k&egrave;m theo phi&ecirc;n bản tiếng Anh được dịch bởi H. Rackham v&agrave;o năm 1914.</p>\r\n\r\n<h2>L&agrave;m thế n&agrave;o để c&oacute; n&oacute;?</h2>\r\n\r\n<p>C&oacute; rất nhiều biến thể của Lorem Ipsum m&agrave; bạn c&oacute; thể t&igrave;m thấy, nhưng đa số được biến đổi bằng c&aacute;ch th&ecirc;m c&aacute;c yếu tố h&agrave;i hước, c&aacute;c từ ngẫu nhi&ecirc;n c&oacute; khi kh&ocirc;ng c&oacute; vẻ g&igrave; l&agrave; c&oacute; &yacute; nghĩa. Nếu bạn định sử dụng một đoạn Lorem Ipsum, bạn n&ecirc;n kiểm tra kĩ để chắn chắn l&agrave; kh&ocirc;ng c&oacute; g&igrave; nhạy cảm được giấu ở giữa đoạn văn bản. Tất cả c&aacute;c c&ocirc;ng cụ sản xuất văn bản mẫu Lorem Ipsum đều được l&agrave;m theo c&aacute;ch lặp đi lặp lại c&aacute;c đoạn chữ cho tới đủ th&igrave; th&ocirc;i, khiến cho lipsum.com trở th&agrave;nh c&ocirc;ng cụ sản xuất Lorem Ipsum đ&aacute;ng gi&aacute; nhất tr&ecirc;n mạng. Trang web n&agrave;y sử dụng hơn 200 từ la-tinh, kết hợp thuần thục nhiều cấu tr&uacute;c c&acirc;u để tạo ra văn bản Lorem Ipsum tr&ocirc;ng c&oacute; vẻ thật sự hợp l&iacute;. Nhờ thế, văn bản Lorem Ipsum được tạo ra m&agrave; kh&ocirc;ng cần một sự lặp lại n&agrave;o, cũng kh&ocirc;ng cần ch&egrave;n th&ecirc;m c&aacute;c từ ngữ h&oacute;m hỉnh hay thiếu trật tự.</p>', 'http://simbaviet.com/unica/FILES/source/user-default.png', 1, '2020-03-29 05:27:57', '2020-03-29 05:27:57', NULL),
(2, 'Dịch vụ Quyết Toán Thuế', 'dich-vu-quyet-toan-thue', '<h2>Lorem Ipsum l&agrave; g&igrave;?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;chỉ đơn giản l&agrave; một đoạn văn bản giả, được d&ugrave;ng v&agrave;o việc tr&igrave;nh b&agrave;y v&agrave; d&agrave;n trang phục vụ cho in ấn. Lorem Ipsum đ&atilde; được sử dụng như một văn bản chuẩn cho ng&agrave;nh c&ocirc;ng nghiệp in ấn từ những năm 1500, khi một họa sĩ v&ocirc; danh gh&eacute;p nhiều đoạn văn bản với nhau để tạo th&agrave;nh một bản mẫu văn bản. Đoạn văn bản n&agrave;y kh&ocirc;ng những đ&atilde; tồn tại năm thế kỉ, m&agrave; khi được &aacute;p dụng v&agrave;o tin học văn ph&ograve;ng, nội dung của n&oacute; vẫn kh&ocirc;ng hề bị thay đổi. N&oacute; đ&atilde; được phổ biến trong những năm 1960 nhờ việc b&aacute;n những bản giấy Letraset in những đoạn Lorem Ipsum, v&agrave; gần đ&acirc;y hơn, được sử dụng trong c&aacute;c ứng dụng d&agrave;n trang, như Aldus PageMaker.</p>\r\n\r\n<h2>Tại sao lại sử dụng n&oacute;?</h2>\r\n\r\n<p>Ch&uacute;ng ta vẫn biết rằng, l&agrave;m việc với một đoạn văn bản dễ đọc v&agrave; r&otilde; nghĩa dễ g&acirc;y rối tr&iacute; v&agrave; cản trở việc tập trung v&agrave;o yếu tố tr&igrave;nh b&agrave;y văn bản. Lorem Ipsum c&oacute; ưu điểm hơn so với đoạn văn bản chỉ gồm nội dung kiểu &quot;Nội dung, nội dung, nội dung&quot; l&agrave; n&oacute; khiến văn bản giống thật hơn, b&igrave;nh thường hơn. Nhiều phần mềm thiết kế giao diện web v&agrave; d&agrave;n trang ng&agrave;y nay đ&atilde; sử dụng Lorem Ipsum l&agrave;m đoạn văn bản giả, v&agrave; nếu bạn thử t&igrave;m c&aacute;c đoạn &quot;Lorem ipsum&quot; tr&ecirc;n mạng th&igrave; sẽ kh&aacute;m ph&aacute; ra nhiều trang web hiện vẫn đang trong qu&aacute; tr&igrave;nh x&acirc;y dựng. C&oacute; nhiều phi&ecirc;n bản kh&aacute;c nhau đ&atilde; xuất hiện, đ&ocirc;i khi do v&ocirc; t&igrave;nh, nhiều khi do cố &yacute; (xen th&ecirc;m v&agrave;o những c&acirc;u h&agrave;i hước hay th&ocirc;ng tục).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>N&oacute; đến từ đ&acirc;u?</h2>\r\n\r\n<p>Tr&aacute;i với quan điểm chung của số đ&ocirc;ng, Lorem Ipsum kh&ocirc;ng phải chỉ l&agrave; một đoạn văn bản ngẫu nhi&ecirc;n. Người ta t&igrave;m thấy nguồn gốc của n&oacute; từ những t&aacute;c phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước C&ocirc;ng Nguy&ecirc;n, nghĩa l&agrave; n&oacute; đ&atilde; c&oacute; khoảng hơn 2000 tuổi. Một gi&aacute;o sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan t&acirc;m tới một trong những từ la-tinh kh&oacute; hiểu nhất, &quot;consectetur&quot;, tr&iacute;ch từ một đoạn của Lorem Ipsum, v&agrave; đ&atilde; nghi&ecirc;n cứu tất cả c&aacute;c ứng dụng của từ n&agrave;y trong văn học cổ điển, để từ đ&oacute; t&igrave;m ra nguồn gốc kh&ocirc;ng thể chối c&atilde;i của Lorem Ipsum. Thật ra, n&oacute; được t&igrave;m thấy trong c&aacute;c đoạn 1.10.32 v&agrave; 1.10.33 của &quot;De Finibus Bonorum et Malorum&quot; (Đỉnh tối thượng của C&aacute;i Tốt v&agrave; C&aacute;i Xấu) viết bởi Cicero v&agrave;o năm 45 trước C&ocirc;ng Nguy&ecirc;n. Cuốn s&aacute;ch n&agrave;y l&agrave; một luận thuyết đạo l&iacute; rất phổ biến trong thời k&igrave; Phục Hưng. D&ograve;ng đầu ti&ecirc;n của Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot; được tr&iacute;ch từ một c&acirc;u trong đoạn thứ 1.10.32.</p>\r\n\r\n<p>Tr&iacute;ch đoạn chuẩn của Lorem Ipsum được sử dụng từ thế kỉ thứ 16 v&agrave; được t&aacute;i bản sau đ&oacute; cho những người quan t&acirc;m đến n&oacute;. Đoạn 1.10.32 v&agrave; 1.10.33 trong cuốn &quot;De Finibus Bonorum et Malorum&quot; của Cicero cũng được t&aacute;i bản lại theo đ&uacute;ng cấu tr&uacute;c gốc, k&egrave;m theo phi&ecirc;n bản tiếng Anh được dịch bởi H. Rackham v&agrave;o năm 1914.</p>\r\n\r\n<h2>L&agrave;m thế n&agrave;o để c&oacute; n&oacute;?</h2>\r\n\r\n<p>C&oacute; rất nhiều biến thể của Lorem Ipsum m&agrave; bạn c&oacute; thể t&igrave;m thấy, nhưng đa số được biến đổi bằng c&aacute;ch th&ecirc;m c&aacute;c yếu tố h&agrave;i hước, c&aacute;c từ ngẫu nhi&ecirc;n c&oacute; khi kh&ocirc;ng c&oacute; vẻ g&igrave; l&agrave; c&oacute; &yacute; nghĩa. Nếu bạn định sử dụng một đoạn Lorem Ipsum, bạn n&ecirc;n kiểm tra kĩ để chắn chắn l&agrave; kh&ocirc;ng c&oacute; g&igrave; nhạy cảm được giấu ở giữa đoạn văn bản. Tất cả c&aacute;c c&ocirc;ng cụ sản xuất văn bản mẫu Lorem Ipsum đều được l&agrave;m theo c&aacute;ch lặp đi lặp lại c&aacute;c đoạn chữ cho tới đủ th&igrave; th&ocirc;i, khiến cho lipsum.com trở th&agrave;nh c&ocirc;ng cụ sản xuất Lorem Ipsum đ&aacute;ng gi&aacute; nhất tr&ecirc;n mạng. Trang web n&agrave;y sử dụng hơn 200 từ la-tinh, kết hợp thuần thục nhiều cấu tr&uacute;c c&acirc;u để tạo ra văn bản Lorem Ipsum tr&ocirc;ng c&oacute; vẻ thật sự hợp l&iacute;. Nhờ thế, văn bản Lorem Ipsum được tạo ra m&agrave; kh&ocirc;ng cần một sự lặp lại n&agrave;o, cũng kh&ocirc;ng cần ch&egrave;n th&ecirc;m c&aacute;c từ ngữ h&oacute;m hỉnh hay thiếu trật tự.</p>', 'http://simbaviet.com/unica/FILES/source/user-default.png', 1, '2020-03-29 05:28:23', '2020-03-29 05:28:23', NULL),
(3, 'Dịch vụ kê khai thuế', 'dich-vu-ke-khai-thue', '<h2>Lorem Ipsum l&agrave; g&igrave;?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;chỉ đơn giản l&agrave; một đoạn văn bản giả, được d&ugrave;ng v&agrave;o việc tr&igrave;nh b&agrave;y v&agrave; d&agrave;n trang phục vụ cho in ấn. Lorem Ipsum đ&atilde; được sử dụng như một văn bản chuẩn cho ng&agrave;nh c&ocirc;ng nghiệp in ấn từ những năm 1500, khi một họa sĩ v&ocirc; danh gh&eacute;p nhiều đoạn văn bản với nhau để tạo th&agrave;nh một bản mẫu văn bản. Đoạn văn bản n&agrave;y kh&ocirc;ng những đ&atilde; tồn tại năm thế kỉ, m&agrave; khi được &aacute;p dụng v&agrave;o tin học văn ph&ograve;ng, nội dung của n&oacute; vẫn kh&ocirc;ng hề bị thay đổi. N&oacute; đ&atilde; được phổ biến trong những năm 1960 nhờ việc b&aacute;n những bản giấy Letraset in những đoạn Lorem Ipsum, v&agrave; gần đ&acirc;y hơn, được sử dụng trong c&aacute;c ứng dụng d&agrave;n trang, như Aldus PageMaker.</p>\r\n\r\n<h2>Tại sao lại sử dụng n&oacute;?</h2>\r\n\r\n<p>Ch&uacute;ng ta vẫn biết rằng, l&agrave;m việc với một đoạn văn bản dễ đọc v&agrave; r&otilde; nghĩa dễ g&acirc;y rối tr&iacute; v&agrave; cản trở việc tập trung v&agrave;o yếu tố tr&igrave;nh b&agrave;y văn bản. Lorem Ipsum c&oacute; ưu điểm hơn so với đoạn văn bản chỉ gồm nội dung kiểu &quot;Nội dung, nội dung, nội dung&quot; l&agrave; n&oacute; khiến văn bản giống thật hơn, b&igrave;nh thường hơn. Nhiều phần mềm thiết kế giao diện web v&agrave; d&agrave;n trang ng&agrave;y nay đ&atilde; sử dụng Lorem Ipsum l&agrave;m đoạn văn bản giả, v&agrave; nếu bạn thử t&igrave;m c&aacute;c đoạn &quot;Lorem ipsum&quot; tr&ecirc;n mạng th&igrave; sẽ kh&aacute;m ph&aacute; ra nhiều trang web hiện vẫn đang trong qu&aacute; tr&igrave;nh x&acirc;y dựng. C&oacute; nhiều phi&ecirc;n bản kh&aacute;c nhau đ&atilde; xuất hiện, đ&ocirc;i khi do v&ocirc; t&igrave;nh, nhiều khi do cố &yacute; (xen th&ecirc;m v&agrave;o những c&acirc;u h&agrave;i hước hay th&ocirc;ng tục).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>N&oacute; đến từ đ&acirc;u?</h2>\r\n\r\n<p>Tr&aacute;i với quan điểm chung của số đ&ocirc;ng, Lorem Ipsum kh&ocirc;ng phải chỉ l&agrave; một đoạn văn bản ngẫu nhi&ecirc;n. Người ta t&igrave;m thấy nguồn gốc của n&oacute; từ những t&aacute;c phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước C&ocirc;ng Nguy&ecirc;n, nghĩa l&agrave; n&oacute; đ&atilde; c&oacute; khoảng hơn 2000 tuổi. Một gi&aacute;o sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan t&acirc;m tới một trong những từ la-tinh kh&oacute; hiểu nhất, &quot;consectetur&quot;, tr&iacute;ch từ một đoạn của Lorem Ipsum, v&agrave; đ&atilde; nghi&ecirc;n cứu tất cả c&aacute;c ứng dụng của từ n&agrave;y trong văn học cổ điển, để từ đ&oacute; t&igrave;m ra nguồn gốc kh&ocirc;ng thể chối c&atilde;i của Lorem Ipsum. Thật ra, n&oacute; được t&igrave;m thấy trong c&aacute;c đoạn 1.10.32 v&agrave; 1.10.33 của &quot;De Finibus Bonorum et Malorum&quot; (Đỉnh tối thượng của C&aacute;i Tốt v&agrave; C&aacute;i Xấu) viết bởi Cicero v&agrave;o năm 45 trước C&ocirc;ng Nguy&ecirc;n. Cuốn s&aacute;ch n&agrave;y l&agrave; một luận thuyết đạo l&iacute; rất phổ biến trong thời k&igrave; Phục Hưng. D&ograve;ng đầu ti&ecirc;n của Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot; được tr&iacute;ch từ một c&acirc;u trong đoạn thứ 1.10.32.</p>\r\n\r\n<p>Tr&iacute;ch đoạn chuẩn của Lorem Ipsum được sử dụng từ thế kỉ thứ 16 v&agrave; được t&aacute;i bản sau đ&oacute; cho những người quan t&acirc;m đến n&oacute;. Đoạn 1.10.32 v&agrave; 1.10.33 trong cuốn &quot;De Finibus Bonorum et Malorum&quot; của Cicero cũng được t&aacute;i bản lại theo đ&uacute;ng cấu tr&uacute;c gốc, k&egrave;m theo phi&ecirc;n bản tiếng Anh được dịch bởi H. Rackham v&agrave;o năm 1914.</p>\r\n\r\n<h2>L&agrave;m thế n&agrave;o để c&oacute; n&oacute;?</h2>\r\n\r\n<p>C&oacute; rất nhiều biến thể của Lorem Ipsum m&agrave; bạn c&oacute; thể t&igrave;m thấy, nhưng đa số được biến đổi bằng c&aacute;ch th&ecirc;m c&aacute;c yếu tố h&agrave;i hước, c&aacute;c từ ngẫu nhi&ecirc;n c&oacute; khi kh&ocirc;ng c&oacute; vẻ g&igrave; l&agrave; c&oacute; &yacute; nghĩa. Nếu bạn định sử dụng một đoạn Lorem Ipsum, bạn n&ecirc;n kiểm tra kĩ để chắn chắn l&agrave; kh&ocirc;ng c&oacute; g&igrave; nhạy cảm được giấu ở giữa đoạn văn bản. Tất cả c&aacute;c c&ocirc;ng cụ sản xuất văn bản mẫu Lorem Ipsum đều được l&agrave;m theo c&aacute;ch lặp đi lặp lại c&aacute;c đoạn chữ cho tới đủ th&igrave; th&ocirc;i, khiến cho lipsum.com trở th&agrave;nh c&ocirc;ng cụ sản xuất Lorem Ipsum đ&aacute;ng gi&aacute; nhất tr&ecirc;n mạng. Trang web n&agrave;y sử dụng hơn 200 từ la-tinh, kết hợp thuần thục nhiều cấu tr&uacute;c c&acirc;u để tạo ra văn bản Lorem Ipsum tr&ocirc;ng c&oacute; vẻ thật sự hợp l&iacute;. Nhờ thế, văn bản Lorem Ipsum được tạo ra m&agrave; kh&ocirc;ng cần một sự lặp lại n&agrave;o, cũng kh&ocirc;ng cần ch&egrave;n th&ecirc;m c&aacute;c từ ngữ h&oacute;m hỉnh hay thiếu trật tự.</p>', 'http://simbaviet.com/unica/FILES/source/user-default.png', 1, '2020-03-29 05:28:41', '2020-03-29 05:28:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_catalog`
--

CREATE TABLE `article_catalog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `catalog_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chu_tai_khoan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `chu_tai_khoan`, `stk`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vietcombank - Thành Công', 'Trần Văn Hiếu', '0451000341307', 'FILES/source/logovietcombank.jpg', 1, '2020-05-14 02:42:42', '2020-06-24 01:14:05'),
(2, 'MB Bank', 'Trần Văn Hiếu', '860113586868', 'FILES/source/Logo_MB_new.png', 1, '2020-06-24 01:15:40', '2020-06-24 01:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `vitri` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `link`, `page_id`, `content`, `pos`, `vitri`, `type`, `note`, `status`, `created_at`, `updated_at`) VALUES
(4, 'FILES/source/banner/banner.jpg', NULL, NULL, 1, NULL, 1, 1, NULL, NULL, 1, '2020-05-04 01:19:08', '2020-08-04 07:58:29'),
(5, 'FILES/source/banner/banner.jpg', 'Banner2', NULL, 1, NULL, NULL, 1, NULL, NULL, 1, '2020-05-05 09:24:47', '2020-08-04 07:58:49'),
(6, 'FILES/source/banner/2.jpg', NULL, NULL, 1, NULL, 1, 1, NULL, NULL, 1, '2020-08-04 12:38:51', '2020-08-04 12:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `tel` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `map_lat` float(8,6) DEFAULT NULL,
  `map_long` float(9,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `tel`, `active`, `map_lat`, `map_long`, `created_at`, `updated_at`) VALUES
(1, 'Công ty TNHH HEO', 'Số 41A - Lô D2 Khu đô thị Đại Kim, Phường Đại Kim, Quận Hoàng Mai, Thành phố Hà Nội', '090.999.9999', 1, 20.974987, 105.833885, NULL, NULL),
(3, 'Chi nhánh số 1', 'Địa chỉ chi nhánh số 1', '0912.345.678', 1, 20.976988, 105.833885, '2020-08-02 10:49:56', '2020-08-02 10:50:13'),
(4, 'Cty TNHH ABC', 'Thanh hóa', '543534', 1, 19.774448, 105.789001, '2020-08-03 07:37:15', '2020-08-03 07:37:15'),
(7, 'Chi nhánh học kế toán online', 'Địa chỉ văn phòng đại diện a', '0987108844', 1, 19.001955, 105.596260, '2020-08-04 12:57:53', '2020-08-04 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `sum` bigint(20) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `pay_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-Chưa chọn, 1-cod, 2-online',
  `city` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `post_id`, `sum`, `code`, `pay_type`, `city`, `address`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 4, 183000, 'ASb4j1584416823', 0, NULL, NULL, 2, '2020-03-16 19:21:20', '2020-03-16 20:55:12'),
(10, 4, 4, 183000, 'dw3Vf1584422313', 0, NULL, NULL, 2, '2020-03-16 22:10:06', '2020-03-16 22:18:40'),
(11, 3, 4, 183000, 'POC761584422423', 0, NULL, NULL, 2, '2020-03-16 22:19:31', '2020-03-16 22:20:34'),
(13, 8, 4, 183000, 'Ix3Yh1584636693', 0, NULL, NULL, 2, '2020-03-19 09:43:18', '2020-03-19 09:52:00'),
(14, 10, 12, 125000, '9pAXg1585749373', 0, NULL, NULL, 0, '2020-03-20 07:23:35', '2020-03-20 07:23:35'),
(15, 10, 13, 150000, '8pDQg1585749373', 0, NULL, NULL, 0, '2020-03-20 07:23:42', '2020-03-20 07:23:42'),
(16, 11, 4, 183000, '972Gg1585749373', 0, NULL, NULL, 0, '2020-03-20 19:35:11', '2020-03-20 19:35:11'),
(17, 11, 12, 125000, '9p67A1585749373', 0, NULL, NULL, 0, '2020-03-20 19:36:49', '2020-03-20 19:36:49'),
(19, 3, 15, 200000, 'CTem21585490178', 0, NULL, NULL, 2, '2020-03-29 06:55:44', '2020-03-29 06:58:46'),
(20, 3, 12, 125000, '0jEr31585490178', 0, NULL, NULL, 2, '2020-03-29 06:55:58', '2020-03-29 06:58:51'),
(21, 3, 14, 170000, 'Z1IHF1585490178', 0, NULL, NULL, 2, '2020-03-29 06:56:16', '2020-03-29 06:58:57'),
(23, 7, 12, 125000, '9pDGg1585749373', 0, NULL, NULL, 2, '2020-04-01 06:33:40', '2020-04-01 07:14:33'),
(24, 3, 13, 150000, 'v7RvK1586573936', 0, NULL, NULL, 1, '2020-04-10 19:58:45', '2020-04-10 19:58:56'),
(26, 14, 12, 125000, '5K3Gg1585749373', 2, 1, NULL, 1, '2020-04-23 03:37:12', '2020-05-14 12:58:54'),
(27, 16, 12, 125000, 'slq9D1587639171', 0, NULL, NULL, 2, '2020-04-23 03:37:18', '2020-04-23 03:53:29'),
(28, 16, 4, 181000, 'i6xYz1587639171', 0, NULL, NULL, 1, '2020-04-23 03:48:48', '2020-04-23 03:52:51'),
(29, 16, 15, 200000, 'zEyXX1587639171', 0, NULL, NULL, 1, '2020-04-23 03:52:46', '2020-04-23 03:52:51'),
(30, 16, 13, 150000, 'vYmM51587639474', 0, NULL, NULL, 1, '2020-04-23 03:57:51', '2020-04-23 03:57:54'),
(31, 16, 14, 170000, 'KeY4b1587639568', 0, NULL, NULL, 1, '2020-04-23 03:59:25', '2020-04-23 03:59:28'),
(33, 18, 4, 181000, 'Z1IHF1585490178', 2, 49, NULL, 1, '2020-04-25 03:20:47', '2020-04-27 02:11:11'),
(35, 18, 13, 150000, 'GKy2t1587953455', 2, 49, NULL, 1, '2020-04-27 02:10:55', '2020-04-27 02:11:11'),
(36, 18, 14, 170000, 'JYRHU1587958494', 2, 4, NULL, 2, '2020-04-27 03:34:54', '2020-04-27 03:38:12'),
(43, 21, 13, 150000, '1mQhk1589184871', 0, NULL, NULL, 0, '2020-05-11 08:14:31', '2020-05-11 08:14:31'),
(44, 21, 14, 170000, 'usx581589185283', 0, NULL, NULL, 0, '2020-05-11 08:21:23', '2020-05-11 08:21:23'),
(47, 14, 4, 181000, 'dVGCo1589461070', 2, 1, NULL, 1, '2020-05-14 12:57:50', '2020-05-14 12:58:54'),
(49, 14, 14, 170000, 'f4gL21589535402', 1, 49, 'Hồ Tây', 1, '2020-05-15 09:36:42', '2020-05-15 09:37:10'),
(50, 14, 34, 599000, 'tbxnB1589535421', 1, 49, 'Hồ Tây', 2, '2020-05-15 09:37:01', '2020-05-15 09:42:42'),
(51, 22, 4, 181000, 'DUsIP1589597139', 2, 26, NULL, 1, '2020-05-16 02:45:39', '2020-05-16 02:46:18'),
(52, 18, 44, 499000, 'cLu3w1589597495', 0, NULL, NULL, 0, '2020-05-16 02:51:35', '2020-05-16 02:51:35'),
(53, 24, 34, 599000, 'jsXw41589619553', 2, 57, NULL, 2, '2020-05-16 08:59:13', '2020-05-16 09:15:43'),
(54, 24, 13, 150000, '4U6bD1589620274', 2, 53, NULL, 1, '2020-05-16 09:11:14', '2020-05-16 09:11:44'),
(55, 24, 44, 499000, 'gEzgy1589620295', 2, 53, NULL, 1, '2020-05-16 09:11:35', '2020-05-16 09:11:44'),
(56, 23, 4, 181000, '6YSX21591434376', 2, 49, NULL, 2, '2020-06-06 09:06:16', '2020-06-06 09:10:47'),
(58, 19, 4, 181000, 'fd5my1593414490', 1, 57, 'Phương THA', 1, '2020-06-29 07:08:10', '2020-06-29 07:08:23'),
(59, 28, 13, 150000, '975g61594210098', 2, 1, NULL, 2, '2020-07-08 12:08:18', '2020-07-08 12:11:43'),
(60, 28, 34, 599000, 'lkboH1594210126', 2, 1, NULL, 2, '2020-07-08 12:08:46', '2020-07-08 12:11:30'),
(61, 17, 13, 150000, 'I6rmq1597808506', 2, 57, NULL, 1, '2020-08-19 03:41:46', '2020-08-19 03:42:02'),
(62, 17, 14, 170000, 'PPPDh1597808635', 2, 49, NULL, 2, '2020-08-19 03:43:55', '2020-08-19 03:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

CREATE TABLE `catalogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 1,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogs`
--

INSERT INTO `catalogs` (`id`, `title`, `slug`, `content`, `parent_id`, `sort`, `thumbnail`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dịch vụ kế toán', 'dich-vu-ke-toan', NULL, NULL, 1, 'http://simbaviet.com/unica/FILES/source/user-default.png', 1, '2020-03-29 05:27:38', '2020-03-29 05:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_noibat` tinyint(4) DEFAULT NULL,
  `no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`, `type`, `cat_id`, `note`, `status`, `created_at`, `updated_at`, `icon`, `is_noibat`, `no`) VALUES
(1, 'ke-toan-san-xuat-tren-misa', 'Kế toán SẢN XUẤT trên Misa', NULL, 1, NULL, 1, '2020-03-04 20:22:38', '2020-03-19 07:03:30', 'FILES/source/c2.png', NULL, NULL),
(2, 'tieng-anh', 'Tiếng Anh', NULL, 1, NULL, 1, '2020-03-04 20:27:28', '2020-03-04 20:27:28', NULL, NULL, NULL),
(3, 'tieng-han', 'Tiếng Hàn', NULL, 1, NULL, 0, '2020-03-04 22:42:16', '2020-03-04 22:42:16', NULL, NULL, NULL),
(5, 'ca-phe', 'Cà phê', NULL, 4, NULL, 1, '2020-03-04 22:49:00', '2020-03-04 22:49:00', NULL, NULL, NULL),
(6, 'khoa-hoc-ke-toan-xay-dung-tren-misa', 'Khoá học Kế toán xây dựng trên MISA', NULL, 6, NULL, 1, '2020-03-19 07:04:25', '2020-04-27 08:31:47', NULL, 1, NULL),
(7, 'ke-toan-xay-dung-tren-misa', 'Kế toán XÂY DỰNG trên Misa', NULL, 6, NULL, 1, '2020-03-19 07:11:06', '2020-03-19 07:11:06', NULL, NULL, NULL),
(9, 'ke-toan-misa', 'Kế toán misa', NULL, 8, NULL, 1, '2020-04-27 09:23:44', '2020-04-27 09:23:44', NULL, 0, NULL),
(10, 'hoc-ke-toan-cty-xay-dung', 'Học kế toán cty Xây Dựng', NULL, NULL, NULL, 1, '2020-04-27 09:24:27', '2020-08-01 08:15:07', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(21, 'khoa-hoc-ke-toan-dich-vu-tren-3tsoft', 'Khoá học Kế toán dịch vụ trên  3TSOFT', NULL, 17, NULL, 1, '2020-04-28 08:05:32', '2020-04-28 08:05:32', NULL, 0, NULL),
(41, 'hoc-ke-toan-cty-thuong-mai', 'Học kế toán cty Thương Mại', NULL, NULL, NULL, 1, '2020-07-17 05:27:30', '2020-07-17 05:27:30', NULL, 1, NULL),
(42, 'hoc-ke-toan-cty-san-xuat', 'Học kế toán cty Sản Xuất', NULL, NULL, NULL, 1, '2020-07-17 05:28:30', '2020-07-21 04:21:26', NULL, 1, NULL),
(43, 'hoc-ke-toan-cty-thiet-ke', 'Học kế toán cty Thiết Kế', NULL, NULL, NULL, 1, '2020-07-17 05:29:18', '2020-08-04 14:24:55', NULL, 1, 1),
(44, 'hoc-ke-toan-cty-xnk', 'Học kế toán cty XNK', NULL, NULL, NULL, 1, '2020-07-17 05:29:39', '2020-07-17 05:35:17', NULL, 1, NULL),
(45, 'hoc-ke-toan-cty-dich-vu', 'Hoc kế toán cty Dịch vụ', NULL, NULL, NULL, 1, '2020-07-17 05:37:21', '2020-07-17 05:37:21', NULL, 1, NULL),
(46, 'hoc-ke-toan-cty-cau-duong', 'Học kế toán cty Cầu Đường', NULL, NULL, NULL, 1, '2020-07-17 05:38:11', '2020-07-17 05:38:11', NULL, 1, NULL),
(47, 'dich-vu-ke-toan-thue', 'DỊCH VỤ KẾ TOÁN THUẾ', NULL, NULL, NULL, 1, '2020-07-17 05:42:40', '2020-07-21 07:13:02', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(48, 'hoa-don-dien-tu', 'HOÁ ĐƠN ĐIỆN TỬ', NULL, NULL, NULL, 1, '2020-07-17 05:43:25', '2020-07-17 05:43:25', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(49, 'chu-ky-so', 'CHỮ KÝ SỐ', NULL, NULL, NULL, 1, '2020-07-17 05:43:45', '2020-07-17 05:43:57', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(50, 'dich-vu-hoan-thue', 'DỊCH VỤ HOÀN THUẾ', NULL, NULL, NULL, 1, '2020-07-17 05:44:25', '2020-07-17 05:44:25', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(51, 'dao-tao-ke-toan-thuc-hanh', 'ĐÀO TẠO KẾ TOÁN THỰC HÀNH', NULL, NULL, NULL, 1, '2020-07-17 05:46:01', '2020-07-17 05:46:01', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(52, 'ke-khai-bhxh', 'KÊ KHAI BHXH', NULL, NULL, NULL, 1, '2020-07-17 05:46:47', '2020-08-04 14:23:05', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, 1),
(53, 'dich-vu-ke-khai-thue', 'DỊCH VỤ KÊ KHAI THUẾ', NULL, NULL, NULL, 1, '2020-07-17 05:47:17', '2020-07-17 05:47:17', 'FILES/source/banner/57303270_1227463364078740_7839276743629209600_o.jpg', 1, NULL),
(54, 'dich-vu-bctc-thue', 'DỊCH VỤ BCTC THUẾ', NULL, NULL, NULL, 1, '2020-07-17 05:47:29', '2020-08-04 14:23:44', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_s` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `link`, `des_s`, `des_f`, `image`, `pos`, `section_id`, `type`, `note`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dịch vụ kê khai thuế', 'http://simbaviet.com/unica/bai-viet/dich-vu-bao-cao-tai-chinh-thue', 'Dịch vụ kê khai thuế chuyên nghiệp', NULL, 'FILES/source/062835_cbo-3-khoa-chung-khoan_thumb.jpg', 1, 1, NULL, NULL, 1, 1, '2020-03-08 03:02:19', '2020-04-27 01:05:03'),
(2, 'Đăng ký', 'http://hocketoanonline.com.vn/', 'Học kế toán online', '<p>h&atilde;y đăng k&yacute; ngay từ b&acirc;y giờ</p>', 'FILES/source/nhaplieusmall.png', 1, 3, NULL, NULL, 1, 1, '2020-03-08 03:10:39', '2020-08-04 12:44:36'),
(3, 'Nguyễn Hiếu', '#', 'Đại sứ Yoga Việt Nam', NULL, 'FILES/source/August52016431pm_nguyen-hieu_thumb.jpg', 1, 4, NULL, NULL, 1, 1, '2020-03-08 03:16:10', '2020-03-08 03:16:10'),
(4, 'Học viên', NULL, '200.000+', NULL, NULL, 1, 7, NULL, NULL, 1, 1, '2020-03-11 00:08:54', '2020-03-11 00:08:54'),
(5, 'Giảng viên', NULL, '450+', NULL, NULL, 2, 7, NULL, NULL, 1, 1, '2020-03-11 00:09:08', '2020-03-11 00:09:08'),
(6, 'Khóa học', NULL, '800+', NULL, NULL, 3, 7, NULL, NULL, 1, 1, '2020-03-11 00:09:24', '2020-03-11 00:09:24'),
(7, 'Affliate', NULL, '15.000+', NULL, NULL, 4, 7, NULL, NULL, 1, 1, '2020-03-11 00:09:39', '2020-03-11 00:09:55'),
(8, 'QUÉT TÀI LIỆU', NULL, 'Quét và lập chỉ mục truy xuất đối với các hóa đơn, hợp đồng, sách, tài liệu kỹ thuật,… từ khổ A5 đến A0 bằng máy quét tốc độ cao.', NULL, 'FILES/source/h1.png', 1, 8, NULL, NULL, 1, 1, '2020-03-11 00:13:49', '2020-08-01 10:00:41'),
(9, 'Nguyễn Ngân Hà', '#', 'Mình đang theo học khóa Tiếng Anh tại hr, chương trình dạy rất thực tế và dễ hiểu cho người mất gốc. Chỉ sau 3 tháng mình đã có thể tự tin giao tiếp Tiếng Anh cơ bản và sử dụng được ngay trong chuyến du lịch Thái vừa rồi. Rất cám ơn hr và cô giáo đã nhiệt tình support, mình sẽ tham khảo thêm các khóa nâng cao hơn để thi lấy chứng chỉ Tiếng Anh nữa.', NULL, 'FILES/source/ab-av-1.jpg', 1, 9, NULL, NULL, 1, 1, '2020-03-11 00:17:45', '2020-03-11 00:17:45'),
(10, 'Cơ hội nghề nghiệp', NULL, 'Tham gia ngay', '<p>hr lu&ocirc;n ch&agrave;o đ&oacute;n những nh&acirc;n tố t&agrave;i năng v&agrave; t&acirc;m huyết với sứ mệnh &quot;n&acirc;ng cao gi&aacute; trị tri thức, phục vụ h&agrave;ng triệu người Việt Nam</p>', 'FILES/source/ab1.png', 1, 10, NULL, NULL, 1, 1, '2020-03-11 00:22:21', '2020-03-11 00:22:21'),
(11, 'Xem và học thử các khóa học', NULL, NULL, NULL, NULL, 1, 11, NULL, NULL, 1, 1, '2020-03-11 00:26:57', '2020-03-11 00:26:57'),
(12, 'Dịch vụ báo cáo tài chính thuế', 'http://unica.simbaviet.com/bai-viet/dich-vu-quyet-toan-thue', 'Dịch vụ báo cáo tài chính thuế chuyên nghiệp', NULL, 'FILES/source/bao-cao-tai-chinh.jpg', NULL, 1, NULL, NULL, 1, 1, '2020-03-19 08:24:29', '2020-03-29 05:48:35'),
(13, 'Dịch vụ Quyết Toán Thuế', 'http://unica.simbaviet.com/bai-viet/dich-vu-ke-khai-thue', 'Dịch vụ Quyết Toán Thuế', NULL, 'FILES/source/dich-vu-quyet-toan-thue-2.jpg', NULL, 1, NULL, NULL, 1, 1, '2020-03-19 08:29:03', '2020-03-29 05:48:40'),
(14, 'Đăng ký', 'http://cokhithepminhphu.com/', 'Học kế toán thực tế', NULL, 'FILES/source/xulydulieusmall.png', 2, 3, NULL, NULL, 1, 1, '2020-03-19 08:30:13', '2020-08-05 03:33:09'),
(15, 'Đăng ký', '#', 'Hóa đơn điện tử', NULL, 'FILES/source/quettailieusmall.png', 3, 3, NULL, NULL, 1, 1, '2020-03-19 08:31:41', '2020-08-03 03:39:43'),
(16, 'Dịch vụ', '#', 'BCTC trọn gói', NULL, 'FILES/source/phanmemsmall.png', 4, 3, NULL, NULL, 1, 1, '2020-03-19 08:32:52', '2020-08-03 03:40:15'),
(17, 'HỒ NGỌC CƯƠNG', '#', 'Freelancer Facebook Marketing', NULL, 'FILES/source/ho-ngoc-cuong.jpg', 2, 4, NULL, NULL, 1, 1, '2020-03-19 08:35:29', '2020-03-19 08:35:29'),
(18, 'Phạm Thành Long', '#', 'Luật sư - Diễn giả', NULL, 'FILES/source/pham%20thanh%20long.jpg', 3, 4, NULL, NULL, 1, 1, '2020-03-19 08:37:41', '2020-03-19 08:37:41'),
(19, 'Lê Thẩm Dương', NULL, 'Tiến sĩ - Diễn giả chuyên nghiệp - Chuyên gia Tài chính, Lãnh đạo, Nhân sự.....', NULL, 'FILES/source/_ts-le-tham-duong.jpg', 4, 4, NULL, NULL, 1, 1, '2020-03-19 08:41:26', '2020-03-19 08:42:51'),
(20, 'Dịch vụ đào tạo kế toán cho doanh nghiệp', 'http://hocketoanonline.com.vn/dich-vu-dao-tao-ke-toan-cho-doanh-nghiep', NULL, NULL, 'FILES/source/pha-che-barista-tu-co-ban-den-nang-cao_m_1561532187.jpg', NULL, 1, NULL, NULL, 1, 1, '2020-07-18 01:41:06', '2020-07-18 01:41:06'),
(22, 'Giảng viên 1', '#', 'Giới thiệu ngắn giảng viên', NULL, 'FILES/source/img-home-banner-1.png', NULL, 4, NULL, NULL, 1, 1, '2020-08-04 12:47:32', '2020-08-04 12:47:32'),
(24, 'Dịch vụ đào tạo kế toán 1', '#', 'Mô tả ngắn dịch vụ 1', NULL, 'FILES/source/xulydulieusmall.png', 3, 3, NULL, NULL, 1, 1, '2020-08-04 14:16:00', '2020-08-04 14:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uses` int(10) UNSIGNED DEFAULT NULL,
  `max_uses` int(10) UNSIGNED DEFAULT NULL,
  `max_uses_user` int(10) UNSIGNED DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `is_fixed` tinyint(1) NOT NULL DEFAULT 1,
  `starts_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `name`, `description`, `uses`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `is_fixed`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, '174125a', 'Trần Minh', 'aaaaaaaaaaaaaaaaaaaaa', NULL, 20, NULL, 1, 50, 1, '2020-06-26 17:00:00', '2020-06-29 17:00:00', '2020-06-26 03:17:49', '2020-06-26 03:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `danhgias`
--

CREATE TABLE `danhgias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kh_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sosao` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhgias`
--

INSERT INTO `danhgias` (`id`, `kh_id`, `user_id`, `content`, `sosao`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '<p>Kh&oacute;a học bổ &iacute;ch</p>', 3, 1, '2020-03-05 02:48:01', '2020-03-10 20:04:39'),
(2, 14, 18, 'bài học rất là chất lượng. cảm ơn thầy giáo', 5, 0, '2020-04-27 03:56:29', '2020-04-27 03:56:29'),
(3, 15, 3, '<p>nội dung r&otilde; r&agrave;ng, gi&aacute;o tr&igrave;nh ổn</p>', 5, 1, '2020-04-28 07:20:19', '2020-04-28 07:21:00'),
(4, 14, 18, '<p>kh&oacute;a học chất lượng</p>', 5, 1, '2020-05-05 13:55:33', '2020-05-05 13:56:03'),
(5, 14, 18, '<p>kh&oacute;a học chất lượng</p>', 3, 1, '2020-05-05 13:56:39', '2020-05-05 13:56:51'),
(6, 14, 3, '<p>kho&aacute; học tuyệt vời</p>', 1, 1, '2020-05-08 05:52:17', '2020-05-08 05:54:05'),
(7, 13, 18, '<p>http://simbaviet.com/unica/khoa-hoc/len-bao-cao-tai-chinh-tai-doanh-nghiep-thuong-mai</p>', 5, 1, '2020-05-11 08:09:42', '2020-05-11 08:10:18'),
(8, 4, 18, 'http://simbaviet.com/unica/khoa-hoc/len-bao-cao-tai-chinh-tai-doanh-nghiep-thuong-mai', 5, 0, '2020-05-11 08:11:02', '2020-05-11 08:11:02'),
(9, 34, 10, '111111111111111111', 3, 1, '2020-06-05 16:11:13', '2020-06-05 16:11:13'),
(10, 4, 23, '<p>chất lượng tốt</p>', 5, 1, '2020-06-06 09:11:58', '2020-06-06 09:12:28'),
(11, 13, 28, '<p>b&agrave;i học hay v&agrave; tuyệt vời</p>', 5, 1, '2020-07-08 12:17:38', '2020-07-08 12:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `giangviens`
--

CREATE TABLE `giangviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giangviens`
--

INSERT INTO `giangviens` (`id`, `name`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lê Hà Anh', '<p><strong>Thạc Sĩ Kinh Tế, Cử Nh&acirc;n Luật,</strong><strong>&nbsp;Luật Gia TPHCM</strong></p>\r\n\r\n<p>- Gi&aacute;m Đốc Trung T&acirc;m Đ&agrave;o Tạo Quốc Tế &Acirc;u Vi&ecirc;t</p>\r\n\r\n<p>- Giảng vi&ecirc;n tại trường Đại Học Văn Hiến</p>\r\n\r\n<p>- Giảng vi&ecirc;n tại trường Đại Học Hutech TP.HCM</p>', 'FILES/source/ng1.png', '2020-03-04 21:29:03', '2020-04-28 07:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `giaodiches`
--

CREATE TABLE `giaodiches` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `stk_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stk_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stk_type` int(11) DEFAULT NULL,
  `stk_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giaodiches`
--

INSERT INTO `giaodiches` (`id`, `code`, `user_id`, `stk_name`, `stk_number`, `stk_type`, `stk_branch`, `account_id`, `created_by`, `updated_by`, `type`, `amount`, `content`, `status`, `created_at`, `updated_at`) VALUES
(12, 'NT-ZEd3J1587639070', 16, 'Nguyễn Sỹ Mạnh', '4454545', 1, NULL, 1, NULL, 1, 1, 1000000, 'Nạp tiền vào tài khoản #16 - Email :hoangmanhit@gmail.com', 1, '2020-04-23 03:51:10', '2020-04-23 03:51:35'),
(13, 'NT-PLI2o1588156853', 3, 'nguyen van vuong', '0011004184602', 1, NULL, 1, NULL, 1, 1, 360000, 'Nạp tiền vào tài khoản #3 - Email :vuongplus.jsc@gmail.com', 1, '2020-04-29 10:40:53', '2020-04-29 10:44:46'),
(14, 'NT-pOHf41588688122', 3, 'nguyen van vuong', '0011004184602', 1, NULL, 1, NULL, NULL, 1, 360000, 'Nạp tiền vào tài khoản #3 - Email :vuongplus.jsc@gmail.com', 0, '2020-05-05 14:15:22', '2020-05-05 14:15:22'),
(15, 'NT-bjpfe1588954415', 3, 'nguyen van vuong', '0011004184602', 3, NULL, 1, NULL, NULL, 1, 460000, 'Nạp tiền vào tài khoản #3 - Email :vuongplus.jsc@gmail.com', 0, '2020-05-08 16:13:35', '2020-05-08 16:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `history_logins`
--

CREATE TABLE `history_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE `icons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_11_073824_create_menus_wp_table', 1),
(4, '2017_08_11_074006_create_menu_items_wp_table', 1),
(5, '2019_07_16_150955_create_webinfos_table', 1),
(6, '2019_07_16_164609_create_pages_table', 1),
(7, '2019_07_17_012951_create_banners_table', 1),
(8, '2019_07_17_023731_create_seos_table', 1),
(9, '2019_07_17_025524_create_images_table', 1),
(10, '2019_07_17_032406_create_icons_table', 1),
(11, '2019_07_17_033903_create_tags_table', 1),
(12, '2019_07_17_034949_create_categories_table', 1),
(13, '2019_07_17_035809_create_posts_table', 1),
(14, '2019_07_17_071036_create_albums_table', 1),
(15, '2019_07_18_015156_create_sections_table', 1),
(16, '2019_07_18_025101_create_contents_table', 1),
(17, '2020_02_27_040008_create_contacts_table', 1),
(18, '2020_03_05_013537_create_admins_table', 1),
(19, '2020_03_05_040809_create_giangviens_table', 2),
(20, '2020_03_05_092951_create_danhgias_table', 3),
(21, '2020_03_05_095343_create_history_logins_table', 4),
(22, '2020_03_05_100332_create_thongbaos_table', 5),
(23, '2020_03_05_101924_create_tailieus_table', 6),
(24, '2019_12_17_031505_baodv_create_provinces_table', 7),
(25, '2020_03_29_032224_create_articles_table', 7),
(26, '2020_03_29_032304_create_catalogs_table', 7),
(27, '2020_03_29_032337_create_article_catalog_table', 7),
(28, '2020_04_20_141811_create_table_coupons_table', 8),
(29, '2020_04_20_142042_create_table_user_coupons_table', 8),
(30, '2020_04_20_142111_create_table_post_coupons_table', 8),
(31, '2020_04_20_150624_create_vouchers_table', 8),
(32, '2020_04_21_141353_create_services_table', 8),
(33, '2020_04_23_125000_create_user_reset_pass_table', 8),
(34, '2019_07_24_014343_create_social_accounts_table', 9),
(35, '2020_04_26_115545_add_pay_type_and_region_id_to_carts_table', 9),
(36, '2020_04_26_163253_create_banks_table', 9),
(37, '2020_04_26_205545_add_address_to_carts_table', 9),
(38, '2020_04_26_225545_add_is_noibat_to_categories_table', 9),
(39, '2020_04_29_205545_add_url_view_to_sections_table', 10),
(40, '2020_04_29_235545_add_sum_rate_to_posts_table', 11),
(41, '2020_05_06_235545_add_image_to_pages_table', 12),
(42, '2020_05_08_235545_add_encrypt_video_to_posts_table', 13),
(43, '2020_05_12_000000_add_logo_to_banks_table', 14),
(44, '2020_05_14_000000_add_chu_tai_khoan_to_banks_table', 15),
(45, '2020_05_24_000000_add_hoc_thu_to_posts_table', 16),
(46, '2020_05_29_000000_add_video_hoc_thu_to_posts_table', 17),
(47, '2020_08_01_143829_add_no_to_categories_table', 18),
(48, '2020_08_06_000000_add_cat_id_to_articles_table', 19),
(49, '2020_08_22_000000_create_tai_lieu_khoa_hoc_table', 19),
(50, '2020_08_22_000000_create_tai_lieu_khoa_hocs_table', 19),
(51, '2020_08_26_000000_add_link_download_to_tailieus_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `name`, `type`, `content`, `created_at`, `updated_at`, `image`) VALUES
(1, 'trang-chu', 'Trang chủ', 1, NULL, '2020-03-04 19:47:48', '2020-03-04 19:47:48', NULL),
(2, 'gioi-thieu', 'Giới thiệu', 2, NULL, '2020-03-04 19:48:09', '2020-06-24 01:05:34', 'FILES/source/August52016431pm_nguyen-hieu_thumb.jpg'),
(4, 'tai-lieu', 'Tài liệu', 7, NULL, '2020-03-04 19:48:48', '2020-03-04 19:48:48', NULL),
(5, 'chinh-sach-bao-mat', 'Chính sách bảo mật', 10, '<p>Nội dung ch&iacute;nh s&aacute;ch bảo mật</p>', '2020-03-04 19:51:06', '2020-05-19 15:54:30', 'FILES/source/tuan-bui-thiet-ke-web.png'),
(8, 'gioi-thieu-ve-hocketoanonline', 'giới thiệu về hocketoanonline', 12, '<p>test&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '2020-06-06 08:51:49', '2020-06-23 09:01:53', 'FILES/source/tuan-bui-thiet-ke-web.png'),
(10, 'gioi-thieu-dich-vu-ke-toan', 'Giới thiệu dịch vụ kế toán', 12, '<p>Nội dung chi tiết b&agrave;i viết</p>', '2020-07-18 01:37:40', '2020-07-18 01:37:40', 'FILES/source/pha-che-barista-tu-co-ban-den-nang-cao_m_1561532187.jpg'),
(11, 'dich-vu-dao-tao-ke-toan-cho-doanh-nghiep', 'Dịch vụ đào tạo kế toán cho doanh nghiệp', 12, '<p>Nội dung chi tiết dịch vụ</p>', '2020-07-18 01:40:20', '2020-07-18 01:40:20', 'FILES/source/pha-che-barista-tu-co-ban-den-nang-cao_m_1561532187.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nucuoithienthan88@gmail.com', '$2y$10$RNFgMGi1Gbb3Du0r73EQ9O6js909YJE12XzAg1DH54R33XshxNt1y', '2020-04-22 18:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uudai` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoantien` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loiich` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `giangvien_id` int(11) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `price2` float DEFAULT NULL,
  `des_s` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_click` int(11) DEFAULT NULL,
  `sosao` int(11) DEFAULT NULL,
  `kh_id` int(11) DEFAULT NULL,
  `noi_bat` int(11) DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `sum_time` bigint(20) DEFAULT 0,
  `status` tinyint(1) DEFAULT NULL,
  `hoc_thu` tinyint(4) NOT NULL DEFAULT 0,
  `video_hoc_thu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sum_rate` double(8,2) DEFAULT NULL,
  `encrypt_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `slug`, `name`, `video`, `uudai`, `hoantien`, `loiich`, `giangvien_id`, `image`, `price`, `price2`, `des_s`, `content`, `cat_id`, `tags`, `number_click`, `sosao`, `kh_id`, `noi_bat`, `pos`, `type`, `sum_time`, `status`, `hoc_thu`, `video_hoc_thu`, `created_at`, `updated_at`, `sum_rate`, `encrypt_video`) VALUES
(4, 'nguyen-ly-ke-toan-cho-nguoi-moi-bat-dau', 'Nguyên lý kế toán cho người mới bắt đầu1', 'https://www.youtube.com/embed/PfTRsSbF61U', 'Thời gian ưu đãi còn 1 ngày.', 'Hoàn tiền trong 7 ngày nếu không hài lòng.', '<ul>\r\n	<li>Nắm được Nguy&ecirc;n l&yacute; kế to&aacute;n l&agrave; như thế n&agrave;o.</li>\r\n	<li>Hiểu bản chất v&agrave; l&agrave;m được kế to&aacute;n căn bản</li>\r\n	<li>C&oacute; được kiến thức&nbsp;tương đương, thậm ch&iacute; l&agrave; vượt so với sinh vi&ecirc;n kế to&aacute;n học trong trường</li>\r\n	<li>C&oacute; được kiến thức nền tảng tốt để chuẩn bị cho c&aacute;c kh&oacute;a học kế to&aacute;n tiếp theo.</li>\r\n</ul>', 1, 'FILES/source/nguyen-ly-ke-toan-cho-nguoi-moi-bat-dau_1559199606.jpg', 800000, 181000, 'Nguyên lý kế toán cho người mới bắt đầu là khóa kế toán cơ bản dành cho những bạn chưa biết gì về kế toán, muốn chuyển sang nghề kế toán hoặc những bạn đã học lâu rồi nhưng nay đã quên.', '<p><strong>Nguy&ecirc;n l&yacute; kế to&aacute;n cho người mới bắt đầu</strong>&nbsp;l&agrave; kh&oacute;a kế to&aacute;n cơ bản d&agrave;nh cho những bạn chưa biết g&igrave; về kế to&aacute;n, muốn chuyển sang&nbsp;nghề kế to&aacute;n hoặc những bạn đ&atilde; học l&acirc;u rồi nhưng&nbsp;nay đ&atilde; qu&ecirc;n.1</p>\r\n\r\n<p>Kh&oacute;a học được x&acirc;y dựng dựa tr&ecirc;n nền tảng&nbsp;<strong>Nguy&ecirc;n l&yacute; kế to&aacute;n</strong>&nbsp;được viết bởi trường Học Viện T&agrave;i Ch&iacute;nh, đảm bảo đầy đủ kiến thức căn bản của kế to&aacute;n, gi&uacute;p người học hiểu một c&aacute;ch to&agrave;n diện&nbsp;về kế to&aacute;n.</p>', 10, 'Kế toán, Tài chính', NULL, 2, NULL, 1, 1, 1, 520, 1, 0, NULL, '2020-03-04 22:51:03', '2020-07-17 05:25:43', 4.00, NULL),
(5, NULL, 'Phần 1: Giới thiệu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 1, 2, 260, NULL, 0, NULL, '2020-03-04 22:51:21', '2020-04-27 09:01:34', NULL, NULL),
(7, NULL, 'Phần 2: Kế toán thuế giá trị gia tăng cơ bản', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 2, 2, 260, NULL, 0, NULL, '2020-03-04 22:52:08', '2020-04-27 09:05:53', NULL, NULL),
(8, NULL, 'Phần 3: Kế toán vốn bằng tiền', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 3, 2, 0, NULL, 0, NULL, '2020-03-04 22:52:31', '2020-04-27 08:57:12', NULL, NULL),
(9, NULL, 'Bài 1: Giới thiệu khóa học', 'https://videos.hocketoanonline.com.vn/streamer/embed.php?v=NDEx', NULL, NULL, NULL, NULL, 'http://hocketoanonline.com.vn/https://videos.hocketoanonline.com.vn/streamer/embed.php?v=NDEx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 3, 130, NULL, 1, 'https://youtube.com/embed/PfTRsSbF61U', '2020-03-05 00:20:30', '2020-07-06 16:27:01', NULL, NULL),
(11, NULL, 'Bài 2: Học theo chế độ kế toán nào', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/videos/test.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 3, 130, NULL, 0, NULL, '2020-03-05 01:26:57', '2020-04-27 09:01:34', NULL, NULL),
(13, 'len-bao-cao-tai-chinh-tai-doanh-nghiep-thuong-mai', 'Lên Báo cáo tài chính tại doanh nghiệp thương mại', NULL, NULL, NULL, '<ul>\r\n	<li>Biết l&agrave;m th&ocirc;ng b&aacute;o ph&aacute;t h&agrave;nh h&oacute;a đơn</li>\r\n	<li>Nộp tờ khai v&agrave; tiền thuế m&ocirc;n b&agrave;i</li>\r\n	<li>Quy định xử phạt nếu kh&ocirc;ng nộp</li>\r\n	<li>C&aacute;c c&ocirc;ng việc đầu ti&ecirc;n của 1 doanh nghiệp mới th&agrave;nh lập</li>\r\n	<li>Tự tin định khoản nghiệp vụ kế to&aacute;n được ở mọi doanh nghiệp</li>\r\n	<li>Biết l&agrave;m bảng chấm c&ocirc;ng, bảng lương</li>\r\n	<li>Biết l&ecirc;n BCTC trong doanh nghiệp thương mại</li>\r\n	<li>Kiểm tra b&aacute;o c&aacute;o t&agrave;i ch&iacute;nh</li>\r\n	<li>L&agrave;m tờ khai quyết to&aacute;n thuế thu nhập doanh nghiệp năm</li>\r\n	<li>L&agrave;m tờ khai quyết to&aacute;n thuế thu nhập c&aacute; nh&acirc;n năm</li>\r\n</ul>', 1, 'FILES/source/baocaotaichinh.jpg', 330000, 150000, 'Hướng dẫn các công việc đầu tiên ở DN mới thành lập, hướng dẫn kê khai, nộp thuế môn bài, làm thông báo phát hành hóa đơn', '<p>B&aacute;o c&aacute;o t&agrave;i ch&iacute;nh&nbsp;được xem như l&agrave; hệ thống c&aacute;c bảng biểu, m&ocirc; tả th&ocirc;ng tin về t&igrave;nh h&igrave;nh t&agrave;i ch&iacute;nh, kinh doanh v&agrave; c&aacute;c luồng tiền của doanh nghiệp. B&aacute;o c&aacute;o t&agrave;i ch&iacute;nh những b&aacute;o c&aacute;o tổng hợp nhất về t&igrave;nh h&igrave;nh t&agrave;i sản, vốn chủ sở hữu v&agrave; nợ phải trả cũng như t&igrave;nh h&igrave;nh t&agrave;i ch&iacute;nh, kết quả kinh doanh trong kỳ của doanh nghiệp.</p>\r\n\r\n<p>H&atilde;y đến với kh&oacute;a học&nbsp;<strong>L&ecirc;n B&aacute;o c&aacute;o t&agrave;i ch&iacute;nh tại doanh nghiệp thương mại</strong>&nbsp;tại&nbsp;<strong>Unica.vn</strong></p>\r\n\r\n<p>Hướng dẫn c&aacute;c c&ocirc;ng việc đầu ti&ecirc;n ở DN mới th&agrave;nh lập, hướng dẫn k&ecirc; khai, nộp thuế m&ocirc;n b&agrave;i, l&agrave;m th&ocirc;ng b&aacute;o ph&aacute;t h&agrave;nh h&oacute;a đơn</p>\r\n\r\n<p>Hướng dẫn ph&acirc;n biệt h&oacute;a đơn mua v&agrave;o trong doanh nghiệp, hướng dẫn l&agrave;m bảng lương, bảng chấm c&ocirc;ng; nhập số dư đầu kỳ, h&oacute;a đơn mua v&agrave;o - b&aacute;n ra, chứng từ ng&acirc;n h&agrave;ng. L&agrave;m tờ khai quyết to&aacute;n thuế TNDN, Thu nhập c&aacute; nh&acirc;n. In sổ s&aacute;ch, chứng từ kế to&aacute;n</p>\r\n\r\n<p>Nắm vững quy định của ph&aacute;p luật về lệ ph&iacute; thuế m&ocirc;n b&agrave;i, đăng k&yacute; t&agrave;i khoản ng&acirc;n h&agrave;ng thuế điện tử</p>', 10, 'Tài chính', NULL, 4, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-03-19 08:08:16', '2020-07-17 05:25:31', 5.00, 'FoGB0XEqFYuW5K83thfi.m3u8'),
(14, 'phap-luat-thue', 'Pháp luật thuế', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, '<ul>\r\n	<li>Nắm vững v&agrave; ph&acirc;n biệt r&otilde; sự kh&aacute;c nhau giữa Ph&aacute;p Luật Thuế v&agrave; Ph&aacute;p luật Kế To&aacute;n</li>\r\n	<li>C&oacute; kiến thức đ&uacute;ng - đầy đủ, biết l&agrave;m thực tế khi điều h&agrave;nh hoặc khai b&aacute;o thuế cho Doanh Nghiệp.</li>\r\n	<li>C&oacute; sự r&otilde; r&agrave;ng v&agrave; minh bạch trong c&aacute;c chi ph&iacute;.</li>\r\n	<li>Quy tr&igrave;nh Kế To&aacute;n tại Doanh Nghiệp.</li>\r\n	<li>C&oacute; sự hiểu biết để xử l&yacute; đ&uacute;ng luật về sổ s&aacute;ch, chứng từ.</li>\r\n	<li>K&ecirc; khai đ&uacute;ng c&aacute;c khoản chi ph&iacute; kh&ocirc;ng c&oacute; H&oacute;a đơn theo đ&uacute;ng quy định</li>\r\n</ul>', 1, 'FILES/source/phap-luat-thue.jpg', 350000, 170000, 'Nắm vững và phân biệt rõ sự khác nhau giữa Pháp Luật Thuế và Pháp luật Kế Toán - Có thể hạch toán được nợ và có nhưng chưa chắc đã làm được kế toán đúng.', '<p>C&oacute; thể n&oacute;i, thuế l&agrave; hiện tượng tất yếu, xuất hiện v&agrave; tồn tại c&ugrave;ng với c&aacute;c hiện tượng kinh tế - x&atilde; hội kh&aacute;c. Sự xuất hiện v&agrave; ph&aacute;t triển của thuế gắn với mỗi giai đoạn, lợi &iacute;ch m&agrave; nh&agrave; nước sử dụng n&oacute; l&agrave; c&ocirc;ng cụ điều tiết nguồn thu của nền kinh tế x&atilde; hội ấy.</p>\r\n\r\n<p>Ph&aacute;p luật về thuế lu&ocirc;n l&agrave; một lĩnh vực c&oacute; t&iacute;nh chất phức tạp cao, dễ g&acirc;y nhầm lẫn giữa c&aacute;c chế định về thuế kh&aacute;c nhau do vậy t&ocirc;i xin được thống k&ecirc; những kiến thức ph&aacute;p l&yacute; cơ bản về thuế để c&aacute;c bạn c&oacute; thể vận dụng trong hoạt động kinh doanh của đơn vị m&igrave;nh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;Kh&oacute;a học của t&ocirc;i sẽ đ&uacute;c kết ngắn gọn về Quy tr&igrave;nh th&agrave;nh lập Doanh Nghiệp.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Quy tr&igrave;nh Kế To&aacute;n tại Doanh Nghiệp.</p>\r\n\r\n<p>- Từ khi Doanh Nghiệp mới th&agrave;nh lập đến quyết to&aacute;n cuối năm.</p>', 10, 'Thuế', NULL, 4, NULL, 1, NULL, 1, 130, 1, 0, NULL, '2020-03-19 08:11:24', '2020-08-26 01:50:22', 3.00, NULL),
(18, NULL, 'Phần 1: TỔNG QUAN KHÓA HỌC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 1, 2, 130, NULL, 0, NULL, '2020-04-27 03:47:47', '2020-05-05 02:53:17', NULL, NULL),
(19, NULL, 'Bài 1: Giới thiệu khóa học', 'https://www.youtube.com/watch?v=qGgZlZhia44', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, NULL, 3, 130, NULL, 0, NULL, '2020-04-27 03:48:45', '2020-05-05 02:53:17', NULL, NULL),
(20, NULL, 'Phần 1: Giới thiệu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 1, 2, 0, NULL, 0, NULL, '2020-04-27 08:54:02', '2020-04-27 08:54:02', NULL, NULL),
(21, NULL, 'Phần 2: Kế toán thuế giá trị gia tăng cơ bản', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 2, 2, 0, NULL, 0, NULL, '2020-04-27 08:57:27', '2020-04-27 08:57:27', NULL, NULL),
(22, NULL, 'Phần 3: Kế toán vốn bằng tiền', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 3, 2, 0, NULL, 0, NULL, '2020-04-27 08:57:40', '2020-04-27 08:57:40', NULL, NULL),
(23, NULL, 'Bài 3: Thuế giá trị gia tăng là gì?', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 3, 130, NULL, 0, NULL, '2020-04-27 09:00:46', '2020-04-27 09:04:37', NULL, NULL),
(24, NULL, 'Bài 4: Phương pháp tính thuế giá trị gia tăng trực tiếp', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 3, 130, NULL, 0, NULL, '2020-04-27 09:02:06', '2020-04-27 09:05:53', NULL, NULL),
(25, NULL, 'Bài 5: Khái quát và nhiệm vụ kế toán vốn bằng tiền', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:02:43', '2020-04-27 09:02:43', NULL, NULL),
(26, NULL, 'Bài 6: Chứng từ, sổ sách và tài khoản sử dụng đối với kế toán tiền', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:03:10', '2020-04-27 09:03:10', NULL, NULL),
(28, NULL, 'Bài 1: Giới thiệu khóa học', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:07:28', '2020-04-27 09:07:28', NULL, NULL),
(29, NULL, 'Bài 2: Học theo chế độ kế toán nào', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/videos/test.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:09:10', '2020-04-27 09:09:10', NULL, NULL),
(30, NULL, 'Bài 3: Thuế giá trị gia tăng là gì?', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:09:53', '2020-04-27 09:09:53', NULL, NULL),
(31, NULL, 'Bài 4: Phương pháp tính thuế giá trị gia tăng trực tiếp', NULL, NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:10:24', '2020-04-27 10:11:30', NULL, NULL),
(32, NULL, 'Bài 5: Khái quát và nhiệm vụ kế toán vốn bằng tiền', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:10:54', '2020-04-27 09:10:54', NULL, NULL),
(33, NULL, 'Bài 6: Chứng từ, sổ sách và tài khoản sử dụng đối với kế toán tiền', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:11:20', '2020-04-27 09:11:20', NULL, NULL),
(34, 'ke-toan-doanh-nghiep-cho-nguoi-moi-bat-dau', 'Kế toán doanh nghiệp cho người mới bắt đầu', NULL, NULL, NULL, '<ul>\r\n	<li>Bạn sẽ nắm được c&aacute;ch hạch to&aacute;n kế to&aacute;n c&aacute;c phần h&agrave;nh kế to&aacute;n trong doanh nghiệp.</li>\r\n	<li>Hiểu bản chất hạch to&aacute;n c&aacute;c nghiệp vụ kế to&aacute;n từ đơn giản đến phức tạp.</li>\r\n	<li>Kiến thức c&oacute; được tương đương, thậm ch&iacute; l&agrave; vượt so với sinh vi&ecirc;n kế to&aacute;n học trong trường.</li>\r\n	<li>C&oacute; được kiến thức nền tảng tốt để chuẩn bị cho c&aacute;c kh&oacute;a học kế to&aacute;n tiếp theo.</li>\r\n</ul>', 1, 'FILES/source/B20_m_1566974742.jpg', 599000, NULL, 'Kế toán là ngành nghề luôn cần thiết trong xã hội, có vai trò quan trọng trong mỗi doanh nghiệp.', '<p>Đ&acirc;y&nbsp;l&agrave; kh&oacute;a học kế to&aacute;n cơ bản cho những người mới bắt đầu v&agrave;o nghề kế to&aacute;n hoặc học đ&atilde;&nbsp;l&acirc;u v&agrave;&nbsp;nay đ&atilde; qu&ecirc;n. Nếu bạn l&agrave; người mới ho&agrave;n to&agrave;n th&igrave; bạn n&ecirc;n học kh&oacute;a học &quot;Nguy&ecirc;n l&yacute; kế to&aacute;n&quot; trước, sau đ&oacute; mới học được kh&oacute;a n&agrave;y. Kh&oacute;a học n&agrave;y được x&acirc;y dựng dựa tr&ecirc;n nền tảng được viết bởi trường Học Viện T&agrave;i Ch&iacute;nh v&agrave; kết hợp với kiến thực thực tế của giảng vi&ecirc;n để phong ph&uacute; hơn cho kh&oacute;a học. Đảm bảo đầy đủ kiến thức căn bản của kế to&aacute;n. Gi&uacute;p người học c&oacute; được c&aacute;i nh&igrave;n ban đầu một c&aacute;ch dễ hiểu về kế to&aacute;n trong doanh nghiệp.<br />\r\nKh&oacute;a học đi s&acirc;u v&agrave;o từng phần h&agrave;nh kế to&aacute;n trong doanh nghiệp. Từ kế to&aacute;n vốn bằng tiền đến Kế to&aacute;n h&agrave;ng tồn kho, Kế to&aacute;n TSCĐ, Kế to&aacute;n tiền lương, Kế to&aacute;n phải thu, phải trả, Kế to&aacute;n gi&aacute; th&agrave;nh, Kế to&aacute;n ti&ecirc;u thụ x&aacute;c định kết quả kinh doanh, Kế to&aacute;n vốn chủ sở hữu...</p>', 10, 'Kế toán', NULL, 4, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-04-27 09:29:46', '2020-07-17 05:24:47', NULL, NULL),
(35, NULL, 'Phần 1: Giới thiệu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, 1, 2, 0, NULL, 0, NULL, '2020-04-27 09:35:45', '2020-04-27 09:35:45', NULL, NULL),
(36, NULL, 'Phần 2: Kế toán thuế giá trị gia tăng cơ bản', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, 2, 2, 0, NULL, 0, NULL, '2020-04-27 09:36:30', '2020-04-27 09:36:30', NULL, NULL),
(37, NULL, 'Phần 3: Kế toán vốn bằng tiền', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, NULL, 3, 2, 0, NULL, 0, NULL, '2020-04-27 09:36:44', '2020-04-27 09:36:44', NULL, NULL),
(38, NULL, 'Bài 1: Giới thiệu khóa học', 'https://www.youtube.com/watch?v=EngW7tLk6R8', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:37:26', '2020-04-27 10:20:10', NULL, NULL),
(39, NULL, 'Bài 2: Học theo chế độ kế toán nào', 'https://www.youtube.com/embed/PfTRsSbF61U', NULL, NULL, NULL, NULL, 'FILES/source/SampleVideo_360x240_1mb.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:37:54', '2020-04-27 10:19:34', NULL, NULL),
(40, NULL, 'Bài 3: Thuế giá trị gia tăng là gì?', NULL, NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:38:26', '2020-04-27 10:11:42', NULL, NULL),
(41, NULL, 'Bài 4: Phương pháp tính thuế giá trị gia tăng trực tiếp', NULL, NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:38:57', '2020-04-27 10:11:52', NULL, NULL),
(42, NULL, 'Bài 5: Khái quát và nhiệm vụ kế toán vốn bằng tiền', NULL, NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:40:22', '2020-04-27 10:12:00', NULL, NULL),
(43, NULL, 'Bài 6: Chứng từ, sổ sách và tài khoản sử dụng đối với kế toán tiền', 'https://www.youtube.com/watch?v=nBADFUDapmk', NULL, NULL, NULL, NULL, 'FILES/source/small.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-04-27 09:40:47', '2020-07-07 01:30:34', NULL, NULL),
(44, 'ke-toan-san-xuat-thuc-hanh-tren-excel', 'Kế toán sản xuất thực hành trên excel', 'https://www.youtube.com/embed/UXyxGTaSvGY?rel=0&showinfo=0', NULL, NULL, '<ul>\r\n	<li>Hiểu được đặc điểm về cơ cấu tổ chức, quy tr&igrave;nh sản xuất th&ocirc;ng thường của doanh nghiệp sản xuất.</li>\r\n	<li>Hiểu được quy tr&igrave;nh lu&acirc;n chuyển chứng từ kế to&aacute;n trong doanh nghiệp sản xuất.</li>\r\n	<li>Hiểu được phương ph&aacute;p hạch to&aacute;n kế to&aacute;n trong doanh nghiệp sản xuất.</li>\r\n	<li>Nắm chắc c&aacute;c phương ph&aacute;p t&iacute;nh gi&aacute; th&agrave;nh trong doanh nghiệp&nbsp;sản xuất v&agrave; vận dụng linh hoạt.</li>\r\n	<li>Hiểu r&otilde; c&aacute;c quy định về định mức v&agrave; c&aacute;ch lập định mức trong doanh nghiệp sản xuất.</li>\r\n	<li>Hiểu được bản chất v&agrave; sự kh&aacute;c biệt của kế to&aacute;n sản xuất với c&aacute;c loại h&igrave;nh kế to&aacute;n kh&aacute;c.</li>\r\n	<li>Th&agrave;nh thạo c&aacute;ch lập b&aacute;o c&aacute;o t&agrave;i ch&iacute;nh.</li>\r\n	<li>Biết c&aacute;ch l&agrave;m sổ s&aacute;ch tự động, in sổ s&aacute;ch lưu trữ.</li>\r\n</ul>', 1, 'FILES/source/nguyen-ly-ke-toan-cho-nguoi-moi-bat-dau_1559199606.jpg', 499000, NULL, 'Thực hành chi tiết từng nghiệp vụ của kế toán doanh nghiệp sản xuất trên bộ chứng từ kế toán thực tế vào phần mềm Excel', '<p>Bạn l&agrave; kế to&aacute;n vi&ecirc;n c&ograve;n thiếu kinh nghiệm l&agrave;m việc thực tế.</p>\r\n\r\n<p>Bạn muốn t&igrave;m hiểu kỹ hơn về kế to&aacute;n sản xuất, để &aacute;p dụng trong c&ocirc;ng việc</p>\r\n\r\n<p>H&atilde;y t&igrave;m hiểu kh&oacute;a học&nbsp;<strong>Kế to&aacute;n sản xuất thực h&agrave;nh tr&ecirc;n excel.&nbsp;</strong>Trong kh&oacute;a học, bạn&nbsp;sẽ được hướng dẫn thực h&agrave;nh chi tiết từng nghiệp vụ của kế to&aacute;n doanh nghiệp sản xuất tr&ecirc;n bộ chứng từ kế to&aacute;n thực tế v&agrave;o phần mềm excel.</p>\r\n\r\n<p><strong>Tại sao n&ecirc;n chọn kh&oacute;a học n&agrave;y?</strong></p>\r\n\r\n<p>Giảng vi&ecirc;n c&oacute; nhiều năm kinh nghiệm l&agrave;m kế to&aacute;n ở c&ocirc;ng ty sản xuất lớn của nước ngo&agrave;i, c&oacute; kinh nghiệm giảng dạy thực tế ở trung t&acirc;m đ&agrave;o tạo kế to&aacute;n.</p>\r\n\r\n<p>Nội dung kh&oacute;a học được thiết kế đơn giản nhất để bạn&nbsp;c&oacute; thể hiểu, thực h&agrave;nh, vận dụng v&agrave;o thực tế (hướng dẫn bạn&nbsp;sử dụng những h&agrave;m excel đơn giản v&agrave; hữu &iacute;ch nhất, được tải t&agrave;i liệu về để thực h&agrave;nh, c&oacute; file kết quả để đối chiếu...)</p>\r\n\r\n<p>Bạn được giảng vi&ecirc;n hỗ trợ mọi l&uacute;c, mọi nơi qua c&aacute;c c&ocirc;ng cụ như&nbsp; teamviewer, utraviewer, zalo, facebook, điện thoại ...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', 10, 'Kế toán', NULL, NULL, NULL, 1, NULL, 1, 150, 1, 0, NULL, '2020-05-05 02:25:25', '2020-08-28 06:56:40', NULL, NULL),
(45, NULL, 'Phần 1: Khai báo đầu kỳ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 1, 2, 150, NULL, 0, NULL, '2020-05-05 02:27:38', '2020-05-05 02:35:05', NULL, NULL),
(46, NULL, 'Phần 2: Hạch toán các nghiệp vụ trong kỳ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 2, 2, 0, NULL, 0, NULL, '2020-05-05 02:28:17', '2020-05-05 02:28:17', NULL, NULL),
(47, NULL, 'Phần 3: Lên sổ sách', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, NULL, 3, 2, 0, NULL, 0, NULL, '2020-05-05 02:28:26', '2020-05-05 02:28:26', NULL, NULL),
(48, NULL, 'Bài 1: Giới thiệu khóa học', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:29:14', '2020-05-05 02:29:14', NULL, NULL),
(49, NULL, 'Bài 2: Khai báo danh mục đầu kỳ', 'https://www.youtube.com/watch?v=EngW7tLk6R8', NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 3, 150, NULL, 0, NULL, '2020-05-05 02:34:18', '2020-05-05 02:36:48', NULL, NULL),
(50, NULL, 'Bài 3: Nhập số dư đầu kỳ', 'https://www.youtube.com/watch?v=EngW7tLk6R8', NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:38:03', '2020-05-05 02:38:03', NULL, NULL),
(51, NULL, 'Bài 4: Quy trình ghi sổ kế toán', 'https://www.youtube.com/watch?v=EngW7tLk6R8', NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:38:32', '2020-05-05 02:38:32', NULL, NULL),
(52, NULL, 'Bài 5: Hạch toán các nghiệp vụ trong kỳ (NV1-NV5)', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:38:59', '2020-05-05 02:38:59', NULL, NULL),
(53, NULL, 'Bài 6: Hạch toán các nghiệp vụ trong kỳ (NV6-NV10)', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:39:16', '2020-05-05 02:39:16', NULL, NULL),
(54, NULL, 'Bài 7: Lên bảng cân đối tài khoản', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:40:13', '2020-05-05 02:40:13', NULL, NULL),
(55, NULL, 'Bài 8: Kiểm tra số liệu', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:40:35', '2020-05-05 02:40:35', NULL, NULL),
(56, NULL, 'Bài 9: Lên bảng cân đối kế toán', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:40:57', '2020-05-05 02:40:57', NULL, NULL),
(57, NULL, 'Phần 2: HỒ SƠ DOANH NGHIỆP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 2, 2, 0, NULL, 0, NULL, '2020-05-05 02:47:57', '2020-05-05 02:47:57', NULL, NULL),
(58, NULL, 'Phần 3: THỦ TỤC ĐĂNG KÝ ÁP DỤNG PHƯƠNG PHÁP TÍNH THUẾ GIÁ TRỊ GIA TĂNG và ĐẶT IN HÓA ĐƠN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 3, 2, 0, NULL, 0, NULL, '2020-05-05 02:48:07', '2020-05-05 02:48:07', NULL, NULL),
(59, NULL, 'Bài 2: Thuế là gì, công tác quản lý Thuế và quy trình xử lý chứng từ và sổ sách kế toán', 'https://www.youtube.com/watch?v=qGgZlZhia44', NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:53:46', '2020-05-05 02:53:46', NULL, NULL),
(60, NULL, 'Bài 3: Thủ tục Đăng ký Thành lập Doanh Nghiệp (Đối với Doanh Nghiệp mới thành lập)', 'https://www.youtube.com/watch?v=qGgZlZhia44', NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:54:16', '2020-05-05 02:54:16', NULL, NULL),
(61, NULL, 'Bài 4: Quản lý, Lưu trữ và sắp xếp Hồ sơ Doanh Nghiệp', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:54:34', '2020-05-05 02:54:34', NULL, NULL),
(62, NULL, 'Bài 5: Đăng ký Thuế điện tử và Đăng ký bố cáo tài khoản Doanh Nghiệp với cơ quan chức năng có thẩm quyền', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:54:50', '2020-05-05 02:54:50', NULL, NULL),
(63, NULL, 'Bài 6: Thủ tục đăng ký áp dụng Phương pháp tính thuế Giá trị gia tăng', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:55:08', '2020-05-05 02:55:44', NULL, NULL),
(64, NULL, 'Bài 7: Hướng dẫn thủ tục đặt in Hóa đơn Gía trị gia tăng và thủ tục mua Hóa đơn tại cơ quan thuế', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 02:55:26', '2020-05-05 02:55:26', NULL, NULL),
(65, NULL, 'Phần 1: Công việc đầu tiên ở doanh nghiệp mới thành lập. Kê khai, nộp thuế Môn bài', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 1, 2, 0, NULL, 0, NULL, '2020-05-05 08:56:40', '2020-05-05 08:56:40', NULL, 'FoGB0XEqFYuW5K83thfi.m3u8'),
(66, NULL, 'Phần 2: Lên báo cáo tài chính bằng phần mềm Misa đối với doanh nghiệp thương mại', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 2, 2, 0, NULL, 0, NULL, '2020-05-05 08:56:52', '2020-05-05 08:56:52', NULL, NULL),
(67, NULL, 'Bài 1: Hướng dẫn đăng ký tài khoản nộp thuế điện tử', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:57:45', '2020-05-05 08:57:45', NULL, 'FoGB0XEqFYuW5K83thfi.m3u8'),
(68, NULL, 'Bài 2: Hướng dẫn làm thông báo phát hành hóa đơn', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:58:32', '2020-05-05 08:58:32', NULL, NULL),
(69, NULL, 'Bài 3: Quy định về thuế môn bài', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:58:51', '2020-05-05 08:58:51', NULL, NULL),
(70, NULL, 'Bài 4: Lập tờ khai thuế môn bài', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:59:10', '2020-05-05 08:59:10', NULL, NULL),
(71, NULL, 'Bài 5: Hướng dẫn nộp tờ khai và tiền thuế môn bài', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:59:26', '2020-05-05 08:59:26', NULL, NULL),
(72, NULL, 'Bài 6: Cài đặt và upload bản quyền phần mềm kế toán misa', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:59:42', '2020-05-05 08:59:42', NULL, NULL),
(73, NULL, 'Bài 7: Nhập danh mục và số dư đầu kỳ', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 08:59:59', '2020-05-05 08:59:59', NULL, NULL),
(74, NULL, 'Bài 8: Nhập chứng từ hóa đơn mua vào', NULL, NULL, NULL, NULL, NULL, 'FILES/source/y2mate-com%20-%20ACTION%20ENGLISH%20-%20Video%20truy%E1%BB%81n%20%C4%91%E1%BB%99ng%20l%E1%BB%B1c%20h%E1%BB%8Dc%20ti%E1%BA%BFng%20Anh%20cho%20h%C3%A0ng%20tri%E1%BB%87u%20ng%C6%B0%E1%BB%9Di_wvJMte7qn4s_360p.mp4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, NULL, 3, 0, NULL, 0, NULL, '2020-05-05 09:00:13', '2020-05-05 09:00:13', NULL, NULL),
(75, NULL, 's dfg sdfg dfg', 'https://www.youtube.com/watch?v=gvtKHz7MWpo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL, NULL, 3, 0, NULL, 1, NULL, '2020-06-27 08:21:55', '2020-06-27 08:21:55', NULL, NULL),
(76, NULL, 'bài 1: abc', 'https://videos.hocketoanonline.com.vn/streamer/embed.php?v=NDEy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, NULL, NULL, 3, 0, NULL, 1, NULL, '2020-07-08 12:30:17', '2020-07-08 12:30:17', NULL, NULL),
(77, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(78, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(81, NULL, 'Học phần 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80, NULL, 1, 2, 0, NULL, 0, NULL, '2020-07-15 16:48:53', '2020-07-15 16:48:53', NULL, NULL),
(82, 'tieu-de-khoa-hoc-ten-khoa-hoc', 'Tiêu đề khoá học - tên khoá học', 'https://www.youtube.com/embed/J71G4HGJiqA', 'Tặng kèm tài liệu khoá học không ở đâu có', 'Cam kết hoàn tiền nếu không ưng ý với khoá học', '<ul>\r\n	<li>Biết l&agrave;m th&ocirc;ng b&aacute;o ph&aacute;t h&agrave;nh h&oacute;a đơn</li>\r\n	<li>Nộp tờ khai v&agrave; tiền thuế m&ocirc;n b&agrave;i</li>\r\n	<li>Quy định xử phạt nếu kh&ocirc;ng nộp</li>\r\n	<li>C&aacute;c c&ocirc;ng việc đầu ti&ecirc;n của 1 doanh nghiệp mới th&agrave;nh lập</li>\r\n	<li>lợi &iacute;ch kho&aacute; học</li>\r\n</ul>', 1, 'FILES/source/pham%20thanh%20long.jpg', 1000000, 900000, 'Hướng dẫn các công việc đầu tiên ở DN mới thành lập, hướng dẫn kê khai, nộp thuế môn bài, làm thông báo phát hành hóa đơn', '<p>B&aacute;o c&aacute;o t&agrave;i ch&iacute;nh&nbsp;được xem như l&agrave; hệ thống c&aacute;c bảng biểu, m&ocirc; tả th&ocirc;ng tin về t&igrave;nh h&igrave;nh t&agrave;i ch&iacute;nh, kinh doanh v&agrave; c&aacute;c luồng tiền của doanh nghiệp. B&aacute;o c&aacute;o t&agrave;i ch&iacute;nh những b&aacute;o c&aacute;o tổng hợp nhất về t&igrave;nh h&igrave;nh t&agrave;i sản, vốn chủ sở hữu v&agrave; nợ phải trả cũng như t&igrave;nh h&igrave;nh t&agrave;i ch&iacute;nh, kết quả kinh doanh trong kỳ của doanh nghiệp.</p>', 10, NULL, NULL, NULL, NULL, 1, NULL, 1, 100, 1, 0, NULL, '2020-07-16 01:24:03', '2020-07-17 05:24:58', NULL, NULL),
(83, NULL, 'Chương 1: Giới thiệu về khoá học', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 82, NULL, 1, 2, 100, NULL, 0, NULL, '2020-07-16 01:25:12', '2020-07-16 01:27:57', NULL, NULL),
(84, NULL, 'Bài 1: Giới thiệu về khoá học', 'https://videos.hocketoanonline.com.vn/streamer/embed.php?v=NDEy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, NULL, 3, 100, NULL, 1, NULL, '2020-07-16 01:26:59', '2020-07-16 01:27:57', NULL, NULL),
(85, 'khoa-hoc-1', 'Khoa học 1', NULL, NULL, NULL, NULL, 1, 'FILES/source/pham%20thanh%20long.jpg', 34, NULL, 'eqry6rubi6n', '<p>e56i767878</p>', 53, NULL, NULL, NULL, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-08-28 06:59:34', '2020-08-28 06:59:34', NULL, NULL),
(86, 'khoa-hoc-2', 'Khóa  học 2', NULL, NULL, NULL, NULL, 1, 'FILES/source/thuc-hanh-ke-toan-chi-phi-gia-thanh.jpg', 3, NULL, '3r3ct4', '<p>q4ctttrf</p>', 54, NULL, NULL, NULL, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-08-28 07:00:50', '2020-08-28 07:01:51', NULL, NULL),
(87, 'khoa-hoc-3', 'Khoa hoc 3', NULL, NULL, NULL, NULL, 1, 'FILES/source/pham%20thanh%20long.jpg', 35, NULL, '21cvc45', '<p>dfhrhtym</p>', 46, NULL, NULL, NULL, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-08-28 07:02:30', '2020-08-28 07:02:30', NULL, NULL),
(88, 'khoa-hoc-4', 'Khóa học 4', NULL, NULL, NULL, NULL, 1, 'FILES/source/pha-che-barista-tu-co-ban-den-nang-cao_m_1561532187.jpg', 789, NULL, 'ẻybjtk', '<p>rtjbytkuyk</p>', 44, NULL, NULL, NULL, NULL, 1, NULL, 1, 0, 1, 0, NULL, '2020-08-28 07:03:07', '2020-08-28 07:03:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_coupons`
--

CREATE TABLE `post_coupons` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_coupons`
--

INSERT INTO `post_coupons` (`post_id`, `coupon_id`) VALUES
(34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `parent_id`, `name`, `level`) VALUES
(1, NULL, 'Tp Hà Nội', 1),
(2, NULL, 'Hà Giang', 1),
(3, NULL, 'Cao Bằng', 1),
(4, NULL, 'Bắc Kạn', 1),
(5, NULL, 'Tuyên Quang', 1),
(6, NULL, 'Lào Cai', 1),
(7, NULL, 'Điện Biên', 1),
(8, NULL, 'Lai Châu', 1),
(9, NULL, 'Sơn La', 1),
(10, NULL, 'Yên Bái', 1),
(11, NULL, 'Hoà Bình', 1),
(12, NULL, 'Thái Nguyên', 1),
(13, NULL, 'Lạng Sơn', 1),
(14, NULL, 'Quảng Ninh', 1),
(15, NULL, 'Bắc Giang', 1),
(16, NULL, 'Phú Thọ', 1),
(17, NULL, 'Vĩnh Phúc', 1),
(18, NULL, 'Bắc Ninh', 1),
(19, NULL, 'Hải Dương', 1),
(20, NULL, 'Tp Hải Phòng', 1),
(21, NULL, 'Hưng Yên', 1),
(22, NULL, 'Thái Bình', 1),
(23, NULL, 'Hà Nam', 1),
(24, NULL, 'Nam Định', 1),
(25, NULL, 'Ninh Bình', 1),
(26, NULL, 'Thanh Hoá', 1),
(27, NULL, 'Nghệ An', 1),
(28, NULL, 'Hà Tĩnh', 1),
(29, NULL, 'Quảng Bình', 1),
(30, NULL, 'Quảng Trị', 1),
(31, NULL, 'Thừa Thiên Huế', 1),
(32, NULL, 'Tp Đà Nẵng', 1),
(33, NULL, 'Quảng Nam', 1),
(34, NULL, 'Quảng Ngãi', 1),
(35, NULL, 'Bình Định', 1),
(36, NULL, 'Phú Yên', 1),
(37, NULL, 'Khánh Hoà', 1),
(38, NULL, 'Ninh Thuận', 1),
(39, NULL, 'Bình Thuận', 1),
(40, NULL, 'Kon Tum', 1),
(41, NULL, 'Gia Lai', 1),
(42, NULL, 'Đắk Lăk', 1),
(43, NULL, 'Đắk Nông', 1),
(44, NULL, 'Lâm Đồng', 1),
(45, NULL, 'Bình Phước', 1),
(46, NULL, 'Tây Ninh', 1),
(47, NULL, 'Bình Dương', 1),
(48, NULL, 'Đồng Nai', 1),
(49, NULL, 'Bà Rịa - Vũng Tàu', 1),
(50, NULL, 'Tp Hồ Chí Minh', 1),
(51, NULL, 'Long An', 1),
(52, NULL, 'Tiền Giang', 1),
(53, NULL, 'Bến Tre', 1),
(54, NULL, 'Trà Vinh', 1),
(55, NULL, 'Vĩnh Long', 1),
(56, NULL, 'Đồng Tháp', 1),
(57, NULL, 'An Giang', 1),
(58, NULL, 'Kiên Giang', 1),
(59, NULL, 'Tp Cần Thơ', 1),
(60, NULL, 'Hậu Giang', 1),
(61, NULL, 'Sóc Trăng', 1),
(62, NULL, 'Bạc Liêu', 1),
(63, NULL, 'Cà Mau', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des_s` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_f` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url_view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `des_s`, `des_f`, `image`, `pos`, `page_id`, `type`, `note`, `html`, `created_by`, `status`, `created_at`, `updated_at`, `url_view`) VALUES
(1, 'DỊCH VỤ KẾ TOÁN THUẾ', NULL, NULL, NULL, 1, 1, 3, NULL, '<div class=\"container bg-gray\" id=\"comboIndex\">\r\n\r\n                        <div class=\"row\">\r\n\r\n                            <div class=\"col-lg-12\">\r\n\r\n                                <div class=\"hr-target\">\r\n\r\n                                    <h4>DỊCH VỤ KẾ TOÁN THUẾ</h4>\r\n\r\n                                    <div class=\"home-dvkt\"><div class=\"target-box1\"><div class=\"target-box-inner\">\r\n\r\n                            <div class=\"box-t-mi\">\r\n\r\n                                <a href=\"http://unica.simbaviet.com/bai-viet/dich-vu-quyet-toan-thue\">\r\n\r\n                                    <div class=\"overlay-box\"></div>\r\n\r\n                                    <img class=\"lazy\" alt=\"Dịch vụ báo cáo tài chính thuế\" src=\"http://localhost:8080/unica/FILES/source/bao-cao-tai-chinh.jpg\" style=\"\">\r\n\r\n                                    <span><i class=\"fa fa-child\" aria-hidden=\"true\"></i>\r\n\r\n                                        <div class=\"ava\">Dịch vụ báo cáo tài chính thuế<p>Dịch vụ báo cáo tài chính thuế chuyên nghiệp</p></div>\r\n\r\n                                    </span>\r\n\r\n                                </a>\r\n\r\n                            </div>\r\n\r\n                        </div><div class=\"target-box-inner\">\r\n\r\n                            <div class=\"box-t-mi\">\r\n\r\n                                <a href=\"http://unica.simbaviet.com/bai-viet/dich-vu-ke-khai-thue\">\r\n\r\n                                    <div class=\"overlay-box\"></div>\r\n\r\n                                    <img class=\"lazy\" alt=\"Dịch vụ Quyết Toán Thuế\" src=\"http://localhost:8080/unica/FILES/source/dich-vu-quyet-toan-thue-2.jpg\" style=\"\">\r\n\r\n                                    <span><i class=\"fa fa-child\" aria-hidden=\"true\"></i>\r\n\r\n                                        <div class=\"ava\">Dịch vụ Quyết Toán Thuế<p>Dịch vụ Quyết Toán Thuế</p></div>\r\n\r\n                                    </span>\r\n\r\n                                </a>\r\n\r\n                            </div>\r\n\r\n                        </div><div class=\"target-box-inner\">\r\n\r\n                            <div class=\"box-t-mi\">\r\n\r\n                                <a href=\"http://hocketoanonline.com.vn/dich-vu-dao-tao-ke-toan-cho-doanh-nghiep\">\r\n\r\n                                    <div class=\"overlay-box\"></div>\r\n\r\n                                    <img class=\"lazy\" alt=\"Dịch vụ đào tạo kế toán cho doanh nghiệp\" src=\"http://localhost:8080/unica/FILES/source/pha-che-barista-tu-co-ban-den-nang-cao_m_1561532187.jpg\" style=\"\">\r\n\r\n                                    <span><i class=\"fa fa-child\" aria-hidden=\"true\"></i>\r\n\r\n                                        <div class=\"ava\">Dịch vụ đào tạo kế toán cho doanh nghiệp<p></p></div>\r\n\r\n                                    </span>\r\n\r\n                                </a>\r\n\r\n                            </div>\r\n\r\n                        </div><div class=\"target-box-inner\">\r\n\r\n                            <div class=\"box-t-mi\">\r\n\r\n                                <a href=\"http://simbaviet.com/unica/bai-viet/dich-vu-bao-cao-tai-chinh-thue\">\r\n\r\n                                    <div class=\"overlay-box\"></div>\r\n\r\n                                    <img class=\"lazy\" alt=\"Dịch vụ kê khai thuế\" src=\"http://localhost:8080/unica/FILES/source/062835_cbo-3-khoa-chung-khoan_thumb.jpg\" style=\"\">\r\n\r\n                                    <span><i class=\"fa fa-child\" aria-hidden=\"true\"></i>\r\n\r\n                                        <div class=\"ava\">Dịch vụ kê khai thuế<p>Dịch vụ kê khai thuế chuyên nghiệp</p></div>\r\n\r\n                                    </span>\r\n\r\n                                </a>\r\n\r\n                            </div>\r\n\r\n                        </div></div></div></div></div></div></div>', 1, 1, '2020-03-08 02:51:21', '2020-08-29 01:03:49', 'http://simbaviet.com/unica/bai-viet/dich-vu-bao-cao-tai-chinh-thue'),
(3, 'ĐĂNG KÝ HỌC KẾ TOÁN OLINE & DỊCH VỤ', NULL, NULL, NULL, 2, 1, 4, NULL, '<div class=\"service\">\r\n                        <div class=\"container\">\r\n\r\n                            <div class=\"row\">\r\n\r\n                                <div class=\"col-lg-12 pdm-No\">\r\n\r\n                                    <div class=\"hr-reason\">\r\n\r\n                                        <h4>ĐĂNG KÝ HỌC KẾ TOÁN OLINE & DỊCH VỤ</h4>\r\n                                            <div class=\"swiper-container slider-service\">\r\n                                                <div class=\"swiper-wrapper\"><div class=\"swiper-slide\">\r\n\r\n                                <div class=\"reason-4\">\r\n\r\n                                    <div class=\"img-reason\"><img class=\"img-responsive lazy\" alt=\"\" src=\"http://localhost:8080/unica/FILES/source/nhaplieusmall.png\" style=\"\"></div>\r\n\r\n                                    <div class=\"txt-reason\">Đăng ký\r\n\r\n                                        <span>Học kế toán online</span>\r\n\r\n                                    </div>\r\n                                    <a href=\"http://hocketoanonline.com.vn/\" class=\"custom-button\" >Ðăng ký</a>\r\n\r\n                                </div>\r\n\r\n                            </div><div class=\"swiper-slide\">\r\n\r\n                                <div class=\"reason-4\">\r\n\r\n                                    <div class=\"img-reason\"><img class=\"img-responsive lazy\" alt=\"\" src=\"http://localhost:8080/unica/FILES/source/xulydulieusmall.png\" style=\"\"></div>\r\n\r\n                                    <div class=\"txt-reason\">Đăng ký\r\n\r\n                                        <span>Học kế toán thực tế</span>\r\n\r\n                                    </div>\r\n                                    <a href=\"http://cokhithepminhphu.com/\" class=\"custom-button\" >Ðăng ký</a>\r\n\r\n                                </div>\r\n\r\n                            </div><div class=\"swiper-slide\">\r\n\r\n                                <div class=\"reason-4\">\r\n\r\n                                    <div class=\"img-reason\"><img class=\"img-responsive lazy\" alt=\"\" src=\"http://localhost:8080/unica/FILES/source/quettailieusmall.png\" style=\"\"></div>\r\n\r\n                                    <div class=\"txt-reason\">Đăng ký\r\n\r\n                                        <span>Hóa đơn điện tử</span>\r\n\r\n                                    </div>\r\n                                    <a href=\"#\" class=\"custom-button\" >Ðăng ký</a>\r\n\r\n                                </div>\r\n\r\n                            </div><div class=\"swiper-slide\">\r\n\r\n                                <div class=\"reason-4\">\r\n\r\n                                    <div class=\"img-reason\"><img class=\"img-responsive lazy\" alt=\"\" src=\"http://localhost:8080/unica/FILES/source/xulydulieusmall.png\" style=\"\"></div>\r\n\r\n                                    <div class=\"txt-reason\">Dịch vụ đào tạo kế toán 1\r\n\r\n                                        <span>Mô tả ngắn dịch vụ 1</span>\r\n\r\n                                    </div>\r\n                                    <a href=\"#\" class=\"custom-button\" >Ðăng ký</a>\r\n\r\n                                </div>\r\n\r\n                            </div><div class=\"swiper-slide\">\r\n\r\n                                <div class=\"reason-4\">\r\n\r\n                                    <div class=\"img-reason\"><img class=\"img-responsive lazy\" alt=\"\" src=\"http://localhost:8080/unica/FILES/source/phanmemsmall.png\" style=\"\"></div>\r\n\r\n                                    <div class=\"txt-reason\">Dịch vụ\r\n\r\n                                        <span>BCTC trọn gói</span>\r\n\r\n                                    </div>\r\n                                    <a href=\"#\" class=\"custom-button\" >Ðăng ký</a>\r\n\r\n                                </div>\r\n\r\n                            </div></div>\r\n                        <div class=\"next-btn-rel\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></div>\r\n                            <div class=\"prev-btn-rel\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i></div>\r\n                            </div>\r\n                        </div></div></div></div></div>', 1, 1, '2020-03-08 03:09:08', '2020-08-28 00:49:55', '#'),
(4, 'GIẢNG VIÊN TIÊU BIỂU', NULL, NULL, NULL, 3, 1, 5, NULL, '<div class=\"container-fluid bg-br\">\n\n                        <div class=\"container\">\n\n                            <div class=\"row\">\n\n                                <div class=\"col-lg-12\">\n\n                                    <div class=\"hr-top-teacher\">\n\n                                        <h4>GIẢNG VIÊN TIÊU BIỂU</h4>\n\n                                        <div class=\"box-teacher clearfix clear\">\n\n                                            <ul class=\"slider-teacher\"><div class=\"inner-box-teacher col-md-3\">\n\n                            <div class=\"img-teacher\">\n\n                                <img class=\"lazy\" width=\"153px\" height=\"153px\" alt=\"Giảng viên 1\" src=\"http://hocketoanonline.com.vn/FILES/source/img-home-banner-1.png\" style=\"\">\n\n                            </div>\n\n                            <a href=\"#\" class=\"name-teacher\">Giảng viên 1</a>\n\n                            <div class=\"des-teacher\">Giới thiệu ngắn giảng viên</div>\n\n                        </div><div class=\"inner-box-teacher col-md-3\">\n\n                            <div class=\"img-teacher\">\n\n                                <img class=\"lazy\" width=\"153px\" height=\"153px\" alt=\"Nguyễn Hiếu\" src=\"http://hocketoanonline.com.vn/FILES/source/August52016431pm_nguyen-hieu_thumb.jpg\" style=\"\">\n\n                            </div>\n\n                            <a href=\"#\" class=\"name-teacher\">Nguyễn Hiếu</a>\n\n                            <div class=\"des-teacher\">Đại sứ Yoga Việt Nam</div>\n\n                        </div><div class=\"inner-box-teacher col-md-3\">\n\n                            <div class=\"img-teacher\">\n\n                                <img class=\"lazy\" width=\"153px\" height=\"153px\" alt=\"HỒ NGỌC CƯƠNG\" src=\"http://hocketoanonline.com.vn/FILES/source/ho-ngoc-cuong.jpg\" style=\"\">\n\n                            </div>\n\n                            <a href=\"#\" class=\"name-teacher\">HỒ NGỌC CƯƠNG</a>\n\n                            <div class=\"des-teacher\">Freelancer Facebook Marketing</div>\n\n                        </div><div class=\"inner-box-teacher col-md-3\">\n\n                            <div class=\"img-teacher\">\n\n                                <img class=\"lazy\" width=\"153px\" height=\"153px\" alt=\"Phạm Thành Long\" src=\"http://hocketoanonline.com.vn/FILES/source/pham%20thanh%20long.jpg\" style=\"\">\n\n                            </div>\n\n                            <a href=\"#\" class=\"name-teacher\">Phạm Thành Long</a>\n\n                            <div class=\"des-teacher\">Luật sư - Diễn giả</div>\n\n                        </div><div class=\"inner-box-teacher col-md-3\">\n\n                            <div class=\"img-teacher\">\n\n                                <img class=\"lazy\" width=\"153px\" height=\"153px\" alt=\"Lê Thẩm Dương\" src=\"http://hocketoanonline.com.vn/FILES/source/_ts-le-tham-duong.jpg\" style=\"\">\n\n                            </div>\n\n                            <a href=\"\" class=\"name-teacher\">Lê Thẩm Dương</a>\n\n                            <div class=\"des-teacher\">Tiến sĩ - Diễn giả chuyên nghiệp - Chuyên gia Tài chính, Lãnh đạo, Nhân sự.....</div>\n\n                        </div></ul></div></div></div></div></div></div>', 1, 1, '2020-03-08 03:15:20', '2020-08-04 12:47:32', NULL),
(5, 'Học viện Online hr', '<p>Chia sẻ kiến thức v&agrave; kinh nghiệm thực tế tới h&agrave;ng triệu người</p>', '<p>HỌC MỌI L&Uacute;C, MỌI NƠI</p>', NULL, 1, 2, 6, NULL, ' <div class=\"hr-about-block-1\">\n                <div class=\"container-fluid\">\n                    <div class=\"row\">\n                        <div class=\"col-lg-12\">\n                            <h3>Học viện Online hr</h3>\n                            <p><p>Chia sẻ kiến thức v&agrave; kinh nghiệm thực tế tới h&agrave;ng triệu người</p></p>\n                            <span><p>HỌC MỌI L&Uacute;C, MỌI NƠI</p></span>\n                        </div>\n                    </div>\n                </div>\n            </div>', 1, 1, '2020-03-10 23:56:37', '2020-03-10 23:56:37', NULL),
(6, 'GIỚI THIỆU - HỌC VIỆN ONLINE HR', '<p>HR l&agrave; một hệ thống đ&agrave;o tạo trực tuyến, cổng kết nối Chuy&ecirc;n gia với Học vi&ecirc;n<br />\r\n<br />\r\nSứ mệnh của hr l&agrave; chia sẻ kiến thức thực tiễn tới 10 triệu người d&acirc;n Việt Nam</p>', NULL, NULL, 2, 2, 7, NULL, '<div class=\"hr-about-block-2\">\n                <div class=\"container\">\n                    <div class=\"row\">\n                        <div class=\"col-lg-12\">\n                            <p>GIỚI THIỆU - HỌC VIỆN ONLINE HR</p>\n                            <span><p>HR l&agrave; một hệ thống đ&agrave;o tạo trực tuyến, cổng kết nối Chuy&ecirc;n gia với Học vi&ecirc;n<br />\r\n<br />\r\nSứ mệnh của hr l&agrave; chia sẻ kiến thức thực tiễn tới 10 triệu người d&acirc;n Việt Nam</p></span>\n                            <div class=\"video-youtube\">\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>', 1, 1, '2020-03-11 00:00:40', '2020-03-11 00:00:40', NULL),
(7, 'Thống kê trang giới thiệu', NULL, NULL, NULL, 3, 2, 8, NULL, '<div class=\"hr-about-block-3\">\n                        <div class=\"container\">\n                            <div class=\"row\">\n                                <div class=\"col-lg-12\">\n                                    <ul><li><p>200.000+</p><span>Học viên</span></li><li><p>450+</p><span>Giảng viên</span></li><li><p>800+</p><span>Khóa học</span></li><li><p>15.000+</p><span>Affliate</span></li></ul></div></div></div></div>', 1, 1, '2020-03-11 00:08:33', '2020-03-11 00:09:55', NULL),
(8, 'TRẢI NGHIỆM PHƯƠNG PHÁP HỌC TẬP HIỆN ĐẠI', NULL, NULL, NULL, 4, 2, 9, NULL, '<div class=\"hr-about-block-4\">\r\n                        <div class=\"container\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-lg-12\">\r\n                                    <p>Trải nghiệm phương pháp học tập hiện đại</p>\r\n                                    <ul class=\"slider\"> <li class=\"\" style=\"\" tabindex=\"-1\" role=\"option\" aria-describedby=\"slick-slide00\">\r\n                                    <div class=\"img-about\"><img src=\"http://hocketoanonline.com.vn/FILES/source/h1.png\" alt=\"\"></div>\r\n                                    <span>QUÉT TÀI LIỆU</span>\r\n                                </li></ul></div></div></div></div>', 1, 1, '2020-03-11 00:13:21', '2020-08-01 10:00:41', NULL),
(9, 'HỌC VIÊN NÓI GÌ VỀ HR', NULL, NULL, NULL, 5, 2, 10, NULL, '<div class=\"hr-about-block-5\">\n                        <div class=\"container\">\n                            <div class=\"row\">\n                                <div class=\"col-lg-12\">\n                                    <h3>HỌC VIÊN NÓI GÌ VỀ HR</h3>\n                                    <ul><li><div class=\"img-hv-ab\"><img class=\"img-responsive\" src=\"http://simbaviet.com/unica/FILES/source/ab-av-1.jpg\" alt=\"\"></div>\n                                    <p>Nguyễn Ngân Hà</p>\n                                    <span>Mình đang theo học khóa Tiếng Anh tại hr, chương trình dạy rất thực tế và dễ hiểu cho người mất gốc. Chỉ sau 3 tháng mình đã có thể tự tin giao tiếp Tiếng Anh cơ bản và sử dụng được ngay trong chuyến du lịch Thái vừa rồi. Rất cám ơn hr và cô giáo đã nhiệt tình support, mình sẽ tham khảo thêm các khóa nâng cao hơn để thi lấy chứng chỉ Tiếng Anh nữa. \n                                    </span>\n                                </li></ul></div></div></div></div>', 1, 1, '2020-03-11 00:16:43', '2020-03-11 00:17:45', NULL),
(10, 'LỢI THẾ CỦA MÔ HÌNH ĐÀO TẠO ELEARNING', '<p>E-learning kh&ocirc;ng chỉ l&agrave; một lĩnh vực đầu tư tiềm năng m&agrave; c&ograve;n l&agrave; một sản phẩm nh&acirc;n văn, mang lại cơ hội tiếp cận tri thức tinh hoa cho tất cả mọi người.<br />\r\nNếu bạn c&oacute; đam m&ecirc; với gi&aacute;o dục, h&atilde;y c&ugrave;ng hr tạo n&ecirc;n những đột ph&aacute; mới để thay đổi thực tại v&agrave; kiến tạo tương lai!</p>', NULL, NULL, 6, 2, 11, NULL, '<div class=\"hr-about-block-6\">\n                        <div class=\"container\">\n                            <div class=\"row\">\n                                <div class=\"col-lg-12\">\n                                    <h3>LỢI THẾ CỦA MÔ HÌNH ĐÀO TẠO ELEARNING</h3>\n                                    <span><p>E-learning kh&ocirc;ng chỉ l&agrave; một lĩnh vực đầu tư tiềm năng m&agrave; c&ograve;n l&agrave; một sản phẩm nh&acirc;n văn, mang lại cơ hội tiếp cận tri thức tinh hoa cho tất cả mọi người.<br />\r\nNếu bạn c&oacute; đam m&ecirc; với gi&aacute;o dục, h&atilde;y c&ugrave;ng hr tạo n&ecirc;n những đột ph&aacute; mới để thay đổi thực tại v&agrave; kiến tạo tương lai!</p>\n                                    </span>\n                                    <ul><li><div class=\"box-about-bot\">\n                            <span>Cơ hội nghề nghiệp</span>\n                            <div class=\"img-about-bot\"><img src=\"http://simbaviet.com/unica/FILES/source/ab1.png\" alt=\"\"></div>\n                                        <p>hr lu&ocirc;n ch&agrave;o đ&oacute;n những nh&acirc;n tố t&agrave;i năng v&agrave; t&acirc;m huyết với sứ mệnh &quot;n&acirc;ng cao gi&aacute; trị tri thức, phục vụ h&agrave;ng triệu người Việt Nam</p>\n                                        <a href=\"\">Tham gia ngay</a>\n                                    </div>\n                                </li></ul></div></div></div></div>', 1, 1, '2020-03-11 00:21:34', '2020-03-11 00:22:21', NULL),
(11, 'Học bất cứ lúc nào, bất cứ nơi đâu', '<p>Giờ đ&acirc;y học vi&ecirc;n c&oacute; thể học trực tuyến c&aacute;c b&agrave;i học của hệ thống hr m&agrave; kh&ocirc;ng cần tới m&aacute;y t&iacute;nh, v&igrave; chỉ với một chiếc smartphone học vi&ecirc;n vẫn c&oacute; thể học được c&aacute;c kho&aacute; học một c&aacute;ch thuận tiện nhất với mọi chức năng tương tự tr&ecirc;n web.</p>', NULL, 'FILES/source/about-app.png', 8, 2, 12, NULL, '<div class=\"hr-about-block-7\">\n                        <div class=\"container\">\n                            <div class=\"row\">\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                                    <div class=\"block-about-left\">\n                                        <img class=\"img-responsive\" src=\"http://simbaviet.com/unica/FILES/source/about-app.png\" alt=\"\">\n                                    </div>\n                                </div>\n                                <div class=\"col-lg-6 col-md-6 col-sm-6\">\n                                    <div class=\"block-about-right\">\n                                        <h3>Học bất cứ lúc nào, bất cứ nơi đâu</h3>\n                                        <p><p>Giờ đ&acirc;y học vi&ecirc;n c&oacute; thể học trực tuyến c&aacute;c b&agrave;i học của hệ thống hr m&agrave; kh&ocirc;ng cần tới m&aacute;y t&iacute;nh, v&igrave; chỉ với một chiếc smartphone học vi&ecirc;n vẫn c&oacute; thể học được c&aacute;c kho&aacute; học một c&aacute;ch thuận tiện nhất với mọi chức năng tương tự tr&ecirc;n web.</p>\n                                        </p>\n                                        <ul><li><i class=\"fa fa-check\" aria-hidden=\"true\"></i> Xem và học thử các khóa học</li></ul></div></div></div></div></div>', 1, 1, '2020-03-11 00:26:34', '2020-03-11 00:26:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `obj_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `seo_des`, `seo_title`, `seo_key`, `type`, `obj_id`, `created_at`, `updated_at`) VALUES
(1, 'trang chủ 1', 'trang chủ 1', 'trang chủ 1', 1, 1, '2020-03-04 19:47:48', '2020-05-05 09:49:36'),
(2, NULL, NULL, NULL, 1, 2, '2020-03-04 19:48:09', '2020-03-04 19:48:09'),
(4, NULL, 'Trang tài liệu học tập', NULL, 1, 4, '2020-03-04 19:48:48', '2020-05-05 09:49:23'),
(5, NULL, NULL, NULL, 1, 5, '2020-03-04 19:51:06', '2020-03-04 19:51:06'),
(6, NULL, NULL, NULL, 2, 1, '2020-03-04 20:22:38', '2020-03-04 20:22:38'),
(7, NULL, NULL, NULL, 2, 2, '2020-03-04 20:27:28', '2020-03-04 20:27:28'),
(9, NULL, NULL, NULL, 2, 3, '2020-03-04 22:42:16', '2020-03-04 22:42:16'),
(11, NULL, NULL, NULL, 2, 5, '2020-03-04 22:49:00', '2020-03-04 22:49:00'),
(12, NULL, NULL, NULL, 3, 4, '2020-03-04 22:51:03', '2020-03-04 22:51:03'),
(13, NULL, NULL, NULL, 2, 6, '2020-03-19 07:04:25', '2020-03-19 07:04:25'),
(14, NULL, NULL, NULL, 2, 7, '2020-03-19 07:11:06', '2020-03-19 07:11:06'),
(16, NULL, NULL, NULL, 3, 13, '2020-03-19 08:08:16', '2020-03-19 08:08:16'),
(17, NULL, NULL, NULL, 3, 14, '2020-03-19 08:11:24', '2020-03-19 08:11:24'),
(21, NULL, NULL, NULL, 2, 9, '2020-04-27 09:23:44', '2020-04-27 09:23:44'),
(22, NULL, NULL, NULL, 2, 10, '2020-04-27 09:24:27', '2020-04-27 09:24:27'),
(26, NULL, NULL, NULL, 3, 34, '2020-04-27 09:29:46', '2020-04-27 09:29:46'),
(34, NULL, NULL, NULL, 2, 21, '2020-04-28 08:05:32', '2020-04-28 08:05:32'),
(44, NULL, NULL, NULL, 3, 44, '2020-05-05 02:25:25', '2020-05-05 02:25:25'),
(47, NULL, NULL, NULL, 1, 8, '2020-06-06 08:51:49', '2020-06-06 08:51:49'),
(59, NULL, NULL, NULL, 3, 82, '2020-07-16 01:24:03', '2020-07-16 01:24:03'),
(60, NULL, NULL, NULL, 2, 41, '2020-07-17 05:27:30', '2020-07-17 05:27:30'),
(61, NULL, NULL, NULL, 2, 42, '2020-07-17 05:28:30', '2020-07-17 05:28:30'),
(62, NULL, NULL, NULL, 2, 43, '2020-07-17 05:29:18', '2020-07-17 05:29:18'),
(63, NULL, NULL, NULL, 2, 44, '2020-07-17 05:29:39', '2020-07-17 05:29:39'),
(64, NULL, NULL, NULL, 2, 45, '2020-07-17 05:37:21', '2020-07-17 05:37:21'),
(65, NULL, NULL, NULL, 2, 46, '2020-07-17 05:38:11', '2020-07-17 05:38:11'),
(66, NULL, NULL, NULL, 2, 47, '2020-07-17 05:42:40', '2020-07-17 05:42:40'),
(67, NULL, NULL, NULL, 2, 48, '2020-07-17 05:43:25', '2020-07-17 05:43:25'),
(68, NULL, NULL, NULL, 2, 49, '2020-07-17 05:43:45', '2020-07-17 05:43:45'),
(69, NULL, NULL, NULL, 2, 50, '2020-07-17 05:44:25', '2020-07-17 05:44:25'),
(70, NULL, NULL, NULL, 2, 51, '2020-07-17 05:46:01', '2020-07-17 05:46:01'),
(71, NULL, NULL, NULL, 2, 52, '2020-07-17 05:46:47', '2020-07-17 05:46:47'),
(72, NULL, NULL, NULL, 2, 53, '2020-07-17 05:47:17', '2020-07-17 05:47:17'),
(73, NULL, NULL, NULL, 2, 54, '2020-07-17 05:47:29', '2020-07-17 05:47:29'),
(75, NULL, NULL, NULL, 1, 10, '2020-07-18 01:37:40', '2020-07-18 01:37:40'),
(76, NULL, NULL, NULL, 1, 11, '2020-07-18 01:40:20', '2020-07-18 01:40:20'),
(77, NULL, NULL, NULL, 3, 85, '2020-08-28 06:59:34', '2020-08-28 06:59:34'),
(78, NULL, NULL, NULL, 3, 86, '2020-08-28 07:00:50', '2020-08-28 07:00:50'),
(79, NULL, NULL, NULL, 3, 87, '2020-08-28 07:02:30', '2020-08-28 07:02:30'),
(80, NULL, NULL, NULL, 3, 88, '2020-08-28 07:03:07', '2020-08-28 07:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nick_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_accounts`
--

INSERT INTO `social_accounts` (`avatar`, `created_at`, `updated_at`, `nick_name`, `provider`, `provider_user_id`, `user_id`) VALUES
('https://graph.facebook.com/v3.3/2711209738894962/picture?type=normal', '2020-04-27 14:47:44', '2020-04-27 14:47:44', NULL, 'facebook', '2711209738894962', 20),
('https://graph.facebook.com/v3.3/731178523960710/picture?type=normal', '2020-05-11 03:01:56', '2020-05-11 03:01:56', NULL, 'facebook', '731178523960710', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tailieus`
--

CREATE TABLE `tailieus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link_download` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tailieus`
--

INSERT INTO `tailieus` (`id`, `name`, `image`, `link`, `content`, `pos`, `status`, `created_at`, `updated_at`, `link_download`) VALUES
(1, 'Hoa quả tươi', 'FILES/source/html_logo.png', 'FILES/source/restaurent-icon.png', '1111', 1, 1, '2020-03-05 03:34:08', '2020-03-11 00:59:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tailieu_khoahoc`
--

CREATE TABLE `tailieu_khoahoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `no` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tailieu_khoahoc`
--

INSERT INTO `tailieu_khoahoc` (`id`, `name`, `link`, `content`, `post_id`, `status`, `no`) VALUES
(1, 'Bộ cài Phần mềm kế toán MISA', 'FILES/source/phap-luat-thue.jpg', 'Bộ chứng từ thực tế Kế toán xây dựng trên phần mềm MISA 2017', 14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tailieu_khoahocs`
--

CREATE TABLE `tailieu_khoahocs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `no` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thongbaos`
--

CREATE TABLE `thongbaos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongbaos`
--

INSERT INTO `thongbaos` (`id`, `user_id`, `name`, `content`, `pos`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Thông báo khuyến mãi', 'Test', 2, 1, '2020-03-05 03:17:07', '2020-03-05 03:17:48'),
(2, 2, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 200,000 vào tài khoản. Số dư hiện tại của bạn là 400,000 . Xin cảm ơn!', NULL, 1, '2020-03-11 03:40:59', '2020-03-11 03:40:59'),
(3, 2, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 500,000 vào tài khoản. Số dư hiện tại của bạn là 900,000 . Xin cảm ơn!', 1, 1, '2020-03-12 19:48:13', '2020-03-12 20:29:41'),
(4, 3, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 100,000 vào tài khoản. Số dư hiện tại của bạn là 100,000 . Xin cảm ơn!', NULL, 1, '2020-03-13 21:23:10', '2020-03-14 23:46:40'),
(5, 2, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPha chế cafe barista từ cơ bản đến nâng cao thành công !', NULL, 1, '2020-03-16 20:32:45', '2020-03-16 21:19:36'),
(6, 2, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPha chế cafe barista từ cơ bản đến nâng cao thành công !', NULL, 1, '2020-03-16 20:47:03', '2020-03-16 21:15:48'),
(7, 3, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 100,000,000 vào tài khoản. Số dư hiện tại của bạn là 100,100,000 . Xin cảm ơn!', NULL, 0, '2020-03-16 21:59:44', '2020-03-16 21:59:44'),
(8, 4, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 1,000,000 vào tài khoản. Số dư hiện tại của bạn là 1,000,000 . Xin cảm ơn!', NULL, 0, '2020-03-16 22:18:24', '2020-03-16 22:18:24'),
(9, 4, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPha chế cafe barista từ cơ bản đến nâng cao thành công !', NULL, 0, '2020-03-16 22:18:33', '2020-03-16 22:18:33'),
(10, 3, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPha chế cafe barista từ cơ bản đến nâng cao thành công !', NULL, 1, '2020-03-16 22:20:23', '2020-03-19 03:02:50'),
(11, 8, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 660,000 vào tài khoản. Số dư hiện tại của bạn là 660,000 . Xin cảm ơn!', NULL, 0, '2020-03-19 09:48:19', '2020-03-19 09:48:19'),
(12, 8, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcNguyên lý kế toán cho người mới bắt đầu thành công !', NULL, 0, '2020-03-19 09:51:33', '2020-03-19 09:51:33'),
(13, 3, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcThực hành kế toán chi phí giá thành trong doanh nghiệp thành công !', NULL, 1, '2020-03-29 06:56:18', '2020-03-29 06:58:03'),
(14, 3, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcKế toán cho người mới bắt đầu thành công !', NULL, 1, '2020-03-29 06:56:18', '2020-03-29 06:58:25'),
(15, 3, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPháp luật thuế thành công !', NULL, 1, '2020-03-29 06:56:18', '2020-03-29 06:58:29'),
(16, 3, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 788,500,000 vào tài khoản. Số dư hiện tại của bạn là 887,922,000 . Xin cảm ơn!', NULL, 1, '2020-04-01 06:24:16', '2020-05-09 11:53:22'),
(17, 7, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 10,000,000 vào tài khoản. Số dư hiện tại của bạn là 10,000,000 . Xin cảm ơn!', NULL, 0, '2020-04-01 06:55:59', '2020-04-01 06:55:59'),
(18, 7, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcKế toán cho người mới bắt đầu thành công !', NULL, 1, '2020-04-01 06:56:13', '2020-04-01 07:12:37'),
(19, NULL, '1', 'a', 1, 0, '2020-04-10 19:36:23', '2020-04-10 19:36:23'),
(20, 3, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcLên Báo cáo tài chính tại doanh nghiệp thương mại thành công !', NULL, 1, '2020-04-10 19:58:56', '2020-04-29 10:44:15'),
(21, 16, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 1,000,000 vào tài khoản. Số dư hiện tại của bạn là 1,000,000 . Xin cảm ơn!', NULL, 1, '2020-04-23 03:51:35', '2020-04-23 04:27:13'),
(22, 16, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcKế toán cho người mới bắt đầu thành công !', NULL, 1, '2020-04-23 03:52:51', '2020-04-25 02:58:52'),
(23, 16, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcNguyên lý kế toán cho người mới bắt đầu1 thành công !', NULL, 0, '2020-04-23 03:52:51', '2020-04-23 03:52:51'),
(24, 16, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcThực hành kế toán chi phí giá thành trong doanh nghiệp thành công !', NULL, 0, '2020-04-23 03:52:51', '2020-04-23 03:52:51'),
(25, 16, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcLên Báo cáo tài chính tại doanh nghiệp thương mại thành công !', NULL, 1, '2020-04-23 03:57:54', '2020-04-23 04:26:20'),
(26, 16, 'Thông báo đăng ký mua khóa học thành công !', 'Chúc mừng bạn đã đăng ký mua khóa họcPháp luật thuế thành công !', NULL, 1, '2020-04-23 03:59:28', '2020-04-23 04:26:16'),
(27, NULL, 'test thông báo', 'test', 2, 0, '2020-04-23 04:26:37', '2020-04-23 04:26:37'),
(28, 3, 'Chúc mừng nạp tiền thành công!', 'Bạn đã được cộng 360,000 vào tài khoản. Số dư hiện tại của bạn là 888,132,000 . Xin cảm ơn!', NULL, 1, '2020-04-29 10:44:46', '2020-05-08 16:13:46'),
(29, 18, 'test', 'test', NULL, 1, '2020-05-05 13:51:33', '2020-05-05 13:51:51'),
(30, 3, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(31, 6, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(32, 7, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(33, 9, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(34, 10, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(35, 12, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(36, 13, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(37, 14, 'test thong bao', 'aaaaaaaa', NULL, 1, '2020-05-14 12:59:57', '2020-05-14 13:00:06'),
(38, 15, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(39, 17, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(40, 18, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(41, 19, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(42, 20, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(43, 21, 'test thong bao', 'aaaaaaaa', NULL, 0, '2020-05-14 12:59:57', NULL),
(44, 3, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(45, 6, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(46, 7, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(47, 9, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(48, 10, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(49, 12, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(50, 13, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(51, 14, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(52, 15, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(53, 17, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(54, 19, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(55, 20, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(56, 22, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(57, 23, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(58, 24, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(59, 25, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(60, 26, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(61, 27, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 0, '2020-07-08 12:44:23', NULL),
(62, 28, 'Dạy thực hành BCTC Công ty xây dựng Hùng vương trên MISA', 'khuyến tháng 7 cho toàn bộ người dùng', NULL, 1, '2020-07-08 12:44:23', '2020-07-08 12:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `point` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `phone`, `dob`, `email_verified_at`, `password`, `address`, `gender`, `city`, `point`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Trần Minh', 'public/uploads/users/1589448418dsc08599_slnj.jpg', 'vuongplus.jsc@gmail.com', '0941555844', '11-04-1990', NULL, '$2y$10$rWDPLNrsOkwboH5mvYNFweHzD59oBtK7xi3YMRHO/HvMlYMATgc1m', 'Quảng Chính, Quảng Xương, Thanh Hoá', 1, '18', 888132000, 1, NULL, '2020-03-13 21:11:45', '2020-05-14 09:26:58'),
(6, 'dt', NULL, 'vanchungk17cntt@gmail.com', '0942433932', NULL, NULL, '$2y$10$mucdOw5yddszg7Fsjw5.WeHSJXz59/SniaVqcrl7ogHWnfDKSMovu', NULL, NULL, NULL, 0, 1, NULL, '2020-03-17 02:58:46', '2020-03-17 02:58:46'),
(7, 'Nguyen Quy Doanh', NULL, 'quydoanh5493@gmail.com', '0967864448', NULL, NULL, '$2y$10$PHBIOLNMazYTlV.BmyQxm.D2NHV0kfjKQSd.7itbY11M0pkK3Q27i', NULL, NULL, NULL, 9875000, 1, NULL, '2020-03-18 03:53:43', '2020-04-01 06:56:13'),
(9, 'Vuong Nguyen', NULL, 'nvvuong.hna@gmail.com', '1686961445', NULL, NULL, '$2y$10$n33cJu6R0dQD5bLLKWu3N.49zqkaHl9NgthxolllHG4zEmbwvCJ5C', NULL, NULL, NULL, 0, 1, NULL, '2020-03-19 09:56:37', '2020-03-19 09:56:37'),
(10, 'baodv', 'FILES/source/user-default.png', 'admin@webtopmot.com', '0985967191', '1993-02-08', NULL, '$2y$10$.lub8GYm50i/2RwNJZC/r.AUviBerpKV5tPrRRqBJZhhBFrRsY5Qq', 'Ha Noi', 1, '1', 0, 1, NULL, '2020-03-20 07:23:09', '2020-03-20 07:23:09'),
(12, 'Đỗ Văn Bảo', NULL, 'vanbaodo@gmail.com', '0985967191', NULL, NULL, '$2y$10$Sh6rt6l6u0yQrFTmZdWnY.qz30wH8g9LOqJkPU.6j0MP8wbioDigG', NULL, NULL, NULL, 0, 1, NULL, '2020-03-29 07:15:07', '2020-03-29 07:15:07'),
(13, 'vương', NULL, 'admin@admin11.com', '0123456677', NULL, NULL, '$2y$10$obAFup72.OgR4tLxnh2kmOZ3GYNpASLyACqzVAuvWq.4td3gIAVTa', NULL, NULL, NULL, 0, 1, NULL, '2020-03-29 07:32:41', '2020-03-29 07:32:41'),
(14, 'vương', 'public/uploads/users/1591454841e2e99c1e848c69d2309d.jpg', 'webplus.com.vn@gmail.com', '0987108844', NULL, NULL, '$2y$10$D9oIarpRJzUIGM9Qc1EmN.dScI9JIAWASSBU7shSoAybLe49WgTkq', NULL, 0, '49', 0, 1, NULL, '2020-04-10 20:44:42', '2020-06-06 14:47:21'),
(15, 'Nguyễn Quân', NULL, 'nucuoithienthan88@gmail.com', '0912345678', '10-05-2000', NULL, '$2y$10$DaKvA6yj9bMxDUDFNqGSUecwpclaCMhpvx0wDCvQT.Q09Mr/VcZVq', 'Số 26A ĐL lê lợi', 1, '26', 0, 1, NULL, '2020-04-22 18:40:59', '2020-05-11 08:14:01'),
(17, 'Phương', NULL, 'trinhphuongk18@gmail.com', '9858560846', NULL, NULL, '$2y$10$XTIiKb2bBZW9cWbyOZcMMOcFOatsHpDohwmMe6xLAJG5IifkL2bZa', NULL, NULL, NULL, 0, 1, NULL, '2020-04-25 02:04:40', '2020-05-09 01:04:08'),
(19, 'dau phuong 123', 'public/uploads/users/1589187666flc.jpg', 'dauphuong161@gmail.com', '0946286333', NULL, NULL, '$2y$10$rZpjiZW9FPG/Zd1ygKV4R.HCjzFy29i3njLEqvwK7rkAL0F401VwK', 'le thánh tông1', 1, '57', 0, 1, NULL, '2020-04-25 04:16:10', '2020-05-11 09:01:06'),
(20, 'Dau Hoang Phuong', NULL, 'dauhoangphuong88@yahoo.com', NULL, NULL, NULL, '$2y$10$yo1j94zRbCB2LzRRcwrp7e5dWRCKA/5JtnSAsrRpPyOjhizJbQu8a', NULL, NULL, NULL, 0, 1, NULL, '2020-04-27 14:47:44', '2020-04-27 14:47:44'),
(22, 'Nguyễn Quân', NULL, 'nguyenquan812@gmail.com', '0912345678', NULL, NULL, '$2y$10$BJGESs5vPuolowG9lmBwhuc1jrVXMDbxI7Rf1znzlK0C8I7nL0voW', NULL, NULL, NULL, 0, 1, NULL, '2020-05-16 02:45:12', '2020-05-16 02:45:12'),
(23, 'Nguyen sy Manh', 'public/uploads/users/1593480449dola.jpg', 'hamrongmedia@gmail.com', '0968724886', '09-06-2020', NULL, '$2y$10$M66FwlaQCOCcfBLAUY7lRe3VTYY1zut8u2J1QFAHddobf7FsAsN3q', 'srfwetwe', 1, '23', 0, 1, NULL, '2020-05-16 08:55:53', '2020-06-30 01:28:09'),
(24, 'Nguyen sy Manh', NULL, 'ctyhamrongmedia@gmail.com', '1678740242', NULL, NULL, '$2y$10$iRoKbEr/8X3g..PhGXy5duYD8m1GdAapyHqIwTk8211/hIc8kBtjK', NULL, NULL, NULL, 0, 1, NULL, '2020-05-16 08:58:49', '2020-05-16 08:58:49'),
(25, 'Trân Van Hieu', NULL, 'namhieu9383@gmail.com', '0987888212', NULL, NULL, '$2y$10$VllOAkJjzddAxPzTes/mNeXJqtkluAd5GnnizXI4kp0t/jyo5D/sa', NULL, NULL, NULL, 0, 1, NULL, '2020-06-05 08:01:25', '2020-06-05 08:01:25'),
(26, 'vuong', NULL, 'khoduan.com@gmail.com', '0123456788', NULL, NULL, '$2y$10$RghiqNXm7TYf8DyVKUsjteV0pwhTKzseLjjO6os5YjngjVv5Po/42', NULL, NULL, NULL, 0, 1, NULL, '2020-06-06 14:54:17', '2020-06-06 14:54:17'),
(27, 'Lê Đức Minh', NULL, 'ducminh38777@gmail.com', '0826438777', NULL, NULL, '$2y$10$.UIN3p3lOpF2N/xfcwDuV.u3iE93dPuMcbK9qTWmgF0eKccnhqT3S', NULL, NULL, NULL, 0, 1, NULL, '2020-06-23 03:31:57', '2020-06-23 03:31:57'),
(28, 'Tran Van Hieu', NULL, 'ketoanminhtranghanoi@gmail.com', '0971365196', NULL, NULL, '$2y$10$i1wxLg2J8GFHZGh53v1/7umJUygQs6dF7jYH65BL/zeqJceZ9KrqO', NULL, NULL, NULL, 0, 1, NULL, '2020-07-08 12:03:44', '2020-07-08 12:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_onlines`
--

CREATE TABLE `user_onlines` (
  `id` int(11) UNSIGNED NOT NULL,
  `session` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `active` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_onlines`
--

INSERT INTO `user_onlines` (`id`, `session`, `time`, `active`) VALUES
(5, '864m94nc8t3sd5n4h6nnc2cim0', 1596420066, '1'),
(6, 'dko28g08v572nij2jsl82rggbl', 1596441686, '1'),
(7, 'l3j09uhs15r332hbvaqh8cam35', 1596429067, '1'),
(8, '5sesbaimlpdr3hlfd9fe038au2', 1596421142, '1'),
(9, '6umjvg0nooc4e48lbkb6tkkeo3', 1596421618, '1'),
(10, 'ad07ticn7t0r1cmn3ts9qhjef0', 1596443699, '1'),
(11, '4ig698u2863lkvu43rkifi0h7i', 1596426580, '1'),
(12, 'm7g3jho8fseeerhp2elb4u2e15', 1596422661, '1'),
(13, '1lhq65tos9fdhb617l0krm64n0', 1596424006, '1'),
(14, 'tg8j632jgr23sm4snrm5h62lkk', 1596424026, '1'),
(15, 'n3q011ilrdk327aj9k3idg1qbs', 1596425785, '1'),
(16, 'pvn4sit046e8hjsc804p26askb', 1596425942, '1'),
(17, 'oe9bajki6s70vugadrkogbrd0e', 1596478828, '1'),
(18, 't8gabsgptlh6kpjd41cd1qggpi', 1596435378, '1'),
(19, 'pon4qrmh2cillloq4pi8sgf83q', 1596473522, '1'),
(20, 'elnlv15bks0sdgum4s50lbe145', 1596437395, '1'),
(21, 'o298jkn0g0ss889q0unctk4kab', 1596451358, '1'),
(22, 'qmgp47te0llmh8rol20htniq1k', 1596437704, '1'),
(23, 'dm0vna16u4njk9ml6ffqvod08o', 1596438017, '1'),
(24, 'kghuoc3gktgt12cuod67ojm1pt', 1596506970, '1'),
(25, 'h9vd75n1599866jufdgkkunbhr', 1596442135, '1'),
(26, 's1psc9shqnhgnnm52b42fs73pn', 1596446457, '1'),
(27, 'q0dafjpre8gsbkkq9fcqom8qfm', 1596446459, '1'),
(28, 'aqa086qus77ucs7983hmp3qkj8', 1596446460, '1'),
(29, 'hn9afv7743gljuapgv4sa0hb2b', 1596446460, '1'),
(30, 'ttggahuvcv315fq1rk5lm5bf0m', 1596446461, '1'),
(31, 'aa77qukola9eas962e7i640hjq', 1596446474, '1'),
(32, 'c9tkokq26ufckst7hbf090imbt', 1596447284, '1'),
(33, 'e0picegok1qujbgkvb3srjqbd2', 1596462453, '1'),
(34, '7brrpgjaop903q6aerc6eefh4v', 1596462434, '1'),
(35, 'u1auv5pfh5dl5qoo7obu1ugeb6', 1596470080, '1'),
(36, '5cip1sbghmc77lb9lp5ri0una4', 1596471694, '1'),
(37, 'geh76sps5foosr768reb27dpii', 1596477525, '1'),
(38, '0fr9k7v88rtfdrdb5skto4hte3', 1596477527, '1'),
(39, 'eldl0rac1n70sb1tqqleqidv3g', 1596477527, '1'),
(40, '1umbl67qjr7k7n2qpgmgohsc5o', 1596477527, '1'),
(41, 'h1qv31omabb168blhm2ssif9he', 1596477527, '1'),
(42, 'c5696hbvdij2behaoghr38stei', 1596477528, '1'),
(43, 'md0mgsmm6t2jpuu2msgm7ja924', 1596477528, '1'),
(44, 'qo8ch8bgjpnjj1tqujkhl6p6nc', 1596477529, '1'),
(45, 'h0orrakfijua6a4ldhstdb1gh1', 1596477530, '1'),
(46, 'aujtn5a9231an6u76bale6ebek', 1596477531, '1'),
(47, '2kuc07bofijs93nd8pdn7bua96', 1596477534, '1'),
(48, 'kd2ss6f66m31b7qdqv5rgsohaq', 1596477586, '1'),
(49, '9khcff5c81jruj1anfacns6dsb', 1596477588, '1'),
(50, 'c3c13f01b75uvqavam2mlgche6', 1596477589, '1'),
(51, '4norrnoaum4ku02ttt7n63jiiv', 1596477589, '1'),
(52, '9564d38396m0hchsjor6dgvhj3', 1596488940, '1'),
(53, '3c612fev4sdgsjud1n3rksivtk', 1596489031, '1'),
(54, '86o5cve8kun8cp3dvivrn7rvh5', 1596489134, '1'),
(55, 'cjgjsietp69rg6ir52q0jit62k', 1596489230, '1'),
(56, 'hp1lv855f04qfb0lvb8uruk9na', 1596489347, '1'),
(57, 'e2mf0ni5jq3sllpdhgva76rpov', 1596489360, '1'),
(58, '3fbvlh6qajid4s5f3kk3fqjcjv', 1596503033, '1'),
(59, '98l1r8pg6h4sk3j4l8s0kimv5t', 1596501441, '1'),
(60, 'bhtur1if4713sl3hg5vvtmoisl', 1596504574, '1'),
(61, 'gldml6djj7cnh1srpu66rr06df', 1596503033, '1'),
(62, '7mn9vj8cgb6g2g0c35vc88q4hl', 1596503421, '1'),
(63, '0mjfoqi27p1f0sdtqkte38lhoh', 1596501941, '1'),
(64, 'iqgmdi2s5i4jhdpfbqk4fao36s', 1596503202, '1'),
(65, 'qc5p5o1hogcg9n8kkgh8kr3nu5', 1596502721, '1'),
(66, 'hdn1toguv5vgovs45ldg95t880', 1596528627, '1'),
(67, '47qj0p9jtr2mhq1uu399bb4mqc', 1596503075, '1'),
(68, 'f8gf407s3k0hq2m9lbpcot85n7', 1596506740, '1'),
(69, 's9schf6r0ekp901r7vqjfl60b6', 1596506741, '1'),
(70, '68dtqdos03l6p5ke3std1um992', 1596506743, '1'),
(71, 'fkb79643nekv0llbo10vo7pafe', 1596507291, '1'),
(72, 'btrpc11f87bgno08qgo7qt0nud', 1596507292, '1'),
(73, 'amhm3b2i0hnf173m01tq6e757h', 1596507294, '1'),
(74, 'i913csh9c17if16pmco8i8gn4h', 1596526336, '1'),
(75, '76k2uheibfd8teknpdn57tlovm', 1596531424, '1'),
(76, 'mbmevbflvs9gecv6mp1jnl4nkr', 1596531764, '1'),
(77, '833vnonphsld08g6ia3cng8que', 1596528582, '1'),
(78, '3uik3d3c13mp9r13csdjr9u9b9', 1596528591, '1'),
(79, 'kkde3k16f2c5gmp5uib75tegi3', 1596528598, '1'),
(80, 'rvgemu5r4dt69jbl732mhblgs2', 1596528599, '1'),
(81, '04j8l9tmratb272k7pc9pgotlj', 1596538036, '1'),
(82, 'ns6edobg0r459cnlujpikt4srp', 1596538392, '1'),
(83, '7j35egssk1kef2it03n714d703', 1596538680, '1'),
(84, '5dc2ntcpq3ir74tb0b5rqdb4sm', 1596539910, '1'),
(85, 'ip7l7ll4j5jvgi6coggovgeqg4', 1596541021, '1'),
(86, 'l075vqnjveo7r0bnbgiihh3oj3', 1596543120, '1'),
(87, 'kssde0t6ub86v12g85689a6hu1', 1596543209, '1'),
(88, 'ck5vbmsddr6b6eq0gpj7r0gn3m', 1596551523, '1'),
(89, 'a81qcs7rocnnkb7ec8qm0gi6jg', 1596551087, '1'),
(90, 'onbrmtdt2vjp8cle6spg8chf8d', 1596549526, '1'),
(91, '9k9eit5hfsp8ednne7olqu6j4s', 1596549769, '1'),
(92, 'ocbi75ao3suhutabbl5d836qor', 1596549846, '1'),
(93, 'tb7pb7muoltaqvlce2jk6a6cn2', 1596550121, '1'),
(94, 'vkrnj0ipuph5gnh7v8e3qci3v1', 1596550373, '1'),
(95, 'uadnq3cmvshqe5pp2b0e7uvtqh', 1596550915, '1'),
(96, 'hh10bimn2te88k4mff81cuic9t', 1596551544, '1'),
(97, '38h9t4likql7ri5j4h8g7dtpun', 1596551587, '1'),
(98, 'sfo3otfgkjono8ql6e44lgrrv9', 1596551630, '1'),
(99, 'e2cvfnjabpl9p598i6mi3ho1tf', 1596551715, '1'),
(100, 'hifprgsjeu4ah8p98nqp9f5ltb', 1596551755, '1'),
(101, 'b0vd4is7osvoc9j7t7kpn8bkmn', 1596551800, '1'),
(102, 'kqbj3j1mf8df0rhppi3hl6l1a4', 1596551842, '1'),
(103, '4a8v3l8k67mhmr19445u1kii2l', 1596551885, '1'),
(104, 'gsbvuia0ssnuo4kl2gsheoltjs', 1596551928, '1'),
(105, 's5n3fmfpsc1c428di8u79sk3nt', 1596551971, '1'),
(106, 'ilbrrb5lhami2q40e063j9pruo', 1596552014, '1'),
(107, 'acbdvt2d2aqig93gg2rh2j2vbk', 1596552060, '1'),
(108, '1ja4ei2kir2olt7qlvm884kmss', 1596552111, '1'),
(109, 'n409ccna8tbar4tpmf75eieoj0', 1596553825, '1'),
(110, 'kspfisi3mb22k3gj5godf3vi59', 1596555785, '1'),
(111, 'vms443dfcri8auscn0tda96up7', 1596556989, '1'),
(112, 'a56tpchr7tg5b82eb0sqbhi3l5', 1596558489, '1'),
(113, 'uj4f18j18q0cqgal9pt0qhek7n', 1596560192, '1'),
(114, '7lbue1t3ertilu0fho9sl8gbjq', 1596560515, '1'),
(115, 'n887bdt36eapfnmckqkt8cof4j', 1596560791, '1'),
(116, 'eit3flarg5dbssnfid12ss77fl', 1596561062, '1'),
(117, 'qdn6leghh7eseugcs4gjvlt3bp', 1596561317, '1'),
(118, '6ipoupga4j5u645egvno5ij9sd', 1596561563, '1'),
(119, 'itenjj90guur3f2pleac9n6bse', 1596566092, '1'),
(120, 'm7tmp94571jctdi4018k08f8e5', 1596570395, '1'),
(121, 'esc0po3u57heftlhcho740rl4i', 1596575029, '1'),
(122, '5u9jrseq4o496ts5v9jsgdllae', 1596580008, '1'),
(123, 'oeab60d69m2pqoqbrh9oee3dmn', 1596584161, '1'),
(124, 'rbnk2loce552dfanscoguelg8b', 1596587023, '1'),
(125, 'mtdvlhorem9rv2tgmm9jova5qq', 1596587024, '1'),
(126, 'j35h8231a5ou1050mtr4psonh2', 1596588056, '1'),
(127, 'sr3fj26ech6t9mtakj973ug6nm', 1596588965, '1'),
(128, 'vhcevsbl0htn0o6ourmlaf8rfp', 1596589045, '1'),
(129, 'ipbstdf04uf87p50ask588hdlf', 1596588988, '1'),
(130, 'i3um03f6sje10i3a89iluf9qjk', 1596589177, '1'),
(131, 'sk3gl8cc56qbum6dl87edcufem', 1596598432, '1'),
(132, 'u7dva26jr4u5ogb196j30q1ase', 1596678966, '1'),
(133, 'f083kcvfl4rddu18k45qh4105u', 1596682047, '1'),
(134, 's799d1nrbhuli9qht6he4i484u', 1596700220, '1'),
(135, '14hf8o2eeh7c0gvl52fp7vp5qi', 1596700515, '1'),
(136, 'r2fkunkuiveffe86iscdnkgene', 1596765572, '1'),
(137, 'pade267coqpervmi8hmfip8fql', 1597811209, '1'),
(138, 'nuor23fl6eldcvout07qfg2gqt', 1597802972, '1'),
(139, 'mb0hrl9936ocr73nvu7sfka1h6', 1597820398, '1'),
(140, 'cm9mjh9rpqe0dbdoq8nt2v8ddi', 1598406288, '1'),
(141, 'jn0hekgvhgvvbctkm9aqr439d1', 1598416105, '1'),
(142, 'e3plb1snptsh2ls6am8o8hcg7t', 1598428908, '1'),
(143, 'seai5q8u8jo95arag3sgadffct', 1598429054, '1'),
(144, 'vnuq6ogvomimtrgf9lak6o40jq', 1598500251, '1'),
(145, 'so53bqtvf2b94a8t01mqm9n4pk', 1598489991, '1'),
(146, 't5nsj1h8dkq26gufa1bm41mi5v', 1598513244, '1'),
(147, '2frcufan2c76s1a8rqki7u34vg', 1598516504, '1'),
(148, '5uiagh9ue7ivmqsmcfvfhmsvu9', 1598588328, '1'),
(149, 'jsh7gp5238gl9vld7j2iafvsfg', 1598575084, '1'),
(150, 'rph41ufdajcksr1iv42u8valn4', 1598602154, '1'),
(151, 'uoi4gl8s9kq6r0m76u7q73stpt', 1598662587, '1'),
(152, 'ohg1lo1uu3hi10t8nm3llgalme', 1598664440, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_reset_pass`
--

CREATE TABLE `user_reset_pass` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_reset_pass`
--

INSERT INTO `user_reset_pass` (`id`, `email`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hamrongmedia@gmail.com', '9d626239ecaab7f3af9a436ced330416f7302dddb3d3e7dcc3a5fe143a249a78', 0, '2020-04-27 01:50:34', '2020-04-27 01:50:34'),
(6, 'hamrongmedia@gmail.com', '9c758e5b1b93ec5a872c2e2b53e0fc82af61a01932e590d6f6c7a27c57d09527', 0, '2020-05-05 09:05:27', '2020-05-05 09:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_voucher`
--

CREATE TABLE `user_voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `voucher_id` int(10) UNSIGNED NOT NULL,
  `redeemed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webinfos`
--

CREATE TABLE `webinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `webinfos`
--

INSERT INTO `webinfos` (`id`, `content`, `name`, `created_at`, `updated_at`) VALUES
(1, '{\"_token\":\"SV6p2eUsQYyybnpWVI7El9opD3Ao1SIK4qtyum9O\",\"name\":\"TRUNG T\\u00c2M \\u0110\\u00c0O T\\u1ea0O D\\u1ecaCH V\\u1ee4 K\\u1ebe TO\\u00c1N MINH TRANG\",\"hotline\":\"0971.365.196\",\"email\":\"info@hocketoanonline.com.vn\",\"address\":\"H\\u00e0 N\\u1ed9i\",\"map\":\"<iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m14!1m8!1m3!1d14898.771928168839!2d105.8027586!3d21.0049406!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8251f76e4ce9b11d!2zROG7i2NoIHbhu6UgxJHDoG8gdOG6oW8ga-G6vyB0b8OhbiBNaW5oIFRyYW5n!5e0!3m2!1svi!2s!4v1592960635966!5m2!1svi!2s\\\" width=\\\"600\\\" height=\\\"450\\\" frameborder=\\\"0\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" aria-hidden=\\\"false\\\" tabindex=\\\"0\\\"><\\/iframe>\",\"footer\":\"<p>Copyright &copy; 2020. Design by H\\u1ecdc K\\u1ebf to&aacute;n Online<\\/p>\\r\\n\\r\\n<p>Hotline: 0971.365.196<\\/p>\\r\\n\\r\\n<p>Email:&nbsp;info@hocketoanonline.com.vn<\\/p>\",\"mota\":\"<ul>\\r\\n\\t<li><strong>V\\u0103n ph&ograve;ng:<\\/strong>&nbsp;To&agrave; N4A, S\\u1ed1 52, L&ecirc; V\\u0103n L\\u01b0\\u01a1ng, Nh&acirc;n Ch&iacute;nh, Thanh Xu&acirc;n, HN<\\/li>\\r\\n\\t<li><strong>Chi nh&aacute;nh 1:<\\/strong>&nbsp;S\\u1ed1 12, Ph\\u1ed1 Tr\\u1ea7n K\\u1ef3, P.\\u0110&ocirc;ng A, TP Nam \\u0110\\u1ecbnh, T\\u1ec9nh Nam \\u0110\\u1ecbnh<\\/li>\\r\\n\\t<li><strong>Email:<\\/strong>&nbsp;<a href=\\\"mailto:minhphugroup@gmail.com\\\">ketoanminhtranghanoi@gmail.com<\\/a><\\/li>\\r\\n\\t<li><strong>Hotline\\/Zalo:<\\/strong>&nbsp;<a href=\\\"tel:0986 122 168\\\">0971 365 196 - 0986 122 168<\\/a><\\/li>\\r\\n<\\/ul>\",\"mota2\":\"<p><strong>QUY \\u0110\\u1ecaNH V&Agrave; CH&Iacute;NH S&Aacute;CH<\\/strong><\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><a href=\\\"#\\\" target=\\\"_blank\\\">Ch&iacute;nh s&aacute;ch b\\u1ea3o m\\u1eadt th&ocirc;ng tin <\\/a><\\/li>\\r\\n\\t<li><a href=\\\"#\\\" target=\\\"_blank\\\">Chi\\u0301nh sa\\u0301ch va\\u0300 quy \\u0111i\\u0323nh chung <\\/a><\\/li>\\r\\n<\\/ul>\",\"mota3\":\"<p><strong>QUY \\u0110\\u1ecaNH V&Agrave; CH&Iacute;NH S&Aacute;CH<\\/strong><\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><a href=\\\"#\\\" target=\\\"_blank\\\">Ch&iacute;nh s&aacute;ch b\\u1ea3o m\\u1eadt th&ocirc;ng tin <\\/a><\\/li>\\r\\n\\t<li><a href=\\\"#\\\" target=\\\"_blank\\\">Chi\\u0301nh sa\\u0301ch va\\u0300 quy \\u0111i\\u0323nh chung <\\/a><\\/li>\\r\\n<\\/ul>\",\"facebook\":\"https:\\/\\/www.facebook.com\\/KeToanThue.0986122168.0971365196\",\"gg\":\"#\",\"zalo\":\"0971365196\",\"skype\":null,\"youtube\":\"#\"}', 'thong-tin-chung', '2020-02-11 20:33:22', '2020-08-03 07:12:05'),
(3, '{\"logo\":\"FILES\\/source\\/1843-406.jpg\",\"link_logo\":\"#\",\"logo_footer\":\"FILES\\/source\\/1843-406.jpg\",\"link_logo_footer\":null}', 'header', '2020-02-11 21:04:30', '2020-07-05 14:17:50'),
(4, '', 'footer', '2020-05-06 09:43:51', '2020-05-06 09:43:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `albums_slug_unique` (`slug`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_catalog`
--
ALTER TABLE `article_catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_catalog_article_id_index` (`article_id`),
  ADD KEY `article_catalog_catalog_id_index` (`catalog_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_name_unique` (`name`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danhgias`
--
ALTER TABLE `danhgias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giangviens`
--
ALTER TABLE `giangviens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giaodiches`
--
ALTER TABLE `giaodiches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `history_logins`
--
ALTER TABLE `history_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `post_coupons`
--
ALTER TABLE `post_coupons`
  ADD UNIQUE KEY `post_coupons_post_id_coupon_id_unique` (`post_id`,`coupon_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`provider_user_id`,`provider`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `tailieus`
--
ALTER TABLE `tailieus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tailieu_khoahoc`
--
ALTER TABLE `tailieu_khoahoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tailieu_khoahocs`
--
ALTER TABLE `tailieu_khoahocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thongbaos`
--
ALTER TABLE `thongbaos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD UNIQUE KEY `user_coupons_user_id_coupon_id_unique` (`user_id`,`coupon_id`);

--
-- Indexes for table `user_onlines`
--
ALTER TABLE `user_onlines`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_reset_pass`
--
ALTER TABLE `user_reset_pass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_reset_pass_code_unique` (`code`);

--
-- Indexes for table `user_voucher`
--
ALTER TABLE `user_voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_voucher_user_id_foreign` (`user_id`),
  ADD KEY `user_voucher_voucher_id_foreign` (`voucher_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`),
  ADD KEY `vouchers_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `webinfos`
--
ALTER TABLE `webinfos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article_catalog`
--
ALTER TABLE `article_catalog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `danhgias`
--
ALTER TABLE `danhgias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `giangviens`
--
ALTER TABLE `giangviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `giaodiches`
--
ALTER TABLE `giaodiches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `history_logins`
--
ALTER TABLE `history_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `icons`
--
ALTER TABLE `icons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tailieus`
--
ALTER TABLE `tailieus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tailieu_khoahoc`
--
ALTER TABLE `tailieu_khoahoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tailieu_khoahocs`
--
ALTER TABLE `tailieu_khoahocs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thongbaos`
--
ALTER TABLE `thongbaos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_onlines`
--
ALTER TABLE `user_onlines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `user_reset_pass`
--
ALTER TABLE `user_reset_pass`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_voucher`
--
ALTER TABLE `user_voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webinfos`
--
ALTER TABLE `webinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_catalog`
--
ALTER TABLE `article_catalog`
  ADD CONSTRAINT `article_catalog_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_catalog_catalog_id_foreign` FOREIGN KEY (`catalog_id`) REFERENCES `catalogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_voucher`
--
ALTER TABLE `user_voucher`
  ADD CONSTRAINT `user_voucher_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_voucher_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
