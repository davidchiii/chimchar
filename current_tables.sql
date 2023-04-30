-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 08:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jail`
--

-- --------------------------------------------------------

--
-- Table structure for table `alias`
--

CREATE TABLE `alias` (
  `alias_id` int(11) NOT NULL,
  `criminal_id` int(11) DEFAULT NULL,
  `alias` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alias`
--

INSERT INTO `alias` (`alias_id`, `criminal_id`, `alias`) VALUES
(1, 1, 'Joker'),
(2, 2, 'Penguin'),
(3, 3, 'Riddler'),
(4, 4, 'Poison Ivy'),
(5, 5, 'Bane'),
(6, 6, 'Two-Face'),
(7, 7, 'Scarecrow'),
(8, 8, 'Mr.Freeze'),
(9, 9, 'Deadshot'),
(10, 10, 'Deathstroke');

-- --------------------------------------------------------

--
-- Table structure for table `appeal`
--

CREATE TABLE `appeal` (
  `appeal_id` int(11) NOT NULL,
  `crime_id` int(11) DEFAULT NULL,
  `appeal_filing_date` date DEFAULT NULL,
  `appeal_hearing_date` date DEFAULT NULL,
  `appeal_status` varchar(8) DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appeal`
--

INSERT INTO `appeal` (`appeal_id`, `crime_id`, `appeal_filing_date`, `appeal_hearing_date`, `appeal_status`) VALUES
(1, 1, '2001-08-24', '2001-10-22', 'D'),
(2, 1, '2002-09-28', '2002-11-27', 'A'),
(3, 2, '2002-06-22', '0000-00-00', 'A'),
(4, 2, '2006-01-09', '2006-02-28', 'D'),
(5, 5, '2006-01-08', '2006-03-04', 'A'),
(6, 6, '2007-10-20', '2007-12-09', 'A'),
(7, 7, '2010-02-13', '2010-05-06', 'D'),
(8, 9, '2013-06-17', '2013-12-26', 'A'),
(9, 9, '2018-12-23', '2019-01-15', 'P'),
(10, 9, '2022-03-10', '2022-05-17', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `crime_id` int(11) NOT NULL,
  `criminal_id` int(11) DEFAULT NULL,
  `classification` varchar(8) DEFAULT 'U',
  `date_charged` date DEFAULT NULL,
  `appeal_status` varchar(16) NOT NULL,
  `hearing_date` date DEFAULT NULL,
  `appeal_cutoff_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`crime_id`, `criminal_id`, `classification`, `date_charged`, `appeal_status`, `hearing_date`, `appeal_cutoff_date`) VALUES
(1, 1, 'F', '2001-06-18', 'CL', '2001-09-22', '2001-10-22'),
(2, 10, 'M', '2002-05-25', 'CL', '2002-10-27', '2002-11-27'),
(3, 2, 'F', '2002-07-25', 'CL', '2002-08-31', '0000-00-00'),
(4, 5, 'M', '2005-08-29', 'CL', '2006-01-31', '2006-02-28'),
(5, 3, 'U', '2005-11-13', 'CL', '2006-02-04', '2006-03-04'),
(6, 6, 'F', '2007-07-01', 'CL', '2007-11-09', '2007-12-09'),
(7, 7, 'O', '2009-12-10', 'CL', '2010-04-06', '2010-05-06'),
(8, 4, 'U', '2013-06-28', 'CL', '2013-11-26', '2013-12-26'),
(9, 9, 'U', '2018-05-20', 'CL', '2018-12-15', '2019-01-15'),
(10, 8, 'O', '2022-02-10', 'CL', '2022-04-17', '2022-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `crime_charge`
--

CREATE TABLE `crime_charge` (
  `charge_id` int(11) NOT NULL,
  `crime_id` int(11) DEFAULT NULL,
  `crime_code` int(11) DEFAULT NULL,
  `charge_status` char(2) DEFAULT NULL,
  `fine_amount` int(11) DEFAULT NULL,
  `court_fee` int(11) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_charge`
--

INSERT INTO `crime_charge` (`charge_id`, `crime_id`, `crime_code`, `charge_status`, `fine_amount`, `court_fee`, `amount_paid`, `due_date`) VALUES
(1, 1, 104, 'GL', 100000, 150, 2500, '2001-10-22'),
(2, 2, 101, 'GL', 30793, 150, 22651, '2002-11-27'),
(3, 3, 102, 'NG', 6058, 150, 2523, '0000-00-00'),
(4, 4, 107, 'GL', 7119, 150, 6614, '2006-02-28'),
(5, 5, 108, 'NG', 2504, 150, 1205, '2006-03-04'),
(6, 6, 103, 'GL', 8396, 150, 6118, '2007-12-09'),
(7, 7, 110, 'NG', 7127, 150, 7127, '2010-05-06'),
(8, 8, 102, 'GL', 48120, 150, 10861, '2013-12-26'),
(9, 9, 110, 'PD', 29095, 150, 290145, '2019-01-15'),
(10, 10, 105, 'PD', 27013, 150, 26000, '2022-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `crime_code`
--

CREATE TABLE `crime_code` (
  `crime_code` int(11) NOT NULL,
  `code_desc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_code`
--

INSERT INTO `crime_code` (`crime_code`, `code_desc`) VALUES
(105, 'Auto Theft'),
(108, 'Battery'),
(107, 'Burglary'),
(110, 'Embezzlement'),
(102, 'Felony Assault'),
(106, 'Harassment'),
(101, 'Homicide'),
(109, 'Insurance Fraud'),
(104, 'Kidnapping'),
(103, 'Robbery');

-- --------------------------------------------------------

--
-- Table structure for table `crime_officers`
--

CREATE TABLE `crime_officers` (
  `crime_id` int(11) NOT NULL,
  `officer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_officers`
--

INSERT INTO `crime_officers` (`crime_id`, `officer_id`) VALUES
(8, 1),
(7, 2),
(9, 3),
(5, 4),
(2, 5),
(3, 6),
(10, 7),
(4, 8),
(1, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `criminals`
--

CREATE TABLE `criminals` (
  `criminal_id` int(11) NOT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state_in` char(2) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `phone_nmbr` char(10) DEFAULT NULL,
  `voff_status` char(1) DEFAULT 'N',
  `probation_status` char(1) DEFAULT 'N',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criminals`
--

INSERT INTO `criminals` (`criminal_id`, `last_name`, `first_name`, `street`, `city`, `state_in`, `zip`, `phone_nmbr`, `voff_status`, `probation_status`, `user_id`) VALUES
(1, 'White', 'Jack', '83 Thatcher Drive', 'Troy', 'NY', '12180', '6559210157', 'N', 'N', 11),
(2, 'Cobblepot', 'Oswald', '477 Green Street', 'New York', 'NY', '10027', '3513447614', 'Y', 'N', 12),
(3, 'Nigma', 'Edward', '9 Windfall Street', 'Spring Valley', 'NY', '10977', '9845100329', 'Y', 'N', 13),
(4, 'Isley', 'Pamela', '361 Elm Road', 'New York', 'NY', '10002', '9555748746', 'N', 'N', 14),
(5, 'Dorrance', 'Eduardo', '494 Cross Street', 'Yonkers', 'NY', '10701', '6138896999', 'N', 'N', 15),
(6, 'Dent', 'Harvey', '6 West Berkshire Court', 'Bronx', 'NY', '10469', '2424303001', 'Y', 'N', 16),
(7, 'Crane', 'Jonathan', '9360 Anderson Street', 'Lindenhurst', 'NY', '11757', '7813725074', 'Y', 'Y', 17),
(8, 'Fries', 'Victor', '382 Liberty Drive', 'Elmont', 'NY', '11003', '9324227171', 'N', 'N', 18),
(9, 'Lawton', 'Floyd', '609 S. Lake Forest Street', 'Endicott', 'NY', '13760', '3757238985', 'Y', 'N', 19),
(10, 'Wilson', 'Slade', '819 Old York Drive', 'Brooklyn', 'NY', '11208', '7898741046', 'N', 'N', 20);

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` int(11) NOT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `precinct` char(4) NOT NULL,
  `badge` varchar(14) DEFAULT NULL,
  `phone_num` char(10) DEFAULT NULL,
  `status_val` char(1) DEFAULT 'P',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `last_name`, `first_name`, `precinct`, `badge`, `phone_num`, `status_val`, `user_id`) VALUES
(1, 'Rice', 'Jamie', '2222', '412-23-2211', '6223334583', 'A', 1),
(2, 'White', 'William', '1363', '123-62-3377', '6654468234', 'A', 2),
(3, 'Odom', 'Jake', '1422', '456-56-6830', '6651522286', 'I', 3),
(4, 'Price', 'Blake', '1422', '123-55-2466', '3451128653', 'A', 4),
(5, 'Simons', 'Kenneth', '1363', '534-33-3775', '665554885', 'A', 5),
(6, 'Amory', 'Lily', '4582', '465-59-5044', '1254886522', 'I', 6),
(7, 'Melbourne', 'Lindsey', '2312', '495-82-1161', '3558332880', 'A', 7),
(8, 'Georges', 'Fox', '2222', '132-42-7542', '6336553442', 'A', 8),
(9, 'Roman', 'Wolf', '2222', '135-73-5884', '1883050023', 'A', 9),
(10, 'Shima', 'Falco', '2222', '132-35-1232', '1889305290', 'A', 10);

-- --------------------------------------------------------

--
-- Table structure for table `prob_officer`
--

CREATE TABLE `prob_officer` (
  `prob_id` int(11) NOT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state_in` char(2) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `phone_num` char(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `status_val` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prob_officer`
--

INSERT INTO `prob_officer` (`prob_id`, `last_name`, `first_name`, `street`, `city`, `state_in`, `zip`, `phone_num`, `email`, `status_val`) VALUES
(1, 'Pern', 'Larry', '235 Frontier Dr', 'Stanton', 'VA', '55123', '1236644210', 'pern.larry@vapd.com', 'A'),
(2, 'Syn', 'Simon', '36345 Otter Ln', 'Stanton', 'VA', '55123', '1237447009', 'simon.syn@vapd.com', 'A'),
(3, 'Miller', 'Ben', '88 Broadway', 'New York', 'NY', '10003', '5346623412', 'miller@sigma.com', 'I'),
(4, 'Stanley', 'Mordy', '312 Longley Way', 'Stranton', 'VA', '55123', '6342220400', 'mordylolol@gmail.com', 'A'),
(5, 'Ou', 'Kevin', '55 Branson St', 'Monterrey', 'CA', '91889', '4127564500', 'ouch.kevin@gmail.com', 'I'),
(6, 'Chag', 'Palua', '623 Shimmerhorn Lane', 'Arcadia', 'CA', '91798', '5459890024', 'chag@gmail.com', 'A'),
(7, 'Perkins', 'Percy', '43 Lankershim Blvd', 'Ford', 'VA', '55347', '', 'pp@google.com', 'A'),
(8, 'Jordan', 'Ben', '63 Tees St', 'Orlando', 'FL', '84524', '7459920430', 'scamartist@gmail.com', 'A'),
(9, 'Armon', 'Sonny', '4388 Thomas Dr', 'Jurf', 'FL', '84524', '7458339604', 'sonnyboy@gmail.com', 'I'),
(10, 'Jackson', 'Percy', '23 Olympian Way', 'Zeus', 'CA', '65545', '2220590040', 'love@arc.net', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `sentences`
--

CREATE TABLE `sentences` (
  `sentencing_id` int(11) NOT NULL,
  `criminal_id` int(11) DEFAULT NULL,
  `sentence_type` char(1) DEFAULT NULL,
  `prob_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `num_violations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sentences`
--

INSERT INTO `sentences` (`sentencing_id`, `criminal_id`, `sentence_type`, `prob_id`, `start_date`, `end_date`, `num_violations`) VALUES
(1, 1, 'J', 5, '2001-09-22', '2045-09-22', 2),
(2, 2, 'J', 3, '2002-10-27', '2060-10-27', 2),
(3, 3, 'J', 7, '2002-08-31', '2029-08-31', 2),
(4, 4, 'J', 10, '2006-01-31', '2043-01-31', 2),
(5, 5, 'P', 8, '2006-02-04', '2028-02-04', 2),
(6, 6, 'J', 9, '2007-11-09', '2022-11-09', 2),
(7, 7, 'P', 1, '2010-04-06', '2061-04-06', 2),
(8, 8, 'P', 4, '2013-11-26', '2040-11-26', 2),
(9, 9, 'J', 6, '2018-12-15', '2025-12-15', 2),
(10, 10, 'J', 2, '2022-04-17', '2029-04-17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `permission_type` varchar(10) NOT NULL,
  `officer_id` int(11) DEFAULT NULL,
  `criminal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `permission_type`, `officer_id`, `criminal_id`) VALUES
(1, 'officer1', 'abc123', 'admin', 1, NULL),
(2, 'officer2', 'abc123', 'admin', 2, NULL),
(3, 'officer3', 'abc123', 'admin', 3, NULL),
(4, 'officer4', 'abc123', 'admin', 4, NULL),
(5, 'officer5', 'abc123', 'admin', 5, NULL),
(6, 'officer6', 'abc123', 'admin', 6, NULL),
(7, 'officer7', 'abc123', 'admin', 7, NULL),
(8, 'officer8', 'abc123', 'admin', 8, NULL),
(9, 'officer9', 'abc123', 'admin', 9, NULL),
(10, 'officer10', 'abc123', 'admin', 10, NULL),
(11, 'criminal1', 'xyz789', 'user', NULL, 1),
(12, 'criminal2', 'xyz789', 'user', NULL, 2),
(13, 'criminal3', 'xyz789', 'user', NULL, 3),
(14, 'criminal4', 'xyz789', 'user', NULL, 4),
(15, 'criminal5', 'xyz789', 'user', NULL, 5),
(16, 'criminal6', 'xyz789', 'user', NULL, 6),
(17, 'criminal7', 'xyz789', 'user', NULL, 7),
(18, 'criminal8', 'xyz789', 'user', NULL, 8),
(19, 'criminal9', 'xyz789', 'user', NULL, 9),
(20, 'criminal10', 'xyz789', 'user', NULL, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alias`
--
ALTER TABLE `alias`
  ADD PRIMARY KEY (`alias_id`),
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `appeal`
--
ALTER TABLE `appeal`
  ADD PRIMARY KEY (`appeal_id`),
  ADD KEY `crime_id` (`crime_id`);

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`crime_id`),
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `crime_charge`
--
ALTER TABLE `crime_charge`
  ADD PRIMARY KEY (`charge_id`),
  ADD KEY `crime_id` (`crime_id`),
  ADD KEY `crime_code` (`crime_code`);

--
-- Indexes for table `crime_code`
--
ALTER TABLE `crime_code`
  ADD PRIMARY KEY (`crime_code`),
  ADD UNIQUE KEY `code_desc` (`code_desc`);

--
-- Indexes for table `crime_officers`
--
ALTER TABLE `crime_officers`
  ADD PRIMARY KEY (`crime_id`),
  ADD KEY `officer_id` (`officer_id`);

--
-- Indexes for table `criminals`
--
ALTER TABLE `criminals`
  ADD PRIMARY KEY (`criminal_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`),
  ADD UNIQUE KEY `badge` (`badge`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prob_officer`
--
ALTER TABLE `prob_officer`
  ADD PRIMARY KEY (`prob_id`);

--
-- Indexes for table `sentences`
--
ALTER TABLE `sentences`
  ADD PRIMARY KEY (`sentencing_id`),
  ADD KEY `criminal_id` (`criminal_id`),
  ADD KEY `prob_id` (`prob_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `officer_id` (`officer_id`),
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alias`
--
ALTER TABLE `alias`
  ADD CONSTRAINT `alias_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`criminal_id`);

--
-- Constraints for table `appeal`
--
ALTER TABLE `appeal`
  ADD CONSTRAINT `appeal_ibfk_1` FOREIGN KEY (`crime_id`) REFERENCES `crime` (`crime_id`);

--
-- Constraints for table `crime`
--
ALTER TABLE `crime`
  ADD CONSTRAINT `crime_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`criminal_id`);

--
-- Constraints for table `crime_charge`
--
ALTER TABLE `crime_charge`
  ADD CONSTRAINT `crime_charge_ibfk_1` FOREIGN KEY (`crime_id`) REFERENCES `crime` (`crime_id`),
  ADD CONSTRAINT `crime_charge_ibfk_2` FOREIGN KEY (`crime_code`) REFERENCES `crime_code` (`crime_code`);

--
-- Constraints for table `crime_officers`
--
ALTER TABLE `crime_officers`
  ADD CONSTRAINT `crime_officers_ibfk_1` FOREIGN KEY (`crime_id`) REFERENCES `crime` (`crime_id`),
  ADD CONSTRAINT `crime_officers_ibfk_2` FOREIGN KEY (`officer_id`) REFERENCES `officer` (`officer_id`);

--
-- Constraints for table `officer`
--
ALTER TABLE `officer`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sentences`
--
ALTER TABLE `sentences`
  ADD CONSTRAINT `sentences_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`criminal_id`),
  ADD CONSTRAINT `sentences_ibfk_2` FOREIGN KEY (`prob_id`) REFERENCES `prob_officer` (`prob_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `criminal_id` FOREIGN KEY (`criminal_id`) REFERENCES `criminals` (`criminal_id`),
  ADD CONSTRAINT `officer_id` FOREIGN KEY (`officer_id`) REFERENCES `officer` (`officer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
