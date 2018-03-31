-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 04:42 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abc_school_grades`
--

-- --------------------------------------------------------

--
-- Table structure for table `bng06`
--

CREATE TABLE IF NOT EXISTS `bng06` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bng06`
--

INSERT INTO `bng06` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Himel', '170027', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Adnan Himel', '170028', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Sadman Saqib', '170030', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bng07`
--

CREATE TABLE IF NOT EXISTS `bng07` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bng07`
--

INSERT INTO `bng07` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Sadnan', '170032', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bng08`
--

CREATE TABLE IF NOT EXISTS `bng08` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bng08`
--

INSERT INTO `bng08` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(2, 2017, 'Taskin Taosib', '170026', 0, 0, 0, 0, 0, 45);

-- --------------------------------------------------------

--
-- Table structure for table `bng09`
--

CREATE TABLE IF NOT EXISTS `bng09` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bng09`
--

INSERT INTO `bng09` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Go Azam', '170023', 0, 0, 30, 0, 0, 0),
(0, 2017, 'Zahidul Islam', '170029', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bng10`
--

CREATE TABLE IF NOT EXISTS `bng10` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eng06`
--

CREATE TABLE IF NOT EXISTS `eng06` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eng06`
--

INSERT INTO `eng06` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Himel', '170027', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Adnan Himel', '170028', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Sadman Saqib', '170030', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eng07`
--

CREATE TABLE IF NOT EXISTS `eng07` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eng07`
--

INSERT INTO `eng07` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Sadnan', '170032', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eng08`
--

CREATE TABLE IF NOT EXISTS `eng08` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eng08`
--

INSERT INTO `eng08` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(1, 2017, 'Taskin Taosib', '170026', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eng09`
--

CREATE TABLE IF NOT EXISTS `eng09` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eng09`
--

INSERT INTO `eng09` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Go Azam', '170023', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Zahidul Islam', '170029', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eng10`
--

CREATE TABLE IF NOT EXISTS `eng10` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mat06`
--

CREATE TABLE IF NOT EXISTS `mat06` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mat06`
--

INSERT INTO `mat06` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Himel', '170027', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Adnan Himel', '170028', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Sadman Saqib', '170030', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mat07`
--

CREATE TABLE IF NOT EXISTS `mat07` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mat07`
--

INSERT INTO `mat07` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Sadnan', '170032', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mat08`
--

CREATE TABLE IF NOT EXISTS `mat08` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mat08`
--

INSERT INTO `mat08` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(1, 2017, 'Taskin Taosib', '170026', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mat09`
--

CREATE TABLE IF NOT EXISTS `mat09` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mat09`
--

INSERT INTO `mat09` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Go Azam', '170023', 0, 0, 0, 45, 0, 0),
(0, 2017, 'Zahidul Islam', '170029', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mat10`
--

CREATE TABLE IF NOT EXISTS `mat10` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sci06`
--

CREATE TABLE IF NOT EXISTS `sci06` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sci06`
--

INSERT INTO `sci06` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Himel', '170027', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Adnan Himel', '170028', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Sadman Saqib', '170030', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sci07`
--

CREATE TABLE IF NOT EXISTS `sci07` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sci07`
--

INSERT INTO `sci07` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Sadnan', '170032', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sci08`
--

CREATE TABLE IF NOT EXISTS `sci08` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sci08`
--

INSERT INTO `sci08` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(1, 2017, 'Taskin Taosib', '170026', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sci09`
--

CREATE TABLE IF NOT EXISTS `sci09` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sci09`
--

INSERT INTO `sci09` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Go Azam', '170023', 0, 10, 15, 30, 0, 0),
(0, 2017, 'Zahidul Islam', '170029', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sci10`
--

CREATE TABLE IF NOT EXISTS `sci10` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soc06`
--

CREATE TABLE IF NOT EXISTS `soc06` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc06`
--

INSERT INTO `soc06` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Himel', '170027', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Adnan Himel', '170028', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Sadman Saqib', '170030', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc07`
--

CREATE TABLE IF NOT EXISTS `soc07` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc07`
--

INSERT INTO `soc07` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Adnan Sadnan', '170032', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc08`
--

CREATE TABLE IF NOT EXISTS `soc08` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc08`
--

INSERT INTO `soc08` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(1, 2017, 'Taskin Taosib', '170026', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc09`
--

CREATE TABLE IF NOT EXISTS `soc09` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soc09`
--

INSERT INTO `soc09` (`sl`, `year`, `stu_full_name`, `sid`, `ct1`, `ct2`, `mid`, `final`, `assign`, `total`) VALUES
(0, 2017, 'Go Azam', '170023', 0, 0, 0, 0, 0, 0),
(0, 2017, 'Zahidul Islam', '170029', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soc10`
--

CREATE TABLE IF NOT EXISTS `soc10` (
  `sl` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `stu_full_name` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ct1` int(11) NOT NULL,
  `ct2` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bng06`
--
ALTER TABLE `bng06`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `bng07`
--
ALTER TABLE `bng07`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `bng08`
--
ALTER TABLE `bng08`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `bng09`
--
ALTER TABLE `bng09`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `bng10`
--
ALTER TABLE `bng10`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `eng06`
--
ALTER TABLE `eng06`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `eng07`
--
ALTER TABLE `eng07`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `eng08`
--
ALTER TABLE `eng08`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `eng09`
--
ALTER TABLE `eng09`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `eng10`
--
ALTER TABLE `eng10`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `mat06`
--
ALTER TABLE `mat06`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `mat07`
--
ALTER TABLE `mat07`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `mat08`
--
ALTER TABLE `mat08`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `mat09`
--
ALTER TABLE `mat09`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `mat10`
--
ALTER TABLE `mat10`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sci06`
--
ALTER TABLE `sci06`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sci07`
--
ALTER TABLE `sci07`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sci08`
--
ALTER TABLE `sci08`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sci09`
--
ALTER TABLE `sci09`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sci10`
--
ALTER TABLE `sci10`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `soc06`
--
ALTER TABLE `soc06`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `soc07`
--
ALTER TABLE `soc07`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `soc08`
--
ALTER TABLE `soc08`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `soc09`
--
ALTER TABLE `soc09`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `soc10`
--
ALTER TABLE `soc10`
 ADD PRIMARY KEY (`sid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
