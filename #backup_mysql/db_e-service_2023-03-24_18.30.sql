-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2023 at 11:27 AM
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
  `ref_id_used` int NOT NULL COMMENT 'REF.อ้างอิงไอดีที่ใช้งาน',
  `attachment_sort` int DEFAULT NULL,
  `path_attachment_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_type` int NOT NULL COMMENT '1-รูป/2-ไฟล์แนบ',
  `image_cate` int NOT NULL COMMENT '1-master/2-ใบแจ้งซ่อม/3-รูปหลังซ่อม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บไฟล์รูป';

--
-- Dumping data for table `tb_attachment`
--

INSERT INTO `tb_attachment` (`id_attachment`, `ref_id_used`, `attachment_sort`, `path_attachment_name`, `attachment_type`, `image_cate`) VALUES
(1, 1, NULL, 'e405d9584b3e9db4a29681473aae3ff4.jpg', 1, 2),
(2, 3, NULL, '70a659f2f7fb04ff6f010feabd34ab99.jpg', 1, 2),
(3, 4, NULL, '3aaa41b78d4717be8def44a60837e49a.jpg', 1, 2);

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
  `building_name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่ออาคาร',
  `building_status` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลอาคาร';

--
-- Dumping data for table `tb_building`
--

INSERT INTO `tb_building` (`id_building`, `ref_id_site`, `building_initialname`, `building_name`, `building_status`) VALUES
(1, 1, NULL, 'โรงอาหาร', 1),
(2, 1, NULL, 'โซน A', 1),
(3, 1, NULL, 'อาคาร 9', 1),
(4, 1, NULL, 'อาคาร 8', 1),
(5, 1, NULL, 'อาคาร 7', 1),
(6, 1, NULL, 'อาคาร 6', 1),
(7, 1, NULL, 'อาคาร 5', 1),
(8, 1, NULL, 'อาคาร 4', 1),
(9, 1, NULL, 'อาคาร 3', 1),
(10, 1, NULL, 'อาคาร 2', 1),
(11, 1, NULL, 'อาคาร 1', 1),
(12, 1, NULL, 'ออฟฟิต', 1),
(13, 1, NULL, 'ทั่วไป', 1),
(14, 1, NULL, 'ขนส่ง', 1),
(15, 7, NULL, 'PLP.PCS', 1),
(16, 7, NULL, 'PLP.JPK', 1),
(17, 7, NULL, 'PLP.JPAC', 1),
(18, 1, NULL, 'PCS โรงอาหาร', 1),
(19, 1, NULL, 'PCS โรงกรองน้ำ', 1),
(20, 1, NULL, 'PCS อาคาร4', 1),
(21, 1, NULL, 'PCS อาคาร3', 1),
(22, 1, NULL, 'PCS อาคาร2', 1),
(23, 1, NULL, 'PCS อาคาร1', 1),
(24, 1, NULL, 'PCS อาคาร 8', 1),
(25, 1, NULL, 'PCS อาคาร 7', 1),
(26, 1, NULL, 'PCS อาคาร 6', 1),
(27, 1, NULL, 'PCS ออฟฟิต', 1),
(28, 1, NULL, 'PCS ห้องโมบาย 6', 1),
(29, 1, NULL, 'PCS ห้องโมบาย 5 อ.7', 1),
(30, 1, NULL, 'PCS ห้องโมบาย 4 อ.7', 1),
(31, 1, NULL, 'PCS ห้องโมบาย 3', 1),
(32, 1, NULL, 'PCS ห้องโมบาย 2', 1),
(33, 1, NULL, 'PCS ห้องโมบาย 1', 1),
(34, 1, NULL, 'PCS ห้องโถงล่าง', 1),
(35, 1, NULL, 'PCS ห้องแพ็ค อ.4', 1),
(36, 1, NULL, 'PCS ห้องแพ็ค อ.1 หลังฟรีส', 1),
(37, 1, NULL, 'PCS ห้องแพ็ค อ.1 หน้าฟรีส', 1),
(38, 1, NULL, 'PCS ห้องเซิฟเวอร์', 1),
(39, 1, NULL, 'PCS ห้องเก็บเครื่องชั่ง', 1),
(40, 1, NULL, 'PCS ห้องเก็บ9', 1),
(41, 1, NULL, 'PCS ห้องเก็บ8', 1),
(42, 1, NULL, 'PCS ห้องเก็บ7', 1),
(43, 1, NULL, 'PCS ห้องเก็บ5', 1),
(44, 1, NULL, 'PCS ห้องเก็บ4', 1),
(45, 1, NULL, 'PCS ห้องเก็บ3', 1),
(46, 1, NULL, 'PCS ห้องเก็บ2', 1),
(47, 1, NULL, 'PCS ห้องเก็บ1', 1),
(48, 1, NULL, 'PCS ห้องเก็บ 6', 1),
(49, 1, NULL, 'PCS ห้องเก็บ 29', 1),
(50, 1, NULL, 'PCS ห้องเก็บ 28', 1),
(51, 1, NULL, 'PCS ห้องเก็บ 25', 1),
(52, 1, NULL, 'PCS ห้องเก็บ 24', 1),
(53, 1, NULL, 'PCS ห้องเก็บ 23', 1),
(54, 1, NULL, 'PCS ห้องเก็บ 22', 1),
(55, 1, NULL, 'PCS ห้องเก็บ 21', 1),
(56, 1, NULL, 'PCS ห้องเก็บ 20', 1),
(57, 1, NULL, 'PCS ห้องเก็บ 19', 1),
(58, 1, NULL, 'PCS ห้องเก็บ 18', 1),
(59, 1, NULL, 'PCS ห้องเก็บ 17', 1),
(60, 1, NULL, 'PCS ห้องเก็บ 16', 1),
(61, 1, NULL, 'PCS ห้องเก็บ 15', 1),
(62, 1, NULL, 'PCS ห้องเก็บ 14', 1),
(63, 1, NULL, 'PCS ห้องเก็บ 13', 1),
(64, 1, NULL, 'PCS ห้องเก็บ 12', 1),
(65, 1, NULL, 'PCS ห้องเก็บ 11', 1),
(66, 1, NULL, 'PCS ห้องเก็บ 10', 1),
(67, 1, NULL, 'PCS ห้องอบปลา อ.7', 1),
(68, 1, NULL, 'PCS ห้องสัมมนา', 1),
(69, 1, NULL, 'PCS ห้องสมุด', 1),
(70, 1, NULL, 'PCS ห้องลอจิสติกส์', 1),
(71, 1, NULL, 'PCS ห้องรับรองลูกค้า CS', 1),
(72, 1, NULL, 'PCS ห้องรับรองลูกค้า', 1),
(73, 1, NULL, 'PCS ห้องรับประทานอาหารว่าง', 1),
(74, 1, NULL, 'PCS ห้องรองผู้จัการ WH', 1),
(75, 1, NULL, 'PCS ห้องฟรีส 6', 1),
(76, 1, NULL, 'PCS ห้องฟรีส 5', 1),
(77, 1, NULL, 'PCS ห้องฟรีส 4', 1),
(78, 1, NULL, 'PCS ห้องฟรีส 3', 1),
(79, 1, NULL, 'PCS ห้องฟรีส 2', 1),
(80, 1, NULL, 'PCS ห้องฟรีส 1', 1),
(81, 1, NULL, 'PCS ห้องพัฒนาธุรกิจ4', 1),
(82, 1, NULL, 'PCS ห้องพัฒนาธุรกิจ3', 1),
(83, 1, NULL, 'PCS ห้องพัฒนาธุรกิจ2', 1),
(84, 1, NULL, 'PCS ห้องพัฒนาธุรกิจ', 1),
(85, 1, NULL, 'PCS ห้องพักวิทยากร', 1),
(86, 1, NULL, 'PCS ห้องพนักงาน WH', 1),
(87, 1, NULL, 'PCS ห้องพนักงาน CS', 1),
(88, 1, NULL, 'PCS ห้องผู้จัดการ CS', 1),
(89, 1, NULL, 'PCS ห้องผู้จัการฝ่ายวิศวกรรม', 1),
(90, 1, NULL, 'PCS ห้องประชุม อาคาร 6', 1),
(91, 1, NULL, 'PCS ห้องประชุม', 1),
(92, 1, NULL, 'PCS ห้องบัญชี-การเงิน', 1),
(93, 1, NULL, 'PCS ห้องทำงาน CUS', 1),
(94, 1, NULL, 'PCS ห้องคุณอัจฉรา', 1),
(95, 1, NULL, 'PCS ห้องคุณจิตชัย', 1),
(96, 1, NULL, 'PCS ห้องการตลาด', 1),
(97, 1, NULL, 'PCS ห้องInventory อ.6', 1),
(98, 1, NULL, 'PCS ห้องCONTROL SPIRAL FEEZER อ.1', 1),
(99, 1, NULL, 'PCS ห้องChill 30', 1),
(100, 1, NULL, 'PCS ห้อง QS', 1),
(101, 1, NULL, 'PCS ห้อง P4 อ.4', 1),
(102, 1, NULL, 'PCS ห้อง CUS', 1),
(103, 1, NULL, 'PCS ห้อง CHILL อ.1', 1),
(104, 1, NULL, 'PCS หลัง GEN ROOM 03', 1),
(105, 1, NULL, 'PCS หน้าห้องประชุม', 1),
(106, 1, NULL, 'PCS หน้าประตูห้องบัญชีคลัง', 1),
(107, 1, NULL, 'PCS สำนักงานชั่วคราวPLP อ.8', 1),
(108, 1, NULL, 'PCS ลานโหลดใหญ่ อ.6', 1),
(109, 1, NULL, 'PCS ลานโหลด อ.7', 1),
(110, 1, NULL, 'PCS ลานโหลด อ.5', 1),
(111, 1, NULL, 'PCS ลานโหลด อ.4', 1),
(112, 1, NULL, 'PCS ลานโหลด อ.3', 1),
(113, 1, NULL, 'PCS ลานโหลด อ.2', 1),
(114, 1, NULL, 'PCS ลานโหลด อ.1', 1),
(115, 1, NULL, 'PCS ลานโหลด', 1),
(116, 1, NULL, 'PCS รับวัตถุดิบฟรีสอ.4', 1),
(117, 1, NULL, 'PCS ฟรีส อาคาร 4', 1),
(118, 1, NULL, 'PCS ป้อมตาชั่งหน้าบริษัท', 1),
(119, 1, NULL, 'PCS ป้อมตาชั่ง อ.8', 1),
(120, 1, NULL, 'PCS บ้านพักลูกค้า อ.6', 1),
(121, 1, NULL, 'PCS บริเวณที่พักปลา อ.7', 1),
(122, 1, NULL, 'PCS ทางเดิน CS อ.6', 1),
(123, 1, NULL, 'PCS ทางเข้าห้อง Chill 30', 1),
(124, 1, NULL, 'PCS ด้านข้างแผนกซ่อมบำรุง', 1),
(125, 1, NULL, 'PCS ด้านข้าง อ.1', 1),
(126, 1, NULL, 'PCS ดาดฟ้าอาคาร1', 1),
(127, 1, NULL, 'PCS ดาดฟ้าอาคาร 8', 1),
(128, 1, NULL, 'PCS ดาดฟ้าอาคาร 6', 1),
(129, 1, NULL, 'PCS ดาดฟ้าอาคาร 4', 1),
(130, 1, NULL, 'PCS ดาดฟ้าอาคาร 3', 1),
(131, 1, NULL, 'PCS คลังแห้ง อ. 6', 1),
(132, 1, NULL, 'PCS คลังสินค้า', 1),
(133, 1, NULL, 'PCS SPARAL FREEZER อ.1', 1),
(134, 1, NULL, 'PCS SOLAR ROOF อาคาร 8', 1),
(135, 1, NULL, 'PCS SOLAR ROOF อาคาร 6', 1),
(136, 1, NULL, 'PCS SOLAR ROOF อาคาร 4', 1),
(137, 1, NULL, 'PCS SOLAR ROOF อาคาร 2', 1),
(138, 1, NULL, 'PCS QA', 1),
(139, 1, NULL, 'PCS PASSAGEWAY6', 1),
(140, 1, NULL, 'PCS PASSAGEWAY อ.4', 1),
(141, 1, NULL, 'PCS MDB ROOM 08', 1),
(142, 1, NULL, 'PCS MACHINE ROOM 08', 1),
(143, 1, NULL, 'PCS MACHINE ROOM 06', 1),
(144, 1, NULL, 'PCS MACHINE ROOM 05', 1),
(145, 1, NULL, 'PCS MACHINE ROOM 04', 1),
(146, 1, NULL, 'PCS MACHINE ROOM 03', 1),
(147, 1, NULL, 'PCS MACHINE ROOM 02', 1),
(148, 1, NULL, 'PCS MACHINE ROOM 01', 1),
(149, 1, NULL, 'PCS INVENTORY', 1),
(150, 1, NULL, 'PCS GEN ROOM 08', 1),
(151, 1, NULL, 'PCS GEN ROOM 06', 1),
(152, 1, NULL, 'PCS GEN ROOM 04', 1),
(153, 1, NULL, 'PCS GEN ROOM 03', 1),
(154, 1, NULL, 'PCS GEN ROOM 01', 1),
(155, 1, NULL, 'PCS CONTROL บ่อน้ำเสีย', 1),
(156, 1, NULL, 'PCS CONTROL SPIRAL FEEZER อ.1', 1),
(157, 1, NULL, 'PCS CONTROL SOLAR อ.6', 1),
(158, 1, NULL, 'PCS CONTROL SOLAR อ.4', 1),
(159, 1, NULL, 'PCS CONTROL SOLAR อ.1', 1),
(160, 1, NULL, 'PCS CONTROL SOLAR ROOF อ.2', 1),
(161, 1, NULL, 'PCS CONTROL SOLAR ROOF อ. 8', 1),
(162, 1, NULL, 'PCS CONTROL ROOM SOLAR ROOF อ.6', 1),
(163, 1, NULL, 'PCS CONTROL ROOM SOLAR ROOF อ.4', 1),
(164, 1, NULL, 'PCS CONTROL ROOM 08', 1),
(165, 1, NULL, 'PCS CONTROL ROOM 07', 1),
(166, 1, NULL, 'PCS CONTROL ROOM 06', 1),
(167, 1, NULL, 'PCS CONTROL ROOM 05', 1),
(168, 1, NULL, 'PCS CONTROL ROOM 04', 1),
(169, 1, NULL, 'PCS CONTROL ROOM 03', 1),
(170, 1, NULL, 'PCS CONTROL ROOM 02', 1),
(171, 1, NULL, 'PCS CONTROL ROOM 01', 1),
(172, 1, NULL, 'PCS CONTROL MOBILE RACK 6', 1),
(173, 1, NULL, 'PCS ANTEROOM อ.6', 1),
(174, 1, NULL, 'PCS ANTEROOM อ.4', 1),
(175, 1, NULL, 'PCS ANTEROOM อ.3', 1),
(176, 1, NULL, 'PCS ANTEROOM อ.2', 1),
(177, 1, NULL, 'PCS ANTEROOM อ.1', 1),
(178, 1, NULL, 'PCS ANTE ROOM อ.7', 1),
(179, 1, NULL, 'PCS AIRLOCK อ.4', 1),
(180, 1, NULL, 'PCS AIR LOCK อ.6', 1),
(181, 1, NULL, 'PCS AIR LOCK อ.3', 1),
(182, 1, NULL, 'PCS AIR LOCK อ.2', 1),
(183, 1, NULL, 'PCS', 1),
(184, 5, NULL, 'JPK คลังสินค้าอาคาร B2', 1),
(185, 5, NULL, 'JPK คลังสินค้าอาคาร B1(THPD)', 1),
(186, 5, NULL, 'JPK คลังสินค้า', 1),
(187, 5, NULL, 'JPK MACHINE ROOM B2', 1),
(188, 5, NULL, 'JPK MACHINE ROOM B1', 1),
(189, 5, NULL, 'JPK MACHINE ROOM 01', 1),
(190, 2, NULL, 'JPAC อาคาร C', 1),
(191, 2, NULL, 'JPAC อาคาร B', 1),
(192, 2, NULL, 'JPAC อาคาร A', 1),
(193, 2, NULL, 'JPAC คลังสินค้า', 1),
(194, 2, NULL, 'JPAC Office', 1),
(195, 2, NULL, 'JPAC MACHINE ROOM 01', 1);

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
(1, NULL, 1, NULL, NULL, NULL, 7, 'ไม่มีหมวด', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(2, NULL, 1, NULL, NULL, NULL, 7, 'Standard Weight (F1) (ตุ้มน้ำหนัก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(3, NULL, 1, NULL, NULL, NULL, 7, 'Electronic Balance', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(4, NULL, 1, NULL, NULL, NULL, 7, 'Digital Thermometer with Probe (โพรบวัดอุณหภูมิ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(5, NULL, 1, NULL, NULL, NULL, 7, 'Digital Thermometer (เทอร์โมมิเตอร์แบบดิจิตอล)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(6, NULL, 1, NULL, NULL, NULL, 7, 'Gas Detector (เครื่องวัดแก็ส)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(7, NULL, 1, NULL, NULL, NULL, 7, 'Lux Meter (เครื่องวัดความเข้มแสง, เครื่องวัดแสง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(8, NULL, 1, NULL, NULL, NULL, 7, 'Machine Balance', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(9, NULL, 1, NULL, NULL, NULL, 7, 'Screw Compressor (เครื่องอัดลมแบบสกรู, ปั๊มลมสกรู)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(10, NULL, 1, NULL, NULL, NULL, 7, 'Wood Impregnation Vessel (ถังอัดน้ำยา, เครื่องอัดน้ายา)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(11, NULL, 1, NULL, NULL, NULL, 7, 'Pump, ปั๊ม (เครื่องสูบ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(12, NULL, 1, NULL, NULL, NULL, 7, 'Inter Cooler Tank', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(13, NULL, 1, NULL, NULL, NULL, 7, 'Low Pressure Reciver', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(14, NULL, 1, NULL, NULL, NULL, 7, 'Evaporative Condenser (เครื่องควบแน่นแบบระเหย, ระบายความร้อนแบบการระเหย)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(15, NULL, 1, NULL, NULL, NULL, 7, 'Air Purger', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(16, NULL, 1, NULL, NULL, NULL, 7, 'Cold Room (ห้องเย็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(17, NULL, 1, NULL, NULL, NULL, 7, 'Chill Tunnel', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(18, NULL, 1, NULL, NULL, NULL, 7, 'Cold Pack Chilling Unit', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(19, NULL, 1, NULL, NULL, NULL, 7, 'Mobile Rack (ชั้นวางสินค้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(20, NULL, 1, NULL, NULL, NULL, 7, 'Power Pallet Truck (รถพาเลทไฟฟ้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(21, NULL, 1, NULL, NULL, NULL, 7, 'Magnetic Conveyor (สายพานลำเลียงแบบแม่เหล็ก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(22, NULL, 1, NULL, NULL, NULL, 7, 'Carbon Filter Tank (ถังกรองคาร์บอน, ถังกรองถ่าน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(23, NULL, 1, NULL, NULL, NULL, 7, 'Resin Fillter Tanks (ถังกรองเรซิ่น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(24, NULL, 1, NULL, NULL, NULL, 7, 'Transformer (หม้อแปลงไฟฟ้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(25, NULL, 1, NULL, NULL, NULL, 7, 'Water Pump (ปั๊มน้ำ, เครื่องสูบน้ำ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(26, NULL, 1, NULL, NULL, NULL, 7, 'Electric Insect Killer (เครื่องดักแมลง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(27, NULL, 1, NULL, NULL, NULL, 7, 'Low Pressure Pump', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(28, NULL, 1, NULL, NULL, NULL, 7, 'Air Blast (ห้องฟรีส)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(29, NULL, 1, NULL, NULL, NULL, 7, 'Forklift (รถโฟล์คลิฟท์)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(30, NULL, 1, NULL, NULL, NULL, 7, 'Electric Forklift (รถโฟล์คลิฟท์ไฟฟ้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(31, NULL, 1, NULL, NULL, NULL, 7, 'Car Lift (รถแฮนด์ลิฟท์)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(32, NULL, 1, NULL, NULL, NULL, 7, 'Meat Seperator (เครื่องรีดเนื้อ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(33, NULL, 1, NULL, NULL, NULL, 7, 'Washer (เครื่องล้างถาด)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(34, NULL, 1, NULL, NULL, NULL, 7, 'Generator (เครื่องปั่นไฟ, เครื่องกำเนิดไฟฟ้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(35, NULL, 1, NULL, NULL, NULL, 7, 'Power Meter, Radiofrequency, Shortwave Diathermy Unit', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(36, NULL, 1, NULL, NULL, NULL, 7, 'Compressor, คอมเพรสเซอร์', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(37, NULL, 1, NULL, NULL, NULL, 7, 'Chilling Storage Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(38, NULL, 1, NULL, NULL, NULL, 7, 'Cooling Tower (หอหล่อเย็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(39, NULL, 1, NULL, NULL, NULL, 7, 'Air Cooled Chiller, แอร์ชิลเลอร์ (เครื่องทำความเย็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(40, NULL, 1, NULL, NULL, NULL, 7, 'Forklift, โฟล์คลิฟท์ (รถยก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(41, NULL, 1, NULL, NULL, NULL, 7, 'Fire Pump (ปั๊มน้ำดับเพลิง, เครื่องสูบน้ำดับเพลิง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(42, NULL, 1, NULL, NULL, NULL, 7, 'Air Conditioner (แอร์)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(43, NULL, 1, NULL, NULL, NULL, 7, 'Water Cooler (เครื่องทำน้ำเย็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(44, NULL, 1, NULL, NULL, NULL, 7, 'Refrigerator (ตู้แช่เย็น, ตู้เย็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(45, NULL, 1, NULL, NULL, NULL, 7, 'Conveyor (สายพานลำเลียง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(46, NULL, 1, NULL, NULL, NULL, 7, 'Analog Multimeter', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(47, NULL, 1, NULL, NULL, NULL, 7, 'Electrical Control Panel (ตู้คอนโทรลไฟฟ้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(48, NULL, 1, NULL, NULL, NULL, 7, 'Fish Washer (เครื่องล้างปลา)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(49, NULL, 1, NULL, NULL, NULL, 7, 'Softener Filter Tank (ระบบถังกรองน้ำอ่อน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(50, NULL, 1, NULL, NULL, NULL, 7, 'High Pressure Pump (ปั้มแรงดันสูง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(51, NULL, 1, NULL, NULL, NULL, 7, 'Evaporator', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(52, NULL, 1, NULL, NULL, NULL, 7, 'Emergency Light (ไฟฉุกเฉิน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(53, NULL, 1, NULL, NULL, NULL, 7, 'Spiral Freezer Conveyor', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(54, NULL, 1, NULL, NULL, NULL, 7, 'Rolling Machine', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(55, NULL, 1, NULL, NULL, NULL, 7, 'Strapping Machine (เครื่องรัดกล่อง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(56, NULL, 1, NULL, NULL, NULL, 7, 'Metal Detector (เครื่องตรวจจับโลหะ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(57, NULL, 1, NULL, NULL, NULL, 7, 'Inverter Solar', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(58, NULL, 1, NULL, NULL, NULL, 7, 'Sand Tank', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(59, NULL, 1, NULL, NULL, NULL, 7, 'Reverse Osmosis (RO) (การกรองน้ำแบบ Reverse Osmosis)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(60, NULL, 1, NULL, NULL, NULL, 7, 'Wastewater Treatment (ระบบบําบัดน้ําเสีย)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(61, NULL, 1, NULL, NULL, NULL, 7, 'Sandblasting Machine (เครื่องยิงทราย)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(62, NULL, 1, NULL, NULL, NULL, 7, 'Air Handling Unit (AHU) (เครื่องส่งลม, เครื่องควบคุมอากาศ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(63, NULL, 1, NULL, NULL, NULL, 7, 'Ammonia Shell and Tube Tank', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(64, NULL, 1, NULL, NULL, NULL, 7, 'Dock Leveler (สะพานปรับระดับ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(65, NULL, 1, NULL, NULL, NULL, 7, 'Lift Machine (ลิฟท์ยกของ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(66, NULL, 1, NULL, NULL, NULL, 7, 'ASRS System (ระบบจัดเก็บสินค้าอัตโนมัติ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(67, NULL, 1, NULL, NULL, NULL, 7, 'Air Shower, แอร์ชาวเวอร์ (ม่านอากาศ, พัดลมเป่าอากาศ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(68, NULL, 1, NULL, NULL, NULL, 7, 'Pump Vessel', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(69, NULL, 1, NULL, NULL, NULL, 7, 'Air Cleaner, Particulate/Gas/Vapor', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(70, NULL, 1, NULL, NULL, NULL, 7, 'Belt Convayer (สายพานลำเลียงยาง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(71, NULL, 1, NULL, NULL, NULL, 7, 'Wastwater Treatment Tank (บ่อบำบัดน้ำเสีย)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(72, NULL, 1, NULL, NULL, NULL, 7, 'AUTO SCRUBBING MACHINE(เครื่องขัดพื้น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(73, NULL, 1, NULL, NULL, NULL, 7, 'Temperature And Humidity (เครื่องวัดอุณหภูมิและความชื้น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(74, NULL, 1, NULL, NULL, NULL, 7, 'Auto Door (ประตูอัตโนมัติ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(75, NULL, 1, NULL, NULL, NULL, 7, 'Auto speed  Door', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(76, NULL, 1, NULL, NULL, NULL, 7, 'Debox Machine', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(77, NULL, 1, NULL, NULL, NULL, 7, 'Infrared Thermometer (เครื่องวัดอุณหภูมิอินฟาเรด)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(78, NULL, 1, NULL, NULL, NULL, 7, 'Standard Weight (ตุ้มน้ำหนักมาตรฐาน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(79, NULL, 1, NULL, NULL, NULL, 7, 'Thermo-Hygrometer (เครื่องวัดอุณหภูมิและความชื้น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(80, NULL, 1, NULL, NULL, NULL, 7, 'Truck (รถบรรทุก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(81, NULL, 1, NULL, NULL, NULL, 7, 'Office Room (ห้องทำงาน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(82, NULL, 1, NULL, NULL, NULL, 7, 'Meeting Room (ห้องประชุม)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(83, NULL, 1, NULL, NULL, NULL, 7, 'Server, เซิร์ฟเวอร์', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(84, NULL, 1, NULL, NULL, NULL, 7, 'Security room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(85, NULL, 1, NULL, NULL, NULL, 7, 'Toilet Room (ห้องน้ำ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(86, NULL, 1, NULL, NULL, NULL, 7, 'Overhead Door', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(87, NULL, 1, NULL, NULL, NULL, 7, 'ประตูม้วนเหล็กไฟฟ้า', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(88, NULL, 1, NULL, NULL, NULL, 7, 'Room (ห้อง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(89, NULL, 1, NULL, NULL, NULL, 7, 'Maintenance Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(90, NULL, 1, NULL, NULL, NULL, 7, 'Electric Control Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(91, NULL, 1, NULL, NULL, NULL, 7, 'Control Room (ห้องควบคุม)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(92, NULL, 1, NULL, NULL, NULL, 7, 'Dock Load', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(93, NULL, 1, NULL, NULL, NULL, 7, 'Anti Room (ห้องเย็นพักสินค้า)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(94, NULL, 1, NULL, NULL, NULL, 7, 'Packing Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(95, NULL, 1, NULL, NULL, NULL, 7, 'Cold Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(96, NULL, 1, NULL, NULL, NULL, 7, 'Freezer (ตู้แช่)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(97, NULL, 1, NULL, NULL, NULL, 7, 'Area (พื้นที่)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(98, NULL, 1, NULL, NULL, NULL, 7, 'Cold Storage Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(99, NULL, 1, NULL, NULL, NULL, 7, 'Freezer Room', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(100, NULL, 1, NULL, NULL, NULL, 7, 'Structure & Equipment', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(101, NULL, 1, NULL, NULL, NULL, 7, 'Floor (พื้น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(102, NULL, 1, NULL, NULL, NULL, 7, 'Office (สำนักงาน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(103, NULL, 1, NULL, NULL, NULL, 7, 'LOAD/UNLOAD (จุดเข้าออกชิ้นงาน)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(104, NULL, 1, NULL, NULL, NULL, 7, 'Roof', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(105, NULL, 1, NULL, NULL, NULL, 7, 'Sifter (ตะแกรงเหลี่ยม)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(106, NULL, 1, NULL, NULL, NULL, 7, 'PVC Strip Curtain (ม่านพลาสติก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(107, NULL, 1, NULL, NULL, NULL, 7, 'Copy Machine', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(108, NULL, 1, NULL, NULL, NULL, 7, 'Laminating Machine', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(109, NULL, 1, NULL, NULL, NULL, 7, 'Auto Machine', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(110, NULL, 1, NULL, NULL, NULL, 7, 'Fan (พัดลม)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(111, NULL, 1, NULL, NULL, NULL, 7, 'Electrical Office', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(112, NULL, 1, NULL, NULL, NULL, 7, 'Microwave', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(113, NULL, 1, NULL, NULL, NULL, 7, 'Battery', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(114, NULL, 1, NULL, NULL, NULL, 7, 'MCB (ตู้จ่ายไฟ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(115, NULL, 1, NULL, NULL, NULL, 7, 'Switch', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(116, NULL, 1, NULL, NULL, NULL, 7, 'Spot Light', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(117, NULL, 1, NULL, NULL, NULL, 7, 'Clock, Elapsed-Time', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(118, NULL, 1, NULL, NULL, NULL, 7, 'Table', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(119, NULL, 1, NULL, NULL, NULL, 7, 'Sink', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(120, NULL, 1, NULL, NULL, NULL, 7, 'Chair (เก้าอี้)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(121, NULL, 1, NULL, NULL, NULL, 7, 'Carbinet (ตู้)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(122, NULL, 1, NULL, NULL, NULL, 7, 'Stacking Shelf', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(123, NULL, 1, NULL, NULL, NULL, 7, 'Car (รถ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(124, NULL, 1, NULL, NULL, NULL, 7, 'Valve, วาล์ว', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(125, NULL, 1, NULL, NULL, NULL, 7, 'Fish Pond', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(126, NULL, 1, NULL, NULL, NULL, 7, 'Solar Inverter', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(127, NULL, 1, NULL, NULL, NULL, 7, 'Tool (เครื่องมือ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(128, NULL, 1, NULL, NULL, NULL, 7, 'Bucket', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(129, NULL, 1, NULL, NULL, NULL, 7, 'Pinch Valve', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(130, NULL, 1, NULL, NULL, NULL, 7, 'Equipment​ Inline​ Unit', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(131, NULL, 1, NULL, NULL, NULL, 7, 'Tablet', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(132, NULL, 1, NULL, NULL, NULL, 7, 'Fire Alarm System (ระบบแจ้งเหตุเพลิงไหม้)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(133, NULL, 1, NULL, NULL, NULL, 7, 'Cabinet (ตู้)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(134, NULL, 1, NULL, NULL, NULL, 7, 'Fire Hose (สายดับเพลิง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(135, NULL, 1, NULL, NULL, NULL, 7, 'Clothes Dryers', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(136, NULL, 1, NULL, NULL, NULL, 7, 'Balance Scales', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(137, NULL, 1, NULL, NULL, NULL, 7, 'Cart (รถเข็น)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(138, NULL, 1, NULL, NULL, NULL, 7, 'Pallet Dolly', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(139, NULL, 1, NULL, NULL, NULL, 7, 'Sign', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(140, NULL, 1, NULL, NULL, NULL, 7, 'Emergency', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(141, NULL, 1, NULL, NULL, NULL, 7, 'Fire Extinguisher (ถังดับเพลิง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(142, NULL, 1, NULL, NULL, NULL, 7, 'Signboad', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(143, NULL, 1, NULL, NULL, NULL, 7, 'Building (อาคาร, ตึก)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(144, NULL, 1, NULL, NULL, NULL, 7, 'Stacker (รถยกพาเลท, รถยกสูง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(145, NULL, 1, NULL, NULL, NULL, 7, 'Washer (เครื่องล้างกะบะ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(146, NULL, 1, NULL, NULL, NULL, 7, 'Pallet Wrapping Machine (เครื่องพันพาเลท)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(147, NULL, 1, NULL, NULL, NULL, 7, 'Rework', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(148, NULL, 1, NULL, NULL, NULL, 7, 'Lift (ลิฟส่งของ)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(149, NULL, 1, NULL, NULL, NULL, 7, 'High Pressure (เครื่องฉีดน้ำแรงดันสูง)', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(150, NULL, 1, NULL, NULL, NULL, 7, 'High Pressure Pump House', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(151, NULL, 1, NULL, NULL, NULL, 7, 'Hydraulic Dock Leveler', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(152, NULL, 1, NULL, NULL, NULL, 7, 'Electric Fork Lift Truck 3 tons', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(153, NULL, 1, NULL, NULL, NULL, 7, 'Pallet Stacker', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1),
(154, NULL, 1, NULL, NULL, NULL, 7, 'Solar Cell True', NULL, '2023-03-24 12:12:12', 1, NULL, NULL, 1);

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
-- Table structure for table `tb_change_parts`
--

CREATE TABLE `tb_change_parts` (
  `id_parts` int NOT NULL,
  `ref_id_maintenance_request` int NOT NULL COMMENT 'REF.ไอดีใบแจ้งซ่อม',
  `parts_serialno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ซีเรียลนัมเบอร์(ถ้ามี)',
  `parts_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่ออะไหล่',
  `parts_description` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อธิบายอะไหล่ที่เปลี่ยน(ถ้ามี)',
  `parts_price` double DEFAULT NULL COMMENT 'ราคา(ถ้ามี)',
  `parts_qty` int DEFAULT NULL COMMENT 'จำนวนชิ้น(ถ้ามี)',
  `date_parts_change` datetime DEFAULT NULL COMMENT 'วันที่เปลี่ยนอะไหล่(ถ้ามี)',
  `ref_id_user_change` int NOT NULL COMMENT 'REF.ไอดีผู้อัพเดท',
  `date_adddata` datetime NOT NULL COMMENT 'วันที่อัพเดทข้อมูล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางรายการอะไหล่ที่เปลี่ยน';

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
(14, 'MIS', 2, 'จัดการข้อมูล', 1),
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

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `id_log` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บLog-timeline';

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
(1, 'MT-AS-0001', 7, 80, NULL, NULL, '1ฒภ-305', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(2, 'MT-AS-0002', 7, 80, NULL, NULL, '1ฒภ-306', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(3, 'MT-AS-0003', 7, 80, NULL, NULL, '2ฒง-6932', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(4, 'MT-AS-0004', 7, 80, NULL, NULL, '2ฒง-6987', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(5, 'MT-AS-0005', 7, 80, NULL, NULL, '2ฒญ-4896', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(6, 'MT-AS-0006', 7, 80, NULL, NULL, '2ฒญ-4897', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(7, 'MT-AS-0007', 7, 80, NULL, NULL, '3ฒฐ-5512', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(8, 'MT-AS-0008', 7, 80, NULL, NULL, '3ฒฐ-5514', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(9, 'MT-AS-0009', 7, 80, NULL, NULL, '3ฒน-304', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(10, 'MT-AS-0010', 7, 80, NULL, NULL, '3ฒน-305', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(11, 'MT-AS-0011', 7, 80, NULL, NULL, '3ฒน-313', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(12, 'MT-AS-0012', 7, 80, NULL, NULL, '70-2571', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(13, 'MT-AS-0013', 7, 80, NULL, NULL, '70-2576', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(14, 'MT-AS-0014', 7, 80, NULL, NULL, '70-2579', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(15, 'MT-AS-0015', 7, 80, NULL, NULL, '70-2581', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(16, 'MT-AS-0016', 7, 80, NULL, NULL, '70-2582', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(17, 'MT-AS-0017', 7, 80, NULL, NULL, '70-2583', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(18, 'MT-AS-0018', 7, 80, NULL, NULL, '70-2584', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(19, 'MT-AS-0019', 7, 80, NULL, NULL, '70-2585', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(20, 'MT-AS-0020', 7, 80, NULL, NULL, '70-2878', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(21, 'MT-AS-0021', 7, 80, NULL, NULL, '70-2906', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(22, 'MT-AS-0022', 7, 80, NULL, NULL, '70-2982', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(23, 'MT-AS-0023', 7, 80, NULL, NULL, '70-3133', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(24, 'MT-AS-0024', 7, 80, NULL, NULL, '70-3134', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(25, 'MT-AS-0025', 7, 80, NULL, NULL, '70-3135', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(26, 'MT-AS-0026', 7, 80, NULL, NULL, '70-4289', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(27, 'MT-AS-0027', 7, 80, NULL, NULL, '70-4653', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(28, 'MT-AS-0028', 7, 80, NULL, NULL, '70-5575', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(29, 'MT-AS-0029', 7, 80, NULL, NULL, '70-5673', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(30, 'MT-AS-0030', 7, 80, NULL, NULL, '70-5842', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(31, 'MT-AS-0031', 7, 80, NULL, NULL, '70-6356', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(32, 'MT-AS-0032', 7, 80, NULL, NULL, '70-6390', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(33, 'MT-AS-0033', 7, 80, NULL, NULL, '70-6993', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(34, 'MT-AS-0034', 7, 80, NULL, NULL, '70-6994', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(35, 'MT-AS-0035', 7, 80, NULL, NULL, '70-7295', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(36, 'MT-AS-0036', 7, 80, NULL, NULL, '70-7296', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(37, 'MT-AS-0037', 7, 80, NULL, NULL, '70-7703', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(38, 'MT-AS-0038', 7, 80, NULL, NULL, '70-7704', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(39, 'MT-AS-0039', 7, 80, NULL, NULL, '70-8332', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(40, 'MT-AS-0040', 7, 80, NULL, NULL, '70-8333', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(41, 'MT-AS-0041', 7, 80, NULL, NULL, '70-8334', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(42, 'MT-AS-0042', 7, 80, NULL, NULL, '70-8546', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(43, 'MT-AS-0043', 7, 80, NULL, NULL, '70-8779', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(44, 'MT-AS-0044', 7, 80, NULL, NULL, '70-8780', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(45, 'MT-AS-0045', 7, 80, NULL, NULL, '71-0077', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(46, 'MT-AS-0046', 7, 80, NULL, NULL, '71-0078', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(47, 'MT-AS-0047', 7, 80, NULL, NULL, '71-0236', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(48, 'MT-AS-0048', 7, 80, NULL, NULL, '71-0237', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(49, 'MT-AS-0049', 7, 37, NULL, NULL, 'ACC ROOM 3_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(50, 'MT-AS-0050', 7, 37, NULL, NULL, 'ACC ROOM 3_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(51, 'MT-AS-0051', 7, 37, NULL, NULL, 'ACC ROOM 4_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(52, 'MT-AS-0052', 7, 37, NULL, NULL, 'ACC ROOM 4_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(53, 'MT-AS-0053', 7, 37, NULL, NULL, 'ACC ROOM 5_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(54, 'MT-AS-0054', 7, 37, NULL, NULL, 'ACC ROOM 5_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(55, 'MT-AS-0055', 7, 37, NULL, NULL, 'ACC ROOM 6_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(56, 'MT-AS-0056', 7, 37, NULL, NULL, 'ACC ROOM 6_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(57, 'MT-AS-0057', 7, 37, NULL, NULL, 'ACC ROOM 7_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(58, 'MT-AS-0058', 7, 37, NULL, NULL, 'ACC ROOM 7_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(59, 'MT-AS-0059', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(60, 'MT-AS-0060', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(61, 'MT-AS-0061', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(62, 'MT-AS-0062', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(63, 'MT-AS-0063', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(64, 'MT-AS-0064', 7, 37, NULL, NULL, 'ACC ROOM SYTEM E_6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(65, 'MT-AS-0065', 7, 62, NULL, NULL, 'AHU 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(66, 'MT-AS-0066', 7, 62, NULL, NULL, 'AHU 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(67, 'MT-AS-0067', 7, 39, NULL, NULL, 'AHU 22 Tr(LOAD)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(68, 'MT-AS-0068', 7, 39, NULL, NULL, 'AHU 30.5 Tr(SA)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(69, 'MT-AS-0069', 7, 39, NULL, NULL, 'AHU 30.5 Tr(SB)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(70, 'MT-AS-0070', 7, 39, NULL, NULL, 'AHU 30.5 Tr(SC)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(71, 'MT-AS-0071', 7, 39, NULL, NULL, 'AHU 9.5 Tr(WW)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(72, 'MT-AS-0072', 7, 42, NULL, NULL, 'AIR CONDITIONER [220 V]ห้องคอนโทรล อ.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(73, 'MT-AS-0073', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(74, 'MT-AS-0074', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(75, 'MT-AS-0075', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(76, 'MT-AS-0076', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(77, 'MT-AS-0077', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(78, 'MT-AS-0078', 7, 4, NULL, NULL, 'AIR FLOW ASRS 1/6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(79, 'MT-AS-0079', 7, 4, NULL, NULL, 'AIR FLOW ASRS 2/1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(80, 'MT-AS-0080', 7, 4, NULL, NULL, 'AIR FLOW ASRS 2/2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(81, 'MT-AS-0081', 7, 4, NULL, NULL, 'AIR FLOW ASRS 2/3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(82, 'MT-AS-0082', 7, 4, NULL, NULL, 'AIR FLOW ASRS 2/4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(83, 'MT-AS-0083', 7, 62, NULL, NULL, 'AIR HANDING UNIT (AHU) อ.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(84, 'MT-AS-0084', 7, 62, NULL, NULL, 'AIR HANDING UNIT (AHU)อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(85, 'MT-AS-0085', 7, 4, NULL, NULL, 'AIR LOCK (อาคาร 2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(86, 'MT-AS-0086', 7, 4, NULL, NULL, 'AIR LOCK (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(87, 'MT-AS-0087', 7, 4, NULL, NULL, 'AIR LOCK (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(88, 'MT-AS-0088', 7, 4, NULL, NULL, 'AIR LOCK (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(89, 'MT-AS-0089', 7, 15, NULL, NULL, 'AIR PURGER อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(90, 'MT-AS-0090', 7, 67, NULL, NULL, 'AIR SHOWER อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(91, 'MT-AS-0091', 7, 11, NULL, NULL, 'AMMONIA PUMP', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(92, 'MT-AS-0092', 7, 11, NULL, NULL, 'AMMONIA PUMP CAM 2_4 DK 1634.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(93, 'MT-AS-0093', 7, 11, NULL, NULL, 'AMMONIA PUMP CAM 2_4 DK 1634.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(94, 'MT-AS-0094', 7, 11, NULL, NULL, 'AMMONIA PUMP CAM 2_4 DK 1634.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(95, 'MT-AS-0095', 7, 11, NULL, NULL, 'AMMONIA PUMP CAM 2_4 DK 1634.5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(96, 'MT-AS-0096', 7, 11, NULL, NULL, 'AMMONIA PUMP CAM 2_4 DK 1634.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(97, 'MT-AS-0097', 7, 11, NULL, NULL, 'AMMONIA PUMP อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(98, 'MT-AS-0098', 7, 63, NULL, NULL, 'AMMONIA TANK อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(99, 'MT-AS-0099', 7, 79, NULL, NULL, 'Ante 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(100, 'MT-AS-0100', 7, 4, NULL, NULL, 'Ante 1 AHU 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(101, 'MT-AS-0101', 7, 4, NULL, NULL, 'Ante 1 AHU 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(102, 'MT-AS-0102', 7, 4, NULL, NULL, 'Ante 1 AHU 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(103, 'MT-AS-0103', 7, 79, NULL, NULL, 'Ante 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(104, 'MT-AS-0104', 7, 79, NULL, NULL, 'Ante 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(105, 'MT-AS-0105', 7, 4, NULL, NULL, 'ANTE ASRS 1 (อาคาร8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(106, 'MT-AS-0106', 7, 4, NULL, NULL, 'ANTE ASRS 2 (อาคาร8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(107, 'MT-AS-0107', 7, 97, NULL, NULL, 'Ante Loading', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(108, 'MT-AS-0108', 7, 4, NULL, NULL, 'ANTE LOADING (อ.8) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(109, 'MT-AS-0109', 7, 4, NULL, NULL, 'ANTE LOADING (อ.8) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(110, 'MT-AS-0110', 7, 4, NULL, NULL, 'ANTE LOADING (อ.8) คอยค์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(111, 'MT-AS-0111', 7, 4, NULL, NULL, 'ANTE LOADING (อ.8) คอยค์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(112, 'MT-AS-0112', 7, 97, NULL, NULL, 'Ante Room', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(113, 'MT-AS-0113', 7, 4, NULL, NULL, 'ANTE ROOM (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(114, 'MT-AS-0114', 7, 4, NULL, NULL, 'ANTE ROOM 01', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(115, 'MT-AS-0115', 7, 4, NULL, NULL, 'ANTE ROOM 01 (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(116, 'MT-AS-0116', 7, 4, NULL, NULL, 'ANTE ROOM 01 (อาคาร 2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(117, 'MT-AS-0117', 7, 4, NULL, NULL, 'ANTE ROOM 01 (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(118, 'MT-AS-0118', 7, 4, NULL, NULL, 'ANTE ROOM 01 (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(119, 'MT-AS-0119', 7, 4, NULL, NULL, 'ANTE ROOM 01 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(120, 'MT-AS-0120', 7, 4, NULL, NULL, 'ANTE ROOM 02', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(121, 'MT-AS-0121', 7, 4, NULL, NULL, 'ANTE ROOM 02 (อาคาร 2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(122, 'MT-AS-0122', 7, 4, NULL, NULL, 'ANTE ROOM 02 (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(123, 'MT-AS-0123', 7, 4, NULL, NULL, 'ANTE ROOM 02 (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(124, 'MT-AS-0124', 7, 4, NULL, NULL, 'ANTE ROOM 02 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(125, 'MT-AS-0125', 7, 4, NULL, NULL, 'ANTE ROOM 03 (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(126, 'MT-AS-0126', 7, 4, NULL, NULL, 'ANTE ROOM 03 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(127, 'MT-AS-0127', 7, 4, NULL, NULL, 'Ante Room 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(128, 'MT-AS-0128', 7, 16, NULL, NULL, 'ANTE ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(129, 'MT-AS-0129', 7, 4, NULL, NULL, 'ANTE ROOM 1 (อาคาร 7)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(130, 'MT-AS-0130', 7, 4, NULL, NULL, 'Ante Room 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(131, 'MT-AS-0131', 7, 16, NULL, NULL, 'ANTE ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(132, 'MT-AS-0132', 7, 4, NULL, NULL, 'Ante Room 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(133, 'MT-AS-0133', 7, 16, NULL, NULL, 'ANTE ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(134, 'MT-AS-0134', 7, 93, NULL, NULL, 'Ante Room 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(135, 'MT-AS-0135', 7, 93, NULL, NULL, 'Ante Room ฟรีโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(136, 'MT-AS-0136', 7, 93, NULL, NULL, 'Ante Room เจนโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(137, 'MT-AS-0137', 7, 4, NULL, NULL, 'Anteroom 3 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(138, 'MT-AS-0138', 7, 66, NULL, NULL, 'ASRS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(139, 'MT-AS-0139', 7, 66, NULL, NULL, 'ASRS อาคาร 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(140, 'MT-AS-0140', 7, 15, NULL, NULL, 'AUTO PURGER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(141, 'MT-AS-0141', 7, 69, NULL, NULL, 'AUTO PURGER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(142, 'MT-AS-0142', 7, 74, NULL, NULL, 'Auto Slide Door1 AR01 Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(143, 'MT-AS-0143', 7, 74, NULL, NULL, 'Auto Slide Door10 BR10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(144, 'MT-AS-0144', 7, 74, NULL, NULL, 'Auto Slide Door2 AR02 Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(145, 'MT-AS-0145', 7, 74, NULL, NULL, 'Auto Slide Door3 AM02 Free Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(146, 'MT-AS-0146', 7, 74, NULL, NULL, 'Auto Slide Door4 AM03 Free Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(147, 'MT-AS-0147', 7, 74, NULL, NULL, 'Auto Slide Door5 AR04 Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(148, 'MT-AS-0148', 7, 74, NULL, NULL, 'Auto Slide Door6 AR05 Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(149, 'MT-AS-0149', 7, 74, NULL, NULL, 'Auto Slide Door7 AM06 Free Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(150, 'MT-AS-0150', 7, 74, NULL, NULL, 'Auto Slide Door8 BR09', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(151, 'MT-AS-0151', 7, 74, NULL, NULL, 'Auto Slide Door9 Ante 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(152, 'MT-AS-0152', 7, 75, NULL, NULL, 'Auto Speed Door \"IN\" Free Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(153, 'MT-AS-0153', 7, 75, NULL, NULL, 'Auto Speed Door2 \"OUT\" Free Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(154, 'MT-AS-0154', 7, 75, NULL, NULL, 'Auto Speed Door5 \"IN\" Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(155, 'MT-AS-0155', 7, 75, NULL, NULL, 'Auto Speed Door6 \"OUT\" Gen Zone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(156, 'MT-AS-0156', 7, 3, NULL, NULL, 'BALANCE MACHINE 15 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(157, 'MT-AS-0157', 7, 8, NULL, NULL, 'BALANCE MACHINE 15 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(158, 'MT-AS-0158', 7, 8, NULL, NULL, 'BALANCE MACHINE 2 Ton', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(159, 'MT-AS-0159', 7, 3, NULL, NULL, 'BALANCE MACHINE 2,000 Kg.(Digital Scale Floor scale 2000Kg)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(160, 'MT-AS-0160', 7, 3, NULL, NULL, 'BALANCE MACHINE 3 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(161, 'MT-AS-0161', 7, 3, NULL, NULL, 'BALANCE MACHINE 30 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(162, 'MT-AS-0162', 7, 3, NULL, NULL, 'BALANCE MACHINE 35 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(163, 'MT-AS-0163', 7, 3, NULL, NULL, 'BALANCE MACHINE 6 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(164, 'MT-AS-0164', 7, 3, NULL, NULL, 'BALANCE MACHINE 60 Kg. (เครื่องชั่งวางพื้น)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(165, 'MT-AS-0165', 7, 8, NULL, NULL, 'BALANCE MACHINE 60 Kg.(Spring Scale)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(166, 'MT-AS-0166', 7, 3, NULL, NULL, 'BALANCE MACHINE 7.5 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(167, 'MT-AS-0167', 7, 8, NULL, NULL, 'BALANCE MACHINE 80 Ton', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(168, 'MT-AS-0168', 7, 3, NULL, NULL, 'BALANCE MACHINE 80,000 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(169, 'MT-AS-0169', 7, 36, NULL, NULL, 'BITZER 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(170, 'MT-AS-0170', 7, 36, NULL, NULL, 'BITZER 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(171, 'MT-AS-0171', 7, 36, NULL, NULL, 'BITZER 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(172, 'MT-AS-0172', 7, 36, NULL, NULL, 'BITZER 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(173, 'MT-AS-0173', 7, 36, NULL, NULL, 'BITZER 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(174, 'MT-AS-0174', 7, 36, NULL, NULL, 'BITZER 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(175, 'MT-AS-0175', 7, 36, NULL, NULL, 'BITZER 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(176, 'MT-AS-0176', 7, 36, NULL, NULL, 'BITZER 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(177, 'MT-AS-0177', 7, 4, NULL, NULL, 'Blast Freezer 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(178, 'MT-AS-0178', 7, 28, NULL, NULL, 'BLAST FREEZER 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(179, 'MT-AS-0179', 7, 4, NULL, NULL, 'Blast Freezer 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(180, 'MT-AS-0180', 7, 28, NULL, NULL, 'BLAST FREEZER 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(181, 'MT-AS-0181', 7, 4, NULL, NULL, 'Blast Freezer 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(182, 'MT-AS-0182', 7, 28, NULL, NULL, 'BLAST FREEZER 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(183, 'MT-AS-0183', 7, 4, NULL, NULL, 'BLAST FREEZER 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(184, 'MT-AS-0184', 7, 4, NULL, NULL, 'BLAST FREEZER 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(185, 'MT-AS-0185', 7, 4, NULL, NULL, 'BLAST FREEZER 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(186, 'MT-AS-0186', 7, 40, NULL, NULL, 'BT  ELECTRIC  TRUCK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(187, 'MT-AS-0187', 7, 36, NULL, NULL, 'BTITZER 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(188, 'MT-AS-0188', 7, 36, NULL, NULL, 'BTITZER 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(189, 'MT-AS-0189', 7, 36, NULL, NULL, 'BTITZER 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(190, 'MT-AS-0190', 7, 22, NULL, NULL, 'CABON TANK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(191, 'MT-AS-0191', 7, 81, NULL, NULL, 'Checking Post Room', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(192, 'MT-AS-0192', 7, 4, NULL, NULL, 'CHILL ROOM', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(193, 'MT-AS-0193', 7, 39, NULL, NULL, 'CHILLER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(194, 'MT-AS-0194', 7, 95, NULL, NULL, 'Cold Room AM01', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(195, 'MT-AS-0195', 7, 95, NULL, NULL, 'Cold Room AM02', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(196, 'MT-AS-0196', 7, 95, NULL, NULL, 'Cold Room AR03', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(197, 'MT-AS-0197', 7, 95, NULL, NULL, 'Cold Room AR04', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(198, 'MT-AS-0198', 7, 95, NULL, NULL, 'Cold Room AR06', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(199, 'MT-AS-0199', 7, 95, NULL, NULL, 'Cold Room AR07', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(200, 'MT-AS-0200', 7, 95, NULL, NULL, 'Cold Room BR08', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(201, 'MT-AS-0201', 7, 95, NULL, NULL, 'Cold Room BR09', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(202, 'MT-AS-0202', 7, 95, NULL, NULL, 'Cold Room BR10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(203, 'MT-AS-0203', 7, 95, NULL, NULL, 'Cold Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(204, 'MT-AS-0204', 7, 95, NULL, NULL, 'Cold Room BR12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(205, 'MT-AS-0205', 7, 16, NULL, NULL, 'COLDROOM  F', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(206, 'MT-AS-0206', 7, 16, NULL, NULL, 'COLDROOM A', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(207, 'MT-AS-0207', 7, 16, NULL, NULL, 'COLDROOM B', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(208, 'MT-AS-0208', 7, 16, NULL, NULL, 'COLDROOM C', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(209, 'MT-AS-0209', 7, 16, NULL, NULL, 'COLDROOM D', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(210, 'MT-AS-0210', 7, 16, NULL, NULL, 'COLDROOM E', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(211, 'MT-AS-0211', 7, 9, NULL, NULL, 'Compressor 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(212, 'MT-AS-0212', 7, 9, NULL, NULL, 'Compressor 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(213, 'MT-AS-0213', 7, 9, NULL, NULL, 'Compressor 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(214, 'MT-AS-0214', 7, 9, NULL, NULL, 'COMPRESSOR 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(215, 'MT-AS-0215', 7, 46, NULL, NULL, 'CONTROL PANEL 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(216, 'MT-AS-0216', 7, 47, NULL, NULL, 'CONTROL PANEL 11 อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(217, 'MT-AS-0217', 7, 47, NULL, NULL, 'CONTROL PANEL 12 อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(218, 'MT-AS-0218', 7, 47, NULL, NULL, 'CONTROL PANEL 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(219, 'MT-AS-0219', 7, 47, NULL, NULL, 'CONTROL PANEL 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(220, 'MT-AS-0220', 7, 47, NULL, NULL, 'CONTROL PANEL 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(221, 'MT-AS-0221', 7, 47, NULL, NULL, 'CONTROL PANEL 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(222, 'MT-AS-0222', 7, 47, NULL, NULL, 'CONTROL PANEL 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(223, 'MT-AS-0223', 7, 47, NULL, NULL, 'CONTROL PANEL 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(224, 'MT-AS-0224', 7, 47, NULL, NULL, 'CONTROL PANEL 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(225, 'MT-AS-0225', 7, 47, NULL, NULL, 'CONTROL PANEL 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(226, 'MT-AS-0226', 7, 47, NULL, NULL, 'CONTROL SPIRAL FEEZER อ.1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(227, 'MT-AS-0227', 7, 48, NULL, NULL, 'Conveyer clean fish เครื่องล้างปลา อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(228, 'MT-AS-0228', 7, 25, NULL, NULL, 'COOL WATER PUMP', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(229, 'MT-AS-0229', 7, 38, NULL, NULL, 'COOLING TOWER Tr250', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(230, 'MT-AS-0230', 7, 4, NULL, NULL, 'Coretemp FREEZE 01(ห้องฟรีส 01)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(231, 'MT-AS-0231', 7, 4, NULL, NULL, 'Coretemp FREEZE 02(ห้องฟรีส 02)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(232, 'MT-AS-0232', 7, 4, NULL, NULL, 'Coretemp FREEZE 03(ห้องฟรีส 03)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(233, 'MT-AS-0233', 7, 4, NULL, NULL, 'Coretemp FREEZE 04(ห้องฟรีส 04)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(234, 'MT-AS-0234', 7, 4, NULL, NULL, 'Coretemp FREEZE 05(ห้องฟรีส 05)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(235, 'MT-AS-0235', 7, 4, NULL, NULL, 'Coretemp FREEZE 06(ห้องฟรีส 06)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(236, 'MT-AS-0236', 7, 4, NULL, NULL, 'Coretemp FREEZE 07(ห้องฟรีส 07)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(237, 'MT-AS-0237', 7, 4, NULL, NULL, 'Coretemp FREEZE 08(ห้องฟรีส 08)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(238, 'MT-AS-0238', 7, 29, NULL, NULL, 'Counter Balance', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(239, 'MT-AS-0239', 7, 40, NULL, NULL, 'COUNTER BALANCN', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(240, 'MT-AS-0240', 7, 4, NULL, NULL, 'DIGITAL THERMOMETER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(241, 'MT-AS-0241', 7, 5, NULL, NULL, 'DIGITAL THERMOMETER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(242, 'MT-AS-0242', 7, 4, NULL, NULL, 'DIGITAL THERMOMETER (Master)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(243, 'MT-AS-0243', 7, 5, NULL, NULL, 'DIGITAL THERMOMETER (Master)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(244, 'MT-AS-0244', 7, 5, NULL, NULL, 'DIGITAL THERMOMITER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(245, 'MT-AS-0245', 7, 5, NULL, NULL, 'DIGITAL THERMOMITER (MASTER)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(246, 'MT-AS-0246', 7, 151, NULL, NULL, 'Dock leveler', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(247, 'MT-AS-0247', 7, 151, NULL, NULL, 'dock leveler 04', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(248, 'MT-AS-0248', 7, 151, NULL, NULL, 'dock leveler 06', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(249, 'MT-AS-0249', 7, 151, NULL, NULL, 'dock leveler01', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(250, 'MT-AS-0250', 7, 64, NULL, NULL, 'Dock Lever Free Zone 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(251, 'MT-AS-0251', 7, 64, NULL, NULL, 'Dock Lever Free Zone 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(252, 'MT-AS-0252', 7, 64, NULL, NULL, 'Dock Lever Gen Zone 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(253, 'MT-AS-0253', 7, 64, NULL, NULL, 'Dock Lever Gen Zone 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(254, 'MT-AS-0254', 7, 92, NULL, NULL, 'Dock ทางลงโฟรคลิฟท์ลานโหลด 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(255, 'MT-AS-0255', 7, 92, NULL, NULL, 'Dock ทางลงโฟรคลิฟท์ลานโหลด 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(256, 'MT-AS-0256', 7, 92, NULL, NULL, 'Dock ทางลงโฟรคลิฟท์เจนโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(257, 'MT-AS-0257', 7, 92, NULL, NULL, 'Dock เก็บของฟรีโซน 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(258, 'MT-AS-0258', 7, 92, NULL, NULL, 'Dock เก็บของฟรีโซน 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(259, 'MT-AS-0259', 7, 92, NULL, NULL, 'Dock เก็บของฟรีโซน 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(260, 'MT-AS-0260', 7, 92, NULL, NULL, 'Dock เก็บของเจนโซน 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(261, 'MT-AS-0261', 7, 92, NULL, NULL, 'Dock เก็บของเจนโซน 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(262, 'MT-AS-0262', 7, 153, NULL, NULL, 'Electric Pallet Stacker', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(263, 'MT-AS-0263', 7, 30, NULL, NULL, 'ELECTRIC REACH TRUCK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(264, 'MT-AS-0264', 7, 8, NULL, NULL, 'Electronic Balance 30 kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(265, 'MT-AS-0265', 7, 8, NULL, NULL, 'Electronic Balance 7.5 kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(266, 'MT-AS-0266', 7, 52, NULL, NULL, 'Emergency Light 1 Loading Genzone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(267, 'MT-AS-0267', 7, 52, NULL, NULL, 'Emergency Light 10 Loading 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(268, 'MT-AS-0268', 7, 52, NULL, NULL, 'Emergency Light 11 Thawing Room', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(269, 'MT-AS-0269', 7, 52, NULL, NULL, 'Emergency Light 12 ทางขึ้นบันไดชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(270, 'MT-AS-0270', 7, 52, NULL, NULL, 'Emergency Light 13 Anteroom 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(271, 'MT-AS-0271', 7, 52, NULL, NULL, 'Emergency Light 14 ชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(272, 'MT-AS-0272', 7, 52, NULL, NULL, 'Emergency Light 15 MBD Room', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(273, 'MT-AS-0273', 7, 52, NULL, NULL, 'Emergency Light 16 In-Out Loading 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(274, 'MT-AS-0274', 7, 52, NULL, NULL, 'Emergency Light 17 Loading 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(275, 'MT-AS-0275', 7, 52, NULL, NULL, 'Emergency Light 18 Loading 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(276, 'MT-AS-0276', 7, 52, NULL, NULL, 'Emergency Light 19 BR10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(277, 'MT-AS-0277', 7, 52, NULL, NULL, 'Emergency Light 2 ห้องแพ็ค 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(278, 'MT-AS-0278', 7, 52, NULL, NULL, 'Emergency Light 20 BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(279, 'MT-AS-0279', 7, 52, NULL, NULL, 'Emergency Light 21 Loading 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(280, 'MT-AS-0280', 7, 52, NULL, NULL, 'Emergency Light 3 ห้องแพ็ค 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(281, 'MT-AS-0281', 7, 52, NULL, NULL, 'Emergency Light 4 Loading Freezone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(282, 'MT-AS-0282', 7, 52, NULL, NULL, 'Emergency Light 5 In-Out Freezone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(283, 'MT-AS-0283', 7, 52, NULL, NULL, 'Emergency Light 6 Production Line', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(284, 'MT-AS-0284', 7, 52, NULL, NULL, 'Emergency Light 7 Office 3fl.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(285, 'MT-AS-0285', 7, 52, NULL, NULL, 'Emergency Light 8 Office 2fl.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(286, 'MT-AS-0286', 7, 52, NULL, NULL, 'Emergency Light 9 In-Out Loading 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(287, 'MT-AS-0287', 7, 14, NULL, NULL, 'EVAPORATIVE CONDENSOR 01', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(288, 'MT-AS-0288', 7, 14, NULL, NULL, 'EVAPORATIVE CONDENSOR 02', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(289, 'MT-AS-0289', 7, 14, NULL, NULL, 'EVAPORATIVE CONDENSOR 03', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(290, 'MT-AS-0290', 7, 14, NULL, NULL, 'EVAPORATIVE CONDISER 16 อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(291, 'MT-AS-0291', 7, 14, NULL, NULL, 'EVAPORATIVE CONDISER 17 อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(292, 'MT-AS-0292', 7, 51, NULL, NULL, 'EVAPORATOR ( คอล์ยคลังแห้ง 1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(293, 'MT-AS-0293', 7, 51, NULL, NULL, 'EVAPORATOR ( คอล์ยคลังแห้ง 2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(294, 'MT-AS-0294', 7, 51, NULL, NULL, 'EVAPORATOR ( คอล์ยคลังแห้ง 3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(295, 'MT-AS-0295', 7, 51, NULL, NULL, 'EVAPORATOR ( คอล์ยคลังแห้ง 4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(296, 'MT-AS-0296', 7, 51, NULL, NULL, 'EVAPORATOR ( คอล์ยห้อง SMALL COLD ROOM )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(297, 'MT-AS-0297', 7, 51, NULL, NULL, 'EVAPORATOR (PASSAGEWAYอ.4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(298, 'MT-AS-0298', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ANTE ASRS 1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(299, 'MT-AS-0299', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ANTE ASRS 2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(300, 'MT-AS-0300', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย LOADING AREA 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(301, 'MT-AS-0301', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย LOADING AREA 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(302, 'MT-AS-0302', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย LOADING AREA 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(303, 'MT-AS-0303', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย LOADING AREA 1_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(304, 'MT-AS-0304', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(305, 'MT-AS-0305', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(306, 'MT-AS-0306', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(307, 'MT-AS-0307', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 1_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(308, 'MT-AS-0308', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 2_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(309, 'MT-AS-0309', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ASRS 2_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(310, 'MT-AS-0310', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง CHILL )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(311, 'MT-AS-0311', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ส่วนผลิต 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(312, 'MT-AS-0312', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ส่วนผลิต 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(313, 'MT-AS-0313', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ส่วนผลิต 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(314, 'MT-AS-0314', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ส่วนผลิต 1_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(315, 'MT-AS-0315', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง ส่วนผลิต 1_5)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(316, 'MT-AS-0316', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง โมบาย 1_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(317, 'MT-AS-0317', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ย ห้อง โมบาย 1_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(318, 'MT-AS-0318', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยAIR LOCKอ.3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(319, 'MT-AS-0319', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยAIRLOCK 4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(320, 'MT-AS-0320', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยAIRLOCK 6 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(321, 'MT-AS-0321', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยAIRLOCK อ.2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(322, 'MT-AS-0322', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTE LOADING 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(323, 'MT-AS-0323', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTE LOADING 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(324, 'MT-AS-0324', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTE LOADING 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(325, 'MT-AS-0325', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTE LOADING 1_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(326, 'MT-AS-0326', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTE ROOMอ.4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(327, 'MT-AS-0327', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 1_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(328, 'MT-AS-0328', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 1_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(329, 'MT-AS-0329', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 1_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(330, 'MT-AS-0330', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 1_4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(331, 'MT-AS-0331', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 2_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(332, 'MT-AS-0332', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 2_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(333, 'MT-AS-0333', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 3_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(334, 'MT-AS-0334', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 3_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(335, 'MT-AS-0335', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 3_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(336, 'MT-AS-0336', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 4_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(337, 'MT-AS-0337', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 4_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(338, 'MT-AS-0338', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 6_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(339, 'MT-AS-0339', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 6_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(340, 'MT-AS-0340', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM 6_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(341, 'MT-AS-0341', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยANTEROOM อ.7)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(342, 'MT-AS-0342', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยPASSAGEWAY 6 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(343, 'MT-AS-0343', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยรับวัตถุดิบฟรีสอ.4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(344, 'MT-AS-0344', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานรับวัตถุดิบ อ.1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(345, 'MT-AS-0345', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 2 อ. 4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(346, 'MT-AS-0346', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 2_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(347, 'MT-AS-0347', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 2_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(348, 'MT-AS-0348', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 4_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(349, 'MT-AS-0349', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 4_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(350, 'MT-AS-0350', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 5 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(351, 'MT-AS-0351', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 6_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(352, 'MT-AS-0352', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 6_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(353, 'MT-AS-0353', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 6_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(354, 'MT-AS-0354', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด 6_4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(355, 'MT-AS-0355', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลด อ.1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(356, 'MT-AS-0356', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลดอ.2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(357, 'MT-AS-0357', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลดอ.7 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(358, 'MT-AS-0358', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลดอ.7 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(359, 'MT-AS-0359', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลดอ.7 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(360, 'MT-AS-0360', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยลานโหลดเล็ก 6 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(361, 'MT-AS-0361', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้อง CHILLอ.1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(362, 'MT-AS-0362', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้อง P4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(363, 'MT-AS-0363', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องChill 30_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(364, 'MT-AS-0364', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องChill 30_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(365, 'MT-AS-0365', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องP3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(366, 'MT-AS-0366', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 1_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(367, 'MT-AS-0367', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 1_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(368, 'MT-AS-0368', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 2_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(369, 'MT-AS-0369', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 2_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(370, 'MT-AS-0370', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 3_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(371, 'MT-AS-0371', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 3_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(372, 'MT-AS-0372', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 4_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(373, 'MT-AS-0373', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 4_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(374, 'MT-AS-0374', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 5_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(375, 'MT-AS-0375', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 5_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(376, 'MT-AS-0376', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 6_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(377, 'MT-AS-0377', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 7_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(378, 'MT-AS-0378', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 7_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(379, 'MT-AS-0379', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 8_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(380, 'MT-AS-0380', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องฟรีส 8_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(381, 'MT-AS-0381', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องอบปลา 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(382, 'MT-AS-0382', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องอบปลา 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(383, 'MT-AS-0383', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 1_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(384, 'MT-AS-0384', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 1_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(385, 'MT-AS-0385', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 10_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(386, 'MT-AS-0386', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 10_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(387, 'MT-AS-0387', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 10_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(388, 'MT-AS-0388', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 11_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(389, 'MT-AS-0389', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 11_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(390, 'MT-AS-0390', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 12_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(391, 'MT-AS-0391', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 12_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(392, 'MT-AS-0392', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 13_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(393, 'MT-AS-0393', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 13_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(394, 'MT-AS-0394', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 14_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(395, 'MT-AS-0395', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 14_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(396, 'MT-AS-0396', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 14_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(397, 'MT-AS-0397', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 15_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(398, 'MT-AS-0398', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 15_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(399, 'MT-AS-0399', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 16_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(400, 'MT-AS-0400', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 16_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(401, 'MT-AS-0401', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 17_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(402, 'MT-AS-0402', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 17_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(403, 'MT-AS-0403', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 18_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(404, 'MT-AS-0404', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 18_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(405, 'MT-AS-0405', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 19_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(406, 'MT-AS-0406', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 19_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(407, 'MT-AS-0407', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 2_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(408, 'MT-AS-0408', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 2_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(409, 'MT-AS-0409', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 2_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(410, 'MT-AS-0410', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 20_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(411, 'MT-AS-0411', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 20_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(412, 'MT-AS-0412', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 21_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(413, 'MT-AS-0413', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 21_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(414, 'MT-AS-0414', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 22_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(415, 'MT-AS-0415', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 22_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(416, 'MT-AS-0416', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 23_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(417, 'MT-AS-0417', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 23_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(418, 'MT-AS-0418', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 24_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(419, 'MT-AS-0419', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 24_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(420, 'MT-AS-0420', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 25_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(421, 'MT-AS-0421', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 25_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(422, 'MT-AS-0422', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 28_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(423, 'MT-AS-0423', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 29_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(424, 'MT-AS-0424', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 29_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(425, 'MT-AS-0425', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 29_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(426, 'MT-AS-0426', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 29_4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(427, 'MT-AS-0427', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 3_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(428, 'MT-AS-0428', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 3_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(429, 'MT-AS-0429', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 3_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(430, 'MT-AS-0430', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 4_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(431, 'MT-AS-0431', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 4_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(432, 'MT-AS-0432', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 4_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(433, 'MT-AS-0433', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 5_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(434, 'MT-AS-0434', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 5_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(435, 'MT-AS-0435', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 6_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(436, 'MT-AS-0436', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 6_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(437, 'MT-AS-0437', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 7_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(438, 'MT-AS-0438', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 7_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(439, 'MT-AS-0439', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 7_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(440, 'MT-AS-0440', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 8_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(441, 'MT-AS-0441', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 8_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(442, 'MT-AS-0442', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 8_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(443, 'MT-AS-0443', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 8_4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(444, 'MT-AS-0444', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 9_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(445, 'MT-AS-0445', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 9_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(446, 'MT-AS-0446', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องเก็บ 9_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(447, 'MT-AS-0447', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องแพ็ค 1 อาคาร1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(448, 'MT-AS-0448', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องแพ็ค 2 อาคาร1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1);
INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES
(449, 'MT-AS-0449', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องแพ็คอ.4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(450, 'MT-AS-0450', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(451, 'MT-AS-0451', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(452, 'MT-AS-0452', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(453, 'MT-AS-0453', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(454, 'MT-AS-0454', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_5)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(455, 'MT-AS-0455', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 1_6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(456, 'MT-AS-0456', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(457, 'MT-AS-0457', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_10)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(458, 'MT-AS-0458', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(459, 'MT-AS-0459', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(460, 'MT-AS-0460', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(461, 'MT-AS-0461', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_5)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(462, 'MT-AS-0462', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(463, 'MT-AS-0463', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_7)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(464, 'MT-AS-0464', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(465, 'MT-AS-0465', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 2_9)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(466, 'MT-AS-0466', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 3_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(467, 'MT-AS-0467', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 3_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(468, 'MT-AS-0468', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 3_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(469, 'MT-AS-0469', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 3_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(470, 'MT-AS-0470', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 4_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(471, 'MT-AS-0471', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 4_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(472, 'MT-AS-0472', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 4_3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(473, 'MT-AS-0473', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 4_4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(474, 'MT-AS-0474', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 5_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(475, 'MT-AS-0475', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 5_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(476, 'MT-AS-0476', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_1 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(477, 'MT-AS-0477', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(478, 'MT-AS-0478', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_3 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(479, 'MT-AS-0479', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_4 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(480, 'MT-AS-0480', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_5 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(481, 'MT-AS-0481', 7, 51, NULL, NULL, 'EVAPORATOR (คอล์ยห้องโมบาย 6_6 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(482, 'MT-AS-0482', 7, 51, NULL, NULL, 'EVAPORATOR 1 ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(483, 'MT-AS-0483', 7, 51, NULL, NULL, 'EVAPORATOR 10 ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(484, 'MT-AS-0484', 7, 51, NULL, NULL, 'EVAPORATOR 11 ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(485, 'MT-AS-0485', 7, 51, NULL, NULL, 'EVAPORATOR 12 ROOM 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(486, 'MT-AS-0486', 7, 51, NULL, NULL, 'EVAPORATOR 13 ROOM 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(487, 'MT-AS-0487', 7, 51, NULL, NULL, 'EVAPORATOR 14 ROOM 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(488, 'MT-AS-0488', 7, 51, NULL, NULL, 'EVAPORATOR 15 ROOM 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(489, 'MT-AS-0489', 7, 51, NULL, NULL, 'EVAPORATOR 16 ROOM 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(490, 'MT-AS-0490', 7, 51, NULL, NULL, 'EVAPORATOR 2 ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(491, 'MT-AS-0491', 7, 51, NULL, NULL, 'EVAPORATOR 20 ANTEROOMROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(492, 'MT-AS-0492', 7, 51, NULL, NULL, 'EVAPORATOR 21 ANTEROOMROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(493, 'MT-AS-0493', 7, 51, NULL, NULL, 'EVAPORATOR 22 LOADING 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(494, 'MT-AS-0494', 7, 51, NULL, NULL, 'EVAPORATOR 23 LOADING 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(495, 'MT-AS-0495', 7, 51, NULL, NULL, 'EVAPORATOR 25 CHILL ROOM', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(496, 'MT-AS-0496', 7, 51, NULL, NULL, 'EVAPORATOR 25 PACKING ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(497, 'MT-AS-0497', 7, 51, NULL, NULL, 'EVAPORATOR 26 FREEZE 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(498, 'MT-AS-0498', 7, 51, NULL, NULL, 'EVAPORATOR 27 FREEZE 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(499, 'MT-AS-0499', 7, 51, NULL, NULL, 'EVAPORATOR 27 FREEZE 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(500, 'MT-AS-0500', 7, 51, NULL, NULL, 'EVAPORATOR 28 FREEZE 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(501, 'MT-AS-0501', 7, 51, NULL, NULL, 'EVAPORATOR 29 FREEZE 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(502, 'MT-AS-0502', 7, 51, NULL, NULL, 'EVAPORATOR 29 FREEZE 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(503, 'MT-AS-0503', 7, 51, NULL, NULL, 'EVAPORATOR 3 ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(504, 'MT-AS-0504', 7, 51, NULL, NULL, 'EVAPORATOR 30 FREEZE 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(505, 'MT-AS-0505', 7, 51, NULL, NULL, 'EVAPORATOR 31 FREEZE 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(506, 'MT-AS-0506', 7, 51, NULL, NULL, 'EVAPORATOR 31 FREEZE 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(507, 'MT-AS-0507', 7, 51, NULL, NULL, 'EVAPORATOR 33 FREEZE 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(508, 'MT-AS-0508', 7, 51, NULL, NULL, 'EVAPORATOR 35 FREEZE 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(509, 'MT-AS-0509', 7, 51, NULL, NULL, 'EVAPORATOR 37 FREEZE 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(510, 'MT-AS-0510', 7, 51, NULL, NULL, 'Evaporator 38 Room BR08', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(511, 'MT-AS-0511', 7, 51, NULL, NULL, 'Evaporator 39 Room BR09', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(512, 'MT-AS-0512', 7, 51, NULL, NULL, 'EVAPORATOR 4 ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(513, 'MT-AS-0513', 7, 51, NULL, NULL, 'Evaporator 40 Room BR09', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(514, 'MT-AS-0514', 7, 51, NULL, NULL, 'Evaporator 41 Room BR09', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(515, 'MT-AS-0515', 7, 51, NULL, NULL, 'Evaporator 42 Room BR10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(516, 'MT-AS-0516', 7, 51, NULL, NULL, 'Evaporator 43 Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(517, 'MT-AS-0517', 7, 51, NULL, NULL, 'Evaporator 44 Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(518, 'MT-AS-0518', 7, 51, NULL, NULL, 'Evaporator 45 Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(519, 'MT-AS-0519', 7, 51, NULL, NULL, 'Evaporator 46 Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(520, 'MT-AS-0520', 7, 51, NULL, NULL, 'Evaporator 47 Room BR11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(521, 'MT-AS-0521', 7, 51, NULL, NULL, 'Evaporator 48 Anteroom 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(522, 'MT-AS-0522', 7, 51, NULL, NULL, 'Evaporator 49 Loading 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(523, 'MT-AS-0523', 7, 51, NULL, NULL, 'EVAPORATOR 5 ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(524, 'MT-AS-0524', 7, 51, NULL, NULL, 'Evaporator 50 Loading 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(525, 'MT-AS-0525', 7, 51, NULL, NULL, 'Evaporator 51 BR12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(526, 'MT-AS-0526', 7, 51, NULL, NULL, 'EVAPORATOR 6 ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(527, 'MT-AS-0527', 7, 51, NULL, NULL, 'EVAPORATOR 7 ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(528, 'MT-AS-0528', 7, 51, NULL, NULL, 'EVAPORATOR 8 ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(529, 'MT-AS-0529', 7, 51, NULL, NULL, 'EVAPORATOR 9 ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(530, 'MT-AS-0530', 7, 51, NULL, NULL, 'EVAPORATOR(คอล์ยบริเวณที่พักปลา1_1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(531, 'MT-AS-0531', 7, 51, NULL, NULL, 'EVAPORATOR(คอล์ยบริเวณที่พักปลา1_2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(532, 'MT-AS-0532', 7, 41, NULL, NULL, 'FIRE PUMP', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(533, 'MT-AS-0533', 7, 41, NULL, NULL, 'FIREFIGHTING MOTOR PUMP ระบบมอเตอร์ไฟฟ้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(534, 'MT-AS-0534', 7, 41, NULL, NULL, 'FIREFIGHTING PUMP(ปั้มดับเพลิงอาคาร1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(535, 'MT-AS-0535', 7, 41, NULL, NULL, 'FIREFIGHTING PUMP(ปั้มดับเพลิงอาคาร2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(536, 'MT-AS-0536', 7, 41, NULL, NULL, 'FIREFIGHTING PUMP(ปั้มดับเพลิงอาคาร8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(537, 'MT-AS-0537', 7, 40, NULL, NULL, 'FORK LIFFT 60-8FD 25', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(538, 'MT-AS-0538', 7, 40, NULL, NULL, 'FORK LIFT 6FB 1.5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(539, 'MT-AS-0539', 7, 30, NULL, NULL, 'Forklif Reach truck(CQD16)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(540, 'MT-AS-0540', 7, 29, NULL, NULL, 'Forklift Counter Balancn(mtr63214)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(541, 'MT-AS-0541', 7, 152, NULL, NULL, 'Forklift Reach Truch (MTR65009)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(542, 'MT-AS-0542', 7, 152, NULL, NULL, 'Forklift Reach Truck (MTR65010)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(543, 'MT-AS-0543', 7, 30, NULL, NULL, 'Forklift Reach truck(CQD16)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(544, 'MT-AS-0544', 7, 30, NULL, NULL, 'Forklift Reach truck(CQD20)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(545, 'MT-AS-0545', 7, 152, NULL, NULL, 'Forklift Reach Truck(mtr65011)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(546, 'MT-AS-0546', 7, 152, NULL, NULL, 'Forklift Reach Truck(mtr65012)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(547, 'MT-AS-0547', 7, 30, NULL, NULL, 'Forklift Reach Truck(mtr65013)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(548, 'MT-AS-0548', 7, 4, NULL, NULL, 'FREEZE ROOM 01 (ห้องฟรีส 01)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(549, 'MT-AS-0549', 7, 4, NULL, NULL, 'FREEZE ROOM 02 (ห้องฟรีส 02)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(550, 'MT-AS-0550', 7, 4, NULL, NULL, 'FREEZE ROOM 03 (ห้องฟรีส 03)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(551, 'MT-AS-0551', 7, 4, NULL, NULL, 'FREEZE ROOM 04 (ห้องฟรีส 04)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(552, 'MT-AS-0552', 7, 4, NULL, NULL, 'FREEZE ROOM 05 (ห้องฟรีส 05)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(553, 'MT-AS-0553', 7, 4, NULL, NULL, 'FREEZE ROOM 06 (ห้องฟรีส 06)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(554, 'MT-AS-0554', 7, 4, NULL, NULL, 'FREEZE ROOM 07 (ห้องฟรีส 07)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(555, 'MT-AS-0555', 7, 4, NULL, NULL, 'FREEZE ROOM 08 (ห้องฟรีส 08)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(556, 'MT-AS-0556', 7, 6, NULL, NULL, 'GAS DETECTOR (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(557, 'MT-AS-0557', 7, 6, NULL, NULL, 'GAS DETECTOR (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(558, 'MT-AS-0558', 7, 6, NULL, NULL, 'GAS DETECTOR (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(559, 'MT-AS-0559', 7, 6, NULL, NULL, 'GAS DETECTOR (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(560, 'MT-AS-0560', 7, 6, NULL, NULL, 'GAS DETECTOR (อาคาร 8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(561, 'MT-AS-0561', 7, 34, NULL, NULL, 'GENERATOR', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(562, 'MT-AS-0562', 7, 34, NULL, NULL, 'GENERATOR CATERPILLAR อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(563, 'MT-AS-0563', 7, 34, NULL, NULL, 'GENERATOR CATERPILLAR อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(564, 'MT-AS-0564', 7, 34, NULL, NULL, 'GENERATOR CUMMINS อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(565, 'MT-AS-0565', 7, 34, NULL, NULL, 'GENERATOR DEUTZ อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(566, 'MT-AS-0566', 7, 34, NULL, NULL, 'GENERATOR อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(567, 'MT-AS-0567', 7, 36, NULL, NULL, 'GREASSOR COMPRESSOR 132 KW. อ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(568, 'MT-AS-0568', 7, 31, NULL, NULL, 'HAND PALLET', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(569, 'MT-AS-0569', 7, 31, NULL, NULL, 'HAND PALLET 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(570, 'MT-AS-0570', 7, 31, NULL, NULL, 'HAND PALLET 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(571, 'MT-AS-0571', 7, 31, NULL, NULL, 'HAND PALLET 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(572, 'MT-AS-0572', 7, 31, NULL, NULL, 'HAND PALLET 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(573, 'MT-AS-0573', 7, 31, NULL, NULL, 'HAND PALLET 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(574, 'MT-AS-0574', 7, 50, NULL, NULL, 'Hipressure Pump', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(575, 'MT-AS-0575', 7, 25, NULL, NULL, 'HOT WATER PUMP', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(576, 'MT-AS-0576', 7, 64, NULL, NULL, 'Hydraulic Dock Leveler อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(577, 'MT-AS-0577', 7, 64, NULL, NULL, 'Hydraulic Dock Leveler อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(578, 'MT-AS-0578', 7, 77, NULL, NULL, 'Infrared Thermometer', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(579, 'MT-AS-0579', 7, 12, NULL, NULL, 'INTER COOLER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(580, 'MT-AS-0580', 7, 10, NULL, NULL, 'INTER VESSEL COLD ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(581, 'MT-AS-0581', 7, 126, NULL, NULL, 'INVERTER No.1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(582, 'MT-AS-0582', 7, 126, NULL, NULL, 'INVERTER No.10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(583, 'MT-AS-0583', 7, 126, NULL, NULL, 'INVERTER No.11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(584, 'MT-AS-0584', 7, 126, NULL, NULL, 'INVERTER No.12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(585, 'MT-AS-0585', 7, 126, NULL, NULL, 'INVERTER No.13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(586, 'MT-AS-0586', 7, 126, NULL, NULL, 'INVERTER No.14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(587, 'MT-AS-0587', 7, 126, NULL, NULL, 'INVERTER No.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(588, 'MT-AS-0588', 7, 126, NULL, NULL, 'INVERTER No.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(589, 'MT-AS-0589', 7, 126, NULL, NULL, 'INVERTER No.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(590, 'MT-AS-0590', 7, 126, NULL, NULL, 'INVERTER No.5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(591, 'MT-AS-0591', 7, 126, NULL, NULL, 'INVERTER No.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(592, 'MT-AS-0592', 7, 126, NULL, NULL, 'INVERTER No.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(593, 'MT-AS-0593', 7, 126, NULL, NULL, 'INVERTER No.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(594, 'MT-AS-0594', 7, 126, NULL, NULL, 'INVERTER No.9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(595, 'MT-AS-0595', 7, 57, NULL, NULL, 'INVERTER อ.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(596, 'MT-AS-0596', 7, 57, NULL, NULL, 'INVERTER อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(597, 'MT-AS-0597', 7, 57, NULL, NULL, 'INVERTER อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(598, 'MT-AS-0598', 7, 57, NULL, NULL, 'INVERTER อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(599, 'MT-AS-0599', 7, 30, NULL, NULL, 'JAC ELECTRIC TRUCK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(600, 'MT-AS-0600', 7, 30, NULL, NULL, 'JAC FORKLIFT', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(601, 'MT-AS-0601', 7, 40, NULL, NULL, 'JAC FORKLIFT', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(602, 'MT-AS-0602', 7, 72, NULL, NULL, 'JPK.AS.63.A.01(Autoscrubberเครื่องขัดพื้น)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(603, 'MT-AS-0603', 7, 72, NULL, NULL, 'JPK.AS.64.A.02(Autoscrubberเครื่องขัดพื้น)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(604, 'MT-AS-0604', 7, 72, NULL, NULL, 'JPK.AS.64.A.03(Autoscrubberเครื่องขัดพื้น)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(605, 'MT-AS-0605', 7, 154, NULL, NULL, 'JPK.SC.M.62.A.01ห้องโซล่าเชลล์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(606, 'MT-AS-0606', 7, 148, NULL, NULL, 'Lift Load 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(607, 'MT-AS-0607', 7, 148, NULL, NULL, 'Lift02', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(608, 'MT-AS-0608', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(609, 'MT-AS-0609', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(610, 'MT-AS-0610', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(611, 'MT-AS-0611', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(612, 'MT-AS-0612', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(613, 'MT-AS-0613', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(614, 'MT-AS-0614', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(615, 'MT-AS-0615', 7, 26, NULL, NULL, 'LIGHT ENTR INSECT 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(616, 'MT-AS-0616', 7, 47, NULL, NULL, 'Load Center  LC1 Genzone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(617, 'MT-AS-0617', 7, 47, NULL, NULL, 'Load Center  LC1 อาคาร 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(618, 'MT-AS-0618', 7, 47, NULL, NULL, 'Load Center  LC2 Genzone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(619, 'MT-AS-0619', 7, 47, NULL, NULL, 'Load Center  LC2 อาคาร 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(620, 'MT-AS-0620', 7, 47, NULL, NULL, 'Load Center  LC3 Freezone', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(621, 'MT-AS-0621', 7, 47, NULL, NULL, 'Load Center  LC3 อาคาร 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(622, 'MT-AS-0622', 7, 47, NULL, NULL, 'Load Center  LC4 Production', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(623, 'MT-AS-0623', 7, 4, NULL, NULL, 'LOADING (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(624, 'MT-AS-0624', 7, 4, NULL, NULL, 'LOADING (อาคาร 2)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(625, 'MT-AS-0625', 7, 4, NULL, NULL, 'LOADING 01', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(626, 'MT-AS-0626', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 3)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(627, 'MT-AS-0627', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 4) คอล์ย 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(628, 'MT-AS-0628', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 4) คอล์ย 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(629, 'MT-AS-0629', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 5)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(630, 'MT-AS-0630', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(631, 'MT-AS-0631', 7, 4, NULL, NULL, 'LOADING 01 (อาคาร 7)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(632, 'MT-AS-0632', 7, 4, NULL, NULL, 'LOADING 02', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(633, 'MT-AS-0633', 7, 4, NULL, NULL, 'LOADING 02 (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(634, 'MT-AS-0634', 7, 4, NULL, NULL, 'LOADING 02 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(635, 'MT-AS-0635', 7, 4, NULL, NULL, 'LOADING 02 (อาคาร 6)โหลดเล็ก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(636, 'MT-AS-0636', 7, 4, NULL, NULL, 'LOADING 02 (อาคาร 7)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(637, 'MT-AS-0637', 7, 4, NULL, NULL, 'LOADING 03 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(638, 'MT-AS-0638', 7, 4, NULL, NULL, 'LOADING 04 (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(639, 'MT-AS-0639', 7, 4, NULL, NULL, 'Loading 1 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(640, 'MT-AS-0640', 7, 4, NULL, NULL, 'Loading 1 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(641, 'MT-AS-0641', 7, 4, NULL, NULL, 'Loading 1 อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(642, 'MT-AS-0642', 7, 4, NULL, NULL, 'Loading 2 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(643, 'MT-AS-0643', 7, 4, NULL, NULL, 'Loading 2 คอยล์ 1 อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(644, 'MT-AS-0644', 7, 4, NULL, NULL, 'Loading 2 คอยล์ 1 อาคาร B3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(645, 'MT-AS-0645', 7, 4, NULL, NULL, 'Loading 2 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(646, 'MT-AS-0646', 7, 79, NULL, NULL, 'Loading 2 อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(647, 'MT-AS-0647', 7, 4, NULL, NULL, 'Loading 3 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(648, 'MT-AS-0648', 7, 4, NULL, NULL, 'Loading 3 อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(649, 'MT-AS-0649', 7, 79, NULL, NULL, 'Loading 3 อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(650, 'MT-AS-0650', 7, 4, NULL, NULL, 'Loading 4 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(651, 'MT-AS-0651', 7, 97, NULL, NULL, 'Loading Aera', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(652, 'MT-AS-0652', 7, 4, NULL, NULL, 'LOADING AREA (อ.8) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(653, 'MT-AS-0653', 7, 4, NULL, NULL, 'LOADING AREA (อ.8) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(654, 'MT-AS-0654', 7, 4, NULL, NULL, 'LOADING AREA (อ.8) คอยค์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(655, 'MT-AS-0655', 7, 4, NULL, NULL, 'LOADING AREA (อ.8) คอยค์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(656, 'MT-AS-0656', 7, 18, NULL, NULL, 'LOADING ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(657, 'MT-AS-0657', 7, 18, NULL, NULL, 'LOADING ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(658, 'MT-AS-0658', 7, 7, NULL, NULL, 'LUX METER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(659, 'MT-AS-0659', 7, 8, NULL, NULL, 'Machine Balance max cap 60 kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(660, 'MT-AS-0660', 7, 47, NULL, NULL, 'Main MDB 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(661, 'MT-AS-0661', 7, 47, NULL, NULL, 'Main MDB 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(662, 'MT-AS-0662', 7, 95, NULL, NULL, 'Mobile Rack', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(663, 'MT-AS-0663', 7, 19, NULL, NULL, 'MOBILE RACK 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(664, 'MT-AS-0664', 7, 19, NULL, NULL, 'MOBILE RACK 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(665, 'MT-AS-0665', 7, 19, NULL, NULL, 'MOBILE RACK 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(666, 'MT-AS-0666', 7, 19, NULL, NULL, 'MOBILE RACK A', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(667, 'MT-AS-0667', 7, 19, NULL, NULL, 'MOBILE RACK B', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(668, 'MT-AS-0668', 7, 19, NULL, NULL, 'MOBILE RACK C', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(669, 'MT-AS-0669', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 01 อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(670, 'MT-AS-0670', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 01(อาคาร8)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(671, 'MT-AS-0671', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 02 อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(672, 'MT-AS-0672', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 03 อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(673, 'MT-AS-0673', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 04 อ.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(674, 'MT-AS-0674', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 05 อ.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(675, 'MT-AS-0675', 7, 19, NULL, NULL, 'MOBILE RACKING ROOM 06 อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(676, 'MT-AS-0676', 7, 19, NULL, NULL, 'MOBILL RACK SYSTEM A', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(677, 'MT-AS-0677', 7, 19, NULL, NULL, 'MOBILL RACK SYSTEM B', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(678, 'MT-AS-0678', 7, 19, NULL, NULL, 'MOBILL RACK SYSTEM C', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(679, 'MT-AS-0679', 7, 19, NULL, NULL, 'MOBILL RACK SYSTEM E', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(680, 'MT-AS-0680', 7, 73, NULL, NULL, 'Moisture Reducing Machine', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(681, 'MT-AS-0681', 7, 5, NULL, NULL, 'NH3 DETECTOR No.1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(682, 'MT-AS-0682', 7, 5, NULL, NULL, 'NH3 DETECTOR No.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(683, 'MT-AS-0683', 7, 5, NULL, NULL, 'NH3 DETECTOR No.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(684, 'MT-AS-0684', 7, 5, NULL, NULL, 'NH3 DETECTOR No.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(685, 'MT-AS-0685', 7, 4, NULL, NULL, 'PACKING ROOM', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(686, 'MT-AS-0686', 7, 18, NULL, NULL, 'PACKING ROOM 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(687, 'MT-AS-0687', 7, 4, NULL, NULL, 'Packing Room 1 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(688, 'MT-AS-0688', 7, 4, NULL, NULL, 'Packing Room 1 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(689, 'MT-AS-0689', 7, 5, NULL, NULL, 'PACKING ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(690, 'MT-AS-0690', 7, 18, NULL, NULL, 'PACKING ROOM 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(691, 'MT-AS-0691', 7, 4, NULL, NULL, 'Packing Room 2 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(692, 'MT-AS-0692', 7, 4, NULL, NULL, 'Packing Room 2 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(693, 'MT-AS-0693', 7, 18, NULL, NULL, 'PACKING ROOM 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(694, 'MT-AS-0694', 7, 4, NULL, NULL, 'Packing Room 3 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(695, 'MT-AS-0695', 7, 4, NULL, NULL, 'Packing Room 3 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(696, 'MT-AS-0696', 7, 18, NULL, NULL, 'PACKING ROOM 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(697, 'MT-AS-0697', 7, 4, NULL, NULL, 'Packing Room 4 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(698, 'MT-AS-0698', 7, 4, NULL, NULL, 'Packing Room 4 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(699, 'MT-AS-0699', 7, 18, NULL, NULL, 'PACKING ROOM 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(700, 'MT-AS-0700', 7, 4, NULL, NULL, 'PASSAGEWAY (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(701, 'MT-AS-0701', 7, 4, NULL, NULL, 'PASSAGEWAY (อาคาร 6)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(702, 'MT-AS-0702', 7, 20, NULL, NULL, 'PE งาสั้น', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(703, 'MT-AS-0703', 7, 20, NULL, NULL, 'PE.M.65.A.01(08025JP5908)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(704, 'MT-AS-0704', 7, 20, NULL, NULL, 'PE.M.65.A.02(080225JP5910)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(705, 'MT-AS-0705', 7, 20, NULL, NULL, 'POWE PWLLET', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(706, 'MT-AS-0706', 7, 20, NULL, NULL, 'POWER HAND PALED TRUCK อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(707, 'MT-AS-0707', 7, 20, NULL, NULL, 'POWER PALATE PE', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(708, 'MT-AS-0708', 7, 20, NULL, NULL, 'POWER PALETE PE', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(709, 'MT-AS-0709', 7, 35, NULL, NULL, 'POWER PALLATE 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(710, 'MT-AS-0710', 7, 20, NULL, NULL, 'POWER PALLATE 14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(711, 'MT-AS-0711', 7, 20, NULL, NULL, 'POWER PALLET', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(712, 'MT-AS-0712', 7, 20, NULL, NULL, 'Power Pallet(180890383)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(713, 'MT-AS-0713', 7, 20, NULL, NULL, 'Power Pallet(180890839)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(714, 'MT-AS-0714', 7, 20, NULL, NULL, 'power Pallet(hangcha)I9BA06652', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(715, 'MT-AS-0715', 7, 20, NULL, NULL, 'Power Pallet(I9BA06653)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(716, 'MT-AS-0716', 7, 20, NULL, NULL, 'Power Pallet(I9BA06654)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(717, 'MT-AS-0717', 7, 20, NULL, NULL, 'Powerpallet wp46-25', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(718, 'MT-AS-0718', 7, 37, NULL, NULL, 'PREPARATION 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(719, 'MT-AS-0719', 7, 37, NULL, NULL, 'PREPARATION 2_1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(720, 'MT-AS-0720', 7, 37, NULL, NULL, 'PREPARATION 2_2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(721, 'MT-AS-0721', 7, 37, NULL, NULL, 'PREPARATION 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(722, 'MT-AS-0722', 7, 153, NULL, NULL, 'PS.M.65.A.01(08012JP0100)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(723, 'MT-AS-0723', 7, 153, NULL, NULL, 'PS.M.65.A.02(08015JP0101)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(724, 'MT-AS-0724', 7, 105, NULL, NULL, 'Rack', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(725, 'MT-AS-0725', 7, 4, NULL, NULL, 'Rawmate รับสดฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(726, 'MT-AS-0726', 7, 17, NULL, NULL, 'RAWMATERIAL', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(727, 'MT-AS-0727', 7, 30, NULL, NULL, 'Reach Truck', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(728, 'MT-AS-0728', 7, 13, NULL, NULL, 'RECIEVER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(729, 'MT-AS-0729', 7, 36, NULL, NULL, 'RECIPROCATING COMPRESSOR 90 KW', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(730, 'MT-AS-0730', 7, 36, NULL, NULL, 'RECIPROCATING COMPRESSOR 90 KW อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(731, 'MT-AS-0731', 7, 36, NULL, NULL, 'RECIPROCATING COMPRESSOR N4WBHE', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(732, 'MT-AS-0732', 7, 23, NULL, NULL, 'RESIN TANK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(733, 'MT-AS-0733', 7, 59, NULL, NULL, 'REVERSE OSMOSIS(RO)โรงกรองน้ำอ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(734, 'MT-AS-0734', 7, 54, NULL, NULL, 'ROLLING MACHINE (เครื่องรีดไก่)อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(735, 'MT-AS-0735', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(736, 'MT-AS-0736', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(737, 'MT-AS-0737', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(738, 'MT-AS-0738', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(739, 'MT-AS-0739', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(740, 'MT-AS-0740', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(741, 'MT-AS-0741', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 15', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(742, 'MT-AS-0742', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 16', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(743, 'MT-AS-0743', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 17', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(744, 'MT-AS-0744', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 18', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(745, 'MT-AS-0745', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 19', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(746, 'MT-AS-0746', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(747, 'MT-AS-0747', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 20', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(748, 'MT-AS-0748', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(749, 'MT-AS-0749', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(750, 'MT-AS-0750', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(751, 'MT-AS-0751', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(752, 'MT-AS-0752', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(753, 'MT-AS-0753', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(754, 'MT-AS-0754', 7, 87, NULL, NULL, 'ROLLING SHUTTER B1 ประตู 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(755, 'MT-AS-0755', 7, 87, NULL, NULL, 'ROLLING SHUTTER B2 ประตู 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(756, 'MT-AS-0756', 7, 87, NULL, NULL, 'ROLLING SHUTTER B2 ประตู 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(757, 'MT-AS-0757', 7, 87, NULL, NULL, 'ROLLING SHUTTER B2 ประตู 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(758, 'MT-AS-0758', 7, 87, NULL, NULL, 'ROLLING SHUTTER B2 ประตู 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(759, 'MT-AS-0759', 7, 58, NULL, NULL, 'SAND TANK 01 อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(760, 'MT-AS-0760', 7, 58, NULL, NULL, 'SAND TANK 02 อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(761, 'MT-AS-0761', 7, 36, NULL, NULL, 'SCREW COMPRESSOR 150 KW. อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(762, 'MT-AS-0762', 7, 36, NULL, NULL, 'SCREW COMPRESSOR 250 KW. อ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(763, 'MT-AS-0763', 7, 36, NULL, NULL, 'SCREW COMPRESSOR 250 KW. อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(764, 'MT-AS-0764', 7, 36, NULL, NULL, 'SCREW COMPRESSOR N200VSD-MX 160KW อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(765, 'MT-AS-0765', 7, 47, NULL, NULL, 'SDB Shop Maintenance', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(766, 'MT-AS-0766', 7, 47, NULL, NULL, 'SDB Solar Cell', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(767, 'MT-AS-0767', 7, 49, NULL, NULL, 'SOFTENER อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(768, 'MT-AS-0768', 7, 49, NULL, NULL, 'SOFTENER อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(769, 'MT-AS-0769', 7, 53, NULL, NULL, 'Spiral', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(770, 'MT-AS-0770', 7, 4, NULL, NULL, 'SPIRAL FREEZE (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(771, 'MT-AS-0771', 7, 53, NULL, NULL, 'SPIRAL FREEZER อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(772, 'MT-AS-0772', 7, 79, NULL, NULL, 'Sytem A', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(773, 'MT-AS-0773', 7, 4, NULL, NULL, 'Sytem A AHU 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(774, 'MT-AS-0774', 7, 4, NULL, NULL, 'Sytem A AHU 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(775, 'MT-AS-0775', 7, 4, NULL, NULL, 'Sytem A AHU 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(776, 'MT-AS-0776', 7, 79, NULL, NULL, 'Sytem B', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(777, 'MT-AS-0777', 7, 4, NULL, NULL, 'Sytem B AHU 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(778, 'MT-AS-0778', 7, 4, NULL, NULL, 'Sytem B AHU 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(779, 'MT-AS-0779', 7, 79, NULL, NULL, 'Sytem C', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(780, 'MT-AS-0780', 7, 4, NULL, NULL, 'Sytem C AHU 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(781, 'MT-AS-0781', 7, 4, NULL, NULL, 'Sytem C AHU 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(782, 'MT-AS-0782', 7, 79, NULL, NULL, 'Sytem E', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(783, 'MT-AS-0783', 7, 4, NULL, NULL, 'Sytem E คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(784, 'MT-AS-0784', 7, 4, NULL, NULL, 'Sytem E คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(785, 'MT-AS-0785', 7, 4, NULL, NULL, 'Sytem E คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(786, 'MT-AS-0786', 7, 4, NULL, NULL, 'Sytem E คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(787, 'MT-AS-0787', 7, 4, NULL, NULL, 'Sytem E คอยล์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(788, 'MT-AS-0788', 7, 4, NULL, NULL, 'Sytem E คอยล์ 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(789, 'MT-AS-0789', 7, 24, NULL, NULL, 'TRANFORMERS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(790, 'MT-AS-0790', 7, 24, NULL, NULL, 'Transformer (หม้อแปลงไฟฟ้า)อ.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(791, 'MT-AS-0791', 7, 24, NULL, NULL, 'Transformer (หม้อแปลงไฟฟ้า)อ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(792, 'MT-AS-0792', 7, 24, NULL, NULL, 'Transformer (หม้อแปลงไฟฟ้า)อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(793, 'MT-AS-0793', 7, 24, NULL, NULL, 'Transformer (หม้อแปลงไฟฟ้า)อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(794, 'MT-AS-0794', 7, 24, NULL, NULL, 'Transformer (หม้อแปลงไฟฟ้า)อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(795, 'MT-AS-0795', 7, 51, NULL, NULL, 'VAPORATOR (คอล์ยห้องเก็บ 28_2 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(796, 'MT-AS-0796', 7, 10, NULL, NULL, 'VESSEL BLAST FREEZER', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(797, 'MT-AS-0797', 7, 68, NULL, NULL, 'VESSEL BLAST FREEZER 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(798, 'MT-AS-0798', 7, 68, NULL, NULL, 'VESSEL BLAST FREEZER 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(799, 'MT-AS-0799', 7, 10, NULL, NULL, 'VESSEL COLDROOM', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(800, 'MT-AS-0800', 7, 11, NULL, NULL, 'VESSEL NH3 PUMP 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(801, 'MT-AS-0801', 7, 27, NULL, NULL, 'VESSEL NH3 PUMP 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(802, 'MT-AS-0802', 7, 11, NULL, NULL, 'VESSEL NH3 PUMP 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(803, 'MT-AS-0803', 7, 27, NULL, NULL, 'VESSEL NH3 PUMP 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(804, 'MT-AS-0804', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(805, 'MT-AS-0805', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(806, 'MT-AS-0806', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(807, 'MT-AS-0807', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(808, 'MT-AS-0808', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(809, 'MT-AS-0809', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(810, 'MT-AS-0810', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(811, 'MT-AS-0811', 7, 11, NULL, NULL, 'VESSEL PUMP NH3 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(812, 'MT-AS-0812', 7, 4, NULL, NULL, 'Walkway system A AHU 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(813, 'MT-AS-0813', 7, 4, NULL, NULL, 'Walkway system A AHU 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(814, 'MT-AS-0814', 7, 33, NULL, NULL, 'WASH MACHINE เครื่องล้างถาด อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(815, 'MT-AS-0815', 7, 60, NULL, NULL, 'WASTE WATER TREATMENT SYSTEM(ระบบบำบัด)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(816, 'MT-AS-0816', 7, 71, NULL, NULL, 'Wastewater Treatment System', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(817, 'MT-AS-0817', 7, 25, NULL, NULL, 'WATER PUMP', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(818, 'MT-AS-0818', 7, 25, NULL, NULL, 'WATER PUMP (ปั้มพญานาค) อ.2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(819, 'MT-AS-0819', 7, 25, NULL, NULL, 'WATER PUMP (ปั้มพญานาค) อ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(820, 'MT-AS-0820', 7, 25, NULL, NULL, 'WATER PUMP (ปั้มพญานาค) อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(821, 'MT-AS-0821', 7, 25, NULL, NULL, 'WATER PUMP 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(822, 'MT-AS-0822', 7, 25, NULL, NULL, 'WATER PUMP 15 Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(823, 'MT-AS-0823', 7, 25, NULL, NULL, 'WATER PUMP 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(824, 'MT-AS-0824', 7, 25, NULL, NULL, 'WATER PUMP 5 Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(825, 'MT-AS-0825', 7, 25, NULL, NULL, 'WATER PUMP 7.5 Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(826, 'MT-AS-0826', 7, 25, NULL, NULL, 'WATER PUMP S.P.A 7.5 Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(827, 'MT-AS-0827', 7, 71, NULL, NULL, 'Water Treatment System', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(828, 'MT-AS-0828', 7, 25, NULL, NULL, 'WATER WELL 20 Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(829, 'MT-AS-0829', 7, 2, NULL, NULL, 'WEIGHT 1 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(830, 'MT-AS-0830', 7, 2, NULL, NULL, 'WEIGHT 10 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(831, 'MT-AS-0831', 7, 2, NULL, NULL, 'WEIGHT 2 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(832, 'MT-AS-0832', 7, 2, NULL, NULL, 'WEIGHT 20 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(833, 'MT-AS-0833', 7, 2, NULL, NULL, 'WEIGHT 5 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(834, 'MT-AS-0834', 7, 2, NULL, NULL, 'WEIGHT 500 Kg. (ลูกตุ้ม)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(835, 'MT-AS-0835', 7, 21, NULL, NULL, 'WORKER CONVERYER 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(836, 'MT-AS-0836', 7, 70, NULL, NULL, 'WORKER CONVERYER 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(837, 'MT-AS-0837', 7, 21, NULL, NULL, 'WORKER CONVERYER 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(838, 'MT-AS-0838', 7, 70, NULL, NULL, 'WORKER CONVERYER 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(839, 'MT-AS-0839', 7, 21, NULL, NULL, 'WORKER CONVERYER 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(840, 'MT-AS-0840', 7, 70, NULL, NULL, 'WORKER CONVERYER 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(841, 'MT-AS-0841', 7, 21, NULL, NULL, 'WORKER CONVERYER 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(842, 'MT-AS-0842', 7, 70, NULL, NULL, 'WORKER CONVERYER 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(843, 'MT-AS-0843', 7, 21, NULL, NULL, 'WORKER CONVERYER 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(844, 'MT-AS-0844', 7, 70, NULL, NULL, 'WORKER CONVERYER 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(845, 'MT-AS-0845', 7, 21, NULL, NULL, 'WORKER CONVERYER 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(846, 'MT-AS-0846', 7, 70, NULL, NULL, 'WORKER CONVERYER 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(847, 'MT-AS-0847', 7, 21, NULL, NULL, 'WORKER CONVERYER 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(848, 'MT-AS-0848', 7, 70, NULL, NULL, 'WORKER CONVERYER 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(849, 'MT-AS-0849', 7, 70, NULL, NULL, 'WORKER CONVERYER 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(850, 'MT-AS-0850', 7, 45, NULL, NULL, 'WORKER CONVEYOR 2Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(851, 'MT-AS-0851', 7, 45, NULL, NULL, 'WORKER CONVEYOR 3Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(852, 'MT-AS-0852', 7, 45, NULL, NULL, 'WORKER CONVEYOR 7.5Hp', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(853, 'MT-AS-0853', 7, 105, NULL, NULL, 'กรงใส่ปลา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(854, 'MT-AS-0854', 7, 100, NULL, NULL, 'กระจก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(855, 'MT-AS-0855', 7, 100, NULL, NULL, 'กระถางต้นไม้', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(856, 'MT-AS-0856', 7, 124, NULL, NULL, 'ก๊อกน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(857, 'MT-AS-0857', 7, 100, NULL, NULL, 'กันชน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(858, 'MT-AS-0858', 7, 100, NULL, NULL, 'ขอบปูน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(859, 'MT-AS-0859', 7, 100, NULL, NULL, 'ขอบผนัง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(860, 'MT-AS-0860', 7, 100, NULL, NULL, 'คลองสาธารณะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(861, 'MT-AS-0861', 7, 88, NULL, NULL, 'คลังแห้ง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(862, 'MT-AS-0862', 7, 4, NULL, NULL, 'คลังแห้ง คอยด์ 1-2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(863, 'MT-AS-0863', 7, 4, NULL, NULL, 'คลังแห้ง คอยด์ 3-4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(864, 'MT-AS-0864', 7, 36, NULL, NULL, 'คอมเพรสเซอร์ลูกสูบ 90 KW. ห้องเครื่องอาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(865, 'MT-AS-0865', 7, 36, NULL, NULL, 'คอมเพรสเซอร์สกรู 185KW.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(866, 'MT-AS-0866', 7, 9, NULL, NULL, 'คอมเพรสเซอร์สกรู 280KW. SPARAL FREEZER อ.1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(867, 'MT-AS-0867', 7, 143, NULL, NULL, 'งานสร้างความปลอดภัย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(868, 'MT-AS-0868', 7, 143, NULL, NULL, 'งานสร้างฝ่ายการตลาด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(869, 'MT-AS-0869', 7, 143, NULL, NULL, 'งานสร้างฝ่ายขนส่ง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(870, 'MT-AS-0870', 7, 143, NULL, NULL, 'งานสร้างฝ่ายคลังสินค้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(871, 'MT-AS-0871', 7, 143, NULL, NULL, 'งานสร้างฝ่ายคุณภาพ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(872, 'MT-AS-0872', 7, 143, NULL, NULL, 'งานสร้างฝ่ายจัดซื้อ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(873, 'MT-AS-0873', 7, 143, NULL, NULL, 'งานสร้างฝ่ายบริการลูกค้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(874, 'MT-AS-0874', 7, 143, NULL, NULL, 'งานสร้างฝ่ายบัญชี', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(875, 'MT-AS-0875', 7, 143, NULL, NULL, 'งานสร้างฝ่ายบุคคล/ธุรการ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(876, 'MT-AS-0876', 7, 143, NULL, NULL, 'งานสร้างฝ่ายวิศวกรรม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(877, 'MT-AS-0877', 7, 143, NULL, NULL, 'งานสร้างฝ่ายอินเวนเทอรี่', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(878, 'MT-AS-0878', 7, 143, NULL, NULL, 'งานสร้างฝ่ายไอที', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(879, 'MT-AS-0879', 7, 147, NULL, NULL, 'งานแจ้งสร้าง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(880, 'MT-AS-0880', 7, 97, NULL, NULL, 'ช่องจอดรับวัตถุดิบ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(881, 'MT-AS-0881', 7, 97, NULL, NULL, 'ช่องโหลด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(882, 'MT-AS-0882', 7, 92, NULL, NULL, 'ช่องโหลด 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(883, 'MT-AS-0883', 7, 92, NULL, NULL, 'ช่องโหลด 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(884, 'MT-AS-0884', 7, 92, NULL, NULL, 'ช่องโหลด 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(885, 'MT-AS-0885', 7, 92, NULL, NULL, 'ช่องโหลด 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(886, 'MT-AS-0886', 7, 92, NULL, NULL, 'ช่องโหลด 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(887, 'MT-AS-0887', 7, 92, NULL, NULL, 'ช่องโหลด 14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(888, 'MT-AS-0888', 7, 92, NULL, NULL, 'ช่องโหลด 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(889, 'MT-AS-0889', 7, 92, NULL, NULL, 'ช่องโหลด 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(890, 'MT-AS-0890', 7, 92, NULL, NULL, 'ช่องโหลด 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(891, 'MT-AS-0891', 7, 92, NULL, NULL, 'ช่องโหลด 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(892, 'MT-AS-0892', 7, 92, NULL, NULL, 'ช่องโหลด 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(893, 'MT-AS-0893', 7, 92, NULL, NULL, 'ช่องโหลด 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(894, 'MT-AS-0894', 7, 92, NULL, NULL, 'ช่องโหลด 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(895, 'MT-AS-0895', 7, 92, NULL, NULL, 'ช่องโหลด 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(896, 'MT-AS-0896', 7, 89, NULL, NULL, 'ช๊อปช่าง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(897, 'MT-AS-0897', 7, 85, NULL, NULL, 'ชักโครก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(898, 'MT-AS-0898', 7, 122, NULL, NULL, 'ชั้นวางของ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(899, 'MT-AS-0899', 7, 80, NULL, NULL, 'ฒฐ-332', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(900, 'MT-AS-0900', 7, 80, NULL, NULL, 'ฒฐ-334', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(901, 'MT-AS-0901', 7, 100, NULL, NULL, 'ต้นไม้', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(902, 'MT-AS-0902', 7, 105, NULL, NULL, 'ตะแกรงรางน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1);
INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES
(903, 'MT-AS-0903', 7, 136, NULL, NULL, 'ตาชั่ง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(904, 'MT-AS-0904', 7, 8, NULL, NULL, 'ตาชั่ง 100 kg', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(905, 'MT-AS-0905', 7, 8, NULL, NULL, 'ตาชั่งรถบรรทุก 80 ตัน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(906, 'MT-AS-0906', 7, 8, NULL, NULL, 'ตาชั่ั่ง 100 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(907, 'MT-AS-0907', 7, 3, NULL, NULL, 'ตาช่าง 60 kg', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(908, 'MT-AS-0908', 7, 113, NULL, NULL, 'ตู้ชาร์จแบตฯ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(909, 'MT-AS-0909', 7, 132, NULL, NULL, 'ตู้ดับเพลิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(910, 'MT-AS-0910', 7, 121, NULL, NULL, 'ตู้ล๊อกเกอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(911, 'MT-AS-0911', 7, 121, NULL, NULL, 'ตู้เก็บของ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(912, 'MT-AS-0912', 7, 134, NULL, NULL, 'ตู้เก็บสายดับเพลิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(913, 'MT-AS-0913', 7, 133, NULL, NULL, 'ตู้เก็บอุปกรณ์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(914, 'MT-AS-0914', 7, 44, NULL, NULL, 'ตู้เย็นออฟฟิศ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(915, 'MT-AS-0915', 7, 44, NULL, NULL, 'ตู้เย็นออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(916, 'MT-AS-0916', 7, 114, NULL, NULL, 'ตู้ไฟ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(917, 'MT-AS-0917', 7, 80, NULL, NULL, 'ถน-8888', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(918, 'MT-AS-0918', 7, 128, NULL, NULL, 'ถังขยะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(919, 'MT-AS-0919', 7, 141, NULL, NULL, 'ถังดับเพลิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(920, 'MT-AS-0920', 7, 128, NULL, NULL, 'ถังน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(921, 'MT-AS-0921', 7, 96, NULL, NULL, 'ถาดฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(922, 'MT-AS-0922', 7, 140, NULL, NULL, 'ถุงบอกทิศทางลม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(923, 'MT-AS-0923', 7, 129, NULL, NULL, 'ท่อน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(924, 'MT-AS-0924', 7, 97, NULL, NULL, 'ทางเข้า-ออก FL', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(925, 'MT-AS-0925', 7, 88, NULL, NULL, 'ทางเข้าลานโหลด 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(926, 'MT-AS-0926', 7, 88, NULL, NULL, 'ทางเข้าลานโหลด 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(927, 'MT-AS-0927', 7, 88, NULL, NULL, 'ทางเข้าลานโหลดฟรีโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(928, 'MT-AS-0928', 7, 88, NULL, NULL, 'ทางเข้าลานโหลดเจนโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(929, 'MT-AS-0929', 7, 139, NULL, NULL, 'ธงชาติ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(930, 'MT-AS-0930', 7, 139, NULL, NULL, 'ธงบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(931, 'MT-AS-0931', 7, 139, NULL, NULL, 'ธงพระมหากษัตริย์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(932, 'MT-AS-0932', 7, 117, NULL, NULL, 'นาฬิกา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(933, 'MT-AS-0933', 7, 4, NULL, NULL, 'บริเวณที่พักปลา คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(934, 'MT-AS-0934', 7, 4, NULL, NULL, 'บริเวณที่พักปลา คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(935, 'MT-AS-0935', 7, 125, NULL, NULL, 'บ่อน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(936, 'MT-AS-0936', 7, 60, NULL, NULL, 'บ่อน้ำเสีย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(937, 'MT-AS-0937', 7, 125, NULL, NULL, 'บ่อปลา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(938, 'MT-AS-0938', 7, 60, NULL, NULL, 'บ่อพักน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(939, 'MT-AS-0939', 7, 142, NULL, NULL, 'บอร์ดประชาสัมพันธ์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(940, 'MT-AS-0940', 7, 144, NULL, NULL, 'บันได', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(941, 'MT-AS-0941', 7, 143, NULL, NULL, 'บ้านพัก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(942, 'MT-AS-0942', 7, 100, NULL, NULL, 'ประตู', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(943, 'MT-AS-0943', 7, 74, NULL, NULL, 'ประตู Speedoor', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(944, 'MT-AS-0944', 7, 103, NULL, NULL, 'ประตูช่องโหลด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(945, 'MT-AS-0945', 7, 74, NULL, NULL, 'ประตูออโต้', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(946, 'MT-AS-0946', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 1 ประตู 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(947, 'MT-AS-0947', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 1 ประตู 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(948, 'MT-AS-0948', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 1 ประตู 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(949, 'MT-AS-0949', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 1 ประตู 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(950, 'MT-AS-0950', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 1 ประตู 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(951, 'MT-AS-0951', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 2 ประตู 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(952, 'MT-AS-0952', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 2 ประตู 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(953, 'MT-AS-0953', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 2 ประตู 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(954, 'MT-AS-0954', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 2 ประตู 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(955, 'MT-AS-0955', 7, 86, NULL, NULL, 'ประตูโอเวอร์เฮดโหลด 2 ประตู 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(956, 'MT-AS-0956', 7, 111, NULL, NULL, 'ปลั๊กพาวเวอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(957, 'MT-AS-0957', 7, 111, NULL, NULL, 'ปลั๊กเสียบ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(958, 'MT-AS-0958', 7, 111, NULL, NULL, 'ปลั๊กแบตเตอรี่', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(959, 'MT-AS-0959', 7, 111, NULL, NULL, 'ปลั๊กไฟ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(960, 'MT-AS-0960', 7, 84, NULL, NULL, 'ป้อม รปภ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(961, 'MT-AS-0961', 7, 84, NULL, NULL, 'ป้อม รปภ.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(962, 'MT-AS-0962', 7, 11, NULL, NULL, 'ปั้มน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(963, 'MT-AS-0963', 7, 11, NULL, NULL, 'ปั้มลม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(964, 'MT-AS-0964', 7, 50, NULL, NULL, 'ปั้มไฮเพรชเชอร์ อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(965, 'MT-AS-0965', 7, 50, NULL, NULL, 'ปั้มไฮเพรชเชอร์ อาคาร2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(966, 'MT-AS-0966', 7, 131, NULL, NULL, 'ป้ายบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(967, 'MT-AS-0967', 7, 142, NULL, NULL, 'ป้ายเตือน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(968, 'MT-AS-0968', 7, 100, NULL, NULL, 'ผนังห้อง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(969, 'MT-AS-0969', 7, 100, NULL, NULL, 'ผ้าใบดำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(970, 'MT-AS-0970', 7, 100, NULL, NULL, 'ผ้าใบบังแดด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(971, 'MT-AS-0971', 7, 100, NULL, NULL, 'ฝ้าผนัง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(972, 'MT-AS-0972', 7, 110, NULL, NULL, 'พัดลม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(973, 'MT-AS-0973', 7, 138, NULL, NULL, 'พาเลท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(974, 'MT-AS-0974', 7, 101, NULL, NULL, 'พื้น', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(975, 'MT-AS-0975', 7, 106, NULL, NULL, 'ม่าน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(976, 'MT-AS-0976', 7, 106, NULL, NULL, 'ม่านชักรอก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(977, 'MT-AS-0977', 7, 123, NULL, NULL, 'รถ 10 ล้อ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(978, 'MT-AS-0978', 7, 123, NULL, NULL, 'รถ 4 ล้อ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(979, 'MT-AS-0979', 7, 123, NULL, NULL, 'รถ 6 ล้อ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(980, 'MT-AS-0980', 7, 123, NULL, NULL, 'รถกระบะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(981, 'MT-AS-0981', 7, 123, NULL, NULL, 'รถดับเพลิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(982, 'MT-AS-0982', 7, 123, NULL, NULL, 'รถตู้', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(983, 'MT-AS-0983', 7, 123, NULL, NULL, 'รถยนต์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(984, 'MT-AS-0984', 7, 123, NULL, NULL, 'รถเก๋ง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(985, 'MT-AS-0985', 7, 137, NULL, NULL, 'รถเข็นฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(986, 'MT-AS-0986', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(987, 'MT-AS-0987', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(988, 'MT-AS-0988', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(989, 'MT-AS-0989', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(990, 'MT-AS-0990', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(991, 'MT-AS-0991', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(992, 'MT-AS-0992', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(993, 'MT-AS-0993', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(994, 'MT-AS-0994', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(995, 'MT-AS-0995', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(996, 'MT-AS-0996', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(997, 'MT-AS-0997', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(998, 'MT-AS-0998', 7, 31, NULL, NULL, 'รถแฮนด์ลิฟท์ เบอร์ 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(999, 'MT-AS-0999', 7, 100, NULL, NULL, 'รางน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1000, 'MT-AS-1000', 7, 135, NULL, NULL, 'ราวตากผ้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1001, 'MT-AS-1001', 7, 100, NULL, NULL, 'ราวเหล็ก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1002, 'MT-AS-1002', 7, 97, NULL, NULL, 'ลานจอดรถ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1003, 'MT-AS-1003', 7, 97, NULL, NULL, 'ลานรับปลา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1004, 'MT-AS-1004', 7, 4, NULL, NULL, 'ลานรับวัตถุดิบ(อาคาร1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1005, 'MT-AS-1005', 7, 4, NULL, NULL, 'ลานรับวัตถุดิบฟรีส (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1006, 'MT-AS-1006', 7, 97, NULL, NULL, 'ลานโหลด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1007, 'MT-AS-1007', 7, 88, NULL, NULL, 'ลานโหลด 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1008, 'MT-AS-1008', 7, 88, NULL, NULL, 'ลานโหลด 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1009, 'MT-AS-1009', 7, 88, NULL, NULL, 'ลานโหลดฟรีโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1010, 'MT-AS-1010', 7, 88, NULL, NULL, 'ลานโหลดเจนโซน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1011, 'MT-AS-1011', 7, 65, NULL, NULL, 'ลิฟท์ยกของอ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1012, 'MT-AS-1012', 7, 78, NULL, NULL, 'ลูกตุ้ม 10 Kg.', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1013, 'MT-AS-1013', 7, 124, NULL, NULL, 'วาล์วน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1014, 'MT-AS-1014', 7, 100, NULL, NULL, 'ศาลพระภูมิ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1015, 'MT-AS-1015', 7, 100, NULL, NULL, 'สนามหญ้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1016, 'MT-AS-1016', 7, 116, NULL, NULL, 'สปอร์ตไลท์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1017, 'MT-AS-1017', 7, 4, NULL, NULL, 'ส่วนผลิต (อาคาร 8 ) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1018, 'MT-AS-1018', 7, 4, NULL, NULL, 'ส่วนผลิต (อาคาร 8 ) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1019, 'MT-AS-1019', 7, 4, NULL, NULL, 'ส่วนผลิต (อาคาร 8 ) คอยค์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1020, 'MT-AS-1020', 7, 4, NULL, NULL, 'ส่วนผลิต (อาคาร 8 ) คอยค์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1021, 'MT-AS-1021', 7, 4, NULL, NULL, 'ส่วนผลิต (อาคาร 8 ) คอยค์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1022, 'MT-AS-1022', 7, 115, NULL, NULL, 'สวิทช์ไฟ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1023, 'MT-AS-1023', 7, 92, NULL, NULL, 'สะพานโหลด 1 ช่อง 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1024, 'MT-AS-1024', 7, 92, NULL, NULL, 'สะพานโหลด 1 ช่อง 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1025, 'MT-AS-1025', 7, 92, NULL, NULL, 'สะพานโหลด 2 ช่อง 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1026, 'MT-AS-1026', 7, 92, NULL, NULL, 'สะพานโหลด 2 ช่อง 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1027, 'MT-AS-1027', 7, 130, NULL, NULL, 'สายฉีดน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1028, 'MT-AS-1028', 7, 127, NULL, NULL, 'สายชำระ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1029, 'MT-AS-1029', 7, 141, NULL, NULL, 'สายดับเพลิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1030, 'MT-AS-1030', 7, 127, NULL, NULL, 'สายยางน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1031, 'MT-AS-1031', 7, 111, NULL, NULL, 'สายไฟ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1032, 'MT-AS-1032', 7, 81, NULL, NULL, 'สำนักงานศุลกากร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1033, 'MT-AS-1033', 7, 100, NULL, NULL, 'หน้าต่าง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1034, 'MT-AS-1034', 7, 111, NULL, NULL, 'หลอดไฟ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1035, 'MT-AS-1035', 7, 111, NULL, NULL, 'หลอดไฟรั่วกำแพง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1036, 'MT-AS-1036', 7, 104, NULL, NULL, 'หลังคา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1037, 'MT-AS-1037', 7, 79, NULL, NULL, 'ห้อง B203', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1038, 'MT-AS-1038', 7, 4, NULL, NULL, 'ห้อง B203 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1039, 'MT-AS-1039', 7, 4, NULL, NULL, 'ห้อง B203 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1040, 'MT-AS-1040', 7, 79, NULL, NULL, 'ห้อง B204', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1041, 'MT-AS-1041', 7, 4, NULL, NULL, 'ห้อง B204 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1042, 'MT-AS-1042', 7, 4, NULL, NULL, 'ห้อง B204 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1043, 'MT-AS-1043', 7, 79, NULL, NULL, 'ห้อง B205', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1044, 'MT-AS-1044', 7, 4, NULL, NULL, 'ห้อง B205 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1045, 'MT-AS-1045', 7, 4, NULL, NULL, 'ห้อง B205 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1046, 'MT-AS-1046', 7, 79, NULL, NULL, 'ห้อง B206', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1047, 'MT-AS-1047', 7, 4, NULL, NULL, 'ห้อง B206 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1048, 'MT-AS-1048', 7, 4, NULL, NULL, 'ห้อง B206 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1049, 'MT-AS-1049', 7, 79, NULL, NULL, 'ห้อง B207', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1050, 'MT-AS-1050', 7, 4, NULL, NULL, 'ห้อง B207 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1051, 'MT-AS-1051', 7, 4, NULL, NULL, 'ห้อง B207 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1052, 'MT-AS-1052', 7, 98, NULL, NULL, 'ห้อง Chill', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1053, 'MT-AS-1053', 7, 4, NULL, NULL, 'ห้อง CHILL (อาคาร 8 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1054, 'MT-AS-1054', 7, 4, NULL, NULL, 'ห้อง Chill 30 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1055, 'MT-AS-1055', 7, 4, NULL, NULL, 'ห้อง Chill 30 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1056, 'MT-AS-1056', 7, 4, NULL, NULL, 'ห้อง CHILL ROOM อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1057, 'MT-AS-1057', 7, 81, NULL, NULL, 'ห้อง CS B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1058, 'MT-AS-1058', 7, 81, NULL, NULL, 'ห้อง CS JPK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1059, 'MT-AS-1059', 7, 90, NULL, NULL, 'ห้อง MDB อาคาร 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1060, 'MT-AS-1060', 7, 4, NULL, NULL, 'ห้อง P4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1061, 'MT-AS-1061', 7, 83, NULL, NULL, 'ห้อง Server', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1062, 'MT-AS-1062', 7, 84, NULL, NULL, 'ห้อง Server', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1063, 'MT-AS-1063', 7, 4, NULL, NULL, 'ห้อง SMALL COLD ROOM (อ.8 )', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1064, 'MT-AS-1064', 7, 4, NULL, NULL, 'ห้องASRS 1 (อาคาร 8 ) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1065, 'MT-AS-1065', 7, 4, NULL, NULL, 'ห้องASRS 1 (อาคาร 8 ) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1066, 'MT-AS-1066', 7, 4, NULL, NULL, 'ห้องASRS 1 (อาคาร 8 ) คอยค์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1067, 'MT-AS-1067', 7, 4, NULL, NULL, 'ห้องASRS 1 (อาคาร 8 ) คอยค์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1068, 'MT-AS-1068', 7, 4, NULL, NULL, 'ห้องASRS 2 (อาคาร 8 ) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1069, 'MT-AS-1069', 7, 4, NULL, NULL, 'ห้องASRS 2 (อาคาร 8 ) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1070, 'MT-AS-1070', 7, 91, NULL, NULL, 'ห้องควบคุมระบบทำความเย็น', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1071, 'MT-AS-1071', 7, 90, NULL, NULL, 'ห้องควบคุมโซล่าเซล', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1072, 'MT-AS-1072', 7, 85, NULL, NULL, 'ห้องน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1073, 'MT-AS-1073', 7, 85, NULL, NULL, 'ห้องน้ำชาย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1074, 'MT-AS-1074', 7, 85, NULL, NULL, 'ห้องน้ำชายด้านหน้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1075, 'MT-AS-1075', 7, 85, NULL, NULL, 'ห้องน้ำชายด้านหลัง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1076, 'MT-AS-1076', 7, 85, NULL, NULL, 'ห้องน้ำชายออฟฟิศชั้น 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1077, 'MT-AS-1077', 7, 85, NULL, NULL, 'ห้องน้ำชายออฟฟิศชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1078, 'MT-AS-1078', 7, 85, NULL, NULL, 'ห้องน้ำชายออฟฟิศชั้น 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1079, 'MT-AS-1079', 7, 85, NULL, NULL, 'ห้องน้ำหญิง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1080, 'MT-AS-1080', 7, 85, NULL, NULL, 'ห้องน้ำหญิงด้านหน้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1081, 'MT-AS-1081', 7, 85, NULL, NULL, 'ห้องน้ำหญิงด้านหลัง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1082, 'MT-AS-1082', 7, 85, NULL, NULL, 'ห้องน้ำหญิงออฟฟิศชั้น 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1083, 'MT-AS-1083', 7, 85, NULL, NULL, 'ห้องน้ำหญิงออฟฟิศชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1084, 'MT-AS-1084', 7, 85, NULL, NULL, 'ห้องน้ำหญิงออฟฟิศชั้น 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1085, 'MT-AS-1085', 7, 85, NULL, NULL, 'ห้องน้ำออฟฟิศชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1086, 'MT-AS-1086', 7, 85, NULL, NULL, 'ห้องน้ำออฟฟิศชั้น 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1087, 'MT-AS-1087', 7, 85, NULL, NULL, 'ห้องน้ำอาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1088, 'MT-AS-1088', 7, 85, NULL, NULL, 'ห้องน้ำโหลด 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1089, 'MT-AS-1089', 7, 85, NULL, NULL, 'ห้องน้ำโหลด 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1090, 'MT-AS-1090', 7, 82, NULL, NULL, 'ห้องประชุม 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1091, 'MT-AS-1091', 7, 82, NULL, NULL, 'ห้องประชุม 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1092, 'MT-AS-1092', 7, 82, NULL, NULL, 'ห้องประชุม 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1093, 'MT-AS-1093', 7, 82, NULL, NULL, 'ห้องประชุมชั้น 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1094, 'MT-AS-1094', 7, 82, NULL, NULL, 'ห้องประชุมชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1095, 'MT-AS-1095', 7, 82, NULL, NULL, 'ห้องประชุมชั้น 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1096, 'MT-AS-1096', 7, 88, NULL, NULL, 'ห้องพักปลา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1097, 'MT-AS-1097', 7, 96, NULL, NULL, 'ห้องฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1098, 'MT-AS-1098', 7, 28, NULL, NULL, 'ห้องฟรีส 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1099, 'MT-AS-1099', 7, 99, NULL, NULL, 'ห้องฟรีส 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1100, 'MT-AS-1100', 7, 28, NULL, NULL, 'ห้องฟรีส 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1101, 'MT-AS-1101', 7, 99, NULL, NULL, 'ห้องฟรีส 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1102, 'MT-AS-1102', 7, 28, NULL, NULL, 'ห้องฟรีส 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1103, 'MT-AS-1103', 7, 99, NULL, NULL, 'ห้องฟรีส 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1104, 'MT-AS-1104', 7, 96, NULL, NULL, 'ห้องฟรีส 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1105, 'MT-AS-1105', 7, 99, NULL, NULL, 'ห้องฟรีส 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1106, 'MT-AS-1106', 7, 96, NULL, NULL, 'ห้องฟรีส 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1107, 'MT-AS-1107', 7, 99, NULL, NULL, 'ห้องฟรีส 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1108, 'MT-AS-1108', 7, 96, NULL, NULL, 'ห้องฟรีส 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1109, 'MT-AS-1109', 7, 99, NULL, NULL, 'ห้องฟรีส 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1110, 'MT-AS-1110', 7, 96, NULL, NULL, 'ห้องฟรีส 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1111, 'MT-AS-1111', 7, 96, NULL, NULL, 'ห้องฟรีส 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1112, 'MT-AS-1112', 7, 88, NULL, NULL, 'ห้องรับรอง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1113, 'MT-AS-1113', 7, 81, NULL, NULL, 'ห้องรับรองลูกค้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1114, 'MT-AS-1114', 7, 88, NULL, NULL, 'ห้องรับวัตถุดิบ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1115, 'MT-AS-1115', 7, 88, NULL, NULL, 'ห้องรับสด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1116, 'MT-AS-1116', 7, 4, NULL, NULL, 'ห้องละลายสินค้า 10 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1117, 'MT-AS-1117', 7, 4, NULL, NULL, 'ห้องละลายสินค้า 8 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1118, 'MT-AS-1118', 7, 88, NULL, NULL, 'ห้องอบปลา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1119, 'MT-AS-1119', 7, 4, NULL, NULL, 'ห้องอบปลา คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1120, 'MT-AS-1120', 7, 4, NULL, NULL, 'ห้องอบปลา คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1121, 'MT-AS-1121', 7, 4, NULL, NULL, 'ห้องเก็บ 1 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1122, 'MT-AS-1122', 7, 4, NULL, NULL, 'ห้องเก็บ 1 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1123, 'MT-AS-1123', 7, 4, NULL, NULL, 'ห้องเก็บ 1 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1124, 'MT-AS-1124', 7, 4, NULL, NULL, 'ห้องเก็บ 1 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1125, 'MT-AS-1125', 7, 4, NULL, NULL, 'ห้องเก็บ 10 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1126, 'MT-AS-1126', 7, 4, NULL, NULL, 'ห้องเก็บ 10 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1127, 'MT-AS-1127', 7, 4, NULL, NULL, 'ห้องเก็บ 10 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1128, 'MT-AS-1128', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1129, 'MT-AS-1129', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1130, 'MT-AS-1130', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1131, 'MT-AS-1131', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1132, 'MT-AS-1132', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1133, 'MT-AS-1133', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1134, 'MT-AS-1134', 7, 4, NULL, NULL, 'ห้องเก็บ 11 คอยล์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1135, 'MT-AS-1135', 7, 4, NULL, NULL, 'ห้องเก็บ 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1136, 'MT-AS-1136', 7, 4, NULL, NULL, 'ห้องเก็บ 12 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1137, 'MT-AS-1137', 7, 4, NULL, NULL, 'ห้องเก็บ 12 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1138, 'MT-AS-1138', 7, 4, NULL, NULL, 'ห้องเก็บ 13 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1139, 'MT-AS-1139', 7, 4, NULL, NULL, 'ห้องเก็บ 13 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1140, 'MT-AS-1140', 7, 4, NULL, NULL, 'ห้องเก็บ 14 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1141, 'MT-AS-1141', 7, 4, NULL, NULL, 'ห้องเก็บ 14 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1142, 'MT-AS-1142', 7, 4, NULL, NULL, 'ห้องเก็บ 14 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1143, 'MT-AS-1143', 7, 4, NULL, NULL, 'ห้องเก็บ 15 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1144, 'MT-AS-1144', 7, 4, NULL, NULL, 'ห้องเก็บ 15 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1145, 'MT-AS-1145', 7, 4, NULL, NULL, 'ห้องเก็บ 16 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1146, 'MT-AS-1146', 7, 4, NULL, NULL, 'ห้องเก็บ 16 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1147, 'MT-AS-1147', 7, 4, NULL, NULL, 'ห้องเก็บ 17 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1148, 'MT-AS-1148', 7, 4, NULL, NULL, 'ห้องเก็บ 17 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1149, 'MT-AS-1149', 7, 4, NULL, NULL, 'ห้องเก็บ 18 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1150, 'MT-AS-1150', 7, 4, NULL, NULL, 'ห้องเก็บ 18 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1151, 'MT-AS-1151', 7, 4, NULL, NULL, 'ห้องเก็บ 19 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1152, 'MT-AS-1152', 7, 4, NULL, NULL, 'ห้องเก็บ 19 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1153, 'MT-AS-1153', 7, 4, NULL, NULL, 'ห้องเก็บ 2 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1154, 'MT-AS-1154', 7, 4, NULL, NULL, 'ห้องเก็บ 2 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1155, 'MT-AS-1155', 7, 4, NULL, NULL, 'ห้องเก็บ 2 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1156, 'MT-AS-1156', 7, 4, NULL, NULL, 'ห้องเก็บ 20 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1157, 'MT-AS-1157', 7, 4, NULL, NULL, 'ห้องเก็บ 20 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1158, 'MT-AS-1158', 7, 4, NULL, NULL, 'ห้องเก็บ 21 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1159, 'MT-AS-1159', 7, 4, NULL, NULL, 'ห้องเก็บ 21 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1160, 'MT-AS-1160', 7, 4, NULL, NULL, 'ห้องเก็บ 22 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1161, 'MT-AS-1161', 7, 4, NULL, NULL, 'ห้องเก็บ 22 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1162, 'MT-AS-1162', 7, 4, NULL, NULL, 'ห้องเก็บ 23 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1163, 'MT-AS-1163', 7, 4, NULL, NULL, 'ห้องเก็บ 23 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1164, 'MT-AS-1164', 7, 4, NULL, NULL, 'ห้องเก็บ 24 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1165, 'MT-AS-1165', 7, 4, NULL, NULL, 'ห้องเก็บ 24 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1166, 'MT-AS-1166', 7, 4, NULL, NULL, 'ห้องเก็บ 25 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1167, 'MT-AS-1167', 7, 4, NULL, NULL, 'ห้องเก็บ 25 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1168, 'MT-AS-1168', 7, 4, NULL, NULL, 'ห้องเก็บ 28 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1169, 'MT-AS-1169', 7, 4, NULL, NULL, 'ห้องเก็บ 28 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1170, 'MT-AS-1170', 7, 4, NULL, NULL, 'ห้องเก็บ 29 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1171, 'MT-AS-1171', 7, 4, NULL, NULL, 'ห้องเก็บ 29 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1172, 'MT-AS-1172', 7, 4, NULL, NULL, 'ห้องเก็บ 29 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1173, 'MT-AS-1173', 7, 4, NULL, NULL, 'ห้องเก็บ 29 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1174, 'MT-AS-1174', 7, 4, NULL, NULL, 'ห้องเก็บ 3 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1175, 'MT-AS-1175', 7, 4, NULL, NULL, 'ห้องเก็บ 3 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1176, 'MT-AS-1176', 7, 4, NULL, NULL, 'ห้องเก็บ 3 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1177, 'MT-AS-1177', 7, 4, NULL, NULL, 'ห้องเก็บ 3 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1178, 'MT-AS-1178', 7, 4, NULL, NULL, 'ห้องเก็บ 4 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1179, 'MT-AS-1179', 7, 4, NULL, NULL, 'ห้องเก็บ 4 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1180, 'MT-AS-1180', 7, 4, NULL, NULL, 'ห้องเก็บ 6 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1181, 'MT-AS-1181', 7, 4, NULL, NULL, 'ห้องเก็บ 6 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1182, 'MT-AS-1182', 7, 4, NULL, NULL, 'ห้องเก็บ 6 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1183, 'MT-AS-1183', 7, 4, NULL, NULL, 'ห้องเก็บ 6 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1184, 'MT-AS-1184', 7, 4, NULL, NULL, 'ห้องเก็บ 7 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1185, 'MT-AS-1185', 7, 4, NULL, NULL, 'ห้องเก็บ 7 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1186, 'MT-AS-1186', 7, 4, NULL, NULL, 'ห้องเก็บ 7 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1187, 'MT-AS-1187', 7, 4, NULL, NULL, 'ห้องเก็บ 7 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1188, 'MT-AS-1188', 7, 4, NULL, NULL, 'ห้องเก็บ 8 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1189, 'MT-AS-1189', 7, 4, NULL, NULL, 'ห้องเก็บ 8 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1190, 'MT-AS-1190', 7, 4, NULL, NULL, 'ห้องเก็บ 8 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1191, 'MT-AS-1191', 7, 4, NULL, NULL, 'ห้องเก็บ 8 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1192, 'MT-AS-1192', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1193, 'MT-AS-1193', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1194, 'MT-AS-1194', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1195, 'MT-AS-1195', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1196, 'MT-AS-1196', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1197, 'MT-AS-1197', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1198, 'MT-AS-1198', 7, 4, NULL, NULL, 'ห้องเก็บ 9 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1199, 'MT-AS-1199', 7, 4, NULL, NULL, 'ห้องเก็บ AM01 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1200, 'MT-AS-1200', 7, 4, NULL, NULL, 'ห้องเก็บ AM01 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1201, 'MT-AS-1201', 7, 4, NULL, NULL, 'ห้องเก็บ AM01 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1202, 'MT-AS-1202', 7, 4, NULL, NULL, 'ห้องเก็บ AM01 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1203, 'MT-AS-1203', 7, 4, NULL, NULL, 'ห้องเก็บ AM02 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1204, 'MT-AS-1204', 7, 4, NULL, NULL, 'ห้องเก็บ AM02 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1205, 'MT-AS-1205', 7, 4, NULL, NULL, 'ห้องเก็บ AM02 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1206, 'MT-AS-1206', 7, 4, NULL, NULL, 'ห้องเก็บ AM02 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1207, 'MT-AS-1207', 7, 4, NULL, NULL, 'ห้องเก็บ AM03 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1208, 'MT-AS-1208', 7, 4, NULL, NULL, 'ห้องเก็บ AM03 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1209, 'MT-AS-1209', 7, 4, NULL, NULL, 'ห้องเก็บ AM03 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1210, 'MT-AS-1210', 7, 4, NULL, NULL, 'ห้องเก็บ AM03 คอยล์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1211, 'MT-AS-1211', 7, 4, NULL, NULL, 'ห้องเก็บ ARO1 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1212, 'MT-AS-1212', 7, 4, NULL, NULL, 'ห้องเก็บ ARO2 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1213, 'MT-AS-1213', 7, 4, NULL, NULL, 'ห้องเก็บ ARO2 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1214, 'MT-AS-1214', 7, 4, NULL, NULL, 'ห้องเก็บ ARO2 คอยล์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1215, 'MT-AS-1215', 7, 4, NULL, NULL, 'ห้องเก็บ ARO3 คอยล์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1216, 'MT-AS-1216', 7, 4, NULL, NULL, 'ห้องเก็บ ARO3 คอยล์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1217, 'MT-AS-1217', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1218, 'MT-AS-1218', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1219, 'MT-AS-1219', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1220, 'MT-AS-1220', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1221, 'MT-AS-1221', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 5 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1222, 'MT-AS-1222', 7, 4, NULL, NULL, 'ห้องเก็บ เบอร์ 5 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1223, 'MT-AS-1223', 7, 95, NULL, NULL, 'ห้องเก็บสินค้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1224, 'MT-AS-1224', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1225, 'MT-AS-1225', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1226, 'MT-AS-1226', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1227, 'MT-AS-1227', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1228, 'MT-AS-1228', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1229, 'MT-AS-1229', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1230, 'MT-AS-1230', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 15', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1231, 'MT-AS-1231', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 16', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1232, 'MT-AS-1232', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 17', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1233, 'MT-AS-1233', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 18', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1234, 'MT-AS-1234', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 19', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1235, 'MT-AS-1235', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1236, 'MT-AS-1236', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 20', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1237, 'MT-AS-1237', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 21', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1238, 'MT-AS-1238', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 22', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1239, 'MT-AS-1239', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 23', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1240, 'MT-AS-1240', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 24', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1241, 'MT-AS-1241', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 25', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1242, 'MT-AS-1242', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1243, 'MT-AS-1243', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 30', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1244, 'MT-AS-1244', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1245, 'MT-AS-1245', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1246, 'MT-AS-1246', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1247, 'MT-AS-1247', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1248, 'MT-AS-1248', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1249, 'MT-AS-1249', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1250, 'MT-AS-1250', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า ASRS1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1251, 'MT-AS-1251', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า ASRS2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1252, 'MT-AS-1252', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า P3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1253, 'MT-AS-1253', 7, 88, NULL, NULL, 'ห้องเก็บสินค้า P4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1254, 'MT-AS-1254', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1255, 'MT-AS-1255', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1256, 'MT-AS-1256', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1257, 'MT-AS-1257', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1258, 'MT-AS-1258', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1259, 'MT-AS-1259', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1260, 'MT-AS-1260', 7, 88, NULL, NULL, 'ห้องเก็บสินค้าโมบาย 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1261, 'MT-AS-1261', 7, 143, NULL, NULL, 'ห้องแต่งตัวทีมฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1262, 'MT-AS-1262', 7, 94, NULL, NULL, 'ห้องแพ็ค', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1263, 'MT-AS-1263', 7, 4, NULL, NULL, 'ห้องแพ็ค (อาคาร 4)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1264, 'MT-AS-1264', 7, 4, NULL, NULL, 'ห้องแพ็ค 1 (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1265, 'MT-AS-1265', 7, 4, NULL, NULL, 'ห้องแพ็ค 2 (อาคาร 1)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1266, 'MT-AS-1266', 7, 4, NULL, NULL, 'ห้องแพ็คกิ้งฟรีส', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1267, 'MT-AS-1267', 7, 4, NULL, NULL, 'ห้องโมบาย 1 (อาคาร8) คอยค์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1268, 'MT-AS-1268', 7, 4, NULL, NULL, 'ห้องโมบาย 1 (อาคาร8) คอยค์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1269, 'MT-AS-1269', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1270, 'MT-AS-1270', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1271, 'MT-AS-1271', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1272, 'MT-AS-1272', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1273, 'MT-AS-1273', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1274, 'MT-AS-1274', 7, 4, NULL, NULL, 'ห้องโมบาย 1 คอยด์ 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1275, 'MT-AS-1275', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1276, 'MT-AS-1276', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1277, 'MT-AS-1277', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1278, 'MT-AS-1278', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1279, 'MT-AS-1279', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1280, 'MT-AS-1280', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1281, 'MT-AS-1281', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1282, 'MT-AS-1282', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1283, 'MT-AS-1283', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1284, 'MT-AS-1284', 7, 4, NULL, NULL, 'ห้องโมบาย 2 คอยด์ 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1285, 'MT-AS-1285', 7, 4, NULL, NULL, 'ห้องโมบาย 3 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1286, 'MT-AS-1286', 7, 4, NULL, NULL, 'ห้องโมบาย 3 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1287, 'MT-AS-1287', 7, 4, NULL, NULL, 'ห้องโมบาย 3 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1288, 'MT-AS-1288', 7, 4, NULL, NULL, 'ห้องโมบาย 3 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1289, 'MT-AS-1289', 7, 4, NULL, NULL, 'ห้องโมบาย 4 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1290, 'MT-AS-1290', 7, 4, NULL, NULL, 'ห้องโมบาย 4 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1291, 'MT-AS-1291', 7, 4, NULL, NULL, 'ห้องโมบาย 5 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1292, 'MT-AS-1292', 7, 4, NULL, NULL, 'ห้องโมบาย 5 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1293, 'MT-AS-1293', 7, 4, NULL, NULL, 'ห้องโมบาย 5 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1294, 'MT-AS-1294', 7, 4, NULL, NULL, 'ห้องโมบาย 5 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1295, 'MT-AS-1295', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1296, 'MT-AS-1296', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1297, 'MT-AS-1297', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1298, 'MT-AS-1298', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1299, 'MT-AS-1299', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1300, 'MT-AS-1300', 7, 4, NULL, NULL, 'ห้องโมบาย 6 คอยด์ 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1301, 'MT-AS-1301', 7, 143, NULL, NULL, 'หอพัก', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1302, 'MT-AS-1302', 7, 102, NULL, NULL, 'ออฟฟิต', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1303, 'MT-AS-1303', 7, 102, NULL, NULL, 'ออฟฟิต CS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1304, 'MT-AS-1304', 7, 81, NULL, NULL, 'ออฟฟิศ 1 อาคาร THPD', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1305, 'MT-AS-1305', 7, 81, NULL, NULL, 'ออฟฟิศ 2 อาคาร THPD', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1306, 'MT-AS-1306', 7, 81, NULL, NULL, 'ออฟฟิศ 3 อาคาร THPD', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1307, 'MT-AS-1307', 7, 81, NULL, NULL, 'ออฟฟิศ CS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1308, 'MT-AS-1308', 7, 81, NULL, NULL, 'ออฟฟิศชั้น 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1309, 'MT-AS-1309', 7, 81, NULL, NULL, 'ออฟฟิศชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1310, 'MT-AS-1310', 7, 81, NULL, NULL, 'ออฟฟิศชั้น 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1311, 'MT-AS-1311', 7, 81, NULL, NULL, 'ออฟฟิศวิศวกรรม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1312, 'MT-AS-1312', 7, 81, NULL, NULL, 'ออฟฟิิศสำนักงานชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1313, 'MT-AS-1313', 7, 143, NULL, NULL, 'อาคาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1314, 'MT-AS-1314', 7, 143, NULL, NULL, 'อาคาร 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1315, 'MT-AS-1315', 7, 143, NULL, NULL, 'อาคาร 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1316, 'MT-AS-1316', 7, 143, NULL, NULL, 'อาคาร 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1317, 'MT-AS-1317', 7, 143, NULL, NULL, 'อาคาร 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1318, 'MT-AS-1318', 7, 143, NULL, NULL, 'อาคาร 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1319, 'MT-AS-1319', 7, 143, NULL, NULL, 'อาคาร 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1320, 'MT-AS-1320', 7, 143, NULL, NULL, 'อาคาร 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1321, 'MT-AS-1321', 7, 143, NULL, NULL, 'อาคาร 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1322, 'MT-AS-1322', 7, 143, NULL, NULL, 'อาคาร A', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1323, 'MT-AS-1323', 7, 143, NULL, NULL, 'อาคาร B', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1324, 'MT-AS-1324', 7, 143, NULL, NULL, 'อาคาร B1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1325, 'MT-AS-1325', 7, 143, NULL, NULL, 'อาคาร B2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1326, 'MT-AS-1326', 7, 143, NULL, NULL, 'อาคาร C', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1327, 'MT-AS-1327', 7, 143, NULL, NULL, 'อาคาร JPK', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1328, 'MT-AS-1328', 7, 119, NULL, NULL, 'อ่างจุ่มเท้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1329, 'MT-AS-1329', 7, 119, NULL, NULL, 'อ่างล้างจาน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1330, 'MT-AS-1330', 7, 119, NULL, NULL, 'อ่างล้างมือ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1331, 'MT-AS-1331', 7, 119, NULL, NULL, 'อ่างล้างหน้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1332, 'MT-AS-1332', 7, 77, NULL, NULL, 'อินฟาเรด เทอร์โมมิเตอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1333, 'MT-AS-1333', 7, 14, NULL, NULL, 'อีแว๊ป ดาดฟ้า อาคาร4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1334, 'MT-AS-1334', 7, 14, NULL, NULL, 'อีแว๊ป ดาดฟ้า อาคาร6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1335, 'MT-AS-1335', 7, 14, NULL, NULL, 'อีแว๊ป ดาดฟ้าอาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1336, 'MT-AS-1336', 7, 14, NULL, NULL, 'อีแว๊ป ดาดฟ้าอาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1337, 'MT-AS-1337', 7, 120, NULL, NULL, 'เก้าอี้', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1338, 'MT-AS-1338', 7, 56, NULL, NULL, 'เครื่อง Metal Detector', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1339, 'MT-AS-1339', 7, 109, NULL, NULL, 'เครื่องกดสบู่เหลว', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1340, 'MT-AS-1340', 7, 72, NULL, NULL, 'เครื่องขัดพื้น (่Scrubber Floor)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1341, 'MT-AS-1341', 7, 149, NULL, NULL, 'เครื่องฉีดน้ำแรงดันสูง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1342, 'MT-AS-1342', 7, 109, NULL, NULL, 'เครื่องฉีดแอลกอฮอล์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1343, 'MT-AS-1343', 7, 56, NULL, NULL, 'เครื่องตรวจจับโลหะ อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1344, 'MT-AS-1344', 7, 6, NULL, NULL, 'เครื่องตรวจวัดแอมโมเนีย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1345, 'MT-AS-1345', 7, 6, NULL, NULL, 'เครื่องตรวจวัดแอมโมเนียแบบพกพา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1346, 'MT-AS-1346', 7, 107, NULL, NULL, 'เครื่องถ่ายเอกสาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1347, 'MT-AS-1347', 7, 43, NULL, NULL, 'เครื่องทำน้ำเย็น อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1348, 'MT-AS-1348', 7, 43, NULL, NULL, 'เครื่องทำน้ำเย็นออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1349, 'MT-AS-1349', 7, 43, NULL, NULL, 'เครื่องทำน้ำเย็นโรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1350, 'MT-AS-1350', 7, 107, NULL, NULL, 'เครื่องปริ้น', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1351, 'MT-AS-1351', 7, 149, NULL, NULL, 'เครื่องพ่นยา,สำหรับฉีดล้าง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1352, 'MT-AS-1352', 7, 146, NULL, NULL, 'เครื่องพันฟิล์ม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1353, 'MT-AS-1353', 7, 61, NULL, NULL, 'เครื่องยิงทราย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1354, 'MT-AS-1354', 7, 55, NULL, NULL, 'เครื่องรัดกล่อง (Stap the Box)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1355, 'MT-AS-1355', 7, 55, NULL, NULL, 'เครื่องรัดกล่อง (Stape the Box)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1356, 'MT-AS-1356', 7, 55, NULL, NULL, 'เครื่องรัดกล่อง อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1357, 'MT-AS-1357', 7, 32, NULL, NULL, 'เครื่องรีดถุง', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1358, 'MT-AS-1358', 7, 32, NULL, NULL, 'เครื่องรีดถุงเพลา 2 ชั้นสเตนเลส(Press Beg)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1359, 'MT-AS-1359', 7, 145, NULL, NULL, 'เครื่องล้างกะบะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1360, 'MT-AS-1360', 7, 33, NULL, NULL, 'เครื่องล้างถาด', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1361, 'MT-AS-1361', 7, 108, NULL, NULL, 'เครื่องเคลือบบัตร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1362, 'MT-AS-1362', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1363, 'MT-AS-1363', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 10', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1364, 'MT-AS-1364', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 11', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1365, 'MT-AS-1365', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 12', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1366, 'MT-AS-1366', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 13', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1367, 'MT-AS-1367', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 14', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1368, 'MT-AS-1368', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1369, 'MT-AS-1369', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1370, 'MT-AS-1370', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1371, 'MT-AS-1371', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 5', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1);
INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES
(1372, 'MT-AS-1372', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1373, 'MT-AS-1373', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1374, 'MT-AS-1374', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1375, 'MT-AS-1375', 7, 26, NULL, NULL, 'เครื่องไฟดักแมลง 9', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1376, 'MT-AS-1376', 7, 81, NULL, NULL, 'เคาเตอร์ประชาสัมพันธ์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1377, 'MT-AS-1377', 7, 112, NULL, NULL, 'เตาอบ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1378, 'MT-AS-1378', 7, 5, NULL, NULL, 'เทอร์โมมิเตอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1379, 'MT-AS-1379', 7, 5, NULL, NULL, 'เทอร์โมมิเตอร์(มาสเตอร์)', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1380, 'MT-AS-1380', 7, 100, NULL, NULL, 'เสากันชน', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1381, 'MT-AS-1381', 7, 113, NULL, NULL, 'แบตเตอร์รี่', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1382, 'MT-AS-1382', 7, 42, NULL, NULL, 'แอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1383, 'MT-AS-1383', 7, 42, NULL, NULL, 'แอร์ [220 V]บ้านพักลูกค้า อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1384, 'MT-AS-1384', 7, 42, NULL, NULL, 'แอร์ [220 V]บ้านพักลูกค้า อ.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1385, 'MT-AS-1385', 7, 42, NULL, NULL, 'แอร์ [220 V]ป้อมตาชั่งรถบรรทุก อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1386, 'MT-AS-1386', 7, 42, NULL, NULL, 'แอร์ [220 V]สำนักงานชั่วคราวPLP อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1387, 'MT-AS-1387', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องInventory อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1388, 'MT-AS-1388', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องคอนโทรลโซล่า อ.1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1389, 'MT-AS-1389', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องคุณอัจฉรา ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1390, 'MT-AS-1390', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องบัญชี-การเงิน ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1391, 'MT-AS-1391', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องพัฒนาธุรกิจ ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1392, 'MT-AS-1392', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องพัฒนาธุรกิจ2 ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1393, 'MT-AS-1393', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องพัฒนาธุรกิจ3 ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1394, 'MT-AS-1394', 7, 42, NULL, NULL, 'แอร์ [220 V]ห้องพัฒนาธุรกิจ4 ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1395, 'MT-AS-1395', 7, 42, NULL, NULL, 'แอร์ [380 V]ห้องประชุม ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1396, 'MT-AS-1396', 7, 42, NULL, NULL, 'แอร์[220 V]CONTROL MOBILE RACK อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1397, 'MT-AS-1397', 7, 42, NULL, NULL, 'แอร์[220 V]ป้อมตาชั่งรถบรรทุกหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1398, 'MT-AS-1398', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องCUSโรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1399, 'MT-AS-1399', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องการตลาดออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1400, 'MT-AS-1400', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องคอนโทรลSpiral อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1401, 'MT-AS-1401', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องคอนโทรลอาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1402, 'MT-AS-1402', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องคอนโทรลโซล่า อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1403, 'MT-AS-1403', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องทำงาน CUS อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1404, 'MT-AS-1404', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องประชุม อาคาร 6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1405, 'MT-AS-1405', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องผู้จัการฝ่ายวิศวกรรม ออฟฟิศหน้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1406, 'MT-AS-1406', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องรับประทานอาหารว่าง อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1407, 'MT-AS-1407', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องลอจิสติกส์ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1408, 'MT-AS-1408', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องสัมมนา อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1409, 'MT-AS-1409', 7, 42, NULL, NULL, 'แอร์[220 V]ห้องเซิฟเวอร์ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1410, 'MT-AS-1410', 7, 42, NULL, NULL, 'แอร์[380 V]หน้าประตูห้องบัญชีคลังออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1411, 'MT-AS-1411', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องCUSโรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1412, 'MT-AS-1412', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องMDB ROOM อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1413, 'MT-AS-1413', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องคอนโทรล อ.3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1414, 'MT-AS-1414', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องคอนโทรล อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1415, 'MT-AS-1415', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องคอนโทรล อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1416, 'MT-AS-1416', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องคอนโทรล อ.8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1417, 'MT-AS-1417', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องคุณจิตชัย ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1418, 'MT-AS-1418', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องสมุด ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1419, 'MT-AS-1419', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องสัมมนา อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1420, 'MT-AS-1420', 7, 42, NULL, NULL, 'แอร์[380 V]ห้องโถงล่าง ออฟฟิศหน้าบริษัท', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1421, 'MT-AS-1421', 7, 42, NULL, NULL, 'แอร์[380 Vห้องคอนโทรลโซล่า อ.4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1422, 'MT-AS-1422', 7, 42, NULL, NULL, 'แอร์ทางเดิน CS อ.6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1423, 'MT-AS-1423', 7, 42, NULL, NULL, 'แอร์หน้าห้องประชุม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1424, 'MT-AS-1424', 7, 42, NULL, NULL, 'แอร์ห้อง Checking Post', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1425, 'MT-AS-1425', 7, 42, NULL, NULL, 'แอร์ห้อง CS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1426, 'MT-AS-1426', 7, 42, NULL, NULL, 'แอร์ห้อง Sever  ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1427, 'MT-AS-1427', 7, 42, NULL, NULL, 'แอร์ห้อง Sever  ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1428, 'MT-AS-1428', 7, 42, NULL, NULL, 'แอร์ห้องQS.CUS โรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1429, 'MT-AS-1429', 7, 42, NULL, NULL, 'แอร์ห้องคอนโทรล ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1430, 'MT-AS-1430', 7, 42, NULL, NULL, 'แอร์ห้องคอนโทรล ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1431, 'MT-AS-1431', 7, 42, NULL, NULL, 'แอร์ห้องคอนโทรล ตัวที่ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1432, 'MT-AS-1432', 7, 42, NULL, NULL, 'แอร์ห้องคอนโทรล อ.7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1433, 'MT-AS-1433', 7, 42, NULL, NULL, 'แอร์ห้องคอนโทรลระบบบำบัดน้ำเสีย', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1434, 'MT-AS-1434', 7, 42, NULL, NULL, 'แอร์ห้องทำงานกงศุลตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1435, 'MT-AS-1435', 7, 42, NULL, NULL, 'แอร์ห้องทำงานกงศุลตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1436, 'MT-AS-1436', 7, 42, NULL, NULL, 'แอร์ห้องทำงานกงศุลตัวที่ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1437, 'MT-AS-1437', 7, 42, NULL, NULL, 'แอร์ห้องประชุม', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1438, 'MT-AS-1438', 7, 42, NULL, NULL, 'แอร์ห้องประชุมชั้น 1 ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1439, 'MT-AS-1439', 7, 42, NULL, NULL, 'แอร์ห้องประชุมชั้น 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1440, 'MT-AS-1440', 7, 42, NULL, NULL, 'แอร์ห้องประชุมชั้น 3 ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1441, 'MT-AS-1441', 7, 42, NULL, NULL, 'แอร์ห้องประชุมชั้น 3 ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1442, 'MT-AS-1442', 7, 42, NULL, NULL, 'แอร์ห้องผู้จัดการCUS โรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1443, 'MT-AS-1443', 7, 42, NULL, NULL, 'แอร์ห้องพนักงานCUS โรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1444, 'MT-AS-1444', 7, 42, NULL, NULL, 'แอร์ห้องพนักงานWH', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1445, 'MT-AS-1445', 7, 42, NULL, NULL, 'แอร์ห้องรองผู้จัดการWH', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1446, 'MT-AS-1446', 7, 42, NULL, NULL, 'แอร์ห้องรับรองลูกค้า', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1447, 'MT-AS-1447', 7, 42, NULL, NULL, 'แอร์ห้องรับรองลูกค้าCUS', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1448, 'MT-AS-1448', 7, 42, NULL, NULL, 'แอร์ห้องโซล่าเซล ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1449, 'MT-AS-1449', 7, 42, NULL, NULL, 'แอร์ห้องโซล่าเซล ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1450, 'MT-AS-1450', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 1 ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1451, 'MT-AS-1451', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 2 ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1452, 'MT-AS-1452', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 2 ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1453, 'MT-AS-1453', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 2 ตัวที่ 3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1454, 'MT-AS-1454', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 2 ตัวที่ 4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1455, 'MT-AS-1455', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 3 ตัวที่ 1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1456, 'MT-AS-1456', 7, 42, NULL, NULL, 'แอร์ออฟฟิศชั้น 3 ตัวที่ 2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1457, 'MT-AS-1457', 7, 120, NULL, NULL, 'โซฟา', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1458, 'MT-AS-1458', 7, 118, NULL, NULL, 'โต๊ะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1459, 'MT-AS-1459', 7, 118, NULL, NULL, 'โต๊ะเช็คเกอร์', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1460, 'MT-AS-1460', 7, 85, NULL, NULL, 'โถ่ปัสสาวะ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1461, 'MT-AS-1461', 7, 88, NULL, NULL, 'โรงกรองน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1462, 'MT-AS-1462', 7, 143, NULL, NULL, 'โรงกรองน้ำ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1463, 'MT-AS-1463', 7, 100, NULL, NULL, 'โรงจอดรถ', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1464, 'MT-AS-1464', 7, 88, NULL, NULL, 'โรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1465, 'MT-AS-1465', 7, 100, NULL, NULL, 'โรงอาหาร', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1466, 'MT-AS-1466', 7, 52, NULL, NULL, 'ไฟฉุกเฉิน อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1467, 'MT-AS-1467', 7, 52, NULL, NULL, 'ไฟฉุกเฉิน อาคาร2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1468, 'MT-AS-1468', 7, 52, NULL, NULL, 'ไฟฉุกเฉิน อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1469, 'MT-AS-1469', 7, 52, NULL, NULL, 'ไฟฉุกเฉิน อาคาร4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1470, 'MT-AS-1470', 7, 52, NULL, NULL, 'ไฟฉุกเฉิน อาคาร6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1471, 'MT-AS-1471', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1472, 'MT-AS-1472', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร3', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1473, 'MT-AS-1473', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร4', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1474, 'MT-AS-1474', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร6', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1475, 'MT-AS-1475', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร7', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1476, 'MT-AS-1476', 7, 26, NULL, NULL, 'ไฟดักแมลง อาคาร8', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1477, 'MT-AS-1477', 7, 26, NULL, NULL, 'ไฟดักแมลงทางเข้าSpiral อาคาร1', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1),
(1478, 'MT-AS-1478', 7, 150, NULL, NULL, 'ไฮเพรสเชอร์  EN2', NULL, '2023-03-24 12:12:12', 3, NULL, NULL, 1);

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
  `serial_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recived_date` datetime DEFAULT NULL COMMENT 'REF_ID.วันทีีรับเข้า/หรือซื้อ',
  `ref_id_machine_master` int NOT NULL COMMENT 'REF_ID.เครื่องจักร Master',
  `ref_id_building` int DEFAULT NULL COMMENT 'REF_ID.อาคาร',
  `ref_id_location` int DEFAULT NULL COMMENT 'REF_ID.สถานที่',
  `ref_id_site` int NOT NULL COMMENT 'REF_ID.ไซต์งาน',
  `ref_id_supplier` int DEFAULT NULL COMMENT 'REF_ID.ซัพพลายฯ',
  `status_work` int DEFAULT NULL COMMENT '1-ใช้งานอยู่/2-อยู่ระหว่างการซ่อม',
  `detail_machine_site` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'รายละเอียดเพิ่มเติม',
  `mcs_adddate` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `mcs_editdate` datetime DEFAULT NULL,
  `ref_id_user_edit` int DEFAULT NULL,
  `status_machine_site` int NOT NULL COMMENT '1-ใช้งาน/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='เครื่องจักร/อุปกรณ์ไฟฟ้าแยกไซต์งาน';

--
-- Dumping data for table `tb_machine_site`
--

INSERT INTO `tb_machine_site` (`id_machine_site`, `code_machine_site`, `serial_number`, `recived_date`, `ref_id_machine_master`, `ref_id_building`, `ref_id_location`, `ref_id_site`, `ref_id_supplier`, `status_work`, `detail_machine_site`, `mcs_adddate`, `ref_id_user_add`, `mcs_editdate`, `ref_id_user_edit`, `status_machine_site`) VALUES
(1, 'MT-AS-0001-0001', NULL, '2023-03-01 00:00:00', 1, NULL, NULL, 1, NULL, 1, 'ใช้กรณีไม่รู้จักเครื่องจักร', '2023-03-22 10:41:21', 3, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_maintenance_request`
--

CREATE TABLE `tb_maintenance_request` (
  `id_maintenance_request` int NOT NULL COMMENT 'ID ใบแจ้งซ่อม',
  `maintenance_request_no` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'PCS-FM-IT-23-02-0001',
  `ref_id_dept_request` int NOT NULL COMMENT 'REF.ไอดีแผนกแจ้งซ่อม',
  `ref_id_site_request` int NOT NULL COMMENT 'REF.ไซต์งาน',
  `ref_id_dept_responsibility` int NOT NULL COMMENT 'แผนกที่รับผิดชอบใบแจ้งซ่อม',
  `mt_request_date` datetime NOT NULL COMMENT 'วันที่แจ้งซ่อม',
  `ref_id_user_request` int NOT NULL COMMENT 'REF.ไอดีผู้แจ้งซ่อม',
  `ref_id_machine_site` int NOT NULL COMMENT 'REF.ไอดีเครื่องจักรรายไซต์',
  `ref_id_mt_type` int NOT NULL COMMENT 'REF.อ้างอิงประเภทใบงาน',
  `status_approved` int DEFAULT NULL COMMENT '1-อนุมัติซ่อม / 2-ไม่อนุมัติ(หน.ช่าง)',
  `ref_id_user_approver` int NOT NULL COMMENT 'REF.ไอดีผู้อนุมัติใบแจ้งซ่อม',
  `detail_note_approved` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotted_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ/จ่ายงานให้ผู้ซ่อม',
  `allotted_accept_date` datetime DEFAULT NULL COMMENT 'วันที่ผู้ซ่อม(ช่าง)รับงาน',
  `ref_user_id_accept_request` int DEFAULT NULL COMMENT 'REF.ไอดีผู้กดรับงาน',
  `related_to_safty` int DEFAULT NULL COMMENT 'เกี่ยวข้องกับความปลอดภัย 	1-ไม่เกี่ยวข้อง/2-เกี่ยวข้อง',
  `problem_statement` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'อาการเสีย,ปัญหาที่พบ',
  `ref_id_job_type` int DEFAULT NULL COMMENT 'ประเภทงานซ่อม1-แจ้งช่างซ่อม/2-ช่างซ่อมเอง/3-ส่งซ่อมภายนอก',
  `urgent_type` int NOT NULL COMMENT '1-ด่วน/2-ไม่ด่วน',
  `outsource_service_status` int DEFAULT NULL COMMENT '0, 1-ส่งซ่อมภายนอก/ แจ้งช่างซ่อม',
  `caused_by_os` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'สาเหตุที่ส่งซ่อม 		เหตุผล:|:รายละเอียด / คั่นด้วย :|:',
  `ref_id_user_approve_os` int DEFAULT NULL COMMENT 'ผู้อนุมัติส่งซ่อมภายนอก',
  `duration_serv_start` datetime DEFAULT NULL COMMENT 'เวลาที่เริ่มซ่อม',
  `duration_serv_end` datetime DEFAULT NULL COMMENT 'เวลาที่ซ่อมเสร็จ',
  `estimate_hand_over_date` datetime DEFAULT NULL COMMENT 'วันที่คาดว่าจะเสร็จส่งมอบ',
  `hand_over_date` datetime DEFAULT NULL COMMENT 'วันที่ส่งมอบงาน',
  `recomment` longtext COLLATE utf8mb4_unicode_ci,
  `ref_id_user_survey` int DEFAULT NULL,
  `survay_date` datetime DEFAULT NULL,
  `ref_id_user_hand_over` int DEFAULT NULL COMMENT 'REF.ไอดีผู้ส่งมอบงาน',
  `cause_mt_request_cancel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'สาเหตุการยกเลิก',
  `date_mt_request_cancel` datetime DEFAULT NULL COMMENT 'วันที่ยกเลิก',
  `ref_id_user_cancel` int DEFAULT NULL,
  `maintenance_request_status` int NOT NULL COMMENT 'สถานะใบแจ้งซ่อม 1-ใช้งาน,2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางใบแจ้งซ่อม';

--
-- Dumping data for table `tb_maintenance_request`
--

INSERT INTO `tb_maintenance_request` (`id_maintenance_request`, `maintenance_request_no`, `ref_id_dept_request`, `ref_id_site_request`, `ref_id_dept_responsibility`, `mt_request_date`, `ref_id_user_request`, `ref_id_machine_site`, `ref_id_mt_type`, `status_approved`, `ref_id_user_approver`, `detail_note_approved`, `allotted_date`, `allotted_accept_date`, `ref_user_id_accept_request`, `related_to_safty`, `problem_statement`, `ref_id_job_type`, `urgent_type`, `outsource_service_status`, `caused_by_os`, `ref_id_user_approve_os`, `duration_serv_start`, `duration_serv_end`, `estimate_hand_over_date`, `hand_over_date`, `recomment`, `ref_id_user_survey`, `survay_date`, `ref_id_user_hand_over`, `cause_mt_request_cancel`, `date_mt_request_cancel`, `ref_id_user_cancel`, `maintenance_request_status`) VALUES
(1, 'PCS-FM-MT-2303-0001', 5, 1, 7, '2023-03-22 12:59:54', 178, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'เครื่องไม่ทำงาน อ.6', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ทดสอบยกเลิกใบแจ้งซ่อม', '2023-03-23 15:39:51', 178, 2),
(2, 'PCS-FM-MT-2303-0002', 2, 1, 7, '2023-03-22 14:03:47', 179, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'แฮนด์ลิฟต์ อ.4 ยกงานไม่ได้ ขอด่วนนะครับไม่มีรถลากงานแล้ว', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'PCS-FM-MT-2303-0003', 5, 1, 7, '2023-03-23 15:44:43', 178, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'มีเสียงดังมาจากเครื่องนี้ ที่ อ.9', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'เสียงหายแล้ว', '2023-03-23 15:48:38', 178, 2),
(4, 'PCS-FM-MT-2303-0004', 5, 1, 7, '2023-03-23 15:50:10', 178, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'พัดลมมีเสียงดัง พัดลมสั่นผิดปกติ', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

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
(7, 'งานเกี่ยวกับซอฟต์แวร์ (Software & OS)', 13, 'งานเกี่ยวกับซอฟต์แวร์ (Software & OS)', 1),
(8, 'งานเกี่ยวกับซอฟต์แวร์ (Software)', 13, 'งานเกี่ยวกับซอฟต์แวร์(ทุกโปรแกรม, ทุก OS)', 1),
(9, 'งานเกี่ยวกับระบบเครือข่าย (Network)', 13, 'งานเกี่ยวกับระบบเครือข่าย (Network)', 1),
(10, 'งานเกี่ยวกับระบบฮารด์แวร์ (Hardware)', 13, 'งานเกี่ยวกับระบบฮารด์แวร์ (Hardware)', 1),
(11, 'งานเกี่ยวกับกล้องวงจรปิด (CCTV)', 13, 'งานเกี่ยวกับกล้องวงจรปิด (CCTV)', 1),
(12, 'งานส่งซ่อมภายนอกแผนก IT/MIS', 13, 'งานส่งซ่อมภายนอกแผนก IT/MIS (เนื่องจากมีประกัน หรือ ซ่อมเองไม่ได้)', 1),
(13, 'test edit 1', 13, 'test edit 1 test edit 1', 2),
(14, 'test-add-2-edit', 13, 'test-add-2-edit', 2),
(15, 'Edit-1 xxx', 13, 'Edit-1 xxx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_outsite_repair`
--

CREATE TABLE `tb_outsite_repair` (
  `id_outsite_repair` int NOT NULL COMMENT 'ไอดีซ่อมภายนอก',
  `ref_id_maintenance_request` int NOT NULL COMMENT 'REF.ไอดีใบแจ้งซ่อม',
  `caused_outsite_repair` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สาเหตุที่ส่งซ่อม',
  `ref_id_supplier` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'REF.ซัพคอนแทค',
  `datesent_repair` datetime NOT NULL COMMENT 'วันที่ส่งซ่อม',
  `dateresive_repair` datetime DEFAULT NULL COMMENT 'วันที่ซ่อมเสร็จ',
  `ref_id_user_update` int NOT NULL COMMENT 'REF.ไอดี user update',
  `datetime_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='เก็บข้อมูลส่งซ่อมภายนอก';

-- --------------------------------------------------------

--
-- Table structure for table `tb_permission`
--

CREATE TABLE `tb_permission` (
  `id_permission` int NOT NULL,
  `ref_class_user` int NOT NULL COMMENT 'ระดับผู้ใช้งาน (sitting.inc)',
  `module_name` int NOT NULL COMMENT 'ชื่อโมดูล',
  `accept_denied` int NOT NULL COMMENT '1-accept/2-denied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางกำหนดสิทธิ์ระดับผู้ใช้งาน';

--
-- Dumping data for table `tb_permission`
--

INSERT INTO `tb_permission` (`id_permission`, `ref_class_user`, `module_name`, `accept_denied`) VALUES
(1, 1, 0, 2),
(2, 1, 1, 2),
(3, 1, 2, 1),
(4, 1, 3, 2),
(5, 2, 0, 2),
(6, 2, 1, 1),
(7, 2, 2, 1),
(8, 2, 3, 2),
(9, 3, 0, 1),
(10, 3, 1, 1),
(11, 3, 2, 1),
(12, 3, 3, 1),
(13, 5, 0, 1),
(14, 5, 1, 1),
(15, 5, 2, 1),
(16, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_repairer`
--

CREATE TABLE `tb_ref_repairer` (
  `id_ref_repairer` int NOT NULL,
  `ref_id_maintenance_request` int NOT NULL COMMENT 'REF.ไอดีใบแจ้งซ่อม',
  `ref_id_user_repairer` int NOT NULL COMMENT 'REF.ไอดีผู้รับผิดชอบ (ผู้ซ่อม)',
  `acknowledge_date` datetime DEFAULT NULL COMMENT 'วันที่กดรับทราบ',
  `status_repairer` int NOT NULL COMMENT '1-ผู้ซ่อม/2-ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='เก็บข้อมูลช่างซ่อม-ใบเบิก (1ใบ ซ่อมได้หลายคน)';

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
(10, 13, 'edit-1', 'edit-1', 1);

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
(5, 7, 'MT-002', 'เปลี่ยนอะไหล่', 'เปลี่ยนอะไหล่', 1),
(6, 7, 'MT-001', 'ขันแน่น', 'ขันแน่น', 1),
(7, 13, 'ITR-04', 'ส่งเคลมประกัน', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair_result`
--

CREATE TABLE `tb_repair_result` (
  `id_repair_result` int NOT NULL,
  `ref_id_maintenance_request` int NOT NULL COMMENT 'REF.ไอดีใบแจ้งซ่อม',
  `ref_id_failure_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'REF.ไอดีรหัสอาการเสีย',
  `ref_id_repair_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'REF.ไอดีรหัสซ่อม',
  `txt_caused_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สาเหตุของปัญหา',
  `txt_solution` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'วิธีการแก้ไข',
  `ref_id_user_report` int NOT NULL COMMENT 'REF.ไอดีผู้ซ่อมผู้รายงาน',
  `report_date` datetime NOT NULL,
  `edit_report_date` datetime DEFAULT NULL COMMENT 'วันที่แก้ไขล่าสุด',
  `ref_id_user_edit` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางสรุปผลการซ่อม';

-- --------------------------------------------------------

--
-- Table structure for table `tb_satisfaction_survey`
--

CREATE TABLE `tb_satisfaction_survey` (
  `id_survey` int NOT NULL,
  `ref_id_maintenance_request` int NOT NULL,
  `ref_topic_survey` int NOT NULL,
  `score_result` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บประเมินผลการซ่อม';

--
-- Dumping data for table `tb_satisfaction_survey`
--

INSERT INTO `tb_satisfaction_survey` (`id_survey`, `ref_id_maintenance_request`, `ref_topic_survey`, `score_result`) VALUES
(1, 19, 0, 1),
(2, 19, 1, 0),
(3, 19, 2, 0),
(4, 19, 3, 0),
(5, 19, 4, 1),
(6, 19, 5, 0),
(7, 19, 6, 0),
(8, 19, 7, 0),
(9, 15, 0, 0),
(10, 15, 1, 0),
(11, 15, 2, 0),
(12, 15, 3, 0),
(13, 15, 4, 0),
(14, 15, 5, 0),
(15, 15, 6, 0),
(16, 15, 7, 1),
(17, 10, 0, 1),
(18, 10, 1, 0),
(19, 10, 2, 1),
(20, 10, 3, 0),
(21, 10, 4, 0),
(22, 10, 5, 0),
(23, 10, 6, 0),
(24, 10, 7, 1);

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
(7, 'PLP', 'บริษัท แปซิฟิค โลจิสติกส์ โปร จำกัด', 1),
(8, 'PACS', 'บริษัท แปซิฟิค ห้องเย็น จำกัด (สาขาสระบุรี)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_responsibility`
--

CREATE TABLE `tb_site_responsibility` (
  `id_site_responsibility` int NOT NULL,
  `ref_id_user` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id_site` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางอ้างอิงช่างซ่อมผูกกับใบงานไซค์ไหน';

--
-- Dumping data for table `tb_site_responsibility`
--

INSERT INTO `tb_site_responsibility` (`id_site_responsibility`, `ref_id_user`, `ref_id_site`) VALUES
(1, '3', '7'),
(2, '3', '1'),
(3, '3', '3'),
(4, '176', '7'),
(5, '176', '1'),
(6, '176', '3'),
(7, '178', '1'),
(8, '179', '1'),
(9, '180', '3'),
(10, '181', '8'),
(11, '182', '1');

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
(1, 13, 'บริษัท ยูธว์ เทค จำกัด', '0924191939', '0924191939 คุณ xx', 1),
(2, 13, 'Tigersoft (1998) Co., Ltd.', '0234703748', '02-347-0373 คุณ xxx', 1),
(3, 13, 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', '0271040400', 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', 1),
(4, 7, 'บริษัท เอ็กซ์ เอ็ม เค (ประเทศไทย) จำกัด', '0123456799', 'บริษัท เอ็กซ์ เอ็ม เค (ประเทศไทย) จำกัด', 1),
(5, 8, 'บริษัท ชูโฟทิค จำกัด', '0244511233', '', 2);

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
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_token` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` int DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_user` int NOT NULL COMMENT '1>ผู้ใช้ระบบ2>ช่างซ่อม3>หัวหน้าช่าง4>ผจก5>ผู้จัดการระบบ',
  `ref_id_site` int DEFAULT NULL COMMENT 'ไซต์',
  `ref_id_dept` int DEFAULT NULL COMMENT 'แผนก',
  `ref_id_position` int DEFAULT NULL COMMENT 'ตำแหน่ง',
  `status_user` int NOT NULL COMMENT '1-ใช้งาน/2-ระงับ',
  `create_date` datetime NOT NULL,
  `ref_id_user_add` int NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `ref_id_user_edit` int DEFAULT NULL,
  `latest_login` datetime DEFAULT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ตารางเก็บข้อมูลผู้ใช้งานทุกระดับ';

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `no_user`, `password`, `email`, `line_token`, `fullname`, `sex`, `phone`, `photo`, `class_user`, `ref_id_site`, `ref_id_dept`, `ref_id_position`, `status_user`, `create_date`, `ref_id_user_add`, `edit_date`, `ref_id_user_edit`, `latest_login`, `ip_address`) VALUES
(3, '6501278', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sopon.g@jwdcoldchain.com', NULL, 'Sopon G.', 1, NULL, NULL, 5, 99, 13, 1, 1, '2023-02-02 06:48:06', 1, NULL, NULL, NULL, NULL),
(113, '1234567', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'somchai@jwdcoldchain.com', NULL, 'สมชาย ห้องเห็น', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(114, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Anucha.u@jwdcoldchain.com', NULL, 'Anucha Urapen', 1, NULL, NULL, 5, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(115, '9999999', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'it@jwdcoldchain.com', NULL, 'IT-support-PCS', 1, NULL, NULL, 3, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(116, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'stanutty90@gmail.com', NULL, 'thawatchai srichandaeng', 1, NULL, NULL, 3, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(117, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'stanutty10@gmail.com', NULL, 'Nddjdhd Ddhdh', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(118, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'linda.n@jwdcoldchain.com', NULL, 'Linda Nontanum', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(119, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sawitchaya.k@jwdcoldchain.com', NULL, 'Sawitchaya Kalyanamitra', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(120, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'amornthep.l@jwdcoldchain.com', NULL, 'Amornthep Lertthasanawong', 1, NULL, NULL, 3, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(121, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sandyhouse86@gmail.com', NULL, 'สุดารัตน์', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(122, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'eaknarin.t@cc.pcs-plp.com', NULL, 'เอกนรินทร์ ทิชาชาติ', 1, NULL, NULL, 2, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(123, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sittichoke.p@jwdcoldchain.com', NULL, 'สิทธิโชค เพียรประเสริฐกุล', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(124, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Thanunchai.p@jpk.co.th', NULL, 'ธนันชัย พงศ์สถาพร', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(125, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'songwuth.l@jwd-pacific.com', NULL, 'Songwuth Luasingkun', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(126, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'apiwan.s@jwdcoldchain.com', NULL, 'อภิวรรณ สำรวยประเสริฐ', 1, NULL, NULL, 3, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(127, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'thawatchai.srichandaeng@gmail.com', NULL, 'thawatchai srichandaeng', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(128, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'pim.k@jwdcoldchain.com', NULL, 'PIM KETKRAI', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(129, '0011144', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'thanwarat.k@jwdcoldchain.com', NULL, 'ธัญวรัตน์ เกียรติเสรีกุล', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(130, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'kullakan.s@jwdcoldchain.com', NULL, 'Kullakan Surattinaitham', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(131, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'treephop.m@jwdcoldchain.com', NULL, 'Treephop Meealum', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(132, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'nuttaphon.s@jwdcoldchain.com', NULL, 'Nuttaphon Sarapimpa', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(133, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'attendance@jwdcoldchain.com', NULL, 'Pornsikarn Pratarnporn', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(134, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'chalermphon.s@jwdcoldchain.com', NULL, 'Chalermphon Saenkla', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(135, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'uthai.a@jwdcoldchain.com', NULL, 'Uthai Ampa', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(136, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'training@jwdcoldchain.com', NULL, 'Maythaporn Sukprasuet', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(137, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'inthuon.p@jwdcoldchain.com', NULL, 'Inthuon Phuttha', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(138, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'plp@jwdcoldchain.com', NULL, 'Pacific Logistic Pro', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(139, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'supanna.p230135@gmail.com', NULL, 'Supanna sondong', 1, NULL, NULL, 2, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(140, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'nattakan.r@jwdcoldchain.com', NULL, 'Nattakan Rotsiravoraphat', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(141, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'customerservice@jwdcoldchain.com', NULL, 'Customer Service JWD Pacific Cold Chain', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(142, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'petcharat.p@jwdcoldchain.com', NULL, 'Petcharat Pengkhonsarn', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(143, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'autchara@gmail.com', NULL, 'Autchara pcs', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(144, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'tunyarat.p@jwdcoldchain.com', NULL, 'Tunyarat Panyaworatip', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(145, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'weesuda.k@pcs-plp.com', NULL, 'Weesuda Kamtone', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(146, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'qa@jwdcoldchain.com', NULL, 'QA JWD Pacific Cold Chain', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(147, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'weesuda.k@jwdcoldchain.com', NULL, 'Weesuda.k', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(148, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'pratit.w@jwdcoldchain.com', NULL, 'Pratit Wongphimaykham', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(149, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'wanlapa.m@JWDCOLDCHAIN.COM', NULL, 'Wanlapa mathmontree', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(150, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'qa.pcs@jwdcoldchain.com', NULL, 'QA', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(151, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'pathom.c@jwdcoldchain.com', NULL, 'ปฐม ชิ้นปิ่นเกลียว', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(152, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'suwanna.k@jwdcoldchain.com', NULL, 'Suwanna K.', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(153, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sudarat.n@cc.pcs-plp.com', NULL, 'miki2', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(154, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'chitchanok.s@jpk.co.th', NULL, 'ชิดชนก สุกิจวิมล', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(155, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'chaiwoot.c@jwdcoldchain.com', NULL, 'Chaiwoot Charoenfuangfu', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(156, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Namkang.J.@cc.pcs-plp.com', NULL, 'น้ำค้าง จอมประเสริฐ', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(157, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Namkang.J@cc.pcs-plp.com', NULL, 'น้ำค้าง จอมประเสริฐ', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(158, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'atthapol.i@jwdcoldchain.com', NULL, 'อรรถพล เอี่ยมจาตุ', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(159, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Admin.hr@jwdcoldchain.com', NULL, 'เมธาพร', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(160, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'siriwat.m@jwdcoldchain.com', NULL, 'นายสิริวัฑฒ์ มูลทองลี', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(161, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'suphanne.p@jwdcoldchain.com', NULL, 'สุพรรณี พิสฐศาสน์', 1, NULL, NULL, 1, 1, 3, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(162, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'autcharapk@gmail.com', NULL, 'Autcharapcs', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(163, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'engineer@jpk.co.th', NULL, 'wuttisak koonpho', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(164, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'cs-jpac@jwd-pacific.com', NULL, 'มัทรี', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(165, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Laddawa.s@jwd-pacific.com', NULL, 'น.ส.ลัดดาวัลย์ ศรีเสงี่ยม', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(167, '6601009', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'mitipol@jwdcoldchain.com', NULL, 'มิติพล โยคณิตย์', 1, NULL, NULL, 2, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(176, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'enuser1@pcs-plp.com', NULL, 'หัวหน้าช่าง (ไอดีทดสอบ)', NULL, NULL, NULL, 3, 99, 7, NULL, 1, '2023-03-21 16:49:30', 3, NULL, NULL, NULL, NULL),
(178, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'usertest1@pcs-plp.com', NULL, 'PCS WH', NULL, NULL, NULL, 1, 1, 5, NULL, 1, '2023-03-21 17:01:51', 3, NULL, NULL, NULL, NULL),
(179, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'usertest2@pcs-plp.com', NULL, 'TEST HR', NULL, NULL, NULL, 1, 1, 2, NULL, 1, '2023-03-22 13:11:10', 3, NULL, NULL, NULL, NULL),
(180, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'userpact1@pcs-plp.com', NULL, 'PACT WH', NULL, NULL, NULL, 1, 3, 5, NULL, 1, '2023-03-22 13:25:12', 3, NULL, NULL, NULL, NULL),
(181, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'userpacs1@pcs-plp.com', NULL, '', NULL, NULL, NULL, 1, 8, 5, NULL, 1, '2023-03-22 13:33:48', 3, NULL, NULL, NULL, NULL),
(182, '0000000', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'usertest3@pcs-plp.com', NULL, '', NULL, NULL, NULL, 1, 1, 5, NULL, 1, '2023-03-23 15:05:07', 3, NULL, NULL, NULL, NULL);

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
  ADD KEY `ref_id_machine` (`ref_id_used`);

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
-- Indexes for table `tb_change_parts`
--
ALTER TABLE `tb_change_parts`
  ADD PRIMARY KEY (`id_parts`),
  ADD KEY `idx_ref_id_requestid` (`ref_id_maintenance_request`);

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
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tb_machine_master`
--
ALTER TABLE `tb_machine_master`
  ADD PRIMARY KEY (`id_machine`),
  ADD KEY `machine_code` (`machine_code`) USING BTREE;

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
-- Indexes for table `tb_maintenance_request`
--
ALTER TABLE `tb_maintenance_request`
  ADD PRIMARY KEY (`id_maintenance_request`),
  ADD KEY `maintenance_request_no` (`maintenance_request_no`);

--
-- Indexes for table `tb_maintenance_type`
--
ALTER TABLE `tb_maintenance_type`
  ADD PRIMARY KEY (`id_mt_type`);

--
-- Indexes for table `tb_outsite_repair`
--
ALTER TABLE `tb_outsite_repair`
  ADD PRIMARY KEY (`id_outsite_repair`);

--
-- Indexes for table `tb_permission`
--
ALTER TABLE `tb_permission`
  ADD PRIMARY KEY (`id_permission`);

--
-- Indexes for table `tb_ref_repairer`
--
ALTER TABLE `tb_ref_repairer`
  ADD PRIMARY KEY (`id_ref_repairer`);

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
-- Indexes for table `tb_repair_result`
--
ALTER TABLE `tb_repair_result`
  ADD PRIMARY KEY (`id_repair_result`);

--
-- Indexes for table `tb_satisfaction_survey`
--
ALTER TABLE `tb_satisfaction_survey`
  ADD PRIMARY KEY (`id_survey`);

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
  MODIFY `id_building` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `tb_caused_by_code`
--
ALTER TABLE `tb_caused_by_code`
  MODIFY `id_caused_by_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_change_parts`
--
ALTER TABLE `tb_change_parts`
  MODIFY `id_parts` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_location` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_machine_master`
--
ALTER TABLE `tb_machine_master`
  MODIFY `id_machine` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1479;

--
-- AUTO_INCREMENT for table `tb_machine_responsibility`
--
ALTER TABLE `tb_machine_responsibility`
  MODIFY `id_mc_responsibility` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_machine_site`
--
ALTER TABLE `tb_machine_site`
  MODIFY `id_machine_site` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_maintenance_request`
--
ALTER TABLE `tb_maintenance_request`
  MODIFY `id_maintenance_request` int NOT NULL AUTO_INCREMENT COMMENT 'ID ใบแจ้งซ่อม', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_maintenance_type`
--
ALTER TABLE `tb_maintenance_type`
  MODIFY `id_mt_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_outsite_repair`
--
ALTER TABLE `tb_outsite_repair`
  MODIFY `id_outsite_repair` int NOT NULL AUTO_INCREMENT COMMENT 'ไอดีซ่อมภายนอก';

--
-- AUTO_INCREMENT for table `tb_permission`
--
ALTER TABLE `tb_permission`
  MODIFY `id_permission` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_ref_repairer`
--
ALTER TABLE `tb_ref_repairer`
  MODIFY `id_ref_repairer` int NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tb_repair_result`
--
ALTER TABLE `tb_repair_result`
  MODIFY `id_repair_result` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satisfaction_survey`
--
ALTER TABLE `tb_satisfaction_survey`
  MODIFY `id_survey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_site`
--
ALTER TABLE `tb_site`
  MODIFY `id_site` int NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไซต์', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_site_responsibility`
--
ALTER TABLE `tb_site_responsibility`
  MODIFY `id_site_responsibility` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

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
