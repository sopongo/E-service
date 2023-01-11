<?PHP

require_once '../../include/class_crud.inc.php';
$obj = new CRUD();

//id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_location, ref_dept, status_user, create_date, lass_login, last_ip
//tb_user


$numRow = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user");    //ถ้าจำนวน Row ทั้งหมด

$numRow = 500;
/*
/*$_POST['length'] คือ จำนวนต่อหน้า
$_POST["draw"] คือ ??? ประมาณว่าเลขหน้า
$_POST["search"]["value"]
$_POST['order']['0']['column'] คือ เสริทข้อมูลโดยใช้ลำดับคอลัมน์ในตารางดาต้าเบส
$_POST['order']['0']['dir'] คือ ASC DESC
$_POST['start']
$_POST['length']
*/


$_POST['order']['0']['column'] = $_POST['order']['0']['column']+1;

if($_POST["start"]==0){
    $length=$_POST['length'];
}else{
    $length=$_POST["start"]+$_POST['length'];
}
$start = ($_POST["start"]-1)*$_POST['length'];
//$fetchRow = $obj->getRows("id_offsupp, ref_id_branch, offsupp_code, offsupp_name, ref_id_menu, ref_id_menu_sub, offsupp_status, total_balance, ref_id_unit", "tb_office_supplies", "id_offsupp DESC", $start, $limit);
// AND tb_office_supplies.ref_id_menu_sub=mainCate.ref_id_menu
//$fetchRow = $obj->fetchRows("SELECT * FROM tb_user ORDER BY id_user DESC LIMIT $start, $_POST['length']");


$employeeData = array();	
for($i=1; $i<=10; $i++) {
    $empRows = array();			
    $empRows[] = $i.'--numRow----'.$numRow.'----$start-----'.$start;
    $empRows[] = $i.'--draw----'.$_POST["draw"].'------'.$_POST['action'];
    $empRows[] = $i.'---keyword---'.$_POST["search"]["value"];
    $empRows[] = $i.'---order-column-'.$_POST['order']['0']['column'];
    $empRows[] = $i.'---order-dir-'.$_POST['order']['0']['dir'];
    $empRows[] = $i.'--start--'.$_POST['start'].'--length--'.$_POST['length'].'---- LIMIT'.$_POST['start'].','.$length;
    $empRows[] = "SELECT * FROM tb_user ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start']." , ".$length."";
    $employeeData[] = $empRows;
}

$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  intval($numRow),
    "recordsFiltered" 	=> 	intval($numRow),
    "data"    			=> 	$employeeData
);
echo json_encode($output);
exit();



/*-----------------------------------------------------------------------------------------------------------------*/
?>