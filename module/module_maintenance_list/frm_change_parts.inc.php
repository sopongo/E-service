<div class="modal fade" id="modal-change_parts" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>เพิ่มรายการอะไหล่ที่เปลี่ยน</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-change_parts p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-update_parts btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->


<script>

/*********************************************************************************************************/
$(document).on("click", ".btn-update_parts", function (event){ 
  var frmData = $("form#needs-validation10").serialize();

    var parts_name = $('#parts_name').val();
    var parts_price = $('#parts_price').val();    
    var parts_qty = $('#parts_qty').val();
    var date_parts_change = $('#date_parts_change').val();

  if(date_parts_change==''){ swal("ผิดพลาด!", "ระบุวันที่เปลี่ยนอะไหล่", "error");  return false;}
  if(parts_name==''){ swal("ผิดพลาด!", "กรอกชื่ออะไหล่", "error");  return false;}
  if(parts_price==''){ swal("ผิดพลาด!", "กรอกราคาอะไหล่", "error");  return false;}
  if(parts_qty==''){ swal("ผิดพลาด!", "กรอกจำนวน/ชิ้น", "error");  return false;}      

  swal({
        title: "บันทึกข้อมูล \r\n รายการอะไหล่ที่เปลี่ยน ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
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