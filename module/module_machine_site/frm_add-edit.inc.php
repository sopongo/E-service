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
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มเครื่องจักร-อุปกรณ์รายไซต์</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">
        <!--FORM 1-->
        <div class="check"></div>
        <form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">

            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                    <div class="card-body p-3"> 

                    <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสเครื่องจักร-อุปกรณ์ (**ระบบจะสร้างให้อัตโนมัติ):</label>  
                                    <input type="text" id="machine_code" name="machine_code" readonly placeholder="??-AS-0000-000" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกรหัสเครื่องจักร-อุปกรณ์</div>
                                </div>
                            </div>                        
                        </div><!--row-4-->                    

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
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                            <div class="form-group mb-2">
                                <label><span class="text-danger">**</span> แผนกที่รับผิดชอบ: </label> 
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

                        <div class="col-sm-4 col-md-4 col-xs-4">  
                        <div class="form-group">  
                        <label><span class="text-danger">**</span> เลือกหมวดหลัก: </label> 
                            <select class="custom-select" name="ref_id_menu" id="ref_id_menu" style="width:100%; font-size:0.85rem;" required>  
                            <option disabled selected value="" >เลือกแผนกที่รับผิดชอบก่อน</option>
                            </select>
                            <div class="invalid-feedback">เลือกหมวดหลัก</div>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-xs-4">  
                        <div class="form-group">  
                        <label>เลือกหมวดย่อย: </label> 
                            <select class="custom-select" name="ref_id_sub_menu" id="ref_id_sub_menu" style="width:100%; font-size:0.85rem;">  
                            <option disabled selected value="" >เลือกหมวดหลักก่อน</option>
                            </select>
                            <div class="invalid-feedback">เลือกหมวดย่อย</div>
                        </div>
                        </div>                        
                        </div><!--row-4-->

                        <div class="row row-2">
                                <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname"><span class="text-danger">**</span> เลือกเครื่องจักร-อุปกรณ์:</label>  
                                    <select class="custom-select" name="ref_id_machine" id="ref_id_machine" style="width:100%; font-size:0.85rem;" required>
                                    <option value="" disabled selected>ไม่มีข้อมูล</option></select>
                                    <div class="invalid-feedback">เลือกเครื่องจักร-อุปกรณ์:</div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-xs-6">
                        <div class="form-group">  
                        <label>ซัพพลายเออร์: </label> 
                            <select class="custom-select" name="ref_id_supplier" id="ref_id_supplier" style="width:100%; font-size:0.85rem;"><option disabled selected value="" >เลือกซัพพลายเออร์</option></select>
                        </div>
                        </div>                            

                        </div><!--row row-2 -->

                            <div class="row row-2">
                                <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">Serial No. / : ซีเรียลนัมเบอร์ (ถ้ามี):</label>  
                                    <input type="text" id="serial_number" name="serial_number" placeholder="Serial No. / : ซีเรียลนัมเบอร์" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-xs-6"><!--000-->
                              <div class="form-group">  
                                <label for="date_rcv">วันที่รับเข้า:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input input-md mr-0" id="date_rcv" name="date_rcv" value="<?PHP echo date('Y/m/d');?>" data-target="#reservationdate" required />
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <div class="invalid-feedback">เลือกวันที่รับเข้า</div>
                                  </div>
                                </div>
                              </div><!--form-group-->
                              </div>

                        </div><!--row row-2 -->                        

                        <div class="row row-cate">

                        </div><!--row-cate-->

                        <div class="row row-5">
                            <div class="col-sm-9 col-md-9 col-xs-9">  
                                <div class="form-group">  
                                    <label for="firstname">ประวัติ, รายละเอียดเพิ่มเติมเกี่ยวกับเครื่องจักร-อุปกรณ์นี้ (ถ้ามี):</label>  
                                    <textarea class="form-control w-100" id="detail_machine" name="detail_machine" rows="6" placeholder="รายละเอียด ..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-xs-3">
                                    <label>รูปเครื่องจักร-อุปกรณ์:</label>  
                                    <img src="uploads-temp/default.png?ver=1" id="preview" class="border p-2 w-100 d-block" />
                                </div>
                        </div><!--row-5-->

                        <div class="row row-6 mt-3">
                        <div class="col-sm-4 col-md-4 col-xs-4">
                        <div class="form-group">  
                        <label><span class="text-danger">**</span> ไซต์งาน: </label> 
                            <select class="custom-select" name="ref_id_site" id="ref_id_site" style="width:100%; font-size:0.85rem;" required>  
                                    <?PHP
                                    //id_menu name_menu
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_site WHERE site_status=1 ORDER BY id_site ASC");
                                    if (count($rowData)!=0) {
                                        echo '<option value="" disabled selected>เลือกไซต์งาน</option>';
                                        foreach($rowData as $key => $value) {
                                            echo '<option value="'.$rowData[$key]['id_site'].'">'.$rowData[$key]['site_initialname'].' - '.$rowData[$key]['site_name'].'</option>';
                                        }
                                    } else {
                                        echo '<option disabled selected value="" >เลือกไซต์งาน</option>  ';
                                    }
                                    ?>
                            </select>
                            <div class="invalid-feedback">เลือกไซต์งาน</div>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-xs-4">
                        <div class="form-group">  
                        <label>อาคาร: </label> 
                            <select class="custom-select" name="ref_id_building" id="ref_id_building" style="width:100%; font-size:0.85rem;"><option value="" disabled selected>ต้องเลือกไซต์งานก่อน</option></select>
                            <div class="invalid-feedback">เลือกอาคาร</div>
                        </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-xs-4">
                        <div class="form-group">  
                        <label>สถานที่ใช้งาน: </label> 
                            <select class="custom-select" name="ref_id_location" id="ref_id_location" style="width:100%; font-size:0.85rem;"><option value="" disabled selected>ต้องเลือกไซต์งานก่อน</option></select>
                            <div class="invalid-feedback">เลือกสถานที่ใช้งาน</div>
                        </div>
                        </div>                        

                        </div><!--row-6-->
           
                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_row" id="id_row" />
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


<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $("#modal-default").modal("show"); 
    //Date picker
    $('#reservationdate').datetimepicker({
        //format: 'L',
        format: 'YYYY/MM/DD'
    });

$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
});

$(document).on("change", "#ref_id_sub_menu", function (e){ 
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_sub_menu = $("#ref_id_sub_menu option:selected" ).val();       
    var ref_id_dept = $("#ref_id_dept option:selected" ).val();    
    chk_machine_site(ref_id_dept, ref_id_menu, ref_id_sub_menu);
});

$(document).on("change", "#ref_id_menu", function (e){ 
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_sub_menu = $("#ref_id_sub_menu option:selected" ).val();       
    var ref_id_dept = $("#ref_id_dept option:selected" ).val();    
    //alert(id_site_val);
    $.ajax({
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"ref_id_menu":ref_id_menu, "action":"chk_subCate"},
        beforeSend: function () {
        },
        success: function (data) {
        //console.log(data);
        if(data){
            $('#ref_id_sub_menu').html(data);
            chk_machine_site(ref_id_dept, ref_id_menu, ref_id_sub_menu);
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

$(document).on("change", "#ref_id_location", function (e){ 
    var ref_id_location = $("#ref_id_location option:selected").val();
    //alert(ref_id_location); //return false;
    if(ref_id_location==""){
        alert('xxxxxxxxxxxxxxx');
        $('#ref_id_building option:eq(0)').prop('selected', true); return false;
    }
    $.ajax({
        dataType: "json",
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"ref_id_location":ref_id_location, "action":"chk_building_location"},
        beforeSend: function () {},
        success: function (data) {
            console.log(data); //return false;
            if(data.ref_id_building!=0){
                $('#ref_id_building option[value='+data.ref_id_building+']').prop('selected', true);
            }else{
                $('#ref_id_building option:eq(0)').prop('selected', true);
            }
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            //alert(errorThrown);
        }
    });
});
    
$(document).on("change", "#ref_id_building", function (e){ 
    var ref_id_building = $("#ref_id_building option:selected" ).val();
    //alert(ref_id_building);    
    $.ajax({
        dataType: "json",
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"ref_id_building":ref_id_building, "action":"chk_location_building"},
        beforeSend: function () {},
        success: function (data) {
            console.log(data); //return false;
            $('#ref_id_location').html(data.slt_location);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            //alert(errorThrown);
        }
    });

});


$(document).on("change", "#ref_id_site", function (e){ 
    //var ref_id_site = $("#ref_id_site option:selected" ).val();
    //var ref_id_building = $("#ref_id_building option:selected" ).val();    
    //alert('xxxxxx');
    chk_location_mc();
});

function chk_location_mc(){
    //$('#ref_id_building').html('<option value="" selected>เลือกอาคาร</option>');
    var ref_id_site = $("#ref_id_site option:selected" ).val();
    $.ajax({
        dataType: "json",
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"ref_id_site":ref_id_site, "action":"chk_location_mc"},
        beforeSend: function () {},
        success: function (data) {
            console.log(data); //return false;
            $('#ref_id_building').html(data.slt_building);
            $('#ref_id_location').html(data.slt_location);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            //alert(errorThrown);
        }
    });
}

function chk_machine_site(val_id_dept, val_id_menu, val_id_sub_menu){
    $('img#preview').attr('src', '<?PHP echo $path_machine_Default;?>');
    $.ajax({
        dataType: "json",
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"val_id_dept":val_id_dept, "val_id_menu":val_id_menu, "val_id_sub_menu":val_id_sub_menu, "action":"chk_machine_site"},
        beforeSend: function () {
            //$('.check').html(ref_id_dept+'----------'+ref_id_menu+'----------'+ref_id_sub_menu);
        },
        success: function (data) {
            console.log(data); //return false;
            //alert(data.slt_mc);
            $('#ref_id_machine').html(data.slt_mc);
            $('#ref_id_supplier').html(data.slt_supplier);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });
}

$(document).on("change", "#ref_id_machine", function (e){ 
    var ref_text_machine = $("#ref_id_machine option:selected" ).text();    
    var ref_id_machine = $("#ref_id_machine option:selected" ).val();
    const  myArray = ref_text_machine.split(" : ");
    $('#machine_code').val(myArray[0]+'-000');
        $.ajax({
            dataType: "json",
            url: "module/module_machine_site/ajax_action.php",
            type: "POST",
            data:{"ref_id_machine":ref_id_machine, "action":"chk_machine_detail"},
            beforeSend: function () {},
            success: function (data) {
            console.log(data); //return false;
            if(data.photo){
                $('img#preview').attr('src', '<?PHP echo $path_machine;?>'+data.photo+'');
            }else{
                $('img#preview').attr('src', '<?PHP echo $path_machine_Default;?>');
                //swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
            }   
                event.preventDefault();
            },
                error: function (jXHR, textStatus, errorThrown) {
                console.log(data);
                alert(errorThrown);
            }
        });
});

$(document).on("change", "#ref_id_dept", function (e){ 
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_sub_menu = $("#ref_id_sub_menu option:selected" ).val();    

    var ref_id_dept = $("#ref_id_dept option:selected" ).val();
    var ref_id_dept_txt = $("#ref_id_dept option:selected" ).text();
    const  myArray = ref_id_dept_txt.split(" - ");
    //let word = myArray[1];
    //alert(ref_id_dept+'-----'+ref_id_dept_txt+'----'+myArray[0]);    return false;
    //$("#ref_id_menu" ).html('<option value="" selected="">เลือกแผนกที่รับผิดชอบ</option>');
    //$("#ref_id_sub_menu" ).html('<option value="" selected="">เลือกหมวดหลัก</option>');  

    $.ajax({
        url: "module/module_machine_site/ajax_action.php",
        type: "POST",
        data:{"ref_id_dept":ref_id_dept, "action":"chk_dept_cate"},
        beforeSend: function () {
            //$('.check').html(ref_id_dept+'----------'+ref_id_menu+'----------'+ref_id_sub_menu);
        },
        success: function (data) {
        //console.log(data); //return false;
        if(data){
            $('#ref_id_menu').html(data);
            $('#machine_code').val(myArray[0]+'-AS-0000-000');
            chk_machine_site(ref_id_dept, ref_id_menu, ref_id_sub_menu);
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
            url: "module/module_machine_site/ajax_action.php",
            type: "POST",
            //dataType: "JSON",
            data: frm_Data,
            processData: false,
            contentType: false,            
            //data:{"data":frm_Data, "action":"adddata"},
            beforeSend: function () {
            },
            success: function (data) {
            //console.log(data); //return false;
            if(data==1){
                sweetAlert("ผิดพลาด!", "ชื่อย่อ'"+$("#location_initialname").val()+"' หรือ '"+$("#location_name").val()+"' ถูกใช้แล้ว", "error");
                return false;
            }else{
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('#example1').DataTable().ajax.reload();
                $("#modal-default").modal("hide"); 
                $(".modal-backdrop").hide().fadeOut();
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('body').find('.was-validated').removeClass();
                $('form').each(function() { this.reset() });
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