<?PHP
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD();

//EX.tb_machine_master
//tb_machine_master    id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine
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
    $query_search = " WHERE tb_machine_master.name_machine LIKE '%".$search."%'  OR (tb_machine_site.code_machine_site LIKE '%".$search."%'  OR tb_machine_site.serial_number LIKE '%".$search."%' )";
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
    0=> "tb_machine_site.id_machine_site",
    1=> "tb_machine_site.id_machine_site",
    2=> "tb_attachment.path_attachment_name",
    3=> "tb_machine_site.status_work",    
    4=> "tb_machine_site.code_machine_site",    
    5=> "tb_machine_site.serial_number",        
    6=> "tb_machine_master.name_machine",
    7=> "tb_dept.dept_initialname",
    8=> "tb_dept.dept_initialname",
    9=> "tb_dept.dept_initialname",
    10=> "tb_dept.dept_initialname",
    11=> "tb_dept.dept_initialname",
);
//tb_machine_master    id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine

$orderBY = $colunm_sort[$_POST['order']['0']['column']];

$arrData = array();	

$numRow = $obj->getCount("SELECT count(tb_machine_site.id_machine_site) AS total_row FROM tb_machine_site 
LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master) ".$query_search."");    //ถ้าจำนวน Row ทั้งหมด

$fetchRow = $obj->fetchRows("SELECT tb_machine_master.id_machine, tb_machine_master.machine_code, tb_machine_master.model_name, tb_machine_master.name_machine, tb_machine_master.status_machine,  
tb_category.name_menu, tb_dept.dept_initialname, tb_attachment.path_attachment_name, 
tb_machine_site.serial_number, tb_machine_site.code_machine_site, tb_machine_site.id_machine_site, tb_machine_site.status_work,
tb_site.site_initialname, tb_building.building_name, tb_location.location_name
 FROM tb_machine_site
 LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master=tb_machine_master.id_machine) 
 LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_machine_master.ref_id_dept) 
 LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
 LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location) 
 LEFT JOIN tb_site ON (tb_site.id_site=tb_machine_site.ref_id_site)  
 LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu) 
  LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_machine_master.id_machine AND tb_attachment.image_cate=1) ".$query_search." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length." ");

//ORDER BY tb_user.".$_POST['order']['0']['column']." tb_user.".$_POST['order']['0']['dir']." LIMIT ".$_POST['start'].", ".$length."
//EX.tb_machine_master
//tb_category	id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
//tb_attachment 	id_attachment, ref_id_used, attachment_sort, path_attachment_name, attachment_type
//tb_machine_master     id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine
//id_machine_site, code_machine_site, serial_number, recived_date, ref_id_used_master, ref_id_building, ref_id_location, ref_id_site, ref_id_supplier, status_work, detail_machine_site, mcs_adddate, ref_id_user_add, mcs_editdate, ref_id_user_edit, status_machine_site
//tb_dept	id_dept, dept_initialname, mt_request_manage, dept_name, dept_status
//id_site, site_initialname, site_name, site_status
//id_location, ref_id_site, ref_id_building, location_initialname, location_name, location_status
//id_building, ref_id_site, building_initialname, building_name, building_status
if (count($fetchRow)>0) {
    $No = ($numRow-$_POST['start']);
    foreach($fetchRow as $key=>$value){
        $dataRow = array();
        $dataRow[] = $No.'.';
        $dataRow[] = ($fetchRow[$key]['path_attachment_name']=='' ? '<img src="'.$path_machine_Default.'" class="img" />' : '<a href="'.$path_machine.$fetchRow[$key]['path_attachment_name'].'" data-toggle="lightbox" data-title="'.$fetchRow[$key]['machine_code'].': '.$fetchRow[$key]['name_machine'].'"><img src="'.$path_machine.$fetchRow[$key]['path_attachment_name'].'" class="img" alt="'.$path_machine.$fetchRow[$key]['machine_code'].'"></a>');
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline">
        <input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['status_machine']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_machine_site'].'" id="customSwitch'.$fetchRow[$key]['id_machine_site'].'">
        <label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_machine_site'].'"></label></div>';
        $dataRow[] = ($fetchRow[$key]['code_machine_site']=='' ? '-' : $fetchRow[$key]['code_machine_site']);
        $dataRow[] = ($fetchRow[$key]['serial_number']=='' ? '-' : $fetchRow[$key]['serial_number']);
        $dataRow[] = ($fetchRow[$key]['name_machine']=='' ? '-' : $fetchRow[$key]['name_machine']);
        $dataRow[] = ($fetchRow[$key]['name_menu']=='' ? '-' : $fetchRow[$key]['name_menu']);
        $dataRow[] = ($fetchRow[$key]['site_initialname']=='' ? '-' : $fetchRow[$key]['site_initialname']);
        $dataRow[] = ($fetchRow[$key]['building_name']=='' ? '-' : $fetchRow[$key]['building_name']);        
        $dataRow[] = ($fetchRow[$key]['location_name']=='' ? '-' : $fetchRow[$key]['location_name']);        
        $dataRow[] = '<div class="check-status custom-control custom-switch custom-switch-on-success custom-switch-off-danger d-inline"><input type="checkbox" class="custom-control-input" '.($fetchRow[$key]['status_machine']==1 ? 'checked value="1" disabled' : ' disabled ').' data-id="'.$fetchRow[$key]['id_machine_site'].'" id="customSwitch'.$fetchRow[$key]['id_machine_site'].'"><label class="custom-control-label custom-control-label" for="customSwitch'.$fetchRow[$key]['id_machine_site'].'"></label></div>';
        $dataRow[] = '<button type="button" class="btn btn-success btn-sm view-data" data-id="'.$fetchRow[$key]['id_machine_site'].'" data-toggle="modal"  id="viewData" data-backdrop="static" data-keyboard="false" title="ดูข้อมูล"><i class="fa fa-file-alt"></i></button>
        <button type="button" class="btn btn-warning btn-sm edit-data" data-id="'.$fetchRow[$key]['id_machine_site'].'" data-toggle="modal" id="edit-data" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button>';
        $arrData[] = $dataRow; //data-target="#modal-view" //data-target="#modal-default" 
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
