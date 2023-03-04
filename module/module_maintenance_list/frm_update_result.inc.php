<div class="modal fade" id="modal-repair_results" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>สรุปผลการซ่อม</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-update-result p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-submitxxx btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />

        <!--<input type="submit" class="btn btn-block btn-success btn-md w-auto btn_report_result" value="บันทึก" />
        <input type="reset" class="btn btn-approved btn-danger" data-dismiss="modal" value="ยกเลิก" />-->
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->

<script>
$(document).ready(function(){

    $(document).on("click", ".chk_failure_code", function (){ 
    $('#txt_failure_code').val("").toggleClass('d-none d-block');
    $('#slt_failure_code').toggleClass('d-none d-block');
    $("#slt_failure_code option[value='']").prop("selected", true);
    $('.chk_failure_code').toggleClass('d-none d-inline');
    $('.chk_failure_code').toggleClass('d-none d-inline');
    $('.invalid-feedback').toggleClass('d-none d-inline');
});    

$(document).on("change", "#slt_failure_code", function (){ 
    var ref_id = $(this).val();
    if(ref_id=='custom'){
        //$("#slt_failure_code option[value='']").prop("selected", true);
        $('#txt_failure_code').val("").toggleClass('d-none d-block');
        $('#slt_failure_code').toggleClass('d-none d-block');
        $('.chk_failure_code').toggleClass('d-none d-inline');        
    }
});    

$(document).on("click", ".chk_repair_code", function (){ 
    $('#txt_repair_code').val("").toggleClass('d-none d-block');
    $('#slt_repair_code').toggleClass('d-none d-block');
    $("#slt_repair_code option[value=''").attr("selected","selected");    
    $('.chk_repair_code').toggleClass('d-none d-inline');
});     

$(document).on("change", "#slt_repair_code", function (){ 
    var ref_id = $(this).val();
    if(ref_id=='custom'){
        //$("#slt_repair_code option[value=''").attr("selected","selected");
        $('#txt_repair_code').val("").toggleClass('d-none d-block');
        $('#slt_repair_code').toggleClass('d-none d-block');
        $('.chk_repair_code').toggleClass('d-none d-inline');        
    }
});        

$(document).on("click", ".btn_report_result", function (e){ 
e.stopPropagation();

slt_failure_code = $("#slt_failure_code option:selected" ).val();
txt_failure_code = $('#txt_failure_code').val();
 slt_repair_code = $("#slt_repair_code option:selected" ).val();
txt_repair_code = $('#txt_repair_code').val();
txt_solution = $('#txt_solution').val();
txt_caused_by = $('#txt_caused_by').val();

if(slt_failure_code=='' && txt_failure_code==''){    swal("ผิดพลาด!", "ระบุรหัสอาการเสีย", "error");    return false;}
if(slt_failure_code=='custom' && txt_failure_code==''){    swal("ผิดพลาด!", "กรอกอาการเสีย", "error");    return false;}
if(txt_caused_by==''){    swal("ผิดพลาด!", "ระบุสาเหตุของปัญหา", "error");    return false;}
if(slt_repair_code=='' && txt_repair_code==''){    swal("ผิดพลาด!", "ระบุรหัสซ่อม", "error");    return false;}
if(slt_repair_code=='custom' && txt_repair_code==''){    swal("ผิดพลาด!", "กรอกรหัสซ่อม", "error");    return false;}
if(txt_solution==''){    swal("ผิดพลาด!", "ระบุวิธีการแก้ไข/ป้องกันเกิดปัญหาซ้ำ", "error");    return false;}

var frmData = $("form#needs-validation").serialize();
$.ajax({
    url: "module/module_maintenance_list/send_request.inc.php",
    type: "POST",
    data: frmData,  
    //data:{"action":"report_result","ref_id":0},       
    //data:{"action":"report_result","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>,"data":frmData},
    beforeSend: function () {
    },
    success: function (data) {
        console.log(data);
        if(data="Success"){
            //$('#modal-repair_results').modal('toggle');
            //swal("สำเร็จ!", "บันทึกข้อมูลเรียบร้อย", "success");
        }
    },
        error: function (jXHR, textStatus, errorThrown) {
        console.log(data);
        //alert(errorThrown);
        swal("Error!", ""+errorThrown+"", "error");
    }
});
});

});
</script>