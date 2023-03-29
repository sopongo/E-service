<?PHP
session_start();
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
?>

<style>
</style>
<div class="card-body p-2">

<?PHP
        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine, tb_attachment.path_attachment_name, tb_ref_repairer.*, 
        tb_location.location_name AS machine_location, tb_building.building_name AS machine_building,
        tb_user_request.fullname AS fullname_request, tb_dept_request.dept_initialname FROM tb_maintenance_request 
        LEFT JOIN tb_user AS tb_user_request ON (tb_user_request.id_user=tb_maintenance_request.ref_id_user_request)
        LEFT JOIN tb_dept AS tb_dept_request ON (tb_dept_request.id_dept=tb_user_request.ref_id_dept)
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building)
        LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)          
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) 
        LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_maintenance_request.id_maintenance_request AND tb_attachment.attachment_type=1 AND tb_attachment.image_cate=2) 
        LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
        WHERE tb_maintenance_request.allotted_accept_date IS NOT NULL AND tb_maintenance_request.duration_serv_start IS NULL AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']."  ";
        
//AND tb_ref_repairer.acknowledge_date IS NULL
//AND tb_maintenance_request.allotted_accept_date IS NULL 
        $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY tb_maintenance_request.mt_request_date DESC");
    if (count($fetchRow)>0) {
        foreach($fetchRow as $key=>$value){
?>
<div class="card card-row card-info col-md-3 p-0 mr-3 d-inline-block align-top">
    <div class="card-header"><span class="card-title text-md"><i class="fas fa-file-alt"></i> ใบแจ้งซ่อมเลขที่: <?PHP echo $fetchRow[$key]['maintenance_request_no']; ?></span></div>
    <div class="card-body p-3 m-0">
        <div class="border-bottom pb-2 mb-2"><span class="badge bg-info text-sm"><?PHP echo $fetchRow[$key]['dept_responsibility'];?></span> <span class="badge bg-<?PHP echo $fetchRow[$key]['urgent_type']==1 ? 'danger' : 'warning';?> text-sm"><?PHP echo $fetchRow[$key]['urgent_type']==1 ? 'ด่วน' : 'ไม่ด่วน';?></span><div class="float-right text-sm">วันที่แจ้งซ่อม: <?PHP echo $fetchRow[$key]['mt_request_date'];?></div></div>
        <div class="text-md text-bold pb-2"><?PHP echo $fetchRow[$key]['name_menu']!='' ? $fetchRow[$key]['name_menu'] : 'ไม่ทราบชื่อ, ไม่ระบุ';?></div>
        <div class="text-sm pb-1"><?PHP echo $fetchRow[$key]['code_machine_site']!='' ? $fetchRow[$key]['code_machine_site'] : '-';?></div>
        <div class="text-sm pb-1"><?PHP echo $fetchRow[$key]['name_machine']!='' ? $fetchRow[$key]['name_machine'] : 'ไม่ทราบชื่อ, ไม่ระบุ';?></div>
        <div class="border-top border-bottom pt-2 pb-2 mb-2 d-block" style="height:80px;"><lebel class="d-block text-bold text-sm text-red">ปัญหาที่พบ:</lebel><?PHP echo $fetchRow[$key]['problem_statement']!='' ? $fetchRow[$key]['problem_statement'] : '';?></div>
        <div class="col-md-4 d-inline-block pl-0">ประเภทงานซ่อม:</div><div class="col-md-7 d-inline-block "><?PHP echo $fetchRow[$key]['ref_id_job_type']!='' ? $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']] : '-'; ?></div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">อาคาร:</div><div class="col-md-7 d-inline-block"><?PHP echo $fetchRow[$key]['machine_building']!='' ? $fetchRow[$key]['machine_building'] : '-';?></div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">สถานที่:</div><div class="col-md-7 d-inline-block"><?PHP echo $fetchRow[$key]['machine_location']!='' ? $fetchRow[$key]['machine_location'] : '-';?></div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">ผู้แจ้งซ่อม:</div><div class="col-md-7 d-inline-block"><?PHP echo $fetchRow[$key]['fullname_request']!='' ? $fetchRow[$key]['fullname_request'] : '-';?> (<?PHP echo $fetchRow[$key]['dept_initialname']!='' ? $fetchRow[$key]['dept_initialname'] : '-';?>)</div>
        <?PHP
                if(file_exists($pathReq.$fetchRow[$key]['path_attachment_name']) && !empty($fetchRow[$key]['path_attachment_name'])){                    
                echo '<div class="divimg_after col-sm-12 mt-2"><img src="'.$pathReq.$fetchRow[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ" /></div>';
                }else{
                $pathReq.$fetchRow[$key]['path_attachment_name'] = $noimg;
                echo '<div class="divimg_after col-sm-12 mt-2"><img src="'.$pathReq.$fetchRow[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ" /></div>';
                }
        ?>
                <div class="m-auto w-100 text-center border-bottom pb-1 overflow-hidden">
                <span class="btn bg-success btn-md col-md-4 d-inline float-left mb-1"><a href="?module=requestid&id=<?PHP echo $fetchRow[$key]['id_maintenance_request']!='' ? $fetchRow[$key]['id_maintenance_request'] : 0;?>" target="_blank">ดูใบแจ้งซ่อม</a></span> 
                <!--<span class="btn bg-warning btn-md col-md-3 d-inline-block float-left ml-1 mb-1">รับทราบ</span>
                <span class="btn bg-info btn-md col-md-3 d-inline-block float-right">เริ่มซ่อม</span>-->
                </div>

    </div>
</div>
<?PHP
        }
    }else{
        echo 'ยังไม่มีงานที่ได้รับมอบหมาย';
    }
?>

</div><!--card-body p-2-->