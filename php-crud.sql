-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 05:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_test`
--

CREATE TABLE `user_test` (
  `id` int(20) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `language` varchar(255) NOT NULL,
  `profile_image` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_test`
--

INSERT INTO `user_test` (`id`, `first_name`, `last_name`, `email`, `gender`, `password`, `language`, `profile_image`) VALUES
(78, 'Thakur Jay', 'Sunilbhai', 'jaythakur509855@gmail.co', 'male', '$2y$10$bIuOu8gQHzLd45yGA7mr6uSxMccIGUCE3nK9IzO.xK8BMECsR.Ozq', 'English', ''),
(79, 'Thakur Jay', 'Sunilbhai', 'thakurjay.sw002@gmail.com', 'male', '$2y$10$zbleB3SMkH9PdiWgZFPpsOBnATQLInBz/ow6oTlB592Xtan1QonP6', 'English', ''),
(80, 'diguwef', 'fegeifwu', 'jaythakur509855@gmail.co', 'male', '$2y$10$zV8ymfBJqn.Dlk5HaBjCsuZmK3d00ltDiF.i3dzWMmeQn5a9OKdhu', 'English', ''),
(81, 'Thakur Jay', 'Sunilbhai', 'thakurjay@gmail.com', 'male', '$2y$10$ujktPonxmbd5R2beP1ZW/OEO1Cg1os/ke6cG2oxf5kWTBIqvjT4YC', 'English', ''),
(82, '.Thakur Jay.', '. Sunilbhai.', '. is@mil.com.', '. male.', '. Satyam@123.', '. English.', '. .'),
(83, '.Thakur Jay.', '. Sunilbhai.', '. jaythakur509855@gmail.co.', '. male.', '. Satyam@123.', '. English.', '. .');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_test`
--
ALTER TABLE `user_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_test`
--
ALTER TABLE `user_test`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
