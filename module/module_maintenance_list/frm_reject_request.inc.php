<div class="modal fade" id="modal-reject_request" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>ปฎิเสธรับงาน</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-reject_request p-0 py-2">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <!--<input type="submit" class="btn btn-primary btn-submit btn-success" value="อัพเดท" />-->
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn_update_reject">ปฏิเสธรับงาน</button>
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

    $(document).on("click", ".btn_update_reject", function (e){ 
    e.stopPropagation();
    //var frmData = $("form#needs-validation_12").serialize();
    var reject_caused = $("#reject_caused").val();
    if(reject_caused==''){
        sweetAlert("ผิดพลาด!", "ระบุสาเหตุปฏิเสธรับงานซ่อมนี้", "error"); return false;
    }
    swal({
        title: "ยืนยันปฏิเสธรับงานซ่อมนี้ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        cancelButtonText: "ไม่, ยกเลิก",
        confirmButtonText: "ยืนยัน",
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{"action":"update_reject","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>,"reject_caused":reject_caused},
            beforeSend: function () {
            },success: function (data) {
                $("#modal-reject_request").modal('hide');
                console.log(data); //return false;
                event.stopPropagation();
                swal({
                    title: "อัพเดทข้อมูลเรียบร้อยแล้ว.",
                    //text: "คลิก \"OK\" เพื่อปิดหน้าต่างนี้",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    //console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    //window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
    event.preventDefault();    
    event.stopPropagation();
    });
});
</script>