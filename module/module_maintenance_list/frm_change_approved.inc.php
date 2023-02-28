<div class="modal fade" id="modal-change-approved" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h6 class="modal-title font-weight-bold" id="ModalLabel-approved"><i class="fas fa-angle-double-right"></i> <span>เปลี่ยน, เพิ่มช่างซ่อม</span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-change-approved p-0 py-0">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn-update-approved">บันทึก</button>
        <input type="reset" class="btn btn-approved btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-approved -->

<script>
$(document).ready(function(){

    $(document).on("click", ".btn-update-approved", function (e){ 
    e.stopPropagation();
    var mechanic_count = $('.select2-selection__choice').length;
    var slt_select2_mechanic = $('#slt_select2_mechanic').val();
    //alert(mechanic_count); return false;
    if(mechanic_count==0){
        swal("แจ้งเตือน!", "เลือกผู้รับผิดชอบอย่าน้อย 1 คน", "warning");
        return false;
    }else{
        $( ".select2-selection__choice" ).each(function( i ) {
            if ( this.style.color !== "blue" ) {
            this.style.color = "blue";
            } else {
            this.style.color = "";
            }
        });
    }
        $.ajax({
        url: "module/module_maintenance_list/send_request.inc.php",
        type: "POST",
        data:{"action":"change_mechanic","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "slt_select2_mechanic":slt_select2_mechanic},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            return false;
            //window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
            if(data="Success"){
                return false;
                //$(".modal-body-update-type").html(data);
                //var txt_slt_maintenance_type = $("#slt_maintenance_type option:selected" ).text();   
                //$('.span_mt_type').html('- '+txt_slt_maintenance_type);
                //$('#modal-maintenance_type').modal('toggle');
                //swal("สำเร็จ!", "อัพเดทประเภทใบแจ้งซ่อมแล้ว", "success");
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


