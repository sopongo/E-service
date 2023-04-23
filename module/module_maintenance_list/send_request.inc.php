<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/setting.inc.php');
    require_once('../../include/class.phpmailer.php');//ระบบส่งเมล์

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    !empty($_POST['ref_id']) ? $ref_id = intval($_POST['ref_id']): '';

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }    

    if ($action=='adddata' && !empty($_POST)) {    
        //echo json_encode(1);        exit();
        //echo "<pre>";    print_r($_POST);    echo "</pre>";
        //echo "<pre>";    print_r($_FILES);    echo "</pre>";

        $rowData = $obj->customSelect("SELECT dept_initialname FROM tb_dept WHERE tb_dept.id_dept=".$_POST['ref_id_dept']."");
        $chk_no = $_SESSION['sess_site_initialname'].'-FM-'.$rowData['dept_initialname'].'-'.date('y').''.date('m');
        #สร้างรหัสใบแจ้งซ่อม Ex. PCS-FM-IT-2302-0001	 
        $countNo= 0; 
        $countNo = $obj->getCount("SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request WHERE 
        ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND LEFT(maintenance_request_no,".strlen($chk_no).")='".$chk_no."'");
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
            'ref_id_machine_site' => (!empty($_POST['ref_id_machine_site'])) ? $_POST['ref_id_machine_site'] : 0,
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
        //echo  json_encode($insertRow); exit();
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

        //#tb_timeline id_timeline, ref_id_maintenance_request, timeline_date, ref_id_user, ref_arr_timeline, title_timeline, detail_timeline
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $rowID,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 1, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .จบโค๊ด Update Timeline ###########

        ##### ส่งอีเมล์แจ้งเตือนหัวหน้าช่าง-ผู้แจ้งซ่อม ######
        $rowData = $obj->customSelect("SELECT tb_maintenance_request.*, tb_maintenance_type.name_mt_type, tb_maintenance_request.ref_id_dept_responsibility AS id_dept_responsibility, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_user_request.no_user, tb_user_request.email, tb_user_request.fullname, tb_user_request.ref_id_dept AS ref_id_dept_request, tb_user_dept_request.dept_initialname AS dept_user_request,
        tb_user_cancel.fullname AS cancel_fullname, tb_user_approved.fullname AS approved_fullname, tb_failure_code.failure_code_th_name, tb_repair_code.repair_code_name, 
        tb_repair_result.txt_solution, tb_repair_result.txt_caused_by, tb_repair_result.ref_id_failure_code, tb_repair_result.ref_id_repair_code,
        tb_failure_code.id_failure_code, tb_repair_code.id_repair_code, tb_outsite_repair.*, tb_supplier.supplier_name, tb_user_survey.fullname AS fullname_survay,
        tb_user_handover.fullname AS fullname_handover, tb_accept_request.fullname AS fullname_accept, tb_machine_site.ref_id_machine_master, tb_machine_site.code_machine_site, tb_machine_master.name_machine, tb_building.building_name, tb_location.location_name FROM tb_maintenance_request 
        LEFT JOIN tb_maintenance_type ON (tb_maintenance_type.id_mt_type=tb_maintenance_request.ref_id_mt_type)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_user AS tb_user_request ON (tb_user_request.id_user=tb_maintenance_request.ref_id_user_request)    
        LEFT JOIN tb_user AS tb_user_cancel ON (tb_user_cancel.id_user=tb_maintenance_request.ref_id_user_cancel)    
        LEFT JOIN tb_user AS tb_user_approved ON (tb_user_approved.id_user=tb_maintenance_request.ref_id_user_approver) 
        LEFT JOIN tb_user AS tb_user_survey ON (tb_user_survey.id_user=tb_maintenance_request.ref_id_user_survey) 
        LEFT JOIN tb_user AS tb_accept_request ON (tb_accept_request.id_user=tb_maintenance_request.ref_user_id_accept_request)      
        LEFT JOIN tb_user AS tb_user_handover ON (tb_user_handover.id_user=tb_maintenance_request.ref_id_user_hand_over) 
        LEFT JOIN tb_dept AS tb_user_dept_request ON (tb_user_dept_request.id_dept=tb_user_request.ref_id_dept)
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)    
        LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location) 
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)          
        LEFT JOIN tb_repair_result ON (tb_repair_result.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)
        LEFT JOIN tb_failure_code ON (tb_failure_code.id_failure_code=tb_repair_result.ref_id_failure_code)   
        LEFT JOIN tb_repair_code ON (tb_repair_code.id_repair_code=tb_repair_result.ref_id_repair_code)   
        LEFT JOIN tb_outsite_repair ON (tb_outsite_repair.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)   
        LEFT JOIN tb_supplier ON (tb_supplier.id_supplier=tb_outsite_repair.ref_id_supplier) WHERE tb_maintenance_request.id_maintenance_request=".$rowID.";");

        //คิวรี่หาหัวหน้าแผนก เพื่อส่งอีเมล์แจ้งเตือนมีใบแจ้งซ่อม
        //$fetchRow = $obj->fetchRows($sql_fetchRow);
        $mailBcc = '';
        $deptResp = $obj->fetchRows("SELECT tb_user.email, tb_user.fullname, tb_site_responsibility.* FROM tb_user 
        LEFT JOIN tb_site_responsibility ON (tb_site_responsibility.ref_id_user=tb_user.id_user) 
        WHERE tb_site_responsibility.ref_id_site=".$rowData['ref_id_site_request']." AND tb_user.ref_id_dept=".$rowData['ref_id_dept_responsibility']." AND (tb_user.class_user=2 OR tb_user.class_user=3 OR tb_user.class_user=5) AND tb_user.status_user=1");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = false;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl"; // Enable "tls" encryption, "ssl" also accepted
        $mail->Host = "mail.cc.pcs-plp.com"; //$smtp
        $mail->Port = 465; //$smtp_port
        $mail->CharSet = 'UTF-8';
        $mail->Username = "no-reply@cc.pcs-plp.com"; //$noreply_mail
        $mail->Password = "shv'gpHo#23"; //$pass_mail
        $mail->SetFrom("no-reply@cc.pcs-plp.com", "E-service (แจ้งซ่อมออนไลน์)");
        //$mail->AddBCC("it-support@jwdcoldchain.com", "หัว จม.(เทส ส่งใบแจ้งซ่อมนะต๊ะ) มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม");
        //$mail->AddAttachment($upload_pdf."invoice_".$inv_no.".pdf");
        //$mail->AddReplyTo("youruser@yahoo.com","Mocyc Dot Com");
     $mail->Subject = "[แจ้งซ่อม] มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม ".$rowData['maintenance_request_no']." ";
     $message = '<table style="width:50%;" cellspacing="0" cellpadding="1" border="1">
     <tr>
       <td>
     <table style="width:100%; font-family: Tahoma, serif; font-size:13px;" cellspacing="0" cellpadding="10" border="0">
       <tr>
         <td colspan="2"><strong>[E-service Alert] มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม: '.$rowData['maintenance_request_no'].'</strong></td>
       </tr>
       <tr>
         <td colspan="2"><strong>แจ้ง ผจก.แผนก, หัวหน้าส่วน, ผู้มีส่วนเกี่ยวข้อง</strong></td>
       </tr>
       <tr>
         <td colspan="2"><strong>ไซต์งาน:</strong> '.$_SESSION['sess_site_initialname'].'</td>
       </tr>
       <tr>
         <td colspan="2"><strong>แผนก:</strong> '.$rowData['dept_responsibility'].'</td>
       </tr>    
         <tr>
         <td colspan="2">มีผู้แจ้งซ่อมเครื่องจักร-อุปกรณ์ เลขที่ใบแจ้งซ่อม: '.$rowData['maintenance_request_no'].'</td>
       </tr>
       <tr><td width="30%"><strong>ผู้แจ้งซ่อม:</strong></td><td width="70%">'.$rowData['fullname'].' <strong>แผนก:</strong> '.$rowData['dept_user_request'].'</td></tr>
       <tr><td><strong>วันที่แจ้งซ่อม:</strong></td><td>'.$rowData['mt_request_date'].'</td></tr>
       <tr><td><strong>รหัสเครื่องจักร-อุปกรณ์:</strong></td><td>'.$rowData['code_machine_site'].':</td></tr>
       <tr><td><strong>ชื่อเครื่องจักร-อุปกรณ์:</strong></td><td>'.$rowData['name_machine'].':</td></tr>
       <tr><td><strong>ไซต์งาน:</strong></td><td>'.$_SESSION['sess_site_initialname'].'</td></tr>
       <tr><td><strong>อาคาร:</strong></td><td>'.$rowData['building_name'].'</td></tr>
       <tr><td><strong>สถานที่:</strong></td><td>'.$rowData['location_name'].'</td></tr>
       <tr><td><strong>อาการเสีย/ปัญหาที่พบ:</strong></td><td></td></tr>
       <tr><td colspan="2">'.$rowData['problem_statement'].'</td></tr>
       <tr><td colspan="2"><hr /></td></tr>  
       <tr><td colspan="2">กรุณาล็อกอินเข้าระบบเพื่อตรวจสอบใบแจ้งซ่อม <strong>คลิกที่นี่เพื่อเข้าสู่ระบบ E-service</strong></td></tr>  
     </table>
       </td>
     </tr>
     </table>';
     $mail->MsgHTML($message);
     //$mail->AddAttachment("(Windows 7) - Wallpapers4Desktop.com 015.jpg");
     $mail->AddAddress($rowData['email']);//อีเมล์ผู้แจ้งซ่อม
    // $mail->AddBCC("it-support@jwdcoldchain.com"); //BCC ส่งอีเมล์หาหัวหน้าแผนกที่รับผิดชอบ
    //$mail->AddBCC($mailBcc); //BCC ส่งอีเมล์หาหัวหน้าแผนกที่รับผิดชอบ
     $mail->set('X-Priority', '3'); //Priority 1 = High, 3 = Normal, 5 = low
     @$mail->Send(); //ส่งเมล์
    $mail->ClearAllRecipients();
    $mail->ClearAddresses();

        if (count($deptResp)>0) {
            foreach($deptResp as $key=>$value){
                $mail->ClearAllRecipients();
                $mail->ClearAddresses();
                @$mail->AddAddress($deptResp[$key]['email']); //BCC ส่งอีเมล์หาหัวหน้าแผนกที่รับผิดชอบ
                @$mail->Send();
            }
        }
        ##### ส่งอีเมล์แจ้งเตือนหัวหน้าช่าง-ผู้แจ้งซ่อม ######
        echo json_encode($rowID);
        exit();
    }
    
    if ($action=='send_survey') { //ประเมิณผลการซ่อม
        //echo '<pre>'; print_r($_POST); print_r($_FILES); echo '</pre>'; //exit();
        //tb_satisfaction_survey        id_survey, ref_id_maintenance_request, ref_topic_survey, score_result, recomment
        $rowID = $obj->customSelect("SELECT id_survey FROM tb_satisfaction_survey WHERE ref_id_maintenance_request=".$_POST['ref_id']." LIMIT 1");

        if(empty($rowID['id_survey'])){
            //echo 'เพิ่ม';
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
            ######### รอใส่โค๊ด Update Timeline ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 15, //REF. $arr_timeline ประเมิณผลการซ่อม
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### รอใส่โค๊ด Update Timeline ###########

            ######### ปิดงานซ่อม ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 16, //REF. $arr_timeline ซ่อมแล้ว
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### .ปิดงานซ่อม ###########

            echo $rowID ;
            exit();
        }else{
            //echo 'อัพเดท';
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
            ######### รอใส่โค๊ด Update Timeline ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 15, //REF. $arr_timeline ประเมิณผลการซ่อม
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### รอใส่โค๊ด Update Timeline ###########
            echo $rowID ;
            exit();
        }
        exit();        
    }

    if ($action=='noapproved') {
        $updateRow = [
            'status_approved' => 2,
            'ref_id_user_approver' => $_SESSION['sess_id_user'],
            'detail_note_approved' => (!empty($_POST['detail_note_approved'])) ? $_POST['detail_note_approved'] : '',
            'allotted_date' => date('Y-m-d H:i:s'),            
        ];
        $rowID = $obj->update($updateRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 24, //REF. $arr_timeline ไม่อนุมัติใบแจ้งซ่อม
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########
        echo $rowID;
        exit();        
    }

    if ($action=='problem_statement') {
        //echo $ref_id.'----xxx------'.$_POST['problem_statement']; exit();
        $updateRow = [
            'problem_statement' => (!empty($_POST['problem_statement'])) ? $_POST['problem_statement'] : '',
        ];
        $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 8, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########
        echo $rowID;
        exit();        
    }

    if ($action=='start_repair') {
        //echo $ref_id.'----xxx------'.$action;
        $updateRow = [
            'duration_serv_start' => (date('Y-m-d H:i:s')),
        ];
        $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 6, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $rowID;
        exit();        
    }    

    if ($action=='del_parts') {//ลบข้อมูลรายการอะไหล่ที่เปลี่ยน
        !empty($_POST['parts_id']) ? $parts_id = intval($_POST['parts_id']): '';
        //echo $ref_id.'-------'.$_POST['img_id']; exit();
        //$checkFile = $obj->customSelect('SELECT * FROM tb_attachment WHERE id_attachment='.$img_id.'');
        //@unlink('../../'.$pathReq.$checkFile['path_attachment_name']);
        $result = $obj->deleteRow($ref_id, 'tb_change_parts', 'id_parts='.$parts_id.' AND ref_id_maintenance_request='.$ref_id.'');
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 22, //REF. $arr_timeline ลบข้อมูลรายการอะไหล่ที่เปลี่ยน
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########        
        echo $result;
        exit();
    }

    if ($action=='delimg') {//ลบรูปถ่ายใบแจ้งซ่อม
        !empty($_POST['img_id']) ? $img_id = intval($_POST['img_id']): '';
        //echo $ref_id.'-------'.$_POST['img_id']; exit();
        $checkFile = $obj->customSelect('SELECT * FROM tb_attachment WHERE id_attachment='.$img_id.'');
        @unlink('../../'.$pathReq.$checkFile['path_attachment_name']);
        $result = $obj->deleteRow($ref_id, 'tb_attachment', 'id_attachment='.$img_id.' AND ref_id_used='.$ref_id.'');
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 23, //REF. $arr_timeline ลบรูปถ่ายใบแจ้งซ่อม
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $result;
        exit();
    }

    if ($action=='post_timeline') { ##ส่งข้อความติดตามงานซ่อม
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 17, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => (!empty($_POST['txt_timeline'])) ? $_POST['txt_timeline'] : NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        echo $insertTM;
        exit();
    }
    
    if ($action=='serv_end') { ##ปิดงาน/ส่งมอบงาน
        //echo $ref_id.'----xxx------'.$action; exit();
        $updateRow = [
            'duration_serv_end' => (date('Y-m-d H:i:s')),   //เวลาที่ซ่อมเสร็จ	
        ];
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 13, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########
        echo $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        exit();
    }        

    if ($action=='accept_request') { //ช่างรับทราบ, รับงานซ่อม
        //echo $ref_id.'----xxx------'.$action;
        $updateRow = [
            'allotted_accept_date' => (date('Y-m-d H:i:s')),
            'ref_user_id_accept_request' => ($_SESSION['sess_id_user']),
        ];
        $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        if($rowID=='Success'){
            $update_repairer = [
                'acknowledge_date' => (date('Y-m-d H:i:s')),
            ];
            $rowID = $obj->update($update_repairer, "ref_id_maintenance_request=".$_POST['ref_id']." AND ref_id_user_repairer=".$_SESSION['sess_id_user']."", "tb_ref_repairer");
        }
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 19, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########        
        echo $rowID;
        exit();
    }
   
    if ($action=='hand_over'){ //ส่งมอบงาน/ปิดงาน
        $updateRow = [
            'hand_over_date' => (date('Y-m-d H:i:s')),
            'ref_id_user_hand_over' => $_SESSION['sess_id_user'],
        ];
        $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        if($rowID=='Success'){
            ######### รอใส่โค๊ด Update Timeline ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 14, //REF. $arr_timeline ส่งมอบงาน รอผู้แจ้งซ่อมประเมิณ
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### End Update Timeline ###########
            echo $rowID;
            exit();
        }
    }     

    if ($action=='reject_hand_over'){ //ยกเลิกส่งมอบงาน ตีกลับช่างซ่อม
        $updateRow = [
            'duration_serv_end' => NULL,
        ];
        $rowID = $obj->update($updateRow, "id_maintenance_request=".$_POST['ref_id']."", "tb_maintenance_request");
        if($rowID=='Success'){
            ######### รอใส่โค๊ด Update Timeline ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 21, //REF. $arr_timeline ยกเลิกส่งมอบ ให้ช่างแก้ไขงานซ่อมใหม่
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### รอใส่โค๊ด Update Timeline ###########
            echo $rowID;
            exit();
        }
    }
    
    if ($action=='update_img_after') { //แนบรูปหลังซ่อม
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
            ######### รอใส่โค๊ด Update Timeline ###########
            $insert_tm = [
                'ref_id_maintenance_request' => $ref_id,
                'timeline_date' => date('Y-m-d H:i:s'),
                'ref_id_user' => $_SESSION['sess_id_user'],
                'ref_arr_timeline' => 12, //REF. $arr_timeline อัพเดทข้อมูลภาพถ่ายหลังซ่อม
                'title_timeline' => NULL,
                'detail_timeline' => NULL,
            ];
            $insertTM = $obj->addRow($insert_tm, "tb_timeline");
            ######### รอใส่โค๊ด Update Timeline ###########
        }
        exit();
    }

    if ($action=='update_parts'){ //อัพเดทข้อมูลรายการอะไหล่ที่เปลี่ยน
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
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 11, //REF. $arr_timeline อัพเดทข้อมูลรายการอะไหล่ที่เปลี่ยน
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########        
        
        $rowID = str_replace(array("\r", "\n"), '', $rowID);
        echo strip_tags($rowID);
        exit();        
    }        
    
    if ($action=='outsite_repair') {//อัพเดทข้อมูลส่งซ่อมภายนอก
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
        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 10, //REF. $arr_timeline อัพเดทข้อมูลส่งซ่อมภายนอก
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########        
        echo json_encode($rowID);
        exit();
    }

    if ($action=='report_result') { //อัพเดทข้อมูลสรุปผลการซ่อม
        //echo "<pre>";    print_r($_POST);    echo "</pre>"; //exit();
        //echo $_POST['data'];        echo "\r\n\r\n";        echo $_POST['action'];        echo "\r\n\r\n";        echo $_POST['ref_id'];                echo "\r\n\r\n";
        if(isset($_POST['data'])){
            ##"slt_failure_code=3&txt_failure_code=xxxx&txt_caused_by=xxxxxxx&slt_repair_code=6&txt_repair_code=xxxx&txt_solution=xxxxxx
            parse_str($_POST['data'], $output); //$output['period']
            //echo $output['slt_failure_code'];                echo "\r\n\r\n";            
            //print_r($output); exit();
        }
        $chkID = $obj->customSelect("SELECT count(id_repair_result) AS total_row FROM tb_repair_result WHERE ref_id_maintenance_request=".$_POST['ref_id']." ");
        //#tb_repair_result     id_repair_result, ref_id_maintenance_request, ref_id_failure_code, ref_id_repair_code, txt_caused_by, txt_solution, ref_id_user_report, report_date, edit_report_date
        if($chkID['total_row']==1){
            $insertRow = [
                'ref_id_failure_code' => ($output['slt_failure_code']=='custom' || $output['slt_failure_code']=='' ? $output['txt_failure_code'] : $output['slt_failure_code']),
                'ref_id_repair_code' => ($output['slt_repair_code']=='custom'  || $output['slt_repair_code']=='' ? $output['txt_repair_code'] : $output['slt_repair_code']),
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
        ############# บันทึก Timeline ################
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 9, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ############# จบบันทึก Timeline  #############
        echo json_encode($rowID);
        exit();
    }

    
    if ($action=='timeline') {
        $arr_test_tm = array();
        $rowTM = $obj->fetchRows("SELECT tb_timeline.*, tb_user.fullname FROM tb_timeline LEFT JOIN tb_user ON (tb_user.id_user=tb_timeline.ref_id_user)
        WHERE tb_timeline.ref_id_maintenance_request=".$ref_id." ORDER BY tb_timeline.timeline_date ASC"); // AND tb_ref_repairer.status_repairer=1 
        if (count($rowTM)!=0){
          foreach($rowTM as $key => $value){
            //tb_timeline id_timeline, ref_id_maintenance_request, timeline_date, ref_id_user, ref_arr_timeline, title_timeline, detail_timeline
              $date = explode(" ", $rowTM[$key]['timeline_date']);
              $addArr = [
              'date' => $date[0],
              'id_timeline' => $rowTM[$key]['timeline_date'],
              'ref_id_maintenance_request' => $rowTM[$key]['ref_id_maintenance_request'],
              'timeline_date' => $rowTM[$key]['timeline_date'],
              'ref_id_user' => $rowTM[$key]['ref_id_user'],
              'fullname' => $rowTM[$key]['fullname'],
              'ref_arr_timeline' => $rowTM[$key]['ref_arr_timeline'],
              'title_timeline' => $rowTM[$key]['title_timeline'],
              'detail_timeline' => $rowTM[$key]['detail_timeline'],
            ];
            array_push($arr_test_tm, $addArr);
          }
          $key_values = array_column($arr_test_tm, 'timeline_date'); 
          array_multisort($key_values, SORT_ASC, $arr_test_tm);
          //echo '<pre>'; print_r($arr_test_tm); echo '</pre>';
        }
        $i = 1;
        foreach($arr_test_tm as $key => $value){
          if($key==0){
            $chk_date = $arr_test_tm[$key]['date'];
          }
          if($chk_date==$arr_test_tm[$key]['date']){
            if($i==1){
              $i++;
              echo '<!-- timeline time label --><div class="time-label"><span class="bg-warning">'.nowDateShort($arr_test_tm[$key]['date']).'</span></div><!--.timeline time label -->';
              //echo '<div class="text-bold">(A)-'.$arr_test_tm[$key]['date'].'</div>';
              //echo 'a.'.$arr_test_tm[$key]['timeline_date'].'---->id_timeline--->'.$arr_test_tm[$key]['id_timeline']."(id_timeline)----->".$i."<br />";
              echo '<div>'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][2].'
              <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> '.timeAgo($rowTM[$key]['timeline_date']).' ('.nowDateShort($rowTM[$key]['timeline_date']).' เวลา: '.nowTime($rowTM[$key]['timeline_date']).')</span>
                <h3 class="timeline-header text-bold text-sm">'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][1].': '.$i.'</h3>
                <div class="timeline-body">'.((!empty($rowTM[$key]['detail_timeline']) ? '<p class="p-0 m-0 text-sm"><i class="fas fa-quote-left"></i> '.$rowTM[$key]['detail_timeline'].'  <i class="fas fa-quote-right"></i></p>' : '')).' โดย: '.$rowTM[$key]['fullname'].'</div>
              </div>
            </div>';
            }else{
              //echo 'b.'.$arr_test_tm[$key]['timeline_date'].'---->id_timeline--->'.$arr_test_tm[$key]['id_timeline']."(id_timeline)----->".$i."<br />";
              echo '<div>'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][2].'
              <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> '.timeAgo($rowTM[$key]['timeline_date']).' ('.nowDateShort($rowTM[$key]['timeline_date']).' เวลา: '.nowTime($rowTM[$key]['timeline_date']).')</span>
                <h3 class="timeline-header text-bold text-sm">'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][1].'</h3>
                <div class="timeline-body">'.((!empty($rowTM[$key]['detail_timeline']) ? '<p class="p-0 m-0 text-sm"><i class="fas fa-quote-left"></i> '.$rowTM[$key]['detail_timeline'].'   <i class="fas fa-quote-right"></i></p>' : '')).' โดย: '.$rowTM[$key]['fullname'].'</div>
              </div>
            </div>';
              $i++;
            }
          }else{
            $i = 1;
            $chk_date=$arr_test_tm[$key]['date'];
            if($i==1){
              $i++;
              //echo '<div class="text-bold">(B)-'.$arr_test_tm[$key]['date'].'</div>';
              //echo 'a.'.$arr_test_tm[$key]['timeline_date'].'---->id_timeline--->'.$arr_test_tm[$key]['id_timeline']."(id_timeline)----->".$i."<br />";
              echo '<!-- timeline time label --><div class="time-label"><span class="bg-warning">'.nowDateShort($arr_test_tm[$key]['date']).'</span></div><!--.timeline time label -->';
              echo '<div>'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][2].'
              <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> '.timeAgo($rowTM[$key]['timeline_date']).' ('.nowDateShort($rowTM[$key]['timeline_date']).' เวลา: '.nowTime($rowTM[$key]['timeline_date']).')</span>
                <h3 class="timeline-header text-bold text-sm">'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][1].'</h3>
                <div class="timeline-body">'.((!empty($rowTM[$key]['detail_timeline']) ? '<p class="p-0 m-0 text-sm"><i class="fas fa-quote-left"></i> '.$rowTM[$key]['detail_timeline'].'   <i class="fas fa-quote-right"></i></p>' : '')).' โดย: '.$rowTM[$key]['fullname'].'</div>
              </div>
            </div>';                                  
            }else{
              //echo 'b.'.$arr_test_tm[$key]['timeline_date'].'---->id_timeline--->'.$arr_test_tm[$key]['id_timeline']."(id_timeline)----->".$i."<br />";
              echo '<div>'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][2].'
              <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> '.timeAgo($rowTM[$key]['timeline_date']).' ('.nowDateShort($rowTM[$key]['timeline_date']).' เวลา: '.nowTime($rowTM[$key]['timeline_date']).')</span>
                <h3 class="timeline-header text-bold text-sm">'.$arr_timeline[$rowTM[$key]['ref_arr_timeline']][1].'</h3>
                <div class="timeline-body">'.((!empty($rowTM[$key]['detail_timeline']) ? '<p class="p-0 m-0 text-sm"><i class="fas fa-quote-left"></i> '.$rowTM[$key]['detail_timeline'].'  <i class="fas fa-quote-right"></i></p>' : '')).' โดย: '.$rowTM[$key]['fullname'].'</div>
              </div>
            </div>';                                  
              $i++;
            }
          }
        }
        
        if($rowTM[$key]['ref_arr_timeline']!=16){
            echo '<div><i class="far fa-clock bg-gray"></i></div>';
        }else{
            echo '<div><i class="far fa-laugh-squint bg-success"></i></div>';
        }
        exit();
    }        

    if ($action=='update_reject') {
        $updateRow = [
            'reject_caused' =>  (!empty($_POST['reject_caused'])) ? $_POST['reject_caused'] : NULL,
            'reject_date' => (date('Y-m-d H:i:s')),
            'status_repairer' => (2),
        ];
        $resultUpdate = $obj->update($updateRow, "ref_id_maintenance_request=".$ref_id." AND ref_id_user_repairer=".$_SESSION['sess_id_user']." AND status_repairer=1", "tb_ref_repairer");
        /*
        $updateRow = [
            'allotted_accept_date' =>  NULL,
            'ref_user_id_accept_request' => NULL,
        ];
        $resultUpdate = $obj->update($updateRow, "id_maintenance_request=".$ref_id." AND ref_user_id_accept_request=".$_SESSION['sess_id_user']."", "tb_maintenance_request");
        */
        echo $resultUpdate;
        exit();
    }    

    if ($action=='cancel-req'){//ยกเลิกใบแจ้งซ่อม
        $insertRow = [
            'cause_mt_request_cancel' => (!empty($_POST['cancel_statement'])) ? $_POST['cancel_statement'] : '',
            'maintenance_request_status' => 2,
            'date_mt_request_cancel' => (date('Y-m-d H:i:s')),
            'ref_id_user_cancel' => ($_SESSION['sess_id_user']),
        ];
        $resultUpdate = $obj->update($insertRow, "id_maintenance_request=".$ref_id."", "tb_maintenance_request");
        echo json_encode($resultUpdate);
        exit();

        ######### รอใส่โค๊ด Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 2, //REF. $arr_timeline ยกเลิกใบแจ้งซ่อม
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### รอใส่โค๊ด Update Timeline ###########        
    }

    if ($action=='change_mechanic') { //แก้ไขผู้รับผิดชอบงานซ่อม
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
            'reject_caused' =>  'ถูกยกเลิก',
            'reject_date' => (date('Y-m-d H:i:s')),
            'status_repairer' => 2,
        ];
        $updRepairer = $obj->update($holdRow, $query_1, "tb_ref_repairer");        
        
        for($i=0;$i<count($_POST['slt_select2_mechanic']);$i++){
            $insertRow = [
                'ref_id_maintenance_request' => $ref_id,
                'ref_id_user_repairer' => (!empty($_POST['slt_select2_mechanic'][$i])) ? $_POST['slt_select2_mechanic'][$i] : NULL,
                'reject_date' => NULL,
                'reject_caused' => NULL,                
                'status_repairer' => 1,
            ];
            if($obj->countAll("SELECT ref_id_user_repairer FROM tb_ref_repairer WHERE ref_id_maintenance_request=".$ref_id." AND ref_id_user_repairer=".$_POST['slt_select2_mechanic'][$i]." AND status_repairer=1")==0){
                $rowID = $obj->addRow($insertRow, "tb_ref_repairer");
            }
        }
        ######### Update Timeline ###########
        $insert_tm = [
            'ref_id_maintenance_request' => $ref_id,
            'timeline_date' => date('Y-m-d H:i:s'),
            'ref_id_user' => $_SESSION['sess_id_user'],
            'ref_arr_timeline' => 7, //REF. $arr_timeline
            'title_timeline' => NULL,
            'detail_timeline' => NULL,
        ];
        $insertTM = $obj->addRow($insert_tm, "tb_timeline");
        ######### .Update Timeline ###########
        echo json_encode($rowID);
        exit();        
    }
    



?>