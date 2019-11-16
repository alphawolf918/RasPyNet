-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2019 at 11:30 AM
-- Server version: 10.1.38-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PyNet`
--
CREATE DATABASE IF NOT EXISTS `PyNet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `PyNet`;

-- --------------------------------------------------------

--
-- Table structure for table `PyNet`
--
-- Creation: Nov 05, 2019 at 10:40 PM
--

DROP TABLE IF EXISTS `PyNet`;
CREATE TABLE IF NOT EXISTS `PyNet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DownloadSpeed` mediumtext NOT NULL,
  `UploadSpeed` mediumtext NOT NULL,
  `WifiName` varchar(100) DEFAULT NULL,
  `LoggedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `VIEW_PyNet`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `VIEW_PyNet`;
CREATE TABLE IF NOT EXISTS `VIEW_PyNet` (
`ID` int(11)
,`DownloadSpeed` longtext
,`UploadSpeed` longtext
,`WifiName` varchar(100)
,`LoggedDate` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `VIEW_PyNet`
--
DROP TABLE IF EXISTS `VIEW_PyNet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_PyNet`  AS  select `PN`.`ID` AS `ID`,concat(`PN`.`DownloadSpeed`,' Mbps') AS `DownloadSpeed`,concat(`PN`.`UploadSpeed`,' Mbps') AS `UploadSpeed`,`PN`.`WifiName` AS `WifiName`,`PN`.`LoggedDate` AS `LoggedDate` from `PyNet` `PN` ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
