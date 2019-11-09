-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2019 at 03:24 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailmaintainer`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `slots` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `branch` varchar(10) NOT NULL DEFAULT 'Notalloted',
  `room` int(11) NOT NULL,
  `instructor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`slots`, `time`, `date`, `branch`, `room`, `instructor`) VALUES
('A1', '8:00 to 8:30', '2019-11-03', 'cse', 203, 'srb'),
('A2', '8:30 to 9:00', '2019-11-03', 'Notalloted', 203, ''),
('B1', '9:00 to 9:30', '2019-11-04', 'EE', 119, 'sts'),
('B2', '9:30 to 10:00', '2019-11-04', 'ME', 118, 'TGK'),
('C1', '10:00 to 10:30', '2019-11-05', 'Notalloted', 109, 'sts'),
('C2', '10:30 to 11:00', '2019-11-05', 'Notalloted', 21, ''),
('D1', '11:00 to 12:00', '2019-11-06', 'Notalloted', 22, ''),
('E1', '1:00 to 2:00', '2019-11-07', 'ME', 21, 'tgk'),
('E2', '2:30 to 3:30', '2019-11-07', 'Notalloted', 212, 'sqw');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
