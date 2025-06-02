-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 03:34 PM
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
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(300) DEFAULT NULL,
  `rate_reviews` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `rate_reviews`, `datetime`) VALUES
(26, 13, 5, '2025-05-30', '2025-06-07', 1, NULL, 'Booked', 'order_QbBniuMPfJLYbu', 'pay_QbBnrmmvdmRLrU', 6400, 'Success', NULL, 1, '2025-05-30 20:56:10'),
(27, 13, 5, '2025-05-30', '2025-06-07', 0, 1, 'cancelled', 'order_QbBr3gdHyj4LmT', 'pay_QbBrBvvUekEDIH', 6400, 'Success', NULL, NULL, '2025-05-30 20:59:19'),
(28, 13, 5, '2025-05-30', '2025-06-07', 0, 1, 'cancelled', 'order_QbBtMUiairsgE5', 'pay_QbBtXGK79u9kVn', 6400, 'Success', NULL, NULL, '2025-05-30 21:01:30'),
(29, 13, 4, '2025-05-30', '2025-06-07', 1, NULL, 'Booked', 'order_QbCC50ufFeWydp', 'pay_QbCCCIlB82LPbJ', 4000, 'Success', NULL, 1, '2025-05-30 21:19:13'),
(30, 13, 5, '2025-05-30', '2025-06-07', 1, NULL, 'Booked', 'order_QbCJcuLD51EWt2', 'pay_QbCJjPAtr7OWRY', 6400, 'Success', NULL, 1, '2025-05-30 21:26:22'),
(31, 13, 5, '2025-05-30', '2025-06-07', 1, NULL, 'Booked', 'order_QbCMbaLfexwxnU', 'pay_QbCMkeppJIkWBe', 6400, 'Success', NULL, 1, '2025-05-30 21:29:11'),
(32, 13, 5, '2025-05-30', '2025-06-07', 1, NULL, 'Booked', 'order_QbCNjUEczzR6m6', 'pay_QbCNpsWsnRgQk9', 6400, 'Success', NULL, 1, '2025-05-30 21:30:15'),
(33, 13, 5, '2025-05-30', '2025-06-07', 0, 0, 'cancelled', 'order_QbCQJmzekHMvVr', 'pay_QbCQQl8iULHQvt', 6400, 'Success', NULL, 0, '2025-05-30 21:32:42'),
(34, 13, 4, '2025-05-31', '2025-06-07', 0, NULL, 'pending', 'order_QbN67PxcJJM8Xv', NULL, 0, 'pending', NULL, 1, '2025-05-31 07:59:13'),
(35, 13, 4, '2025-05-31', '2025-06-07', 1, NULL, 'Booked', 'order_QbN68fQdEF63wd', 'pay_QbN6HFt4Jh7lGV', 3500, 'Success', NULL, 1, '2025-05-31 07:59:14'),
(36, 13, 4, '2025-05-31', '2025-06-07', 1, NULL, 'Booked', 'order_QbN7fYuzqD26jk', 'pay_QbN7p8EMzNqrSF', 3500, 'Success', NULL, 1, '2025-05-31 08:00:41'),
(37, 13, 3, '2025-05-31', '2025-06-07', 1, NULL, 'Booked', 'order_QbNABte2QNwvp1', 'pay_QbNALKQuypLs5C', 2100, 'Success', NULL, 1, '2025-05-31 08:03:04'),
(38, 13, 4, '2025-05-31', '2025-06-07', 0, 0, 'cancelled', 'order_QbOWJX6PCCUBbd', 'pay_QbOWSvyiTEShE4', 3500, 'Success', NULL, NULL, '2025-05-31 09:22:42'),
(39, 13, 4, '2025-05-31', '2025-06-06', 0, 1, 'cancelled', 'order_QbOfSOtOl1X6oA', 'pay_QbOfZf4hvwLOWK', 3000, 'Success', NULL, NULL, '2025-05-31 09:31:22'),
(40, 15, 5, '2025-05-31', '2025-06-07', 1, NULL, 'Booked', 'order_QbQxKysHV0oO15', 'pay_QbQxRv3uIiMpkt', 5600, 'Success', NULL, 0, '2025-05-31 11:45:40'),
(41, 13, 3, '2025-06-01', '2025-06-17', 0, NULL, 'pending', 'order_QbqbfBQARygwGY', NULL, 0, 'pending', NULL, NULL, '2025-06-01 12:51:10'),
(42, 13, 3, '2025-06-01', '2025-06-17', 1, NULL, 'Booked', 'order_QbqbgYOzusTkmY', 'pay_QbqbpAngxTCsxI', 4800, 'Success', NULL, 1, '2025-06-01 12:51:11'),
(43, 13, 4, '2025-06-01', '2025-06-16', 1, NULL, 'Booked', 'order_QbqcOwLMfCQNuz', 'pay_QbqcXpwDxFuRKG', 7500, 'Success', NULL, 1, '2025-06-01 12:51:51'),
(44, 13, 5, '2025-06-24', '2025-06-25', 0, NULL, 'pending', 'order_QbqdSeXBpMg8sT', NULL, 0, 'pending', NULL, NULL, '2025-06-01 12:52:52'),
(45, 13, 5, '2025-06-24', '2025-06-25', 0, NULL, 'pending', 'order_QbqdTg7pazdhv5', NULL, 0, 'pending', NULL, NULL, '2025-06-01 12:52:53'),
(46, 13, 5, '2025-06-24', '2025-06-25', 1, NULL, 'Booked', 'order_QbqdUfpIPVVD17', 'pay_QbqdbnM9Zof1OG', 800, 'Success', NULL, 1, '2025-06-01 12:52:53'),
(47, 13, 6, '2025-06-23', '2025-06-25', 1, NULL, 'Booked', 'order_QbqteA8vthZhzX', 'pay_QbqtnPtvwmKTIZ', 1600, 'Success', NULL, 1, '2025-06-01 13:08:11'),
(48, 13, 5, '2025-06-01', '2025-06-10', 0, NULL, 'pending', 'order_QbwlULXbI2pIwJ', NULL, 0, 'pending', NULL, NULL, '2025-06-01 18:52:38'),
(49, 13, 5, '2025-06-01', '2025-06-10', 0, NULL, 'Booked', 'order_QbwlVWqXL40EBT', 'pay_Qbwlg2VOPh7kGy', 7200, 'Success', NULL, NULL, '2025-06-01 18:52:39'),
(50, 13, 5, '2025-06-09', '2025-06-10', 0, NULL, 'Booked', 'order_QbwmEaXyyYDuh2', 'pay_QbwmMjblmPeyPT', 800, 'Success', NULL, NULL, '2025-06-01 18:53:20'),
(51, 13, 5, '2025-06-02', '2025-06-03', 0, NULL, 'pending', 'order_Qbwx4IhJ89oUOR', NULL, 0, 'pending', NULL, NULL, '2025-06-01 19:03:35'),
(52, 13, 5, '2025-06-02', '2025-06-03', 0, NULL, 'Booked', 'order_Qbwx5PrH6VULdT', 'pay_QbwxDq6eSZ4KIR', 800, 'Success', NULL, NULL, '2025-06-01 19:03:36'),
(53, 13, 5, '2025-06-02', '2025-06-03', 0, NULL, 'Booked', 'order_Qbx1bVMPuilxyD', 'pay_Qbx1k2E6xWxXMM', 800, 'Success', NULL, NULL, '2025-06-01 19:07:53'),
(54, 13, 5, '2025-06-02', '2025-06-03', 0, 0, 'cancelled', 'order_Qbx3a11bmZdMr4', 'pay_Qbx3kUW9sU17xB', 800, 'Success', NULL, NULL, '2025-06-01 19:09:45'),
(55, 13, 3, '2025-06-02', '2025-06-03', 0, NULL, 'pending', 'order_QbxRGp6bcEAUbK', NULL, 0, 'pending', NULL, NULL, '2025-06-01 19:32:11'),
(56, 13, 3, '2025-06-02', '2025-06-03', 0, NULL, 'pending', 'order_QbxSQwVPhh31MY', NULL, 0, 'pending', NULL, NULL, '2025-06-01 19:33:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `booking_order_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
