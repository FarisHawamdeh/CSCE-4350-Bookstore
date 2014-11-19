-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 11:32 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `issuper` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `bookid` int(11) NOT NULL,
  `author` varchar(45) NOT NULL,
  PRIMARY KEY (`bookid`,`author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `publisher` varchar(45) NOT NULL,
  `publicationdate` date DEFAULT NULL,
  `isbn` varchar(17) DEFAULT NULL,
  `isdeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bookformat`
--

CREATE TABLE IF NOT EXISTS `bookformat` (
  `bookid` int(11) NOT NULL,
  `format` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  PRIMARY KEY (`bookid`,`format`,`price`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `bookid` int(11) NOT NULL,
  `category` int(5) NOT NULL,
  PRIMARY KEY (`bookid`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `bookid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  PRIMARY KEY (`bookid`,`customerid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customerid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `emailaddress` varchar(60) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(7) DEFAULT NULL,
  `creditcard` varchar(20) DEFAULT NULL,
  `isdeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `format` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderid`,`bookid`,`format`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `creditcard` int(20) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(7) DEFAULT NULL,
  `cost` int(7) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `sellerid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `emailaddress` varchar(60) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phonenumber` varchar(12) NOT NULL,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `isdeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sellerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `selleritem`
--

CREATE TABLE IF NOT EXISTS `selleritem` (
  `sellerid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  PRIMARY KEY (`sellerid`,`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
