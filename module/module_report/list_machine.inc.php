<script src="plugins/autoNumeric/autoNumeric.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<style type="text/css">
.dataTables_length,
.form-control-sm {
    font-size: 0.85rem;
    /* 40px/16=2.5em */
}

.table,
.dataTable tr td {
    padding: 0.55rem 0.50rem;
    margin: 0;
}

.btn-sm {
    padding: 0.10rem 0.40rem 0.20rem 0.40rem;
    margin: 0.0rem 0.0rem;
}

.dt-buttons button {
    font-size: 0.85rem;
    /* 40px/16=2.5em */
}

.dropdown-menu {
    /*left:-70px;*/
}

.dropdown-menu a.dropdown-item {
    font-size: 0.85rem;
    /* 40px/16=2.5em */
}

div.dataTables_wrapper {
    width: 100%;
    /*background-color:#FCC;*/
    margin: 0 auto;
}

.dataTables_scrollBody {
    margin-bottom: 5px;
}

.radioGroup {
    display: inline-block;
    margin-bottom: 10px;
    margin-right: 10px;
}

.divloading {
    height: 600px;
    width: 100%;
}

.center {
    justify-content: center;
    align-items: center;
    display: flex;
    height: 250px;
}

a.disabled {
    pointer-events: none;
    cursor: default;
}
</style>

<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php 
if($_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){
    $fetchSelect = $obj -> fetchRows("SELECT DISTINCT(tb_dept.id_dept), tb_dept.dept_name
    FROM tb_dept
    LEFT JOIN tb_machine_master ON (tb_machine_master.ref_id_dept = tb_dept.id_dept)
    WHERE tb_machine_master.ref_id_site=".$_SESSION['sess_ref_id_site'].";");
}
if($_SESSION['sess_class_user']==1 || $_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3){
    $fetchCategory = $obj->fetchRows("SELECT DISTINCT(tb_category.name_menu), tb_category.id_menu
    FROM tb_category
    LEFT JOIN tb_machine_master ON (tb_category.id_menu = tb_machine_master.ref_id_menu)
    LEFT JOIN tb_machine_site ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
    LEFT JOIN tb_maintenance_request ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
    WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . "
    AND tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . ";");
}
?>

<section class="content">

    <div class="card">

        <div class="card-header">
            <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-chart-bar"></i>
                <?PHP echo $title_act; ?>
            </h6>
            <div class="card-tools">
                <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active">
                        <?PHP echo $breadcrumb_txt; ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="card-body">

            <form id="needs-validation" class="addform " name="addform" method="POST" enctype="multipart/form-data"
                autocomplete="off" novalidate="">

                <?php if($_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>แผนกที่รับผิดชอบเครื่องจักร-อุปกรณ์:</label>
                            <select class="form-control select2" id="dept" name="dept" onchange="getValue(this)">
                                <option selected="selected" value="0">ทั้งหมด</option>
                                <?php 
                                foreach($fetchSelect as $key=>$value){

                                    echo '<option value="'.$value['id_dept'].'" >'.$value['dept_name'].'</option>';

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ประเภทเครื่องจักร-อุปกรณ์:</label>
                            <select class="form-control select2" id="menu" name="menu">
                                <option selected="selected" value="total">ทั้งหมด</option>
                                <option id="menu" disabled="disabled">เลือกแผนก</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php }?>

                <?php if($_SESSION['sess_class_user']==1 || $_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3){?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ประเภทเครื่องจักร-อุปกรณ์:</label>
                            <select class="form-control select2" id="menu" name="menu">
                                <option selected="selected" value="total">ทั้งหมด</option>
                                <?php 
                                foreach ($fetchCategory as $key => $value) {
                                    if (empty($value['id_menu'])) {
                                        echo '<option value="none">ไม่ระบุ</option>';
                                    } else {
                                        echo '<option value="' . $value['id_menu'] . '">' . $value['name_menu'] . '</option>';
                                    }
                                }
                                ?>
                                <option value="none">ไม่ระบุ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php }?>

                <div class="row pb-3">
                    <div class="col-md-3">
                        <label for="exampleSelectRounded0">ช่วงวันที่แจ้งซ่อม:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservationtime"
                                name="reservationtime">
                        </div>
                    </div>
                </div>
            </form>

            <a href="#" class="btn btn-success btn-block w-auto d-inline-block btn-showData"><b>ค้นหา
                </b></a>

            <div class="row">
                <div class="col p-0 pt-3">
                    <!-- Custom Tabs -->
                    <div class="card card-warning card-outline staticData">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3"><i class="far fa-chart-bar"></i>
                                สถิติใบแจ้งซ่อมเครื่องจักร-อุปกรณ์</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" id="tab"
                                        data-toggle="tab">แผนภูมิ</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" id="tab"
                                        data-toggle="tab">ตาราง</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="loading col-sm-12 col-md-12 col-xs-12 p-0 divloading d-none">
                                        <div class="w-100 center"><i class="fas fa fa-sync-alt fa-spin"></i>
                                            <div class="align-text-top ml-2 text-bold pt-2">Loading...</div>
                                        </div>
                                    </div>
                                    <div id="chart_script"></div>
                                    <div id="dashboard_div" class="dashboard_div d-none">
                                        <div class="chart">
                                            <div id="barChart"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card-title"><span
                                                class="font11 text-danger">**แผนภูมินี้จะแสดงสถิติรายการเครื่องจักร-อุปกรณ์ที่มีการแจ้งซ่อมมากกว่าหรือเท่ากับ
                                                1 รายการ</span></div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">

                                    <div class="col-sm-12 p-0 m-0">

                                        <table id="example1"
                                            class="table table-bordered table-hover dataTable dtr-inline display nowrap"
                                            style="width:1000px">
                                            <!-- dataTable dtr-inline -->
                                            <!--<table id="example1" class="display nowrap" style="width:100%">-->
                                            <thead>
                                                <tr class="bg-light">
                                                    <th scope="col" class="sorting_disabled">No</th>
                                                    <th scope="col">เลขที่ใบแจ้งซ่อม</th>
                                                    <th scope="col">วันที่แจ้งซ่อม</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col">รหัสเครื่องจักร-อุปกรณ์</th>
                                                    <th scope="col">ชื่อเครื่องจักร-อุปกรณ์</th>
                                                    <th scope="col">ประเภทเครื่องจักร-อุปกรณ์</th>
                                                    <th scope="col">อาการเสีย/ปัญหาที่พบ</th>
                                                    <th scope="col">ภาพแจ้งซ่อม</th>
                                                    <th scope="col">แผนกที่รับผิดชอบ</th>
                                                    <th scope="col">ประเภทงานซ่อม</th>
                                                    <th scope="col">เกี่ยวกับความปลอดภัย</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>

        </div>

    </div>

</section>

<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })

    $(document).ready(function () {
        var startDate = moment().subtract(1, 'month');
        var endDate = moment();
        var maxDate = moment();
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
        });

        $('#reservationtime').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            maxDate: maxDate,
            timePicker: false,
            timePicker24Hour: false,
            locale: {
                format: 'DD/MM/YYYY',
                language: "th"
            }
        }).on('apply.daterangepicker', function (ev, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;
            var diffInDays = endDate.diff(startDate, 'days');
            var maxRangeInDays = moment.duration(1, 'month').asDays();
            if (diffInDays > maxRangeInDays) {
                endDate = startDate.clone().add(1, 'month');
                Toast.fire({
                    icon: 'warning',
                    title: 'เลือกช่วงวันแจ้งซ่อมได้ไม่เกิน 1 เดือน'
                })
            }
            $(this).data('daterangepicker').setEndDate(endDate);
        });

        var frmData = $("form#needs-validation").serialize();

        $.ajax({
            url: "module/module_report/ajax_action.php",
            type: "POST",
            data: {
                "data": frmData,
                "action": 'get_chart'
            },
            beforeSend: function () {
                $("#dept").prop("disabled", true);
                $("#menu").prop("disabled", true);
                $(".dashboard_div").addClass('d-none');
                $(".loading").removeClass('d-none').fadeIn(50);
                $("#barChart").hide();
            },
            success: function (data) {
                $("#dept").prop("disabled", false);
                $("#menu").prop("disabled", false);
                $("#chart_script").html(data);
                $(".dashboard_div").removeClass('d-none');
                $("#barChart").fadeIn(500);
                $(".loading").addClass('d-none').fadeOut(500);
                event.stopPropagation();
                console.log(data);
            },
            error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
            }
        });
    });


    function getValue(dept) {

        var dept = dept.value;


        $.ajax({
            url: "module/module_report/ajax_action.php",
            type: "POST",
            data: {
                "data": dept,
                "action": "get_menu"
            },
            success: function (data) {
                $("#menu").html(data);
                console.log(data);
                //return false;
            },
            error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
            }
        });

    }

    $(document).on("click", ".btn-showData", function () {

        $('#example1').DataTable().ajax.reload();

        var frmData = $("form#needs-validation").serialize();

        $.ajax({
            url: "module/module_report/ajax_action.php",
            type: "POST",
            data: {
                "data": frmData,
                "action": 'get_chart'
            },
            beforeSend: function () {
                $("#dept").prop("disabled", true);
                $("#menu").prop("disabled", true);
                // $(".dashboard_div").addClass('d-none');
                // $(".loading").removeClass('d-none').fadeIn(50);
                // $("#barChart").hide();
            },
            success: function (data) {
                $("#dept").prop("disabled", false);
                $("#menu").prop("disabled", false);
                $("#chart_script").html(data);
                // $(".dashboard_div").removeClass('d-none');
                // $("#barChart").fadeIn(500);
                // $(".loading").addClass('d-none').fadeOut(500);
                event.stopPropagation();
                console.log(data);
            },
            error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
            }
        });


    });

    $(document).on("click", "#tab", function (event) {

        $('#example1').DataTable().ajax.reload();

        var frmData = $("form#needs-validation").serialize();

        $.ajax({
            url: "module/module_report/ajax_action.php",
            type: "POST",
            data: {
                "data": frmData,
                "action": 'get_chart'
            },
            beforeSend: function () {
                $("#tab").addClass('disabled');
                $("#dept").prop("disabled", true);
                $("#menu").prop("disabled", true);
                $(".dashboard_div").addClass('d-none');
                $(".loading").removeClass('d-none').fadeIn(50);
                $("#barChart").hide();
            },
            success: function (data) {
                $("#dept").prop("disabled", false);
                $("#menu").prop("disabled", false);
                $("#tab").removeClass('disabled');
                $("#chart_script").html(data);
                $(".dashboard_div").removeClass('d-none');
                $("#barChart").fadeIn(500);
                $(".loading").addClass('d-none').fadeOut(500);
                event.stopPropagation();
                console.log(data);
            },
            error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
            }
        });

    });

    $('#example1').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "order": [0, 'desc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 3, 6, 7, 8, 9, 10, 11]
            }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
            {
                "bSearchable": false,
                "aTargets": [0, 3, 6, 7, 8, 9, 10, 11]
            } //คอลัมน์ที่จะไม่ให้เสริท
        ],
        ajax: {
            beforeSend: function () {
                //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
            },
            url: 'module/module_report/datatable_processing.php', //?keyword=xxxxxxx
            type: 'POST',
            data: function (data) {
                data.formData = $('#needs-validation').serialize();
                data.action = "module_machine";
            },
            error: function (xhr, error, code) {
                console.log(xhr, code);
            },
            async: false,
            cache: false,
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "ทั้งหมด"]
        ],
        "paging": true,
        "lengthChange": true, //ออฟชั่นแสดงผลต่อหน้า
        "pagingType": "simple_numbers",
        "pageLength": 10,
        "searching": true,
        "ordering": true,
        "info": true,
        //"autoWidth": false,
        //"responsive": true,
        "buttons": ["excel", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>