-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 04:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `topic_id`, `user_id`, `question_id`, `user_answer`, `answer`, `created_at`, `updated_at`) VALUES
(1, 2, 40, 23, 'B', 'B', '2022-05-26 13:30:17', '2022-05-26 13:30:17'),
(2, 2, 40, 7, 'C', 'C', '2022-05-26 13:30:20', '2022-05-26 13:30:20'),
(3, 2, 40, 24, 'D', 'B', '2022-05-26 13:30:23', '2022-05-26 13:30:23'),
(4, 2, 40, 36, 'B', 'B', '2022-05-26 13:30:30', '2022-05-26 13:30:30'),
(5, 2, 40, 24, 'C', 'B', '2022-05-26 13:30:32', '2022-05-26 13:30:32'),
(6, 2, 40, 28, 'D', 'B', '2022-05-26 13:30:36', '2022-05-26 13:30:36'),
(7, 2, 40, 14, 'A', 'B', '2022-05-26 13:30:39', '2022-05-26 13:30:39'),
(8, 2, 40, 11, 'C', 'C', '2022-05-26 13:30:43', '2022-05-26 13:30:43'),
(9, 2, 40, 12, 'D', 'D', '2022-05-26 13:30:46', '2022-05-26 13:30:46'),
(10, 2, 40, 14, 'C', 'B', '2022-05-26 13:30:49', '2022-05-26 13:30:49'),
(11, 2, 40, 63, 'D', 'B', '2022-05-26 13:30:53', '2022-05-26 13:30:53'),
(12, 2, 40, 66, 'C', 'C', '2022-05-26 13:30:56', '2022-05-26 13:30:56'),
(13, 2, 40, 30, 'C', 'B', '2022-05-26 13:31:00', '2022-05-26 13:31:00'),
(14, 2, 40, 59, 'D', 'B', '2022-05-26 13:31:03', '2022-05-26 13:31:03'),
(15, 2, 40, 20, 'B', 'C', '2022-05-26 13:31:06', '2022-05-26 13:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `MAIL_FROM_NAME` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_DRIVER` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_HOST` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_PORT` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_USERNAME` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_FROM_ADDRESS` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_PASSWORD` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MAIL_ENCRYPTION` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copyrighttexts`
--

CREATE TABLE `copyrighttexts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copyrighttexts`
--

INSERT INTO `copyrighttexts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Copyright 2021- Brilliant Science Coaching', NULL, '2019-05-24 12:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
(3, '2017_11_23_160102_create_sessions_table', 1),
(4, '2017_11_25_133229_create_settings_table', 1),
(5, '2017_12_03_080242_create_topics_table', 1),
(6, '2017_12_03_080330_create_tests_table', 1),
(7, '2017_12_03_091845_create_questions_table', 1),
(8, '2017_12_03_110511_create_answers_table', 1),
(9, '2017_12_21_085915_add_image_video_column_to_questions', 2),
(12, '2019_02_07_113422_create_f_a_qs_table', 4),
(13, '2019_02_04_122123_create_pages_table', 5),
(14, '2019_02_12_065327_create_copyrighttexts_table', 6),
(17, '2019_02_04_100908_create_social_icons_table', 7),
(18, '2019_02_15_072716_create_config_table', 8),
(19, '2019_02_12_165455_create_topic_user_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `show_in_menu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_snippet` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_video_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_audio` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `topic_id`, `question`, `subject`, `a`, `b`, `c`, `d`, `e`, `f`, `answer`, `code_snippet`, `answer_exp`, `created_at`, `updated_at`, `question_img`, `question_video_link`, `question_audio`) VALUES
(1, 2, NULL, 'physics', 'asd', 'asd', 'sad', 'asd', 'asd', 'asd', 'B', NULL, NULL, '2022-05-26 09:45:48', '2022-05-26 09:45:48', 'question_1653578148sample1.jpg', NULL, NULL),
(2, 2, NULL, 'physics', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:46:07', '2022-05-26 09:46:07', 'question_1653578167smaple12.jpg', NULL, NULL),
(3, 2, NULL, 'physics', 'asdasd', 'asd', 'asdasd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:47:56', '2022-05-26 09:47:56', 'question_1653578276admin.jpg', NULL, NULL),
(4, 2, NULL, 'physics', 'asd', 'asd', 'ad', 'asd', 'dad', 'asd', 'B', NULL, NULL, '2022-05-26 09:48:12', '2022-05-26 09:48:12', 'question_1653578292folder.png', NULL, NULL),
(5, 2, NULL, 'physics', 'asd', 'asd', 'asda', 'sdas', 'asd', 'sad', 'D', NULL, NULL, '2022-05-26 09:48:36', '2022-05-26 09:48:36', 'question_1653578316logo2.png', NULL, NULL),
(6, 2, NULL, 'physics', 'asd', 'asd', 'adsadas', 'asdasd', 'sd', 'das', 'C', NULL, NULL, '2022-05-26 09:48:52', '2022-05-26 09:48:52', 'question_1653578332new.png', NULL, NULL),
(7, 2, NULL, 'physics', 'as', 'dasda', 'asdas', 'das', 'dasd', 'asdasd', 'C', NULL, NULL, '2022-05-26 09:49:12', '2022-05-26 09:49:12', 'question_1653578352newlogo.jpg', NULL, NULL),
(8, 2, NULL, 'chemistry', 'asd', 'dasd', 'asdas', 'das', 'dasd', 'asd', 'D', NULL, NULL, '2022-05-26 09:49:37', '2022-05-26 09:49:37', 'question_1653578377img1.jpg', NULL, NULL),
(9, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dasd', 'sad', 'D', NULL, NULL, '2022-05-26 09:49:51', '2022-05-26 09:49:51', 'question_1653578391img2.jpg', NULL, NULL),
(10, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dsad', 'sad', 'C', NULL, NULL, '2022-05-26 09:50:09', '2022-05-26 09:50:09', 'question_1653578409img1.jpg', NULL, NULL),
(11, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dasd', 'as', 'C', NULL, NULL, '2022-05-26 09:50:25', '2022-05-26 09:50:25', 'question_1653578425img2.jpg', NULL, NULL),
(12, 2, NULL, 'chemistry', 'sad', 'asd', 'asdas', 'dasd', 'asd', 'asd', 'D', NULL, NULL, '2022-05-26 09:50:45', '2022-05-26 09:50:45', 'question_1653578445img2.jpg', NULL, NULL),
(13, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'B', NULL, NULL, '2022-05-26 09:51:19', '2022-05-26 09:51:19', 'question_1653578479img1.jpg', NULL, NULL),
(14, 2, NULL, 'chemistry', 'asd', 'asd', 'asdsa', 'das', 'dasd', 'asd', 'B', NULL, NULL, '2022-05-26 09:51:36', '2022-05-26 09:51:36', 'question_1653578496img1.jpg', NULL, NULL),
(15, 2, NULL, 'biology', 'asdas', 'dasd', 'dasd', 'asd', 'asda', 'sdasdasd', 'B', NULL, NULL, '2022-05-26 09:52:13', '2022-05-26 09:52:13', 'question_1653578533img2.jpg', NULL, NULL),
(16, 2, NULL, 'biology', 'asd', 'asdsa', 'das', 'dasd', 'asdas', 'd', 'B', NULL, NULL, '2022-05-26 09:52:32', '2022-05-26 09:52:32', 'question_1653578552img1.jpg', NULL, NULL),
(17, 2, NULL, 'biology', 'asdas', 'dsa', 'dasd', 'asd', 'asdsa', 'd', 'B', NULL, NULL, '2022-05-26 09:52:47', '2022-05-26 09:52:47', 'question_1653578567img1-lg.jpg', NULL, NULL),
(18, 2, NULL, 'biology', 'asd', 'asdas', 'asd', 'asda', 'sdas', 'd', 'B', NULL, NULL, '2022-05-26 09:53:03', '2022-05-26 09:53:03', 'question_1653578583img2.jpg', NULL, NULL),
(19, 2, NULL, 'biology', 'asd', 'sadas', 'dasd', 'asdas', 'dasd', 'asd', 'B', NULL, NULL, '2022-05-26 09:53:22', '2022-05-26 09:53:22', 'question_1653578602img3.jpg', NULL, NULL),
(20, 2, NULL, 'biology', 'asd', 'asdas', 'das', 'asdasd', 'asd', 'asdas', 'C', NULL, NULL, '2022-05-26 09:53:37', '2022-05-26 09:53:37', 'question_1653578617img3-lg.jpg', NULL, NULL),
(21, 2, NULL, 'biology', 'asd', 'asdas', 'dasd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:53:55', '2022-05-26 09:53:55', 'question_1653578635img6-lg.jpg', NULL, NULL),
(22, 2, NULL, 'physics', 'sad', 'asd', 'asdasd', 'asd', 'asdas', 'das', 'B', NULL, NULL, '2022-05-26 11:09:40', '2022-05-26 11:09:40', 'question_1653583180call.png', NULL, NULL),
(23, 2, NULL, 'physics', 'asd', 'asd', 'ads', 'asd', 'asd', 'ds', 'B', NULL, NULL, '2022-05-26 11:09:58', '2022-05-26 11:09:58', 'question_1653583198envelope.png', NULL, NULL),
(24, 2, NULL, 'physics', 'asd', 'asd', 'asd', 'asdas', 'asdas', 'dasd', 'B', NULL, NULL, '2022-05-26 11:10:16', '2022-05-26 11:10:16', 'question_1653583216globe.png', NULL, NULL),
(25, 2, NULL, 'physics', 'asd', 'asd', 'asd', 'asdas', 'asdas', 'asd', 'C', NULL, NULL, '2022-05-26 11:10:32', '2022-05-26 11:10:32', 'question_1653583232logo.png', NULL, NULL),
(26, 2, NULL, 'chemistry', 'sad', 'asd', 'asd', 'asdas', 'das', 'das', 'B', NULL, NULL, '2022-05-26 11:11:03', '2022-05-26 11:11:03', 'question_1653583263bkash.png', NULL, NULL),
(27, 2, NULL, 'chemistry', 'asd', 'dasd', 'asd', 'asdasd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 11:11:18', '2022-05-26 11:11:18', 'question_1653583278card.png', NULL, NULL),
(28, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'das', 'dasd', 'B', NULL, NULL, '2022-05-26 11:11:33', '2022-05-26 11:11:33', 'question_1653583293cash.png', NULL, NULL),
(29, 2, NULL, 'biology', 'asd', 'ads', 'asd', 'asdas', 'das', 'das', 'A', NULL, NULL, '2022-05-26 11:12:26', '2022-05-26 11:12:26', 'question_1653583346cod.png', NULL, NULL),
(30, 2, NULL, 'biology', 'asd', 'asd', 'asdas', 'asdas', 'das', 'dasd', 'B', NULL, NULL, '2022-05-26 11:12:41', '2022-05-26 11:12:41', 'question_1653583361drdeo-logo-white.png', NULL, NULL),
(31, 2, NULL, 'biology', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 11:13:01', '2022-05-26 11:13:01', 'question_1653583381help.png', NULL, NULL),
(32, 2, NULL, 'physics', 'asd', 'asd', 'sad', 'asd', 'asd', 'asd', 'B', NULL, NULL, '2022-05-26 09:45:48', '2022-05-26 09:45:48', 'question_1653578148sample1.jpg', NULL, NULL),
(33, 2, NULL, 'physics', 'asd', 'asd', 'sad', 'asd', 'asd', 'asd', 'B', NULL, NULL, '2022-05-26 09:45:48', '2022-05-26 09:45:48', 'question_1653578148sample1.jpg', NULL, NULL),
(34, 2, NULL, 'physics', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:46:07', '2022-05-26 09:46:07', 'question_1653578167smaple12.jpg', NULL, NULL),
(35, 2, NULL, 'physics', 'asdasd', 'asd', 'asdasd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:47:56', '2022-05-26 09:47:56', 'question_1653578276admin.jpg', NULL, NULL),
(36, 2, NULL, 'physics', 'asd', 'asd', 'ad', 'asd', 'dad', 'asd', 'B', NULL, NULL, '2022-05-26 09:48:12', '2022-05-26 09:48:12', 'question_1653578292folder.png', NULL, NULL),
(37, 2, NULL, 'physics', 'asd', 'asd', 'asda', 'sdas', 'asd', 'sad', 'D', NULL, NULL, '2022-05-26 09:48:36', '2022-05-26 09:48:36', 'question_1653578316logo2.png', NULL, NULL),
(38, 2, NULL, 'physics', 'asd', 'asd', 'adsadas', 'asdasd', 'sd', 'das', 'C', NULL, NULL, '2022-05-26 09:48:52', '2022-05-26 09:48:52', 'question_1653578332new.png', NULL, NULL),
(39, 2, NULL, 'physics', 'asd', 'asd', 'sad', 'asd', 'asd', 'asd', 'B', NULL, NULL, '2022-05-26 09:45:48', '2022-05-26 09:45:48', 'question_1653578148sample1.jpg', NULL, NULL),
(40, 2, NULL, 'physics', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:46:07', '2022-05-26 09:46:07', 'question_1653578167smaple12.jpg', NULL, NULL),
(41, 2, NULL, 'physics', 'asdasd', 'asd', 'asdasd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:47:56', '2022-05-26 09:47:56', 'question_1653578276admin.jpg', NULL, NULL),
(42, 2, NULL, 'physics', 'asd', 'asd', 'ad', 'asd', 'dad', 'asd', 'B', NULL, NULL, '2022-05-26 09:48:12', '2022-05-26 09:48:12', 'question_1653578292folder.png', NULL, NULL),
(43, 2, NULL, 'physics', 'asd', 'asd', 'asda', 'sdas', 'asd', 'sad', 'D', NULL, NULL, '2022-05-26 09:48:36', '2022-05-26 09:48:36', 'question_1653578316logo2.png', NULL, NULL),
(44, 2, NULL, 'physics', 'asd', 'asd', 'adsadas', 'asdasd', 'sd', 'das', 'C', NULL, NULL, '2022-05-26 09:48:52', '2022-05-26 09:48:52', 'question_1653578332new.png', NULL, NULL),
(45, 2, NULL, 'physics', 'as', 'dasda', 'asdas', 'das', 'dasd', 'asdasd', 'C', NULL, NULL, '2022-05-26 09:49:12', '2022-05-26 09:49:12', 'question_1653578352newlogo.jpg', NULL, NULL),
(46, 2, NULL, 'chemistry', 'asd', 'dasd', 'asdas', 'das', 'dasd', 'asd', 'D', NULL, NULL, '2022-05-26 09:49:37', '2022-05-26 09:49:37', 'question_1653578377img1.jpg', NULL, NULL),
(47, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dasd', 'sad', 'D', NULL, NULL, '2022-05-26 09:49:51', '2022-05-26 09:49:51', 'question_1653578391img2.jpg', NULL, NULL),
(48, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dsad', 'sad', 'C', NULL, NULL, '2022-05-26 09:50:09', '2022-05-26 09:50:09', 'question_1653578409img1.jpg', NULL, NULL),
(49, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dasd', 'as', 'C', NULL, NULL, '2022-05-26 09:50:25', '2022-05-26 09:50:25', 'question_1653578425img2.jpg', NULL, NULL),
(50, 2, NULL, 'chemistry', 'sad', 'asd', 'asdas', 'dasd', 'asd', 'asd', 'D', NULL, NULL, '2022-05-26 09:50:45', '2022-05-26 09:50:45', 'question_1653578445img2.jpg', NULL, NULL),
(51, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dasd', 'sad', 'D', NULL, NULL, '2022-05-26 09:49:51', '2022-05-26 09:49:51', 'question_1653578391img2.jpg', NULL, NULL),
(52, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'dsad', 'sad', 'C', NULL, NULL, '2022-05-26 09:50:09', '2022-05-26 09:50:09', 'question_1653578409img1.jpg', NULL, NULL),
(53, 2, NULL, 'chemistry', 'sad', 'asd', 'asd', 'asdas', 'das', 'das', 'B', NULL, NULL, '2022-05-26 11:11:03', '2022-05-26 11:11:03', 'question_1653583263bkash.png', NULL, NULL),
(54, 2, NULL, 'chemistry', 'asd', 'dasd', 'asd', 'asdasd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 11:11:18', '2022-05-26 11:11:18', 'question_1653583278card.png', NULL, NULL),
(55, 2, NULL, 'chemistry', 'asd', 'asd', 'asd', 'asdas', 'das', 'dasd', 'B', NULL, NULL, '2022-05-26 11:11:33', '2022-05-26 11:11:33', 'question_1653583293cash.png', NULL, NULL),
(56, 2, NULL, 'biology', 'asdas', 'dasd', 'dasd', 'asd', 'asda', 'sdasdasd', 'B', NULL, NULL, '2022-05-26 09:52:13', '2022-05-26 09:52:13', 'question_1653578533img2.jpg', NULL, NULL),
(57, 2, NULL, 'biology', 'asd', 'asdsa', 'das', 'dasd', 'asdas', 'd', 'B', NULL, NULL, '2022-05-26 09:52:32', '2022-05-26 09:52:32', 'question_1653578552img1.jpg', NULL, NULL),
(58, 2, NULL, 'biology', 'asdas', 'dsa', 'dasd', 'asd', 'asdsa', 'd', 'B', NULL, NULL, '2022-05-26 09:52:47', '2022-05-26 09:52:47', 'question_1653578567img1-lg.jpg', NULL, NULL),
(59, 2, NULL, 'biology', 'asd', 'asdas', 'asd', 'asda', 'sdas', 'd', 'B', NULL, NULL, '2022-05-26 09:53:03', '2022-05-26 09:53:03', 'question_1653578583img2.jpg', NULL, NULL),
(60, 2, NULL, 'biology', 'asd', 'sadas', 'dasd', 'asdas', 'dasd', 'asd', 'B', NULL, NULL, '2022-05-26 09:53:22', '2022-05-26 09:53:22', 'question_1653578602img3.jpg', NULL, NULL),
(61, 2, NULL, 'biology', 'asd', 'asdsa', 'das', 'dasd', 'asdas', 'd', 'B', NULL, NULL, '2022-05-26 09:52:32', '2022-05-26 09:52:32', 'question_1653578552img1.jpg', NULL, NULL),
(62, 2, NULL, 'biology', 'asdas', 'dsa', 'dasd', 'asd', 'asdsa', 'd', 'B', NULL, NULL, '2022-05-26 09:52:47', '2022-05-26 09:52:47', 'question_1653578567img1-lg.jpg', NULL, NULL),
(63, 2, NULL, 'biology', 'asd', 'asdas', 'asd', 'asda', 'sdas', 'd', 'B', NULL, NULL, '2022-05-26 09:53:03', '2022-05-26 09:53:03', 'question_1653578583img2.jpg', NULL, NULL),
(64, 2, NULL, 'biology', 'asd', 'sadas', 'dasd', 'asdas', 'dasd', 'asd', 'B', NULL, NULL, '2022-05-26 09:53:22', '2022-05-26 09:53:22', 'question_1653578602img3.jpg', NULL, NULL),
(65, 2, NULL, 'biology', 'asd', 'asdas', 'das', 'asdasd', 'asd', 'asdas', 'C', NULL, NULL, '2022-05-26 09:53:37', '2022-05-26 09:53:37', 'question_1653578617img3-lg.jpg', NULL, NULL),
(66, 2, NULL, 'biology', 'asd', 'asdas', 'dasd', 'asd', 'asd', 'asd', 'C', NULL, NULL, '2022-05-26 09:53:55', '2022-05-26 09:53:55', 'question_1653578635img6-lg.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_txt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Quick Quiz',
  `userquiz` tinyint(1) DEFAULT 0,
  `w_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_login` tinyint(1) DEFAULT 0,
  `fb_login` tinyint(1) DEFAULT 0,
  `gitlab_login` tinyint(1) DEFAULT 0,
  `right_setting` tinyint(1) DEFAULT NULL,
  `element_setting` tinyint(1) DEFAULT NULL,
  `wel_mail` tinyint(1) NOT NULL DEFAULT 0,
  `coming_soon` tinyint(1) NOT NULL DEFAULT 0,
  `comingsoon_enabled_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `welcome_txt`, `userquiz`, `w_email`, `currency_code`, `currency_symbol`, `google_login`, `fb_login`, `gitlab_login`, `right_setting`, `element_setting`, `wel_mail`, `coming_soon`, `comingsoon_enabled_ip`, `created_at`, `updated_at`) VALUES
(1, 'logo_1512974578qq2.png', 'favicon.ico', 'Quick Quiz', NULL, 'test@gmail.com', 'INR', 'fa fa-rupee', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2022-05-26 09:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `social_icons`
--

CREATE TABLE `social_icons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_q_mark` int(11) NOT NULL,
  `timer` int(11) DEFAULT NULL,
  `show_ans` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`, `per_q_mark`, `timer`, `show_ans`, `amount`, `created_at`, `updated_at`) VALUES
(2, 'Test', 'For Test.', 6, 61, '0', NULL, '2022-05-26 09:44:17', '2022-05-26 10:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `topic_user`
--

CREATE TABLE `topic_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `amount` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsappnum` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `whatsappnum`, `board`, `class1`, `mobile`, `address`, `city`, `role`, `image`, `remember_token`, `created_at`, `updated_at`, `otp`) VALUES
(1, 'Admin', 'admin@info.com', '$2y$10$4Y7TLx24XucQirs4RIH2UO0ormaEj1VoP9D3nhsoOialwV.frXrvO', NULL, NULL, NULL, '9999999999', NULL, NULL, 'A', NULL, 'a8FVyWO9pYlSJJXn1suVQTl86szvg4BUFi7IO4dfF2hbqtHwBzduwBuprIZW', '2017-12-10 17:16:00', '2022-05-23 03:01:36', 1234),
(40, 'Neelesh Krishna', 'neelesh2210@gmail.com', '$2y$10$71Mo0lYm4ArtUl8ednQZAuyBfC6jKovIbGpA/7.lKEE0m2TN725FS', '4545644654', 'CBSE', '11th', '7271001995', NULL, 'VARANASI', 'S', NULL, NULL, '2022-05-26 09:17:50', '2022-05-26 09:18:13', 1234),
(41, NULL, NULL, '$2y$10$b7qFn1cqu/nC9MBLwF3aG.ZRayOa6DO4kdXIcW5Xuywals7oFYLKu', NULL, NULL, NULL, '7271001994', NULL, NULL, 'S', NULL, NULL, '2022-05-26 09:19:15', '2022-05-26 09:19:15', 1234),
(42, 'Neelesh Krishna', 'vikash@gmail.com', '$2y$10$CmDprrbt4lpY08BbD/.EJuWnqCAhw/gG2/NOA2z/XYzsclFeUolfu', '4545644654', 'ICSE', '11th', '7894612304', NULL, 'VARANASI', 'S', NULL, NULL, '2022-05-26 09:20:57', '2022-05-26 09:34:44', 1234),
(43, NULL, NULL, '$2y$10$kLqdhwd.Yl9OYZ1jdGXyhuCL6cBYm0XJsSuEHQUYevcwnX1oWu0Ui', NULL, NULL, NULL, '7894545544', NULL, NULL, 'S', NULL, NULL, '2022-05-26 12:18:52', '2022-05-26 12:18:52', 1234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copyrighttexts`
--
ALTER TABLE `copyrighttexts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_title_unique` (`title`);

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
  ADD UNIQUE KEY `pages_name_unique` (`name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_icons`
--
ALTER TABLE `social_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_user`
--
ALTER TABLE `topic_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_user_user_id_foreign` (`user_id`),
  ADD KEY `topic_user_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copyrighttexts`
--
ALTER TABLE `copyrighttexts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_icons`
--
ALTER TABLE `social_icons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topic_user`
--
ALTER TABLE `topic_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
