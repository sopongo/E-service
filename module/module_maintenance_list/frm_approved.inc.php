<div class="modal fade" id="modal-approved" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h6 class="modal-title font-weight-bold" id="ModalLabel-approved"><i class="fas fa-angle-double-right"></i> <span>อนุมัติ, จ่ายงานซ่อม</span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-approved p-0 py-1">

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-block btn-success btn-md w-auto btn-update-approved">จ่ายงานซ่อม</button>
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
    swal({
        title: "ยืนยันการอนุมัติ \r\n และจ่ายงานซ่อม ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/update_result.inc.php",
            type: "POST",
            data:{"action":"add_mechanic","ref_id":<?PHP echo $rowData['id_maintenance_request']; ?>, "slt_select2_mechanic":slt_select2_mechanic},            
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                //event.stopPropagation();
                $(".modal").hide().fadeOut();
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }
                swal({
                    title: "สำเร็จ!",
                    text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    console.log(data);
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


