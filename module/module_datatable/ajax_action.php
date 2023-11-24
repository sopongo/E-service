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
        //tb_dept id_dept, dept_initialname, dept_name, dept_status

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }
        //print_r($output); die;

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_row!=".$output["id_row"]."") : ($query_id = "");        

        $output['col_name_1'] = str_replace(" ","",$output['col_name_1']);
        $totalRow = $obj->getCount("SELECT count(id_row) AS total_row FROM tb_datatable WHERE col_name_1 = '".(trim($output['col_name_1']))."' ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            $output['col_name_1'] = str_replace(" ","",$output['col_name_1']);
            
            if(empty($rowID)){
                $insertRow = [
                    'col_name_1' => (!empty($output['col_name_1'])) ? $output['col_name_1'] : '',
                    'col_name_2' => (!empty($output['col_name_2'])) ? $output['col_name_2'] : '',
                    'col_name_3' => (!empty($output['col_name_3'])) ? number_format($output['col_name_3']) : 0,
                    'col_name_4' => date('Y-m-d H:i:s'),
                    'col_name_5' => (!empty($output['col_name_5'])) ? $output['col_name_5'] : '',
                ];
                $rowID = $obj->addRow($insertRow, "tb_datatable");
            }else{
                print_r($output);
                echo 2222; 
                die;
                $insertRow = [
                    'col_name_1' => (!empty($output['col_name_1'])) ? $output['col_name_1'] : '',
                    'col_name_2' => (!empty($output['col_name_2'])) ? $output['col_name_2'] : '',
                    'col_name_3' => (!empty($output['col_name_3'])) ? $output['col_name_3'] : '',
                    'col_name_5' => (!empty($output['col_name_5'])) ? $output['col_name_5'] : '',
                ];
                $obj->update($insertRow, "id_row=".$rowID."", "tb_datatable");
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
            $rowData = $obj->customSelect("SELECT * FROM tb_datatable WHERE tb_datatable.id_row=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>