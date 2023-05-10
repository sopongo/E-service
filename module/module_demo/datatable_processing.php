<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
require_once '../../include/function.inc.php';
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

empty($_POST['val_1']) ? $_POST['val_1'] = null : $_POST['val_1'];
empty($_POST['val_2']) ? $_POST['val_2'] = null : $_POST['val_2'];
empty($_POST['radio_1']) ? $_POST['radio_1'] = null : $_POST['radio_1'];

$arrData = null;
if($_POST['val_1']==null && $_POST['val_2']==null){
    $output = array(
        "draw"                  =>	intval($_POST["draw"]),
        "recordsTotal"  	=>  intval(0),
        "recordsFiltered" 	=> 	intval(0),
        "data"                  => 	$arrData
    );
    echo json_encode($output);
    exit();
}


$_POST['order']['0']['column'] = $_POST['order']['0']['column']+1;

$search = $_POST["search"]["value"];
$query_search = "";
if(!empty($search[0])){
    $query_search = " WHERE brand_name LIKE '%".$search."%' OR brand_remark LIKE '%".$search."%' ";
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
    //0=> "tb_brand.id_brand",
    1=> "tb_brand.ref_id_site",
    2=> "tb_brand.ref_id_dept",
    3=> "tb_brand.ref_id_dept",
    4=> "tb_brand.brand_name",
    5=> "tb_brand.brand_remark",        
    /*4=> "tb_datatable.col_name_4"*/
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(id_brand) AS total_row FROM tb_brand ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT * FROM tb_brand ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//#tb_brand     id_brand, ref_id_site, ref_id_dept, brand_name, brand_remark, brand_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = ($_POST['start']+$No).'.';
        //$dataRow[] = ($_POST['start']+$No).'.';
        $dataRow[] = ($fetchRow[$key]['ref_id_site']=='' ? '-' : '').' | เช็คส่งค่ากลับ='.(rand(11,99)).'---val_1='.$_POST['val_1'].'---val_2='.$_POST['val_2'].'----radio_1='.$_POST['radio_1'];
        $dataRow[] = ($fetchRow[$key]['ref_id_dept']=='' ? '-' : $fetchRow[$key]['ref_id_dept']);
        $dataRow[] = ($fetchRow[$key]['brand_name']=='' ? '-' : $fetchRow[$key]['brand_name']);
        $dataRow[] = ($fetchRow[$key]['brand_remark']=='' ? '-' : $fetchRow[$key]['brand_remark']);
        $dataRow[] = '#';
        $arrData[] = $dataRow;
        $No--;
    }
} else {
    $arrData = null;
}

$output = array(
    "draw"                  =>	intval($_POST["draw"]),
    "recordsTotal"  	=>  intval($numRow),
    "recordsFiltered" 	=> 	intval($numRow),
    "data"                  => 	$arrData
);
echo json_encode($output);
exit();

/*------------------------------------------------------------------*/
/*------------------------------------------------------------------*/
?>