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

isset($_REQUEST['id_row']) ? $id_row = intval($_REQUEST['id_row']) : $id_row = '';

$query = ' WHERE tb_datatable_2.ref_id_row='.$id_row.'';

$search = $_POST["search"]["value"];
$query_search = "";
if(!empty($search[0])){
    $query_search = " WHERE (add_value LIKE '%".$search."%' OR edit_value LIKE '%".$search."%' )";
}

$search_bycol = '';
/*
if(isset($_POST['slt_value_colname_3']) && $_POST['slt_value_colname_3']!=NULL){
    $search_bycol = ($query_search!=NULL ? " AND (col_name_3=".$_POST['slt_value_colname_3'].")" : " WHERE col_name_3=".$_POST['slt_value_colname_3']."") ;
}
*/

if($_POST["start"]==0){
    $length=$_POST['length'];
}else{
    $length=$_POST['length'];
}
$start = ($_POST["start"]-1)*$_POST['length'];

empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column']=0 : $_POST['order']['0']['column'];
//empty($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir']='desc' : $_POST['order']['0']['dir']='';

$colunm_sort = array( //ใช้เรียงข้อมูล
    0=> "tb_datatable_2.id_rows",
    1=> "tb_datatable_2.id_rows",
    2=> "tb_datatable_2.add_value",
    3=> "tb_datatable_2.edit_value",
    4=> "tb_datatable_2.delete_value",
    5=> "tb_datatable_2.view_value",
    6=> "tb_datatable_2.text_value",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	
$numRow = $obj->getCount("SELECT count(id_rows) AS total_row FROM tb_datatable_2 ".$query.$query_search.$search_bycol."");    //ถ้าจำนวน Row ทั้งหมด
$fetchRow = $obj->fetchRows("SELECT * FROM tb_datatable_2 ".$query.$query_search.$search_bycol." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        //$dataRow[] = ($fetchRow[$key]['add_value']=='' ? '-' : $fetchRow[$key]['add_value']);
        //$dataRow[] = ($fetchRow[$key]['add_value']=='' ? '-' : $fetchRow[$key]['edit_value'].' : id_rows= '.$fetchRow[$key]['id_rows']);
        //$dataRow[] = ($fetchRow[$key]['add_value']=='' ? '-' : $fetchRow[$key]['delete_value']);
        //$dataRow[] = ($fetchRow[$key]['add_value']=='' ? '-' : $fetchRow[$key]['view_value']);
        //$dataRow[] = ($fetchRow[$key]['add_value']=='' ? '-' : $fetchRow[$key]['text_value']);
        $dataRow[] = '<div class="icheck-danger d-inline"><input type="checkbox" '.($fetchRow[$key]['add_value']==2 ? 'checked=""' : '' ).' id="add_value_'.$fetchRow[$key]['id_rows'].'" name="add_value[]" /><label for="add_value_'.$fetchRow[$key]['id_rows'].'"></label></div>';
        $dataRow[] = '<div class="icheck-danger d-inline"><input type="checkbox" '.($fetchRow[$key]['edit_value']==2 ? 'checked=""' : '' ).' id="edit_value_'.$fetchRow[$key]['id_rows'].'" name="edit_value[]" /><label for="edit_value_'.$fetchRow[$key]['id_rows'].'"></label></div>';
        $dataRow[] = '<div class="icheck-danger d-inline"><input type="checkbox" '.($fetchRow[$key]['delete_value']==2 ? 'checked=""' : '' ).' id="delete_value_'.$fetchRow[$key]['id_rows'].'" name="delete_value[]" /><label for="delete_value_'.$fetchRow[$key]['id_rows'].'"></label></div>';
        $dataRow[] = '<div class="icheck-danger d-inline"><input type="checkbox" '.($fetchRow[$key]['view_value']==2 ? 'checked=""' : '' ).' id="view_value_'.$fetchRow[$key]['id_rows'].'" name="view_value[]" /><label for="view_value_'.$fetchRow[$key]['id_rows'].'"></label></div>';        
        $dataRow[] = '<input type="text" id="text_value_'.$fetchRow[$key]['id_rows'].'" name="text_value[]" maxlength="50" value="'.($fetchRow[$key]['text_value']=='' ? '' : $fetchRow[$key]['text_value']).'" placeholder="ColName 1" class="form-control" aria-describedby="inputGroupPrepend">';
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