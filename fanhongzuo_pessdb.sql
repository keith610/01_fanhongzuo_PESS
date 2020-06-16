-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 03:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fanhongzuo_pessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

CREATE TABLE `dispatch` (
  `incidentId` int(11) NOT NULL,
  `patrolcarId` varchar(10) CHARACTER SET latin1 NOT NULL,
  `timeDispatched` datetime NOT NULL,
  `timeArrived` datetime DEFAULT NULL,
  `timeCompleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dispatch`
--

INSERT INTO `dispatch` (`incidentId`, `patrolcarId`, `timeDispatched`, `timeArrived`, `timeCompleted`) VALUES
(56, 'XX2222K', '2020-04-30 15:35:31', '2020-05-05 15:17:07', NULL),
(57, 'AB5554D', '2020-05-05 15:21:04', '2020-05-05 15:21:33', NULL),
(58, 'QQ1111Q', '2020-05-06 10:06:36', '2020-05-06 10:09:34', '2020-05-06 10:50:30'),
(59, 'XX1111X', '2020-05-06 12:17:04', '2020-05-06 12:18:03', '2020-05-06 12:17:36'),
(60, 'QQ1111Q', '2020-05-08 09:12:57', '2020-05-08 09:20:52', '2020-05-08 09:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incidentId` int(11) NOT NULL,
  `callerName` varchar(30) CHARACTER SET latin1 NOT NULL,
  `phoneNumber` varchar(10) CHARACTER SET latin1 NOT NULL,
  `incidentTypeid` varchar(3) CHARACTER SET latin1 NOT NULL,
  `incidentLocation` varchar(50) CHARACTER SET latin1 NOT NULL,
  `incidentDesc` varchar(100) CHARACTER SET latin1 NOT NULL,
  `incidentStatusld` varchar(1) CHARACTER SET latin1 NOT NULL,
  `timeCalled` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incidentId`, `callerName`, `phoneNumber`, `incidentTypeid`, `incidentLocation`, `incidentDesc`, `incidentStatusld`, `timeCalled`) VALUES
(60, 'hongzuo', '87662385', '050', 'Ang Mo Kio Ave 1', 'Fallen tree at Ang Mo Kio Ave 1', '3', '2020-05-08 01:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `incidenttype`
--

CREATE TABLE `incidenttype` (
  `incidentTypeId` varchar(3) CHARACTER SET latin1 NOT NULL,
  `incidentTypeDesc` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incidenttype`
--

INSERT INTO `incidenttype` (`incidentTypeId`, `incidentTypeDesc`) VALUES
('070', 'Loan Shark'),
('010', 'Fire'),
('020', 'Riot'),
('030', 'Burglary'),
('040', 'Domestic Violent'),
('050', 'Fallen Tree'),
('060', 'Traffic Accident'),
('999', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `incident_status`
--

CREATE TABLE `incident_status` (
  `statusId` varchar(1) CHARACTER SET latin1 NOT NULL,
  `statusDesc` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incident_status`
--

INSERT INTO `incident_status` (`statusId`, `statusDesc`) VALUES
('1', 'Pending'),
('2', 'Dispatched'),
('3', 'Complated'),
('4', 'Duplicate');

-- --------------------------------------------------------

--
-- Table structure for table `patrolcar`
--

CREATE TABLE `patrolcar` (
  `patrolcarId` varchar(10) CHARACTER SET latin1 NOT NULL,
  `patrolcarStatusId` varchar(1) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patrolcar`
--

INSERT INTO `patrolcar` (`patrolcarId`, `patrolcarStatusId`) VALUES
('QX1234A', '4'),
('QX3456B', '4'),
('QX1111J', '4'),
('QX2222K', '4'),
('QX5555D', '4'),
('QX2288D', '4'),
('QX8769P', '4'),
('QX1342G', '4'),
('QX8723W', '4'),
('QX8923T', '4'),
('AB3333C', '4'),
('AB5555D', '4'),
('AC1234B', '2'),
('AX2222K', '1'),
('QQ2222K', '4'),
('QQ8723W', '1'),
('XX2222K', '4'),
('QX2288Q', '4'),
('QX2288X', '3'),
('AB5554D', '4'),
('QQ1111Q', '3'),
('XX1111X', '4');

-- --------------------------------------------------------

--
-- Table structure for table `patrolcar_status`
--

CREATE TABLE `patrolcar_status` (
  `statusId` varchar(1) CHARACTER SET latin1 NOT NULL,
  `statusDesc` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patrolcar_status`
--

INSERT INTO `patrolcar_status` (`statusId`, `statusDesc`) VALUES
('1', 'Dispatched'),
('2', 'Patrol'),
('3', 'Free'),
('4', 'Arrived');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incidentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incidentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
