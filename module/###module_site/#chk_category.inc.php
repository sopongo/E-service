<?PHP
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');	
error_reporting(error_reporting() & ~E_NOTICE);



$level_menu = $_REQUEST['level_menu']; #รับค่า action มาจากหน้าจัดการ


if (!empty($level_menu)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
    require_once '../../include/class_crud.inc.php';
    $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
}

echo "chk_category.inc.php";

?>