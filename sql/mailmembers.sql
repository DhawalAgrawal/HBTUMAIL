-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2018 at 11:47 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HBTUMAIL`
--

-- --------------------------------------------------------

--
-- Table structure for table `mailmembers`
--

CREATE TABLE IF NOT EXISTS `mailmembers` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `rid` int(99) NOT NULL,
  `name` varchar(99) NOT NULL,
  `rollNumber` int(99) NOT NULL,
  `branch` varchar(99) NOT NULL,
  `f_s` varchar(99) NOT NULL,
  `year` varchar(99) NOT NULL,
  `idimage` varchar(99) NOT NULL,
  `image` varchar(99) NOT NULL,
  `yn` int(2) NOT NULL DEFAULT '0',
  `email` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
