<?PHP
    session_start();
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        require_once '../../include/setting.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    ##แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า profile.inc.php
    if ($action=='edituser') {

        $Row = $obj->customSelect("SELECT * FROM tb_user WHERE id_user=".$_SESSION['sess_id_user']." ORDER BY id_user DESC");
               
        $no_user = (!empty($_POST['no_user'])) ? $_POST['no_user'] : '';
        $password = (!empty($_POST['password'])) ? sha1($keygen.$_POST['password']) : '';
        $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
        //$line_token = (!empty($_POST['line_token'])) ? $_POST['line_token'] : null;
        $fullname = (!empty($_POST['fullname'])) ? $_POST['fullname'] : '';
        //$sex = (!empty($_POST['sex'])) ? $_POST['sex'] : null;
        $phone = (!empty($_POST['phone'])) ? $_POST['phone'] : null;
        $ref_id_location = (!empty($_POST['ref_id_location'])) ? $_POST['ref_id_location'] : '';
        $ref_dept = (!empty($_POST['ref_dept'])) ? $_POST['ref_dept'] : '';
        $photo = $_FILES['photo'];
                
        /*id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_location, ref_dept, status_user, create_date, lass_login, last_ip*/
        $imagename = '';
        if (!empty($photo['name'])){ ##ถ้ามีแบบไฟล์รูปมาให้อัพโหลดรูปก่อน
            $imagename = $obj->uploadPhoto($photo,$pathUser);
            
            $updateRow = [
                'no_user' => $no_user,              
                'email' => $email,
                'fullname' => $fullname,
                'phone' => $phone,
                'photo' => $imagename,
                'ref_id_location' => $ref_id_location,
                'ref_dept' => $ref_dept,
            ];
        } else {
            $updateRow = [
                'no_user' => $no_user,
                'email' => $email,
                'fullname' => $fullname,
                'phone' => $phone,
                'photo' => null,
                'ref_id_location' => $ref_id_location,
                'ref_dept' => $ref_dept
            ];
        }

        if($_SESSION['sess_id_user']) {
            $result=$obj->update($updateRow, 'id_user='.$_SESSION['sess_id_user'], "tb_user");
            if($result){
                $_SESSION['sess_id_location'] = $ref_id_location;
                $_SESSION['sess_id_dept'] = $ref_dept;
                $_SESSION['sess_fullname'] = $fullname;                
            }
        }

        if($password!=''){
            $updatePws = [
                'password' => $password
            ];
            $result=$obj->update($updatePws, 'id_user='.$_SESSION['sess_id_user'], "tb_user");
        }
        echo json_encode($result);
        exit();
    }

    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action == 'addUser' && !empty($_POST)) {
        $no_user = (!empty($_POST['no_user'])) ? $_POST['no_user'] : '';
        $password = (!empty($_POST['password'])) ? sha1($_POST['password']) : '';
        $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
        $line_token = (!empty($_POST['line_token'])) ? $_POST['line_token'] : null;
        $fullname = (!empty($_POST['fullname'])) ? $_POST['fullname'] : '';
        $sex = (!empty($_POST['sex'])) ? $_POST['sex'] : null;
        $phone = (!empty($_POST['phone'])) ? $_POST['phone'] : null;
        $class_user = (!empty($_POST['class_user'])) ? $_POST['class_user'] : '';        
        $ref_id_location = (!empty($_POST['ref_id_location'])) ? $_POST['ref_id_location'] : '';
        $ref_dept = (!empty($_POST['ref_dept'])) ? $_POST['ref_dept'] : '';
        $status_user = (!empty($_POST['status_user'])) ? $_POST['status_user'] : '';        
        $create_date = date('Y-m-d H:i:s');
        $photo = $_FILES['photo'];
        
        ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['userid'])) ? $_POST['userid'] : '';
        
        /*id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_location, ref_dept, status_user, create_date, lass_login, last_ip*/
        $imagename = '';
        if (!empty($photo['name'])){ ##ถ้ามีแบบไฟล์รูปมาให้อัพโหลดรูปก่อน
            $imagename = $obj->uploadPhoto($photo,$pathUser);
            $insertRow = [
                'no_user' => $no_user,              
                'password' => $password,
                'email' => $email,
                'line_token' => $line_token,
                'fullname' => $fullname,
                'sex' => $sex,
                'phone' => $phone,
                'photo' => $imagename,
                'class_user' => $class_user,
                'ref_id_location' => $ref_id_location,
                'ref_dept' => $ref_dept,
                'status_user' => $status_user,
                'create_date' => date('Y-m-d H:i:s'),
                'lass_login' => '0000-00-00 00:00:00',
                'last_ip' => null,
            ];
        } else {
            $insertRow = [
                'no_user' => $no_user,              
                'password' => $password,
                'email' => $email,
                'line_token' => $line_token,
                'fullname' => $fullname,
                'sex' => $sex,
                'phone' => $phone,
                'photo' => null,
                'class_user' => $class_user,
                'ref_id_location' => $ref_id_location,
                'ref_dept' => $ref_dept,
                'status_user' => $status_user,
                'create_date' => date('Y-m-d H:i:s'),
                'lass_login' => '0000-00-00 00:00:00',
                'last_ip' => null,
            ];
        }

        if ($rowID) {
            $obj->update($insertRow, $rowID);
        } else {
            $rowID = $obj->addRow($insertRow, "tb_user");
        }
        echo json_encode($rowID);
        exit();
    }
        
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;

        $fetchRow = $obj->fetchRows("SELECT tb_user.*,  tb_location.location_short, tb_dept.dept_name
        FROM tb_user
        LEFT JOIN tb_location ON (tb_location.id_location=tb_user.ref_id_location) 
        LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_dept) ORDER BY id_user DESC LIMIT $start, $limit");

        if (!empty($fetchRow)) {           
            foreach($fetchRow as $key=>$value) {##แปลงค่า class_user โดยอ้างอิงจากอาร์เรย์ $classUserArr รวมถึงค่าต่างที่อ้างอิงด้วยอาร์เรย์
                $fetchRow[$key]['class_user'] = $classUserArr[$fetchRow[$key]['class_user']];
                $fetchRow[$key]['status_user'] = $statusUserArr[$fetchRow[$key]['status_user']];
            }
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user");
        $rowArr = ['count' => $total, 'user' => $dataList];
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
        

?>