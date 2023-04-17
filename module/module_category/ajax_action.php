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
        //tb_category   id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }

        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_menu!=".$output["id_row"]."") : ($query_id = "");        

        //$output['menu_code'] = str_replace(" ","",$output['menu_code']);
        $output['name_menu'] = trim($output['name_menu']);

        $totalRow = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category WHERE (menu_code = '".(trim($output['menu_code']))."' OR name_menu='".(trim($output['name_menu']))."') ".$query_id."");
        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            //$output['name_menu'] = str_replace(" ","",$output['name_menu']);
            //$output['name_menu'] = trim($output['name_menu']);
            
            if(empty($rowID)){
                $insertRow = [
                    //id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
                    'menu_code' => (!empty($output['menu_code'])) ? $output['menu_code'] : NULL,
                    'level_menu' => (!empty($output['level_menu'])) ? $output['level_menu'] : NULL,
                    'sort_menu' => NULL,
                    'ref_id_menu' => (!empty($output['ref_id_menu'])) ? $output['ref_id_menu'] : NULL,
                    'ref_id_sub' => NULL,
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : NULL,
                    //'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : NULL,
                    'ref_id_dept' => $_SESSION['sess_id_dept'],
                    'name_menu' => (!empty($output['name_menu'])) ? $output['name_menu'] : NULL,
                    'desc_menu' => (!empty($output['desc_menu'])) ? $output['desc_menu'] : NULL,
                    'menu_adddate' => date('Y-m-d H:i:s'),
                    'ref_id_user_add' => $_SESSION['sess_id_user'],
                    'menu_editdate' => NULL,
                    'ref_id_user_edit' => NULL,
                    'status_menu' => (!empty($output['status_menu'])) ? $output['status_menu'] : NULL,
                ];
                $result = $obj->addRow($insertRow, "tb_category");
            }else{
                $insertRow = [
                    'menu_code' => (!empty($output['menu_code'])) ? $output['menu_code'] : NULL,
                    'level_menu' => (!empty($output['level_menu'])) ? $output['level_menu'] : NULL,
                    'sort_menu' => NULL,
                    'ref_id_menu' => (!empty($output['ref_id_menu'])) ? $output['ref_id_menu'] : NULL,
                    'ref_id_sub' => NULL,
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : NULL,
                    'ref_id_site' => (!empty($output['ref_id_site'])) ? $output['ref_id_site'] : NULL,
                    //'ref_id_dept' => $_SESSION['sess_id_dept'],
                    'name_menu' => (!empty($output['name_menu'])) ? $output['name_menu'] : NULL,
                    'desc_menu' => (!empty($output['desc_menu'])) ? $output['desc_menu'] : NULL,
                    'menu_adddate' => date('Y-m-d H:i:s'),
                    'ref_id_user_add' => $_SESSION['sess_id_user'],
                    'menu_editdate' => NULL,
                    'ref_id_user_edit' => NULL,
                    'status_menu' => (!empty($output['status_menu'])) ? $output['status_menu'] : NULL,
                ];
                $result = $obj->update($insertRow, "id_menu=".$rowID."", "tb_category");
            }
            echo json_encode($result);
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'status_menu' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_menu=".$_POST['id_row']."", "tb_category");
        echo json_encode(1);
        exit();
    }    

if ($action=="edit") {
    $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
    if (!empty($rowID)) {        
        $rowData = $obj->customSelect("SELECT * FROM tb_category WHERE tb_category.id_menu=".$rowID."");
        //tb_category   id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu

        $slt_ref_id_menu = '';
        $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_dept=".$rowData['ref_id_dept']." AND tb_category.level_menu=1 AND tb_category.status_menu=1");
        if (!empty($fetchRow)) {
            $slt_ref_id_menu.='<option value="" selected>เลือกหมวดหลัก</option>'; //disabled
            foreach($fetchRow as $key=>$value) {
                $slt_ref_id_menu.='<option '.($fetchRow[$key]['id_menu']==$rowData['ref_id_menu'] ? 'selected' : '').' value="'.$fetchRow[$key]['id_menu'].'">'.($fetchRow[$key]['menu_code']!=NULL ? $fetchRow[$key]['menu_code'].'-' : '').$fetchRow[$key]['name_menu'].'</option>';
            }
        }else{           
            $slt_ref_id_menu.='<option value="" selected>เลือกหมวดหลัก</option>';
        }

        $rowData['slt_ref_id_menu'] = $slt_ref_id_menu;
        echo json_encode($rowData);
        exit();
    }
}

    if ($action=="chk_id_menu") {
        $slt_ref_id_menu = '';
        $id_dept_val = (!empty($_POST['id_dept_val'])) ? $_POST['id_dept_val'] : '';
        if (!empty($id_dept_val)){        
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_dept=".$id_dept_val." AND tb_category.level_menu=1 AND tb_category.status_menu=1");
            if (!empty($fetchRow)) {
                $slt_ref_id_menu.='<option value="" selected>เลือกหมวดหลัก</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_ref_id_menu.='<option value="'.$fetchRow[$key]['id_menu'].'">'.($fetchRow[$key]['menu_code']!=NULL ? $fetchRow[$key]['menu_code'].'-' : '').$fetchRow[$key]['name_menu'].'</option>';
                }
            }else{
                $slt_ref_id_menu.='<option value="" selected>เลือกหมวดหลัก</option>';
            }
            echo $slt_ref_id_menu;
            exit();
        }
    }        

?>