<!-- Google Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- HTML2 Canvas -->
<script src="plugins/html2canvas/html2canvas.js"></script>
<script src="plugins/html2canvas/html2canvas.min.js"></script>
<style>
  .checkbox-menu li label {
      display: block;
      padding: 3px 10px;
      clear: both;
      color: #333;
      white-space: nowrap;
      margin: 0;
      transition: border-color 0.4s ease;
      cursor: pointer;
  }

  .checkbox-menu li input {
      margin: 0px 5px;
      top: 2px;
      position: relative;
      cursor: pointer;
  }

  .checkbox-menu li.active label {
      background-color: #f5f5f5;
  }

  .checkbox-menu li label:hover,
  .checkbox-menu li label:focus {
      border-color: #007bff;
  }

  .checkbox-menu li.active label:hover,
  .checkbox-menu li.active label:focus {
      background-color: #f5f5f5;
  }

  .center-text {
      text-align: center;
  }

  .table-title {
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
      padding-top: 1%;
      margin-bottom: 0%;
      background-color: #F1F3F4;
  }

  .left-text {
      text-align: left;
  }

  .centered-cell {
      text-align: center;
  }

  .google-visualization-table-table tr td {
      height: 40px;
      /* Adjust the desired height value */
  }

  .align-middle {
      display: flex;
      align-items: stretch;
      height: 100%;
      justify-content: center;
      flex-direction: column;
  }

  .checkbox1-menu li label {
      display: block;
      padding: 3px 10px;
      clear: both;
      color: #333;
      white-space: nowrap;
      margin: 0;
      transition: border-color 0.4s ease;
      cursor: pointer;
  }

  #table2chart tbody tr td:nth-child(n+3):nth-child(-n+5) {
      text-align: center;
  }

  #table1chart tbody tr td:nth-child(5),
  #table2chart tbody tr td:nth-child(5) {
      text-align: center;
  }
</style>

<?php 
$fetchSite = $obj -> fetchRows("SELECT * FROM db_eservice_new.tb_site WHERE site_status = 1 ORDER BY tb_site.id_site ASC");
$siteSelect = '';
foreach($fetchSite as $key => $value){
    $siteSelect.= "<option value='".$value['id_site']."' ".($value['id_site']==$_SESSION['sess_ref_id_site'] ? 'selected' : '').">".$value['site_initialname']."</option>";
}
$currentMonth = date('m');
$previousMonth = date("m", strtotime("-1 months"));
$monthSelect ='';
for ($i = 1; $i <= 12; $i++) {
    $monthSelect.='<li><label><input type="checkbox" name="dropdownMonth[]" value="'.str_pad($i, 2, "0", STR_PAD_LEFT).'" '.(($i==$currentMonth) || ($i==$previousMonth) ? 'checked':'').' > ' . $arr_newMonths[str_pad($i, 2, "0", STR_PAD_LEFT)] . '</label></li>';
}
$currentYear = date('Y');
$yearSelect = '';
for ($year = 2023; $year <= $currentYear; $year++) {
    $yearSelect.='<li><label><input type="checkbox" name="dropdownYear[]" value="' . $year . '" '.($year==$currentYear ? 'checked':'').'> ' . $year . '</label></li>';
}
$deptSelect = $obj -> fetchRows("SELECT * FROM db_eservice_new.tb_dept WHERE tb_dept.dept_status = 1");

// foreach($deptSelect as $key => $value){
   
//     $DataDept = array(
//         "id_dept" => $value['id_dept'],
//         "dept_initialname" => $value['dept_initialname'],
//         "dept_name" => $value['dept_name']
//     );
//     $arrDept[] = $DataDept;
// }

// echo '<pre>';
// print_r($arrDept);
// echo '</pre>';
?>

<!-- Main content -->
<section class="content ">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h5 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-tools"></i>
                <?PHP echo $title_act; ?>
            </h5>
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

                <div class="card p-0">
                    <div class="card-body p-1">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12 ml-1">
                                <label>ไซต์งาน:</label>
                                <select class="custom-select col-sm-1 col-md-1 col-xs-12 mr-3" name="site" id="site"
                                    onchange="getValue(this)" style="width:100%; font-size:0.85rem;" required="">
                                    <?php echo $siteSelect ?>
                                </select>
                                <label>แผนกช่างซ่อม:</label>
                                <select class="custom-select col-sm-1 col-md-1 col-xs-12 mr-3" name="dept" id="dept"
                                    style="width:100%; font-size:0.85rem;" required="">
                                    <option selected="selected" value="0">ทั้งหมด</option>
                                </select>
                                <label>เดือน:</label>
                                <div class="d-inline">
                                    <button
                                        class="btn btn-default dropdown-toggle col-sm-4 col-md-3 col-xs-12 mr-3 justify-content-between"
                                        type="button" id="dropdownMonth" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        เลือกเดือน
                                    </button>
                                    <ul class="dropdown-menu checkbox-menu allow-focus">
                                        <?php echo $monthSelect; ?>
                                    </ul>
                                </div>
                                <div class="d-inline">
                                    <label>ปี:</label>
                                    <button
                                        class="btn btn-default dropdown-toggle col-sm-2 col-md-2 col-xs-12 mr-3 justify-content-between"
                                        type="button" id="dropdownYear" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        เลือกปี
                                    </button>
                                    <ul class="dropdown-menu checkbox-menu allow-focus">
                                        <?php echo $yearSelect; ?>
                                    </ul>
                                </div>
                                <button
                                    class="btn btn-sm btn-secondary buttons-excel buttons-html5 btn-export mt-1 mb-1"
                                    type="button">
                                    <i class="fas fa-download"></i> Export PNG
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div id="chart_script"></div>

            <div id="dashboard-content">
                <div class="row">
                    <div class="card m-0 col-12">
                        <div class="card-header">
                            <h3 class="card-title title-text">

                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-md-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                สถานะการแจ้งซ่อม
                            </h3>
                        </div><!-- /.card-header -->
                        <div id="donutchart" style="height: 400px;"></div>
                    </div>
                    <div class="card col-md-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-tools mr-1"></i>
                                สถิติการทำงานช่างซ่อม
                            </h3>
                        </div><!-- /.card-header -->
                        <div id="repairchart" style="height: 400px;"></div>
                    </div>
                    <div class="card col-md-5">
                        <div class="card-header">
                            <h3 class="card-title ">
                                <i class="fas fa-chart-bar mr-1"></i>
                                สถิติผู้ใช้งานระบบแจ้งซ่อม
                            </h3>
                        </div><!-- /.card-header -->
                        <div id="userchart" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-md-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-hard-hat mr-1"></i>
                                ช่างซ่อม
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="align-middle">
                            <div id="table2chart" class="pl-2 pr-2 pt-2"></div>
                            <div id="table1chart" class="pl-2 pr-2 pt-2"></div>
                            <div class="pl-2 pr-2 pt-1 text-center text-danger">**แสดงงานที่กำลังซ่อมทั้งหมด ไม่อิงตามช่วงเวลาที่เลือก**</div>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-clock mr-1 "></i>
                                เวลาเฉลี่ยในการซ่อม
                            </h3>
                        </div><!-- /.card-header -->
                        <div id="averagechart" style="height: 400px;"></div>
                    </div>
                    <div class="card col-md-5">
                        <div class="card-header">
                            <h3 class="card-title ">
                                <i class="fas fa-industry mr-1"></i>
                                สถิติแจ้งซ่อมเครื่องจักร-อุปกรณ์
                            </h3>
                        </div><!-- /.card-header -->
                        <div id="machinechart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div><!-- /.card-body -->
    </div><!-- /.card -->
</section>
<!-- /.content -->

<!-- Moment -->
<script src="plugins/moment/moment.min.js"></script>

<script type="text/javascript">
$(".checkbox-menu").on("change", "input[type='checkbox']", function () {
    $(this).closest("li").toggleClass("active", this.checked);
});

$(".checkbox1-menu").on("change", "input[type='checkbox']", function () {
    $(this).closest("li").toggleClass("active", this.checked);
});

function updateMonthButtonText() {
    var selectedMonths = [];
    $("input[name='dropdownMonth[]']:checked").each(function () {
        selectedMonths.push($(this).parent().text().trim());
    });
    if (selectedMonths.length > 0) {
        var buttonText = "";
        if (selectedMonths.length === 1) {
            buttonText = selectedMonths[0];
        } else {
            buttonText = selectedMonths[0] + " - " + selectedMonths[selectedMonths.length - 1];
        }
        $("#dropdownMonth").text(buttonText);
    } else {
        $("#dropdownMonth").text("เลือกเดือน");
    }
}

function updateYearButtonText() {
    var selectedYears = [];
    $("input[name='dropdownYear[]']:checked").each(function () {
        selectedYears.push($(this).parent().text().trim());
    });
    if (selectedYears.length > 0) {
        var buttonText = "";
        if (selectedYears.length === 1) {
            buttonText = selectedYears[0];
        } else {
            buttonText = selectedYears[0] + " - " + selectedYears[selectedYears.length - 1];
        }
        $("#dropdownYear").text(buttonText);
    } else {
        $("#dropdownYear").text("เลือกปี");
    }
}

function getValue(site) {

    var site = site.value;
    $("#dept").val('0');

    $.ajax({
        url: "module/module_report/ajax_action.php",
        type: "POST",
        data: {
            "data": site,
            "action": "menu_dept"
        },
        success: function (data) {
            $("#dept").html(data);
            // console.log(data);
            //return false;
        },
        error: function (data) {
            console.log(data);
            sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
        }
    });
}

function SendData() {

    var frmData = $("form#needs-validation").serialize();
    var deptData = $("#dept").val();

    $.ajax({
        url: "module/module_report/ajax_action.php",
        type: "POST",
        data: {
            "data": frmData,
            "dept": deptData,
            "action": 'dashboard'
        },
        success: function (data) {
            $("#chart_script").html(data);
            console.log(data);
            event.stopPropagation();
        },
        error: function (data) {
            console.log(data);
            sweetAlert("ผิดพลาด!", "ไม่สามารถแสดงผลข้อมูลได้", "error");
        }
    });
}

function TitleText() {
    var siteText = $("#site option:selected").text();
    var deptText = " แผนก " + $("#dept option:selected").text();

    if ($("#dept option:selected").text() == "ทั้งหมด") {
        deptText = "";
    }
    var monthText = " ช่วงเดือน " + $("#dropdownMonth").text();
    if ($("#dropdownMonth").text() == "เลือกเดือน") {
        monthText = "";
    }
    var yearText = " " + $("#dropdownYear").text();
    if ($("#dropdownYear").text() == "เลือกปี") {
        yearText = "";
    }
    if($("#dropdownYear").text().includes("-")){
        yearText = " ," + yearText;
    }
    $(".title-text").text(siteText + deptText + monthText + yearText);
}

$(document).ready(function () {

    var selectedYear = parseInt($("input[name='dropdownYear[]']:checked").val());
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;

    // Enable or disable month checkboxes based on selected year
    $("input[name='dropdownMonth[]']").prop("disabled", false);

    if (selectedYear < currentYear) {
        $("input[name='dropdownMonth[]']").prop("disabled", false);
    } else if (selectedYear === currentYear) {
        $("input[name='dropdownMonth[]']").each(function () {
            var monthValue = parseInt($(this).val());
            $(this).prop("disabled", monthValue > currentMonth);
        });
    }

    $('.dropdown-menu').on('click', function (e) {
        e.stopPropagation();
    });

    updateMonthButtonText();
    updateYearButtonText();
    getValue(site);
    SendData();
    TitleText();

});

$(document).on("click", ".btn-export", function (event) {

    var dashboardElement = document.getElementById("dashboard-content");

    dashboardElement.classList.add("no-box-shadow");
    // สร้างองค์ประกอบแคนวาส
    var canvas = document.createElement("canvas");
    canvas.width = dashboardElement.offsetWidth;
    canvas.height = dashboardElement.offsetHeight;


    // แสดงผลลัพธ์ขององค์ประกอบ "dashboard" บนแคนวาส
    html2canvas(dashboardElement, {
        background: '#ffffff',
        scale: 2
    }).then(function (canvas) {
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

$(document).on("change", "form", function () {

    var selectedYear = parseInt($("input[name='dropdownYear[]']:checked").val());
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;
    updateMonthButtonText();
    updateYearButtonText();
    SendData();
    TitleText();

    // Enable or disable month checkboxes based on selected year
    $("input[name='dropdownMonth[]']").prop("disabled", false);

    if (selectedYear < currentYear) {
        $("input[name='dropdownMonth[]']").prop("disabled", false);
    } else if (selectedYear === currentYear) {
        $("input[name='dropdownMonth[]']").each(function () {
            var monthValue = parseInt($(this).val());
            $(this).prop("disabled", monthValue > currentMonth);
        });
    }
});
</script>