-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2025 at 02:37 PM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `small_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ccategory`
--

CREATE TABLE `ccategory` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `category` varchar(100) NOT NULL COMMENT 'Course Category',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ccategory`
--

INSERT INTO `ccategory` (`id`, `category`, `user`, `doe`) VALUES
(0, 'hello', 'Admin', '2025-02-11 16:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `course_name` varchar(100) NOT NULL COMMENT 'Course name',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `user`, `doe`) VALUES
(0, 'Hi', 'Admin', '2025-02-11 19:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `phone` varchar(10) NOT NULL COMMENT 'Phone no ',
  `sname` varchar(100) NOT NULL COMMENT 'Staff name',
  `address` text NOT NULL COMMENT 'address',
  `gender` varchar(6) NOT NULL COMMENT 'gender ',
  `email` text NOT NULL COMMENT 'email',
  `role` varchar(50) NOT NULL COMMENT 'role',
  `location` varchar(50) NOT NULL COMMENT 'location',
  `quali` varchar(50) NOT NULL COMMENT 'qualification',
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `phone`, `sname`, `address`, `gender`, `email`, `role`, `location`, `quali`, `user`, `doe`) VALUES
(10, '8258903821', 'TB', 'Agt', 'Male', 'tb@gmail.com', 'Admin', 'Agartala', 'B.Tech', 'Admin', '2025-02-11 15:49:11');

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `login_data` AFTER INSERT ON `employee` FOR EACH ROW BEGIN
INSERT INTO login (name, user, type) VALUES (NEW.sname, NEW.email, NEW.role);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL COMMENT 'Auto Increment',
  `location` varchar(100) NOT NULL COMMENT 'Location Entry',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of Entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`, `user`, `doe`) VALUES
(2, 'Agartala', 'Admin', '2025-02-11 14:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(100) NOT NULL COMMENT 'User name',
  `pass` varchar(100) NOT NULL COMMENT 'Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`) VALUES
('tb@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL COMMENT 'Autoincrement id',
  `course_name` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL COMMENT 'Father name',
  `c_fees` varchar(100) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `app_date` date NOT NULL,
  `dob` date NOT NULL COMMENT 'date of birth',
  `gender` varchar(6) NOT NULL COMMENT 'gender',
  `s_ph` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL COMMENT 'image file ',
  `pay` varchar(50) NOT NULL,
  `pay_ss` varchar(100) NOT NULL COMMENT 'Pay receipt',
  `user` varchar(100) NOT NULL DEFAULT 'Individual',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `course_name`, `sname`, `fname`, `c_fees`, `regno`, `app_date`, `dob`, `gender`, `s_ph`, `img`, `pay`, `pay_ss`, `user`, `doe`) VALUES
(13, '\r\n                                    Hi\r\n                                ', 'fytf', 'jhgfytvf', '1000', 'REG-1739470128796-9836', '2025-02-13', '2002-10-25', 'Male', '5454545454', '5454545454_1739470155.png', 'Online', '5454545454_1739470155.png', 'Individual', '2025-02-13 18:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `role` varchar(100) NOT NULL COMMENT 'role name',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `user`, `doe`) VALUES
(2, 'Admin', 'Admin', '2025-02-11 14:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `days` varchar(100) NOT NULL,
  `sloat` varchar(100) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `bno` int(10) NOT NULL COMMENT 'Batch No',
  `sdate` date NOT NULL,
  `tdate` date NOT NULL,
  `teacher` varchar(100) NOT NULL COMMENT 'Teacher name',
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`id`, `days`, `sloat`, `tname`, `bno`, `sdate`, `tdate`, `teacher`, `user`, `doe`) VALUES
(3, 'Tuesday', '7:00 AM to 8:30 AM', 'Web Application Development', 1, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:19:20'),
(4, 'Thursday', '7:00 AM to 8:30 AM', 'Web Application Development', 1, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:37:51'),
(5, 'Saturday', '7:00 AM to 8:30 AM', 'Web Application Development', 1, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:39:47'),
(6, 'Tuesday', '6:30 PM to 8:00 PM', 'Web Application Development', 2, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:41:03'),
(9, 'Thursday', '6:30 PM to 8:00 PM', 'Web Application Development', 2, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:42:09'),
(10, 'Saturday', '6:30 PM to 8:00 PM', 'Web Application Development', 2, '2024-04-01', '2024-09-30', 'Dibakar saha', 'Admin', '2024-04-30 10:42:24'),
(11, 'Friday', '6:30 PM to 8:00 PM', 'PHP & Mysql', 1, '2024-03-01', '2024-05-31', 'Dibakar saha', 'Admin', '2024-04-30 10:42:57'),
(12, 'Saturday', '4:00 PM to 5:30  PM', 'PHP & Mysql', 1, '2024-03-01', '2024-05-31', 'Dibakar saha', 'Admin', '2024-04-30 10:43:12'),
(13, 'Tuesday', '8:00 PM to :9:30  PM', 'Mobile App Development Using Flutter', 1, '2024-01-01', '2024-06-30', 'Dibakar saha', 'Admin', '2024-04-30 10:43:33'),
(14, 'Thursday', '8:00 PM to :9:30  PM', 'Mobile App Development Using Flutter', 1, '2024-01-01', '2024-06-30', 'Dibakar saha', 'Admin', '2024-04-30 10:43:57'),
(15, 'Saturday', '8:00 PM to :9:30  PM', 'Mobile App Development Using Flutter', 1, '2024-01-01', '2024-06-30', 'Dibakar saha', 'Admin', '2024-04-30 10:44:20'),
(16, 'Sunday', '9:00 AM to 10:30  AM', 'PHP & Mysql', 1, '2024-03-01', '2024-05-31', 'Dibakar saha', 'Admin', '2024-05-02 07:17:44'),
(17, 'Monday', '6:30 PM to 8:00 PM', 'Mobile App Development Using Flutter', 1, '2024-01-01', '2024-06-30', 'Dibakar saha', 'Admin', '2024-05-02 07:21:48'),
(18, 'Sunday', '11:00 AM to 12:30 PM', 'Mobile App Development Using Flutter', 1, '2024-01-01', '2024-06-30', 'Dibakar saha', 'Admin', '2024-05-04 06:30:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto Increment', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
