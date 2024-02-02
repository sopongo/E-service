<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");

require_once __DIR__ . "/../../../include/connect_db.inc.php";
require_once __DIR__ . "/../../../include/class_crud.inc.php";
require_once __DIR__ . "/../../../include/function.inc.php";
require_once __DIR__ . "/../../../include/setting.inc.php";

require_once __DIR__ . "/../../../tools/datatable_processing.php";

Class DataTable extends TableProcessing {
    public $start;
    public $end;
    public $vehicle;
    public $status;
    
    public function __construct($TableSET){
        parent::__construct($TableSET); //ส่งค่าไปที่ DataTable Class
    }   
    public function getTable(){
        // return $this->start;
        return $this->SqlQuery();
    }

    public function SqlQuery(){
        $sql      = $this->getSQL(true);
        // $sqlCount = $this->getSQL(false);
        // return $sqlCount;

        try {
            $obj = new CRUD();

            // $Row = $obj->fetchRows(Setting::$SQLSET);
            $fetchRow = $obj->fetchRows($sql);
            $numRow   = $obj->countAll($sql);

            // return $numRow;
            $Result   = $this->createArrayDataTable($fetchRow, $numRow);
            
            return $Result;
        } catch (PDOException $e) {
            return "Database connection failed: " . $e->getMessage();
        
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        
        } finally {
            $con = null;
        }
    }

    public function getSQL(bool $OrderBY){


        if($OrderBY){
            $sql = "SELECT tb_maintenance_request.ref_id_dept_responsibility, tb_dept.dept_initialname, tb_dept.dept_name, tb_dept.id_dept ";
            
        } else {
            $sql = "SELECT count(tb_dept.id_dept) AS total_row ";
        }
        $sql .= "FROM tb_maintenance_request ";
        $sql .= "LEFT JOIN tb_dept ON (tb_maintenance_request.ref_id_dept_responsibility = tb_dept.id_dept) ";
        $sql .= "WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." ";
        $sql .= "AND dept_status=1 ";
        $sql .= "AND mt_request_manage=1 ";
        if($_SESSION['sess_class_user'] != 5 && $_SESSION['sess_class_user'] != 4){
            $sql .= "AND id_dept=".$_SESSION['sess_id_dept']." ";
        }
        
        $sql .= "$this->query_search ";
        $sql .= "GROUP BY tb_maintenance_request.ref_id_dept_responsibility ";
        if($OrderBY) {
            $sql .= "ORDER BY ";
            $sql .= "$this->orderBY ";
            $sql .= "$this->dir ";
            $sql .= "$this->limit ";
        }

        return $sql;
    }

    public function createArrayDataTable($fetchRow, $numRow){

        $arrData = null;
        $output = array(
            "draw" => intval($this->draw),
            "recordsTotal" => intval(0),
            "recordsFiltered" => intval(0),
            "data" => $arrData,
        );

        if (count($fetchRow) > 0) {
            $No = ($numRow - $this->pStart);
            foreach ($fetchRow as $key => $value) {
                $id      = $fetchRow[$key]['id_dept'];
                $checked = ($fetchRow[$key]['driver_status']==1 ? 'checked value="1" disabled' : ' disabled ');
                if(IsNullOrEmptyString($fetchRow[$key]['notify_status'])){
                    $fetchRow[$key]['notify_status'] = 0;
                }


                $dataRow = array();
                $dataRow[] = "<h6 class='text-center'>$No.</h6>";
                $dataRow[] = ($fetchRow[$key]['dept_initialname'] == '' ? '-' : $fetchRow[$key]['dept_initialname']);
                $dataRow[] = ($fetchRow[$key]['dept_name'] == '' ? '-' : $fetchRow[$key]['dept_name']);
                $dataRow[] = $_SESSION['sess_site_initialname'];
                $dataRow[] = $this->getStatus($fetchRow[$key]['id_dept']);
                $dataRow[] = $this->getControl($fetchRow[$key]['id_dept'], $fetchRow[$key]['notify_status'], 'control');
    
                $arrData[] = $dataRow;
                $No--;
            }
        }

        $output = array(
            "draw" => intval($this->draw),
            "recordsTotal" => intval($numRow),
            "recordsFiltered" => intval($numRow),
            "data" => $arrData,
        );

        return $output;
    }

    public function getStatus($dept){
        $row = $this->getRowStatus($dept);

        $sm_notify = false;

        if(!empty($row)){
            foreach($row as $k => $v){
                switch ($v['notify_type']){
                    case 1: // ถ้าเป็นสรุปงานแจ้งซ่อม
                        if($v['notify_status'] != 0)
                            $sm_notify = true;
                        break;
                }
            }
        }
        $r  = "<div class='text-center align-middle pt-1'>";
        $r .= "<i class='far fa-file-alt fa-2x mr-1' style='color: ".Setting::$notifyStatusIcon[$sm_notify].";'></i>";
        $r .= "</div>";
        return $r;
        
    }

    public function getRowStatus($dept){
        $sql  = "SELECT * ";
        $sql .= "FROM tb_notify ";
        $sql .= "WHERE ref_id_site=".$_SESSION['sess_ref_id_site']." ";
        $sql .= "AND ref_id_dept=$dept ";
        try {
            $obj = new CRUD();

            $row = $obj->fetchRows($sql);
            
            return $row;
        } catch (PDOException $e) {
            return "Database connection failed: " . $e->getMessage();
        
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        
        } finally {
            $con = null;
        }
    }

    public function getControl($id, $status, $mode){

        switch($mode){
            case 'control':
                $result  = "<button type='button' class='btn btn-warning btn-sm edit-notify' data-id='$id' data-toggle='modal' data-target='#modal-notify' id='edit-notify' data-backdrop='static' data-keyboard='false' title='แก้ไขข้อมูล'>";
                $result .= "<i class='fa fa-pencil-alt'></i>";
                $result .= "</button>";
                break;
            case 'status':
                switch($status){
                    case 0:
                        $result = "<h4 class='text-center m-0'><span class='badge badge-danger'>".Setting::$notifyStatus[$status]."</span></h4>";
                        break;
                    case 1:
                        $result = "<h4 class='text-center m-0'><span class='badge badge-success'>".Setting::$notifyStatus[$status]."</span></h4>";
                        break;
                    case 2:
                        $result = "<h4 class='text-center m-0'><span class='badge badge-success'>".Setting::$notifyStatus[$status]."</span></h4>";
                        break;
                    case 3:
                        $result = "<h4 class='text-center m-0'><span class='badge badge-success'>".Setting::$notifyStatus[$status]."</span></h4>";
                        break;
                }
                break;
        }
        return $result;
    }

}

//////////////////////////////////////////////////////////////////////////////////
$column = $_POST['order']['0']['column'] + 1;
$search = $_POST["search"]["value"];
$start  = $_POST["start"];
$length = $_POST["length"];
$dir    = $_POST['order']['0']['dir'];
$draw   = $_POST["draw"];

$action = $_POST['action'];

$DataTableSearch = array(
    
);

switch($action){
    default:
        $DataTableCol = array( 
            0 => "tb_dept.id_dept",
            1 => "tb_dept.id_dept",
            2 => "tb_dept.id_dept",
            3 => "tb_dept.id_dept",
            4 => "tb_dept.id_dept",
            5 => "tb_dept.id_dept",
            6 => "tb_dept.id_dept",
        );
    break;
}

$dataGet = array(
    'column'     => $column,
    'search'     => $search,
    'length'     => $length,
    'start'      => $start,
    'dir'        => $dir,
    'draw'       => $draw,
    'dataCol'    => $DataTableCol,
    'dataSearch' => $DataTableSearch
);


switch($action) {
    default:
        $Call   = new DataTable($dataGet);
        $result = $Call->getTable(); 
    break;
}
// print_r($_POST['formData']);
// exit;
///////////////////////////////////////////////////////////////////////////////////

echo json_encode($result);
exit;
?>