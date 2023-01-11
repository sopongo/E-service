<?PHP
    session_start();

    require_once '../../include/query_class.inc.php';

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }


    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action == 'add_offsupp' && !empty($_POST)) {
         ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['slt_id_offsupps'])) ? $_POST['slt_id_offsupps'] : '';

        $numRow = $obj->getCount("SELECT count(id_offsupp_location) AS total_row FROM tb_offsupp_location WHERE ref_id_offsupp=".$rowID." AND ref_id_location=".$_POST['ref_id_location']." ");
        if($numRow!=0){
            echo json_encode('DuplicateRows');
            exit();        
        }
        /*id_offsupp_location, ref_id_offsupp, ref_id_location, total_balance, status_use_offsupp, ref_id_user_add, ref_adddate*/
        $insertRow = [
            'ref_id_location' => ((!empty($_POST['ref_id_location'])) ? $_POST['ref_id_location'] : ''),
            'ref_id_offsupp' => ((!empty($_POST['slt_id_offsupps'])) ? $_POST['slt_id_offsupps'] : ''),                                                
            'total_balance' => 0,
            'status_use_offsupp' =>  ((!empty($_POST['status_use'])) ? $_POST['status_use'] : ''),
            'ref_id_user_add' => $_SESSION['sess_id_user'],
            'ref_adddate' => date('Y-m-d H:i:s')
        ];   
        $rowID = $obj->addRow($insertRow, "tb_offsupp_location");
        echo json_encode($rowID);
        exit();
    }
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;
        $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.id_offsupp_location, tb_office_supplies.ref_id_menu, tb_office_supplies.ref_id_menu_sub, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
        tb_offsupp_location.status_use_offsupp, tb_offsupp_location.total_balance, tb_location.location_short, tb_location.location_name,mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
        tb_office_supplies_photo.photo_name, tb_unit.unit_name
                FROM tb_offsupp_location
                LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp) 
                LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp =tb_office_supplies.id_offsupp)
                LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
                LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
                LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location)       
                LEFT JOIN tb_unit ON (tb_unit.id_unit=tb_office_supplies.ref_id_unit) $class_query ORDER BY tb_offsupp_location.id_offsupp_location DESC LIMIT $start, $limit");
                /*GROUP BY tb_offsupp_location.ref_id_offsupp */
        if (!empty($fetchRow)) {
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(id_offsupp_location) AS total_row FROM tb_offsupp_location $class_query");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();
    }

    
    if ($action == "getData") {
        $id_offsupp_location = (!empty($_GET['ref_id_offsupp_location'])) ? $_GET['ref_id_offsupp_location'] : '';
        if (!empty($id_offsupp_location)){

            $fetchRow = $obj->customSelect("SELECT tb_offsupp_location.id_offsupp_location, tb_office_supplies.ref_id_menu, tb_office_supplies.ref_id_menu_sub, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
            tb_office_supplies.moq, tb_office_supplies.min_stock, tb_office_supplies.leadtime, tb_office_supplies.offsupp_status, tb_offsupp_location.status_use_offsupp, tb_offsupp_location.total_balance, 
            tb_location.location_name,mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
            tb_office_supplies_photo.photo_name, tb_unit.unit_name
            FROM tb_offsupp_location
            LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp) 
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp =tb_office_supplies.id_offsupp)
            LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
            LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location)       
            LEFT JOIN tb_unit ON (tb_unit.id_unit=tb_office_supplies.ref_id_unit) WHERE tb_offsupp_location.id_offsupp_location=$id_offsupp_location");

            if($fetchRow!=''){//tb_inven_balance        ref_id_rcv
                $fetchLot = $obj->fetchRows("SELECT tb_inven_balance.*, tb_inven_rcv.* FROM tb_inven_balance 
                LEFT JOIN tb_inven_rcv ON(tb_inven_rcv.id_rcv=tb_inven_balance.ref_id_rcv)
                WHERE tb_inven_balance.ref_id_offsupp_location=$id_offsupp_location AND tb_inven_balance.total_balance!=0 ORDER BY tb_inven_rcv.rcv_date ASC");
            }


            $rowArr = ['lot' => $fetchLot, 'row' => $fetchRow];
            echo json_encode($rowArr);
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

        $_SESSION['sess_class_user']==1 ? $condition_query_location = 'tb_offsupp_location.ref_id_location='.$_SESSION['sess_id_location'].' AND' : $condition_query_location ='';
        $_SESSION['sess_class_user']==1 ? $condition_query_status = 'AND status_use_offsupp=1' : $condition_query_status='';       

        if (!empty($searchText)){
            $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.id_offsupp_location, tb_office_supplies.ref_id_menu, tb_office_supplies.ref_id_menu_sub, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
            tb_offsupp_location.status_use_offsupp, tb_offsupp_location.total_balance, tb_location.location_short, tb_location.location_name,mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
            tb_office_supplies_photo.photo_name, tb_unit.unit_name
            FROM tb_offsupp_location
            LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp) 
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp =tb_office_supplies.id_offsupp)
            LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
            LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location)       
            LEFT JOIN tb_unit ON (tb_unit.id_unit=tb_office_supplies.ref_id_unit) 
            WHERE ".$condition_query_location." tb_office_supplies.offsupp_name LIKE '%".$searchText."%'".$condition_query_status.";");

            $rowArr = "";
            $rowArr = ['rowcount' => count($fetchRow), 'row' => $fetchRow];

            echo json_encode($rowArr);
            exit();
        }
    }

    if ($action == "getsubmenu") {
        $ref_id_menu = (!empty($_GET['ref_id_menu'])) ? $_GET['ref_id_menu'] : '';
        if (!empty($ref_id_menu)) {
            $results = $obj->fetchRows("SELECT * FROM tb_category WHERE level_menu=2 AND ref_id_menu=$ref_id_menu");
            $results_offsupp = $obj->fetchRows("SELECT tb_office_supplies.*, tb_office_supplies_photo.* FROM tb_office_supplies 
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
            WHERE tb_office_supplies.ref_id_menu=$ref_id_menu AND tb_office_supplies.offsupp_status=1 ORDER BY tb_office_supplies_photo.id_photo" );
            /*foreach($results as $row){
                $xxx.=$row[0];

            }*/
            //echo json_encode($results_offsupp); exit();
            $rowArr = ['sub' => $results, 'offsupp' => $results_offsupp];
            echo json_encode($rowArr);
            exit();
        }
    }    


?>