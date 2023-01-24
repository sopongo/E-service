<?PHP
//$obj = new CRUD();
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
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs11" data-toggle="pill" href="#custom-tabs-content-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-clipboard-list"></i> ประเภทใบแจ้งซ่อม</a>
            </li>
            <li class="nav-item">
            <a class="nav-link tab-2" id="custom-tabs2" data-toggle="pill" href="#custom-tabs-content-2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-wrench"></i> รหัสอาการเสีย</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs3" data-toggle="pill" href="#custom-tabs-content-3" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><i class="fas fa-cog"></i> รหัสสาเหตุการเสีย</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs4" data-toggle="pill" href="#custom-tabs-content-4" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false"><i class="fas fa-tools"></i> รหัสการซ่อม,วิธีซ่อม</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs5" data-toggle="pill" href="#custom-tabs-content-5" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false"><i class="fas fa-exclamation-triangle"></i> สาเหตุการปฏิเสธงานซ่อม</a>
            </li>            
        </ul>
        </div>

        <div class="card-body p-0 pt-3">
        <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade active show" id="custom-tabs-content-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <?php include_once 'module/module_maintenance_req/sub_module_mt_type/list.inc.php'; //หน้ารายการประเภทใบแจ้งซ่อม                ?>
            </div>

            <div class="tab-pane fade table-responsive-xl" id="custom-tabs-content-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                ...TAB-2 Wait process
                <?php //include_once 'module/module_maintenance_req/sub_module_failure_code/list.inc.php'; //หน้ารายการประเภทใบแจ้งซ่อม ?>
            </div>

            <div class="tab-pane fade" id="custom-tabs-content-3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                ...TAB-3  Wait process
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
        url: "module/module_maintenance_req/sub_module_failure_code/list.inc.php",
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
        url: "module/module_maintenance_req/sub_module_caused_code/list.inc.php",
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

$(document).on('click','#addData-tab3',function(event){
    $('#id_row-tab3').val();
    $('#exampleModalLabel-tab3 span').html("เพิ่มสาเหตุการเสีย");
    $.ajax({
    type: 'POST',
      url: "module/module_maintenance_req/sub_module_caused_code/ajax_action.php",
      dataType: "json",
      data:{action:"ref_id_dept"},
      success: function (data) {
        //console.log(data);
        $('#ref_id_dept-tab3').html(data);
      },
      error: function (data) {
        //console.log(data);        
        swal("ผิดพลาด!", "ไม่พบข้อมูลที่ระบุ.", "error");
      }
    });
    event.preventDefault();
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