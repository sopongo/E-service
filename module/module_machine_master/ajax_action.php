<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/setting.inc.php');        
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
        //#tb_machine_master     id_machine, machine_code, ref_id_dept, ref_id_menu, ref_id_sub_menu, name_machine, detail_machine, mc_adddate, ref_id_user_add, mc_editdate, ref_id_user_edit, status_machine
        $rowID = $_POST['id_row'];
        $_POST['name_machine'] = trim($_POST['name_machine']);
        $_POST['model_name'] = trim($_POST['model_name']);        
        !empty($_POST['id_row']) ? $query_id = " AND id_machine!=".$_POST["id_row"]."" : $query_id = "";

        $totalRow = $obj->getCount("SELECT count(id_machine) AS total_row FROM tb_machine_master WHERE (machine_code = '".(trim($_POST['machine_code']))."' OR name_machine='".(trim($_POST['name_machine']))."') ".$query_id."");

        $countCode = 0;
        $_POST['machine_code'] = str_replace("-0000", "", $_POST['machine_code']);
        ##หารหัสเครื่องจักรล่าสุดของหมวดนั้นๆ (ORDER BY DESC เช่น MT-AS-0002) จากนั้นเอามาตัดเอาตัวเลข 4 ตัวท้าย strip 0 ออกจากนั้นเอาไป+1
        $countCode = $obj->customSelect("SELECT machine_code FROM tb_machine_master WHERE LEFT(machine_code, ".strlen($_POST['machine_code']).")='".$_POST['machine_code']."' ORDER BY machine_code DESC LIMIT 1");
        $machine_code =  $_POST['machine_code'].'-'.str_pad(intval(substr($countCode['machine_code'],  -4)+1), 4, 0, STR_PAD_LEFT);

        if($totalRow!=0){ ##ถ้า $totalRow ไม่เท่ากับ 0 แสดงว่ามีในระบบแล้ว
            echo json_encode(1);
            exit();
        }else{ ##ถ้าไม่มีจะทำการเช็คว่ามี $rowID ที่ส่งมาจากฟอร์มหรือไม่ (ถ้่ามีคือการ update) ถ้าไม่มีคือ insert
            if(empty($rowID)){
                //echo 'new add-'.$machine_code; exit();
                $insertRow = [
                    'machine_code' => (!empty($machine_code)) ? $machine_code : "Not found.",
                    'ref_id_dept' => (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : NULL,
                    'ref_id_menu' => (!empty($_POST['ref_id_menu'])) ? $_POST['ref_id_menu'] : NULL,
                    'ref_id_sub_menu' => (!empty($_POST['ref_id_sub_menu'])) ? $_POST['ref_id_sub_menu'] : NULL,
                    'model_name' => (!empty($_POST['model_name'])) ? $_POST['model_name'] : NULL,
                    'name_machine' => (!empty($_POST['name_machine'])) ? $_POST['name_machine'] : NULL,
                    'detail_machine' => (!empty($_POST['detail_machine'])) ? $_POST['detail_machine'] : NULL,
                    'mc_adddate' => date('Y-m-d H:i:s'),
                    'ref_id_user_add' => $_SESSION['sess_id_user'],
                    'mc_editdate' => NULL,
                    'ref_id_user_edit' => NULL,
                    'status_machine' => (!empty($_POST['status_machine'])) ? $_POST['status_machine'] : NULL,
                ];
                $rowID = $obj->addRow($insertRow, "tb_machine_master");
            }else{
                //echo 2;  exit; //Update Data
                if($_POST['chk_ref_id_dept']!=$_POST['ref_id_dept']){
                    //echo 'edit row and edit cate-'.$machine_code; exit();
                    //echo $machine_code; exit();
                    $insertRow_mc_code = [ 'machine_code' => (!empty($machine_code)) ? $machine_code : "Not found.",];
                }else{
                    $insertRow_mc_code = [];
                }
                //echo 'edit row only'; exit();
                $insertRow = [
                    'ref_id_dept' => (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : NULL,
                    'ref_id_menu' => (!empty($_POST['ref_id_menu'])) ? $_POST['ref_id_menu'] : NULL,
                    'ref_id_sub_menu' => (!empty($_POST['ref_id_sub_menu'])) ? $_POST['ref_id_sub_menu'] : NULL,
                    'model_name' => (!empty($_POST['model_name'])) ? $_POST['model_name'] : NULL,
                    'name_machine' => (!empty($_POST['name_machine'])) ? $_POST['name_machine'] : NULL,
                    'detail_machine' => (!empty($_POST['detail_machine'])) ? $_POST['detail_machine'] : NULL,
                    'mc_editdate' => date('Y-m-d H:i:s'),
                    'ref_id_user_edit' => $_SESSION['sess_id_user'],
                    'status_machine' => (!empty($_POST['status_machine'])) ? $_POST['status_machine'] : NULL,
                ];
                $insertRow = array_merge($insertRow, $insertRow_mc_code);

                /*echo $_POST['ref_id_dept'].'-----------'.$_POST['ref_id_menu'];
                echo '-----------';
                echo $insertRow['ref_id_dept'].'----'.$insertRow['ref_id_menu'];
                exit();*/
            
                $rowID = $obj->update($insertRow, "id_machine=".$rowID."", "tb_machine_master");
            }

            $imagename = '';
            //id_attachment, ref_id_used, attachment_sort, attachment_name, attachment_type
            if (!empty($_FILES['photo']['name'])){ ##ถ้ามีแนบไฟล์รูปมาให้อัพโหลดรูปก่อน
                $imagename = $obj->uploadPhoto($_FILES['photo'], $path_machine);
                $insertPhoto = [
                    'ref_id_used' => $rowID,
                    'attachment_sort' => null,
                    'path_attachment_name' => $imagename,
                    'attachment_type' => 1,
                    'image_cate' => 2
                ];    
                $rowID = $obj->addRow($insertPhoto, "tb_attachment");        
            }
            echo json_encode($rowID);
            exit();
        }
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

    if ($action=="view") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT tb_machine_master.*, tb_attachment.path_attachment_name, userAdd.fullname AS userAdd_name,
            userEdit.fullname AS userEdit_name, mainCate.name_menu AS mainCate_name, subCate.name_menu AS subCate_name , tb_dept.dept_initialname, tb_dept.dept_name 
            FROM tb_machine_master 
            LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_machine_master.id_machine AND tb_attachment.attachment_type=1) 
            LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_machine_master.ref_id_dept) 
            LEFT JOIN tb_category AS mainCate ON (tb_machine_master.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_machine_master.ref_id_sub_menu=subCate.id_menu) 
            LEFT JOIN tb_user AS userAdd ON (userAdd.id_user=tb_machine_master.ref_id_user_add) 
            LEFT JOIN tb_user AS userEdit ON (userEdit.id_user=tb_machine_master.ref_id_user_edit) 
            WHERE tb_machine_master.id_machine=".$rowID."");

            $rowData['path_attachment_name']==NULL ? $rowData['path_attachment_name'] = $path_machine_Default : $rowData['path_attachment_name'] = $path_machine.$rowData['path_attachment_name'];
            $rowData['userEdit_name'] = ''.($rowData['userEdit_name']==NULL ? ' - ' : $rowData['userEdit_name']).' วันที่: '.($rowData['mc_editdate']==NULL ? '-' : nowDateShort($rowData['mc_editdate'])).' เวลา: '.($rowData['mc_editdate']==NULL ? '-' : nowTime($rowData['mc_editdate'])).' น.';
            $rowData['userAdd_name'] = ''.($rowData['userAdd_name']==NULL ? ' - ' : $rowData['userAdd_name']).' วันที่: '.($rowData['mc_adddate']==NULL ? '-' : nowDateShort($rowData['mc_adddate'])).' เวลา: '.($rowData['mc_adddate']==NULL ? '-' : nowTime($rowData['mc_adddate'])).' น.';            
            $rowData['view'] = '<tr>
            <td rowspan="9" class="col-sm-4 col-md-4 col-xs-4 text-center"><img src="'.$rowData['path_attachment_name'].'" class="w-100 p-2" /></td>
            <td class="text-bold p-0 m-0 text-right col-sm-3 col-md-3 col-xs-3">สถานะการใช้งาน:</td><td class="col-sm-6 col-md-6 col-xs-6">'.($rowData['status_machine']!=NULL ? $rowData['status_machine'] = $statusArr[$rowData['status_machine']] : $rowData['status_machine']='-').'</td></tr>
        </tr>
        <tr><td class="text-bold p-0 m-0 text-right col-sm-3 col-md-3 col-xs-3 p-0 m-0">แผนกที่รับผิดชอบ:</td><td class="col-sm-6 col-md-6 col-xs-6">'.($rowData['dept_initialname']!=NULL ? $rowData['dept_initialname'].' - '.$rowData['dept_name'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right ">รหัสเครื่องจักร-อุปกรณ์:</td><td class="col-sm-5 col-md-5 col-xs-5">'.($rowData['machine_code']!=NULL ? $rowData['machine_code'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">ชื่อรุ่น (Model):</td><td>'.($rowData['model_name']!=NULL ? $rowData['model_name'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">ชื่อเครื่องจักร-อุปกรณ์:</td><td>'.($rowData['name_machine']!=NULL ? $rowData['name_machine'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">หมวดหลัก:</td><td>'.($rowData['mainCate_name']!=NULL ? $rowData['mainCate_name'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">หมวดย่อย:</td><td>'.($rowData['subCate_name']!=NULL ? $rowData['subCate_name'] : '-').'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">เพิ่มข้อมูลโดย:</td><td>'.($rowData['userAdd_name']).'</td></tr>
        <tr><td class="text-bold p-0 m-0 text-right">แก้ไขล่าสุดโดย:</td><td>'.($rowData['userEdit_name']).'</td></tr>
        <tr><td colspan="3" class="col-sm-12 col-md-12 col-xs-12 text-bold text-left">รายละเอียดเครื่องจักร-อุปกรณ์:</td></tr>
        <tr><td colspan="3"><p>'.(nl2br($rowData['detail_machine'])).'</p></td></tr>';
            echo json_encode($rowData);
            exit();
        }
    }


    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT tb_machine_master.*, tb_attachment.path_attachment_name, tb_user.fullname FROM tb_machine_master 
            LEFT JOIN tb_attachment ON (tb_attachment.ref_id_used=tb_machine_master.id_machine) 
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
            $rowData['fullname'] = 'แก้ไขล่าสุดโดย:'.($rowData['fullname']==NULL ? ' - ' : $rowData['fullname']).' วันที่: '.($rowData['mc_editdate']==NULL ? '-' : nowDateShort($rowData['mc_editdate'])).' เวลา: '.($rowData['mc_editdate']==NULL ? '-' : nowTime($rowData['mc_editdate'])).' น.';
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

?>