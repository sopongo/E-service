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
        //tb_reject_mtr_code    id_reject_mtr, ref_id_dept, reject_mtr_code, reject_mtr_name, reject_mtr_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"reject_mtr_status=1&repair_code=23232&ref_id_dept-tab5=2&reject_mtr_code=tes&repair_code_en_name=234&reject_mtr_remark=setse234&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        $chk_update  = '';
        !empty($output['id_row-tab5']) ? ($rowID = $output["id_row-tab5"]) && ($query_id = " AND id_reject_mtr!=".$output["id_row-tab5"]."") : ($query_id = "");        

        $output['reject_mtr_name'] = trim($output['reject_mtr_name']);
        $totalRow = $obj->getCount("SELECT count(id_reject_mtr) AS total_row FROM tb_reject_mtr_code WHERE ref_id_dept='".$output['ref_id_dept-tab5']."' AND reject_mtr_name = '".(trim($output['reject_mtr_name']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            //tb_reject_mtr_code    id_reject_mtr, ref_id_dept, reject_mtr_code, reject_mtr_name, reject_mtr_status
            $output['reject_mtr_name'] = trim($output['reject_mtr_name']);

            if(empty($rowID)){
                $insertRow = [
                    'ref_id_dept' => (!empty($output['ref_id_dept-tab5'])) ? $output['ref_id_dept-tab5'] : '',
                    'reject_mtr_name' => (!empty($output['reject_mtr_name'])) ? $output['reject_mtr_name'] : '',
                    'reject_mtr_remark' => (!empty($output['reject_mtr_remark'])) ? $output['reject_mtr_remark'] : '',
                    'reject_mtr_status' => (!empty($output['reject_mtr_status'])) ? $output['reject_mtr_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_reject_mtr_code");
            }else{
                $insertRow = [
                    'ref_id_dept' => (!empty($output['ref_id_dept-tab5'])) ? $output['ref_id_dept-tab5'] : '',
                    'reject_mtr_name' => (!empty($output['reject_mtr_name'])) ? $output['reject_mtr_name'] : '',
                    'reject_mtr_remark' => (!empty($output['reject_mtr_remark'])) ? $output['reject_mtr_remark'] : '',
                    'reject_mtr_status' => (!empty($output['reject_mtr_status'])) ? $output['reject_mtr_status'] : '',
                ];
                $rowID = $obj->update($insertRow, "id_reject_mtr=".$rowID."", "tb_reject_mtr_code");
            }
            echo json_encode($rowID);
            exit();
        }
    }

    if($action=='update-status'){
        $insertRow = [
            'reject_mtr_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_reject_mtr=".$_POST['id_row']."", "tb_reject_mtr_code");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_reject_mtr_code WHERE tb_reject_mtr_code.id_reject_mtr=".$rowID."");

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