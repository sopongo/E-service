<div class="modal fade" id="modal-change_parts" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span class="text-title-parts">เพิ่มรายการอะไหล่ที่เปลี่ยน</span></h5>
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
    event.stopPropagation();
    var id_parts = $('#id_parts').val();
    //alert(id_parts); return false;
    var frmData = $("form#needs-validation10").serialize();
    parts_price = 0; parts_qty=0;
    var parts_name = $('#parts_name').val();
    var parts_price = $('#parts_price').val();    
    var parts_qty = $('#parts_qty').val();
    var grand_total = $('.grand_total').text();
    
    var date_parts_change = $('#date_parts_change').val();
    var parts_serialno = $('#parts_serialno').val();
    var parts_description = $('#parts_description').val();

    parts_price = parts_price.replace(/,/g , '');
    parts_qty = parts_qty.replace(/,/g , '');
    grand_total = grand_total.replace(/,/g , '');
    grand_total = parseFloat(grand_total); 

	if(parts_price!='' && typeof(parts_price)!="undefined"){ 
        parts_price = parseFloat(parts_price); 
    }
	if(parts_qty!='' && typeof(parts_qty)!="undefined"){ 
        parts_qty = parseFloat(parts_qty);
     }

    var subTotal = (parseFloat(parts_price)*parseFloat(parts_qty)).toFixed(2);
    var grand_total = (parseFloat(grand_total)+parseFloat(subTotal)).toFixed(2);

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
                event.stopPropagation();
                part_id = data;
                part_id = part_id.replace(/[\n\r]/g, '');
                part_id = part_id.replace(/^\s+|\s+$/gm,'');

                $("#modal-change_parts").modal('hide');
                if(data=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }else{
                    var tr_partid = $('tr[class^=tr_partid_]').length;
                    var add_tr_partid = tr_partid+1;
                    //alert(tr_partid);
                    parts_price = addCommas(parts_price.toFixed(2));
                    parts_qty = addCommas(parts_qty);
                    subTotal = addCommas(subTotal);
                    //alert(part_id);
                    if(isNaN(data)){
                        //alert(data+'Show'+id_parts); //return false;
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(1)').text(parts_serialno);
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(2)').text(parts_name);
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(3)').text(parts_description);
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(4)').text(parts_price);
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(5)').text(parts_qty);
                        $('.tb_parts tr.tr_partid_'+id_parts).find('td:eq(6)').text(subTotal);
                        $('.grand_total').text(addCommas(grand_total));
                    }else{
                        //alert('Show '+data+' Show'); //return false;
                        $('.tb_parts tr:last').before('<tr class="tr_partid_'+part_id+'"><td>'+add_tr_partid+'.</td><td>'+parts_serialno+'</td><td>'+parts_name+'</td><td>'+parts_description+'</td><td class="text-right">'+parts_price+'</td><td class="text-right">'+parts_qty+'</td><td class="text-right">'+subTotal+'</td><td><button type="button" class="btn btn-danger btn-sm p-0 px-1 m-0" data-id="'+part_id+'" title="ลบรายการนี้" id="btn-del_parts"><i class="fa fa-trash-alt"></i></button> <button type="button" class="btn btn-warning btn-sm btn-edit_part p-0 px-1 m-0" data-id="'+part_id+'" data-toggle="modal" data-target="#modal-change_parts" id="addData" data-backdrop="static" data-keyboard="false" title="แก้ไขข้อมูล"><i class="fa fa-pencil-alt"></i></button></td></tr>');
                        $('.grand_total').text(addCommas(grand_total));
                    }
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
                    event.stopPropagation();
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