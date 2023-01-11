<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();


//EX.tb_location
//id_location, ref_id_site, ref_id_building, location_initialname, location_name, location_status
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
    $query_search = " WHERE tb_location.location_initialname LIKE '%".$search."%' OR tb_location.location_name LIKE '%".$search."%' ";
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
    0=> "tb_location.id_location",
    1=> "tb_location.id_location",
    2=> "tb_location.location_initialname",
    3=> "tb_location.location_name",
    4=> "tb_location.location_status",
    5=> "tb_site.site_name",
    6=> "tb_building.building_name",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_location) AS total_row FROM tb_location ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_location.*, tb_site.site_initialname, tb_building.building_name
FROM tb_location 
LEFT JOIN tb_site ON (tb_site.id_site=tb_location.ref_id_site) 
LEFT JOIN tb_building ON (tb_building.id_building=tb_location.ref_id_building) ".$query_search." 
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//EX.tb_location
//id_location, ref_id_site, ref_id_building, location_initialname, location_name, location_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['location_initialname']=='' ? '-' : $fetchRow[$key]['location_initialname']);
        $dataRow[] = ($fetchRow[$key]['location_name']=='' ? '-' : $fetchRow[$key]['location_name']);
        $dataRow[] = ($fetchRow[$key]['building_name']=='' ? '-' : $fetchRow[$key]['building_name']);
        $dataRow[] = ($fetchRow[$key]['site_initialname']=='' ? '-' : $fetchRow[$key]['site_initialname']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['location_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_location'].'" id="customSwitch'.$fetchRow[$key]['id_location'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_location'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;"><a class="dropdown-item edit-data" data-id="'.$fetchRow[$key]['id_location'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
        </div></div>'.'';//.'SELECT * FROM tb_user '.$query_search.' ORDER BY '.$orderBY.' '.$_POST['order']['0']['dir'].' LIMIT '.$_POST['start'].', '.$length.''
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