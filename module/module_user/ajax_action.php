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
        //tb_unit   id_unit, unit_name, status_unit

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_unit!=".$output["id_row"]."") : ($query_id = "");        

        $output['unit_name'] = trim($output['unit_name']);
        $totalRow = $obj->getCount("SELECT count(id_unit) AS total_row FROM tb_unit WHERE unit_name = '".(trim($output['unit_name']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert           
            if(empty($rowID)){
                $insertRow = [
                    'unit_name' => (!empty($output['unit_name'])) ? $output['unit_name'] : '',
                    'status_unit' => (!empty($output['status_unit'])) ? $output['status_unit'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_unit");
            }else{
                $insertRow = [
                    'unit_name' => (!empty($output['unit_name'])) ? $output['unit_name'] : '',
                    'status_unit' => (!empty($output['status_unit'])) ? $output['status_unit'] : '',
                ];
                $obj->update($insertRow, "id_unit=".$rowID."", "tb_unit");
            }
            echo json_encode("Success");
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'status_unit' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_unit=".$_POST['id_row']."", "tb_unit");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_unit WHERE tb_unit.id_unit=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>