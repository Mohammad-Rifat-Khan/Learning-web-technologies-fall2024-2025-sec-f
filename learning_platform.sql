-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 08:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `category`, `module`, `duration`, `price`, `image`) VALUES
(1, 'Crop Rotation Techniques', 'Learn the best practices for rotating crops to maximize soil fertility, control pests, and improve crop yields. This course includes real-world examples and practical applications.', 'crop', 'Introduction', 5, 50.00, NULL),
(2, 'Sustainable Farming Practices', 'Explore eco-friendly farming methods to maintain soil health and biodiversity. This course covers organic fertilizers, composting, and water conservation techniques.', 'crop', 'Intermediate', 7, 75.00, NULL),
(3, 'Livestock Care Basics', 'Essential care techniques for maintaining healthy livestock, including feeding routines, vaccination schedules, and disease prevention strategies.', 'livestock', 'Basics', 4, 40.00, NULL),
(4, 'Dairy Farming Essentials', 'Master the art of dairy farming, including milk production processes, cattle health monitoring, and profitability strategies.', 'livestock', 'Essentials', 6, 60.00, NULL),
(5, 'Advanced Agri-Tech', 'Discover the latest technologies in agriculture, including precision farming, GPS-guided equipment, and AI applications for decision-making.', 'technology', 'Advanced', 10, 120.00, NULL),
(6, 'Smart Farming with IoT', 'Learn how the Internet of Things (IoT) is transforming agriculture with connected sensors, automated systems, and real-time data analysis.', 'technology', 'Technology', 12, 150.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrollment_date`) VALUES
(2, 1, 1, '2025-01-03 19:37:09'),
(3, 1, 2, '2025-01-03 19:37:14'),
(4, 1, 1, '2025-01-03 19:37:57'),
(5, 1, 1, '2025-01-03 19:37:58'),
(6, 1, 1, '2025-01-03 19:37:58'),
(7, 1, 1, '2025-01-03 19:37:58'),
(8, 1, 1, '2025-01-03 19:37:58'),
(9, 1, 1, '2025-01-03 19:37:58'),
(10, 1, 1, '2025-01-03 19:38:50'),
(11, 1, 1, '2025-01-03 19:42:36'),
(12, 1, 1, '2025-01-03 19:42:36'),
(13, 1, 1, '2025-01-03 19:42:37'),
(14, 1, 1, '2025-01-03 19:42:37'),
(15, 1, 1, '2025-01-03 19:42:37'),
(16, 1, 1, '2025-01-03 19:42:37'),
(17, 1, 1, '2025-01-03 19:42:37'),
(18, 1, 1, '2025-01-03 19:42:37'),
(19, 1, 1, '2025-01-03 19:42:37'),
(20, 1, 1, '2025-01-03 19:42:38'),
(21, 1, 1, '2025-01-03 19:42:38'),
(22, 1, 1, '2025-01-03 19:42:38'),
(23, 1, 1, '2025-01-03 19:42:38'),
(24, 1, 1, '2025-01-03 19:42:38'),
(25, 1, 1, '2025-01-03 19:42:38'),
(26, 1, 1, '2025-01-03 19:42:38'),
(27, 1, 1, '2025-01-03 19:42:39'),
(28, 1, 6, '2025-01-05 19:14:26'),
(29, 1, 5, '2025-01-05 19:14:29'),
(30, 1, 1, '2025-01-05 19:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `saved_courses`
--

CREATE TABLE `saved_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'rifatkhan', 'test@gmail.com', 'test123'),
(2, 'tanvirjabid', 'jabid@hotmail.com', 'asd123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`,`description`,`category`) USING HASH;

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `saved_courses`
--
ALTER TABLE `saved_courses`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `saved_courses`
--
ALTER TABLE `saved_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
