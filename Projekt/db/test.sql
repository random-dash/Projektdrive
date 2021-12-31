-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 05:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsimg`
--

CREATE TABLE `newsimg` (
  `ID` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `txt` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `anrede` varchar(128) NOT NULL,
  `vorname` varchar(128) NOT NULL,
  `nachname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `position` enum('admin','service','guest') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `pwd`, `anrede`, `vorname`, `nachname`, `email`, `position`) VALUES
(2, 'tester', '$2y$10$wtlr2FYtR9rddwV18G2XYeHAfEg88kkidCYdImeLw.b5VKt4OuTNy', 'Herr', 'Testing', 'Tester', 'tester@gmx.at', 'guest'),
(3, 'xrmx', '$2y$10$lXygc/UGNVQoJAVHEy4/FuwmVSQGJlHLCdB7U0byqRd7k8D0yj.mC', 'Herr', 'Mustafa', 'RAHIMI', 'rahimi@hotmail.com', 'guest'),
(4, 'klimt', '$2y$10$9fiT9CzU49VwincrpWpAYua.gyWPx2SxATFCc5jeMRNMIOgqLPsRy', 'Herr', 'Gustav', 'Klimt', 'klimt@klimt.at', 'guest'),
(5, 'amy', '$2y$10$uLwbrW2Zu5rLswFJlreRs.oJnY75TIYQ5/upexjaMlisR6vJ8USYa', 'Frau', 'Amy', 'Amies', 'amy@amy.at', 'guest'),
(6, 'admin', '$2y$10$zC36sS6K1Y7VSQi7mrxeq.IOnkpaMPWOXA6IW2Lofc6hdbHpga1xG', 'Herr', 'admin', 'admin', 'admin@admin.at', 'admin'),
(7, 'belal', '$2y$10$ZFbqmHQt.g4i380ezrzAWe3RDwlos2NLd4Xs7CrzFk3TRgNZxgpDK', 'Herr', 'Belal', 'Abdelhady', 'belal@ab.at', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsimg`
--
ALTER TABLE `newsimg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsimg`
--
ALTER TABLE `newsimg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
