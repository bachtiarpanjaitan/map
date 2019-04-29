-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 29 Apr 2019 pada 15.52
-- Versi server: 5.7.24
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `map`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvalstatus`
--

DROP TABLE IF EXISTS `approvalstatus`;
CREATE TABLE IF NOT EXISTS `approvalstatus` (
  `approvalstatusid` int(11) NOT NULL AUTO_INCREMENT,
  `approvalstatusname` varchar(10) NOT NULL,
  PRIMARY KEY (`approvalstatusid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `approvalstatus`
--

INSERT INTO `approvalstatus` (`approvalstatusid`, `approvalstatusname`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bloks`
--

DROP TABLE IF EXISTS `bloks`;
CREATE TABLE IF NOT EXISTS `bloks` (
  `blokid` int(11) NOT NULL AUTO_INCREMENT,
  `blokname` varchar(100) NOT NULL,
  PRIMARY KEY (`blokid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bloks`
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
-- Struktur dari tabel `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `bookid` int(11) NOT NULL AUTO_INCREMENT,
  `unitid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `remarks` text,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`bookid`, `unitid`, `fullname`, `email`, `address`, `phone`, `remarks`) VALUES
(6, 1, 'jack mamba2', 'asdadsa@gmail.com', 'Medan Belawan', '08123123', 'asdasdf asd'),
(2, 2, 'Paramitha', 'paramita@gmail.com', 'medan', '08123123', 'Testing insert from form');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE IF NOT EXISTS `levels` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `levelname` varchar(50) NOT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`levelid`, `levelname`) VALUES
(1, 'Manager'),
(2, 'Head Division'),
(3, 'Staff'),
(5, 'Customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `requestdetails`
--

DROP TABLE IF EXISTS `requestdetails`;
CREATE TABLE IF NOT EXISTS `requestdetails` (
  `requestdetailid` int(11) NOT NULL AUTO_INCREMENT,
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
  `approveddate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`requestdetailid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `requestdetails`
--

INSERT INTO `requestdetails` (`requestdetailid`, `requesttypeid`, `username`, `unittypeid`, `blokid`, `checkindate`, `checkoutdate`, `unitid`, `marriagecertificate`, `createdat`, `createdby`, `updatedat`, `updatedby`, `approvedstatusid`, `approvedby`, `approveddate`) VALUES
(6, 1, 'user', 1, 2, '2019-04-28 00:00:00', '2019-04-28 00:00:00', 2, '5cc5cffa046ea.jpeg', '2019-04-28 16:08:30', '0000-00-00 00:00:00', NULL, NULL, 2, 'admin', '2019-04-29 08:51:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `requesttypes`
--

DROP TABLE IF EXISTS `requesttypes`;
CREATE TABLE IF NOT EXISTS `requesttypes` (
  `requesttypeid` int(11) NOT NULL AUTO_INCREMENT,
  `requesttypename` varchar(50) NOT NULL,
  PRIMARY KEY (`requesttypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `requesttypes`
--

INSERT INTO `requesttypes` (`requesttypeid`, `requesttypename`) VALUES
(1, 'Unit Baru'),
(2, 'Maintenance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`roleid`, `rolename`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `statusid` int(11) NOT NULL AUTO_INCREMENT,
  `statusname` varchar(25) NOT NULL,
  PRIMARY KEY (`statusid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`statusid`, `statusname`) VALUES
(1, 'Allow Order'),
(2, 'On Booking'),
(3, 'On Order'),
(4, 'Maintenance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unitid` int(11) NOT NULL AUTO_INCREMENT,
  `unitcoords` text NOT NULL,
  `unittitle` text NOT NULL,
  `unitdescription` text,
  `statusid` int(11) NOT NULL DEFAULT '1',
  `blokid` int(11) DEFAULT '0',
  PRIMARY KEY (`unitid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`unitid`, `unitcoords`, `unittitle`, `unitdescription`, `statusid`, `blokid`) VALUES
(1, '562,470,562,478,574,476,573,468', 'UNIT S', 'Testing Edit Lagi', 1, 1),
(2, '562,470,562,478,574,476,573,468', 'UNIT P', 'Testing Edit Lagi', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unittypes`
--

DROP TABLE IF EXISTS `unittypes`;
CREATE TABLE IF NOT EXISTS `unittypes` (
  `unittypeid` int(11) NOT NULL AUTO_INCREMENT,
  `unittypename` varchar(50) NOT NULL,
  PRIMARY KEY (`unittypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unittypes`
--

INSERT INTO `unittypes` (`unittypeid`, `unittypename`) VALUES
(1, 'Unit Requler'),
(2, 'Dormitory');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `levelid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `telepon` text NOT NULL,
  `issuspend` tinyint(1) NOT NULL DEFAULT '0',
  `blokid` int(11) DEFAULT NULL,
  `allowapproverequest` tinyint(4) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `fullname`, `email`, `password`, `levelid`, `roleid`, `telepon`, `issuspend`, `blokid`, `allowapproverequest`) VALUES
('user', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 3, 3, '08123123123', 0, 1, 0),
('admin', 'asdas awdwd', 'asdadsa@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 1, '08123123', 0, 0, 1),
('Test', 'test', 'test@gmail.com', '0cbc6611f5540bd0809a388dc95a615b', 2, 2, '08123123123', 0, 1, 0),
('customer', 'customer Satu', 'customer@gmail.com', '91ec1f9324753048c0096d036a694f86', 5, 3, '0812312313', 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
