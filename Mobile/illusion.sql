-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 05:05 PM
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
-- Database: `illusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL COMMENT 'auto increament id',
  `category` varchar(50) NOT NULL COMMENT 'category',
  `sname` varchar(100) NOT NULL COMMENT 'shop name',
  `user` varchar(50) NOT NULL COMMENT 'name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `sname`, `user`, `doe`) VALUES
(3, 'Mobile', 'Illusion Store', 'admin', '2024-12-04 13:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `cname` text NOT NULL COMMENT 'Customer Name',
  `address` varchar(500) NOT NULL COMMENT 'Customer Address',
  `gstno` varchar(20) NOT NULL COMMENT 'GST No of Client',
  `mobile` varchar(10) NOT NULL COMMENT 'Customer Phone No',
  `wa` varchar(10) NOT NULL COMMENT 'Whats App No',
  `state` varchar(100) NOT NULL COMMENT 'State name',
  `pin` varchar(6) NOT NULL COMMENT 'Pin No',
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of Entry'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8642, 'MI', 'Illusion Store', 'admin', '2024-11-28 14:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `daybook`
--

CREATE TABLE `daybook` (
  `id` int(10) NOT NULL COMMENT 'autoincrement Id',
  `bdate` date NOT NULL COMMENT 'date',
  `sales` float(10,2) NOT NULL COMMENT 'Total Sales',
  `exp` float(10,2) NOT NULL COMMENT 'Expances',
  `tmode` varchar(30) NOT NULL COMMENT 'transaction Mode',
  `tamount` float(10,2) NOT NULL COMMENT 'Transaction Amount'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `invno` varchar(100) NOT NULL COMMENT 'Invoice no',
  `invdate` date NOT NULL COMMENT 'Invoice date ',
  `vname` varchar(100) NOT NULL COMMENT 'vendore name',
  `product` varchar(500) NOT NULL COMMENT 'product name',
  `tpay` float(10,2) NOT NULL COMMENT 'total payment',
  `pmode` varchar(100) NOT NULL COMMENT 'payment mode',
  `bname` varchar(100) NOT NULL COMMENT 'bank name',
  `tid` varchar(100) NOT NULL COMMENT 'transaction id',
  `empname` varchar(100) NOT NULL COMMENT 'employee name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expm`
--

CREATE TABLE `expm` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `des` varchar(20) NOT NULL COMMENT 'Description',
  `nill` float NOT NULL COMMENT 'Nil Rated Supplies',
  `exe` float NOT NULL COMMENT 'Exempted(other than nil rated/non GST supply)',
  `nongst` float NOT NULL COMMENT 'Non-GST Supplies'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hsn`
--

CREATE TABLE `hsn` (
  `id` int(10) NOT NULL COMMENT 'autoincrement id',
  `invno` varchar(20) NOT NULL COMMENT 'Invoice Number',
  `invdate` date NOT NULL COMMENT 'Invoice Date',
  `hsn` int(20) NOT NULL COMMENT 'hsn',
  `des` varchar(50) NOT NULL COMMENT 'Description',
  `uqc` varchar(50) NOT NULL COMMENT 'UQC',
  `tq` float NOT NULL COMMENT 'Total Quantity',
  `tv` float(10,2) NOT NULL COMMENT 'Total Value',
  `taxv` float(10,2) NOT NULL COMMENT 'Taxable Value',
  `itax` float(10,2) NOT NULL COMMENT 'Integrated Tax Amount',
  `ctax` float(10,2) NOT NULL COMMENT 'Central Tax Amount',
  `stax` float NOT NULL COMMENT 'State/UT Tax Amoun',
  `cess` float NOT NULL COMMENT 'Cess Amount'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `to_whom` varchar(100) NOT NULL COMMENT 'To Whom',
  `dop` date NOT NULL COMMENT 'date of purchase and sales',
  `credit` float(10,2) NOT NULL COMMENT 'Credit',
  `debit` float(10,2) NOT NULL COMMENT 'Debit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `location` varchar(100) NOT NULL COMMENT 'Location name',
  `sname` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL COMMENT 'user name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`, `sname`, `user`, `doe`) VALUES
(4, 'Agartala', 'Illusion Store', 'admin', '2024-11-27 11:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `expdate` date NOT NULL DEFAULT '2024-11-25' COMMENT 'Expiry date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`, `type`, `sname`, `expdate`) VALUES
('admin', 'admin@123', 'admin', 'Illusion Store', '2025-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `ostock`
--

CREATE TABLE `ostock` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `pname` text DEFAULT NULL COMMENT 'Product name',
  `ostock` int(10) DEFAULT NULL COMMENT 'Opening stock',
  `prate` float(20,2) DEFAULT NULL COMMENT 'Purchase Rate',
  `srate` float(20,2) DEFAULT NULL COMMENT 'Sales Rate',
  `pqty` int(10) DEFAULT NULL COMMENT 'Purchase Quantity',
  `sqty` int(10) DEFAULT NULL COMMENT 'Sales Quantity',
  `cstock` int(10) DEFAULT NULL COMMENT 'Closing Stock',
  `doe` date DEFAULT NULL COMMENT 'Date of Entry',
  `hsn` varchar(15) DEFAULT NULL COMMENT 'HSN Code'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outstanding`
--

CREATE TABLE `outstanding` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `vname` varchar(100) NOT NULL COMMENT 'Vendore name',
  `amount` float(10,2) NOT NULL COMMENT 'Total Amount',
  `recv` float(10,2) NOT NULL COMMENT 'Received Amount',
  `pamt` float(10,2) NOT NULL COMMENT 'Pending amount',
  `tmode` varchar(100) NOT NULL COMMENT 'Transaction Mode',
  `tid` varchar(100) NOT NULL COMMENT 'Transaction id',
  `bname` varchar(100) NOT NULL COMMENT 'Bank name',
  `rdate` date NOT NULL COMMENT 'Received Date',
  `user` varchar(100) NOT NULL COMMENT 'Name of Entry user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `pinv` varchar(100) NOT NULL,
  `pname` varchar(500) NOT NULL COMMENT 'Product name',
  `imeno` varchar(100) DEFAULT NULL COMMENT 'ime no',
  `chargerno` varchar(100) NOT NULL COMMENT 'charger no',
  `price` float(10,2) NOT NULL COMMENT 'Purchase Rate',
  `sname` varchar(100) NOT NULL COMMENT 'shop name',
  `status` varchar(100) NOT NULL DEFAULT 'Not Sales' COMMENT 'status',
  `sdate` date DEFAULT NULL COMMENT 'sales date',
  `user` varchar(100) DEFAULT NULL COMMENT 'sales man name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pinv`, `pname`, `imeno`, `chargerno`, `price`, `sname`, `status`, `sdate`, `user`) VALUES
(1, '12345', 'abc', '12345', 'NA', 2000.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(2, '12345', 'abc', '54321', 'NA', 2000.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(4, '987456321', 'xyz', '32145', 'NA', 5000.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(7, '2345852', 'xyz', '85228963', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(8, '2345852', 'xyz', '7676575676', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(9, '2345852', 'xyz', '4345454', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(10, '2345852', 'xyz', '74125', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(14, '85236', 'abcd', '4520', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(15, '85236', 'abcd', '4520', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(16, '85236', 'abcd', '85230', 'NA', 500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(20, '123456', 'xyz', '65656565454', 'NA', 2500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(21, '123456', 'xyz', '45445646546', 'NA', 2500.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(25, '1212', 'asjh', '5465456465', 'NA', 250.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(26, '1212', 'asjh', '5446151615', 'NA', 250.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(30, '545455', 'ssss', '5454544545', 'NA', 300.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(31, '545455', 'ssss', '45454545', 'NA', 300.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(35, '52630', 'acbcj', '65412', 'NA', 50.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(36, '52630', 'acbcj', '69320', 'NA', 50.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(40, '5454555', 'shgdhgs', '2454545', 'NA', 600.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(42, '5454555', 'shgdhgs', '5454545', 'NA', 600.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(46, '5454555', 'hdgsd', '98989898', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(56, '5454555', 'asdas', '52222', 'NA', 45.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(57, '5454555', 'asdas', '522255', 'NA', 45.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(58, '5454555', 'asdas', '52230', 'NA', 45.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(59, '5454555', 'asdas', '', 'NA', 45.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(60, '5454555', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(61, '5454555', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(62, '21332', 'abc', '5454545454', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(63, '21332', 'abc', '8787878787', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(64, '21332', 'abc', '45454545', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(65, '21332', 'abc', '', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(66, '21332', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(67, '21332', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(68, '21332', 'abc', '5454545454', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(69, '21332', 'abc', '54545', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(70, '21332', 'abc', '', 'NA', 20.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(71, '21332', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin'),
(72, '21332', '', '', 'NA', 0.00, 'Illusion Store', 'Not Sales', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL,
  `brname` varchar(100) NOT NULL COMMENT 'Brand Name',
  `pinv` varchar(50) NOT NULL COMMENT 'Purchase Invoice No',
  `category` varchar(100) NOT NULL COMMENT 'category name',
  `product` varchar(500) DEFAULT NULL,
  `hsn` varchar(50) DEFAULT NULL,
  `qty` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `rate` varchar(20) DEFAULT NULL,
  `srate` float(10,2) NOT NULL,
  `mrp` varchar(20) DEFAULT NULL,
  `discper` varchar(20) DEFAULT NULL,
  `discamt` float(10,2) DEFAULT NULL,
  `tax` varchar(20) DEFAULT NULL,
  `gstper` varchar(20) DEFAULT NULL,
  `cgst` varchar(10) DEFAULT NULL COMMENT 'CGST Percentage',
  `cgstp` float(10,2) DEFAULT NULL,
  `sgst` varchar(10) DEFAULT NULL,
  `sgstp` float(10,2) DEFAULT NULL,
  `igst` varchar(10) DEFAULT NULL,
  `igstp` float(10,2) DEFAULT NULL,
  `gstamt` float(10,2) DEFAULT NULL,
  `total` float(10,2) DEFAULT NULL,
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `fy`, `brname`, `pinv`, `category`, `product`, `hsn`, `qty`, `unit`, `rate`, `srate`, `mrp`, `discper`, `discamt`, `tax`, `gstper`, `cgst`, `cgstp`, `sgst`, `sgstp`, `igst`, `igstp`, `gstamt`, `total`, `sname`, `user`, `doe`) VALUES
(8, '', '', '21332', '', '', '', '', 'PC', '', 0.00, '', '', 0.00, '', '18', '', 0.00, '', 0.00, '', 0.00, 0.00, 0.00, 'Illusion Store', 'admin', '2024-12-06 15:43:05'),
(9, '', 'MI', '21332', 'Mobile', 'abc', '5654', '9', 'PC', '20', 50.00, '60', '2', 3.60, '176.40', '12', '6.00', 10.58, '6.00', 10.58, '0', 0.00, 21.17, 197.57, 'Illusion Store', 'admin', '2024-12-06 15:43:55');

--
-- Triggers `purchase`
--
DELIMITER $$
CREATE TRIGGER `stock_insert` AFTER INSERT ON `purchase` FOR EACH ROW BEGIN
    DECLARE product_count INT;

    -- Check if NEW.product is provided
    IF NEW.product IS NOT NULL THEN
        -- Check for existing product and sname combination
        SELECT COUNT(*) INTO product_count 
        FROM stock 
        WHERE product = NEW.product AND sname = NEW.sname;

        IF product_count > 0 THEN
            -- Update existing record if found
            UPDATE stock
            SET qty = qty + NEW.qty, 
                rate = NEW.rate, 
                srate = NEW.srate
            WHERE product = NEW.product AND sname = NEW.sname;
        ELSE
            -- Insert new record if no match is found
            INSERT INTO stock (bname, category, product, hsn, qty, unit, rate, srate, mrp, gst, sname)
            VALUES (NEW.brname, NEW.category, NEW.product, NEW.hsn, NEW.qty, NEW.unit, NEW.rate, NEW.srate, NEW.mrp, NEW.gstper, NEW.sname);
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
  `cgsta` float(10,2) DEFAULT NULL COMMENT 'CGST Amount',
  `sgsta` float(10,2) DEFAULT NULL COMMENT 'SGST Amount',
  `igsta` float(10,2) DEFAULT NULL COMMENT 'IGST Amount',
  `total` float(10,2) DEFAULT NULL COMMENT 'Total Price',
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'User name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of Entry'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `fy`, `pinv`, `invdate`, `vendore`, `gstno`, `state`, `tax`, `cgsta`, `sgsta`, `igsta`, `total`, `sname`, `user`, `doe`) VALUES
(12, '24-25', '21332', '2024-12-06', 'Mun Hks AGs', '16Bmppd7363f', 'Tripura', NULL, NULL, NULL, NULL, NULL, 'Illusion Store', 'admin', '2024-12-06 15:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `role` varchar(100) NOT NULL COMMENT 'Role Entry section',
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Registration date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `sname`, `user`, `regdate`) VALUES
(5, 'Admin', 'Illusion Store', 'admin', '2024-11-27 10:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(10) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Invoice Date',
  `imeno` varchar(100) NOT NULL COMMENT 'IMEI No',
  `product` varchar(500) NOT NULL COMMENT 'Product Name',
  `category` varchar(100) NOT NULL COMMENT 'Category name',
  `chno` varchar(100) NOT NULL COMMENT 'Charger no',
  `hsn` varchar(50) NOT NULL COMMENT 'Product HSN No',
  `qty` varchar(20) NOT NULL COMMENT 'Product Quantity',
  `rate` varchar(20) NOT NULL COMMENT 'Rate of the Product',
  `mrp` float(10,2) NOT NULL COMMENT 'Product MRP',
  `discamt` float(10,2) NOT NULL COMMENT 'Discount',
  `tax` float(10,2) NOT NULL COMMENT 'Tax of the Product',
  `gstper` varchar(20) NOT NULL COMMENT 'GST Percentage',
  `cgst` float(10,2) NOT NULL COMMENT 'CGST Percentage',
  `cgstp` float(10,2) NOT NULL COMMENT 'CGST Amount',
  `sgst` float(10,2) NOT NULL COMMENT 'SGST Percentage',
  `sgstp` float(10,2) NOT NULL COMMENT 'SGST Amount',
  `igst` float(10,2) NOT NULL COMMENT 'IGST Percentage',
  `igstp` float(10,2) NOT NULL COMMENT 'IGST Amount',
  `gstamt` float(10,2) NOT NULL COMMENT 'GST Amount ',
  `total` int(10) NOT NULL COMMENT 'Total Price'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_main`
--

CREATE TABLE `sales_main` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(10) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Invoice Date',
  `imeno` varchar(100) NOT NULL COMMENT 'IMEI No',
  `product` varchar(500) NOT NULL COMMENT 'Product Name',
  `category` varchar(100) NOT NULL COMMENT 'Category name',
  `chno` varchar(100) NOT NULL COMMENT 'Charger no',
  `hsn` varchar(50) NOT NULL COMMENT 'Product HSN No',
  `qty` varchar(20) NOT NULL COMMENT 'Product Quantity',
  `rate` varchar(20) NOT NULL COMMENT 'Rate of the Product',
  `mrp` float(10,2) NOT NULL COMMENT 'Product MRP',
  `discamt` float(10,2) NOT NULL COMMENT 'Discount',
  `tax` float(10,2) NOT NULL COMMENT 'Tax of the Product',
  `gstper` varchar(20) NOT NULL COMMENT 'GST Percentage',
  `cgst` float(10,2) NOT NULL COMMENT 'CGST Percentage',
  `cgstp` float(10,2) NOT NULL COMMENT 'CGST Amount',
  `sgst` float(10,2) NOT NULL COMMENT 'SGST Percentage',
  `sgstp` float(10,2) NOT NULL COMMENT 'SGST Amount',
  `igst` float(10,2) NOT NULL COMMENT 'IGST Percentage',
  `igstp` float(10,2) NOT NULL COMMENT 'IGST Amount',
  `gstamt` float(10,2) NOT NULL COMMENT 'GST Amount ',
  `total` int(10) NOT NULL COMMENT 'Total Price'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE `sales_master` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Sales invoice Date',
  `client` varchar(100) NOT NULL COMMENT 'client Name',
  `ph` varchar(10) NOT NULL COMMENT 'Mobile No',
  `address` text NOT NULL COMMENT 'Address of customer',
  `gstno` varchar(30) NOT NULL COMMENT 'GST No of Client',
  `state` varchar(100) NOT NULL COMMENT 'State name',
  `tax` varchar(15) NOT NULL COMMENT 'Tax Pay',
  `cgsta` varchar(15) NOT NULL COMMENT 'CGST Amount',
  `sgsta` varchar(15) NOT NULL COMMENT 'SGST Amount',
  `igsta` varchar(15) NOT NULL COMMENT 'IGST Amount',
  `total` varchar(15) NOT NULL COMMENT 'Total Price',
  `tmode` varchar(50) NOT NULL COMMENT 'Transaction Mode',
  `bname` varchar(100) NOT NULL COMMENT 'Name of Bank',
  `tid` varchar(100) NOT NULL COMMENT 'Transaction id',
  `user` varchar(100) NOT NULL COMMENT 'Name of User',
  `uname` varchar(100) NOT NULL COMMENT 'Name of User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_master_main`
--

CREATE TABLE `sales_master_main` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `fy` varchar(100) NOT NULL COMMENT 'Financial Year',
  `sinv` varchar(50) NOT NULL COMMENT 'Sales Invoice No',
  `invdate` date NOT NULL COMMENT 'Sales invoice Date',
  `client` varchar(100) NOT NULL COMMENT 'client Name',
  `ph` varchar(10) NOT NULL COMMENT 'Mobile No',
  `gstno` varchar(30) NOT NULL COMMENT 'GST No of Client',
  `state` varchar(100) NOT NULL COMMENT 'State name',
  `tax` varchar(15) NOT NULL COMMENT 'Tax Pay',
  `cgsta` varchar(15) NOT NULL COMMENT 'CGST Amount',
  `sgsta` varchar(15) NOT NULL COMMENT 'SGST Amount',
  `igsta` varchar(15) NOT NULL COMMENT 'IGST Amount',
  `total` varchar(15) NOT NULL COMMENT 'Total Price',
  `tmode` varchar(50) NOT NULL COMMENT 'Transaction Mode',
  `bname` varchar(100) NOT NULL COMMENT 'Name of Bank',
  `tid` varchar(100) NOT NULL COMMENT 'Transaction id',
  `user` varchar(100) NOT NULL COMMENT 'Name of User',
  `uname` varchar(100) NOT NULL COMMENT 'Name of User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `bname` varchar(100) NOT NULL COMMENT 'Brand Name',
  `category` varchar(100) NOT NULL COMMENT 'Category',
  `product` varchar(500) NOT NULL COMMENT 'Product name',
  `hsn` varchar(30) NOT NULL COMMENT 'HSN Code',
  `qty` int(3) NOT NULL COMMENT 'quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `rate` float(10,2) NOT NULL COMMENT 'rate',
  `srate` int(10) NOT NULL COMMENT 'Sale rate',
  `mrp` float(10,2) NOT NULL COMMENT 'MRP',
  `gst` int(2) NOT NULL COMMENT 'gst per',
  `sname` varchar(100) NOT NULL COMMENT 'Shop name',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `bname`, `category`, `product`, `hsn`, `qty`, `unit`, `rate`, `srate`, `mrp`, `gst`, `sname`, `doe`) VALUES
(2, 'MI', 'Mobile', 'abc', '5654', 9, 'PC', 20.00, 50, 60.00, 12, 'Illusion Store', '2024-12-06 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock1`
--

CREATE TABLE `stock1` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `bname` varchar(100) NOT NULL COMMENT 'Brand Name',
  `category` varchar(100) NOT NULL COMMENT 'Category',
  `product` varchar(500) NOT NULL COMMENT 'Product name',
  `hsn` varchar(30) NOT NULL COMMENT 'HSN Code',
  `qty` int(3) NOT NULL COMMENT 'quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `rate` float(10,2) NOT NULL COMMENT 'rate',
  `srate` int(10) NOT NULL COMMENT 'Sale rate',
  `mrp` float(10,2) NOT NULL COMMENT 'MRP',
  `gst` int(2) NOT NULL COMMENT 'gst per'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stockold`
--

CREATE TABLE `stockold` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `bname` varchar(100) NOT NULL COMMENT 'Brand Name',
  `category` varchar(100) NOT NULL COMMENT 'Category',
  `product` varchar(500) NOT NULL COMMENT 'Product name',
  `hsn` varchar(30) NOT NULL COMMENT 'HSN Code',
  `qty` int(3) NOT NULL COMMENT 'quantity',
  `unit` varchar(10) NOT NULL COMMENT 'unit',
  `rate` float(10,2) NOT NULL COMMENT 'rate',
  `srate` int(10) NOT NULL COMMENT 'Sale rate',
  `mrp` float(10,2) NOT NULL COMMENT 'MRP',
  `gst` int(2) NOT NULL COMMENT 'gst per'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockold`
--

INSERT INTO `stockold` (`id`, `bname`, `category`, `product`, `hsn`, `qty`, `unit`, `rate`, `srate`, `mrp`, `gst`) VALUES
(1, 'Mi', 'Accessories', '10000mAh Mi Power Bank 2i Black', '8507', 0, 'pcs', 680.95, 899, 1199.00, 18),
(2, 'Mi', 'Accessories', '10000mAh Mi Power Bank 2i Blue', '85076000', 1, 'pcs', 756.70, 899, 1199.00, 18),
(3, 'Mi', 'Accessories', '10000mAh Mi Power Bank 2i Red', '8507', 0, 'pcs', 680.96, 899, 1199.00, 18),
(4, 'Mi', 'Accessories', '20000mAh Mi Power Bank 2i Black', '85076000', 0, 'pcs', 1135.43, 1599, 1999.00, 18),
(5, 'Mi', 'Accessories', '20000mAh Mi Power Bank 2i White', '8507', 0, 'pcs', 1135.00, 1499, 1999.00, 18),
(6, 'Mi', 'Accessories', 'India Standard Adapter 9V 2A Black', '8504', 3, 'pcs', 336.98, 449, 599.00, 18),
(7, 'Mi', 'Accessories', 'Indian Standard Adapter 5V-2A Black', '8504', 1, 'pcs', 260.86, 349, 499.00, 18),
(8, 'Mi', 'Mobiles', 'Mi 10 Coral Green (8GB+128GB)', '8517', 0, 'pcs', 40576.61, 50999, 54999.00, 18),
(9, 'Mi', 'Mobiles', 'Mi 10 Twilight Grey (8GB+128GB)', '8517', 0, 'pcs', 40576.61, 50999, 54999.00, 18),
(10, 'Mi', 'Accessories', 'Mi 27W Superfast Charger', '85044030', 1, 'pcs', 746.71, 999, 1099.00, 18),
(11, 'Mi', 'Accessories', 'Mi 2A Fast Charger with Cable', '85044030', 33, 'pcs', 336.98, 449, 599.00, 18),
(12, 'Mi', 'Accessories', 'Mi 2-in-1 USB Cable 100cm', '8544', 0, 'pcs', 186.12, 249, 399.00, 18),
(13, 'Mi', 'Accessories', 'Mi 2-in-1 USB Cable 100cm (Black)', '8544', 5, 'pcs', 186.88, 249, 399.00, 18),
(14, 'Mi', 'Accessories', 'Mi 2-in-1 USB Cable 30cm', '85444999', 8, 'pcs', 134.34, 179, 299.00, 18),
(15, 'Mi', 'Mobiles', 'Mi A2 Black (4Gb+64Gb)', '8517', 0, 'pcs', 13644.87, 11999, 17499.00, 12),
(16, 'Mi', 'Mobiles', 'Mi A2 Black (6Gb+128Gb)', '85171290', 0, 'pcs', 13484.87, 15999, 20500.00, 12),
(17, 'Mi', 'Mobiles', 'Mi A2 Gold (4Gb+64Gb)', '8517', 0, 'pcs', 13644.87, 11999, 17499.00, 12),
(18, 'Mi', 'Mobiles', 'Mi A2 Lake Blue (4Gb+64Gb)', '8517', 0, 'pcs', 13644.87, 11999, 17499.00, 12),
(19, 'Mi', 'Mobiles', 'Mi A2 Red (4Gb+64Gb)', '8517', 0, 'pcs', 11799.16, 11999, 17499.00, 12),
(20, 'Mi', 'Mobiles', 'Mi A2 Red (6GB+128Gb)', '85171290', 0, 'pcs', 13484.88, 15999, 20500.00, 12),
(21, 'Mi', 'Mobiles', 'Mi A2 Rose Gold (4Gb+64Gb)', '8517', 0, 'pcs', 11799.16, 11999, 17499.00, 12),
(22, 'Mi', 'Mobiles', 'Mi A3 Kind Of Grey (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12999, 14999.00, 18),
(23, 'Mi', 'Mobiles', 'Mi A3 Kind Of Grey (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 14999, 17499.00, 18),
(24, 'Mi', 'Mobiles', 'Mi A3 More Than White (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12999, 14999.00, 18),
(25, 'Mi', 'Mobiles', 'Mi A3 More Than White (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 14999, 17499.00, 18),
(26, 'Mi', 'Mobiles', 'Mi A3 Not Just Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12999, 14999.00, 18),
(27, 'Mi', 'Mobiles', 'Mi A3 Not Just Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 14999, 17499.00, 18),
(28, 'Mi', 'Accessories', 'Mi Air Purifier 2s', '84213920', 0, 'pcs', 6816.36, 8999, 12999.00, 18),
(29, 'Mi', 'Accessories', 'Mi AirPOP PM2.5 Anti-Pollution Mask(Pack of 2)', '63079090', 20, 'pcs', 213.43, 249, 349.00, 5),
(30, 'Mi', 'Accessories', 'Mi Band 3', '8517', 0, 'pcs', 1514.16, 1999, 2299.00, 18),
(31, 'Mi', 'Accessories', 'Mi Band 3 Charging Cable', '85444299', 0, 'pcs', 111.37, 149, 199.00, 18),
(32, 'Mi', 'Accessories', 'Mi Band 3 Strap Black', '40169990', 0, 'pcs', 186.12, 249, 349.00, 18),
(33, 'Mi', 'Accessories', 'Mi Band 3 Strap Blue', '40169990', 0, 'pcs', 186.12, 249, 349.00, 18),
(34, 'Mi', 'Accessories', 'Mi Band 3 Strap Orange', '40169990', 0, 'pcs', 186.12, 249, 349.00, 18),
(35, 'Mi', 'Accessories', 'Mi Band 3 Strap Red', '40169990', 1, 'pcs', 186.12, 249, 349.00, 18),
(36, 'Mi', 'Accessories', 'Mi Band HRX Edition (Black)', '8517', 0, 'pcs', 983.90, 1299, 1799.00, 18),
(37, 'Mi', 'Accessories', 'Mi Beard Trimmer', '85102000', 15, 'pcs', 1049.95, 1499, 1799.00, 18),
(38, 'Mi', 'Accessories', 'Mi Bluetooth Speaker Basic 2', '85182900', 1, 'pcs', 1344.68, 1799, 2699.00, 18),
(39, 'Mi', 'Accessories', 'Mi Blutooth Headset Basic Black', '8518', 0, 'pcs', 672.00, 899, 999.00, 18),
(40, 'Mi', 'Accessories', 'Mi Body Composition Scale', '8423', 0, 'pcs', 1554.00, 1999, 2999.00, 18),
(41, 'Mi', 'Accessories', 'Mi Box 4K', '85255090', 0, 'pcs', 2713.95, 3999, 4999.00, 18),
(42, 'Mi', 'Accessories', 'Mi Braided USB Type-C Cable Black', '85444999', 6, 'pcs', 224.40, 299, 399.00, 18),
(43, 'Mi', 'Accessories', 'Mi Braided USB Type-C Cable Red', '85444999', 8, 'pcs', 224.40, 299, 399.00, 18),
(44, 'Mi', 'Accessories', 'Mi Business Backpack', '4202', 0, 'pcs', 984.00, 1299, 1799.00, 18),
(45, 'Mi', 'Accessories', 'Mi Business Casual Backpack', '42021250', 2, 'pcs', 756.70, 999, 1999.00, 18),
(46, 'Mi', 'Accessories', 'Mi Car Charger', '8504', 1, 'pcs', 522.24, 699, 999.00, 18),
(47, 'Mi', 'Accessories', 'Mi Car Charger Basic', '85044090', 1, 'pcs', 335.61, 449, 599.00, 18),
(48, 'Mi', 'Accessories', 'Mi Casual Backpack Black', '42021250', 0, 'pcs', 680.95, 899, 999.00, 18),
(49, 'Mi', 'Accessories', 'Mi Casual Backpack Blue', '42021250', 0, 'pcs', 680.95, 899, 999.00, 18),
(50, 'Mi', 'Accessories', 'Mi City Backpack (Dark Gery)', '42021250', 4, 'pcs', 1217.28, 1599, 1799.00, 18),
(51, 'Mi', 'Accessories', 'Mi Compact Bluetooth Speaker 2', '818', 2, 'pcs', 597.22, 799, 899.00, 18),
(52, 'Mi', 'Accessories', 'Mi Dual Driver In-Ear Earphones Black', '85183000', 34, 'pcs', 599.65, 799, 999.00, 18),
(53, 'Mi', 'Accessories', 'Mi Dual Driver In-Ear Earphones Blue', '85183000', 33, 'pcs', 599.65, 799, 999.00, 18),
(54, 'Mi', 'Accessories', 'MI Earphones (Black)', '8518', 1, 'pcs', 522.47, 699, 999.00, 18),
(55, 'Mi', 'Accessories', 'Mi Earphones (Silver)', '8518', 0, 'pcs', 522.47, 699, 999.00, 18),
(56, 'Mi', 'Accessories', 'MI Earphones Basic (Black)', '8518', 29, 'pcs', 321.97, 429, 599.00, 18),
(57, 'Mi', 'Accessories', 'Mi Earphones Basic (Blue)', '85183000', 33, 'pcs', 321.97, 429, 599.00, 18),
(58, 'Mi', 'Accessories', 'Mi Earphones Basic (Red)', '8518', 1, 'pcs', 298.24, 399, 599.00, 18),
(59, 'Mi', 'Accessories', 'Mi Flex Phone Grip and Stand Black', '39269099', 0, 'pcs', 111.82, 149, 199.00, 18),
(60, 'Mi', 'Accessories', 'Mi Flex Phone Grip and Stand Blue', '39269099', 2, 'pcs', 111.82, 149, 199.00, 18),
(61, 'Mi', 'Accessories', 'Mi Flex Phone Grip and Stand Red', '39269099', 4, 'pcs', 111.82, 149, 199.00, 18),
(62, 'Mi', 'Accessories', 'MI Home Security Camera 360 (1080)', '8525', 6, 'pcs', 2283.07, 2999, 3999.00, 18),
(63, 'Mi', 'Accessories', 'Mi Home Security Camera Basic 1080P', '85183000', 1, 'pcs', 1554.14, 1999, 2299.00, 18),
(64, 'Mi', 'Accessories', 'Mi LED Light Prime (Blue)', '94054090', 0, 'pcs', 157.78, 199, 249.00, 12),
(65, 'Mi', 'Accessories', 'Mi LED Light Prime (White)', '94054090', 0, 'pcs', 157.78, 199, 249.00, 12),
(66, 'Mi', 'TV', 'Mi LED TV 4A Pro 108cm (43)', '8528', 0, 'pcs', 19598.00, 25999, 25999.00, 28),
(67, 'Mi', 'TV', 'MI LED TV 4A PRO 80cm (32)', '85287215', 2, 'pcs', 13918.00, 16999, 19999.00, 18),
(68, 'Mi', 'TV', 'Mi LED TV 4X Pro 138.8cm (55)', '8528', 0, 'pcs', 27648.01, 40999, 49999.00, 28),
(69, 'Mi', 'Accessories', 'Mi LED Wi-Fi Smart Bulb (White and Color)', '85395000', 1, 'pcs', 1029.92, 1299, 1499.00, 12),
(70, 'Mi', 'Accessories', 'Mi Luggage 20(49 cm) Blue', '42021290', 0, 'pcs', 2271.62, 2999, 3499.00, 18),
(71, 'Mi', 'Accessories', 'Mi Luggage 20(49 cm) Gray', '4021290', 0, 'pcs', 2271.62, 2999, 3499.00, 18),
(72, 'Mi', 'Accessories', 'Mi Luggage 20(49 cm) Red', '42021290', 0, 'pcs', 2271.62, 2999, 3499.00, 18),
(73, 'Mi', 'Accessories', 'Mi Luggage 24(61 cm) Blue', '42021290', 0, 'pcs', 3256.31, 4299, 4799.00, 18),
(74, 'Mi', 'Accessories', 'Mi Luggage 24(61 cm) Gray', '42021290', 1, 'pcs', 3256.31, 4299, 4799.00, 18),
(75, 'Mi', 'Accessories', 'Mi Micro USB Braided Kevlar Cable 100cm Black', '85444299', 2, 'pcs', 186.88, 249, 299.00, 18),
(76, 'Mi', 'Accessories', 'Mi Micro USB Braided Kevlar Cable 100cm Red', '85444299', 0, 'pcs', 186.88, 249, 299.00, 18),
(77, 'Mi', 'Accessories', 'Mi Motion - Activated Night Light 2', '85131090', 3, 'pcs', 450.00, 599, 699.00, 18),
(78, 'Mi', 'Accessories', 'Mi Neckband Bluetooth Earphones', '85183000', 4, 'pcs', 1195.18, 1599, 1999.00, 18),
(79, 'Mi', 'Laptop', 'Mi NoteBook 14 I5/8G/256G/UHD/Silver', '84713010', 0, 'pcs', 35707.00, 44999, 49999.00, 18),
(80, 'Mi', 'Laptop', 'Mi NoteBook 14 I5/8G/512G/MX250/Silver', '84713010', 0, 'pcs', 40577.00, 50999, 54999.00, 18),
(81, 'Mi', 'Laptop', 'Mi NoteBook 14 I5/8G/512G/UHD/Silver', '84713010', 0, 'pcs', 38142.00, 47999, 52999.00, 18),
(82, 'Mi', 'Laptop', 'Mi NoteBook Horizon 14 I5/8G/512G/MX350/Grey', '84713010', 0, 'pcs', 44634.00, 55999, 59999.00, 18),
(83, 'Mi', 'Accessories', 'Mi Pocket Speaker 2 (Black)', '8518', 1, 'pcs', 1135.43, 1499, 1499.00, 18),
(84, 'Mi', 'Accessories', 'Mi Polarized Pilot Sunglasses Blue', '90041000', 4, 'pcs', 836.68, 1199, 1199.00, 18),
(85, 'Mi', 'Accessories', 'Mi Polarized Pilot Sunglasses Green', '90041000', 1, 'pcs', 836.68, 1099, 1199.00, 18),
(86, 'Mi', 'Accessories', 'Mi Polarized Square Sunglasses Blue', '90041000', 3, 'pcs', 684.39, 899, 999.00, 18),
(87, 'Mi', 'Accessories', 'Mi Polarized Square Sunglasses Grey', '90041000', 1, 'pcs', 684.39, 899, 999.00, 18),
(88, 'Mi', 'Accessories', 'Mi Protective Glass (Redmi Note 8 Pro)', '70072900', 0, 'pcs', 299.00, 399, 599.00, 18),
(89, 'Mi', 'Accessories', 'Mi Protective Glass (Redmi Note 8)', '70072900', 8, 'pcs', 299.00, 399, 599.00, 18),
(90, 'Mi', 'Accessories', 'Mi Rechargeable LED Lamp', '85131090', 2, 'pcs', 1125.00, 1499, 1799.00, 18),
(91, 'Mi', 'Accessories', 'Mi Rollerball Pen', '9608', 1, 'pcs', 142.70, 179, 299.00, 12),
(92, 'Mi', 'Accessories', 'MI Router 3C (White)', '5817', 0, 'pcs', 756.70, 999, 1199.00, 18),
(93, 'Mi', 'Accessories', 'Mi Router 4C', '85176290', 4, 'pcs', 836.64, 999, 1199.00, 18),
(94, 'Mi', 'Accessories', 'MI Selfie Stick (Black)', '9620', 1, 'pcs', 522.47, 799, 999.00, 18),
(95, 'Mi', 'Accessories', 'Mi Selfie Stick Tripod (With Bluetooth remote) Black', '96200000', 6, 'pcs', 824.80, 1199, 3299.00, 18),
(96, 'Mi', 'Accessories', 'Mi Smart Band 3i', '85176290', 0, 'pcs', 983.94, 1299, 1599.00, 18),
(97, 'Mi', 'Accessories', 'Mi Smart Band 3i Charging Cable', '8544420', 6, 'pcs', 97.00, 129, 199.00, 18),
(98, 'Mi', 'Accessories', 'Mi Smart Band 4', '85176290', 14, 'pcs', 1750.17, 2299, 2499.00, 18),
(99, 'Mi', 'Accessories', 'Mi Smart Band 4 Charging Cable', '85444220', 3, 'pcs', 149.00, 199, 299.00, 18),
(100, 'Mi', 'Accessories', 'Mi Smart Band 4 Strap Black', '39269099', 0, 'pcs', 187.00, 249, 349.00, 18),
(101, 'Mi', 'Accessories', 'Mi Smart Band 4 Strap Orange', '39269099', 0, 'pcs', 187.00, 249, 349.00, 18),
(102, 'Mi', 'Accessories', 'Mi Smart Band 4 Strap Red', '39269099', 0, 'pcs', 186.88, 249, 349.00, 18),
(103, 'Mi', 'Accessories', 'Mi Smart Water Purifier(RO+UV)', '84219900', 7, 'pcs', 9609.00, 12999, 14999.00, 18),
(104, 'Mi', 'Accessories', 'Mi Soundbar', '85182200', 0, 'pcs', 4109.35, 4999, 5999.00, 18),
(105, 'Mi', 'Accessories', 'Mi Sports Bluetooth Earphones Basic Black', '85183000', 2, 'pcs', 974.90, 1299, 1799.00, 18),
(106, 'Mi', 'Accessories', 'Mi Sports Bluetooth Earphones Basic White', '85183000', 2, 'pcs', 1120.44, 1299, 1799.00, 18),
(107, 'Mi', 'Accessories', 'Mi Step Out Backpack Dark Blue', '42021250', 5, 'pcs', 227.62, 299, 499.00, 18),
(108, 'Mi', 'Accessories', 'Mi Step Out Backpack Red', '42021250', 2, 'pcs', 227.62, 299, 499.00, 18),
(109, 'Mi', 'Accessories', 'Mi Step Out Backpack Royal Blue', '42021250', 0, 'pcs', 227.62, 299, 499.00, 18),
(110, 'Mi', 'Accessories', 'Mi Super Bass Wireless Headphones Gold', '85176290', 0, 'pcs', 1350.00, 1799, 2199.00, 18),
(111, 'Mi', 'Accessories', 'Mi Super Bass Wireless Headphones Red', '85183000', 1, 'pcs', 1344.68, 1799, 2199.00, 18),
(112, 'Mi', 'Accessories', 'Mi TDS Tester', '90278090', 1, 'pcs', 262.00, 349, 499.00, 18),
(113, 'Mi', 'Accessories', 'Mi Travel Backpack Blue', '42021250', 3, 'pcs', 1514.16, 1999, 2199.00, 18),
(114, 'Mi', 'Accessories', 'Mi True Wireless Earphone 2', '85176290', 2, 'pcs', 3376.51, 3999, 5499.00, 18),
(115, 'Mi', 'TV', 'Mi TV 32 inch Pro 4C', '8528', 0, 'pcs', 11020.01, 12999, 14999.00, 18),
(116, 'Mi', 'TV', 'Mi TV 4A 100cm (40)', '85287216', 0, 'pcs', 17336.28, 23999, 24999.00, 28),
(117, 'Mi', 'TV', 'Mi TV 4A 108cm (43) Horizon Edition', '85287217', 0, 'pcs', 20351.00, 26999, 29999.00, 28),
(118, 'Mi', 'TV', 'MI TV 4A 32 (80cm)', '8528', 0, 'pcs', 10168.68, 12999, 15999.00, 18),
(119, 'Mi', 'TV', 'Mi TV 4A 43 (108cm)', '8528', 0, 'pcs', 17249.22, 22999, 25999.00, 28),
(120, 'Mi', 'TV', 'Mi TV 4A 49 Pro (123.2 cm)', '8528', 0, 'pcs', 23249.55, 30999, 32999.00, 28),
(121, 'Mi', 'TV', 'Mi TV 4X 108 cm (43)', '85287217', 1, 'pcs', 22613.00, 29999, 34999.00, 28),
(122, 'Mi', 'TV', 'Mi TV 4X 125.7 cm (50)', '85287217', 0, 'pcs', 26382.00, 34999, 41999.00, 28),
(123, 'Mi', 'TV', 'Mi TV 4X 138.8 cm (55)', '85287217', 0, 'pcs', 33920.00, 44999, 49999.00, 28),
(124, 'Mi', 'TV', 'Mi TV 4X 163.9 cm (65)', '85287217', 0, 'pcs', 41457.38, 55999, 64999.00, 28),
(125, 'Mi', 'Accessories', 'Mi TV Stick', '85255090', 0, 'pcs', 2171.01, 2999, 3499.00, 18),
(126, 'Mi', 'Accessories', 'Mi USB Cable 120cm Black', '8544', 26, 'pcs', 149.35, 199, 299.00, 18),
(127, 'Mi', 'Accessories', 'Mi USB IR Accessory (India Local)', '85177090', 2, 'pcs', 151.00, 249, 299.00, 18),
(128, 'Mi', 'Accessories', 'Mi USB Type-C Cable', '85444999', 1, 'pcs', 149.35, 199, 299.00, 18),
(129, 'Mi', 'Accessories', 'Mi Webcam HD Silver', '84733099', 1, 'pcs', 697.00, 899, 1499.00, 18),
(130, 'Mi', 'Mobiles', 'POCO F1 Armored Edition (8gb+256gb)', '8517', 0, 'pcs', 25021.99, 22999, 30999.00, 12),
(131, 'Mi', 'Mobiles', 'POCO F1 Graphite Black (6Gb+128Gb)', '8517', 0, 'pcs', 20947.70, 18999, 24999.00, 12),
(132, 'Mi', 'Mobiles', 'Poco F1 Graphite Black (6gb+64gb)', '8517', 0, 'pcs', 18329.13, 17999, 21999.00, 12),
(133, 'Mi', 'Mobiles', 'Poco F1 Graphite Black (8Gb+256Gb)', '8517', 0, 'pcs', 24159.13, 22999, 30999.00, 12),
(134, 'Mi', 'Mobiles', 'Poco F1 Rosso Red (6Gb+64Gb)', '8517', 0, 'pcs', 17256.28, 17999, 21999.00, 12),
(135, 'Mi', 'Mobiles', 'POCO F1 Steel Blue (6Gb+128Gb)', '8517', 0, 'pcs', 19844.85, 18999, 24999.00, 12),
(136, 'Mi', 'Mobiles', 'POCO F1 Steel Blue (6Gb+64Gb)', '8517', 0, 'pcs', 17256.25, 17999, 21999.00, 12),
(137, 'Mi', 'Mobiles', 'Redmi 5A Gold (2Gb+16Gb)', '8517', 0, 'pcs', 5116.07, 5999, 6499.00, 12),
(138, 'Mi', 'Mobiles', 'Redmi 6 Black (3Gb+32Gb)', '8517', 0, 'pcs', 7248.43, 7999, 8999.00, 12),
(139, 'Mi', 'Mobiles', 'Redmi 6 Black (3gb+64gb)', '8517', 0, 'pcs', 8101.29, 8499, 10499.00, 12),
(140, 'Mi', 'Mobiles', 'Redmi 6 Blue (3GB+32GB)', '8517', 0, 'pcs', 7641.00, 7999, 8999.00, 12),
(141, 'Mi', 'Mobiles', 'Redmi 6 Blue (3gb+64gb)', '8517', 0, 'pcs', 8101.29, 8499, 10499.00, 12),
(142, 'Mi', 'Mobiles', 'Redmi 6 Gold (3GB+32GB)', '8517', 0, 'pcs', 7641.00, 7999, 8999.00, 12),
(143, 'Mi', 'Mobiles', 'Redmi 6 Gold (3gb+64gb)', '8517', 0, 'pcs', 8101.29, 8499, 10499.00, 12),
(144, 'Mi', 'Mobiles', 'Redmi 6 Pro Black (3Gb+32Gb)', '8517', 0, 'pcs', 9380.57, 9299, 11499.00, 12),
(145, 'Mi', 'Mobiles', 'Redmi 6 Pro Black (4Gb+64Gb)', '8517', 0, 'pcs', 11086.29, 11499, 13499.00, 12),
(146, 'Mi', 'Mobiles', 'Redmi 6 Pro Gold (3Gb+32Gb)', '8517', 0, 'pcs', 8427.73, 9299, 11499.00, 12),
(147, 'Mi', 'Mobiles', 'Redmi 6 Pro Gold (4gb+64gb)', '8517', 0, 'pcs', 11086.29, 11499, 13499.00, 12),
(148, 'Mi', 'Mobiles', 'Redmi 6 Pro Lake Blue (3GB+32Gb)', '8517', 0, 'pcs', 10506.00, 9299, 11499.00, 12),
(149, 'Mi', 'Mobiles', 'Redmi 6 Pro Lake Blue (4Gb+64Gb)', '8517', 0, 'pcs', 10113.45, 11499, 13499.00, 12),
(150, 'Mi', 'Mobiles', 'Redmi 6 Pro Red (3Gb+32Gb)', '8517', 0, 'pcs', 9380.36, 9299, 11499.00, 12),
(151, 'Mi', 'Mobiles', 'Redmi 6 Pro Red (4Gb+64Gb)', '85171290', 0, 'pcs', 9270.59, 11499, 13499.00, 12),
(152, 'Mi', 'Mobiles', 'Redmi 6 Rose Gold (3Gb+32Gb)', '8517', 0, 'pcs', 7641.00, 8299, 8999.00, 12),
(153, 'Mi', 'Mobiles', 'Redmi 6 Rose Gold (3gb+64gb)', '8517', 0, 'pcs', 8101.29, 8799, 10499.00, 12),
(154, 'Mi', 'Mobiles', 'Redmi 6A Black (2Gb+16Gb)', '8517', 0, 'pcs', 5730.00, 6299, 6999.00, 12),
(155, 'Mi', 'Mobiles', 'Redmi 6A Black (2Gb+32Gb)', '8517', 0, 'pcs', 6395.57, 6799, 7999.00, 12),
(156, 'Mi', 'Mobiles', 'Redmi 6A Blue (2Gb+16Gb)', '8517', 0, 'pcs', 5628.00, 6299, 6999.00, 12),
(157, 'Mi', 'Mobiles', 'Redmi 6A Blue (2Gb+32Gb)', '8517', 0, 'pcs', 6395.57, 6799, 7999.00, 12),
(158, 'Mi', 'Mobiles', 'Redmi 6A Gold (2Gb+16Gb)', '8517', 0, 'pcs', 5730.00, 6299, 6999.00, 12),
(159, 'Mi', 'Mobiles', 'Redmi 6A Gold (2Gb+32Gb)', '8517', 0, 'pcs', 6395.57, 6799, 7999.00, 12),
(160, 'Mi', 'Mobiles', 'Redmi 6A Rose Gold (2Gb+16Gb)', '8517', 0, 'pcs', 5730.00, 6299, 6999.00, 12),
(161, 'Mi', 'Mobiles', 'Redmi 6A Rose Gold (2gb+32gb)', '8517', 0, 'pcs', 6395.57, 6799, 7999.00, 12),
(162, 'Mi', 'Mobiles', 'Redmi 7 Comet Blue (2Gb+32Gb)', '85171290', 0, 'pcs', 6791.24, 7799, 9999.00, 12),
(163, 'Mi', 'Mobiles', 'Redmi 7 Comet Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 7640.25, 8799, 10999.00, 12),
(164, 'Mi', 'Mobiles', 'Redmi 7 Eclipse Black (2Gb+32Gb)', '85171290', 0, 'pcs', 6791.24, 7799, 9999.00, 12),
(165, 'Mi', 'Mobiles', 'Redmi 7 Eclipse Black (3Gb+32Gb)', '85171290', 0, 'pcs', 7640.25, 8799, 10999.00, 12),
(166, 'Mi', 'Mobiles', 'Redmi 7 Lunar Red (2Gb+32Gb)', '85171290', 0, 'pcs', 6791.24, 7799, 9999.00, 12),
(167, 'Mi', 'Mobiles', 'Redmi 7 Lunar Red (3Gb+32Gb)', '85171290', 0, 'pcs', 7215.75, 8799, 10999.00, 12),
(168, 'Mi', 'Mobiles', 'Redmi 7A Matte Black (2Gb+16Gb)', '85171290', 0, 'pcs', 5101.99, 6199, 6499.00, 12),
(169, 'Mi', 'Mobiles', 'Redmi 7A Matte Black (2Gb+32Gb)', '85171290', 0, 'pcs', 5263.02, 6399, 6999.00, 12),
(170, 'Mi', 'Mobiles', 'Redmi 7A Matte Blue (2Gb+16Gb)', '85171290', 0, 'pcs', 5101.99, 6199, 6499.00, 12),
(171, 'Mi', 'Mobiles', 'Redmi 7A Matte Blue (2Gb+32Gb)', '85171290', 0, 'pcs', 5263.02, 6399, 6999.00, 12),
(172, 'Mi', 'Mobiles', 'Redmi 7A Matte Gold (2Gb+16Gb)', '85171290', 0, 'pcs', 5101.99, 6199, 6499.00, 12),
(173, 'Mi', 'Mobiles', 'Redmi 7A Matte Gold (2Gb+32Gb)', '85171290', 0, 'pcs', 5263.02, 6399, 6999.00, 12),
(174, 'Mi', 'Mobiles', 'Redmi 8 Emerald Green (4Gb+64Gb)', '85171290', 1, 'pcs', 6791.24, 10299, 10999.00, 18),
(175, 'Mi', 'Mobiles', 'Redmi 8 Onyx Black (4Gb+64Gb)', '85171290', 0, 'pcs', 6791.24, 10299, 10999.00, 18),
(176, 'Mi', 'Mobiles', 'Redmi 8 Ruby Red (4Gb+64Gb)', '85171290', 0, 'pcs', 6791.24, 10299, 10999.00, 18),
(177, 'Mi', 'Mobiles', 'Redmi 8 Sapphire Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 6791.24, 10299, 10999.00, 18),
(178, 'Mi', 'Mobiles', 'Redmi 8A Dual Midnight Grey (2GB+32GB)', '85171290', 0, 'pcs', 5543.63, 7499, 7499.00, 18),
(179, 'Mi', 'Mobiles', 'Redmi 8A Dual Midnight Grey (3GB+32GB)', '8517', 0, 'pcs', 5970.13, 8299, 8999.00, 18),
(180, 'Mi', 'Mobiles', 'Redmi 8A Dual Midnight Grey(3GB+64GB)', '8517', 0, 'pcs', 7303.12, 9299, 9999.00, 18),
(181, 'Mi', 'Mobiles', 'Redmi 8A Dual Sea Blue(2Gb+32Gb)', '85171290', 0, 'pcs', 5543.63, 7499, 8499.00, 18),
(182, 'Mi', 'Mobiles', 'Redmi 8A Dual Sea Blue(3Gb+32Gb)', '8517', 0, 'pcs', 5970.12, 8299, 8999.00, 18),
(183, 'Mi', 'Mobiles', 'Redmi 8A Dual Sea Blue(3GB+64GB)', '8517', 0, 'pcs', 7303.12, 9299, 9999.00, 18),
(184, 'Mi', 'Mobiles', 'Redmi 8a Dual Sky White(2Gb+32Gb)', '8517', 0, 'pcs', 5543.63, 7499, 7499.00, 18),
(185, 'Mi', 'Mobiles', 'Redmi 8A Dual Sky White(3GB+32GB)', '85171290', 0, 'pcs', 5970.13, 8299, 0.00, 18),
(186, 'Mi', 'Mobiles', 'Redmi 8A Dual Sky White(3GB+64GB)', '8517', 0, 'pcs', 7303.12, 9299, 9999.00, 18),
(187, 'Mi', 'Mobiles', 'Redmi 8A Midnight Black (2Gb+32Gb)', '85171290', 0, 'pcs', 5517.73, 6999, 7999.00, 18),
(188, 'Mi', 'Mobiles', 'Redmi 8A Midnight Black (3Gb+32Gb)', '85171290', 0, 'pcs', 5942.23, 7499, 8999.00, 18),
(189, 'Mi', 'Mobiles', 'Redmi 8A Ocean Blue (2Gb+32Gb)', '85171290', 0, 'pcs', 5517.73, 6999, 7999.00, 18),
(190, 'Mi', 'Mobiles', 'Redmi 8A Ocean Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 5942.23, 7499, 8999.00, 18),
(191, 'Mi', 'Mobiles', 'Redmi 8A Sunset Red (2gb+32gb)', '85171290', 0, 'pcs', 5517.73, 6999, 7999.00, 18),
(192, 'Mi', 'Mobiles', 'Redmi 8A Sunset Red (3Gb+32Gb)', '85171290', 0, 'pcs', 5942.23, 7499, 8999.00, 18),
(193, 'Mi', 'Mobiles', 'Redmi 9 Carbon Black (4GB+64GB)', '8517', 0, 'pcs', 7708.90, 9499, 10999.00, 18),
(194, 'Mi', 'Mobiles', 'Redmi 9 Prime Matte Black (4GB+64GB)', '8517', 0, 'pcs', 8114.67, 10299, 11999.00, 18),
(195, 'Mi', 'Mobiles', 'Redmi 9 Prime Mint Green (4GB+128GB)', '8517', 0, 'pcs', 9737.77, 12499, 13999.00, 18),
(196, 'Mi', 'Mobiles', 'Redmi 9 Prime Mint Green (4GB+64GB)', '8517', 0, 'pcs', 8114.67, 10299, 11999.00, 18),
(197, 'Mi', 'Mobiles', 'Redmi 9 Sporty Orange (4GB+64GB)', '8517', 0, 'pcs', 7708.90, 9499, 10999.00, 18),
(198, 'Mi', 'Mobiles', 'Redmi 9A Midnight Black (2GB+32GB)', '8517', 0, 'pcs', 5868.52, 6999, 8499.00, 18),
(199, 'Mi', 'Mobiles', 'Redmi 9A Sea Blue (2GB+32GB)', '8517', 0, 'pcs', 5868.52, 6999, 8499.00, 18),
(200, 'Mi', 'Accessories', 'Redmi Earbuds S', '85176290', 3, 'pcs', 1350.15, 1799, 2399.00, 18),
(201, 'Mi', 'Mobiles', 'Redmi Go Black (1Gb+16Gb)', '85171290', 0, 'pcs', 4093.53, 4999, 5999.00, 18),
(202, 'Mi', 'Mobiles', 'Redmi Go Black (1Gb+8Gb)', '85171290', 0, 'pcs', 3905.36, 4699, 5999.00, 12),
(203, 'Mi', 'Mobiles', 'Redmi Go Blue (1Gb+16Gb)', '85171290', 0, 'pcs', 4093.53, 4999, 5999.00, 18),
(204, 'Mi', 'Mobiles', 'Redmi Go Blue (1Gb+8Gb)', '85171290', 0, 'pcs', 3905.36, 4699, 5999.00, 12),
(205, 'Mi', 'Accessories', 'Redmi Go Soft Case Black', '39269099', 1, 'pcs', 111.37, 149, 349.00, 18),
(206, 'Mi', 'Mobiles', 'Redmi K20 Carbon Black (6Gb+128Gb)', '85171290', 0, 'pcs', 20375.43, 24999, 24999.00, 18),
(207, 'Mi', 'Mobiles', 'Redmi K20 Carbon Black (6Gb+64Gb)', '85171290', 0, 'pcs', 18677.40, 21999, 22999.00, 18),
(208, 'Mi', 'Mobiles', 'Redmi K20 Flame Red (6Gb+128Gb)', '85171290', 0, 'pcs', 20375.43, 24999, 24999.00, 18),
(209, 'Mi', 'Mobiles', 'Redmi K20 Flame Red (6Gb+64Gb)', '85171290', 0, 'pcs', 18677.40, 21999, 22999.00, 18),
(210, 'Mi', 'Mobiles', 'Redmi K20 Glacier Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 20375.43, 24999, 24999.00, 18),
(211, 'Mi', 'Mobiles', 'Redmi K20 Glacier Blue (6Gb+64Gb)', '85171290', 0, 'pcs', 18677.40, 21999, 22999.00, 18),
(212, 'Mi', 'Mobiles', 'Redmi K20 Pro Carbon Black (6Gb+128Gb)', '85171290', 0, 'pcs', 23771.47, 26999, 28999.00, 18),
(213, 'Mi', 'Mobiles', 'Redmi K20 Pro Carbon Black (8Gb+256Gb)', '85171290', 0, 'pcs', 26318.50, 29999, 31999.00, 18),
(214, 'Mi', 'Mobiles', 'Redmi K20 Pro Flame Red (6Gb+128Gb)', '85171290', 0, 'pcs', 23771.47, 26999, 28999.00, 18),
(215, 'Mi', 'Mobiles', 'Redmi K20 Pro Glacier Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 23771.47, 26999, 28999.00, 18),
(216, 'Mi', 'Mobiles', 'Redmi K20 Pro Glacier Blue (8Gb+256Gb)', '85171290', 0, 'pcs', 26318.50, 29999, 31999.00, 18),
(217, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Black (4Gb+64Gb)', '8517', 0, 'pcs', 11799.16, 13499, 15999.00, 12),
(218, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Black (6gb+64gb)', '8517', 0, 'pcs', 13484.88, 14499, 17999.00, 12),
(219, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Gold (4Gb+64Gb)', '8517', 0, 'pcs', 11799.16, 13499, 15999.00, 12),
(220, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Gold (6Gb+64Gb)', '8517', 0, 'pcs', 13484.88, 14499, 17999.00, 12),
(221, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Lake Blue (6gb+64gb)', '8517', 0, 'pcs', 13484.88, 14499, 17999.00, 12),
(222, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Red (4gb+64gb)', '8517', 0, 'pcs', 11799.16, 13499, 15999.00, 12),
(223, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Red (6GB+64GB)', '8517', 0, 'pcs', 16240.00, 14499, 17999.00, 12),
(224, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Rose Gold (4Gb+64GB)', '8517', 0, 'pcs', 14327.00, 13499, 15999.00, 12),
(225, 'Mi', 'Mobiles', 'Redmi Note 5 Pro Rose Gold (6Gb+64Gb)', '8517', 0, 'pcs', 16240.00, 14499, 17999.00, 12),
(226, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Black (4Gb+64Gb)', '8517', 0, 'pcs', 11939.15, 12499, 15999.00, 12),
(227, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Black (6Gb+64Gb)', '8517', 0, 'pcs', 13644.86, 16499, 17999.00, 12),
(228, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Blue (4Gb+64Gb)', '8517', 0, 'pcs', 11939.15, 12499, 15999.00, 12),
(229, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Blue (6Gb+64Gb)', '8517', 0, 'pcs', 13644.86, 16499, 17999.00, 12),
(230, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Red (4Gb+64Gb)', '8517', 0, 'pcs', 11939.15, 12499, 15999.00, 12),
(231, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Red (6Gb+64Gb)', '8517', 0, 'pcs', 13644.86, 16499, 17999.00, 12),
(232, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Rose Gold (4Gb+64Gb)', '8517', 0, 'pcs', 11939.15, 12499, 15999.00, 12),
(233, 'Mi', 'Mobiles', 'Redmi Note 6 Pro Rose Gold (6Gb+64Gb)', '8517', 0, 'pcs', 13644.86, 16499, 17999.00, 12),
(234, 'Mi', 'Mobiles', 'Redmi Note 7 Onyx Black (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 10299, 12999.00, 12),
(235, 'Mi', 'Mobiles', 'Redmi Note 7 Onyx Black (4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 14999.00, 12),
(236, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Moonlight White (4Gb+64Gb)', '85171290', 0, 'pcs', 11885.31, 11499, 15999.00, 12),
(237, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Moonlight White (6Gb+128Gb)', '85171290', 0, 'pcs', 14432.34, 14499, 17999.00, 12),
(238, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Moonlight White (6Gb+64Gb)', '85171290', 0, 'pcs', 12734.32, 13499, 16999.00, 12),
(239, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Nebula Red (4Gb+64Gb)', '85171290', 0, 'pcs', 11885.31, 11499, 15999.00, 12),
(240, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Nebula Red (6Gb+128Gb)', '85171290', 0, 'pcs', 14432.34, 14499, 17999.00, 12),
(241, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Nebula Red (6Gb+64Gb)', '85171290', 0, 'pcs', 13583.33, 13499, 16999.00, 12),
(242, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Neptune Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 11885.31, 11499, 15999.00, 12),
(243, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Neptune Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 14432.34, 14499, 17999.00, 12),
(244, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Neptune Blue (6Gb+64Gb)', '85171290', 0, 'pcs', 13583.33, 13499, 16999.00, 12),
(245, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Space Black (4Gb+64Gb)', '85171290', 0, 'pcs', 11885.31, 11499, 15999.00, 12),
(246, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Space Black (6Gb+128Gb)', '85171290', 0, 'pcs', 14432.34, 14499, 17999.00, 12),
(247, 'Mi', 'Mobiles', 'Redmi Note 7 Pro Space Black (6Gb+64Gb)', '85171290', 0, 'pcs', 13583.33, 13499, 16999.00, 12),
(248, 'Mi', 'Mobiles', 'Redmi Note 7 Ruby Red (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 10299, 12999.00, 12),
(249, 'Mi', 'Mobiles', 'Redmi Note 7 Ruby Red(4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 14999.00, 12),
(250, 'Mi', 'Mobiles', 'Redmi Note 7 Sapphire Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 10299, 12999.00, 12),
(251, 'Mi', 'Mobiles', 'Redmi Note 7 Sapphire Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 14999.00, 12),
(252, 'Mi', 'Mobiles', 'Redmi Note 7S Moonlight White (4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 13999.00, 12),
(253, 'Mi', 'Mobiles', 'Redmi Note 7S Onyx Black (3Gb+32Gb)', '85171290', 0, 'pcs', 9338.28, 10299, 11999.00, 12),
(254, 'Mi', 'Mobiles', 'Redmi Note 7S Onyx Black (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12499, 13999.00, 12),
(255, 'Mi', 'Mobiles', 'Redmi Note 7S Ruby Red (3Gb+32Gb)', '85171290', 0, 'pcs', 9338.28, 10299, 11999.00, 12),
(256, 'Mi', 'Mobiles', 'Redmi Note 7S Ruby Red (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12499, 13999.00, 12),
(257, 'Mi', 'Mobiles', 'Redmi Note 7S Sapphire Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 9338.28, 10299, 11999.00, 12),
(258, 'Mi', 'Mobiles', 'Redmi Note 7S Sapphire Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 11036.30, 12499, 13999.00, 12),
(259, 'Mi', 'Mobiles', 'Redmi Note 8 Cosmic Purple (4Gb+64Gb)', '8517', 0, 'pcs', 8489.27, 12799, 12999.00, 18),
(260, 'Mi', 'Mobiles', 'Redmi Note 8 Cosmic Purple (6Gb+128Gb)', '8517', 0, 'pcs', 11088.11, 14499, 15999.00, 18),
(261, 'Mi', 'Mobiles', 'Redmi Note 8 Moonlight White (4Gb+64Gb)', '85171290', 0, 'pcs', 8489.27, 12799, 12999.00, 18),
(262, 'Mi', 'Mobiles', 'Redmi Note 8 Moonlight White (6Gb+128Gb)', '8517', 0, 'pcs', 11036.30, 14499, 15999.00, 18),
(263, 'Mi', 'Mobiles', 'Redmi Note 8 Neptune Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 8064.76, 9799, 11999.00, 12),
(264, 'Mi', 'Mobiles', 'Redmi Note 8 Neptune Blue (4Gb+64Gb)', '85171290', 0, 'pcs', 8489.27, 12799, 12999.00, 18),
(265, 'Mi', 'Mobiles', 'Redmi Note 8 Neptune Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 11036.30, 14499, 15999.00, 18),
(266, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Electric Blue (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 16999, 17999.00, 18),
(267, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Electric Blue (6Gb+64Gb)', '85171290', 0, 'pcs', 12734.32, 15999, 16999.00, 18),
(268, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Electric Blue (8Gb+128Gb)', '8517', 0, 'pcs', 15281.36, 18999, 19999.00, 18),
(269, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Gamma Green (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 16999, 17999.00, 18),
(270, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Gamma Green (6Gb+64Gb)', '85171290', 0, 'pcs', 12734.32, 15999, 16999.00, 18),
(271, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Halo White (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 16999, 17999.00, 18),
(272, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Halo White (6Gb+64Gb)', '85171290', 0, 'pcs', 12734.32, 15999, 16999.00, 18),
(273, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Halo White (8Gb+128Gb)', '85171290', 0, 'pcs', 15281.36, 18999, 19999.00, 18),
(274, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Shadow Black (6Gb+128Gb)', '85171290', 0, 'pcs', 13583.33, 16999, 17999.00, 18),
(275, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Shadow Black (6Gb+64Gb)', '85171290', 0, 'pcs', 12734.32, 15999, 16999.00, 18),
(276, 'Mi', 'Mobiles', 'Redmi Note 8 Pro Shadow Black (8Gb+128Gb)', '8517', 0, 'pcs', 15353.10, 18999, 19999.00, 18),
(277, 'Mi', 'Mobiles', 'Redmi Note 8 Space Black (3Gb+32Gb)', '85171290', 0, 'pcs', 8064.76, 9799, 11999.00, 12),
(278, 'Mi', 'Mobiles', 'Redmi Note 8 Space Black (4Gb+64Gb)', '85171211', 0, 'pcs', 8489.27, 12799, 12999.00, 18),
(279, 'Mi', 'Mobiles', 'Redmi Note 8 Space Black (6Gb+128Gb)', '85171290', 0, 'pcs', 11036.30, 14499, 15999.00, 18),
(280, 'Mi', 'Mobiles', 'Redmi Note 9 Aqua Green (4Gb+128Gb)', '8517', 0, 'pcs', 10955.09, 13999, 16499.00, 18),
(281, 'Mi', 'Mobiles', 'Redmi Note 9 Aqua Green (6Gb+128Gb)', '8517', 0, 'pcs', 12172.42, 15499, 18999.00, 18),
(282, 'Mi', 'Mobiles', 'Mi', 'Redmi Note 9 Arctic White (4Gb', 8517, '1', 0.00, 10955, 0.00, 16499),
(283, 'Mi', 'Mobiles', 'Redmi Note 9 Pebble Grey (4Gb+128Gb)', '8517', 0, 'pcs', 10955.09, 13999, 16499.00, 18),
(284, 'Mi', 'Mobiles', 'Redmi Note 9 Pebble Grey (6Gb+128Gb)', '8517', 0, 'pcs', 12172.42, 15499, 18999.00, 18),
(285, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Aurora Blue (4Gb+128Gb)', '8517', 0, 'pcs', 12983.96, 16499, 17999.00, 18),
(286, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Aurora Blue (4Gb+64Gb)', '8517', 0, 'pcs', 11360.86, 14499, 16999.00, 18),
(287, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Aurora Blue (6Gb+128Gb)', '8517', 0, 'pcs', 13795.51, 17499, 16999.00, 18),
(288, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Champagne Gold (4GB+128GB)', '8517', 0, 'pcs', 12983.97, 16499, 17999.00, 18),
(289, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Champagne Gold (4GB+64GB)', '8517', 0, 'pcs', 11360.86, 14499, 0.00, 16999),
(290, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Glacier White (4Gb+128Gb)', '8517', 0, 'pcs', 12983.96, 16499, 17999.00, 18),
(291, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Glacier White (4Gb+64Gb)', '8517', 0, 'pcs', 11360.86, 14499, 16999.00, 18),
(292, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Glacier White (6Gb+128Gb)', '8517', 0, 'pcs', 13795.51, 17499, 19999.00, 18),
(293, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Interstellar Black (4Gb+64Gb)', '8517', 0, 'pcs', 11360.86, 14499, 16999.00, 18),
(294, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Interstellar Black (6Gb+128Gb)', '8517', 0, 'pcs', 13795.51, 17499, 16999.00, 18),
(295, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Aurora Blue (6GB+128GB)', '8517', 0, 'pcs', 15012.83, 18999, 20999.00, 18),
(296, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Aurora Blue (6GB+64GB)', '8517', 0, 'pcs', 13795.51, 17499, 18999.00, 18),
(297, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Aurora Blue (8GB+128GB)', '8517', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(298, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Champagne Gold (8GB+128GB)', '8517', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(299, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Glacier White (6GB+128GB)', '8517', 0, 'pcs', 15012.83, 18999, 20999.00, 18),
(300, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Glacier White (6GB+64GB)', '8517', 0, 'pcs', 13795.51, 17499, 18999.00, 18),
(301, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Glacier White (8GB+128GB)', '8517', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(302, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Interstellar Black (6GB+128GB)', '8517', 0, 'pcs', 15012.83, 18999, 20999.00, 18),
(303, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Interstellar Black (6GB+64GB)', '8517', 0, 'pcs', 13795.51, 17499, 18999.00, 18),
(304, 'Mi', 'Mobiles', 'Redmi Note 9 Scarlet Red (4GB+128GB)', '8517', 0, 'pcs', 10955.09, 13999, 16499.00, 18),
(305, 'Mi', 'Accessories', 'Redmi Power Bank 10000mAh Black', '85076000', 31, 'pcs', 608.26, 799, 999.00, 18),
(306, 'Mi', 'Accessories', 'Redmi Power Bank 20000mAh Black', '85076000', 20, 'pcs', 1165.41, 1499, 1999.00, 18),
(307, 'Mi', 'Accessories', 'Redmi Power Bank 20000mAh White', '85076000', 0, 'pcs', 1243.15, 1599, 1999.00, 18),
(308, 'Mi', 'Mobiles', 'Redmi Y2 Black (3Gb+32Gb)', '8517', 0, 'pcs', 8427.73, 9299, 10499.00, 12),
(309, 'Mi', 'Mobiles', 'Redmi Y2 Black (4Gb+64Gb)', '8517', 0, 'pcs', 10113.45, 11499, 13499.00, 12),
(310, 'Mi', 'Mobiles', 'Redmi Y2 Blue (3Gb+32Gb)', '8517', 0, 'pcs', 9551.00, 9299, 10499.00, 12),
(311, 'Mi', 'Mobiles', 'Redmi Y2 Dark Grey (4Gb+64Gb)', '8517', 0, 'pcs', 10113.45, 11499, 13299.00, 12),
(312, 'Mi', 'Mobiles', 'Redmi Y2 Gold (3Gb+32Gb)', '8517', 0, 'pcs', 9551.00, 9299, 10499.00, 12),
(313, 'Mi', 'Mobiles', 'Redmi Y2 Gold (4Gb+64Gb)', '8517', 0, 'pcs', 10113.45, 11499, 13499.00, 12),
(314, 'Mi', 'Mobiles', 'Redmi Y2 Rose Gold (3Gb+32Gb)', '8517', 0, 'pcs', 8427.73, 9299, 10499.00, 12),
(315, 'Mi', 'Mobiles', 'Redmi Y2 Rose Gold (4Gb+64Gb)', '8517', 0, 'pcs', 9270.59, 11499, 13499.00, 12),
(316, 'Mi', 'Mobiles', 'Redmi Y3 Bold Red (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 9299, 11999.00, 12),
(317, 'Mi', 'Mobiles', 'Redmi Y3 Bold Red (4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 13999.00, 12),
(318, 'Mi', 'Mobiles', 'Redmi Y3 Elegant Blue (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 9299, 11999.00, 12),
(319, 'Mi', 'Mobiles', 'Redmi Y3 Elegant Blue (4Gb+64Gb)', '8517129', 0, 'pcs', 10187.29, 12499, 13999.00, 12),
(320, 'Mi', 'Mobiles', 'Redmi Y3 Prime Black (3Gb+32Gb)', '85171290', 0, 'pcs', 8489.27, 9299, 11999.00, 12),
(321, 'Mi', 'Mobiles', 'Redmi Y3 Prime Black (4Gb+64Gb)', '85171290', 0, 'pcs', 10187.29, 12499, 13999.00, 12),
(322, 'Mi', 'Mobiles', 'Redmi 9i Sea Blue(4GB+128GB)', '8517', 0, 'pcs', 7546.59, 9599, 10999.00, 18),
(323, 'Mi', 'Mobiles', 'Redmi 9i Nature Green(4GB+128GB)', '8517', 0, 'pcs', 7546.59, 9599, 10999.00, 18),
(324, 'Mi', 'Mobiles', 'Redmi 9i Midnight Black(4GB+64GB)', '8517', 0, 'pcs', 6735.04, 8599, 9999.00, 18),
(325, 'Mi', 'Mobiles', 'Redmi 9 Prime Space Blue(4GB+64GB)', '8517', 0, 'pcs', 8114.67, 10299, 11999.00, 18),
(326, 'Mi', 'Accessories', 'Mi Smart Band 5', '85176290', 1, 'pcs', 1902.43, 2499, 2999.00, 18),
(327, 'Mi', 'Accessories', 'Redmi Earbuds 2C', '85176290', 2, 'pcs', 1125.00, 1499, 1999.00, 18),
(328, 'Mi', 'Accessories', 'Mi Beard Trimmer 1C', '85102000', 0, 'PC', 749.75, 1099, 0.00, 18),
(329, 'Mi', 'Mobiles', 'Redmi 9 Sky Blue (4GB+64GB)', '85171211', 0, 'pcs', 7708.90, 9499, 10999.00, 18),
(330, 'Mi', 'Mobiles', 'Redmi 9 Prime Sunrise Flare (4GB+64GB)', '85171211', 0, 'pcs', 8114.67, 10299, 11999.00, 18),
(331, 'Mi', 'Mobiles', 'Redmi Note 9 Aqua Green (4GB+64GB)', '85171211', 0, 'pcs', 9737.77, 12499, 14999.00, 18),
(332, 'Mi', 'Mobiles', 'Redmi Note 9 Shadow Black (4GB+64GB)', '85171211', 0, 'pcs', 9737.77, 12499, 14999.00, 18),
(333, 'Mi', 'Mobiles', 'Mi 10T Cosmic Black (6GB+128GB)', '85171211', 0, 'pcs', 29214.93, 36499, 39999.00, 18),
(334, 'Mi', 'Mobiles', 'Redmi 9 Prime Space Blue (4GB+128GB)', '8517', 0, 'pcs', 9737.77, 12499, 13999.00, 18),
(335, 'Mi', 'Mobiles', 'Redmi Note 9 pro Interstellar Black (4GB+128GB)', '8517', 0, 'pcs', 12983.97, 16499, 17999.00, 18),
(336, 'Mi', 'Accessories', 'Redmi Earphones Red', '85183000', 0, 'pcs', 299.45, 399, 599.00, 18),
(337, 'Mi', 'Accessories', 'Redmi Earphones Black', '8518300', 0, 'pcs', 299.45, 399, 599.00, 18),
(338, 'Mi', 'Accessories', 'Mi Portable Wireless Mouse Black', '84716060', 0, 'pcs', 375.25, 500, 649.00, 18),
(339, 'Mi', 'Accessories', 'Mi Portable Wireless Mouse White', '84716060', 0, 'pcs', 375.25, 500, 649.00, 18),
(340, 'Mi', 'Accessories', 'Mi Rollerball Pen Refill', '96086010', 0, 'pcs', 89.31, 119, 199.00, 18),
(341, 'Mi', 'Accessories', 'Mi Outdoor Bluetooth Speaker', '85182900', 12, 'pcs', 1049.95, 1499, 1999.00, 18),
(342, 'Mi', 'Accessories', '10000mAh Mi Power Bank 3i Blue', '8507600', 14, 'pcs', 760.51, 999, 1299.00, 18),
(343, 'Mi', 'Accessories', '10000mAh Mi Power Bank 3i Black', '85076000', 11, 'pcs', 760.51, 999, 1299.00, 18),
(344, 'Mi', 'Accessories', 'Mi Business Casual Backpack Blue', '42021250', 7, 'pcs', 760.51, 999, 1999.00, 18),
(345, 'Mi', 'Accessories', 'Mi Business Casual Backpack Light Grey', '42021250', 3, 'pcs', 760.51, 999, 1999.00, 18),
(346, 'Mi', 'Accessories', 'Mi Step Out Backpack Black', '42021250', 3, 'pcs', 227.62, 299, 499.00, 18),
(347, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Champagne Gold (6GB+128GB)', '8517', 0, 'pcs', 15012.83, 18999, 20999.00, 18),
(348, 'Mi', 'Mobiles', 'Mi 10T Pro Lunar Silver (8GB+128GB)', '85171211', 0, 'pcs', 32461.12, 40499, 47999.00, 18),
(349, 'Mi', 'Mobiles', 'Mi 10T Pro Cosmic Black (8GB+128GB)', '85171211', 0, 'pcs', 32461.12, 40499, 47999.00, 18),
(350, 'Mi', 'Mobiles', 'Mi 10T Cosmic Black (8GB+128GB)', '85171211', 0, 'pcs', 30838.03, 38499, 42999.00, 18),
(351, 'Mi', 'Mobiles', 'Redmi 9i Nature Green(4GB+64GB)', '8517', 0, 'pcs', 7140.81, 8799, 9999.00, 18),
(352, 'Mi', 'Mobiles', 'Redmi 9 Power Blazing Blue(4GB+64GB)', '8517', 0, 'pcs', 9332.00, 11999, 13999.00, 18),
(353, 'Mi', 'Mobiles', 'Mi 10i Pacific Sunrise (6GB+128GB)', '8517', 0, 'pcs', 17853.25, 22499, 24999.00, 18),
(354, 'Mi', 'Mobiles', 'Mi 10i Atlantic Blue (6GB+128GB)', '8517', 0, 'pcs', 17853.25, 22499, 24999.00, 18),
(355, 'Mi', 'Mobiles', 'Mi 10i Midnight Black (6GB+128GB)', '8517', 0, 'pcs', 17853.25, 22499, 24999.00, 18),
(356, 'Mi', 'Mobiles', 'Mi 10i Midnight Black (8GB+128GB)', '8517', 0, 'pcs', 19476.35, 24499, 27999.00, 18),
(357, 'Mi', 'Mobiles', 'Mi 10i Pacific Sunrise (8GB+128GB)', '8517', 0, 'pcs', 19476.35, 24499, 27999.00, 18),
(358, 'Mi', 'Mobiles', 'Redmi 9 Power Blazing Blue(4GB+128GB)', '8517', 0, 'pcs', 9737.77, 12499, 15999.00, 18),
(359, 'Mi', 'Mobiles', 'Redmi 9 Power Mighty Black (4GB+64GB)', '8517', 0, 'pcs', 8926.22, 10999, 13999.00, 18),
(360, 'Mi', 'Mobiles', 'Redmi Note 9 Pro Max Champagne Gold (6GB+64GB)', '8517', 0, 'pcs', 13795.51, 17499, 18999.00, 18),
(361, 'Mi', 'Mobiles', 'Mi 10T Lunar Silver (8GB+128GB)', '8517', 0, 'pcs', 30838.03, 38499, 42999.00, 18),
(362, 'Mi', 'Accessories', 'Redmi Smart Band', '85176290', 4, 'pcs', 1217.28, 1599, 2099.00, 18),
(363, 'Mi', 'Accessories', 'Mi 18W Dual Port Charger', '85044090', 0, 'pcs', 449.55, 599, 799.00, 18),
(364, 'Mi', 'Accessories', 'MI SMART BAND 5 STRAP BLACK', '39269099', 0, 'pcs', 224.40, 299, 399.00, 18),
(365, 'Mi', 'Accessories', 'MI SMART BAND 5 STRAP NAVY BLUE', '39269099', 0, 'pcs', 224.40, 299, 399.00, 18),
(366, 'Mi', 'Accessories', 'MI SMART BAND 5 STRAP ORANGE', '39269099', 0, 'pcs', 224.40, 299, 399.00, 18),
(367, 'Mi', 'Accessories', 'MI SMART BAND 5 STRAP PURPLE', '39269099', 1, 'pcs', 224.40, 299, 399.00, 18),
(368, 'Mi', 'Accessories', 'MI SMART BAND 5 STRAP TEAL', '39269099', 1, 'pcs', 224.40, 299, 399.00, 18),
(369, 'Mi', 'Accessories', 'Mi True Wireless Earphone 2C', '85176290', 0, 'pcs', 1875.51, 2499, 3499.00, 18),
(370, 'Mi', 'Accessories', 'Redmi Earphones Blue', '8518300', 0, 'pcs', 299.45, 399, 599.00, 18),
(371, 'Mi', 'Accessories', 'Mi Smart LED Desk Lamp 1S', '94052010', 3, 'pcs', 1875.51, 2499, 2999.00, 18),
(372, 'Mi', 'Accessories', 'Mi Smart Bedside Lamp 2', '94052010', 2, 'pcs', 2175.71, 2899, 2999.00, 18),
(373, 'Mi', 'Accessories', 'MI KN 95 PROTECTIVE MASK PACK OF 2', '63079090', 11, 'pcs', 189.53, 199, 799.00, 5),
(374, 'Mi', 'Accessories', 'MI AUTOMATIC SOAP DISPENSER', '85098000', 1, 'pcs', 586.18, 999, 1199.00, 18),
(375, 'Mi', 'Accessories', 'MI FOAMING HAND WASH 3 PACK', '34013090', 1, 'pcs', 456.00, 599, 799.00, 18),
(376, 'Mi', 'Accessories', 'MI SIMPLE WAY FOAMING HAND WASH 1 PACK', '34013090', 3, 'pcs', 174.33, 199, 299.00, 18),
(377, 'Mi', 'Accessories', '20000MAH MI POWER BANK 3I BLACK', '85076000', 19, 'pcs', 1293.41, 1699, 2199.00, 18),
(378, 'Mi', 'Accessories', 'MI SMART SPEAKER', '85176290', 11, 'pcs', 3044.33, 3999, 5999.00, 18),
(379, 'Mi', 'Accessories', 'I Love Mi T Shirt Black M', '61091000', 1, 'pcs', 342.00, 399, 799.00, 5),
(380, 'Mi', 'Accessories', 'I Love Mi T Shirt White M', '61091000', 1, 'pcs', 342.00, 399, 799.00, 5),
(381, 'Mi', 'Accessories', 'Mi Organic Solid T Shirt White M', '61091000', 1, 'pcs', 427.71, 500, 999.00, 5),
(382, 'Mi', 'Accessories', 'MI Electric Toothbrush T100', '8509800', 1, 'pcs', 524.60, 699, 799.00, 18),
(383, 'Mi', 'Mobiles', 'Redmi 9A Midnight Black (3GB+32GB)', '8517', 0, 'pcs', 6329.27, 7999, 9499.00, 18),
(384, 'Mi', 'Mobiles', 'Redmi 9A Sea Blue (3GB+32GB)', '8517', 0, 'pcs', 6329.27, 7999, 9499.00, 18),
(385, 'Mi', 'Mobiles', 'Redmi 9 Carbon Black (4GB+128GB)', '8517', 0, 'pcs', 8114.67, 10299, 11999.00, 18),
(386, 'Mi', 'Accessories', 'Mi 18W Car Charger Pro', '85044090', 1, 'pcs', 599.65, 799, 999.00, 18),
(387, 'Mi', 'Accessories', 'MI Athleisure Shoes Blue UK 8', '64041190', 2, 'pcs', 1141.15, 1699, 2999.00, 18),
(388, 'Mi', 'Accessories', 'MI Athleisure Shoes Black UK 8', '64041190', 0, 'pcs', 1141.15, 1699, 2999.00, 18),
(389, 'Mi', 'Accessories', 'MI Athleisure Shoes Black UK 7', '64041190', 2, 'pcs', 1141.15, 1699, 2999.00, 18),
(390, 'Mi', 'Accessories', 'MI Athleisure Shoes Grey UK 7', '64041190', 1, 'pcs', 1141.15, 1699, 2999.00, 18),
(391, 'Mi', 'Accessories', 'MI Athleisure Shoes Grey UK 8', '64041190', 1, 'pcs', 1141.15, 1699, 2999.00, 18),
(392, 'Mi', 'Mobiles', 'Redmi Note 9 Shadow Black (6GB+128GB)', '8517', 0, 'pcs', 12172.42, 15499, 18999.00, 18),
(393, 'Mi', 'Mobiles', 'Redmi 9A Nature Green (3GB+32GB)', '8517', 0, 'pcs', 6085.80, 7799, 9499.00, 18),
(394, 'Mi', 'Accessories', 'MI SonicBass Wireless Earphones (BlacK)', '85176290', 8, 'pcs', 974.90, 1299, 1599.00, 18),
(395, 'Mi', 'Accessories', 'MI SonicBass Wireless Earphones (Blue)', '85176290', 8, 'pcs', 974.90, 1299, 1599.00, 18),
(396, 'Mi', 'Mobiles', 'Mi 10i Atlantic Blue (8GB+128GB)', '8517', 0, 'pcs', 19476.35, 24499, 27999.00, 18),
(397, 'Mi', 'TV', 'Mi TV 4A 80cm (32) Horizon Edition', '85287215', 8, 'pcs', 13918.00, 16999, 19999.00, 18),
(398, 'Mi', 'Mobiles', 'Redmi 9 Power Blazing Blue(6GB+128GB)', '85171211', 0, 'pcs', 10955.09, 13499, 16999.00, 18),
(399, 'Mi', 'Mobiles', 'Redmi 9 Power Electric Green (6GB+128GB)', '85171211', 0, 'pcs', 10549.32, 13499, 16999.00, 18),
(400, 'Mi', 'Accessories', 'Mi Neckband Bluetooth Earphones Pro Black', '85176290', 3, 'pcs', 1350.15, 1799, 2499.00, 18),
(401, 'Mi', 'Accessories', 'Mi Neckband Bluetooth Earphones Pro Blue', '85176290', 3, 'pcs', 1350.15, 1799, 2499.00, 18),
(402, 'Mi', 'Mobiles', 'Redmi Note 10 Frost White (6GB+128GB)', '85171211', 2, 'pcs', 12983.96, 16499, 18999.00, 18),
(403, 'Mi', 'Mobiles', 'Redmi Note 10 Shadow Black (6GB+128GB)', '85171211', 0, 'pcs', 11360.86, 14499, 17999.00, 18),
(404, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Max Dark Night (6GB+128GB)', '85171211', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(405, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Max Vintage Bronze (6GB+128GB)', '85171211', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(406, 'Mi', 'Mobiles', 'Redmi Note 10 Shadow Black (4GB+64GB)', '85171211', 0, 'pcs', 10549.32, 13499, 15999.00, 18),
(407, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Dark Night (6GB+128GB)', '85171211', 0, 'pcs', 14607.06, 18499, 19999.00, 18),
(408, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Vintage Bronze (8GB+128GB)', '85171211', 0, 'pcs', 15418.51, 19499, 21999.00, 18),
(409, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Max Glacial Blue (6GB+128GB)', '85171211', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(410, 'Mi', 'Mobiles', 'Redmi 9 Power Electric Green (4GB+64GB)', '85171211', 0, 'pcs', 8926.22, 11499, 13999.00, 18),
(411, 'MI', 'Accessories', 'Redmi Smart Band Strap Green', '39269099', 0, 'pcs', 186.12, 249, 299.00, 18),
(412, 'MI', 'Accessories', 'Redmi Smart Band Strap Blue', '39269099', 1, 'pcs', 186.12, 249, 299.00, 18),
(413, 'MI', 'Accessories', 'Mi 33W SonicCharge 2.0 Charger', '85044030', 7, 'pcs', 749.75, 999, 1999.00, 18),
(414, 'MI', 'Accessories', '10000mAh Mi Wireless Power Bank', '85076000', 8, 'pcs', 1902.43, 2499, 2699.00, 18),
(415, 'MI', 'Accessories', 'Mi Smart Band 5 Charging Cable', '85444299', 6, 'pcs', 186.12, 249, 349.00, 18),
(417, 'Apple', 'Mobiles', 'iPhone XR 64Gb White', '85171211', 0, 'pcs', 38969.49, 47900, 47900.00, 18),
(418, 'Apple', 'Mobiles', 'iPhone XR 128Gb White', '85171211', 0, 'pcs', 43037.29, 52900, 52900.00, 18),
(419, 'Apple', 'Mobiles', 'iPhone 12 128Gb White', '85171211', 0, 'pcs', 69071.19, 84900, 84900.00, 18),
(420, 'Apple', 'Mobiles', 'iPhone 12 128Gb Green', '85171211', 0, 'pcs', 69071.19, 84900, 84900.00, 18),
(421, 'Apple', 'Mobiles', 'iPhone 12 mini 64Gb Blue', '851712', 1, 'pcs', 56867.80, 69900, 69900.00, 18),
(422, 'Apple', 'Mobiles', 'iPhone 12 mini 64Gb (PRODUCT)Red', '851712', 1, 'pcs', 56867.80, 69900, 69900.00, 18),
(423, 'Apple', 'Mobiles', 'iPhone 12 mini 64Gb Green', '851712', 0, 'pcs', 56867.80, 69900, 69900.00, 18),
(424, 'Apple', 'Mobiles', 'iPhone 12 Pro Max 128Gb Pacific Blue', '851712', 0, 'pcs', 105681.36, 129900, 129900.00, 18),
(425, 'Apple', 'Mobiles', 'iPhone 12 Pro 128Gb Graphite', '85171211', 1, 'pcs', 97545.76, 119900, 119900.00, 18),
(426, 'Apple', 'Mobiles', 'iPhone 11 64Gb White', '85171211', 0, 'pcs', 44664.41, 54900, 54900.00, 18),
(427, 'Apple', 'Mobiles', 'iPhone 11 64Gb Purple', '85171211', 0, 'pcs', 44664.41, 54900, 54900.00, 18),
(428, 'Apple', 'Mobiles', 'iPhone 11 64Gb Black', '85171211', 0, 'pcs', 44664.41, 54900, 54900.00, 18),
(429, 'Apple', 'Mobiles', 'iPhone 11 128Gb White', '85171211', 0, 'pcs', 48732.20, 59900, 59900.00, 18),
(430, 'Apple', 'Mobiles', 'iPhone 11 128Gb Black', '85171211', 0, 'pcs', 48732.20, 59900, 59900.00, 18),
(431, 'Apple', 'Accessories', 'iPhone 20W USB-C Power Adapter', '850440', 4, 'pcs', 1398.31, 1900, 1900.00, 18),
(432, 'Apple', 'Mobiles', 'iPhone 11 128Gb Purple', '85171290', 0, 'pcs', 48732.20, 59900, 59900.00, 18),
(433, 'Apple', 'Mobiles', 'iPhone 12 mini 128Gb (PRODUCT)Red', '85171290', 0, 'pcs', 60935.60, 74900, 74900.00, 18),
(434, 'Apple', 'Mobiles', 'iPhone 12 128Gb Blue', '85171290', 0, 'pcs', 69071.19, 84900, 84900.00, 18),
(435, 'Apple', 'Mobiles', 'iPhone 12 128Gb (PRODUCT)Red', '85171290', 0, 'pcs', 69071.19, 84900, 84900.00, 18),
(436, 'Apple', 'Accessories', 'EarPods with Lightning Connector', '85183000', 2, 'pcs', 1398.31, 1900, 1900.00, 18),
(437, 'Apple', 'Accessories', 'AirPods 2 with Charging Case', '85176290', 0, 'pcs', 10338.98, 14900, 14900.00, 18),
(438, 'Mi', 'Mobiles', 'Redmi Note 10 Frost White (4GB+64GB)', '85171211', 0, 'pcs', 9737.77, 12499, 15999.00, 18),
(439, 'Mi', 'Mobiles', 'Redmi Note 10 Aqua Green (6GB+128GB)', '85171211', 0, 'pcs', 11766.64, 14999, 17999.00, 18),
(440, 'Mi', 'Mobiles', 'Mi 11X Lunar White (6GB+128GB)', '85171211', 1, 'pcs', 24345.64, 29999, 33999.00, 18),
(441, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Glacial Blue (6GB+128GB)', '85171211', 0, 'pcs', 14607.06, 17999, 19999.00, 18),
(442, 'Mi', 'Accessories', '10000mAh Mi Pocket Power Bank Pro', '85076000', 4, 'PC', 877.70, 1199, 1699.00, 18),
(443, 'Mi', 'Mobiles', 'Mi 11X Celestial Silver (8GB+128GB)', '85171211', 0, 'pcs', 25968.74, 32499, 34999.00, 18),
(444, 'Mi', 'Mobiles', 'Mi 11X Cosmic Black (6GB+128GB)', '85171211', 0, 'pcs', 24345.64, 30499, 33999.00, 18),
(445, 'Mi', 'Mobiles', 'Redmi Note 10 Aqua Green (4GB+64GB)', '85171211', 0, 'pcs', 10143.54, 12999, 15999.00, 18),
(446, 'Mi', 'Mobiles', 'Redmi 9 Power Fiery Red (4GB+64GB)', '85171211', 0, 'pcs', 9332.00, 11499, 13999.00, 18),
(447, 'Mi', 'Mobiles', 'Redmi Note 9 Pebble Grey (4Gb+64Gb)', '85171211', 0, 'pcs', 9737.77, 12499, 14999.00, 18),
(448, 'OnePlus', 'Mobiles', 'OnePlus 9R 5G Carbon Black (8GB+128GB)', '85171211', 1, 'pcs', 32880.51, 39999, 39999.00, 18),
(449, 'OnePlus', 'Mobiles', 'OnePlus 9R 5G Lake Blue (8GB+128GB)', '85171211', 1, 'pcs', 32880.51, 39999, 39999.00, 18),
(450, 'OnePlus', 'Mobiles', 'OnePlus 9R 5G Lake Blue (12GB+256GB)', '85171211', 1, 'pcs', 36168.64, 43999, 43999.00, 18),
(451, 'OnePlus', 'Mobiles', 'OnePlus 9 5G Astral Black (8GB+128GB)', '85171211', 0, 'pcs', 41100.85, 49999, 49999.00, 18),
(452, 'OnePlus', 'Mobiles', 'OnePlus Nord Blue Marble (12GB+128GB)', '85171211', 0, 'pcs', 24660.17, 29999, 29999.00, 18),
(453, 'OnePlus', 'Mobiles', 'OnePlus 8T 5G Lunar Silver (8GB+128GB)', '85171211', 0, 'pcs', 32058.47, 38999, 42999.00, 18),
(454, 'Apple', 'Mobiles', 'iPhone 11 128Gb Green', '85171290', 0, 'pcs', 48732.20, 59900, 59900.00, 18),
(455, 'Apple', 'Mobiles', 'iPhone 12 Pro Max 128Gb Gold', '85171290', 0, 'pcs', 105681.36, 129900, 129900.00, 18),
(456, 'Mi', 'Mobiles', 'Mi 11X Pro 5G Celestial Silver (8GB+128GB)', '85171211', 0, 'pcs', 32461.12, 39999, 47999.00, 18),
(457, 'Mi', 'Mobiles', 'Redmi Note 10S Deep Sea Blue (6GB+128GB)', '85171211', 4, 'pcs', 13389.74, 16499, 18999.00, 18),
(458, 'Mi', 'Mobiles', 'Redmi Note 9 Arctic White (4Gb+128Gb)', '8517', 1, 'PC', 10955.00, 13999, 16499.00, 18),
(459, 'Mi', 'Mobiles', 'Redmi 9 Power Mighty Black (6GB+128GB)', '85171211', 0, 'pcs', 10955.09, 13499, 16999.00, 18),
(460, 'Mi', 'Mobiles', 'Mi 11 Lite Jazz Blue (8GB+128GB)', '85171211', 0, 'pcs', 19476.35, 24499, 25999.00, 18),
(461, 'Mi', 'Mobiles', 'Mi 11 Lite Vinyl Black (6GB+128GB)', '85171211', 0, 'pcs', 17853.25, 22499, 24999.00, 18),
(462, 'Mi', 'TV', 'Mi TV 4A 40 Horizon', '85287216', 4, 'pcs', 18090.00, 23999, 29999.00, 28),
(463, 'Mi', 'Mobiles', 'Redmi Note 10S Shadow Black (6GB+128GB)', '85171211', 0, 'pcs', 13389.74, 16999, 18999.00, 18);
INSERT INTO `stockold` (`id`, `bname`, `category`, `product`, `hsn`, `qty`, `unit`, `rate`, `srate`, `mrp`, `gst`) VALUES
(464, 'Mi', 'Mobiles', 'Redmi Note 10S Shadow Black (6GB+64GB)', '85171211', 0, 'pcs', 12172.41, 15499, 16999.00, 18),
(465, 'Mi', 'Mobiles', 'Mi 11X Pro 5G Cosmic Black (8GB+128GB)', '85171211', 0, 'pcs', 32461.12, 40999, 47999.00, 18),
(466, 'Mi', 'TV', 'Redmi Smart TV X50 125.7 cm (50 inches) Black', '85287217', 0, 'pcs', 29397.00, 38999, 44999.00, 28),
(467, 'Mi', 'Mobiles', 'Mi 11 Ultra 5G Ceramic Black (12GB+256GB)', '85171211', 0, 'pcs', 56807.58, 69999, 74999.00, 18),
(468, 'Apple', 'Mac', 'MacBook Air 13inch M1 Chip 8Gb+256GB Space Gray', '847130', 0, 'pcs', 74005.08, 92900, 92900.00, 18),
(469, 'Mi', 'Mobiles', 'Mi 11X Pro 5G Cosmic Black (8GB+256GB)', '85171211', 0, 'pcs', 34084.22, 42499, 49999.00, 18),
(470, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Vintage Bronze (6GB+128GB)', '85171211', 4, 'pcs', 14607.06, 17999, 19999.00, 18),
(471, 'Mi', 'Mobiles', 'Mi 11X Lunar White (8GB+128GB)', '85171211', 0, 'pcs', 25968.74, 32499, 34999.00, 18),
(472, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Max Vintage Bronze (8GB+128GB)', '85171211', 0, 'pcs', 17853.26, 22499, 24999.00, 18),
(473, 'Mi', 'Mobiles', 'Redmi Note 10T 5G Mint Green (6GB+128GB)', '85171211', 0, 'pcs', 13389.74, 16999, 18999.00, 18),
(474, 'Mi', 'Mobiles', 'Mi 11 Lite Vinyl Black (8GB+128GB)', '85171211', 0, 'pcs', 19476.35, 24499, 25999.00, 18),
(475, 'Mi', 'Mobile', 'Redmi Note 10S Frost white (6GB+128GB)', '85171211', 0, 'PC', 12983.96, 16499, 18999.00, 18),
(476, 'Mi', 'Laptop', 'Mi NoteBook 14 E-Learning Edition 8GB RAM+256GB SSD, i3 10th Gen+UHD Graphics', '84713010', 3, 'pcs', 30432.25, 38999, 44999.00, 18),
(477, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Max Dark Night (8GB+128GB)', '85171211', 0, 'pcs', 17853.25, 22499, 24999.00, 18),
(478, 'Mi', 'Mobiles', 'Redmi Note 10T 5G Mint Green (4GB+64GB)', '85171211', 0, 'pcs', 11766.64, 14999, 16999.00, 18),
(479, 'Mi', 'Accessories', 'Mi Portable Electric Air Compressor (Tyre Inflator)', '84148090', 6, 'pcs', 1902.43, 2299, 3499.00, 18),
(480, 'Mi', 'Mobiles', 'Redmi Note 10S Cosmic Purple (6GB+64GB)', '85171211', 0, 'pcs', 12172.41, 15499, 16999.00, 18),
(481, 'Mi', 'Mobiles', 'Redmi 9A Nature Green (2GB+32GB)', '85171211', 0, 'pcs', 6120.07, 7299, 8499.00, 18),
(482, 'Mi', 'Accessories', 'Mi Portable Bluetooth Speaker (16W) Blue', '85182200', 8, 'pcs', 1875.51, 2499, 3499.00, 18),
(483, 'Mi', 'TV', 'Mi QLED TV 75', '85287217', 0, 'pcs', 96484.00, 127999, 199999.00, 28),
(484, 'Mi', 'Mobiles', 'Redmi 10 Prime Phantom Black (4GB+64GB)', '85171211', 1, 'pcs', 10549.31, 12999, 14999.00, 18),
(485, 'Mi', 'Mobiles', 'Redmi Note 10S Frost white (6GB+64GB)', '85171211', 0, 'pcs', 12172.41, 15499, 16999.00, 18),
(486, 'Mi', 'Mobiles', 'Redmi 10 Prime Astral White (4GB+64GB)', '85171211', 0, 'pcs', 10143.54, 12999, 14999.00, 18),
(487, 'Mi', 'TV', 'Mi LED TV 4C 80cm (32)', '85287215', 0, 'pcs', 13918.00, 16999, 19999.00, 18),
(488, 'Mi', 'Mobiles', 'Mi 11X Cosmic Black (8GB+128GB)', '85171211', 0, 'pcs', 25968.74, 32499, 34999.00, 18),
(489, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Tuscany Coral (8GB+128GB)', '85171211', 0, 'pcs', 23534.09, 28999, 33999.00, 18),
(490, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Vinyl Black (6GB+128GB)', '85171211', 1, 'pcs', 21911.00, 27499, 31999.00, 18),
(491, 'Mi', 'Mobiles', 'Redmi Note 10S Cosmic Purple (6GB+128GB)', '85171211', 1, 'pcs', 13389.74, 16999, 18999.00, 18),
(492, 'Mi', 'Mobiles', 'Redmi Note 10T 5G Chromium White (6GB+128GB)', '85171211', 0, 'pcs', 13795.51, 17499, 18999.00, 18),
(493, 'Mi', 'Mobiles', 'Redmi 10 Prime Phantom Black (6GB+128GB)', '85171211', 0, 'pcs', 12172.41, 14999, 16999.00, 18),
(494, 'Mi', 'Mobiles', 'Redmi 9i Sport Coral Green (4GB+64GB)', '85171211', 0, 'pcs', 7140.81, 8799, 9999.00, 18),
(495, 'Mi', 'Mobiles', 'Redmi 9 Power Fiery Red (6GB+128GB)', '85171211', 0, 'pcs', 10955.09, 13499, 16999.00, 18),
(496, 'Mi', 'Accessories', 'Mi Smart Band 6', '85176290', 14, 'pcs', 2663.70, 3499, 3999.00, 18),
(497, 'Mi', 'Accessories', 'Redmi Earbuds 3 Pro Blue', '85183000', 0, 'pcs', 2250.85, 2999, 5999.00, 18),
(498, 'Mi', 'Accessories', 'Redmi Earbuds 3 Pro Pink', '85183000', 2, 'pcs', 2250.85, 2999, 5999.00, 18),
(499, 'Mi', 'Mobiles', 'Redmi Note 10 Lite Aurora Blue (4GB+64GB)', '85171211', 0, 'pcs', 11360.87, 14499, 16999.00, 18),
(500, 'Mi', 'Mobiles', 'Redmi Note 10 Lite Aurora Blue (6GB+128GB)', '85171211', 0, 'pcs', 13795.51, 17499, 19999.00, 18),
(501, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Dark Night (8GB+128GB)', '85171211', 0, 'pcs', 15418.61, 19499, 21999.00, 18),
(502, 'Mi', 'Mobiles', 'Redmi 9A Sport Metallic Blue (2GB+32GB)', '85171211', 0, 'pcs', 6120.07, 7299, 8499.00, 18),
(503, 'Mi', 'Mobiles', 'Redmi 9A Sport Coral Green (2GB+32GB)', '85171211', 0, 'pcs', 5868.53, 7299, 8499.00, 18),
(504, 'Mi', 'Mobiles', 'Redmi 9 Activ Carbon Black (4GB+64GB)', '85171211', 0, 'pcs', 7708.90, 9799, 11499.00, 18),
(505, 'Mi', 'Mobiles', 'Redmi 9 Activ Carbon Black (6GB+128GB)', '85171211', 1, 'pcs', 9331.99, 11499, 12999.00, 18),
(506, 'Mi', 'TV', 'Redmi Smart TV X65 163.9 cm (65 inches) Black', '85287217', 1, 'pcs', 46734.00, 61999, 74999.00, 28),
(507, 'Mi', 'TV', 'Mi TV QLED 4k 138.8 cm (55)', '85287217', 1, 'pcs', 45226.00, 59999, 59999.00, 28),
(508, 'Mi', 'TV', 'Xiaomi TV 5X 50 Metallic Grey', '85287217', 0, 'pcs', 31658.00, 41999, 59999.00, 28),
(509, 'Mi', 'TV', 'Xiaomi TV 5X 55 Metallic Grey', '85287217', 0, 'pcs', 36181.00, 48999, 69999.00, 28),
(510, 'Mi', 'Accessories', 'Xiaomi SonicCharge 2.0 Cable White', '85444299', 45, 'pcs', 186.12, 249, 699.00, 18),
(511, 'Mi', 'TV', 'Redmi Smart TV 43 (108 cm)', '85287217', 2, 'pcs', 18844.00, 24999, 34999.00, 28),
(512, 'Mi', 'TV', 'Redmi Smart TV 32 (80 cm)', '85287215', 6, 'pcs', 13099.00, 15999, 24999.00, 18),
(513, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Vinyl Black (8GB+128GB)', '85171211', 0, 'pcs', 23534.09, 28999, 33999.00, 18),
(514, 'Mi', 'Mobiles', 'Redmi 10 Prime Astral White (6GB+128GB)', '85171211', 0, 'pcs', 11766.64, 14999, 16999.00, 18),
(515, 'Mi', 'Mobiles', 'Redmi 9 Activ Metallic Purple (4GB+64GB)', '85171211', 0, 'pcs', 7708.90, 9499, 10999.00, 18),
(516, 'Mi', 'Accessories', 'Xiaomi TV Webcam', '85258090', 6, 'pcs', 1551.00, 1999, 3999.00, 18),
(517, 'Mi', 'Mobiles', 'Redmi Note 10S Deep Sea Blue (6GB+64GB)', '85171211', 0, 'pcs', 12172.41, 15499, 16999.00, 18),
(518, 'Mi', 'Mobiles', 'Redmi 10 Prime Bifrost Blue (6GB+128GB)', '85171211', 0, 'pcs', 11766.64, 14999, 16999.00, 18),
(519, 'Mi', 'Mobiles', 'Redmi Note 10S Deep Sea Blue (8GB+128GB)', '85171211', 1, 'pcs', 15012.83, 18499, 20999.00, 18),
(520, 'Mi', 'Mobiles', 'Redmi 9 Activ Metallic Purple (6GB+128GB)', '85171211', 0, 'pcs', 8926.22, 11499, 12999.00, 18),
(521, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Matte Black (6GB+128GB)', '85171211', 0, 'pcs', 14607.05, 16999, 18999.00, 18),
(522, 'Mi', 'Accessories', 'Mi Boost Pro Power Bank 30000mAh 18W Black', '85076000', 2, 'pcs', 1902.45, 2499, 3499.00, 18),
(523, 'Mi', 'Accessories', 'Mi Power Bank Hypersonic 20000mAh (50W) Black', '85076000', 5, 'pcs', 3044.34, 3999, 4999.00, 18),
(524, 'Mi', 'Accessories', 'Xiaomi Beard Trimmer 2 Black', '85102000', 7, 'pcs', 1500.25, 1999, 3499.00, 18),
(525, 'Mi', 'Accessories', 'Xiaomi Precision Screwdriver Kit Dark Grey', '82054000', 1, 'pcs', 988.90, 1299, 1499.00, 18),
(526, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Jazz Blue (6GB+128GB)', '85171211', 0, 'pcs', 21910.99, 26999, 31999.00, 18),
(527, 'Mi', 'Mobiles', 'Redmi 9A Sport Metallic Blue (3GB+32GB)', '85171211', 4, 'pcs', 6735.04, 8299, 9499.00, 18),
(528, 'Mi', 'Mobiles', 'Redmi 9A Sport Carbon Black (3GB+32GB)', '85171211', 0, 'pcs', 6735.04, 8299, 9499.00, 18),
(529, 'Mi', 'Laptop', 'Mi NoteBook Ultra Lustrous Gray i5 11th Gen + Iris Xe Graphics 8GB RAM + 512GB NVMe SSD', '84713010', 0, 'pcs', 48692.09, 59999, 71999.00, 18),
(530, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Aquamarine Blue (6GB+64GB)', '85171300', 0, 'pcs', 13795.51, 15999, 18999.00, 18),
(531, 'Mi', 'Mobiles', 'Xiaomi 11i 5G Stealth Black (6GB+128GB)', '85171300', 1, 'pcs', 20287.89, 25499, 29999.00, 18),
(532, 'Mi', 'Mobiles', 'Xiaomi 11i 5G Camo Green (8GB+128GB)', '85171300', 0, 'pcs', 21910.99, 26999, 31999.00, 18),
(533, 'Mi', 'Mobiles', 'Xiaomi 11i Hypercharge 5G Purple Mist (8GB+128GB)', '85171300', 0, 'pcs', 23534.09, 28999, 33999.00, 18),
(534, 'Mi', 'Mobiles', 'Xiaomi 11T Pro 5G Celestial Magic (12GB+256GB)', '85171300', 0, 'pcs', 35707.31, 43999, 54999.00, 18),
(535, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Jazz Blue (8GB+128GB)', '85171300', 0, 'pcs', 23534.09, 28999, 33999.00, 18),
(536, 'Mi', 'Mobiles', 'Redmi Note 10 Pro Dark Nebula (6GB+128GB)', '85171300', 0, 'pcs', 14607.06, 17999, 19999.00, 18),
(537, 'Mi', 'Mobiles', 'Redmi Note 10 Lite Glacier White (4GB+128GB)', '85171300', 4, 'pcs', 12983.96, 15999, 17999.00, 18),
(538, 'Mi', 'Mobiles', 'Redmi Note 10T 5G Metallic Blue (4GB+64GB)', '85171300', 0, 'pcs', 12172.41, 15499, 16999.00, 18),
(539, 'Mi', 'Mobiles', 'Redmi Note 10S Shadow Black (8GB+128GB)', '85171300', 1, 'pcs', 15012.83, 18499, 20999.00, 18),
(540, 'Mi', 'Mobiles', 'Redmi 9A Sport Carbon Black (2GB+32GB)', '85171300', 5, 'pcs', 6287.76, 7499, 8499.00, 18),
(541, 'Mi', 'Mobiles', 'Redmi Note 11 Horizon Blue (6GB+128GB)', '85171300', 3, 'pcs', 12983.96, 16499, 19999.00, 18),
(542, 'Mi', 'Mobiles', 'Redmi Note 11 Starburst White (6GB+128GB)', '85171300', 0, 'pcs', 16948.30, 16499, 19999.00, 18),
(543, 'Mi', 'Mobiles', 'Redmi Note 11 Space Black (6GB+64GB)', '85171300', 0, 'pcs', 16100.84, 14999, 18999.00, 18),
(544, 'Mi', 'Mobiles', 'Redmi Note 11 Horizon Blue (6GB+64GB)', '85171300', 0, 'pcs', 16100.84, 14999, 18999.00, 18),
(545, 'Mi', 'TV', 'Mi TV 5X 43 Metallic Grey', '85287217', 4, 'pcs', 24120.33, 31999, 49999.00, 28),
(546, 'Mi', 'TV', 'Redmi Smart TV X43', '85287217', 1, 'pcs', 21859.00, 28999, 42999.00, 28),
(547, 'Mi', 'Mobiles', 'Xiaomi 11T Pro 5G Meteorite Black (8GB+128GB)', '85171300', 0, 'pcs', 32461.12, 39999, 49999.00, 18),
(548, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Aquamarine Blue (8GB+128GB)', '85171300', 0, 'pcs', 16230.15, 19999, 22999.00, 18),
(549, 'Mi', 'Mobiles', 'Xiaomi 11i 5G Pacific Pearl (8GB+128GB)', '85171300', 0, 'pcs', 21910.99, 26999, 31999.00, 18),
(550, 'Mi', 'Accessories', 'Redmi Smart Band Pro SportsWatch', '85176290', 2, 'pcs', 3044.38, 3999, 5999.00, 18),
(551, 'Mi', 'Mobiles', 'Xiaomi 11 Lite NE 5G Tuscany Coral (6GB+128GB)', '85171300', 1, 'pcs', 21910.99, 26999, 31999.00, 18),
(552, 'Mi', 'Mobiles', 'Redmi Note 11 Space Black (4GB+64GB)', '85171300', 3, 'pcs', 10955.09, 13999, 17999.00, 18),
(553, 'Mi', 'Mobiles', 'Redmi Note 11 Starburst White (6GB+64GB)', '85171300', 1, 'pcs', 11766.64, 14999, 18999.00, 18),
(554, 'Mi', 'Mobiles', 'Redmi Note 11S Space Black (8GB+128GB)', '85171300', 2, 'pcs', 15012.83, 18999, 21999.00, 18),
(555, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Aquamarine Blue (6GB+128GB)', '85171300', 0, 'pcs', 14607.05, 16999, 20999.00, 18),
(556, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Matte Black (8GB+128GB)', '85171300', 0, 'pcs', 16230.15, 20499, 22999.00, 18),
(557, 'Mi', 'Mobiles', 'Xiaomi 11i 5G Camo Green (6GB+128GB)', '85171300', 1, 'pcs', 20287.89, 25499, 29999.00, 18),
(558, 'Mi', 'Mobiles', 'Xiaomi 11i 5G Purple Mist (8GB+128GB)', '85171300', 1, 'pcs', 21910.99, 26999, 31999.00, 18),
(559, 'Mi', 'Mobiles', 'Redmi Note 10T 5G Metallic Blue (6GB+128GB)', '85171300', 2, 'pcs', 13389.73, 17499, 18999.00, 18),
(560, 'Mi', 'Mobiles', 'Redmi 10 Prime Bifrost Blue (4GB+64GB)', '85171300', 0, 'pcs', 10549.31, 13499, 14999.00, 18),
(561, 'Mi', 'Mobiles', 'Redmi Note 11 Pro+ 5G Stealth Black (8GB+128GB)', '85171300', 1, 'pcs', 18664.80, 22999, 26999.00, 18),
(562, 'Mi', 'Mobiles', 'Redmi Note 11 Pro+ 5G Mirage Blue (8GB+128GB)', '85171300', 0, 'pcs', 18664.80, 22999, 26999.00, 18),
(563, 'Mi', 'Mobiles', 'Redmi Note 11 Pro Stealth Black (8GB+128GB)', '85171300', 0, 'pcs', 16230.15, 19999, 24999.00, 18),
(564, 'Mi', 'Mobiles', 'Redmi Note 11 Pro Phantom White (8GB+128GB)', '85171300', 0, 'pcs', 16230.15, 19999, 24999.00, 18),
(565, 'Mi', 'Mobiles', 'Redmi Note 11T 5G Stardust White (6GB+128GB)', '85171300', 1, 'pcs', 14607.05, 16999, 20999.00, 18),
(566, 'Mi', 'Mobiles', 'Redmi 9i Sport Metallic Blue (4GB+64GB)', '85171300', 2, 'pcs', 7303.12, 8799, 9999.00, 18),
(567, 'Mi', 'Mobiles', 'Redmi 9 Activ Coral Green (4GB+64GB)', '85171300', 6, 'pcs', 7708.90, 9499, 10999.00, 18);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) NOT NULL COMMENT 'Autoincrement id',
  `unit` varchar(100) NOT NULL COMMENT 'Unit name',
  `sname` varchar(100) NOT NULL COMMENT 'Shop Name',
  `user` varchar(100) NOT NULL COMMENT 'Name of user ',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date of Entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit`, `sname`, `user`, `doe`) VALUES
(2, 'PC', 'Illusion Store', 'admin', '2024-11-28 14:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(10) NOT NULL COMMENT 'Autoincreemnt id',
  `name` varchar(100) NOT NULL COMMENT 'Name of Employee',
  `mobile` varchar(15) NOT NULL COMMENT 'Mobile no',
  `email` varchar(100) DEFAULT NULL COMMENT 'Email',
  `user` varchar(50) NOT NULL COMMENT 'User name',
  `role` varchar(100) NOT NULL COMMENT 'Role name',
  `location` varchar(100) NOT NULL COMMENT 'Location Name',
  `tip` varchar(50) NOT NULL COMMENT 'IP Address',
  `menu` varchar(100) NOT NULL COMMENT 'Menu name',
  `userreg` varchar(100) NOT NULL COMMENT 'User registration',
  `regdate` date NOT NULL COMMENT 'Date of registration'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `name`, `mobile`, `email`, `user`, `role`, `location`, `tip`, `menu`, `userreg`, `regdate`) VALUES
(2, 'Satyajit Paul', '7005600632', 'satyajitp089@gmail.com', '', 'Manager', 'Central Road', '', '', 'admin', '2020-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `vendore`
--

CREATE TABLE `vendore` (
  `id` int(50) NOT NULL COMMENT 'id Auto Incremented',
  `vcode` varchar(50) NOT NULL COMMENT 'Vendor Code',
  `vendore` varchar(100) NOT NULL COMMENT 'Vendor Name',
  `address` varchar(500) NOT NULL COMMENT 'Vendor address',
  `panno` varchar(10) NOT NULL COMMENT 'Vendor PAN No',
  `gstno` varchar(30) NOT NULL COMMENT 'Vendor GST No',
  `mobile` varchar(10) NOT NULL COMMENT 'Vendor Mobile No',
  `state` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL COMMENT 'shop name',
  `user` varchar(100) NOT NULL COMMENT 'User',
  `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendore`
--

INSERT INTO `vendore` (`id`, `vcode`, `vendore`, `address`, `panno`, `gstno`, `mobile`, `state`, `sname`, `user`, `doe`) VALUES
(28, 'Mun', 'Mun Hks AGs', 'Agartala', 'Bmppd7363f', '16Bmppd7363f', '8787878787', 'Tripura', 'Illusion Store', 'admin', '2024-12-06 15:40:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `daybook`
--
ALTER TABLE `daybook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expm`
--
ALTER TABLE `expm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hsn`
--
ALTER TABLE `hsn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- Indexes for table `ostock`
--
ALTER TABLE `ostock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outstanding`
--
ALTER TABLE `outstanding`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinv` (`sinv`);

--
-- Indexes for table `sales_main`
--
ALTER TABLE `sales_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinv` (`sinv`);

--
-- Indexes for table `sales_master`
--
ALTER TABLE `sales_master`
  ADD PRIMARY KEY (`sinv`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sales_master_main`
--
ALTER TABLE `sales_master_main`
  ADD PRIMARY KEY (`sinv`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `stock1`
--
ALTER TABLE `stock1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockold`
--
ALTER TABLE `stockold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `vendore`
--
ALTER TABLE `vendore`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'auto increament id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=8643;

--
-- AUTO_INCREMENT for table `daybook`
--
ALTER TABLE `daybook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement Id';

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `expm`
--
ALTER TABLE `expm`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id';

--
-- AUTO_INCREMENT for table `hsn`
--
ALTER TABLE `hsn`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'autoincrement id';

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ostock`
--
ALTER TABLE `ostock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `outstanding`
--
ALTER TABLE `outstanding`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `sales_main`
--
ALTER TABLE `sales_main`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `sales_master`
--
ALTER TABLE `sales_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `sales_master_main`
--
ALTER TABLE `sales_master_main`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment id', AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock1`
--
ALTER TABLE `stock1`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented';

--
-- AUTO_INCREMENT for table `stockold`
--
ALTER TABLE `stockold`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincrement id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Autoincreemnt id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendore`
--
ALTER TABLE `vendore`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id Auto Incremented', AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
