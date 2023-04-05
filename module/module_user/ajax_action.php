<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
    require_once ('../../include/setting.inc.php');

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }
    
    if ($action=='register_user' && !empty($_POST)) {
        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
            //no_user=0000000&email_regis=testuser1%40pcs-plp.com&password_regis=1234&slt_regis_site=1&slt_regis_dept=16
            parse_str($_POST['data'], $output); //$output['period']
        }
        
        $totalRow = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user WHERE email = '".(trim($output['email_regis']))."';");
        if($totalRow!=0){
            echo 'mail_dup';
            exit();
        }
        $output['password_regis'] = sha1($keygen.$output['password_regis']); //เก็บรหัสผ่านในรูปแบบ sha1 
        $insertRow = [
            'no_user' => (!empty($output['no_user'])) ? $output['no_user'] : '',
            'password' => (!empty($output['password_regis'])) ? $output['password_regis'] : '',
            'email' => (!empty($output['email_regis'])) ? $output['email_regis'] : '',
            'line_token' => NULL,
            'fullname' => (!empty($output['fullname'])) ? $output['fullname'] : '',
            'sex' => NULL,
            'phone' => NULL,
            'photo' => NULL,
            'class_user' => 1,
            'ref_id_site' => (!empty($output['slt_regis_site'])) ? $output['slt_regis_site'] : '',
            'ref_id_dept' => (!empty($output['slt_regis_dept'])) ? $output['slt_regis_dept'] : '',
            'ref_id_position' => NULL,
            'status_user' => 3,
            'create_date' => (date('Y-m-d H:i:s')),
            'ref_id_user_add' => 0,
            'edit_date' => NULL,
            'ref_id_user_edit' => NULL,
            'latest_login' => NULL,
            'ip_address' => NULL,
        ];
        $rowID = $obj->addRow($insertRow, "tb_user");
        if($rowID!=NULL){
            $insertRow = [				
                'ref_id_user' => $rowID,
                'ref_id_site' => (!empty($output['slt_regis_site'])) ? $output['slt_regis_site'] : '',
            ];
            $rowSite = $obj->addRow($insertRow, "tb_site_responsibility");
        }
        echo $rowID;
        exit();
    }//register_user

    /*echo $action; exit();*/
    if ($action=='adddata' && !empty($_POST)) {
        //id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address

        if(isset($_POST['data'])){
            //echo $_POST['data']; exit();
#status_user=1&no_user=&fullname=&email=it%40jwdcoldchain.comxxx&password=1234&class_user=1&ref_id_site%5B%5D=7&ref_id_site%5B%5D=1&ref_id_site%5B%5D=3&slt_ref_id_dept=8&id_row=
            parse_str($_POST['data'], $output); //$output['period']
        }

        /*print_r($output); 
        echo "\r\n";
        echo count($output['ref_id_site']);
        echo "\r\n";
        echo $output['ref_id_site'][1];
        exit();*/
        
        $rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_user!=".$output["id_row"]."") : ($query_id = "");               
        $output['email'] = trim($output['email']);

        $totalRow = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user WHERE email = '".(trim($output['email']))."' ".$query_id."");
        if($totalRow!=0){
            echo 'mail_dup';
            exit();
        }       

        $output['password'] = sha1($keygen.$output['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
        if(count($output['ref_id_site'])!=1){ //ถ้า ช่าง,หัวหน้าช่าง ดู(เลือก)มากกว่า 1 ไซต์
            $ref_id_site = 99; //กำหนดขึ้นมาเอง เพื่อให้รู้ว่าดูมากกว่า 1 ไซต์
        }else{
            $ref_id_site = $output['ref_id_site'][0];
        }
                
    if(empty($rowID)){
        #status_user=1&no_user=&fullname=&email=it%40jwdcoldchain.comxxx&password=1234&class_user=1&ref_id_site%5B%5D=7&ref_id_site%5B%5D=1&ref_id_site%5B%5D=3&slt_ref_id_dept=8&id_row=
        $insertRow = [
            'no_user' => (!empty($output['no_user'])) ? $output['no_user'] : '',
            'password' => (!empty($output['password'])) ? $output['password'] : '',
            'email' => (!empty($output['email'])) ? $output['email'] : '',
            'line_token' => NULL,
            'fullname' => (!empty($output['fullname'])) ? $output['fullname'] : '',
            'sex' => NULL,
            'phone' => NULL,
            'photo' => NULL,
            'class_user' => (!empty($output['class_user'])) ? $output['class_user'] : '',
            'ref_id_site' => $ref_id_site,
            'ref_id_dept' => (!empty($output['slt_ref_id_dept'])) ? $output['slt_ref_id_dept'] : '',
            'ref_id_position' => NULL,
            'status_user' => (!empty($output['status_user'])) ? $output['status_user'] : '',           
            'create_date' => (date('Y-m-d H:i:s')),
            'ref_id_user_add' => ($_SESSION['sess_id_user']),
            'edit_date' => NULL,
            'ref_id_user_edit' => NULL,
            'latest_login' => NULL,
            'ip_address' => NULL,
        ];
        $rowID = $obj->addRow($insertRow, "tb_user");
        if(count($output['ref_id_site'])>1){ //ถ้า ช่าง,หัวหน้าช่าง ดู(เลือก)มากกว่า 1 ไซต์
            foreach($output['ref_id_site'] as $index => $value){
                $insertRow = [				
                    'ref_id_user' => $rowID,
                    'ref_id_site' => (!empty($output['ref_id_site'][$index])) ? $output['ref_id_site'][$index] : NULL,
                ];
                $rowSite = $obj->addRow($insertRow, "tb_site_responsibility");
            }
        }else{
            $insertRow = [				
                'ref_id_user' => $rowID,
                'ref_id_site' => (!empty($output['ref_id_site'][0])) ? $output['ref_id_site'][0] : NULL,
            ];
            $rowSite = $obj->addRow($insertRow, "tb_site_responsibility");
        }
        echo $rowID;
        exit();
    }else{
        $insertRow = [
            'no_user' => (!empty($output['no_user'])) ? $output['no_user'] : '',
            'password' => (!empty($output['password'])) ? $output['password'] : '',
            'email' => (!empty($output['email'])) ? $output['email'] : '',
            'line_token' => NULL,
            'fullname' => (!empty($output['fullname'])) ? $output['fullname'] : '',
            'sex' => NULL,
            'phone' => NULL,
            'photo' => NULL,
            'class_user' => (!empty($output['class_user'])) ? $output['class_user'] : '',
            'ref_id_site' => $ref_id_site,
            'ref_id_dept' => (!empty($output['slt_ref_id_dept'])) ? $output['slt_ref_id_dept'] : '',
            'status_user' => (!empty($output['status_user'])) ? $output['status_user'] : '',           
            'edit_date' => (date('Y-m-d H:i:s')),
            'ref_id_user_edit' => ($_SESSION['sess_id_user']),
        ];
        $obj->update($insertRow, "id_user=".$rowID."", "tb_user");

        /*
        if(count($output['ref_id_site'])>1){ //ถ้า ช่าง,หัวหน้าช่าง ดู(เลือก)มากกว่า 1 ไซต์
            foreach($output['ref_id_site'] as $index => $value){
                $insertRow = [				
                    'ref_id_user' => $rowID,
                    'ref_id_site' => (!empty($output['ref_id_site'][$index])) ? $output['ref_id_site'][$index] : NULL,
                ];
                $rowSite = $obj->addRow($insertRow, "tb_site_responsibility");
            }        
            */
    }
    echo json_encode("Success");
    exit();
    }

    if($action=='edituser'){
        !empty($_POST['password']) ? $_POST['password'] = sha1($keygen.$_POST['password']) : ''; //เก็บรหัสผ่านในรูปแบบ sha1         
        //id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address
        $updateRow = [
            'no_user' => (!empty($_POST['no_user'])) ? $_POST['no_user'] : '',
            'fullname' => (!empty($_POST['fullname'])) ? $_POST['fullname'] : '',
            'ref_id_dept' => (!empty($_POST['ref_id_dept'])) ? $_POST['ref_id_dept'] : '',
            'ref_id_site' => (!empty($_POST['ref_id_site'])) ? $_POST['ref_id_site'] : ''
        ];

        if(!empty($_POST['password'])){
            $passRow = [
                'password' => $_POST['password'],
            ];
            $updateRow = array_merge($updateRow, $passRow);
        }
        $Update = $obj->update($updateRow, "id_user=".$_SESSION['sess_id_user']."", "tb_user");
        echo json_encode($Update);
        exit();
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'status_user' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $id_row = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        //print_r($insertRow); exit();
        $obj->update($insertRow, "id_user=".$id_row."", "tb_user");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit_user") {
        //id_user, no_user, password, email, line_token, fullname, sex, phone, photo, class_user, ref_id_site, ref_id_dept, ref_id_position, status_user, create_date, ref_id_user_add, edit_date, ref_id_user_edit, latest_login, ip_address
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_user WHERE tb_user.id_user=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>