-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 12:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personalfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expdate` date NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expdate`, `description`, `qty`, `unitprice`, `total`, `created_by`, `created_at`) VALUES
(1, '2023-04-01', 'Water Bottle', 1, 1000, 1000, 2, '2023-04-01 06:40:29'),
(5, '2023-04-01', 'snack', 1, 10000, 10000, 2, '2023-04-01 07:09:58'),
(6, '2023-04-01', 'Water Bottle', 3, 800, 2400, 1, '2023-04-01 07:10:36'),
(7, '2023-04-01', 'Fried Potatoe', 4, 3000, 12000, 2, '2023-04-01 07:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `indate` date NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `indate`, `description`, `qty`, `unitprice`, `total`, `created_by`, `created_at`) VALUES
(1, '2023-04-02', 'Salary', 1, 500000, 500000, 2, '2023-04-01 21:48:04'),
(3, '2023-04-02', 'Pocket Money from Uncle', 1, 100000, 100000, 2, '2023-04-01 22:17:34'),
(4, '2023-04-02', 'Salary', 1, 300000, 300000, 1, '2023-04-01 22:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `value`) VALUES
(1, 'Admin', 1),
(2, 'User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT '1.png',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Wai Linn Kyaw', 'wailinnkyaw03@gmail.com', '$2y$10$MK6Hj.9L26D.jKSixHSCueGqCU5ItHW4ZOPBGEMYpcE25YDgCKaH6', '6427a4b8a1a54Profile Picture.jpg', 0, 1, '2023-03-14 04:38:22', '2023-03-14 04:38:22'),
(2, 'Wai Linn Khant', 'wailinnkhant@gmail.com', '$2y$10$7wnaVfQQswTOKMrX2qyuuuECkMsJKj9EaQMgyhCLh/Duq55v5aS9K', '6427a5b478ba60-02-06-0c74656e6bf5a0fdb3732cdcd532ae3d86db410fcfd96b2e7d76b9b91ecf3387_31d68fcc8ea97d31.jpg', 0, 2, '2023-03-14 04:40:04', '2023-03-14 04:40:04'),
(3, 'Eain Dra', 'eaindra@gmail.com', '$2y$10$anqNeKWKB6mwy9qpiax6cegrpnAovbzV/XcyAWKB2WuM3xYIw94yu', '6427a719d23cd0-02-06-05d6190ac811340145a11cd231adec76b5eb2d2c019de7632d887c69db9d26f9_6c59ee6df83a455c.jpg', 0, 2, '2023-04-01 03:32:45', '2023-04-01 03:32:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
