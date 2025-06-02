-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 03:36 PM
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
-- Table structure for table `users_cred`
--

CREATE TABLE `users_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(300) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_cred`
--

INSERT INTO `users_cred` (`id`, `name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `is_verified`, `token`, `t_expire`, `status`, `dateTime`) VALUES
(10, 'Chandan Yadav', 'febegor397@frisbook.com', '12345678', 'IMG_1217118389.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-29', '$2y$10$z9Gf8DuvebSTM6sI7D6Mru0FQxk5sXHzbcDQFoVsgT66uCTTjLcUa', 1, '08b019e728bc3069b291ceab507484a6', NULL, 0, '2025-05-29 14:02:14'),
(12, 'Chandan Yadav', 'cy96748328@gmail.com', '123456', 'IMG_2605428119.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-30', '$2y$10$6CIuXrzxNq2FpZGqp2Zmjes3kjcwAra8P2gZIunj.9yMH1RP7WfyW', 1, NULL, NULL, 1, '2025-05-29 15:42:06'),
(13, 'Chandan Yadav', 'cy967.48328@gmail.com', '1234569852', 'IMG_6489408395.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-30', '$2y$10$olrcVGcjGsl6CxzwgvTzS.qbgEC24NhHcSxXY75q5YiFJOZr9VZuy', 1, NULL, NULL, 1, '2025-05-30 09:11:59'),
(14, 'Ch Yadav', 'demo878815194.9@gmail.com', '1456987', 'IMG_8504992759.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-31', '$2y$10$2JfruGdXF3v0Bg1atNYtB.iUSDBqcwR0UCaSQCtfNMdCuA3q0cyCi', 0, '4d10a3c63159c4d3c1ba07ea68456426', NULL, 1, '2025-05-31 11:38:42'),
(15, 'Ch Yadav', 'de.mo8788151949@gmail.com', '96736000000', 'IMG_6370586647.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-31', '$2y$10$ROcFCD0IBgvZJBPRZg8e1OGVpozhwoid5x08I3coT8g/iDxmlzkbW', 1, 'e2f25f5d1ec88f4a33502b06a01f77e4', NULL, 1, '2025-05-31 11:39:30'),
(16, 'Chandani Yadav', 'cy9.6748328@gmail.com', '9879787979', 'IMG_2047857468.jpeg', 'Room no 106,Sarswati welfare Society,raghukul Nagar, Valai pada road, Santosh bhavan, Nallasopara(east)-401209', 401209, '2025-05-30', '$2y$10$c6hTWm5qzswedJiQ3QAFHO/.E/eeX772rXGOUAZ/W9G6LIrN3lGwO', 0, '16ea78efb3750c58357d130a852cb474', NULL, 1, '2025-05-31 22:04:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_cred`
--
ALTER TABLE `users_cred`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_cred`
--
ALTER TABLE `users_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
