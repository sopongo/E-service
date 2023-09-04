<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<script src="plugins/autoNumeric/autoNumeric.js"></script>

<style>
.dataTables_length, .form-control-sm{  font-size:0.85rem; /* 40px/16=2.5em */
}
.table, .dataTable tr td{  padding:0.40rem 0.50rem;  margin:0;}

.btn-sm{ padding:0.10rem 0.40rem 0.20rem 0.40rem; margin:0.0rem 0.0rem;}

.dt-buttons button{font-size:0.85rem; /* 40px/16=2.5em */}

.dropdown-menu{  /*left:-70px;*/}
.dropdown-menu a.dropdown-item{  font-size:0.85rem; /* 40px/16=2.5em */ }
</style>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    
    <div class="card-header">
        <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>
        <div class="card-tools">
        <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Table</li>
        </ol>
        </div>
    </div>


    <?php
      include_once 'module/module_demo/frm_add-edit.inc.php'; //หน้า add/edit
    ?>

    <div class="card-body">
      <div class="row">
      <div class="col-sm-12">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    
    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light">
        <th class="sorting_disabled">No</th>
        <th>Col-1</th>
        <th>Col-2</th>
        <th>Col-3</th>
        <th>Col-4</th>
        <th>Col-5</th>
        <th>Col-6</th>
        <th>Col-7</th>
        <th>จัดการ</th>
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

$('#some_button').click(function refreshData() {
  $('#example1').DataTable().ajax.reload();
});

$(document).on('change keyup blur','.taxAmount',function(){});


    $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [1,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0,4,5,6,7,8] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_demo/datatable_processing.php',
        type: 'POST',
        data : {"action":"get"},//"slt_search":slt_search
        async: false,
        cache: false,
      },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "pageLength": 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  $(document).ready(function () {
    
    
    var table = $('#example1').DataTable();
    //var info = table.page.info();

    $('#example1_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มข้อมูล</button></div>');
    $('input[type=search]').attr('placeholder', 'Col-3 หรือ Col-4');
    //$('#example1_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example1"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');

    //
    $(document).on('change','.check-status',function(){
      swal({
          title: "ยืนยันการส่งใบเบิก ?",   text: "ต้องการส่งใบเบิกรายการนี้หรือไม่.",
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "ตกลง, ส่งใบเบิก",
          cancelButtonText: "ไม่, ยกเลิก",        
          closeOnConfirm: false 
        }, function(isConfirm){   

          alert(isConfirm);
          return false;
          $.ajax({
              url: "module/module_requisition/xcart_action.php",
              type: "POST",
              dataType: "json",
              data:{req_remark:req_remark, action:"save-requisition"},
              beforeSend: function () {
                //$("#overlay").fadeIn();
              },success: function (json) {
                console.log(json); 
                if(json.error=='over_req'){
                  sweetAlert("ผิดพลาด!", "รหัส:"+json.offsupps_code+" จำนวนคงเหลือไม่พอให้เบิกแล้ว", "error");
                  return false;
                }
                swal({
                  title: "ส่งใบเบิกเรียบร้อย!",
                  text: "ใบเบิกของคุณอยู่ระหว่างการอนุมัติ.",
                  type: "success",
                  //timer: 3000
                }, 
                function(){
                  //window.location.href = "?module=requisitionlist";
                })
            },error: function (json) {
              console.log(json);
              sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
          });
      });

      if($(this).prop('checked')){
          //alert("Checked Box Selected");
      } else {
          //alert("Checked Box deselect");
      }
    });



  });
  

    /*module/module_demo/datatable_processing.php*/
</script>