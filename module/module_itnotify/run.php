<?php

ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");

require_once __DIR__ . "/../../include/connect_db.inc.php";
require_once __DIR__ . "/../../include/class_crud.inc.php";
require_once __DIR__ . "/../../include/function.inc.php";
require_once __DIR__ . "/../../include/setting.inc.php";

// $test = run();
// echo '<pre>';
// print_r($test);
// echo '</pre>';

run();
exit;
function run(){
    $Call   = new ITMaintenance();
    $Call->getData();
}

Class ITMaintenance{
    public function getData(){
        $data = array(
            'todayNew'      => $this->getMaintenanceRequest('todayNew'),
            'yesterdayNew'  => $this->getMaintenanceRequest('yesterdayNew'),
            'wait'          => $this->getMaintenanceRequest('wait'),
            'working'       => $this->getMaintenanceRequest('working'),
            'all'           => $this->getMaintenanceRequest('all'),
            'todayClose'    => $this->getMaintenanceRequest('todayClose'),
            'yesterdayClose'=> $this->getMaintenanceRequest('yesterdayClose')
        );
        $this->sendLineNotify($data);
    }

    public function getMaintenanceRequest($mode){
        $sql = $this->getQuery($mode);
        // return $sql;
        try {
            $obj = new CRUD();  

            $result = $obj->fetchRows($sql);

        } catch (PDOException $e) {
            return "Database connection failed: " . $e->getMessage();
        
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        
        } finally {
            $con = null;
        }
        $ITdevice = 0;
        $System   = 0;
        $Printer  = 0;
        $CCTV     = 0;
        $Net      = 0;
        $Software = 0;
        $Hardware = 0;
        $non      = 0;
        $sum      = 0;
        foreach($result as $k => $v){
            if($v['name_machine'] == 'อุปกรณ์แผนก IT'){
                $ITdevice += 1;
            }
            if($v['name_machine'] == 'งานเกี่ยวกับการจัดการระบบ'){
                $System += 1;
            }
            if($v['name_machine'] == 'งานซ่อมเกี่ยวกับ เครื่องพิมพ์ (Printer)'){
                $Printer += 1;
            }
            if($v['name_machine'] == 'งานซ่อมเกี่ยวกับ กล้องวงจรปิด CCTV'){
                $CCTV += 1;
            }
            if($v['name_machine'] == 'งานซ่อมเกี่ยวกับ Network / LAN / WIFI'){
                $Net += 1;
            }
            if($v['name_machine'] == 'งานซ่อมเกี่ยวกับ Software ทุก Device'){
                $Software += 1;
            }
            if($v['name_machine'] == 'งานซ่อมเกี่ยวกับ Hardware ทุก Device'){
                $Hardware += 1;
            }
            if(empty($v['name_machine'])){
                $non += 1;
            }
            $sum++;
        }
        return array(
          'ITDevice' => $ITdevice,
          'System'   => $System,
          'Printer'  => $Printer,
          'CCTV'     => $CCTV,
          'Net'      => $Net,
          'Software' => $Software,
          'Hardware' => $Hardware,
          'Non'      => $non,
          'Sum'      => $sum
        );
    }

    public function getQuery($mode){
        $r  = "SELECT hand_over_date, name_machine ";
        $r .= "FROM tb_maintenance_request ";
        $r .= "LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site) ";
        $r .= "LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine) ";
        $r .= "WHERE ref_id_site_request=1 ";
        $r .= "AND ref_id_dept_responsibility=13 ";
        $r .= "AND maintenance_request_status=1 ";
        switch($mode){
            case 'todayNew':
                $r .= "AND DATE(mt_request_date) = '".date('Y-m-d')."' ";
                break;
            case 'yesterdayNew':
                $r .= "AND DATE(mt_request_date) = '".date('Y-m-d', strtotime('-1 day'))."' ";
                break;
            case 'wait':
                $r .= "AND status_approved <> 2 ";
                $r .= "AND allotted_accept_date IS NULL ";
                $r .= "AND duration_serv_start IS NULL ";
                break;
            case 'working':
                $r .= "AND allotted_accept_date IS NOT NULL ";
                $r .= "AND duration_serv_end IS NULL ";
                break;
            case 'all':
                $r .= "AND status_approved <> 2 ";
                $r .= "AND duration_serv_end IS NULL ";
                break;
            case 'todayClose':
                $r .= "AND DATE(hand_over_date) = '".date('Y-m-d')."' ";
                break;
            case 'yesterdayClose':
                $r .= "AND DATE(hand_over_date) = '".date('Y-m-d', strtotime('-1 day'))."' ";
                break;
        }
        return $r;
    }

    public function sendLineNotify($arrData){
        $sToken    = Setting::$l_token;
        $sMessage  = " วันที่ ".date('d/m/').(date('Y') + 543)."\n";
        $sMessage .= "งานใหม่เมื่อวาน: ".$arrData['yesterdayNew']['Sum']."\n";
        $sMessage .= "งานใหม่วันนี้: ".$arrData['todayNew']['Sum']."\n";
        $sMessage .= "งานรอซ่อม: ".$arrData['wait']['Sum']."\n";
        $sMessage .= "งานที่กำลังซ่อม: ".$arrData['working']['Sum']."\n";
        $sMessage .= "รวมงานที่ไม่ปิด: ".$arrData['all']['Sum']."\n";
        $sMessage .= "งานที่ส่งมอบเมื่อวาน: ".$arrData['yesterdayClose']['Sum']."\n";
        $sMessage .= "งานที่ส่งมอบวันนี้: ".$arrData['todayClose']['Sum']."\n";
        $sMessage .= "รายละเอียด\nhttps://ebooking.cc.pcs-plp.com/eservicenew/module/module_itnotify/?date=".date('dmY');

        $chOne = curl_init(); 
	    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	    curl_setopt( $chOne, CURLOPT_POST, 1); 
	    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        
	    try {
            $result = curl_exec($chOne);
            if ($result === false) {
                throw new Exception(curl_error($chOne));
            }
        
            // $result_ = json_decode($result, true);
            // echo "status : " . $result_['status'];
            // echo "message : " . $result_['message'];
        } catch (Exception $e) {
            return 'Caught exception: ' . $e->getMessage();
        } finally {
            curl_close($chOne);
        }
    }
}
?>