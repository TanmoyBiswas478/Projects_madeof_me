-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 07:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parlour`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinment`
--

CREATE TABLE `appoinment` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `doa` date NOT NULL COMMENT 'date of appointment',
  `sname` varchar(100) NOT NULL COMMENT 'Staff name',
  `asloat` varchar(100) NOT NULL COMMENT 'Appointment slot',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appoinment`
--

INSERT INTO `appoinment` (`id`, `doa`, `sname`, `asloat`, `user`, `doe`) VALUES
(4, '2023-12-20', 'abc', '9:00 AM', 'Admin', '2023-12-20 16:24:09'),
(5, '2023-12-20', 'abc', '9:00 AM', 'Admin', '2023-12-20 16:26:48'),
(6, '2023-12-20', 'abc', '9:00 AM', 'Admin', '2023-12-20 16:31:05'),
(7, '2023-12-20', 'abc', '9:00 AM', 'Admin', '2023-12-20 16:33:00'),
(8, '2023-12-20', 'abc', '11:00 AM', 'Admin', '2023-12-20 16:43:49'),
(9, '2023-12-21', 'abc', '11:00 AM', 'Admin', '2023-12-21 10:49:38'),
(10, '2023-12-21', 'abc', '9:00 AM', 'Admin', '2023-12-21 11:06:03'),
(11, '2023-12-21', 'abc', '12:00 PM', 'Admin', '2023-12-21 11:14:24'),
(12, '2024-04-11', 'abc', '9:00 AM', 'Admin', '2024-04-11 11:09:33'),
(13, '2024-04-11', 'abc', '3:00 PM', 'Admin', '2024-04-11 14:06:16'),
(14, '2024-04-11', 'abc', '5:00 PM', 'Admin', '2024-04-11 14:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `cname` varchar(100) NOT NULL COMMENT 'Category',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cname`, `user`, `doe`) VALUES
(37, 'COLORING', 'Admin', '2023-06-22 07:39:48'),
(41, 'Face Treatment', 'Admin', '2023-06-22 09:55:29'),
(33, 'HAIR', 'Admin', '2023-06-22 07:11:34'),
(40, 'Hair Treatment', 'Admin', '2023-06-22 09:55:15'),
(35, 'HANDS & FEET', 'Admin', '2023-06-22 07:12:26'),
(34, 'MAKEUP', 'Admin', '2023-06-22 07:12:02'),
(36, 'SHAVING', 'Admin', '2023-06-22 07:39:06'),
(32, 'SKIN CARE', 'Admin', '2023-06-22 07:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `cid` varchar(100) NOT NULL COMMENT 'customer id',
  `phone` varchar(100) NOT NULL COMMENT 'phone no',
  `name` varchar(100) NOT NULL COMMENT 'name of customer',
  `gender` varchar(6) NOT NULL COMMENT 'gender',
  `address` text NOT NULL COMMENT 'Address',
  `dob` date DEFAULT NULL COMMENT 'date of birth',
  `doa` date DEFAULT NULL COMMENT 'date of anniversary',
  `email` varchar(100) DEFAULT NULL COMMENT 'email',
  `oid` varchar(100) NOT NULL,
  `oaddress` text NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `cid`, `phone`, `name`, `gender`, `address`, `dob`, `doa`, `email`, `oid`, `oaddress`, `user`, `doe`) VALUES
(9, '', '', '', '', '', NULL, NULL, NULL, '', '', '', '2024-04-11 14:15:16'),
(8, '457253', '7005261744', 'Diabakr saha', 'Male', '', NULL, NULL, NULL, '', '', '', '2023-07-07 09:08:05');

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
  `email` text NOT NULL DEFAULT '' COMMENT 'email',
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
(8, '1234567890', 'abc', 'abc', 'Male', 'abc@gmail.com', 'BARBAR', 'Outlet 7', 'abc', 'Admin', '2023-07-07 06:12:08'),
(7, '7005261744', 'diabakr saha', 'agartala', 'Male', 'diba3saha@gmail.com', 'Admin', 'Outlet 7', 'masters', 'Admin', '2023-07-07 06:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(100) NOT NULL COMMENT 'User name',
  `pass` varchar(100) NOT NULL COMMENT 'Password',
  `type` varchar(100) NOT NULL COMMENT 'Type of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`, `type`) VALUES
('admin', 'admin', 'admin'),
('outlet1', 'outlet', 'outlet');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `oname` varchar(100) NOT NULL COMMENT 'Outlet name',
  `address` text NOT NULL COMMENT 'Address',
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id`, `oname`, `address`, `user`, `doe`) VALUES
(5, 'Outlet 7', 'MBB Chowmohani,Agartala', 'Admin', '2023-06-16 09:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `pinv` varchar(50) NOT NULL COMMENT 'Purchase Invoice No',
  `invdate` date NOT NULL,
  `product` varchar(500) DEFAULT NULL,
  `hsn` varchar(50) DEFAULT NULL,
  `qty` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `bno` varchar(100) NOT NULL COMMENT 'Batch no',
  `expdate` date NOT NULL COMMENT 'Expairy date',
  `rate` varchar(20) DEFAULT NULL,
  `srate` float(20,2) NOT NULL COMMENT 'Sales rate',
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
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `fy`, `category`, `pinv`, `invdate`, `product`, `hsn`, `qty`, `unit`, `bno`, `expdate`, `rate`, `srate`, `tax`, `gstper`, `cgst`, `cgstp`, `sgst`, `sgstp`, `igst`, `igstp`, `gstamt`, `total`, `user`, `doe`) VALUES
(1, '', 'Sales', '2563', '2023-11-30', 'demo', '8520', '10', 'ML', '8173139', '2023-11-30', '50', 60.00, '500.00', '18', '9', 45.00, '9', 45.00, '0', 0.00, 90.00, 590.00, 'Admin', '2023-11-30 09:30:33');

--
-- Triggers `purchase`
--
DELIMITER $$
CREATE TRIGGER `purchase_delete` AFTER DELETE ON `purchase` FOR EACH ROW BEGIN
  DECLARE product varchar(100);
DECLARE quantity_var INT;
DECLARE expdate DATE;

    -- Store the values of the deleted row
    SET product=OLD.product;
    SET quantity_var = OLD.qty;
    SET expdate = OLD.expdate;

    -- Update the stock table with the quantity added
    UPDATE stock
    SET qty = qty - quantity_var
    WHERE product = product and expdate=expdate;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_insert` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN
DECLARE product_count INT;
    
    SELECT COUNT(*) INTO product_count 
    FROM stock 
    WHERE expdate = NEW.expdate AND product = NEW.product;
    
    IF product_count > 0 THEN
        -- Product with the same expdate and product already exists, perform update
        UPDATE stock
        SET qty = qty + NEW.qty, rate = NEW.rate, srate = NEW.srate
        WHERE expdate = NEW.expdate AND product = NEW.product;
    ELSE
        -- No matching product found, perform insert
        INSERT INTO stock (category, product, hsn, qty, unit, bno, expdate, rate, srate, gst)
        VALUES (NEW.category, NEW.product, NEW.hsn, NEW.qty, NEW.unit, NEW.bno, NEW.expdate, NEW.rate, NEW.srate, NEW.gstper);
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
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `fy`, `pinv`, `invdate`, `vendore`, `gstno`, `state`, `tax`, `cgsta`, `sgsta`, `igsta`, `total`, `user`, `doe`) VALUES
(1, '23-24', '2563', '2023-11-30', 'ABC PVT LTD', '16FAMPS4420P1ZO', 'Tripura', 500.00, 45.00, 45.00, 0.00, 590.00, 'Admin', '2023-11-30 09:30:33');

--
-- Triggers `purchase_master`
--
DELIMITER $$
CREATE TRIGGER `ledger_vendor` AFTER UPDATE ON `purchase_master` FOR EACH ROW BEGIN
  DECLARE count_result INT;

  -- Check if data for the current month and vendor already exists
  SELECT COUNT(*) INTO count_result
  FROM vendor_pay
  WHERE vname = NEW.vendore AND `month` = DATE_FORMAT(NOW(), '%M-%Y');

  IF count_result > 0 THEN
    -- Data for the current month and vendor exists, update credit
    UPDATE vendor_pay
    SET credit = (
        SELECT SUM(total)
        FROM purchase_master
        WHERE vendore = NEW.vendore
          AND invdate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())
    )
    WHERE vname = NEW.vendore AND `month` = DATE_FORMAT(NOW(), '%M-%Y');
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipe`
--

CREATE TABLE `receipe` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `iname` varchar(100) NOT NULL COMMENT 'Item name',
  `pname` varchar(100) NOT NULL COMMENT 'User product name',
  `qty` int(11) NOT NULL COMMENT 'Quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipe`
--

INSERT INTO `receipe` (`id`, `iname`, `pname`, `qty`, `unit`, `user`, `doe`) VALUES
(7, 'Biscuits', 'Moda', 1, 'grm', 'Admin', '2023-05-15 11:34:59'),
(13, 'Biscuits', 'Sugar', 1, 'Grm', 'Admin', '2023-05-15 11:43:44'),
(14, 'Biscuit', 'Moyda', 32, 'grm', 'Admin', '2023-05-16 11:56:03'),
(15, 'Biscuit', 'Baking Powder', 1, 'grm', 'Admin', '2023-05-16 11:57:13'),
(16, 'Biscuit', 'Salt', 1, 'grm', 'Admin', '2023-05-16 11:59:12'),
(17, 'Biscuit', 'Butter', 14, 'grm', 'Admin', '2023-05-16 12:00:32'),
(18, 'Biscuit', 'Milk Powder', 30, 'grm', 'Admin', '2023-05-16 12:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `requision`
--

CREATE TABLE `requision` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `reqno` varchar(100) NOT NULL COMMENT 'Requisition no',
  `reqdate` date NOT NULL COMMENT 'Requisition date',
  `item` varchar(100) NOT NULL COMMENT 'item name',
  `qty` int(10) NOT NULL COMMENT 'quantity',
  `sqty` int(10) NOT NULL COMMENT 'Quantity Send',
  `unit` varchar(100) NOT NULL COMMENT 'unit',
  `outlet` varchar(100) NOT NULL COMMENT 'outlet to request',
  `doa` date DEFAULT NULL COMMENT 'Date of Accept',
  `status` varchar(100) DEFAULT NULL COMMENT 'status',
  `cancel` text DEFAULT NULL COMMENT 'Cancel ',
  `user` varchar(100) NOT NULL COMMENT 'user name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requision`
--

INSERT INTO `requision` (`id`, `reqno`, `reqdate`, `item`, `qty`, `sqty`, `unit`, `outlet`, `doa`, `status`, `cancel`, `user`, `doe`) VALUES
(2, 'REQ/23-24/1', '2023-05-25', 'DEMO1', 10, 10, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 09:56:13'),
(3, 'REQ/23-24/1', '2023-05-25', 'DEMO1', 10, 10, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 09:56:13'),
(4, 'REQ/23-24/1', '2023-05-25', 'DEMO1', 10, 10, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 09:56:13'),
(5, 'REQ/23-24/2', '2023-05-25', 'demo4', 10, 0, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', 'saghdveyfif', 'Outlet', '2023-05-25 10:22:06'),
(6, 'REQ/23-24/3', '2023-05-25', 'fgfgf', 10, 0, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', 'klhgoihjorih', 'Outlet', '2023-05-25 10:23:00'),
(7, 'REQ/23-24/3', '2023-05-25', 'hgghgf', 10, 0, 'Ltr', 'Outlet1', NULL, NULL, NULL, 'Outlet', '2023-05-25 07:55:53'),
(8, 'REQ/23-24/4', '2023-05-25', 'gfgfd', 10, 10, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', 'Item not available in stock', 'Outlet', '2023-05-25 10:05:37'),
(9, 'REQ/23-24/4', '2023-05-25', 'fdfdsfsdfsdfdsf', 25, 10, 'Nos', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 09:58:44'),
(10, 'REQ/23-24/5', '2023-05-25', 'gtyy', 10, 10, 'Ltr', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:26:35'),
(11, 'REQ/23-24/5', '2023-05-25', 'ffdgfgf', 25, 25, 'PC', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:26:38'),
(12, 'REQ/23-24/5', '2023-05-25', 'fdfdf', 35, 35, 'PC', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:26:40'),
(13, 'REQ/23-24/5', '2023-05-25', 'sdsd', 2, 0, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', 'uyuyu', 'Outlet', '2023-05-25 10:26:47'),
(14, 'REQ/23-24/6', '2023-05-25', 'DEMO1', 2, 2, 'Nos', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:38:40'),
(15, 'REQ/23-24/6', '2023-05-25', 'demo3', 12, 12, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:38:43'),
(16, 'REQ/23-24/6', '2023-05-25', 'kjkj', 12, 12, 'KG', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:38:45'),
(17, 'REQ/23-24/6', '2023-05-25', 'gfgfd', 22, 22, 'ml', 'Outlet1', '2023-05-25', 'Send to Outlet', NULL, 'Outlet', '2023-05-25 10:38:47'),
(18, 'REQ/23-24/7', '2023-05-29', 'DEMO1', 10, 8, 'KG', 'Outlet1', '2023-05-29', 'Send to Outlet', NULL, 'Outlet', '2023-05-29 06:55:32'),
(19, 'REQ/23-24/7', '2023-05-29', 'demo3', 20, 0, 'Ltr', 'Outlet1', '2023-05-29', 'Send to Outlet', 'Item stock not available ', 'Outlet', '2023-05-29 06:55:58');

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
(12, 'Admin', 'Admin', '2023-06-16 09:54:45'),
(10, 'BARBAR', 'Admin', '2023-07-07 05:52:35'),
(11, 'Beautician', 'Admin', '2023-06-16 09:54:33'),
(9, 'Outlet Manager', 'Admin', '2023-06-16 09:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(10) NOT NULL COMMENT 'Financial Year',
  `invno` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Invoice Date',
  `product` varchar(500) NOT NULL COMMENT 'Product Name',
  `sname` varchar(100) DEFAULT NULL,
  `asloat` varchar(100) DEFAULT NULL,
  `hsn` varchar(50) NOT NULL COMMENT 'Product HSN No',
  `qty` varchar(20) NOT NULL COMMENT 'Product Quantity',
  `unit` varchar(100) NOT NULL COMMENT 'Unit',
  `rate` varchar(20) NOT NULL COMMENT 'Rate of the Product',
  `bno` varchar(100) NOT NULL,
  `expdate` date DEFAULT NULL,
  `mrp` float(10,2) NOT NULL COMMENT 'Product MRP',
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
  `user` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `fy`, `invno`, `invdate`, `product`, `sname`, `asloat`, `hsn`, `qty`, `unit`, `rate`, `bno`, `expdate`, `mrp`, `tax`, `gstper`, `cgst`, `cgstp`, `sgst`, `sgstp`, `igst`, `igstp`, `gstamt`, `total`, `user`, `doe`) VALUES
(11, '', 'KHS/23-24/1', '2023-12-21', 'HAIR CUT & SHAMPOO - Male', 'abc', '12:00 PM', 'NA', '1', 'NA', '250.00', 'NA', NULL, 0.00, 250.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250, 'Admin', '2023-12-21 11:14:24'),
(12, '', 'KHS/24-25/2', '2024-04-11', 'HAIR CUT & SHAMPOO - Male', 'abc', '9:00 AM', 'NA', '1', 'NA', '250.00', 'NA', NULL, 0.00, 250.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250, 'Admin', '2024-04-11 11:09:33'),
(13, '', 'KHS/24-25/3', '2024-04-11', 'HAIR CUT & SHAMPOO(ADVANCE) - Male', 'abc', '3:00 PM', 'NA', '1', 'NA', '350.00', 'NA', NULL, 0.00, 350.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 350, 'Admin', '2024-04-11 14:06:16'),
(14, '', 'KHS/24-25/4', '2024-04-11', 'HAIR CUT & SHMAPOO - Baby Girl', 'abc', '5:00 PM', 'NA', '1', 'NA', '250.00', 'NA', NULL, 0.00, 250.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 250, 'Admin', '2024-04-11 14:15:16');

--
-- Triggers `sales`
--
DELIMITER $$
CREATE TRIGGER `appoinment_sloat` AFTER INSERT ON `sales` FOR EACH ROW INSERT INTO appoinment (doa,sname,asloat,user) VALUES (NEW.invdate, NEW.sname,NEW.asloat,NEW.user)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE `sales_master` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL COMMENT 'Financial Year',
  `invno` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Sales invoice Date',
  `name` varchar(100) NOT NULL COMMENT 'client Name',
  `ph` varchar(10) NOT NULL COMMENT 'Mobile No',
  `cid` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `gstno` varchar(30) NOT NULL DEFAULT 'NA' COMMENT 'GST No of Client',
  `state` varchar(100) NOT NULL DEFAULT 'West Bengal' COMMENT 'State name',
  `tax` float(20,2) NOT NULL COMMENT 'Tax Pay',
  `cgsta` float(20,2) NOT NULL COMMENT 'CGST Amount',
  `sgsta` float(20,2) NOT NULL COMMENT 'SGST Amount',
  `igsta` float(20,2) NOT NULL COMMENT 'IGST Amount',
  `total` float(20,2) NOT NULL COMMENT 'Total Price',
  `pay` varchar(100) NOT NULL COMMENT 'Payment mode',
  `type` varchar(100) NOT NULL COMMENT 'Type of service',
  `cash` float(20,2) NOT NULL COMMENT 'Cash total',
  `upi` float(20,2) NOT NULL COMMENT 'UPI Total',
  `card` float(20,2) NOT NULL COMMENT 'Card Total',
  `oid` varchar(100) NOT NULL COMMENT 'Outlet id',
  `oaddress` text NOT NULL COMMENT 'Outlet name and address',
  `user` varchar(100) NOT NULL COMMENT 'Name of User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_master`
--

INSERT INTO `sales_master` (`id`, `fy`, `invno`, `invdate`, `name`, `ph`, `cid`, `gender`, `address`, `gstno`, `state`, `tax`, `cgsta`, `sgsta`, `igsta`, `total`, `pay`, `type`, `cash`, `upi`, `card`, `oid`, `oaddress`, `user`, `doe`) VALUES
(11, '23-24', 'KHS/23-24/1', '2023-12-21', 'Diabakr saha', '7005261744', '457253', 'Male', 'Agartala', 'NA', 'West Bengal', 250.00, 0.00, 0.00, 0.00, 250.00, 'Cash', 'Appointment', 250.00, 0.00, 0.00, '', '', 'Admin', '2023-12-21 11:14:38'),
(12, '24-25', 'KHS/24-25/2', '2024-04-11', 'Diabakr saha', '7005261744', '457253', 'Male', 'Agartala', 'NA', 'West Bengal', 250.00, 0.00, 0.00, 0.00, 250.00, '', '', 0.00, 0.00, 0.00, '', '', 'Admin', '2024-04-11 11:09:33'),
(13, '24-25', 'KHS/24-25/3', '2024-04-11', 'Diabakr saha', '7005261744', '457253', 'Male', '', 'NA', 'West Bengal', 350.00, 0.00, 0.00, 0.00, 350.00, '', '', 0.00, 0.00, 0.00, '', '', 'Admin', '2024-04-11 14:06:16'),
(14, '24-25', 'KHS/24-25/4', '2024-04-11', '', '', '', '', '', 'NA', 'West Bengal', 250.00, 0.00, 0.00, 0.00, 250.00, '', '', 0.00, 0.00, 0.00, '', '', 'Admin', '2024-04-11 14:15:16');

--
-- Triggers `sales_master`
--
DELIMITER $$
CREATE TRIGGER `insert_into_client` AFTER INSERT ON `sales_master` FOR EACH ROW BEGIN
IF NEW.ph NOT IN (SELECT phone FROM client) THEN
        INSERT INTO client (cid,phone,name,gender,oid,oaddress) VALUES (NEW.cid, NEW.ph,NEW.name,NEW.gender,NEW.oid,NEW.oaddress);
    END IF;
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `cname` varchar(100) NOT NULL COMMENT 'category name',
  `iname` varchar(100) NOT NULL COMMENT 'service name',
  `type` varchar(20) NOT NULL COMMENT 'Male/Female',
  `price` float(20,2) NOT NULL COMMENT 'price of service',
  `gst` int(10) NOT NULL COMMENT 'GST%',
  `user` varchar(100) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `cname`, `iname`, `type`, `price`, `gst`, `user`, `doe`) VALUES
(1, 'HAIR', 'HAIR CUT & SHAMPOO', 'Male', 250.00, 0, 'Admin', '2023-06-22 07:14:08'),
(3, 'HAIR', 'HAIR CUT & SHAMPOO(ADVANCE)', 'Male', 350.00, 0, 'Admin', '2023-06-22 08:50:27'),
(5, 'HAIR', 'HAIR CUT & SHAMPOO(REGULAR)', 'Female', 450.00, 0, 'Admin', '2023-06-22 08:53:53'),
(6, 'HAIR', 'HAIR CUT & SHAMPOO(ADVANCE)', 'Female', 650.00, 0, 'Admin', '2023-06-22 08:54:32'),
(7, 'HAIR', 'BLOW DRY SETTING', 'Male', 150.00, 0, 'Admin', '2023-06-22 09:07:02'),
(8, 'HAIR', 'BLOW DRY SETTING', 'Female', 350.00, 0, 'Admin', '2023-06-22 09:07:34'),
(12, 'HAIR', 'SHAVING/TRIMMING', 'Male', 100.00, 0, 'Admin', '2023-06-22 09:13:30'),
(13, 'HAIR', 'HAIR CUT & SHMAPOO', 'Baby Girl', 250.00, 0, 'Admin', '2023-06-22 09:14:05'),
(14, 'HAIR', 'HAIR CUT & SHAMPOO', 'Baby Boy', 150.00, 0, 'Admin', '2023-06-22 09:14:42'),
(17, 'HAIR', 'HAIR REPAIRING(LOREAL)', 'Male', 800.00, 0, 'Admin', '2023-06-22 09:17:57'),
(18, 'HAIR', 'HAIR REPAIRING(LOREAL)', 'Female', 1200.00, 0, 'Admin', '2023-06-22 09:18:37'),
(19, 'HAIR', 'COLOUR SHINE(LOREAL)', 'Male', 600.00, 0, 'Admin', '2023-06-22 09:19:05'),
(21, 'HAIR', 'COLOUR SHINE(LOREAL)', 'Female', 1500.00, 0, 'Admin', '2023-06-22 09:20:33'),
(22, 'HAIR', 'COLOUR SHINE(LOREAL)', 'Female', 1500.00, 0, 'Admin', '2023-06-22 09:20:33'),
(23, 'HAIR', 'STRAIGHT CONTROL(LOREAL)', 'Male', 600.00, 0, 'Admin', '2023-06-22 09:21:12'),
(24, 'HAIR', 'STRAIGHT CONTROL(LOREAL)', 'Female', 1500.00, 0, 'Admin', '2023-06-22 09:21:55'),
(25, 'HAIR', 'SCALP CLEANING(LOREAL)', 'Male', 500.00, 0, 'Admin', '2023-06-22 09:22:48'),
(26, 'HAIR', 'SCALP CLEANING(LOREAL)', 'Female', 500.00, 0, 'Admin', '2023-06-22 09:23:36'),
(27, 'HAIR', 'LUXURIOUS SPA(GK)', 'Male', 1000.00, 0, 'Admin', '2023-06-22 09:24:22'),
(28, 'HAIR', 'LUXURIOUS SPA(GK)', 'Female', 2000.00, 0, 'Admin', '2023-06-22 09:24:58'),
(29, 'HAIR', 'HAIR FALL(TREATMENT)', 'Male', 800.00, 0, 'Admin', '2023-06-22 09:33:11'),
(30, 'HAIR', 'HAIR FALL(TREATMENT)', 'Female', 1200.00, 0, 'Admin', '2023-06-22 09:33:41'),
(31, 'HAIR', 'ANTI-DANDRUFF', 'Male', 800.00, 0, 'Admin', '2023-06-22 09:34:21'),
(32, 'HAIR', 'ANTI-DANDRUFF', 'Female', 1200.00, 0, 'Admin', '2023-06-22 09:34:50'),
(34, 'HAIR', 'SCALP(TREATMENT)', 'Male', 800.00, 0, 'Admin', '2023-06-22 09:36:07'),
(35, 'HAIR', 'SCALP(TREATMENT)', 'Female', 1200.00, 0, 'Admin', '2023-06-22 09:36:31'),
(36, 'HAIR', 'HAIR FALL TREATMENT(WITH SPA)', 'Male', 1200.00, 0, 'Admin', '2023-06-22 09:37:25'),
(37, 'HAIR', 'HAIR FALL TREATMENT(WITH SPA)', 'Female', 1800.00, 0, 'Admin', '2023-06-22 09:38:03'),
(38, 'HAIR', 'ANTI-DANDRUFF TREATMENT(WITH SPA)', 'Male', 1200.00, 0, 'Admin', '2023-06-22 09:39:08'),
(39, 'HAIR', 'ANTI-DANDRUFF TREATMENT(WITH SPA)', 'Female', 1800.00, 0, 'Admin', '2023-06-22 09:40:21'),
(40, 'HAIR', 'SCALP TREATMENT(WITH SPA)', 'Male', 1200.00, 0, 'Admin', '2023-06-22 09:40:59'),
(43, 'HAIR', 'SCALP TREATMENT(WITH SPA)', 'Female', 1800.00, 0, 'Admin', '2023-06-22 09:42:16'),
(44, 'HAIR', 'KERATIN TREATMENT(GK)', 'Female', 5000.00, 0, 'Admin', '2023-06-22 09:43:08'),
(45, 'HAIR', 'KERATIN TREATMENT(GK)', 'Male', 2500.00, 0, 'Admin', '2023-06-22 09:43:28'),
(46, 'HAIR', 'KERATIN TREATMENT(OTHERS)', 'Female', 3499.00, 0, 'Admin', '2023-06-22 09:44:09'),
(47, 'HAIR', 'KERATIN TREATMENT(OTHERS)', 'Male', 1499.00, 0, 'Admin', '2023-06-22 09:44:28'),
(48, 'HAIR', 'BOTOX TREATMENT(ADVANCE)', 'Female', 8000.00, 0, 'Admin', '2023-06-22 09:45:19'),
(49, 'HAIR', 'BOTOX TREATMENT(ADVANCE)', 'Female', 8000.00, 0, 'Admin', '2023-06-22 09:45:19'),
(50, 'HAIR', 'BOTOX TREATMENT(ADVANCE)', 'Male', 4000.00, 0, 'Admin', '2023-06-22 09:45:43'),
(51, 'HAIR', 'SMOOTHENING/STRAIGHTENING(LOREAL)', 'Male', 2000.00, 0, 'Admin', '2023-06-22 09:46:43'),
(52, 'HAIR', 'SMOOTHENING/STRAIGHTENING(LOREAL)', 'Female', 4500.00, 0, 'Admin', '2023-06-22 09:47:04'),
(53, 'HAIR', 'LOREAL REBONDING', 'Male', 1000.00, 0, 'Admin', '2023-06-22 09:47:33'),
(54, 'HAIR', 'REBONDING', 'Female', 3500.00, 0, 'Admin', '2023-06-22 09:47:55'),
(55, 'HAIR', 'IRONING(ONE TIME)', 'Female', 800.00, 0, 'Admin', '2023-06-22 09:48:40'),
(56, 'HAIR', 'TONG(ONE TIME)', 'Female', 800.00, 0, 'Admin', '2023-06-22 09:49:01'),
(57, 'HAIR', 'CRIMPING(ONE TIME)', 'Female', 800.00, 0, 'Admin', '2023-06-22 09:49:23'),
(58, 'HAIR', 'ONE STREAK', 'Male', 200.00, 0, 'Admin', '2023-06-22 09:49:53'),
(59, 'HAIR', 'ONE STREAK', 'Female', 500.00, 0, 'Admin', '2023-06-22 09:50:15'),
(60, 'HAIR', 'TOUCH UP', 'Female', 1200.00, 0, 'Admin', '2023-06-22 09:50:39'),
(61, 'HAIR', 'TOUCH UP', 'Male', 600.00, 0, 'Admin', '2023-06-22 09:50:56'),
(62, 'HAIR', 'GLOBAL', 'Male', 1200.00, 0, 'Admin', '2023-06-22 09:51:19'),
(63, 'HAIR', 'GLOBAL', 'Female', 2500.00, 0, 'Admin', '2023-06-22 09:51:56'),
(64, 'HAIR', 'GLOBAL HIGHLIGHTS', 'Male', 1000.00, 0, 'Admin', '2023-06-22 09:52:27'),
(65, 'HAIR', 'GLOBAL HIGHLIGHTS', 'Female', 3000.00, 0, 'Admin', '2023-06-22 09:52:43'),
(66, 'HAIR', 'ONE STREAK', 'Male', 300.00, 0, 'Admin', '2023-06-22 09:53:16'),
(67, 'HAIR', 'ONE STREAK', 'Male', 300.00, 0, 'Admin', '2023-06-22 09:53:16'),
(68, 'HAIR', 'ONE STREAK', 'Female', 650.00, 0, 'Admin', '2023-06-22 09:53:32'),
(69, 'HAIR', 'TOUCH UP', 'Male', 650.00, 0, 'Admin', '2023-06-22 09:53:53'),
(70, 'HAIR', 'TOUCH UP', 'Female', 1500.00, 0, 'Admin', '2023-06-22 09:54:08'),
(71, 'HAIR', 'GLOBAL', 'Male', 1200.00, 0, 'Admin', '2023-06-22 09:54:34'),
(72, 'HAIR', 'GLOBAL', 'Female', 3500.00, 0, 'Admin', '2023-06-22 09:55:16'),
(73, 'HAIR', 'GLOBAL HIGHLIGHTS', 'Male', 1400.00, 0, 'Admin', '2023-06-22 09:55:37'),
(74, 'HAIR', 'GLOBAL HIGHLIGHTS', 'Female', 4200.00, 0, 'Admin', '2023-06-22 09:56:14'),
(75, 'HAIR', 'EYE BROW THREADING', 'Female', 30.00, 0, 'Admin', '2023-06-22 09:57:05'),
(76, 'HAIR', 'FORHEAD THREADING', 'Female', 30.00, 0, 'Admin', '2023-06-22 09:57:40'),
(77, 'HAIR', 'UPPER LIPS THREADING', 'Female', 30.00, 0, 'Admin', '2023-06-22 09:58:05'),
(78, 'HAIR', 'CHIN THREADING', 'Female', 30.00, 0, 'Admin', '2023-06-22 09:58:32'),
(79, 'HAIR', 'FULL FACE THREADING', 'Female', 150.00, 0, 'Admin', '2023-06-22 09:59:45'),
(80, 'HAIR', 'EYE BROW WAXING', 'Female', 60.00, 0, 'Admin', '2023-06-22 10:00:27'),
(81, 'HAIR', 'FORHEAD WAXING', 'Female', 60.00, 0, 'Admin', '2023-06-22 10:00:50'),
(82, 'HAIR', 'UPPER LIPS WAXING', 'Female', 60.00, 0, 'Admin', '2023-06-22 10:01:13'),
(83, 'HAIR', 'CHIN WAXING', 'Female', 60.00, 0, 'Admin', '2023-06-22 10:01:51'),
(84, 'HAIR', 'FULL FACE WAXING', 'Female', 500.00, 0, 'Admin', '2023-06-22 10:02:19'),
(85, 'HAIR', 'UNDER ARM WAXING', 'Female', 200.00, 0, 'Admin', '2023-06-22 10:02:45'),
(86, 'HAIR', 'FULL HAND WAXING', 'Female', 500.00, 0, 'Admin', '2023-06-22 10:03:09'),
(87, 'HAIR', 'HALF HAND WAXING', 'Female', 300.00, 0, 'Admin', '2023-06-22 10:03:31'),
(88, 'HAIR', 'FULL LEG WAXING', 'Female', 600.00, 0, 'Admin', '2023-06-22 10:03:57'),
(89, 'HAIR', 'HALF LEG WAXING', 'Female', 450.00, 0, 'Admin', '2023-06-22 10:04:24'),
(90, 'HAIR', 'FULL BODY WAXING', 'Female', 2500.00, 0, 'Admin', '2023-06-22 10:04:50'),
(91, 'HAIR', 'FULL HAND WAXING(RICA)', 'Female', 700.00, 0, 'Admin', '2023-06-22 10:05:51'),
(92, 'HAIR', 'HALF HAND WAXING(RICA)', 'Female', 500.00, 0, 'Admin', '2023-06-22 10:06:37'),
(93, 'HAIR', 'FULL LEG WAXING(RICA)', 'Female', 1000.00, 0, 'Admin', '2023-06-22 10:07:00'),
(94, 'HAIR', 'HALF LEG WAXING(RICA)', 'Female', 1000.00, 0, 'Admin', '2023-06-22 10:07:33'),
(95, 'HAIR', 'FULL BODY WAXING(RICA)', 'Female', 3000.00, 0, 'Admin', '2023-06-22 10:08:15'),
(96, 'HAIR', 'NORMAL PEDICURE', 'Female', 600.00, 0, 'Admin', '2023-06-22 10:09:59'),
(97, 'HAIR', 'NORMAL MANICURE', '', 600.00, 0, 'Admin', '2023-06-22 10:10:26'),
(98, 'HAIR', 'SPA PEDICURE', '', 800.00, 0, 'Admin', '2023-06-22 10:10:58'),
(99, 'HAIR', 'SPA MANICURE', '', 1000.00, 0, 'Admin', '2023-06-22 10:11:33'),
(100, 'HAIR', 'KERATIN MANICURE', '', 700.00, 0, 'Admin', '2023-06-22 10:11:59'),
(101, 'HAIR', 'LOTUS(FACE DETAN PACK)', '', 400.00, 0, 'Admin', '2023-06-22 10:12:56'),
(102, 'HAIR', 'O3+(FACE DETAN PACK)', '', 600.00, 0, 'Admin', '2023-06-22 10:13:51'),
(103, 'HAIR', 'HEAD MESSAGR(60 MINS)', 'Male', 500.00, 0, 'Admin', '2023-06-22 10:16:25'),
(104, 'HAIR', 'HEAD MESSAGR(60 MINS)', 'Female', 500.00, 0, 'Admin', '2023-06-22 10:16:37'),
(105, 'HAIR', 'BODY POLISH', 'Female', 3500.00, 0, 'Admin', '2023-06-22 10:16:57'),
(106, 'HAIR', 'OIL MESSAGE', 'Female', 2000.00, 0, 'Admin', '2023-06-22 10:17:26'),
(108, 'HAIR', 'LOTUS(CLEAN UP)', '', 800.00, 0, 'Admin', '2023-06-22 10:19:11'),
(110, 'HAIR', 'O3+(CLEAN UP)', '', 1500.00, 0, 'Admin', '2023-06-22 10:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(10) NOT NULL COMMENT 'Auto increment id',
  `State` varchar(100) NOT NULL COMMENT 'Name of State',
  `code` varchar(2) NOT NULL COMMENT 'State Code for GST'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `qty` float(20,2) NOT NULL COMMENT 'quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `bno` varchar(100) NOT NULL COMMENT 'Batch no',
  `expdate` date NOT NULL COMMENT 'Exp Date',
  `rate` float(10,2) NOT NULL COMMENT 'rate',
  `srate` float(20,2) NOT NULL COMMENT 'sales rate',
  `gst` int(2) NOT NULL COMMENT 'gst per',
  `status` varchar(100) DEFAULT 'Not Expair'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `category`, `product`, `hsn`, `qty`, `unit`, `bno`, `expdate`, `rate`, `srate`, `gst`, `status`) VALUES
(1, 'Sales', 'demo', '8520', 10.00, 'ML', '8173139', '2023-11-30', 50.00, 60.00, 18, 'Not Expair');

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
  `user` varchar(50) NOT NULL COMMENT 'user name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vname`, `address`, `gstno`, `panno`, `phone`, `state`, `nod`, `user`, `doe`) VALUES
(7, 'ABC PVT LTD', 'Agartala', '16FAMPS4420P1ZO', 'FAMPS4420P', '7005261744', 'Tripura', 7, 'Admin', '2023-11-30 05:52:00'),
(8, 'fdfds', 'dfdsfds', '15fdfdfdfffffff', 'fdfdfdffff', '5263202222', 'Mizoram', 5, 'outlet1', '2023-11-30 06:06:24');

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
  `user` varchar(100) NOT NULL COMMENT 'user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_pay`
--

INSERT INTO `vendor_pay` (`id`, `vname`, `gstno`, `debit`, `credit`, `month`, `user`, `doe`) VALUES
(242, 'CELEBRATION FOOD INDUSTRIES', '16BEDPD6471G1ZO', 0.00, 6103.00, 'November-2023', 'Admin', '2023-11-22 10:44:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cname`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

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
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`oname`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `receipe`
--
ALTER TABLE `receipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requision`
--
ALTER TABLE `requision`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `sinv` (`invno`);

--
-- Indexes for table `sales_master`
--
ALTER TABLE `sales_master`
  ADD PRIMARY KEY (`invno`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
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
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`,`gstno`),
  ADD UNIQUE KEY `panno` (`panno`);

--
-- Indexes for table `vendor_pay`
--
ALTER TABLE `vendor_pay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoinment`
--
ALTER TABLE `appoinment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipe`
--
ALTER TABLE `receipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `requision`
--
ALTER TABLE `requision`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_master`
--
ALTER TABLE `sales_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment id', AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor_pay`
--
ALTER TABLE `vendor_pay`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id', AUTO_INCREMENT=243;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
