-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 02:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `patient_id` varchar(200) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `referral_doctor` varchar(200) NOT NULL,
  `patient_name` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `pin` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `whatsapp` varchar(200) NOT NULL,
  `n_id_type` varchar(200) NOT NULL,
  `nid` varchar(200) NOT NULL,
  `marital` varchar(200) NOT NULL,
  `gurdian_name` varchar(200) NOT NULL,
  `relationship` varchar(200) NOT NULL,
  `gurdian_address` varchar(200) NOT NULL,
  `gar_mobile` varchar(11) NOT NULL,
  `department` varchar(200) NOT NULL,
  `department_ward` varchar(200) NOT NULL,
  `bed_type` varchar(200) NOT NULL,
  `bed_no` varchar(200) NOT NULL,
  `tpa` varchar(200) NOT NULL,
  `consult_doctor` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `symptoms_type` varchar(100) NOT NULL,
  `symptoms_title` varchar(100) NOT NULL,
  `symptoms_desc` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `patient_status` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `location`, `patient_id`, `mobile`, `referral_doctor`, `patient_name`, `father_name`, `gender`, `age`, `blood_group`, `address`, `city`, `state`, `pin`, `email`, `whatsapp`, `n_id_type`, `nid`, `marital`, `gurdian_name`, `relationship`, `gurdian_address`, `gar_mobile`, `department`, `department_ward`, `bed_type`, `bed_no`, `tpa`, `consult_doctor`, `description`, `symptoms_type`, `symptoms_title`, `symptoms_desc`, `status`, `patient_status`, `user`, `doe`) VALUES
(27, 'Sabroom', '1362', '7088888888', 'DR. aBCD', 'sagar', 'sujay', 'Male', '23', 'a+', 'Agartala', 'AGTL', 'Tripura', '799101', 'sanishillagt@outlook.com', '7085555464', 'Pan', 'AHABFJAFSS', 'Married', 'ABC', 'Father', 'SBRM', '7894456564', 'MED', '1', 'AC-1', '', 'Cash', 'DR. DIbakar', 'NA', 'Respiratory', 'These symptoms affect the respiratory system', 'NA', '1', 'patient_admit', 'Super Admin', '2024-03-17 05:02:34');

--
-- Triggers `appointment`
--
DELIMITER $$
CREATE TRIGGER `bed_update` AFTER INSERT ON `appointment` FOR EACH ROW BEGIN
 UPDATE bed_entry SET STATUS=1 WHERE bed_no=NEW.bed_no;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bed_entry`
--

CREATE TABLE `bed_entry` (
  `id` int(10) NOT NULL,
  `bed_no` varchar(100) NOT NULL,
  `bed_type` varchar(100) NOT NULL,
  `w_section` varchar(100) NOT NULL,
  `w_no` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bed_entry`
--

INSERT INTO `bed_entry` (`id`, `bed_no`, `bed_type`, `w_section`, `w_no`, `status`, `user`, `doe`) VALUES
(11, '36', 'NON-AC', 'Female', '3', 1, 'Super Admin', '2024-03-11 08:16:45'),
(10, 'BD-02', 'AC-1', 'Male', '1', 1, 'Admin', '2024-03-10 12:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `bed_type`
--

CREATE TABLE `bed_type` (
  `id` int(10) NOT NULL,
  `bed_type` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bed_type`
--

INSERT INTO `bed_type` (`id`, `bed_type`, `user`, `doe`) VALUES
(7, 'AC-1', 'Admin', '2024-03-09 15:47:18'),
(8, 'NON-AC', 'Super Admin', '2024-03-11 08:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `fy` varchar(10) NOT NULL COMMENT 'Financial Year',
  `billno` varchar(100) NOT NULL COMMENT 'Bill no',
  `bdate` date NOT NULL COMMENT 'Bill Date',
  `ph` varchar(10) NOT NULL COMMENT 'Phone no',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `dname` varchar(100) NOT NULL COMMENT 'Doctor Name',
  `paid` float(20,2) NOT NULL COMMENT 'Paid',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `fy`, `billno`, `bdate`, `ph`, `name`, `dname`, `paid`, `user`, `doe`) VALUES
(5, '22-23', 'DAS/22-23/1', '2023-03-06', '7085584347', 'selmon khan', 'DR.REDDY', 1000.00, 'recep', '2023-03-06 11:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` int(10) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_head` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `dept_id`, `dept_name`, `dept_head`, `user`, `doe`) VALUES
(6, 'MED', 'medicine', 'DR.ABC', 'Admin', '2024-03-09 20:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(10) NOT NULL COMMENT 'Doctor Id',
  `regis_no` varchar(10) NOT NULL COMMENT 'Registration No',
  `specialization` varchar(100) NOT NULL COMMENT 'specialiZation',
  `qulification` varchar(100) NOT NULL COMMENT 'Qualification',
  `name` varchar(100) NOT NULL COMMENT 'name',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `mobile` varchar(11) NOT NULL COMMENT 'phone no',
  `doctoraddress` varchar(100) NOT NULL COMMENT 'doctor address',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `regis_no`, `specialization`, `qulification`, `name`, `email`, `mobile`, `doctoraddress`, `user`, `doe`) VALUES
(16, 'D-121', 'ENT', 'MBBS', 'DR. DIbakar', 'dibakar@gmail.com', '5612651651', 'sdadsad', 'Admin', '2024-03-09 15:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`id`, `name`, `description`, `user`, `doe`) VALUES
(14, '1st Floor', 'N/A', 'Admin', '2024-03-09 15:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `lab_master`
--

CREATE TABLE `lab_master` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `prname` varchar(500) NOT NULL COMMENT 'Test name',
  `dept` varchar(100) NOT NULL COMMENT 'Department name',
  `charge` float(20,2) NOT NULL COMMENT 'charges',
  `user` varchar(100) NOT NULL COMMENT 'user to enter',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_master`
--

INSERT INTO `lab_master` (`id`, `prname`, `dept`, `charge`, `user`, `doe`) VALUES
(2, 'KFT', 'PATHOLOGY', 700.00, 'Admin', '2023-05-17 10:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL COMMENT 'Location Name',
  `user` varchar(100) NOT NULL COMMENT 'Entry of User',
  `dob` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_name`, `user`, `dob`) VALUES
(44, 'Sabroom ', '', '2023-01-29 06:31:56'),
(45, 'Agartala, Amtali', '', '2023-01-29 06:31:56'),
(46, 'Udaipur, Tripura', '', '2023-01-29 06:31:56'),
(65, 'Rani Bazar', 'admin', '2023-01-29 13:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `type`, `login_status`) VALUES
(8, '7085584347', '1234', 'NA', 0),
(6, '8787442863', '12345', 'Admin', 0),
(5, 'Super Admin', 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medical_service`
--

CREATE TABLE `medical_service` (
  `id` int(10) NOT NULL,
  `m_type` varchar(200) NOT NULL,
  `charge` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nation_id`
--

CREATE TABLE `nation_id` (
  `id` int(10) NOT NULL,
  `n_id_type` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nation_id`
--

INSERT INTO `nation_id` (`id`, `n_id_type`, `user`, `doe`) VALUES
(9, 'Pan', 'Super Admin', '2024-03-11 13:22:08'),
(10, 'Voter ID', 'Super Admin', '2024-03-11 13:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id` int(10) NOT NULL,
  `menue` varchar(100) NOT NULL,
  `submenu` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `menue`, `submenu`, `url`, `user`, `doe`) VALUES
(24, 'Master Entry', 'Role Section', 'role_entry.php', 'Super Admin', '2024-02-27 12:27:24'),
(26, 'Master Entry', 'Symptoms Section', 'symptoms_entry.php', 'Super Admin', '2024-02-27 15:04:00'),
(27, 'Master Entry', 'Role Section', 'role_entry.php', 'Super Admin', '2024-02-27 15:22:35'),
(28, 'Master Entry', 'Department Section', 'department_entry.php', 'Super Admin', '2024-02-27 15:23:06'),
(30, 'Master Entry', 'Doctor Section', 'doctor_entry.php', 'Super Admin', '2024-02-27 15:33:49'),
(31, 'Master Entry', 'TPA Section', 'tpa_entry.php', 'Super Admin', '2024-02-27 15:35:11'),
(32, 'Bed Section', 'Bed Entry', 'bed_entry.php', 'Super Admin', '2024-02-27 15:35:48'),
(33, 'Bed Section', 'Bed Group', 'bed_group.php', 'Super Admin', '2024-02-27 15:36:28'),
(34, 'Bed Section', 'Bed Type', 'bed_type.php', 'Super Admin', '2024-02-27 15:37:05'),
(35, 'Master Entry', 'Floor Section', 'floor_section.php', 'Super Admin', '2024-02-27 15:38:06'),
(36, 'Master Entry', 'Ward Section', 'ward_section.php', 'Super Admin', '2024-02-27 15:38:39'),
(37, 'Patient', 'General Registration', 'patient_registration.php', 'Super Admin', '2024-03-10 18:31:42'),
(38, 'Reception', 'Patient View in Nurse', 'nurse_view_patient.php', 'Super Admin', '2024-03-09 14:16:55'),
(39, 'Patient', 'Patient Admit', 'patient_admit.php', 'Super Admin', '2024-03-10 18:32:24'),
(40, 'Master Entry', 'Location', 'location.php', 'Super Admin', '2024-03-11 08:41:40'),
(41, 'Master Entry', 'National ID', 'n_id_type.php', 'Super Admin', '2024-03-11 08:44:50'),
(42, 'Master Entry', 'Payment Mode', 'payment.php', 'Super Admin', '2024-03-11 08:47:16'),
(43, 'Service Master', 'Medical Service', 'medical_charges.php', 'Super Admin', '2024-03-16 04:18:03'),
(44, 'Service Master', 'Surgical Service', 'surgical_charges.php', 'Super Admin', '2024-03-16 05:11:36'),
(45, 'Service Master', 'Therapy Service', 'therapy_charges.php', 'Super Admin', '2024-03-16 05:30:30');

--
-- Triggers `navigation`
--
DELIMITER $$
CREATE TRIGGER `Insert_permission` AFTER INSERT ON `navigation` FOR EACH ROW BEGIN
    INSERT INTO permission (id,ph,sname,menue,submenue,url,user)
    VALUES (NEW.id,'Super Admin', 'Super Admin',NEW.menue,NEW.submenu,NEW.url,NEW.user);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_navigation` AFTER UPDATE ON `navigation` FOR EACH ROW BEGIN
 update permission set menue=NEW.menue,submenue=NEW.submenu,url=NEW.url where id=NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_section`
--

CREATE TABLE `nurse_section` (
  `id` int(10) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `patient_name` varchar(200) NOT NULL,
  `referral_doctor` varchar(200) NOT NULL,
  `consult_doctor` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `department_ward` varchar(200) NOT NULL,
  `bed_type` varchar(200) NOT NULL,
  `bed_no` varchar(200) NOT NULL,
  `height` varchar(200) NOT NULL,
  `weight` varchar(200) NOT NULL,
  `bp` varchar(200) NOT NULL,
  `pulse` varchar(200) NOT NULL,
  `temp` varchar(200) NOT NULL COMMENT 'Temperature',
  `resp` varchar(200) NOT NULL COMMENT 'Respiration',
  `symptoms_type` varchar(200) NOT NULL,
  `symptoms_title` varchar(200) NOT NULL,
  `symptoms_desc` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL COMMENT 'Doctor''s Note',
  `note` varchar(200) NOT NULL,
  `any_allerg` varchar(200) NOT NULL COMMENT 'Any Known Allergy',
  `prev_med_isu` varchar(200) NOT NULL COMMENT 'Previous Medical Issue',
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nurse_section`
--

INSERT INTO `nurse_section` (`id`, `patient_id`, `patient_name`, `referral_doctor`, `consult_doctor`, `gender`, `age`, `department`, `department_ward`, `bed_type`, `bed_no`, `height`, `weight`, `bp`, `pulse`, `temp`, `resp`, `symptoms_type`, `symptoms_title`, `symptoms_desc`, `description`, `note`, `any_allerg`, `prev_med_isu`, `user`, `doe`) VALUES
(13, '2126', 'akash datta', 'DR.ABC', 'DR. DIbakar', 'Male', '20', 'MED', '1', 'AC-1', '', '168', '65', '120', '90', '34', 'NO', 'Respiratory', 'These symptoms affect the respiratory system', 'hi', 'hi', 'no', 'no', 'no', 'Super Admin', '2024-03-13 09:00:58'),
(14, '2126', 'akash datta', 'DR.ABC', 'DR. DIbakar', 'Male', '20', 'MED', '1', 'AC-1', '', '168', '65', '120', '90', '34', 'NO', 'Respiratory', 'These symptoms affect the respiratory system', 'hi', 'hi', 'no', 'no', 'no', 'Super Admin', '2024-03-13 09:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `location` varchar(200) NOT NULL,
  `patient_type` varchar(200) NOT NULL,
  `patient_id` varchar(200) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `referral_doctor` varchar(200) NOT NULL,
  `patient_name` varchar(200) NOT NULL COMMENT 'Patient Name',
  `father_name` varchar(200) NOT NULL COMMENT 'Father Name',
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `pin` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `whatsapp` varchar(200) NOT NULL,
  `marital` varchar(100) NOT NULL,
  `n_id_type` varchar(200) NOT NULL COMMENT 'national ID Type',
  `nid` varchar(200) NOT NULL COMMENT 'National Id no',
  `status` varchar(100) NOT NULL,
  `user` varchar(200) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `location`, `patient_type`, `patient_id`, `mobile`, `referral_doctor`, `patient_name`, `father_name`, `address`, `city`, `state`, `pin`, `gender`, `age`, `blood_group`, `email`, `whatsapp`, `marital`, `n_id_type`, `nid`, `status`, `user`, `doe`) VALUES
(18, 'Sabroom', 'new', '1362', '7088888888', 'DR. aBCD', 'sagar', 'sujay', 'Agartala', 'AGTL', 'Tripura', '799101', 'Male', '23', 'a+', 'sanishillagt@outlook.com', '7085555464', 'Married', 'Pan', 'AHABFJAFSS', '1', 'Super Admin', '2024-03-17 05:01:11'),
(17, 'Agartala, Amtali', 'new', '1375', '4554555555', 'DR.ABC', 'akash datta', 'bikash datta', 'Sabroom', 'DMR', 'Tripura', '799145', 'Male', '20', 'a-', 'sanishil959@gmail.com', '4654454545', 'Married', 'Pan', 'dffddf', 'pending', 'Super Admin', '2024-03-14 12:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int(10) NOT NULL,
  `payment_name` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `payment_name`, `user`, `doe`) VALUES
(3, 'Cash', 'Super Admin', '2024-03-11 13:11:08'),
(4, 'TPA', 'Super Admin', '2024-03-11 13:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) NOT NULL,
  `ph` varchar(30) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `menue` varchar(100) NOT NULL,
  `submenue` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `ph`, `sname`, `menue`, `submenue`, `url`, `user`, `doe`) VALUES
(24, 'Super Admin', 'Super Admin', 'Master Entry', 'Role Section', 'role_entry.php', 'Super Admin', '2024-02-27 12:27:24'),
(24, '8787442863', 'Barnali deb', 'Master Entry', 'Role Section', 'role_entry.php', 'Super Admin', '2024-02-27 12:35:44'),
(26, 'Super Admin', 'Super Admin', 'Master Entry', 'Symptoms Section', 'symptoms_entry.php', 'Super Admin', '2024-02-27 15:04:00'),
(26, '8787442863', 'Barnali deb', 'Master Entry', 'Symptoms Section', 'symptoms_entry.php', 'Super Admin', '2024-02-27 15:04:22'),
(28, 'Super Admin', 'Super Admin', 'Master Entry', 'Department Section', 'department_entry.php', 'Super Admin', '2024-02-27 15:23:06'),
(28, '8787442863', 'Barnali deb', 'Master Entry', 'Department Section', 'department_entry.php', 'Super Admin', '2024-02-27 15:23:54'),
(30, 'Super Admin', 'Super Admin', 'Master Entry', 'Doctor Section', 'doctor_entry.php', 'Super Admin', '2024-02-27 15:33:49'),
(31, 'Super Admin', 'Super Admin', 'Master Entry', 'TPA Section', 'tpa_entry.php', 'Super Admin', '2024-02-27 15:35:11'),
(32, 'Super Admin', 'Super Admin', 'Bed Section', 'Bed Entry', 'bed_entry.php', 'Super Admin', '2024-02-27 15:35:48'),
(33, 'Super Admin', 'Super Admin', 'Bed Section', 'Bed Group', 'bed_group.php', 'Super Admin', '2024-02-27 15:36:28'),
(34, 'Super Admin', 'Super Admin', 'Bed Section', 'Bed Type', 'bed_type.php', 'Super Admin', '2024-02-27 15:37:05'),
(35, 'Super Admin', 'Super Admin', 'Master Entry', 'Floor Section', 'floor_section.php', 'Super Admin', '2024-02-27 15:38:06'),
(36, 'Super Admin', 'Super Admin', 'Master Entry', 'Ward Section', 'ward_section.php', 'Super Admin', '2024-02-27 15:38:39'),
(30, '8787442863', 'Barnali deb', 'Master Entry', 'Doctor Section', 'doctor_entry.php', 'Super Admin', '2024-02-27 15:39:49'),
(31, '8787442863', 'Barnali deb', 'Master Entry', 'TPA Section', 'tpa_entry.php', 'Super Admin', '2024-02-27 15:39:59'),
(35, '8787442863', 'Barnali deb', 'Master Entry', 'Floor Section', 'floor_section.php', 'Super Admin', '2024-02-27 15:40:09'),
(36, '8787442863', 'Barnali deb', 'Master Entry', 'Ward Section', 'ward_section.php', 'Super Admin', '2024-02-27 15:40:18'),
(32, '8787442863', 'Barnali deb', 'Bed Section', 'Bed Entry', 'bed_entry.php', 'Super Admin', '2024-02-27 15:40:30'),
(33, '8787442863', 'Barnali deb', 'Bed Section', 'Bed Group', 'bed_group.php', 'Super Admin', '2024-02-27 15:40:38'),
(34, '8787442863', 'Barnali deb', 'Bed Section', 'Bed Type', 'bed_type.php', 'Super Admin', '2024-02-27 15:40:46'),
(37, 'Super Admin', 'Super Admin', 'Patient', 'General Registration', 'patient_registration.php', 'Super Admin', '2024-03-10 18:31:42'),
(37, '8787442863', 'Barnali deb', 'Patient', 'General Registration', 'patient_registration.php', 'Super Admin', '2024-03-10 18:31:42'),
(38, 'Super Admin', 'Super Admin', 'Reception', 'Patient View in Nurse', 'nurse_view_patient.php', 'Super Admin', '2024-03-09 14:16:55'),
(38, '8787442863', 'Barnali deb', 'Reception', 'Patient View in Nurse', 'nurse_view_patient.php', 'Super Admin', '2024-03-09 14:17:11'),
(24, '7085584347', 'Sani Shil', 'Master Entry', 'Role Section', 'role_entry.php', 'Super Admin', '2024-03-09 14:51:26'),
(26, '7085584347', 'Sani Shil', 'Master Entry', 'Symptoms Section', 'symptoms_entry.php', 'Super Admin', '2024-03-09 14:51:36'),
(28, '7085584347', 'Sani Shil', 'Master Entry', 'Department Section', 'department_entry.php', 'Super Admin', '2024-03-09 14:51:44'),
(30, '7085584347', 'Sani Shil', 'Master Entry', 'Doctor Section', 'doctor_entry.php', 'Super Admin', '2024-03-09 14:51:52'),
(37, '7085584347', 'Sani Shil', 'Patient', 'General Registration', 'patient_registration.php', 'Super Admin', '2024-03-10 18:31:42'),
(32, '7085584347', 'Sani Shil', 'Bed Section', 'Bed Entry', 'bed_entry.php', 'Super Admin', '2024-03-09 14:55:25'),
(39, 'Super Admin', 'Super Admin', 'Patient', 'Patient Admit', 'patient_admit.php', 'Super Admin', '2024-03-10 18:32:24'),
(40, 'Super Admin', 'Super Admin', 'Master Entry', 'Location', 'location.php', 'Super Admin', '2024-03-11 08:41:40'),
(41, 'Super Admin', 'Super Admin', 'Master Entry', 'National ID', 'n_id_type.php', 'Super Admin', '2024-03-11 08:44:50'),
(42, 'Super Admin', 'Super Admin', 'Master Entry', 'Payment Mode', 'payment.php', 'Super Admin', '2024-03-11 08:47:16'),
(39, '8787442863', 'Barnali deb', 'Patient', 'Patient Admit', 'patient_admit.php', 'Super Admin', '2024-03-12 19:23:37'),
(43, 'Super Admin', 'Super Admin', 'Service Master', 'Medical Service', 'medical_charges.php', 'Super Admin', '2024-03-16 04:18:03'),
(44, 'Super Admin', 'Super Admin', 'Service Master', 'Surgical Service', 'surgical_charges.php', 'Super Admin', '2024-03-16 05:11:36'),
(45, 'Super Admin', 'Super Admin', 'Service Master', 'Therapy Service', 'therapy_charges.php', 'Super Admin', '2024-03-16 05:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `ref_doctor`
--

CREATE TABLE `ref_doctor` (
  `id` int(10) NOT NULL COMMENT 'Autoincremnt id',
  `regno` varchar(100) NOT NULL COMMENT 'Registration no',
  `dname` varchar(100) NOT NULL COMMENT 'Doctor name',
  `per` int(10) NOT NULL COMMENT 'percentage',
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ref_doctor`
--

INSERT INTO `ref_doctor` (`id`, `regno`, `dname`, `per`, `user`, `doe`) VALUES
(5, '12345', 'Dr. Reddy', 5, 'Admin', '2023-05-17 09:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`, `user`, `doe`) VALUES
(14, 'Doctor', 'Super Admin', '2024-03-09 20:26:16'),
(15, 'Admin', 'Super Admin', '2024-03-09 20:26:21'),
(16, 'Super Admin', 'Super Admin', '2024-03-09 20:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL COMMENT 'Serial ID',
  `name` varchar(255) NOT NULL COMMENT 'Name of Staff',
  `ph` varchar(10) NOT NULL COMMENT 'Mobile no',
  `pass` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL COMMENT 'Address',
  `gender` varchar(255) NOT NULL COMMENT 'Gender',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `location` varchar(255) NOT NULL COMMENT 'location',
  `role` varchar(255) NOT NULL COMMENT 'Role',
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quali` varchar(100) NOT NULL COMMENT 'qualification of staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `ph`, `pass`, `address`, `gender`, `email`, `location`, `role`, `user`, `doe`, `quali`) VALUES
(37, 'Barnali deb', '8787442863', '12345', 'Agartala', 'Female', '', 'NA', 'NA', 'Super Admin', '2024-02-27 12:32:54', 'M.tech'),
(39, 'Sani Shil', '7085584347', 'C0EvSM1F', 'SBRM', 'Male', 'sanishil.cse@gmail.com', 'NA', 'NA', 'Super Admin', '2024-03-09 14:48:57', 'Diploma Engineering');

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `insert_login` AFTER INSERT ON `staff` FOR EACH ROW BEGIN
insert into login(user,pass,type,login_status) values(NEW.ph,NEW.pass,'NA','0');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `surgical_service`
--

CREATE TABLE `surgical_service` (
  `id` int(10) NOT NULL,
  `surgical_service` varchar(200) NOT NULL,
  `charge` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surgical_service`
--

INSERT INTO `surgical_service` (`id`, `surgical_service`, `charge`, `user`, `doe`) VALUES
(2, 'Operating Room', '1200', 'Super Admin', '2024-03-16 06:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms_entry`
--

CREATE TABLE `symptoms_entry` (
  `id` int(10) NOT NULL,
  `symptoms_type` varchar(100) NOT NULL,
  `symptoms_title` varchar(100) NOT NULL,
  `symptoms_description` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `symptoms_entry`
--

INSERT INTO `symptoms_entry` (`id`, `symptoms_type`, `symptoms_title`, `symptoms_description`, `user`, `doe`) VALUES
(21, 'Respiratory', 'These symptoms affect the respiratory system', '', 'Admin', '2024-03-09 15:32:03'),
(22, 'Digestive', 'These symptoms affect the digestive system', '', 'Admin', '2024-03-09 20:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `therapies_charge`
--

CREATE TABLE `therapies_charge` (
  `id` int(10) NOT NULL,
  `therapies_type` varchar(200) NOT NULL,
  `charge` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tpa`
--

CREATE TABLE `tpa` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_prsn_nme` varchar(100) NOT NULL,
  `contact_prsn_ph` varchar(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpa`
--

INSERT INTO `tpa` (`id`, `name`, `code`, `phone`, `address`, `contact_prsn_nme`, `contact_prsn_ph`, `user`, `doe`) VALUES
(4, 'HDFC', '121', '8258903821', 'AGTL', 'dibakar saha', '8258903821', 'Admin', '2024-03-09 20:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `ward_section`
--

CREATE TABLE `ward_section` (
  `id` int(10) NOT NULL,
  `dept_id` varchar(100) NOT NULL,
  `w_section` varchar(100) NOT NULL,
  `w_no` varchar(100) NOT NULL,
  `w_floor` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ward_section`
--

INSERT INTO `ward_section` (`id`, `dept_id`, `w_section`, `w_no`, `w_floor`, `user`, `doe`) VALUES
(8, 'MED', 'Male', '1', '1st Floor', 'Admin', '2024-03-09 20:32:55'),
(9, 'MED', 'Female', '3', '1st Floor', 'Super Admin', '2024-03-11 08:15:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bed_entry`
--
ALTER TABLE `bed_entry`
  ADD PRIMARY KEY (`bed_no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bed_type`
--
ALTER TABLE `bed_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_master`
--
ALTER TABLE `lab_master`
  ADD PRIMARY KEY (`prname`),
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
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `medical_service`
--
ALTER TABLE `medical_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nation_id`
--
ALTER TABLE `nation_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse_section`
--
ALTER TABLE `nurse_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD KEY `id` (`id`);

--
-- Indexes for table `ref_doctor`
--
ALTER TABLE `ref_doctor`
  ADD PRIMARY KEY (`regno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ph` (`ph`);

--
-- Indexes for table `surgical_service`
--
ALTER TABLE `surgical_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms_entry`
--
ALTER TABLE `symptoms_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapies_charge`
--
ALTER TABLE `therapies_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpa`
--
ALTER TABLE `tpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward_section`
--
ALTER TABLE `ward_section`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bed_entry`
--
ALTER TABLE `bed_entry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bed_type`
--
ALTER TABLE `bed_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Doctor Id', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lab_master`
--
ALTER TABLE `lab_master`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_service`
--
ALTER TABLE `medical_service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nation_id`
--
ALTER TABLE `nation_id`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `nurse_section`
--
ALTER TABLE `nurse_section`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ref_doctor`
--
ALTER TABLE `ref_doctor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincremnt id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Serial ID', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `surgical_service`
--
ALTER TABLE `surgical_service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `symptoms_entry`
--
ALTER TABLE `symptoms_entry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `therapies_charge`
--
ALTER TABLE `therapies_charge`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tpa`
--
ALTER TABLE `tpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ward_section`
--
ALTER TABLE `ward_section`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`id`) REFERENCES `navigation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
