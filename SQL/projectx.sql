-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2018 at 02:33 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.2.5-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectx`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CommonStation` (IN `mrt1` INT, IN `mrt2` INT)  NO SQL
SELECT t1.stationId FROM stop as t1 , stop as t2 WHERE t1.mrtNo = mrt1
AND t2.mrtNo = mrt2 AND t1.stationId = t2.stationId LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `connectedMRT` (IN `varMrtNo` INT)  NO SQL
SELECT DISTINCT(t1.mrtNo) FROM stop as t1 , stop as t2
WHERE t1.stationId IN (SELECT t3.stationId FROM stop as t3 WHERE t3.mrtNo = varMrtNo)
AND t1.stationId = t2.stationId
AND t1.mrtNo != t2.mrtNo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `connectedMRT2` (IN `varMrtNo` INT)  NO SQL
SELECT * FROM (SELECT DISTINCT(t1.mrtNo) as source FROM stop as t1 , stop as t2
WHERE t1.stationId IN (SELECT t3.stationId FROM stop as t3 WHERE t3.mrtNo = varMrtNo)
AND t1.stationId = t2.stationId
AND t1.mrtNo != t2.mrtNo) AS t4, (SELECT DISTINCT(t1.mrtNo) as destination FROM stop as t1 , stop as t2
WHERE t1.stationId IN (SELECT t3.stationId FROM stop as t3 WHERE t3.mrtNo = varMrtNo)
AND t1.stationId = t2.stationId
AND t1.mrtNo != t2.mrtNo) as t5
WHERE t4.source = varMrtNo
AND t5.destination != varMrtNo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mrtJunction stationWise` (IN `varStationId` INT)  NO SQL
SELECT DISTINCT(t1.mrtNo) FROM stop as t1 , stop as t2
WHERE t1.stationId = varStationId
AND t1.stationId = t2.stationId
AND t1.mrtNo != t2.mrtNo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stationNameThroughId` (IN `varStationId` INT)  NO SQL
SELECT station.stationName FROM station WHERE station.stationId = varStationId$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(255) DEFAULT NULL,
  `customerBankAcc` varchar(255) DEFAULT NULL,
  `customerAddress` varchar(255) DEFAULT NULL,
  `customerPhoneNumber` varchar(255) DEFAULT NULL,
  `customerBloodGroup` varchar(10) DEFAULT NULL,
  `customerBalance` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerName`, `customerBankAcc`, `customerAddress`, `customerPhoneNumber`, `customerBloodGroup`, `customerBalance`) VALUES
(1, 'Abdullah Al Rifat', NULL, NULL, NULL, NULL, -17900);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeId` int(11) NOT NULL,
  `employeeName` varchar(255) DEFAULT NULL,
  `employeeBankAcc` varchar(255) DEFAULT NULL,
  `employeeAddress` varchar(255) DEFAULT NULL,
  `employeePhoneNumber` varchar(255) DEFAULT NULL,
  `jobDescription` varchar(25) DEFAULT NULL,
  `stationId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrt`
--

CREATE TABLE `mrt` (
  `mrtNo` int(11) NOT NULL,
  `mrtName` varchar(255) DEFAULT NULL,
  `mrtStartP1` int(11) DEFAULT NULL,
  `mrtStartP2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrt`
--

INSERT INTO `mrt` (`mrtNo`, `mrtName`, `mrtStartP1`, `mrtStartP2`) VALUES
(6, 'MRT 6', 16, 1),
(7, 'MRT 7', 17, 24),
(8, 'MRT 8', 25, 36),
(9, 'MRT 9', 33, 38),
(10, 'MRT 10', 33, 41),
(11, 'MRT 11', 43, 44);

-- --------------------------------------------------------

--
-- Table structure for table `mrtschedule`
--

CREATE TABLE `mrtschedule` (
  `scheduleId` int(11) NOT NULL,
  `trainId` int(11) DEFAULT NULL,
  `mrtNo` int(11) DEFAULT NULL,
  `startStation` int(11) DEFAULT NULL,
  `endStation` int(11) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `errorTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `stationId` int(11) NOT NULL,
  `stationName` varchar(255) DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  `Latitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`stationId`, `stationName`, `Longitude`, `Latitude`) VALUES
(1, 'North Uttara', 90.379544, 23.875855),
(2, 'Center Uttara ', 90.398162, 23.872856),
(3, 'Uttara South', 90.38735, 23.875643),
(4, 'Pallabi', 90.366295, 23.825921),
(5, 'Mirpur 11', 90.36615, 23.815902),
(6, 'Mirpur 10', 90.368609, 23.806866),
(7, 'KAJIPARA', 90.372798, 23.797228),
(8, 'Shewrapara', 90.375671, 23.790447),
(9, 'Agargao', 90.380667, 23.776808),
(10, 'Bijoy saroni', 90.383504, 23.765197),
(11, 'Farmgate', 90.389972, 23.758336),
(12, 'Karwan Bazar', 90.393155, 23.749919),
(13, 'Shahbagh', 90.395675, 23.73728),
(14, 'Dhaka University', 90.392812, 23.732637),
(15, 'Press Club', 90.406058, 23.729962),
(16, 'Motijheel', 90.417356, 23.732922),
(17, 'Mohammodpur', 90.36094, 23.757137),
(18, 'shongkor', 90.368235, 23.750621),
(19, 'dhanmondi 15', 90.372741, 23.743971),
(20, 'jigatola', 90.375582, 23.73922),
(21, 'Science Lab', 90.383477, 23.738839),
(22, 'kakrail', 90.408581, 23.737602),
(23, 'malibag', 90.414, 23.744019),
(24, 'mouchak', 90.495649, 23.694066),
(25, 'gabtoli', 90.344287, 23.78373),
(26, 'mazar road', 90.348458, 23.79165),
(27, 'konabari', 90.348845, 23.795001),
(28, 'mirpur 1', 90.353128, 23.798462),
(29, 'mirpur 2', 90.366427, 23.806573),
(30, 'mipur 14', 90.378252, 23.751173),
(31, 'kochukhet', 90.387857, 23.791607),
(32, 'shainik club', 90.400269, 23.790486),
(33, 'banani', 90.400951, 23.79438),
(34, 'kakoli', 90.403994, 23.7463),
(35, 'gulshan 2', 90.413235, 23.796911),
(36, 'notun bazar', 90.423486, 23.797615),
(37, 'P', 93.400269, 24.790486),
(38, 'Q', 93.400951, 24.79438),
(39, 'R', 93.403994, 24.7463),
(40, 'S', 93.413235, 24.796911),
(41, 'T', 93.423486, 24.797615),
(42, 'V', 93.723486, 24.897615),
(43, 'W', 95.32735, 25.835643),
(44, 'X', 95.49735, 25.675643);

-- --------------------------------------------------------

--
-- Table structure for table `stop`
--

CREATE TABLE `stop` (
  `stopId` int(11) NOT NULL,
  `stationId` int(11) DEFAULT NULL,
  `mrtNo` int(11) DEFAULT NULL,
  `orderNo` int(11) DEFAULT NULL,
  `reachTimeFromP1` time DEFAULT NULL,
  `reachTimeFromP2` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stop`
--

INSERT INTO `stop` (`stopId`, `stationId`, `mrtNo`, `orderNo`, `reachTimeFromP1`, `reachTimeFromP2`) VALUES
(1, 1, 6, 35, '00:40:00', '00:00:00'),
(2, 2, 6, 34, '00:37:00', '00:03:00'),
(3, 3, 6, 33, '00:35:00', '00:05:00'),
(4, 4, 6, 32, '00:32:00', '00:08:00'),
(5, 5, 6, 31, '00:29:00', '00:11:00'),
(6, 6, 6, 30, '00:26:00', '00:14:00'),
(7, 7, 6, 29, '00:23:00', '00:17:00'),
(8, 8, 6, 28, '00:20:00', '00:20:00'),
(9, 9, 6, 27, '00:17:00', '00:23:00'),
(10, 10, 6, 26, '00:15:00', '00:25:00'),
(11, 11, 6, 25, '00:13:00', '00:27:00'),
(12, 12, 6, 24, '00:10:00', '00:30:00'),
(13, 13, 6, 23, '00:07:00', '00:33:00'),
(14, 14, 6, 22, '00:05:00', '00:35:00'),
(15, 15, 6, 21, '00:02:00', '00:38:00'),
(16, 16, 6, 20, '00:00:00', '00:40:00'),
(17, 17, 7, 20, '00:00:00', '00:22:00'),
(18, 18, 7, 21, '00:03:00', '00:19:00'),
(19, 19, 7, 22, '00:05:00', '00:17:00'),
(20, 20, 7, 23, '00:07:00', '00:15:00'),
(21, 21, 7, 24, '00:10:00', '00:12:00'),
(22, 13, 7, 25, '00:12:00', '00:10:00'),
(23, 22, 7, 26, '00:16:00', '00:06:00'),
(24, 23, 7, 27, '00:20:00', '00:02:00'),
(25, 24, 7, 28, '00:22:00', '00:00:00'),
(26, 25, 8, 20, '00:00:00', '00:30:00'),
(27, 26, 8, 21, '00:05:00', '00:25:00'),
(28, 27, 8, 22, '00:07:00', '00:23:00'),
(29, 28, 8, 23, '00:08:00', '00:22:00'),
(30, 29, 8, 24, '00:10:00', '00:20:00'),
(31, 6, 8, 25, '00:12:00', '00:18:00'),
(32, 30, 8, 26, '00:14:00', '00:16:00'),
(33, 31, 8, 27, '00:18:00', '00:12:00'),
(34, 32, 8, 28, '00:20:00', '00:10:00'),
(35, 33, 8, 29, '00:23:00', '00:07:00'),
(36, 34, 8, 30, '00:26:00', '00:04:00'),
(37, 35, 8, 31, '00:28:00', '00:02:00'),
(38, 36, 8, 32, '00:30:00', '00:00:00'),
(133, 33, 9, 20, '00:00:00', '00:23:00'),
(134, 37, 9, 21, '00:05:00', '00:18:00'),
(135, 38, 9, 22, '00:10:00', '00:13:00'),
(136, 39, 10, 20, '00:05:00', '00:15:00'),
(137, 40, 10, 21, '00:10:00', '00:10:00'),
(138, 41, 10, 22, '00:20:00', '00:00:00'),
(148, 42, 9, 23, '00:16:00', '00:07:00'),
(149, 27, 9, 24, '00:23:00', '00:00:00'),
(150, 33, 10, 23, '00:00:00', '00:20:00'),
(151, 43, 11, 20, '00:00:00', '00:10:00'),
(152, 44, 11, 21, '00:10:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ticketPrice`
--

CREATE TABLE `ticketPrice` (
  `id` int(11) NOT NULL,
  `ticketType` varchar(255) DEFAULT NULL,
  `ticketPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketPrice`
--

INSERT INTO `ticketPrice` (`id`, `ticketType`, `ticketPrice`) VALUES
(1, 'Singel', 25),
(2, 'Daily', 100),
(3, 'Weekly', 500),
(4, 'Monthly', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketId` int(11) NOT NULL,
  `issueDate` datetime DEFAULT NULL,
  `validDate` datetime DEFAULT NULL,
  `price` double DEFAULT NULL,
  `ticketType` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketId`, `issueDate`, `validDate`, `price`, `ticketType`, `customerId`) VALUES
(1, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(2, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(3, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(4, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(5, '2018-05-12 00:00:00', '2018-05-12 00:00:00', 25, 1, 1),
(6, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(7, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(8, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(9, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(10, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(11, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(12, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(13, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(14, '2018-05-12 00:00:00', '2018-05-12 00:00:00', 25, 1, 1),
(15, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(16, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(17, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(18, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1),
(19, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(20, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(21, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(22, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(23, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(24, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(25, '2018-05-12 00:00:00', '2018-05-19 00:00:00', 500, 3, 1),
(26, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(27, '2018-05-12 00:00:00', '2018-05-12 00:00:00', 25, 1, 1),
(28, '2018-05-12 00:00:00', '2018-05-12 00:00:00', 25, 1, 1),
(29, '2018-05-12 00:00:00', '2018-05-13 00:00:00', 100, 2, 1),
(30, '2018-05-12 00:00:00', '2018-06-11 00:00:00', 1500, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `trainId` int(11) NOT NULL,
  `trainName` int(11) DEFAULT NULL,
  `trainNo` int(11) DEFAULT NULL,
  `trainCapacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Abdullah Al Rifat', 'abdullahalrifat95@gmail.com', '1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeId`),
  ADD KEY `stationId` (`stationId`);

--
-- Indexes for table `mrt`
--
ALTER TABLE `mrt`
  ADD PRIMARY KEY (`mrtNo`),
  ADD KEY `mrtStartP1` (`mrtStartP1`),
  ADD KEY `mrtStartP2` (`mrtStartP2`);

--
-- Indexes for table `mrtschedule`
--
ALTER TABLE `mrtschedule`
  ADD PRIMARY KEY (`scheduleId`),
  ADD KEY `trainId` (`trainId`),
  ADD KEY `mrtNo` (`mrtNo`),
  ADD KEY `startStation` (`startStation`),
  ADD KEY `endStation` (`endStation`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`stationId`);

--
-- Indexes for table `stop`
--
ALTER TABLE `stop`
  ADD PRIMARY KEY (`stopId`),
  ADD KEY `stationId` (`stationId`),
  ADD KEY `mrtNo` (`mrtNo`);

--
-- Indexes for table `ticketPrice`
--
ALTER TABLE `ticketPrice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `ticketType` (`ticketType`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`trainId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrtschedule`
--
ALTER TABLE `mrtschedule`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `stationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `stop`
--
ALTER TABLE `stop`
  MODIFY `stopId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `trainId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `user` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`stationId`) REFERENCES `station` (`stationId`);

--
-- Constraints for table `mrt`
--
ALTER TABLE `mrt`
  ADD CONSTRAINT `mrt_ibfk_1` FOREIGN KEY (`mrtStartP1`) REFERENCES `station` (`stationId`),
  ADD CONSTRAINT `mrt_ibfk_2` FOREIGN KEY (`mrtStartP2`) REFERENCES `station` (`stationId`);

--
-- Constraints for table `mrtschedule`
--
ALTER TABLE `mrtschedule`
  ADD CONSTRAINT `mrtschedule_ibfk_1` FOREIGN KEY (`trainId`) REFERENCES `train` (`trainId`),
  ADD CONSTRAINT `mrtschedule_ibfk_2` FOREIGN KEY (`mrtNo`) REFERENCES `mrt` (`mrtNo`),
  ADD CONSTRAINT `mrtschedule_ibfk_3` FOREIGN KEY (`startStation`) REFERENCES `station` (`stationId`),
  ADD CONSTRAINT `mrtschedule_ibfk_4` FOREIGN KEY (`endStation`) REFERENCES `station` (`stationId`);

--
-- Constraints for table `stop`
--
ALTER TABLE `stop`
  ADD CONSTRAINT `stop_ibfk_1` FOREIGN KEY (`stationId`) REFERENCES `station` (`stationId`),
  ADD CONSTRAINT `stop_ibfk_2` FOREIGN KEY (`mrtNo`) REFERENCES `mrt` (`mrtNo`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`ticketType`) REFERENCES `ticketPrice` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`customerId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;