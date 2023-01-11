<?PHP

require_once '../../include/class_crud.inc.php';
$obj = new CRUD();

//id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_location, ref_dept, status_user, create_date, lass_login, last_ip
//tb_user


$numRow = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user");    //ถ้าจำนวน Row ทั้งหมด

$numRow = 500;
/*
/*$_POST['length'] คือ จำนวนต่อหน้า
$_POST["draw"] คือ ???
$_POST["search"]["value"]
$_POST['order']['0']['column']
$_POST['order']['0']['dir']
$_POST['start']
$_POST['length']
*/

//$limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
$start = ($_POST["draw"]-1) * $_POST['length'];
//$fetchRow = $obj->getRows("id_offsupp, ref_id_branch, offsupp_code, offsupp_name, ref_id_menu, ref_id_menu_sub, offsupp_status, total_balance, ref_id_unit", "tb_office_supplies", "id_offsupp DESC", $start, $limit);
// AND tb_office_supplies.ref_id_menu_sub=mainCate.ref_id_menu
$fetchRow = $obj->fetchRows("SELECT * FROM tb_user ORDER BY id_user DESC LIMIT $start, $_POST['length']");


$employeeData = array();	
for($i=1; $i<=10; $i++) {
    $empRows = array();			
    $empRows[] = '--numRow----'.$numRow;
    $empRows[] = '--draw----'.$_POST["draw"];
    $empRows[] = '---keyword---'.$_POST["search"]["value"];
    $empRows[] = '---order-column-'.$_POST['order']['0']['column'];
    $empRows[] = '---order-dir-'.$_POST['order']['0']['dir'];
    $empRows[] = '------'.$_POST['start'].'----'.$_POST['length'];
    $employeeData[] = $empRows;
}

$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  intval($numRow),
    "recordsFiltered" 	=> 	intval(500),
    "data"    			=> 	$employeeData
);
echo json_encode($output);
exit();



/*-----------------------------------------------------------------------------------------------------------------*/
/*
$sqlQuery = "SELECT * FROM tb_user";
if(!empty($_POST["search"]["value"])){
    $sqlQuery .= 'where(moid LIKE "%'.$_POST["search"]["value"].'%" ';
    $sqlQuery .= ' OR partnum LIKE "%'.$_POST["search"]["value"].'%" ';			
}

$sqlTot = '';

if(!empty($_POST["order"])){
    $sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    $sqlTot.= $sqlQuery;
} else {
    $sqlQuery .= 'ORDER BY id_user DESC ';
    $sqlTot.= $sqlQuery;
}

if($_POST["length"] != -1){
    $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}	


/*$result = mysqli_query($this->dbConnect, $sqlQuery);
$numRows = mysqli_num_rows($result);*/
$numRows = $obj->getCount($sqlQuery);

/*$result_queryTot = mysqli_query($this->dbConnect, $sqlTot) or die("Database Error:". mysqli_error($con));
$totalRecords = mysqli_num_rows($result_queryTot);*/

$fetchRow = $obj->fetchRows($sqlTot);      
$totalRecords = $obj->getCount($sqlTot);

$employeeData = array();	


foreach($fetchRow as $key=>$value) {
    $empRows = array();			
    $empRows[] = $fetchRow[$key]['no_user'];
    $empRows[] = $fetchRow[$key]['email'];
    $empRows[] = $fetchRow[$key]['fullname'];
    $empRows[] = $fetchRow[$key]['class_user'];
    $empRows[] = $fetchRow[$key]['ref_id_location'];
    $empRows[] = $fetchRow[$key]['ref_dept'];
    $employeeData[] = $empRows;
}

$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  intval($numRows),
    "recordsFiltered" 	=> 	intval($totalRecords),
    "data"    			=> 	$employeeData
);
echo json_encode($output);
exit();

?>