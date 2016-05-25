-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2016 at 05:22 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
`ProductID` int(11) NOT NULL,
  `ProductBarcode` varchar(20) NOT NULL,
  `ProductQuaternaryCategoryID` int(11) NOT NULL,
  `ProductBrandID` int(11) NOT NULL,
  `ProductFamily` varchar(50) DEFAULT NULL,
  `ProductMaterialID` int(11) NOT NULL,
  `ProductColorID` int(11) NOT NULL,
  `ProductSize` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `ProductBarcode`, `ProductQuaternaryCategoryID`, `ProductBrandID`, `ProductFamily`, `ProductMaterialID`, `ProductColorID`, `ProductSize`) VALUES
(1, '7297418000750', 75, 1, 'Basic', 17, 30, 'Others'),
(2, '8595028436938', 75, 7, 'Classic', 17, 30, '20Cm'),
(3, '8595028432756', 75, 7, 'Scarlett', 17, 30, '22Cm'),
(4, '8595028426380', 75, 7, 'Sonic', 19, 31, '12Cm'),
(5, '8595028439991', 75, 7, 'Sonic', 19, 31, '12Cm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
 ADD PRIMARY KEY (`ProductID`), ADD UNIQUE KEY `ProductBarcode` (`ProductBarcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
