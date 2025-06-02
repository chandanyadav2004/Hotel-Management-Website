-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 03:35 PM
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
-- Database: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `rate_review`
--

CREATE TABLE `rate_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(150) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate_review`
--

INSERT INTO `rate_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datetime`) VALUES
(10, 46, 5, 13, 5, '1 Chandan Hotel Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assum', 0, '2025-06-01 12:54:20'),
(11, 43, 4, 13, 4, '2 Chandan Hotel Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assum', 0, '2025-06-01 12:54:31'),
(12, 42, 3, 13, 2, '3 Chandan Hotel Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assum', 0, '2025-06-01 12:54:41'),
(13, 47, 6, 13, 5, '4 Chandan Hotel\r\nChandan Hotel Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure v', 0, '2025-06-01 13:09:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD CONSTRAINT `rate_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rate_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rate_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users_cred` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
