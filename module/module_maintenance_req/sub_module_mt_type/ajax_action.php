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
        //tb_maintenance_type   id_mt_type, name_mt_type, ref_id_dept, mt_type_remark, status_mt_type

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        $chk_update  = '';
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_mt_type!=".$output["id_row"]."") : ($query_id = "");        

        //$output['name_mt_type'] = str_replace(" ","",$output['name_mt_type']);
        $output['name_mt_type'] = trim($output['name_mt_type']);
        $totalRow = $obj->getCount("SELECT count(id_mt_type) AS total_row FROM tb_maintenance_type WHERE name_mt_type = '".(trim($output['name_mt_type']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert

            //$output['name_mt_type'] = str_replace(" ","",$output['name_mt_type']);
            $output['name_mt_type'] = trim($output['name_mt_type']);
            if(empty($rowID)){
                $insertRow = [
                    'name_mt_type' => (!empty($output['name_mt_type'])) ? $output['name_mt_type'] : '',
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : '',
                    'mt_type_remark' => (!empty($output['mt_type_remark'])) ? $output['mt_type_remark'] : '',
                    'status_mt_type' => (!empty($output['status_mt_type'])) ? $output['status_mt_type'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_maintenance_type");
            }else{
                $insertRow = [
                    'name_mt_type' => (!empty($output['name_mt_type'])) ? $output['name_mt_type'] : '',
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : '',
                    'mt_type_remark' => (!empty($output['mt_type_remark'])) ? $output['mt_type_remark'] : '',
                    'status_mt_type' => (!empty($output['status_mt_type'])) ? $output['status_mt_type'] : '',
                ];
                $rowID = $obj->update($insertRow, "id_mt_type=".$rowID."", "tb_maintenance_type");
            }
            echo json_encode($rowID);
            exit();
        }
    }

    if($action=='update-status'){
        $insertRow = [
            'status_mt_type' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_mt_type=".$_POST['id_row']."", "tb_maintenance_type");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_maintenance_type WHERE tb_maintenance_type.id_mt_type=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>