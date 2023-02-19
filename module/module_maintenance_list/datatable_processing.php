<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
require_once '../../include/function.inc.php';
$obj = new CRUD();


//EX.tb_maintenance_request
//id_maintenance_request, status_approved, status_approved, id_maintenance_request
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

$slt_search = $_POST["slt_search"];
$keyword = $_GET["keyword"];

$query_search = "";
if(!empty($search[0])){
    $query_search = " WHERE (status_approved LIKE '%".$search."%' OR status_approved LIKE '%".$search."%') ";
}else{
    $query_search = " ";
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
    0=> "tb_maintenance_request.id_maintenance_request",
    1=> "tb_maintenance_request.id_maintenance_request",
    2=> "tb_maintenance_request.maintenance_request_no ",
    3=> "tb_maintenance_request.mt_request_date",
    4=> "tb_machine_site.code_machine_site",
    5=> "tb_machine_master.name_machine",
    6=> "tb_category.name_menu",
    7=> "tb_dept_responsibility.dept_initialname",
    8=> "tb_maintenance_request.ref_id_job_type",
    9=> "tb_maintenance_request.status_approved",
    10=> "tb_maintenance_request.status_approved"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ".$query_search." ");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine
FROM tb_maintenance_request 
LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)      
LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept)
".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//id_maintenance_request, status_approved, status_approved, id_maintenance_request
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['maintenance_request_no']=='' ? '-' : $fetchRow[$key]['maintenance_request_no']); //.'----'.$slt_search.'-------'.$keyword
        $dataRow[] = ($fetchRow[$key]['mt_request_date']=='' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']));
        $dataRow[] = ($fetchRow[$key]['code_machine_site']=='' ? '-' : $fetchRow[$key]['code_machine_site']);
        $dataRow[] = ($fetchRow[$key]['name_machine']=='' ? '-' : $fetchRow[$key]['name_machine']);
        $dataRow[] = ($fetchRow[$key]['name_menu']=='' ? '-' : $fetchRow[$key]['name_menu']);
        $dataRow[] = ($fetchRow[$key]['dept_responsibility']=='' ? '-' : $fetchRow[$key]['dept_responsibility']);        
        $dataRow[] = ($fetchRow[$key]['ref_id_job_type']=='' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']]);
        $dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : mb_substr($fetchRow[$key]['problem_statement'],0,30,"utf8"));
        $dataRow[] = ($fetchRow[$key]['status_approved']=='' ? '-' : $fetchRow[$key]['status_approved']);
        $dataRow[] = '<button type="button" class="btn btn-success btn-sm view-data" data-id="'.$fetchRow[$key]['id_maintenance_request'].'" data-toggle="modal"  id="viewData" data-backdrop="static" data-keyboard="false" title="ดูข้อมูล"><i class="fa fa-file-alt"></i></button>
        <button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_maintenance_request'].'" data-toggle="modal" id="edit-data" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>';
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