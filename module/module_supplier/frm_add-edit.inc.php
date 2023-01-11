<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
</style>

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มซัพพลายเออร์</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1 tb_supplier		id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_status-->
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
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="supplier_status" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="supplier_status" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-4">
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
                        </div><!--row-4-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">ชื่อซัพพลายเออร์:</label>  
                                    <input type="text" id="supplier_name" name="supplier_name" placeholder="ชื่อซัพพลายเออร์" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อซัพพลายเออร์</div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">เบอร์โทรศัพท์:</label>  
                                    <input type="text" id="supplier_phone" name="supplier_phone" pattern="[0-9].{9,}" maxlength="10" placeholder="เบอร์โทรศัพท์" class="numonly form-control" aria-describedby="inputGroupPrepend" />
                                    <div class="invalid-feedback">เบอร์โทรศัพท์ ตัวเลข 0-9 เท่านั้น</div>
                                </div>
                            </div>                            
                        </div><!--row-4-->

                        <div class="row row-5">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">หมายเหตุ:</label>  
                                    <textarea class="form-control" rows="3" name="supplier_remark" id="supplier_remark" placeholder="Enter ..."></textarea>
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
});    

/*ปุ่ม ADD Recive รับวัสดุเข้าระบบ <<<<<<<<<< เขียนใหม่ใช้โค๊ดนี้ สมบรูณ์กว่าไม่มีบั๊ครีเฟรชหน้าจอ*/
    $(document).on("click", ".btn-submit", function (event){
    var formAdd = document.getElementById('needs-validation');  

    var frmData = $("form#needs-validation").serialize();
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_supplier/ajax_action.php",
            type: "POST",
            data:{"data":frmData, "action":"adddata"},
            beforeSend: function () {
            },
            success: function (data) {
            //console.log(data);
            if(data==1){
                sweetAlert("ผิดพลาด!", "ชื่อซัพพลายเออร์ '"+$("#supplier_name").val()+"' ถูกใช้แล้ว", "error");
                return false;
            }else{
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('#example1').DataTable().ajax.reload();
                $("#modal-default").modal("hide"); 
                $(".modal-backdrop").hide().fadeOut();
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('#id_row').val('');
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