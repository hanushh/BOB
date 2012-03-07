-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 216.14.208.46
-- Generation Time: Mar 07, 2012 at 01:22 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `wakarus_attend`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attn_Id` int(11) NOT NULL,
  `fk_barcode` bigint(13) NOT NULL,
  `fk_PLID` smallint(6) default NULL,
  `fk_SCID` smallint(6) default NULL,
  `fk_SPID` smallint(6) default NULL,
  `comments` text,
  `InOut` tinyint(4) NOT NULL,
  `clockTime` datetime default NULL,
  `Entry` tinyint(1) NOT NULL,
  PRIMARY KEY  (`attn_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attn_Id`, `fk_barcode`, `fk_PLID`, `fk_SCID`, `fk_SPID`, `comments`, `InOut`, `clockTime`, `Entry`) VALUES
(1, 33, NULL, NULL, NULL, NULL, 1, '2011-10-23 00:27:31', 0),
(2, 99, 1, 2, 3, NULL, 0, '2011-10-23 09:42:42', 0),
(3, 3, NULL, NULL, NULL, NULL, 3, '2011-10-23 09:46:55', 0),
(4, 5, NULL, NULL, NULL, NULL, 6, '2011-10-23 09:48:35', 0),
(6, 9, NULL, NULL, NULL, NULL, 8, '2011-10-23 00:50:24', 0),
(8, 8, NULL, NULL, NULL, NULL, 1, '2011-10-23 00:53:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendanceTime`
--

CREATE TABLE `attendanceTime` (
  `timeId` smallint(5) NOT NULL auto_increment,
  `barcode` bigint(25) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `inAM` time NOT NULL,
  `outAM` time NOT NULL,
  `inPM` time NOT NULL,
  `outPM` time NOT NULL,
  `manualIn` time NOT NULL,
  `relaxMin` tinyint(2) NOT NULL,
  `i` int(2) NOT NULL,
  `j` int(2) NOT NULL,
  PRIMARY KEY  (`timeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=321 ;

--
-- Dumping data for table `attendanceTime`
--

INSERT INTO `attendanceTime` (`timeId`, `barcode`, `firstName`, `lastName`, `date`, `inAM`, `outAM`, `inPM`, `outPM`, `manualIn`, `relaxMin`, `i`, `j`) VALUES
(265, 1900100067918, 'Tom', 'Brooks', '2012-01-18', '00:00:00', '00:00:00', '09:08:16', '00:00:00', '00:00:00', 0, 2, 0),
(266, 1900100068253, 'Russell', 'Simmons', '2012-01-19', '00:00:00', '00:00:00', '01:49:37', '00:00:00', '00:00:00', 0, 4, 0),
(267, 1900100068238, 'Paul', 'McCartney', '2012-01-19', '00:00:00', '00:00:00', '01:50:18', '00:00:00', '00:00:00', 0, 2, 4),
(268, 1900100067918, 'Tom', 'Brooks', '2012-01-19', '10:00:00', '00:00:00', '02:50:03', '00:00:00', '00:00:00', 0, 2, 4),
(269, 1900100068212, 'Clint', 'Eastwood', '2012-01-19', '00:00:00', '00:00:00', '06:52:37', '00:00:00', '00:00:00', 0, 2, 3),
(270, 1900100068220, 'Donovan', 'Leitch', '2012-01-19', '00:00:00', '00:00:00', '06:53:08', '00:00:00', '00:00:00', 0, 1, 0),
(271, 1900100068246, 'David', 'Lynch', '2012-01-19', '00:00:00', '00:00:00', '06:53:25', '00:00:00', '00:00:00', 0, 3, 0),
(272, 1900100067900, 'Craig', 'Pearson', '2012-01-19', '00:00:00', '00:00:00', '06:54:25', '00:00:00', '00:00:00', 0, 0, 3),
(273, 1900100077777, 'Kris', 'Wood', '2012-01-19', '00:00:00', '00:00:00', '09:37:01', '00:00:00', '00:00:00', 0, 1, 4),
(274, 1900100068279, 'Ringo', 'Starr', '2012-01-19', '00:00:00', '00:00:00', '09:43:11', '00:00:00', '00:00:00', 0, 3, 0),
(275, 1900100068204, 'Oprah', 'Winfrey', '2012-01-19', '00:00:00', '00:00:00', '09:43:44', '00:00:00', '00:00:00', 0, 4, 2),
(276, 1900100077777, 'Kris', 'Wood', '2012-01-21', '12:40:26', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 7, 2),
(277, 1900100067918, 'Tom', 'Brooks', '2012-01-21', '12:41:39', '00:00:00', '01:20:00', '00:00:00', '00:00:00', 0, 2, 2),
(278, 1900100068253, 'Russell', 'Simmons', '2012-01-21', '12:41:53', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 4, 3),
(279, 1900100068279, 'Ringo', 'Starr', '2012-01-21', '01:18:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 1, 0),
(280, 1900100068238, 'Paul', 'McCartney', '2012-01-21', '01:19:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 4, 4),
(281, 1900100068220, 'Donovan', 'Leitch', '2012-01-21', '01:19:38', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 4),
(282, 1900100067900, 'Craig', 'Pearson', '2012-01-21', '01:25:46', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 7, 1),
(283, 1900100068204, 'Oprah', 'Winfrey', '2012-01-21', '01:33:55', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 7, 2),
(284, 1900100068212, 'Clint', 'Eastwood', '2012-01-21', '01:38:27', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 0),
(285, 1900100068246, 'David', 'Lynch', '2012-01-21', '01:39:33', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 6, 2),
(286, 1900100000003, 'Jeff', 'Cohen', '2012-02-25', '09:54:04', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 4),
(287, 1900100067875, 'Paul', 'McCartney', '2012-02-25', '09:56:04', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 1, 2),
(288, 1900100000016, 'Expert', 'Developer', '2012-02-29', '02:47:23', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 3),
(289, 1100010000001, 'Test', 'Account', '2012-02-29', '04:49:54', '00:00:00', '06:55:13', '00:00:00', '00:00:00', 0, 4, 2),
(290, 1900100111111, 'Adam', 'Administrator', '2012-02-29', '00:00:00', '00:00:00', '12:39:56', '00:00:00', '00:00:00', 0, 2, 2),
(291, 1900100000005, 'Julie', 'Anne', '2012-02-29', '00:00:00', '00:00:00', '06:55:59', '00:00:00', '00:00:00', 0, 8, 1),
(292, 1900100067842, 'Clint', 'Eastwood', '2012-02-29', '00:00:00', '00:00:00', '06:57:17', '00:00:00', '00:00:00', 0, 0, 3),
(293, 1900100000004, 'Rod', 'Eason', '2012-02-29', '00:00:00', '00:00:00', '06:57:50', '00:00:00', '00:00:00', 0, 6, 1),
(294, 1900100000007, 'Craig', 'Pearson', '2012-02-29', '00:00:00', '00:00:00', '11:53:28', '00:00:00', '00:00:00', 0, 2, 1),
(295, 1190010000013, 'Ken', 'Woodward', '2012-03-01', '12:17:34', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 0, 3),
(296, 1900100068279, 'Ringo', 'Starr', '2012-03-01', '12:19:09', '00:00:00', '03:52:43', '00:00:00', '00:00:00', 0, 5, 3),
(297, 1900100000016, 'Expert', 'Developer', '2012-03-01', '12:25:04', '00:00:00', '06:37:58', '00:00:00', '00:00:00', 0, 4, 2),
(298, 1900100300002, 'Jeff', 'Cohen', '2012-03-01', '12:56:51', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 1),
(299, 1900100000005, 'Julie', 'Anne', '2012-03-01', '12:57:09', '00:00:00', '06:41:37', '00:00:00', '00:00:00', 0, 3, 2),
(300, 1100010000001, 'Test', 'Account', '2012-03-01', '01:28:30', '00:00:00', '06:38:20', '00:00:00', '00:00:00', 0, 7, 4),
(301, 1900000000001, 'New User', '', '2012-03-01', '03:56:26', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 4, 1),
(302, 1900100067800, 'Oprah', 'Winfrey', '2012-03-01', '04:21:52', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 4, 3),
(303, 1900100111111, 'Adam', 'Administrator', '2012-03-01', '06:45:27', '00:00:00', '06:38:43', '00:00:00', '00:00:00', 0, 3, 0),
(304, 1900100000007, 'Craig', 'Pearson', '2012-03-01', '07:08:54', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 8, 3),
(305, 1900100068261, 'Jerry', 'Seinfeld', '2012-03-01', '00:00:00', '00:00:00', '04:11:38', '00:00:00', '00:00:00', 0, 6, 0),
(306, 1900100068220, 'Donovan', 'Leitch', '2012-03-01', '00:00:00', '00:00:00', '04:23:21', '00:00:00', '00:00:00', 0, 1, 3),
(307, 1900100000003, 'Jeff', 'Cohen', '2012-03-01', '00:00:00', '00:00:00', '06:45:25', '00:00:00', '00:00:00', 0, 6, 3),
(308, 1900100067918, 'Tom', 'Brooks', '2012-03-01', '00:00:00', '00:00:00', '06:54:54', '00:00:00', '00:00:00', 0, 2, 3),
(309, 1900100000010, 'Paul', 'Handelman', '2012-03-01', '00:00:00', '00:00:00', '07:52:29', '00:00:00', '00:00:00', 0, 3, 0),
(310, 1900100067859, 'Russell', 'Simmons', '2012-03-01', '00:00:00', '00:00:00', '07:57:16', '00:00:00', '00:00:00', 0, 2, 0),
(311, 1900100000006, 'Jim', 'Collins', '2012-03-02', '01:37:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 0, 3),
(312, 1900100000004, 'Rod', 'Eason', '2012-03-02', '01:37:54', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 4),
(313, 1900100068220, 'Donovan', 'Leitch', '2012-03-02', '01:38:05', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 6, 0),
(314, 1900100000002, 'Robert', 'Kennedy', '2012-03-02', '03:58:38', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 3, 0),
(315, 1900100000009, 'Matt', 'Jaffey', '2012-03-02', '04:11:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 8, 2),
(316, 1900100040203, 'Bryan2', 'Lee', '2012-03-02', '04:11:51', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 2),
(317, 1900100067800, 'Oprah', 'Winfrey', '2012-03-02', '08:47:28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 8, 3),
(318, 1900100077777, 'Kris', 'Wood', '2012-03-02', '11:53:46', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 1, 1),
(319, 1190010000013, 'Ken', 'Woodward', '2012-03-02', '00:00:00', '00:00:00', '11:06:16', '00:00:00', '00:00:00', 0, 7, 4),
(320, 1900000000001, 'In-Process', '2', '2012-03-03', '06:41:57', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `calendarDay`
--

CREATE TABLE `calendarDay` (
  `clnDayID` int(11) NOT NULL,
  `clnDay` date default NULL,
  `badWeather` tinyint(1) default NULL,
  `cdPeriod` tinyint(1) NOT NULL,
  PRIMARY KEY  (`clnDayID`),
  UNIQUE KEY `calendarDay` (`clnDay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendarDay`
--

INSERT INTO `calendarDay` (`clnDayID`, `clnDay`, `badWeather`, `cdPeriod`) VALUES
(1, '2011-10-23', 1, 0),
(2, '2011-10-24', 1, 0),
(3, '2011-10-07', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `commId` int(11) NOT NULL,
  `community` char(3) NOT NULL,
  `main` int(5) NOT NULL default '1',
  `mum` int(5) NOT NULL default '1',
  PRIMARY KEY  (`commId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`commId`, `community`, `main`, `mum`) VALUES
(1, 'MUM', 0, 1),
(2, 'IAG', 1, 0),
(3, 'MIG', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE `display` (
  `timeId` smallint(5) NOT NULL auto_increment,
  `barcode` bigint(25) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `inAM` time NOT NULL,
  `outAM` time NOT NULL,
  `inPM` time NOT NULL,
  `outPM` time NOT NULL,
  `manualIn` time NOT NULL,
  `relaxMin` tinyint(2) NOT NULL,
  `i` int(2) NOT NULL,
  `j` int(2) NOT NULL,
  PRIMARY KEY  (`timeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `display`
--


-- --------------------------------------------------------

--
-- Table structure for table `LOA`
--

CREATE TABLE `LOA` (
  `fk_barcode` int(11) NOT NULL,
  `fk_clnDayID` int(11) NOT NULL,
  `LOA_type` tinyint(4) NOT NULL,
  UNIQUE KEY `uIdx_LOA` (`fk_barcode`,`fk_clnDayID`,`LOA_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LOA`
--


-- --------------------------------------------------------

--
-- Table structure for table `lostBarcodes`
--

CREATE TABLE `lostBarcodes` (
  `number` int(8) NOT NULL auto_increment,
  `serialNumber` int(8) NOT NULL,
  `lostBarcode` bigint(13) NOT NULL,
  `newBarcode` bigint(13) NOT NULL,
  UNIQUE KEY `number` (`number`,`lostBarcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lostBarcodes`
--

INSERT INTO `lostBarcodes` (`number`, `serialNumber`, `lostBarcode`, `newBarcode`) VALUES
(1, 1011, 1900178777897, 1900100067876),
(2, 1011, 1900100067876, 1900178777897),
(3, 1011, 1900178777897, 1900178777879),
(4, 1056, 1900110000013, 1900111010013);

-- --------------------------------------------------------

--
-- Table structure for table `programLocation`
--

CREATE TABLE `programLocation` (
  `PLID` smallint(6) NOT NULL,
  `PLName` varchar(255) NOT NULL,
  PRIMARY KEY  (`PLID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programLocation`
--


-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `serialNumber` int(20) NOT NULL default '0',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `comments` varchar(200) NOT NULL,
  `editor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Editor''s review';

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`serialNumber`, `date`, `comments`, `editor`) VALUES
(1056, '2012-03-03 08:28:32', 'First name lastname changed', 'Exper Developer'),
(1056, '2012-03-03 08:29:41', 'Barcode upgraded', 'Exper Developer'),
(1056, '2012-03-03 08:34:45', 'Barcode changed', 'Exper Developer'),
(1056, '2012-03-03 10:06:29', 'username changed', 'Exper Developer'),
(1056, '2012-03-03 10:13:59', 'Lost Barcode replaced\n (1900110000013 changed to 1900111010013)', 'Exper Developer'),
(1056, '2012-03-03 21:41:12', 'changed email subscription', 'Exper Developer'),
(1059, '2012-03-03 22:14:56', 'test comment', 'Exper Developer'),
(1059, '2012-03-03 22:17:28', 'test change of barcode number', 'Paul McCartney'),
(1059, '2012-03-03 23:08:10', 'hi', 'Exper Developer'),
(1058, '2012-03-04 15:01:56', 'Corrected spelling of first name', 'Paul McCartney'),
(1062, '2012-03-06 16:51:32', 'Changed subscribe from yes to no, since this person does not use e-mail', 'Paul McCartney');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(50) NOT NULL,
  `role` varchar(50) NOT NULL default 'user',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(0, 'User'),
(1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `scanningComputer`
--

CREATE TABLE `scanningComputer` (
  `SCID` smallint(6) NOT NULL,
  `SCDesc` varchar(255) NOT NULL,
  PRIMARY KEY  (`SCID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scanningComputer`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `serialNumber` int(11) NOT NULL auto_increment,
  `barcode` bigint(13) NOT NULL,
  `password` varchar(255) default NULL,
  `userName` varchar(255) default NULL,
  `firstName` varchar(255) default NULL,
  `midName` varchar(255) default NULL,
  `lastName` varchar(255) default NULL,
  `gender` char(1) default NULL,
  `subscribe` char(1) NOT NULL default 'Y',
  `role` int(5) NOT NULL default '0' COMMENT 'role of the user',
  PRIMARY KEY  (`serialNumber`),
  UNIQUE KEY `barcode` (`barcode`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1063 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`serialNumber`, `barcode`, `password`, `userName`, `firstName`, `midName`, `lastName`, `gender`, `subscribe`, `role`) VALUES
(1001, 1900100077777, '202cb962ac59075b964b07152d234b70', 'klwood@mum.edu', 'Kris', '', 'Wood', 'F', 'Y', 1),
(1002, 1900100067918, '9edf4fa7b7eaa05b7a112c49c219790e', 'tbrooks@mum.edu', 'Tom', '', 'Brooks', 'M', 'Y', 1),
(1003, 1900100068279, '202cb962ac59075b964b07152d234b70', 'rstarr@mum.edu', 'Ringo', '', 'Starr', 'M', 'Y', 0),
(1013, 1900100067800, '202cb962ac59075b964b07152d234b70', 'owinfrey@mum.edu', 'Oprah', '', 'Winfrey', 'F', 'Y', 0),
(1014, 1900100067818, '202cb962ac59075b964b07152d234b70', 'dlynch@dltv.com', 'David', '', 'Lynch', 'M', 'Y', 0),
(1015, 1900100067842, '202cb962ac59075b964b07152d234b70', 'ceastwood@mum.edu', 'Clint', '', 'Eastwood', 'M', 'Y', 0),
(1016, 1900100067859, '202cb962ac59075b964b07152d234b70', 'rsimmons@mum.edu', 'Russell', '', 'Simmons', 'M', 'Y', 1),
(1017, 1900100067834, '202cb962ac59075b964b07152d234b70', 'rbrand@mum.edu', 'Russell', '', 'Brand', 'M', 'Y', 0),
(1018, 1900100067867, '202cb962ac59075b964b07152d234b70', 'kperry@mum.edu', 'Katy', '', 'Perry', 'F', 'Y', 1),
(1038, 1900100067875, '202cb962ac59075b964b07152d234b70', 'pmccartney@mum.edu', 'Paul', '', 'McCartney', 'M', 'Y', 1),
(1040, 1900100111111, '81dc9bdb52d04dc20036dbd8313ed055', 'aadministrator@mum.edu', 'Adam', '', 'Administrator', 'M', 'Y', 1),
(1041, 1900100000001, '202cb962ac59075b964b07152d234b70', 'blee108@gmail.com', 'Bryan', '', 'Lee', 'M', 'Y', 1),
(1042, 1900100000002, '202cb962ac59075b964b07152d234b70', 'lovetm@yahoo.com', 'Robert', '', 'Kennedy', 'M', 'Y', 1),
(1043, 1900100000003, '202cb962ac59075b964b07152d234b70', 'jrcohen@mum.edu', 'Jeff', '', 'Cohen', 'M', 'Y', 1),
(1044, 1900100000004, '202cb962ac59075b964b07152d234b70', 'reason@mum.edu', 'Rod', '', 'Eason', 'M', 'Y', 1),
(1045, 1900100000005, '202cb962ac59075b964b07152d234b70', 'invincibility@globalcountry.net', 'Julie', '', 'Anne', 'F', 'Y', 1),
(1046, 1900100000006, '202cb962ac59075b964b07152d234b70', 'jim@sidhasuccess.com', 'Jim', '', 'Collins', 'M', 'Y', 1),
(1047, 1900100000007, '202cb962ac59075b964b07152d234b70', 'cpearson@mum.edu', 'Craig', '', 'Pearson', 'M', 'Y', 1),
(1048, 1900100000008, '202cb962ac59075b964b07152d234b70', 'simonshotels@yahoo.com', 'Simon', '', 'Davies', 'M', 'Y', 1),
(1049, 1900100000009, '202cb962ac59075b964b07152d234b70', 'mjaffey@mum.edu', 'Matt', '', 'Jaffey', 'M', 'Y', 1),
(1050, 1900100000010, '202cb962ac59075b964b07152d234b70', 'phandel@mum.edu', 'Paul', '', 'Handelman', 'M', 'Y', 1),
(1051, 1900100000012, '202cb962ac59075b964b07152d234b70', 'thirsch@mum.edu', 'Tom', '', 'Hirsch', 'M', 'Y', 1),
(1052, 1190010000013, '202cb962ac59075b964b07152d234b70', 'kwoodward@mum.edu', 'Ken', '', 'Woodward', 'M', 'Y', 1),
(1053, 1900100000014, '202cb962ac59075b964b07152d234b70', 'dovaitt@mum.edu', 'Douglas', '', 'Ovaitt', 'M', 'Y', 1),
(1054, 1900100000015, '202cb962ac59075b964b07152d234b70', 'srodriguez@mum.edu', 'Simon', '', 'Rodriquez', 'M', 'Y', 1),
(1055, 1900100040203, '81dc9bdb52d04dc20036dbd8313ed055', 'blee10281@gmail.com', 'Bryan2', NULL, 'Lee', 'M', 'Y', 1),
(1056, 1900111010013, '5d78d182fd5f5510588695863d22ac27', 'lovet123m@yahoo.com', 'Temp', '', 'Name1', 'M', 'N', 1),
(1057, 1900100300002, '202cb962ac59075b964b07152d234b70', 'jrcoh3en@mum.edu', 'Jeff', NULL, 'Cohen', 'M', 'Y', 1),
(1058, 1900100000016, '202cb962ac59075b964b07152d234b70', 'edeveloper@myattenance.us', 'Expert', '', 'Developer', 'M', 'Y', 1),
(1059, 1100010000001, '202cb962ac59075b964b07152d234b70', 'taccount@mum.edu', 'Test', '', 'Account', 'M', 'Y', 0),
(1060, 1900100068261, '202cb962ac59075b964b07152d234b70', 'jseinfeld@mum.edu', 'Jerry', '', 'Seinfeld', 'M', 'Y', 1),
(1061, 1900100068220, '202cb962ac59075b964b07152d234b70', 'dleitch@mum.edu', 'Donovan', '', 'Leitch', 'M', 'Y', 0),
(1062, 1900100033333, '202cb962ac59075b964b07152d234b70', 'test2@no-email.com', 'Test 2', '', 'Account', 'F', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userCommunity`
--

CREATE TABLE `userCommunity` (
  `userCommunityID` bigint(20) NOT NULL auto_increment,
  `serialNumber` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `mum_stat` int(2) NOT NULL default '0' COMMENT 'Mum status',
  `iag_stat` int(2) NOT NULL default '0' COMMENT 'Iag Status',
  `mumCommunity` int(1) NOT NULL default '0' COMMENT 'present=1/absent=0',
  `iagCommunity` int(1) NOT NULL default '0' COMMENT 'present=1/absent=0',
  UNIQUE KEY `userCommunityID` (`userCommunityID`),
  KEY `serialNumber` (`serialNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `userCommunity`
--

INSERT INTO `userCommunity` (`userCommunityID`, `serialNumber`, `startDate`, `mum_stat`, `iag_stat`, `mumCommunity`, `iagCommunity`) VALUES
(1, 1001, '2012-02-07', 1, 0, 1, 0),
(2, 1002, '2012-02-06', 1, 0, 1, 0),
(3, 1003, '2012-02-05', 1, 0, 1, 0),
(5, 1013, '0000-00-00', 1, 0, 1, 0),
(6, 1014, '0000-00-00', 1, 0, 1, 0),
(7, 1015, '0000-00-00', 1, 0, 1, 0),
(8, 1016, '0000-00-00', 1, 1, 1, 1),
(9, 1017, '0000-00-00', 0, 0, 0, 1),
(10, 1018, '0000-00-00', 1, 1, 1, 1),
(15, 1038, '0000-00-00', 1, 1, 1, 1),
(17, 1040, '0000-00-00', 1, 0, 1, 0),
(18, 1041, '0000-00-00', 1, 0, 1, 0),
(19, 1042, '0000-00-00', 1, 0, 1, 0),
(20, 1043, '0000-00-00', 0, 0, 1, 0),
(21, 1044, '0000-00-00', 1, 0, 1, 0),
(22, 1045, '0000-00-00', 1, 0, 1, 0),
(23, 1046, '0000-00-00', 1, 0, 1, 0),
(24, 1047, '0000-00-00', 1, 0, 1, 0),
(25, 1048, '0000-00-00', 1, 0, 1, 0),
(26, 1049, '0000-00-00', 1, 0, 1, 0),
(27, 1050, '0000-00-00', 1, 0, 1, 0),
(28, 1051, '0000-00-00', 1, 0, 1, 0),
(29, 1052, '0000-00-00', 1, 0, 1, 0),
(30, 1053, '0000-00-00', 1, 0, 1, 0),
(31, 1054, '0000-00-00', 1, 0, 1, 0),
(32, 1055, '0000-00-00', 1, 0, 1, 0),
(33, 1056, '0000-00-00', 1, 0, 1, 0),
(34, 1057, '0000-00-00', 1, 0, 1, 0),
(35, 1058, '0000-00-00', 1, 0, 1, 0),
(36, 1059, '0000-00-00', 0, 0, 1, 0),
(37, 1060, '0000-00-00', 1, 0, 1, 0),
(38, 1061, '0000-00-00', 1, 0, 1, 0),
(39, 1062, '0000-00-00', 1, 0, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userCommunity`
--
ALTER TABLE `userCommunity`
  ADD CONSTRAINT `userCommunity_ibfk_8` FOREIGN KEY (`serialNumber`) REFERENCES `user` (`serialNumber`) ON DELETE CASCADE ON UPDATE CASCADE;
