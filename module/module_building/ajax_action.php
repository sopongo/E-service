<?PHP
    session_start();
    require_once ('../../include/function.inc.php');

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    /*echo $action; exit();*/
    if ($action=='adddata' && !empty($_POST)) {
        //tb_building   id_building, ref_id_building, building_initialname, building_name, building_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_building!=".$output["id_row"]."") : ($query_id = "");        

        $output['building_initialname'] = str_replace(" ","",$output['building_initialname']);
        $totalRow = $obj->getCount("SELECT count(id_building) AS total_row FROM tb_building WHERE (building_initialname = '".(trim($output['building_initialname']))."' OR building_name='".(trim($output['building_name']))."') ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            $output['building_initialname'] = str_replace(" ","",$output['building_initialname']) ;
            if(empty($rowID)){
                $insertRow = [
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : '',
                    'building_initialname' => (!empty($output['building_initialname'])) ? trim($output['building_initialname']) : NULL,
                    'building_name' => (!empty($output['building_name'])) ? trim($output['building_name']) : '',
                    'building_status' => (!empty($output['building_status'])) ? $output['building_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_building");
            }else{
                $insertRow = [
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : '',
                    'building_initialname' => (!empty($output['building_initialname'])) ? trim($output['building_initialname']) : NULL,
                    'building_name' => (!empty($output['building_name'])) ? trim($output['building_name']) : '',
                    'building_status' => (!empty($output['building_status'])) ? $output['building_status'] : '',
                ];
                $obj->update($insertRow, "id_building=".$rowID."", "tb_building");
            }
            echo json_encode("Success");
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'building_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_building=".$_POST['id_row']."", "tb_building");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_building WHERE tb_building.id_building=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    

?>