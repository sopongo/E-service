<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once ('../../include/function.inc.php');
        
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    } 


    if($action=='chk_qr'){
       /*echo json_encode('code: '.$_POST['qrcode']."SELECT tb_machine_site.*, tb_machine_master.ref_id_dept FROM tb_machine_site 
       LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master) WHERE tb_machine_site.code_machine_site='".$_POST['qrcode']."'"); exit();*/

        $rowData = $obj->customSelect("SELECT tb_machine_site.*, tb_machine_master.ref_id_dept FROM tb_machine_site 
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master) WHERE tb_machine_site.code_machine_site='".$_POST['qrcode']."' ");
        
        if(empty($rowData['code_machine_site'])){
            echo json_encode(0);
            exit();
        }

        $slt_machine = '';
        if($rowData['code_machine_site']==$_POST['qrcode']){
            $rowArr = ['ref_id_dept' => $rowData['ref_id_dept']];
            $fetchMC = $obj->fetchRows("SELECT tb_machine_site.*, tb_machine_master.name_machine, tb_site.site_initialname, tb_building.building_name, tb_location.location_name
            FROM tb_machine_site 
           LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
           LEFT JOIN tb_site ON (tb_site.id_site=tb_machine_site.ref_id_site) 
           LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
           LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location) 
           WHERE tb_machine_master.ref_id_dept=".$rowData['ref_id_dept']." AND tb_machine_site.status_machine_site=1 ");
        }else{
            $rowArr = ['slt_machine' => 0];
            echo json_encode($rowArr);            
        }

        if (!empty($fetchMC)) {
            $slt_machine.='<option value="">เลือกเครื่องจักร-อุปกรณ์</option>'; //disabled
            foreach($fetchMC as $key=>$value) {
                $slt_machine.='<option '.($rowData['code_machine_site']==$fetchMC[$key]['code_machine_site'] ? 'selected': '').'  value="'.$fetchMC[$key]['id_machine_site'].'">'.$fetchMC[$key]['code_machine_site'].' : '.$fetchMC[$key]['name_machine'].' ('.$fetchMC[$key]['site_initialname'].($fetchMC[$key]['building_name']!='' ? '-'.$fetchMC[$key]['building_name'] : '' ).($fetchMC[$key]['location_name']!='' ? '-'.$fetchMC[$key]['location_name'] : '' ).')</option>';
            }
            $slt_machine.='<option value="0">ไม่ทราบชื่อ, ไม่ระบุ</option>';
        }else{
            $slt_machine.='<option value="" selected>ไม่มีข้อมูล</option>';
        }
        $arr_slt_machine = ['slt_machine' => $slt_machine];
        $rowArr = array_merge($rowArr, $arr_slt_machine);
        echo json_encode($rowArr);
        exit();
    }

    if($action=='chk_dept'){
            $slt_machine = '';
            $fetchMC = $obj->fetchRows("SELECT tb_machine_site.*, tb_machine_master.name_machine, tb_site.site_initialname, tb_building.building_name, tb_location.location_name
             FROM tb_machine_site 
            LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_site ON (tb_site.id_site=tb_machine_site.ref_id_site) 
            LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
            LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location) 
            WHERE tb_machine_site.ref_id_site=".$_SESSION['sess_ref_id_site']." AND (tb_machine_master.ref_id_site=".$_SESSION['sess_ref_id_site']." AND tb_machine_master.ref_id_dept=".$_POST['ref_id_dept'].")  AND tb_machine_site.status_machine_site=1 ");
            if (!empty($fetchMC)) {
                $slt_machine.='<option value="">เลือกเครื่องจักร-อุปกรณ์</option>'; //disabled
                foreach($fetchMC as $key=>$value) {
                    $slt_machine.='<option value="'.$fetchMC[$key]['id_machine_site'].'">'.$fetchMC[$key]['code_machine_site'].' : '.$fetchMC[$key]['name_machine'].' ['.$fetchMC[$key]['site_initialname'].($fetchMC[$key]['building_name']!='' ? '-'.$fetchMC[$key]['building_name'] : '' ).($fetchMC[$key]['location_name']!='' ? '-'.$fetchMC[$key]['location_name'] : '' ).']</option>';
                }
                $slt_machine.='<option value="0">ไม่ทราบชื่อ, ไม่ระบุ</option>';
            }else{
                $slt_machine.='<option value="" selected>ไม่มีข้อมูล</option>';
            }
            echo $slt_machine;
            exit();
    }    
    

?>