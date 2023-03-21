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
            echo 'mail_error';
            exit();
        }       
        
    if(empty($rowID)){
                #status_user=1&no_user=&fullname=&email=it%40jwdcoldchain.comxxx&password=1234&class_user=1&ref_id_site%5B%5D=7&ref_id_site%5B%5D=1&ref_id_site%5B%5D=3&slt_ref_id_dept=8&id_row=
        $output['password'] = sha1($keygen.$output['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
        if(count($output['ref_id_site'])!=1){ //ถ้า ช่าง,หัวหน้าช่าง ดู(เลือก)มากกว่า 1 ไซต์
            $ref_id_site = 99; //กำหนดขึ้นมาเอง เพื่อให้รู้ว่าดูมากกว่า 1 ไซต์
        }else{
            $ref_id_site = $output['ref_id_site'][0];
        }
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
            'unit_name' => (!empty($output['unit_name'])) ? $output['unit_name'] : '',
            'status_unit' => (!empty($output['status_unit'])) ? $output['status_unit'] : '',
        ];
        $obj->update($insertRow, "id_unit=".$rowID."", "tb_xunit");
    }
    echo json_encode("Success");
    exit();
    }

    if($action=='update-status'){
        //echo "------".$_POST['chk_box_value'].'----------'.$_POST['id_row']; exit();
        $insertRow = [
            'status_unit' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : ''
        ];
        $obj->update($insertRow, "id_unit=".$_POST['id_row']."", "tb_unit");
        echo json_encode(1);
        exit();
    }    

    if ($action=="edit") {
        $rowID = (!empty($_POST['id_row'])) ? $_POST['id_row'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT * FROM tb_unit WHERE tb_unit.id_unit=".$rowID."");
            echo json_encode($rowData);
            exit();
        }
    }    
?>