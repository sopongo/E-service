<?PHP
 /** @noinspection ForgottenDebugOutputInspection */
 ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');	

require_once ('../include/connect_db.inc.php');
require_once ('../include/function.inc.php');
require_once ('../include/setting.inc.php');
require_once ('../include/class_crud.inc.php');
require_once ('../include/timer.inc.php');
require_once ('../include/query_class.inc.php');

$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ

error_reporting(error_reporting() & ~E_NOTICE);

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../plugins/SimpleXLSX/SimpleXLSX.php';

if ($xlsx = SimpleXLSX::parse('//CS-65-014-PCSIT/OneDrive - Pacific Cold Storage Co. Ltd/Book1.xlsx')) {//Machine_ToolList.xlsx   //books
    //G:/IT/Sopon.G_test/test.xlsx
    //\\CS-65-014-PCSIT\OneDrive - Pacific Cold Storage Co. Ltd
    //https://ebooking.cc.pcs-plp.com/sopon_test/Book1.xlsx
    //G:/IT/Sopon.G_test/test.xlsx
    echo '<pre>';
    print_r($xlsx->rows());
    echo '</pre>';
} else {
    echo SimpleXLSX::parseError();
}
echo '<pre>';

//print_r($Machine_Tool);

//$chk_location = array_unique($Machine_Tool, 2);

//$location = array_unique(array_column($Machine_Tool, 2));
//$site = array_unique(array_column($Machine_Tool, 3));
//$machine = array_unique(array_column($Machine_Tool, 5));

//$cate = array_unique($cate);
//echo "<hr />";
//print_r($Machine_Tool); exit();


?>