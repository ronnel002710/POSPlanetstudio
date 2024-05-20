-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 09:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3590879_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashier_id` int(10) NOT NULL,
  `cashier_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `cashier_name`, `position`, `username`, `password`, `status`) VALUES
(1, 'Andres P. Jario', 'cashier', 'cashier', 'cashier', 'Active'),
(14, 'Crischel T. Amorio', 'Cashier', 'crischel', 'demo123', 'Active'),
(15, 'Charlotte Ayala', 'Cashier', 'Mollit harum in dolo', 'Pa$$w0rd!', 'DeActive');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Power-train and chassis'),
(2, 'Car body and Main Part'),
(3, 'Doors'),
(4, 'Window'),
(5, 'Low voltage/auxiliary electrical system and electronics'),
(6, 'Low voltage electrical supply system'),
(7, 'Gauges and meters'),
(8, 'Ignition system'),
(9, 'Lighting and signaling system'),
(10, 'Sensors'),
(11, 'Starting system'),
(12, 'Electrical switches'),
(14, 'Miscellaneous'),
(15, 'Floor components and parts'),
(16, 'Other components'),
(17, 'Car seat'),
(18, 'Braking system'),
(19, 'Electrified powertrain components'),
(20, 'Engine components and parts'),
(21, 'Engine cooling system'),
(22, 'Engine oil systems'),
(23, 'Exhaust system'),
(24, 'Fuel supply system'),
(25, 'Suspension and steering systems'),
(26, 'Transmission system'),
(27, 'Air conditioning system (A/C)'),
(28, 'Bearings'),
(29, 'Hose'),
(30, 'Other miscellaneous parts');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `transaction_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `membership_number` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`, `contact`, `membership_number`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Jermaine Baldwin Shelley Banks Urielle Washington', 'Nam soluta accusamus', 'Delectus in magnam ', '', 'Jermaine Baldwin', 'Shelley Banks', 'Urielle Washington'),
(2, 'Lionel Romero Amal Blanchard Valentine Park', 'Ea quis alias hic vo', 'Et consequatur alias', '', 'Lionel Romero', 'Amal Blanchard', 'Valentine Park'),
(3, 'Ivor Battle Shea Baxter Deanna Lawrence', 'Qui dolores repellen', 'Aspernatur qui iusto', '', 'Ivor Battle', 'Shea Baxter', 'Deanna Lawrence');

-- --------------------------------------------------------

--
-- Table structure for table `lose`
--

CREATE TABLE `lose` (
  `p_id` int(10) NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `description_name` varchar(30) NOT NULL,
  `amount_lose` varchar(30) NOT NULL,
  `qty` varchar(30) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `category` varchar(20) NOT NULL,
  `exdate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description_name` varchar(50) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `qty_left` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date_delivered` varchar(20) NOT NULL,
  `expiration_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_name`, `description_name`, `unit`, `cost`, `price`, `supplier`, `qty_left`, `category`, `date_delivered`, `expiration_date`) VALUES
(1, 'P007550', 'Honda', 'Ammeter', 'Per Pieces', '300', '350', 'Andres Auto Parts', 49, 'Gauges and meters', '2020-09-12', ''),
(2, 'P003012', 'Honda', 'Clinometer', 'Per Pieces', '300', '350', 'Andres Auto Parts', 1341, 'Gauges and meters', '2020-09-12', '2020-09-15'),
(3, 'P00627', 'Honda', 'Dynamometer', 'Per Pieces', '500', '600', 'Others', 9, 'Gauges and meters', '2020-09-11', ''),
(5, 'PC4711998', 'zuzuki', 'Anti-intrusion bar', 'Per Pieces', '500', '600', 'Cebu Massive Auto Parts, Inc.', 18, 'Doors', '2020-09-16', ''),
(6, 'PC6108219', 'Honda', 'Outer door handle', 'Per Pieces', '500', '600', 'ILOILO AUTO SUPPLY', 20, 'Doors', '2020-09-16', ''),
(7, 'PC7491130', 'Honda', 'Inner door handle', 'Per Pieces', '300', '350', 'ILOILO AUTO SUPPLY', 43, 'Doors', '2020-09-16', ''),
(8, 'PC6334151', 'Honda', 'Window motor', 'Per Pieces', '500', '600', 'ILOILO AUTO SUPPLY', 0, 'Doors', '2020-09-16', ''),
(9, 'PC5896113', 'zuzuki', 'Door control module', 'Per Pieces', '1000', '1300', 'Junry Auto Supply', 49, 'Doors', '2020-09-16', ''),
(10, 'PC5201233', 'zuzuki', 'Bonnet/hood', 'Per Pieces', '1000', '1300', 'William Auto Supply', 0, 'Car body and Main Part', '2020-09-16', ''),
(11, 'PC296401', 'zuzuki', 'Trunk/boot/hatch', 'Per Pieces', '3000', '3500', 'Kapitan Auto Parts', 48, 'Car body and Main Part', '2020-09-16', ''),
(12, 'PC3501296', 'zuzuki', 'Window seal', 'Per Pieces', '500', '600', 'Pyeza Parts Depot Inc.', 48, 'Window', '2020-09-16', ''),
(13, 'PC6627237', 'Samsung', 'Headset', 'Per Box', '100', '150', 'Cebu Big Bike Protections and Accessories', 0, 'Doors', '2020-09-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `unit_id` int(11) NOT NULL,
  `unit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`unit_id`, `unit`) VALUES
(3, 'Per Pieces'),
(4, 'Per Box');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `date_order` varchar(100) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `date_deliver` varchar(100) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `qty` varchar(30) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `date_recieved` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`transaction_id`, `invoice_number`, `date_order`, `suplier`, `date_deliver`, `p_name`, `qty`, `cost`, `status`, `remark`, `date_recieved`) VALUES
(41, 'PO-BT4LM', '2020-09-23', 'Andres Auto Parts', '2020-09-23', 'P007550', '3', '900', 'Received', ' ', '2022-02-01'),
(43, 'PO-PWKJ9', '2020-09-23', 'Andres Auto Parts', '2020-09-23', 'P003012', '1', '300', 'Received', ' OKS', '2020-09-24'),
(44, 'PO-F16L9', '2021-05-21', 'ILOILO AUTO SUPPLY', '2021-05-21', 'PC6334151', '1', '500', 'pending', '', ''),
(45, 'PO-F16L9', '2021-05-21', 'ILOILO AUTO SUPPLY', '2021-05-20', 'PC7491130', '2', '600', 'pending', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_item`
--

CREATE TABLE `purchases_item` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL,
  `date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchases_item`
--

INSERT INTO `purchases_item` (`id`, `name`, `qty`, `cost`, `invoice`, `status`, `date`) VALUES
(39, 'P003012', 2, '300', 'PO-7TN72', 'pending', '2020-09-23'),
(40, 'PC7491130', 1, '300', 'PO-PKN74', 'pending', '2020-09-23'),
(41, 'PC6334151', 1, '500', 'PO-PKN74', 'pending', '2020-09-23'),
(42, 'P007550', 1, '300', 'PO-4U9JE', 'Received', '2020-09-23'),
(43, 'P007550', 3, '900', 'PO-BT4LM', 'Received', '2020-09-23'),
(44, 'P007550', 1, '300', 'PO-PWKJ9', 'Received', '2020-09-23'),
(45, 'P003012', 1, '300', 'PO-PWKJ9', 'Received', '2020-09-23'),
(46, 'PC6334151', 1, '500', 'PO-F16L9', 'pending', '2021-05-21'),
(47, 'PC7491130', 2, '600', 'PO-F16L9', 'pending', '2021-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `due_date` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `balance` varchar(250) NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `cash` varchar(100) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `p_amount` varchar(30) NOT NULL,
  `vat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`transaction_id`, `invoice_number`, `cashier`, `date`, `type`, `amount`, `due_date`, `name`, `balance`, `total_amount`, `cash`, `month`, `year`, `p_amount`, `vat`) VALUES
(62, 'IN00977062541', 'Crischel T. Amorio', '2020-09-23', 'cash', '350', '', '', '', '', '500', 'September', '2020', '350', '0'),
(63, 'IN00276021430', 'Andres P. Jario', '2020-09-23', 'cash', '1300', '', '', '', '', '1300', 'August', '2020', '1300', '0'),
(64, 'IN00333801463', 'Andres P. Jario', '2020-09-23', 'cash', '1200', '', '', '', '', '2000', 'July', '2020', '1200', '0'),
(65, 'IN0002366656', 'Crischel T. Amorio', '2020-09-23', 'cash', '350', '', '', '', '', '500', 'June', '2020', '350', '0'),
(66, 'IN0049787246', 'Andres P. Jario', '2020-09-24', 'cash', '2300', '', '', '', '', '500', 'May', '2020', '350', '0'),
(67, 'IN00751064491', 'Andres P. Jario', '2020-09-26', 'cash', '350', '', '', '', '', '500', 'September', '2020', '350', '0'),
(68, 'IN00751064491', 'Andres P. Jario', '2020-09-26', 'cash', '350', '', '', '', '', '500', 'September', '2020', '350', '0'),
(69, 'IN0021827442', 'Crischel T. Amorio', '2021-10-11', 'cash', '350', '', '', '', '', '500', 'October', '2021', '350', '0'),
(70, 'IN008047785', 'Andres P. Jario', '2022-02-01', 'cash', '1900', '', '', '', '', '2000', 'January', '2022', '1900', '0'),
(71, 'IN008047785', 'Andres P. Jario', '2022-02-02', 'cash', '1900', '', '', '', '', '2000', 'January', '2022', '1900', '0'),
(72, 'IN00539664865', 'Andres P. Jario', '2022-02-01', 'cash', '350', '', '', '', '', '500', 'February', '2022', '350', '0'),
(73, 'IN00479566477', 'Andres P. Jario', '2024-05-20', 'cash', '700', '', '', '', '', '700', 'May', '2024', '700', '0'),
(74, 'IN003166640', 'Andres P. Jario', '2024-05-20', 'cash', '350', '', '', '', '', '350', 'May', '2024', '350', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` varchar(250) NOT NULL,
  `omonth` varchar(25) NOT NULL,
  `oyear` varchar(25) NOT NULL,
  `qtyleft` varchar(25) NOT NULL,
  `dname` varchar(50) NOT NULL,
  `vat` varchar(20) NOT NULL,
  `total_amount` varchar(30) NOT NULL,
  `customer_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`transaction_id`, `invoice`, `product`, `qty`, `amount`, `name`, `price`, `discount`, `category`, `date`, `omonth`, `oyear`, `qtyleft`, `dname`, `vat`, `total_amount`, `customer_name`) VALUES
(80, 'IN00977062541', 'PC7491130', '1', '350', 'Honda', '350', '0', 'Doors', '2020-09-23', 'September', '2020', '44', 'Inner door handle', '0', '350', NULL),
(81, 'IN00276021430', 'PC5896113', '1', '1300', 'zuzuki', '1300', '0', 'Doors', '2020-09-23', 'September', '2020', '49', 'Door control module', '0', '1300', NULL),
(82, 'IN00333801463', 'PC4711998', '2', '1200', 'zuzuki', '600', '0', 'Doors', '2020-09-23', 'September', '2020', '18', 'Anti-intrusion bar', '0', '1200', NULL),
(83, 'IN0002366656', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2020-09-23', 'September', '2020', '34', 'Ammeter', '0', '350', NULL),
(84, 'IN0049787246', 'PC7491130', '1', '350', 'Honda', '350', '0', 'Doors', '2020-09-24', 'September', '2020', '43', 'Inner door handle', '0', '350', NULL),
(85, 'IN00403025933', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2020-09-25', 'September', '2020', '37', 'Ammeter', '0', '350', NULL),
(86, 'IN00751064491', 'P003012', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2020-09-26', 'September', '2020', '13', 'Clinometer', '0', '350', NULL),
(87, 'IN0021827442', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2021-10-11', 'October', '2021', '37', 'Ammeter', '0', '350', NULL),
(88, 'IN008047785', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2022-01-31', 'January', '2022', '36', 'Ammeter', '0', '350', NULL),
(89, 'IN008047785', 'P003012', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2022-01-31', 'January', '2022', '1350', 'Clinometer', '0', '350', NULL),
(90, 'IN008047785', 'P00627', '2', '1200', 'Honda', '600', '0', 'Gauges and meters', '2022-01-31', 'January', '2022', '10', 'Dynamometer', '0', '1200', NULL),
(91, 'IN00539664865', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2022-02-01', 'February', '2022', '50', 'Ammeter', '0', '350', NULL),
(92, 'IN00479566477', 'P003012', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2024-05-20', 'May', '2024', '1342', 'Clinometer', '0', '350', 'Jermaine Baldwin Shelley Banks Urielle Washington'),
(93, 'IN00479566477', 'P003012', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2024-05-20', 'May', '2024', '1341', 'Clinometer', '0', '350', NULL),
(94, 'IN003166640', 'P007550', '1', '350', 'Honda', '350', '0', 'Gauges and meters', '2024-05-20', 'May', '2024', '49', 'Ammeter', '0', '350', 'Jermaine Baldwin Shelley Banks Urielle Washington');

-- --------------------------------------------------------

--
-- Table structure for table `supliers`
--

CREATE TABLE `supliers` (
  `suplier_id` int(11) NOT NULL,
  `suplier_name` varchar(100) NOT NULL,
  `suplier_address` varchar(100) NOT NULL,
  `suplier_contact` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supliers`
--

INSERT INTO `supliers` (`suplier_id`, `suplier_name`, `suplier_address`, `suplier_contact`, `contact_person`) VALUES
(1, 'Andres Auto Parts', 'Dumaguete City', '09358167104', 'Andres P. Jario'),
(2, 'Magnet Auto Parts', 'Mabinay Negros Oriental', '09358167010', 'Crischel Amorio'),
(3, 'Cebu Massive Auto Parts, Inc.', 'Cebu City, Cebu', '(032) 256 0608', 'None'),
(4, 'Kapitan Auto Parts', 'Cebu City, Cebu', '(032) 350 2921', 'none'),
(5, 'Junry Auto Supply', 'Mandaue City, Cebu', '0932 211 1046', ''),
(6, 'Pyeza Parts Depot Inc.', 'Mandaue City, Cebu', '(032) 350 9472', ''),
(7, 'ILOILO AUTO SUPPLY', 'Iloilo City, Iloilo', '0917 724 2111', ''),
(8, 'ILOILO 3B Auto Parts', 'Iloilo City, Iloilo', '(033) 320 7350', ''),
(9, 'All Batteries - Banawa', 'Cebu City, Cebu', '(032) 412 9012', ''),
(10, 'All Batteries - Talisay', 'Talisay, Cebu', '(032) 231 5893', ''),
(11, 'Cebu Big Bike Protections and Accessories', 'Lapu-Lapu City, Cebu', '0995 743 9049', ''),
(12, 'William Auto Supply', 'Iloilo City, Iloilo', '(033) 508 6547', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `profile` text NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`, `profile`, `firstname`, `lastname`) VALUES
(1, 'admin', 'demo123', 'Admin', 'Admin', '', 'Andres ', 'Jario'),
(2, 'ronnel', '123456', '', 'Admin', '', 'ronnel', ''),
(3, 'Quoved', 'Pa$$w0rd!', '', 'Admin', '', 'Christopher Skinner', '');

-- --------------------------------------------------------

--
-- Table structure for table `vat_table`
--

CREATE TABLE `vat_table` (
  `vatid` int(11) NOT NULL,
  `vat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vat_table`
--

INSERT INTO `vat_table` (`vatid`, `vat`) VALUES
(1, '.12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `lose`
--
ALTER TABLE `lose`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `purchases_item`
--
ALTER TABLE `purchases_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat_table`
--
ALTER TABLE `vat_table`
  ADD PRIMARY KEY (`vatid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lose`
--
ALTER TABLE `lose`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `purchases_item`
--
ALTER TABLE `purchases_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `supliers`
--
ALTER TABLE `supliers`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vat_table`
--
ALTER TABLE `vat_table`
  MODIFY `vatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
