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
// run();
$Call   = new NewNotify();
print_r ($Call->getData());
// $token = array('sDtsESNI23f9VFPbLFjRlgP33ia7E1IWnvJkBZin3p0', 'ZCrKUwZwzjjuV8t15ewPmYDIjToPVaZRuKY4TQivnSq');
// foreach($token as $k){
//     $Call->sendLineNotify($k);
// }
exit;
function run(){
    $Call   = new NotifyMaintenance();
    $Call->getData();
}

Class NotifyMaintenance{
    public function getData(){
        $data = array(
            'todayNew'      => $this->getMaintenanceRequest('todayNew'),
            'wait'          => $this->getMaintenanceRequest('wait'),
            'working'       => $this->getMaintenanceRequest('working'),
            'todayClose'    => $this->getMaintenanceRequest('todayClose'),
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
            $obj = null;
        }
        $sum      = 0;
        foreach($result as $k => $v){
            $sum++;
        }
        return array(
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
            case 'wait':
                $r .= "AND status_approved <> 2 ";
                $r .= "AND allotted_accept_date IS NULL ";
                $r .= "AND duration_serv_start IS NULL ";
                break;
            case 'working':
                $r .= "AND allotted_accept_date IS NOT NULL ";
                $r .= "AND duration_serv_end IS NULL ";
                break;
            case 'todayClose':
                $r .= "AND DATE(hand_over_date) = '".date('Y-m-d')."' ";
                break;
        }
        return $r;
    }

    public function sendLineNotify($arrData){
        $sToken    = $arrData;
        $sMessage  = " วันที่ ".date('d/m/').(date('Y') + 543)."\n";
        // $sMessage .= "งานใหม่เมื่อวาน: ".$arrData['yesterdayNew']['Sum']."\n";
        // $sMessage .= "งานใหม่วันนี้: ".$arrData['todayNew']['Sum']."\n";
        // $sMessage .= "งานรอซ่อม: ".$arrData['wait']['Sum']."\n";
        // $sMessage .= "งานที่กำลังซ่อม: ".$arrData['working']['Sum']."\n";
        // $sMessage .= "รวมงานที่ไม่ปิด: ".$arrData['all']['Sum']."\n";
        // $sMessage .= "งานที่ส่งมอบเมื่อวาน: ".$arrData['yesterdayClose']['Sum']."\n";
        // $sMessage .= "งานที่ส่งมอบวันนี้: ".$arrData['todayClose']['Sum']."\n";
        // $sMessage .= "รายละเอียด\nhttps://ebooking.cc.pcs-plp.com/eservicenew/module/module_itnotify/?date=".date('dmY');

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

Class NewNotify{
    public function getData(){
        $row = $this->getNotifyConfig();
        foreach ($row as $k=>$v){
            $txt = $this->CreateText($v['ref_id_site'], $v['ref_id_dept']);
            switch ($v['notify_status']){
                case 1: // แจ้งเตือนห้องหลัก และ ห้องส่วนตัวที่ตั้งไว้
                    $this->sendLineNotify($txt, Setting::$main_l_token, $v['site_initialname'], $v['dept_initialname']);
                    $this->sendLineNotify($txt, $v['notify_token']);
                    break;
                case 2: // แจ้งเตือนห้องส่วนตัวที่ตั้งไว้
                    $this->sendLineNotify($txt, $v['notify_token']);
                    break;
                case 3: // แจ้งเตือนห้องหลัก
                    // echo $v['notify_token'];
                    $this->sendLineNotify($txt, Setting::$main_l_token, $v['site_initialname'], $v['dept_initialname']);
                    break;
            }
        }
    }

    public function getNotifyConfig(){
        $sql  = "SELECT tb_notify.*, tb_site.site_initialname, tb_dept.dept_initialname ";
        $sql .= "FROM tb_notify ";
        $sql .= "LEFT JOIN tb_notify_dayofweek ON (tb_notify_dayofweek.ref_id_notify = tb_notify.id_notify) ";
        $sql .= "LEFT JOIN tb_site ON (tb_site.id_site = tb_notify.ref_id_site) ";
        $sql .= "LEFT JOIN tb_dept ON (tb_dept.id_dept = tb_notify.ref_id_dept) ";
        $sql .= "WHERE notify_status <> 0 ";
        $sql .= "AND tb_notify_dayofweek.day=".date('N')." ";
        $sql .= "AND tb_dept.mt_request_manage = 1 ";
        $sql .= "AND tb_dept.dept_status = 1 ";
        $sql .= "AND tb_notify.notify_type = 1 ";
        // return $sql;
        try {
            $obj = new CRUD();  

            $r = $obj->fetchRows($sql);
            return $r;
        } catch (PDOException $e) {
            return "Database connection failed: " . $e->getMessage();
        
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        
        } finally {
            $obj = null;
        }
    }

    public function CreateText($site, $dept){
        // $data = array(
        //     'todayNew'      => $this->getMaintenanceRequest('todayNew', $site, $dept),
        //     'wait'          => $this->getMaintenanceRequest('wait', $site, $dept),
        //     'working'       => $this->getMaintenanceRequest('working', $site, $dept),
        //     'todayClose'    => $this->getMaintenanceRequest('todayClose', $site, $dept),
        // );
        $sMessage  = " วันที่".date('d/m/').(date('Y') + 543)."\n";
        $sMessage .= "งานใหม่วันนี้: ".$this->getMaintenanceRequest('todayNew', $site, $dept)."\n";
        $sMessage .= "งานรอซ่อม: ".$this->getMaintenanceRequest('wait', $site, $dept)."\n";
        $sMessage .= "งานที่กำลังซ่อม: ".$this->getMaintenanceRequest('working', $site, $dept)."\n";
        $sMessage .= "งานที่ส่งมอบวันนี้: ".$this->getMaintenanceRequest('todayClose', $site, $dept)."\n";
        return $sMessage;
    }

    public function getMaintenanceRequest($mode, $site, $dept){
        $sql = $this->getQuery($mode, $site, $dept);
        // return $sql;
        try {
            $obj = new CRUD();  

            $result = $obj->countAll($sql);

            return $result;
        } catch (PDOException $e) {
            return "Database connection failed: " . $e->getMessage();
        
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        
        } finally {
            $obj = null;
        }
    }

    public function getQuery($mode , $site, $dept){
        $r  = "SELECT hand_over_date, name_machine ";
        $r .= "FROM tb_maintenance_request ";
        $r .= "LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site) ";
        $r .= "LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine) ";
        $r .= "WHERE ref_id_site_request=$site ";
        $r .= "AND ref_id_dept_responsibility=$dept ";
        $r .= "AND maintenance_request_status=1 ";
        switch($mode){
            case 'todayNew':
                $r .= "AND DATE(mt_request_date) = '".date('Y-m-d')."' ";
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
            case 'todayClose':
                $r .= "AND DATE(hand_over_date) = '".date('Y-m-d')."' ";
                break;
        }
        return $r;
    }

    public function sendLineNotify($txt, $token, $site = "", $dept = ""){
    
        $sToken    = $token;
        if(!IsNullOrEmptyString($site) || !IsNullOrEmptyString($dept)){
            $sMessage = " ".$site."-".$dept.$txt;
        } else {
            $sMessage  = $txt;
        }
       
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