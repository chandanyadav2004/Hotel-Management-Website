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
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `phonenum` varchar(10) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(21, 26, 'Luxury Room', 800, 6400, 101, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(22, 27, 'Luxury Room', 800, 6400, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(23, 28, 'Luxury Room', 800, 6400, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(24, 29, 'Delux Room', 500, 4000, 102, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(25, 30, 'Luxury Room', 800, 6400, 103, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(26, 31, 'Luxury Room', 800, 6400, 101, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(27, 32, 'Luxury Room', 800, 6400, 10245, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(28, 33, 'Luxury Room', 800, 6400, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(29, 34, 'Delux Room', 500, 3500, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(30, 35, 'Delux Room', 500, 3500, 10245, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(31, 36, 'Delux Room', 500, 3500, 10245, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(32, 37, 'Simple Room', 300, 2100, 10245, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(33, 38, 'Delux Room', 500, 3500, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(34, 39, 'Delux Room', 500, 3000, NULL, 'Chandan Yadav', '123456789', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(35, 40, 'Luxury Room', 800, 5600, 1015, 'Ch Yadav', '9673600000', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(36, 41, 'Simple Room', 300, 4800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(37, 42, 'Simple Room', 300, 4800, 102, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(38, 43, 'Delux Room', 500, 7500, 456, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(39, 44, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(40, 45, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(41, 46, 'Luxury Room', 800, 800, 879, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(42, 47, 'Super Luxury', 800, 1600, 101, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(43, 48, 'Luxury Room', 800, 7200, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(44, 49, 'Luxury Room', 800, 7200, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(45, 50, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(46, 51, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(47, 52, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(48, 53, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(49, 54, 'Luxury Room', 800, 800, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(50, 55, 'Simple Room', 300, 300, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209'),
(51, 56, 'Simple Room', 300, 300, NULL, 'Chandan Yadav', '1234569852', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
