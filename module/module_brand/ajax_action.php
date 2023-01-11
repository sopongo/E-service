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
        //tb_brand  id_brand, brand_name, brand_remark, brand_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_brand!=".$output["id_row"]."") : ($query_id = "");        

        $output['brand_name'] = trim($output['brand_name']);
        $totalRow = $obj->getCount("SELECT count(id_brand) AS total_row FROM tb_brand WHERE brand_name = '".(trim($output['brand_name']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert           
            if(empty($rowID)){
                $insertRow = [
                    'brand_name' => (!empty($output['brand_name'])) ? $output['brand_name'] : '',
                    'brand_remark' => (!empty($output['brand_remark'])) ? $output['brand_remark'] : '',
                    'brand_status' => (!empty($output['brand_status'])) ? $output['brand_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_brand");
            }else{
                $insertRow = [
                    'brand_name' => (!empty($output['brand_name'])) ? $output['brand_name'] : '',
                    'brand_remark' => (!empty($output['brand_remark'])) ? $output['brand_remark'] : '',
                    'brand_status' => (!empty($output['brand_status'])) ? $output['brand_status'] : '',
                ];
                $obj->update($insertRow, "id_brand=".$rowID."", "tb_brand");
            }
            echo json_encode("Success");
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'brand_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_brand=".$_POST['id_row']."", "tb_brand");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_brand WHERE tb_brand.id_brand=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>