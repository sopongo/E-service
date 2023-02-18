<div class="modal fade" id="modal-maintenance_type" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>ประเภทใบแจ้งซ่อม</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-update-type p-0 py-2">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <!--<input type="submit" class="btn btn-primary btn-submit btn-success" value="อัพเดท" />-->
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn_update_mt_type">อัพเดท</button>
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

    $(document).on("click", ".btn_update_mt_type", function (e){ 
    e.stopPropagation();
    var slt_maintenance_type = $("#slt_maintenance_type option:selected" ).val();       
    $.ajax({
        url: "module/module_maintenance_list/update_result.inc.php",
        type: "POST",
        data:{"action":"update_mt_type","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "slt_maintenance_type":slt_maintenance_type},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            if(data="Success"){
                //$(".modal-body-update-type").html(data);
                var txt_slt_maintenance_type = $("#slt_maintenance_type option:selected" ).text();   
                $('.span_mt_type').html('- '+txt_slt_maintenance_type);
                $('#modal-maintenance_type').modal('toggle');
                swal("สำเร็จ!", "อัพเดทประเภทใบแจ้งซ่อมแล้ว", "success");
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