<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/setting.inc.php');


    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    !empty($_POST['ref_id']) ? $ref_id = intval($_POST['ref_id']): '';

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    } 
   

    if ($action=='adddata' && !empty($_POST)) {    
        
        //echo "<pre>";    print_r($_POST);    echo "</pre>";
        //echo "<pre>";    print_r($_FILES);    echo "</pre>";
           
        $rowData = $obj->customSelect("SELECT dept_initialname FROM tb_dept WHERE tb_dept.id_dept=".$_POST['ref_id_dept']."");
        $chk_no = $_SESSION['sess_dept_initialname'].'-FM-'.$rowData['dept_initialname'].'-'.date('y').''.date('m');
        #สร้างรหัสใบแจ้งซ่อม Ex. PCS-FM-IT-2302-0001	 
        $countNo= 0; 
        $countNo = $obj->getCount("SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request WHERE LEFT(maintenance_request_no,".strlen($chk_no).")='".$chk_no."'");
        $countNo = str_pad(($countNo+1), 4, '0', STR_PAD_LEFT);
        $maintenance_request_no = $chk_no.'-'.$countNo;

        //id_maintenance_request, maintenance_request_no, ref_id_dept, mt_request_date, ref_id_user_request, ref_id_machine_site, ref_id_mt_type, status_approved, ref_id_user_approver, allotted_date, allotted_accept_date, related_to_safty, problem_statement, ref_id_job_type, urgent_type, outsource_service_status, caused_by_os, ref_id_user_approve_os, duration_serv_start, duration_serv_end, estimate_hand_over_date, hand_over_date, ref_id_user_hand_over, cause_mt_request_cancel, maintenance_request_status
        $insertRow = [
            'maintenance_request_no' => ($maintenance_request_no),
            'ref_id_dept_request' => $_SESSION['sess_id_dept'],
            'ref_id_site_request' => $_SESSION['sess_ref_id_site'],
            'ref_id_dept_responsibility' => (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : '',
            'mt_request_date' => (date('Y-m-d H:i:s')),
            'ref_id_user_request' => ($_SESSION['sess_id_user']),
            'ref_id_machine_site' => (!empty($_POST['ref_id_machine_site'])) ? $_POST['ref_id_machine_site'] : '',
            'ref_id_mt_type' => (0),
            'status_approved' => (0),
            'ref_id_user_approver' => (0),
            'detail_note_approved' => (NULL),
            'allotted_date' => (NULL),
            'allotted_accept_date' => (NULL),
            'ref_user_id_accept_request' => (NULL),
            'related_to_safty' => (!empty($_POST['related_to_safty'])) ? $_POST['related_to_safty'] : 1,
            'problem_statement' => (!empty($_POST['problem_statement'])) ? $_POST['problem_statement'] : '',
            'ref_id_job_type' => (!empty($_POST['ref_id_job_type'])) ? $_POST['ref_id_job_type'] : '',
            'urgent_type' => (!empty($_POST['urgent_type'])) ? $_POST['urgent_type'] : '',
            'outsource_service_status' => 0,
            'caused_by_os' => (NULL),
            'ref_id_user_approve_os' => (NULL),
            'duration_serv_start' => (NULL),
            'estimate_hand_over_date' => (NULL),
            'estimate_hand_over_date' => (NULL),
            'hand_over_date' => (NULL),
            'recomment' => (NULL),
            'ref_id_user_survey' => (NULL),
            'survay_date' => (NULL),
            'ref_id_user_hand_over' => (NULL),
            'cause_mt_request_cancel' => (NULL),
            'date_mt_request_cancel' =>(NULL),
            'ref_id_user_cancel' => (NULL),
            'maintenance_request_status' => 1,
        ];
        $rowID = $obj->addRow($insertRow, "tb_maintenance_request");
        //echo  json_encode(trim(intval($rowID)));

        $imagename = '';
        //id_attachment	ref_id_machine	attachment_sort	path_attachment_name	attachment_type
        if (!empty($_FILES['files'])){ ##ถ้ามีแนบไฟล์รูปมาให้อัพโหลดรูปก่อน
                for($x=1;$x<=count($_FILES['files'])+1;$x++){
                    if(!empty($_FILES['files']['tmp_name'][$x-1])){
                        $imagename = $obj->uploadMulti_Photo($_FILES['files'], ($x-1), $pathReq);
                        $insertPhoto = [
                            'ref_id_used' => $rowID,
                            'attachment_sort' => null,
                            'path_attachment_name' => $imagename,
                            'attachment_type' => 1,
                            'image_cate' => 2
                        ];    
                        $imgRowID = $obj->addRow($insertPhoto, "tb_attachment");                                
                    }
                }
        }
        echo json_encode($rowID);
        exit();
    }


    
    if ($action=='send_survey') {
        //echo '<pre>'; print_r($_POST); print_r($_FILES); echo '</pre>'; //exit();
        //tb_satisfaction_survey        id_survey, ref_id_maintenance_request, ref_topic_survey, score_result, recomment
        $rowID = $obj->customSelect("SELECT id_survey FROM tb_satisfaction_survey WHERE ref_id_maintenance_request=".$_POST['ref_id']." LIMIT 1");

        if(empty($rowID['id_survey'])){
            echo 'เพิ่ม';
            $insertRow = array();
            $updateRow = array();
            foreach($arrTopicSurvey as $index => $value){
                $addRow = [
                    'ref_id_maintenance_request' => $_POST['ref_id'],
                    'ref_topic_survey' => $index,
                    'score_result' => $_POST['score_'.$index.''],
                ];
                $insertRow = array_merge($insertRow, $addRow);
                //print_r($insertRow); 
                $rowID = $obj->addRow($insertRow, "tb_satisfaction_survey");
            }
            $updateRow = [
                'recomment' => $_POST['recomment'],
                'survay_date' => date('Y-m-d H:i:s'),
               'ref_id_user_survey' => ($_SESSION['sess_id_user']),
                                
            ];
            $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
            echo $rowID ;
            exit();
        }else{
            echo 'อัพเดท';
            $updateRow = array();
            foreach($arrTopicSurvey as $index => $value){
                $addRow = [
                    'ref_id_maintenance_request' => $_POST['ref_id'],
                    'ref_topic_survey' => $index,
                    'score_result' => $_POST['score_'.$index.''],
                ];
                $updateRow = array_merge($updateRow, $addRow);
                //print_r($insertRow); 
                $rowID = $obj->update($updateRow, "ref_id_maintenance_request=".$_POST['ref_id']." AND ref_topic_survey=".$index."", "tb_satisfaction_survey");
            }
            $updateRow = [
                'recomment' => $_POST['recomment'],
                'survay_date' => date('Y-m-d H:i:s'),
                'ref_id_user_survey' => ($_SESSION['sess_id_user']),
            ];
            $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
            echo $rowID ;
            exit();
        }
        ######### รอใส่โค๊ด Update Timeline ###########
        ##                           ใส่โค๊ดตรงนี้                              ##
        ######### รอใส่โค๊ด Update Timeline ###########        
        exit();        
    }


    if ($action=='problem_statement') {
        //echo $ref_id.'----xxx------'.$_POST['problem_statement']; exit();
        $updateRow = [
            'problem_statement' => (!empty($_POST['problem_statement'])) ? $_POST['problem_statement'] : '',
        ];
        echo $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        exit();        
    }

    if ($action=='start_repair') {
        //echo $ref_id.'----xxx------'.$action;
        $updateRow = [
            'duration_serv_start' => (date('Y-m-d H:i:s')),
        ];
        ######### รอใส่โค๊ด Update Timeline ###########
        ##                           ใส่โค๊ดตรงนี้                              ##
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        exit();        
    }    

    if ($action=='del_parts') {
        !empty($_POST['parts_id']) ? $parts_id = intval($_POST['parts_id']): '';
        //echo $ref_id.'-------'.$_POST['img_id']; exit();
        //$checkFile = $obj->customSelect('SELECT * FROM tb_attachment WHERE id_attachment='.$img_id.'');
        //@unlink('../../'.$pathReq.$checkFile['path_attachment_name']);
        ######### รอใส่โค๊ด Update Timeline ###########
        ##                           ใส่โค๊ดตรงนี้                              ##
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $result = $obj->deleteRow($ref_id, 'tb_change_parts', 'id_parts='.$parts_id.' AND ref_id_maintenance_request='.$ref_id.'');
        exit();
    }

    if ($action=='delimg') {
        !empty($_POST['img_id']) ? $img_id = intval($_POST['img_id']): '';
        //echo $ref_id.'-------'.$_POST['img_id']; exit();
        $checkFile = $obj->customSelect('SELECT * FROM tb_attachment WHERE id_attachment='.$img_id.'');
        @unlink('../../'.$pathReq.$checkFile['path_attachment_name']);
        echo $result = $obj->deleteRow($ref_id, 'tb_attachment', 'id_attachment='.$img_id.' AND ref_id_used='.$ref_id.'');
        exit();
    }        

    if ($action=='accept_request') {
        //echo $ref_id.'----xxx------'.$action;
        $updateRow = [
            'allotted_accept_date' => (date('Y-m-d H:i:s')),
            'ref_user_id_accept_request' => ($_SESSION['sess_id_user']),
        ];
        ######### รอใส่โค๊ด Update Timeline ###########
        ##                           ใส่โค๊ดตรงนี้                              ##
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        exit();        
    }    
    
    if ($action=='update_img_after') {
        if(isset($_POST['data'])){
            ##"slt_failure_code=3&txt_failure_code=xxxx&txt_caused_by=xxxxxxx&slt_repair_code=6&txt_repair_code=xxxx&txt_solution=xxxxxx
            parse_str($_POST['data'], $output); //$output['period']
            //echo $output['slt_failure_code'];                echo "\r\n\r\n";            
            //print_r($output); echo 'xxxxxxxxxxxxx'; exit();
        }

        //echo '<pre>'; print_r($_POST); print_r($_FILES); echo '</pre>'; exit();
        //echo $_POST['action']; exit();
        //$_FILES['files']['tmp_name'][0];

        //$obj->uploadMulti_Photo($_FILES['files'], 0, $pathReq); exit();       

        $imagename = '';
        //echo count($_FILES['files']).'------------';
        //id_attachment	ref_id_machine	attachment_sort	path_attachment_name	attachment_type
        if (!empty($_FILES['files'])){ ##ถ้ามีแนบไฟล์รูปมาให้อัพโหลดรูปก่อน
            //echo 'เจอรูปแนบมาจำนวน--'.count($_FILES['files']); exit();
            for($x=1;$x<=count($_FILES['files'])+1;$x++){
                if(!empty($_FILES['files']['tmp_name'][$x-1])){
                    $imagename = $obj->uploadMulti_Photo($_FILES['files'], ($x-1), $pathReq);
                    $insertPhoto = [
                        'ref_id_used' => $ref_id,
                        'attachment_sort' => null,
                        'path_attachment_name' => $imagename,
                        'attachment_type' => 1,
                        'image_cate' => 3 //cate 3 = รูปหลังซ่อม
                    ];
                    $imgRowID = $obj->addRow($insertPhoto, "tb_attachment");
                }
            }
        }
        exit();
    }

    if ($action=='update_parts'){
        //#tb_change_parts  id_parts, ref_id_maintenance_request, parts_serialno, parts_name, parts_description, parts_price, parts_qty, date_parts_change, ref_id_user_change, date_adddata
        //echo "<pre>";    print_r($_POST);    echo "</pre>"; //exit();
        if(isset($_POST['data'])){
            ##"slt_failure_code=3&txt_failure_code=xxxx&txt_caused_by=xxxxxxx&slt_repair_code=6&txt_repair_code=xxxx&txt_solution=xxxxxx
            parse_str($_POST['data'], $output); //$output['period']
            //echo $output['slt_failure_code'];                echo "\r\n\r\n";            
            //print_r($output); //exit();
        }
        if($output['id_parts']==NULL){
            //echo  'add';
            $insertRow = [
                'ref_id_maintenance_request' => ($ref_id),
                'parts_serialno' => (!empty($output['parts_serialno'])) ? $output['parts_serialno'] : '',
                'parts_name' => (!empty($output['parts_name'])) ? $output['parts_name'] : '',
                'parts_description' => (!empty($output['parts_description'])) ? $output['parts_description'] : '',
                'parts_price' => ((!empty($output['parts_price'])) ? intval(str_replace(",","",$output['parts_price'])) : ''),
                'parts_qty' => ((!empty($output['parts_qty'])) ? intval(str_replace(",","",$output['parts_qty'])) : ''),                        
                'date_parts_change' => ((!empty(str_replace("/","-",$output['date_parts_change']))) ? $output['date_parts_change'] : ''),
                'date_adddata' => (date('Y-m-d H:i:s')),
                'ref_id_user_change' => ($_SESSION['sess_id_user']),
            ];
            $rowID = $obj->addRow($insertRow, "tb_change_parts");
        }else{
            //echo  'edit---'.$output['id_parts'];
            //print_r($output); 
            $updateRow = [
                'parts_serialno' => (!empty($output['parts_serialno'])) ? $output['parts_serialno'] : '',
                'parts_name' => (!empty($output['parts_name'])) ? $output['parts_name'] : '',
                'parts_description' => (!empty($output['parts_description'])) ? $output['parts_description'] : '',
                'parts_price' => ((!empty($output['parts_price'])) ? intval(str_replace(",","",$output['parts_price'])) : ''),
                'parts_qty' => ((!empty($output['parts_qty'])) ? intval(str_replace(",","",$output['parts_qty'])) : ''),                        
                'date_parts_change' => ((!empty(str_replace("/","-",$output['date_parts_change']))) ? $output['date_parts_change'] : ''),
                'date_adddata' => (date('Y-m-d H:i:s')),
                'ref_id_user_change' => ($_SESSION['sess_id_user']),
            ];            
            $rowID = $obj->update($updateRow, "id_parts=".$output['id_parts']."", "tb_change_parts");
        }
        ######### รอใส่โค๊ด Update Timeline ###########
        ##                           ใส่โค๊ดตรงนี้                              ##
        ######### รอใส่โค๊ด Update Timeline ###########
        $rowID = str_replace(array("\r", "\n"), '', $rowID);
        echo strip_tags($rowID);
        exit();        
    }        

    
    if ($action=='outsite_repair') {
        //echo "<pre>";    print_r($_POST);    echo "</pre>"; //exit();
        if(isset($_POST['data'])){
            ##"slt_failure_code=3&txt_failure_code=xxxx&txt_caused_by=xxxxxxx&slt_repair_code=6&txt_repair_code=xxxx&txt_solution=xxxxxx
            parse_str($_POST['data'], $output); //$output['period']
            //echo $output['slt_failure_code'];                echo "\r\n\r\n";            
            //print_r($output); //exit();
        }
        //#tb_outsite_repair id_outsite_repair, ref_id_maintenance_request, caused_outsite_repair, ref_id_supplier, datesent_repair, dateresive_repair, ref_id_user_update, date_outsite_repair        
        $chkID = $obj->customSelect("SELECT count(id_outsite_repair) AS total_row FROM tb_outsite_repair WHERE ref_id_maintenance_request=".$_POST['ref_id']." ");        
        isset($output['empty_dateresive']) && $output['empty_dateresive']=='on' ? $output['dateresive_repair'] = '' : $output['dateresive_repair'] = $output['dateresive_repair'];
        if($chkID['total_row']==1){
            $insertRow = [
                'caused_outsite_repair' => (!empty($output['caused_outsite_repair'])) ? $output['caused_outsite_repair'] : '',
                'ref_id_supplier' => ($output['slt_ref_id_supplier_2']=='custom' ? $output['txt_ref_id_supplier_2'] : $output['slt_ref_id_supplier_2']),
                'datesent_repair' => ((!empty(str_replace("/","-",$output['datesent_repair']))) ? $output['datesent_repair'] : ''),
                'dateresive_repair' => ((!empty(str_replace("/","-",$output['dateresive_repair']))) ? $output['dateresive_repair'] : NULL),
                'datetime_update' => (date('Y-m-d H:i:s')),
                'ref_id_user_update' => ($_SESSION['sess_id_user']),
            ];
            $rowID = $obj->update($insertRow, "ref_id_maintenance_request=".$_POST['ref_id']."", "tb_outsite_repair");
        }else{
            $insertRow = [
                'ref_id_maintenance_request' => $_POST['ref_id'],
                'caused_outsite_repair' => (!empty($output['caused_outsite_repair'])) ? $output['caused_outsite_repair'] : '',
                'ref_id_supplier' => ($output['slt_ref_id_supplier_2']=='custom' ? $output['txt_ref_id_supplier_2'] : $output['slt_ref_id_supplier_2']),
                'datesent_repair' => ((!empty(str_replace("/","-",$output['datesent_repair']))) ? $output['datesent_repair'] : ''),
                'dateresive_repair' => ((!empty(str_replace("/","-",$output['dateresive_repair']))) ? $output['dateresive_repair'] : NULL),
                'datetime_update' => (date('Y-m-d H:i:s')),
                'ref_id_user_update' => ($_SESSION['sess_id_user']),
            ];
            $rowID = $obj->addRow($insertRow, "tb_outsite_repair");
        }
        echo json_encode($rowID);
        exit();
    }

    if ($action=='report_result') {
        //echo "<pre>";    print_r($_POST);    echo "</pre>"; //exit();
        //echo $_POST['data'];        echo "\r\n\r\n";        echo $_POST['action'];        echo "\r\n\r\n";        echo $_POST['ref_id'];                echo "\r\n\r\n";
        if(isset($_POST['data'])){
            ##"slt_failure_code=3&txt_failure_code=xxxx&txt_caused_by=xxxxxxx&slt_repair_code=6&txt_repair_code=xxxx&txt_solution=xxxxxx
            parse_str($_POST['data'], $output); //$output['period']
            //echo $output['slt_failure_code'];                echo "\r\n\r\n";            
            //print_r($output);
        }
        $chkID = $obj->customSelect("SELECT count(id_repair_result) AS total_row FROM tb_repair_result WHERE ref_id_maintenance_request=".$_POST['ref_id']." ");
        //#tb_repair_result     id_repair_result, ref_id_maintenance_request, ref_id_failure_code, ref_id_repair_code, txt_caused_by, txt_solution, ref_id_user_report, report_date, edit_report_date
        if($chkID['total_row']==1){
            $insertRow = [
                'ref_id_failure_code' => ($output['slt_failure_code']=='custom' ? $output['txt_failure_code'] : $output['slt_failure_code']),
                'ref_id_repair_code' => ($output['slt_repair_code']=='custom' ? $output['txt_repair_code'] : $output['slt_repair_code']),
                'txt_caused_by' => (!empty($output['txt_caused_by'])) ? $output['txt_caused_by'] : '',
                'txt_solution' => (!empty($output['txt_solution'])) ? $output['txt_solution'] : '',
                'edit_report_date' => (date('Y-m-d H:i:s')),
                'ref_id_user_edit' => ($_SESSION['sess_id_user']),
            ];
            $rowID = $obj->update($insertRow, "ref_id_maintenance_request=".$_POST['ref_id']."", "tb_repair_result");
        }else{
            $insertRow = [
                'ref_id_maintenance_request' => $_POST['ref_id'],
                'ref_id_failure_code' => ($output['slt_failure_code']=='custom' ? $output['txt_failure_code'] : $output['slt_failure_code']),
                'ref_id_repair_code' => ($output['slt_repair_code']=='custom' ? $output['txt_repair_code'] : $output['slt_repair_code']),
                'txt_caused_by' => (!empty($output['txt_caused_by'])) ? $output['txt_caused_by'] : '',
                'txt_solution' => (!empty($output['txt_solution'])) ? $output['txt_solution'] : '',
                'ref_id_user_report' => ($_SESSION['sess_id_user']),
                'report_date' => (date('Y-m-d H:i:s')),
            ];
            $rowID = $obj->addRow($insertRow, "tb_repair_result");
        }
        ############# บันทึกLog ################
        /*รอเขียนโค๊ด Log เพื่อทำ Timeline*/
        ############# จบบันทึก Log #############
        echo json_encode($rowID);
        exit();
    }


    if ($action=='cancel-req') {
        $insertRow = [
            'cause_mt_request_cancel' => (!empty($_POST['cancel_statement'])) ? $_POST['cancel_statement'] : '',
            'maintenance_request_status' => 2,
            'date_mt_request_cancel' => (date('Y-m-d H:i:s')),
            'ref_id_user_cancel' => ($_SESSION['sess_id_user']),
        ];
        $resultUpdate = $obj->update($insertRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        echo json_encode($resultUpdate);
        exit();
    }

    if ($action=='change_mechanic') {
        /*echo count($_POST['slt_select2_mechanic']);
        print_r($_POST['slt_select2_mechanic']);
        echo "\r\n";
        echo $ref_id; */
        #สเต็ปการเปลี่ยนช่างซ่อม
        /*
        1.ให้ UPDATE status_repairer=2 ที่ไอดีใบแจ้งซ่อม = X
        2.
        */                
        $query_1 = '';
        $query_1.='ref_id_maintenance_request='.$ref_id.' AND (';
        for($i=0;$i<count($_POST['slt_select2_mechanic']);$i++){           
                $query_1.='ref_id_user_repairer!='.$_POST['slt_select2_mechanic'][$i].' AND ';
        }
        $query_1.=') AND status_repairer=1';
        $query_1 = str_replace("AND )", ")", $query_1);

        $holdRow = [
            'status_repairer' => 2,
        ];
        $updRepairer = $obj->update($holdRow, $query_1, "tb_ref_repairer");        
        
        for($i=0;$i<count($_POST['slt_select2_mechanic']);$i++){
            $insertRow = [
                'ref_id_maintenance_request' => $ref_id,
                'ref_id_user_repairer' => (!empty($_POST['slt_select2_mechanic'][$i])) ? $_POST['slt_select2_mechanic'][$i] : NULL,
                'status_repairer' => 1,
            ];
            if($obj->countAll("SELECT ref_id_user_repairer FROM tb_ref_repairer WHERE ref_id_maintenance_request=".$ref_id." AND ref_id_user_repairer=".$_POST['slt_select2_mechanic'][$i]." AND status_repairer=1")==0){
                $rowID = $obj->addRow($insertRow, "tb_ref_repairer");
            }
        }
        echo json_encode($rowID);
        exit();        
    }
    



?>