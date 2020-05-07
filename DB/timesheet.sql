-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2020 at 04:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `month` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `event` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`month`, `date`, `event`, `note`) VALUES
(1, 1, 'Tết Nguyên đán', NULL),
(4, 22, 'Nhậu', NULL),
(4, 30, 'abcxyz', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkin_checkout`
--

CREATE TABLE `checkin_checkout` (
  `id` int(11) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `checkin` time DEFAULT NULL,
  `checkin_modify` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `checkout_modify` time DEFAULT NULL,
  `break_time` time DEFAULT NULL,
  `break_time_modify` time DEFAULT NULL,
  `working_time` time DEFAULT NULL,
  `missing_time` time DEFAULT NULL,
  `over_time` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0-approve, 1- subbmit, 3- reject',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkin_checkout`
--

INSERT INTO `checkin_checkout` (`id`, `user_mail`, `date`, `checkin`, `checkin_modify`, `checkout`, `checkout_modify`, `break_time`, `break_time_modify`, `working_time`, `missing_time`, `over_time`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 'hai@123', '2020-04-01', '08:00:00', '09:00:00', '19:00:00', NULL, '01:00:00', NULL, '10:00:00', '00:00:00', '00:00:00', 0, NULL, NULL, '2020-04-30 14:31:35'),
(2, 'hai@123', '2020-04-02', '08:00:00', '10:00:00', '19:00:00', '18:00:00', '01:00:00', '02:00:00', '06:00:00', '02:00:00', NULL, 0, NULL, NULL, '2020-04-30 15:42:50'),
(3, 'hai@123', '2020-04-03', '08:00:00', '08:57:00', '19:00:00', NULL, '01:00:00', NULL, '08:00:00', '00:00:00', '00:00:00', 1, NULL, NULL, '2020-04-28 15:44:16');

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2020_04_22_034148_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_timesheet`
--

CREATE TABLE `monthly_timesheet` (
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `user_mail` varchar(45) DEFAULT NULL,
  `standar_work_hour` double DEFAULT NULL,
  `working_hour` double DEFAULT NULL,
  `missing_hour` double DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `overtime_hour` double DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthly_timesheet`
--

INSERT INTO `monthly_timesheet` (`year`, `month`, `user_mail`, `standar_work_hour`, `working_hour`, `missing_hour`, `note`, `overtime_hour`, `id`) VALUES
(2020, 1, 'hai@123', 160, 160, 0, NULL, NULL, 1),
(2020, 2, 'hai@123', 160, 155, 5, NULL, NULL, 2),
(2020, 4, 'hai@123', 160, 155, 5, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '0- admin\n1- staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'hai', 'hai@123', '$2y$10$.Oq8u9s/Z6n7e0ZKdCOewesfPXiR.lbhrCh4.wqGfh2OhDSzVmHs6', 1),
(2, 'hai', 'hai@1234', '$10$.Oq8u9s/Z6n7e0ZKdCOewesfPXiR.lbhrCh4.wqGfh2OhDSzVmHs6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`month`,`date`);

--
-- Indexes for table `checkin_checkout`
--
ALTER TABLE `checkin_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_timesheet`
--
ALTER TABLE `monthly_timesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin_checkout`
--
ALTER TABLE `checkin_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monthly_timesheet`
--
ALTER TABLE `monthly_timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
