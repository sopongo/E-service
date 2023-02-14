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
    //INSERT INTO `tb_permission` (`id_permission`, `ref_class_user`, `module_name`, `accept_denied`) VALUES ('1', '1', '1', '2');
    if($action=="permission"){
        //echo "TEST CALL AJAX OK";
        //echo $_POST['data']; exit();
##user=1&technician=2&supervisor%20=3&checkboxSuccess_2_0=1&checkboxSuccess_3_0=1&checkboxSuccess_2_1=1&checkboxSuccess_3_1=1&checkboxSuccess_1_2=1&checkboxSuccess_2_2=1&checkboxSuccess_3_2=1&checkboxSuccess_3_3=1

        //echo $_POST['data'];
        parse_str($_POST['data'], $output); //$output['period']        
        $keys = array_keys($module_name);
        $a = 0;
            foreach($module_name as $key => $value) {
                for($i=1; $i<=3;$i++){
                    //ref_class_user, module_name
                    if(empty($output['checkboxSuccess_'.$i."_".$a])){
                        //echo "checkboxSuccess_".$i."_".$a."=empty";
                        $updDateRow = ['accept_denied' => 2];
                    }else{
                        //echo "checkboxSuccess_".$i."_".$a."=".$output['checkboxSuccess_'.$i."_".$a];
                        $updDateRow = ['accept_denied' => 1];
                    }
                    //echo "\r\n"."ref_class_user=".$i." AND module_name=".$a."";
                    $result_update = $obj->update($updDateRow, "ref_class_user=".$i." AND module_name=".$a."", "tb_permission");
                }
                $a++;
                //echo "\r\n".$key;
            }
        //echo 'checkboxSuccess1_';
        //echo count($module_name);
        echo $result_update;
        exit();
    }    
?>