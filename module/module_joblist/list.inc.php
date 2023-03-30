<?PHP
//$obj = new CRUD();
$sql_fetch_Accept= "SELECT tb_maintenance_request.*, tb_ref_repairer.* FROM tb_maintenance_request 
LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
WHERE tb_maintenance_request.allotted_accept_date IS NULL AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']." AND tb_ref_repairer.status_repairer=1";
$accept_numRow = $obj->countAll($sql_fetch_Accept."");

$sql_fetch_WaitStart = "SELECT tb_maintenance_request.*, tb_ref_repairer.* FROM tb_maintenance_request 
LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
WHERE tb_maintenance_request.allotted_accept_date IS NOT NULL AND tb_maintenance_request.duration_serv_start IS NULL AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']."  ";
$waitStart_numRow = $obj->countAll($sql_fetch_WaitStart."");

$sql_fetch_Working = "SELECT tb_maintenance_request.*, tb_ref_repairer.* FROM tb_maintenance_request 
LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
WHERE tb_maintenance_request.allotted_accept_date IS NOT NULL AND tb_maintenance_request.duration_serv_start IS NOT NULL AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']."  ";
$working_numRow = $obj->countAll($sql_fetch_Working."");
?>
<style type="text/css"> 
</style>

<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
</div>


<div class="card-body p-2 m-0">

    <div class="card card-gray card-tabs">
        <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs mt-2" id="custom-tabs-one-tab" role="tablist">
        <li class="nav-item"><a class="nav-link active pl-3 pr-3" id="custom-tabs1" data-toggle="pill" href="#custom-tabs-content-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-hourglass-half"></i> รอรับงานซ่อม (<?PHP echo $accept_numRow; ?>)</a></li>
            <li class="nav-item"><a class="nav-link pl-3 pr-3" id="custom-tabs2" data-toggle="pill" href="#custom-tabs-content-2" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-clock"></i> รอเริ่มซ่อม (<?PHP echo $waitStart_numRow; ?>)</a></li>
            <li class="nav-item"><a class="nav-link tab-2 pl-3 pr-3" id="custom-tabs3" data-toggle="pill" href="#custom-tabs-content-3" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-wrench"></i> กำลังซ่อม (<?PHP echo $working_numRow; ?>)</a></li>
        </ul>
        </div>

        <div class="card-body p-0 pt-3">
        <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade active show" id="custom-tabs-content-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <?php include_once 'module/module_joblist/wait_accept.inc.php'; //รอรับงานซ่อม ?>
            </div>

            <div class="tab-pane fade table-responsive-xl" id="custom-tabs-content-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                ...TAB-2 Wait process
                <?php //include_once 'module/module_joblist/working.inc.php'; //รอเริ่มซ่อม ?>
            </div>

            <div class="tab-pane fade" id="custom-tabs-content-3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                ...TAB-3  Wait process <!--กำลังซ่อม--->
            </div>

            <div class="tab-pane fade" id="custom-tabs-content-4" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                ...TAB-4  Wait process
            </div>

            <div class="tab-pane fade" id="custom-tabs-content-5" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                ...TAB-5  Wait process
            </div>
        </div>
    </div><!-- /.card -->

</div><!-- /.card-body -->

</div><!-- /.card -->

</section>
<!-- /.content -->

<script>
$(document).on("click", "#custom-tabs2", function (){    
    $('#custom-tabs-content-2').html();
    $('#custom-tabs-content-3').html();
    $('#custom-tabs-content-4').html();
}); 


$(document).on("click", "#custom-tabs2", function (){    
    $.ajax({
        url: "module/module_joblist/wait_start.inc.php",
        type: "POST",
        data:{"action":"getdata"},
        beforeSend: function () {
        },
        success: function (data) {
            $('#custom-tabs-content-1').html();
            $('#custom-tabs-content-3').html();
            $('#custom-tabs-content-4').html();
            $('#custom-tabs-content-5').html();
            //console.log(data);
            $('#custom-tabs-content-2').html(data);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });  
});

$(document).on("click", "#custom-tabs3", function (event){    
    $.ajax({
        url: "module/module_joblist/working.inc.php",
        type: "POST",
        data:{"action":"getdata"},
        beforeSend: function () {
        },
        success: function (data) {
            $('#custom-tabs-content-1').html();
            $('#custom-tabs-content-2').html();
            $('#custom-tabs-content-4').html();
            $('#custom-tabs-content-5').html();
            //console.log(data);
            $('#custom-tabs-content-3').html(data);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });  
});


$(document).on("click", "#custom-tabs4", function (){    
    $.ajax({
        url: "module/module_maintenance_req/sub_module_repair_code/list.inc.php",
        type: "POST",
        data:{"action":"getdata"},
        beforeSend: function () {
        },
        success: function (data) {
            $('#custom-tabs-content-1').html();
            $('#custom-tabs-content-2').html();
            $('#custom-tabs-content-3').html();
            $('#custom-tabs-content-5').html();
            console.log(data);
            $('#custom-tabs-content-4').html(data);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            alert(errorThrown);
        }
    });  
});


$(document).on("click", "#custom-tabs5", function (){    
    $.ajax({
        url: "module/module_maintenance_req/sub_module_reject_mtr/list.inc.php",
        type: "POST",
        data:{"action":"getdata"},
        beforeSend: function () {
        },
        success: function (data) {
            $('#custom-tabs-content-1').html();
            $('#custom-tabs-content-2').html();
            $('#custom-tabs-content-3').html();
            $('#custom-tabs-content-4').html();
            console.log(data);
            $('#custom-tabs-content-5').html(data);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            alert(errorThrown);
        }
    });  
});
</script>