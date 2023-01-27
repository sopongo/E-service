<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
        
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    */
    //die();

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    } 
       
    if ($action=='adddata' && !empty($_POST)) {
        //#tb_machine_site      id_machine_site, code_machine_site, serial_number, recived_date, ref_id_machine, ref_id_building, ref_id_location, ref_id_site, ref_id_supplier, status_work, detail_machine_site, mcs_adddate, ref_id_user_add, mcs_editdate, ref_id_user_edit, status_machine_site
        /*
        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            ##"brand_status=1&brand_name=sdf&brand_remark=sdfsdf&id_row="
            parse_str($_POST['data'], $output); //$output['period']
        }
        */
        $rowID = "";
        !empty($_POST['id_row']) ? ($rowID = $_POST["id_row"]) && ($query_id = " AND id_machine_site!=".$_POST["id_row"]."") : ($query_id = "");

        //echo $rowID; exit();
        $_POST['serial_number'] = trim($_POST['serial_number']);

            if(empty($rowID)){
                //echo 1;  exit;
                $_POST['code_machine_site'] = substr($_POST['code_machine_site'], 0, -4);
                $countCode = 0;
                $countCode = $obj->getCount("SELECT count(id_machine_site) AS total_row FROM tb_machine_site WHERE LEFT(code_machine_site, ".strlen($_POST['code_machine_site']).")='".$_POST['code_machine_site']."' ");
                $countCode = str_pad(($countCode+1), 4, '0', STR_PAD_LEFT);
                $code_machine_site = $_POST['code_machine_site'].'-'.$countCode;
                //echo $code_machine_site; exit();
                $insertRow = [
                    "code_machine_site" => (!empty($code_machine_site)) ? $code_machine_site : "Not found.",
                    "serial_number" => (!empty($_POST['serial_number'])) ? $_POST['serial_number'] : NULL,
                    "recived_date" => (!empty($_POST['date_rcv'])) ? $_POST['date_rcv'] : NULL,
                    "ref_id_machine_master" => (!empty($_POST['ref_id_machine'])) ? $_POST['ref_id_machine'] : NULL,
                    "ref_id_building" => (!empty($_POST['ref_id_building'])) ? $_POST['ref_id_building'] : NULL,
                    "ref_id_location" => (!empty($_POST['ref_id_location'])) ? $_POST['ref_id_location'] : NULL,
                    "ref_id_site" => (!empty($_POST['ref_id_site'])) ? $_POST['ref_id_site'] : NULL,
                    "ref_id_supplier" => (!empty($_POST['ref_id_supplier'])) ? $_POST['ref_id_supplier'] : NULL,
                    "detail_machine_site" => (!empty($_POST['detail_machine'])) ? $_POST['detail_machine'] : NULL,
                    'mcs_adddate' => date('Y-m-d H:i:s'),
                    'ref_id_user_add' => $_SESSION['sess_id_user'],
                    "status_machine_site" => (!empty($_POST['status_machine'])) ? $_POST['status_machine'] : NULL,
                ];
                $rowID = $obj->addRow($insertRow, "tb_machine_site");
            }else{
                echo 2;  exit;
                $insertRow = [
                    "code_machine_site" => (!empty($code_machine_site)) ? $code_machine_site : "Not found.",
                    "serial_number" => (!empty($_POST['serial_number'])) ? $_POST['serial_number'] : NULL,
                    "recived_date" => (!empty($_POST['date_rcv'])) ? $_POST['date_rcv'] : NULL,
                    "ref_id_machine_master" => (!empty($_POST['ref_id_machine'])) ? $_POST['ref_id_machine'] : NULL,
                    "ref_id_building" => (!empty($_POST['ref_id_building'])) ? $_POST['ref_id_building'] : NULL,
                    "ref_id_location" => (!empty($_POST['ref_id_location'])) ? $_POST['ref_id_location'] : NULL,
                    "ref_id_site" => (!empty($_POST['ref_id_site'])) ? $_POST['ref_id_site'] : NULL,
                    "ref_id_supplier" => (!empty($_POST['ref_id_supplier'])) ? $_POST['ref_id_supplier'] : NULL,
                    "detail_machine_site" => (!empty($_POST['detail_machine'])) ? $_POST['detail_machine'] : NULL,
                    'mcs_editdate' => date('Y-m-d H:i:s'),
                    'ref_id_user_edit' => $_SESSION['sess_id_user'],
                    "status_machine_site" => (!empty($_POST['status_machine'])) ? $_POST['status_machine'] : NULL,
                ];
                $rowID = $obj->update($insertRow, "id_machine_site=".$rowID."", "tb_machine_site");
            }
            echo json_encode($rowID);
            exit();
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'status_machine' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_machine=".$_POST['id_row']."", "tb_machine_master");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT tb_machine_master.*, tb_attachment.path_attachment_name, tb_user.fullname FROM tb_machine_master 
            LEFT JOIN tb_attachment ON (tb_attachment.ref_id_machine=tb_machine_master.id_machine) 
            LEFT JOIN tb_user ON (tb_user.id_user=tb_machine_master.ref_id_user_edit) WHERE tb_machine_master.id_machine=".$rowID."");         
            $slt_ref_id_menu= '';
            $ref_id_sub_menu= '';
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_dept=".$rowData['ref_id_dept']." AND tb_category.level_menu=1");
            if (!empty($fetchRow)) {
                $slt_ref_id_menu.='<option value="">เลือกหมวดหลัก</option>'; //disabled
                foreach($fetchRow as $key=>$value) {
                    $slt_ref_id_menu.='<option '.($fetchRow[$key]['id_menu']==$rowData['ref_id_menu'] ? 'selected' : '').' value="'.$fetchRow[$key]['id_menu'].'">'.($fetchRow[$key]['menu_code']!=NULL ? $fetchRow[$key]['menu_code'].'-' : '').$fetchRow[$key]['name_menu'].'</option>';
                }
            }else{
                $slt_ref_id_menu.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            $rowData['slt_ref_id_menu'] = $slt_ref_id_menu;

            if($rowData['ref_id_sub_menu']!=NULL){
                $fetchSub= $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_menu=".$rowData['ref_id_menu']." AND tb_category.level_menu=2");
                if (!empty($fetchSub)) {
                    $ref_id_sub_menu.='<option value="">เลือกหมวดหลัก</option>'; //disabled
                    foreach($fetchSub as $key=>$value) {
                        $ref_id_sub_menu.='<option '.($fetchSub[$key]['id_menu']==$rowData['ref_id_sub_menu'] ? 'selected' : '').' value="'.$fetchSub[$key]['id_menu'].'">'.($fetchSub[$key]['menu_code']!=NULL ? $fetchSub[$key]['menu_code'].'-' : '').$fetchSub[$key]['name_menu'].'</option>';
                    }
                }else{
                    $ref_id_sub_menu.='<option disabled="" selected="" value="">เลือกหมวดหลักก่อน</option>';
                }

            }else{
                $ref_id_sub_menu.='<option disabled="" selected="" value="">เลือกหมวดหลักก่อน</option>';
            }
            $rowData['ref_id_sub_menu'] = $ref_id_sub_menu;

            $rowData['path_attachment_name']==NULL ? $rowData['path_attachment_name'] = 'default.png?ver=1' : $rowData['path_attachment_name'];
            $rowData['fullname'] = 'แก้ไขล่าสุดโดย:'.($rowData['fullname']==NULL ? ' - ' : $rowData['fullname']).' เมื่อ: '.($rowData['mc_editdate']==NULL ? '-' : nowDateShort($rowData['mc_editdate'])).' เวลา: '.($rowData['mc_editdate']==NULL ? '-' : nowTime($rowData['mc_editdate'])).' น.';
            echo json_encode($rowData);
            exit();
        }
    }
    
    if ($action=="chk_machine_detail") {
        !empty(intval($_POST['ref_id_machine'])) ? ($ref_id_machine = intval($_POST['ref_id_machine'])) && ($machine_query = '') : ''; 
        $fetch_detail = $obj->customSelect("SELECT tb_attachment.path_attachment_name, tb_machine_master.ref_id_menu, tb_machine_master.ref_id_sub_menu 
        FROM tb_machine_master 
        LEFT JOIN tb_attachment ON (tb_attachment.ref_id_machine=tb_machine_master.id_machine)
        WHERE id_machine=".$ref_id_machine." ORDER BY tb_attachment.id_attachment ASC LIMIT 1");
        $rowArr = [
            'photo' => $fetch_detail['path_attachment_name'], 
            'ref_id_menu' => $fetch_detail['ref_id_menu'], 
            'ref_id_sub_menu' => $fetch_detail['ref_id_sub_menu'], 
        ];
        echo json_encode($rowArr);
        exit();        
    }

    if ($action=="chk_building_location") {
        !empty(intval($_POST['ref_id_location'])) ? ($ref_id_location = intval($_POST['ref_id_location'])) && ($query_building="id_location=".$ref_id_location."") : ($query_building="") ;
        if (!empty($ref_id_location)) {
            $fetchBuilding= $obj->customSelect("SELECT * FROM tb_location WHERE ".$query_building." ");
        }
        $rowArr = ['ref_id_building' => $fetchBuilding['ref_id_building'], ];
        echo json_encode($rowArr);
        exit();
    }    

    if ($action=="chk_location_building") {
        !empty(intval($_POST['ref_id_building'])) ? ($ref_id_building = intval($_POST['ref_id_building'])) && ($query_location="ref_id_building=".$ref_id_building." AND ") : ($query_location="") ;
        $fetchlocation = $obj->fetchRows("SELECT * FROM tb_location WHERE ".$query_location." location_status=1 ORDER BY location_name DESC ");
        $slt_location = '';
        if (!empty($fetchlocation)) {
            $slt_location.='<option value="" selected>เลือกสถานที่</option>'; //disabled
            foreach($fetchlocation as $key=>$value) {
                $slt_location.='<option value="'.$fetchlocation[$key]['id_location'].'">'.$fetchlocation[$key]['location_name'].'</option>';
            }
        }else{
            $slt_location.='<option value="" selected>ไม่มีข้อมูล</option>';
        }
        $rowArr = ['slt_location' => $slt_location];
        echo json_encode($rowArr);
        exit();
    }    


    if ($action=="chk_location_mc") {
        !empty(intval($_POST['ref_id_site'])) ? ($ref_id_site = intval($_POST['ref_id_site'])) : '';
        $fetchbuild = $obj->fetchRows("SELECT * FROM tb_building WHERE ref_id_site=".$ref_id_site." AND building_status=1 ORDER BY building_name DESC ");

        $slt_building = '';
        if (!empty($fetchbuild)) {
            $slt_building.='<option value="" selected>เลือกอาคาร</option>'; //disabled
            foreach($fetchbuild as $key=>$value) {
                $slt_building.='<option value="'.$fetchbuild[$key]['id_building'].'">'.$fetchbuild[$key]['building_name'].'</option>';
            }
        }else{
            $slt_building.='<option value="" selected>ไม่มีข้อมูล</option>';
        }
        
        $fetch_location = $obj->fetchRows("SELECT * FROM tb_location WHERE ref_id_site=".$ref_id_site." AND location_status=1 ORDER BY location_name DESC ");
        $slt_location = '';
        if (!empty($fetch_location)) {
            $slt_location.='<option value="" selected>เลือกสถานที่</option>'; //disabled
            foreach($fetch_location as $key=>$value) {
                $slt_location.='<option value="'.$fetch_location[$key]['id_location'].'">'.$fetch_location[$key]['location_name'].'</option>';
            }
        }else{
            $slt_location.='<option value="" selected>ไม่มีข้อมูล</option>';
        }
        $rowArr = ['slt_building' => $slt_building, 'slt_location' => $slt_location];
        echo json_encode($rowArr);
        exit();
    }    

    if ($action=="chk_machine_site") {
        $dept_query = '';
        $menu_query = '';
        $submenu_query = '';
        $slt_mc = '';
        $val_id_dept = (!empty(intval($_POST['val_id_dept']))) ? ($_POST['val_id_dept']) && ($dept_query = ' AND ref_id_dept='.$_POST['val_id_dept'].'') && ($supplier_query=' 
         AND ref_id_dept='.$_POST['val_id_dept'].'') : '';

        $val_id_menu = (!empty(intval($_POST['val_id_menu']))) ? ($_POST['val_id_menu']) && ($menu_query = ' AND ref_id_menu='.$_POST['val_id_menu'].'') : '';
        
        $val_id_sub_menu = (!empty(intval($_POST['val_id_sub_menu']))) ? ($_POST['val_id_sub_menu']) && ($submenu_query = ' AND ref_id_sub_menu='.$_POST['val_id_sub_menu'].'') : '';
        
            $fetchMC = $obj->fetchRows("SELECT * FROM tb_machine_master WHERE status_machine=1 ".$dept_query.$menu_query.$submenu_query." ORDER BY machine_code DESC ");
            if (!empty($fetchMC)) {
                //id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, model_name, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine
                $slt_mc.='<option value="" selected>เลือกเครื่องจักรและอุปกรณ์</option>'; //disabled
                foreach($fetchMC as $key=>$value) {
                    $slt_mc.='<option value="'.$fetchMC[$key]['id_machine'].'">'.$fetchMC[$key]['machine_code'].' : '.$fetchMC[$key]['name_machine'].'</option>';
                }
            }else{
                $slt_mc.='<option value="" selected>ไม่มีข้อมูล</option>';
            }

            $slt_supplier = '';
            $fetch_supplier = $obj->fetchRows("SELECT * FROM tb_supplier WHERE supplier_status=1 ".$supplier_query ." ORDER BY supplier_name DESC ");
            if (!empty($fetch_supplier)) {
                //id_supplier, ref_id_dept, supplier_name, supplier_phone, supplier_remark, supplier_status                
                $slt_supplier.='<option value="" selected>เลือกซัพพลายเออร์</option>'; //disabled
                foreach($fetch_supplier as $key=>$value) {
                    $slt_supplier.='<option value="'.$fetch_supplier[$key]['id_supplier'].'">'.$fetch_supplier[$key]['supplier_name'].'</option>';
                }
            }else{
                $slt_supplier.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            $rowArr = ['slt_mc' => $slt_mc, 'slt_supplier' => $slt_supplier];
            echo json_encode($rowArr);
            exit();
    }       


    if ($action=="chk_dept_cate") {
        $slt_cate = '';
        $ref_id_dept = (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : '';
        if (!empty($ref_id_dept)){        
            $fetchRow = $obj->fetchRows("SELECT * FROM tb_category WHERE tb_category.ref_id_dept=".$ref_id_dept." AND tb_category.level_menu=1");
            //id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, ref_id_dept, name_menu, desc_menu, menu_adddate, ref_id_user_add, menu_editdate, ref_id_user_edit, status_menu
            if (!empty($fetchRow)) {
                $slt_cate.='<option value="" selected>เลือกหมวดหลัก</option>'; //disabled
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
                $slt_cate.='<option value="" selected>เลือกหมวดรอง</option>'; //disabled
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