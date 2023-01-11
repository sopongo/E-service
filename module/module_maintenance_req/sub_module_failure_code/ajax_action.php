<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../../include/function.inc.php');

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    /*echo $action; exit();*/


    if ($action=='adddata' && !empty($_POST)) {
        //tb_failure_code   id_failure_code, ref_id_dept, failure_code, failure_code_th_name, failure_code_en_name, failure_code_remark, failure_code_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"failure_code_status=1&failure_code=23232&ref_id_dept-tab2=2&failure_code_th_name=tes&failure_code_en_name=234&failure_code_remark=setse234&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        $chk_update  = '';
        !empty($output['id_row-tab2']) ? ($rowID = $output["id_row-tab2"]) && ($query_id = " AND id_failure_code!=".$output["id_row-tab2"]."") : ($query_id = "");        

        $output['failure_code'] = trim($output['failure_code']);
        $totalRow = $obj->getCount("SELECT count(id_failure_code) AS total_row FROM tb_failure_code WHERE failure_code = '".(trim($output['failure_code']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            //tb_failure_code   id_failure_code, ref_id_dept, failure_code, failure_code_th_name, failure_code_en_name, failure_code_remark, failure_code_status
            $output['failure_code'] = trim($output['failure_code']);
            $output['failure_code_th_name'] = trim($output['failure_code_th_name']);
            $output['failure_code_en_name'] = trim($output['failure_code_en_name']);
            if(empty($rowID)){
                $insertRow = [
                    'failure_code' => (!empty($output['failure_code'])) ? $output['failure_code'] : '',
                    'ref_id_dept' => (!empty($output['ref_id_dept-tab2'])) ? $output['ref_id_dept-tab2'] : '',
                    'failure_code_th_name' => (!empty($output['failure_code_th_name'])) ? $output['failure_code_th_name'] : '',
                    'failure_code_en_name' => (!empty($output['failure_code_en_name'])) ? $output['failure_code_en_name'] : '',
                    'failure_code_remark' => (!empty($output['failure_code_remark'])) ? $output['failure_code_remark'] : '',
                    'failure_code_status' => (!empty($output['failure_code_status'])) ? $output['failure_code_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_failure_code");
            }else{
                $insertRow = [
                    'failure_code' => (!empty($output['failure_code'])) ? $output['failure_code'] : '',
                    'ref_id_dept' => (!empty($output['ref_id_dept-tab2'])) ? $output['ref_id_dept-tab2'] : '',
                    'failure_code_th_name' => (!empty($output['failure_code_th_name'])) ? $output['failure_code_th_name'] : '',
                    'failure_code_en_name' => (!empty($output['failure_code_en_name'])) ? $output['failure_code_en_name'] : '',
                    'failure_code_remark' => (!empty($output['failure_code_remark'])) ? $output['failure_code_remark'] : '',
                    'failure_code_status' => (!empty($output['failure_code_status'])) ? $output['failure_code_status'] : '',
                ];
                $rowID = $obj->update($insertRow, "id_failure_code=".$rowID."", "tb_failure_code");
            }
            echo json_encode($rowID);
            exit();
        }
    }

    if($action=='update-status'){
        $insertRow = [
            'failure_code_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_failure_code=".$_POST['id_row']."", "tb_failure_code");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_failure_code WHERE tb_failure_code.id_failure_code=".$rowID."");

            $slt_ref_id_dept = '';
            $rowData_dept = $obj->fetchRows("SELECT * FROM tb_dept WHERE mt_request_manage=1 AND dept_status=1 ORDER BY id_dept ASC");
            if (count($rowData_dept)!=0) {
                $slt_ref_id_dept.='<option value="" disabled>เลือกแผนกที่รับผิดชอบ</option>';
                foreach($rowData_dept as $key => $value) {
                    $slt_ref_id_dept.='<option '.($rowData_dept[$key]['id_dept']==$rowData['ref_id_dept'] ? 'selected' : '').' value="'.$rowData_dept[$key]['id_dept'].'">'.$rowData_dept[$key]['dept_initialname'].' - '.$rowData_dept[$key]['dept_name'].'</option>';
                }
            } else {
                $slt_ref_id_dept.='<option disabled selected value="" >เลือกแผนกที่รับผิดชอบ</option>  ';
            }
            
            $rowData['slt_ref_id_dept'] = $slt_ref_id_dept;
            echo json_encode($rowData);
            exit();
        }
    }

    if($action=='ref_id_dept'){
        $slt_ref_id_dept = '';
        $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE mt_request_manage=1 AND dept_status=1 ORDER BY id_dept ASC");
        if (count($rowData)!=0) {
            $slt_ref_id_dept.='<option value="" disabled selected>เลือกแผนกที่รับผิดชอบ</option>';
            foreach($rowData as $key => $value) {
                $slt_ref_id_dept.='<option value="'.$rowData[$key]['id_dept'].'">'.$rowData[$key]['dept_initialname'].' - '.$rowData[$key]['dept_name'].'</option>';
            }
        } else {
            $slt_ref_id_dept.='<option disabled selected value="" >เลือกแผนกที่รับผิดชอบ</option>  ';
        }
        echo json_encode($slt_ref_id_dept);
        exit();
    }


?>