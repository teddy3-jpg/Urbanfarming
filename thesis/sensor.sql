-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 03:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urban`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `temp` varchar(100) NOT NULL,
  `hum` varchar(100) NOT NULL,
  `moisture` varchar(100) NOT NULL,
  `water` varchar(100) NOT NULL,
  `light` varchar(100) NOT NULL,
  `alarm` varchar(100) NOT NULL,
  `timestamp` timestamp(2) NULL DEFAULT current_timestamp(2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id`, `temp`, `hum`, `moisture`, `water`, `light`, `alarm`, `timestamp`) VALUES
(1, '24', '60', '72', '400', '96', 'off', '2020-11-08 23:15:23.24'),
(2, '24', '58', '73', '410', '110', 'on', '2020-11-08 23:15:23.24'),
(6, '18', '45', '70', '300', '93', 'off', '2020-11-08 23:15:23.24'),
(7, '15', '40', '75', '105', '123', 'off', '2020-11-08 23:15:23.24'),
(8, '20', '50', '72', '52', '136', 'on', '2020-11-08 23:15:23.24'),
(9, '23', '52', '54', '230', '300', 'off', '2020-11-13 23:17:14.00'),
(10, '23', '52', '54', '230', '300', 'off', '2020-12-01 23:17:51.00'),
(11, '22', '60', '89', '500', '85', 'off', '2020-11-08 23:26:02.65'),
(13, '24', '60', '72', '400', '90', 'off', '2020-11-08 23:54:37.80');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
