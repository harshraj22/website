-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2019 at 03:22 PM
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
-- Table structure for table `temp_table`
--

CREATE TABLE `temp_table` (
  `time` varchar(30) NOT NULL,
  `room` int(11) NOT NULL,
  `branch` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_table`
--

INSERT INTO `temp_table` (`time`, `room`, `branch`) VALUES
('8:30 to 9:00', 203, 'Notalloted'),
('10:00 to 10:30', 109, 'Notalloted'),
('10:30 to 11:00', 21, 'cse'),
('11:00 to 12:00', 22, 'Notalloted'),
('2:30 to 3:30', 212, 'Notalloted');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
