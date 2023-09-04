<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_category
//id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
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
    $query_search = " WHERE (tb_category.menu_code LIKE '%".$search."%' OR tb_category.name_menu LIKE '%".$search."%') ";
}else{
    $query_search = " WHERE tb_category.ref_id_site=".$_SESSION['sess_ref_id_site']." ";
}

switch($_SESSION['sess_class_user']){
    case 5:
        $query_search.="";
    break;
    default:
    $query_search.=" AND tb_category.ref_id_dept=".$_SESSION['sess_id_dept']."";
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
    0=> "tb_category.id_menu",
    1=> "tb_category.id_menu",
    2=> "tb_category.menu_code",
    3=> "tb_category.name_menu",
    4=> "tb_category.desc_menu",
    5=> "tb_dept.dept_name",
    6=> "tb_category.status_menu",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_category.*, tb_dept.dept_name, tb_dept.dept_initialname, tb_cate.name_menu AS cate_name_menu
FROM tb_category 
LEFT JOIN tb_category AS tb_cate ON (tb_cate.id_menu=tb_category.ref_id_menu)
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_category.ref_id_dept)".$query_search." 
ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//EX.tb_category
////id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['menu_code']=='' ? '-' : $fetchRow[$key]['menu_code']);
        $dataRow[] = ($fetchRow[$key]['name_menu']=='' ? '-' : $fetchRow[$key]['name_menu']);
        $dataRow[] = ($fetchRow[$key]['desc_menu']=='' ? '-' : $fetchRow[$key]['desc_menu']);        
        $dataRow[] = ($fetchRow[$key]['level_menu']==1 ? 'หมวดหลัก' : 'หมวดรอง &#129078; '.$fetchRow[$key]['cate_name_menu']);
        $dataRow[] = ($fetchRow[$key]['dept_name']=='' ? '-' : $fetchRow[$key]['dept_initialname'].' - '.$fetchRow[$key]['dept_name']);
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['status_menu']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_menu'].'" id="customSwitch'.$fetchRow[$key]['id_menu'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_menu'].'"></label></div>';
        $dataRow[] = '<div class="btn-group dropdown"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">จัดการ</button>
        <div class="dropdown-menu" style="margin-left:-4rem;"><a class="dropdown-item edit-data" data-id="'.$fetchRow[$key]['id_menu'].'" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล</a>
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