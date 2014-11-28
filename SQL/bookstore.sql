-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2014 at 03:31 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `username`, `password`, `issuper`) VALUES
(1, 'John', 'Doe', 'Maou', 'password', 1),
(2, 'Jane', 'Doe', 'Haru', 'password', 0);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `bookid` int(11) NOT NULL,
  `author` varchar(45) NOT NULL,
  PRIMARY KEY (`bookid`,`author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`bookid`, `author`) VALUES
(1, 'James Patterson');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookid`, `title`, `publisher`, `publicationdate`, `isbn`, `isdeleted`) VALUES
(1, 'Hope to Die', 'Little, Brown and Company', '2014-11-24', '9780316210966', 0);

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

--
-- Dumping data for table `bookformat`
--

INSERT INTO `bookformat` (`bookid`, `format`, `price`) VALUES
(1, 'Hardcover', 15);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `bookid` int(11) NOT NULL,
  `genre` int(10) NOT NULL,
  PRIMARY KEY (`bookid`,`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`bookid`, `genre`) VALUES
(1, 1),
(1, 3);

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`bookid`, `customerid`, `date`, `comment`) VALUES
(1, 1, '2014-11-28 08:27:06', 'This book is Boring!!!\r\nLOOOOOL!!!');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `emailaddress`, `password`, `address`, `city`, `state`, `zip`, `creditcard`, `isdeleted`) VALUES
(1, 'Faris Hawamdeh', 'farishawamdeh@gmail.com', 'password', '1155 Union Circle', 'Denton', 'Texas', '76203', '1111222233334444', 0);

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
  `cost` int(10) DEFAULT NULL,
  PRIMARY KEY (`orderid`,`bookid`,`format`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderid`, `bookid`, `format`, `quantity`, `status`, `cost`) VALUES
(1, 1, 'Hardcover', 1, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `creditcard` varchar(20) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(7) DEFAULT NULL,
  `total` int(7) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `creditcard`, `address`, `city`, `state`, `zip`, `total`) VALUES
(1, 1, '1111222233334444', '1155 Union Circle', 'Denton', 'Texas', '76203', 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerid`, `name`, `emailaddress`, `password`, `phonenumber`, `address`, `city`, `state`, `zip`, `isdeleted`) VALUES
(1, 'Bookz!', 'admin@bookz.com', 'password', '9402480021', '2520 Rodeo Plaza', 'Fort Worth', 'Texas', '76164', 0);

-- --------------------------------------------------------

--
-- Table structure for table `selleritem`
--

CREATE TABLE IF NOT EXISTS `selleritem` (
  `sellerid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  PRIMARY KEY (`sellerid`,`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selleritem`
--

INSERT INTO `selleritem` (`sellerid`, `bookid`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
