<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
.dataTables_length, .form-control-sm{
  font-size:0.85rem; /* 40px/16=2.5em */
}
.table, .dataTable tr td{
  padding:0.50rem 0.50rem;
  margin:0;
}

.btn-sm{
  padding:0.10rem 0.40rem 0.20rem 0.40rem;
  margin:0.0rem 0.0rem;
}

.dt-buttons button{font-size:0.85rem; /* 40px/16=2.5em */}

.dropdown-menu a.dropdown-item{
  font-size:0.85rem; /* 40px/16=2.5em */
}
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


    <div class="card-body">

      <div class="row">
      <div class="col-sm-12">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light">
        <th class="sorting_disabled">No</th>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-นามสกุล</th>
        <th>อีเมล์</th>
        <th>ไซต์งาน</th>
        <th>แผนก</th>
        <th>ระดับ</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    </div>
    </div>

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

    $('#example1').DataTable({
      "processing": true,
      "serverSide": true,
      //"order": [0,'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [0,4,5,6,7,8] }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
        { "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] } //คอลัมน์ที่าจะไม่ให้เสริท
      ], 
      ajax: {
        url: 'module/module_demo/datatable_processing.php',
        type: 'POST',
        data : {"action":"get"},
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

    var table = $('#example1').DataTable();
    var info = table.page.info();

  $(document).ready(function () {   
    
    $(document).on("click", ".btn-show", function () {
      alert('xxxx');
    });

    $('input[type=search]').attr('placeholder', 'Email หรือ ชื่อ-นามสกุล');

    //$('#example1_filter').append(' Currently showing page '+(info.page+1)+' of '+info.pages+' pages.');
  
  });



    /*module/module_demo/datatable_processing.php*/
</script>