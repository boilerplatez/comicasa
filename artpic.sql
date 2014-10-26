-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2014 at 10:56 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `artpic`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT 'Untitled',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `file_path` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `uid`, `albumid`, `name`, `size`, `price`, `likes`, `type`, `url`, `title`, `description`, `file_path`) VALUES
(1, 1, 0, '1633021b3-4.jpg', 42489, 0, 1, 'image/jpeg', NULL, '', '', '1/1633021b3-4.jpg'),
(2, 1, 0, 'a-bombers (5).jpg', 133991, 0, 0, 'image/jpeg', NULL, '', '', '1/a-bombers (5).jpg'),
(3, 1, 0, 'download (7).jpg', 116108, 10, 0, 'image/jpeg', NULL, '', '', '1/download (7).jpg'),
(4, 2, 0, 'Lather-bee-Rich-Company.jpg', 249453, 0, 0, 'image/jpeg', NULL, '', '', '2/Lather-bee-Rich-Company.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `file_access`
--

DROP TABLE IF EXISTS `file_access`;
CREATE TABLE IF NOT EXISTS `file_access` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `baught` tinyint(1) NOT NULL DEFAULT '0',
  `saved` tinyint(1) NOT NULL DEFAULT '0',
  `liked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_access`
--

INSERT INTO `file_access` (`pid`, `uid`, `baught`, `saved`, `liked`) VALUES
(1, 2, 0, 1, 1),
(2, 2, 0, 0, 0),
(3, 2, 1, 1, 0),
(34, 1, 1, 0, 0),
(35, 1, 0, 1, 0),
(36, -1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `coins` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `password`, `coins`) VALUES
(1, 'admin', '1234', 175),
(2, 'visitor', '12345', 30);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
