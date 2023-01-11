<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();


//EX.tb_datatable
//id_col, col_name_1, col_name_2, col_name_3, col_name_4, col_name_5, col_name_6, col_name_7, col_name_8, col_name_9
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
    $query_search = " WHERE col_name_3 LIKE '%".$search."%' OR col_name_4 LIKE '%".$search."%' ";
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
    0=> "tb_datatable.id_col",
    1=> "tb_datatable.id_col",
    2=> "tb_datatable.col_name_2",
    3=> "tb_datatable.col_name_3",
    4=> "tb_datatable.col_name_4"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_col) AS total_row FROM tb_datatable ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT * FROM tb_datatable ".$query_search."
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."


if (count($fetchRow)>0) {
    $No = 1;
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = ($_POST['start']+$No).'.';
        $dataRow[] = ($fetchRow[$key]['col_name_1']=='' ? '-' : $fetchRow[$key]['col_name_1']);
        $dataRow[] = ($fetchRow[$key]['col_name_2']=='' ? '-' : $fetchRow[$key]['col_name_2']);
        $dataRow[] = $fetchRow[$key]['col_name_3'];
        $dataRow[] = ($fetchRow[$key]['col_name_4']=='' ? '-' : $fetchRow[$key]['col_name_4']);
        $dataRow[] = ($fetchRow[$key]['col_name_6']=='' ? '-' : $fetchRow[$key]['col_name_6']);
        //$dataRow[] = $fetchRow[$key]['col_name_7'];
        $dataRow[] = '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
        <input type="checkbox" class="check-status custom-control-input" '.(rand(0, 1) ? 'checked' : '').' id="customSwitch'.$fetchRow[$key]['id_col'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_col'].'"></label></div>';
        $dataRow[] = $fetchRow[$key]['col_name_8'];
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;">
          <a class="dropdown-item" data-id="'.$fetchRow[$key]['id_col'].'" data-toggle="modal" data-target="#dataform" href="#" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
          <a class="dropdown-item" href="#"><i class="fas fa-user-check"></i> กำหนดสิทธิ์</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="fas fa-pause-circle"></i> ระงับใช้งาน</a>
        </div>
      </div>'.'';//.'SELECT * FROM tb_user '.$query_search.' ORDER BY '.$orderBY.' '.$_POST['order']['0']['dir'].' LIMIT '.$_POST['start'].', '.$length.''
        $arrData[] = $dataRow;
        $No++;
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