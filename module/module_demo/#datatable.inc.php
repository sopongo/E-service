<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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

    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>    

    </div><!-- /.card-body -->


    </div><!-- /.card -->

</section>
<!-- /.content -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
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
  $(function () {
    $("#example1").DataTable({
		"processing":true,
		"serverSide":true,
		"searching": true,
		"info":	true,
		"pageLength": 5,
		"lengthChange": true,
		"paging":   true,
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
		"ajax":{
			url:"module/module_demo/datatable_processing.php",
			type:"POST",
			data:{action:'listEmployee'},
			dataType:"json"
		},
    success: function (result) {
        console.log(result);
    },
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

    $(document).ready(function () {
    });
    /*module/module_demo/datatable_processing.php*/
</script>