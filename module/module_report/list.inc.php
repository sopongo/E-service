<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<script src="plugins/autoNumeric/autoNumeric.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<style>
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

</style>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">

        <div class="card-header">
            <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-file-invoice"></i>
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

                <?php if($_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){?>
                <div class="row">
                    <div class="col-12">
                        <label for="exampleSelectRounded0">ประเภทใบแจ้งซ่อม:</label>
                        <!-- radio -->
                        <div class="form-group clearfix">

                            <div class="radioGroup">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="radio" id="all" value="all" checked>
                                    <label for="all">
                                        ทั้งหมด
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup">
                                <div class="icheck-success d-inline">
                                    <input type="radio" name="radio" id="person" value="person">
                                    <label for="person">
                                        ใบแจ้งซ่อมของคุณ
                                    </label>
                                </div>
                            </div>
                            <?php if($_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==5){?>
                            <div class="radioGroup">
                                <div class="icheck-success d-inline">
                                    <input type="radio" name="radio" id="responsible" value="responsible">
                                    <label for="responsible">
                                        ใบแจ้งซ่อมที่คุณรับผิดชอบ
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup">
                                <div class="icheck-success d-inline">
                                    <input type="radio" name="radio" id="dept" value="dept">
                                    <label for="dept">
                                        ใบแจ้งซ่อมแผนก
                                    </label>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <!-- radio -->
                    </div>
                </div>
                <?php }?>

                <div class="row">
                    <div class="col-12">
                        <label for="exampleSelectRounded0">สถานะ:</label>
                        <!-- radio -->
                        <div class="form-group clearfix">

                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" class="checkbox" name="total" id="total" value="checked"
                                        onclick="javascript:checkAll(this)" checked />
                                    <label for="total">
                                        ทั้งหมด
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="wait_approved"
                                        id="wait_approved" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="wait_approved">
                                        รออนุมัติ/จ่ายงาน
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="wait_accept"
                                        id="wait_accept" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="wait_accept">
                                        รอช่างรับงานซ่อม
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-warning d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="wait_repair"
                                        id="wait_repair" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="wait_repair">
                                        รอซ่อม
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-warning d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="repairing"
                                        id="repairing" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="repairing">
                                        กำลังซ่อม
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="wait_hand_over"
                                        id="wait_hand_over" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="wait_hand_over">
                                        งานรอส่งมอบ
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="hand_over" id="hand_over"
                                        value="checked" onclick="javascript:UncheckTotal(this)" checked>
                                    <label for="hand_over">
                                        ปิดงานและส่งมอบแล้ว
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-secondary d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="no_approved"
                                        id="no_approved" value="checked" onclick="javascript:UncheckTotal(this)"
                                        checked>
                                    <label for="no_approved">
                                        ไม่อนุมัติ
                                    </label>
                                </div>
                            </div>
                            <div class="radioGroup" id="checkGroup">
                                <div class="icheck-secondary d-inline">
                                    <input type="checkbox" class="checkbox totalCheck" name="cancel" id="cancel"
                                        value="checked" onclick="javascript:UncheckTotal(this)" checked>
                                    <label for="cancel">
                                        ยกเลิกใบแจ้งซ่อม
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
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

            <!-- <a href="#" class="btn btn-success btn-block w-auto d-inline-block btn-send">
                <b>ค้นหา</b>
            </a> -->

            <div class="row pt-3 p-2">
                <div class="col-sm-12 p-0 m-0">

                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline display nowrap"
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
            </div><!-- /.row -->

        </div><!-- /.card-body -->

    </div><!-- /.card -->

</section>
<!-- /.content -->

<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">

function UncheckTotal(o) {
    var boxes = document.getElementsByName("total");
    for (var i = 0; i < boxes.length; i++) {
        boxes[i].checked = false;
    }
}

function checkAll(o) {
    var boxes = document.getElementsByClassName("checkbox");
    for (var x = 0; x < boxes.length; x++) {
        var obj = boxes[x];
        if (obj.type == "checkbox") {
            if (obj.name != "check")
                obj.checked = o.checked;
        }
    }
}

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
            data.action = "module_list";
        },
        error: function (xhr, error, code) {
            console.log(xhr, code);
        },
        async: false,
        cache: false,
    },
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "ทั้งหมด"] ],
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

$(document).on("change", "input", function (event) {
    $('#example1').DataTable().ajax.reload();
});

</script>