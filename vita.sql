-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 03:52 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vita`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `memberId` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `dat` date NOT NULL,
  `fromTime` varchar(6) NOT NULL,
  `till` varchar(6) NOT NULL,
  `location` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `verificationStatus` varchar(10) NOT NULL DEFAULT 'pending' COMMENT 'adds verification to events',
  PRIMARY KEY (`eventId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventId`, `memberId`, `title`, `dat`, `fromTime`, `till`, `location`, `description`, `verificationStatus`) VALUES
(30, 2, 'Core Committee Selection', '2014-03-14', '18:00', '20:00', 'SJT 101', 'Core committee selection for ACM Core. ', 'yes'),
(31, 1, 'Riddler', '2014-03-28', '00:00', '19:00', 'Online', 'aldfj;lasjfl;ajsdf;lajsdfl;ajsdf;l j\r\nadfl;ajfl;ajsdf\r\nadflkj;ladsfjl;j\r\nadfa;slfkja;ldfksj', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `image` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `password`, `image`) VALUES
(1, 'CSI', '1234', 'csi'),
(2, 'acm', '1234', 'acm'),
(3, 'ieee', '1234', 'ieee');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `password`, `image`) VALUES
(1, 'dsw', '1234', 'dsw');
