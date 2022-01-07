-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 01:36 PM
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
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsimg`
--

INSERT INTO `newsimg` (`ID`, `filepath`, `txt`, `time`) VALUES
(22, 'uploads/news/1640961625.jpg', 'Besten Preise zum Neujahr. Besuchen Sie uns bald!', '2021-12-31'),
(27, 'uploads/news/1641445952.jpg', 'Sehr geehrte Damen und Herren,\r\nunser Hotel wurde neu renoviert. \r\nVielen Dank!', '2022-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `ID` int(11) NOT NULL,
  `note` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ticketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`ID`, `note`, `time`, `ticketID`, `userID`) VALUES
(2, 'Versuchen Sie jetzt mal?', '2022-01-05 04:54:55', 10, 8),
(3, 'Habs versucht und geht wieder Dankeschön!', '2022-01-05 04:56:00', 10, 5),
(4, 'Super! Dann wird das Ticket jetzt geschlossen. LG', '2022-01-05 04:56:56', 10, 8),
(6, 'Sehr geehrte Frau Amy,\r\nIhr Account wir demnächst deaktiviert. Sollten Sie ihn wieder aktivieren wollen, dann melden Sie sich bitte über unserer Email.\r\nMFG', '2022-01-05 05:08:38', 11, 8),
(7, 'Vielen Dank für die Rückmeldung. LG', '2022-01-05 16:11:43', 11, 5),
(8, 'Account ist deaktiviert!', '2022-01-06 05:08:55', 11, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `txt` text NOT NULL,
  `status` enum('offen','erfolgreich geschlossen','erfolglos geschlossen') NOT NULL DEFAULT 'offen',
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketID`, `pic`, `title`, `txt`, `status`, `time`, `userID`) VALUES
(10, 'uploads/tickets/500_F_209993509_bgSL37pfhLIq9uF0hoOG1LvOkoe9V7Ax.jpg', 'Mein Login funktioniert nicht.', 'Hallo, mein Login funktioniert leider nicht. Bitte dringend beheben.', 'erfolgreich geschlossen', '2022-01-05 05:04:27', 5),
(11, 'uploads/tickets/Screenshot (7).png', 'Bitte Account deaktivieren', 'Bitte deaktivieren Sie meinen Account! Danke und LG', 'offen', '2022-01-06 05:08:28', 5);

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
  `position` enum('admin','service','guest') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `pwd`, `anrede`, `vorname`, `nachname`, `email`, `position`, `status`) VALUES
(2, 'tester', '$2y$10$wtlr2FYtR9rddwV18G2XYeHAfEg88kkidCYdImeLw.b5VKt4OuTNy', 'Herr', 'Testing', 'Tester', 'tester@gmx.at', 'guest', 'active'),
(4, 'klimt', '$2y$10$XmrvXNvzY7tJeDlt.dRT6OAyBRtSdGuvDuHOqffTjAUYC/HGzN3gy', 'Herr', 'Gustav', 'Klimt', 'klimt@klimt.at', 'guest', 'active'),
(5, 'amy', '$2y$10$uLwbrW2Zu5rLswFJlreRs.oJnY75TIYQ5/upexjaMlisR6vJ8USYa', 'Frau', 'Amy', 'Amies', 'amy@amy.at', 'guest', 'active'),
(6, 'admin', '$2y$10$ZYHIGKUzSIR5oMUuy/ZoBuSJQx6nQVsELVC5t/dljxiVgQtv4IaHq', 'Herr', 'admin', 'admin', 'admin@admin.at', 'admin', 'active'),
(8, 'techniker', '$2y$10$c1MGyOps3KkJIwj0puaQc.m5Ff3BhukFNmvHW4ONU87N1ZA5vibfO', 'Herr', 'Technik', 'Techniker', 'techniker@technik.at', 'service', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsimg`
--
ALTER TABLE `newsimg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ticketID` (`ticketID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `userID` (`userID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`ticketID`) REFERENCES `tickets` (`ticketID`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
