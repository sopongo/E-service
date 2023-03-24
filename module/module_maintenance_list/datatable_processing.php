<?PHP
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
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
isset($_REQUEST['module']) ? $module = $_REQUEST['module'] : $module = '';

$_POST['order']['0']['column'] = $_POST['order']['0']['column']+1;

$search = $_POST["search"]["value"];

//$slt_search = $_POST["slt_search"];
//$keyword = $_GET["keyword"];

$query_search = "";
if(!empty($search)){
    $query_search = " AND (tb_machine_master.name_machine LIKE '%".$search."%' OR tb_maintenance_request.maintenance_request_no LIKE '%".$search."%') ";
}else{
    $query_search = "";
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
    2=> "tb_maintenance_request.id_maintenance_request",    
    3=> "tb_maintenance_request.maintenance_request_no",
    4=> "tb_maintenance_request.mt_request_date",
    5=> "tb_machine_site.status_approved",
    6=> "tb_machine_site.code_machine_site",
    7=> "tb_machine_master.name_machine",
    8=> "tb_category.name_menu",
    9=> "tb_maintenance_request.problem_statement",
    10=> "tb_maintenance_request.problem_statement",
    11=> "tb_dept_responsibility.dept_initialname",
    12=> "tb_maintenance_request.ref_id_job_type",
    13=> "tb_maintenance_request.related_to_safty"
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$_SESSION['sess_class_user']!=4 ? $query_class = ' WHERE tb_dept_responsibility.id_dept='.$_SESSION['sess_id_dept'].'' : $query_class = '';

//AND tb_dept_responsibility.id_dept= '.$_SESSION['sess_id_dept']
switch($_SESSION['sess_class_user']){
    case 1: ##ถ้าระดับผู้ใช้งานเท่ากับ 0,1 (ผู้ใช้ระบบ) จะดูได้แค่ใบแจ้งซ่อมของตัวเอง และของแผนกตัวเอง
    case 0:
    default:
        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_request=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." ".$query_search;
        
        //$query_class.' '.$query_search ".$query_class.' '.$query_search." 
        //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
        $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."");
        $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_request=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."".$query_search);    //ถ้าจำนวน Row ทั้งหมด
    break;

    case 2: ##ถ้าระดับผู้ใช้งานเท่ากับ 2 (ช่างซ่อม) จะดูได้แค่ 1.ใบแจ้งซ่อมของตัวเอง 2.ใบแจ้งซ่อมของแผนกตัวเอง 
    $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
    tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
    LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
    LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
    LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
    LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." ".$query_search;
    
    //$query_class.' '.$query_search ".$query_class.' '.$query_search." 
    //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
    $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."");
    $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
    LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
    LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
    LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
    LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."".$query_search);    //ถ้าจำนวน Row ทั้งหมด
    break;

    case 3: ##ถ้าระดับผู้ใช้งานเท่ากับ 3 (หัวหน้าช่างซ่อม) จะดูได้แค่ 1.ใบแจ้งซ่อมที่แจ้งเข้ามายังแผนกตัวเองได้ทั้งหมด
        if($module=='waitapprove'){
            $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
            tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
            LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
            LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
            LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." ".$query_search." AND tb_maintenance_request.maintenance_request_status!=2";
            //$query_class.' '.$query_search ".$query_class.' '.$query_search." 
            //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
            $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."");

            $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
            LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
            LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
            LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."".$query_search." AND tb_maintenance_request.maintenance_request_status!=2");    //ถ้าจำนวน Row ทั้งหมด
        }else{
            $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
            tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
            LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
            LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
            LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_request=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."".$query_search;
            //$query_class.' '.$query_search ".$query_class.' '.$query_search." 
            //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
            $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."");
            $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
            LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
            LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
            LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE tb_maintenance_request.ref_id_dept_request=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."".$query_search);    //ถ้าจำนวน Row ทั้งหมด
        }
    break;

    case 4: ##ถ้าระดับผู้ใช้งานเท่ากับ 4 (ผู้จัดการระบบ) ดูได้ทั้งหมด
        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE  tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status!=0 $query_search ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ";
        //$query_class.' '.$query_search
        $fetchRow = $obj->fetchRows($sql_fetchRow);
        //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
        //$numRow = $obj->getCount($sql_numRow);    //ถ้าจำนวน Row ทั้งหมด
        //$numRow = count($fetchRow);
        $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
        WHERE tb_maintenance_request.maintenance_request_status!=0 $query_search ORDER BY ".$orderBY."");    //ถ้าจำนวน Row ทั้งหมด        
    break;

    case 5:
        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request 
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)             
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) WHERE  tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status!=0 $query_search ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ";
        //$query_class.' '.$query_search
        $fetchRow = $obj->fetchRows($sql_fetchRow);
        //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
        //$numRow = $obj->getCount($sql_numRow);    //ถ้าจำนวน Row ทั้งหมด
        //$numRow = count($fetchRow);
        $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
        WHERE tb_maintenance_request.maintenance_request_status!=0 $query_search ORDER BY ".$orderBY."");    //ถ้าจำนวน Row ทั้งหมด        
    break;
}

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."
//ref_id_user_request
//id_maintenance_request, status_approved, status_approved, id_maintenance_request
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){

        if($fetchRow[$key]['status_approved']==NULL && $fetchRow[$key]['maintenance_request_status']==1){
            $req_textstatus = 'รออนุมัติ/จ่ายงาน';
        }else{
            $req_textstatus = '-';
        }
        $dataRow = array();
        $dataRow[] = $No.'.';
        //$dataRow[] = $No.'.'.(count($fetchRow)).'---'.$search.'--------'.$query_class.'-------------'.$query_search.$fetchRow[$key]['dept_request'];
        $dataRow[] = '<a class="btn btn-success btn-sm" href="?module=requestid&id='.$fetchRow[$key]['id_maintenance_request'].'" id="viewData"  title="ดูข้อมูล" target="_blank"><i class="fa fa-file-alt"></i></a> ';
        $dataRow[] = ($fetchRow[$key]['maintenance_request_no']=='' ? '-' : $fetchRow[$key]['maintenance_request_no']).'--module-->'.$module; //.'----'.$slt_search.'-------'.$keyword
        $dataRow[] = ($fetchRow[$key]['mt_request_date']=='' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']));
        $dataRow[] = $req_textstatus;
        $dataRow[] = ($fetchRow[$key]['code_machine_site']=='' ? '-' : $fetchRow[$key]['code_machine_site']);
        $dataRow[] = (!empty($fetchRow[$key]['name_machine'])=='' ? 'ไม่ทราบชื่อ, ไม่ระบุ' : $fetchRow[$key]['name_machine']);
        $dataRow[] = ($fetchRow[$key]['name_menu']=='' ? '-' : $fetchRow[$key]['name_menu']);
        //$dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : $fetchRow[$key]['problem_statement']);
        $dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : mb_substr($fetchRow[$key]['problem_statement'],0,50,"utf8"));
        $dataRow[] = ($fetchRow[$key]['related_to_safty']=='' ? '-' : '<a class="text-info"><i class="fas fa-images"></i> คลิกดูภาพ</a>');
        $dataRow[] = ($fetchRow[$key]['dept_responsibility']=='' ? '-' : $fetchRow[$key]['dept_responsibility']);        
        $dataRow[] = ($fetchRow[$key]['ref_id_job_type']=='' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']]);
        $dataRow[] = ($fetchRow[$key]['related_to_safty']==1 ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>');
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