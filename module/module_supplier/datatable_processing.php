<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();


//EX.tb_supplier
//id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status
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
    $query_search = " WHERE supplier_name LIKE '%".$search."%' ";
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
    0=> "tb_supplier.id_supplier",
    1=> "tb_supplier.id_supplier",
    2=> "tb_supplier.supplier_name",
    3=> "tb_supplier.supplier_phone",    
    4=> "tb_dept.dept_initialname",        
    5=> "tb_supplier.supplier_remark",
    6=> "tb_supplier.supplier_status"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_supplier) AS total_row FROM tb_supplier ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT * FROM tb_supplier ".$query_search."
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

$fetchRow = $obj->fetchRows("SELECT tb_supplier.*, tb_dept.dept_name, tb_dept.dept_initialname FROM tb_supplier
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_supplier.ref_id_dept) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//tb_supplier, id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status

if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['supplier_name']=='' ? '-' : $fetchRow[$key]['supplier_name']);
        $dataRow[] = ($fetchRow[$key]['supplier_phone']=='' ? '-' : $fetchRow[$key]['supplier_phone']);
        $dataRow[] = ($fetchRow[$key]['dept_name']=='' ? '-' : $fetchRow[$key]['dept_name'].' ('.$fetchRow[$key]['dept_initialname'].')');        
        $dataRow[] = ($fetchRow[$key]['supplier_remark']=='' ? '-' : $fetchRow[$key]['supplier_remark']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['supplier_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_supplier'].'" id="customSwitch'.$fetchRow[$key]['id_supplier'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_supplier'].'"></label></div>';
        $dataRow[] = '<button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_supplier'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>'.'';
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