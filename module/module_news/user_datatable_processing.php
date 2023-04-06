<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
require_once '../../include/function.inc.php';
$obj = new CRUD();


//EX.tb_news
//id_news, site_initialname, site_name, site_status
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
    $query_search = " WHERE (tb_news.news_title LIKE '%".$search."%' OR tb_news.news_detail LIKE '%".$search."%') AND tb_news.ref_id_site=".$_SESSION['sess_ref_id_site']."";
}else{
    $query_search = " WHERE tb_news.ref_id_site=".$_SESSION['sess_ref_id_site']."";    
}

if($_POST["start"]==0){
    $length=$_POST['length'];
}else{
    $length=$_POST['length'];
}
$start = ($_POST["start"]-1)*$_POST['length'];

empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column']=0 : $_POST['order']['0']['column'];
//empty($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir']='desc' : $_POST['order']['0']['dir']='';

//tb_news id_news, ref_id_site, ref_id_dept, ref_id_user_post, datetime_post, news_title, news_detail, showall_site, datetime_edit, ref_id_user_edit

$colunm_sort = array( //ใช้เรียงข้อมูล
    0=> "tb_news.datetime_post",
    1=> "tb_news.datetime_post",
    2=> "tb_news.news_title",
    3=> "tb_news.fullname",
);

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

//SELECT tb_news.*, tb_user.fullname FROM tb_news 
$numRow = $obj->getCount("SELECT count(id_news) AS total_row FROM tb_news ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_news.*, tb_user.fullname FROM tb_news LEFT JOIN tb_user ON (tb_user.id_user=tb_news.ref_id_user_post) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");
//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."

//id_news, site_initialname, site_name, site_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = '<i class="fas fa-caret-right"></i> '.nowDate($fetchRow[$key]['datetime_post']);
        $dataRow[] = '<a href="#" data-toggle="modal" data-target="#modal-news" id="addData" data-id="'.$fetchRow[$key]['id_news'].'" data-backdrop="static" data-keyboard="false" class="view-news">'.$fetchRow[$key]['news_title'].'</a>';
        $dataRow[] = $fetchRow[$key]['fullname'];
        $arrData[] = $dataRow;
        $No--;
    }
} else {
    $arrData = null;
}

$output = array(
    "draw"                      =>	intval($_POST["draw"]),
    "recordsTotal"      	=>  intval($numRow),
    "recordsFiltered"   	=> 	intval($numRow),
    "data"                         => 	$arrData
);
echo json_encode($output);
exit();

/*------------------------------------------------------------------*/
/*------------------------------------------------------------------*/
?>