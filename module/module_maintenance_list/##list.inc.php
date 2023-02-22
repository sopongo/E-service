<?PHP
/*echo "INSERT INTO `tb_site` (`id_dept`, `dept_initialname`, `dept_name`, `dept_status`) VALUES";
for($i=14;$i<=500;$i++){
    echo "<br/>(NULL, 'test-".$i."', 'test-".$i."', ".(rand(1, 2))."),";
}
*/
//echo $_SESSION['module_access'];
//echo $_SESSION['sess_id_dept'].'-------------'.$_SESSION['sess_class_user'];
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
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
    </div>


    <div class="card-body">
      <div class="row">
      <div class="col-sm-12 p-0 m-0">

      <div class="card">
            <div class="card-body">
            <form id="clear">
                <div class="row">

                  
                  <!--Job-->
                  <div class="col-md-2 pl-1">
                        <div class="form-group">
                            <label>Job</label>
                            <select name="JobID" class="form-control JobID">
                                    <option>All</option>
                                    <option>student</option>
                                    <option>teacher</option>
                                    <option>drive</option>
                            </select>
                            </div>
                      </div>
                  
                  <!--Age-->
                  <div class="col-md-2 pl-1">
                        <div class="form-group" id="filter_col2" data-column="2">
                            <label>Age</label>
                            <input type="text" name="Age" class="form-control column_filter" id="col2_filter" placeholder="Age">
                        </div>
                    </div>
                  
                  <!--From-->
                    <div class="col-md-2 pl-1">
                        <div class="form-group" id="filter_col3" data-column="3">
                            <label>From</label>
                            <input type="text" name="From" class="form-control column_filter date-range-filter datepicker" id="col3_filter" placeholder="mm/dd/YY">
                        </div>
                    </div>
                  
                  <!--TO-->
                  <div class="col-md-2 pl-1">
                        <div class="form-group" id="filter_col3" data-column="3">
                            <label>To</label>
                            <input type="text" name="To" class="form-control column_filter" id="col3_filter" placeholder="mm/dd/YY">
                        </div>
                    </div>
                </div>
              
                </form>
                <div class="text-center">
                <a class="btn btn-success btn-sm " href="#"><i class="fa fa-filter "></i> Filter</a>
                    <Button type="button" class="btn btn-secondary btn-sm "> Clear Filter</Button>
                </div>
            </div>
        </div>      
    
    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"><!---->
      <thead>
      <tr class="bg-light">
        <th scope="col" class="sorting_disabled">No</th>
        <th scope="col">เลขที่ใบแจ้งซ่อม</th>
        <th scope="col">วันที่แจ้งซ่อม</th>
        <th scope="col">รหัสเครื่องจักร-อุปกรณ์</th>
        <th scope="col">ชื่อเครื่องจักร-อุปกรณ์</th>
        <th scope="col">ประเภทเครื่องจักร-อุปกรณ์</th>
        <th scope="col">แผนกที่รับผิดชอบ</th>
        <th scope="col">ประเภทงานซ่อม</th>
        <th scope="col">อาการเสีย/ปัญหาที่พบ</th>
        <th scope="col">สถานะ</th>
        <th scope="col">จัดการ</th>
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

    
$(document).on('change','.JobID',function(){   
    //alert('sdsd');
    //$('#example1').DataTable().ajax.reload();
  });


  $('#some_button').click(function refreshData() {
    $('#example1').DataTable().ajax.reload();
  });


    var oTable = $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0, 7, 8, 9, 10] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [0, 7, 8, 9, 10] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_maintenance_list/datatable_processing.php?keyword=xxxxxxx',
        type: 'POST',
        data : {"action":"get", "slt_search":"keyword"},//"slt_search":slt_search
        async: false,
        cache: false,
      },  

      initComplete: function (settings, json) {
        // Add select filter
        $('#example1_length').append('<label>&nbsp; App ID:</label>');
        $('#example1_length').append('<select class="form-control input-sm"  id="am_aplicacion_id"></select>');
        am_aplicacion_ids = [{0: 'All Apps'}, {"Notebook": 'Notebook'}, {"Car Lift (รถแฮนด์ลิฟท์)": 'Car Lift (รถแฮนด์ลิฟท์)'}];
        for (var key in am_aplicacion_ids) {
            var obj = am_aplicacion_ids[key];
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    $('#am_aplicacion_id').append('<option value="' + prop + '">' + obj[prop] + '</option>');
                }
            }
        }
          // Filter results on select change
          $('#am_aplicacion_id').on('change', function () {
            //oTable.DataTable().ajax.reload();
            //oTable.columns(5).search($(this).val()).draw();
        });
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

  //var info = table.page.info();
  //$('#example1_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มแผนก</button></div>');
  $('input[type=search]').attr('placeholder', 'ชื่อเครื่องจักร/อุปกรณ์, เลขที่ใบแจ้งซ่อม');
  //$('#example1_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example1"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');

  $(document).on('click','#addData',function(){   
    $('#exampleModalLabel span').html("เพิ่มแผนก");
  });

  
  $(document).on('click','.edit-data',function(){   
    $('#exampleModalLabel span').html("แก้ไขแผนก");
    var id_row = $(this).data("id");
    $.ajax({
      type: 'POST',
      url: "module/module_maintenance_list/ajax_action.php",
      dataType: "json",
      data:{action:"edit", id_row:id_row},
      success: function (data) {
        console.log(data);
        if(data){//id_dept, dept_initialname, dept_name, dept_status
          $('#dept_initialname').val(data.dept_initialname);
          $('#dept_name').val(data.dept_name);
          $('#id_row').val(data.id_dept);
          $('#exampleModalLabel span').html("แก้ไขแผนก: "+data.dept_name);
          if(data.mt_request_manage==1){
            $('#mtr_status_use').prop('checked',true);
            $('#mtr_status_hold').prop('checked',false);
          }else{
            $('#mtr_status_use').prop('checked',false);
            $('#mtr_status_hold').prop('checked',true);
          }
          if(data.dept_status==1){
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
          url: "module/module_maintenance_list/ajax_action.php",
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
          url: "module/module_maintenance_list/ajax_action.php",
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
  

    /*module/module_maintenance_list/datatable_processing.php*/
</script>