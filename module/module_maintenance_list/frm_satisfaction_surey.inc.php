<style type="text/css"> 

</style>

<div class="modal fade" id="modal-satisfaction_survey" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>แบบประเมิณหลังซ่อม</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-satisfaction_survey p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-success btn-send_survey" value="บันทึก" />
        <input type="reset" class="btn btn-default" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->
<script>
/*********************************************************************************************************/
$(document).on("click", ".btn-send_survey", function (event){ 
    event.preventDefault();
    var frmData = $("form#needs-validation_12");
        $("input:radio[name^=score_]").each(function () {
            var name = $(this).attr("name");
            nonum = name.replace(/[^\d\.\-]/g,'');
            if($("input:radio[name="+name+"]:checked").length==0){
                sweetAlert("ผิดพลาด!", "กรุณาทำแบบประเมิณข้อที่ "+(parseFloat(nonum)+1)+".", "error");
                return false;   
            }else{
                swal({
                    title: "บันทึกข้อมูล \r\n ผลประเมิณหลังซ่อม ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
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
                            $("#modal-satisfaction_survey").modal('hide');
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
            }
        });

    event.preventDefault();    
    event.stopPropagation();
});

$(document).ready(function(){

});
</script>