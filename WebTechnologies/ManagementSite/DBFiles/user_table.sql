-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2012 at 05:00 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `relancer`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`UserID`, `UserName`, `Password`, `FirstName`, `LastName`, `Address`, `PhoneNo`, `Role`, `Age`, `Salary`) VALUES
(1, 'nirmisha', 'nirmisha', 'Nirmisha', 'Bol', 'asdasfasf', 124345345, 'Admin', 21, 25),
(2, 'madhu', 'madhu', 'Madhu', 'Rangi', 'sfcsdfsdf', 2342342, 'Sales Manager', 25, 40),
(3, 'sonal', 'sonal', 'Sonal', 'Sharma', 'asfadgfsd', 124234, 'Manager', 26, 50),
(4, 'gd', 'sdg', 'sdgsd', 'sdg', 'sdf', 1234567121, 'Manager', 12, 21),
(5, 'dsfsdg', 'sgsfg', 'dfhgfhgfj', 'fhjgkk', 'ghkghjkhjkhjk', 23333, 'Sales Manager', 324, 345346367);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
