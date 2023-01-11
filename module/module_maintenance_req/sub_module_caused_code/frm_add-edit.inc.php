<script type="text/javascript">  

</script> 
<?PHP
//$obj = new CRUD();
//$rowData = $obj->fetchRows("SELECT * FROM tb_caused_by_code");
?>

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
</style>

<div class="modal fade" id="modal-default-tab3" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel-tab3"><i class="fas fa-angle-double-right"></i> <span>เพิ่มสาเหตุการเสีย</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">
        <!--FORM 1 tb_caused_by_code     id_caused_by_code, ref_id_dept, caused_by_code, caused_by_name, caused_by_remark caused_by_code_status-->
        <form id="needs-validation-tab3" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
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
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use-tab3" name="caused_by_code_status" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use-tab3">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold-tab3" name="caused_by_code_status" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold-tab3">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1 tb_caused_by_code     id_caused_by_code, ref_id_dept, caused_by_code, caused_by_name, caused_by_remark caused_by_code_status-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">รหัสสาเหตุการเสีย <span class="text-red font-size-sm">(**ต้องไม่ซ้ำกับที่มีในระบบ)</span></label>  
                                    <input type="text" id="caused_by_code" name="caused_by_code" pattern="[A-Z0-9-].{5,}" maxlength="6" placeholder="รหัสสาเหตุการเสีย" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกรหัสสาเหตุการเสีย [A-z, 0-9] ภาษาอังกฤษพิมพ์ใหญ่ 3 ตัวอักษร</div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-xs-6">  
                            <div class="form-group mb-2">
                                <label>แผนกที่รับผิดชอบ: </label> 
                                <select class="custom-select" name="ref_id_dept-tab3" id="ref_id_dept-tab3" style="width:100%; font-size:0.85rem;" required></select>
                                <div class="invalid-feedback">เลือกแผนกที่รับผิดชอบ</div>
                            </div>
                        </div>
                        </div><!--row-4-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">ชื่อสาเหตุการเสีย</label>  
                                    <input type="text" id="caused_by_name" name="caused_by_name" maxlength="40" placeholder="ชื่อสาเหตุการเสีย" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อสาเหตุการเสีย (TH)</div>
                                </div>
                            </div>
                        </div>                        

                        <div class="row row-5">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">หมายเหตุ(ถ้ามี):</label>  
                                    <textarea class="form-control" id="caused_by_remark" name="caused_by_remark" rows="3" placeholder="รายละเอียด ..."></textarea>
                                </div>
                            </div>
                        </div><!--row-5-->

                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_row-tab3" id="id_row-tab3" />
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
<!-- /.modal-default-tab3 -->


<script type="text/javascript">

$(document).ready(function(){

$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
});    


    $(document).on("click", ".btn-submit", function (event){
        var formAdd = document.getElementById('needs-validation-tab3');  
        var frmData = $("form#needs-validation-tab3").serialize();

        if(formAdd.checkValidity()===false) {  
            event.preventDefault();  
            event.stopPropagation();
        }else{
            //alert('Send Ajax'); return false;
            $.ajax({
                url: "module/module_maintenance_req/sub_module_caused_code/ajax_action.php",
                type: "POST",
                data:{"data":frmData, "action":"adddata"},
                beforeSend: function () {
                },
                success: function (data) {
                console.log(data);
                //return false;
                if(data==1){
                    sweetAlert("ผิดพลาด!", "รหัสสาเหตุการเสีย '"+$("#caused_by_code").val()+"' ถูกใช้แล้ว", "error");
                    return false;
                }else{
                    sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                    $('#example4').DataTable().ajax.reload();
                    $("#modal-default-tab3").modal("hide"); 
                    $(".modal-backdrop").hide().fadeOut();
                    sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                    $('body').find('.was-validated').removeClass();
                    $('#id_row-tab3').val('');
                    $('form').each(function() { this.reset() });
                }   
                    event.preventDefault();
                },
                    error: function (jXHR, textStatus, errorThrown) {
                    //console.log(data);
                    alert(errorThrown);
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
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