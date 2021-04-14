-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2019 at 05:39 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bug_hound`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `type` varchar(32) NOT NULL,
  `location` varchar(100) NOT NULL,
  `problem_report_id` int(11) NOT NULL,
  `attachment_report_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`type`, `location`, `problem_report_id`, `attachment_report_id`) VALUES
('5', '../Bughound/attachments/8/To_Do.txt', 8, 6),
('5', '../Bughound/attachments/10/To_Do.txt', 10, 7),
('5', '../Bughound/attachments/11/To_Do.txt', 11, 8),
('2', '../Bughound/attachments/12/545-p2-Calc-Net.pdf', 12, 9),
('5', '../Bughound/attachments/12/Test.txt', 12, 11);

-- --------------------------------------------------------

--
-- Table structure for table `attachment_type`
--

CREATE TABLE `attachment_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attachment_type`
--

INSERT INTO `attachment_type` (`id`, `type`) VALUES
(1, 'Printouts'),
(2, 'Memory Dumps'),
(3, 'Images'),
(4, 'Memos'),
(5, 'Text Files');

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `problem_report_num` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `report_type` int(11) NOT NULL,
  `severity` int(11) NOT NULL,
  `problem_summary` varchar(100) NOT NULL,
  `reproduceable` tinyint(1) NOT NULL,
  `problem` text NOT NULL,
  `suggested_fix` text NOT NULL,
  `reported_by` int(11) NOT NULL,
  `report_date` date NOT NULL,
  `area` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `priority` int(11) NOT NULL,
  `resolution` int(11) NOT NULL,
  `resolution_version` float NOT NULL,
  `resolved_by` int(11) NOT NULL,
  `resolved_date` date NOT NULL,
  `tested_by` int(11) NOT NULL,
  `tested_date` date NOT NULL,
  `deferred` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`problem_report_num`, `program`, `report_type`, `severity`, `problem_summary`, `reproduceable`, `problem`, `suggested_fix`, `reported_by`, `report_date`, `area`, `assigned_to`, `comments`, `status`, `priority`, `resolution`, `resolution_version`, `resolved_by`, `resolved_date`, `tested_by`, `tested_date`, `deferred`) VALUES
(1, 3, 4, 3, 'All COBOL programmers are old', 1, 'All our COBOL programmers are old and dying out so fast we canâ€™t find replacements', 'Hire young COBOL programmers', 4, '2019-03-18', 0, 7, '', '1', 2, 2, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(2, 1, 2, 1, 'IDE File->Print defaults to PDF ', 1, 'IDE File->Print defaults to PDF â€“ should be blank initially', '', 8, '2019-03-18', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(3, 7, 2, 2, 'Formulator missing capital Greek Sigma', 1, 'Formulator missing capital Greek Sigma', '', 5, '2019-03-18', 0, 0, '', '2', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(4, 6, 3, 1, 'IDE should have a toolbar for compiling, linking, running', 1, 'IDE should have a toolbar for compiling, linking, running', '', 6, '2019-03-18', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(5, 5, 1, 2, 'IDE Help->Editor goes to empty page', 1, 'IDE Help->Editor goes to empty page', '', 4, '2019-03-18', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(6, 2, 1, 2, '\"add areas page\" has no means to Cancel or quit after adding', 0, '\"add areas page\" has no means to Cancel or quit after adding', '', 4, '2019-03-18', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(7, 2, 1, 3, 'Bug Report Test', 0, 'This is a Test to edit Bug Details', '', 5, '2019-03-20', 0, 0, '', '2', 1, 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(8, 6, 3, 1, 'Testing the Attachment', 1, 'Attaching a text file called To_Do', '', 2, '2019-03-19', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(9, 4, 1, 1, 'Test Edit', 0, 'Test Edit', '', 1, '2019-03-19', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(10, 2, 3, 1, 'a', 0, 'a', 'aaaa', 1, '2019-03-19', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(11, 7, 1, 1, 'Attach', 0, 'Attach', '', 1, '2019-03-19', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0),
(12, 5, 1, 2, 'Att', 1, 'Att', '', 6, '2019-03-19', 0, 0, '', '1', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `UName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UserLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `Name`, `UName`, `Password`, `UserLevel`) VALUES
(1, 'Pip', 'pip', 'a', 3),
(2, 'Brutus', 'Brutus', 'b', 1),
(3, 'Bob', 'smithbob', 'a', 3),
(4, 'Sue', 'jonessue', 'a', 2),
(5, 'Habib', 'smithhabib', 'test', 2),
(6, 'Yoshi', 'jonesyoshi', '1', 1),
(7, 'Francois', 'smithfrancois', '123', 2),
(8, 'Becky', 'jonesbecky', '12345', 1),
(9, 'Felix', 'smithfelix', '12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `functional_area`
--

CREATE TABLE `functional_area` (
  `name` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functional_area`
--

INSERT INTO `functional_area` (`name`, `id`, `program_id`) VALUES
('Ada95 Parser', 1, 1),
('Ada95 Lexer', 2, 1),
('Ada95 IDE', 3, 1),
('Logon', 4, 2),
('Start', 5, 2),
('DB Maintenance', 6, 2),
('Search', 7, 2),
('Insert New', 8, 2),
('Search Results', 9, 2),
('Add Edit Areas', 10, 2),
('Add Employees', 11, 2),
('Add Programs', 12, 2),
('View Bugs', 13, 2),
('Lexer', 14, 3),
('Parser', 15, 3),
('Code Generator', 16, 3),
('Linker', 17, 3),
('Lexer', 18, 4),
('Parser', 19, 4),
('Code Generator', 20, 4),
('Linker', 21, 4),
('Lexer', 22, 5),
('Parser', 23, 5),
('Code Generator', 24, 5),
('Linker', 25, 5),
('IDE', 26, 5),
('Lexer', 27, 6),
('Parser', 28, 6),
('Code Generator', 29, 6),
('Linker', 30, 6),
('IDE', 31, 6),
('Editor', 32, 7),
('Spell Checker', 33, 7),
('Dynodraw', 34, 7),
('Formulator', 35, 7);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `description`) VALUES
(1, 'Immediately'),
(2, 'As soon as possible'),
(3, 'Before next milestone'),
(4, 'Before Release'),
(5, 'Fix if possible'),
(6, 'Optional');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `ProgID` int(10) UNSIGNED NOT NULL,
  `ProgName` varchar(100) NOT NULL,
  `Release_build` varchar(32) NOT NULL,
  `Version` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`ProgID`, `ProgName`, `Release_build`, `Version`) VALUES
(1, 'Ada95 Coder', '1', '1'),
(2, 'Bughound', '1', '1'),
(3, 'COBOL Coder', '1', '1'),
(4, 'COBOL Coder', '1', '2'),
(5, 'COBOL Coder', '2', '1'),
(6, 'Pascal Coder', '1', '1'),
(7, 'Word Writer 2011', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `type`) VALUES
(1, 'Coding Error'),
(2, 'Design Issue'),
(3, 'Suggestion'),
(4, 'Documentation'),
(5, 'Hardware'),
(6, 'Query'),
(7, 'ReportTestUpdate');

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `type`) VALUES
(1, 'Pending'),
(2, 'fixed'),
(3, 'Irreproducible'),
(4, 'Deferred'),
(5, 'As designed'),
(6, 'Withdrawn by reporter'),
(7, 'Need more info'),
(8, 'Disagree with suggestion'),
(9, 'Duplicate'),
(10, 'ResolutionTest');

-- --------------------------------------------------------

--
-- Table structure for table `severity`
--

CREATE TABLE `severity` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `severity`
--

INSERT INTO `severity` (`id`, `description`) VALUES
(1, 'Minor'),
(2, 'Serious'),
(3, 'Fatal');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `description`) VALUES
(1, 'Open'),
(2, 'Closed'),
(3, 'Resolved');

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `ULevel` int(11) NOT NULL,
  `UGroup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`ULevel`, `UGroup`) VALUES
(0, 'All Groups'),
(1, 'Level 1'),
(2, 'Level 2'),
(3, 'Level 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attachment_report_id`);

--
-- Indexes for table `attachment_type`
--
ALTER TABLE `attachment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`problem_report_num`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`),
  ADD UNIQUE KEY `UNQ` (`EmpID`),
  ADD UNIQUE KEY `UName` (`UName`);

--
-- Indexes for table `functional_area`
--
ALTER TABLE `functional_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD UNIQUE KEY `UNQ` (`ProgID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `severity`
--
ALTER TABLE `severity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`ULevel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `attachment_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attachment_type`
--
ALTER TABLE `attachment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `problem_report_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `functional_area`
--
ALTER TABLE `functional_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `ProgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `severity`
--
ALTER TABLE `severity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `ULevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
