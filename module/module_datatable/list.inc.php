<?PHP
/*echo "INSERT INTO `tb_datatable` (`id_row`, `col_name_1`, `col_name_2`, `col_name_3`, `col_name_4`, `col_name_5`) VALUES";
for($i=1;$i<=200;$i++){
    $sec = RAND(1,59);
    $sec<=9 ? $sec = '0'.$sec : $sec;
    echo "(NULL, 'Value_".$i."', 'Col_name_2-".$i."', '".$sec."', '".date("Y-m-d H:".$sec.":".$sec."")."', '".(RAND(1,2))."'),<br/>";
}*/
/*echo "INSERT INTO `tb_datatable_2` (`id_rows`, `ref_id_row`, `add_value`, `edit_value`, `delete_value`, `view_value`, `text_value`) VALUES";
for($i=1;$i<=300;$i++){
    $sec = RAND(1,59);
    $rand = substr(md5(microtime()),rand(0,26),5);
    $sec<=9 ? $sec = '0'.$sec : $sec;
    echo "(NULL,'".(RAND(1,200))."', '".(RAND(1,2))."', '".(RAND(1,2))."', '".(RAND(1,2))."', '".(RAND(1,2))."', '".$rand."'),<br/>";
}*/
?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<style>
.dataTables_length, .form-control-sm{  font-size:0.85rem; }/* 40px/16=2.5em */
.table, .dataTable tr td{  padding:0.35rem 0.50rem;  margin:0;}
.btn-sm{ padding:0.10rem 0.40rem 0.20rem 0.40rem; margin:0.0rem 0.0rem;}
.dt-buttons button{font-size:0.85rem; /* 40px/16=2.5em */}
.dropdown-menu{  /*left:-70px;*/}
.dropdown-menu a.dropdown-item{  font-size:0.85rem; /* 40px/16=2.5em */ }

</style>

<!-- Main content -->
<div class="chk_chk"></div>
<section class="content">

    <!-- Default box -->
    <div class="card">
    
    <div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-bezier-curve"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
    </div>

    <?php
      include_once 'module/module_datatable/frm_add-edit.inc.php'; //หน้า add/edit
    ?>

    <div class="card-body">
      <div class="row">
      <div class="col-sm-12 p-0 m-0">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    
  <div class="row mb-2">
    <div class="col-sm-4">
      <label for="exampleSelectRounded0">เลือก Value ColName 3 :</label>
      <select class="custom-select rounded-3 w-25" id="slt_value_colname_3" name="slt_value_colname_3">
        <option value="" selected="">Select Value</option>
        <?PHP
          for($i=1;$i<=60;$i++){
            echo '<option value="'.$i.'">- Value: '.$i.'</option>';
          }
        ?>
      </select>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
  </div>
  

    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light">
        <th width="50" class="sorting_disabled">No</th>
        <th  width="80">ColName 1</th>
        <th>ColName 2</th>
        <th  width="200">ColName 3</th>
        <th  width="200">ColName 4</th>
        <th  width="80">ColName 5</th>
        <th  width="60">จัดการ</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    </div>
    </div><!-- /.row -->

    </div><!-- /.card-body -->

    </div><!-- /.card -->   

</section>
<!-- /.content -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script type="text/javascript"> 

  $(document).on("change", "#slt_value_colname_3", function (event) { //change click blur แล้วแต่เลือกใช้กับ element 
    if ($('#slt_value_colname_3').val() == "") {
        swal("ผิดพลาด!", "กรุณาเลือกค่าที่ต้องการ", "error");
        return false;
    }
        setTimeout(function () {
            $('#example1').DataTable().ajax.reload();
        }, 500);
  });

    $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0, 2, 5, 6] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 2, 4, 5, 6] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_datatable/datatable_processing.php',
        type: 'POST',
        //data : {"action":"get"},//"slt_search":slt_search
        "data": function (data) { //##ส่งแบบที่ 2 ส่งค่าตาม event Click
            data.action = "get"
            data.slt_value_colname_3 = $('#slt_value_colname_3').val();
            //data.ใส่ค่าที่ 2 = ค่าที่ 2;
          },        
        async: false,
        cache: false,
        error: function (xhr, error, code) {
          console.log(xhr, code);
        },
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
      "buttons": ["csv", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

/*
    $('#example2').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0, 2, 5, 6] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 2, 4, 5, 6] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_datatable/datatable_processing_modal.php',
        type: 'POST',
        //data : {"action":"get"},//"slt_search":slt_search
        "data": function (data) { //##ส่งแบบที่ 2 ส่งค่าตาม event Click
            data.action = "get"
            data.slt_value_colname_3 = 3;
            //data.ใส่ค่าที่ 2 = ค่าที่ 2;
          },        
        async: false,
        cache: false,
        error: function (xhr, error, code) {
          console.log(xhr, code);
        },
      },
      "paging": true,
      "lengthChange": true, //ออฟชั่นแสดงผลต่อหน้า
      "pagingType": "simple_numbers",
      "pageLength": 10,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      //"buttons": ["csv", "colvis"]
    });    
*/

$(document).ready(function () {
    
  var table = $('#example1').DataTable();
  //var info = table.page.info();

  $('#example1_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มข้อมูล</button></div>');
  $('input[type=search]').attr('placeholder', 'ชื่อย่อ หรือ ชื่อแผนก');
  //$('#example1_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example1"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');


  $(document).on('click','#addData',function(){   
    $('#exampleModalLabel span').html("เพิ่มข้อมูล");
  });

  
  $(document).on('click','.edit-data',function(){   
    $('#exampleModalLabel span').html("แก้ไขข้อมูล");
    var id_row = $(this).data("id");
    $.ajax({
      type: 'POST',
      url: "module/module_datatable/ajax_action.php",
      dataType: "json",
      data:{action:"edit", id_row:id_row},
      success: function (data) {
        console.log(data);
        if(data){//id_dept, dept_initialname, dept_name, dept_status
          $('#col_name_1').val(data.col_name_1);
          $('#col_name_2').val(data.col_name_2);
          $('#col_name_3').val(data.col_name_3);
          $('#id_row').val(data.id_row);
          $('#exampleModalLabel span').html("แก้ไขข้อมูล: "+data.col_name_1);
          if(data.col_name_5==1){
            $('#status_use').prop('checked',true);
            $('#status_hold').prop('checked',false);
          }else{
            $('#status_use').prop('checked',false);
            $('#status_hold').prop('checked',true);
          }
        }else{
          swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ", "error");
        }
      },
      error: function (data) {
        swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ.", "error");
      }
    });

      $('#example2').DataTable({
      "processing": true,
        "serverSide": true,
        "bDestroy": true,
        "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [0, 1, 2, 3, 4, 5] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
          { "bSearchable": false, "aTargets": [0, 1, 2, 3, 4, 5] } //คอลัมน์ที่าจะไม่ให้เสริท
        ], 
        ajax: {
          beforeSend: function () {
            //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
          },
          url: 'module/module_datatable/datatable_processing_modal.php?xxxx=200',
          type: 'POST',
          //data : {"action":"get"},//"slt_search":slt_search
          "data": function (data) { //##ส่งแบบที่ 2 ส่งค่าตาม event Click
              data.action = "get"
              data.id_row = id_row;
              //data.ใส่ค่าที่ 2 = ค่าที่ 2;
            },        
          async: false,
          cache: false,
          error: function (xhr, error, code) {
            console.log(xhr, error, code);
          },
        },
        "aLengthMenu": [5, 10, 25, 50, 100 ],
        "paging": true,
        "lengthChange": true, //ออฟชั่นแสดงผลต่อหน้า
        "pagingType": "simple_numbers",
        "pageLength": 5,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        /*"buttons": ["csv", "colvis"]*/
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
          url: "module/module_datatable/ajax_action.php",
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


  $(document).on('click','.check-status-mtr',function(){
    var chk_box = $(this).parent().find('input[type="checkbox"]');
    var id_row = $(this).parent().find('input[type="checkbox"]').data("id");

    if(chk_box.is(":checked")==true){
      chk_box_text = "เปิดการจัดการใบแจ้งซ่อม-เครื่องจักร แผนก ฟหหฟ ดฟหกด";
      chk_box_value = 2;
    }else{
      chk_box_text = "ยกเลิกการจัดการใบแจ้งซ่อม-เครื่องจักร แผนก ฟหกดหฟกดฟ";
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
          url: "module/module_datatable/ajax_action.php",
          data:{action:"check-status-mtr", chk_box_value:chk_box_value, id_row:id_row},
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
  

    /*module/module_datatable/datatable_processing.php*/
</script>