<?PHP
session_start();
require_once '../../../include/class_crud.inc.php';
require_once '../../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_reject_mtr_code
//tb_reject_mtr_code    id_reject_mtr, ref_id_dept, reject_mtr_name, reject_mtr_remark, reject_mtr_status
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
    $query_search = " WHERE (tb_reject_mtr_code.reject_mtr_name LIKE '%".$search."%') AND tb_reject_mtr_code.ref_id_dept=".$_SESSION['sess_id_dept']."";
}else{
    $query_search = " WHERE tb_reject_mtr_code.ref_id_dept=".$_SESSION['sess_id_dept']."";
}

if($_POST["start"]==0){
    $length=$_POST['length'];
}else{
    $length=$_POST['length'];
}
$start = ($_POST["start"]-1)*$_POST['length'];

empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column']=0 : $_POST['order']['0']['column'];
//empty($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir']='desc' : $_POST['order']['0']['dir']='';

$colunm_sort = array( //ใช้เรียงข้อมูล
    0=> "tb_reject_mtr_code.id_reject_mtr",
    1=> "tb_reject_mtr_code.id_reject_mtr",
    2=> "tb_reject_mtr_code.reject_mtr_name",
    3=> "tb_dept.dept_name",
    4=> "tb_reject_mtr_code.reject_mtr_remark",
    5=> "tb_reject_mtr_code.reject_mtr_status"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_reject_mtr) AS total_row FROM tb_reject_mtr_code ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_reject_mtr_code.*, tb_dept.dept_name, tb_dept.dept_initialname FROM tb_reject_mtr_code
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_reject_mtr_code.ref_id_dept) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//tb_reject_mtr_code    id_reject_mtr, ref_id_dept, reject_mtr_name, reject_mtr_remark, reject_mtr_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['reject_mtr_name']=='' ? '-' : $fetchRow[$key]['reject_mtr_name']);
        $dataRow[] = ($fetchRow[$key]['dept_name']=='' ? '-' : $fetchRow[$key]['dept_name'].' ('.$fetchRow[$key]['dept_initialname'].')');        
        $dataRow[] = ($fetchRow[$key]['reject_mtr_remark']=='' ? '-' : $fetchRow[$key]['reject_mtr_remark']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['reject_mtr_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_reject_mtr'].'" id="customSwitch'.$fetchRow[$key]['id_reject_mtr'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_reject_mtr'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;">
          <a class="dropdown-item edit-data-tab5" data-id="'.$fetchRow[$key]['id_reject_mtr'].'" data-toggle="modal" data-target="#modal-default-tab5" id="addData-tab5" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
        </div></div>'.'';
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