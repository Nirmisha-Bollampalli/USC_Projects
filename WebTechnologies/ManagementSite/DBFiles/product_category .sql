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
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCategory` varchar(200) NOT NULL,
  `ProductDescription` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`CategoryID`, `ProductCategory`, `ProductDescription`) VALUES
(14, 'Cakes', 'Yummy Cakes'),
(15, 'Cup Cakes', 'Tasty Cup Cakes'),
(16, 'Treats', 'Make Parties Special with special treats'),
(17, 'Gifts', 'Purchase Exciting Gifts '),
(18, 'Ballons', 'Colorful Ballons '),
(19, 'Party Caps', 'Funny Party Caps');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
