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

        <div class="sec-ajax col-md-8 bg-light p-1 m-2">
            <p>ตย. การส่งค่าด้วย ajax หลังจากโหลด Datatable แล้ว</p>
          <div class="row">
          <div class="col-md-4 mb-2">
          <lebel>Val 1:</lebel>
            <input type="text" name="val_1" id="val_1" class="form-control form-control-sm" placeholder="val_1" />
          </div><!--end col-6-->

          <div class="col-md-4 mb-2">
            <lebel>Val 2:</lebel>
            <input type="text" name="val_2" id="val_2"  class="form-control form-control-sm" placeholder="val_2" />
          </div><!--end col-6-->

          <div class="col-md-4 mb-2">
          <lebel>Radio:</lebel>
          <div class="form-group clearfix">
          <div class="icheck-success d-inline">
            <input type="radio" name="radio_1" id="radioSuccess1"  value="1">
            <label for="radioSuccess1"  class="text-success">ส่งค่า RADIO= 1</label>
          </div>
          <div class="icheck-danger d-inline ml-5">
            <input type="radio" name="radio_1" id="radioSuccess2" value="2">
            <label for="radioSuccess2" class="text-danger">ส่งค่า RADIO= 2</label>
          </div>
        </div>
          </div><!--end col-6-->          

          </div><!--end row-->          
          <button id="sendval" name="sendval" class="btn btn-success btn-md">ส่งค่า</button>            
        </div><!--end sec-ajax-->


    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light">
        <th class="sorting_disabled">No</th>
        <th>ไซต์</th>
        <th>แผนก</th>
        <th>ชื่อแบรนด์</th>
        <th>หมายเหตุ</th>
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

/*$(document).on('click','.sendval',function(){
  $('#example1').DataTable().reload();
});*/


  $(document).ready(function () {
    var applications = '';
    var val_1 = $('#val_1').val();
    //var table = $('#example1').DataTable();
    var table = $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0,1, 4, 5] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 1, 2, 4, 5 ] } //คอลัมน์ที่าจะไม่ให้เสริท
      ],
      ajax: {
        beforeSend: function () {
          //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
        },
        url: 'module/module_demo/datatable_processing.php?testval=1234', 
        //data : {"action":"get" },//"slt_search":slt_search ##ส่งแบบที่ 1 ส่งค่าแค่รอบเดียว
        "data":function(data) { //##ส่งแบบที่ 2 ส่งค่าตาม event Click
            data.val_1 = $('#val_1').val();
            data.val_2 = $('#val_2').val();
            data.radio_1 = $('input[name=radio_1]:checked').val();
          },
        type: 'POST',
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

    //var info = table.page.info();

    $('#sendval').click(function refreshData() {
     $('#example1').DataTable().ajax.reload();
    });

    /*$(document).on('click','#sendval',function(){
        table.DataTable().draw();
      });    */

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