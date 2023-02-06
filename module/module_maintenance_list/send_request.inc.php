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

    if ($action=='adddata' && !empty($_POST)) {    
        echo 'xxx';
        //id_maintenance_request, maintenance_request_no, mt_request_date, ref_id_user_request, ref_id_machine_site, ref_id_mt_type, status_approved, ref_id_user_approver, allotted_date, allotted_accept_date, related_to_safty, problem_statement, ref_id_job_type, urgent_type, outsource_service_status, caused_by_os, ref_id_user_approve_os, duration_serv_start, duration_serv_end, estimate_hand_over_date, hand_over_date, ref_id_user_hand_over, cause_mt_request_cancel, maintenance_request_status                        
        $insertRow = [
            'id_maintenance_request' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'maintenance_request_no' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'mt_request_date' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_user_request' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_machine_site' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_mt_type' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'status_approved' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_user_approver' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'allotted_date' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'allotted_accept_date' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'related_to_safty' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'problem_statement' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_job_type' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'urgent_type' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'outsource_service_status' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'caused_by_os' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_user_approve_os' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'duration_serv_start' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'duration_serv_end' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'estimate_hand_over_date' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'hand_over_date' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'ref_id_user_hand_over' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'cause_mt_request_cancel' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
            'maintenance_request_status' => (!empty($output['site_initialname'])) ? $output['site_initialname'] : '',
        ];

    }



?>