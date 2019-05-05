-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2019 at 07:37 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indonesia`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvalstatus`
--

CREATE TABLE `approvalstatus` (
  `approvalstatusid` int(11) NOT NULL,
  `approvalstatusname` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approvalstatus`
--

INSERT INTO `approvalstatus` (`approvalstatusid`, `approvalstatusname`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `bloks`
--

CREATE TABLE `bloks` (
  `blokid` int(11) NOT NULL,
  `blokname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloks`
--

INSERT INTO `bloks` (`blokid`, `blokname`) VALUES
(1, 'Blok S'),
(2, 'Blok P'),
(3, 'Blok B'),
(4, 'Blok U'),
(5, 'Blok T'),
(0, 'Allow All');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `remarks` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `unitid`, `fullname`, `email`, `address`, `phone`, `remarks`) VALUES
(6, 1, 'jack mamba2', 'asdadsa@gmail.com', 'Medan Belawan', '08123123', 'asdasdf asd'),
(2, 2, 'Paramitha', 'paramita@gmail.com', 'medan', '08123123', 'Testing insert from form');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `levelid` int(11) NOT NULL,
  `levelname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`levelid`, `levelname`) VALUES
(1, 'Manager'),
(2, 'Head Division'),
(3, 'Staff'),
(5, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `requestdetails`
--

CREATE TABLE `requestdetails` (
  `requestdetailid` int(11) NOT NULL,
  `requesttypeid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `unittypeid` int(11) NOT NULL,
  `blokid` int(11) NOT NULL,
  `checkindate` datetime DEFAULT NULL,
  `checkoutdate` datetime DEFAULT NULL,
  `unitid` int(11) NOT NULL,
  `marriagecertificate` text,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` timestamp NULL DEFAULT NULL,
  `approvedstatusid` tinyint(1) NOT NULL DEFAULT '1',
  `approvedby` varchar(50) DEFAULT NULL,
  `approveddate` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestdetails`
--

INSERT INTO `requestdetails` (`requestdetailid`, `requesttypeid`, `username`, `unittypeid`, `blokid`, `checkindate`, `checkoutdate`, `unitid`, `marriagecertificate`, `createdat`, `createdby`, `updatedat`, `updatedby`, `approvedstatusid`, `approvedby`, `approveddate`) VALUES
(6, 1, 'user', 1, 2, '2019-04-28 00:00:00', '2019-04-28 00:00:00', 2, '5cc5cffa046ea.jpeg', '2019-04-28 16:08:30', '0000-00-00 00:00:00', NULL, NULL, 2, 'admin', '2019-04-29 08:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `requesttypes`
--

CREATE TABLE `requesttypes` (
  `requesttypeid` int(11) NOT NULL,
  `requesttypename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requesttypes`
--

INSERT INTO `requesttypes` (`requesttypeid`, `requesttypename`) VALUES
(1, 'Unit Baru'),
(2, 'Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `rolename`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusid` int(11) NOT NULL,
  `statusname` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusid`, `statusname`) VALUES
(1, 'Allow Order'),
(2, 'On Booking'),
(3, 'On Order'),
(4, 'Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitid` int(11) NOT NULL,
  `unitcoords` text NOT NULL,
  `unittitle` text NOT NULL,
  `unitdescription` text,
  `statusid` int(11) NOT NULL DEFAULT '1',
  `blokid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitid`, `unitcoords`, `unittitle`, `unitdescription`, `statusid`, `blokid`) VALUES
(1, '707,850,759,850,759,799,707,799', 'Dormitori F', 'Perumahan Inalum', 1, 5),
(5, '415,200,473,216,499,140,441,128', 'Dormitori E-12', 'Perumahan Inalum', 1, 5),
(2, '796,694,869,779,917,760,849,657', 'Dormitori E3', 'Perumahan Inalum', 1, 5),
(3, '886,792,976,843,1031,815,966,721', 'Dormitori E4', 'Perumahan Inalum', 1, 5),
(4, '358,919,417,961,488,875,442,840', 'Dormitori E-52', 'Perumahan Inalum', 1, 5),
(6, '474,439,565,513,587,486,501,411', 'Blok P-11', 'Perumahan Inalum', 1, 5),
(7, '576,434,670,510,701,460,615,400', 'Blok P-12', 'Perumahan Inalum', 1, 5),
(8, '502,360,575,423,609,392,537,327', 'Blok P-13', 'Perumahan Inalum', 1, 5),
(9, '623,390,708,454,722,421,651,353', 'Blok P-14', 'Perumahan Inalum', 1, 5),
(10, '548,319,621,378,639,350,572,296', 'Blok P-15', 'Perumahan Inalum', 1, 5),
(11, '659,335,719,391,746,366,700,319', 'Blok P-16', 'Perumahan Inalum', 1, 5),
(12, '704,285,755,343,784,314,733,261', 'Blok P-17', 'Perumahan Inalum', 1, 5),
(13, '624,251,647,319,683,307,661,239', 'Blok P-18', 'Perumahan Inalum', 1, 5),
(14, '562,229,641,186,633,163,551,193', 'Blok B-11', 'Perumahan Inalum', 1, 5),
(15, '564,231,573,264,667,216,658,189', 'Blok B-12', 'Perumahan Inalum', 1, 5),
(16, '687,196,749,258,774,228,720,171', 'Blok B-13', 'Perumahan Inalum', 1, 5),
(17, '726,166,797,234,823,199,753,128', 'Blok B-14', 'Perumahan Inalum', 1, 5),
(18, '742,89,834,181,843,164,757,74', 'Blok B-15', 'Perumahan Inalum', 1, 5),
(19, '670,94,719,145,752,110,719,63', 'Blok B-16', 'Perumahan Inalum', 1, 5),
(20, '916,292,945,305,971,254,943,240', 'Blok U-11', 'Perumahan Inalum', 1, 5),
(21, '955,307,984,320,1010,269,982,255', 'Blok U-12', 'Perumahan Inalum', 1, 5),
(22, '990,328,1019,341,1045,290,1017,276', 'Blok U-13', 'Perumahan Inalum', 1, 5),
(23, '962,383,984,407,1006,364,987,343', 'Blok U-14', 'Perumahan Inalum', 1, 5),
(24, '930,360,955,386,982,346,956,322', 'Blok U-15', 'Perumahan Inalum', 1, 5),
(25, '892,347,924,363,947,327,917,308', 'Blok U-16', 'Perumahan Inalum', 1, 5),
(26, '886,403,907,430,931,388,911,374', 'Blok U-21', 'Perumahan Inalum', 1, 5),
(27, '910,431,936,444,958,408,929,398', 'Blok U-22', 'Perumahan Inalum', 1, 5),
(28, '941,443,968,445,991,420,960,410', 'Blok U-23', 'Perumahan Inalum', 1, 5),
(29, '973,458,1000,470,1020,437,992,425', 'Blok U-24', 'Perumahan Inalum', 1, 5),
(30, '992,408,1022,435,1062,439,1042,408', 'Blok U-25', 'Perumahan Inalum', 1, 5),
(31, '1003,471,1029,482,1049,448,1023,438', 'Blok U-26', 'Perumahan Inalum', 1, 5),
(32, '1031,483,1057,494,1078,460,1055,444', 'Blok U-27', 'Perumahan Inalum', 1, 5),
(33, '913,501,950,504,957,461,924,445', 'Blok U-28', 'Perumahan Inalum', 1, 5),
(34, '872,494,908,503,921,448,897,437', 'Blok U-29', 'Perumahan Inalum', 1, 5),
(35, '842,457,874,480,893,436,866,406', 'Blok U-30', 'Perumahan Inalum', 1, 5),
(36, '819,515,852,539,870,482,840,459', 'Blok U-31', 'Perumahan Inalum', 1, 5),
(37, '854,554,886,570,894,509,866,504', 'Blok U-32', 'Perumahan Inalum', 1, 5),
(38, '891,565,921,563,926,505.898,509', 'Blok U-33', 'Perumahan Inalum', 1, 5),
(39, '925,560,958,563,963,505,931,509', 'Blok U-34', 'Perumahan Inalum', 1, 5),
(40, '965,565,996,578,1002,514,967,509', 'Blok U-35', 'Perumahan Inalum', 1, 5),
(41, '1002,582,1035,582,1041,522,1006,519', 'Blok U-36', 'Perumahan Inalum', 1, 5),
(42, '1080,594,1137,594,1157,557,1086,540', 'Blok U-37', 'Perumahan Inalum', 1, 5),
(43, '1145,623,1182,641,1204,541,1164,542', 'Blok U-38', 'Perumahan Inalum', 1, 5),
(44, '220,400,234,438,311,403,256,374', 'Blok S-11', 'Perumahan Inalum', 1, 5),
(45, '238,444,253,488,310,449,330,410', 'Blok S-12', 'Perumahan Inalum', 1, 5),
(46, '253,492,269,528,327,485,314,452', 'Blok S-13', 'Perumahan Inalum', 1, 5),
(47, '182,526,220,543,247,478,215,465', 'Blok S-14', 'Perumahan Inalum', 1, 5),
(48, '139,591,168,609,209,545,177,530', 'Blok S-15', 'Perumahan Inalum', 1, 5),
(49, '276,530,291,566,355,523,328,497', 'Blok S-21', 'Perumahan Inalum', 1, 5),
(50, '307,561,330,585,377,551,358,527', 'Blok S-22', 'Perumahan Inalum', 1, 5),
(51, '332,586,358,606,408,572,385,551', 'Blok S-23', 'Perumahan Inalum', 1, 5),
(52, '361,608,379,638,428,604,414,574', 'Blok S-24', 'Perumahan Inalum', 1, 5),
(53, '308,664,333,684,371,646,342,617', 'Blok S-25', 'Perumahan Inalum', 1, 5),
(54, '283,640,305,660,337,616,316,591', 'Blok S-26', 'Perumahan Inalum', 1, 5),
(55, '255,622,280,639,305,590,281,571', 'Blok S-27', 'Perumahan Inalum', 1, 5),
(56, '223,606,249,620,273,572,245,555', 'Blok S-28', 'Perumahan Inalum', 1, 5),
(57, '177,611,219,608,241,556,212,544', 'Blok S-29', 'Perumahan Inalum', 1, 5),
(58, '402,800,421,833,477,788,456,758', 'Blok S-31', 'Perumahan Inalum', 1, 5),
(59, '375,766,394,796,451,753,434,726', 'Blok S-32', 'Perumahan Inalum', 1, 5),
(60, '363,728,381,759,438,717,422,691', 'Blok S-33', 'Perumahan Inalum', 1, 5),
(61, '352,693,371,718,427,681,394,665', 'Blok S-34', 'Perumahan Inalum', 1, 5),
(62, '306,748,342,753,352,695,324,694', 'Blok S-35', 'Perumahan Inalum', 1, 5),
(63, '268,712,303,745,322,692,300,674', 'Blok S-36', 'Perumahan Inalum', 1, 5),
(64, '240,692,266,711,298,673,278,655', 'Blok S-37', 'Perumahan Inalum', 1, 5),
(65, '215,669,238,691,275,655,252,634', 'Blok S-38', 'Perumahan Inalum', 1, 5),
(66, '186,637,213,666,249,632,219,616', 'Blok S-39', 'Perumahan Inalum', 1, 5),
(67, '328,853,363,867,417,845,396,810', 'Blok S-41', 'Perumahan Inalum', 1, 5),
(68, '309,813,329,851,392,808,372,783', 'Blok S-42', 'Perumahan Inalum', 1, 5),
(69, '281,814,307,830,373,778,347,759', 'Blok S-43', 'Perumahan Inalum', 1, 5),
(70, '239,793,269,816,331,770,303,749', 'Blok S-44', 'Perumahan Inalum', 1, 5),
(71, '220,759,238,787,299,748,272,721', 'Blok S-45', 'Perumahan Inalum', 1, 5),
(72, '200,731,218,752,268,721,239,700', 'Blok S-46', 'Perumahan Inalum', 1, 5),
(73, '174,709,198,729,235,697,216,677', 'Blok S-47', 'Perumahan Inalum', 1, 5),
(74, '149,685,171,707,213,676,195,655', 'Blok S-48', 'Perumahan Inalum', 1, 5),
(75, '130,655,148,681,191,651,175,625', 'Blok S-49', 'Pwerumahan Inalum', 1, 5),
(76, '870,637,900,638,905,577,873,584', 'Blok T-11', 'Perumahan Inalum', 1, 5),
(77, '904,625,933,628,947,573,908,574', 'Blok T-12', 'Perumahan Inalum', 1, 5),
(78, '935,635,964,638,986,584,957,576', 'Blok T-13', 'Perumahan Inalum', 1, 5),
(79, '964,648,995,650,1016,598,990,585', 'Blok T-14', 'Perumahan Inalum', 1, 5),
(80, '993,665,1022,667,1046,619,1019,603', 'Blok T-15', 'Perumahan Inalum', 1, 5),
(81, '874,643,879,674,938,663,933,639', 'Blok T-16', 'Perumahan Inalum', 1, 5),
(82, '884,688,933,712,961,675,945,664', 'Blok T-17', 'Perumahan Inalum', 1, 5),
(83, '944,713,983,711,1010,677,972,660', 'Blok T-18', 'Perumahan Inalum', 1, 5),
(84, '1005,741,1077,736,1065,692,1009,703', 'Blok T-19', 'Perumahan Inalum', 1, 5),
(85, '1079,724,1129,709,1120,661,1058,661', 'Blok T-20', 'Perumahan Inalum', 1, 5),
(86, '721,572,757,572,757,539,721,539', 'Mph', 'Mph', 1, 5),
(87, '768,565,804,565,804,541,768,541', 'Recreation Hall', 'Recreation Hall', 1, 5),
(88, '843,361,857,357,845,312,830,316', 'Sport Hall', 'Sport Hall', 1, 5),
(89, ' 452,510,478,543,495,517,471,491', 'Rumah A1', 'Rumah A1', 1, 5),
(90, '383,371,452,371,451,311,384,311', 'Guest House', 'Guest House', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `unittypes`
--

CREATE TABLE `unittypes` (
  `unittypeid` int(11) NOT NULL,
  `unittypename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unittypes`
--

INSERT INTO `unittypes` (`unittypeid`, `unittypename`) VALUES
(1, 'Unit Requler'),
(2, 'Dormitory');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `levelid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `telepon` text NOT NULL,
  `issuspend` tinyint(1) NOT NULL DEFAULT '0',
  `blokid` int(11) DEFAULT NULL,
  `allowapproverequest` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `fullname`, `email`, `password`, `levelid`, `roleid`, `telepon`, `issuspend`, `blokid`, `allowapproverequest`) VALUES
('admin', 'asdas awdwd', 'asdadsa@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 1, '08123123', 0, 0, 1),
('costomer', 'costomer', 'costomer@gmail.com', 'dff09b37ddf3e17ce7c7593718285d8e', 5, 3, '082272102222', 0, 0, 0),
('user', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1, 2, '082272102222', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvalstatus`
--
ALTER TABLE `approvalstatus`
  ADD PRIMARY KEY (`approvalstatusid`);

--
-- Indexes for table `bloks`
--
ALTER TABLE `bloks`
  ADD PRIMARY KEY (`blokid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`levelid`);

--
-- Indexes for table `requestdetails`
--
ALTER TABLE `requestdetails`
  ADD PRIMARY KEY (`requestdetailid`);

--
-- Indexes for table `requesttypes`
--
ALTER TABLE `requesttypes`
  ADD PRIMARY KEY (`requesttypeid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitid`);

--
-- Indexes for table `unittypes`
--
ALTER TABLE `unittypes`
  ADD PRIMARY KEY (`unittypeid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvalstatus`
--
ALTER TABLE `approvalstatus`
  MODIFY `approvalstatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bloks`
--
ALTER TABLE `bloks`
  MODIFY `blokid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `levelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requestdetails`
--
ALTER TABLE `requestdetails`
  MODIFY `requestdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requesttypes`
--
ALTER TABLE `requesttypes`
  MODIFY `requesttypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `unittypes`
--
ALTER TABLE `unittypes`
  MODIFY `unittypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
