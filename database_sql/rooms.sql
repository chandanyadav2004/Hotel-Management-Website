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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(400) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remove` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `remove`) VALUES
(1, 'Chandan12', 145, 54000, 20, 4, 2, 'Master Bedroom', 0, 1),
(2, 'simple room 145', 458, 54800, 12, 5, 1, 'Simple  Room', 1, 1),
(3, 'Simple Room', 250, 300, 10, 5, 3, 'Simple Rooms At 300 mrp\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assumenda repellat beatae sapiente perspiciatis aut omnis quae? Molestiae minima nisi vero.', 1, 0),
(4, 'Delux Room', 300, 500, 10, 3, 2, 'Delux Room at 500 Mrp\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assumenda repellat beatae sapiente perspiciatis aut omnis quae? Molestiae minima nisi vero.', 1, 0),
(5, 'Luxury Room', 350, 800, 2, 8, 2, 'Luxury Room at 800\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assumenda repellat beatae sapiente perspiciatis aut omnis quae? Molestiae minima nisi vero.', 1, 0),
(6, 'Super Luxury', 400, 800, 5, 5, 2, 'Super Luxury Hotel Chandan Hotel Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae obcaecati odio delectus cum commodi, ipsa iure voluptatum assumenda repellat beatae sapiente perspiciatis aut omnis quae? Molestiae minima nisi vero.', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
