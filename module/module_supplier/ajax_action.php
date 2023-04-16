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
        //tb_supplier		id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"supplier_status=1&supplier_name=sdf&supplier_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_supplier!=".$output["id_row"]."") : ($query_id = "");        

        $output['supplier_name'] = trim($output['supplier_name']);
        $totalRow = $obj->getCount("SELECT count(id_supplier) AS total_row FROM tb_supplier WHERE supplier_name = '".(trim($output['supplier_name']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert           
            if(empty($rowID)){
                $insertRow = [
                    'ref_id_site' => $_SESSION['sess_ref_id_site'],
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : '',
                    'supplier_name' => (!empty($output['supplier_name'])) ? $output['supplier_name'] : '',
                    'supplier_phone' => (!empty($output['supplier_phone'])) ? $output['supplier_phone'] : '',
                    'supplier_remark' => (!empty($output['supplier_remark'])) ? $output['supplier_remark'] : '',
                    'supplier_status' => (!empty($output['supplier_status'])) ? $output['supplier_status'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_supplier");
            }else{
                $insertRow = [
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : '',
                    'supplier_name' => (!empty($output['supplier_name'])) ? $output['supplier_name'] : '',
                    'supplier_phone' => (!empty($output['supplier_phone'])) ? $output['supplier_phone'] : '',
                    'supplier_remark' => (!empty($output['supplier_remark'])) ? $output['supplier_remark'] : '',
                    'supplier_status' => (!empty($output['supplier_status'])) ? $output['supplier_status'] : '',
                ];
                $obj->update($insertRow, "id_supplier=".$rowID."", "tb_supplier");
            }
            echo json_encode("Success");
            exit();
        }
    }
    //tb_supplier		id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'supplier_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_supplier=".$_POST['id_row']."", "tb_supplier");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_supplier WHERE tb_supplier.id_supplier=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>