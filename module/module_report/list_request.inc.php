<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script src="plugins/autoNumeric/autoNumeric.js"></script>
<!-- Google Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- HTML2 Canvas -->
<script src="plugins/html2canvas/html2canvas.js"></script>
<script src="plugins/html2canvas/html2canvas.min.js"></script>

<style>

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

.center {
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    font-size: 1.875em;
    color: gray;
}

.radioGroup {
    display: inline-block;
    margin-bottom: 10px;
    margin-right: 10px;
}

.chart_wrap {
    position: relative;
    padding-bottom: 50%;
    height: 0;
    overflow: hidden;
}

.dashboard_div {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, 0);
    width: 100%;
    height: 100%;
    cursor: default;
    /* border: 3px solid green; */
}

.divloading {
    height: 482px;
    width: 100%;
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
            <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-chart-pie"></i>
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
            <div class="row pt-0 p-2">
                <div class="row pt-1 p-2 pr-3">
                    <a href="#" class="btn btn-success btn-block w-auto d-inline-block btn-showData">
                        <b>ค้นหา</b>
                    </a>
                </div>
            </div>
            <div class="dt-buttons btn-group flex-wrap">
                <button class="btn btn-secondary buttons-excel buttons-html5 btn-saveChart" type="button">
                    <i class="fas fa-download"></i><span> Export PNG</span>
                </button>
            </div>

            <div class="row">
                <div class="col p-0 pt-3">
                    <div id="chart_script"></div>
                    <div class="chart_wrap">
                        <div class="loading col-sm-12 col-md-12 col-xs-12 p-0 divloading d-none">
                            <div class="w-100 center"><i class="fas fa fa-sync-alt fa-spin"></i>
                                <div class="align-text-top ml-2 text-bold pt-2">Loading...</div>
                            </div>
                        </div>
                        <div id="dashboard" class="dashboard_div d-none center"></div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
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

    var frmData = $("form#needs-validation").serialize();

    $.ajax({
        url: "module/module_report/ajax_action.php",
        type: "POST",
        data: {
            "data": frmData,
            "action": 'pie_chart'
        },
        beforeSend: function () {
            $("input").prop("disabled", true);
            $(".dashboard_div").addClass('d-none');
            $(".loading").removeClass('d-none').fadeIn(5000);
        },
        success: function (data) {
            $("#chart_script").html(data);
            $("input").prop("disabled", false);
            $(".dashboard_div").removeClass('d-none');
            $(".loading").addClass('d-none').fadeOut(5000);
            event.stopPropagation();
        },
        error: function (data) {
            console.log(data);
            sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
        }
    });
});

$(document).on("click", ".btn-showData", function (event) {

    var frmData = $("form#needs-validation").serialize();

    $.ajax({
        url: "module/module_report/ajax_action.php",
        type: "POST",
        data: {
            "data": frmData,
            "action": 'pie_chart'
        },
        beforeSend: function () {
            $("#dept").prop("disabled", true);
            $("#menu").prop("disabled", true);
            // $(".dashboard_div").addClass('d-none');
            // $(".loading").removeClass('d-none').fadeIn(5000);
            // $("#barChart").hide();
        },
        success: function (data) {
            $("#dept").prop("disabled", false);
            $("#menu").prop("disabled", false);
            $("#chart_script").html(data);
            // $(".dashboard_div").removeClass('d-none');
            // $("#barChart").fadeIn(5000);
            // $(".loading").addClass('d-none').fadeOut(5000);
            event.stopPropagation();
        },
        error: function (data) {
            console.log(data);
            sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
        }
    });
});

$(document).on("click", ".btn-saveChart", function (event) {

    var dashboardElement = document.getElementById("dashboard");
    // สร้างองค์ประกอบแคนวาส
    var canvas = document.createElement("canvas");
    canvas.width = dashboardElement.offsetWidth;
    canvas.height = dashboardElement.offsetHeight;

    // แสดงผลลัพธ์ขององค์ประกอบ "dashboard" บนแคนวาส
    html2canvas(dashboardElement).then(function (canvas) {
        // แปลงแคนวาสเป็นรูปภาพ PNG
        var imageData = canvas.toDataURL("image/png");

        // สร้างองค์ประกอบลิงก์ชั่วคราว
        var link = document.createElement("a");
        link.href = imageData;
        link.download = Date.now() + ".png";
        link.target = "_blank";

        // เรียกใช้การดาวน์โหลด
        link.click();
    });
});
</script>