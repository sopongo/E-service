    <!-- Main content -->
    <section class="content">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> แจ้งเตือน!</h5> - หากต้องการเปลี่ยนไซต์งาน หรือ แผนก ติดต่อแผนก IT เพื่อแก้ไข <br/>- ใช้อีเมล์แอคเค้าท์ ที่มีอยู่จริง เพื่อให้ระบบสามารถส่งอีเมล์หาคุณได้
    </div>    

    <?PHP 
    if($_SESSION['sess_no_user']==null || $_SESSION['sess_id_dept']==0){ ?>
    <div class="alert alert-danger" role="alert">กรอกข้อมูลไซต์งานและแผนก เพื่อเปิดใช้งานระบบ</div>
    <?PHP } ?>

      <!-- Default box -->
      <div class="card"><!-- /.card 00000-->
        
      <div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
</div>

<div class="card-body"><!-- /.card-body 11111-->

    <?PHP
    $obj = new CRUD();

    //echo $_SESSION['sess_id_location'];    echo "-------------";    echo $_SESSION['sess_id_dept'];

    $Row = $obj->customSelect("SELECT * FROM tb_user WHERE id_user=".$_SESSION['sess_id_user']."");

    //echo "-------------";    echo $Row['ref_id_dept'];    echo "-------------";
    ?>

    <!--FORM 1-->
        <div class="row">  
            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  

                    <div class="card-body">  
                        <form id="needs-validation" class="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            <div class="row">  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="no_user">รหัสพนักงาน</label>  
                                        <input type="text" maxlength="7" id="no_user" name="no_user" placeholder="รหัสพนักงาน" class="numberonly form-control w-10" aria-describedby="inputGroupPrepend" autocomplete="off" value="<?PHP echo $Row['no_user'];?>" />  
                                        <div class="invalid-feedback">กรอกรหัสพนักงาน</div>
                                    </div>  
                                </div>  
                                <div class="col-sm-5 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อ-นามสกุลผู้ใช้งาน</label>  
                                        <input type="text" id="fullname" name="fullname" placeholder="ชื่อ-นามสกุล" class="form-control w-100" aria-describedby="inputGroupPrepend" autocomplete="off" value="<?PHP echo $Row['fullname'];?>" />
                                        <div class="invalid-feedback">ต้องกรอกชื่อ-นามสกุล</div>
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="email">อีเมล์</label>  
                                        <input type="email" class="form-control" id="email" name="email" readonly placeholder="email address" aria-describedby="inputGroupPrepend" autocomplete="off" value="<?PHP echo $Row['email'];?>" required>  
                                        <div class="invalid-feedback">กรอกอีเมล์</div>  
                                    </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group"><!--pattern="^\d{10}$"-->
                                        <label for="password" class="text-danger">รหัสผ่าน</label>  
                                        <input type="password" maxlength="10" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" aria-describedby="inputGroupPrepend">
                                        <span class="col-sm d-inline text-danger">** เว้นว่างไว้หากไม่ต้องการเปลี่ยน</span>  
                                    </div>  
                                </div>                                  

                                <div class="row col-lg-12">
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="ref_id_dept">แผนก</label>  
                                        <select class="custom-select" name="ref_id_dept" <?PHP echo $_SESSION['sess_class_user']!=4 || $_SESSION['sess_class_user']!=5 ? 'disabled' : '';?> required>  
                                            <option value="" >เลือกแผนก</option>  
                                            <?PHP
                                            $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE dept_status=1 ORDER BY id_dept ASC");
                                            if (count($rowData)!=0) {
                                                foreach($rowData as $key => $value) {
                                                    echo '<option '.($_SESSION['sess_id_dept']==$rowData[$key]['id_dept'] ? "selected" : "").' '.($_SESSION['sess_class_user']!=5 ? 'disabled' : '').' value="'.($rowData[$key]['id_dept']).'">'.$rowData[$key]['dept_name'].' ('.$rowData[$key]['dept_initialname'].')</option>';
                                                }
                                            } 
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกแผนก</div>  
                                    </div>  
                                </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">
                                        <label for="phone">เบอร์โทรศัพท์</label>  
                                        <input type="tel" pattern="^\d{10}$" class="form-control" id="phone" name="phone" placeholder="Mobile Number" aria-describedby="inputGroupPrepend" value="<?PHP echo $Row['phone']?>" >
                                    </div>  
                                </div>  
                            </div>  

                            <?PHP if($_SESSION['sess_class_user']==5){?>
                            <div class="row row-6">
                            <div class="col-sm-12 col-md-12 col-xs-12">  
                                <div class="form-group">  
                                    <label for="firstname">ระดับผู้ใช้งาน:<span class="text-danger">**</span></label>  
                                    <div class="form-group clearfix">
                                        <?PHP
                                            foreach($classArr as $index=> $value){
                                                if($index!=0){
                                                    echo '<div class="icheck-success d-inline-block mr-3"><input type="radio" '.($index==$_SESSION['sess_class_user'] ? 'checked' : '').' value="'.$index.'" '.($_SESSION['sess_class_user']!=5 ? 'disabled' : '').' name="class_user" id="class_user_'.$index.'" value="'.$index.'" required><label for="class_user_'.$index.'">'.$value.'</label></div>';
                                                }
                                            }
                                            //$value==end($classArr) ? '<div class="invalid-feedback">เลือกระดับผู้ใช้งาน</div>
                                        ?>
                                        </div>
                                </div>
                            </div>
                        </div><!--row-6 -->                            

                            <div class="row row-7">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">  
                                    <label for="firstname">ไซต์งาน:<span class="text-danger">**</span></label>  
                                    <div class="form-group clearfix">
                                        <?PHP
                                            $rowSite= $obj->fetchRows("SELECT * FROM tb_site WHERE site_status=1 ORDER BY site_initialname DESC");                 
                                            if (count($rowSite)>0){
                                                foreach($rowSite as $key => $value) {
                                                    echo '<div class="icheck-primary d-inline-block mr-4"><input type="checkbox" name="ref_id_site[]" id="ref_id_site'.$rowSite[$key]['id_site'].'" '.($rowSite[$key]['id_site']==$_SESSION['sess_ref_id_site'] ? 'checked' : '').' value="'.$rowSite[$key]['id_site'].'" '.($_SESSION['sess_class_user']!=5 ? 'disabled' : '').'><label for="ref_id_site'.$rowSite[$key]['id_site'].'">'.$rowSite[$key]['site_initialname'].'</label></div>'."\r\n";
                                                }
                                            }
                                        ?>
                                        </div>
                                </div>
                            </div>
                        </div><!--row-7 -->
                        <?PHP } ?>

                            <div class="row mt-3"> 
                            <div class="col-sm-4 col-md-4 col-xs-12">  
                                               <div class="form-group">  
                                        <label>รูปโปรไฟล์ (ถ้ามี)</label>  
                                        <div class="custom-file">  
                                            <input type="file" class="custom-file-input" id="photo" name="photo">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>  
                                            <div class="invalid-feedback">Choose file for upload</div>  
                                        </div>  
                                    </div>   
                            </div>  
                            </div>    
                                

                            <div class="row">  
                                <div class="col-sm-0 col-md-0 col-xs-0">  
                                    <div class="float-right">  
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <button type="button" class="btn btn-danger btn-cancel" data-dismiss="modal">ยกเลิก</button>
                                        <input type="hidden" name="action" value="edituser">
                                    </div>
                                </div>  
                            </div>  

                        </form>  
                    </div>  
                </div>  
            </div>  
        </div>  
    <!--FORM 1-->
    

</div><!-- /.card-body 11111-->


      </div><!-- /.card 00000-->

    </section>
    <!-- /.content -->

<script type="text/javascript"> 
$(document).ready(function(){

});
</script>


<script type="text/javascript">
//var statusArr_js = <?PHP echo json_encode($statusArr); ?>;


  //ส่วนเช็ค validate ตอนสมัครสมาชิก
  (function () {  
      'use strict';  
      window.addEventListener('load', function () {  
      var form = document.getElementById('needs-validation');  
        form.addEventListener('submit', function (event) {  
          if (form.checkValidity() === false) {  
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');  
            }, false);
          }, false);
    })();  


$(document).ready(function () {
  // add/edit user
  $(document).on("submit", ".addform", function (event) {
    event.preventDefault();  
    var no_user = $("#no_user").val();
    if($.isNumeric(no_user)==false){
      sweetAlert("ผิดพลาด!", 'รหัสพนักงานไม่ถูกต้อง', "error");
      return false;
    <?PHP if($_SESSION['sess_class_user']==5){?>
    }else if($("input:checkbox[id^=ref_id_site]").filter(':checked').length<1){
        sweetAlert("ผิดพลาด!", "เลือกไซต์งาน", "error");
        return false;    
    }
    <?PHP } ?>
    var alertmsg = "อัพเดทข้อมูลผู้ใช้งานเรียบร้อยแล้ว";
    $.ajax({
      url: "module/module_user/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (response) {
        console.log(response); 
        //return false;
        if (response) {
          swal({
            title: "สำเร็จ!",
            text: "บันทึกข้อมูลเรียบร้อย.",
            type: "success",
            //timer: 3000
          }, 
          function(){
            window.location.href = "?module=profile";
          })

          //$("body form#needs-validation")[0].reset();
          //sweetAlert("สำเร็จ...", alertmsg, "success");
          //window.location.href = "./";
          //$("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
          //$("#overlay").fadeOut();
        }
      },
      error: function (response) {
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!-----"+response);
        sweetAlert("ไม่สำเร็จ!", 'มีบางอย่างผิดพลาด', "error");
        return false;
      },
    });
  });

  
  $(document).on('click',".btn-cancel", function() { //*****ยังไม่เสร็จ */

  });


});

</script>