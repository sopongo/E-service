<style type="text/css"> 
.MultiFile-list{ background:#EAEAEA; margin:3px; padding:5px; width: 100%; }
div.MultiFile-label{background:#fff /*EB2B2B*/; padding:6px; width:100%; margin-right:5px; margin-top:10px; display: inline-block; }
span.MultiFile-label{background:#CCC; }
.MultiFile-title{ width:100%; font-size:0.80rem;  padding: 4px; background:#EEE; height:28px; display:inline-block; overflow:hidden;}
.MultiFile-remove{ background:#fff;}
img.MultiFile-preview{ display:block; padding:6px; border:1px solid #ccc; margin-top:10px; width:auto; height:100px;}
</style>

<div class="modal fade" id="modal-img_after_repair" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มภาพถ่ายหลังซ่อม</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-img_after_repair p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-success btn-img_after_repair" value="บันทึก" />
        <input type="reset" class="btn btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->
<script>
/*********************************************************************************************************/
$(document).on("click", ".btn-img_after_repair", function (event){ 
    event.preventDefault();

    //var frmData = $("form#needs-validation_11").serializeArray();
    var frmData = $("form#needs-validation_11");

    //if(numFiles==0){ swal("ผิดพลาด!", "แนบรูปถ่ายหลังซ่อมอย่างน้อย 1 รูป", "error");  return false;}

    swal({
        title: "บันทึกข้อมูล \r\n รูปภาพหลังซ่อม ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",
        closeOnConfirm: false 
    }, function(){   
        $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        data: new FormData(frmData[0]),
        url: "module/module_maintenance_list/send_request.inc.php",
        enctype: 'multipart/form-data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                //event.stopPropagation();
                $("#modal-img_after_repair").modal('hide');
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
                    swal.close();                    
                    //return false();
                    //alert(ref_id);
                    window.location.href = '?module=requestid&id=<?PHP echo $id; ?>';
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

$(document).ready(function(){

});
</script>