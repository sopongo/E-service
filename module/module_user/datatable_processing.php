<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();


//EX.tb_unit
//id_unit, unit_name, status_unit
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
    $query_search = " WHERE unit_name LIKE '%".$search."%' ";
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
    0=> "tb_unit.id_unit",
    1=> "tb_unit.id_unit",
    2=> "tb_unit.unit_name",
    3=> "tb_unit.status_unit"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_unit) AS total_row FROM tb_unit ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT * FROM tb_unit ".$query_search."
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//id_unit, status_unit, unit_name, status_unit
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['unit_name']=='' ? '-' : $fetchRow[$key]['unit_name']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['status_unit']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_unit'].'" id="customSwitch'.$fetchRow[$key]['id_unit'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_unit'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;"><a class="dropdown-item edit-data" data-id="'.$fetchRow[$key]['id_unit'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a></div></div>'.'';
        //.'SELECT * FROM tb_user '.$query_search.' ORDER BY '.$orderBY.' '.$_POST['order']['0']['dir'].' LIMIT '.$_POST['start'].', '.$length.''
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