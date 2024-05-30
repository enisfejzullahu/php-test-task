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
-- Table structure for table `contact_emails`
--

CREATE TABLE `contact_emails` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hide_email` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_emails`
--

INSERT INTO `contact_emails` (`id`, `contact_id`, `email`, `hide_email`) VALUES
(1, 26, 'fejzullahuenis@gmail.com', 0),
(2, 26, 'e@gmail.com', 0),
(12, 32, 'fejzullahuenis@gmail.com', 0),
(27, 41, 'fejzullahuenis@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_emails`
--
ALTER TABLE `contact_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_emails`
--
ALTER TABLE `contact_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_emails`
--
ALTER TABLE `contact_emails`
  ADD CONSTRAINT `contact_emails_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
