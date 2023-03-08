<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
.remove-photo{ cursor:pointer;}
/*#preview{ width: 200px; height:auto;}*/
</style>

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มสถานที่ใช้งาน</span></h5>
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
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                    <div class="card-body p-3"> 

                        <div class="row row-1">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label>สถานะการใช้งาน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="status_machine" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="status_machine" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1 tb_machine_master    id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                            <div class="form-group mb-2">
                                <label><span class="text-danger">**</span> แผนกที่รับผิดชอบ: </label> 
                                <select class="custom-select" name="ref_id_dept" id="ref_id_dept" style="width:100%; font-size:0.85rem;" required>  
                                    <?PHP
                                    //id_menu name_menu
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE mt_request_manage=1 AND dept_status=1 ORDER BY id_dept ASC");
                                    if (count($rowData)!=0) {
                                        echo '<option value="" >เลือกแผนกที่รับผิดชอบ</option>';
                                        foreach($rowData as $key => $value) {
                                            echo '<option value="'.$rowData[$key]['id_dept'].'">'.$rowData[$key]['dept_initialname'].' - '.$rowData[$key]['dept_name'].'</option>';
                                        }
                                    } else {
                                        echo '<option value="" >เลือกแผนกที่รับผิดชอบ</option>  ';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">เลือกแผนกที่รับผิดชอบ</div>
                            </div>
                        </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสเครื่องจักร-อุปกรณ์ (**ระบบจะสร้างให้อัตโนมัติ):</label>  
                                    <input type="text" id="machine_code" name="machine_code" readonly placeholder="??-AS-???" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกรหัสเครื่องจักร-อุปกรณ์</div>
                                </div>
                            </div>                        
                        </div><!--row-4-->

                        <div class="row row-2">
                        <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">ชื่อรุ่น (Model):</label>  
                                    <input type="text" id="model_name" name="model_name" placeholder="ชื่อรุ่น" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname"><span class="text-danger">**</span> ชื่อเครื่องจักร-อุปกรณ์:</label>  
                                    <input type="text" id="name_machine" name="name_machine" placeholder="ชื่อเครื่องจักร-อุปกรณ์" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อเครื่อง-อุปกรณ์</div>
                                </div>
                            </div>
                        </div><!--row row-2 -->                        

                        <div class="row row-cate">
                        <div class="col-sm-6 col-md-6 col-xs-6">  
                        <div class="form-group">  
                        <label><span class="text-danger">**</span> เลือกหมวดหลัก: </label> 
                            <select class="custom-select" name="ref_id_menu" id="ref_id_menu" style="width:100%; font-size:0.85rem;" required>  
                            <option disabled selected value="" >เลือกแผนกที่รับผิดชอบก่อน</option>
                            </select>
                            <div class="invalid-feedback">เลือกหมวดหลัก</div>
                        </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-xs-6">  
                        <div class="form-group">  
                        <label>เลือกหมวดย่อย: </label> 
                            <select class="custom-select" name="ref_id_sub_menu" id="ref_id_sub_menu" style="width:100%; font-size:0.85rem;">  
                            <option disabled selected value="" >เลือกหมวดหลักก่อน</option>
                            </select>
                            <div class="invalid-feedback">เลือกหมวดย่อย</div>
                        </div>
                        </div>
                        </div><!--row-cate-->

                        <div class="row row-5">
                            <div class="col-sm-12 col-md-12 col-xs-12">  
                                <div class="form-group">  
                                    <label for="firstname">รายละเอียดเครื่องจักร-อุปกรณ์:</label>  
                                    <textarea class="form-control w-100" id="detail_machine" name="detail_machine" rows="3" placeholder="รายละเอียด ..."></textarea>
                                </div>
                            </div>
                        </div><!--row-5-->

                        <div class="row">  
                                <div class="col-sm-6 col-md-6 col-xs-6">  
                                    <div class="form-group">  
                                        <label>รูปเครื่องจักร-อุปกรณ์ (ถ้ามี): <br /><span class="text-red font-11">**ขนาดไฟล์ไม่เกิน 5MB. ขนาดกว้างxสูง 800x800 Pixel</span></label>  
                                        <div class="custom-file">  <input type="file" class="custom-file-input" id="photo" name="photo"><label class="custom-file-label" for="validatedCustomFile">Choose file...</label>  </div>  
                                    </div>                                  
                                </div>  
                                <div class="col-sm-6 col-md-6 col-xs-6">  <span class="alert"></span>
                                    <label>ตัวอย่างรูป:</label>  
                                    <img src="uploads-temp/default.png?ver=1" id="preview" class="border p-2 w-50 d-block" />
                                    <a class="chk-remove pt-2 d-block text-danger" ><i class="fas fa-trash-alt"></i> ลบรูป</a>
                                </div>
                        </div>                        
                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_row" id="id_row" />
            <input type="hidden" value="" name="chk_ref_id_dept" id="chk_ref_id_dept" />
            <input type="hidden" value="adddata" name="action" id="action" />            
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

    function readURL(input) {    
        if (input.files && input.files[0]) {   
            var reader = new FileReader();
            var filename = $("#photo").val();
            filename = filename.substring(filename.lastIndexOf('\\')+1);
            reader.onload = function(e) {
            // debugger;      
            $('#preview').attr('src', e.target.result);
            $('#preview').hide();
            $('#preview').fadeIn(200);      
            
            $('.remove-photo').removeClass('d-none');
            $('.custom-file-label').text(filename);             
            }
            reader.readAsDataURL(input.files[0]);    
        } 
        $(".alert").removeClass("loading").hide();
    }
    function RecurFadeIn(){ 
        console.log('ran');
        FadeInAlert("Wait for it...");  
    }
    function FadeInAlert(text){
        $(".alert").show();
        $(".alert").text(text).addClass("loading");  
    }

$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
    $('#photo').val('');
    $('#preview').attr('src', 'uploads-temp/default.png?ver=1');
});

$('.del-photo').on('click', function(){
    var chk_box = $(this).parent().find('input[type="checkbox"]');
    var id_row = $(this).parent().find('input[type="checkbox"]').data("id");

    if(chk_box.is(":checked")==true){
      chk_box_text = "ระงับการใช้งาน";
      chk_box_value = 2;
    }else{
      chk_box_text = "ใช้งานรายการนี้";
      chk_box_value = 1;
    }

    swal({
    title: "ยืนยันการทำงาน !",
    text: "คุณต้องการ"+chk_box_text+". ใช่หรือไม่ ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ใช่, ทำรายการ!",
    cancelButtonText: "ไม่, ยกเลิก!",
    closeOnConfirm: false,
    closeOnCancel: true
   },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: 'POST',
          url: "module/module_machine_master/ajax_action.php",
          data:{action:"update-status", chk_box_value:chk_box_value, id_row:id_row},
          success: function (data) {
            console.log(data);
            if(data==1){
              swal("สำเร็จ!", "บันทึกข้อมูลเรียบร้อยแล้ว.", "success");
              if(chk_box.is(":checked")==true){
                ///alert("checked");
                chk_box.prop('checked',false);
              }else{
                //alert("ไม่ได้ checked");
                chk_box.prop('checked',true);
              }
            }else{
              swal("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้.", "error");
            }
          },
          error: function (data) {
            swal("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้.", "error");
          }
        });
      } else {
        return true;        
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
    return false;
    //$(this).parent().find('input[type="checkbox"]').prop('checked',true);
});

$('.remove-photo').on('click', function(e) {
    $('#photo').attr("value", "");  
    $('#preview').attr('src', 'uploads-temp/default.png?ver=1');
    e.preventDefault();
});

$(document).on("change", "#photo", function (e){ 
    e.preventDefault();
    var filesize  = (this.files[0].size)/100;
    if(filesize><?PHP echo $imagesize;?>){
        swal("ผิดพลาด!", "ขนาดไฟล์ต้องไม่เกิน 5 Mb.", "error");
        $('#photo').val('');
        return false;
    }else{
        RecurFadeIn();
        readURL(this);    
    }
    //alert(filesize);
});

$(document).on("change", "#ref_id_menu", function (e){ 
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    //alert(id_site_val);
    $.ajax({
        url: "module/module_machine_master/ajax_action.php",
        type: "POST",
        data:{"ref_id_menu":ref_id_menu, "action":"chk_subCate"},
        beforeSend: function () {
        },
        success: function (data) {
        //console.log(data);
        if(data){
            $('#ref_id_sub_menu').html(data);
        }else{
            swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
        }   
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });
});

$(document).on("change", "#ref_id_dept", function (e){ 
    var ref_id_dept = $("#ref_id_dept option:selected" ).val();
    var ref_id_dept_txt = $("#ref_id_dept option:selected" ).text();
    const  myArray = ref_id_dept_txt.split(" - ");
    //let word = myArray[1];
    //alert(ref_id_dept+'-----'+ref_id_dept_txt+'----'+myArray[0]);    return false;
    $.ajax({
        url: "module/module_machine_master/ajax_action.php",
        type: "POST",
        data:{"ref_id_dept":ref_id_dept, "action":"chk_dept_cate"},
        beforeSend: function () {
        },
        success: function (data) {
        //console.log(data);
        if(data){
            $('#ref_id_menu').html(data);
            $('#machine_code').val(myArray[0]+'-AS-0000');
        }else{
            swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
        }   
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });
});

/*ปุ่ม ADD Recive รับวัสดุเข้าระบบ <<<<<<<<<< เขียนใหม่ใช้โค๊ดนี้ สมบรูณ์กว่าไม่มีบั๊ครีเฟรชหน้าจอ*/
    $(document).on("click", ".btn-submit", function (event){
    //$(document).on("submit", "form#needs-validation", function(event){
    event.preventDefault();
    var formAdd = document.getElementById('needs-validation');  
    //var frmData = $("form#needs-validation").serialize();
    var frm_Data= new FormData($('form#needs-validation')[0]);
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_machine_master/ajax_action.php",
            type: "POST",
            //dataType: "JSON",
            data: frm_Data,
            processData: false,
            contentType: false,            
            //data:{"data":frm_Data, "action":"adddata"},
            beforeSend: function () {
            },
            success: function (data) {
                //console.log(data); return false;
                if(data==1){
                    sweetAlert("ผิดพลาด!", "ชื่อเครื่องจักร-อุปกรณ์: '"+$("#name_machine").val()+"' ถูกใช้แล้ว", "error");
                    return false;
                }else{
                    sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                    $('#example1').DataTable().ajax.reload();
                    $("#modal-default").modal("hide"); 
                    $(".modal-backdrop").hide().fadeOut();
                    sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                    $('body').find('.was-validated').removeClass();
                    $('form').each(function() { this.reset() });
                    $('#id_row').val('');
                    $('#chk_ref_id_dept').val('');
                    $('#ref_id_dept option:eq(0)').attr('selected','selected');
                    $('#ref_id_menu option:eq(0)').attr('selected','selected');
                    $('#photo').attr("value", "");  
                    $('#preview').attr('src', 'uploads-temp/default.png?ver=1');
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