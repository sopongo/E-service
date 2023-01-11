<?PHP
require_once '../../../include/class_crud.inc.php';
require_once '../../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_failure_code
//id_failure_code, ref_id_dept, failure_code, failure_code_th_name, failure_code_en_name, failure_code_remark, failure_code_status
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
    $query_search = " WHERE (failure_code_th_name LIKE '%".$search."%' OR failure_code_en_name LIKE '%".$search."%') ";
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
    0=> "tb_failure_code.id_failure_code",
    1=> "tb_failure_code.id_failure_code",
    2=> "tb_failure_code.failure_code",
    3=> "tb_failure_code.failure_code_th_name",
    4=> "tb_failure_code.failure_code_en_name",
    5=> "tb_dept.dept_name",
    6=> "tb_failure_code.failure_code_remark"    
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_failure_code) AS total_row FROM tb_failure_code ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_failure_code.*, tb_dept.dept_name, tb_dept.dept_initialname FROM tb_failure_code
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_failure_code.ref_id_dept) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//tb_failure_code   id_failure_code, ref_id_dept, failure_code, failure_code_th_name, failure_code_en_name, failure_code_remark, failure_code_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['failure_code']=='' ? '-' : $fetchRow[$key]['failure_code']);
        $dataRow[] = ($fetchRow[$key]['failure_code_th_name']=='' ? '-' : $fetchRow[$key]['failure_code_th_name']);
        $dataRow[] = ($fetchRow[$key]['failure_code_en_name']=='' ? '-' : $fetchRow[$key]['failure_code_en_name']);
        $dataRow[] = ($fetchRow[$key]['dept_name']=='' ? '-' : $fetchRow[$key]['dept_name'].' ('.$fetchRow[$key]['dept_initialname'].')');        
        $dataRow[] = ($fetchRow[$key]['failure_code_remark']=='' ? '-' : $fetchRow[$key]['failure_code_remark']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['failure_code_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_failure_code'].'" id="customSwitch'.$fetchRow[$key]['id_failure_code'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_failure_code'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;">
          <a class="dropdown-item edit-data-tab2" data-id="'.$fetchRow[$key]['id_failure_code'].'" data-toggle="modal" data-target="#modal-default-tab2" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
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