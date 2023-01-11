<?PHP
    session_start();
    
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }





    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action == 'add_offsupp' && !empty($_POST)) {
         ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['userid'])) ? $_POST['userid'] : '';

        //id_offsupp  ref_id_branch   ref_id_menu ref_id_menu_sub     offsupp_code    offsupp_name    ref_id_unit offsupp_detail    
        //offsupp_status  total_balance   moqmin_stock
        //leadtime    ref_iduser_add	offsupp_adddate	 ref_iduser_edit    offsupp_editdate
        
        $imagename = '';
        #สร้างรหัสวัสดุ
        $offsupp_code = str_replace("-???","",$_POST['txt_offsupp_code']);
        $countCode = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies WHERE LEFT(offsupp_code,6)='".$offsupp_code."' ");
        $countCode =$countCode+1;
        $countCode = str_pad($countCode, 4, '0', STR_PAD_LEFT);
        $offsupp_code = $offsupp_code.'-'.$countCode;

        $insertRow = [
            'ref_id_branch' => ((!empty($_POST['txt_ref_id_branch'])) ? $_POST['txt_ref_id_branch'] : ''),
            'ref_id_menu' => ((!empty($_POST['txt_ref_id_menu'])) ? $_POST['txt_ref_id_menu'] : ''),
            'ref_id_menu_sub' => ((!empty($_POST['txt_ref_id_menu_sub'])) ? $_POST['txt_ref_id_menu_sub'] : ''),
            'offsupp_name' => ((!empty($_POST['txt_offsupp_name'])) ? $_POST['txt_offsupp_name'] : ''),
            'ref_id_unit' => ((!empty($_POST['txt_ref_id_unit'])) ? $_POST['txt_ref_id_unit'] : ''),
            'offsupp_detail' => ((!empty($_POST['txt_offsupp_detail'])) ? $_POST['txt_offsupp_detail'] : ''),
            'offsupp_status' => ((!empty($_POST['status_offsupp'])) ? $_POST['status_offsupp'] : ''),
            'total_balance' => 0,
            'leadtime' => ((!empty($_POST['txt_leadtime'])) ? $_POST['txt_leadtime'] : ''),
            'moq' => ((!empty($_POST['txt_moq'])) ? $_POST['txt_moq'] : ''),
            'min_stock' => ((!empty($_POST['txt_min_stock'])) ? $_POST['txt_min_stock'] : ''),
            'offsupp_code' => $offsupp_code,
            'ref_iduser_add' => $_SESSION['sess_id_user'],
            'offsupp_adddate' => date('Y-m-d H:i:s')
        ];   

        //echo json_encode($offsupp_code.'-----------'.$offsupp_code);
        //exit();

        $rowID = $obj->addRow($insertRow, "tb_office_supplies");
        echo json_encode($rowID);
        exit();
    }
    
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;
        //$fetchRow = $obj->getRows("id_offsupp, ref_id_branch, offsupp_code, offsupp_name, ref_id_menu, ref_id_menu_sub, offsupp_status, total_balance, ref_id_unit", "tb_office_supplies", "id_offsupp DESC", $start, $limit);
// AND tb_office_supplies.ref_id_menu_sub=mainCate.ref_id_menu
        $fetchRow = $obj->fetchRows("SELECT tb_office_supplies.id_offsupp, tb_location.location_name, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
        tb_office_supplies.offsupp_status, tb_office_supplies.total_balance, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
        tb_office_supplies_photo.photo_name
        FROM tb_office_supplies
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_office_supplies.ref_id_branch)
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) GROUP BY tb_office_supplies.id_offsupp ORDER BY tb_office_supplies.id_offsupp DESC LIMIT $start, $limit");      
        
        if (!empty($fetchRow)) {
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();
    }


    
    if ($action == "getuser") {
        $userID = (!empty($_GET['id_user'])) ? $_GET['id_user'] : '';
        if (!empty($userID)) {
            $user = $obj->getRow('*', 'id_user', $userID, 'tb_user');
            echo json_encode($user);
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

    if ($action == "getsubmenu") {
        $idMenu = (!empty($_GET['id_menu'])) ? $_GET['id_menu'] : '';
        //echo json_encode($idMenu); exit();        
        if (!empty($idMenu)) {
            $results = $obj->fetchRows("SELECT * FROM tb_category WHERE level_menu=2 AND ref_id_menu=$idMenu");
            /*foreach($results as $row){
                $xxx.=$row[0];
            }*/
            echo json_encode($results);
        }
    }    


?>