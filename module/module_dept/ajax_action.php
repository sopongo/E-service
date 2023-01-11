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

    /*echo $action; exit();*/
    if ($action=='adddata' && !empty($_POST)) {
        //tb_dept id_dept, dept_initialname, dept_name, dept_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_dept!=".$output["id_row"]."") : ($query_id = "");        

        $output['dept_initialname'] = str_replace(" ","",$output['dept_initialname']);
        $totalRow = $obj->getCount("SELECT count(id_dept) AS total_row FROM tb_dept WHERE dept_initialname = '".(trim($output['dept_initialname']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            $output['dept_initialname'] = str_replace(" ","",$output['dept_initialname']);
            
            if(empty($rowID)){
                $insertRow = [
                    'dept_initialname' => (!empty($output['dept_initialname'])) ? $output['dept_initialname'] : '',
                    'dept_name' => (!empty($output['dept_name'])) ? $output['dept_name'] : '',
                    'mt_request_manage' => (!empty($output['mt_request_manage'])) ? $output['mt_request_manage'] : '',                    
                    'dept_status' => (!empty($output['dept_status'])) ? $output['dept_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_dept");
            }else{
                $insertRow = [
                    'dept_initialname' => (!empty($output['dept_initialname'])) ? $output['dept_initialname'] : '',
                    'dept_name' => (!empty($output['dept_name'])) ? $output['dept_name'] : '',
                    'mt_request_manage' => (!empty($output['mt_request_manage'])) ? $output['mt_request_manage'] : '',
                    'dept_status' => (!empty($output['dept_status'])) ? $output['dept_status'] : '',
                ];
                $obj->update($insertRow, "id_dept=".$rowID."", "tb_dept");
            }
            echo json_encode("Success");
            exit();
        }
    }

    if($action=='check-status-mtr'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'mt_request_manage' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_dept=".$_POST['id_row']."", "tb_dept");
        echo json_encode(1);
        exit();
    }    
    
    
    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'dept_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_dept=".$_POST['id_row']."", "tb_dept");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_dept WHERE tb_dept.id_dept=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>