<?PHP
session_start();    
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_brand
//id_brand, brand_name, brand_remark, brand_status
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
    $query_search = " WHERE (brand_name LIKE '%".$search."%') AND tb_brand.ref_id_site=".$_SESSION['sess_ref_id_site']." ";
}else{
    $query_search = " WHERE tb_brand.ref_id_site=".$_SESSION['sess_ref_id_site']."";
}

switch($_SESSION['sess_class_user']){
    case 5:
        $query_search.='';
    break;
    default:
        $query_search.=' AND tb_brand.ref_id_dept='.$_SESSION['sess_id_dept'].'';
    break;
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
    0=> "tb_brand.id_brand",
    1=> "tb_brand.id_brand",
    2=> "tb_brand.id_brand",
    3=> "tb_brand.id_brand",
    4=> "tb_brand.brand_name",
    5=> "tb_brand.brand_remark",
    6=> "tb_brand.brand_status"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_brand) AS total_row FROM tb_brand LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_brand.ref_id_dept) 
LEFT JOIN tb_site ON (tb_site.id_site=tb_brand.ref_id_site) ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_brand.*, tb_dept.dept_initialname, tb_site.site_initialname FROM tb_brand 
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_brand.ref_id_dept) 
LEFT JOIN tb_site ON (tb_site.id_site=tb_brand.ref_id_site) ".$query_search." 
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//id_brand, brand_status, brand_name, brand_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['site_initialname']=='' ? '-' : $fetchRow[$key]['site_initialname']);
        $dataRow[] = ($fetchRow[$key]['dept_initialname']=='' ? '-' : $fetchRow[$key]['dept_initialname']);
        $dataRow[] = ($fetchRow[$key]['brand_name']=='' ? '-' : $fetchRow[$key]['brand_name']);
        $dataRow[] = ($fetchRow[$key]['brand_remark']=='' ? '-' : $fetchRow[$key]['brand_remark']);        
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['brand_status']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_brand'].'" id="customSwitch'.$fetchRow[$key]['id_brand'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_brand'].'"></label></div>';
        $dataRow[] = '<button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_brand'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>'.'';
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