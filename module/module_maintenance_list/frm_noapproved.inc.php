<div class="modal fade" id="modal-noapproved" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h6 class="modal-title font-weight-bold" id="ModalLabel-noapproved"><span class="text-red"><i class="fas fa-angle-double-right"></i> ไม่อนุมัติใบแจ้งซ่อม</span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-noapproved p-0 py-1">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn-save-noapproved">บันทึก</button>
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-cancel -->

<script>
$(document).ready(function(){

    $(document).on("click", ".btn-save-noapproved", function (e){ 
    var detail_note_approved = $('#detail_note_approved').val();
    if(detail_note_approved==''){
        swal("แจ้งเตือน!", "กรอกสาเหตุที่ไม่อนุมัติ", "warning");
        return false;
    }
    swal({
            title: "ยืนยันไม่อนุมัติ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?> \r\n",
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            cancelButtonText: "ไม่, ยกเลิก",
            confirmButtonText: "ตกลง",
            closeOnConfirm: false 
        }, function(){   
            $.ajax({
                url: "module/module_maintenance_list/send_request.inc.php",
                type: "POST",
                data:{ "action":"noapproved","detail_note_approved":detail_note_approved, ref_id:<?PHP echo $rowData['id_maintenance_request'];?>},
                beforeSend: function () {
                },success: function (data) {
                    console.log(data); //return false;
                    event.stopPropagation();
                    if(data.error=='over_req'){
                        sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                        return false;
                    }else{
                        $('#modal-noapproved').modal('toggle');
                    }
                    swal({
                        title: "บันทึกข้อมูลเรียบร้อย.",
                        //text: "คลิก \"OK\" เพื่อปิดหน้าต่างนี้",
                        type: "success",
                        //timer: 3000
                    }, 
                    function(){
                        //console.log(data);
                        //event.stopPropagation();
                        //return false();
                        //alert(ref_id);
                        window.location.href = '?module=requestid&id=<?PHP echo $rowData['id_maintenance_request']; ?>';
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
