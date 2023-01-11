<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once '../../include/function.inc.php';

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
       
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action=='addMenu' && !empty($_POST)) {      
        ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        /*id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, name_menu, desc_menu, menu_adddate, addmenu_ref_idmem, 
        menu_editdate, editmenu_ref_idmem, status_menu*/
        $rowID = (!empty($_POST['id_menu'])) ? $_POST['id_menu'] : '';

        /*echo json_encode("xxxxx");
        exit();*/

        if(empty($rowID)){
            /*id_menu, menu_code, level_menu, sort_menu, ref_id_menu, ref_id_sub, name_menu, desc_menu, menu_adddate,
            addmenu_ref_idmem, menu_editdate, editmenu_ref_idmem, status_menu*/

            $insertRow = [
            'menu_code' => (!empty($_POST['menu_code'])) ? $_POST['menu_code'] : null,
            'level_menu' => (!empty($_POST['level_menu'])) ? $_POST['level_menu'] : null,
            'sort_menu' => 0,
            'ref_id_menu' => (!empty($_POST['ref_id_menu'])) ? $_POST['ref_id_menu'] : 0,
            'ref_id_sub' => (!empty($_POST['ref_id_sub'])) ? $_POST['ref_id_sub'] : 0,
            'name_menu' => (!empty($_POST['name_menu'])) ? $_POST['name_menu'] : '',
            'desc_menu' => (!empty($_POST['desc_menu'])) ? $_POST['desc_menu'] : null,
            'menu_adddate' => date('Y-m-d H:i:s'),
            'addmenu_ref_idmem' => $_SESSION['sess_id_user'],
            'menu_editdate' => null,
            'editmenu_ref_idmem' => null,
            'status_menu' => (!empty($_POST['status_menu'])) ? $_POST['status_menu'] : 0,
            ];
            $rowID = $obj->addRow($insertRow, "tb_category");
        }else{
            $insertRow = [
                'level_menu' => (!empty($_POST['level_menu'])) ? $_POST['level_menu'] : '',
                'ref_id_menu' => (!empty($_POST['ref_id_menu'])) ? $_POST['ref_id_menu'] : 0,
                'name_menu' => (!empty($_POST['name_menu'])) ? $_POST['name_menu'] : '',
                'desc_menu' => (!empty($_POST['desc_menu'])) ? $_POST['desc_menu'] :null,
                'menu_editdate' => date('Y-m-d H:i:s'),
                'editmenu_ref_idmem' => $_SESSION['sess_id_user'],
                'status_menu' => (!empty($_POST['status_menu'])) ? $_POST['status_menu'] : ''
            ];
            $obj->update($insertRow, "id_menu=".$rowID."", "tb_category");
        }
        
        echo json_encode($rowID);
        exit();
    }
    
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;
        $fetchRow = $obj->getRows("*", "tb_category", "id_menu DESC", $start, $limit);
        if (!empty($fetchRow)) {
            foreach($fetchRow as $key=>$value) {##แปลงค่า class_user โดยอ้างอิงจากอาร์เรย์ $classUserArr รวมถึงค่าต่างที่อ้างอิงด้วยอาร์เรย์
                $fetchRow[$key]['status_menu'] = $statusArr[$fetchRow[$key]['status_menu']];
                $fetchRow[$key]['level_menu'] = $menuTypeArr[$fetchRow[$key]['level_menu']];
                $fetchRow[$key]['menu_adddate'] == '0000-00-00 00:00:00' ? $fetchRow[$key]['menu_adddate'] = 'ไม่พบข้อมูล' : $fetchRow[$key]['menu_adddate'] = nowDate($fetchRow[$key]['menu_adddate']);
            }
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category");
        $rowArr = ['count' => $total, 'user' => $dataList];
        echo json_encode($rowArr);
        exit();
    }


    if ($action == "getuser") {
        $rowID = (!empty($_GET['id_row'])) ? $_GET['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT tb_user_add.fullname AS add_fullname, tb_user_edit.fullname AS edit_fullname, tb_category_main.name_menu AS main_name, tb_category.* 
            FROM tb_category 
            LEFT JOIN tb_user AS tb_user_add ON (tb_category.addmenu_ref_idmem= tb_user_add.id_user) 
            LEFT JOIN tb_user AS tb_user_edit ON (tb_category.editmenu_ref_idmem= tb_user_edit.id_user) 
            LEFT JOIN tb_category AS tb_category_main ON (tb_category.ref_id_menu= tb_category_main.id_menu) 
            WHERE tb_category.id_menu=".$rowID."");

            /*if($rowData['level_menu']==2){ ##ถ้า level_menu==2 คือหมวดย่อย เลยต้องดึงข้อมูลขื่อหมวดหลักมาแสดงด้วย
                $rowData_mainCate = $obj->getRow('name_menu', 'id_menu', $rowData['ref_id_menu'], 'tb_category');
                $rowData['mainCate'] = $rowData_mainCate['name_menu'];
            }else{
                $rowData['mainCate'] = "-";
            }
            */
            $rowData['level_menu'] = $menuTypeArr[$rowData['level_menu']]; #แปลงเลขอ้างอิงหมวดจากอาร์เรย์ menuTypeArr ไฟล์ setting.inc.php
            $rowData['menu_adddate'] == '0000-00-00 00:00:00' ? $rowData['menu_adddate'] = '-' : $rowData['menu_adddate'] = nowDate($rowData['menu_adddate']).' เวลา&nbsp;'.nowTime($rowData['menu_adddate']).'&nbsp; น.';
            $rowData['menu_editdate'] == '0000-00-00 00:00:00' ? $rowData['menu_editdate'] = '-' : $rowData['menu_editdate'] = nowDate($rowData['menu_editdate']).' เวลา&nbsp;'.nowTime($rowData['menu_editdate']).'&nbsp; น.';
            echo json_encode($rowData);
            exit();
        }
    }
    
    if ($action == "deleteuser") {
        $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
        if (!empty($playerId)) {
            $isDeleted = $obj->deleteRow($playerId);
            if ($isDeleted) {
                $message = ['deleted' => 1];
            } else {
                $message = ['deleted' => 0];
            }
            echo json_encode($message);
            exit();
        }
    }
    
    if ($action == 'search') {
        $searchText = (!empty($_GET['searchText'])) ? trim($_GET['searchText']) : '';
        $conditionSearch = "email LIKE :search";
        $results = $obj->searchRow($searchText, $conditionSearch, "tb_user", "id_user DESC");
        echo json_encode($results);
        exit();
    }
        

?>