<style type="text/css"> 

.bg-pcs{ background-color:#00387C;} 

.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    background-color: #00387C;
}

.w-30{ width: 30%;}
.linehi-170{ line-height:1.60rem;}

.text-size-1{ font-size:0.90rem;}
</style>


<?PHP 
  include_once 'module/module_maintenance_list/frm_update_result.inc.php'; #หน้าอัพเดทผลการซ่อม
  include_once 'module/module_maintenance_list/frm_cancel.inc.php'; #หน้ายกเลิกใบแจ้งซ่อม
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
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="dist/img/mt_request/repair-workshop-icon-png-2907.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">ผู้ซ่อม: Fullname</h3>

                <p class="text-muted text-center">ตำแหน่ง: (Class User)</p>

                <ul class="list-group list-group-unbordered mb-1">
                <li class="list-group-item text-red">
                    <b>ความเร่งด่วน</b> <span class="float-right"> <?PHP echo $rowData['urgent_type']==1 ? '<i class="fas fa-lightbulb fa-1x"></i>'.$urgentArr[$rowData['urgent_type']] : '<span class="text-green">'.$urgentArr[$rowData['urgent_type']].'</span>';?></span>
                  </li>
                  <li class="list-group-item">
                    <b>ประเภทใบแจ้งซ่อม</b> <button type="button" class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button> <span class="float-right">งานเกี่ยวกับเครื่องทำความเย็น	</span>
                  </li>
                  <li class="list-group-item">
                    <b>ประเภทงานซ่อม</b> <span class="float-right"><i class="fas fa-lightbulb fa-1x"></i> แจ้งช่างซ่อม</span>
                  </li>                                    
                  <li class="list-group-item ">
                    <b>เกี่ยวกับความปลอดภัย</b> <span class="float-right text-red"> ใช่</span> <span class="float-right text-success"> ไม่ใช่ </span>
                  </li>
                <li class="list-group-item">
                    <b>แผนกที่รับผิดชอบ</b> <a class="float-right">EN</a>
                  </li>
                  <li class="list-group-item">
                    <b>วันที่แจ้งซ่อม</b> <a class="float-right">2023/01/01 12:13:14</a>
                  </li>
                  <li class="list-group-item">
                    <b>วันที่ปิดงาน</b> <a class="float-right">2023/01/01 15:16:17</a>
                  </li>
                  <li class="list-group-item">
                    <b>รวมเวลาซ่อม</b> <a class="float-right">3 วัน 14 ชั่วโมง</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-success btn-block"><b>อนุมัติ, จ่ายงานซ่อม</b></a>
                <a href="#" class="btn btn-success btn-block"><b>รับทราบ</b></a>
                <a href="#" class="btn btn-warning btn-block"><b>เริ่มซ่อม</b></a>
                <a href="#" class="btn btn-success btn-block"><b>ปิดงาน</b></a>
                <a href="#" class="btn btn-warning btn-block"><b>ไม่อนุมัติใบแจ้งซ่อม</b></a>
                <button type="button" class="btn btn-danger btn-block btn-cancel" data-toggle="modal" data-target="#modal-cancel" id="addData" data-backdrop="static" data-keyboard="false"> ยกเลิกใบแจ้งซ่อม</button>                
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
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">ไทม์ไลน์-ติดตามงานซ่อม</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item float-right"><a class="nav-link" href="#settings" data-toggle="tab">พิมพ์ใบแจ้งซ่อม</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="activity">
                  <div class="row invoice-info linehi-170">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>ผู้แจ้งซ่อม:</strong><br>
                    MySQL_Fullname<br>
                    MySQL_Emp No<br>
                    MySQL_Site / MySQL_Dept<br>
                    MySQL_Email
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>แผนกที่รับผิดชอบ</strong><br>
                    <strong class="d-inline-block w-50">แผนก:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">ผู้อนุมัติ:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">ผู้จ่ายงาน:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">วันที่จ่ายงาน:</strong> 2023/01/02 00:00:00<br>
                  </address>
                </div>
                <!-- /.col -->

                <div class="col-sm-4 invoice-col">
                  <address><br>
                    <strong class="d-inline-block w-50">ผู้ซ่อม:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-50">วันที่รับงานซ่อม:</strong> 2023/01/02 00:00:00<br>
                    <strong class="d-inline-block w-50">วันที่ปิดงาน:</strong> 2023/01/02 00:00:00<br>
                  </address>
                </div>
                <!-- /.col -->                

              </div>

                <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-industry"></i> เครื่องจักร-อุปกรณ์ที่แจ้งซ่อม: <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 แก้ไข</button></div><br>
                <div class="row invoice-info text-left linehi-170">
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">รหัสเครื่องจักร:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">ชื่อรุ่น:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">ชื่ออุปกรณ์:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">ซีเรียลนัมเบอร์:</strong> MySQL_Val<br>
                </div><!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong class="d-inline-block w-30">ไซต์งาน:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">อาคาร:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">สถานที่:</strong> MySQL_Val<br>
                    <strong class="d-inline-block w-30">แผนกที่รับผิดชอบ:</strong> MySQL_Val<br>
                </div><!-- /.col -->

                <div class="col-sm-12">
                    <strong class="d-inline-block w-100 mt-2 text-red">อาการเสีย/ปัญหาที่พบ:</strong> 
                    <p>MySQL_Val</p>
                </div><!-- /.col -->                
              </div><!-- /.row -->

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายอาการเสีย / ปัญหาที่พบ: <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 แก้ไข</button></div><br>  
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
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-clipboard-check"></i> สรุปผลการซ่อม: <button type="button" class="btn btn-default btn-sm update_result" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-pencil-alt"></i> อัพเดท</button></div><br>  
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

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-truck"></i> ส่งซ่อมภายนอก: <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button></div><br>  
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

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-tools"></i> รายการอะไหล่ที่เปลี่ยน: <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button></div><br>  
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
              
              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-camera"></i> ภาพถ่ายหลังซ่อม: <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button></div><br>  
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

              <br>  <div class="card-title d-block text-bold w-100 border-bottom pb-1 mb-2"><i class="fas fa-chart-bar"></i> ประเมินผลการซ่อม (จป., ผู้แจ้งซ่อม): <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt"></i>
 อัพเดท</button></div><br>  
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


$(document).on("click", ".btn-cancel", function (e){ 
  e.stopPropagation();
  $.ajax({
      url: "module/module_maintenance_list/update_result.inc.php",
      type: "POST",
      data:{"action":"cancel","ref_id":1},
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