-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2019 at 04:47 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

CREATE TABLE `buliding` (
  `buliding_id` varchar(150) NOT NULL,
  `buliding_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buliding`
--

INSERT INTO `buliding` (`buliding_id`, `buliding_name`) VALUES
('A001', '114 เตียง'),
('A002', '75 ปี'),
('A003', 'X_RAY เก่า'),
('A004', 'พิเศษ-สุวัฒนา'),
('A005', 'เฉลิมพระเกียรติฯ'),
('A006', 'อุบัติเหตุ'),
('A007', 'เพชรรัตน์ฯ'),
('A008', '58 ปี');

-- --------------------------------------------------------

--
-- Table structure for table `buliding_floor`
--

CREATE TABLE `buliding_floor` (
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

CREATE TABLE `buliding_room` (
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

CREATE TABLE `department` (
  `department_ID` varchar(100) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `buliding_room_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_name`, `buliding_room_id`) VALUES
('dep001', '(75Y) ศัลยกรรมกระดูก', '75Y1FR1'),
('dep002', '(75Y) กิจกรรมบำบัด', '75Y1FR1'),
('dep003', '(75Y) กายภาพบำบัด', '75Y1FR2'),
('dep004', '(75Y) อายุรกรรมหญิง', '75Y4FR1'),
('dep005', '(75Y) พิเศษอายุรกรรมหญิง', '75Y4FR1'),
('dep006', '(75Y) อายุรกรรมชาย 1', '75Y5FR1'),
('dep007', '(75Y) อายุรกรรมชาย 2', '75Y5FR2'),
('dep071', '(SUW) ตา หู คอ จมูก สุวัทนา', 'SUWAT1FR1'),
('dep072', '(SUW) ศัลยกรรมกระดูกสุวัทนา', 'SUWAT2FR1'),
('dep073', '(SUW) เด็กสามัญสุวัทนา', 'SUWAT3FR1'),
('dep074', '(SUW) พิเศษเด็กสุวัทนา', 'SUWAT4FR1'),
('dep075', '(SUW) พิเศษสุวัทนา', 'SUWAT5FR1'),
('dep201', '(114) สูติ', '114bed_4FR1'),
('dep202', '(114) พัฒนาการเด็ก', '114bed_1FR1'),
('dep203', '(114) สูติกรรม2', '114bed_2FR1'),
('dep204', '(114) สูติสามัญ', '114bed_3FR1'),
('dep999', '(0IT) ศูนย์คอมพิวเตอร์ IT', 'X_RAY2FR1');

-- --------------------------------------------------------

--
-- Table structure for table `provider_type`
--

CREATE TABLE `provider_type` (
  `provider_type_code` int(100) NOT NULL,
  `provider_type_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `repair_report` (
  `repair_report_id` varchar(150) NOT NULL,
  `user_cid` varchar(15) NOT NULL,
  `admin_cid` varchar(30) NOT NULL,
  `adminget_name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `status_fix` varchar(100) NOT NULL,
  `date_in` varchar(150) NOT NULL,
  `date_ex` varchar(150) NOT NULL,
  `assis1_admin_name` varchar(30) NOT NULL,
  `assis2_admin_name` varchar(30) NOT NULL,
  `assis3_admin_name` varchar(30) NOT NULL,
  `type_repair` varchar(150) NOT NULL,
  `callback_phone` varchar(50) NOT NULL,
  `repair_report_text` varchar(400) NOT NULL,
  `repair_report_sumtext` varchar(250) NOT NULL,
  `buliding_room_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair_report`
--

INSERT INTO `repair_report` (`repair_report_id`, `user_cid`, `admin_cid`, `adminget_name`, `address`, `status_fix`, `date_in`, `date_ex`, `assis1_admin_name`, `assis2_admin_name`, `assis3_admin_name`, `type_repair`, `callback_phone`, `repair_report_text`, `repair_report_sumtext`, `buliding_room_id`) VALUES
('A620500000', '1250100287235', '4444444', 'มาดี  ( ดะ)', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'อยู่ระหว่างดำเนินการ', '09-05-2562 06:14:44pm', '', '', '', '', 'โปรแกรม', '1150', 'sadasd', '', 'X_RAY2FR1 '),
('A620500001', '1231231241221', '1250100287235', 'รัชวิทย์  ( เต๋า)', ' แผนก อายุรกรรมหญิง  ห้อง อายุรกรรมหญิง ชั้น 4 อาคาร 75 ปี ', 'ดำเนินการเรียบร้อย', '12-05-2562  01:13:54 pm', '12-05-2562  01:18:28 pm', '-', '-', '-', 'อุปกรณ์คอมพิวเตอร์', '123124', 'adsadasd', 'ทดสอบ', '75Y4FR1 '),
('A620500002', '4444444', '1250100287235', 'ระชะวิทะยะ  ( เต๋า)', ' แผนก สูติ  ห้อง สูตินรีเวชกรรม ชั้น 4 อาคาร 114 เตียง ', 'ดำเนินการเรียบร้อย', '12-05-2562  01:21:55 pm', '12-05-2562  11:15:51 pm', '-', '-', '-', 'อุปกรณ์คอมพิวเตอร์', '12312421', 'print ไม่ไ้ด้\r\n', 'แก้เรียบร้อย', '114bed_4FR1 '),
('A620500003', '4444444', '', '', ' แผนก สูติ  ห้อง สูตินรีเวชกรรม ชั้น 4 อาคาร 114 เตียง ', 'รอดำเนินการ', '12-05-2562  01:22:24 pm', '', '', '', '', 'โปรแกรม', '12312421', 'ไม่มีโปรแกรม Microsoft office', '', '114bed_4FR1 '),
('A620500004', '1232141242132', '', '', ' แผนก (75Y) อายุรกรรมหญิง  ห้อง อายุรกรรมหญิง ชั้น 4 อาคาร 75 ปี ', 'รอดำเนินการ', '12-05-2562  10:59:23 pm', '', '', '', '', 'โปรแกรม', '213421', 'ลอง', '', '75Y4FR1 '),
('A620500005', '1232141242132', '', '', ' แผนก (75Y) อายุรกรรมหญิง  ห้อง อายุรกรรมหญิง ชั้น 4 อาคาร 75 ปี ', 'รอดำเนินการ', '12-05-2562  10:59:46 pm', '', '', '', '', 'อินเทอร์เน็ต', '213421', 'test', '', '75Y4FR1 '),
('A620500006', '1232141242132', '1250100287235', 'ระชะวิทะยะ  ( เต๋า)', ' แผนก อายุรกรรมหญิง  ห้อง อายุรกรรมหญิง ชั้น 4 อาคาร 75 ปี ', 'ดำเนินการเรียบร้อย', '12-05-2562  11:05:15 pm', '15-06-2562  09:46:07 pm', 'มาร์ค', '-', '-', 'อินเทอร์เน็ต', '213421', 'asdsadasdasd', '1234', '75Y4FR1 '),
('A620500007', '1250100287235', '', '', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'รอดำเนินการ', '12-05-2562  11:08:14 pm', '', '', '', '', 'อุปกรณ์คอมพิวเตอร์', '1150', 'asdasd', '', 'X_RAY2FR1 '),
('A620500008', '1250100287235', '', '', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'รอดำเนินการ', '12-05-2562  11:09:24 pm', '', '', '', '', 'อุปกรณ์คอมพิวเตอร์', '1150', 'adsadwrsadasas', '', 'X_RAY2FR1 '),
('A620500009', '1250100287235', '1250100287235', 'ระชะวิทะยะ  ( เต๋า)', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'อยู่ระหว่างดำเนินการ', '12-05-2562  11:12:45 pm', '', '', '', '', 'โปรแกรม', '1150', '33', '', 'X_RAY2FR1 '),
('A620500010', '1250100287235', '1250100287235', 'ระชะวิทะยะ  ( เต๋า)', ' แผนก ศูนย์คอมพิวเตอร์ IT  ห้อง ศูนย์คอมพิวเตอร์ ชั้น 2 อาคาร X_RAY เก่า ', 'ดำเนินการเรียบร้อย', '12-05-2562  11:13:14 pm', '14-05-2562  08:21:58 pm', 'เอก', 'ดอย', 'มาร์ค', 'อุปกรณ์คอมพิวเตอร์', '1150', 'Print เครื่องแม่ได้แต่เครื่องลูกไม่ติด', '-', 'X_RAY2FR1 ');

-- --------------------------------------------------------

--
-- Table structure for table `title_name`
--

CREATE TABLE `title_name` (
  `title_name_id` int(50) NOT NULL,
  `title_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users_account` (
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
('1231231241221', '321', '321', 2, 'มัธธา', 'ดีจัง', '123124', 'dep004', 123124, 'ADMIN', '2019-05-09 19:57:41'),
('1232141242132', '4', 'a87ff679a2f3e71d9181a67b7542122c', 4, 'สวัสดี', 'บ๊ายบาย', 'asd', 'dep004', 213421, 'USER', '2019-05-12 22:56:34'),
('1250100287235', '1', '1', 1, 'ระชะวิทะยะ', 'พะละชะละ', 'เต๋า', 'dep999', 1150, 'SUPERADMIN', '2019-05-04 00:00:00'),
('1321412512512', '22', '22', 3, 'สิรพร', 'จอนจิงจา', 'จา', 'dep005', 125, 'USER', '2019-05-04 19:56:16'),
('2595556526233', '4545', '1f6419b1cbe79c71410cb320fc094775', 1, 'สวัสดี', 'ทดสอบ', 'TTT', 'dep003', 2, 'USER', '2019-05-12 23:11:34'),
('4444444', '3', '3', 1, 'มาดี', 'มีดวง', 'ดะ', 'dep999', 12312421, 'ADMIN', '2019-05-05 21:06:53');

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
  MODIFY `provider_type_code` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `title_name`
--
ALTER TABLE `title_name`
  MODIFY `title_name_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
