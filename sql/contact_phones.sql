-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 29, 2024 at 11:50 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_phones`
--

CREATE TABLE `contact_phones` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hide_phone` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_phones`
--

INSERT INTO `contact_phones` (`id`, `contact_id`, `phone`, `hide_phone`) VALUES
(1, 26, '0499949494', 0),
(2, 26, '0499949494', 0),
(13, 32, '0499949494', 1),
(29, 41, '+38163425510', 0),
(30, 41, '0499949494', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_phones`
--
ALTER TABLE `contact_phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_phones`
--
ALTER TABLE `contact_phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_phones`
--
ALTER TABLE `contact_phones`
  ADD CONSTRAINT `contact_phones_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
