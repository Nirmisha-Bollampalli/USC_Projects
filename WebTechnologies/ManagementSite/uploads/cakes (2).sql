-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2012 at 04:57 AM
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
-- Table structure for table `cakes`
--

CREATE TABLE IF NOT EXISTS `cakes` (
  `CategoryID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(100) NOT NULL,
  `ProductQuantity` int(11) NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `ProductDescription` varchar(500) DEFAULT NULL,
  `ProductImage` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`CategoryID`, `ProductID`, `ProductName`, `ProductQuantity`, `ProductPrice`, `ProductDescription`, `ProductImage`) VALUES
(14, 31, 'Cinderella', 12, 25, 'Cinderalla cakes', 'http://localhost/uploads/Cinderella.jpg'),
(14, 32, 'Mickey', 4, 50, 'Mickey Cakes', 'http://localhost/uploads/mic.jpg'),
(14, 33, 'Pirates Of Caribean', 2, 25, 'Cakes of Pirates of Caribean', 'http://localhost/uploads/piratesofcaribean.jpg'),
(14, 34, 'Princess Tiana', 5, 70, 'Princess Tiana Cakes', 'http://localhost/uploads/PrincessTiana.jpg'),
(14, 35, 'Disney Princess', 5, 30, 'Disney Cakes', 'http://localhost/uploads/disneyprincess.jpg'),
(15, 36, 'Blue Berry Pound Cake', 12, 5, 'Cakes made of tasty blue berries.', 'http://localhost/uploads/blueberrypoundcake-sm.png'),
(15, 37, 'Chocolate Cup Cake', 12, 3, 'Yummy Chocolate cup Cakes', 'http://localhost/uploads/Choc.cake.png'),
(15, 38, 'Plain Pound Cake', 8, 9, 'Plain Cakes', 'http://localhost/uploads/plainpoundcakewithcaramelglaze-sm.png'),
(15, 39, 'Lemon Pound Cake', 5, 5, 'Lemon Pound Cakes', 'http://localhost/uploads/lemonpoundcake-sm.png'),
(15, 40, 'Sour Cream Coffee Cake', 5, 3, 'Sour Cream  Coffee Cakes', 'http://localhost/uploads/sourcreamcoffeecake-sm.png'),
(16, 41, 'Antigua Coffee', 20, 20, 'Hot Coffee', 'http://localhost/uploads/antiguacoffee-01.png'),
(16, 42, 'Banbury Tart Cookies', 40, 5, 'Yummy Cookies', 'http://localhost/uploads/banburytartcookies-01.png'),
(16, 43, 'Brownies', 5, 8, 'Tasty Brownies', 'http://localhost/uploads/browniesadozen-01.png'),
(16, 44, 'Lemon Short Bread Cookies', 10, 35, 'Yummy Cookies', 'http://localhost/uploads/lemonshortbreadcookies-01.png'),
(17, 45, 'Barbie Blonde Styling Head', 5, 100, 'Stylish Barbie', 'http://localhost/uploads/Barbie Blonde Styling Head.jpg'),
(17, 46, 'High School Play Set', 20, 50, 'Play Set', 'http://localhost/uploads/High School Play Set.jpg'),
(17, 47, ' Very Real Baby Doll', 40, 80, 'Baby Doll', 'http://localhost/uploads/Little Mommy My Very Real Baby Doll.jpg'),
(17, 48, ' Clawdeen Wolf Doll', 50, 100, 'Cute Doll', 'http://localhost/uploads/Monster High Dead Tired Clawdeen Wolf Doll.jpg'),
(17, 49, 'Melissa and Doug Jenna', 60, 100, 'Baby Doll', 'http://localhost/uploads/Melissa and Doug Jenna.jpg'),
(18, 50, 'Lion Jumbo Ballon', 15, 20, 'Brave Lion', 'http://localhost/uploads/51OCoIYpznL._AA160_.jpg'),
(18, 51, 'Big Bird Ballon', 40, 40, 'Big Jumbo Bird', 'http://localhost/uploads/21+hS4PkrVL._AA160_.jpg'),
(18, 52, 'Hand Held Balloon Pump Set', 40, 100, 'Balloon Pump Set', 'http://localhost/uploads/41X3Lvl-zcL._AA160_.jpg'),
(18, 53, 'Mickey Ballon', 20, 50, 'Mickey', 'http://localhost/uploads/Mickey.jpg'),
(18, 54, 'Twisty Balloons', 40, 50, 'Twisty ballons', 'http://localhost/uploads/41PSgjDi6oL._AA160_.jpg'),
(19, 55, 'Colorful Cap', 20, 25, 'Colorful Caps', 'http://localhost/uploads/cap1.jpg'),
(19, 56, 'Blue Cap', 40, 10, 'Blue Caps', 'http://localhost/uploads/cap2.jpg'),
(19, 57, 'Blue Balloon Cap', 40, 10, 'Blue Balloon Caps', 'http://localhost/uploads/cap3.jpg'),
(19, 58, 'Rainbow Cap', 40, 40, 'RainBow Caps', 'http://localhost/uploads/cap4.jpg'),
(19, 59, 'White Cap', 40, 40, 'White Cap', 'http://localhost/uploads/cap5.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
