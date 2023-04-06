<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/setting.inc.php');
        
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
    }        
?>
<?PHP        
if ($action=='repair_results') {    
        $editData = $obj->customSelect("SELECT tb_repair_result.*, tb_failure_code.failure_code_th_name, tb_repair_code.repair_code_name
        FROM tb_repair_result
        LEFT JOIN tb_failure_code ON (tb_failure_code.id_failure_code=tb_repair_result.ref_id_failure_code)   
        LEFT JOIN tb_repair_code ON (tb_repair_code.id_repair_code=tb_repair_result.ref_id_repair_code)   
        WHERE tb_repair_result.ref_id_maintenance_request=".$ref_id." ");
?>
    <form id="needs-validation8" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
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

                    <div class="row row-5 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12"> 
                            <div class="form-group">
                                <label for="slt_failure_code"><i class="fas fa-angle-double-right"></i>  รหัสอาการเสีย:<span class="text-red font-size-sm">**</span></label>   <?PHP //echo $ref_id;?> / <?PHP //echo $_POST['id_dept_responsibility'];?>
                                <?PHP 
                                            if(isset($editData['ref_id_failure_code'])){/*เช็คการแสดงผล รหัสอาการเสีย*/
                                                //if(preg_match('([a-zA-Zก-ฮ].*[0-9]|[0-9].*[a-zA-Zก-ฮ</[^>*\][\]+>|/])', $editData['ref_id_failure_code'])){ //ถ้ามีตัวอักษรปน แสดงว่าพิมพ์เอง
                                                if(!is_numeric($editData['ref_id_failure_code'])){ //ถ้ามีตัวอักษรปน แสดงว่าพิมพ์เอง
                                                    $chk_show_failure_code = 'd-line'; $chk_slt_failure_code = 'd-none'; $chk_txt_failure_code = 'd-block';
                                                    //echo "ปปปปปปปปปปปปปปปปปปปปปน";
                                                }else{
                                                    $chk_show_failure_code = 'd-none'; $chk_slt_failure_code = 'd-block'; $chk_txt_failure_code = 'd-none';
                                                    //echo "ไม่ปนccccccccccccccccccccc";
                                                }
                                            }else{
                                                    $chk_show_failure_code = 'd-none'; $chk_slt_failure_code = 'd-block'; $chk_txt_failure_code = 'd-none';
                                            }                                      
                                 ?>
                                <a class="chk_failure_code <?PHP echo $chk_show_failure_code; ?> text-red text-size-2"><i class="fas fa-undo"></i> กลับไปใช้ตัวเลือก</a>
            <select class="custom-select <?PHP echo $chk_slt_failure_code; ?>" name="slt_failure_code" id="slt_failure_code" style="width: 100%;" >
            <?PHP  
                $rowMechanic = $obj->fetchRows("SELECT * FROM tb_failure_code WHERE ref_id_dept=".$_POST['id_dept_responsibility']." AND failure_code_status=1 ORDER BY failure_code ASC");
                echo '<option value="">เลือกรหัสอาการเสีย</option>';
                echo '<option value="custom">0000 - พิมพ์ระบุเอง</option>';
                if (count($rowMechanic)!=0) {
                    foreach($rowMechanic as $key => $value) {
                        echo '<option value="'.$rowMechanic[$key]['id_failure_code'].'" '.($rowMechanic[$key]['id_failure_code']==$editData['ref_id_failure_code'] ? 'selected' : '').'>'.$rowMechanic[$key]['failure_code'].' - '.$rowMechanic[$key]['failure_code_th_name'].'</option>';
                    }
                }
            ?>
            </select><div class="invalid-feedback">ระบุรหัสอาการเสีย</div>
            <div><textarea class="form-control <?PHP echo $chk_txt_failure_code; ?>" rows="2" id="txt_failure_code" name="txt_failure_code" placeholder="" ><?PHP echo isset($editData['ref_id_failure_code']) ? $editData['ref_id_failure_code'] : '';?></textarea></div>
                            </div>
                        </div>
                    </div><!--row-5 required-->

                    <div class="row row-5 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="txt_caused_by"><i class="fas fa-angle-double-right"></i>  สาเหตุของปัญหา:<span class="text-red font-size-sm">**</span></label>  
                                <textarea class="form-control" rows="2" id="txt_caused_by" name="txt_caused_by" placeholder=""  ><?PHP echo isset($editData['txt_caused_by']) ? $editData['txt_caused_by'] : '';?></textarea>
                                <div class="invalid-feedback">ระบุสาเหตุของปัญหา</div>
                            </div>
                        </div>
                    </div><!--row-5-->
                    
                    <div class="row row-5 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <?PHP
/*$myString="4444ก44444";
if(preg_match('([a-zA-Zก-ฮ].*[0-9]|[0-9].*[a-zA-Zก-ฮ])', $myString)){ //ถ้าปน
    echo('Has numbers and letters.');
} else {
    echo("no");
}*/
                                            if(isset($editData['ref_id_repair_code'])){/*เช็คการแสดงผล รหัสซ่อม*/
                                                //if(preg_match('([a-zA-Zก-ฮ].*[0-9]|[0-9].*[a-zA-Zก-ฮ</[^>*\][\]+>|/])', $editData['ref_id_repair_code'])){ //ถ้ามีตัวอักษรปน แสดงว่าพิมพ์เอง
                                                if(!is_numeric($editData['ref_id_repair_code'])){ //ถ้ามีตัวอักษรปน แสดงว่าพิมพ์เอง                                                    
                                                    $chk_show_repair_code = 'd-inline'; $chk_slt_repair_code = 'd-none'; $chk_txt_repair_code = 'd-block';
                                                    //echo "ปนcccccccccccccccccc";
                                                }else{
                                                    $chk_show_repair_code = 'd-none'; $chk_slt_repair_code = 'd-block'; $chk_txt_repair_code = 'd-none';
                                                    //echo "ไม่ปนccccccccccccccccccccc";
                                                }
                                            }else{
                                                    $chk_show_repair_code = 'd-none'; $chk_slt_repair_code = 'd-block'; $chk_txt_repair_code = 'd-none';
                                            } 
                                ?>
                                <label for="slt_repair_code"><i class="fas fa-angle-double-right"></i>  รหัสซ่อม:<span class="text-red font-size-sm">**</span></label>  <a class="chk_repair_code <?PHP echo $chk_show_repair_code; ?> text-red text-size-2"><i class="fas fa-undo"></i> กลับไปใช้ตัวเลือก</a>
                                <select class="custom-select <?PHP echo $chk_slt_repair_code;?>" name="slt_repair_code" id="slt_repair_code" style="width: 100%;" >
                                <?PHP  
                                    $rowMechanic = $obj->fetchRows("SELECT * FROM tb_repair_code WHERE ref_id_dept=".$_POST['id_dept_responsibility']." AND repair_code_status=1 ORDER BY repair_code ASC");
                                    echo '<option value="">เลือกรหัสซ่อม</option>';
                                    echo '<option value="custom">0000 - พิมพ์ระบุเอง</option>';
                                    if (count($rowMechanic)!=0) {
                                        foreach($rowMechanic as $key => $value) {
                                        echo '<option value="'.$rowMechanic[$key]['id_repair_code'].'" '.($rowMechanic[$key]['id_repair_code']==$editData['ref_id_repair_code'] ? 'selected' : '').'>'.$rowMechanic[$key]['repair_code'].' - '.$rowMechanic[$key]['repair_code_name'].'</option>';
                                    }
                                    }
                                ?>
                                </select>
                                <textarea class="form-control <?PHP echo $chk_txt_repair_code;?>" rows="2" id="txt_repair_code" name="txt_repair_code" placeholder="" ><?PHP echo isset($editData['ref_id_repair_code']) ? $editData['ref_id_repair_code'] : '';?></textarea>
                                <div class="invalid-feedback">ระบุรหัสซ่อม</div>
                            </div>
                        </div>
                    </div><!--row-5-->
                    
                    <div class="row row-5 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">  
                                <label for="txt_solution"><i class="fas fa-angle-double-right"></i> วิธีการแก้ไข/ป้องกันเกิดปัญหาซ้ำ:<span class="text-red font-size-sm">**</span></label>  
                                <textarea class="form-control" rows="2" id="txt_solution" name="txt_solution" placeholder="Enter ..." required><?PHP echo isset($editData['txt_solution']) ? $editData['txt_solution'] : '';?></textarea>
                                <div class="invalid-feedback">ระบุวิธีการแก้ไข/ป้องกันเกิดปัญหาซ้ำ</div>
                            </div>
                        </div>
                    </div><!--row-5-->                    


                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->

<script>

</script>
<?PHP 
    exit();
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
                                <input type="hidden" name="action" id="action" value="" />
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
            <label>ผู้รับผิดชอบงานซ่อม:</label>
            <select class="select2_mechanic" name="slt_select2_mechanic" id="slt_select2_mechanic" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            <?PHP
                ##เช็คว่ามีช่างซ่อม $ref_id นี้หรือยัง
                //$chk_repairer = $obj->customSelect("SELECT * FROM tb_ref_repairer WHERE ref_id_maintenance_request=".$ref_id."");
                $rowMechanic = $obj->fetchRows("SELECT id_user, fullname FROM tb_user WHERE ref_id_dept=".$_POST['id_dept_responsibility']." AND (class_user=2 OR class_user=3) ORDER BY fullname ASC");
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
        //tags: ["red", "green", "blue"],
        /*data:[
        {id:0,text:"enhancement"},
        {id:1,text:"bug"},
        {id:2,text:"duplicate"},
        {id:3,text:"invalid"},
        {id:4,text:"wontfix"},
        {id:5,text:"thawatchai srichandaeng"},
        ],*/
        theme: 'bootstrap4'
    });

    //$('.select2_mechanic').val(['120','เอกนรินทร์ ทิชาชาติ']).trigger('change');
    //$('.select2_mechanic').val(['green','blue']).trigger('change');

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
});    
/*select2-selection__rendered select2-selection select2-selection--multiple*/
//$('.select2').append('sdfsdfsfd')
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
    if($action=='change-approved'){
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
                                <label for="problem_statement"><span class="text-red font-size-sm"></span> ผู้แก้ไข:</label> <?PHP echo $_SESSION['sess_fullname']; ?>
                            </div>
                        </div>
                    </div><!--row-4-->
                    <div class="row row-5">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group">

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">                            
            <label>ผู้รับผิดชอบงานซ่อม<?PHP echo $ref_id;?> / <?PHP echo $_POST['id_dept_responsibility'];?>:</label>
            <select class="select2_mechanic" name="slt_select2_mechanic" id="slt_select2_mechanic" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            <?PHP
                ##เช็คว่ามีช่างซ่อม $ref_id นี้หรือยัง
                $rowMechanic = $obj->fetchRows("SELECT tb_ref_repairer.*, tb_user.id_user, tb_user.fullname FROM tb_ref_repairer 
                LEFT JOIN tb_user ON (tb_user.id_user=tb_ref_repairer.ref_id_user_repairer) WHERE tb_ref_repairer.ref_id_maintenance_request=".$ref_id." AND status_repairer=1");               
                if (count($rowMechanic)!=0){
                    $Mechanic = "";
                    $id_user = array();
                    $key = 0;
                    foreach($rowMechanic as $key => $value) {
                        $Mechanic.='"'.$rowMechanic[$key]['fullname'].'", ';
                        $id_user[$key] = $rowMechanic[$key]['id_user'];
                    }
                }
                ##คิวรี่ยูเซอร์ ช่าง,หัวหน้าช่างมาแสดง
                $rowMechanic = $obj->fetchRows("SELECT id_user, fullname FROM tb_user WHERE ref_id_dept=".$_POST['id_dept_responsibility']." AND (class_user=2 OR class_user=3) ORDER BY fullname ASC");
                if (count($rowMechanic)!=0) {
                    foreach($rowMechanic as $key => $value) {
                        if($rowMechanic[$key]['id_user'])
                        //$xxxxxx = array_search($rowMechanic[$key]['id_user'],$id_user);
                        echo '<option '.(array_search($rowMechanic[$key]['id_user'],$id_user)==true ? 'selected' : '').' value="'.$rowMechanic[$key]['id_user'].'">'.$rowMechanic[$key]['fullname'].'</optionvalue=>';
                    }
                }
            ?>
            </select>
            <span class="text-red pt-2 d-block">** พิมพ์ชื่อผู้รับผิดชอบและเลือกอย่างน้อย 1 คน</span>
            <?PHP //print_r($id_user); echo count($id_user);?>
          <!-- /.form-group -->

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2_mechanic').select2({
       //tags: [<?PHP echo $Mechanic;?>],
        theme: 'bootstrap4'
    });

    $('.select2_mechanic').val([<?PHP foreach ($id_user as $value) { echo $value.', ';} ?>]).trigger('change');

    //Initialize Select2 Elements
    $('.select2bs4').select2({      theme: 'bootstrap4'    });
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
    }
?>
<?PHP
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
                //id_ref_repairer, ref_id_maintenance_request, ref_id_user_repairer, acknowledge_date, status_repairer
                'ref_id_maintenance_request' => $ref_id,
                'ref_id_user_repairer' => (!empty($_POST['slt_select2_mechanic'][$i])) ? $_POST['slt_select2_mechanic'][$i] : NULL,
                'acknowledge_date' => NULL,
                'status_repairer' => 1,
            ];
            if($obj->countAll("SELECT ref_id_user_repairer FROM tb_ref_repairer WHERE ref_id_maintenance_request=".$ref_id." AND ref_id_user_repairer=".$_POST['slt_select2_mechanic'][$i]." ")==0){
                $rowID = $obj->addRow($insertRow, "tb_ref_repairer");
            }
        }
        //echo json_encode($rowID);
        $updateRow = [
            'status_approved' => 1,
            'ref_id_user_approver' =>  ($_SESSION['sess_id_user']),
            'allotted_date' => (date('Y-m-d H:i:s')),
        ];
        $resultUpdate = $obj->update($updateRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 4, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########
        echo json_encode($resultUpdate);
        exit();        
    }

    if($action=='reject_request'){         
?>
    <form id="needs-validation_12" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-5">
                        <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group"><label>ผู้ปฏิเสธงานซ่อม: <?PHP echo $_SESSION['sess_fullname'];?> (<?PHP echo $_SESSION['sess_dept_initialname'];?>)</label></div>
                        </div>
                        <div class="col-sm-12"><label class="text-red">สาเหตุปฏิเสธงานซ่อม:</label>
                        <textarea class="form-control" rows="5" id="reject_caused" name="reject_caused" placeholder="Enter ..." required></textarea>
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
    if($action=='update_mt_type'){     
        //echo $ref_id; exit();
        $insertRow = [
            'ref_id_mt_type' => (!empty($_POST['slt_maintenance_type'])) ? $_POST['slt_maintenance_type'] : ''
        ];
        $resultUpdate = $obj->update($insertRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 18, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########
        echo json_encode($resultUpdate);
        exit();        
    }

if ($action=='satisfaction_survey') {
    //tb_satisfaction_survey        id_survey, ref_id_maintenance_request, ref_topic_survey, score_result, recomment
    $rowSurvey = $obj->fetchRows("SELECT * FROM tb_satisfaction_survey WHERE ref_id_maintenance_request=".$ref_id." ORDER BY ref_topic_survey ASC");
    if (count($rowSurvey)!=0) {
        foreach($rowSurvey as $key => $value) {                
            ///echo $rowSurvey[$key]['ref_topic_survey'].'--------'.$rowSurvey[$key]['score_result']."<br />";
        }
      }    
?>
    <form id="needs-validation_12" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-5">
                        <!-- select -->
                            <label>หัวข้อประเมิณ:</label>
                            <?PHP
                            $num = 1;
                            foreach($arrTopicSurvey as $index => $value){
                                echo '<div class="col-sm-12 border-bottom pt-2 pb-0 sur_hover">'.($num).'.'.$value.'<div class="w-100 ml-2 d-block">
                                <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group clearfix mt-2">
                                <div class="icheck-success d-inline mr-4"><input type="radio" name="score_'.$index.'" id="score_'.$index.'" value="1" '.(isset($rowSurvey[$index]['score_result']) && $rowSurvey[$index]['score_result']==1 ? 'checked=""' : '').'><label for="score_'.$index.'" class="text-success">ผ่าน</label></div>
                                <div class="icheck-danger d-inline"><input type="radio" name="score_'.$index.'" id="score_not_'.$index.'" value="0" '.(isset($rowSurvey[$index]['score_result']) && $rowSurvey[$index]['score_result']==0 ? 'checked=""' : '').'><label for="score_not_'.$index.'" class="text-danger">ไม่ผ่าน</label></div>
                                </div>
                              </div>
                              </div></div> ';
                              $num++;
                            }
                            ?>
                        </div>
                    </div><!--row-5-->
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>ข้อเสนอแนะ:</label>
                        <textarea class="form-control" rows="3" name="recomment" id="recomment" placeholder="Enter ..."><?PHP echo $_POST['recomment'];?></textarea>
                      </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    <input type="hidden" id="action" name="action" value="send_survey" />
    <input type="hidden" id="ref_id" name="ref_id" value="<?PHP echo $ref_id; ?>" />
    </form><!--FORM 1-->
<?PHP
    exit();
}                
?>
<?PHP 
    if($action=='img_after_repair'){
?>
    <form id="needs-validation_11" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
    <div class="container">
        <div class="row">
        <div class="offset-md-0 col-md-12 offset-md-0">  
            <div class="card">  
                <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p> <span class="float-right editby"></span></div>
                <div class="card-body p-3">
                    <!--ajax data hear-->
                    <div class="row row-5">
                        <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>เลือกรูปถ่าย:</label>
			<div class="row-fluid">
				<div class="col-md-12">
					<input name="files[]" type="file" multiple="multiple" data-maxsize="6000" maxlength="6" id="our-test" accept="gif|jpg|png|jpeg" class="border  p-0 multi with-preview w-100" />
                    <span class="text-red font-size-sm mt-2 d-block w-100">** ไม่เกิน 6 รูป / ไฟล์ไซต์ไม่เกิน 6 เมกะไบต์ต่อรูป</span> 
				</div>
			</div>
                        </div>
                        </div>
                    </div><!--row-5-->
                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    <input type="hidden" id="action" name="action" value="update_img_after" />
    <input type="hidden" id="ref_id" name="ref_id" value="<?PHP echo $ref_id; ?>" />
    </form><!--FORM 1-->
    <script>
        $('#our-test').MultiFile({
            max: 6,
            onFileChange: function(){
                console.log('TEST CHANGE:', this, arguments);
            }
        });
    </script>
<?PHP 
    }
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
        //echo 'ยกเลิกใบแจ้งซ่อม';
        exit();
    }
    if($action=='change-parts'){
        $parts_id = 0;
        !empty($_POST['parts_id']) ? $parts_id = intval($_POST['parts_id']): '';
        //echo '------------------------'.$parts_id; //exit();
        //id_parts, ref_id_maintenance_request, parts_serialno, parts_name, parts_description, parts_price, parts_qty, date_parts_change, ref_id_user_change, date_adddata
        #tb_change_parts
        if($parts_id!=0 && $parts_id!=NULL){
            $rowData = $obj->customSelect("SELECT * FROM tb_change_parts WHERE tb_change_parts.id_parts=".$parts_id." ");
            //echo $rowData['parts_name'];
        }
?>
        <script src="plugins/autoNumeric/autoNumeric.js"></script>
        <!--FORM 1-->
        <form id="needs-validation10" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <input type="hidden" name="id_parts" id="id_parts" value="<?PHP echo isset($rowData['id_parts']) ? $rowData['id_parts'] : ''; ?>" />
        <div class="container">
            <div class="row">

            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                    <div class="row row-7">
                        <div class="col-sm-4 col-md-4 col-xs-4"> 
                            <div class="form-group">
                                <label for="date_parts_change">วันที่เปลี่ยนอะไหล่:<span class="text-red font-size-sm">**</span></label>  
                                <div class="input-group date" id="div_date_parts_change" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input input-md mr-0" id="date_parts_change" name="date_parts_change" value="" data-target="#date_parts_change" />
                                  <div class="input-group-append" data-target="#date_parts_change" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <div class="invalid-feedback">เลือกวันที่เปลี่ยน</div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div><!--row-7 required-->                    

                        <div class="row row-1">
                        <div class="col-sm-4 col-md-4 col-xs-4">  
                            <div class="form-group mb-2">
                                <label>ซีเรียลนัมเบอร์อะไหล่(ถ้ามี): </label> 
                                <input type="text" id="parts_serialno" name="parts_serialno" maxlength="30" placeholder="Serial number.(ถ้ามี)" class="form-control" aria-describedby="inputGroupPrepend" value="<?PHP echo isset($rowData['parts_serialno']) ? $rowData['parts_serialno'] : ''; ?>" />
                            </div>
                        </div>  
                        <div class="col-sm-8 col-md-8 col-xs-8">  
                            <div class="form-group mb-2">
                                <label>ชื่ออะไหล่:<span class="text-red font-size-sm">**</span> </label> 
                                <input type="text" id="parts_name" name="parts_name" maxlength="80" placeholder="ชื่ออะไหล่" class="form-control" aria-describedby="inputGroupPrepend" value="<?PHP echo isset($rowData['parts_name']) ? $rowData['parts_name'] : ''; ?>" required /><div class="invalid-feedback">กรอกชื่ออะไหล่</div>                                
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-4">
                            <div class="col-sm-12 col-md-12 col-xs-12">  
                                <div class="form-group">  
                                    <label for="parts_description">รายละเอียดอะไหล่</label>  
                                    <textarea class="form-control w-100" id="parts_description" name="parts_description" rows="3" placeholder="รายละเอียดอะไหล่ ..."><?PHP echo isset($rowData['parts_description']) ? $rowData['parts_description'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="parts_price">ราคาต่อชิ้น/บาท</label>  
                                    <input type="text" id="parts_price" name="parts_price" placeholder="ราคาต่อชิ้น/บาท" class="form-control numeric" value="<?PHP echo isset($rowData['parts_price']) ? number_format($rowData['parts_price'],2) : ''; ?>" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="parts_qty">จำนวนที่เปลี่ยน/ชิ้น</label>  
                                    <input type="text" id="parts_qty" name="parts_qty" placeholder="จำนวนที่เปลี่ยน/ชิ้น" class="form-control numeric_nocom" value="<?PHP echo isset($rowData['parts_qty']) ? number_format($rowData['parts_qty'], 0) : ''; ?>" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>                            
                        </div><!--row-4-->

                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
        </form>
        <!--FORM 1-->
<script>
$(function($) {
    $('.numeric').autoNumeric('init');
    $('.numeric_nocom').autoNumeric('init', {aSep:',', aDec:false, aPad: false}); 
});
$('#date_parts_change').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY/MM/DD',
        maxDate: new Date(),
    });
</script>        
<?PHP
    }
    if($action=='update_outsite'){
        $rowData = $obj->customSelect("SELECT tb_supplier.*, tb_outsite_repair.*, tb_user.fullname
        FROM tb_outsite_repair 
		LEFT JOIN tb_supplier ON (tb_supplier.id_supplier=tb_outsite_repair.ref_id_supplier)
		LEFT JOIN tb_user ON (tb_user.id_user=tb_outsite_repair.ref_id_user_update)
        WHERE tb_outsite_repair.ref_id_maintenance_request=".$ref_id." ");
?>
    <form id="needs-validation9" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
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
                                <label for="problem_statement"><span class="text-red font-size-sm"></span> ผู้อัพเดท:</label> <?PHP echo !isset($rowData['fullname']) ? $_SESSION['sess_fullname'] : $rowData['fullname'];?>
                            </div>
                        </div>
                    </div><!--row-4-->

                    <div class="row row-5 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12"> 
                            <div class="form-group">
                                <label for="caused_outsite_repair"><i class="fas fa-angle-double-right"></i>  สาเหตุที่ส่งซ่อม:<span class="text-red font-size-sm">**</span></label>   
                                    <div><textarea class="form-control" rows="2" id="caused_outsite_repair" name="caused_outsite_repair" placeholder="" ><?PHP echo !isset($rowData['caused_outsite_repair']) ? '' : $rowData['caused_outsite_repair'];?></textarea></div>
                            </div>
                        </div>
                    </div><!--row-5 required-->

                    <div class="row row-6 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12"> 
                            <div class="form-group">
                                <?PHP
                                    if(isset($rowData['ref_id_supplier'])){/*เช็คการแสดงผล ซัพพลายเออร์*/
                                        if(is_numeric($rowData['ref_id_supplier'])){
                                            $chk_show_id_supplier = 'd-none'; $chk_slt_id_supplier = 'd-block'; $chk_txt_id_supplier = 'd-none'; $custom_seleted ='';
                                            //echo "ไม่ปนccccccccccccccccccccc";
                                        }else{//ถ้ามีตัวอักษรปน แสดงว่าพิมพ์เอง
                                            $chk_show_id_supplier = 'd-inline'; $chk_slt_id_supplier = 'd-none'; $chk_txt_id_supplier = 'd-block'; $custom_seleted = "selected";
                                            //echo "ปนcccccccccccccccccc";
                                        }
                                    }else{
                                            $chk_show_id_supplier = 'd-none'; $chk_slt_id_supplier = 'd-block'; $chk_txt_id_supplier = 'd-none'; $custom_seleted ='';
                                    }
                                ?>
                                <label for="slt_ref_id_supplier_2"><i class="fas fa-angle-double-right"></i>  ซัพพลายเออร์:<span class="text-red font-size-sm">**</span></label>  <a class="chk_id_supplier <?PHP echo $chk_show_id_supplier; ?> text-red text-size-2"><i class="fas fa-undo"></i> กลับไปใช้ตัวเลือก</a>
                                <select class="custom-select <?PHP echo $chk_slt_id_supplier;?>" name="slt_ref_id_supplier_2" id="slt_ref_id_supplier_2" style="width: 100%;" >
                                <?PHP  
                                    echo '<option value="">เลือกซัพพลายเออร์</option>';
                                    echo '<option value="custom" '.$custom_seleted.'>???? - พิมพ์ระบุเอง</option>';
                                    $fetch_supplier = $obj->fetchRows("SELECT * FROM tb_supplier WHERE ref_id_dept=".$_SESSION['sess_id_dept']." AND supplier_status=1 ORDER BY supplier_name DESC ");
                                    if (count($fetch_supplier)>0) {
                                        //id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status                
                                        foreach($fetch_supplier as $key=>$value) {
                                            echo '<option '.($rowData['id_supplier']==$fetch_supplier[$key]['id_supplier'] ? 'selected' : '').' value="'.$fetch_supplier[$key]['id_supplier'].'">'.$fetch_supplier[$key]['supplier_name'].'</option>';
                                        }
                                    }else{
                                            echo '<option value="">ไม่มีข้อมูล</option>';
                                    }
                                ?>
                                </select>
                                <textarea class="form-control <?PHP echo $chk_txt_id_supplier;?>" rows="2" id="txt_ref_id_supplier_2" name="txt_ref_id_supplier_2" placeholder="" ><?PHP echo isset($rowData['ref_id_supplier']) ? $rowData['ref_id_supplier'] : '';?></textarea>
                                <div class="invalid-feedback">ระบุซัพพลายเออร์</div>
                            </div>
                        </div>
                    </div><!--row-6 required-->

                    <div class="row row-7 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12"> 
                            <div class="form-group">
                                <label for="datesent_repair"><i class="fas fa-angle-double-right"></i>  วันที่ส่งซ่อม:<span class="text-red font-size-sm">**</span></label>  
                                <div class="input-group date" id="div_datesent_repair" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input input-md mr-0" id="datesent_repair" name="datesent_repair" value="<?PHP echo !empty($rowData['datesent_repair']) ? str_replace("-", "/", $rowData['datesent_repair']): date('Y/m/d');?>" readonly data-target="#datesent_repair" required />
                                  <div class="input-group-append" data-target="#datesent_repair" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <div class="invalid-feedback">เลือกวันที่ส่งซ่อม</div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div><!--row-7 required-->

                    <div class="row row-8 hv p-1 pb-0">
                        <div class="col-sm-12 col-md-12 col-xs-12"> 
                            <div class="form-group">
                                <label for="slt_id_supplier"><i class="fas fa-angle-double-right"></i>  วันที่ส่งคืน:<span class="text-red font-size-sm">**</span></label>  
                                <div class="input-group date" id="div_dateresive_repair" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input input-md mr-0" id="dateresive_repair" name="dateresive_repair" <?PHP echo !empty($rowData['dateresive_repair']) ? 'value="'.$rowData['dateresive_repair'].'"' : 'disabled';?>  readonly data-target="#dateresive_repair" required />
                                  <div class="input-group-append" data-target="#dateresive_repair" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <div class="invalid-feedback">เลือกวันที่ส่งคืน</div>
                                  </div>
                                </div>

                    <div class="icheck-danger d-inline-block pt-1">
                        <input type="checkbox" id="checkboxDanger1" name="empty_dateresive" <?PHP echo !empty($rowData['dateresive_repair']) ? '' : 'checked=""';?>>
                        <label for="checkboxDanger1" class="text-red">คลิกที่นี่หากยังไม่ระบุวันรับคืน</label>
                      </div>                                
                                </div>
                        </div>
                    </div><!--row-8 required-->                    


                </div><!--card-body-->
            </div><!--card-->
        </div>                
        </div><!--row-->
    </div><!--container-->
    </form><!--FORM 1-->

<script>

//checkboxDanger1

$("#checkboxDanger1").change(function() {
    //$("input[readonly]").prop("disabled", true);
    $("#dateresive_repair").val("").prop('disabled', function (_, val) { return ! val; });
});

//Date picker
$('#datesent_repair').datetimepicker({
        //format: 'L',
        format: 'YYYY/MM/DD',
        maxDate: new Date(),
    });

$('#dateresive_repair').datetimepicker({
        //format: 'L',
        defaultDate: null,
        format: 'YYYY/MM/DD',
        maxDate: new Date(),
    });
</script>
<?PHP
    }
?>