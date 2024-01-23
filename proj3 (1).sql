-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 07:47 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj3`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenancerequest`
--

CREATE TABLE `maintenancerequest` (
  `requestID` int(11) NOT NULL,
  `apartmentNumber` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `problemDescription` text DEFAULT NULL,
  `requestDateTime` datetime DEFAULT NULL,
  `photoPath` varchar(255) DEFAULT NULL,
  `status` enum('Pending','In-Progress','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenancerequest`
--

INSERT INTO `maintenancerequest` (`requestID`, `apartmentNumber`, `area`, `problemDescription`, `requestDateTime`, `photoPath`, `status`) VALUES
(1, 207, 'Kitchen', 'Leaky Sink', '2023-11-04 11:00:41', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_requests`
--

CREATE TABLE `maintenance_requests` (
  `requestID` int(11) NOT NULL,
  `apartmentNumber` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `problemDescription` text NOT NULL,
  `requestDateTime` datetime NOT NULL,
  `photoPath` varchar(255) NOT NULL,
  `status` enum('Pending','In-Progress','Completed','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_requests`
--

INSERT INTO `maintenance_requests` (`requestID`, `apartmentNumber`, `area`, `problemDescription`, `requestDateTime`, `photoPath`, `status`) VALUES
(1, 1234, 'etc', 'etc', '2023-12-05 19:20:28', 'uploads/spectral-light-illuminates-transparent-red-colored-red-roses-abstract-flower-art-generative-ai.jpg', 'Pending'),
(2, 6767, 'txt', 'text', '2023-12-05 19:32:27', 'uploads/WhatsApp Image 2023-11-09 at 9.27.59 PM.jpeg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenantID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `checkInDate` date DEFAULT NULL,
  `checkOutDate` date DEFAULT NULL,
  `apartmentNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenantID`, `name`, `phoneNumber`, `email`, `checkInDate`, `checkOutDate`, `apartmentNumber`) VALUES
(1, 'Anosh Mian', '69420', 'anoshmian@gmail.com', '2023-11-01', '2023-11-30', 207);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype` enum('Manager','Staff','Tenant') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `email`, `password`) VALUES
(1, 'Manager', 'hza5260@psu.edu', 'Rocket786*'),
(3, 'Tenant', 'check@that.com', '123*check'),
(4, 'Staff', 'check@it.com', 'check*123'),
(5, 'Tenant', 'check@why.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenancerequest`
--
ALTER TABLE `maintenancerequest`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenantID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
