-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2019 at 02:29 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `buliding`
--

CREATE TABLE IF NOT EXISTS `buliding` (
  `buliding_id` varchar(150) NOT NULL,
  `buliding_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buliding`
--

INSERT INTO `buliding` (`buliding_id`, `buliding_name`) VALUES
('A001', '114 เตียง'),
('A002', '75 ปี'),
('A003', 'X_RAY เก่า');

-- --------------------------------------------------------

--
-- Table structure for table `buliding_floor`
--

CREATE TABLE IF NOT EXISTS `buliding_floor` (
  `buliding_floor_id` varchar(40) NOT NULL,
  `buliding_floor_name` varchar(100) NOT NULL,
  `buliding_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buliding_floor`
--

INSERT INTO `buliding_floor` (`buliding_floor_id`, `buliding_floor_name`, `buliding_id`) VALUES
('114bed_1F', 'ชั้น 1', 'A001'),
('114bed_2F', 'ชั้น 2', 'A001'),
('114bed_3F', 'ชั้น 3', 'A001'),
('114bed_4F', 'ชั้น 4', 'A001'),
('75Y_1F', 'ชั้น 1', 'A002'),
('75Y_2F', 'ชั้น 2', 'A002'),
('75Y_3F', 'ชั้น 3', 'A002'),
('75Y_4F', 'ชั้น 4', 'A002'),
('75Y_5F', 'ชั้น 5', 'A002'),
('X_RAY2F', 'ชั้น 2', 'A003');

-- --------------------------------------------------------

--
-- Table structure for table `buliding_room`
--

CREATE TABLE IF NOT EXISTS `buliding_room` (
  `buliding_room_id` varchar(40) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `buliding_floor_id` varchar(40) NOT NULL,
  `buliding_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buliding_room`
--

INSERT INTO `buliding_room` (`buliding_room_id`, `room_name`, `buliding_floor_id`, `buliding_id`) VALUES
('114bed_4FR1', 'สูตินรีเวชกรรม', '114bed_4F', 'A001'),
('75Y1FR1', 'ศัลยกรรมกระดูก', '75Y_1F', 'A002'),
('75Y1FR2', 'กายภาพบำบัด', '75Y_1F', 'A002'),
('75Y2FR1', 'ห้อง 1', '75Y_2F', 'A002'),
('75Y3FR1', 'ห้อง 1', '75Y_3F', 'A002'),
('75Y4FR1', 'อายุรกรรมหญิง', '75Y_4F', 'A002'),
('75Y5FR1', 'อายุรกรรมชาย', '75Y_5F', 'A002'),
('X_RAY2FR1', 'ศูนย์คอมพิวเตอร์', 'X_RAY2F', 'A003');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_ID` varchar(100) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `buliding_room_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_name`, `buliding_room_id`) VALUES
('dep001', 'ศัลยกรรมกระดูก', '75Y1FR1'),
('dep002', 'กิจกรรมบำบัด', '75Y1FR1'),
('dep003', 'กายภาพบำบัด', '75Y1FR2'),
('dep004', 'อายุรกรรมหญิง', '75Y4FR1'),
('dep005', 'พิเศษอายุรกรรมหญิง', '75Y4FR1'),
('dep006', 'อายุรกรรมชาย', '75Y5FR1'),
('dep007', 'สูติ', '114bed_4FR1'),
('dep999', 'ศูนย์คอมพิวเตอร์ IT', 'X_RAY2FR1');

-- --------------------------------------------------------

--
-- Table structure for table `provider_type`
--

CREATE TABLE IF NOT EXISTS `provider_type` (
  `provider_type_code` int(100) NOT NULL,
  `provider_type_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_type`
--

INSERT INTO `provider_type` (`provider_type_code`, `provider_type_name`) VALUES
(1, 'แพทย์'),
(2, 'ทันตแพทย์'),
(3, 'พยาบาลวิชาชีพ'),
(4, 'เจ้าพนักงานสาธารณสุขชุมชน'),
(5, 'นักวิชาการสาธารณสุข'),
(6, 'เจ้าพนักงานทันตสาธารณสุข'),
(7, 'อสม (ผู้ให้บริการในชุมชน)'),
(8, 'บุคลากรแพทย์แผนไทย แพทย์พื้นบ้าน'),
(9, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `repair_report`
--

CREATE TABLE IF NOT EXISTS `repair_report` (
  `repair_report_id` varchar(150) NOT NULL,
  `user_cid` varchar(15) NOT NULL,
  `admin_cid` varchar(30) NOT NULL,
  `adminget_name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `status_fix` varchar(100) NOT NULL,
  `date_in` varchar(150) NOT NULL,
  `date_ex` varchar(150) NOT NULL,
  `assis_admin_cid` varchar(30) NOT NULL,
  `assis2_admin_cid` varchar(30) NOT NULL,
  `assis3_admin_cid` varchar(30) NOT NULL,
  `type_repair` varchar(150) NOT NULL,
  `callback_phone` varchar(50) NOT NULL,
  `repair_report_text` varchar(400) NOT NULL,
  `buliding_room_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair_report`
--

INSERT INTO `repair_report` (`repair_report_id`, `user_cid`, `admin_cid`, `adminget_name`, `address`, `status_fix`, `date_in`, `date_ex`, `assis_admin_cid`, `assis2_admin_cid`, `assis3_admin_cid`, `type_repair`, `callback_phone`, `repair_report_text`, `buliding_room_id`) VALUES
('A620500000', '1250100287235', '4444444', 'มาดี  ( ดะ)', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'อยู่ระหว่างดำเนินการ', '09-05-2562 06:14:44pm', '', '', '', '', 'โปรแกรม', '1150', 'sadasd', 'X_RAY2FR1 '),
('A620500002', '1250100287235', '', '', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'รอดำเนินการ', '09-05-2562  06:46:11pm', '', '', '', '', 'อุปกรณ์คอมพิวเตอร์', '1150', 'print test ได้', 'X_RAY2FR1 '),
('A620500003', '1321412512512', '', '', ' แผนก พิเศษอายุรกรรมหญิง  ห้อง อายุรกรรมหญิง ชั้น 4 อาคาร 75 ปี ', 'รอดำเนินการ', '09-05-2562  07:49:15 pm', '', '', '', '', 'โปรแกรม', '125', 'จอฟ้า', '75Y4FR1 ');

-- --------------------------------------------------------

--
-- Table structure for table `title_name`
--

CREATE TABLE IF NOT EXISTS `title_name` (
  `title_name_id` int(50) NOT NULL,
  `title_name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title_name`
--

INSERT INTO `title_name` (`title_name_id`, `title_name`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'น.ส.'),
(4, 'เด็กหญิง'),
(5, 'เด็กชาย');

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE IF NOT EXISTS `users_account` (
  `cid` varchar(13) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title_name_id` int(100) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `niname` varchar(100) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `phone_number` int(20) NOT NULL,
  `status` varchar(60) NOT NULL,
  `inuser_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`cid`, `username`, `password`, `title_name_id`, `fname`, `lname`, `niname`, `department_id`, `phone_number`, `status`, `inuser_date`) VALUES
('1231231241221', '321', 'caf1a3dfb505ffed0d024130f58c5cfa', 2, '123', '24123', '123124', 'dep004', 123124, 'ADMIN', '2019-05-09 19:57:41'),
('1250100287235', '1', '1', 1, 'รัชวิทย์', 'พลชู', 'เต๋า', 'dep999', 1150, 'SUPERADMIN', '2019-05-04 00:00:00'),
('1321412512512', '22', '22', 3, 'สิรพร', 'จอนจิงจา', 'จา', 'dep005', 125, 'USER', '2019-05-04 19:56:16'),
('2312421421421', '12312412', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'สวัสดี', 'ทดสอบ', 'adasd', 'dep001', 1213, 'USER', '2019-05-14 16:40:35'),
('4444444', '3', '3', 1, 'มาดี', 'มีดวง', 'ดะ', 'dep007', 12312421, 'ADMIN', '2019-05-05 21:06:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buliding`
--
ALTER TABLE `buliding`
  ADD PRIMARY KEY (`buliding_id`);

--
-- Indexes for table `buliding_floor`
--
ALTER TABLE `buliding_floor`
  ADD PRIMARY KEY (`buliding_floor_id`);

--
-- Indexes for table `buliding_room`
--
ALTER TABLE `buliding_room`
  ADD PRIMARY KEY (`buliding_room_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `provider_type`
--
ALTER TABLE `provider_type`
  ADD PRIMARY KEY (`provider_type_code`);

--
-- Indexes for table `repair_report`
--
ALTER TABLE `repair_report`
  ADD PRIMARY KEY (`repair_report_id`);

--
-- Indexes for table `title_name`
--
ALTER TABLE `title_name`
  ADD PRIMARY KEY (`title_name_id`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `provider_type`
--
ALTER TABLE `provider_type`
  MODIFY `provider_type_code` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `title_name`
--
ALTER TABLE `title_name`
  MODIFY `title_name_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
