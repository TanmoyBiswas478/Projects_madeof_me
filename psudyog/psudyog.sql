-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 03:50 PM
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
-- Database: `psudyog`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `cname` varchar(100) NOT NULL COMMENT 'Customer name',
  `address` text NOT NULL COMMENT 'Address',
  `gstno` varchar(16) NOT NULL COMMENT 'GST No',
  `panno` varchar(10) NOT NULL COMMENT 'Panno',
  `phone` varchar(10) NOT NULL COMMENT 'Phone no',
  `email` varchar(100) NOT NULL DEFAULT 'NA',
  `state` varchar(10) NOT NULL COMMENT 'State',
  `sname` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `cname`, `address`, `gstno`, `panno`, `phone`, `email`, `state`, `sname`, `user`, `doe`) VALUES
(1, 'Dibakar Saha', 'Ujan Abhoynagar', 'NA', '', '7412589630', 'NA', '', 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:12:32'),
(2, 'TB', 'serfwej', '', '', '8258903821', 'tb@gmail.com', 'Tripura', 'M/s P.S. UDYOG', 'Admin', '2024-12-15 13:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `client_ledger`
--

CREATE TABLE `client_ledger` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `ph` varchar(10) NOT NULL COMMENT 'Phone No',
  `name` varchar(100) NOT NULL COMMENT 'Name of customer',
  `debit` float(20,2) NOT NULL COMMENT 'Debit',
  `credit` float(20,2) NOT NULL COMMENT 'credit',
  `sname` varchar(100) NOT NULL COMMENT 'Shop name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `company` varchar(100) NOT NULL COMMENT 'Company name',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'user ',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company`, `sname`, `user`, `doe`) VALUES
(1, 'IFB INDUSTRIES LIMITED', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:19:25'),
(2, 'VOLTAS LIMITED', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `phone` varchar(10) NOT NULL COMMENT 'Phone no ',
  `stname` varchar(100) NOT NULL COMMENT 'Staff name',
  `address` text NOT NULL COMMENT 'address',
  `gender` varchar(6) NOT NULL COMMENT 'gender ',
  `email` text NOT NULL COMMENT 'email',
  `role` varchar(50) NOT NULL COMMENT 'role',
  `location` varchar(50) DEFAULT NULL COMMENT 'location',
  `quali` varchar(50) NOT NULL COMMENT 'qualification',
  `sname` varchar(100) DEFAULT NULL COMMENT 'Shop name',
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `phone`, `stname`, `address`, `gender`, `email`, `role`, `location`, `quali`, `sname`, `user`, `doe`) VALUES
(31, '6009912205', 'kartik Malakar', 'Aagartala', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:46:22'),
(28, '7005802634', 'Dipan Das', 'AGARTALA', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:43:54'),
(32, '8787497223', 'Santu Basak', 'AGARTALA', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:47:52'),
(29, '8794581426', 'Maran Das', 'AGARTALA', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:44:55'),
(33, '8837218090', 'Shubhajit Roy', 'SURJYAMANI NAGAR', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:48:27'),
(34, '8974480229', 'Akash Shil', 'BAMUTIA', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:49:08'),
(25, '8974500378', 'DEBASHISH NAHA', 'AGARTALA', 'Male', '', '\n                                    Service engin', NULL, 'GRADUATE', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:38:10'),
(35, '9366125438', 'shanu', 'AGARTALA', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:50:03'),
(26, '9366889027', 'Arjun Das', 'KAMALGHAT', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:39:57'),
(30, '9402338536', 'Makhan Shil', 'NUTAN NAGAR', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:45:46'),
(27, '9863028167', 'Mitan Das', 'khayerpur', 'Male', '', '\n                                    Service engin', '', '10TH', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `fledger`
--

CREATE TABLE `fledger` (
  `id` int(10) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `Debit` float(20,2) NOT NULL,
  `Credit` float(20,2) NOT NULL,
  `fname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `frandb`
--

CREATE TABLE `frandb` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `fname` varchar(100) NOT NULL COMMENT 'Franchising Name',
  `address` text NOT NULL COMMENT 'Address',
  `phone` varchar(10) NOT NULL COMMENT 'Phone no',
  `email` varchar(100) NOT NULL COMMENT 'email ',
  `user` varchar(100) NOT NULL COMMENT 'User id',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `frandb`
--
DELIMITER $$
CREATE TRIGGER `login_fran` AFTER INSERT ON `frandb` FOR EACH ROW BEGIN
  insert into login(user,pass,type,sname,status) values(NEW.phone,'12345','Fran',NEW.fname,'Approved');
  insert into ledger(fname,debit,credit) values(NEW.fname,'0.00','0.00');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `fname` varchar(100) NOT NULL COMMENT 'Franchi name',
  `debit` float(20,2) NOT NULL COMMENT 'Debit ',
  `credit` float(20,2) NOT NULL COMMENT 'credit',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(100) NOT NULL COMMENT 'Phone no',
  `pass` varchar(100) NOT NULL COMMENT 'Password',
  `type` varchar(100) NOT NULL COMMENT 'Type of user',
  `sname` varchar(100) DEFAULT NULL COMMENT 'Shop name',
  `expdate` date DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`, `type`, `sname`, `expdate`, `status`) VALUES
('8798709288', '12345', 'Admin', 'M/s P.S. UDYOG', '2025-03-31', 'Pending'),
('outlet', 'outlet', 'outlet', 'M/s P.S. UDYOG', '2025-10-01', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `fname` varchar(100) NOT NULL COMMENT 'Franchi name',
  `sname` varchar(100) NOT NULL COMMENT 'Shop name',
  `plan` varchar(100) NOT NULL COMMENT 'Chose plan',
  `Month` varchar(100) NOT NULL COMMENT 'Month with year',
  `fpaid` float(20,2) NOT NULL,
  `fpaymode` varchar(100) NOT NULL,
  `paid` float(20,2) NOT NULL COMMENT 'Paid',
  `paymode` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL COMMENT 'Upload pay receive',
  `img1` varchar(100) DEFAULT NULL,
  `fstatus` varchar(100) NOT NULL,
  `sstatus` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of enty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL COMMENT 'Auto increemnt id',
  `company` varchar(100) NOT NULL COMMENT 'Company name',
  `pname` varchar(100) NOT NULL COMMENT 'Product name',
  `image` varchar(100) NOT NULL COMMENT 'Product image',
  `sname` varchar(100) NOT NULL DEFAULT 'M/s P.S. UDYOG',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `company`, `pname`, `image`, `sname`, `user`, `doe`) VALUES
(1, 'IFB INDUSTRIES LIMITED', 'TOP LOAD PRESSURE SENSOR', 'b8545ece-1c3f-487a-840d-16f072d4a520.jpg', 'M/s P.S. UDYOG', '8798709288', '2024-10-10 07:42:51'),
(2, 'IFB INDUSTRIES LIMITED', 'eeeey', '', 'M/s P.S. UDYOG', 'Admin', '2024-10-17 04:52:38'),
(3, 'IFB INDUSTRIES LIMITED', 'oiubbvb', '', 'M/s P.S. UDYOG', 'Admin', '2024-10-17 04:54:32'),
(4, 'IFB INDUSTRIES LIMITED', 'kjh', '', 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:16:10'),
(5, 'IFB INDUSTRIES LIMITED', 'KJH', '', 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:28:21'),
(6, 'IFB INDUSTRIES LIMITED', 'EEEE', '', 'M/s P.S. UDYOG', '8798709288', '2024-10-15 15:08:57'),
(7, 'IFB INDUSTRIES LIMITED', 'sad', '', 'M/s P.S. UDYOG', '8798709288', '2024-12-15 12:19:58'),
(8, 'VOLTAS LIMITED', 'FAN', '', 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:41:41'),
(9, 'IFB INDUSTRIES LIMITED', 'ewe', '', 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:42:33'),
(10, 'IFB INDUSTRIES LIMITED', 'SAD', '', 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:43:20');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `img_update` AFTER UPDATE ON `product` FOR EACH ROW BEGIN
UPDATE stock
    SET img = NEW.image
    WHERE product = NEW.pname; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `pinv` varchar(50) NOT NULL COMMENT 'Purchase Invoice No',
  `product` varchar(500) DEFAULT NULL,
  `hsn` varchar(50) DEFAULT NULL,
  `qty` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `unit1` varchar(100) NOT NULL,
  `fqty` int(10) NOT NULL COMMENT 'Free quantity',
  `unit2` varchar(10) NOT NULL COMMENT 'unit ',
  `bno` varchar(100) NOT NULL COMMENT 'Batch no',
  `expdate` date NOT NULL COMMENT 'Expairy date',
  `nop` int(10) NOT NULL COMMENT 'No of pc',
  `rack` varchar(10) NOT NULL,
  `disc` float(20,2) NOT NULL COMMENT 'Discount',
  `rate` varchar(20) DEFAULT NULL,
  `srate` float(20,2) NOT NULL COMMENT 'sales rate',
  `tax` varchar(20) DEFAULT NULL,
  `gstper` varchar(20) DEFAULT NULL,
  `cgst` varchar(10) DEFAULT '0' COMMENT 'CGST Percentage',
  `cgstp` float(10,2) DEFAULT 0.00,
  `sgst` varchar(10) DEFAULT '0',
  `sgstp` float(10,2) DEFAULT 0.00,
  `igst` varchar(10) DEFAULT '0',
  `igstp` float(10,2) DEFAULT 0.00,
  `gstamt` float(10,2) DEFAULT NULL,
  `total` float(10,2) DEFAULT NULL,
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `fy`, `category`, `pinv`, `product`, `hsn`, `qty`, `unit`, `unit1`, `fqty`, `unit2`, `bno`, `expdate`, `nop`, `rack`, `disc`, `rate`, `srate`, `tax`, `gstper`, `cgst`, `cgstp`, `sgst`, `sgstp`, `igst`, `igstp`, `gstamt`, `total`, `sname`, `user`, `doe`) VALUES
(4, '', 'IFB INDUSTRIES LIMITED', '12345', 'eeee', '444', '10', 'PC', '', 0, 'PC', '4444', '0000-00-00', 0, 'A', 0.00, '50', 60.00, '500.00', '5', '0', 0.00, '0', 0.00, '5', 25.00, 25.00, 525.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:14:15'),
(5, '', 'IFB INDUSTRIES LIMITED', '12345', 'oiu', '85', '10', 'PC', '', 0, 'PC', '789', '0000-00-00', 0, 'B', 0.00, '80', 90.00, '800.00', '5', '0', 0.00, '0', 0.00, '5', 40.00, 40.00, 840.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:15:11'),
(6, '', 'IFB INDUSTRIES LIMITED', '741', 'kjh', '74', '10', 'PC', '', 0, 'PC', '789', '0000-00-00', 0, 'C', 0.00, '80', 90.00, '800.00', '5', '0', 0.00, '0', 0.00, '5', 40.00, 40.00, 840.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:16:10'),
(7, '', 'IFB INDUSTRIES LIMITED', '741', 'kjh', '852', '10', 'PC', '', 0, 'PC', '9632', '0000-00-00', 0, '8', 0.00, '50', 80.00, '500.00', '5', '0', 0.00, '0', 0.00, '5', 25.00, 25.00, 525.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:17:04'),
(8, '', 'IFB INDUSTRIES LIMITED', '741', 'KJH', '789', '10', 'PC', '', 0, 'PC', '9632', '0000-00-00', 0, 'V', 0.00, '80', 90.00, '800.00', '5', '0', 0.00, '0', 0.00, '5', 40.00, 40.00, 840.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:28:21'),
(9, '', 'IFB INDUSTRIES LIMITED', '85236', 'EEEE', '789', '10', 'PC', '', 0, 'PC', '5203', '0000-00-00', 0, 'F', 0.00, '50', 60.00, '500.00', '5', '0', 0.00, '0', 0.00, '5', 25.00, 25.00, 525.00, 'M/s P.S. UDYOG', '8798709288', '2024-10-15 15:08:57'),
(10, '', 'IFB INDUSTRIES LIMITED', '44545', 'sad', '5454', '2', 'PC', '', 4, 'Nos', '66', '2024-12-19', 0, '31', 12.00, '10', 20.00, '20.00', '18', '0', 0.00, '0', 0.00, '18', 3.60, 3.60, 23.00, 'M/s P.S. UDYOG', '8798709288', '2024-12-15 12:19:58'),
(11, '', 'VOLTAS LIMITED', '2121', 'FAN', '6545', '40', 'PC', '', 0, '', '45', '2024-12-09', 0, 'E', 10.00, '40', 60.00, '1600.00', '3', '0', 0.00, '0', 0.00, '3', 48.00, 48.00, 1648.00, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:41:41'),
(12, '', 'IFB INDUSTRIES LIMITED', '2121', 'ewe', '99', '50', 'Nos', '', 2, 'Nos', '54', '2024-12-11', 0, 'F', 30.00, '80', 100.00, '4000.00', '5', '0', 0.00, '0', 0.00, '5', 200.00, 200.00, 4200.00, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:42:33'),
(13, '', 'IFB INDUSTRIES LIMITED', '2121', 'SAD', '65', '45', 'PC', '', 3, 'PC', '454', '2025-01-01', 0, 'G', 44.00, '100', 150.00, '4500.00', '12', '0', 0.00, '0', 0.00, '12', 540.00, 540.00, 5040.00, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:43:20');

--
-- Triggers `purchase`
--
DELIMITER $$
CREATE TRIGGER `stock_insert` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN 
    DECLARE product_count INT;

    -- Check if batch_no is provided
    IF NEW.bno IS NOT NULL THEN
        -- If batch_no is provided, check for product, sname, and batch_no
        SELECT COUNT(*) INTO product_count 
        FROM stock 
        WHERE product = NEW.product AND sname = NEW.sname AND bno = NEW.bno;

        IF product_count > 0 THEN
            -- Update existing record if found
            UPDATE stock
            SET qty = qty + NEW.qty, rate = NEW.rate, srate = NEW.srate
            WHERE product = NEW.product AND sname = NEW.sname AND bno = NEW.bno;
        ELSE
            -- If no matching product found with batch_no, insert new record
            INSERT INTO stock (category, product, hsn, qty, unit, bno, expdate, rack, rate, srate, nop, gst, sname)
            VALUES (NEW.category, NEW.product, NEW.hsn, NEW.qty, NEW.unit, NEW.bno, NEW.expdate, NEW.rack, NEW.rate, NEW.srate, NEW.nop, NEW.gstper, NEW.sname);
            
            INSERT INTO product(company, pname, user) VALUES (NEW.category, NEW.product, NEW.user);
        END IF;

    ELSE
        -- If batch_no is not provided, check only by product and sname
        SELECT COUNT(*) INTO product_count 
        FROM stock 
        WHERE product = NEW.product AND sname = NEW.sname;

        IF product_count > 0 THEN
            -- Update existing record if found
            UPDATE stock
            SET qty = qty + NEW.qty, rate = NEW.rate, srate = NEW.srate
            WHERE product = NEW.product AND sname = NEW.sname;
        ELSE
            -- If no matching product found, insert new record without batch_no
            INSERT INTO stock (category, product, hsn, qty, unit, bno, expdate, rack, rate, srate, nop, gst, sname)
            VALUES (NEW.category, NEW.product, NEW.hsn, NEW.qty, NEW.unit, NULL, NEW.expdate, NEW.rack, NEW.rate, NEW.srate, NEW.nop, NEW.gstper, NEW.sname);
            
            INSERT INTO product(company, pname, user) VALUES (NEW.category, NEW.product, NEW.user);
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL COMMENT 'Financial Year',
  `pinv` varchar(50) NOT NULL COMMENT 'Purchase Invoice No',
  `invdate` date DEFAULT NULL COMMENT 'Purchase invoice Date',
  `vendore` varchar(100) DEFAULT NULL COMMENT 'Vendor Name',
  `gstno` varchar(30) DEFAULT NULL COMMENT 'GST No of Vendor',
  `state` varchar(100) DEFAULT NULL COMMENT 'State name',
  `tax` float(10,2) DEFAULT NULL COMMENT 'Tax Pay',
  `cgsta` float(20,2) DEFAULT NULL COMMENT 'CGST Amount',
  `sgsta` float(10,2) DEFAULT NULL COMMENT 'SGST Amount',
  `igsta` float(10,2) DEFAULT NULL COMMENT 'IGST Amount',
  `total` float(10,2) DEFAULT NULL COMMENT 'Total Price',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `fy`, `pinv`, `invdate`, `vendore`, `gstno`, `state`, `tax`, `cgsta`, `sgsta`, `igsta`, `total`, `sname`, `user`, `doe`) VALUES
(5, '24-25', '12345', '2024-10-14', 'SHREE GURU REFRIGERATION', '', '', 1300.00, 0.00, 0.00, 65.00, 1365.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:15:11'),
(9, '24-25', '2121', '2024-12-15', 'SHREE GURU REFRIGERATION', '', '', 10100.00, 0.00, 0.00, 788.00, 10888.00, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:43:20'),
(8, '24-25', '44545', '2002-02-21', 'CHAKROBORTY REFRIGERATION', '', '', 20.00, 0.00, 0.00, 3.60, 23.00, 'M/s P.S. UDYOG', '8798709288', '2024-12-15 12:19:58'),
(6, '24-25', '741', '2024-10-14', 'SHREE GURU REFRIGERATION', '', '', 2100.00, 0.00, 0.00, 105.00, 2205.00, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 15:28:21'),
(7, '24-25', '85236', '2024-10-15', 'SHREE GURU REFRIGERATION', '', '', 500.00, 0.00, 0.00, 25.00, 525.00, 'M/s P.S. UDYOG', '8798709288', '2024-10-15 15:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `role` varchar(100) NOT NULL COMMENT 'role name',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `sname`, `user`, `doe`) VALUES
(10, 'Admin', 'M/s P.S. UDYOG', '8798709288', '2024-10-14 14:59:31'),
(2, 'Admins', 'M/s NITAI LAL SAHA', '9612348170', '2023-10-31 11:57:44'),
(9, 'HELPER', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:33:24'),
(3, 'Operator', 'M/s NITAI LAL SAHA', '7005261744', '2024-01-22 04:59:40'),
(8, 'owner', 'M/s P.S. UDYOG', '8798709288', '2024-09-26 14:21:19'),
(5, 'Service engineer', 'M/s P.S. UDYOG', 'Admin', '2024-03-09 04:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(10) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Invoice Date',
  `category` varchar(100) NOT NULL COMMENT 'Company name',
  `product` varchar(500) NOT NULL COMMENT 'Product Name',
  `hsn` varchar(50) NOT NULL COMMENT 'Product HSN No',
  `qty` varchar(20) NOT NULL COMMENT 'Product Quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `rate` varchar(20) NOT NULL COMMENT 'Rate of the Product',
  `bno` varchar(20) NOT NULL COMMENT 'Batch no',
  `expdate` date NOT NULL COMMENT 'Product expdate',
  `tax` float(10,2) NOT NULL COMMENT 'Tax of the Product',
  `gstper` varchar(20) NOT NULL COMMENT 'GST Percentage',
  `cgst` float(10,2) NOT NULL COMMENT 'CGST Percentage',
  `cgstp` float(10,2) NOT NULL COMMENT 'CGST Amount',
  `sgst` float(10,2) NOT NULL COMMENT 'SGST Percentage',
  `sgstp` float(10,2) NOT NULL COMMENT 'SGST Amount',
  `igst` float(10,2) NOT NULL COMMENT 'IGST Percentage',
  `igstp` float(10,2) NOT NULL COMMENT 'IGST Amount',
  `gstamt` float(10,2) NOT NULL COMMENT 'GST Amount ',
  `total` int(10) NOT NULL COMMENT 'Total Price',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `fy`, `sinv`, `invdate`, `category`, `product`, `hsn`, `qty`, `unit`, `rate`, `bno`, `expdate`, `tax`, `gstper`, `cgst`, `cgstp`, `sgst`, `sgstp`, `igst`, `igstp`, `gstamt`, `total`, `sname`, `user`, `doe`) VALUES
(2, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'OIU', '85', '1', 'PC', '90', '', '0000-00-00', 90.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.50, 4.50, 94, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:35:56'),
(6, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '74', '1', 'PC', '80', '789', '0000-00-00', 80.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.00, 4.00, 84, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:38:59'),
(7, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '789', '1', 'PC', '90', '9632', '0000-00-00', 90.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.50, 4.50, 95, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:41:41'),
(8, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '74', '1', 'PC', '80', '789', '0000-00-00', 80.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.00, 4.00, 84, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:42:02'),
(9, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '789', '1', 'PC', '90', '9632', '0000-00-00', 90.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.50, 4.50, 95, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:43:21'),
(10, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '74', '1', 'PC', '80', '789', '0000-00-00', 80.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.00, 4.00, 84, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:44:38'),
(11, '', 'MPU/24-25/2', '2024-10-14', 'IFB INDUSTRIES LIMITED', 'KJH', '789', '1', 'PC', '90', '9632', '0000-00-00', 90.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 4.50, 4.50, 95, 'M/s P.S. UDYOG', 'Admin', '2024-10-14 16:45:28'),
(12, '', 'MPU/24-25/3', '2024-10-15', 'IFB INDUSTRIES LIMITED', 'EEEE', '789', '2', 'PC', '60', '5203', '0000-00-00', 120.00, '5', 0.00, 0.00, 0.00, 0.00, 5.00, 6.00, 6.00, 126, 'M/s P.S. UDYOG', '8798709288', '2024-10-15 15:10:52'),
(13, '', 'MPU/24-25/4', '2024-12-15', 'IFB INDUSTRIES LIMITED', 'SAD', '65', '25', '', '500', '454', '2025-01-01', 12500.00, '12', 0.00, 0.00, 0.00, 0.00, 12.00, 1500.00, 1500.00, 14000, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 12:59:24'),
(14, '', 'MPU/24-25/5', '2024-12-15', 'IFB INDUSTRIES LIMITED', 'SAD', '5454', '45', 'Case', '40', '66', '2024-12-19', 1800.00, '18', 9.00, 162.00, 9.00, 162.00, 0.00, 0.00, 324.00, 2124, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 13:06:53');

--
-- Triggers `sales`
--
DELIMITER $$
CREATE TRIGGER `stock_deduct` AFTER INSERT ON `sales` FOR EACH ROW BEGIN
IF NEW.bno IS NOT NULL THEN
  UPDATE stock SET qty = qty - (NEW.qty*(select nop from stock WHERE product=NEW.product and bno=NEW.bno)) WHERE product = NEW.product and bno=NEW.bno;
ELSE
  UPDATE stock SET qty = qty - (NEW.qty*(select nop from stock WHERE product=NEW.product)) WHERE product = NEW.product;
  end if; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE `sales_master` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Sales invoice Date',
  `name` varchar(100) NOT NULL COMMENT 'client Name',
  `ph` varchar(10) NOT NULL COMMENT 'Mobile No',
  `gstno` varchar(30) NOT NULL COMMENT 'GST No of Client',
  `state` varchar(100) NOT NULL COMMENT 'State name',
  `tax` float(20,2) NOT NULL COMMENT 'Tax Pay',
  `cgsta` float(20,2) NOT NULL COMMENT 'CGST Amount',
  `sgsta` float(20,2) NOT NULL COMMENT 'SGST Amount',
  `igsta` float(20,2) NOT NULL COMMENT 'IGST Amount',
  `total` float(20,2) NOT NULL COMMENT 'Total Price',
  `tmode` varchar(50) NOT NULL COMMENT 'Transaction Mode',
  `type` varchar(100) NOT NULL COMMENT 'Type of order',
  `credit` float(20,2) NOT NULL,
  `cash` float(20,2) NOT NULL COMMENT 'Cash Payment',
  `upi` float(20,2) NOT NULL COMMENT 'Card Payment',
  `card` float(20,2) NOT NULL COMMENT 'Card Payment',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'Name of User',
  `uname` varchar(100) NOT NULL COMMENT 'Name of User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_master`
--

INSERT INTO `sales_master` (`id`, `fy`, `sinv`, `invdate`, `name`, `ph`, `gstno`, `state`, `tax`, `cgsta`, `sgsta`, `igsta`, `total`, `tmode`, `type`, `credit`, `cash`, `upi`, `card`, `sname`, `user`, `uname`) VALUES
(1, '24-25', 'MPU/24-25/1', '2024-10-14', 'Dibakar Saha', '7412589630', 'NA', '', 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 'M/s P.S. UDYOG', 'Admin', ''),
(2, '24-25', 'MPU/24-25/2', '2024-10-14', 'Dibakar Saha', '7412589630', 'NA', '', 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 'M/s P.S. UDYOG', 'Admin', ''),
(3, '24-25', 'MPU/24-25/3', '2024-10-15', 'Dibakar Saha', '7412589630', 'NA', '', 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 'M/s P.S. UDYOG', '8798709288', ''),
(4, '24-25', 'MPU/24-25/4', '2024-12-15', 'Dibakar Saha', '7412589630', 'NA', '', 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 'M/s P.S. UDYOG', 'Admin', ''),
(5, '24-25', 'MPU/24-25/5', '2024-12-15', 'TB', '8258903821', '', 'Tripura', 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 'M/s P.S. UDYOG', 'Admin', '');

--
-- Triggers `sales_master`
--
DELIMITER $$
CREATE TRIGGER `client_registration` AFTER INSERT ON `sales_master` FOR EACH ROW BEGIN
DECLARE client_count INT;
-- Check if the client already exists
SELECT COUNT(*) INTO client_count FROM client WHERE phone = NEW.ph;
-- If the client doesn't exist, insert them into the client table
 IF client_count = 0 THEN
        INSERT INTO client (cname,gstno,phone,state,sname,user)
        VALUES (NEW.name, NEW.gstno, NEW.ph,NEW.state,NEW.sname,NEW.user);
        
        INSERT INTO client_ledger (ph,name,debit,credit,sname,user)
        VALUES (NEW.ph,NEW.name,0.00,0.00,NEW.sname,NEW.user);
    END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `credit_data` AFTER UPDATE ON `sales_master` FOR EACH ROW BEGIN
  IF NEW.tmode = 'credit' THEN
     insert into client_ledger(ph,name,debit,credit,sname,user) VALUES(NEW.ph,NEW.name,0.00,NEW.credit,NEW.sname,NEW.user);
   ELSE
   insert into client_ledger(ph,name,debit,credit,sname,user) VALUES(NEW.ph,NEW.name,(NEW.cash+NEW.upi+NEW.card),0.00,NEW.sname,NEW.user);
   END IF;
      
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `sname` varchar(100) NOT NULL COMMENT 'Shop name',
  `address` text NOT NULL COMMENT 'Address',
  `phone` varchar(10) NOT NULL COMMENT 'Phone no',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `gstno` varchar(20) DEFAULT NULL COMMENT 'gstno',
  `panno` varchar(20) NOT NULL COMMENT 'panno',
  `state` varchar(20) NOT NULL COMMENT 'state',
  `fname` varchar(100) NOT NULL COMMENT 'franchi name',
  `plan` varchar(100) NOT NULL,
  `paid` float(20,2) NOT NULL COMMENT 'paid',
  `pay` varchar(100) NOT NULL COMMENT 'Payment mode',
  `expdate` date NOT NULL,
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `shop`
--
DELIMITER $$
CREATE TRIGGER `shop_creating` AFTER INSERT ON `shop` FOR EACH ROW BEGIN
  insert into login(user,pass,type,sname,expdate,status) values(NEW.phone,'12345','Shop',NEW.sname,NEW.expdate,'Pending');
  insert into fledger(sname,debit,credit,fname) values(NEW.sname,NEW.paid,'0.00',NEW.fname);
  insert into payment_history(fname,sname,plan,Month,fpaid,fpaymode,sstatus) values(NEW.fname,NEW.sname,NEW.plan,(SELECT MONTHNAME(CURDATE()) month),NEW.paid,NEW.pay,'Approved');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(10) NOT NULL COMMENT 'Auto increment id',
  `State` varchar(100) NOT NULL COMMENT 'Name of State',
  `code` varchar(2) NOT NULL COMMENT 'State Code for GST'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `State`, `code`) VALUES
(1, 'Jammu & Kashmir', '01'),
(2, 'Himachal Pradesh', '02'),
(3, 'Punjab', '03'),
(4, 'Chandigarh', '04'),
(12, 'Uttarakhand', '05'),
(13, 'Haryana', '06'),
(16, 'Delhi', '07'),
(17, 'Rajasthan', '08'),
(20, 'Uttar Pradesh', '09'),
(21, 'Bihar', '10'),
(24, 'Sikkim', '11'),
(25, 'Arunachal Pradesh', '12'),
(28, 'Nagaland', '13'),
(29, 'Manipur', '14'),
(32, 'Mizoram', '15'),
(33, 'Tripura', '16'),
(36, 'Meghalaya', '17'),
(37, 'Assam', '18'),
(40, 'West Bengal', '19'),
(41, 'Jharkhand', '20'),
(44, 'Orissa', '21'),
(45, 'Chhattisgarh', '22'),
(48, 'Madhya Pradesh', '23'),
(49, 'Gujarat', '24'),
(52, 'Daman & Diu', '25'),
(53, 'Dadra & Nagar Haveli', '26'),
(56, 'Maharashtra', '27'),
(57, 'Andhra Pradesh', '28'),
(60, 'Karnataka', '29'),
(61, 'Goa', '30'),
(64, 'Lakshadweep', '31'),
(65, 'Kerala', '32'),
(68, 'Tamil Nadu', '33'),
(69, 'Puducherry', '34'),
(72, 'Andaman & Nicobar Islands', '35'),
(73, 'Telengana', '36'),
(76, 'Andrapradesh(New)', '37');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `category` varchar(100) NOT NULL COMMENT 'Category',
  `product` varchar(500) NOT NULL COMMENT 'Product name',
  `hsn` varchar(30) NOT NULL COMMENT 'HSN Code',
  `qty` int(3) NOT NULL COMMENT 'quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `bno` varchar(100) NOT NULL COMMENT 'Batch no',
  `expdate` date NOT NULL COMMENT 'Exp Date',
  `rack` varchar(100) NOT NULL COMMENT 'Rack no',
  `rate` float(10,2) NOT NULL COMMENT 'rate',
  `srate` float(20,2) NOT NULL COMMENT 'Sales rate',
  `nop` int(10) NOT NULL COMMENT 'No of pc',
  `gst` int(2) NOT NULL COMMENT 'gst per',
  `status` varchar(100) DEFAULT 'Not Expair',
  `sname` varchar(100) NOT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `category`, `product`, `hsn`, `qty`, `unit`, `bno`, `expdate`, `rack`, `rate`, `srate`, `nop`, `gst`, `status`, `sname`, `img`) VALUES
(2, 'IFB INDUSTRIES LIMITED', 'eeee', '444', 10, 'PC', '4444', '0000-00-00', 'A', 50.00, 60.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(3, 'IFB INDUSTRIES LIMITED', 'oiu', '85', 10, 'PC', '', '0000-00-00', 'B', 80.00, 90.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(4, 'IFB INDUSTRIES LIMITED', 'kjh', '74', 20, 'PC', '789', '0000-00-00', 'C', 50.00, 80.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(5, 'IFB INDUSTRIES LIMITED', 'KJH', '789', 10, 'PC', '9632', '0000-00-00', 'V', 80.00, 90.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(6, 'IFB INDUSTRIES LIMITED', 'EEEE', '789', 10, 'PC', '5203', '0000-00-00', 'F', 50.00, 60.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(7, 'IFB INDUSTRIES LIMITED', 'sad', '5454', -48, 'PC', '66', '2024-12-19', '31', 10.00, 20.00, 0, 18, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(8, 'VOLTAS LIMITED', 'FAN', '6545', 40, 'PC', '45', '2024-12-09', 'E', 40.00, 60.00, 0, 3, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(9, 'IFB INDUSTRIES LIMITED', 'ewe', '99', 50, 'Nos', '54', '2024-12-11', 'F', 80.00, 100.00, 0, 5, 'Not Expair', 'M/s P.S. UDYOG', NULL),
(10, 'IFB INDUSTRIES LIMITED', 'SAD', '65', -5, 'PC', '454', '2025-01-01', 'G', 100.00, 150.00, 0, 12, 'Not Expair', 'M/s P.S. UDYOG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stype`
--

CREATE TABLE `stype` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `stype` varchar(100) NOT NULL COMMENT 'Service type',
  `sname` varchar(500) NOT NULL COMMENT 'Shop name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stype`
--

INSERT INTO `stype` (`id`, `stype`, `sname`, `user`, `doe`) VALUES
(1, 'IN WARRANTY', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:33:49'),
(2, 'OUT OF WARRANTY', 'M/s P.S. UDYOG', 'Admin', '2024-10-09 13:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `s_model`
--

CREATE TABLE `s_model` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `s_model` varchar(100) NOT NULL COMMENT 'Suitable Model Name',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'Name of User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of Entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_model`
--

INSERT INTO `s_model` (`id`, `s_model`, `sname`, `user`, `doe`) VALUES
(3, 'Hello', 'M/s P.S. UDYOG', '8798709288', '2024-12-15 12:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `vname` varchar(100) NOT NULL COMMENT 'Vendore name',
  `address` text NOT NULL COMMENT 'Address',
  `gstno` varchar(15) NOT NULL COMMENT 'gstno ',
  `panno` varchar(10) NOT NULL COMMENT 'pan no',
  `phone` varchar(10) NOT NULL COMMENT 'phone no',
  `state` varchar(50) NOT NULL COMMENT 'state',
  `nod` int(10) NOT NULL COMMENT 'no of days to credit',
  `sname` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL COMMENT 'user name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vname`, `address`, `gstno`, `panno`, `phone`, `state`, `nod`, `sname`, `user`, `doe`) VALUES
(1, 'SHREE GURU REFRIGERATION', 'BANAMALIPUR', '', '', '9436121318', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:22:16'),
(2, 'JAIN REFRIGERATION', 'SURJYA CHOWMUHANI', '', '', '9862113091', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:23:08'),
(3, 'CHAKROBORTY REFRIGERATION', 'BATTALA', '', '', '9856812107', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:24:08'),
(4, 'RATAN CHANDRA DAS', 'BATTALA', '', '', '9436123277', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:26:55'),
(5, 'S AND P TRADERS', 'KER CHOWMUHANI', '', '', '9774450977', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:27:45'),
(6, 'SREE GURU CHANDRAPUR/SHREYA TRADERS', 'CHANDRAPUR', '', '', '8794119081', '', 0, 'M/s P.S. UDYOG', 'Admin', '2024-10-09 14:29:35'),
(7, 'IFB INDUSTRIES LIMITED', '', '', '', '', '', 0, 'M/s P.S. UDYOG', '8798709288', '2024-10-10 06:30:27'),
(8, 'VOLTAS LIMITED', 'GUWAHATI', '', '', '', '', 0, 'M/s P.S. UDYOG', '8798709288', '2024-10-10 06:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_pay`
--

CREATE TABLE `vendor_pay` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `vname` varchar(100) NOT NULL COMMENT 'vandor name',
  `gstno` varchar(16) NOT NULL COMMENT 'gst no',
  `debit` float(20,2) NOT NULL COMMENT 'debit',
  `credit` float(20,2) NOT NULL COMMENT 'credit',
  `month` varchar(100) NOT NULL COMMENT 'month of payment',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_pay`
--

INSERT INTO `vendor_pay` (`id`, `vname`, `gstno`, `debit`, `credit`, `month`, `sname`, `user`, `doe`) VALUES
(0, 'IFB INDUSTRIES LIMITED', '', 0.00, 482.00, 'October-2024', '', 'Admin', '2024-10-10 07:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `work_assign`
--

CREATE TABLE `work_assign` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `wno` varchar(100) NOT NULL COMMENT 'Works order no',
  `wdate` date NOT NULL COMMENT 'workds order date',
  `cname` varchar(100) NOT NULL COMMENT 'Customer name',
  `ph` varchar(10) NOT NULL COMMENT 'Phone no',
  `iname` varchar(100) NOT NULL COMMENT 'item name',
  `slno` varchar(100) NOT NULL COMMENT 'item serial no',
  `stype` varchar(100) NOT NULL COMMENT 'service type',
  `asig` varchar(100) NOT NULL COMMENT 'Assigned engineer ',
  `eng_ph` varchar(10) NOT NULL COMMENT 'Engineer phone no',
  `email` varchar(100) NOT NULL COMMENT 'email ',
  `company` varchar(100) NOT NULL COMMENT 'company name',
  `desc_goods` varchar(100) NOT NULL COMMENT 'description of goods ',
  `hsn` varchar(20) NOT NULL COMMENT 'hsn code',
  `qty` int(10) NOT NULL COMMENT 'quantity',
  `rqty` int(10) DEFAULT 0 COMMENT 'Return quantity',
  `unit` varchar(100) NOT NULL COMMENT 'unit',
  `rate` float(20,2) NOT NULL COMMENT 'rate ',
  `rack` varchar(30) NOT NULL COMMENT 'rack ',
  `tax` float(20,2) NOT NULL COMMENT 'taxable values ',
  `gstper` int(10) NOT NULL COMMENT 'gspercentage ',
  `gstamt` varchar(100) NOT NULL COMMENT 'gst amount',
  `total` float(20,2) NOT NULL COMMENT 'total amount',
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'user name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_assign`
--

INSERT INTO `work_assign` (`id`, `wno`, `wdate`, `cname`, `ph`, `iname`, `slno`, `stype`, `asig`, `eng_ph`, `email`, `company`, `desc_goods`, `hsn`, `qty`, `rqty`, `unit`, `rate`, `rack`, `tax`, `gstper`, `gstamt`, `total`, `sname`, `user`, `doe`) VALUES
(1, '1', '2024-12-15', 'TB', '8258903821', 'IT', '878788788777', 'IN WARRANTY', 'Makhan Shil', '9402338536', '', 'IFB INDUSTRIES LIMITED', 'SAD', '5454', 50, 0, 'PC', 20.00, '31', 1000.00, 18, '180.00', 1180.00, 'M/s P.S. UDYOG', 'Admin', '2024-12-15 13:05:18');

--
-- Triggers `work_assign`
--
DELIMITER $$
CREATE TRIGGER `stock_deduct_asign` AFTER INSERT ON `work_assign` FOR EACH ROW BEGIN
  UPDATE stock SET qty = qty - NEW.qty WHERE product = NEW.desc_goods;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER UPDATE ON `work_assign` FOR EACH ROW BEGIN
  UPDATE stock
        SET qty = qty + NEW.rqty WHERE product = NEW.desc_goods AND sname=NEW.sname;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `wno` varchar(100) NOT NULL COMMENT 'Work order no',
  `wdate` date NOT NULL COMMENT 'Work order date',
  `cname` varchar(100) NOT NULL COMMENT 'Customer name',
  `ph` varchar(10) NOT NULL COMMENT 'phone no',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `state` varchar(100) NOT NULL COMMENT 'state',
  `iname` varchar(100) NOT NULL COMMENT 'item name',
  `iserial` varchar(100) NOT NULL COMMENT 'item serial no',
  `stype` varchar(50) NOT NULL COMMENT 'serial no',
  `caddress` text NOT NULL COMMENT 'customer address',
  `status` varchar(100) NOT NULL DEFAULT 'Pending' COMMENT 'Work Status',
  `sname` varchar(100) NOT NULL COMMENT 'shop name',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`id`, `wno`, `wdate`, `cname`, `ph`, `email`, `state`, `iname`, `iserial`, `stype`, `caddress`, `status`, `sname`, `user`, `doe`) VALUES
(1, '1', '2024-12-15', 'TB', '8258903821', 'tb@gmail.com', 'Tripura', 'IT', '878788788777', 'IN WARRANTY', 'serfwej', 'Pending', 'M/s P.S. UDYOG', 'Admin', '2024-12-15 13:04:39');

--
-- Triggers `work_order`
--
DELIMITER $$
CREATE TRIGGER `client_entry` AFTER INSERT ON `work_order` FOR EACH ROW BEGIN
DECLARE client_count INT;
-- Check if the client already exists
SELECT COUNT(*) INTO client_count FROM client WHERE phone = NEW.ph;
-- If the client doesn't exist, insert them into the client table
 IF client_count = 0 THEN
        INSERT INTO client (cname,phone,state,address,email,sname,user)
        VALUES (NEW.cname,NEW.ph,NEW.state,NEW.caddress,NEW.email,NEW.sname,NEW.user);
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `work_status`
--

CREATE TABLE `work_status` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `islno` varchar(100) NOT NULL COMMENT 'Item Serial No',
  `iname` varchar(100) NOT NULL COMMENT 'Item name',
  `wno` varchar(100) NOT NULL COMMENT 'Work order no',
  `wdate` date NOT NULL COMMENT 'Work order date',
  `stype` varchar(100) NOT NULL COMMENT 'Service type',
  `aseng` varchar(100) NOT NULL COMMENT 'Assigned Engineer',
  `ph` varchar(10) NOT NULL COMMENT 'Phone no',
  `email` varchar(100) DEFAULT NULL COMMENT 'email',
  `wassign` date NOT NULL COMMENT 'Date of Assigned',
  `wcomp` date DEFAULT NULL COMMENT 'Date of Complete',
  `sname` varchar(100) NOT NULL COMMENT 'Shop name',
  `status` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `client_ledger`
--
ALTER TABLE `client_ledger`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fledger`
--
ALTER TABLE `fledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frandb`
--
ALTER TABLE `frandb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinv` (`pinv`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`pinv`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinv` (`sinv`);

--
-- Indexes for table `sales_master`
--
ALTER TABLE `sales_master`
  ADD PRIMARY KEY (`sinv`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `State` (`State`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stype`
--
ALTER TABLE `stype`
  ADD PRIMARY KEY (`stype`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `s_model`
--
ALTER TABLE `s_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `vendor_pay`
--
ALTER TABLE `vendor_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_assign`
--
ALTER TABLE `work_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`wno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `work_status`
--
ALTER TABLE `work_status`
  ADD PRIMARY KEY (`wno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_ledger`
--
ALTER TABLE `client_ledger`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `fledger`
--
ALTER TABLE `fledger`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frandb`
--
ALTER TABLE `frandb`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto increemnt id', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_master`
--
ALTER TABLE `sales_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stype`
--
ALTER TABLE `stype`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `s_model`
--
ALTER TABLE `s_model`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_assign`
--
ALTER TABLE `work_assign`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_status`
--
ALTER TABLE `work_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
