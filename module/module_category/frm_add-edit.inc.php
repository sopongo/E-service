<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}

.text-size-2{
 font-size:0.80rem;
}
</style>

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มหมวดเครื่องจักร-อุปกรณ์</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1 id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu-->
        <form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">

            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                        <div class="row row-2">
                        <div class="col-sm-6 col-md-6 col-xs-6">  
                            <div class="form-group mb-2">
                                <label>แผนกที่รับผิดชอบ: </label> 
                                <select class="custom-select" name="ref_id_dept" id="ref_id_dept" style="width:100%; font-size:0.85rem;" required>  
                                    <?PHP
                                    //id_menu name_menu
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE mt_request_manage=1 AND dept_status=1 ORDER BY id_dept ASC");
                                    if (count($rowData)!=0) {
                                        echo '<option value="" disabled selected>เลือกแผนกที่รับผิดชอบ</option>';
                                        foreach($rowData as $key => $value) {
                                            echo '<option value="'.$rowData[$key]['id_dept'].'">'.$rowData[$key]['dept_initialname'].' - '.$rowData[$key]['dept_name'].'</option>';
                                        }
                                    } else {
                                        echo '<option disabled selected value="" >เลือกแผนกที่รับผิดชอบ</option>  ';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">เลือกแผนกที่รับผิดชอบ</div>
                            </div>
                        </div>
                        </div><!--row-2-->

                        <div class="row row-1">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label>สถานะการใช้งาน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="status_menu" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="status_menu" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>
                        </div><!--row-1-->

                        <div class="row row-2">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label>ประเภทหมวด: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="level_cate" name="level_menu" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="level_cate">หมวดหลัก</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="level_sub" name="level_menu" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="level_sub">หมวดย่อย</label><div class="invalid-feedback float-right w-auto pl-3">เลือกประเภทหมวด</div></div></div>
                            </div>
                        </div>
                        </div><!--row-2-->

                        <div class="row row-cate d-none">
                        <div class="col-sm-6 col-md-6 col-xs-6">  
                        <div class="form-group">  
                        <label>เลือกหมวดหลัก: </label> 
                            <select class="custom-select" name="ref_id_menu" id="ref_id_menu" style="width:100%; font-size:0.85rem;">  
                                    <?PHP
                                    //id_menu name_menu
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_category WHERE level_menu=1 AND status_menu=1 ORDER BY id_menu ASC");
                                    if (count($rowData)!=0) {
                                        echo '<option value="" disabled selected>เลือกหมวดหลัก</option>';
                                        foreach($rowData as $key => $value) {
                                            echo '<option value="'.$rowData[$key]['id_menu'].'">'.$rowData[$key]['menu_code'].' - '.$rowData[$key]['name_menu'].'</option>';
                                        }
                                    } else {
                                        echo '<option disabled selected value="" >เลือกหมวดหลัก</option>  ';
                                    }
                                    ?>
                            </select>
                        </div>
                        </div>
                        </div><!--row-cate-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสหมวด: <span class="text-red text-size-2">(**ต้องไม่ซ้ำกับที่มีในระบบ)</span></label>  
                                    <input type="text" id="menu_code" name="menu_code" placeholder="ภาษาอังกฤษ 3 ตัวอักษร" pattern="[A-Z]{3}" class="form-control" aria-describedby="inputGroupPrepend" maxlength="3" />
                                    <div class="invalid-feedback">กรอกภาษาอังกฤษพิมพ์ใหญ่ [A-Z] 3 ตัวอักษร</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">ชื่อหมวด:</label>  
                                    <input type="text" id="name_menu" name="name_menu" placeholder="ชื่อหมวด" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อหมวด</div>
                                </div>
                            </div>
                        </div><!--row-4-->


                        <div class="row row-5">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รายละเอียด(ถ้ามี):</label>  
                                    <textarea class="form-control" id="desc_menu" name="desc_menu" rows="3" placeholder="รายละเอียด ..."></textarea>
                                </div>
                            </div>
                        </div><!--row-5-->

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

$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
    $('textarea').val("");
    $('.row-cate').addClass('d-none');
});

$(document).on('change','#level_cate',function(){
    $('.row-cate').addClass('d-none');
    $('#ref_id_menu option:eq(0)').prop('selected', true);
});

$(document).on('change','#level_sub',function(){
    var id_dept_val = $("#ref_id_dept option:selected" ).val();
    if(id_dept_val==''){
        swal("ผิดพลาด!", "ต้องเลือกแผนกที่รับผิดชอบก่อน", "error");
        $('#level_sub').prop('checked', false);
    }else{
        $('.row-cate').removeClass('d-none');
    }
});
    
$(document).on("change", "#ref_id_dept", function (){ 
    var id_dept_val = $("#ref_id_dept option:selected" ).val();
    //alert(id_dept_val); return false;
    $.ajax({
        url: "module/module_category/ajax_action.php",
        type: "POST",
        data:{"id_dept_val":id_dept_val, "action":"chk_id_menu"},
        beforeSend: function () {
        },
        success: function (data) {
        //console.log(data);
        if(data){
            $('#ref_id_menu').html(data);
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

    var ref_id_dept = $("#ref_id_dept option:selected" ).val();
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
	var level_menu = $("input:radio[name=level_menu]:checked").val();
    ref_id_menu === "" ? ref_id_menu = 0 : ref_id_menu;

    //alert(ref_id_dept+'xxxxxx'+ref_id_menu+'----'+level_menu);

    if(level_menu==2 && ref_id_menu==0){
        swal("ผิดพลาด!", "เลือกหมวดหลัก", "error");  return false;                  
    }

    var formAdd = document.getElementById('needs-validation');  
    var frmData = $("form#needs-validation").serialize();
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_category/ajax_action.php",
            type: "POST",
            data:{"data":frmData, "action":"adddata"},
            beforeSend: function () {
            },
            success: function (data) {
            //console.log(data);
            if(data==1){
                sweetAlert("ผิดพลาด!", "ชื่อย่อ'"+$("#menu_code").val()+"' ถูกใช้แล้ว", "error");
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