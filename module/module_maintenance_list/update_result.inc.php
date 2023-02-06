<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
        
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    } 

/*
    echo "<pre>";    print_r($_POST);    echo "</pre>";
    echo "<pre>";    print_r($_FILES);    echo "</pre>";
    die();
*/

    if ($action=='update-result') {    
    ?>

<form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
<div class="container">
    <div class="row">
    <div class="offset-md-0 col-md-12 offset-md-0">  
        <div class="card">  
            <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
            <div class="card-body p-3">
                <!--ajax data hear-->
            </div><!--card-body-->
        </div><!--card-->
    </div>                

    </div><!--row-->
</div><!--container-->
</form>
<!--FORM 1-->

<script>
    $(document).on("click", ".btn_test", function (e){ 
        e.preventDefault();
        $.ajax({
            url: "module/module_maintenance_list/update_result.inc.php",
            type: "POST",
            data:{"action":"chk_dept","ref_id_dept":999},
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data);
                //$('#slt_machine').html(data);
            },
                error: function (jXHR, textStatus, errorThrown) {
                console.log(data);
                alert(errorThrown);
            }
        });
    });
</script>
    <?PHP
        //id_maintenance_request, maintenance_request_no, mt_request_date, ref_id_user_request, ref_id_machine_site, ref_id_mt_type, status_approved, ref_id_user_approver, allotted_date, allotted_accept_date, related_to_safty, problem_statement, ref_id_job_type, urgent_type, outsource_service_status, caused_by_os, ref_id_user_approve_os, duration_serv_start, duration_serv_end, estimate_hand_over_date, hand_over_date, ref_id_user_hand_over, cause_mt_request_cancel, maintenance_request_status
        exit();
    }//update-result

    $a = 1;
    if ($action=='chk_dept') {    
        //echo json_encode('xxxx');
        echo 'xxxxxxxxxxxxxxxxxxxxxx'.$a++;
        exit();
?>
sa asd sdsfad sfad fsda sfdasfad fsda fsd fsdaasfd
<?PHP } ?>