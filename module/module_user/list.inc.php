<?PHP
/*echo "INSERT INTO `tb_site` (`id_unit`, `dept_initialname`, `unit_name`, `status_unit`) VALUES";
for($i=14;$i<=500;$i++){
    echo "<br/>(NULL, 'test-".$i."', 'test-".$i."', ".(rand(1, 2))."),";
}
*/
?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<style>
.dataTables_length, .form-control-sm{  font-size:0.85rem; /* 40px/16=2.5em */
}
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
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-angle-double-right"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
    </div>

    <?php
      include_once 'module/module_user/frm_add-edit.inc.php'; //หน้า add/edit
    ?>

    <div class="card-body">
      <div class="row">
      <div class="col-sm-12 p-0 m-0">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    
    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light">
        <th width="60" class="sorting_disabled">No</th>
        <th width="80">รหัสพนักงาน</th>
        <th>อีเมล์</th>
        <th>ชื่อ-นามสกุล</th>
        <th width="60">ไซต์</th>
        <th width="60">แผนก</th>
        <th width="90">ระดับผู้ใช้งาน</th>
        <th width="60">สถานะ</th>
        <th width="60">จัดการ</th>
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

<!--<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>-->
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script type="text/javascript"> 

  $('#some_button').click(function refreshData() {
    $('#example1').DataTable().ajax.reload();
  });

    $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0,4, 5, 6, 7,8] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 4, 5, 6, 7, 8] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_user/datatable_processing.php',
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
      "buttons": ["csv", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

$(document).ready(function () {
    
  var table = $('#example1').DataTable();
  //var info = table.page.info();

  $('#example1_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มผู้ใช้งาน</button></div>');
  $('input[type=search]').attr('placeholder', 'รหัสพนักงาน, อีเมล์, ชื่อผู้ใช้งาน');
  //$('#example1_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example1"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');


  $(document).on('click','#addData',function(){   
    $('#exampleModalLabel span').html("เพิ่มผู้ใช้งาน");
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
  });

  
  $(document).on('click','.edit-data',function(){   
    $('#exampleModalLabel span').html("แก้ไขผู้ใช้งาน");
    var id_row = $(this).data("id");
    $.ajax({
      type: 'POST',
      url: "module/module_user/ajax_action.php",
      dataType: "json",
      data:{action:"edit_user", id_row:id_row},
      beforeSend: function () {
      },      
      success: function (data) {
        console.log(data);
        if(data){
          $('#exampleModalLabel span').html("แก้ไขผู้ใช้งาน: "+data.email);
          $('#id_row').val(data.id_user);
          $('#no_user').val(data.no_user);
          $('#fullname').val(data.fullname);
          $('#email').val(data.email);
          $("#class_user_"+data.class_user).attr("checked", "checked");
          $("#ref_id_site"+data.ref_id_site).attr("checked", "checked");
          $("#slt_ref_id_dept"+data.ref_id_site).attr("selected", "selected");          
          $("#slt_ref_id_dept option[value='"+data.ref_id_dept+"']").attr("selected", "selected");
         
          if(data.status_user==1){
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
  });

  
  $(document).on('click','.view-data',function(){
      swal("ขออภัย อยู่ระหว่างพัฒนา", "เมนูแสดงผลผู้ใช้งาน, เครื่องจักรที่รับผิดชอบ", "error");
  });
  $(document).on('click','.check-status',function(){
    var chk_box = $(this).parent().find('input[type="checkbox"]');
    var id_row = $(this).parent().find('input[type="checkbox"]').data("id");
    var email = $(this).parent().find('input[type="checkbox"]').data("email");

    if(chk_box.is(":checked")==true){
      chk_box_text = "ระงับการใช้งาน \r\n "+email;
      chk_box_value = 2;
    }else{
      chk_box_text = "อนุมัติใช้งาน \r\n "+email;
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
          url: "module/module_user/ajax_action.php",
          data:{action:"update-status", chk_box_value:chk_box_value, "id_row":id_row},
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
  
    /*module/module_user/datatable_processing.php*/
</script>