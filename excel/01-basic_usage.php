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

echo '<h1>Parse Machine_ToolList.xslx</h1>';
echo 'Array
(
    [0] => 1
    [1] => WE.50.01.03
    [2] => PCS ห้องเก็บเครื่องชั่ง
    [3] => PCS
    [4] => Standard Weight (F1) (ตุ้มน้ำหนัก)
    [5] => WEIGHT 500 Kg. (ลูกตุ้ม)        
)';
echo '<pre>';
if ($xlsx = SimpleXLSX::parse('../#Machine_ToolList.xlsx')) {//Machine_ToolList.xlsx   //books
    //print_r($xlsx->rows());
    $Machine_Tool = $xlsx->rows();
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


/*
INSERT INTO `tb_machine_site` (`id_machine_site`, `code_machine_site`, `serial_number`, `recived_date`, `ref_id_machine_master`, `ref_id_building`, `ref_id_location`, `ref_id_site`, `ref_id_supplier`, `status_work`, `detail_machine_site`, `mcs_adddate`, `ref_id_user_add`, `mcs_editdate`, `ref_id_user_edit`, `status_machine_site`) VALUES
(1, 'MT-AS-0001-0001', NULL, '2023-03-01 00:00:00', 1, NULL, NULL, 1, NULL, 1, 'ใช้กรณีไม่รู้จักเครื่องจักร', '2023-03-22 10:41:21', 3, NULL, NULL, 1);
*/
echo "INSERT INTO `tb_machine_site` (`id_machine_site`, `code_machine_site`, `serial_number`, `recived_date`, `ref_id_machine_master`, `ref_id_building`, `ref_id_location`, `ref_id_site`, `ref_id_supplier`, `status_work`, `detail_machine_site`, `mcs_adddate`, `ref_id_user_add`, `mcs_editdate`, `ref_id_user_edit`, `status_machine_site`) VALUES <br />";
foreach($Machine_Tool as $index => $value){
    if($index!=NULL){
        $rowData = $obj->customSelect("SELECT * FROM tb_machine_master WHERE name_machine='".$Machine_Tool[$index][5]."'");     

        $rowSite= $obj->customSelect("SELECT id_site FROM tb_site WHERE site_initialname='".$Machine_Tool[$index][3]."'");
        $rowBuilding = $obj->customSelect("SELECT id_building, building_name FROM tb_building WHERE building_name='".$Machine_Tool[$index][4]."' ");
        echo "(NULL, 'code_machine_site', NULL , NULL, '".$rowData['id_machine']."', ".$rowBuilding['building_name'].'---'.$Machine_Tool[$index][2]." , NULL, ".$rowSite['id_site'].", NULL, 1, NULL, '2023-03-24 18:18:18', 3, NULL, NULL, 1), <br />";
    }
}

exit();

/*echo 'INSERT INTO `tb_category` (`id_menu`, `menu_code`, `level_menu`, `sort_menu`, `ref_id_menu`, `ref_id_sub`, `ref_id_dept`, `name_menu`, `desc_menu`, `menu_adddate`, `ref_id_user_add`, `menu_editdate`, `ref_id_user_edit`, `status_menu`) VALUES';*/
foreach($Machine_Tool as $index => $value){
    if($index!=0){
        //$rowData = $obj->customSelect("SELECT * FROM tb_maintenance_request WHERE xxxxx=".$Machine_Tool[$index][3]."");     
        //array_push($arr_building, $Machine_Tool[$index][2], $Machine_Tool[$index][3]);
        //Array ( [0] => 1 [1] => WE.50.01.03 [2] => PCS ห้องเก็บเครื่องชั่ง [3] => PCS [4] => Standard Weight (F1) (ตุ้มน้ำหนัก) [5] => WEIGHT 500 Kg. (ลูกตุ้ม) )
        //$data = array('building' => $Machine_Tool[$index][2], 'site' => $Machine_Tool[$index][3]);
        $data = array('category' => $Machine_Tool[$index][4], 'master_name' => $Machine_Tool[$index][5]);
        $arr_master_machine[] = array_unique($data);
        //echo $Machine_Tool[$index][2]."-------------".$Machine_Tool[$index][3]."<br />";
    }
        //echo $Machine_Tool[$index][1]."-------------".$Machine_Tool[$index][2]."-------------".$Machine_Tool[$index][3]."-------------".$Machine_Tool[$index][4]."<br />";
}



/*
$i = 1;
$fetchRow = $obj->fetchRows("SELECT DISTINCT name_machine, ref_id_menu FROM tb_machine_master ORDER BY name_machine ASC;");
echo "INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES <br/>";
foreach($fetchRow as $key=>$value){
    $machine_code = str_pad(($i), 4, '0', STR_PAD_LEFT);
    $fetchRow[$key]['name_machine'] = str_replace('"', '\"', $fetchRow[$key]['name_machine']);
    echo '(NULL, "MT-AS-'.$machine_code.'", 7, '.$fetchRow[$key]['ref_id_menu'].', NULL, NULL , "'.$fetchRow[$key]['name_machine'].'" , NULL , "2023-03-24 12:12:12", 3, NULL, NULL, 1), <br />';
    $i++;
}
exit();
*/

//print_r($arr_master_machine); exit();
echo "INSERT INTO `tb_machine_master` (`id_machine`, `machine_code`, `ref_id_dept`, `ref_id_menu`, `ref_id_sub_menu`, `model_name`, `name_machine`, `detail_machine`, `mc_adddate`, `ref_id_user_add`, `mc_editdate`, `ref_id_user_edit`, `status_machine`) VALUES <br/>";

$num = 1;
foreach($arr_master_machine as $index => $value){
    //echo $arr_building[$index]['building']."-------------".$arr_building[$index]['site']."<br />";
    if(!empty($arr_master_machine[$index]['master_name'])){
        $rowData = $obj->customSelect("SELECT id_menu, name_menu FROM tb_category WHERE name_menu='".$arr_master_machine[$index]['category']."'");  
        echo "(NULL, 'MT-AS-000".$num."', 7, ".$rowData['id_menu'].", NULL, NULL, '".$arr_master_machine[$index]['master_name']."', NULL , '2023-03-24 12:12:12', 3, NULL, NULL, 1), <br />";
    }
    /*$rowData = $obj->customSelect("SELECT * FROM tb_site WHERE site_initialname='".$arr_building[$index]['site']."'");
    if(!empty($rowData['id_site'])){
        echo "(NULL, '".$rowData['id_site']."', NULL, '".$arr_building[$index]['building']."', '1'),<br />";
    }else{
        //$rowData['id_site'] = 0;
    }
    */
    //echo "<hr />";
    $num++;
}

?>