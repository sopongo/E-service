<style type="text/css"> 
.MultiFile-list{ background:#EB2B2B; margin:3px; padding:5px; width: 100%; }
div.MultiFile-label{background:#fff /*EB2B2B*/; padding:6px; width:32%; margin-right:5px; margin-top:10px; display: inline-block; }
span.MultiFile-label{background:#CCC; }
.MultiFile-title{ width:100%; font-size:0.80rem;  padding: 4px; background:#D0F; height:28px; display:inline-block; overflow:hidden;}
.MultiFile-remove{ background:#fff;}
img.MultiFile-preview{ display:block; padding:6px; border:1px solid #ccc; margin-top:10px; width:auto; height:100px;}
</style>

<div class="modal fade" id="modal-img_after_repair" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
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
        <input type="submit" class="btn btn-primary btn-img_after_repair btn-success" value="บันทึก" />
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
    var frmData = $("form#needs-validation_11").serialize();
    var numFiles = $("input:file")[0].files.length;

    if(numFiles==0){ swal("ผิดพลาด!", "แนบรูปถ่ายหลังซ่อมอย่างน้อย 1 รูป", "error");  return false;}

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
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            data:{"data":frmData, "action":"update_parts",  "ref_id":<?PHP echo $id; ?>},
            //data:{ "action":"outsite_repair", ref_id:<?PHP echo $rowData['id_maintenance_request']; ?>},
            /*dataType: "json",
            processData: false,
            contentType: false,
            data: frm_Data, */
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                //event.stopPropagation();
                $("#modal-change_parts").modal('hide');
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
                    //window.location.href = '?module=requestid&id=<?PHP echo $id; ?>';
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