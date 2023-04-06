<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
</style>
<!--
id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address

###FORM
no_user     password        email       fullname        class_user      ref_id_site     ref_id_dept     ref_id_position     status_user -->

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มหน่วยนับ</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1-->
        <form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">

            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                        <div class="row row-1">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label>สถานะการใช้งาน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="status_user" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="status_user" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสพนักงาน:</label>
                                    <input type="text" id="no_user" name="no_user" placeholder="รหัสพนักงาน" maxlength="7" class="form-control numbersOnly" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">ชื่อ-นามสกุล:</label>  
                                    <input type="text" id="fullname" name="fullname" placeholder="รหัสพนักงาน" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                        </div><!--row-4 -->

                        <div class="row row-5">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">อีเมล์:<span class="text-danger">**</span></label>  
                                    <input type="text" id="email" name="email" placeholder="รหัสพนักงาน" class="form-control" aria-describedby="inputGroupPrepend" value="" autocomplete="off" required />
                                    <div class="invalid-feedback">กรอกอีเมล์</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสผ่าน:<span class="text-danger">**</span></label>  
                                    <input type="password" id="password" name="password" placeholder="รหัสพนักงาน" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกรหัสผ่าน</div>
                                </div>
                            </div>
                        </div><!--row-5 -->

                        <div class="row row-6">
                            <div class="col-sm-12 col-md-12 col-xs-12">  
                                <div class="form-group">  
                                    <label for="firstname">ระดับผู้ใช้งาน:<span class="text-danger">**</span></label>  
                                    <div class="form-group clearfix">
                                        <?PHP
                                            foreach($classArr as $index=> $value){
                                                if($index!=0){
                                                    echo '<div class="icheck-success d-inline-block mr-3"><input type="radio" '.(($index==4 || $index==5) && $_SESSION['sess_class_user']!=5 ? 'disabled' : '').' name="class_user" id="class_user_'.$index.'" value="'.$index.'" required><label for="class_user_'.$index.'">'.$value.'</label></div>';
                                                }
                                            }
                                            //$value==end($classArr) ? '<div class="invalid-feedback">เลือกระดับผู้ใช้งาน</div>
                                        ?>
                                        </div>
                                </div>
                            </div>
                        </div><!--row-6 -->

                        <!--no_user     password        email       fullname        class_user      ref_id_site     ref_id_dept     ref_id_position     status_user -->
                        <div class="row row-7">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">  
                                    <label for="firstname">ไซต์งาน:<span class="text-danger">**</span></label>  
                                    <div class="form-group clearfix">
                                        <?PHP
                                            $rowSite= $obj->fetchRows("SELECT * FROM tb_site WHERE site_status=1 ORDER BY site_initialname DESC");                 
                                            if (count($rowSite)>0){
                                                foreach($rowSite as $key => $value) {
                                                    echo '<div class="icheck-primary d-inline-block mr-4"><input type="checkbox" name="ref_id_site[]" id="ref_id_site'.$key.'" value="'.$rowSite[$key]['id_site'].'" '.($key!=$_SESSION['sess_ref_id_site'] && $_SESSION['sess_class_user']!=5 ? 'disabled' : '').''.($key==$_SESSION['sess_ref_id_site'] ? 'checked' : '').' required><label for="ref_id_site'.$key.'">'.$rowSite[$key]['site_initialname'].'</label></div>';
                                                }
                                            }
                                        ?>
                                        </div>
                                    <div class="invalid-feedback">เลือกไซต์งาน</div>
                                </div>
                            </div>
                        </div><!--row-7 -->

                        <div class="row row-8">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">แผนก:<span class="text-danger">**</span></label>  
                                    <div class="form-group clearfix">
                                        <select class="custom-select rounded-3" id="slt_ref_id_dept" name="slt_ref_id_dept" required>
                                            <option value="">เลือกแผนก</option>
                                        <?PHP
                                            $rowDept= $obj->fetchRows("SELECT * FROM tb_dept WHERE dept_status=1 ORDER BY dept_initialname DESC");
                                            if (count($rowDept)>0) {
                                                foreach($rowDept as $key => $value) {
                                                    echo '<option value="'.$rowDept[$key]['id_dept'].'">'.$rowDept[$key]['dept_initialname'].'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                        <div class="invalid-feedback">เลือกแผนก</div>
                                        </div>
                                </div>
                            </div>
                        </div><!--row-8-->

                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_row" id="id_row" />
        </form>
        <!--FORM 1-->

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-submit btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->

<script type="text/javascript">
$(document).ready(function(){

$('.numbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});


$('input[type=radio][name=class_user]').on('change', function() {
   //alert($(this).val());
   if ($(this).val()==5) {
        $('input[type=checkbox][name^=ref_id_site]').attr('checked', true);
    } else{
        $('input[type=checkbox][name^=ref_id_site]').attr('checked', false);
        $('input[type=checkbox][id^=ref_id_site<?PHP echo $_SESSION['sess_ref_id_site']; ?>]').attr('checked', true);
    }
});

$('input[type=checkbox][name^=ref_id_site]').on('change', function() {
   //alert($(this).val());
   /*
   if ($(this).is(":checked")) {
        $('input[type=checkbox][name^=ref_id_site]').attr('disabled', true);
        $(this).attr('disabled', false);
    } else {
        $('input[type=checkbox][name^=ref_id_site]').attr('disabled', false);
        $(this).attr('disabled', true);
    }
    */   
});



$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
});    

/*ปุ่ม ADD Recive รับวัสดุเข้าระบบ <<<<<<<<<< เขียนใหม่ใช้โค๊ดนี้ สมบรูณ์กว่าไม่มีบั๊ครีเฟรชหน้าจอ*/
    $(document).on("click", ".btn-submit", function (event){
    var formAdd = document.getElementById('needs-validation');  

    var frmData = $("form#needs-validation").serialize();

    /*if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    */
    if($("input:radio[name^=status_user]").filter(':checked').length<1){
        sweetAlert("ผิดพลาด!", "เลือกสถานะการใช้งาน", "error");
        return false;
    }else if($('#password').val()=='' && $('#id_row').val()!=''){
        sweetAlert("ผิดพลาด!", "กรอกรหัสผ่าน", "error");
        return false;
    }else if($('#email').val()==''){
        sweetAlert("ผิดพลาด!", "กรอกอีเมล์", "error");
        return false;
    }else if(isEmail($('#email').val())==false){
        sweetAlert("ผิดพลาด!", "รูปแบบอีเมล์ไม่ถูกต้อง", "error");
        return false;
    }else if($("input:radio[name^=class_user]").filter(':checked').length<1){
        sweetAlert("ผิดพลาด!", "เลือกระดับผู้ใช้งาน", "error");
        return false;
    }else if($("input:checkbox[id^=ref_id_site]").filter(':checked').length<1){
        sweetAlert("ผิดพลาด!", "เลือกไซต์งาน", "error");
        return false;
    }else if($('#slt_ref_id_dept option:selected').val()<=0){
        sweetAlert("ผิดพลาด!", "เลือกแผนก", "error");
        return false;
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_user/ajax_action.php",
            type: "POST",
            data:{"data":frmData, "action":"adddata"},
            beforeSend: function () {
                //console.log('mail_dup');
            },
            success: function (data) {
            console.log(data);
            data = $.trim(data.replace(/\s+/g," "));
            //console.log(data==='mail_dup'); 
            if(data=='mail_dup'){
                sweetAlert("ผิดพลาด!", "อีเมล์ "+($('#email').val())+" \r\nนี้ถูกใช้งานแล้ว", "error");
                return false;
            }else{
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('#example1').DataTable().ajax.reload();
                $("#modal-default").modal("hide"); 
                $(".modal-backdrop").hide().fadeOut();
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('body').find('.was-validated').removeClass();
                $('form').each(function() { this.reset() });
            }   
                event.preventDefault();
            },
                error: function (jXHR, textStatus, errorThrown) {
                //console.log(data);
                alert(errorThrown);
            }
        });    
        event.preventDefault();    
    }
    //alert('Ajax'); return false;
    formAdd.classList.add('was-validated');      
    return false;
});


});//document
</script>