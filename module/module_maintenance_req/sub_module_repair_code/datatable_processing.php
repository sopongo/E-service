<?PHP
require_once '../../../include/class_crud.inc.php';
require_once '../../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_repair_code
//tb_repair_code    id_repair_code, ref_id_dept, repair_code, repair_code_name, repair_code_remark, repair_code_status
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
    $query_search = " WHERE repair_code_name LIKE '%".$search."%' ";
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
    0=> "tb_repair_code.id_repair_code",
    1=> "tb_repair_code.id_repair_code",
    2=> "tb_repair_code.repair_code",
    3=> "tb_repair_code.repair_code_name",
    5=> "tb_dept.dept_name",
    6=> "tb_repair_code.repair_code_remark"    
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_repair_code) AS total_row FROM tb_repair_code ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_repair_code.*, tb_dept.dept_name, tb_dept.dept_initialname FROM tb_repair_code
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_repair_code.ref_id_dept) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//tb_repair_code    id_repair_code, ref_id_dept, repair_code, repair_code_name, repair_code_remark, repair_code_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['repair_code']=='' ? '-' : $fetchRow[$key]['repair_code']);
        $dataRow[] = ($fetchRow[$key]['repair_code_name']=='' ? '-' : $fetchRow[$key]['repair_code_name']);
        $dataRow[] = ($fetchRow[$key]['dept_name']=='' ? '-' : $fetchRow[$key]['dept_name'].' ('.$fetchRow[$key]['dept_initialname'].')');        
        $dataRow[] = ($fetchRow[$key]['repair_code_remark']=='' ? '-' : $fetchRow[$key]['repair_code_remark']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['repair_code_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_repair_code'].'" id="customSwitch'.$fetchRow[$key]['id_repair_code'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_repair_code'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;">
          <a class="dropdown-item edit-data-tab4" data-id="'.$fetchRow[$key]['id_repair_code'].'" data-toggle="modal" data-target="#modal-default-tab4" id="addData-tab4" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
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