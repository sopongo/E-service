<?PHP
switch($denied_requestid){
  case 1:
?>
<style type="text/css">
.bg-pcs{ background-color:#00387C;} 

.nav-pills .nav-link.active, .nav-pills .show > .nav-link {    background-color: #00387C;}
p.problem_statement{ font-size:1rem; text-indent:15px;}
.w-30{ width: 30%;}
.linehi-170{ line-height:1.60rem;}
.text-size-1{ font-size:0.90rem;}
.list-group li{ line-height:0.75rem; }
.list-group li span{ line-height:1.2rem; }
.select2-container .select2-selection--single {
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 8%);
    width:100%;
}

.card-title{ font-size:1rem;}
.select2-selection__choice{ font-size:1rem; background-color: #ffc107; color:#000;}
.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {    color:#000;}
</style>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<?PHP 
  include_once 'module/module_maintenance_list/frm_approved.inc.php'; #หน้าอนุมัติ,จ่ายงานซ่อม
  include_once 'module/module_maintenance_list/frm_update_result.inc.php'; #หน้าอัพเดทผลการซ่อม
  include_once 'module/module_maintenance_list/frm_cancel.inc.php'; #หน้ายกเลิกใบแจ้งซ่อม
  include_once 'module/module_maintenance_list/frm_maintenance_type.inc.php'; #อัพเดทประเภทใบแจ้งซ่อม
  include_once 'module/module_maintenance_list/frm_problem_statement.inc.php'; #อัพเดทประเภทใบแจ้งซ่อม

  
  ##ลิงค์โค๊ดส่วนที่ 1
  if($rowData['status_approved']==1){//ถ้าอนุมัติแล้ว จะคิวรี่ผู้รับผิดชอบมารอไว้
    $rowMechanic = $obj->fetchRows("SELECT tb_user.id_user, tb_user.fullname, tb_ref_repairer.* FROM tb_ref_repairer 
    LEFT JOIN tb_user ON (tb_user.id_user=tb_ref_repairer.ref_id_user_repairer) WHERE tb_ref_repairer.ref_id_maintenance_request=".$rowData['id_maintenance_request']." ORDER BY tb_ref_repairer.id_ref_repairer ASC");
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

                <?PHP if($rowData['status_approved']==NULL && $rowData['maintenance_request_status']!==2 && $_SESSION['sess_class_user']==1){?>
                  <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-warning text-lg">รออนุมัติ</div>
                </div>
                  <?PHP } ?>                  
                <?PHP if($rowData['maintenance_request_status']==2){?>
                <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-danger text-lg">ยกเลิก</div>
                </div>
                <?PHP } ?>
              <div class="card-body box-profile">

                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="dist/img/mt_request/repair-workshop-icon-png-2907.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">ผู้ซ่อม: Fullname</h3>
                <p class="text-muted text-center">ตำแหน่ง: (Class User)</p>

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
                    <b>ประเภทใบแจ้งซ่อม</b> <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){?><button type="button" class="btn btn-default btn-sm float-right btn-update-type ml-2" data-toggle="modal" data-target="#modal-maintenance_type" id="btn_maintenance_type" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button> <?PHP } ?>
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
                  <li class="list-group-item">
                    <b>วันที่ปิดงาน</b> <a class="float-right"><?PHP echo $rowData['hand_over_date']!='' ? $rowData['hand_over_date'] : '-';?></a>
                  </li>
                  <li class="list-group-item">
                    <b>รวมเวลาซ่อม</b> <a class="float-right"><?PHP echo $rowData['hand_over_date']!='' ? $rowData['hand_over_date'] : '-';?></a>
                  </li>
                </ul>

                <?PHP if($rowData['status_approved']==NULL && $rowData['maintenance_request_status']==1 && ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4)){ //รออนุมัติ/หรือไม่อนุมัติ?>
                    <button type="button" class="btn btn-success btn-block btn-approved" data-toggle="modal" data-target="#modal-approved" id="addData" data-backdrop="static" data-keyboard="false"> อนุมัติ, จ่ายงานซ่อม</button>
                    <a href="#" class="btn btn-warning btn-block btn-disapprove"><b>ไม่อนุมัติใบแจ้งซ่อม</b></a>
                <?PHP }?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']==NULL && $rowData['maintenance_request_status']==1){ ?>
                    <?PHP if(($chk_id_result == $_SESSION['sess_id_user'] && $rowData['status_approved']==1) || $_SESSION['sess_class_user']==4){ ##เช็คว่าคนที่เปิดดูหน้านี้ใช้ผู้รับผิดชอบหรือไม่ ?>
                      <a href="#" class="btn btn-success btn-block"><b>รับทราบ</b></a>
                      <a href="#" class="btn btn-warning btn-block"><b>ปฎิเสธรับงาน</b></a>
                      <?PHP } ?>
                <?PHP } ?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']==NULL && $rowData['maintenance_request_status']==1){?>
                    <a href="#" class="btn btn-warning btn-block"><b>เริ่มซ่อม</b></a>
                <?PHP } ?>
                <?PHP if($rowData['status_approved']==1 && $rowData['allotted_accept_date']!=NULL && $rowData['duration_serv_start']!=NULL && $rowData['maintenance_request_status']==1){?>
                    <a href="#" class="btn btn-success btn-block"><b>ปิดงาน</b></a>
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

                <p class="text-muted">
                Text Wait
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Title Wait</strong>

                <p class="text-muted">Text Wait</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Title Wait</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">Text Wait</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Title Wait</strong>

                <p class="text-muted">Text Wait</p>
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
              
              <div class="card-title d-block text-bold w-100 border-bottom pb-1 mt-3 mb-2"><i class="fas fa-users-cog"></i> ผู้รับผิดชอบงานซ่อม: <?PHP if($rowData['status_approved']==1){?><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> เปลี่ยน-เพิ่ม ผู้รับผิดชอบ</button><?PHP } ?></div><br>
              <div class="row invoice-info linehi-170">
                <?PHP if($rowData['status_approved']!=1){?>
                  <div class="col-sm-4 invoice-col">
                    <span class="text-gray">- ยังไม่ระบุ</span>
                  </div>
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
                    <strong class="d-inline-block w-30">ประเภทเครื่องจักร:</strong> <?PHP echo $rowMachine['name_menu']!='' ? $rowMachine['name_menu'] : '-';?><br>
                    <strong class="d-inline-block w-30">ชื่ออุปกรณ์:</strong> <?PHP echo $rowMachine['name_machine']!='' ? $rowMachine['name_machine'] : '-';?><br>
                    <strong class="d-inline-block w-30">ไซต์งาน:</strong> <?PHP echo $rowMachine['site_initialname']!='' ? $rowMachine['site_initialname'] : '-';?><br>
                </div><!-- /.col -->

                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">ซีเรียลนัมเบอร์:</strong> <?PHP echo $rowMachine['serial_number']!='' ? $rowMachine['serial_number'] : '-';?><br>
                    <strong class="d-inline-block w-30">ชื่อรุ่น:</strong> <?PHP echo $rowMachine['model_name']!='' ? $rowMachine['model_name'] : '-';?><br>
                    <strong class="d-inline-block w-30">อาคาร:</strong> <?PHP echo $rowMachine['building_name']!='' ? $rowMachine['building_name'] : '-';?><br>
                </div><!-- /.col -->

                <div class="col-sm-4 invoice-col">
                <strong class="d-inline-block w-30">รหัสเครื่องจักร:</strong> <?PHP echo $rowMachine['code_machine_site'];?><br><br>
                <strong class="d-inline-block w-30">สถานที่:</strong> <?PHP echo $rowMachine['location_name']!='' ? $rowMachine['location_name'] : '-';?><br>
                </div><!-- /.col -->                

                <div class="col-sm-12 mt-3 ">
                <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2 text-red"><i class="fas fa-info-circle"></i> อาการเสีย/ปัญหาที่พบ: 
                <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?>
                <button type="button" class="btn btn-default btn-sm btn-problem_statement"  data-toggle="modal" data-target="#modal-problem_statement" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP } ?></div><br>
                    <p class="problem_statement"><?PHP echo $rowData['problem_statement'];?></p>
                </div><!-- /.col -->                
              </div><!-- /.row -->

              <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายอาการเสีย / ปัญหาที่พบ: </div><br>  
              <div class="row invoice-info">
              <div class="row">
                <?PHP for($i=1; $i<=6; $i++){?>
                  <div class="col-sm-2">
                    <div class="position-relative">
                      <img src="upload-pic-req/idmt-req/<?PHP echo $i; ?>.jpg" alt="Photo 1" class="img-fluid">
                    </div>
                  </div>
                  <?PHP } ?>
                </div>
              </div><!-- /.row -->
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-clipboard-check"></i> สรุปผลการซ่อม: 
              <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">รหัสอาการเสีย:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-25">สาเหตุของปัญหา:</strong> MySQL_Val<br>
                </div><!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">รหัสซ่อม:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-25">วิธีการแก้ไข:</strong> MySQL_Val<br>
                </div><!-- /.col -->
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-truck"></i> ส่งซ่อมภายนอก: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?><button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">สาเหตุที่ส่งซ่อม:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-25">ซัพพลายเออร์:</strong> MySQL_Val<br>
                </div><!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <strong class="d-inline-block w-25">วันที่ส่งซ่อม:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-25">วันที่ส่งคืน:</strong> MySQL_Val<br>
                </div><!-- /.col -->                
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-tools"></i> รายการอะไหล่ที่เปลี่ยน: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?><button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP }?></div><br>  
                <!-- Table row -->
                <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP for($i=1; $i<=3; $i++){?>
                    <tr>
                      <td>1</td>
                      <td>Spare Parts Name</td>
                      <td>455-981-221</td>
                      <td>Spare Parts Detail</td>
                      <td>฿<?PHP echo $i; ?>4.50</td>
                    </tr>
                    <?PHP } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>                
                <!-- /Table row -->
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายหลังซ่อม: <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?><button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i> อัพเดท</button><?PHP }?></div><br>  
              <div class="row invoice-info">
              <div class="row">
                <?PHP for($i=1; $i<=6; $i++){?>
                  <div class="col-sm-2">
                    <div class="position-relative">
                      <img src="upload-pic-req/idmt-req/<?PHP echo $i; ?>.jpg" alt="Photo 1" class="img-fluid">
                    </div>
                  </div>
                  <?PHP } ?>
                </div>
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-chart-bar"></i> ประเมินผลการซ่อม (จป., ผู้แจ้งซ่อม): <?PHP if($_SESSION['sess_class_user']!=0 && $_SESSION['sess_class_user']!=1){ ?><button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button><?PHP } ?></div><br>  
              <div class="row invoice-info linehi-170">
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-50">Title_Wait:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">Title_Wait:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">Title_Wait:</strong> MySQL_Val<br>
                </div><!-- /.col -->
              </div><!-- /.row -->         
              
            </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="timeline">
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
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
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

<script>

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

$(document).on("click", ".btn-approved", function (e){
    e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"approved","ref_id":<?PHP echo $rowData['id_maintenance_request']?>,"id_dept_responsibility":<?PHP echo $rowData['id_dept_responsibility']?>},
      beforeSend: function () {
      },
      success: function (data) {
          $(".modal-body-approved ").html(data);
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