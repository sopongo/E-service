<?php 

Class Table{
    public $today;
    public $yesterday;
    public function __construct($dateString){
        $day = substr($dateString, 0, 2);
        $month = substr($dateString, 2, 2);
        $year = substr($dateString, 4, 4);

        // สร้าง timestamp จากวันที่, เดือน, ปี
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        // ลบวันลงไป 1 วัน
        $timestampYesterday = strtotime("-1 day", $timestamp);
        $this->today = date("Y-m-d", $timestamp);
        $this->yesterday = date("Y-m-d", $timestampYesterday);
    }
    public function getData(){
        // return $this->getMaintenanceRequest('todayNew');
        return array(
            'todayNew'      => $this->getMaintenanceRequest('todayNew'),
            'yesterdayNew'  => $this->getMaintenanceRequest('yesterdayNew'),
            'wait'          => $this->getMaintenanceRequest('wait'),
            'working'       => $this->getMaintenanceRequest('working'),
            'all'           => $this->getMaintenanceRequest('all'),
            'todayClose'    => $this->getMaintenanceRequest('todayClose'),
            'yesterdayClose'=> $this->getMaintenanceRequest('yesterdayClose')
        );
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
          'ITDevice' => $ITdevice == 0 ? '' : $ITdevice,
          'System'   => $System == 0 ? '' : $System,
          'Printer'  => $Printer == 0 ? '' : $Printer,
          'CCTV'     => $CCTV == 0 ? '' : $CCTV,
          'Net'      => $Net == 0 ? '' : $Net,
          'Software' => $Software == 0 ? '' : $Software,
          'Hardware' => $Hardware == 0 ? '' : $Hardware,
          'Non'      => $non == 0 ? '' : $non,
          'Sum'      => $sum == 0 ? '0' : $sum,
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
                $r .= "AND DATE(mt_request_date) = '".$this->today."' ";
                break;
            case 'yesterdayNew':
                $r .= "AND DATE(mt_request_date) = '".$this->yesterday."' ";
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
}

?>