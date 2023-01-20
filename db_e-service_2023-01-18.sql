-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2023 at 11:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_e-service`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_attachment`
--

CREATE TABLE `tb_attachment` (
  `id_attachment` int NOT NULL,
  `ref_id_machine` int NOT NULL,
  `attachment_sort` int DEFAULT NULL,
  `path_attachment_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_type` int NOT NULL COMMENT '1-รูป/2-ไฟล์แนบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บไฟล์รูป';

--
-- Dumping data for table `tb_attachment`
--

INSERT INTO `tb_attachment` (`id_attachment`, `ref_id_machine`, `attachment_sort`, `path_attachment_name`, `attachment_type`) VALUES
(1, 1, NULL, 'd67e628c6d89f807c2c3d426f5f608fd.jpg', 1),
(2, 2, NULL, 'fea4024522c07b76d0ec2ff46a4b6ba2.jpg', 1),
(3, 3, NULL, '83f738c1c3a73a9d6aadb9dbc398bb26.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

CREATE TABLE `tb_brand` (
  `id_brand` int NOT NULL,
  `brand_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_remark` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_status` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางแบรนด์สินค้า';

--
-- Dumping data for table `tb_brand`
--

INSERT INTO `tb_brand` (`id_brand`, `brand_name`, `brand_remark`, `brand_status`) VALUES
(1, 'Pumpkin', '', 1),
(2, 'kingtony', 'kingtony ', 1),
(3, 'Bosch', '', 1),
(4, 'Kingtons', 'Ram and all storage', 1),
(5, 'Dewalt', 'Dewalt', 1),
(6, 'Dell Computer & Laptop', 'Dell Computer & Laptop', 1),
(7, 'Makita', 'เครื่องมือช่าง', 1),
(8, '3M', 'เทส', 1),
(9, 'Nichiyu', '', 1),
(10, 'Sumitomo', '', 1),
(11, 'Danfoss', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_building`
--

CREATE TABLE `tb_building` (
  `id_building` int NOT NULL,
  `ref_id_site` int NOT NULL COMMENT 'อ้างอิงไอดีไซต์งาน',
  `building_initialname` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อย่ออาคาร',
  `building_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่ออาคาร',
  `building_status` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลอาคาร';

--
-- Dumping data for table `tb_building`
--

INSERT INTO `tb_building` (`id_building`, `ref_id_site`, `building_initialname`, `building_name`, `building_status`) VALUES
(1, 1, NULL, 'PCS - อาคาร 1', 2),
(2, 1, NULL, 'PCS - อาคาร 2', 1),
(3, 1, NULL, 'PCS - อาคาร 3', 2),
(4, 1, NULL, 'PCS - อาคาร 4', 1),
(5, 1, NULL, 'PCS - อาคาร 5', 1),
(6, 1, NULL, 'PCS - อาคาร 6', 1),
(7, 1, NULL, 'PCS - อาคาร 7', 2),
(8, 1, NULL, 'PCS - อาคาร 8', 2),
(9, 1, NULL, 'PCS - อาคาร 9', 1),
(10, 2, NULL, 'อาคาร A', 1),
(11, 2, NULL, 'อาคาร B', 1),
(12, 2, NULL, 'อาคาร C', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id_menu` int NOT NULL,
  `menu_code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_menu` int NOT NULL COMMENT '1-หมวดหลัก/2-หมวดรอง/3-หมวดย่อย',
  `sort_menu` int DEFAULT NULL COMMENT 'เรียงลำดับหมวด',
  `ref_id_menu` int DEFAULT NULL COMMENT 'REF.ไอดีหมวดหลัก',
  `ref_id_sub` int DEFAULT NULL COMMENT 'REF.ไอดีหมวดหลัก',
  `ref_id_dept` int NOT NULL COMMENT 'REF.แผนกที่รับผิดชอบ',
  `name_menu` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_menu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_adddate` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `menu_editdate` datetime DEFAULT NULL,
  `ref_id_user_edit` int DEFAULT NULL,
  `status_menu` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางประเภเครื่องจักรและอุปกรณ์';

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id_menu`, `menu_code`, `level_menu`, `sort_menu`, `ref_id_menu`, `ref_id_sub`, `ref_id_dept`, `name_menu`, `desc_menu`, `menu_adddate`, `ref_id_user_add`, `menu_editdate`, `ref_id_user_edit`, `status_menu`) VALUES
(1, NULL, 1, NULL, NULL, NULL, 7, 'Air Blast (ห้องฟรีส)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(2, NULL, 1, NULL, NULL, NULL, 7, 'Air Cleaner, Particulate/Gas/Vapor', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(3, NULL, 1, NULL, NULL, NULL, 7, 'Air Conditioner (แอร์)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(4, NULL, 1, NULL, NULL, NULL, 7, 'Air Cooled Chiller, แอร์ชิลเลอร์ (เครื่องทำความเย็น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(5, NULL, 1, NULL, NULL, NULL, 7, 'Air Handling Unit (AHU) (เครื่องส่งลม, เครื่องควบคุมอากาศ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(6, NULL, 1, NULL, NULL, NULL, 7, 'Air Purger', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(7, NULL, 1, NULL, NULL, NULL, 7, 'Air Shower, แอร์ชาวเวอร์ (ม่านอากาศ, พัดลมเป่าอากาศ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(8, NULL, 1, NULL, NULL, NULL, 7, 'Ammonia Shell and Tube Tank', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(9, NULL, 1, NULL, NULL, NULL, 7, 'Analog Multimeter', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(10, NULL, 1, NULL, NULL, NULL, 7, 'ASRS System (ระบบจัดเก็บสินค้าอัตโนมัติ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(11, NULL, 1, NULL, NULL, NULL, 7, 'Auto Door (ประตูอัตโนมัติ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(12, NULL, 1, NULL, NULL, NULL, 7, 'AUTO SCRUBBING MACHINE(เครื่องขัดพื้น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(13, NULL, 1, NULL, NULL, NULL, 7, 'Auto speed  Door', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(14, NULL, 1, NULL, NULL, NULL, 7, 'Belt Convayer (สายพานลำเลียงยาง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(15, NULL, 1, NULL, NULL, NULL, 7, 'Car Lift (รถแฮนด์ลิฟท์)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(16, NULL, 1, NULL, NULL, NULL, 7, 'Carbon Filter Tank (ถังกรองคาร์บอน, ถังกรองถ่าน)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(17, NULL, 1, NULL, NULL, NULL, 7, 'Chill Tunnel', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(18, NULL, 1, NULL, NULL, NULL, 7, 'Chilling Storage Room', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(19, NULL, 1, NULL, NULL, NULL, 7, 'Cold Pack Chilling Unit', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(20, NULL, 1, NULL, NULL, NULL, 7, 'Cold Room (ห้องเย็น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(21, NULL, 1, NULL, NULL, NULL, 7, 'Compressor, คอมเพรสเซอร์', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(22, NULL, 1, NULL, NULL, NULL, 7, 'Conveyor (สายพานลำเลียง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(23, NULL, 1, NULL, NULL, NULL, 7, 'Cooling Tower (หอหล่อเย็น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(24, NULL, 1, NULL, NULL, NULL, 7, 'Debox Machine', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(25, NULL, 1, NULL, NULL, NULL, 7, 'Digital Thermometer (เทอร์โมมิเตอร์แบบดิจิตอล)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(26, NULL, 1, NULL, NULL, NULL, 7, 'Digital Thermometer with Probe (โพรบวัดอุณหภูมิ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(27, NULL, 1, NULL, NULL, NULL, 7, 'Dock Leveler (สะพานปรับระดับ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(28, NULL, 1, NULL, NULL, NULL, 7, 'Electric Forklift (รถโฟล์คลิฟท์ไฟฟ้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(29, NULL, 1, NULL, NULL, NULL, 7, 'Electric Insect Killer (เครื่องดักแมลง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(30, NULL, 1, NULL, NULL, NULL, 7, 'Electrical Control Panel (ตู้คอนโทรลไฟฟ้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(31, NULL, 1, NULL, NULL, NULL, 7, 'Electronic Balance', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(32, NULL, 1, NULL, NULL, NULL, 7, 'Emergency Light (ไฟฉุกเฉิน)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(33, NULL, 1, NULL, NULL, NULL, 7, 'Evaporative Condenser (เครื่องควบแน่นแบบระเหย, ระบายความร้อนแบบการระเหย)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(34, NULL, 1, NULL, NULL, NULL, 7, 'Evaporator', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(35, NULL, 1, NULL, NULL, NULL, 7, 'Fire Pump (ปั๊มน้ำดับเพลิง, เครื่องสูบน้ำดับเพลิง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(36, NULL, 1, NULL, NULL, NULL, 7, 'Fish Washer (เครื่องล้างปลา)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(37, NULL, 1, NULL, NULL, NULL, 7, 'Forklift (รถโฟล์คลิฟท์)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(38, NULL, 1, NULL, NULL, NULL, 7, 'Forklift, โฟล์คลิฟท์ (รถยก)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(39, NULL, 1, NULL, NULL, NULL, 7, 'Gas Detector (เครื่องวัดแก็ส)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(40, NULL, 1, NULL, NULL, NULL, 7, 'Generator (เครื่องปั่นไฟ, เครื่องกำเนิดไฟฟ้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(41, NULL, 1, NULL, NULL, NULL, 7, 'High Pressure Pump (ปั้มแรงดันสูง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(42, NULL, 1, NULL, NULL, NULL, 7, 'Infrared Thermometer (เครื่องวัดอุณหภูมิอินฟาเรด)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(43, NULL, 1, NULL, NULL, NULL, 7, 'Inter Cooler Tank', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(44, NULL, 1, NULL, NULL, NULL, 7, 'Inverter Solar', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(45, NULL, 1, NULL, NULL, NULL, 7, 'Lift Machine (ลิฟท์ยกของ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(46, NULL, 1, NULL, NULL, NULL, 7, 'Low Pressure Pump', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(47, NULL, 1, NULL, NULL, NULL, 7, 'Low Pressure Reciver', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(48, NULL, 1, NULL, NULL, NULL, 7, 'Lux Meter (เครื่องวัดความเข้มแสง, เครื่องวัดแสง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(49, NULL, 1, NULL, NULL, NULL, 7, 'Machine Balance', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(50, NULL, 1, NULL, NULL, NULL, 7, 'Magnetic Conveyor (สายพานลำเลียงแบบแม่เหล็ก)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(51, NULL, 1, NULL, NULL, NULL, 7, 'Meat Seperator (เครื่องรีดเนื้อ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(52, NULL, 1, NULL, NULL, NULL, 7, 'Metal Detector (เครื่องตรวจจับโลหะ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(53, NULL, 1, NULL, NULL, NULL, 7, 'Mobile Rack (ชั้นวางสินค้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(54, NULL, 1, NULL, NULL, NULL, 7, 'Power Meter, Radiofrequency, Shortwave Diathermy Unit', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(55, NULL, 1, NULL, NULL, NULL, 7, 'Power Pallet Truck (รถพาเลทไฟฟ้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(56, NULL, 1, NULL, NULL, NULL, 7, 'Pump Vessel', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(57, NULL, 1, NULL, NULL, NULL, 7, 'Pump, ปั๊ม (เครื่องสูบ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(58, NULL, 1, NULL, NULL, NULL, 7, 'Refrigerator (ตู้แช่เย็น, ตู้เย็น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(59, NULL, 1, NULL, NULL, NULL, 7, 'Resin Fillter Tanks (ถังกรองเรซิ่น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(60, NULL, 1, NULL, NULL, NULL, 7, 'Reverse Osmosis (RO) (การกรองน้ำแบบ Reverse Osmosis)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(61, NULL, 1, NULL, NULL, NULL, 7, 'Rolling Machine', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(62, NULL, 1, NULL, NULL, NULL, 7, 'Sand Tank', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(63, NULL, 1, NULL, NULL, NULL, 7, 'Sandblasting Machine (เครื่องยิงทราย)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(64, NULL, 1, NULL, NULL, NULL, 7, 'Screw Compressor (เครื่องอัดลมแบบสกรู, ปั๊มลมสกรู)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(65, NULL, 1, NULL, NULL, NULL, 7, 'Softener Filter Tank (ระบบถังกรองน้ำอ่อน)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(66, NULL, 1, NULL, NULL, NULL, 7, 'Spiral Freezer Conveyor', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(67, NULL, 1, NULL, NULL, NULL, 7, 'Standard Weight (F1) (ตุ้มน้ำหนัก)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(68, NULL, 1, NULL, NULL, NULL, 7, 'Standard Weight (ตุ้มน้ำหนักมาตรฐาน)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(69, NULL, 1, NULL, NULL, NULL, 7, 'Strapping Machine (เครื่องรัดกล่อง)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(70, NULL, 1, NULL, NULL, NULL, 7, 'Temperature And Humidity (เครื่องวัดอุณหภูมิและความชื้น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(71, NULL, 1, NULL, NULL, NULL, 7, 'Thermo-Hygrometer (เครื่องวัดอุณหภูมิและความชื้น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(72, NULL, 1, NULL, NULL, NULL, 7, 'Transformer (หม้อแปลงไฟฟ้า)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(73, NULL, 1, NULL, NULL, NULL, 7, 'Washer (เครื่องล้างถาด)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(74, NULL, 1, NULL, NULL, NULL, 7, 'Wastewater Treatment (ระบบบําบัดน้ําเสีย)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(75, NULL, 1, NULL, NULL, NULL, 7, 'Wastwater Treatment Tank (บ่อบำบัดน้ำเสีย)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(76, NULL, 1, NULL, NULL, NULL, 7, 'Water Cooler (เครื่องทำน้ำเย็น)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(77, NULL, 1, NULL, NULL, NULL, 7, 'Water Pump (ปั๊มน้ำ, เครื่องสูบน้ำ)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(78, NULL, 1, NULL, NULL, NULL, 7, 'Wood Impregnation Vessel (ถังอัดน้ำยา, เครื่องอัดน้ายา)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
(79, 'HWA', 1, NULL, NULL, NULL, 13, 'ฮาร์ดแวร์คอมพิวเตอร์', 'ฮาร์ดแวร์ในเครื่องคอมพิวเตอร์ (CPU RAM HDD MD)', '2023-01-06 16:58:35', 1, NULL, NULL, 1),
(80, 'ITA', 1, NULL, NULL, NULL, 13, 'อุปกรณ์ไอทีทั้งหมด', 'เช่น CPU RAM HDD MB', '2023-01-10 13:08:23', 1, NULL, NULL, 1),
(81, 'HDD', 2, NULL, 79, NULL, 13, 'Hard Disk', NULL, '2023-01-07 10:46:33', 1, NULL, NULL, 1),
(82, 'RAM', 2, NULL, 79, NULL, 13, 'แรม', 'Ram', '2023-01-07 11:14:59', 1, NULL, NULL, 1),
(83, 'NTW', 1, NULL, NULL, NULL, 13, 'อุปกรณ์ระบบ Network', 'อุปกรณ์ระบบ Network ทั้งหมด', '2023-01-07 08:51:24', 1, NULL, NULL, 1),
(84, 'CTV', 1, NULL, NULL, NULL, 13, 'อุปกรณ์ระบบกล้อง CCTV', 'อุปกรณ์ระบบ Network', '2023-01-07 08:52:00', 1, NULL, NULL, 1),
(85, 'MTR', 1, NULL, NULL, NULL, 13, 'จอมอนิเตอร์', 'จอมอนิเตอร์', '2023-01-07 11:12:35', 1, NULL, NULL, 1),
(86, 'SPK', 1, NULL, NULL, NULL, 13, 'ลำโพงบูลทูธ', 'ลำโพงบูลทูธ', '2023-01-07 11:13:25', 1, NULL, NULL, 1),
(87, 'UPS', 1, NULL, NULL, NULL, 13, 'เครื่องสำรองไฟ', NULL, '2023-01-07 11:14:10', 1, NULL, NULL, 1),
(88, 'ROU', 2, NULL, 83, NULL, 13, 'เราเตอร์', NULL, '2023-01-07 11:14:44', 1, NULL, NULL, 1),
(89, 'NTB', 1, NULL, NULL, NULL, 13, 'Notebook', 'รวมทุกแบรนด์', '2023-01-18 08:25:19', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_caused_by_code`
--

CREATE TABLE `tb_caused_by_code` (
  `id_caused_by_code` int NOT NULL,
  `ref_id_dept` int NOT NULL COMMENT 'REF.ไอดีแผนก',
  `caused_by_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสสาเหตุเสีย',
  `caused_by_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สาเหตุเสีย',
  `caused_by_remark` longtext COLLATE utf8mb4_unicode_ci,
  `caused_by_code_status` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางข้อมูลสาเหตุเสีย(MASTER)';

--
-- Dumping data for table `tb_caused_by_code`
--

INSERT INTO `tb_caused_by_code` (`id_caused_by_code`, `ref_id_dept`, `caused_by_code`, `caused_by_name`, `caused_by_remark`, `caused_by_code_status`) VALUES
(1, 13, 'ITF-01', 'ไดรฟ์เวอร์มีปัญหา,เสีย', 'ไดรฟ์เวอร์มีปัญหา,เสีย', 1),
(2, 13, 'ITF-02', 'HDD BAD Sector / Error Code', 'ติดแบด, มี Error Code', 1),
(3, 13, 'ITF-03', 'Hardware เสียหาย', 'Hardware เสียหาย', 1),
(4, 13, 'ITF-04', 'เสื่อมสภาพ-หมดอายุการใช้งาน', 'ใช้กับทุก Device', 1),
(5, 13, 'ITF-05', 'แบตเตอรี่เสื่อม', 'แบตเตอรี่เสื่อม **ใช้กับทุก Device', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dept`
--

CREATE TABLE `tb_dept` (
  `id_dept` int NOT NULL,
  `dept_initialname` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mt_request_manage` int NOT NULL COMMENT 'จัดการใบแจ้งซ่อมได้ (1-ได้/2-ไม่ได้)',
  `dept_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลแผนกในบริษัท';

--
-- Dumping data for table `tb_dept`
--

INSERT INTO `tb_dept` (`id_dept`, `dept_initialname`, `mt_request_manage`, `dept_name`, `dept_status`) VALUES
(1, 'MM', 2, 'ฝ่ายบริหาร', 1),
(2, 'MK', 2, 'ฝ่ายการตลาด', 1),
(3, 'CS', 2, 'ฝ่ายบริการลูกค้า', 1),
(4, 'TP', 2, 'ฝ่ายขนส่ง', 1),
(5, 'WH', 2, 'ฝ่ายคลังสินค้า', 1),
(6, 'WI', 2, 'Inventory', 1),
(7, 'MT', 1, 'ซ่อมบำรุง', 1),
(8, 'EN', 1, 'ฝ่ายวิศวกรรม', 1),
(9, 'HA', 2, 'ฝ่ายบุคคล/ธุรการ', 1),
(10, 'HR', 2, 'บุคคล', 1),
(11, 'AP', 2, 'ธุรการ', 1),
(12, 'MI', 2, 'ฝ่ายบริหารจัดการระบบ', 1),
(13, 'IT', 1, 'เทคโนโลยีสารสนเทศ', 1),
(14, 'MIS', 1, 'จัดการข้อมูล', 1),
(15, 'PC', 2, 'ฝ่ายจัดซื้อ', 1),
(16, 'AF', 2, 'ฝ่ายบัญชี/การเงิน', 1),
(17, 'AC', 2, 'บัญชี', 1),
(18, 'FI', 2, 'การเงิน', 1),
(19, 'CC', 2, 'บริหารงบ', 1),
(20, 'QA', 2, 'ฝ่ายประกันคุณภาพ', 1),
(21, 'ST', 2, 'ความปลอดภัย', 1),
(22, 'GA', 2, 'ฝ่ายงานราชการ', 1),
(23, 'test', 2, 'test test test test test test ', 2),
(24, 'tetxx', 2, 'test xxx', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_failure_code`
--

CREATE TABLE `tb_failure_code` (
  `id_failure_code` int NOT NULL,
  `ref_id_dept` int NOT NULL COMMENT 'REF.รหัสแผนก',
  `failure_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสอาการเสีย',
  `failure_code_th_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่ออาการเสียไทย',
  `failure_code_en_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่ออาการเสียไทย-ENG',
  `failure_code_remark` longtext COLLATE utf8mb4_unicode_ci,
  `failure_code_status` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บรหัสอาการเสีย (Master)';

--
-- Dumping data for table `tb_failure_code`
--

INSERT INTO `tb_failure_code` (`id_failure_code`, `ref_id_dept`, `failure_code`, `failure_code_th_name`, `failure_code_en_name`, `failure_code_remark`, `failure_code_status`) VALUES
(1, 7, 'FC01', 'ทรุด', 'Collapsed', '', 1),
(2, 7, 'FC02', 'เสี่อมสภาพ / ครบอายุการใช้งาน', 'Deteriorate / completed lifetime', '', 1),
(3, 7, 'FC03', 'เสียรูป', 'Deformed', '', 1),
(4, 7, 'FC04', 'รั่ว / ซึม', 'Leak / seep', '', 1),
(5, 7, 'FC05', 'หลุด / หลวม / หย่อน', 'Loose / loose / slack', '', 1),
(6, 7, 'FC06', 'แตกร้าว / หัก', 'Broken / broken', '', 1),
(7, 7, 'FC07', 'ขาด', 'Tear', '', 1),
(8, 7, 'FC08', 'สั่น / โยกคลอน', 'Shake', '', 1),
(9, 7, 'FC09', 'สึกหรอ / ผุ', 'Decay', '', 1),
(10, 7, 'FC10', 'เสียดสี', 'Friction', '', 1),
(11, 7, 'FC11', ' เสียงดัง', 'Loud Noise', '', 1),
(12, 7, 'FC12', 'ไม่ทำงาน', 'Not Functioned', '', 1),
(13, 7, 'FC13', 'อุดตัน / ไม่ไหล', 'Clogged / not flowing', '', 1),
(14, 7, 'FC14', 'สิ่งแปลกปลอม', 'Foreign object', '', 2),
(15, 7, 'FC15', 'Error / ทำงานผิดเงื่อนไข', 'Error / Wrong working condition', '', 1),
(16, 7, 'FC16', 'ร้อน / ไหม้ / หลอมละลาย', 'Hot / burning / melting', '', 1),
(17, 7, 'FC17', 'กลิ่นผิดปกติ', 'Unusual smell', '', 1),
(18, 7, 'FC18', 'สูญหาย', 'Lost', '', 1),
(19, 7, 'FC19', ' ไฟรั่ว / ลัดวงจร', 'Leak / Short circuit', '', 1),
(20, 7, 'FC20', 'วัดค่าไม่ตรง / แสดงผลไม่ตรงค่าจริง', 'Mismatch Measurement / Wrong Display', '', 1),
(21, 7, 'FC21', 'ใช้งานหรือปรับตั้งผิดวิธี', 'Misuse / Wrong setting', '', 1),
(22, 13, 'ITP-01', 'เปิดเครื่องไม่ติด', 'Can\'t Power On', 'เปิดเครื่องไม่ติด **(ทุก Device/อุปกรณ์)', 1),
(23, 13, 'ITP-02', 'ใช้งาน INTERNET ไม่ได้', 'Internet not working', '', 1),
(24, 13, 'ITP-03', 'Printer พิมพ์เอกสารไม่ได้', '', '', 1),
(25, 13, 'ITP-04', 'อาการเสียทั่วไป (Hardwatr-Software)', '', '', 1),
(26, 13, 'ITP-05', 'กล้องวงจรปิดใช้ไม่ได้', '', 'กล้องวงจรปิดใช้ไม่ได้', 1),
(27, 13, 'TEST-1', 'test-edit-1 xxx', 'test-edit-1', 'test-edit-1 xxx', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_location`
--

CREATE TABLE `tb_location` (
  `id_location` int NOT NULL,
  `ref_id_site` int NOT NULL,
  `ref_id_building` int DEFAULT NULL COMMENT 'REF.id_building',
  `location_initialname` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_status` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลสถานที่ตั้งเครื่องจักร/อุปกรณ์';

--
-- Dumping data for table `tb_location`
--

INSERT INTO `tb_location` (`id_location`, `ref_id_site`, `ref_id_building`, `location_initialname`, `location_name`, `location_status`) VALUES
(208, 1, NULL, NULL, 'PCS ไม่ทราบสถานที่', 1),
(209, 0, 0, NULL, 'JPK MACHINE ROOM 01', 1),
(210, 5, NULL, NULL, 'JPK คลังสินค้า', 1),
(211, 0, 0, NULL, 'JPK MACHINE ROOM B2', 1),
(212, 0, 0, NULL, 'JPK คลังสินค้าอาคาร B2', 1),
(213, 0, 0, NULL, 'JPK MACHINE ROOM B1', 1),
(214, 5, NULL, NULL, 'JPK คลังสินค้าอาคาร B1(THPD)', 1),
(215, 1, 0, NULL, 'PCS MACHINE ROOM 01', 1),
(216, 1, 0, NULL, 'PCS SPARAL FREEZER อ.1', 1),
(217, 1, 0, NULL, 'PCS คลังสินค้า', 1),
(218, 1, 0, NULL, 'PCS GEN ROOM 01', 1),
(219, 1, 0, NULL, 'PCS CONTROL ROOM 01', 1),
(220, 1, 0, NULL, 'PCS CONTROL SPIRAL FEEZER อ.1', 1),
(221, 1, NULL, NULL, 'PCS ห้องสัมมนา', 1),
(222, 1, 0, NULL, 'PCS ห้องรับประทานอาหารว่าง', 1),
(223, 1, 0, NULL, 'PCS ห้องพักวิทยากร', 1),
(224, 1, 0, NULL, 'PCS ห้องCONTROL SPIRAL FEEZER อ.1', 1),
(225, 1, 0, NULL, 'PCS ดาดฟ้าอาคาร1', 1),
(226, 1, 0, NULL, 'PCS อาคาร1', 1),
(227, 1, 0, NULL, 'PCS ด้านข้าง อ.1', 1),
(228, 1, 0, NULL, 'PCS ลานโหลด', 1),
(229, 1, 0, NULL, 'PCS ห้องเก็บ1', 1),
(230, 1, 0, NULL, 'PCS ห้องเก็บ2', 1),
(231, 1, 0, NULL, 'PCS ห้องเก็บ3', 1),
(232, 1, 0, NULL, 'PCS ห้องเก็บ4', 1),
(233, 1, 0, NULL, 'PCS ห้องเก็บ5', 1),
(234, 1, 0, NULL, 'PCS ห้อง CHILL อ.1', 1),
(235, 1, 0, NULL, 'PCS ANTEROOM อ.1', 1),
(236, 1, 0, NULL, 'PCS ห้องฟรีส 1', 1),
(237, 1, 0, NULL, 'PCS ห้องฟรีส 2', 1),
(238, 1, 0, NULL, 'PCS ห้องฟรีส 3', 1),
(239, 1, 0, NULL, 'PCS ห้องฟรีส 4', 1),
(240, 1, 0, NULL, 'PCS ห้องฟรีส 5', 1),
(241, 1, 0, NULL, 'PCS ห้องฟรีส 6', 1),
(242, 1, 0, NULL, 'PCS ลานโหลด อ.1', 1),
(243, 1, 0, NULL, 'PCS ห้องแพ็ค อ.1 หลังฟรีส', 1),
(244, 1, 0, NULL, 'PCS ห้องแพ็ค อ.1 หน้าฟรีส', 1),
(245, 1, 0, NULL, 'PCS โรงอาหาร', 1),
(246, 1, 0, NULL, 'PCS MACHINE ROOM 02', 1),
(247, 1, 0, NULL, 'PCS อาคาร2', 1),
(248, 1, 0, NULL, 'PCS CONTROL ROOM 02', 1),
(249, 1, 0, NULL, 'PCS CONTROL SOLAR ROOF อ.2', 1),
(250, 1, 0, NULL, 'PCS ด้านข้างแผนกซ่อมบำรุง', 1),
(251, 1, 0, NULL, 'PCS ห้องเก็บ 6', 1),
(252, 1, 0, NULL, 'PCS ห้องเก็บ7', 1),
(253, 1, 0, NULL, 'PCS ห้องเก็บ8', 1),
(254, 1, 0, NULL, 'PCS ห้องเก็บ9', 1),
(255, 1, 0, NULL, 'PCS ANTEROOM อ.2', 1),
(256, 1, 0, NULL, 'PCS AIR LOCK อ.2', 1),
(257, 1, 0, NULL, 'PCS ลานโหลด อ.2', 1),
(258, 1, 0, NULL, 'PCS SOLAR ROOF อาคาร 2', 1),
(259, 1, 0, NULL, 'PCS MACHINE ROOM 03', 1),
(260, 1, 0, NULL, 'PCS GEN ROOM 03', 1),
(261, 1, 0, NULL, 'PCS โรงกรองน้ำ', 1),
(262, 1, 0, NULL, 'PCS อาคาร3', 1),
(263, 1, 0, NULL, 'PCS CONTROL ROOM 03', 1),
(264, 1, 0, NULL, 'PCS หลัง GEN ROOM 03', 1),
(265, 1, 0, NULL, 'PCS CONTROL บ่อน้ำเสีย', 1),
(266, 1, 0, NULL, 'PCS ดาดฟ้าอาคาร 3', 1),
(267, 1, 0, NULL, 'PCS ห้องเก็บ 10', 1),
(268, 1, 0, NULL, 'PCS ห้องเก็บ 11', 1),
(269, 1, 0, NULL, 'PCS ห้องเก็บ 12', 1),
(270, 1, 0, NULL, 'PCS ห้องเก็บ 13', 1),
(271, 1, 0, NULL, 'PCS ANTEROOM อ.3', 1),
(272, 1, 0, NULL, 'PCS ลานโหลด อ.4', 1),
(273, 1, 0, NULL, 'PCS ลานโหลด อ.3', 1),
(274, 1, 0, NULL, 'PCS AIR LOCK อ.3', 1),
(275, 1, 0, NULL, 'PCS MACHINE ROOM 04', 1),
(276, 1, 0, NULL, 'PCS GEN ROOM 04', 1),
(277, 1, 0, NULL, 'PCS อาคาร4', 1),
(278, 1, 0, NULL, 'PCS CONTROL ROOM 04', 1),
(279, 1, 0, NULL, 'PCS CONTROL ROOM SOLAR ROOF อ.4', 1),
(280, 1, 0, NULL, 'PCS ดาดฟ้าอาคาร 4', 1),
(281, 1, 0, NULL, 'PCS ห้องเก็บ 14', 1),
(282, 1, 0, NULL, 'PCS ห้องเก็บ 15', 1),
(283, 1, 0, NULL, 'PCS ห้องเก็บ 16', 1),
(284, 1, 0, NULL, 'PCS ห้องเก็บ 17', 1),
(285, 1, 0, NULL, 'PCS ห้องเก็บ 18', 1),
(286, 1, 0, NULL, 'PCS ห้องเก็บ 19', 1),
(287, 1, 0, NULL, 'PCS ห้องเก็บ 20', 1),
(288, 1, 0, NULL, 'PCS ห้องเก็บ 21', 1),
(289, 1, 0, NULL, 'PCS ห้องเก็บ 22', 1),
(290, 1, 0, NULL, 'PCS ห้อง P4 อ.4', 1),
(291, 1, 0, NULL, 'PCS ANTEROOM อ.4', 1),
(292, 1, 0, NULL, 'PCS AIRLOCK อ.4', 1),
(293, 1, 0, NULL, 'PCS ฟรีส อาคาร 4', 1),
(294, 1, 0, NULL, 'PCS PASSAGEWAY อ.4', 1),
(295, 1, 0, NULL, 'PCS รับวัตถุดิบฟรีสอ.4', 1),
(296, 1, 0, NULL, 'PCS ห้องแพ็ค อ.4', 1),
(297, 1, 0, NULL, 'PCS SOLAR ROOF อาคาร 4', 1),
(298, 1, 0, NULL, 'PCS MACHINE ROOM 05', 1),
(299, 1, 0, NULL, 'PCS CONTROL ROOM 05', 1),
(300, 1, 0, NULL, 'PCS ห้องเก็บ 23', 1),
(301, 1, 0, NULL, 'PCS ห้องเก็บ 24', 1),
(302, 1, 0, NULL, 'PCS ห้องเก็บ 25', 1),
(303, 1, 0, NULL, 'PCS ลานโหลด อ.5', 1),
(304, 1, 0, NULL, 'PCS MACHINE ROOM 06', 1),
(305, 1, 0, NULL, 'PCS GEN ROOM 06', 1),
(306, 1, 0, NULL, 'PCS CONTROL ROOM 06', 1),
(307, 1, 0, NULL, 'PCS CONTROL ROOM SOLAR ROOF อ.6', 1),
(308, 1, 0, NULL, 'PCS ดาดฟ้าอาคาร 6', 1),
(309, 1, 0, NULL, 'PCS CONTROL MOBILE RACK 6', 1),
(310, 1, 0, NULL, 'PCS ห้องทำงาน CUS', 1),
(311, 1, 0, NULL, 'PCS ห้องประชุม อาคาร 6', 1),
(312, 1, 0, NULL, 'PCS ทางเดิน CS อ.6', 1),
(313, 1, 0, NULL, 'PCS ทางเข้าห้อง Chill 30', 1),
(314, 1, 0, NULL, 'PCS ห้องโมบาย 6', 1),
(315, 1, 0, NULL, 'PCS ห้องเก็บ 28', 1),
(316, 1, 0, NULL, 'PCS ห้องเก็บ 29', 1),
(317, 1, 0, NULL, 'PCS ห้องChill 30', 1),
(318, 1, 0, NULL, 'PCS ห้องโมบาย 1', 1),
(319, 1, NULL, NULL, 'PCS ห้องโมบาย 2', 1),
(320, 1, 0, NULL, 'PCS ห้องโมบาย 3', 1),
(321, 1, 0, NULL, 'PCS ANTEROOM อ.6', 1),
(322, 1, 0, NULL, 'PCS AIR LOCK อ.6', 1),
(323, 1, 0, NULL, 'PCS PASSAGEWAY6', 1),
(324, 1, 6, NULL, 'PCS ลานโหลดใหญ่ อ.6', 1),
(325, 1, 6, NULL, 'PCS คลังแห้ง อ. 6', 1),
(326, 1, 6, NULL, 'PCS อาคาร 6', 1),
(327, 1, 0, NULL, 'PCS SOLAR ROOF อาคาร 6', 1),
(328, 1, 0, NULL, 'PCS CONTROL ROOM 07', 1),
(329, 1, 0, NULL, 'PCS ห้องโมบาย 4 อ.7', 1),
(330, 1, 0, NULL, 'PCS ห้องโมบาย 5 อ.7', 1),
(331, 1, 0, NULL, 'PCS ANTE ROOM อ.7', 1),
(332, 1, 0, NULL, 'PCS ห้องอบปลา อ.7', 1),
(333, 1, 0, NULL, 'PCS บริเวณที่พักปลา อ.7', 1),
(334, 1, 0, NULL, 'PCS ลานโหลด อ.7', 1),
(335, 1, 7, NULL, 'PCS อาคาร 7', 1),
(336, 1, 0, NULL, 'PCS MACHINE ROOM 08', 1),
(337, 1, 8, NULL, 'PCS ดาดฟ้าอาคาร 8', 1),
(338, 1, 0, NULL, 'PCS GEN ROOM 08', 1),
(339, 1, 0, NULL, 'PCS CONTROL ROOM 08', 1),
(340, 1, 0, NULL, 'PCS MDB ROOM 08', 1),
(341, 1, 0, NULL, 'PCS อาคาร 8', 1),
(342, 1, 8, NULL, 'PCS SOLAR ROOF อาคาร 8', 1),
(343, 1, 0, NULL, 'PCS CONTROL SOLAR ROOF อ. 8', 1),
(344, 1, 0, NULL, 'PCS ป้อมตาชั่งหน้าบริษัท', 1),
(345, 1, 0, NULL, 'PCS CONTROL SOLAR อ.4', 1),
(346, 1, 0, NULL, 'PCS CONTROL SOLAR อ.6', 1),
(347, 1, 0, NULL, 'PCS ห้องInventory อ.6', 1),
(348, 1, 0, NULL, 'PCS บ้านพักลูกค้า อ.6', 1),
(349, 1, 0, NULL, 'PCS CONTROL SOLAR อ.1', 1),
(350, 1, 0, NULL, 'PCS ป้อมตาชั่ง อ.8', 1),
(351, 1, 0, NULL, 'PCS สำนักงานชั่วคราวPLP อ.8', 1),
(352, 1, 0, NULL, 'PCS ห้อง CUS', 1),
(353, 1, 0, NULL, 'PCS ห้องโถงล่าง', 1),
(354, 1, 0, NULL, 'PCS ห้องการตลาด', 1),
(355, 1, 8, NULL, 'PCS ห้องเซิฟเวอร์ อ.8', 1),
(356, 1, 0, NULL, 'PCS หน้าประตูห้องบัญชีคลัง', 1),
(357, 1, 0, NULL, 'PCS ห้องสมุด', 1),
(358, 1, 0, NULL, 'PCS ห้องลอจิสติกส์', 1),
(359, 1, 0, NULL, 'PCS ห้องผู้จัการฝ่ายวิศวกรรม', 1),
(360, 1, 0, NULL, 'PCS ห้องบัญชี-การเงิน', 1),
(361, 1, 0, NULL, 'PCS ห้องประชุม', 1),
(362, 1, 0, NULL, 'PCS ห้องคุณจิตชัย', 1),
(363, 1, 0, NULL, 'PCS ห้องคุณอัจฉรา', 1),
(364, 1, 0, NULL, 'PCS ห้องพัฒนาธุรกิจ', 1),
(365, 1, 0, NULL, 'PCS ห้องพัฒนาธุรกิจ2', 1),
(366, 1, 0, NULL, 'PCS ห้องพัฒนาธุรกิจ3', 1),
(367, 1, 0, NULL, 'PCS ห้องพัฒนาธุรกิจ4', 1),
(368, 1, 0, NULL, 'PCS ห้องรับรองลูกค้า', 1),
(369, 1, 0, NULL, 'PCS ห้องรับรองลูกค้า CS', 1),
(370, 1, 0, NULL, 'PCS หน้าห้องประชุม', 1),
(371, 1, NULL, NULL, 'PCS ห้องพนักงาน CS', 1),
(372, 1, 1, NULL, 'PCS ห้องผู้จัดการ CS', 1),
(373, 1, 0, NULL, 'PCS ห้อง QS', 1),
(374, 1, 0, NULL, 'PCS ห้องรองผู้จัการ WH', 1),
(375, 1, 0, NULL, 'PCS ห้องพนักงาน WH', 1),
(376, 1, 0, NULL, 'PCS ออฟฟิต', 1),
(377, 2, NULL, NULL, 'JPAC MACHINE ROOM 01', 1),
(378, 2, NULL, NULL, 'JPAC อาคาร A', 1),
(379, 0, 0, NULL, 'JPAC อาคาร C', 1),
(380, 0, 0, NULL, 'JPAC อาคาร B', 1),
(381, 0, 0, NULL, 'JPAC Office', 1),
(382, 0, 0, NULL, 'JPAC คลังสินค้า', 1),
(383, 0, 0, NULL, 'JPAC ไลน์ผลิต 1', 1),
(384, 0, 0, NULL, 'PLP.JPAC', 1),
(385, 0, 0, NULL, 'PLP.JPK', 1),
(386, 1, 0, NULL, 'PLP.PCS', 1),
(387, 1, 0, NULL, 'PCS QA', 1),
(388, 1, 0, NULL, 'PCS INVENTORY', 1),
(389, 1, 0, NULL, 'PCS ห้องเก็บเครื่องชั่ง', 1),
(390, 1, 0, NULL, 'PCS', 1),
(391, 0, 0, NULL, 'อาคาร 1', 1),
(392, 0, 0, NULL, 'อาคาร 2', 1),
(393, 0, 0, NULL, 'อาคาร 3', 1),
(394, 0, 0, NULL, 'อาคาร 4', 1),
(395, 0, 0, NULL, 'อาคาร 5', 1),
(396, 0, 0, NULL, 'อาคาร 6', 1),
(397, 0, 0, NULL, 'อาคาร 7', 1),
(398, 1, 8, NULL, 'อาคาร 8', 1),
(399, 0, 0, NULL, 'อาคาร 9', 1),
(400, 0, 0, NULL, 'โซน A', 1),
(401, 0, 0, NULL, 'โซน B', 1),
(402, 0, 0, NULL, 'ทั่วไป', 1),
(403, 0, 0, NULL, 'ส่วนกลาง', 1),
(404, 0, 0, NULL, 'ออฟฟิต', 1),
(405, 1, NULL, NULL, 'โรงอาหาร', 1),
(406, 0, 0, NULL, 'ห้องเครื่อง', 1),
(407, 1, NULL, NULL, 'ป้อม รปภ.', 1),
(408, 0, 0, NULL, 'สโตว์', 1),
(409, 1, NULL, NULL, 'PLP', 1),
(410, 0, 0, NULL, 'ขนส่ง', 1),
(411, 1, 1, NULL, 'บริการลูกค้า', 1),
(412, 0, 0, NULL, 'SHOP', 1),
(413, 0, 0, NULL, 'โรงขัดแยกขยะ', 1),
(414, 1, NULL, NULL, 'โรงจอดรถ', 1),
(415, 1, 8, NULL, 'Office ชั้น 2', 1),
(416, 1, 8, NULL, 'ห้องประชุม (Control Room)', 1),
(417, 1, 8, NULL, 'ห้องน้ำชาย ชั้น 3', 1),
(418, 1, 8, NULL, 'ห้องน้ำหญิง ชั้น 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_machine_master`
--

CREATE TABLE `tb_machine_master` (
  `id_machine` int NOT NULL,
  `machine_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสเครื่องจักร',
  `ref_id_dept` int NOT NULL COMMENT 'แผนกที่รับผิดชอบ',
  `ref_id_menu` int NOT NULL COMMENT 'หมวดหลัก',
  `ref_id_sub_menu` int DEFAULT NULL COMMENT 'หมวดรอง',
  `model_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อรุ่น',
  `name_machine` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_machine` longtext COLLATE utf8mb4_unicode_ci,
  `mc_adddate` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `mc_editdate` datetime DEFAULT NULL,
  `ref_id_user_edit` int DEFAULT NULL,
  `status_machine` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='เครื่องจักร/อุปกรณ์ไฟฟ้า (MASTER)';

--
-- Dumping data for table `tb_machine_master`
--

INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES
(1, 'MT-AS-0002', 7, 44, NULL, 'Hybrid 48VDC-5KVA', 'หม้อแปลงไฟฟ้า Hybrid 48VDC-5KVA', 'Hybrid 48VDC-5KVA/4000W, 60A MPPT Charger, 60A AC Charger', '2023-01-17 16:06:11', 1, '2023-01-18 10:24:54', 1, 1),
(2, 'IT-AS-0001', 13, 89, NULL, 'Dell Latitude 3410-SNS3410008', 'DELL Latitude 3410 xxx', 'DELL Latitude 3410 xxx', '2023-01-17 16:09:05', 1, '2023-01-18 08:25:58', 1, 1),
(3, 'MT-AS-0001', 7, 32, NULL, 'CP04-AD', 'ไฟฉุกเฉิน LED CP04-AD', 'Emergency Light (ไฟฉุกเฉิน)', '2023-01-18 09:48:01', 1, NULL, NULL, 1),
(5, 'MT-AS-0003', 7, 44, NULL, 'Hybrid 48VDC-5KVA', 'Hybrid 48VDC-5KVA/4000W/60A', 'Hybrid 48VDC-5KVA', '2023-01-18 10:25:19', 1, '2023-01-18 10:26:42', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_machine_responsibility`
--

CREATE TABLE `tb_machine_responsibility` (
  `id_mc_responsibility` int NOT NULL,
  `ref_id_user` int NOT NULL,
  `ref_id_machine_site` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางอ้างอิงพนักงานว่ารับผิดชอบเครื่องจักรใดบ้าง';

-- --------------------------------------------------------

--
-- Table structure for table `tb_machine_site`
--

CREATE TABLE `tb_machine_site` (
  `id_machine_site` int NOT NULL,
  `code_machine_site` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recived_date` datetime NOT NULL COMMENT 'REF_ID.วันทีีรับเข้า/หรือซื้อ',
  `ref_id_machine` int NOT NULL COMMENT 'REF_ID.เครื่องจักร Master',
  `ref_id_building` int NOT NULL COMMENT 'REF_ID.อาคาร',
  `ref_id_location` int NOT NULL COMMENT 'REF_ID.สถานที่',
  `ref_id_site` int NOT NULL COMMENT 'REF_ID.ไซต์งาน',
  `ref_id_supplier` int NOT NULL COMMENT 'REF_ID.ซัพพลายฯ',
  `status_work` int NOT NULL COMMENT '1-ใช้งานอยู่/2-อยู่ระหว่างการซ่อม',
  `detail_machine_site` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รายละเอียดเพิ่มเติม',
  `mcs_adddate` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `mcs_editdate` datetime NOT NULL,
  `ref_id_user_edit` int NOT NULL,
  `status_machine_site` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='เครื่องจักร/อุปกรณ์ไฟฟ้าแยกไซต์งาน';

-- --------------------------------------------------------

--
-- Table structure for table `tb_maintenance_type`
--

CREATE TABLE `tb_maintenance_type` (
  `id_mt_type` int NOT NULL,
  `name_mt_type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อประเภทใบงานฯ',
  `ref_id_dept` int NOT NULL COMMENT 'REF.ไอดีแผนกที่รับผิดชอบ',
  `mt_type_remark` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_mt_type` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางประเภทใบงานแจ้งซ่อม';

--
-- Dumping data for table `tb_maintenance_type`
--

INSERT INTO `tb_maintenance_type` (`id_mt_type`, `name_mt_type`, `ref_id_dept`, `mt_type_remark`, `status_mt_type`) VALUES
(1, 'งานซ่อมทั่วไป', 7, '', 1),
(2, 'งานเกี่ยวกับไฟฟ้า', 7, '', 1),
(3, 'งานเกี่ยวกับระบบน้ำ', 7, '', 1),
(4, 'งานเกี่ยวกับเครื่องทำความเย็น', 7, '', 1),
(5, 'งานซ่อมโดยช่างภายนอก', 7, '', 1),
(6, 'งานซ่อมเครื่องเย็นโดยช่างนอก', 7, '', 1),
(7, 'งานเกี่ยวกับระบบปฎิบัติการ (OS) Windows', 13, 'งานเกี่ยวกับระบบปฎิบัติการ (OS) Windows (ไม่รวม Software)', 1),
(8, 'งานเกี่ยวกับซอฟต์แวร์ (Software)', 13, 'งานเกี่ยวกับซอฟต์แวร์(ทุกโปรแกรม, ทุก OS)', 1),
(9, 'งานเกี่ยวกับระบบเครือข่าย (Network)', 13, 'งานเกี่ยวกับระบบเครือข่าย (Network)', 1),
(10, 'งานเกี่ยวกับระบบฮารด์แวร์ (Hardware)', 13, 'งานเกี่ยวกับระบบฮารด์แวร์ (Hardware)', 1),
(11, 'งานเกี่ยวกับกล้องวงจรปิด (CCTV)', 13, 'งานเกี่ยวกับกล้องวงจรปิด (CCTV)', 1),
(12, 'งานส่งซ่อมภายนอกแผนก IT/MIS', 13, 'งานส่งซ่อมภายนอกแผนก IT/MIS (เนื่องจากมีประกัน หรือ ซ่อมเองไม่ได้)', 1),
(13, 'test edit 1', 13, 'test edit 1 test edit 1', 2),
(14, 'test-add-2-edit', 13, 'test-add-2-edit', 2),
(15, 'Edit-1 xxx', 13, 'Edit-1 xxx', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reject_mtr_code`
--

CREATE TABLE `tb_reject_mtr_code` (
  `id_reject_mtr` int NOT NULL,
  `ref_id_dept` int NOT NULL,
  `reject_mtr_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject_mtr_remark` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject_mtr_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บ Master สาเหตุปฏิเสธซ่อม';

--
-- Dumping data for table `tb_reject_mtr_code`
--

INSERT INTO `tb_reject_mtr_code` (`id_reject_mtr`, `ref_id_dept`, `reject_mtr_name`, `reject_mtr_remark`, `reject_mtr_status`) VALUES
(1, 7, 'ตกรุ่นหาอะไหล่ไม่ได้', 'ตกรุ่นหาอะไหล่ไม่ได้', 1),
(2, 13, 'ตกรุ่นหาอะไหล่ไม่ได้', 'ตกรุ่นหาอะไหล่ไม่ได้ **ใช้กับทุก Device', 1),
(3, 13, 'ไม่คุ้มค่าซ่อม', 'ไม่คุ้มค่าซ่อม', 1),
(4, 13, 'แจ้งรายละเอียดไม่ชัดเจน', '', 1),
(5, 13, 'ปปป', 'ปป', 1),
(6, 7, 'พไำพไำพ', 'ำไพำไ', 1),
(7, 13, 'sdfsdf', 'sdf', 1),
(8, 7, 'sdfsd', 'sdf', 1),
(9, 8, 'edit-1', 'edit-1', 2),
(10, 13, 'edit-1', 'edit-1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair_code`
--

CREATE TABLE `tb_repair_code` (
  `id_repair_code` int NOT NULL,
  `ref_id_dept` int NOT NULL,
  `repair_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_code_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repair_code_remark` longtext COLLATE utf8mb4_unicode_ci,
  `repair_code_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลรหัสซ่อม';

--
-- Dumping data for table `tb_repair_code`
--

INSERT INTO `tb_repair_code` (`id_repair_code`, `ref_id_dept`, `repair_code`, `repair_code_name`, `repair_code_remark`, `repair_code_status`) VALUES
(1, 13, 'ITR-01', 'ลงระบบปฏิบัติการ (OS) ใหม่', 'ลงระบบปฏิบัติการ (OS) ใหม่', 1),
(2, 13, 'ITR-02', 'ลงโปรแกรมใหม่ (Software)', 'ลงโปรแกรมใหม่ (Software)', 1),
(3, 13, 'ITR-03', 'เปลี่ยนอะไหล่ใหม่', 'เปลี่ยนอะไหล่ใหม่', 1),
(4, 13, 'XXX-04', 'Edit', 'Edit', 1),
(5, 7, 'XXX-05', 'XXX-05-Edit', 'XXX-05', 1),
(6, 7, 'XXX-06', 'XXX-06-Edit', 'XXX-06-Edit', 1),
(7, 13, 'ITR-04', 'ส่งเคลมประกัน', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site`
--

CREATE TABLE `tb_site` (
  `id_site` int NOT NULL COMMENT 'ไอดีไซต์',
  `site_initialname` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อย่อไซต์',
  `site_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อเต็ม',
  `site_status` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางไซต์งาน';

--
-- Dumping data for table `tb_site`
--

INSERT INTO `tb_site` (`id_site`, `site_initialname`, `site_name`, `site_status`) VALUES
(1, 'PCS', 'บริษัท แปซิฟิค ห้องเย็น จากัด', 1),
(2, 'JPAC', 'บริษัท เจดับเบิ้ลยูดี แปซิฟิค จากัด', 1),
(3, 'PACT', 'บริษัท แปซิฟิค ทียูเอ็ม โคลด์ สโตเรจ จำกัด', 1),
(4, 'PACM', 'บริษัท แปซิฟิค เอ็ม โคลด์ สโตเรจ จากัด', 1),
(5, 'JPK', 'บริษัท เจพีเค โคลด์ สโตเรจ จากัด', 1),
(6, 'PACA', 'PACA', 1),
(7, 'PLP', 'บริษัท แปซิฟิค โลจิสติกส์ โปร จำกัด', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_responsibility`
--

CREATE TABLE `tb_site_responsibility` (
  `id_site_responsibility` int NOT NULL,
  `ref_id_user` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id_site` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางอ้างอิงช่างซ่อมผูกกับใบงานไซค์ไหน';

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int NOT NULL,
  `ref_id_dept` int NOT NULL,
  `supplier_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_remark` longtext COLLATE utf8mb4_unicode_ci,
  `supplier_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ใช้เก็บข้อมูลผู้จำหน่าย-ผู้ซ่อมภายนอก';

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `ref_id_dept`, `supplier_name`, `supplier_phone`, `supplier_remark`, `supplier_status`) VALUES
(1, 7, 'supplier_phone', '0000', 'supplier_phone', 1),
(2, 13, 'test-edit-1', '1234567890', 'test-edit-1', 1),
(3, 13, 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', '0271040400', 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', 1),
(4, 13, 'test add-1-edit-1', '0123456799', 'test add-1-edit-1', 1),
(5, 8, 'test-add-edit-999999 xxx', '1234567980', 'test-add-edit-999999 xxx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int NOT NULL,
  `unit_name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status_unit` int NOT NULL COMMENT '1-ใช้งานได้/2-ยกเลิก\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `unit_name`, `status_unit`) VALUES
(1, 'แท่ง', 1),
(2, 'รีม', 1),
(3, 'ชิ้น', 1),
(4, 'ลิตร', 1),
(5, 'ด้าม', 1),
(6, 'อัน', 1),
(7, 'ตัว', 1),
(8, 'กิโลกรัม', 1),
(9, 'กรัม', 1),
(10, 'โหล', 1),
(11, 'กล่อง', 1),
(12, 'ใบ', 1),
(13, 'ก้อน', 1),
(14, 'ม้วน', 1),
(15, 'ชุด', 1),
(16, 'เส้น', 1),
(17, 'ผืน', 1),
(18, 'แกลลอน', 1),
(19, 'ขวด', 1),
(20, 'ตลับ', 1),
(31, 'ถุง', 1),
(32, 'ถัง', 1),
(33, 'เครื่อง', 1),
(34, 'ยูนิต', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `no_user` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_token` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_user` int NOT NULL COMMENT 'ระดับผู้ใช้งาน',
  `ref_id_site` int NOT NULL COMMENT 'ไซต์',
  `ref_id_dept` int NOT NULL COMMENT 'แผนก',
  `ref_id_position` int NOT NULL COMMENT 'ตำแหน่ง',
  `status_user` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ',
  `create_date` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `ref_id_user_edit` int DEFAULT NULL,
  `latest_login` datetime DEFAULT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลผู้ใช้งานทุกระดับ';

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_responsibility`
--

CREATE TABLE `tb_user_responsibility` (
  `id_responsibility` int NOT NULL,
  `ref_id_user` int NOT NULL COMMENT 'REF.ไอดีพนักงาน',
  `ref_id_mt_type` int NOT NULL COMMENT 'REF.ไอดีประเภทใบงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางอ้างอิงช่างซ่อมผูกกับใบงานประเภทใดบ้าง';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_attachment`
--
ALTER TABLE `tb_attachment`
  ADD PRIMARY KEY (`id_attachment`),
  ADD KEY `ref_id_machine` (`ref_id_machine`);

--
-- Indexes for table `tb_brand`
--
ALTER TABLE `tb_brand`
  ADD PRIMARY KEY (`id_brand`),
  ADD KEY `idx_brand_name` (`brand_name`);

--
-- Indexes for table `tb_building`
--
ALTER TABLE `tb_building`
  ADD PRIMARY KEY (`id_building`),
  ADD KEY `idx_ref_id_site` (`ref_id_site`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_code` (`menu_code`);

--
-- Indexes for table `tb_caused_by_code`
--
ALTER TABLE `tb_caused_by_code`
  ADD PRIMARY KEY (`id_caused_by_code`),
  ADD UNIQUE KEY `caused_by_code` (`caused_by_code`);

--
-- Indexes for table `tb_dept`
--
ALTER TABLE `tb_dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `tb_failure_code`
--
ALTER TABLE `tb_failure_code`
  ADD PRIMARY KEY (`id_failure_code`);

--
-- Indexes for table `tb_location`
--
ALTER TABLE `tb_location`
  ADD PRIMARY KEY (`id_location`),
  ADD KEY `idx_ref_id_building` (`ref_id_building`),
  ADD KEY `idx_ref_id_site` (`ref_id_site`);

--
-- Indexes for table `tb_machine_master`
--
ALTER TABLE `tb_machine_master`
  ADD PRIMARY KEY (`id_machine`),
  ADD UNIQUE KEY `machine_code` (`machine_code`) USING BTREE;

--
-- Indexes for table `tb_machine_responsibility`
--
ALTER TABLE `tb_machine_responsibility`
  ADD PRIMARY KEY (`id_mc_responsibility`);

--
-- Indexes for table `tb_machine_site`
--
ALTER TABLE `tb_machine_site`
  ADD PRIMARY KEY (`id_machine_site`),
  ADD KEY `code_machine_site` (`code_machine_site`);

--
-- Indexes for table `tb_maintenance_type`
--
ALTER TABLE `tb_maintenance_type`
  ADD PRIMARY KEY (`id_mt_type`);

--
-- Indexes for table `tb_reject_mtr_code`
--
ALTER TABLE `tb_reject_mtr_code`
  ADD PRIMARY KEY (`id_reject_mtr`);

--
-- Indexes for table `tb_repair_code`
--
ALTER TABLE `tb_repair_code`
  ADD PRIMARY KEY (`id_repair_code`),
  ADD UNIQUE KEY `repair_code` (`repair_code`);

--
-- Indexes for table `tb_site`
--
ALTER TABLE `tb_site`
  ADD PRIMARY KEY (`id_site`),
  ADD KEY `idx_site_initialname` (`site_initialname`);

--
-- Indexes for table `tb_site_responsibility`
--
ALTER TABLE `tb_site_responsibility`
  ADD PRIMARY KEY (`id_site_responsibility`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uniq_email` (`email`),
  ADD KEY `idx_no_user` (`no_user`),
  ADD KEY `fk_ref_id_site` (`ref_id_site`);

--
-- Indexes for table `tb_user_responsibility`
--
ALTER TABLE `tb_user_responsibility`
  ADD PRIMARY KEY (`id_responsibility`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_attachment`
--
ALTER TABLE `tb_attachment`
  MODIFY `id_attachment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_brand`
--
ALTER TABLE `tb_brand`
  MODIFY `id_brand` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_building`
--
ALTER TABLE `tb_building`
  MODIFY `id_building` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tb_caused_by_code`
--
ALTER TABLE `tb_caused_by_code`
  MODIFY `id_caused_by_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_dept`
--
ALTER TABLE `tb_dept`
  MODIFY `id_dept` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_failure_code`
--
ALTER TABLE `tb_failure_code`
  MODIFY `id_failure_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_location`
--
ALTER TABLE `tb_location`
  MODIFY `id_location` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `tb_machine_master`
--
ALTER TABLE `tb_machine_master`
  MODIFY `id_machine` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_machine_responsibility`
--
ALTER TABLE `tb_machine_responsibility`
  MODIFY `id_mc_responsibility` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_machine_site`
--
ALTER TABLE `tb_machine_site`
  MODIFY `id_machine_site` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_maintenance_type`
--
ALTER TABLE `tb_maintenance_type`
  MODIFY `id_mt_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_reject_mtr_code`
--
ALTER TABLE `tb_reject_mtr_code`
  MODIFY `id_reject_mtr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_repair_code`
--
ALTER TABLE `tb_repair_code`
  MODIFY `id_repair_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_site`
--
ALTER TABLE `tb_site`
  MODIFY `id_site` int NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไซต์', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_site_responsibility`
--
ALTER TABLE `tb_site_responsibility`
  MODIFY `id_site_responsibility` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user_responsibility`
--
ALTER TABLE `tb_user_responsibility`
  MODIFY `id_responsibility` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_building`
--
ALTER TABLE `tb_building`
  ADD CONSTRAINT `fk_ref_id_site` FOREIGN KEY (`ref_id_site`) REFERENCES `tb_site` (`id_site`);

--
-- Constraints for table `tb_location`
--
ALTER TABLE `tb_location`
  ADD CONSTRAINT `tb_location_ibfk_1` FOREIGN KEY (`ref_id_building`) REFERENCES `tb_building` (`id_building`),
  ADD CONSTRAINT `tb_location_ibfk_2` FOREIGN KEY (`ref_id_site`) REFERENCES `tb_site` (`id_site`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
