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

        //id_offsupp    ref_id_menu ref_id_menu_sub     offsupp_code    offsupp_name    ref_id_unit offsupp_detail    
        //offsupp_status    moqmin_stock
        //leadtime    ref_iduser_add	offsupp_adddate	 ref_iduser_edit    offsupp_editdate
        
        $imagename = '';
        #สร้างรหัสวัสดุ
        $offsupp_code = str_replace("-???","",$_POST['txt_offsupp_code']);
        $countCode = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies WHERE LEFT(offsupp_code,6)='".$offsupp_code."' ");
        $countCode =$countCode+1;
        $countCode = str_pad($countCode, 4, '0', STR_PAD_LEFT);
        $offsupp_code = $offsupp_code.'-'.$countCode;

        echo json_encode($offsupp_code);
        exit();

        //id_offsupp, ref_id_menu, ref_id_menu_sub, offsupp_code, offsupp_name, ref_id_unit, offsupp_detail, offsupp_status, moq, min_stock, leadtime, 
        //ref_iduser_add, offsupp_adddate, ref_iduser_edit, offsupp_editdate
        $insertRow = [
            'ref_id_menu' => ((!empty($_POST['txt_ref_id_menu'])) ? $_POST['txt_ref_id_menu'] : ''),
            'ref_id_menu_sub' => ((!empty($_POST['txt_ref_id_menu_sub'])) ? $_POST['txt_ref_id_menu_sub'] : null),
            'offsupp_code' => $offsupp_code,
            'offsupp_name' => ((!empty($_POST['txt_offsupp_name'])) ? $_POST['txt_offsupp_name'] : ''),
            'ref_id_unit' => ((!empty($_POST['txt_ref_id_unit'])) ? $_POST['txt_ref_id_unit'] : ''),
            'offsupp_detail' => ((!empty($_POST['txt_offsupp_detail'])) ? $_POST['txt_offsupp_detail'] : null),
            'offsupp_status' => ((!empty($_POST['status_offsupp'])) ? $_POST['status_offsupp'] : ''),
            'moq' => ((!empty($_POST['txt_moq'])) ? $_POST['txt_moq'] : null),
            'min_stock' => ((!empty($_POST['txt_min_stock'])) ? $_POST['txt_min_stock'] : null),
            'max_req' => ((!empty($_POST['max_req'])) ? $_POST['max_req'] : null),
            'leadtime' => ((!empty($_POST['txt_leadtime'])) ? $_POST['txt_leadtime'] : null),            
            'ref_iduser_add' => $_SESSION['sess_id_user'],
            'offsupp_adddate' => date('Y-m-d H:i:s'),
            'ref_iduser_edit' => null,
            'offsupp_editdate' => null
        ];   
        //echo json_encode($offsupp_code.'-----------'.$offsupp_code);
        //exit();

        $rowID = $obj->addRow($insertRow, "tb_office_supplies");

        
        $photo = $_FILES['photo'];
        //file (photo) upload
        $imagename = '';
        //id_photo, sort_photo, ref_id_offsupp, photo_name
        if (!empty($photo['name'])){ ##ถ้ามีแนบไฟล์รูปมาให้อัพโหลดรูปก่อน
            $imagename = $obj->uploadPhotoOffsupp($photo);
            $insertPhoto = [
                'sort_photo' => null,
                'ref_id_offsupp' => ($rowID),
                'photo_name' => $imagename
            ];    
            $rowID = $obj->addRow($insertPhoto, "tb_office_supplies_photo");        
        }
        
            echo json_encode($rowID);
            exit();
    }
    
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;

        $fetchRow = $obj->fetchRows("SELECT tb_office_supplies.id_offsupp, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
        tb_office_supplies.offsupp_status, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
        tb_office_supplies_photo.photo_name
        FROM tb_office_supplies
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
        ORDER BY tb_office_supplies.id_offsupp DESC LIMIT $start, $limit");
        /*GROUP BY tb_office_supplies.id_offsupp */
        
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

    
    if ($action == "get_offsupp") {
        $id_offsupp = (!empty($_GET['id_offsupp'])) ? $_GET['id_offsupp'] : '';
        if (!empty($id_offsupp)) {
            $offsupp = $obj->customSelect("SELECT tb_office_supplies.*, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name,
            tb_office_supplies_photo.photo_name
            FROM tb_office_supplies
            LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
            LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
            WHERE tb_office_supplies.id_offsupp=".$id_offsupp." ORDER BY tb_office_supplies_photo.id_photo ASC LIMIT 1;");
            echo json_encode($offsupp);
            
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