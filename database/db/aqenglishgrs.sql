-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 01:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqenglishgrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vission_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vission_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_about_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_about_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_about_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `image`, `details`, `mission_image`, `mission_details`, `vission_image`, `vission_details`, `footer_about`, `body_about_title`, `body_about_description`, `body_about_image`, `created_at`, `updated_at`) VALUES
(1, NULL, '<p>na</p>', 'public/frontend/images/about/61af28c6d71b9.jpg', '<p>na</p>', 'public/frontend/images/about/61af28c6d7e8b.jpg', '<p>ba</p>', '<p>na</p>', 'na', '<p>na</p>', 'public/frontend/images/about/61af5ff80d7a0.jpg', NULL, '2021-12-07 13:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `absent_month`
--

CREATE TABLE `absent_month` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `absent_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `absent_students`
--

CREATE TABLE `absent_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `account_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_amount` decimal(20,2) DEFAULT NULL,
  `contract_person` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_verified` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `payment_method_id`, `bank_id`, `account_name`, `account_no`, `opening_amount`, `contract_person`, `contract_phone`, `address`, `status`, `is_active`, `is_verified`, `deleted_at`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Cash', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activism_modules`
--

CREATE TABLE `activism_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `activate_code` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activate_status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classes_id` int(11) NOT NULL,
  `sessiones_id` int(11) NOT NULL,
  `batch_setting_id` int(11) NOT NULL,
  `attendance_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_student` int(11) DEFAULT NULL,
  `total_present` int(11) DEFAULT NULL,
  `total_absent` int(11) DEFAULT NULL,
  `is_admin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `classes_id`, `sessiones_id`, `batch_setting_id`, `attendance_date`, `total_student`, `total_present`, `total_absent`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, '2021-12-07 12:58:00', 1, 0, 1, 1, 2, '2021-12-07 06:58:18', '2021-12-07 06:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_details`
--

INSERT INTO `attendance_details` (`id`, `attendance_id`, `student_id`, `attendance`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 14, 'Absent', 0, '2021-12-07 07:00:08', '2021-12-07 07:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_verified` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `short_name`, `address`, `status`, `is_active`, `is_verified`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dutch Bangla Bank Ltd', 'DBBL', 'Mirpur-10', 1, 1, 1, 1, NULL, '2021-04-07 10:40:45', '2021-06-10 06:32:22'),
(2, 'Cash', 'cash', 'cash', 1, 1, 1, 1, NULL, '2021-04-07 10:50:19', '2021-04-07 10:50:19'),
(3, 'Mobile Banking', 'Mobile Banking', 'Mirpur-10', 1, 1, 1, 1, NULL, '2021-06-10 06:33:37', '2021-06-10 06:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch_day_times`
--

CREATE TABLE `batch_day_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_setting_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_day_times`
--

INSERT INTO `batch_day_times` (`id`, `batch_setting_id`, `day_id`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 1, '16:00', '17:00', 1, '2021-12-06 09:50:01', '2021-12-06 09:50:01'),
(8, 1, 3, '16:00', '17:00', 1, '2021-12-06 09:50:01', '2021-12-06 09:50:01'),
(9, 1, 4, '16:00', '17:00', 1, '2021-12-06 09:50:01', '2021-12-06 09:50:01'),
(13, 3, 1, '14:00', '15:00', 1, '2021-12-06 10:30:52', '2021-12-06 10:30:52'),
(14, 3, 3, '14:00', '15:00', 1, '2021-12-06 10:30:52', '2021-12-06 10:30:52'),
(15, 3, 6, '14:00', '15:00', 1, '2021-12-06 10:30:52', '2021-12-06 10:30:52'),
(16, 4, 1, '16:36', '18:36', 1, '2021-12-06 10:36:45', '2021-12-06 10:36:45'),
(17, 4, 4, '18:36', '16:37', 1, '2021-12-06 10:36:45', '2021-12-06 10:36:45'),
(18, 2, 1, '18:00', '19:00', 1, '2021-12-06 10:37:40', '2021-12-06 10:37:40'),
(19, 2, 3, '18:00', '19:00', 1, '2021-12-06 10:37:40', '2021-12-06 10:37:40'),
(20, 2, 6, '18:00', '19:00', 1, '2021-12-06 10:37:40', '2021-12-06 10:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `batch_settings`
--

CREATE TABLE `batch_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classes_id` int(11) NOT NULL,
  `sessiones_id` int(11) NOT NULL,
  `class_type_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_seat` int(11) DEFAULT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_settings`
--

INSERT INTO `batch_settings` (`id`, `batch_uid`, `batch_name`, `classes_id`, `sessiones_id`, `class_type_id`, `description`, `total_seat`, `fb_link`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021003', 'Six Batch 01', 6, 1, 1, '<p>Six Batch 01<br></p>', 50, 'https://www.m.me/azadsirbiologynine', 1, '2021-12-06 09:49:26', '2021-12-06 09:50:01'),
(2, '2021007', 'Saven Batch 01', 7, 2, 1, '<p>Saven Batch 01<br></p>', 50, 'https://www.m.me/azadsirbiologynine', 1, '2021-12-06 10:27:00', '2021-12-06 10:37:40'),
(3, '2021005', 'Six Batch 02', 6, 1, 1, '<p>Six Batch 02<br></p>', 50, 'https://www.m.me/azadsirbiologynine', 1, '2021-12-06 10:30:52', '2021-12-06 10:30:52'),
(4, '2021006', 'Six Batch 01', 6, 2, 1, '<p>Six Batch 01<br></p>', 50, 'https://www.m.me/azadsirbiologynine', 1, '2021-12-06 10:36:45', '2021-12-06 10:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `batch_typies`
--

CREATE TABLE `batch_typies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_typies`
--

INSERT INTO `batch_typies` (`id`, `name`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Full Package', NULL, NULL, 1, NULL, NULL, NULL),
(2, 'Half Package', NULL, NULL, 1, NULL, NULL, NULL),
(3, 'Partial Package', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `image`, `publish_date`, `description`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'The Holy Grail of Mathematics', 'the-holy-grail-of-mathematics', 'public/images/blogs/61af471995edc.jpg', NULL, '<p>কুরআন শরীফ, কাবা শরীফ, নূর নবী (স.)-এর রওজা মোবারক মুসলিমদের কাছে মহা পবিত্র বস্তু, বাইবেল খ্রিস্টানদের কাছে মহা পবিত্র বস্তু, গীতা হিন্দুদের কাছে মহা পবিত্র বস্তু আর রীমান হাইপোথিসিস হলো ', 1, 1, '2021-12-07 11:35:53', '2021-12-07 11:35:53'),
(2, NULL, 'The Growing Papaya Tree', 'the-growing-papaya-tree', 'public/images/blogs/61af484fb0bd7.jpg', NULL, '<p>The rain was dropping with a strong breeze and the sun was hiding behind clouds, I looked up to the sky standing on a balcony. It was the only thing I could do when my parents were busy de', 1, 1, '2021-12-07 11:41:03', '2021-12-07 11:41:03'),
(3, NULL, 'কি করে একটা মানুষ হিউম্যান ক্যালকুলেটর হতে পারে?', 'ki-kre-ekta-manush-hiumzan-kzalkuletr-hte-pare', 'public/images/blogs/61af4949cadaf.jpg', NULL, '<p>হিউম্যান ক্যালকুলেটর কেন হতে পারবে না? আমি যদি এখন আপনাকে হিউমেন ক্যালকুলেটর বানিয়ে দেই তাহলে বিশ্বাস হবে?</p><p><br></p><p>আসলে আমাদের ক্যালকুলেটর যে প্রোগ্রামে কাজ করে সেভাবে কাজ করে তীক', 1, 1, '2021-12-07 11:45:13', '2021-12-07 11:45:13'),
(4, NULL, 'গাণিতিক পদার্থবিজ্ঞান: জেনে নাও ভালো করার কৌশল!', 'ganitik-pdarthbijngan-jene-naoo-valo-krar-kousl', 'public/images/blogs/61af4abec2839.jpg', NULL, '<p><font color=\"#212529\" face=\"Roboto, Baloo Da 2, sans-serif, cursive\"><span style=\"font-size: 16px; background-color: rgb(250, 250, 250);\">গণিত অনেকের কাছেই অন্যতম ভীতির এক নাম। এর সাথে যখন', 1, 1, '2021-12-07 11:51:26', '2021-12-07 11:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `board_question_types`
--

CREATE TABLE `board_question_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chapter 01', '2021-12-06 09:41:38', '2021-12-06 09:41:38'),
(2, 1, 'Chapter 02', '2021-12-06 09:41:48', '2021-12-06 09:41:48'),
(3, 1, 'Chapter 03', '2021-12-06 09:41:56', '2021-12-06 09:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `fb_link`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Five', 'https://www.m.me/azadsirbiologynine', 1, '2021-12-05 18:00:00', '2021-12-05 18:00:00'),
(6, 'Six', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:23:19', '2021-02-08 12:23:19'),
(7, 'Saven', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:23:23', '2021-02-08 12:23:23'),
(8, 'Eight', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:23:31', '2021-02-08 12:23:31'),
(9, 'Nine', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:23:36', '2021-02-08 12:23:36'),
(10, 'Ten', 'https://www.m.me/azadsirbiologyten', 1, '2021-02-08 12:23:41', '2021-02-08 12:23:41'),
(11, 'Eleven', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:23:54', '2021-02-08 12:23:54'),
(12, 'Twelve', 'https://www.m.me/azadsirbiologynine', 1, '2021-02-08 12:24:00', '2021-02-08 12:24:00'),
(13, 'SSC', 'https://www.m.me/azadsirbiologynine', 0, NULL, NULL),
(14, 'HSC', 'https://www.m.me/azadsirbiologynine', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Saturday', 1, '2021-02-10 07:22:05', '2021-02-10 07:22:05'),
(2, 'Sunday', 1, '2021-02-10 07:22:56', '2021-02-10 07:22:56'),
(3, 'Monday', 1, '2021-02-10 07:22:56', '2021-02-10 07:22:56'),
(4, 'Tuesday', 1, '2021-02-10 07:25:08', '2021-02-10 07:25:10'),
(5, 'Wednesday', 1, '2021-02-10 07:25:13', '2021-02-10 07:25:15'),
(6, 'Thursday', 1, '2021-02-10 07:24:19', '2021-02-10 07:24:19'),
(7, 'Friday', 1, '2021-02-10 07:24:19', '2021-02-10 07:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `exam_settings`
--

CREATE TABLE `exam_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `question_subject_id` int(11) DEFAULT NULL,
  `exam_start_date_time` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_end_date_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_view` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_status` tinyint(4) DEFAULT NULL,
  `question_type` tinyint(4) DEFAULT NULL,
  `publish_type` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_settings`
--

INSERT INTO `exam_settings` (`id`, `fee_cat_id`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `examination_type_id`, `subject_id`, `question_subject_id`, `exam_start_date_time`, `exam_end_date_time`, `duration`, `result_view`, `exam_status`, `question_type`, `publish_type`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 1, 6, 1, 1, 1, 3, '2021-12-07T12:47', '2021-12-08', '5', '1', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-07 06:47:38', '2021-12-07 06:47:38'),
(4, 5, 1, 1, 6, 1, 1, 1, 1, '2021-12-07T13:09', '2021-12-08', '30', NULL, 1, NULL, NULL, 1, NULL, 1, NULL, '2021-12-07 07:09:49', '2021-12-07 07:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Half yearly', NULL, NULL),
(2, 'Test', NULL, NULL),
(3, 'Annual', NULL, NULL),
(4, 'Board Final', NULL, NULL),
(5, 'Pre-Test ', NULL, NULL),
(6, 'First Semester', NULL, NULL),
(7, 'Second Semester', NULL, NULL),
(8, 'Tutorial', '2021-08-02 14:37:03', '2021-08-02 14:37:03'),
(9, 'Quiz Test', NULL, NULL),
(10, 'First Test Exam', NULL, NULL),
(11, 'Second Test Exam', NULL, NULL),
(12, 'Model Test', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_action_typies`
--

CREATE TABLE `fee_action_typies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_amount_settings`
--

CREATE TABLE `fee_amount_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `pay_time_id` int(11) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_amount_settings`
--

INSERT INTO `fee_amount_settings` (`id`, `fee_cat_id`, `origin_id`, `pay_time_id`, `amount`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, '500.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-06 11:33:16', '2021-12-06 11:33:16'),
(2, 2, NULL, 2, '2000.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-06 11:33:33', '2021-12-06 11:33:33'),
(4, 4, 2, 3, '0.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-07 06:47:38', '2021-12-07 06:47:38'),
(5, 5, 3, 1, '1000.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-07 07:07:27', '2021-12-07 07:07:27'),
(6, 5, 4, 1, '5000.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-07 07:09:49', '2021-12-07 07:09:49'),
(7, 6, 1, 3, '0.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-08 11:46:01', '2021-12-08 11:46:01'),
(8, 6, 2, 3, '0.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-08 11:46:49', '2021-12-08 11:46:49'),
(9, 6, 3, 1, '200.00', 3, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-08 11:47:11', '2021-12-08 11:47:11'),
(10, 6, 4, 1, '100.00', 3, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-08 11:47:32', '2021-12-08 11:47:32'),
(11, 6, 5, 1, '100.00', 1, 1, 6, 1, 1, NULL, 1, NULL, '2021-12-08 11:47:54', '2021-12-08 11:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `fee_categories`
--

CREATE TABLE `fee_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_category_type_id` int(10) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_categories`
--

INSERT INTO `fee_categories` (`id`, `module_id`, `name`, `fee_category_type_id`, `status`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Admission  Fee', 1, 1, NULL, NULL, '2021-04-07 05:07:47', '2021-04-07 06:05:08'),
(2, 2, 'Monthly Fees', 1, 1, NULL, NULL, '2021-04-25 03:53:40', '2021-06-10 06:07:47'),
(4, NULL, 'MCQ Examination', 2, 1, NULL, NULL, '2021-05-23 14:23:24', '2021-05-23 14:23:24'),
(5, NULL, 'Witten Examination', 2, 1, NULL, NULL, '2021-05-23 14:23:43', '2021-05-23 14:23:43'),
(6, NULL, 'Sheet', 2, 1, NULL, NULL, '2021-05-23 14:23:53', '2021-05-23 14:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `fee_category_typies`
--

CREATE TABLE `fee_category_typies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_category_typies`
--

INSERT INTO `fee_category_typies` (`id`, `name`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Setting amount from one time', NULL, NULL, 1, NULL, NULL, NULL),
(2, 'Setting amount from many times', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_collections`
--

CREATE TABLE `fee_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_collection_main_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `payment_amount` decimal(5,2) DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `fee_setting_id` int(11) DEFAULT NULL,
  `student_waiver_id` int(11) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_month_id` tinyint(4) DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collection_main`
--

CREATE TABLE `fee_collection_main` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `payment_amount` decimal(20,2) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_month_id` tinyint(4) DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_settings`
--

CREATE TABLE `fee_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `amount` decimal(5,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_works`
--

CREATE TABLE `home_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classes_id` int(11) DEFAULT NULL,
  `sessiones_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dead_line` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_student` int(11) DEFAULT NULL,
  `total_present` int(11) DEFAULT NULL,
  `total_absent` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_works`
--

INSERT INTO `home_works` (`id`, `classes_id`, `sessiones_id`, `batch_setting_id`, `subject_id`, `chapter_id`, `topic`, `dead_line`, `attachment`, `total_student`, `total_present`, `total_absent`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 1, 1, 'Biology', '2021-12-08T12:57', 'public/uploads/homework/invoice_61af05f6e8727.pdf', 1, 1, 0, 1, 2, '2021-12-07 06:57:58', '2021-12-07 06:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `home_work_details`
--

CREATE TABLE `home_work_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_work_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_work_details`
--

INSERT INTO `home_work_details` (`id`, `home_work_id`, `student_id`, `attachment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 14, NULL, 1, '2021-12-07 06:57:58', '2021-12-07 06:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcq_exam_settings`
--

CREATE TABLE `mcq_exam_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `mcq_subject_id` int(11) DEFAULT NULL,
  `mcq_question_subject_id` int(11) DEFAULT NULL,
  `exam_start_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_start_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_end_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_exam_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcq_exam_student_answers`
--

CREATE TABLE `mcq_exam_student_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `mcq_exam_student_ans_summary_id` int(11) DEFAULT NULL,
  `mcq_exam_setting_id` int(11) DEFAULT NULL,
  `mcq_subject_id` int(11) DEFAULT NULL,
  `mcq_question_subject_id` int(11) DEFAULT NULL,
  `mcq_question_id` int(11) DEFAULT NULL,
  `given_option_id` int(11) DEFAULT NULL,
  `correct_option_id` int(11) DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_exam_student_answers`
--

INSERT INTO `mcq_exam_student_answers` (`id`, `student_id`, `batch_setting_id`, `batch_type_id`, `mcq_exam_student_ans_summary_id`, `mcq_exam_setting_id`, `mcq_subject_id`, `mcq_question_subject_id`, `mcq_question_id`, `given_option_id`, `correct_option_id`, `result`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 14, 1, 1, 1, 2, 1, 3, 3, 15, 15, 1, NULL, NULL, NULL, NULL, '2021-12-07 06:56:54', '2021-12-07 06:56:54'),
(2, 14, 1, 1, 2, 2, 1, 3, 3, 13, 15, 0, NULL, NULL, NULL, NULL, '2021-12-07 07:01:54', '2021-12-07 07:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_exam_student_ans_summaries`
--

CREATE TABLE `mcq_exam_student_ans_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `mcq_exam_setting_id` int(11) DEFAULT NULL,
  `mcq_subject_id` int(11) DEFAULT NULL,
  `mcq_question_subject_id` int(11) DEFAULT NULL,
  `final_result` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_exam_student_ans_summaries`
--

INSERT INTO `mcq_exam_student_ans_summaries` (`id`, `student_id`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `examination_type_id`, `mcq_exam_setting_id`, `mcq_subject_id`, `mcq_question_subject_id`, `final_result`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 14, 1, 1, 6, 1, 1, 2, 1, 3, 0, 6, '1', 1, NULL, '2021-12-07 07:01:50', '2021-12-07 07:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_questions`
--

CREATE TABLE `mcq_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `mcq_subject_id` int(11) DEFAULT NULL,
  `question` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `describe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_questions`
--

INSERT INTO `mcq_questions` (`id`, `class_id`, `session_id`, `batch_setting_id`, `section_id`, `mcq_subject_id`, `question`, `describe`, `image`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 6, 1, NULL, NULL, 2, '<p>Question 01</p>', 'Na', 'public/images/questions/61aefeaf4a076.jpg', 1, NULL, 1, NULL, '2021-12-07 06:26:55', '2021-12-07 06:28:26'),
(3, 6, 1, NULL, NULL, 3, 'asdfsadf', 'Sdfsadf', 'public/images/questions/61aeff589547d.jpg', 1, NULL, 1, NULL, '2021-12-07 06:29:44', '2021-12-07 06:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_question_options`
--

CREATE TABLE `mcq_question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mcq_subject_id` int(11) DEFAULT NULL,
  `mcq_question_id` int(11) DEFAULT NULL,
  `pattern` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_question_options`
--

INSERT INTO `mcq_question_options` (`id`, `mcq_subject_id`, `mcq_question_id`, `pattern`, `option`, `answer`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 2, 2, 'A', '<p>A</p>', 0, 1, NULL, 1, NULL, '2021-12-07 06:28:26', '2021-12-07 06:28:26'),
(10, 2, 2, 'B', '<p>A</p>', 0, 1, NULL, 1, NULL, '2021-12-07 06:28:26', '2021-12-07 06:28:26'),
(11, 2, 2, 'C', '<p>C</p>', 1, 1, NULL, 1, NULL, '2021-12-07 06:28:26', '2021-12-07 06:28:26'),
(12, 2, 2, 'D', '<p>A</p>', 0, 1, NULL, 1, NULL, '2021-12-07 06:28:26', '2021-12-07 06:28:26'),
(13, 3, 3, 'A', 'A', 0, 1, NULL, 1, NULL, '2021-12-07 06:29:44', '2021-12-07 06:29:44'),
(14, 3, 3, 'B', 'B', 0, 1, NULL, 1, NULL, '2021-12-07 06:29:44', '2021-12-07 06:29:44'),
(15, 3, 3, 'C', 'C', 1, 1, NULL, 1, NULL, '2021-12-07 06:29:44', '2021-12-07 06:29:44'),
(16, 3, 3, 'D', 'D', 0, 1, NULL, 1, NULL, '2021-12-07 06:29:45', '2021-12-07 06:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_question_subjects`
--

CREATE TABLE `mcq_question_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `topic` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `question_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_question_subjects`
--

INSERT INTO `mcq_question_subjects` (`id`, `class_id`, `session_id`, `batch_setting_id`, `section_id`, `subject_id`, `chapter_id`, `topic`, `examination_type_id`, `question_no`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 6, 1, NULL, NULL, 1, 1, '0', 1, 'Six Math MCQ Question', 1, NULL, 1, NULL, '2021-12-07 06:26:55', '2021-12-07 06:26:55'),
(3, 6, 1, NULL, NULL, 1, 1, 'Biology', 1, 'Six Math MCQ Question', 1, NULL, 1, NULL, '2021-12-07 06:29:44', '2021-12-07 06:29:44');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_08_091614_create_classes_table', 1),
(5, '2021_02_08_091826_create_sessiones_table', 1),
(6, '2021_02_08_091838_create_batches_table', 1),
(7, '2021_02_08_091850_create_days_table', 1),
(8, '2021_02_08_092111_create_batch_day_times_table', 1),
(9, '2021_02_08_092214_create_facilities_table', 1),
(10, '2021_02_08_092531_create_student_waivers_table', 1),
(11, '2021_02_08_092608_create_payment_types_table', 1),
(12, '2021_02_08_092634_create_absent_students_table', 1),
(13, '2021_02_08_092656_create_student_types_table', 1),
(14, '2021_02_08_092722_create_students_table', 1),
(15, '2021_02_08_092806_create_student_infos_table', 1),
(16, '2021_02_08_093624_create_sections_table', 1),
(17, '2021_02_08_100959_create_batch_settings_table', 1),
(18, '2021_02_26_230619_create_blogs_table', 1),
(19, '2021_02_26_230816_create_sliders_table', 1),
(20, '2021_02_26_230853_create_notices_table', 1),
(21, '2021_02_26_230911_create_news_table', 1),
(22, '2021_02_26_230926_create_sheets_table', 1),
(23, '2021_02_26_231016_create_months_table', 1),
(24, '2021_02_26_231037_create_contacts_table', 1),
(25, '2021_02_26_231338_create_sms_templetes_table', 1),
(26, '2021_02_26_231419_create_sms_histroys_table', 1),
(27, '2021_02_26_234050_create_subjects_table', 1),
(28, '2021_02_27_090246_create_years_table', 1),
(29, '2021_02_28_120059_create_question_types_table', 1),
(30, '2021_02_28_120136_create_exam_types_table', 1),
(31, '2021_02_28_120204_create_board_question_types_table', 1),
(32, '2021_04_05_105003_create_modules_table', 1),
(33, '2021_04_05_105028_create_fee_categories_table', 1),
(34, '2021_04_05_105057_create_fee_settings_table', 1),
(35, '2021_04_05_105125_create_waiver_typies_table', 1),
(36, '2021_04_05_105126_create_waivers_table', 1),
(37, '2021_04_05_105450_create_activism_modules_table', 1),
(38, '2021_04_05_105518_create_payment_methods_table', 1),
(39, '2021_04_05_105536_create_banks_table', 1),
(40, '2021_04_05_105548_create_accounts_table', 1),
(41, '2021_04_05_105626_create_fee_collection_main_table', 1),
(42, '2021_04_05_105627_create_fee_collections_table', 1),
(43, '2021_04_11_133644_create_absent_month_table', 1),
(44, '2021_04_17_175735_create_web_settings_table', 1),
(45, '2021_04_17_181803_create_social_media_table', 1),
(46, '2021_04_25_122950_create_attendances_table', 1),
(47, '2021_04_25_124159_create_attendance_details_table', 1),
(48, '2021_04_26_212306_create_written_questions_table', 1),
(49, '2021_05_02_115504_create_fee_action_typies_table', 1),
(50, '2021_05_13_175115_create_mcq_question_subjects_table', 1),
(51, '2021_05_13_175130_create_mcq_questions_table', 1),
(52, '2021_05_13_175148_create_mcq_question_options_table', 1),
(53, '2021_05_17_203603_create_mcq_exam_settings_table', 1),
(54, '2021_05_17_204214_create_mcq_exam_student_ans_summaries_table', 1),
(55, '2021_05_17_204233_create_mcq_exam_student_answers_table', 1),
(56, '2021_05_23_170903_create_fee_category_typies_table', 1),
(57, '2021_05_23_171158_create_batch_typies_table', 1),
(58, '2021_05_23_171443_create_pay_times_table', 1),
(59, '2021_05_23_171527_create_fee_amount_settings_table', 1),
(60, '2021_05_23_171609_create_payment_histories_table', 1),
(61, '2021_05_29_115828_create_student_question_settings_table', 1),
(62, '2021_05_29_132153_create_exam_settings_table', 1),
(63, '2021_06_07_142621_create_blog_categories_table', 1),
(64, '2021_06_15_140226_create_sheet_settings_table', 1),
(65, '2021_06_15_140557_create_student_sheet_settings_table', 1),
(66, '2021_06_15_174443_create_sheet_typies_table', 1),
(67, '2021_06_26_225428_create_jobs_table', 1),
(68, '2021_07_09_202149_create_chapters_table', 1),
(69, '2021_11_15_104801_create_permission_tables', 1),
(70, '2021_12_01_122817_create_old_school_sessions_table', 1),
(71, '2021_12_01_133542_create_old_schools_table', 1),
(72, '2021_12_01_142059_create_old_school_classes_table', 1),
(73, '2021_12_01_144853_create_old_school_subjects_table', 1),
(74, '2021_12_01_150227_create_old_school_questions_table', 1),
(75, '2021_12_04_145841_create_old_question_boards_table', 1),
(76, '2021_12_04_145926_create_old_question_years_table', 1),
(77, '2021_12_04_150001_create_old_question_subjects_table', 1),
(78, '2021_12_05_112826_create_old_board_questions_table', 1),
(79, '2021_12_07_125120_create_home_works_table', 2),
(80, '2021_12_07_125204_create_home_work_details_table', 2),
(81, '2021_12_07_132347_create_result_groups_table', 3),
(82, '2021_12_07_152043_create_abouts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 2),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 1),
(3, 'App\\User', 2),
(4, 'App\\User', 1),
(4, 'App\\User', 2),
(5, 'App\\User', 1),
(5, 'App\\User', 2),
(6, 'App\\User', 1),
(6, 'App\\User', 2),
(7, 'App\\User', 1),
(7, 'App\\User', 2),
(8, 'App\\User', 1),
(8, 'App\\User', 2),
(9, 'App\\User', 1),
(9, 'App\\User', 2),
(10, 'App\\User', 1),
(10, 'App\\User', 2),
(11, 'App\\User', 1),
(11, 'App\\User', 2),
(12, 'App\\User', 1),
(12, 'App\\User', 2),
(13, 'App\\User', 1),
(13, 'App\\User', 2),
(14, 'App\\User', 1),
(14, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'January ', NULL, NULL),
(2, 'February ', NULL, NULL),
(3, 'March', NULL, NULL),
(4, 'April', NULL, NULL),
(5, 'May', NULL, NULL),
(6, 'June', NULL, NULL),
(7, 'July', NULL, NULL),
(8, 'August ', NULL, NULL),
(9, 'September', NULL, NULL),
(10, 'October', NULL, NULL),
(11, 'November ', NULL, NULL),
(12, 'December', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noticesfile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `slug`, `publish_date`, `noticesfile`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'New Batch start Form January 2022', 'New Batch start Form January 2022', '2021-12-07 17:07:05', 'public/images/notices/61af405982e70.pdf', 1, 1, '2021-12-07 11:07:05', '2021-12-07 11:07:05'),
(2, 'VNS School New Batch Start January 2022', 'VNS School New Batch Start January 2022', '2021-12-07 17:07:31', 'public/images/notices/61af4073da482.png', 1, 1, '2021-12-07 11:07:31', '2021-12-07 11:07:31'),
(3, '08-12-2021 All class postponed For personal Reason', '08-12-2021 All class postponed For personal Reason', '2021-12-07 17:08:13', 'public/images/notices/61af409d52a37.jpg', 1, 1, '2021-12-07 11:08:13', '2021-12-07 11:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `old_board_questions`
--

CREATE TABLE `old_board_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_board_questions`
--

INSERT INTO `old_board_questions` (`id`, `subject_id`, `name`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'bangla', 'public/media/images/old_questions\\bangla61af12b7f1ea6.pdf', 1, '2021-12-07 07:52:23', '2021-12-07 07:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `old_question_boards`
--

CREATE TABLE `old_question_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_question_boards`
--

INSERT INTO `old_question_boards` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dinajpur', 1, '2021-12-07 07:51:47', '2021-12-07 07:55:27'),
(2, 'Jessore', 1, '2021-12-07 07:55:34', '2021-12-07 07:55:34'),
(3, 'Dhaka', 1, '2021-12-07 07:55:39', '2021-12-07 07:55:39'),
(4, 'Sylhet', 1, '2021-12-07 07:55:48', '2021-12-07 07:55:48'),
(5, 'Mymensingh', 1, '2021-12-07 07:55:57', '2021-12-07 07:55:57'),
(6, 'Barisal', 1, '2021-12-07 07:56:06', '2021-12-07 07:56:06'),
(7, 'Khulna', 1, '2021-12-07 07:56:20', '2021-12-07 07:56:20'),
(8, 'Rajshahi', 1, '2021-12-07 07:56:31', '2021-12-07 07:56:31'),
(9, 'Technical', 1, '2021-12-07 07:56:40', '2021-12-07 07:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `old_question_subjects`
--

CREATE TABLE `old_question_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_question_subjects`
--

INSERT INTO `old_question_subjects` (`id`, `year_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', 1, '2021-12-07 07:52:06', '2021-12-07 07:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `old_question_years`
--

CREATE TABLE `old_question_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_question_years`
--

INSERT INTO `old_question_years` (`id`, `board_id`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2000', 1, '2021-12-07 07:51:54', '2021-12-07 07:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `old_schools`
--

CREATE TABLE `old_schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_schools`
--

INSERT INTO `old_schools` (`id`, `institute`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kalmegh High School', 'school', 1, '2021-12-07 07:35:23', '2021-12-07 07:35:23'),
(2, 'Baliadangi Pilot High School', 'school', 1, '2021-12-07 07:35:45', '2021-12-07 07:35:45'),
(3, 'Samiruddin College', 'college', 1, '2021-12-07 07:35:55', '2021-12-07 07:35:55'),
(4, 'Lahiri Degree College', 'college', 1, '2021-12-07 07:36:08', '2021-12-07 07:36:08'),
(5, 'Thakurgaon High School', 'school', 1, '2021-12-07 07:53:07', '2021-12-07 07:53:07'),
(6, 'Thakurgaon girls High School', 'school', 1, '2021-12-07 07:53:16', '2021-12-07 07:53:16'),
(7, 'Thakurgaon College', 'college', 1, '2021-12-07 07:53:28', '2021-12-07 07:53:28'),
(8, 'Panchagor College', 'college', 1, '2021-12-07 07:53:39', '2021-12-07 07:53:39'),
(9, 'Dinajpur High School', 'school', 1, '2021-12-07 07:53:57', '2021-12-07 07:53:57'),
(10, 'Rangpur High School', 'school', 1, '2021-12-07 07:54:09', '2021-12-07 07:54:09'),
(11, 'Bogura High School', 'school', 1, '2021-12-07 07:54:19', '2021-12-07 07:54:19'),
(12, 'Dinajpur Govt College', 'college', 1, '2021-12-07 07:54:38', '2021-12-07 07:54:38'),
(13, 'Rangpur College', 'college', 1, '2021-12-07 07:54:56', '2021-12-07 07:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `old_school_classes`
--

CREATE TABLE `old_school_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_school_classes`
--

INSERT INTO `old_school_classes` (`id`, `session_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 1, '2021-12-07 07:49:54', '2021-12-07 07:49:54'),
(2, 1, '2', 1, '2021-12-07 07:50:00', '2021-12-07 07:50:00'),
(3, 1, '3', 1, '2021-12-07 07:50:05', '2021-12-07 07:50:05'),
(4, 1, '4', 1, '2021-12-07 07:50:10', '2021-12-07 07:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `old_school_questions`
--

CREATE TABLE `old_school_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_school_questions`
--

INSERT INTO `old_school_questions` (`id`, `subject_id`, `name`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla First Paper', 'public/media/images/old_questions\\bangla first paper61af125bf3491.pdf', 1, '2021-12-07 07:50:51', '2021-12-07 07:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `old_school_sessions`
--

CREATE TABLE `old_school_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_school_sessions`
--

INSERT INTO `old_school_sessions` (`id`, `school_id`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2001', 1, '2021-12-07 07:36:51', '2021-12-07 07:36:51'),
(2, 1, '2002', 1, '2021-12-07 07:36:56', '2021-12-07 07:36:56'),
(3, 1, '2003', 1, '2021-12-07 07:37:01', '2021-12-07 07:37:01'),
(4, 1, '2004', 1, '2021-12-07 07:37:06', '2021-12-07 07:37:06'),
(5, 1, '2005', 1, '2021-12-07 07:37:12', '2021-12-07 07:37:12'),
(6, 1, '2006', 1, '2021-12-07 07:37:17', '2021-12-07 07:37:17'),
(7, 2, '2008', 1, '2021-12-07 07:39:21', '2021-12-07 07:39:21'),
(8, 2, '2009', 1, '2021-12-07 07:39:27', '2021-12-07 07:39:27'),
(9, 2, '2010', 1, '2021-12-07 07:39:51', '2021-12-07 07:39:51'),
(10, 3, '2010', 1, '2021-12-07 07:40:45', '2021-12-07 07:40:45'),
(11, 3, '2011', 1, '2021-12-07 07:40:50', '2021-12-07 07:40:50'),
(12, 3, '2012', 1, '2021-12-07 07:40:55', '2021-12-07 07:40:55'),
(13, 3, '2013', 1, '2021-12-07 07:41:00', '2021-12-07 07:41:00'),
(14, 3, '2014', 1, '2021-12-07 07:41:04', '2021-12-07 07:41:04'),
(15, 4, '2001', 1, '2021-12-07 07:42:23', '2021-12-07 07:42:23'),
(16, 4, '2002', 1, '2021-12-07 07:42:30', '2021-12-07 07:42:30'),
(17, 4, '2003', 1, '2021-12-07 07:42:36', '2021-12-07 07:42:36'),
(18, 4, '2004', 1, '2021-12-07 07:42:41', '2021-12-07 07:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `old_school_subjects`
--

CREATE TABLE `old_school_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_school_subjects`
--

INSERT INTO `old_school_subjects` (`id`, `class_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', 1, '2021-12-07 07:50:21', '2021-12-07 07:50:21'),
(2, 1, 'English', 1, '2021-12-07 07:50:28', '2021-12-07 07:50:28'),
(3, 1, 'Mathematics', 1, '2021-12-07 07:50:34', '2021-12-07 07:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `fee_amount_setting_id` int(11) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `student_waiver_id` int(11) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` datetime NOT NULL,
  `receive_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `invoice_no`, `reference_no`, `fee_cat_id`, `origin_id`, `fee_amount_setting_id`, `amount`, `user_id`, `student_id`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `student_waiver_id`, `payment_method_id`, `account_id`, `transaction_id`, `receive_date`, `receive_by`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '001', 'MF2021P', 2, 1, 2, '2000.00', 6, 14, 1, 1, 6, 1, NULL, NULL, NULL, NULL, '2021-12-06 05:43:02', 1, 1, NULL, 1, NULL, '2021-12-06 11:43:02', '2021-12-06 11:43:02'),
(3, '003', 'MCQ2021P', 4, 1, 3, '500.00', 6, 14, 1, 1, 6, 1, NULL, NULL, NULL, NULL, '2021-12-06 05:56:49', 1, 1, NULL, 1, NULL, '2021-12-06 11:56:49', '2021-12-06 11:56:49'),
(5, '005', 'MF2021P', 2, 3, 2, '2000.00', 6, 14, 1, 1, 6, 1, NULL, 2, NULL, '84578555', '2021-12-07 11:08:05', 1, 1, NULL, 1, NULL, '2021-12-07 05:08:05', '2021-12-07 05:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_verified` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method`, `status`, `is_active`, `is_verified`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 'Bkash', 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admission Fees', 1, NULL, NULL),
(2, 'Exam Fees', 1, NULL, NULL),
(3, 'Monthly Fees', 1, NULL, NULL),
(4, 'Quiz Fees', 1, NULL, NULL),
(5, 'Sheet Fees', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pay_times`
--

CREATE TABLE `pay_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_times`
--

INSERT INTO `pay_times` (`id`, `name`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'One Time', NULL, NULL, 1, NULL, NULL, NULL),
(2, 'More Times', NULL, NULL, 1, NULL, NULL, NULL),
(3, 'Never Pay', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'student setting', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(2, 'student management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(3, 'waiver management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(4, 'attendance', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(5, 'home work', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(6, 'fee management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(7, 'payment management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(8, 'mcq qustions', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(9, 'written qustions', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(10, 'result management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(11, 'old questions', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(12, 'sheet management', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(13, 'sms settting', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24'),
(14, 'website settting', 'web', '2021-11-14 11:13:24', '2021-11-14 11:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_groups`
--

CREATE TABLE `result_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `mcq_exam_setting_id` int(11) DEFAULT NULL,
  `mcq_exam_total_mark` int(11) DEFAULT NULL,
  `written_exam_setting_id` int(11) DEFAULT NULL,
  `written_exam_total_mark` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result_groups`
--

INSERT INTO `result_groups` (`id`, `name`, `class_id`, `session_id`, `batch_setting_id`, `mcq_exam_setting_id`, `mcq_exam_total_mark`, `written_exam_setting_id`, `written_exam_total_mark`, `created_at`, `updated_at`) VALUES
(1, 'Six Class Exam', 6, 1, 1, 2, 1, 4, 10, '2021-12-07 07:26:42', '2021-12-07 07:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', NULL, NULL),
(2, 'Stuff', '', NULL, NULL),
(3, '', 'Student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, '2021-12-06 09:36:24', '2021-12-06 09:36:24'),
(2, 'B', 1, '2021-12-06 09:36:28', '2021-12-06 09:36:28'),
(3, 'C', 1, '2021-12-06 09:36:32', '2021-12-06 09:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessiones`
--

CREATE TABLE `sessiones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessiones`
--

INSERT INTO `sessiones` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022', 1, '2021-12-06 09:36:15', '2021-12-06 09:36:15'),
(2, '2023', 1, '2021-12-06 10:36:05', '2021-12-06 10:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE `sheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sheet_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `topic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sheet_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sheet_type_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sheets`
--

INSERT INTO `sheets` (`id`, `sheet_no`, `subject_id`, `class_id`, `session_id`, `chapter_id`, `topic`, `sheet_file`, `thumbnail`, `description`, `sheet_type_id`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'গুচ্ছ মডেল টেস্ট (মানবিক )', 1, 6, 1, 1, 'গুচ্ছ মডেল টেস্ট (মানবিক )', 'public/uploads/sheets/bangla first paper61af125bf3491 (1)_61b0958114140.pdf', 'public/uploads/sheets/combined-model-test-min_thumbnail_61b097d3c0837.jpg', '<p>দেশের ২০টি পাবলিক (সাধারন এবং বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়) (জিএসটি) সমন্বিত ভর্তি পরীক্ষার জন্য সিদ্ধান্ত গ্রহন করেছে। সমন্বিত ভর্তি পরীক্ষায় সাফল্য অর্জনের জন্য আপনার প্রয়োজন পূর্নাঙ্গ প্রস্তুতি । তাই স্বল্প সময়ে আপনার ভর্তি প্রস্তুতিকে আরো শানিত করতে BacBon School আয়োজন করেছে মডেল টেস্ট প্রোগ্রাম।</p><p><br></p><p><b>এই মডেল টেস্ট’টি মূলত কাদের জন্য?</b></p><p><br></p><p>গুচ্ছ ভর্তি পরীক্ষার প্রশ্নের আদলে যারা পূর্ণাঙ্গ মডেল টেস্ট চাও।</p><p>যারা হাজারো প্রতিযোগীর মধ্যে নিজের অবস্থান যাচাই করতে চাও।</p><p>যেকোন সময় পরীক্ষা দিয়ে সাথে সাথে ফলাফল পেতে চাও যারা ।</p><p>অল্প সময়ে প্রস্তুতি নিয়ে আসন্ন গুচ্ছ ভর্তি প্রতিযোগীতায় ভালো করতে চাও যারা ।</p><p>অভিজ্ঞ শিক্ষক, যাদের হাত ধরে শত শত ছাত্র-ছাত্রী বুয়েট-মেডিকেল-বিশ্ববিদ্যালয়ে আছে, তাদের দ্বারাই প্রস্তুতকৃত মডেল টেস্টে অংশগ্রহণ করতে চাও যারা ।</p><p><b>এই মডেল টেস্ট কী কাজ আসবে?</b></p><p><br></p><p>গুচ্ছ ভর্তি পরীক্ষা যেহেতু এবারই প্রথম, আর তাই আমাদের এই পূর্ণাঙ্গ মডেল টেস্টের মাধ্যমে পরীক্ষার মানবণ্টন, সময়, প্রশ্নের ধরণ এসব কিছু সম্পর্কে সঠিক ধারণা অর্জন করা যাবে।</p><p>প্রতিটি MCQ-এর ব্যাখ্যাসহ সমাধান এবং নিজের র্দূর্বলতা সম্পর্কে ধারণা লাভ করা যাবে।</p><p><b>আমাদের এই মডেল টেস্ট তোমাকে কীভাবে প্রস্তুত করবে?</b></p><p><br></p><p>কোর্সটিতে রয়েছে পূর্ণাঙ্গ মডেল টেস্ট, যা শুধু তোমাদের অনুশীলনের জন্যেই নয়; বরং এই নতুন প্যাটার্নে তোমাদের গাইডলাইন দেয়ার জন্য যা তোমাকে মানসিকভাবে গুচ্ছ পদ্ধতির ভর্তি পরীক্ষার্থী হিসেবে গড়ে তুলবে।</p><p>ভর্তি পরীক্ষার প্রস্ততির জন্য অনুশীলনীর কোন বিকল্প নেই। তাই মডেল টেস্টে অংশগ্রহণের মাধ্যমে তুমি আরও দক্ষ হয়ে উঠবে।</p>', NULL, 1, NULL, 1, NULL, '2021-12-08 11:22:41', '2021-12-08 11:35:10'),
(2, 'English Grammar Crash Course', 1, 6, 1, NULL, 'English Grammar Crash Course', 'public/uploads/sheets/bangla first paper61af125bf3491 (1)_61b0985ddaff5.pdf', 'public/uploads/sheets/images_skills_jpeg_English-Grammar-Crash-Course---Title-Thumbnail_thumbnail_61b0985ddb41c.jpg', '<p>কোর্স সম্পর্কে</p><p>সবচেয়ে বেসিক গ্রামার নিয়মগুলোও নিয়েও কিন্তু আমরা অনেকসময় কনফিউজড হয়ে যাই যখন ইংরেজি গ্রামার ঠিক রেখে বাক্য তৈরির চেষ্টা করতে হয় আমাদের। স্কুল জীবনে আমাদের অনেক জটিল গ্রামার নিয়ম শেখানো হয় কিন্তু আমরা যখন বুঝতে পারি যে ইংরেজি গ্রামার আসলেই কীভাবে কাজ করে তখন এই জটিল নিয়মগুলো আমাদের কোন কাজেই আসেনা। আপনিও যদি পুরানো স্কুল জীবনের গ্রামার- এর নিয়মগুলো মুখস্থ করতে করতে ক্লান্ত হয়ে যান, তাহলে এই কোর্সটি আপনার জন্যই!</p><p><br></p><p>গ্রামারের নিয়মগুলো মুখস্থের চেয়ে বাস্তব পরিস্থিতি এর মাধ্যমে ইংরেজি শেখা আরও বেশি কার্যকর। কিন্তু দুর্ভাগ্যবশত আমাদের পাঠ্যক্রম এমনভাবে তৈরি যা আমাদের মধ্যে ইংরেজি গ্রামারের ভয়কে আরও গভীরভাবে গেথে ফেলেছে এবং এর ফলে আমরা ইংরেজিতে ভালো হতে পারি না। এই ভয় পরবর্তীতে আমাদের বিশ্ববিদ্যালয় ভর্তি পরীক্ষা, বিসিএস প্রস্তুতি, চাকরি নিয়োগ, এমনকি আমাদের বিদেশে পড়াশোনার ক্ষেত্রেও আমাদের ভালো করায় বাঁধার কারণ হচ্ছে। আপনিও নিশ্চয়ই এই ভয়ের জায়গাটি থেকে কি বেরিয়ে আসতে চান, তাইনা?</p><p><br></p><p>এখনই সময় এই ইংরেজি গ্রামার শেখার উপায়টি পরিবর্তন করার! তাই গতানুগতিক গ্রামার শেখার পদ্ধতি থেকে বেরিয়ে আসতে আপনাকে সাহায্য করার জন্য, টেন মিনিট স্কুল নিয়ে এসেছে \"English Grammar Crash Course\"! এই কোর্স- এ আপনি Noun, Pronoun, Articles, Verbs, Gerunds, Tense- এর মতো গ্রামারের বেসিক বিষয়গুলি থেকে শুরু করে Prepositions, Changing sentences, Modifiers, Connectors ইত্যাদির মতো জটিল বিষয়গুলোও শিখবেন।</p><p><br></p><p>আপনার কোর্স ইন্সট্রাক্টর, সাকিব বিন রশিদ, একজন অভিজ্ঞ শিক্ষক যিনি আপনাকে ইংরেজি গ্রামারের বেসিক বিষয়গুলি বুঝতে এবং গ্রামারের কমন ভুলগুলোকে কীভাবে এড়িয়ে চলবেন তা শেখাবেন।</p><p><br></p><p>মুখস্থ করে গ্রামার শেখার দিনগুলোকে বিদায় জানাতে এখনই Enroll করুন কোর্সটিতে!</p><p><br></p><p>কোর্সটি কাদের জন্য?</p><p>যারা দীর্ঘদিন ধরে ইংরেজি গ্রামার- এর নিয়ম মুখস্থ করে আসছে কিন্তু তারপরও ইংরেজিতে ভালো করতে পারছে না।</p><p>বিশ্ববিদ্যালয়ে ভর্তি পরিক্ষার্থী যারা ইংরেজিতে ভালো করতে চায়।</p><p>যারা ইংরেজি গ্রামারের বেসিকস গুলো আবার নতুনভাবে শিখতে চায় ভালোভাবে শিক্ষকতা করার জন্য় কিংবা সাধারণভাবেই ইংরেজিতে ভালো করার জন্য।</p><p>যারা বিসিএস বা যেকোনো চাকরির পরীক্ষার জন্য প্রস্তুতি নিতে চায়।</p><p>যারা ইংরেজি পরীক্ষায় আরও ভালো নম্বর পেতে চায়।</p><p>কোর্সটি থেকে আপনি কী কী শিখবেন?</p><p>Subject-verb agreement, practical uses of Nouns, Pronouns, Articles, Verbs, Adverbs, Adjectives, Gerunds, Tenses, Prepositions, Modals ইত্যাদি।</p><p>Changing sentences into simple, complex, and compound forms, usage of modifiers, tag questions, changing voice, conditional sentences ইত্যাদি।</p><p>আমাদের দৈনন্দিন জীবনে করা কমন কিছু গ্রামার- এর ভুল কীভাবে এড়ানো যায়।</p><p>বেসিক থেকে শুরু করে অ্যাডভান্সড অ্যাপ্লিকেশন পর্যন্ত, ইংরেজী গ্রামারে ভালো করতে যে টপিকগুলো প্র‍য়োজন।</p><p>এই কোর্সের বৈশিষ্ট্যগুলো কী কী?</p><p>সূত্রের মতো গ্রামার নিয়মগুলি মুখস্থ করে নয় বরং এই কোর্সটিতে আপনাকে বাস্তব উদাহরণ এর মাধ্যমে ইংরেজি গ্রামার শেখানো হবে। আমাদের কোর্স ম্যাটারিয়ালস এর সাহায্যে আপনি গ্রামার- এর নিয়মগুলো মুখস্থ করা ছাড়াই বাস্তব জীবনে প্রয়োগের মাধ্যমে একদম সহজে শিখতে পারবেন।</p><p>বেসিক থেকে শুরু করে অ্যাডভান্স গ্রামার পর্যন্ত, সবই আছে কোর্সটিতে।</p><p>আপনাকে আরও ভালোভাবে বুঝতে সাহায্য করার জন্য রয়েছে ১০০টি ভিডিও, ১০০টি কুইজ এবং ১০০টি নোট, সাথে একটি অডিওবুক।</p>', NULL, 1, NULL, 1, NULL, '2021-12-08 11:34:53', '2021-12-08 11:46:26'),
(3, 'সবার জন্য Vocabulary', 1, 6, 1, 1, 'সবার জন্য Vocabulary', 'public/uploads/sheets/bangla first paper61af125bf3491 (1)_61b099062eb3d.pdf', 'public/uploads/sheets/Shobar-Jonno-Vocanulary-Course---Title-Thumbnail_thumbnail_61b099062f033.jpg', '<p>কোর্সটির বৈশিষ্ট্যগুলো কী কী?</p><p>প্রতিটি অধ্যায়ের শেষে ৬০টি সেটের ফ্ল্যাশকার্ড যা আপনার নতুন শব্দ মনে রাখাকে আরো শক্ত করবে।</p><p>এই কোর্সে আছে নতুন শব্দের অর্থসহ ব্যবহার যা আপনার যেকোনো জায়গায় আপনার কথা বলার দক্ষতা বৃদ্ধি করবে।</p><p>এই কোর্সের ইন্সট্রাক্টর মুনজেরিন শহীদ যিনি ইংরেজিতে তাঁর সেকেন্ড পোস্ট গ্র্যাজুয়েট সম্পন্ন করেছেন অক্সফোর্ড বিশ্ববিদ্যালয় থেকে।</p><p>কোর্সটি সম্পর্কে</p><p>আপনার ইংরেজি ভোকাবুলারি ভালো না হওয়া নিয়ে কি আপনি চিন্তিত? ডজন ডজন অপরিচিত শব্দ মনে রাখার ভয় কি আপনাকে তাড়া করে বেড়াচ্ছে? আপনাকে সহায়তা করার জন্যই চলে এসেছি আমরা!</p><p><br></p><p>আপনার ইংরেজি ভোকাবুলারির জ্ঞানকে বাড়াতে টেন মিনিট স্কুল নিয়ে এসেছে মুনজেরিন শহীদের “সবার জন্য ভোকাবুলারি” কোর্স। এই কোর্সটি একটি গাইডলাইন হিসেবে কাজ করবে তাঁদের জন্য, যাঁরা প্রতিদিনের ইংরেজি কথাবার্তায় অথবা চাকরীর পরীক্ষাগুলোর ভোকাবুলারিতে নিজেদের একটি শক্ত অবস্থানে দেখতে চান।</p><p><br></p><p>এই কোর্সে মুনজেরিন শহীদ আপনাকে শেখাবেন প্রতিদিনে কোন ইংরেজি শব্দগুলো আপনি ব্যবহার করতে পারবেন এবং তা কোথায় ব্যবহার করতে পারবেন। এই কোর্সের অধ্যায়গুলোর মাধ্যমে আপনি নতুন ইংরেজি শব্দ মনে রাখা শিখতে পারবেন কোনো ঘাম না ঝরিয়েই। প্রতিটি অধ্যায়ের শেষের ফ্ল্যাশকার্ড আপনাকে সাহায্য করবে নতুন শেখা শব্দগুলো মনে রাখার ক্ষেত্রেও!</p><p><br></p><p>কোর্সটি কাদের জন্য?</p><p>যাঁরা নিজেদের ইংরেজি ভোকাবুলারির দক্ষতা বাড়াতে চান</p><p>যেসকল শিক্ষার্থীরা ভর্তি পরীক্ষা, আইইএলটিএস পরীক্ষার ভোকাবুলারি সেকশনে ভালো করতে চান।</p><p>যাঁরা স্পোকেন ইংলিশে্র ক্ষেত্রে আরো নতুন শব্দ ব্যবহার করতে চান।</p><p>কোর্সটি থেকে আপনি কী কী শিখবেন?</p><p>প্রতিদিনের ব্যবহার করা নতুন শব্দ অর্থসহ।</p><p>আপনার কনভার্সেশনের দক্ষতা আরো বাড়ানোর জন্য নতুন শব্দের ব্যবহার।</p><p>চাকরী, শিক্ষা, ভ্রমণ, উৎসব, বিনোদন ইত্যাদির ক্ষেত্রে ব্যবহার করা নতুন ইংরেজি শব্দ।</p>', NULL, 1, NULL, 1, NULL, '2021-12-08 11:37:42', '2021-12-08 11:37:42'),
(4, 'আমার বাংলা বই', 1, 6, 1, 1, 'আমার বাংলা বই', 'public/uploads/sheets/bangla first paper61af125bf3491 (1)_61b099e0c5777.pdf', 'public/uploads/sheets/Bangla_thumbnail_61b099e0c5df7.png', '<p>কোর্সটির বৈশিষ্ট্যগুলো কী কী?</p><p>প্রতিটি অধ্যায়ের শেষে ৬০টি সেটের ফ্ল্যাশকার্ড যা আপনার নতুন শব্দ মনে রাখাকে আরো শক্ত করবে।</p><p>এই কোর্সে আছে নতুন শব্দের অর্থসহ ব্যবহার যা আপনার যেকোনো জায়গায় আপনার কথা বলার দক্ষতা বৃদ্ধি করবে।</p><p>এই কোর্সের ইন্সট্রাক্টর মুনজেরিন শহীদ যিনি ইংরেজিতে তাঁর সেকেন্ড পোস্ট গ্র্যাজুয়েট সম্পন্ন করেছেন অক্সফোর্ড বিশ্ববিদ্যালয় থেকে।</p><p>কোর্সটি সম্পর্কে</p><p>আপনার ইংরেজি ভোকাবুলারি ভালো না হওয়া নিয়ে কি আপনি চিন্তিত? ডজন ডজন অপরিচিত শব্দ মনে রাখার ভয় কি আপনাকে তাড়া করে বেড়াচ্ছে? আপনাকে সহায়তা করার জন্যই চলে এসেছি আমরা!</p><p><br></p><p>আপনার ইংরেজি ভোকাবুলারির জ্ঞানকে বাড়াতে টেন মিনিট স্কুল নিয়ে এসেছে মুনজেরিন শহীদের “সবার জন্য ভোকাবুলারি” কোর্স। এই কোর্সটি একটি গাইডলাইন হিসেবে কাজ করবে তাঁদের জন্য, যাঁরা প্রতিদিনের ইংরেজি কথাবার্তায় অথবা চাকরীর পরীক্ষাগুলোর ভোকাবুলারিতে নিজেদের একটি শক্ত অবস্থানে দেখতে চান।</p><p><br></p><p>এই কোর্সে মুনজেরিন শহীদ আপনাকে শেখাবেন প্রতিদিনে কোন ইংরেজি শব্দগুলো আপনি ব্যবহার করতে পারবেন এবং তা কোথায় ব্যবহার করতে পারবেন। এই কোর্সের অধ্যায়গুলোর মাধ্যমে আপনি নতুন ইংরেজি শব্দ মনে রাখা শিখতে পারবেন কোনো ঘাম না ঝরিয়েই। প্রতিটি অধ্যায়ের শেষের ফ্ল্যাশকার্ড আপনাকে সাহায্য করবে নতুন শেখা শব্দগুলো মনে রাখার ক্ষেত্রেও!</p><p><br></p><p>কোর্সটি কাদের জন্য?</p><p>যাঁরা নিজেদের ইংরেজি ভোকাবুলারির দক্ষতা বাড়াতে চান</p><p>যেসকল শিক্ষার্থীরা ভর্তি পরীক্ষা, আইইএলটিএস পরীক্ষার ভোকাবুলারি সেকশনে ভালো করতে চান।</p><p>যাঁরা স্পোকেন ইংলিশে্র ক্ষেত্রে আরো নতুন শব্দ ব্যবহার করতে চান।</p><p>কোর্সটি থেকে আপনি কী কী শিখবেন?</p><p>প্রতিদিনের ব্যবহার করা নতুন শব্দ অর্থসহ।</p><p>আপনার কনভার্সেশনের দক্ষতা আরো বাড়ানোর জন্য নতুন শব্দের ব্যবহার।</p><p>চাকরী, শিক্ষা, ভ্রমণ, উৎসব, বিনোদন ইত্যাদির ক্ষেত্রে ব্যবহার করা নতুন ইংরেজি শব্দ।</p>', NULL, 1, NULL, 1, NULL, '2021-12-08 11:41:20', '2021-12-08 11:41:20'),
(5, 'English For Today', 1, 6, 1, 1, 'English For Today', 'public/uploads/sheets/bangla first paper61af125bf3491_61b09a3539e01.pdf', 'public/uploads/sheets/English For Today_thumbnail_61b09a353a228.png', '<p>কোর্সটির বৈশিষ্ট্যগুলো কী কী?</p><p>প্রতিটি অধ্যায়ের শেষে ৬০টি সেটের ফ্ল্যাশকার্ড যা আপনার নতুন শব্দ মনে রাখাকে আরো শক্ত করবে।</p><p>এই কোর্সে আছে নতুন শব্দের অর্থসহ ব্যবহার যা আপনার যেকোনো জায়গায় আপনার কথা বলার দক্ষতা বৃদ্ধি করবে।</p><p>এই কোর্সের ইন্সট্রাক্টর মুনজেরিন শহীদ যিনি ইংরেজিতে তাঁর সেকেন্ড পোস্ট গ্র্যাজুয়েট সম্পন্ন করেছেন অক্সফোর্ড বিশ্ববিদ্যালয় থেকে।</p><p>কোর্সটি সম্পর্কে</p><p>আপনার ইংরেজি ভোকাবুলারি ভালো না হওয়া নিয়ে কি আপনি চিন্তিত? ডজন ডজন অপরিচিত শব্দ মনে রাখার ভয় কি আপনাকে তাড়া করে বেড়াচ্ছে? আপনাকে সহায়তা করার জন্যই চলে এসেছি আমরা!</p><p><br></p><p>আপনার ইংরেজি ভোকাবুলারির জ্ঞানকে বাড়াতে টেন মিনিট স্কুল নিয়ে এসেছে মুনজেরিন শহীদের “সবার জন্য ভোকাবুলারি” কোর্স। এই কোর্সটি একটি গাইডলাইন হিসেবে কাজ করবে তাঁদের জন্য, যাঁরা প্রতিদিনের ইংরেজি কথাবার্তায় অথবা চাকরীর পরীক্ষাগুলোর ভোকাবুলারিতে নিজেদের একটি শক্ত অবস্থানে দেখতে চান।</p><p><br></p><p>এই কোর্সে মুনজেরিন শহীদ আপনাকে শেখাবেন প্রতিদিনে কোন ইংরেজি শব্দগুলো আপনি ব্যবহার করতে পারবেন এবং তা কোথায় ব্যবহার করতে পারবেন। এই কোর্সের অধ্যায়গুলোর মাধ্যমে আপনি নতুন ইংরেজি শব্দ মনে রাখা শিখতে পারবেন কোনো ঘাম না ঝরিয়েই। প্রতিটি অধ্যায়ের শেষের ফ্ল্যাশকার্ড আপনাকে সাহায্য করবে নতুন শেখা শব্দগুলো মনে রাখার ক্ষেত্রেও!</p><p><br></p><p>কোর্সটি কাদের জন্য?</p><p>যাঁরা নিজেদের ইংরেজি ভোকাবুলারির দক্ষতা বাড়াতে চান</p><p>যেসকল শিক্ষার্থীরা ভর্তি পরীক্ষা, আইইএলটিএস পরীক্ষার ভোকাবুলারি সেকশনে ভালো করতে চান।</p><p>যাঁরা স্পোকেন ইংলিশে্র ক্ষেত্রে আরো নতুন শব্দ ব্যবহার করতে চান।</p><p>কোর্সটি থেকে আপনি কী কী শিখবেন?</p><p>প্রতিদিনের ব্যবহার করা নতুন শব্দ অর্থসহ।</p><p>আপনার কনভার্সেশনের দক্ষতা আরো বাড়ানোর জন্য নতুন শব্দের ব্যবহার।</p><p>চাকরী, শিক্ষা, ভ্রমণ, উৎসব, বিনোদন ইত্যাদির ক্ষেত্রে ব্যবহার করা নতুন ইংরেজি শব্দ।</p>', NULL, 1, NULL, 1, NULL, '2021-12-08 11:42:45', '2021-12-08 11:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `sheet_settings`
--

CREATE TABLE `sheet_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `sheet_type_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `sheet_id` int(11) DEFAULT NULL,
  `publish_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taken_by` int(11) DEFAULT NULL,
  `publish_by` int(11) DEFAULT NULL,
  `download_times` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sheet_settings`
--

INSERT INTO `sheet_settings` (`id`, `fee_cat_id`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `sheet_type_id`, `subject_id`, `sheet_id`, `publish_date`, `taken_by`, `publish_by`, `download_times`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 6, 1, NULL, 1, 1, '2021-12-08', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-08 11:46:01', '2021-12-08 11:46:01'),
(2, 6, 1, 1, 6, 1, NULL, 1, 2, '2021-12-08', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-08 11:46:49', '2021-12-08 11:46:49'),
(3, 6, 3, 1, 6, 1, NULL, 1, 3, '2021-12-08', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-08 11:47:11', '2021-12-08 11:47:11'),
(4, 6, 3, 1, 6, 1, NULL, 1, 4, '2021-12-08', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-08 11:47:32', '2021-12-08 11:47:32'),
(5, 6, 1, 1, 6, 1, NULL, 1, 5, '2021-12-08', 1, 1, NULL, 1, NULL, 1, NULL, '2021-12-08 11:47:54', '2021-12-08 11:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `sheet_typies`
--

CREATE TABLE `sheet_typies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'public/images/sliders/61af351ac0d66.jpg', NULL, 1, '2021-12-07 10:19:06', '2021-12-07 10:19:06'),
(2, NULL, 'public/images/sliders/61af3521bf22c.jpg', NULL, 1, '2021-12-07 10:19:13', '2021-12-07 10:19:13'),
(3, NULL, 'public/images/sliders/61af352876c17.jpg', NULL, 1, '2021-12-07 10:19:20', '2021-12-07 10:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `sms_histroys`
--

CREATE TABLE `sms_histroys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_admin` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_histroys`
--

INSERT INTO `sms_histroys` (`id`, `user_id`, `student_id`, `message`, `status`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 6, 5, 'Congratulations!\n            You have successfully completed your enrolment.\n            AQ English Grammar School', 1, NULL, '2021-12-06 10:16:19', '2021-12-06 10:16:19'),
(2, 6, 14, 'Dear Guardian,\r\nYour son\'s/daughter\'s:Md Abu Taleb,ID No.:20220002, (Six Batch 01) \'Monthly Tuition Fee\' of January  2021 has been Paid.\r\nRegards\r\n#AQ English Grammar School.', 1, NULL, '2021-12-06 11:43:03', '2021-12-06 11:43:03'),
(3, 6, 14, 'Dear Guardian,\nYour son\'s/daughter\'s:Md Abu Taleb,ID No.:20220002, (Six Batch 01) \'Monthly Tuition Fee\' of February  2021 has been Paid.\nRegards\n#AQ English Grammar School.', 1, NULL, '2021-12-07 05:00:53', '2021-12-07 05:00:53'),
(4, 6, 14, 'Dear Guardian,\nYour son\'s/daughter\'s:Md Abu Taleb,ID No.:20220002, (Six Batch 01) \'Others Fee\' 2022 has been Paid.\nRegards\n#AQ English Grammar School.', 1, NULL, '2021-12-07 05:48:44', '2021-12-07 05:48:44'),
(5, 6, 14, 'Dear Guardian,\nYour son\'s/daughter\'s: Md Abu Taleb,ID No.20220002,(Six Batch 01) \'Monthly Tuition Fee\' of February  2021 still remains unpaid.\nRegards # NS Edu Zone.', 1, NULL, '2021-12-07 05:55:32', '2021-12-07 05:55:32'),
(6, 6, 14, 'Dear Guardian,\nYour son\'s/daughter\'s: Md Abu Taleb,ID No.20220002,(Six Batch 01) \'Monthly Tuition Fee\' of June 2021 still remains unpaid.\nRegards #AQ English Grammar School.', 1, NULL, '2021-12-07 05:58:28', '2021-12-07 05:58:28'),
(7, 6, 14, 'Respected Guardian,\r\nYour son/daughter : ( Md Abu Taleb, ID No.:20220002) was absent from today\'s ( 07-12-2021 ) class.\r\n\r\n#AQ English Grammar School.', 1, NULL, '2021-12-07 07:00:09', '2021-12-07 07:00:09'),
(8, 6, 14, 'Honourable Guardian\n\nObtained marks of your child on Six Class Exam of chapter Chapter 01 ( Biology ) are-\n\nCQ: 10 /10\nMCQ: 0 /1;\nTotal: 10 out of 11\n\n#ABCBioScience.', 1, NULL, '2021-12-07 07:28:47', '2021-12-07 07:28:47'),
(9, 6, 14, 'Honourable Guardian\n\nObtained marks of your child on Six Class Exam of chapter Chapter 01 ( Biology ) are-\n\nCQ: 10 /10\nMCQ: 0 /1;\nTotal: 10 out of 11\n\n#AQ English Grammar School.', 1, NULL, '2021-12-07 07:30:38', '2021-12-07 07:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `sms_templetes`
--

CREATE TABLE `sms_templetes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `roll` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_type_id` int(11) DEFAULT NULL,
  `start_month_id` tinyint(4) DEFAULT NULL,
  `activate_status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `school_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `class_id`, `session_id`, `section_id`, `batch_setting_id`, `batch_type_id`, `roll`, `admission_date`, `student_type_id`, `start_month_id`, `activate_status`, `created_by`, `status`, `school_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(14, 6, 6, 1, NULL, 1, 1, NULL, '2021-12-06', 1, 1, 1, NULL, 1, 'Thakurgaon Govt High School', NULL, '2021-12-06 11:07:43', '2021-12-06 11:42:34'),
(16, 6, 6, 1, NULL, 3, 1, NULL, '2021-12-06', 1, 1, 1, NULL, 1, 'Thakurgaon Govt High School', NULL, '2021-12-06 11:39:59', '2021-12-06 11:39:59'),
(17, 6, 7, 2, NULL, 2, 1, NULL, '2021-12-06', 1, 1, 1, NULL, 1, 'Thakurgaon Govt High School', NULL, '2021-12-06 11:41:03', '2021-12-06 11:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `student_infos`
--

CREATE TABLE `student_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `own_mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bkash_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_infos`
--

INSERT INTO `student_infos` (`id`, `user_id`, `father`, `mother`, `guardian_mobile`, `own_mobile`, `email`, `bkash_number`, `whatsapp_number`, `facebook_id`, `address`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(5, '6', NULL, NULL, '01779325718', NULL, 'abutalebgmtt@gmail.com', NULL, NULL, NULL, 'Dhaka', NULL, 1, '2021-12-06 10:16:18', '2021-12-06 10:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `student_question_settings`
--

CREATE TABLE `student_question_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `exam_setting_id` int(11) DEFAULT NULL,
  `fee_amount_setting_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `exam_capability` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_question_settings`
--

INSERT INTO `student_question_settings` (`id`, `student_id`, `batch_setting_id`, `batch_type_id`, `fee_cat_id`, `origin_id`, `exam_setting_id`, `fee_amount_setting_id`, `class_id`, `session_id`, `exam_capability`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 14, 1, 1, 4, 2, 2, 4, 6, 1, 1, 1, NULL, NULL, NULL, '2021-12-07 06:47:44', '2021-12-07 06:47:44'),
(4, 14, 1, 1, 5, 4, 4, 6, 6, 1, 1, 1, NULL, NULL, NULL, '2021-12-07 07:10:50', '2021-12-07 07:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `student_sheet_settings`
--

CREATE TABLE `student_sheet_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `sheet_id` int(11) DEFAULT NULL,
  `sheet_type_id` int(11) DEFAULT NULL,
  `sheet_setting_id` int(11) DEFAULT NULL,
  `fee_amount_setting_id` int(11) DEFAULT NULL,
  `download_capability` tinyint(4) DEFAULT NULL,
  `download_count` int(11) DEFAULT NULL,
  `download_time` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_types`
--

CREATE TABLE `student_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_types`
--

INSERT INTO `student_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Offline', 1, '2021-12-05 18:00:00', '2021-12-05 18:00:00'),
(2, 'Online', 1, '2021-12-05 18:00:00', '2021-12-05 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_waivers`
--

CREATE TABLE `student_waivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `waiver_id` int(11) DEFAULT NULL,
  `fee_cat_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `waiver_type_id` tinyint(4) DEFAULT NULL,
  `waiver_value` decimal(8,2) DEFAULT NULL,
  `waiver_amount` decimal(5,2) DEFAULT NULL,
  `fee_amount_setting_id` int(11) DEFAULT NULL,
  `fee_amount_setting` decimal(5,2) DEFAULT NULL,
  `start_month_id` tinyint(4) DEFAULT NULL,
  `end_month_id` tinyint(4) DEFAULT NULL,
  `activate_status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `fee_setting_amount` decimal(5,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', '1', '2021-12-06 09:41:24', '2021-12-06 09:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `useruid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `roll` int(11) DEFAULT NULL,
  `school_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_type_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useruid`, `name`, `mobile`, `email`, `otp`, `email_verified_at`, `password`, `remember_token`, `image`, `role_id`, `class_id`, `section_id`, `shift_id`, `roll`, `school_name`, `address`, `student_type_id`, `status`, `type`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '20220001', 'Admin', '01988139009', 'admin@gmail.com', NULL, NULL, '$2a$12$T6b7m.W4RA5jqA2NAa/YkOeWGA/zkqTVHAYLnadcGr3dsHv1DSwBC', NULL, 'public/images/manpowers/61ade34c222b5.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2021-12-05 18:00:00', '2021-12-06 10:17:48'),
(6, '20220002', 'Md Abu Taleb', '01779325718', 'abutalebgmtt@gmail.com', NULL, NULL, '$2y$10$1AthhjO6BoQPHmwfuTHnkO15HDPYqJag9fF4BDv628f71JBqHNzXW', NULL, 'public/images/manpowers/61ade72234b23.png', 3, 6, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-12-06 10:16:18', '2021-12-06 10:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `waivers`
--

CREATE TABLE `waivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waiver_type_id` tinyint(4) DEFAULT NULL,
  `amount` decimal(5,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waiver_typies`
--

CREATE TABLE `waiver_typies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homepage_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitebanner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `site_name`, `homepage_title`, `about`, `meta_tags`, `meta_description`, `sitebanner`, `logo`, `footer_logo`, `favicon`, `email`, `phone`, `state_address`, `local_address`, `address`, `map_code`, `created_at`, `updated_at`) VALUES
(1, 'AQ English Grammar School', 'AQ English Grammar School', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abutalebgmtt@gmail.com', '01779325718', 'Dhaka', 'Dhaka', 'Merul Badda, Dhaka', NULL, NULL, '2021-12-07 11:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `written_exam_results`
--

CREATE TABLE `written_exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `batch_setting_id` int(11) DEFAULT NULL,
  `batch_type_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `exam_setting_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `question_subject_id` int(11) DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `submission_files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `written_exam_results`
--

INSERT INTO `written_exam_results` (`id`, `student_id`, `batch_setting_id`, `batch_type_id`, `class_id`, `session_id`, `examination_type_id`, `exam_setting_id`, `subject_id`, `question_subject_id`, `result`, `submission_files`, `created_by`, `verified`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 14, 1, 1, 6, 1, 1, 4, 1, 1, 10, '\"written_question.png\"', 1, '1', 1, NULL, '2021-12-07 07:16:56', '2021-12-07 07:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `written_questions`
--

CREATE TABLE `written_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `topic` int(11) DEFAULT NULL,
  `total_mark` int(11) DEFAULT NULL,
  `examination_type_id` int(11) DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `written_questions`
--

INSERT INTO `written_questions` (`id`, `question_no`, `class_id`, `session_id`, `subject_id`, `chapter_id`, `topic`, `total_mark`, `examination_type_id`, `attachment`, `solution_attachment`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Six Math MCQ Question', 6, 1, 1, 1, 0, 10, 1, 'public/uploads/questions/61af07ad5b754.pdf', NULL, '<p>na</p>', 1, NULL, '2021-12-07 07:05:17', '2021-12-07 07:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '2010', '2021-12-06 09:39:58', '2021-12-06 09:39:58'),
(2, '2011', '2021-12-06 09:40:06', '2021-12-06 09:40:06'),
(3, '2012', '2021-12-06 09:40:11', '2021-12-06 09:40:11'),
(4, '2013', '2021-12-06 09:40:18', '2021-12-06 09:40:18'),
(5, '2014', '2021-12-06 09:40:24', '2021-12-06 09:40:24'),
(6, '2015', '2021-12-06 09:40:29', '2021-12-06 09:40:29'),
(7, '2016', '2021-12-06 09:40:36', '2021-12-06 09:40:36'),
(8, '2017', '2021-12-06 09:40:43', '2021-12-06 09:40:43'),
(9, '2018', '2021-12-06 09:40:49', '2021-12-06 09:40:49'),
(10, '2019', '2021-12-06 09:40:56', '2021-12-06 09:40:56'),
(11, '2020', '2021-12-06 09:41:02', '2021-12-06 09:41:02'),
(12, '2021', '2021-12-06 09:41:10', '2021-12-06 09:41:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absent_month`
--
ALTER TABLE `absent_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absent_students`
--
ALTER TABLE `absent_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activism_modules`
--
ALTER TABLE `activism_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_day_times`
--
ALTER TABLE `batch_day_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_settings`
--
ALTER TABLE `batch_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_typies`
--
ALTER TABLE `batch_typies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_question_types`
--
ALTER TABLE `board_question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_settings`
--
ALTER TABLE `exam_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_action_typies`
--
ALTER TABLE `fee_action_typies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_amount_settings`
--
ALTER TABLE `fee_amount_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_categories`
--
ALTER TABLE `fee_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_category_typies`
--
ALTER TABLE `fee_category_typies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_collections`
--
ALTER TABLE `fee_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_collection_main`
--
ALTER TABLE `fee_collection_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_settings`
--
ALTER TABLE `fee_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_works`
--
ALTER TABLE `home_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_work_details`
--
ALTER TABLE `home_work_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `mcq_exam_settings`
--
ALTER TABLE `mcq_exam_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_exam_student_answers`
--
ALTER TABLE `mcq_exam_student_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_exam_student_ans_summaries`
--
ALTER TABLE `mcq_exam_student_ans_summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_question_options`
--
ALTER TABLE `mcq_question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_question_subjects`
--
ALTER TABLE `mcq_question_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_board_questions`
--
ALTER TABLE `old_board_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_question_boards`
--
ALTER TABLE `old_question_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_question_subjects`
--
ALTER TABLE `old_question_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_question_years`
--
ALTER TABLE `old_question_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_schools`
--
ALTER TABLE `old_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_school_classes`
--
ALTER TABLE `old_school_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_school_questions`
--
ALTER TABLE `old_school_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_school_sessions`
--
ALTER TABLE `old_school_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_school_subjects`
--
ALTER TABLE `old_school_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_times`
--
ALTER TABLE `pay_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_groups`
--
ALTER TABLE `result_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessiones`
--
ALTER TABLE `sessiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheet_settings`
--
ALTER TABLE `sheet_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheet_typies`
--
ALTER TABLE `sheet_typies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_histroys`
--
ALTER TABLE `sms_histroys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_templetes`
--
ALTER TABLE `sms_templetes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_infos`
--
ALTER TABLE `student_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_question_settings`
--
ALTER TABLE `student_question_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sheet_settings`
--
ALTER TABLE `student_sheet_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_types`
--
ALTER TABLE `student_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_waivers`
--
ALTER TABLE `student_waivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `waivers`
--
ALTER TABLE `waivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiver_typies`
--
ALTER TABLE `waiver_typies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `written_questions`
--
ALTER TABLE `written_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `absent_month`
--
ALTER TABLE `absent_month`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absent_students`
--
ALTER TABLE `absent_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activism_modules`
--
ALTER TABLE `activism_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_details`
--
ALTER TABLE `attendance_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch_day_times`
--
ALTER TABLE `batch_day_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `batch_settings`
--
ALTER TABLE `batch_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `batch_typies`
--
ALTER TABLE `batch_typies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `board_question_types`
--
ALTER TABLE `board_question_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exam_settings`
--
ALTER TABLE `exam_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_action_typies`
--
ALTER TABLE `fee_action_typies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_amount_settings`
--
ALTER TABLE `fee_amount_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fee_categories`
--
ALTER TABLE `fee_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_category_typies`
--
ALTER TABLE `fee_category_typies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_collections`
--
ALTER TABLE `fee_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_collection_main`
--
ALTER TABLE `fee_collection_main`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_settings`
--
ALTER TABLE `fee_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_works`
--
ALTER TABLE `home_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_work_details`
--
ALTER TABLE `home_work_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcq_exam_settings`
--
ALTER TABLE `mcq_exam_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcq_exam_student_answers`
--
ALTER TABLE `mcq_exam_student_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mcq_exam_student_ans_summaries`
--
ALTER TABLE `mcq_exam_student_ans_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mcq_question_options`
--
ALTER TABLE `mcq_question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mcq_question_subjects`
--
ALTER TABLE `mcq_question_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `old_board_questions`
--
ALTER TABLE `old_board_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `old_question_boards`
--
ALTER TABLE `old_question_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `old_question_subjects`
--
ALTER TABLE `old_question_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `old_question_years`
--
ALTER TABLE `old_question_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `old_schools`
--
ALTER TABLE `old_schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `old_school_classes`
--
ALTER TABLE `old_school_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `old_school_questions`
--
ALTER TABLE `old_school_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `old_school_sessions`
--
ALTER TABLE `old_school_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `old_school_subjects`
--
ALTER TABLE `old_school_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pay_times`
--
ALTER TABLE `pay_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_groups`
--
ALTER TABLE `result_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessiones`
--
ALTER TABLE `sessiones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sheet_settings`
--
ALTER TABLE `sheet_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sheet_typies`
--
ALTER TABLE `sheet_typies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_histroys`
--
ALTER TABLE `sms_histroys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sms_templetes`
--
ALTER TABLE `sms_templetes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_infos`
--
ALTER TABLE `student_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_question_settings`
--
ALTER TABLE `student_question_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_sheet_settings`
--
ALTER TABLE `student_sheet_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_types`
--
ALTER TABLE `student_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_waivers`
--
ALTER TABLE `student_waivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `waivers`
--
ALTER TABLE `waivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waiver_typies`
--
ALTER TABLE `waiver_typies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `written_exam_results`
--
ALTER TABLE `written_exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `written_questions`
--
ALTER TABLE `written_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
