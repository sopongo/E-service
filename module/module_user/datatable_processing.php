<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_user
//id_user, fullname, status_user
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

$search = $_POST["search"]["value"];
$query_search = "";
if(!empty($search[0])){
    $query_search = " WHERE (tb_user.no_user LIKE '%".$search."%' OR tb_user.email LIKE '%".$search."%' OR tb_user.fullname LIKE '%".$search."%' ) AND tb_user.ref_id_site=".$_SESSION['sess_ref_id_site']."";
}else{
    $query_search = " WHERE tb_user.ref_id_site=".$_SESSION['sess_ref_id_site']."";
}

if($_SESSION['sess_class_user']!=5){
    $query_search.=" AND (tb_user.class_user!=4 AND tb_user.class_user!=5) AND tb_user.id_user!=".$_SESSION['sess_id_user']."";
}else{
    $query_search.=" AND tb_user.class_user!=5 AND tb_user.id_user!=".$_SESSION['sess_id_user']."";
}


if($_POST["start"]==0){
    $length=$_POST['length'];
}else{
    $length=$_POST['length'];
}
$start = ($_POST["start"]-1)*$_POST['length'];

empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column']=0 : $_POST['order']['0']['column'];
//empty($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir']='desc' : $_POST['order']['0']['dir']='';

//No 	รหัสพนักงาน	อีเมล์	ชื่อ-นามสกุล	ไซต์	แผนก	ระดับผู้ใช้งาน	สถานะใช้งาน	จัดการ
//id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address
$colunm_sort = array( //ใช้เรียงข้อมูล
    0=> "tb_user.id_user",
    1=> "tb_user.id_user",
    2=> "tb_user.no_user",
    3=> "tb_user.email",
    4=> "tb_user.fullname",
    5=> "tb_user.ref_id_site",
    6=> "tb_user.ref_id_dept",
    7=> "tb_user.class_user",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	
$numRow = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_user.*, tb_dept.dept_initialname, site_initialname  FROM tb_user 
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_id_dept)
LEFT JOIN tb_site ON (tb_site.id_site=tb_user.ref_id_site) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//No 	รหัสพนักงาน	อีเมล์	ชื่อ-นามสกุล	ไซต์	แผนก	ระดับผู้ใช้งาน	สถานะใช้งาน	จัดการ
//id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['no_user']=='' ? '-' : $fetchRow[$key]['no_user']);
        $dataRow[] = ($fetchRow[$key]['email']=='' ? '-' : $fetchRow[$key]['email']);
        $dataRow[] = ($fetchRow[$key]['fullname']=='' ? '-' : $fetchRow[$key]['fullname']);
        $dataRow[] = ($fetchRow[$key]['site_initialname']=='' ? 'All Site' : $fetchRow[$key]['site_initialname']);
        $dataRow[] = ($fetchRow[$key]['dept_initialname']=='' ? '-' : $fetchRow[$key]['dept_initialname']);
        $dataRow[] = ($fetchRow[$key]['class_user']=='' ? '-' : $classArr[$fetchRow[$key]['class_user']]);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['status_user']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_user'].'" id="customSwitch'.$fetchRow[$key]['id_user'].'" data-email="'.$fetchRow[$key]['email'].'"><label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_user'].'"></label></div>';
        $dataRow[] = '<button type="button" class="btn btn-success btn-sm view-data" data-id="'.$fetchRow[$key]['id_user'].'" data-email="'.$fetchRow[$key]['email'].'" data-toggle="modal" data-target="#modal-view" id="viewData" data-backdrop="static" data-keyboard="false" title="ดูข้อมูล"><i class="fa fa-file-alt"></i></button>
        <button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_user'].'" data-toggle="modal" data-target="#modal-default" id="edit-data" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>';
        $arrData[] = $dataRow;
        $No--;
    }
} else {
    $arrData = null;
}

$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  intval($numRow),
    "recordsFiltered" 	=> 	intval($numRow),
    "data"    			=> 	$arrData
);
echo json_encode($output);
exit();

/*------------------------------------------------------------------*/
/*------------------------------------------------------------------*/
?>