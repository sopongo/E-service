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
    if ($action=='addData' && !empty($_POST)) {      
        ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['id_location'])) ? $_POST['id_location'] : '';
        if(empty($rowID)){
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : null,
                'status_location' => (!empty($_POST['status_location'])) ? $_POST['status_location'] : ''
            ];
            $rowID = $obj->addRow($insertRow, "tb_location");
        }else{
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : null,
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
        $fetchRow = $obj->getRows("*", "tb_location", "id_location DESC", $start, $limit);
        if (!empty($fetchRow)) {
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }

        $total = $obj->getCount("SELECT count(id_location) AS total_row FROM tb_location");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();
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
        $searchText = (!empty($_GET['searchText'])) ? trim($_GET['searchText']) : '';
        $conditionSearch = "location_name LIKE :search";
        $results = $obj->searchRow($searchText, $conditionSearch, "tb_location", "location_name DESC");
        $rowArr = ['count' => '0', 'row' => $results];
        echo json_encode($rowArr);
        //echo json_encode($results);
        exit();
    }
        

?>