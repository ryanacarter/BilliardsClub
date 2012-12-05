-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2012 at 10:02 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `billiards`
--

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `relation` varchar(6) NOT NULL,
  PRIMARY KEY (`pID`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`relation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`pID`, `first_name`, `last_name`, `email`, `phone`, `relation`) VALUES
(2, 'Ryan', 'Carter', 'carterra@dukes.jmu.edu', '5402479144', 'A Team'),
(3, 'Thomas', 'Smith', 'smithtp@dukes.jmu.edu', '5405554444', 'A Team'),
(4, 'Chris', 'Belcourt', 'belcoucn@dukes.jmu.edu', '5405553333', 'A Team'),
(6, 'Rachney', 'Soun', 'sounra@dukes.jmu.edu', '5402474345', 'B Team'),
(7, 'Liz', 'Wronko', 'wrokoea@dukes.jmu.edu', '5405554444', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `timestamp`
--

CREATE TABLE `timestamp` (
  `tID` int(11) NOT NULL AUTO_INCREMENT,
  `dateStamp` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`tID`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `timestamp`
--

INSERT INTO `timestamp` (`tID`, `dateStamp`, `email`) VALUES
(47, '12.04.12', 'carterra@dukes.jmu.edu');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `timestamp`
--
ALTER TABLE `timestamp`
  ADD CONSTRAINT `timestamp_ibfk_1` FOREIGN KEY (`email`) REFERENCES `persons` (`email`);
