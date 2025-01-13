-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 11:11 AM
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
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `employee_name`, `contact_no`, `password`) VALUES
(4, 'tanvirjabid', 'Tanvir Jabid ', '906834', '098poi'),
(5, 'john_doe', 'John Doe', '1234567890', 'password123'),
(6, 'jane_smith', 'Jane Smith', '0987654321', 'welcome2025'),
(7, 'alex_jones', 'Alex Jones', '1122334455', 'johnDoe@123'),
(8, 'mary_johnson', 'Mary Johnson', '2233445566', 'adminPass1'),
(9, 'james_williams', 'James Williams', '3344556677', 'qwerty1234'),
(10, 'patricia_brown', 'Patricia Brown', '4455667788', 'abc123!@#'),
(11, 'robert_davis', 'Robert Davis', '5566778899', 'letmein2023'),
(12, 'linda_martin', 'Linda Martin', '6677889900', 'securePass1'),
(13, 'michael_lee', 'Michael Lee', '7788990011', 'Test@12345'),
(14, 'elizabeth_garcia', 'Elizabeth Garcia', '8899001122', 'newpassword99'),
(15, 'rifatkhan', 'Rifat Khan', '015331488', '123qwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
