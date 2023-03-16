<div class="modal fade" id="modal-outsite_repair" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>ส่งซ่อมภายนอก</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-outsite_repair p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-outsite_repair btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />

        <!--<input type="submit" class="btn btn-block btn-success btn-md w-auto btn_report_result" value="บันทึก" />
        <input type="reset" class="btn btn-approved btn-danger" data-dismiss="modal" value="ยกเลิก" />-->
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->


<script>

/*********************************************************************************************************/
$(document).on("click", ".btn-outsite_repair", function (event){ 
  var frmData = $("form#needs-validation9").serialize();

  var caused_outsite_repair = $('#caused_outsite_repair').val();
  var txt_ref_id_supplier = $('#txt_ref_id_supplier').val();  
  var ref_id_supplier = $("#ref_id_supplier option:selected" ).val();
  datesent_repair = $('#datesent_repair').val();
  dateresive_repair = $('#dateresive_repair').val();

  if(caused_outsite_repair==''){ swal("ผิดพลาด!", "ระบุสาเหตุที่ส่งซ่อม", "error");    return false;}
  if(ref_id_supplier=='' && txt_ref_id_supplier==''){    swal("ผิดพลาด!", "ระบุซัพพลายเออร์", "error");    return false;}
  if(ref_id_supplier=='custom' && txt_ref_id_supplier==''){    swal("ผิดพลาด!", "ระบุซัพพลายเออร์", "error");    return false;}
  if(datesent_repair==''){ swal("ผิดพลาด!", "ระบุวันที่ส่งซ่อม", "error");    return false;}

    if($("#checkboxDanger1").prop('checked')==false){
        if(dateresive_repair==''){ swal("ผิดพลาด!", "ระบุ วันที่รับคืน", "error");    return false;}
        if(dateresive_repair<datesent_repair){
            swal("ผิดพลาด!", "วันที่รับคืนน้อยกว่าวันที่ส่งซ่อม"); return false;      
        }
        if(dateresive_repair>current_date){
            swal("ผิดพลาด!", "วันที่รับคืนมากกว่าวันที่ปัจจุบัน"); return false;      
        }
    }

    var datesent_repair = new Date($('#datesent_repair').val().replace(/\//g, '-'));
    var dateresive_repair = new Date($('#dateresive_repair').val().replace(/\//g, '-'));
    var current_date= new Date('<?php echo date('Y-m-d');?>');
    if(datesent_repair>current_date){
      swal("ผิดพลาด!", "วันที่ส่งซ่อมมากกว่าวันที่ปัจจุบัน"); return false;      
    }
    
  swal({
        title: "บันทึกข้อมูล \r\n การส่งเคลมซัพพลายเออร์ ?",   text: "ใบแจ้งซ่อมเลขที่: <?PHP echo $breadcrumb_txt;?>",
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
            data:{"data":frmData, "action":"outsite_repair",  "ref_id":<?PHP echo $id; ?>},
            //data:{ "action":"outsite_repair", ref_id:<?PHP echo $rowData['id_maintenance_request']; ?>},
            /*dataType: "json",
            processData: false,
            contentType: false,
            data: frm_Data, */
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

    $(document).on("click", ".btn_outsite_repair", function (e){ 
    e.stopPropagation();
    });

    $(document).on("click", ".chk_id_supplier", function (){ 
        $('#txt_ref_id_supplier').val("").toggleClass('d-none d-block');
        $('#ref_id_supplier').toggleClass('d-none d-block');
        $("#ref_id_supplier option[value='']").prop("selected", true);
        $('.chk_id_supplier').toggleClass('d-none d-inline');
        $('.chk_id_supplier').toggleClass('d-none d-inline');
        $('.invalid-feedback').toggleClass('d-none d-inline');
    });        


    $(document).on("change", "#ref_id_supplier", function (){ 
    var ref_id = $(this).val();
    if(ref_id=='custom'){
        //$("#ref_id_supplier option[value='']").prop("selected", true);
        $('#txt_ref_id_supplier').val("").toggleClass('d-none d-block');
        $('#ref_id_supplier').toggleClass('d-none d-block');
        $('.chk_id_supplier').toggleClass('d-none d-inline');        
    }
});        

});
</script>