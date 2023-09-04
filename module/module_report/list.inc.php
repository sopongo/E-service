<!-- Ekko Lightbox -->
<link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>
<script src="plugins/autoNumeric/autoNumeric.js"></script>

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

.container {
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 0px;
}

</style>

<?php 
    $fetchSelect = $obj -> fetchRows("SELECT DISTINCT(tb_dept.id_dept), tb_dept.dept_name
    FROM tb_dept
    LEFT JOIN tb_maintenance_request ON (tb_maintenance_request.ref_id_dept_responsibility = tb_dept.id_dept)
    WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site'].";");

    $fetchDept = $obj->fetchRows("SELECT tb_dept.* 
    FROM tb_dept
    WHERE dept_status=1");

    $customDept = $obj-> customSelect("SELECT tb_dept.*
    FROM tb_dept
    WHERE tb_dept.id_dept = ".$_SESSION['sess_id_dept']."");

?>

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
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">ประเภทใบแจ้งซ่อม:</label>
                                <select class="form-control select2" id="selectType" name="selectType">
                                    <option selected="selected" id="all" value="all">ทั้งหมด</option>
                                    <option id="person" value="person">ใบแจ้งซ่อมของคุณ</option>
                                    <?php if($_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3){ ?>
                                    <option id="responsible" value="responsible">ใบแจ้งซ่อมที่คุณรับผิดชอบ</option>
                                    <?php }?>
                                    <?php if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){ ?>
                                    <option id="dept" value="dept">ใบแจ้งซ่อมแผนก</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php if($_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){ ?>
                        <div class="col-sm-4 col-md-4 col-xs-12 deptFilter" id="deptFilter">
                            <div class="form-group">
                                <label for="dept_request">แผนกที่รับผิดชอบงานแจ้งซ่อม:</label>
                                <select class="form-control select2" id="selectDept_responsible"
                                    name="selectDept_responsible">
                                    <option selected="selected" value="0">ทั้งหมด</option>
                                    <?php 
                                            foreach($fetchSelect as $key=>$value){
                                                echo '<option value="'.$value['id_dept'].'" >'.$value['dept_name'].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){ ?>
                        <div class="col-sm-4 col-md-4 col-xs-12 deptFilter" id="deptFilter">
                            <div class="form-group">
                                <label for="dept_request">แผนกที่ส่งใบแจ้งซ่อม:</label>
                                <select class="form-control select2" id="selectDept_request" name="selectDept_request">
                                    <option selected="selected" value="0">ทั้งหมด</option>
                                    <?php 
                                        foreach($fetchDept as $key=>$value){
                                            echo '<option value="'.$value['id_dept'].'" >'.$value['dept_name'].'</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
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
                                    <input type="checkbox" class="checkbox totalCheck" name="repairing" id="repairing"
                                        value="checked" onclick="javascript:UncheckTotal(this)" checked>
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

            <div class="row pt-3 p-2">
                <a href="#" class="btn btn-success btn-block w-auto d-inline-block btn-showData">
                    <b>ค้นหา</b>
                </a>
            </div>

            <div class="row pt-3 p-2">
                <div class="col-sm-12 p-0 m-0">
                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline display nowrap"
                        style="width:1000px">
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">

$('.select2').select2({
    theme: 'bootstrap4'
})

$(document).ready(function () {
    // Disable the "deptFilter" elements initially
    $("#selectDept_responsible").prop('disabled', true);
    $("#selectDept_request").prop('disabled', true);
    // Handle the change event of the select element
    $("#selectType").change(function () {
        // Check the selected value
        var selectedValue = $(this).val();

        // Enable or disable the "deptFilter" elements based on the selected value
        if (selectedValue === "dept") {
            $("#selectDept_responsible").prop('disabled', false);
            $("#selectDept_request").prop('disabled', false);
        } else {
            $("#selectDept_responsible").prop('disabled', true);
            $("#selectDept_request").prop('disabled', true);
        }
    });
});

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
});
// .on('apply.daterangepicker', function (ev, picker) {
//     startDate = picker.startDate;
//     endDate = picker.endDate;
//     var diffInDays = endDate.diff(startDate, 'days');
//     var maxRangeInDays = moment.duration(1, 'month').asDays();
//     if (diffInDays > maxRangeInDays) {
//         endDate = startDate.clone().add(1, 'month');
//         Toast.fire({
//             icon: 'warning',
//             title: 'เลือกช่วงวันแจ้งซ่อมได้ไม่เกิน 1 เดือน'
//         })
//     }
//     $(this).data('daterangepicker').setEndDate(endDate);
// });

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
            data.dept = $('#dept').val();
            data.action = "module_list";
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

$('input[type=search]').attr('placeholder', 'ชื่อเครื่องจักร/อุปกรณ์, เลขที่ใบแจ้งซ่อม');

$(document).on("click", ".btn-showData", function (event) {
    $('#example1').DataTable().ajax.reload();
});
</script>