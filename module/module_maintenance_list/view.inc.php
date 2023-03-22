<?PHP
switch($denied_requestid){
  case 1:
?>
<script src='plugins/multifile/jquery.MultiFile.js'></script><!--ใช้กับหน้า update_result.inc.php / $action=img_after_repair  -->
<style type="text/css">

.sur_hover:hover { background-color:#eee;}
 
@media only screen and (max-width:640px) {
    /*.card-title{ width:100%;  background-color: #000; padding-bottom:50px ;}*/
}

.showSweetAlert h2{ font-size:1.5rem;}
.showSweetAlert p{ font-size:1rem;}
.btn-gray {    color: #333;    background-color: #e7e7e7;    border-color: #e3e3e3;    box-shadow: none;}
.btn-gray:hover {    background-color: #cccccc;}
.bg-pcs{ background-color:#00387C;} 

.nav-pills .nav-link.active, .nav-pills .show > .nav-link {    background-color: #00387C;}
p.problem_statement{ font-size:1rem; text-indent:15px;}
.w-30{ width: 30%;}
.linehi-170{ line-height:1.60rem;}
.text-size-1{ font-size:0.90rem;}
.text-size-2{ font-size:0.80rem; cursor: pointer;}
.list-group li{ line-height:0.75rem; }
.list-group li span{ line-height:1.0rem; }
.select2-container .select2-selection--single {
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 8%);
    width:100%;
}

.img_lightbox{ overflow:hidden; display: block; z-index: 10; width:100%;}
.doubleUnderline {    text-decoration:underline;    border-bottom: 1px solid #000;}

.card-title{ font-size:1rem;}
.select2-selection__choice{ font-size:1rem; background-color: #ffc107; color:#000;}
.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {    color:#000;}

.hv:hover{ background-color:#eaeaea;}

.img-wrap {    position: relative; cursor: pointer;}
.img-wrap .close {
    position: absolute;
    top:-2px;
    right:2px;
    z-index:500; display:block; opacity:0.7; font-size:1rem;
  }
</style>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<?PHP 
  if($rowData['status_approved']==1 && $rowData['maintenance_request_status']!=2){
    include_once 'module/module_maintenance_list/frm_change_approved.inc.php'; #หน้าเปลี่ยน-เพิ่มช่างซ่อม
  }else{
    include_once 'module/module_maintenance_list/frm_approved.inc.php'; #หน้าอนุมัติ,จ่ายงานซ่อม
  }
  include_once 'module/module_maintenance_list/frm_update_result.inc.php'; #หน้าอัพเดทผลการซ่อม
  include_once 'module/module_maintenance_list/frm_cancel.inc.php'; #หน้ายกเลิกใบแจ้งซ่อม
  include_once 'module/module_maintenance_list/frm_maintenance_type.inc.php'; #อัพเดทประเภทใบแจ้งซ่อม
  include_once 'module/module_maintenance_list/frm_problem_statement.inc.php'; #อัพเดทอาการเสีย/ปัญหาที่พบ
  include_once 'module/module_maintenance_list/frm_outsite_repair.inc.php'; #อัพเดทส่งซ่อมภายนอก
  include_once 'module/module_maintenance_list/frm_change_parts.inc.php';#อัพเดทรายการอะไหล่ที่เปลี่ยน
  include_once 'module/module_maintenance_list/frm_img_after_repair.inc.php';#อัพเดทรูปหลังซ่อม
  include_once 'module/module_maintenance_list/frm_satisfaction_surey.inc.php';#อัพเดทรูปหลังซ่อม
        
  ##ลิงค์โค๊ดส่วนที่ 1
  if($rowData['status_approved']==1){//ถ้าอนุมัติแล้ว จะคิวรี่ผู้รับผิดชอบมารอไว้
    $rowMechanic = $obj->fetchRows("SELECT tb_user.id_user, tb_user.fullname, tb_ref_repairer.* FROM tb_ref_repairer 
    LEFT JOIN tb_user ON (tb_user.id_user=tb_ref_repairer.ref_id_user_repairer) WHERE tb_ref_repairer.ref_id_maintenance_request=".$rowData['id_maintenance_request']." AND tb_ref_repairer.status_repairer=1 ORDER BY tb_ref_repairer.id_ref_repairer ASC");
    ##เช็คว่าไอดีใน $_SESSION['sess_id_user'] ตรงกับ $rowMechanic ถ้าตรงจะแสดงปุ่มรับงาน-ปฏิเสธ
    $chk_id_result = array_search($_SESSION['sess_id_user'], array_column($rowMechanic, 'id_user', 'id_user'));
  }  
?>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
</div>

<br />
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-main card-primary card-outline position-relative ">

                <?PHP if($rowData['status_approved']==NULL && $rowData['maintenance_request_status']!==2){?>
                  <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-warning text-lg">รออนุมัติ</div>
                </div>
                  <?PHP } ?>
                  <?PHP if($rowData['allotted_date']!=NULL && $rowData['allotted_accept_date']==''){?>
                  <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-warning text-lg">รอรับงาน</div>
                </div>
                  <?PHP } ?>
                  <?PHP if($rowData['allotted_date']!=NULL && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']=='' ){?>
                  <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-warning text-lg">รอซ่อม</div>
                </div>
                  <?PHP } ?>
                  <?PHP if($rowData['allotted_date']!=NULL && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']!=NULL ){?>
                  <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-warning text-lg">กำลังซ่อม</div>
                </div>
                  <?PHP } ?>                  
                <?PHP if($rowData['maintenance_request_status']==2){?>
                <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-danger text-lg">ยกเลิก</div>
                </div>
                <?PHP } ?>
              <div class="card-body box-profile">

                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="dist/img/mt_request/icon_view.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">สถานะการซ่อม: ???</h3>
                <p class="text-muted text-center">วันที่อัพเดท: 00/00/0000</p>

                <ul class="list-group list-group-unbordered mb-1">
                <?PHP if($rowData['maintenance_request_status']==2){?>
                  <li class="list-group-item">
                    <b class="text-red">ใบแจ้งซ่อมถูกยกเลิก</b> 
                      <span class="d-block pt-2 pl-3">สาเหตุ: <?PHP echo $rowData['cause_mt_request_cancel']." (".$rowData['cancel_fullname']." วันที่ยกเลิก: ".nowDate($rowData['date_mt_request_cancel'])." เวลา:".nowTime($rowData['date_mt_request_cancel']).")";?>	</span>
                  </li>
                <?PHP } ?>
                <li class="list-group-item text-red">
                    <b>ความเร่งด่วน</b> <span class="float-right"> <?PHP echo $rowData['urgent_type']==1 ? '<i class="fas fa-lightbulb fa-1x"></i> '.$urgentArr[$rowData['urgent_type']] : '<span class="text-green">'.$urgentArr[$rowData['urgent_type']].'</span>';?></span>
                  </li>
                  <li class="list-group-item">
                    <b>ประเภทใบแจ้งซ่อม</b> <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){?><button type="button" class="btn btn-default btn-sm float-right btn-update-type ml-2" data-toggle="modal" data-target="#modal-maintenance_type" id="btn_maintenance_type" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button> <?PHP } ?>
                      <span class="d-block pt-2 pl-3 span_mt_type"><?PHP echo $rowData['name_mt_type']!='' ? '- '.$rowData['name_mt_type'] : '- ยังไม่ระบุ';?>	</span>
                  </li>
                  <li class="list-group-item bg-hover">
                    <b>ประเภทงานซ่อม</b> <span class="float-right"> <?PHP echo  $rowData['ref_id_job_type']!=NULL ? $ref_id_job_typeArr[$rowData['ref_id_job_type']] : '-';?></span>
                  </li>                                    
                  <li class="list-group-item ">
                    <b>เกี่ยวกับความปลอดภัย</b>
                    <?PHP 
                        switch($rowData['related_to_safty']){
                          case 1:
                            echo '<span class="float-right text-red">'.$related_to_saftyArr[$rowData['related_to_safty']].'</span>';
                          break;
                          case 2:
                            echo '<span class="float-right text-success">'.$related_to_saftyArr[$rowData['related_to_safty']].'</span>';
                          break;
                          case NULL :
                          default:
                          echo '<span class="float-right">-</span>';
                          break;
                        }
                    ?></li>
                <li class="list-group-item">
                    <b>แผนกที่รับผิดชอบ</b> <span class="float-right"><?PHP echo $rowData['dept_responsibility']; ?></span>
                  </li>
                  <li class="list-group-item">
                    <b>วันที่แจ้งซ่อม</b> <span class="float-right"><?PHP echo $rowData['mt_request_date'];?></span>
                  </li>
                  <?PHP if($rowData['status_approved']==1){?>
                  <li class="list-group-item">
                    <b>อนุมัติและจ่ายงานเมื่อ</b> <span class="float-right text-right"> <?PHP echo $rowData['allotted_date'];?><br/> โดย: <?PHP echo $rowData['approved_fullname'];?></span>
                  </li>
                <?PHP }?>
                <?PHP if($rowData['allotted_accept_date']!=''){?>
                  <li class="list-group-item">
                    <b>รับทราบ,รับงานซ่อมเมื่อ</b> <span class="float-right text-right"> <?PHP echo $rowData['allotted_accept_date'];?><br/> โดย: <?PHP echo $rowData['approved_fullname'];?></span>
                  </li>
                <?PHP }?>
                <li class="list-group-item">
                    <b>วันที่เริ่มซ่อม</b> <span class="float-right text-right"><?PHP echo $rowData['duration_serv_start']!='' ? $rowData['duration_serv_start'] : '-';?></span>
                  </li>
                  <li class="list-group-item">
                    <b>วันที่ปิดงาน</b> <span class="float-right text-right"><?PHP echo $rowData['hand_over_date']!='' ? $rowData['hand_over_date'] : '-';?></span>
                  </li>
                  <li class="list-group-item"><?PHP //echo $time_elapsed = timeAgo('2023-03-09 14:00:22'); //The argument $time_ago is in timestamp (Y-m-d H:i:s)format.?>
                    <b>ใช้เวลาซ่อมไปแล้ว</b> <span class="float-right text-right"><?PHP echo $rowData['duration_serv_start']!='' ? timeAgo($rowData['duration_serv_start']) : '-';?></span>
                  </li>
                </ul>

                <?PHP if($rowData['status_approved']==NULL && $rowData['maintenance_request_status']==1 && ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4)){ //รออนุมัติ/หรือไม่อนุมัติ?>
                    <button type="button" class="btn btn-success btn-block btn-approved" data-toggle="modal" data-target="#modal-approved" id="addData" data-backdrop="static" data-keyboard="false"> อนุมัติ, จ่ายงานซ่อม</button>
                    <a href="#" class="btn btn-warning btn-block btn-disapprove">ไม่อนุมัติใบแจ้งซ่อม</a>
                <?PHP }?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']==NULL && $rowData['maintenance_request_status']==1){ ?>
                    <?PHP if(($chk_id_result == $_SESSION['sess_id_user'] && $rowData['status_approved']==1) || $_SESSION['sess_class_user']==4){ ##เช็คว่าคนที่เปิดดูหน้านี้ใช้ผู้รับผิดชอบหรือไม่ ?>
                      <a href="#" class="btn btn-success btn-block btn-accept_date">รับทราบ, รับงานซ่อม</a>
                      <a href="#" class="btn btn-warning btn-block">ปฎิเสธรับงาน</a>
                      <?PHP } ?>
                <?PHP } ?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']==NULL && $rowData['maintenance_request_status']==1){?>
                    <a href="#" class="btn btn-warning btn-block btn-start_repair">เริ่มซ่อม</a>
                <?PHP } ?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']!=NULL && $rowData['maintenance_request_status']==1){?>
                    <a href="#" class="btn btn-success btn-block">ปิดงาน</a>
                <?PHP } ?>
                <?PHP if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4 && $rowData['maintenance_request_status']==1){?>
                <button type="button" class="btn btn-danger btn-block btn-cancel" data-toggle="modal" data-target="#modal-cancel" id="addData" data-backdrop="static" data-keyboard="false"> ยกเลิกใบแจ้งซ่อม</button>
                <?PHP } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header" style="background-color:#00387C;">
                <h3 class="card-title ">สถานะเครื่องจักร-อุปกรณ์</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Title Wait</strong>
                <p class="text-muted">Coming Soon</p>
                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Title Wait</strong>
                <p class="text-muted">Coming Soon</p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Title Wait</strong>
                <p class="text-muted">Coming Soon</p>
                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Title Wait</strong>
                <p class="text-muted">Coming Soon</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">รายละเอียด</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">ไทม์ไลน์</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ติดตามงานซ่อม</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="activity">

              <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-user"></i> ผู้แจ้งซ่อม: </div><br>
              <div class="row invoice-info linehi-170">
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">ชื่อผู้แจ้งซ่อม:</strong> <?PHP echo $rowData['fullname']!='' ? $rowData['fullname'] : '-';?> <?PHP echo $rowData['dept_user_request']!='' ? '('.$rowData['dept_user_request'].')' : '-';?><br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">รหัสพนักงาน:</strong> <?PHP echo $rowData['no_user']!='' ? $rowData['no_user'] : '-';?><br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">อีเมล์:</strong> <?PHP echo $rowData['email']!='' ? $rowData['email'] : '-';?><br>
                </div>
                <!-- /.col -->
              </div>
              
              <div class="card-title d-block text-bold w-100 border-bottom pb-1 mt-3 mb-2"><i class="fas fa-users-cog"></i> ผู้รับผิดชอบงานซ่อม: <?PHP if($rowData['status_approved']==1 && $rowData['maintenance_request_status']!=2){?><button type="button" class="btn btn-default btn-sm btn-change-approved" data-toggle="modal" data-target="#modal-change-approved" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> เปลี่ยน-เพิ่ม ผู้รับผิดชอบ</button><?PHP } ?></div><br>
              <div class="row invoice-info linehi-170">
                <?PHP if($rowData['status_approved']!=1){?>
                        <div class="m-auto d-block pt-3 pb-3 text-center text-gray">ยังไม่กำหนดผู้รับผิดชอบ</div>
                <?PHP } else{ ?>
              <?PHP
                ##ลิงค์โค๊ดส่วนที่ 1
                if (count($rowMechanic)!=0) {
                    $i = 1;
                    foreach($rowMechanic as $key => $value) {
                        echo '<div class="col-sm-4 invoice-col"><strong class="d-inline-block w-30">ผู้รับผิดชอบ'.(count($rowMechanic)>1 ? 'คนที่ '.$i.': ' : ': ').'</strong> '.$rowMechanic[$key]['fullname'].'</div>';
                        //echo '<span>'.$i.'. '.$rowMechanic[$key]['fullname'].'</span>';
                        $i++;
                    }
                }
              ?>
                <?PHP }?>
              </div>

                <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2 mt-3"><i class="fas fa-industry"></i> เครื่องจักร-อุปกรณ์ที่แจ้งซ่อม: </div><br>
                <div class="row invoice-info text-left linehi-170">
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">ประเภทเครื่องจักร:</strong> <?PHP echo !empty($rowMachine['name_menu']) ? $rowMachine['name_menu'] : '-';?><br>
                    <strong class="d-inline-block w-30">ชื่ออุปกรณ์:</strong> <?PHP echo !empty($rowMachine['name_machine']) ? $rowMachine['name_machine'] : 'ไม่ทราบชื่อ, ไม่ระบุ';?><br>
                    <strong class="d-inline-block w-30">ไซต์งาน:</strong> <?PHP echo !empty($rowMachine['site_initialname']) ? $rowMachine['site_initialname'] : '-';?><br>
                </div><!-- /.col -->

                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">ซีเรียลนัมเบอร์:</strong> <?PHP echo !empty($rowMachine['serial_number']) ? $rowMachine['serial_number'] : '-';?><br>
                    <strong class="d-inline-block w-30">ชื่อรุ่น:</strong> <?PHP echo !empty($rowMachine['model_name']) ? $rowMachine['model_name'] : '-';?><br>
                    <strong class="d-inline-block w-30">อาคาร:</strong> <?PHP echo !empty($rowMachine['building_name']) ? $rowMachine['building_name'] : '-';?><br>
                </div><!-- /.col -->

                <div class="col-sm-4 invoice-col">
                <strong class="d-inline-block w-30">รหัสเครื่องจักร:</strong> <?PHP echo !empty($rowMachine['code_machine_site']) ? $rowMachine['code_machine_site'] : '-';?><br><br>
                <strong class="d-inline-block w-30">สถานที่:</strong> <?PHP echo !empty($rowMachine['location_name']) ? $rowMachine['location_name'] : '-';?><br>
                </div><!-- /.col -->                

                <div class="col-sm-12 mt-3 ">
                <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2 text-red"><i class="fas fa-info-circle"></i> อาการเสีย/ปัญหาที่พบ: 
                <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?>
                <button type="button" class="btn btn-default btn-sm btn-problem_statement"  data-toggle="modal" data-target="#modal-problem_statement" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP } ?></div><br>
                    <p class="problem_statement"><?PHP echo $rowData['problem_statement'];?></p>
                </div><!-- /.col -->                
              </div><!-- /.row -->

              <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายอาการเสีย / ปัญหาที่พบ: </div><br />  
              <div class="row divimg_before_null">
                <?PHP
                  $rowImg= $obj->fetchRows("SELECT * FROM tb_attachment WHERE ref_id_used=".$rowData['id_maintenance_request']." AND attachment_type=1 AND image_cate=2");                 
                  if (count($rowImg)>0) {
                    $i = 1;
                    foreach($rowImg as $key => $value) {
                      if(file_exists($pathReq.$rowImg[$key]['path_attachment_name'])){
                        echo '<div class="divimg_before divimg_'.$rowImg[$key]['id_attachment'].' col-sm-2"><div class="img-wrap"><span class="close text-danger del-img" data-id="'.$rowImg[$key]['id_attachment'].'" data-class="divimg_before">&times;</span></div><div class="position-relative">'.($rowImg[$key]['path_attachment_name']=='' ? '' : '<a href="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" data-toggle="lightbox" data-title="'.$title_act.'" data-gallery="gallery" class="img_lightbox"><img src="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ"></a>').'</div></div>';
                      }else{
                        $pathReq.$rowImg[$key]['path_attachment_name'] = $noimg;
                        echo '<div class="divimg_before divimg_'.$rowImg[$key]['id_attachment'].' col-sm-2"><div class="img-wrap"><span class="close text-danger del-img" data-id="'.$rowImg[$key]['id_attachment'].'" data-class="divimg_before">&times;</span></div><div class="position-relative">'.($rowImg[$key]['path_attachment_name']=='' ? '' : '<a href="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" data-toggle="lightbox" data-title="'.$title_act.'" data-gallery="gallery" class="img_lightbox"><img src="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ"></a>').'</div></div>';
                      }
                        $i++;
                    }
                  }else{
                      echo '<div class="m-auto d-block pt-3 pb-3 text-center text-gray">ไม่มีรูปภาพ</div>';
                  }
                ?>
              </div><!-- /.row -->
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-clipboard-check"></i> สรุปผลการซ่อม: 
              <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?><button type="button" class="btn btn-default btn-sm btn-repair_results" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">รหัสอาการเสีย:</strong> <?PHP echo $rowData['failure_code_th_name']=='' ? ($rowData['ref_id_failure_code']=='' ? '-' : $rowData['ref_id_failure_code']) : $rowData['failure_code_th_name'];?><br>
                    <strong class="d-inline-block w-25">สาเหตุของปัญหา:</strong> <?PHP echo $rowData['txt_caused_by']=='' ? '-' : $rowData['txt_caused_by'];?><br>
                </div><!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">รหัสซ่อม:</strong> <?PHP echo $rowData['repair_code_name']=='' ? ($rowData['ref_id_repair_code']=='' ? '-' : $rowData['ref_id_repair_code']) : $rowData['repair_code_name'];?><br>
                    <strong class="d-inline-block w-25">วิธีการแก้ไข:</strong> <?PHP echo $rowData['txt_solution']=='' ? '-' : $rowData['txt_solution'];?><br>
                </div><!-- /.col -->
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-truck"></i> ส่งซ่อมภายนอก: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?><button type="button" class="btn btn-default btn-sm btn-update_outsite" data-toggle="modal" data-target="#modal-outsite_repair" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">สาเหตุที่ส่งซ่อม:</strong> <?PHP echo $rowData['caused_outsite_repair']=='' ? '-' : $rowData['caused_outsite_repair'];?><br>
                    <strong class="d-inline-block w-25">ซัพพลายเออร์:</strong> <?PHP echo $rowData['supplier_name']=='' ? $rowData['ref_id_supplier'] : $rowData['supplier_name'];?><br>
                </div><!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">วันที่ส่งซ่อม:</strong> <?PHP echo $rowData['datesent_repair']=='' ? '-' : nowDateShort($rowData['datesent_repair']);?><br>
                    <strong class="d-inline-block w-25">วันที่ส่งคืน:</strong> <?PHP echo $rowData['dateresive_repair']=='' ? '-' : nowDateShort($rowData['dateresive_repair']);?><br>
                </div><!-- /.col -->                
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-tools"></i> รายการอะไหล่ที่เปลี่ยน: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?><button type="button" class="btn btn-default btn-sm btn-change_parts" data-toggle="modal" data-target="#modal-change_parts" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP }?></div><br>  
                <!-- Table row -->
                <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped tb_parts">
                    <thead>
                    <tr class="bg-light">
                      <th>#</th>
                      <th>S/N No.</th>
                      <th>ชื่ออะไหล่</th>
                      <th>รายละเอียด</th>
                      <th class="text-right">ราคาบาท/ชิ้น</th>
                      <th class="text-right">จำนวน/ชิ้น</th>
                      <th class="text-right">รวม/บาท</th>
                      <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                          $grand_total = 0;
                          $rowParts = $obj->fetchRows("SELECT * FROM tb_change_parts WHERE ref_id_maintenance_request=".$rowData['id_maintenance_request']." ORDER BY id_parts ASC");
                          if (count($rowParts)!=0) {
                            $i = 1;
                              foreach($rowParts as $key => $value) {
                                  echo '<tr class="tr_partid_'.$rowParts[$key]['id_parts'].'">';
                                  echo '<td class="td_no">'.$i.'.</td>';
                                  echo '<td>'.$rowParts[$key]['parts_serialno'].'</td>';
                                  echo '<td>'.$rowParts[$key]['parts_name'].'</td>';
                                  echo '<td>'.$rowParts[$key]['parts_description'].'</td>';
                                  echo '<td class="text-right">'.number_format($rowParts[$key]['parts_price'],2).'</td>';
                                  echo '<td class="text-right">'.number_format($rowParts[$key]['parts_qty'],0).'</td>';
                                  echo '<td class="text-right subTotal">'.(number_format(($rowParts[$key]['parts_price']*$rowParts[$key]['parts_qty']),2)).'</td>';
                                  echo '<td><button type="button" class="btn btn-danger btn-sm p-0 px-1 m-0" data-id="'.$rowParts[$key]['id_parts'].'" title="ลบรายการนี้" id="btn-del_parts"><i class="fa fa-trash-alt"></i></button>
                                  <button type="button" class="btn btn-warning btn-sm btn-edit_part p-0 px-1 m-0" data-id="'.$rowParts[$key]['id_parts'].'" data-toggle="modal" data-target="#modal-change_parts" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button></td>';
                                  echo '</tr>';
                                  $i++;
                                  $grand_total+=$rowParts[$key]['parts_price']*$rowParts[$key]['parts_qty'];
                              }
                          } else {
                              echo '<tr class="bg-white"><td colspan="8" class="text-center text-gray">ไม่มีรายการเปลี่ยนอะไหล่</td></tr>';
                          }
                    ?>
                        <tr class="bg-light">
                          <td colspan="6" class="text-right">รวมค่าอะไหล่ทั้งหมด(บาท):</td>
                          <td class="text-right"><div class="doubleUnderline d-inline grand_total"><?PHP echo number_format($grand_total,2)?></div></td>
                          <td>บาท.</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>                
                <!-- /Table row -->
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายหลังซ่อม: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?><button type="button" class="btn btn-default btn-sm btn-img_after"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP }?></div><br>  
              <div class="row divimg_after_null">
                  <?PHP
                  $rowImg= $obj->fetchRows("SELECT * FROM tb_attachment WHERE ref_id_used=".$rowData['id_maintenance_request']." AND attachment_type=1 AND image_cate=3");                 
                  if (count($rowImg)>0) {
                    $i = 1;
                    foreach($rowImg as $key => $value) {
                      if(file_exists($pathReq.$rowImg[$key]['path_attachment_name'])){
                        echo '<div class="divimg_after divimg_'.$rowImg[$key]['id_attachment'].' col-sm-2"><div class="img-wrap"><span class="close text-danger del-img" data-id="'.$rowImg[$key]['id_attachment'].'" data-class="divimg_after">&times;</span></div><div class="position-relative">'.($rowImg[$key]['path_attachment_name']=='' ? '' : '<a href="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" data-toggle="lightbox" data-title="'.$title_act.'" data-gallery="gallery" class="img_lightbox"><img src="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ"></a>').'</div></div>';
                      }else{
                        $pathReq.$rowImg[$key]['path_attachment_name'] = $noimg;
                        echo '<div class="divimg_after divimg_'.$rowImg[$key]['id_attachment'].' col-sm-2"><div class="img-wrap"><span class="close text-danger del-img" data-id="'.$rowImg[$key]['id_attachment'].'" data-class="divimg_before">&times;</span></div><div class="position-relative">'.($rowImg[$key]['path_attachment_name']=='' ? '' : '<img src="'.$pathReq.$rowImg[$key]['path_attachment_name'].'" class="img-fluid img-rounded mb-2" alt="ภาพถ่ายอาการเสีย / ปัญหาที่พบ">').'</div></div>';
                      }
                        $i++;
                    }
                  }else{
                      echo '<div class="m-auto d-block pt-3 pb-3 text-center text-gray ">ไม่มีรูปภาพ</div>';
                  }
                ?>
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-chart-bar"></i> ประเมินผลการซ่อม: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1 && $rowData['maintenance_request_status']!=2){ ?><button type="button" class="btn btn-default btn-sm btn-survey"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                    <?PHP
                    $rowSurvey = $obj->fetchRows("SELECT * FROM tb_satisfaction_survey WHERE ref_id_maintenance_request=".$rowData['id_maintenance_request']." ORDER BY ref_topic_survey ASC");
                      if (count($rowSurvey)!=0) {
                        $score = 0;
                          foreach($rowSurvey as $key => $value) {
                              $score+=$rowSurvey[$key]['score_result'];
                          }
                          $score_result = $score/count($arrTopicSurvey)*100;
                          if($score_result<=30){
                              $bg_progress = 'bg-danger';
                          }else if($score_result>=31 && $score_result<=74){
                            $bg_progress = 'bg-warning';
                          }else if($score_result>=75){
                            $bg_progress = 'bg-green';
                          }else{
                            $bg_progress = 'bg-gray';
                          }
                      }else{
                        $score_result = 0;
                          $bg_progress = 'bg-gray';
                      }
                    ?>
                      <div class="col col-sm-3">
                        <!-- /.survey-1-->
                        <strong class="d-inline-block w-100">คะแนน:</strong>
                        <div class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar <?PHP echo $bg_progress; ?>" role="progressbar" aria-valuenow="<?PHP echo $score_result;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?PHP echo $score_result;?>%">
                              </div>
                          </div>
                          <h3><?PHP echo $score_result;?>%</h3>
                      </div>
                        <!-- /.survey-1-->
                      </div>
                      <div class="col col-sm-9">
                            <label>ข้อเสนอแนะ:</label>
                            <p class="recomment" id="recomment"><?PHP echo $rowData['recomment']!='' ? $rowData['recomment'] : '-';?></p>
                      </div>
                <?PHP
                      $choice_survey_1 = '';
                      $choice_survey_2 = '';
                      if (count($rowSurvey)!=0) {
                          foreach($rowSurvey as $key => $value) {                
                            $rowSurvey[$key]['score_result']==1 ? $show_pass= '<span class="w-auto float-right text-success"><i class="fas fa-check-circle"></i> ผ่าน</span>' : $show_pass='<span class="w-auto float-right text-danger"><i class="fas fa-times-circle"></i> ไม่ผ่าน</span>';
                            if($key%2==0){ //หา key (ข้อ)เลขคู่
                              $choice_survey_1.= '<div class="d-inline-block w-100"><label>'.($key+1).'. '.$arrTopicSurvey[$rowSurvey[$key]['ref_topic_survey']].':</label> '.$show_pass.'</div>';
                            }else{
                              $choice_survey_2.= '<div class="d-inline-block w-100"><label>'.($key+1).'. '.$arrTopicSurvey[$rowSurvey[$key]['ref_topic_survey']].':</label> '.$show_pass.'</div>';
                            }
                          }
                        }else{
                            foreach($arrTopicSurvey as $index => $value){
                              if($index%2==0){ //หา index (ข้อ)เลขคู่
                                $choice_survey_1.= '<div class="d-inline-block w-100"><label>'.($index+1).'. '.$value.':</label> <span class="w-auto float-right text-gray">-</div>';
                              }else{
                                $choice_survey_2.= '<div class="d-inline-block w-100"><label>'.($index+1).'. '.$value.':</label> <span class="w-auto float-right text-gray">-</div>';
                              }
                            }
                        }
                ?>
                <div class="col-name-1 col-sm-4">
                  <?PHP echo $choice_survey_1;?>
                </div><!-- /.col -->

              <div class="col-name-1 col-sm-2">
              </div>                

                <div class="col-name-1 col-sm-4">
                  <?PHP echo $choice_survey_2;?>
                </div><!-- /.col -->             

                <div class="row mt-3">
                <div class="col-sm-6 border-bottom">
                      <div class="col col-sm-6 m-auto text-center">
                            <span>ลายเซ็นของผู้ประเมิณ:</span>
                            <img src="upload-signature/signature.png" class=" w-75" />
                            <p>ชื่อ-นามสกุล: <?PHP echo $rowData['fullname_survay']!='' ? $rowData['fullname_survay'] : '-';?><br />วันที่ประเมิณ <?PHP echo $rowData['survay_date']!='' ? nowDate($rowData['survay_date']) : '-';?></p>
                      </div>
                </div>
                <div class="col-sm-6 border-bottom">
                      <div class="col col-sm-6 m-auto text-center">
                            <span>ลายเซ็นของหน่วยงานควบคุมคุณภาพ:</span>
                            <img src="upload-signature/signature.png" class=" w-75" />
                            <p>ชื่อ-นามสกุล: -<br />วันที่ประเมิณ -</p>
                      </div>
                </div>
                </div>

              </div><!-- /.row -->         
              
            </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="timeline">         
                    <?PHP 
                      if($id=='show'){
                    ?>          
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">เปิดใบแจ้งซ่อม</a> ปปปป/ดด/วว</h3>

                          <div class="timeline-body">ชื่อเครื่องจักร / อาการเสีย / ผู้แจ้ง
                          </div>

                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                    <?PHP 
                      }else{
                        echo 'Coming Soon.';
                      }
                    ?>
                  </div>
                  <!-- /.timeline tab-pane -->

                  <div class="tab-pane" id="settings">
                    <?PHP 
                      if($id=='show'){
                    ?>
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <?PHP 
                      }else{
                        echo 'Coming Soon.';
                      }
                    ?>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!-- end Main content -->

</div><!-- /.card -->

</section>
<!-- /.content -->


<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">


<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>  
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">

  <!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


<script type="text/javascript"> 

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
});


$(document).on("click", ".btn-update_outsite", function (e){ 
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"update_outsite","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-outsite_repair").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });
});

$(document).on("click", "#btn-del_parts", function (e){ 
    var parts_id = $(this).data("id");
    swal({
        title: "ยืนยันลบอะไหล่รายการนี้ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        cancelButtonText: "ไม่, ยกเลิก",
        confirmButtonText: "ตกลง",
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{ "action":"del_parts", ref_id:<?PHP echo $rowData['id_maintenance_request'];?>, "parts_id":parts_id},
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                event.stopPropagation();
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }else{
                  $('.tr_partid_'+parts_id).remove();
                    var tr_partid = $('tr[class^=tr_partid_]').length;
                    var num_tr = 0;
                    var grand_total = 0;
                    $(".tb_parts tr").each(function(){
                        $(this).find('td.td_no').text(num_tr+'.'); //td_no //td:eq(0)
                        subTotal = $(this).find('td:eq(6)').text();
                        subTotal = subTotal.replace(/,/g , '');
                        if(subTotal!='' && typeof(subTotal)!="undefined"){ 
                          subTotal = parseFloat(subTotal); 
                        }else{
                          subTotal = 0; 
                        }
                        grand_total+= parseFloat(subTotal);
                        num_tr++;
                    });
                  $('.grand_total').text(addCommas(grand_total.toFixed(2)));
                }
                swal({
                    title: "ลบข้อมูลเรียบร้อย.",
                    //text: "คลิก \"OK\" เพื่อปิดหน้าต่างนี้",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    //window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
    event.preventDefault();    
    event.stopPropagation();
});

$(document).on("click", ".del-img", function (e){ 
  var img_id = $(this).data("id");
  var class_name= $(this).data("class");  
  swal({
        title: "ยืนยันการลบรูปภาพนี้ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        cancelButtonText: "ไม่, ยกเลิก",
        confirmButtonText: "ตกลง",
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{ "action":"delimg", ref_id:<?PHP echo $rowData['id_maintenance_request'];?>, "img_id":img_id},
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                event.stopPropagation();
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }else{
                  $('.divimg_'+img_id).remove();
                  if(class_name=='divimg_before'){
                    if($('.divimg_before').length==0){
                      $('.divimg_before_null').html('<div class="m-auto d-block pt-3 pb-3 text-center text-gray">ไม่มีรูปภาพ</div>');
                    }
                  }else{
                    if($('.divimg_after').length==0){
                      $('.divimg_after_null').html('<div class="m-auto d-block pt-3 pb-3 text-center text-gray">ไม่มีรูปภาพ</div>');
                    }
                  }
                }
                swal({
                    title: "ลบข้อมูลเรียบร้อย.",
                    //text: "คลิก \"OK\" เพื่อปิดหน้าต่างนี้",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    //window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
    event.preventDefault();    
    event.stopPropagation();
});

$(document).on("click", ".btn-img_after", function (e){ 
  hand_over_date = '';
  if(hand_over_date!=''){
    sweetAlert("ผิดพลาด!", "ผู้ซ่อมต้องสรุปผลการซ่อมก่อน\r\n จึงจะอัพโหลดรูปหลังซ่อมได้", "error");
    return false;
  /*
$rowData['failure_code_th_name']
$rowData['txt_caused_by']
$rowData['repair_code_name']
$rowData['txt_solution']
  */
  }else{
    e.stopPropagation();
    $.ajax({
        url: "module/module_maintenance_list/update_result.inc.php",
        type: "POST",
        data:{"action":"img_after_repair","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>},
        beforeSend: function () {
        },
        success: function (data) {
          console.log(data);
          $('#modal-img_after_repair').modal({backdrop: 'static', keyboard: false}, 'show');
          $(".modal-img_after_repair").html(data);
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            //alert(errorThrown);
            swal("Error!", ""+errorThrown+"", "error");
        }
    });
  }
});

$(document).on("click", ".btn-survey", function (e){ 
  var checkDate = '<?PHP echo $rowData['survay_date'];?>';
  var recomment = $('p.recomment').text();
  if(checkDate==''){
    sweetAlert("ผิดพลาด!", "ผู้ซ่อมต้องปิดงานซ่อมก่อน \r\n จึงจะประเมิณผลการซ่อมได้", "error");
    return false;
  }else{
    e.stopPropagation();
    $.ajax({
        url: "module/module_maintenance_list/update_result.inc.php",
        type: "POST",
        data:{"action":"satisfaction_survey","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "recomment":recomment},
        beforeSend: function () {
        },
        success: function (data) {
          //console.log(data);
          $('#modal-satisfaction_survey').modal({backdrop: 'static', keyboard: false}, 'show');
          $(".modal-satisfaction_survey").html(data);
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            //alert(errorThrown);
            swal("Error!", ""+errorThrown+"", "error");
        }
    });
  }
});


$(document).on("click", ".btn-problem_statement", function (e){ 
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"update_problem_statement","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-update_problem_statement").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });
});

$(document).on("click", ".btn-start_repair", function (event){ 
  swal({
        title: "ยืนยันเริ่มซ่อมใบงานนี้ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{ "action":"start_repair", ref_id:<?PHP echo $rowData['id_maintenance_request']; ?>},
            /*dataType: "json",
            processData: false,
            contentType: false,
            data: frm_Data, */
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                event.stopPropagation();
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }
                swal({
                    title: "เริ่มบันทึกระยะเวลาซ่อมแล้ว.",
                    text: "หากซ่อมงานเรียบร้อยแล้วคลิกที่ปุ่ม \"ปิดงาน\"",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
    event.preventDefault();    
    event.stopPropagation();
});


$(document).on("click", ".btn-accept_date", function (event){ 
  swal({
        title: "ยืนยันรับทราบ, รับงานซ่อม ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{ "action":"accept_request", ref_id:<?PHP echo $rowData['id_maintenance_request']; ?>},
            /*dataType: "json",
            processData: false,
            contentType: false,
            data: frm_Data, */
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                event.stopPropagation();
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }
                swal({
                    title: "รับงานซ่อมนี้เรียบร้อย.",
                    text: "หากต้องต้องซ่อมงานนี้ทันที ให้คลิกที่ปุ่ม \"เริ่มซ่อม\"",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    //window.location.href = '?module=requestid&id='+data+'';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
    event.preventDefault();    
    event.stopPropagation();
});

$(document).on("click", ".btn-submit_result", function (event){ 
    var formAdd = document.getElementById('needs-validation8');  
    var frmData = $("form#needs-validation8").serialize();

    slt_failure_code = $("#slt_failure_code option:selected" ).val();
    txt_failure_code = $('#txt_failure_code').val();
    slt_repair_code = $("#slt_repair_code option:selected" ).val();
    txt_repair_code = $('#txt_repair_code').val();
    txt_solution = $('#txt_solution').val();
    txt_caused_by = $('#txt_caused_by').val();

if(slt_failure_code=='' && txt_failure_code==''){    swal("ผิดพลาด!", "ระบุรหัสอาการเสีย", "error");    return false;}
if(slt_failure_code=='custom' && txt_failure_code==''){    swal("ผิดพลาด!", "กรอกอาการเสีย", "error");    return false;}
if(txt_caused_by==''){    swal("ผิดพลาด!", "ระบุสาเหตุของปัญหา", "error");    return false;}
if(slt_repair_code=='' && txt_repair_code==''){    swal("ผิดพลาด!", "ระบุรหัสซ่อม", "error");    return false;}
if(slt_repair_code=='custom' && txt_repair_code==''){    swal("ผิดพลาด!", "กรอกรหัสซ่อม", "error");    return false;}
if(txt_solution==''){    swal("ผิดพลาด!", "ระบุวิธีการแก้ไข/ป้องกันเกิดปัญหาซ้ำ", "error");    return false;}

if(txt_failure_code!=''){  $("#slt_failure_code option[value=custom]").attr("selected","selected");}
if(txt_repair_code!=''){  $("#slt_repair_code option[value=custom]").attr("selected","selected");}

    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{"data":frmData, "action":"report_result",  "ref_id":<?PHP echo $id; ?>},
            beforeSend: function () {
            },
            success: function (data) {
            console.log(data); //return false;
            $("#modal-repair_results").modal('hide');
            if(data==''){
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error"); return false;
            }else{
              swal({
                    title: "สำเร็จ!",
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);return false;
                    //alert(ref_id);
                    window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
                })
                //sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
            }   
                event.preventDefault();
            },
                error: function (jXHR, textStatus, errorThrown) {
                //console.log(data);
                //alert(errorThrown);
            }
        });    
        event.preventDefault();    
    }
    //alert('Ajax'); return false;
    formAdd.classList.add('was-validated');      
    return false;
});

$(document).on("click", ".btn-update-type", function (e){ 
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"update_type","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "ref_mt_type":<?PHP echo $rowData['ref_id_mt_type']; ?>, "ref_id_dept":<?PHP echo $rowData['ref_id_dept_responsibility']; ?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-update-type").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });
});

$(document).on("click", ".btn-edit_part", function (e){
  var parts_id = $(this).data("id");
  $('.text-title-parts').text('แก้ไขรายการอะไหล่ที่เปลี่ยน');
  //alert(parts_id);  return false;
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"change-parts","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"parts_id":parts_id},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-change_parts").html(data);
          console.log(data);
          e.stopPropagation();
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });  
});

$(document).on("click", ".btn-change_parts", function (e){
  $('.text-title-parts').text('เพิ่มรายการอะไหล่ที่เปลี่ยน');
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"change-parts","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"id_dept_responsibility":<?PHP echo $rowData['id_dept_responsibility']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-change_parts").html(data);
          console.log(data);
          e.stopPropagation();
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });  
});

$(document).on("click", ".btn-change-approved", function (e){
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"change-approved","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"id_dept_responsibility":<?PHP echo $rowData['id_dept_responsibility']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-change-approved").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });  
});

$(document).on("click", ".btn-repair_results", function (e){
  e.stopPropagation();
  var chk_allotted_date = '<?PHP echo $rowData['allotted_accept_date']; ?>';
  if(chk_allotted_date==''){
    swal("ผิดพลาด!", "ต้องให้ผู้ซ่อม(ช่าง) กดรับงานก่อน\r\nถึงจะสรุปผลการซ่อมได้", "error");    
    return false;
  }else{
    $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"repair_results","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"id_dept_responsibility":<?PHP echo $rowData['id_dept_responsibility']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-update-result").html(data);
          $('#modal-repair_results').modal('show');
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });  
  }
});

$(document).on("click", ".btn-approved", function (e){
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"approved","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"id_dept_responsibility":<?PHP echo $rowData['id_dept_responsibility']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-approved").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });  
});

$(document).on("click", ".btn-update-cancel", function (event){
  var ref_id = $('#ref_id').val();
        if($('#cancel_statement').val()==''){
            sweetAlert("ผิดพลาด!", "กรอกสาเหตุการยกเลิก", "error");
            return false;
        }
    //$(document).on("submit", "form#needs-validation", function(event){
    event.preventDefault();
    var formAdd = document.getElementById('needs-validation_2');  
    //var frmData = $("form#needs-validation_2").serialize();
    var frm_Data= new FormData($('form#needs-validation_2')[0]);
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        swal({
        title: "ยืนยัน ?",   text: "ต้องการยกเลิกใบแจ้งซ่อมนี้หรือไม่. หากยกเลิกแล้วจะไม่สามารถทำรายการได้อีก",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            //dataType: "json",
            //data:{ "action":"cancel-req"},
            processData: false,
            contentType: false,
            data: frm_Data, 
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                $('#modal-cancel').modal('toggle');
                swal({
                    title: "สำเร็จ!",
                    text: "ยกเลิกใบแจ้งซ่อมแล้ว",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //return false();
                    window.location.href = "?module=requestid&id="+ref_id+"";
                })
                //$('#modal-cancel').modal('toggle');
                //$('.card-main').prepend('<div class="ribbon-wrapper ribbon-xl"><div class="ribbon bg-danger text-xl">ยกเลิก</div></div>');
                //swal("สำเร็จ!", "ยกเลิกใบแจ้งซ่อมแล้ว", "success");
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
        event.preventDefault();    
    }
    //alert('Ajax'); return false;
    formAdd.classList.add('was-validated');      
    return false;
    });    

$(document).on("click", ".btn-cancel", function (e){ 
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"cancel","ref_id":<?PHP echo $rowData['id_maintenance_request']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-cancel").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });
});

$(document).on("click", ".update_result", function (e){ 
  //event.preventDefault();
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"update-result","ref_id":1},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-update-result").html(data);
          console.log(data);
      },
          error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          //alert(errorThrown);
          swal("Error!", ""+errorThrown+"", "error");
      }
  });
});

</script>

<?PHP
  break;
  case 0:
  default:
  ?>
  <style type="text/css"> 
</style>


<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
<h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-exclamation-circle"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
</div>


<div class="card-body">
      <div class="error-page">
          <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
          <h3><i class="fas fa-exclamation-triangle text-red"></i> <?PHP echo $title_site;?></h3>
          <p class="text-red"><?PHP echo $warning_text[3]; ?></p>
          <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      </div>
</div><!-- /.card-body -->
</div><!-- /.card -->
</section>
<!-- /.content -->

<script>
    
</script>
  <?PHP
  break;
}//switch($denied_requestid){
?>