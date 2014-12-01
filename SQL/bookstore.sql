-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2014 at 04:36 AM
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
(1, 'James Patterson'),
(2, 'Jason Wilson'),
(2, 'Paul Theroux'),
(3, 'Gina Homolka'),
(4, 'Sean Brock'),
(5, 'The Editors of Southern Living Magazine'),
(6, 'Donna Tartt'),
(7, 'David Foster Wallace'),
(8, 'Joseph Heller'),
(9, 'James Patterson'),
(9, 'Marshall Karp');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookid`, `title`, `publisher`, `publicationdate`, `isbn`, `isdeleted`) VALUES
(1, 'Hope to Die', 'Little, Brown and Company', '2014-11-24', '9780316210966', 0),
(2, 'The Best American Travel Writing 2014', 'Houghton Mifflin Harcourt', '2014-07-10', '9780544330153', 0),
(3, 'The Skinnytaste Cookbook', 'Crown Publishing Group', '2014-09-30', '9780385345620', 0),
(4, 'Heritage', 'Artisan', '2014-10-21', '9781579654634', 0),
(5, 'The Southern Cake Book', 'Oxmoor House', '2014-05-27', '9780848702984', 0),
(6, 'The Goldfinch', 'Little, Brown and Company', '2013-10-22', '9780316055437', 0),
(7, 'Infinite Jest', 'Little, Brown and Company', '2006-11-13', '9780316066525', 0),
(8, 'Catch-22', 'Simon & Schuster', '1951-04-05', '9781451626650', 0),
(9, 'NYPD Red 3', 'Little, Brown and Company', '2015-03-15', '9780316406994', 0);

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
(1, 'Hardcover', 15),
(1, 'Paperback', 10),
(2, 'Hardcover', 15),
(2, 'Paperback', 12),
(3, 'Hardcover', 18),
(4, 'Hardcover', 25),
(5, 'Hardcover', 30),
(5, 'Paperback', 20),
(6, 'Hardcover', 19),
(7, 'Hardcover', 22),
(7, 'Paperback', 14),
(8, 'Hardcover', 20),
(8, 'Paperback', 10),
(9, 'Hardcover', 20),
(9, 'Paperback', 16);

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
(1, 3),
(2, 0),
(3, 4),
(4, 4),
(5, 4),
(6, 3),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 1),
(9, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `emailaddress`, `password`, `address`, `city`, `state`, `zip`, `creditcard`, `isdeleted`) VALUES
(1, 'Faris Hawamdeh', 'farishawamdeh@gmail.com', 'password', '1155 Union Circle', 'Denton', 'Texas', '76203', '1111222233334444', 0),
(2, 'Jason Lindsey', 'JasonSLindsey@armyspy.com', 'ich1ul0ohhiK', '1180 Oak Way', 'Lincoln', 'Nebraska', '68501', '4716992911218985', 0),
(3, 'Martin Winter', 'MartinDWinter@dayrep.com', 'EiW8voeP6', '2412 Marion Drive', 'Tampa', 'Florida', '33634', '5113979318306980', 0),
(4, 'Elizabeth Jones', 'ElizabethJJones@armyspy.com', 'feCh0quee0Ee', '6 Barrington Court', 'Rector', 'Arkansas', '72461', '5139696654966991', 0),
(5, 'Charles Dooley', 'CharlesVDooley@jourrapide.com', 'Gie9ohPai', '3594 Elk Rd Little', 'Tucson', 'Arizona', '85716', '4916697506926805', 0);

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
(1, 1, 'Hardcover', 1, 0, 15),
(2, 1, 'Paperback', 2, 0, 20),
(2, 3, 'Hardcover', 1, 0, 18),
(3, 8, 'Paperback', 1, 0, 10),
(4, 4, 'Hardcover', 1, 0, 25),
(4, 5, 'Hardcover', 1, 0, 30),
(5, 5, 'Paperback', 1, 0, 20),
(6, 5, 'Hardcover', 1, 0, 30);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `creditcard`, `address`, `city`, `state`, `zip`, `total`) VALUES
(1, 1, '1111222233334444', '1155 Union Circle', 'Denton', 'Texas', '76203', 15),
(2, 2, '4716992911218985', '1180 Oak Way', 'Lincoln', 'Nebraska', '68501', 58),
(3, 4, '5139696654966991', '6 Barrington Cour', 'Rector', 'Arkansas', '72461', 10),
(4, 5, '4916697506926805', '3594 Elk Rd Little', 'Tucson', 'Arizona', '85716', 55),
(5, 3, '5113979318306980', '2412 Marion Drive', 'Tampa', 'Florida', '33634', 20),
(6, 1, '1111222233334444', '1155 Union Circle', 'Denton', 'Texas', '76203', 30);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerid`, `name`, `emailaddress`, `password`, `phonenumber`, `address`, `city`, `state`, `zip`, `isdeleted`) VALUES
(1, 'Bookz!', 'admin@bookz.com', 'password', '9402480021', '2520 Rodeo Plaza', 'Fort Worth', 'Texas', '76164', 0),
(2, 'Elizabeth Jones', 'ElizabethJJones@armyspy.com', 'feCh0quee0Ee', '9708540373', '1170 Stark Hollow Road', 'Holyoke', 'Colorado', '80734', 0);

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
(1, 1),
(1, 2),
(1, 3),
(1, 7),
(1, 8),
(1, 9),
(2, 4),
(2, 5),
(2, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
