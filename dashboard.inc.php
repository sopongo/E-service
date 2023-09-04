<style>
.dataTables_length,
.form-control-sm {
  font-size: 0.85rem;
  /* 40px/16=2.5em */
}

.table,
.dataTable tr td {
  padding: 0.35rem 0.50rem;
  margin: 0;
}

.btn-sm {
  padding: 0.10rem 0.40rem 0.20rem 0.40rem;
  margin: 0.0rem 0.0rem;
}

.dt-buttons button {
  font-size: 0.85rem;
  /* 40px/16=2.5em */
}

.dropdown-menu {
  /*left:-70px;*/
}

.dropdown-menu a.dropdown-item {
  font-size: 0.85rem;
  /* 40px/16=2.5em */
}

div.dataTables_wrapper {
  width: 100%;
  /*background-color:#FCC;*/
  margin: 0 auto;
}

.dataTables_scrollBody {
  margin-bottom: 5px;
}
@media (min-width: 100px) {
  .testw{ width: 100%; }
}
@media (min-width: 391px) {
  .testw{ width: 50%; }
}
@media (min-width: 768px) {
  .testw{ width: 30%; }
}
@media (min-width: 1200px) {
  .testw{ width: 20%; }
}
</style>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>  
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">

<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
          <h5 class="display-10 d-inline-block font-weight-bold"><i class="fas fa-tools"></i> <?PHP echo $title_site;?></h5>
          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt; ?></li>
            </ol>
          </div>
        </div>


      <?PHP
        $query_req = '';
        $TotalWait_approved = 0;
        $TotalNo_approved = 0;
        $TotalRepairing = 0;
        $TotalWait_repair = 0;
        $TotalWait_accept = 0;
        $TotalWait_hand_over = 0;
        $TotalHand_over = 0;
        $TotalCancel = 0;
        
        switch($_SESSION['sess_class_user']){
          case 1:
              $query_req = "AND (tb_maintenance_request.ref_id_user_request=".$_SESSION['sess_id_user'].")";
          break;
          case 2:
          case 3:
              $query_req = "AND (tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . " OR tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . ")";
          break;
          case 4:
          case 5:
              $query_req = "AND tb_maintenance_request.id_maintenance_request IS NOT NULL ";
          break;
      }

      $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
      tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
      LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
      LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
      LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
      LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
      LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
      WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " 
      " . $query_req . "" ;

      $fetchRowTotal = $obj->fetchRows($sql_fetchRow);

      if(!empty($fetchRowTotal)){
        foreach($fetchRowTotal as $key => $value){

            if ($fetchRowTotal[$key]['status_approved'] == 0 && $fetchRowTotal[$key]['allotted_date'] == null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
                $TotalWait_approved++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['allotted_accept_date'] == null && $fetchRowTotal[$key]['ref_user_id_accept_request'] == null && $fetchRowTotal[$key]['duration_serv_start'] == null 
              && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
                $TotalWait_accept++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['allotted_accept_date'] != null && $fetchRowTotal[$key]['ref_user_id_accept_request'] != null && $fetchRowTotal[$key]['duration_serv_start'] == null 
              && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
                $TotalWait_repair++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['allotted_accept_date'] != null && $fetchRowTotal[$key]['ref_user_id_accept_request'] != null && $fetchRowTotal[$key]['duration_serv_start'] != null 
              && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
                $TotalRepairing++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['allotted_accept_date'] != null && $fetchRowTotal[$key]['ref_user_id_accept_request'] != null && $fetchRowTotal[$key]['duration_serv_start'] != null
              && $fetchRowTotal[$key]['duration_serv_end'] != null && $fetchRowTotal[$key]['hand_over_date'] == null ) {
                $TotalWait_hand_over++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['duration_serv_start'] != null && $fetchRowTotal[$key]['duration_serv_end'] != null) {
                $TotalHand_over++;
            } else if ($fetchRowTotal[$key]['status_approved'] == 2 && $fetchRowTotal[$key]['allotted_date'] != null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
              && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
                $TotalNo_approved++;
            } else if ($fetchRowTotal[$key]['maintenance_request_status'] == 2) {
                $TotalCancel++;
            } 

        }

    }
      ?>
      
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="pr-3 pl-3 testw">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5>รออนุมัติ<br /></h5>
                  <p>จำนวน <?php echo $TotalWait_approved?> รายการ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->

            <div class="pr-3 pl-3 testw">
              <!-- small box -->
              <div class="small-box bg-lightblue">
                <div class="inner">
                  <h5>รอช่างรับงาน<br /></h5>
                  <p>จำนวน <?php echo $TotalWait_accept?> รายการ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-settings"></i>
                  <ion-icon name="heart"></ion-icon>
                </div>
              </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="pr-3 pl-3 testw">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h5>กำลังซ่อม<br /></h5>
                  <p>จำนวน <?php echo $TotalRepairing?> รายการ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-home"></i>
                  <ion-icon name="heart"></ion-icon>
                </div>
              </div>
            </div>
            <!-- ./col -->

            <div class="pr-3 pl-3 testw">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h5>ส่งมอบงานแล้ว</h5>
                  <p>จำนวน <?php echo $TotalHand_over ?> รายการ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
              </div>
            </div>

            <div class="pr-3 pl-3 testw">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h5>ยกเลิก</h5>
                  <p>จำนวน <?php echo $TotalCancel?> รายการ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>

              <h3 class="card-title mb-2 mt-4 text-bold"><i class="fas fa-bell"></i> ข่าวประกาศ</h3>
              <?PHP include_once 'module/module_news/view.inc.php'; #ดูข่าว ?>
              <div class="w-100 d-inline-block overflow-auto">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th width="10%">วันที่ประกาศ</th>
                      <th width="60%">หัวข้อประกาศ</th>
                      <th width="10%">ไซต์งาน</th>
                      <th width="10%">แผนก</th>
                      <th width="10%">ผู้ประกาศ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?PHP
                        $rowNews = $obj->fetchRows("SELECT tb_news.*, tb_user.fullname, tb_user.ref_id_dept, tb_user.ref_id_site , tb_site.site_initialname, tb_dept.dept_initialname FROM tb_news 
                        LEFT JOIN tb_user ON (tb_user.id_user=tb_news.ref_id_user_post)
                        LEFT JOIN tb_site ON (tb_site.id_site=tb_user.ref_id_site) 
                        LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_id_dept) 
                        WHERE tb_news.ref_id_site=".$_SESSION['sess_ref_id_site']." ORDER BY tb_news.datetime_post DESC LIMIT 5;");
                        if (count($rowNews)!=0) {
                            foreach($rowNews as $key => $value) {
                                echo '<tr>
                                <td><i class="fas fa-caret-right"></i> '.nowDate($rowNews[$key]['datetime_post']).'</td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-news" id="addData" data-id="'.$rowNews[$key]['id_news'].'" data-backdrop="static" data-keyboard="false" class="view-news">'.$rowNews[$key]['news_title'].'</a></td>
                                <td>'.$rowNews[$key]['site_initialname'].'</td>
                                <td>'.$rowNews[$key]['dept_initialname'].'</td>
                                <td><span class="tag tag-success">'.$rowNews[$key]['fullname'].'</span></td>
                              </tr>';
                            }
                        } else {
                          echo '<tr><td width="100%" colspan="5" align="center" class="text-bold text-md text-gray">ยังไม่มีข่าวประกาศ</td></tr>';
                        }
                    ?>
                  </tbody>
                </table>
                  </div>
              </div>

<h3 class="card-title mb-2 mt-5 text-bold"><i class="fas fa-file-invoice"></i> ติดตาม-ประเมิน (5 ใบแจ้งซ่อมล่าสุด)</h3>
<div class="w-100 d-inline-block overflow-auto">
<table class="table table-hover table-bordered dataTable text-nowrap">
                  <thead>
                    <tr>
                    <tr class="bg-light">
                      <th scope="col" class="sorting_disabled">No</th>
                      <th scope="col">จัดการ</th>
                      <th scope="col">เลขที่ใบแจ้งซ่อม</th>
                      <th scope="col">วันที่แจ้งซ่อม</th>
                      <th scope="col">สถานะ</th>
                      <th scope="col">รหัสเครื่องจักร-อุปกรณ์</th>
                      <th scope="col">ชื่อเครื่องจักร-อุปกรณ์</th>
                      <th scope="col">ประเภทเครื่องจักร-อุปกรณ์</th>
                      <th scope="col">อาการเสีย/ปัญหาที่พบ</th>
                      <th scope="col">ภาพแจ้งซ่อม</th>
                      <th scope="col">แผนกที่รับผิดชอบ</th>
                      <th scope="col">ประเภทงานซ่อม</th>
                      <th scope="col">เกี่ยวกับความปลอดภัย</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?PHP
                        $sqlGrouprow = $obj->fetchRows("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); ");
                        $fetchRow = $obj->fetchRows("SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine, tb_attachment.path_attachment_name FROM tb_maintenance_request 
                        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu) 
                        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility) 
                        LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_maintenance_request.id_maintenance_request AND tb_attachment.attachment_type=1 AND tb_attachment.image_cate=2) WHERE tb_maintenance_request.ref_id_dept_request=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." GROUP BY tb_maintenance_request.id_maintenance_request ORDER BY tb_maintenance_request.mt_request_date DESC LIMIT 5 ");
                        if (count($fetchRow)>0) {
                          $No = count($fetchRow);
                          foreach($fetchRow as $key=>$value){
                            if($fetchRow[$key]['status_approved']==NULL && $fetchRow[$key]['allotted_date']==NULL && $fetchRow[$key]['maintenance_request_status']==1 && $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['hand_over_date']==NULL){
                              $req_textstatus= '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';
                          }else if($fetchRow[$key]['status_approved']==1 && $fetchRow[$key]['allotted_date']!='' && $fetchRow[$key]['maintenance_request_status']==1 && $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['allotted_accept_date']==NULL && $fetchRow[$key]['hand_over_date']==NULL){
                              $req_textstatus= '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';

                            }else if($fetchRow[$key]['status_approved']==1 && $fetchRow[$key]['allotted_date']!='' && $fetchRow[$key]['maintenance_request_status']==1 && $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['hand_over_date']==NULL && $fetchRow[$key]['allotted_accept_date']!=NULL && $fetchRow[$key]['duration_serv_start']==NULL){
                              $req_textstatus= '<span class="text-bold text-danger">รอซ่อม</span>'; //duration_serv_start
                          }else if($fetchRow[$key]['status_approved']==1 && $fetchRow[$key]['allotted_date']!='' && $fetchRow[$key]['maintenance_request_status']==1 && $fetchRow[$key]['duration_serv_end']!=NULL && $fetchRow[$key]['hand_over_date']!=NULL){
                              $req_textstatus= '<span class="text-bold text-success"> ซ่อมแล้ว</span>'; //ok
                          }else if($fetchRow[$key]['maintenance_request_status']==2){            
                              $req_textstatus= '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
                          }else{
                              $req_textstatus = '-';
                          }                            
                  ?>
                    <tr>
                      <td><?PHP echo $No; ?>.</td>
                      <td><?PHP echo '<a class="btn btn-success btn-sm" href="?module=requestid&id='.$fetchRow[$key]['id_maintenance_request'].'" id="viewData"  title="ดูข้อมูล" target="_blank"><i class="fa fa-file-alt"></i></a>';?></td>
                      <td><?PHP echo $fetchRow[$key]['maintenance_request_no']=='' ? '-' : $fetchRow[$key]['maintenance_request_no']; ?></td>
                      <td><?PHP echo $fetchRow[$key]['mt_request_date']=='' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']);?></td>
                      <td><?PHP echo $req_textstatus;?></td>
                      <td><?PHP echo $fetchRow[$key]['code_machine_site']=='' ? '-' : $fetchRow[$key]['code_machine_site'];?></td>
                      <td><?PHP echo !empty($fetchRow[$key]['name_machine'])=='' ? 'ไม่ทราบชื่อ, ไม่ระบุ' : $fetchRow[$key]['name_machine'];?></td>
                      <td><?PHP echo $fetchRow[$key]['name_menu']=='' ? '-' : $fetchRow[$key]['name_menu'];?></td>
                      <td><?PHP echo $fetchRow[$key]['problem_statement']=='' ? '-' : mb_substr($fetchRow[$key]['problem_statement'],0,50,"utf8");?></td>
                      <td><?PHP echo !empty($fetchRow[$key]['path_attachment_name']) ? '<a href="'.$pathReq.$fetchRow[$key]['path_attachment_name'].'" data-toggle="lightbox" data-title="ใบแจ้งซ่อมเลขที่: '.$fetchRow[$key]['maintenance_request_no'].'" data-gallery="gallery" class="link-danger"><i class="fas fa-images"></i> คลิกดูภาพ</a>' : '-';?></td>
                      <td><?PHP echo $fetchRow[$key]['dept_responsibility']=='' ? '-' : $fetchRow[$key]['dept_responsibility'];?></td>
                      <td><?PHP echo $fetchRow[$key]['ref_id_job_type']=='' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']];?></td>
                      <td><?PHP echo $fetchRow[$key]['related_to_safty']==1 ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>';?></td>
                    </tr>
                  <?PHP
                              $No--;
                          }
                        }else{
                          echo '<tr><td width="100%" colspan="13" align="center" class="text-bold text-md text-gray pt-5 pb-5">ยังไม่มีใบแจ้งซ่อม</td></tr>';
                        }
                        
                  ?>
                  </tbody>
                </table>
</div>


        </div><!-- /.card-body -->
      </div><!-- /.card -->




    </section>
    <!-- /.content -->



<script type="text/javascript">  

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
});  


$(document).on('click','.view-news',function(){   
    var id_row = $(this).data("id");
    //alert(id_row);
    $.ajax({
      type: 'POST',
      url: "module/module_news/ajax_action.php",
      dataType: "json",
      data:{action:"view_news", id_row:id_row},
      success: function (data) {
        console.log(data);
        if(data){
          $('.title_news').html(data.news_title);
          $('.modal-body-news').html('<div class="w-100 m-auto pl-5 pr-5 pt-5 pb-5">'+data.news_detail+'</div>');
          $('.ref_id_user_post').html(data.fullname);          
        }else{
          swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
        }
      },
      error: function (data) {
        swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ.", "error");
      }
    });
  });
</script> 
