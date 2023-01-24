<?PHP
//$obj = new CRUD();
?>

<style>
.dataTables_length, .form-control-sm{  font-size:0.85rem; /* 40px/16=2.5em */
}
.table, .dataTable tr td{  padding:0.35rem 0.50rem;  margin:0;}

.btn-sm{ padding:0.10rem 0.40rem 0.20rem 0.40rem; margin:0.0rem 0.0rem;}

.dt-buttons button{font-size:0.85rem; /* 40px/16=2.5em */}

.dropdown-menu{  /*left:-70px;*/}
.dropdown-menu a.dropdown-item{  font-size:0.85rem; /* 40px/16=2.5em */ }

</style>

    <?php
      //include_once 'frm_add-edit.inc.php'; //หน้า add/edit
      //include_once 'test.inc.php'; 
      include_once 'frm_add-edit.inc.php'; //หน้า add/edit      
    ?>

    <div class="card-body p-3">
      <div class="row">
      <div class="col-sm-12 p-0 m-0">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    
    <table id="example5" class="table table-bordered table-hover dataTable dtr-inline table-responsive-xl">
      <thead>
      <tr class="bg-light">
        <th class="sorting_disabled">No</th>
        <th>สาเหตุการปฏิเสธงานซ่อม</th>
        <th>แผนกที่รับผิดชอบ</th>
        <th>หมายเหตุ</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    </div>
    </div><!-- /.row -->

    </div><!-- /.card-body -->


<script type="text/javascript"> 

  $('#some_button').click(function refreshData() {
    $('#example5').DataTable().ajax.reload();
  });

    $('#example5').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0, 3, 4, 5] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [0, 3, 4, 5] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_maintenance_req/sub_module_reject_mtr/datatable_processing.php',
        type: 'POST',
        data : {"action":"get"},//"slt_search":slt_search
        async: false,
        cache: false,
      },
      "paging": true,
      "lengthChange": true, //ออฟชั่นแสดงผลต่อหน้า
      "pagingType": "simple_numbers",
      "pageLength": 10,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

$(document).ready(function () {
    
  var table = $('#example5').DataTable();
  //var info = table.page.info();

  $('#example5_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-tab5" id="addData-tab5" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มสาเหตุการปฏิเสธงานซ่อม</button></div>');
  $('input[type=search]').attr('placeholder', 'สาเหตุการปฏิเสธงานซ่อม');
  //$('#example5_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example5"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');

  $(document).on('click','#addData-tab5',function(){
    $('#id_row-tab5').val('');
    $('#exampleModalLabel-tab5 span').html("เพิ่มสาเหตุการปฏิเสธงานซ่อม");    
    $.ajax({
    type: 'POST',
      url: "module/module_maintenance_req/sub_module_reject_mtr/ajax_action.php",
      dataType: "json",
      data:{action:"ref_id_dept"},
      success: function (data) {
        //console.log(data);
        $('#ref_id_dept-tab5').html(data);
      },
      error: function (data) {
        //console.log(data);        
        swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ.", "error");
      }
    });
  });

  $(document).on('click','.edit-data-tab5',function(){   
    $('#exampleModalLabel-tab5 span').html("แก้ไขสาเหตุการปฏิเสธงานซ่อม");
    var id_row = $(this).data("id");
    $.ajax({
      type: 'POST',
      url: "module/module_maintenance_req/sub_module_reject_mtr/ajax_action.php",
      dataType: "json",
      data:{action:"edit", id_row:id_row},
      success: function (data) {
        //console.log(data);
        if(data){//tb_reject_mtr_code id_reject_mtr, ref_id_dept, reject_mtr_name, reject_mtr_remark, reject_mtr_status
          $('#ref_id_dept-tab5').html(data.slt_ref_id_dept);
          $('#reject_mtr_name').val(data.reject_mtr_name);
          $('#reject_mtr_remark').val(data.reject_mtr_remark);
          $('#id_row-tab5').val(data.id_reject_mtr);
          $('#exampleModalLabel-tab5 span').html("แก้ไขสาเหตุการปฏิเสธงานซ่อม: "+data.reject_mtr_name);
          if(data.repair_code_status==1){
            $('#status_use-tab5').prop('checked',true);
            $('#status_hold-tab5').prop('checked',false);
          }else{
            $('#status_use-tab5').prop('checked',false);
            $('#status_hold-tab5').prop('checked',true);
          }
        }else{
          //console.log(data);
          swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
        }
      },
      error: function (data) {
        //console.log(data);
        swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ.", "error");
      }
    });
  });


  $(document).on('click','.check-status',function(){
    var chk_box = $(this).parent().find('input[type="checkbox"]');
    var id_row = $(this).parent().find('input[type="checkbox"]').data("id");

    if(chk_box.is(":checked")==true){
      chk_box_text = "ระงับการใช้งาน";
      chk_box_value = 2;
    }else{
      chk_box_text = "ใช้งานรายการนี้";
      chk_box_value = 1;
    }

    swal({
    title: "ยืนยันการทำงาน !",
    text: "คุณต้องการ"+chk_box_text+". ใช่หรือไม่ ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ใช่, ทำรายการ!",
    cancelButtonText: "ไม่, ยกเลิก!",
    closeOnConfirm: false,
    closeOnCancel: true
   },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: 'POST',
          url: "module/module_maintenance_req/sub_module_reject_mtr/ajax_action.php",
          data:{action:"update-status", chk_box_value:chk_box_value, id_row:id_row},
          success: function (data) {
            console.log(data);
            if(data==1){
              swal("สำเร็จ!", "บันทึกข้อมูลเรียบร้อยแล้ว.", "success");
              if(chk_box.is(":checked")==true){
                ///alert("checked");
                chk_box.prop('checked',false);
              }else{
                //alert("ไม่ได้ checked");
                chk_box.prop('checked',true);
              }
            }else{
              swal("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้.", "error");
            }
          },
          error: function (data) {
            swal("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้.", "error");
          }
        });
      } else {
        return true;        
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
    return false;
    //$(this).parent().find('input[type="checkbox"]').prop('checked',true);
  });



});
  

    /*module/module_maintenance_req/sub_module_reject_mtr/datatable_processing.php*/
</script>