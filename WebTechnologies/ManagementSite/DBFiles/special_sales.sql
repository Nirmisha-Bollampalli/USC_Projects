-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2012 at 04:59 AM
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
-- Table structure for table `special_sales`
--

CREATE TABLE IF NOT EXISTS `special_sales` (
  `ProductID` int(11) NOT NULL,
  `SpecialSalesID` int(11) NOT NULL AUTO_INCREMENT,
  `Discount` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `ProductImage` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`SpecialSalesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `special_sales`
--

INSERT INTO `special_sales` (`ProductID`, `SpecialSalesID`, `Discount`, `StartDate`, `EndDate`, `ProductImage`) VALUES
(31, 26, 30, '2012-02-12', '2012-12-12', 'http://localhost/uploads/51OCoIYpznL._AA160_.jpg'),
(6, 27, 12, '2012-12-12', '2012-12-12', 'http://localhost/uploads/PrincessAurora.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
