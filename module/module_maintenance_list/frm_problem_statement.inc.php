<div class="modal fade" id="modal-problem_statement" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>อัพเดทอาการเสีย/ปัญหาที่พบ</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-update_problem_statement p-0 py-2">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <!--<input type="submit" class="btn btn-primary btn-submit btn-success" value="อัพเดท" />-->
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn_update_problem_statement">อัพเดท</button>
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->


<script>
$(document).ready(function(){

    $(document).on("click", ".btn_update_problem_statement", function (e){ 
    e.stopPropagation();
    var problem_statement = $("#problem_statement" ).val();       
    if(problem_statement.length<10){
        swal("แจ้งเตือน!", "รายละเอียดอาการเสีย/ปัญหาที่พบสั้นเกินไป", "warning");
        return false();
    }
    $.ajax({
        url: "module/module_maintenance_list/send_request.inc.php",
        type: "POST",
        data:{"action":"problem_statement","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "problem_statement":problem_statement},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            if(data="Success"){
                //$(".modal-body-update-type").html(data);
                //var txt_slt_maintenance_type = $("#slt_maintenance_type option:selected" ).text();   
                //$('.span_mt_type').html('- '+txt_slt_maintenance_type);
                $('#modal-problem_statement').modal('toggle');
                $(".problem_statement").html(problem_statement);
                swal("สำเร็จ!", "อัพเดทอาการเสีย/ปัญหาที่พบแล้ว", "success");
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