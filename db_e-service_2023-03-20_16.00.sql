-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2023 at 08:58 AM
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
(1, 15, NULL, '24cb64d9c45a4a611684cb61ef901727.jpg', 1, 0),
(2, 6, NULL, '0ac579411ce05e419b31190e9d68ae9d.jpg', 1, 2),
(3, 6, NULL, '63ea5fff9b861f36674361782014dbe4.gif', 1, 2),
(4, 7, NULL, 'bd50605731f46e8a754a688a06706359.jpg', 1, 2),
(5, 7, NULL, '1cf1c94c48f5c74b9730a920ea80597d.gif', 1, 2),
(6, 8, NULL, '414f9f158473d1c0eec4afe7d3ad3daa.jpg', 1, 2),
(7, 8, NULL, '021151a179e0b17c5febbc58c1a99ca1.gif', 1, 2),
(8, 9, NULL, 'a580f20a3e2c05404a0e38c1ac50eeb8.jpg', 1, 2),
(9, 9, NULL, 'f0aec007928fe2adcd859023dfb33096.gif', 1, 2),
(10, 10, NULL, '96e09dce32ad5b323efe597a3528c6b5.jpg', 1, 2),
(11, 10, NULL, 'ef09a9afbf6c14673716b9d3c206659b.gif', 1, 2),
(12, 11, NULL, '71ee88a4b79e8add6963077e9b95836c.jpg', 1, 2),
(13, 11, NULL, '45c32539549a9e181dcb3348ecfb9ff7.jpg', 1, 2),
(14, 11, NULL, '1dd2c080788deed2f0b8aa6f64a7865d.jpg', 1, 2),
(15, 11, NULL, '8576d1211d7f2c8735fc873f808368e1.jpg', 1, 2),
(16, 11, NULL, '19e315d75a4ff195a249e8776518bdff.jpg', 1, 2),
(17, 12, NULL, '100509df16b0507766e0179b4aab075b.jpg', 1, 2),
(18, 12, NULL, 'dd0fbec6421ab9eceb5c2e5831c6df16.jpg', 1, 2),
(19, 12, NULL, '9ad8b826aac7b1490c760e548354744f.jpg', 1, 2),
(20, 12, NULL, 'e2225ce4ac0b241e8398e3e2f0f83da0.jpg', 1, 2),
(21, 12, NULL, '402c77b56da0c77d831fbcb5d93a7328.jpg', 1, 2),
(22, 13, NULL, 'cdfe3b991a4bf0fb400e4238cd971bd2.jpg', 1, 2),
(23, 13, NULL, 'a54f9b4d5a2fac26fcb4f448e50e3f9f.jpg', 1, 2),
(24, 13, NULL, '9579610004627917a0dd66101c975aea.jpg', 1, 2),
(25, 13, NULL, '6926ff25121e75e30ffc1591f0910167.jpg', 1, 2),
(26, 13, NULL, '3784330ff9c600f956c2906bb3bf498c.jpg', 1, 2),
(27, 14, NULL, 'e3a9142292d6782277e88ffb0e413be7.jpg', 1, 2),
(28, 14, NULL, '081730ac990b7acd22b8565ea7cc0aa2.jpg', 1, 2),
(29, 14, NULL, '34b39da30f432dbe6331289dea78d1f0.jpg', 1, 2),
(30, 14, NULL, '8896338b8ca928eabe694f9a1d00b8a7.jpg', 1, 2),
(31, 14, NULL, '293a91d4065f2ffe480ad65807c807ab.jpg', 1, 2),
(32, 18, NULL, 'a071ca674663dbf0ed08456fee92df3b.jpg', 1, 2),
(33, 18, NULL, 'ba4cff0ce776be6c0dd5e515d527c210.jpg', 1, 2),
(34, 18, NULL, '7ee4dc0193ca3c68a9f94ab7ac46c8fd.jpg', 1, 2),
(38, 19, NULL, '2b590c901a6e1eb49f1150c2c8ed7c56.jpg', 1, 2),
(39, 19, NULL, '31cef6b8e1fa74b6c6e705c5c1818cf8.jpg', 1, 2),
(40, 19, NULL, 'f9cf6f451d5fced332b95bb55b85f68f.jpg', 1, 2),
(41, 19, NULL, '97e7b58e10588b2c0c19581762463d9f.jpg', 1, 2),
(43, 20, NULL, '17fd851949ad4e6d25a63ac487aecb17.jpg', 1, 2),
(44, 20, NULL, '7b6d4408dfee52095e2d8f8b07ffc36c.jpg', 1, 2),
(45, 20, NULL, 'ca81d244ffd322171250795e397133cc.jpg', 1, 2),
(46, 20, NULL, 'f289836c5fc2b95db65b6ff8c8708862.jpg', 1, 2),
(47, 20, NULL, '6363b303e7154594bbe7a9d6f5632e1a.jpg', 1, 2),
(48, 20, NULL, '32a73703dfa5bcd641cbfa3eba211003.jpg', 1, 2),
(49, 21, NULL, '55b01554b1f1acb9bfc911821ed16ee1.jpg', 1, 2),
(50, 21, NULL, 'cca223d1de7203f38e999a5a1a0a11da.jpg', 1, 2),
(51, 21, NULL, 'c3058715af570c6f8eb332798b4fecd8.jpg', 1, 2),
(52, 21, NULL, 'f59df487fe8a838350897946d0d29b02.jpg', 1, 2),
(53, 21, NULL, '4ca90047b978dbcf46d424bea2442dac.jpg', 1, 2),
(54, 21, NULL, '480eddbb90d8ca3d309114643f853e92.jpg', 1, 2),
(55, 26, NULL, '8a5c3fcf51f4c6294d4f34cf820e1f43.jpg', 1, 2),
(56, 26, NULL, '0d088cf58b9f0b62a6e176e327254ee9.jpg', 1, 2),
(57, 28, NULL, 'd7d8549847a4dc38402df2c69089489c.jpeg', 1, 2),
(59, 47, NULL, 'a825b03c42571a4fcc0efd12026a7c4f.jpg', 1, 3),
(60, 47, NULL, '397f655b121a5ec976c1ed5757fd64be.jpg', 1, 3),
(61, 47, NULL, '515a06542552b3d3efe857079dbb8542.jpg', 1, 3),
(62, 47, NULL, '5d86ee484f8b3b5d680588e57beb2595.jpg', 1, 3),
(63, 19, NULL, '040571ac4cd971babc8e4dbb4450807b.jpg', 1, 3),
(64, 19, NULL, 'a82df5b9c9e348a6c33656fc013c65ac.jpg', 1, 3),
(65, 19, NULL, 'fcb08cd86e371815609276e491dca4bf.jpg', 1, 3),
(66, 19, NULL, 'd2f7fc5d31bf68e0e32d9ea934327d4b.jpg', 1, 3),
(69, 19, NULL, 'f7d649b6fd060dd1d4b0dd9e5bc39aa2.jpg', 1, 3),
(70, 6, NULL, '9dfe82ad78e7365c526aaf77035ba19e.jpg', 1, 3),
(71, 6, NULL, '4427f1908657778ca9ce828b2e1c1659.jpg', 1, 3),
(72, 19, NULL, 'fada63614287f6a362721bbba9b13986.jpg', 1, 3),
(73, 19, NULL, 'b775fccff6534df3978ba0d3dc654d2c.jpg', 1, 3),
(74, 19, NULL, 'ecb1875a213031668a0025deab5d0bac.jpg', 1, 3),
(75, 19, NULL, '41c870462921652c5086fe1b904e47a2.jpg', 1, 3),
(76, 19, NULL, '761837e4ab6f06a8a00c2c8a32c32426.jpg', 1, 3),
(77, 19, NULL, 'e6bb6968e80e53ee3c111b3b9cf877c7.jpg', 1, 3),
(78, 19, NULL, '235e559adb634119ff548e97830a2421.jpg', 1, 3),
(79, 19, NULL, '7ab53808c8a9665f907f8b5123928fe4.jpeg', 1, 3);

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
(3, 1, NULL, 'PCS - อาคาร 3', 1),
(4, 1, NULL, 'PCS - อาคาร 4', 1),
(5, 1, NULL, 'PCS - อาคาร 5', 1),
(6, 1, NULL, 'PCS - อาคาร 6', 1),
(7, 1, NULL, 'PCS - อาคาร 7', 1),
(8, 1, NULL, 'PCS - อาคาร 8', 1),
(9, 1, NULL, 'PCS - อาคาร 9', 1),
(10, 2, NULL, 'อาคาร A', 1),
(11, 2, NULL, 'อาคาร B', 1),
(12, 2, NULL, 'อาคาร C', 1);

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
(21, NULL, 1, NULL, NULL, NULL, 7, 'Compressor (คอมเพรสเซอร์)', NULL, '2023-01-06 00:00:00', 1, NULL, NULL, 1),
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
(89, 'NTB', 1, NULL, NULL, NULL, 13, 'Notebook', 'รวมทุกแบรนด์', '2023-01-18 08:25:19', 1, NULL, NULL, 1),
(90, 'PTL', 2, NULL, 80, NULL, 13, 'เครื่องพิมพ์เลเซอร์', 'เครื่องพิมพ์เลเซอร์', '2023-01-23 11:20:51', 1, NULL, NULL, 1),
(91, 'PTI', 2, NULL, 80, NULL, 13, 'เครื่องพิมพ์อิงค์เจ็ต', 'เครื่องพิมพ์อิงค์เจ็ต', '2023-01-23 11:21:39', 1, NULL, NULL, 1),
(92, 'COM', 1, NULL, NULL, NULL, 13, 'คอมพิวเตอร์ PC', NULL, '2023-01-24 08:41:30', 1, NULL, NULL, 1),
(93, 'ARE', 1, NULL, NULL, NULL, 7, 'Area (พื้นที่)', 'Area (พื้นที่)', '2023-02-28 11:48:17', 3, NULL, NULL, 1),
(94, 'ROM', 1, NULL, NULL, NULL, 7, 'Room (ห้อง)', 'Room (ห้อง)', '2023-02-28 11:49:17', 3, NULL, NULL, 1),
(95, 'BLD', 1, NULL, NULL, NULL, 7, 'Building (อาคาร, สิ่งปลูกสร้าง)', 'Building (อาคาร, สิ่งปลูกสร้าง)', '2023-02-28 11:50:08', 3, NULL, NULL, 1),
(96, 'TRK', 1, NULL, NULL, NULL, 7, 'Truck (รถบรรทุก)', 'Truck (รถบรรทุก)', '2023-03-02 13:47:19', 3, NULL, NULL, 1);

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

--
-- Dumping data for table `tb_change_parts`
--

INSERT INTO `tb_change_parts` (`id_parts`, `ref_id_maintenance_request`, `parts_serialno`, `parts_name`, `parts_description`, `parts_price`, `parts_qty`, `date_parts_change`, `ref_id_user_change`, `date_adddata`) VALUES
(1, 19, '11', '22', '33', 44.44, 55, '2023-03-14 00:00:00', 3, '2023-03-14 17:45:53'),
(2, 19, '1123479ADWX111', 'RAM DDR4 Kingtons BUS2600 / 8Gb', 'RAM DDR4 Kingtons BUS2600 / 8Gb', 1260, 1, '2023-03-14 00:00:00', 3, '2023-03-14 17:46:52'),
(3, 47, '001AD123DDSF', 'HDD SSD Kingson 240GB', 'HDD SSD Kingson 240GB ประกัน COM7', 996, 1, '2023-03-14 00:00:00', 3, '2023-03-15 08:01:39'),
(4, 19, 'DSFW454AW112', 'RAM DDR4 BUS 2400MHz KINGTONS 8GB.', 'RAM DDR4 BUS 2400MHz KINGTONS 8GB. ประกัน Lifetime ปี', 1250, 1, '2023-03-15 00:00:00', 3, '2023-03-15 08:27:51');

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
(8, 'EN', 2, 'ฝ่ายวิศวกรรม', 1),
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
(341, 1, 8, NULL, 'PCS อาคาร 8', 1),
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
(418, 1, 8, NULL, 'ห้องน้ำหญิง ชั้น 2 (ยกเลิก)', 2);

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
(1, 'IT-AS-0002', 13, 92, NULL, 'Dell OptiPlex 3050', 'Dell OptiPlex 3050', 'CPU :Core i5-7500 3.4GHz\r\n✅RAM : 4GB\r\n✅ความจุ : SSD 120GB\r\n✅windows 10\r\n✅DVD\r\n✅USB\r\n✅USB3.0\r\n✅Display\r\n✅HDMI', '2023-01-17 16:06:11', 1, '2023-01-24 08:41:52', 1, 1),
(2, 'IT-AS-0001', 13, 89, NULL, 'Dell Latitude 3410-SNS3410008', 'DELL Latitude 3410', 'CPU : INTEL CORE I7-10510U\r\nRAM : 8 GB (8GB X1) DDR4 2667MHz\r\nSTORAGE : 1 TB 2.5\" 5400 RPM\r\nDISPLAY : 14\" HD ANTI-GLARE\r\nVGA : INTEGRATED UHD GRAPHICS\r\nOS : WINDOWS 10 PRO 64 BIT', '2023-01-17 16:09:05', 1, '2023-01-21 13:55:08', 1, 1),
(3, 'IT-AS-0003', 13, 87, NULL, 'CP04-AD', 'ไฟฉุกเฉิน LED CP04-AD', 'Emergency Light (ไฟฉุกเฉิน)', '2023-01-18 09:48:01', 1, '2023-01-23 08:32:10', 1, 1),
(5, 'MT-AS-0005', 7, 2, NULL, 'JM-072 Conveyor Washer', 'เครื่องล้างปลา (Conveyor clean fish)', 'JM-072 Conveyor Washer', '2023-01-18 10:25:19', 1, '2023-01-23 08:31:57', 1, 1),
(6, 'IT-AS-0007', 13, 92, NULL, 'Optiplex 7000 SFF', 'Dell Optiplex 7000 SFF i7', '(SNS70SF052) PC Dell Optiplex 7000 SFF i7-12700/16GB/512GB SSD/Win11Pro/3Yr.', '2023-01-21 11:20:00', 1, '2023-01-24 09:04:42', 1, 1),
(7, 'MT-AS-0007', 7, 15, NULL, 'CNS-305DN', 'รถแฮนด์ลิฟท์ CNS-305DN', 'รถยกลาก รับน้ำหนักได้ 3,000 กก. (3 ตัน)\r\nชนิดงาหน้าแคบ ขนาดงา 550 x 1,150 มม.\r\nงารับน้ำหนักได้ตามสเปก แข็งแรง ทนทานต่อการใช้งาน\r\nตัวรถผลิตจากเหล็กหนาคุณภาพ พ่นด้วยสีเหลือง\r\nล้อไนลอนหล่อทั้งลูก เข็นลื่น คล่องตัว ทนต่อการสึกหรอ และกัดกร่อนของสารเคมี เหมาะใช้บนพื้นเรียบหรือพื้นที่เปียกชื้น\r\nมือจับหุ้มยาง ใช้งานลากได้กระชับถนัดมือ\r\nออกแบบชุดจับยึดล้อช่วยให้เข้าพาเลทได้ง่าย\r\nฝาปั๊มสามารถปรับได้\r\nรับประกัน 2 ปี เฉพาะปั๊มไฮดรอลิก และรับประกัน 1 ปี ชิ้นส่วนอื่น ๆ (กรณีที่เกิดจากกระบวนการผลิตเท่านั้น)\r\nสีเหลือง', '2023-01-23 08:46:20', 1, '2023-01-23 08:46:32', 1, 1),
(8, 'IT-AS-0004', 13, 80, 90, 'HP LJ107A', 'เครื่องพิมพ์ ขาวดำ HP LJ107A', '* เครื่องพิมพ์ระบบเลเซอร์ขาว-ดำ\r\n* ความละเอียดในการพิมพ์ 1,200 x 1,200 dpi\r\n* ความเร็วการพิมพ์ 20 แผ่น/นาที\r\n* หน่วยความจำมาตรฐาน 64 MB\r\n* ช่องใส่กระดาษ ถาด 150 แผ่น\r\n* การเชื่อมต่อ : Hi-Speed USB 2.0 port\r\n* ผงหมึก 107A\r\n* ขนาด 33.1x21.5x17.8 ซม.', '2023-01-23 11:23:53', 1, NULL, NULL, 1),
(9, 'IT-AS-0005', 13, 80, 91, 'PIXMA G3020', 'เครื่องพิมพ์อิงค์เจ็ต Canon PIXMA G3020', 'พิมพ์ สแกน ถ่ายเอกสาร\r\nความเร็วการพิมพ์มาตรฐาน ISO (ขนาด A4): พิมพ์ขาวดำได้ถึง 9.1 ภาพต่อนาที และพิมพ์ภาพสีได้ 5.0 ภาพต่อนาที\r\nรองรับการเชื่อมต่อแบบไร้สาย (WI-FI), การเชื่อมต่อไร้สาย Pictbridge, การพิมพ์ผ่านมือถือ (MOPRIA), การพิมพ์จากอุปกรณ์ IOS (AIRPRINT), เชื่อมต่อตรงแบบไร้สาย (WI-FI DIRECT)\r\nปริมาณการพิมพ์ที่แนะนำ: 150 - 1,500 หน้า', '2023-01-23 11:54:47', 1, NULL, NULL, 1),
(10, 'IT-AS-0006', 13, 80, 90, 'Model Test Add 8.50 Edit 8.55', 'Test Add 8.50 Edit 8.55 / Change', 'Detail Test Add 8.50 Edit 8.55 / Change Dept. /', '2023-01-24 08:54:38', 1, '2023-01-24 08:58:08', 1, 1),
(11, 'IT-AS-0008', 13, 79, 81, 'SEAGATE BARRACUDA - 7200RPM SATA3 (ST500DM009)', 'SEAGATE SATA-3 BARRACUDA', '• 500 GB\r\n• 32 MB Cache\r\n• 7200 RPM\r\n• SATA 3\r\n• Desktop Hard Drive\r\n• CMR Technology', '2023-01-30 15:05:50', 1, '2023-01-30 15:07:46', 1, 1),
(12, 'IT-AS-0009', 13, 79, 81, 'PC N300', 'Toshiba HDD PC N300 6TB 7200RPM SATA lll', 'Toshiba HDD PC N300 6TB 7200RPM SATA lll (6GB) 256MB for NAS - 3 Year', '2023-01-31 13:54:58', 1, '2023-01-31 13:57:00', 1, 1),
(13, 'MT-AS-0008', 7, 21, NULL, 'AA-BB-CC-1234', 'คอมเพรสเซอร์', NULL, '2023-02-03 17:44:23', 3, '2023-02-03 17:45:57', 3, 1),
(14, 'MT-AS-0009', 7, 94, NULL, NULL, 'ห้องน้ำชายชั้น 3 อ.8', 'ห้องน้ำชายชั้น 3 อ.8', '2023-02-28 11:51:07', 3, NULL, NULL, 1),
(15, 'MT-AS-0010', 7, 1, NULL, 'test', 'test', 'test', '2023-03-07 09:24:25', 3, NULL, NULL, 1);

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
(1, 'IT-AS-0007-0001', 'FEWF1234554DSF1123', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:54:31', 1, NULL, NULL, 1),
(2, 'IT-AS-0007-0002', 'FEWF1234554DSF4236', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:54:44', 1, NULL, NULL, 1),
(3, 'IT-AS-0007-0003', 'FEWF1234554DSF4451', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:54:45', 1, NULL, NULL, 1),
(4, 'IT-AS-0007-0004', 'FEWF1234554DSF1188', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:55:17', 1, NULL, NULL, 1),
(5, 'IT-AS-0007-0005', 'FEWF1234554DSF5744', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:55:21', 1, NULL, NULL, 1),
(6, 'Not found.', 'SAWD1234554DSF5744', '2023-01-27 00:00:00', 6, 4, NULL, 1, NULL, 1, 'test Add test add', '2023-01-27 14:55:26', 1, '2023-02-16 17:50:01', 3, 1),
(7, 'Not found.', 'SAWD1234554DSF5222', '2023-01-27 00:00:00', 6, 6, 326, 1, NULL, 1, 'test Add test add', '2023-01-27 14:55:29', 1, '2023-02-16 17:49:43', 3, 1),
(8, 'IT-AS-0007-0008', 'SAWD1234554DSF5475', '2023-01-27 00:00:00', 6, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:55:34', 1, NULL, NULL, 1),
(9, 'IT-AS-0002-0001', 'PCADDF11211111', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:20', 1, NULL, NULL, 1),
(10, 'IT-AS-0002-0002', 'PCADDF11211112', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:24', 1, NULL, NULL, 1),
(11, 'IT-AS-0002-0003', 'PCADDF11211113', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:26', 1, NULL, NULL, 1),
(12, 'IT-AS-0002-0004', 'PCADDF11211114', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:28', 1, NULL, NULL, 1),
(13, 'IT-AS-0002-0005', 'PCADDF11211115', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:30', 1, NULL, NULL, 1),
(14, 'IT-AS-0002-0006', 'PCADDF11211116', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:32', 1, NULL, NULL, 1),
(15, 'IT-AS-0002-0007', 'PCADDF11211117', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:34', 1, NULL, NULL, 1),
(16, 'IT-AS-0002-0008', 'PCADDF11211118', '2023-01-27 00:00:00', 1, 8, 416, 1, NULL, NULL, 'test Add test add', '2023-01-27 14:57:36', 1, NULL, NULL, 1),
(17, 'IT-AS-0005-0001', 'QWEE112343', '2023-01-27 00:00:00', 9, NULL, 407, 1, NULL, NULL, 'test add add test', '2023-01-27 15:48:02', 1, NULL, NULL, 1),
(18, 'MT-AS-0007-0001', NULL, '2023-01-27 00:00:00', 7, 4, NULL, 1, NULL, NULL, NULL, '2023-01-27 17:11:36', 1, NULL, NULL, 1),
(19, 'IT-AS-0003-0001', NULL, '2023-01-27 00:00:00', 3, 8, 355, 1, NULL, NULL, 'ให้ในห้องเซิฟเวอร์', '2023-01-27 17:16:24', 1, NULL, NULL, 1),
(20, 'IT-AS-0001-0001', NULL, '2023-01-27 00:00:00', 2, NULL, 208, 1, NULL, NULL, 'test', '2023-01-27 17:21:01', 1, NULL, NULL, 1),
(21, 'IT-AS-0001-0002', NULL, '2023-01-27 00:00:00', 2, NULL, NULL, 3, NULL, NULL, NULL, '2023-01-27 17:24:32', 1, NULL, NULL, 1),
(22, 'IT-AS-0008-0002', 'HD12345789000', '2023-01-30 00:00:00', 11, NULL, NULL, 1, NULL, 1, 'เทสเปลี่ยนแผนก เปลี่ยนหมวดเครื่องจักร สร้างโค๊ดใหม่', '2023-01-30 08:43:50', 1, '2023-01-31 15:13:33', 1, 1),
(23, 'IT-AS-0008-0001', 'ST500DM009', '2023-01-30 00:00:00', 11, NULL, 208, 1, 1, 1, 'test', '2023-01-30 15:06:30', 1, NULL, NULL, 1),
(24, 'IT-AS-0003-0002', NULL, '2023-01-31 00:00:00', 3, NULL, NULL, 1, 2, 1, NULL, '2023-01-31 09:24:01', 1, NULL, NULL, 1),
(25, 'MT-AS-0008-0001', NULL, '2023-02-03 00:00:00', 13, 4, NULL, 1, 4, 1, NULL, '2023-02-03 17:50:24', 3, NULL, NULL, 1),
(26, 'MT-AS-0005-0001', NULL, '2023-02-28 00:00:00', 5, 5, NULL, 1, 4, 1, 'ย้ายมาจาก อ.8', '2023-02-28 10:54:24', 3, NULL, NULL, 1),
(27, 'MT-AS-0009-0001', NULL, '2023-02-28 00:00:00', 14, 8, 417, 1, 3, 1, NULL, '2023-02-28 11:51:53', 3, NULL, NULL, 1),
(28, 'IT-AS-0007-0007', '001123456', '2023-03-14 00:00:00', 6, NULL, NULL, 1, 3, 1, 'test', '2023-03-14 09:53:16', 3, NULL, NULL, 1);

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
(1, 'MT-FM-IT-2302-0001', 7, 1, 13, '2023-02-21 14:01:17', 118, 21, 7, 0, 3, NULL, '2023-02-22 14:27:24', NULL, NULL, 1, 'ทดสอบแจ้งซ่อม', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ทดสอบระบบ', '2023-02-23 15:55:53', 113, 2),
(2, 'MT-FM-MT-2302-0001', 7, 1, 7, '2023-02-21 14:11:58', 118, 18, 5, 0, 3, NULL, '2023-02-27 15:53:19', NULL, NULL, 2, ' test test test test test test', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'MT-FM-IT-2302-0002', 7, 1, 13, '2023-02-27 11:09:01', 113, 24, 8, 0, 3, NULL, '2023-03-04 15:49:09', NULL, NULL, 1, ' test test test test test test', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'IT-FM-MT-2302-0001', 13, 1, 7, '2023-02-28 10:55:41', 3, 26, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'โซ่ลำเลียงหย่อน ทำให้สายพานช้า', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'IT-FM-MT-2302-0002', 13, 1, 7, '2023-02-28 11:52:52', 3, 27, 4, 0, 3, NULL, '2023-03-08 13:37:16', NULL, NULL, 1, 'ก๊อกน้ำปิดไม่สนิท มีน้ำหยดตลอดเวลา', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'IT-FM-MT-2303-0001', 13, 1, 7, '2023-03-07 13:36:34', 3, 18, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'gdfgfd', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 'IT-FM-MT-2303-0002', 13, 1, 7, '2023-03-07 13:36:45', 3, 18, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'gdfgfd', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 'IT-FM-MT-2303-0003', 13, 1, 7, '2023-03-07 13:37:06', 3, 18, 4, 1, 3, NULL, '2023-03-09 09:03:21', NULL, NULL, 1, 'xxxxxxxxxx', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 'IT-FM-MT-2303-0004', 13, 1, 7, '2023-03-07 13:37:10', 3, 18, 0, 1, 3, NULL, '2023-03-09 09:01:27', NULL, NULL, 1, 'gdfgfd', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, 'IT-FM-MT-2303-0005', 13, 1, 7, '2023-03-07 13:37:18', 3, 18, 0, 1, 3, NULL, '2023-03-09 08:54:18', NULL, NULL, 1, 'gdfgfd', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '**แก้ไข / ทดสอบ กรอกข้อเสนอแนะ', 3, '2023-03-20 14:04:45', NULL, NULL, NULL, NULL, 1),
(11, 'IT-FM-MT-2303-0006', 13, 1, 7, '2023-03-07 13:46:19', 3, 26, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'สายพานไม่เลื่อน', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, 'IT-FM-MT-2303-0007', 13, 1, 7, '2023-03-07 13:46:34', 3, 26, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'สายพานไม่เลื่อน', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, 'IT-FM-MT-2303-0008', 13, 1, 7, '2023-03-07 13:46:52', 3, 26, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'สายพานไม่เลื่อน', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 'IT-FM-MT-2303-0009', 13, 1, 7, '2023-03-07 13:48:39', 3, 26, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'สายพานไม่เลื่อน', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, 'IT-FM-IT-2303-0001', 13, 1, 13, '2023-03-07 14:09:39', 3, 20, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ทดสอบแจ้งซ่อม แนบรูป', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2023-03-20 13:51:27', NULL, NULL, NULL, NULL, 1),
(16, 'IT-FM-IT-2303-0002', 13, 1, 13, '2023-03-07 14:09:49', 3, 8, 0, 1, 3, NULL, '2023-03-08 17:44:40', NULL, NULL, 1, 'ทดสอบแก้ไขอาการเสีย/ปัญหาที่พบ', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 'IT-FM-MT-2303-0010', 13, 1, 7, '2023-03-07 14:10:09', 3, 18, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ทดสอบแจ้งซ่อม แนบรูป', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, 'IT-FM-MT-2303-0011', 13, 1, 7, '2023-03-07 14:10:46', 3, 18, 6, 1, 3, NULL, '2023-03-08 16:45:23', NULL, NULL, 1, '', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(19, 'IT-FM-MT-2303-0012', 13, 1, 7, '2023-03-07 14:11:37', 3, 18, 0, 1, 114, NULL, '2023-03-09 14:30:20', '2023-03-14 17:30:32', 3, 1, 'ทดสอบแจ้งซ่อม แนบรูป', 1, 1, 0, NULL, NULL, '2023-03-15 08:28:24', NULL, NULL, NULL, 'ทดสอบแก้ไข 2 / 3', 3, '2023-03-20 14:38:59', NULL, NULL, NULL, NULL, 1),
(20, 'IT-FM-MT-2303-0013', 13, 1, 7, '2023-03-07 14:19:05', 3, 18, 4, 1, 3, NULL, '2023-03-08 14:30:38', NULL, NULL, 1, 'test edit แจ้งซ่อมออนไลน์ เป็นโปรแกรมสำหรับ จัดการงานซ่อมบำรุงออนไลน์ ภายในองค์กร สามารถบริหารจัดการงานซ่อมบำรุง บันทึกข้อมูลการทำงาน รับแจ้งซ่อมจากผู้ใช้งาน บันทึกทะเบียนอุปกรณ์ประวัติและค่าใช้จ่ายการซ่อม วางแผนบำรุงรักษา PM ประเมินความพึงพอใจหลังรับบริการ และ ระบบรายงานที่สรุปข้อมูลต่าง ๆ ที่เกี่ยวกับการซ่อมบำรุง', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, 'IT-FM-IT-2303-0003', 13, 1, 13, '2023-03-09 11:13:30', 3, 24, 9, 1, 3, NULL, '2023-03-09 11:24:38', '2023-03-09 13:23:55', 114, 1, 'กล่องปิดไม่ได้ Edit test', 1, 1, 0, NULL, NULL, '2023-03-09 14:00:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, 'IT-FM-IT-2303-0004', 13, 1, 13, '2023-03-14 09:53:51', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'เปิดไม่ติด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 'IT-FM-IT-2303-0005', 13, 1, 13, '2023-03-14 09:54:03', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'เปิดไม่ติด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, 'IT-FM-IT-2303-0006', 13, 1, 13, '2023-03-14 09:55:51', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'เปิดไม่ติด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, 'IT-FM-IT-2303-0007', 13, 1, 13, '2023-03-14 10:01:01', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'test xxxxx', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(26, 'IT-FM-IT-2303-0008', 13, 1, 13, '2023-03-14 10:01:59', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'test xxxxx', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, 'IT-FM-IT-2303-0009', 13, 1, 13, '2023-03-14 10:02:38', 3, 2, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'test', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(28, 'IT-FM-IT-2303-0010', 13, 1, 13, '2023-03-14 10:02:47', 3, 2, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'test', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 'IT-FM-IT-2303-0011', 13, 1, 13, '2023-03-14 10:32:55', 3, 1, 0, 0, 0, NULL, NULL, NULL, NULL, 1, '1234564654654', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 'IT-FM-IT-2303-0012', 13, 1, 13, '2023-03-14 10:33:31', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(31, 'IT-FM-IT-2303-0013', 13, 1, 13, '2023-03-14 10:33:55', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, 'IT-FM-IT-2303-0014', 13, 1, 13, '2023-03-14 10:34:21', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 'IT-FM-IT-2303-0015', 13, 1, 13, '2023-03-14 10:34:29', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, 'IT-FM-IT-2303-0016', 13, 1, 13, '2023-03-14 10:34:38', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 'IT-FM-IT-2303-0017', 13, 1, 13, '2023-03-14 10:37:30', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, 'IT-FM-IT-2303-0018', 13, 1, 13, '2023-03-14 10:37:39', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 'IT-FM-IT-2303-0019', 13, 1, 13, '2023-03-14 10:37:52', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, 'IT-FM-IT-2303-0020', 13, 1, 13, '2023-03-14 10:38:16', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 'IT-FM-IT-2303-0021', 13, 1, 13, '2023-03-14 10:41:04', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, 'IT-FM-IT-2303-0022', 13, 1, 13, '2023-03-14 10:41:20', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 'IT-FM-IT-2303-0023', 13, 1, 13, '2023-03-14 10:41:40', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, 'IT-FM-IT-2303-0024', 13, 1, 13, '2023-03-14 10:42:20', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(43, 'IT-FM-IT-2303-0025', 13, 1, 13, '2023-03-14 10:42:27', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(44, 'IT-FM-IT-2303-0026', 13, 1, 13, '2023-03-14 10:42:54', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(45, 'IT-FM-IT-2303-0027', 13, 1, 13, '2023-03-14 10:43:05', 3, 28, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'ะำหะห ะำหฟหฟกด', 1, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(46, 'IT-FM-MT-2303-0014', 13, 1, 7, '2023-03-14 10:47:02', 3, 25, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'test xxxxxx', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, 'IT-FM-MT-2303-0015', 13, 1, 7, '2023-03-14 10:52:02', 3, 27, 0, 1, 3, NULL, '2023-03-15 08:02:25', '2023-03-15 08:02:46', 3, 1, 'test xxxx', 1, 1, 0, NULL, NULL, '2023-03-15 08:04:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

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

--
-- Dumping data for table `tb_outsite_repair`
--

INSERT INTO `tb_outsite_repair` (`id_outsite_repair`, `ref_id_maintenance_request`, `caused_outsite_repair`, `ref_id_supplier`, `datesent_repair`, `dateresive_repair`, `ref_id_user_update`, `datetime_update`) VALUES
(2, 21, 'เทสแก้ไข edit 1 2', '33sdf3', '2023-03-14 00:00:00', NULL, 3, '2023-03-14 08:53:03'),
(3, 19, 'ยังอยู่ในประกัน', 'Edit test 222 text', '2023-03-14 00:00:00', '2023-03-18 00:00:00', 3, '2023-03-18 10:05:22');

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
(12, 3, 3, 1);

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

--
-- Dumping data for table `tb_ref_repairer`
--

INSERT INTO `tb_ref_repairer` (`id_ref_repairer`, `ref_id_maintenance_request`, `ref_id_user_repairer`, `acknowledge_date`, `status_repairer`) VALUES
(1, 18, 117, NULL, 2),
(2, 18, 139, NULL, 2),
(3, 18, 127, NULL, 2),
(4, 18, 128, NULL, 2),
(5, 18, 117, NULL, 2),
(6, 18, 124, NULL, 1),
(7, 18, 123, NULL, 2),
(8, 18, 117, NULL, 2),
(9, 18, 128, NULL, 1),
(10, 18, 139, NULL, 2),
(11, 18, 116, NULL, 2),
(12, 16, 120, NULL, 2),
(13, 16, 114, NULL, 2),
(14, 16, 126, NULL, 2),
(15, 16, 167, NULL, 1),
(16, 8, 117, NULL, 2),
(17, 8, 128, NULL, 2),
(18, 8, 116, NULL, 2),
(19, 8, 124, NULL, 1),
(20, 8, 127, NULL, 1),
(21, 8, 123, NULL, 1),
(22, 21, 114, NULL, 1),
(23, 21, 167, NULL, 2),
(24, 21, 126, NULL, 1),
(25, 19, 139, NULL, 2),
(26, 19, 124, NULL, 1),
(27, 19, 123, NULL, 2),
(28, 47, 124, NULL, 1),
(29, 19, 139, NULL, 1),
(30, 19, 116, NULL, 1);

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

--
-- Dumping data for table `tb_repair_result`
--

INSERT INTO `tb_repair_result` (`id_repair_result`, `ref_id_maintenance_request`, `ref_id_failure_code`, `ref_id_repair_code`, `txt_caused_by`, `txt_solution`, `ref_id_user_report`, `report_date`, `edit_report_date`, `ref_id_user_edit`) VALUES
(1, 2, 'อัพเดท-พิมพ์แก้ไขเอง', 'อัพเดท-พิมพ์แก้ไขเอง', 'test', 'test', 3, '2023-03-04 13:31:45', '2023-03-04 13:48:12', 3),
(5, 3, '25', '2', 'ไดร์ฟเวอร์เสีย', 'ทำ PM', 3, '2023-03-04 15:41:44', '2023-03-04 15:46:54', 3),
(6, 20, '2', '2222ก24222', 'test edit 2', 'test edit 2', 3, '2023-03-07 15:32:16', '2023-03-07 16:03:36', 3),
(7, 19, 'แก้ไข + พิมพ์เอง 1', 'แก้ไข + พิมพ์เอง 2', 'สายไฟขาด ****แก้ไข', 'เปลี่ยนสายไฟ เทสๆ ***แก้ไข', 3, '2023-03-08 17:47:34', '2023-03-08 17:48:22', 3),
(8, 8, 'test / ** กกก 1234', 'test / ** กกก 1234', 'test', 'test', 3, '2023-03-09 09:55:43', '2023-03-09 09:58:19', 3),
(9, 14, '', 'test', '--- Edit ---  ทดสอบ test 123456 / 0001', '--- Edit ---  ทดสอบ test 123456 / 0001', 3, '2023-03-09 10:55:27', '2023-03-09 11:10:40', 3),
(10, 21, '22', '3', 'PSU เสีย ', 'ทำ PM ทุกเดือน', 114, '2023-03-09 14:23:10', '2023-03-13 17:07:55', 3),
(11, 47, 'เครื่องช้า', 'เปลี่ยน HDD เป็น SSD', 'HDD เสื่อมสภาพ', 'เปลี่ยน HDD เป็น SSD', 3, '2023-03-15 08:03:39', NULL, NULL);

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
(1, 13, 'บริษัท ยูธว์ เทค จำกัด', '0924191939', '0924191939 คุณ xx', 1),
(2, 13, 'Tigersoft (1998) Co., Ltd.', '0234703748', '02-347-0373 คุณ xxx', 1),
(3, 13, 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', '0271040400', 'บริษัท ไดนามิค ไอที โซลูชั่นส์ จำกัด', 1),
(4, 7, 'บริษัท เอ็กซ์ เอ็ม เค (ประเทศไทย) จำกัด', '0123456799', 'บริษัท เอ็กซ์ เอ็ม เค (ประเทศไทย) จำกัด', 1),
(5, 8, 'บริษัท ชูโฟทิค จำกัด', '0244511233', '', 1);

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
  `fullname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_user` int NOT NULL COMMENT '1>ผู้ใช้ระบบ2>ช่างซ่อม3>หัวหน้าช่าง4>ผู้จัดการระบบ',
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
(3, '6501278', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sopon.g@jwdcoldchain.com', NULL, 'Sopon G.', 1, NULL, NULL, 4, 1, 13, 1, 1, '2023-02-02 06:48:06', 1, NULL, NULL, NULL, NULL),
(113, '1234567', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'somchai@jwdcoldchain.com', NULL, 'สมชาย ห้องเห็น', 1, NULL, NULL, 1, 1, 7, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(114, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'Anucha.u@jwdcoldchain.com', NULL, 'Anucha Urapen', 1, NULL, NULL, 3, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
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
(126, '', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'apiwan.s@jwdcoldchain.com', NULL, 'อภิวรรณ สำรวยประเสริฐ', 1, NULL, NULL, 2, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
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
(166, '6501278', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'sopon.g@pact.com', NULL, 'โสภณ (PACT)', 1, NULL, NULL, 1, 1, NULL, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL),
(167, '6601009', 'bfe277ea3e2275a6809a0e8f7b3a3baa601664fa', 'mitipol@jwdcoldchain.com', NULL, 'มิติพล โยคณิตย์', 1, NULL, NULL, 2, 1, 13, 1, 1, '2023-02-02 00:00:00', 1, NULL, NULL, NULL, NULL);

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
  MODIFY `id_attachment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tb_caused_by_code`
--
ALTER TABLE `tb_caused_by_code`
  MODIFY `id_caused_by_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_change_parts`
--
ALTER TABLE `tb_change_parts`
  MODIFY `id_parts` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_machine_master`
--
ALTER TABLE `tb_machine_master`
  MODIFY `id_machine` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_machine_responsibility`
--
ALTER TABLE `tb_machine_responsibility`
  MODIFY `id_mc_responsibility` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_machine_site`
--
ALTER TABLE `tb_machine_site`
  MODIFY `id_machine_site` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_maintenance_request`
--
ALTER TABLE `tb_maintenance_request`
  MODIFY `id_maintenance_request` int NOT NULL AUTO_INCREMENT COMMENT 'ID ใบแจ้งซ่อม', AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tb_maintenance_type`
--
ALTER TABLE `tb_maintenance_type`
  MODIFY `id_mt_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_outsite_repair`
--
ALTER TABLE `tb_outsite_repair`
  MODIFY `id_outsite_repair` int NOT NULL AUTO_INCREMENT COMMENT 'ไอดีซ่อมภายนอก', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_permission`
--
ALTER TABLE `tb_permission`
  MODIFY `id_permission` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_ref_repairer`
--
ALTER TABLE `tb_ref_repairer`
  MODIFY `id_ref_repairer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id_repair_result` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_satisfaction_survey`
--
ALTER TABLE `tb_satisfaction_survey`
  MODIFY `id_survey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

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
