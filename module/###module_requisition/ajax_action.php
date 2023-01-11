<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/query_class.inc.php');

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
       
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action=='addData' && !empty($_POST)) {      
        ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['id_location'])) ? $_POST['id_location'] : '';
        if(empty($rowID)){
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : '',
                'status_location' => (!empty($_POST['status_location'])) ? $_POST['status_location'] : ''
            ];
            $rowID = $obj->addRow($insertRow, "tb_location");
        }else{
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : '',
                'status_location' => (!empty($_POST['status_location'])) ? $_POST['status_location'] : ''
            ];
            $obj->update($insertRow, "id_location =".$rowID."", "tb_location");
        }
            echo json_encode($rowID);
            exit();
    }
    
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;


        /*if(isset($_GET['ref_id_menu']) && $_GET['ref_id_menu']==0){
            ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4) ? 
            $query_cate = " WHERE tb_office_supplies.ref_id_menu!=".$_GET['ref_id_menu']."" : $query_cate = " AND tb_office_supplies.ref_id_menu!=".$_GET['ref_id_menu']."";
        }else{
            ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4) ? 
            $query_cate = " WHERE tb_office_supplies.ref_id_menu=".$_GET['ref_id_menu']."" : $query_cate = " AND tb_office_supplies.ref_id_menu=".$_GET['ref_id_menu']."";
        }
        */

        if(isset($_GET['ref_id_menu_sub']) && $_GET['ref_id_menu_sub']==0){
            ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4) ? 
            $query_subCate = " WHERE tb_office_supplies.ref_id_menu_sub!=".$_GET['ref_id_menu_sub']."" : $query_subCate = " AND tb_office_supplies.ref_id_menu_sub!=".$_GET['ref_id_menu_sub']."";
        }else{
            ($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4) ? 
            $query_subCate = " WHERE tb_office_supplies.ref_id_menu_sub=".$_GET['ref_id_menu_sub']."" : $query_subCate = " AND tb_office_supplies.ref_id_menu_sub=".$_GET['ref_id_menu_sub']."";
        }

        if(isset($_GET['slt_location']) && $_GET['slt_location']!=0){
            $query_location = " WHERE tb_offsupp_location.ref_id_location=".$_GET['slt_location']." ";
        }
      
        
        /*echo json_encode("SELECT tb_offsupp_location.*, tb_office_supplies.id_offsupp, 
        tb_office_supplies.ref_id_menu, tb_office_supplies.ref_id_menu_sub, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, tb_office_supplies.ref_id_unit,
        tb_office_supplies.offsupp_detail,tb_office_supplies.max_req, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, 
        tb_office_supplies_photo.photo_name, tb_unit.unit_name, tb_location.location_short, 
        (SELECT SUM(quantity) FROM tb_requisition_detail WHERE tb_requisition_detail.id_offsupp_location=tb_offsupp_location.id_offsupp_location AND tb_requisition_detail.requisition_result=1) AS wait_pay
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location) $query_location ORDER BY tb_office_supplies.id_offsupp DESC, tb_office_supplies_photo.ref_id_offsupp ASC LIMIT $start, $limit");
        exit();*/

        $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.*, tb_office_supplies.id_offsupp, 
        tb_office_supplies.ref_id_menu, tb_office_supplies.ref_id_menu_sub, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, tb_office_supplies.ref_id_unit,
        tb_office_supplies.offsupp_detail,tb_office_supplies.max_req, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, 
        tb_office_supplies_photo.photo_name, tb_unit.unit_name, tb_location.location_short, 
        (SELECT SUM(quantity) FROM tb_requisition_detail WHERE tb_requisition_detail.id_offsupp_location=tb_offsupp_location.id_offsupp_location AND tb_requisition_detail.requisition_result=1) AS wait_pay
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location) $query_location ORDER BY tb_office_supplies.id_offsupp DESC, tb_office_supplies_photo.ref_id_offsupp ASC LIMIT $start, $limit");

        //$countRow = count($fetchRow);

        if (!empty($fetchRow)) {
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(ref_id_location) AS total_row FROM tb_offsupp_location $class_query");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();
        /*-------------------------------------------------*/
    }


    if ($action == "getuser") {
        $rowID = (!empty($_GET['id_row'])) ? $_GET['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_location WHERE tb_location.id_location=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }
    
    if ($action == "deleterow") {       
        $rowId = (!empty($_GET['id'])) ? $_GET['id'] : '';
        if (!empty($rowId)) {
            $isDeleted = $obj->deleteRow($rowId, "tb_location", "id_location=$rowId");
            if ($isDeleted) {
                $message = ['deleted' => 1];
            } else {
                $message = ['deleted' => 0];
            }
            echo json_encode(1);
            exit();
        }
    }
    
    if ($action == 'search') {
        $searchinput = (!empty($_GET['searchinput'])) ? trim($_GET['searchinput']) : '';


        echo json_encode($searchinput);
        exit;


        echo json_encode("SELECT tb_offsupp_location.*, tb_office_supplies.*, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, 
        tb_office_supplies_photo.photo_name, tb_unit.unit_name, tb_location.location_short
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location) ORDER BY tb_office_supplies.id_offsupp DESC, tb_office_supplies_photo.ref_id_offsupp ASC");
        exit;


        $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.*, tb_office_supplies.*, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, 
        tb_office_supplies_photo.photo_name, tb_unit.unit_name, tb_location.location_short
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
        LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
        LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
        LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
        LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location)
        $class_query ORDER BY tb_office_supplies.id_offsupp DESC, tb_office_supplies_photo.ref_id_offsupp ASC
        LIMIT $start, $limit");

        if (!empty($fetchRow)) {
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(ref_id_location) AS total_row FROM tb_offsupp_location $class_query");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();        
    }
        

?>