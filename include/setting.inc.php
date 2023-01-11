<?php

$title_site = "หน้าหลัก E-Service | Dashboard";

$title_site_1 = "PCS E-Service | ระบบแจ้งซ่อมออนไลน์";
$title_site_2 = "ระบบ แจ้งซ่อมออนไลน์ | E-Service";
$title_site_3 = "PCS E-Service";

$req_digit = "-RQ-"; //ตัวย่อหน้าเลขที่ใบเบิก

$keygen = 'Pcs@'; //sha1+password

$btn_perPage = 10;#จำนวนปุ่มแสดงเลขหน้า
$limit_perPage = 10; #จำนวนข้อมูลที่แสดงต่อ 1 หน้า *ทั้งโปรแกรม


$pathImg = "uploads/";
$pathImgDefault = "uploads/default.png";

$pathProduct = "uploads-product/";
$pathProductDefault = "uploads-product/default.png";

$pathUser= "uploads-user/";
$pathUserDefault = "uploads-user/default.png";


/*
* @return array $branchArr
* รายชื่อส่วนงาน
*/
$branchArr = array( 
    array(0,'',''),
    array(1,'PCS','Pacific Cold Chain'),
    array(2,'JPAC','xxxxxxxxxxxxxxx'),
    array(3,'JPK','xxxxxxxxxxxxxxx'),
    array(4,'PACM','xxxxxxxxxxxxxxx'),
    array(5,'PACS','xxxxxxxxxxxxxxx'),
    array(6,'PACT','xxxxxxxxxxxxxxx'),
    array(7,'PACA','xxxxxxxxxxxxxxx'),
);

$deptArr = array( 
    array(0,'',''),
    array(1,'MA','Management'),
    array(2,'PLP','Pacific Logistics Pro'),
    array(3,'WH','Warehouse'),
    array(4,'QA','xxxxxxxxxxxxxxx'),
    array(5,'Safety','xxxxxxxxxxxxxxx'),
    array(6,'CS','Customer Service'),
    array(7,'AC','Account'),
    array(8,'EN','xxxxxxxxxxxxxxx'),
    array(9,'HR','xxxxxxxxxxxxxxx'),
    array(10,'IT/MIS','xxxxxxxxxxxxxxx'),
    array(11,'INV','Inventory'),
    array(12,'MT','xxxxxxxxxxxxxxx'),    
    array(13,'MK','xxxxxxxxxxxxxxx'),
    array(14,'PC','xxxxxxxxxxxxxxx')
);


/*
"0"=> "ไม่พบข้อมูล", 
"1" => "User",
"2" => "Manager"
"3" => "Super User"
"4" => "Administrator"
*/
$classUserArr = array("0"=> "ไม่พบข้อมูล", "1"=>"ผู้ใช้ระบบ", "2"=>"ผู้อนุมัติ", "3"=>"ผู้จัดการระบบ", "4"=>"ผู้ดูแลระบบ");

$statusUserArr = array("0"=> "ไม่พบข้อมูล", "1" => "ใช้งานได้","2" => "ระงับใช้งาน");

$menuTypeArr = array("0"=> "ไม่พบข้อมูล", "1" => "หมวดหลัก","2" => "หมวดย่อย");

$statusArr = array("0"=> "ไม่พบข้อมูล", "1" => "ใช้งานได้","2" => "ระงับใช้งาน"); //ใช้กับ User,วัสดุ,หมวด,หน่วยนับ

//ใชักับฟิลด์ req_paid
$paidStatusArr = array("0"=> "ไม่พบข้อมูล", "1" => "รออนุมัติ","2" => "ไม่อนุมัติ", "3" => "รอจ่าย", "4" => "จ่ายแล้ว");

$statusReqArr = array("0"=> "ไม่พบข้อมูล", "1" => "ใช้งานได้","2" => "ระงับใช้งาน");



$arr_day_of_week = array('','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์');	
$arr_mouth = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');	
$arr_mouthEN = array('January','February','March','April','May','June','July','August','September','October','November','December');	