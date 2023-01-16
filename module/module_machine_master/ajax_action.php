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
       
    if ($action=='adddata' && !empty($_POST)) {
        //#tb_machine_master     id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }
        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_machine!=".$output["id_row"]."") : ($query_id = "");        

        //$output['location_initialname'] = str_replace(" ","",$output['location_initialname']);
        $output['name_machine'] = trim($output['name_machine']);
        $totalRow = $obj->getCount("SELECT count(id_machine) AS total_row FROM tb_machine_master WHERE machine_code = '".(trim($output['machine_code']))."' OR name_machine='".(trim($output['name_machine']))."' ".$query_id."");
        $totalRow = 0;        
        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert          
           //#tb_machine_master     id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine
            if(empty($rowID)){

                $output['machine_code'] = str_replace("-0000", "", $output['machine_code']);
                $countCode = 0;
                $countCode = $obj->getCount("SELECT count(id_machine) AS total_row FROM tb_machine_master WHERE LEFT(machine_code, ".strlen($output['machine_code']).")='".$output['machine_code']."' ");
                $countCode = str_pad(($countCode+1), 4, '0', STR_PAD_LEFT);
                $machine_code = $output['machine_code'].'-'.$countCode;

                $insertRow = [
                    'machine_code' => (!empty($machine_code)) ? $machine_code : "Not found.",
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : NULL,
                    'ref_id_menu' => (!empty($output['ref_id_menu'])) ? $output['ref_id_menu'] : NULL,
                    'ref_id_sub_menu' => (!empty($output['ref_id_sub_menu'])) ? $output['ref_id_sub_menu'] : NULL,
                    'name_machine' => (!empty($output['name_machine'])) ? $output['name_machine'] : NULL,
                    'detail_machine' => (!empty($output['detail_machine'])) ? $output['detail_machine'] : NULL,
                    'mc_adddate' => date('Y-m-d H:i:s'),
                    'ref_id_user_add' => $_SESSION['sess_id_user'],
                    'mc_editdate' => NULL,
                    'ref_id_user_edit' => NULL,
                    'status_machine' => (!empty($output['status_machine'])) ? $output['status_machine'] : NULL,
                ];
                $rowID = $obj->addRow($insertRow, "tb_machine_master");

            }else{
                //echo 2;  exit;
                $insertRow = [
                    'machine_code' => (!empty($output['machine_code'])) ? $output['machine_code'] : NULL,
                    'ref_id_dept' => (!empty($output['ref_id_dept'])) ? $output['ref_id_dept'] : NULL,
                    'ref_id_menu' => (!empty($output['ref_id_menu'])) ? $output['ref_id_menu'] : NULL,
                    'ref_id_sub_menu' => (!empty($output['ref_id_sub_menu'])) ? $output['ref_id_sub_menu'] : NULL,
                    'name_machine' => (!empty($output['name_machine'])) ? $output['name_machine'] : NULL,
                    'detail_machine' => (!empty($output['detail_machine'])) ? $output['detail_machine'] : NULL,
                    'mc_editdate' => date('Y-m-d H:i:s'),
                    'ref_id_user_edit' => $_SESSION['sess_id_user'],
                    'status_machine' => (!empty($output['status_machine'])) ? $output['status_machine'] : NULL,
                ];
                $rowID = $obj->update($insertRow, "id_machine=".$rowID."", "tb_machine_master");
            }
            echo json_encode($rowID);
            exit();
        }
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'location_status' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_machine=".$_POST['id_row']."", "tb_machine_master");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_machine_master WHERE tb_machine_master.id_machine=".$rowID."");
            
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

    if ($action=="chk_dept_cate") {
        $slt_cate = '';
        $ref_id_dept = (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : '';
        if (!empty($ref_id_dept)){        
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_dept=".$ref_id_dept." AND tb_category.level_menu=1");
            //id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
            if (!empty($fetchRow)) {
                $slt_cate.='<option value="" selected>เหลือหมวดหลัก</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_cate.='<option value="'.$fetchRow[$key]['id_menu'].'">'.($fetchRow[$key]['menu_code']!=NULL ? $fetchRow[$key]['menu_code'].'-' : '').$fetchRow[$key]['name_menu'].'</option>';
                }
            }else{
                $slt_cate.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            echo $slt_cate;
            exit();
        }
    }   
    
    if ($action=="chk_subCate") {
        $slt_cate = '';
        $ref_id_menu = (!empty($_POST['ref_id_menu'])) ? $_POST['ref_id_menu'] : '';
        if (!empty($ref_id_menu)){        
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_menu=".$ref_id_menu." AND tb_category.level_menu=2");
            //id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
            if (!empty($fetchRow)) {
                $slt_cate.='<option value="" selected>เหลือหมวดหลัก</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_cate.='<option value="'.$fetchRow[$key]['id_menu'].'">'.($fetchRow[$key]['menu_code']!=NULL ? $fetchRow[$key]['menu_code'].'-' : '').$fetchRow[$key]['name_menu'].'</option>';
                }
            }else{
                $slt_cate.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            echo $slt_cate;
            exit();
        }
    }       

?>