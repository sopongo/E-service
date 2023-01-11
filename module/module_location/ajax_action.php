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
        //tb_location   id_location, ref_id_site, ref_id_building, location_initialname, location_name, location_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_location!=".$output["id_row"]."") : ($query_id = "");        

        //$output['location_initialname'] = str_replace(" ","",$output['location_initialname']);
        $output['location_name'] = trim($output['location_name']);
        $totalRow = $obj->getCount("SELECT count(id_location) AS total_row FROM tb_location WHERE location_initialname = '".(trim($output['location_initialname']))."' OR location_name='".(trim($output['location_name']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            //$output['location_name'] = str_replace(" ","",$output['location_name']);
            //$output['location_name'] = trim($output['location_name']);
            
            if(empty($rowID)){
                $insertRow = [
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : NULL,
                    'ref_id_building' => (!empty($output['ref_id_building'])) ? $output['ref_id_building'] : NULL,
                    'location_initialname' => (!empty($output['location_initialname'])) ? trim($output['location_initialname']) : NULL,
                    'location_name' => (!empty($output['location_name'])) ? trim($output['location_name']) : '',
                    'location_status' => (!empty($output['location_status'])) ? $output['location_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_location");
            }else{
                $insertRow = [
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : NULL,
                    'ref_id_building' => (!empty($output['ref_id_building'])) ? $output['ref_id_building'] : NULL,
                    'location_initialname' => (!empty($output['location_initialname'])) ? trim($output['location_initialname']) : NULL,
                    'location_name' => (!empty($output['location_name'])) ? trim($output['location_name']) : '',
                    'location_status' => (!empty($output['location_status'])) ? $output['location_status'] : '',
                ];
                $obj->update($insertRow, "id_location=".$rowID."", "tb_location");
            }
            echo json_encode("Success");
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'location_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_location=".$_POST['id_row']."", "tb_location");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_location WHERE tb_location.id_location=".$rowID."");
            
            $slt_building = '';
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_building WHERE tb_building.ref_id_site=".$rowData['ref_id_site']." AND tb_building.building_status!=2");
            if (!empty($fetchRow)) {
                $slt_building.='<option value="">เลือกอาคาร</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_building.='<option '.($fetchRow[$key]['id_building']==$rowData['ref_id_building'] ? 'selected' : '').' value="'.$fetchRow[$key]['id_building'].'">'.($fetchRow[$key]['building_initialname']!=NULL ? $fetchRow[$key]['building_initialname'].'-' : '').$fetchRow[$key]['building_name'].'</option>';
                }
            }else{
                $slt_building.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            $rowData['slt_building'] = $slt_building;
            echo json_encode($rowData);
            exit();
        }
    }

    if ($action=="chk_building") {
        $slt_building = '';
        $id_site_val = (!empty($_POST['id_site_val'])) ? $_POST['id_site_val'] : '';
        //echo "SELECT * FROM tb_building WHERE tb_building.ref_id_site=".$id_site_val." AND tb_building.building_status!=2";
        //exit();
        if (!empty($id_site_val)){        
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_building WHERE tb_building.ref_id_site=".$id_site_val." AND tb_building.building_status!=2");
            if (!empty($fetchRow)) {
                $slt_building.='<option value="" selected>เลือกอาคาร</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_building.='<option value="'.$fetchRow[$key]['id_building'].'">'.($fetchRow[$key]['building_initialname']!=NULL ? $fetchRow[$key]['building_initialname'].'-' : '').$fetchRow[$key]['building_name'].'</option>';
                }
            }else{
                $slt_building.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            echo $slt_building;
            exit();
        }
    }        

?>