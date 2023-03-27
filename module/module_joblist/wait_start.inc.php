<style>
</style>
<div class="card-body p-2">



<?PHP
        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine, tb_attachment.path_attachment_name, tb_ref_repairer.* FROM tb_maintenance_request 
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)          
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) 
        LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_maintenance_request.id_maintenance_request AND tb_attachment.attachment_type=1 AND tb_attachment.image_cate=2) 
        LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']." AND 
        tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
        WHERE tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']." ";
        $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY mt_request_date DESC");

    if (count($fetchRow)>0) {
        foreach($fetchRow as $key=>$value){
?>
<div class="card card-row card-warning col-md-3 p-0 mr-3 d-inline-block align-top">
    <div class="card-header"><span class="card-title text-md"><i class="fas fa-file-alt"></i> ใบแจ้งซ่อมเลขที่: <?PHP echo $fetchRow[$key]['maintenance_request_no']; ?></span></div>
    <div class="card-body p-3 m-0">
        <div class="border-bottom pb-2 mb-2"><span class="badge bg-info text-sm"><?PHP echo $fetchRow[$key]['dept_responsibility'];?></span> <span class="badge bg-<?PHP echo $fetchRow[$key]['urgent_type']==1 ? 'danger' : 'warning';?> text-sm"><?PHP echo $fetchRow[$key]['urgent_type']==1 ? 'ด่วน' : 'ไม่ด่วน';?></span><div class="float-right text-sm">วันที่แจ้งซ่อม: 2023-03-27 11:11:11</div></div>
        <div class="text-md text-bold pb-2"><?PHP echo $fetchRow[$key]['name_menu']!='' ? $fetchRow[$key]['name_menu'] : 'ไม่ทราบชื่อ, ไม่ระบุ';?></div>
        <div class="text-sm pb-1"><?PHP echo $fetchRow[$key]['code_machine_site']!='' ? $fetchRow[$key]['code_machine_site'] : '-';?></div>
        <div class="text-sm pb-1"><?PHP echo $fetchRow[$key]['name_machine']!='' ? $fetchRow[$key]['name_machine'] : 'ไม่ทราบชื่อ, ไม่ระบุ';?></div>
        <div class="border-top border-bottom pt-2 pb-2 mb-2 d-block" style="height:80px;"><lebel class="d-block text-bold text-sm">ปัญหาที่พบ:</lebel><?PHP echo $fetchRow[$key]['problem_statement']!='' ? $fetchRow[$key]['problem_statement'] : '';?></div>
        <div class="col-md-4 d-inline-block pl-0">ประเภทงานซ่อม:</div><div class="col-md-7 d-inline-block ">SQL Value</div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">อาคาร:</div><div class="col-md-7 d-inline-block">SQL Value</div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">สถานที่:</div><div class="col-md-7 d-inline-block">SQL Value</div>
        <div class="col-md-4 d-inline-block pl-0 pt-1">ผู้แจ้งซ่อม:</div><div class="col-md-7 d-inline-block">SQL Value</div>
        <?PHP
                if(file_exists($pathReq.$fetchRow[$key]['path_attachment_name']) && !empty($fetchRow[$key]['path_attachment_name'])){
                echo '<div class="divimg_after col-sm-12 mt-2"><img src="'.$pathReq.$fetchRow[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ" /></div>';
                }else{
                $pathReq.$fetchRow[$key]['path_attachment_name'] = $noimg;
                echo '<div class="divimg_after col-sm-12 mt-2"><img src="'.$pathReq.$fetchRow[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ" /></div>';
                }
        ?>
                <div class="m-auto w-100 text-center border-bottom pb-5">
                <span class="btn bg-warning btn-md col-md-5 d-inline-block float-left mb-1">รับทราบ</span> 
                <span class="btn bg-info btn-md col-md-5 d-inline-block float-right">เริ่มซ่อม</span>
                </div>

            


    </div>
</div>
<?PHP
        }
    }
?>


</div><!--card-body p-2-->