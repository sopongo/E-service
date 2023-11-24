<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();

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
    $query_search = " WHERE (col_name_1 LIKE '%".$search."%' OR col_name_2 LIKE '%".$search."%' )";
}

$search_bycol = '';
if(isset($_POST['slt_value_colname_3']) && $_POST['slt_value_colname_3']!=NULL){
    $search_bycol = ($query_search!=NULL ? " AND (col_name_3=".$_POST['slt_value_colname_3'].")" : " WHERE col_name_3=".$_POST['slt_value_colname_3']."") ;
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
    0=> "tb_datatable.id_row",
    1=> "tb_datatable.id_row",
    2=> "tb_datatable.col_name_1",
    3=> "tb_datatable.col_name_2",
    4=> "tb_datatable.col_name_3",
    5=> "tb_datatable.col_name_4",
    6=> "tb_datatable.col_name_5",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	
$numRow = $obj->getCount("SELECT count(id_row) AS total_row FROM tb_datatable ".$query_search.$search_bycol."");    //ถ้าจำนวน Row ทั้งหมด
$fetchRow = $obj->fetchRows("SELECT * FROM tb_datatable ".$query_search.$search_bycol." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['col_name_1']=='' ? '-' : $fetchRow[$key]['col_name_1']);
        $dataRow[] = ($fetchRow[$key]['col_name_2']=='' ? '-' : $fetchRow[$key]['col_name_2'].' : id_row= '.$fetchRow[$key]['id_row']);
        $dataRow[] = ($fetchRow[$key]['col_name_3']=='' ? '-' : $fetchRow[$key]['col_name_3']);
        $dataRow[] = ($fetchRow[$key]['col_name_4']=='' ? '-' : $fetchRow[$key]['col_name_4']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['col_name_5']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_row'].'" id="customSwitch'.$fetchRow[$key]['id_row'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_row'].'"></label></div>';        
        $dataRow[] = '<button type="button" class="btn btn-success btn-sm view-data mr-1" data-id="'.$fetchRow[$key]['id_row'].'" data-toggle="modal" data-target="#modal-default" id="viewData" data-backdrop="static" data-keyboard="false" title="ดูข้อมูล"><i class="fa fa-list-alt"></i></button> <button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_row'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>';
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