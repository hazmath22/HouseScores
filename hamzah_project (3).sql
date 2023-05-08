-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 03:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamzah_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_types`
--

CREATE TABLE `class_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_types`
--

INSERT INTO `class_types` (`id`, `class_type`) VALUES
(1, 'A1'),
(2, 'A2');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `score` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `team_id`, `score`) VALUES
(12, 2, '44.00'),
(13, 2, '44.00'),
(14, 2, '44.00'),
(15, 2, '4.00'),
(16, 3, '4.00'),
(17, 1, '3.00'),
(18, 3, '6.00'),
(19, 2, '300.00'),
(20, 1, '300.00'),
(21, 3, '600.00'),
(22, 2, '14.00'),
(23, 1, '7.00'),
(24, 1, '690.00'),
(25, 2, '550.00'),
(26, 3, '390.00'),
(27, 1, '1.00'),
(28, 1, '1.00'),
(29, 1, '22.22'),
(30, 1, '50.85'),
(31, 1, '25.30'),
(32, 1, '0.63'),
(33, 1, '99.00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `classtype_id` int(10) UNSIGNED NOT NULL,
  `roll_number` varchar(191) NOT NULL,
  `student_name` varchar(191) NOT NULL,
  `house` varchar(191) DEFAULT NULL,
  `team_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `classtype_id`, `roll_number`, `student_name`, `house`, `team_id`) VALUES
(1, 1, '112255', 'Akbar Sarwar', 'House# 199 Lahore', 2),
(2, 1, '6655', 'Waqar ALi', 'house 200', 1),
(3, 2, '9898', 'Muzamel', 'House88', 1),
(4, 1, '001', 'Wasif', '', 3),
(5, 2, '1122', 'ABC', 'xyz', 2),
(6, 2, '0001', 'Sana', 'abc', 1),
(7, 1, '3333333', 'Zain Nisaar', '3434', 1),
(8, 1, '4343', 'abc', '3434', 1),
(9, 1, 'asdf', 'Akbar Sarwar', 'dsaf', 1),
(10, 1, '4444555', 'Waqar ALi', 'asdf', 1),
(11, 1, '2323', 'asdf', 'dsaf', 1),
(12, 2, '4444555', '2232', '232', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_scores`
--

CREATE TABLE `student_scores` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `score` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_scores`
--

INSERT INTO `student_scores` (`id`, `team_id`, `student_id`, `score`) VALUES
(1, 1, 3, '50.00'),
(2, 1, 2, '800.00'),
(3, 1, 2, '50.00'),
(4, 1, 2, '50.00'),
(5, 2, 1, '50.00'),
(6, 2, 1, '50.00'),
(7, 2, 1, '50.00'),
(8, 1, 3, '150.00'),
(9, 1, 2, '50.00'),
(10, 3, 4, '600.00'),
(11, 3, 4, '50.00'),
(12, 1, 3, '20.00'),
(13, 1, 8, '550.00'),
(14, 1, 7, '232.00'),
(15, 1, 7, '50.00'),
(16, 1, 7, '22.00'),
(17, 1, 7, '22.00'),
(18, 1, 7, '4.00'),
(19, 1, 7, '70.00'),
(20, 1, 8, '50.00'),
(21, 1, 12, '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `background` varchar(191) DEFAULT '1A7D0E',
  `background_hover` varchar(191) DEFAULT '224FD6',
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `background`, `background_hover`, `status`) VALUES
(1, 'Jinnah', '1A7D0E', '13690F', 1),
(2, 'Iqbal', '1D6FCC', '224FD6', 1),
(3, 'Sir Syed', 'E8DA23', 'C3B419', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@123', '2021-02-26 16:28:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_types`
--
ALTER TABLE `class_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `classtype_id` (`classtype_id`);

--
-- Indexes for table `student_scores`
--
ALTER TABLE `student_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_types`
--
ALTER TABLE `class_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_scores`
--
ALTER TABLE `student_scores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
