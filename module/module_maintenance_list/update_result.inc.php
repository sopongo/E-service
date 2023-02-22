<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
        
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    $ref_id = intval($_POST['ref_id']);

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
</form><!--FORM 1-->

<script>
    $(document).on("click", ".btn_test", function (e){ 
    //$('.btn_test').on('click',function(e){
        //e.preventDefault();
        e.stopImmediatePropagation(); //ป้องกันการส่ง success ซ้ำ
        $.ajax({
            url: "module/module_maintenance_list/frm_cancel.inc.php",
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
<?PHP 
    } 
    if ($action=='update_problem_statement') {
        $Row = $obj->customSelect("SELECT * FROM tb_maintenance_request WHERE id_maintenance_request=".$ref_id."");
?>
    <form id="needs-validation_2" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-4">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="problem_statement"><span class="text-red font-size-sm"></span> ผู้อัพเดท:</label> <?PHP echo $_SESSION['sess_fullname']; ?>
                            </div>
                        </div>
                    </div><!--row-4-->
                    <div class="row row-5">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="problem_statement">อาการเสีย/ปัญหาที่พบ:<span class="text-red font-size-sm">**</span></label>  
                                <textarea class="form-control" rows="5" id="problem_statement" name="problem_statement" placeholder="Enter ..." required><?PHP echo $Row['problem_statement'];?></textarea>
                                <input type="hidden" name="action" id="action" value="xxxxxxxxxxxxxx" />
                                <input type="hidden" name="ref_id" id="ref_id" value="<?PHP echo $ref_id; ?>" />
                                <div class="invalid-feedback">กรอกสาเหตุการยกเลิก</div>
                            </div>
                        </div>
                    </div><!--row-5-->
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->
<?PHP
    }    
    if($action=='approved'){
?>

    <form id="needs-validation_3" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-4">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">
                                <label for="problem_statement"><span class="text-red font-size-sm"></span> ผู้อนุมัติ:</label> <?PHP echo $_SESSION['sess_fullname']; ?>
                            </div>
                        </div>
                    </div><!--row-4-->
                    <div class="row row-5">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">


<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">                            
            <label>ผู้รับผิดชอบงานซ่อม<?PHP echo $_POST['id_dept_responsibility'];?>:</label>
            <select class="select2_mechanic" name="slt_select2_mechanic" id="slt_select2_mechanic" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            <?PHP
                $rowMechanic = $obj->fetchRows("SELECT id_user, fullname FROM tb_user WHERE ref_id_dept=".$_POST['id_dept_responsibility']." AND (class_user=2 OR class_user=3 OR class_user=4) ORDER BY fullname ASC");
                if (count($rowMechanic)!=0) {
                    foreach($rowMechanic as $key => $value) {
                        echo '<option value="'.$rowMechanic[$key]['id_user'].'">'.$rowMechanic[$key]['fullname'].'</option>';
                    }
                }
            ?>
            </select>
            <span class="text-red pt-2 d-block">** พิมพ์ชื่อผู้รับผิดชอบและเลือกอย่างน้อย 1 คน</span>
          <!-- /.form-group -->

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2_mechanic').select2({
        theme: 'bootstrap4'
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
});    
</script>
                            </div>
                        </div>
                    </div><!--row-5-->
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->
<?PHP
        exit();
    }
    if($action=='cancel'){
?>
    <form id="needs-validation_2" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-4">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="problem_statement"><span class="text-red font-size-sm"></span> ผู้ยกเลิก:</label> <?PHP echo $_SESSION['sess_fullname']; ?>
                            </div>
                        </div>
                    </div><!--row-4-->
                    <div class="row row-5">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="problem_statement">สาเหตุการยกเลิก:<span class="text-red font-size-sm">**</span></label>  
                                <textarea class="form-control" rows="5" id="cancel_statement" name="cancel_statement" placeholder="Enter ..." required></textarea>
                                <input type="hidden" name="action" id="action" value="cancel-req" />
                                <input type="hidden" name="ref_id" id="ref_id" value="<?PHP echo $ref_id; ?>" />
                                <div class="invalid-feedback">กรอกสาเหตุการยกเลิก</div>
                            </div>
                        </div>
                    </div><!--row-5-->
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->
<?PHP
        //echo 'ยกเลิกใบแจ้งซ่อม'; exit();
    }
?>
<?PHP 
    if($action=='add_mechanic'){
        /*
        echo count($_POST['slt_select2_mechanic']);
        print_r($_POST['slt_select2_mechanic']);
        echo "\r\n";
        echo $ref_id; exit();
        */
        for($i=0;$i<count($_POST['slt_select2_mechanic']);$i++){
            $insertRow = [
                'ref_id_maintenance_request' => $ref_id,
                'ref_id_user_repairer' => (!empty($_POST['slt_select2_mechanic'][$i])) ? $_POST['slt_select2_mechanic'][$i] : NULL,
            ];
            $rowID = $obj->addRow($insertRow, "tb_ref_repairer");
        }
        //echo json_encode($rowID);
        $updateRow = [
            'status_approved' => 1,
            'ref_id_user_approver' =>  ($_SESSION['sess_id_user']),
            'allotted_date' => (date('Y-m-d H:i:s')),
        ];
        $resultUpdate = $obj->update($updateRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        echo json_encode($resultUpdate);
        exit();        
    }
?>
<?PHP 
    if($action=='update_mt_type'){     
        //echo $ref_id; exit();
        $insertRow = [
            'ref_id_mt_type' => (!empty($_POST['slt_maintenance_type'])) ? $_POST['slt_maintenance_type'] : ''
        ];
        $resultUpdate = $obj->update($insertRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        echo json_encode($resultUpdate);
        exit();        
?>

<?PHP
    }
?>
<?PHP 
    if($action=='update_type'){
        $ref_mt_type = $_POST['ref_mt_type'];
        $ref_id_dept = $_POST['ref_id_dept'];
?>
    <form id="needs-validation_2" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">เลือกประเภทใบแจ้งซ่อม</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-5">
                        <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>ประเภทใบแจ้งซ่อม แผนก<?PHP echo $_SESSION['sess_dept_name'];?> (<?PHP echo $_SESSION['sess_dept_initialname'];?>):</label>
                            <select class="custom-select" name="slt_maintenance_type" id="slt_maintenance_type">
                                <option value="" >เลือกประเภทใบแจ้งซ่อม</option>
                                <?PHP
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_maintenance_type WHERE ref_id_dept=".$ref_id_dept." AND status_mt_type=1 ");
                                    if (count($rowData)!=0) {
                                        foreach($rowData as $key => $value) {
                                            echo '<option '.($rowData[$key]['id_mt_type']==$ref_mt_type ? 'selected' : '').' value="'.($rowData[$key]['id_mt_type']).'">'.$rowData[$key]['name_mt_type'].'</option>';
                                        }
                                    } 
                                ?>
                            </select>
                        </div>
                        </div>
                    </div><!--row-5-->
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->
<?PHP
        //echo 'ยกเลิกใบแจ้งซ่อม'; exit();
    }
?>