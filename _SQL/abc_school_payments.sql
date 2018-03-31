-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 04:43 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abc_school_payments`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailytransaction2017`
--

CREATE TABLE IF NOT EXISTS `dailytransaction2017` (
`id` int(11) NOT NULL,
  `details` varchar(5000) NOT NULL,
  `type` varchar(500) NOT NULL,
  `amount` int(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employeepayment2017`
--

CREATE TABLE IF NOT EXISTS `employeepayment2017` (
  `id` int(11) NOT NULL,
  `stuff_id` int(11) NOT NULL,
  `stuff_name` varchar(100) NOT NULL,
  `stuff_designation` varchar(50) NOT NULL,
  `type` varchar(500) NOT NULL,
  `salary` int(11) NOT NULL,
  `m1` int(11) DEFAULT NULL,
  `m2` int(11) DEFAULT NULL,
  `m3` int(11) DEFAULT NULL,
  `m4` int(11) DEFAULT NULL,
  `m5` int(11) DEFAULT NULL,
  `m6` int(11) DEFAULT NULL,
  `m7` int(11) DEFAULT NULL,
  `m8` int(11) DEFAULT NULL,
  `m9` int(11) DEFAULT NULL,
  `m10` int(11) DEFAULT NULL,
  `m11` int(11) DEFAULT NULL,
  `m12` int(11) DEFAULT NULL,
  `others` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeepayment2017`
--

INSERT INTO `employeepayment2017` (`id`, `stuff_id`, `stuff_name`, `stuff_designation`, `type`, `salary`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `m9`, `m10`, `m11`, `m12`, `others`, `status`, `timestamp`) VALUES
(0, 171, 'Rahat Ahmed', 'Assistant Teacher', 'teacher', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-03-11 15:34:07'),
(1, 11265, 'Rahat Ahmed', 'Managing Director', 'genaral', 10000, 4000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 'paid', '2017-02-27 08:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `stupayment_2016`
--

CREATE TABLE IF NOT EXISTS `stupayment_2016` (
  `sid` int(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `class` varchar(15) NOT NULL,
  `m1` int(11) NOT NULL,
  `m2` int(11) NOT NULL,
  `m3` int(11) NOT NULL,
  `m4` int(11) NOT NULL,
  `m5` int(11) NOT NULL,
  `m6` int(11) NOT NULL,
  `m7` int(11) NOT NULL,
  `m8` int(11) NOT NULL,
  `m9` int(11) NOT NULL,
  `m10` int(11) NOT NULL,
  `m11` int(11) NOT NULL,
  `m12` int(100) NOT NULL,
  `othercost` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stupayment_2016`
--

INSERT INTO `stupayment_2016` (`sid`, `fullname`, `class`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `m9`, `m10`, `m11`, `m12`, `othercost`, `status`, `updatetime`) VALUES
(1, 'Mojnu Shah', 'c09', 375, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stupayment_2017`
--

CREATE TABLE IF NOT EXISTS `stupayment_2017` (
  `sid` int(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `class` varchar(15) NOT NULL,
  `m1` int(11) NOT NULL,
  `m2` int(11) NOT NULL,
  `m3` int(11) NOT NULL,
  `m4` int(11) NOT NULL,
  `m5` int(11) NOT NULL,
  `m6` int(11) NOT NULL,
  `m7` int(11) NOT NULL,
  `m8` int(11) NOT NULL,
  `m9` int(11) NOT NULL,
  `m10` int(11) NOT NULL,
  `m11` int(11) NOT NULL,
  `m12` int(100) NOT NULL,
  `othercost` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stupayment_2017`
--

INSERT INTO `stupayment_2017` (`sid`, `fullname`, `class`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `m9`, `m10`, `m11`, `m12`, `othercost`, `status`, `updatetime`) VALUES
(1, 'Mojnu Shah', 'c09', 900, 900, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000, '0', '2017-03-09 17:15:41'),
(170032, 'Adnan Sadnan', 'c07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dailytransaction2017`
--
ALTER TABLE `dailytransaction2017`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeepayment2017`
--
ALTER TABLE `employeepayment2017`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `stuff_id` (`stuff_id`);

--
-- Indexes for table `stupayment_2016`
--
ALTER TABLE `stupayment_2016`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `stupayment_2017`
--
ALTER TABLE `stupayment_2017`
 ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dailytransaction2017`
--
ALTER TABLE `dailytransaction2017`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
