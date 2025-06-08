-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `tname` varchar(100) NOT NULL COMMENT 'Training name',
  `bno` varchar(100) NOT NULL COMMENT 'Batch no',
  `teacher` varchar(100) NOT NULL COMMENT 'Teacher name',
  `file` varchar(100) NOT NULL COMMENT 'File name',
  `user` varchar(100) NOT NULL COMMENT 'User name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `tname`, `bno`, `teacher`, `file`, `user`, `doe`) VALUES
(3, 'PHP & Mysql', '2', 'sani shil', '10-03-24(HMS-Update).docx', 'Admin', '2024-05-23 06:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_mark`
--

CREATE TABLE `assignment_mark` (
  `id` int(11) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `bno` varchar(100) NOT NULL,
  `mark` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_mark`
--

INSERT INTO `assignment_mark` (`id`, `cname`, `tname`, `regno`, `bno`, `mark`, `user`, `doe`) VALUES
(25, 'Sukriti Bhowmik', 'PHP & Mysql', 'Php0001', '2', '', '', '2024-05-26 18:37:03'),
(26, '', '', '', '', '47', 'teacher', '2024-05-26 18:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `category` varchar(100) NOT NULL COMMENT 'Category',
  `tname` varchar(100) NOT NULL COMMENT 'Training name',
  `bno` int(10) NOT NULL COMMENT 'Batch no',
  `trname` varchar(100) NOT NULL COMMENT 'Trainee name',
  `sdate` date NOT NULL COMMENT 'Start date',
  `edate` date NOT NULL COMMENT 'End Date',
  `venue` varchar(100) NOT NULL COMMENT 'Venue name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `category`, `tname`, `bno`, `trname`, `sdate`, `edate`, `venue`, `user`, `doe`) VALUES
(9, 'Training', 'Web Application Development', 1, 'Dibakar saha', '2024-04-01', '2024-09-30', 'Radhanagar,Head Office', 'Admin', '2024-04-29 10:32:01'),
(10, 'Training', 'Web Application Development', 2, 'Dibakar saha', '2024-04-01', '2024-09-30', 'Radhanagar,Head Office', 'Admin', '2024-04-29 10:32:58'),
(11, 'Training', 'Mobile App Development Using Flutter', 1, 'Dibakar saha', '2024-01-01', '2024-06-30', 'Radhanagar,Head Office', 'Admin', '2024-04-29 10:33:34'),
(12, 'Training', 'PHP & Mysql', 1, 'Dibakar saha', '2024-03-01', '2024-05-31', 'Radhanagar,Head Office', 'Admin', '2024-04-29 10:34:20'),
(14, 'Tuition', 'B.Tech(2nd Year)', 1, 'Dibakar saha', '2024-01-01', '2024-06-30', 'Radhanagar,Head Office', 'Admin', '2024-04-30 10:47:14'),
(15, 'Tuition', 'Diploma', 1, 'Dibakar saha', '2024-01-01', '2024-06-30', 'Radhanagar,Head Office', 'Admin', '2024-04-30 10:47:42'),
(18, 'Training', 'Computer Typing', 1, 'Dibakar saha', '2024-05-17', '2024-05-26', 'Agartala', 'Admin', '2024-05-17 16:57:05'),
(19, 'Training', 'Basic Data Structure', 1, 'tb', '2024-05-18', '2024-06-19', 'agartala', 'Admin', '2024-05-17 16:59:08'),
(20, 'Training', 'PHP & Mysql', 2, 'sani shil', '2024-05-17', '2024-05-17', 'Agartala', 'Admin', '2024-05-17 17:26:58'),
(21, 'Training', 'Basic Database ', 1, 'tb', '2024-05-23', '2024-10-23', 'AGT', 'Admin', '2024-05-23 12:31:09'),
(22, 'Training', 'Web Designing', 1, 'Dibakar saha', '2024-05-23', '2024-09-23', 'Bishalgarh', 'Admin', '2024-05-23 13:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `bname` varchar(100) NOT NULL COMMENT 'Branch name',
  `location` varchar(100) NOT NULL COMMENT 'Location ',
  `ph` varchar(10) NOT NULL COMMENT 'Phone no',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `cordinator` varchar(100) NOT NULL COMMENT 'Coordinator name',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `bname`, `location`, `ph`, `email`, `cordinator`, `user`, `doe`) VALUES
(1, 'Radhanagar Branch', 'Agartala', '7005261744', 'diba3saha@gmail.com', 'Dibakar saha', 'Admin', '2024-04-24 11:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `Days` varchar(100) NOT NULL COMMENT 'Days',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `Days`, `user`, `doe`) VALUES
(6, 'Friday', 'Admin', '2024-04-29 10:58:49'),
(2, 'Monday', 'Admin', '2024-04-29 10:58:49'),
(7, 'Saturday', 'Admin', '2024-04-29 10:58:49'),
(1, 'Sunday', 'Admin', '2024-04-29 10:57:28'),
(5, 'Thursday', 'Admin', '2024-04-29 10:58:49'),
(3, 'Tuesday', 'Admin', '2024-04-29 10:58:49'),
(4, 'Wednesday', 'Admin', '2024-04-29 10:58:49');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `phone`, `sname`, `address`, `gender`, `email`, `role`, `location`, `quali`, `user`, `doe`) VALUES
(3, '7005261744', 'Dibakar saha', 'Agartala', 'Male', 'diba3saha@gmail.com', '\n                                    Admin\n       ', 'Radhanagar', 'Masters', 'Admin', '2024-04-29 10:15:29'),
(7, '7085584347', 'sani shil', 'sabroom', 'Male', 'sanishil.cse@gmail.com', '\n                                    teacher\n     ', 'Agartala', 'Mtech', 'Admin', '2024-05-17 17:24:28'),
(4, '8258903821', 'tb', 'SurobindhExpressCour\nHGB Road\nMelarmath', 'Male', 'sdfdsfdfddf', '\n                                    Admin\n       ', 'AGT', 'b.tech', 'Admin', '2024-05-04 06:30:57');

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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(100) NOT NULL COMMENT 'User name',
  `pass` varchar(100) NOT NULL COMMENT 'Password',
  `type` varchar(100) NOT NULL COMMENT 'Type of user',
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`, `type`, `name`) VALUES
('abc', '1234', 'teacher', 'sani shil');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `tname` varchar(100) NOT NULL COMMENT 'Training name',
  `bno` int(10) NOT NULL COMMENT 'Batch No',
  `topic` text NOT NULL COMMENT 'Topic',
  `file` text NOT NULL COMMENT 'File name',
  `user` varchar(100) NOT NULL COMMENT 'User ',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `tname`, `bno`, `topic`, `file`, `user`, `doe`) VALUES
(26, 'B.Tech(2nd Year)', 1, 'HMS', '10-03-24(HMS-Update).pdf', 'Admin', '2024-05-20 19:45:28'),
(27, 'B.Tech(2nd Year)', 1, 'Introduction', '10-03-24(HMS-Update).docx', 'Admin', '2024-05-20 19:52:00'),
(28, 'PHP & Mysql', 2, 'HMS', '10-03-24(HMS-Update).pdf', 'Admin', '2024-05-23 05:55:12'),
(29, 'PHP & Mysql', 2, 'https://meet.google.com/xue-kmkn-nvz', '', 'Admin', '2024-05-23 05:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `tname` varchar(100) NOT NULL COMMENT 'Training Name',
  `question` text NOT NULL COMMENT 'Question ',
  `option1` text NOT NULL COMMENT 'Option A',
  `option2` text NOT NULL COMMENT 'Option B',
  `option3` text NOT NULL COMMENT 'Option C',
  `option4` text NOT NULL COMMENT 'Option D',
  `answer` varchar(100) NOT NULL COMMENT 'answer',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`id`, `tname`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `user`, `doe`) VALUES
(10, 'Basic C', 'How many keywords are there in the C', '32', '30', '33', '31', '32', 'Admin', '2024-05-16 05:07:12'),
(11, 'Basic C', 'What is #include<stdio.h>', 'it used to print the line', 'function', 'it includes the standard input-output header file', 'None of these', 'it includes the standard input-output header file', 'Admin', '2024-05-16 07:15:14'),
(13, 'Basic C', 'What is the father of C language?', 'Steve Jobs', 'Dennis Ritchie', 'Rasmus Lerdorf', 'Mark Zuckerberg', 'Dennis Ritchie', 'Admin', '2024-05-16 17:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL COMMENT 'Autoincrement id',
  `fy` varchar(20) NOT NULL COMMENT 'Financial Year',
  `regno` varchar(100) DEFAULT NULL COMMENT 'Registration no ',
  `bno` int(10) DEFAULT NULL,
  `dor` date DEFAULT NULL COMMENT 'Date of registration',
  `tname` varchar(100) NOT NULL COMMENT 'Training name',
  `duration` varchar(50) NOT NULL COMMENT 'Duration ',
  `fees` varchar(100) NOT NULL COMMENT 'Fees',
  `iname` varchar(100) NOT NULL COMMENT 'Institute name',
  `dept` varchar(100) NOT NULL COMMENT 'Department Name',
  `year` varchar(10) NOT NULL COMMENT 'year',
  `cname` varchar(100) NOT NULL COMMENT 'Candidate name',
  `fname` varchar(100) NOT NULL COMMENT 'Father name',
  `mname` varchar(100) NOT NULL COMMENT 'Mother name',
  `dob` date NOT NULL COMMENT 'date of birth',
  `gender` varchar(6) NOT NULL COMMENT 'gender',
  `ph` varchar(10) NOT NULL COMMENT 'Phone no',
  `wph` varchar(10) NOT NULL COMMENT 'Whatsapp no',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `tmode` varchar(100) NOT NULL COMMENT 'Training mode',
  `address` text NOT NULL COMMENT 'Address',
  `aadhaar_img` varchar(100) NOT NULL COMMENT 'Aadhaar image ',
  `admit_img` varchar(100) NOT NULL COMMENT 'Admit image',
  `marksheet_img` varchar(100) NOT NULL COMMENT 'Marksheet image ',
  `img` varchar(100) NOT NULL COMMENT 'image file ',
  `sig` varchar(100) NOT NULL COMMENT 'Signature',
  `paymode` varchar(100) NOT NULL COMMENT 'Payment mode',
  `receipt` varchar(100) NOT NULL COMMENT 'Pay receipt',
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `user` varchar(100) NOT NULL DEFAULT 'Individual',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fy`, `regno`, `bno`, `dor`, `tname`, `duration`, `fees`, `iname`, `dept`, `year`, `cname`, `fname`, `mname`, `dob`, `gender`, `ph`, `wph`, `email`, `tmode`, `address`, `aadhaar_img`, `admit_img`, `marksheet_img`, `img`, `sig`, `paymode`, `receipt`, `status`, `user`, `doe`) VALUES
(4, '24-25', '', NULL, NULL, 'WAD', '6 month', '1500.00 Per Month', 'TIT', 'Computer Science', '2', 'Chayan Bhadra', 'partha bhadra', 'susmita bhadra', '2004-05-02', 'Male', '8415858506', '8415858506', 'chayanbhadra1@gmail.com', 'Offline', 'Udaipur', '8415858506_WAD.jpeg', '8415858506_WAD.jpeg', '8415858506_WAD.jpeg', '8415858506_WAD.png', '8415858506_WAD.png', 'Online', '8415858506_WAD.jpeg', 'Pending', 'Individual', '2024-04-30 10:59:22'),
(5, '24-25', 'Php0001', 2, NULL, 'Php', '6 month', '1500.00 Per month', 'Gomati District Polytechnic ', 'Computer science and technology ', '2', 'Sukriti Bhowmik', 'Sukanta bhowmik ', 'Atasi Bhowmik ', '2004-12-21', 'Male', '6009935839', '6009935839', 'sukritibhowmik978@gmail.com', 'Offline', '15/16, Chittaranjan road, p.o Radhakishore pur, Gomati district, Tripura\r\nBata Gally', '6009935839_PMR.jpg', '6009935839_PMR.jpg', '6009935839_PMR.', '6009935839_PMR.jpg', '6009935839_PMR.jpg', 'Online', '6009935839_PMR.jpg', 'Pending', 'Individual', '2024-05-26 06:26:15'),
(7, '24-25', 'MDF0001', 1, NULL, 'MDF', '6 Month', '2000.00 Per Month', 'Icfai', 'Computer science', 'F', 'Mrinmoy Biswas', 'L.t rajsekhar Biswas', 'Indira Biswas Banik', '1999-09-09', 'Male', '9612660871', '9612660871', 'mrinmoybiswas1999@gmail.com', 'Online', 'Math Chowmuhani, Agartala, Tripura ', '9612660871_MDF.jpg', '9612660871_MDF.', '9612660871_MDF.', '9612660871_MDF.jpg', '9612660871_MDF.jpg', 'Online', '9612660871_MDF.jpg', 'Pending', 'Individual', '2024-04-30 12:16:16'),
(8, '24-25', NULL, NULL, NULL, 'WAD', '6 month', '1500.00 Per Month', 'NATIONAL INSTITUTE OF TECHNOLOGY AGARTALA ', 'Department of Mathematics ', '2', 'SUKANTA SARKAR', 'RATAN SARKAR', 'MIRA SARKAR', '2002-12-24', 'Male', '9863019103', '9089139674', 'sukantasarkar2412@gmail.com', 'Offline', 'Ballabhpur,Amtali, West Tripura ', '9863019103_WAD.pdf', '9863019103_WAD.pdf', '9863019103_WAD.pdf', '9863019103_WAD.jpg', '9863019103_WAD.pdf', 'Online', '9863019103_WAD.jpg', 'Pending', 'Individual', '2024-04-13 16:42:11'),
(9, '24-25', NULL, NULL, NULL, 'Php', '6 month', '1500.00 Per month', 'Gomati District Polytechnic', 'Computer Science & Technology', '2', 'Rajdip Das', 'Samar Das', 'rakhi Sarkar Das', '2005-10-20', 'Male', '9862789044', '9862789044', 'rajdipdas201005@gmail.com', 'Offline', 'South Badharghat,Chowrangee Para', '9862789044_PMR.jpg', '9862789044_PMR.jpg', '9862789044_PMR.jpg', '9862789044_PMR.jpg', '9862789044_PMR.jpg', 'Online', '9862789044_PMR.jpg', 'Pending', 'Individual', '2024-04-26 09:15:37'),
(11, '24-25', NULL, NULL, NULL, 'WAD', '6 month', '1500.00 Per Month', 'NATIONAL INSTITUTE OF ELETRONICS & INFORMATION TECHNOLOGY', 'BCA', '2', 'ANKUR DHAR', 'AJOY CHANDRA DHAR', 'DROPADI GUPTA DHAR', '2003-10-26', 'Male', '9863407453', '9863407453', 'DHARANKUR906@GMAIL.COM', 'Offline', 'BARJALA AGARTALA WEST TRIPURA AIRPORT ROAD', '9863407453_WAD.jpeg', '9863407453_WAD.', '9863407453_WAD.', '9863407453_WAD.jpeg', '9863407453_WAD.jpeg', 'Online', '9863407453_WAD.jpeg', 'Pending', 'Individual', '2024-04-23 15:15:06'),
(12, '24-25', 'MDF0001', 1, NULL, 'MDF', '6 Month', '2000.00 Per Month', 'Techno College of Engineering Agartala', 'Computer Science and Engineering', '2', 'sani shil', 'samiran shil', 'purnima shil', '2003-12-25', 'Male', '7085584347', '7085584347', 'sanishil.cse@gmail.com', 'Online', 'Rupaichari Sabroom South Tripura', '7085584347_MDF.pdf', '7085584347_MDF.', '7085584347_MDF.', '7085584347_MDF.jpg', '7085584347_MDF.jpg', 'Online', '7085584347_MDF.jpg', 'Pending', 'Individual', '2024-04-30 12:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `role` varchar(100) NOT NULL COMMENT 'role name',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `user`, `doe`) VALUES
(1, 'Admin', 'Admin', '2024-04-24 11:27:34'),
(3, 'Receptionist', 'Admin', '2024-04-24 11:28:12'),
(5, 'teacher', 'Admin', '2024-05-17 17:22:35'),
(2, 'Trainer', 'Admin', '2024-04-24 11:27:55');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `sloat` varchar(100) NOT NULL COMMENT 'Class Sloat',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`id`, `sloat`, `user`, `doe`) VALUES
(1, '7:00 AM to 8:30 AM', 'Admin', '2024-04-30 06:32:13'),
(2, '9:00 AM to 10:30  AM', 'Admin', '2024-04-30 06:32:26'),
(3, '11:00 AM to 12:30 PM', 'Admin', '2024-04-29 10:54:28'),
(4, '4:00 PM to 5:30  PM', 'Admin', '2024-04-29 10:54:28'),
(5, '6:30 PM to 8:00 PM', 'Admin', '2024-04-30 10:40:46'),
(6, '8:00 PM to :9:30  PM', 'Admin', '2024-04-29 10:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `category` varchar(100) NOT NULL COMMENT 'Training category',
  `tname` varchar(100) NOT NULL COMMENT 'Training name',
  `sform` varchar(20) NOT NULL COMMENT 'Short form',
  `duration` varchar(20) NOT NULL COMMENT 'Duration',
  `fees` float(20,2) NOT NULL COMMENT 'Training fees',
  `unit` varchar(100) NOT NULL COMMENT 'Unit',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `category`, `tname`, `sform`, `duration`, `fees`, `unit`, `user`, `doe`) VALUES
(19, 'LKG', 'ABC', 'A', '2 WEEKS', 1000.00, 'N/A', 'Admin', '2024-07-12 07:29:40'),
(2, 'Training', 'Advance Python with numpy & Pandas', 'APP', '6 Month', 1500.00, 'Per Month', 'Admin', '0000-00-00 00:00:00'),
(16, 'Tuition', 'B.Tech(2nd Year)', 'btech', '6 Month', 1500.00, 'Per Month', 'Admin', '2024-04-30 10:46:15'),
(7, 'Training', 'Basic C', 'CPR', '2 Month', 1500.00, 'Per Month', 'Admin', '0000-00-00 00:00:00'),
(4, 'Training', 'Basic Data Structure', 'BDS', '2 Month', 1500.00, 'Per Month', 'Admin', '0000-00-00 00:00:00'),
(3, 'Training', 'Basic Database ', 'BDB', '2 Month', 1500.00, 'Per Month', 'admin', '0000-00-00 00:00:00'),
(5, 'Training', 'Basic Office Automation', 'BOA', '3 Month', 1200.00, 'Registration fees, 500/ Month', 'Admin', '0000-00-00 00:00:00'),
(6, 'Training', 'Basic Python', 'BPP', '2 Month', 1500.00, 'Per Month', 'Admin', '0000-00-00 00:00:00'),
(8, 'Training', 'Computer Typing', 'CTS', '3 Month', 1200.00, 'Registration Fees, 500/Month', 'Admin', '0000-00-00 00:00:00'),
(17, 'Tuition', 'Diploma', 'dip', '6 Month', 1500.00, 'Per Month', 'Admin', '2024-04-30 10:46:27'),
(9, 'Training', 'Diploma in Computer Application', 'DCA', '1 Year', 1000.00, 'Registration Fees, 500/Month', 'Admin', '0000-00-00 00:00:00'),
(10, 'Training', 'Diploma in Computer Operation', 'DCO', '6 Month', 1200.00, 'Registration fees, 500/ Month', 'Admin', '0000-00-00 00:00:00'),
(11, 'Training', 'Mobile App Development Using Flutter', 'MDF', '6 Month', 2000.00, 'Per Month', 'Admin', '0000-00-00 00:00:00'),
(1, 'Training', 'PHP & Mysql', 'php', '6 Month', 1500.00, 'Per Month', 'Admin', '2024-04-25 12:47:39'),
(13, 'Training', 'Software Engineering', 'SWE', '2 Month', 1500.00, 'Per Month', 'admin', '0000-00-00 00:00:00'),
(14, 'Training', 'Web Application Development', 'WAD', '6 month', 2000.00, 'Per Month', 'admin', '0000-00-00 00:00:00'),
(15, 'Training', 'Web Designing', 'WDS', '3 Month', 1500.00, 'Per Month', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `training_category`
--

CREATE TABLE `training_category` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `catagory` varchar(100) NOT NULL COMMENT 'training category',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_category`
--

INSERT INTO `training_category` (`id`, `catagory`, `user`, `doe`) VALUES
(2, 'Awareness Workshop', 'Admin', '2024-04-26 05:16:20'),
(6, 'LKG', 'Admin', '2024-07-12 07:29:06'),
(3, 'Training', 'Admin', '2024-04-26 05:16:40'),
(1, 'Tuition', 'Admin', '2024-04-26 05:15:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_mark`
--
ALTER TABLE `assignment_mark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`bname`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `ph` (`ph`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`Days`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question` (`question`) USING HASH;

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
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sloat` (`sloat`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`tname`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `training_category`
--
ALTER TABLE `training_category`
  ADD PRIMARY KEY (`catagory`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignment_mark`
--
ALTER TABLE `assignment_mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question_bank`
--
ALTER TABLE `question_bank`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `training_category`
--
ALTER TABLE `training_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
