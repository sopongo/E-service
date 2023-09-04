<?PHP
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');	

require_once ('include/connect_db.inc.php');
require_once ('include/function.inc.php');
require_once ('include/setting.inc.php');
require_once ('include/class_crud.inc.php');
require_once ('include/timer.inc.php');
require_once ('include/query_class.inc.php');

error_reporting(error_reporting() & ~E_NOTICE);

//$stmt = new CRUD();
/*ทดสอบ คอมเม้นต์ และอัพโหลดลง GITHUB*/

//if($_SESSION['sess_id_user']!=NULL && $_SESSION['sess_status_user']!=NULL){ 
if(empty($_SESSION['sess_id_user'])){ 
  $_SESSION = []; //empty array. 
  session_destroy(); die(include('login.inc.php')); 
}

$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ

//เริ่มต้นการใช้งาน แทรกส่วนนี้ไว้ตอนต้นๆของเพจ ก่อนการประมวลผล
$Time = new Processing(); // instance to class processing
$start = $Time->Start_Time(); // inits time		

/*เช็คการรับค่าโมดูลต่างๆ เพื่อดึงไฟล์มา include โฟลเดอร์ module_xxxx*/
isset($_REQUEST['module']) ? $module = $_REQUEST['module'] : $module = '';
isset($_REQUEST['id']) ? $id = intval($_REQUEST['id']) : $id = '';

switch($module){  

  case 'gen-qrcode':
    include('qrcode.inc.php');
    exit();
  break;  

  case 'howto':
    $title_site = "คู่มือการใช้งาน"; $title_act = "คู่มือการใช้งาน"; $breadcrumb_txt = "คู่มือการใช้งาน";
    $include_module = "module/module_howto/howto.inc.php";
    $module=="howto" ? ($active_howto="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_howto=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

  case 'news':
    $title_site = "ข่าวประกาศทั้งหมด"; $title_act = "ข่าวประกาศทั้งหมด"; $breadcrumb_txt = "ข่าวประกาศทั้งหมด";
    $include_module = "module/module_news/user_list.inc.php";
    $module=="news" ? ($active_news="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_news=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

  case 'newslist':
    $title_site = "ข่าวประกาศทั้งหมด"; $title_act = "ข่าวประกาศทั้งหมด"; $breadcrumb_txt = "ข่าวประกาศทั้งหมด";
    $include_module = "module/module_news/list.inc.php";
    $module=="newslist" ? ($active_newslist="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_newslist=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

  case 'permission':
    $title_site = "กำหนดสิทธิ์การใช้งาน"; $title_act = "กำหนดสิทธิ์การใช้งาน"; $breadcrumb_txt = "กำหนดสิทธิ์การใช้งาน";
    $include_module = "module/module_permission/view.inc.php";
    $module=="permission" ? ($active_permission="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_permission=""); #ไฮไลท์เมนูด้านซ้าย
  break;
   
    case 'create-request':
    $title_site = "แจ้งซ่อม"; $title_act = "แจ้งซ่อม"; $breadcrumb_txt = "แจ้งซ่อม";
    $include_module = "module/module_maintenance_list/frm_add-edit.inc.php";
    $module=="create-request" ? ($active_createrequest="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_createrequest=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'requestlist':
    $title_site = "ใบแจ้งซ่อมทั้งหมด"; $title_act = "ใบแจ้งซ่อมทั้งหมด"; $breadcrumb_txt = "ใบแจ้งซ่อมทั้งหมด";
    $include_module = "module/module_maintenance_list/list.inc.php";
    $module=="requestlist" ? ($active_requestlist="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_requestlist=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

    case 'waitaccept':    
      $title_site = "งานรอช่างรับงาน"; $title_act = "งานรอช่างรับงาน"; $breadcrumb_txt = "งานรอช่างรับงาน";
      $include_module = "module/module_maintenance_list/list.inc.php";
      $module=="waitaccept" ? ($active_waitaccept="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_waitaccept=""); #ไฮไลท์เมนูด้านซ้าย    
    break;

    case 'allrequestlist':    
      $title_site = " ใบแจ้งซ่อมทั้งหมด"; $title_act = " ใบแจ้งซ่อมทั้งหมด"; $breadcrumb_txt = " ใบแจ้งซ่อมทั้งหมด";
      $include_module = "module/module_maintenance_list/list.inc.php";
      $module=="allrequestlist" ? ($active_allrequestlist="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_handover=""); #ไฮไลท์เมนูด้านซ้าย    
    break;

    case 'handover':    
      $title_site = "งานรอส่งมอบ"; $title_act = "งานรอส่งมอบ"; $breadcrumb_txt = "งานรอส่งมอบ";
      $include_module = "module/module_maintenance_list/list.inc.php";
      $module=="handover" ? ($active_handover="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_handover=""); #ไฮไลท์เมนูด้านซ้าย    
    break;    

  case 'requestid': 
    if(!is_numeric($id) || $id==0){ //เคลียร์ค่า session
      session_destroy(); header('location:./'); exit();
    }
    $rowData = $obj->customSelect("SELECT tb_maintenance_request.*, tb_maintenance_type.name_mt_type, tb_maintenance_request.ref_id_dept_responsibility AS id_dept_responsibility, tb_dept_responsibility.dept_initialname AS dept_responsibility,
    tb_user_request.no_user, tb_user_request.email, tb_user_request.fullname, tb_user_request.ref_id_dept AS ref_id_dept_request, tb_user_dept_request.dept_initialname AS dept_user_request,
    tb_user_cancel.fullname AS cancel_fullname, tb_user_approved.fullname AS approved_fullname, tb_failure_code.failure_code_th_name, tb_repair_code.repair_code_name, 
    tb_repair_result.txt_solution, tb_repair_result.txt_caused_by, tb_repair_result.ref_id_failure_code, tb_repair_result.ref_id_repair_code,
    tb_failure_code.id_failure_code, tb_repair_code.id_repair_code, tb_outsite_repair.*, tb_supplier.supplier_name, tb_user_survey.fullname AS fullname_survay,
    tb_user_handover.fullname AS fullname_handover, tb_accept_request.fullname AS fullname_accept FROM tb_maintenance_request 
    LEFT JOIN tb_maintenance_type ON (tb_maintenance_type.id_mt_type=tb_maintenance_request.ref_id_mt_type)
    LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
    LEFT JOIN tb_user AS tb_user_request ON (tb_user_request.id_user=tb_maintenance_request.ref_id_user_request)    
    LEFT JOIN tb_user AS tb_user_cancel ON (tb_user_cancel.id_user=tb_maintenance_request.ref_id_user_cancel)    
    LEFT JOIN tb_user AS tb_user_approved ON (tb_user_approved.id_user=tb_maintenance_request.ref_id_user_approver) 
    LEFT JOIN tb_user AS tb_user_survey ON (tb_user_survey.id_user=tb_maintenance_request.ref_id_user_survey) 
    LEFT JOIN tb_user AS tb_accept_request ON (tb_accept_request.id_user=tb_maintenance_request.ref_user_id_accept_request)      
    LEFT JOIN tb_user AS tb_user_handover ON (tb_user_handover.id_user=tb_maintenance_request.ref_id_user_hand_over) 
    LEFT JOIN tb_dept AS tb_user_dept_request ON (tb_user_dept_request.id_dept=tb_user_request.ref_id_dept)
    LEFT JOIN tb_repair_result ON (tb_repair_result.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)
    LEFT JOIN tb_failure_code ON (tb_failure_code.id_failure_code=tb_repair_result.ref_id_failure_code)   
    LEFT JOIN tb_repair_code ON (tb_repair_code.id_repair_code=tb_repair_result.ref_id_repair_code)   
    LEFT JOIN tb_outsite_repair ON (tb_outsite_repair.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)   
    LEFT JOIN tb_supplier ON (tb_supplier.id_supplier=tb_outsite_repair.ref_id_supplier) WHERE tb_maintenance_request.id_maintenance_request=".$id." ");
  
    $rowMachine = $obj->customSelect("SELECT tb_machine_site.*, tb_machine_master.*,
    tb_site.site_initialname, tb_building.building_name, tb_location.location_name, tb_dept.dept_initialname, tb_category.name_menu  FROM tb_machine_site
    LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
    LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)      
    LEFT JOIN tb_site ON (tb_site.id_site=tb_machine_site.ref_id_site) 
    LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
    LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location)     
    LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_machine_master.ref_id_dept) 
      WHERE tb_machine_site.id_machine_site=".$rowData['ref_id_machine_site']." ");

    if($rowData['id_maintenance_request']!=$id){
      header('location:./');
    }else{
      //|| $rowData['ref_id_dept']==$_SESSION['sess_id_dept']
      if($rowData['ref_id_dept_request']==$_SESSION['sess_id_dept'] || $rowData['ref_id_user_request']==$_SESSION['sess_id_user'] || $_SESSION['sess_class_user']==5 || $_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==2){#001
        $denied_requestid = 1;
        $include_module = "module/module_maintenance_list/view.inc.php";
        $title_site = "".$rowData['maintenance_request_no'].""; $title_act = "ใบแจ้งซ่อมเลขที่: ".$rowData['maintenance_request_no'].""; $breadcrumb_txt = "".$rowData['maintenance_request_no']."";
        $module=="requestid" ? ($active_requestid="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_requestid=""); #ไฮไลท์เมนูด้านซ้าย
      }else{
        $denied_requestid = 0; //ไม่สิทธิ์ดูใบแจ้งซ่อมนี้ เพราะไม่มีสิทธิ์ตาม if ที่ #001
        $include_module = "module/module_maintenance_list/view.inc.php";
        $title_site = $warning_text[1]; $title_act = $warning_text[1]; $breadcrumb_txt = $warning_text[1];
        $module=="requestid" ? ($active_requestid="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_requestid=""); #ไฮไลท์เมนูด้านซ้าย
      }
    }
  break;  
   
  case 'site':
    $title_site = "ไซต์งาน"; $title_act = "ไซต์งาน"; $breadcrumb_txt = "ไซต์งาน";
    $include_module = "module/module_site/list.inc.php";
    $module=="site" ? ($active_site="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_site=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'building':
    $title_site = "อาคาร"; $title_act = "อาคาร"; $breadcrumb_txt = "อาคาร";
    $include_module = "module/module_building/list.inc.php";
    $module=="building" ? ($active_building="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_building=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'location':
    $title_site = "สถานที่ใช้งาน"; $title_act = "สถานที่ใช้งาน"; $breadcrumb_txt = "สถานที่ใช้งาน";
    $include_module = "module/module_location/list.inc.php";
    $module=="location" ? ($active_location="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_location=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'dept':
    $title_site = "แผนก"; $title_act = "แผนก"; $breadcrumb_txt = "แผนก";
    $include_module = "module/module_dept/list.inc.php";
    $module=="dept" ? ($active_dept="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_dept=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'unit':
    $title_site = "หน่วยนับ"; $title_act = "หน่วยนับ"; $breadcrumb_txt = "หน่วยนับ";
    $include_module = "module/module_unit/list.inc.php";
    $module=="unit" ? ($active_unit="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_unit=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'mtr-setting':
    $title_site = "ตั้งค่าใบแจ้งซ่อม"; $title_act = "ตั้งค่าใบแจ้งซ่อม"; $breadcrumb_txt = "ตั้งค่าใบแจ้งซ่อม";
    $include_module = "module/module_maintenance_req/list.inc.php";
    $module=="mtr-setting" ? ($active_mtr="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_mtr=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

  case 'waitapprove':
    $title_site = "งานรออนุมัติซ่อม"; $title_act = "งานรออนุมัติซ่อม"; $breadcrumb_txt = "งานรออนุมัติซ่อม";
    $include_module = "module/module_maintenance_list/list.inc.php";
    $module=="waitapprove" ? ($active_waitapprove="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_waitapprove=""); #ไฮไลท์เมนูด้านซ้าย    
  break;
    
  case 'joblist':
    $title_site = "งานซ่อมของคุณ"; $title_act = "งานซ่อมของคุณ"; $breadcrumb_txt = "งานซ่อมของคุณ";
    $include_module = "module/module_joblist/list.inc.php";
    $module=="joblist" ? ($active_joblist="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_joblist=""); #ไฮไลท์เมนูด้านซ้าย    
  break;

  case 'category':
    $title_site = "ประเภทเครื่องจักร-อุปกรณ์"; $title_act = "ประเภทเครื่องจักร-อุปกรณ์"; $breadcrumb_txt = "ประเภทเครื่องจักร-อุปกรณ์";
    $include_module = "module/module_category/list.inc.php";
    $module=="category" ? ($active_category="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_category=""); #ไฮไลท์เมนูด้านซ้าย
  break;  

  case 'timeline':
    $title_site = "แบรนด์"; $title_act = "แบรนด์"; $breadcrumb_txt = "แบรนด์";
    $include_module = "module/module_demo/timeline.inc.php";
    $module=="timeline" ? ($active_brand="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_brand=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'brand':
    $title_site = "แบรนด์"; $title_act = "แบรนด์"; $breadcrumb_txt = "แบรนด์";
    $include_module = "module/module_brand/list.inc.php";
    $module=="brand" ? ($active_brand="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_brand=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'supplier':
    $title_site = "ซัพพลายเออร์"; $title_act = "ซัพพลายเออร์"; $breadcrumb_txt = "ซัพพลายเออร์";
    $include_module = "module/module_supplier/list.inc.php";
    $module=="supplier" ? ($active_supplier="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_supplier=""); #ไฮไลท์เมนูด้านซ้าย
  break;  

  case 'userlist':
    $title_site = "รายชื่อผู้ใช้งาน"; $title_act = "รายชื่อผู้ใช้งาน"; $breadcrumb_txt = "รายชื่อผู้ใช้งาน";
    $include_module = "module/module_user/list.inc.php";
    $module=="userlist" ? ($active_userlist="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'logout':
    $title_site = "กำลังทำงาน"; $title_act = "กำลังทำงาน"; $ico_act = "ico32_loading";
    //$include_page = "logout.inc.php";
    include('logout.inc.php');
  break;

  case 'machine-master':
    $title_site = "ข้อมูลเครื่องจักร-อุปกรณ์ (Master Data)"; $title_act = "ข้อมูลเครื่องจักร-อุปกรณ์ (Master Data)"; $breadcrumb_txt = "ข้อมูลเครื่องจักร-อุปกรณ์ (Master Data)";
    $include_module = "module/module_machine_master/list.inc.php";
    $module=="machine-master" ? ($active_machine="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_machine=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'machine-site':
    $title_site = "ข้อมูลเครื่องจักร-อุปกรณ์รายไซต์"; $title_act = "ข้อมูลเครื่องจักร-อุปกรณ์รายไซต์"; $breadcrumb_txt = "ข้อมูลเครื่องจักร-อุปกรณ์รายไซต์";
    $include_module = "module/module_machine_site/list.inc.php";
    $module=="machine-site" ? ($active_machine_site="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_machine_site=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'dashboard_report':
    $title_site = " รายงาน E-Service | Dashboard"; $title_act = " รายงาน E-Service | Dashboard"; $breadcrumb_txt = " รายงาน E-Service | Dashboard";
    $include_module = "module/module_report/dashboard.inc.php";
    $module=="dashboard_report" ? ($active_dashboard_report="active") && ($active_treeview_2="menu-open") : ($active_treeview_2="menu-close") && ($active_dashboard_report=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'report':
    $title_site = "รายงานใบแจ้งซ่อม"; $title_act = "รายงานใบแจ้งซ่อม"; $breadcrumb_txt = "รายงานใบแจ้งซ่อม";
    $include_module = "module/module_report/list.inc.php";
    $module=="report" ? ($active_report="active") && ($active_treeview_2="menu-open") : ($active_treeview_2="menu-close") && ($active_report=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'machine_report':
    $title_site = "รายงานเครื่องจักร-อุปกรณ์"; $title_act = "รายงานเครื่องจักร-อุปกรณ์"; $breadcrumb_txt = "รายงานเครื่องจักร-อุปกรณ์";
    $include_module = "module/module_report/list_machine.inc.php";
    $module=="machine_report" ? ($active_machine_report="active") && ($active_treeview_2="menu-open") : ($active_treeview_2="menu-close") && ($active_machine_report=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'user_report':
    $title_site = "สถิติผู้ใช้งานแจ้งซ่อม"; $title_act = "สถิติผู้ใช้งานแจ้งซ่อม"; $breadcrumb_txt = "สถิติผู้ใช้งานแจ้งซ่อม";
    $include_module = "module/module_report/list_user.inc.php";
    $module=="user_report" ? ($active_user_report="active") && ($active_treeview_2="menu-open") : ($active_treeview_2="menu-close") && ($active_user_report=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'request_report':
    $title_site = "สถานะใบแจ้งซ่อม"; $title_act = "สถานะใบแจ้งซ่อม"; $breadcrumb_txt = "สถานะใบแจ้งซ่อม";
    $include_module = "module/module_report/list_request.inc.php";
    $module=="request_report" ? ($active_request_report="active") && ($active_treeview_2="menu-open") : ($active_treeview_2="menu-close") && ($active_request_report=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'profile':
    $title_site = "แก้ไขข้อมูลส่วนตัว"; $title_act = "แก้ไขข้อมูลส่วนตัว"; $breadcrumb_txt = "แก้ไขข้อมูลส่วนตัว";
    $include_module = "module/module_user/profile.inc.php";
    //$module=="unit" ? ($active_unit="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break; 

  case 'datatable':
    $title_site = "Data Table"; $title_act = "Data Table"; $breadcrumb_txt = "Data Table";
    $include_module = "module/module_demo/datatable.inc.php";
    $module=="datatable" ? ($active_datatable="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_datatable=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'tabview':
    $title_site = "TAB View"; $title_act = "TAB View"; $breadcrumb_txt = "TAB View";
    $include_module = "module/module_demo/tab.inc.php";
    $module=="tabview" ? ($active_tabview="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_tabview=""); #ไฮไลท์เมนูด้านซ้าย
  break;  

  case 'qrscaner':
    $title_site = "QR Scaner"; $title_act = "QR Scaner"; $breadcrumb_txt = "QR Scaner";
    $include_module = "module/module_demo/qr.inc.php";
    $module=="qrscaner" ? ($active_qrscaner="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_qrscaner=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'dashboard':
  default :
    $include_module = "dashboard.inc.php";
    $module=="dashboard" || $module=="" ? $active_dashbord="active" : $active_dashbord=""; #ไฮไลท์เมนูด้านซ้าย
    $title_act = $title_site_3; $breadcrumb_txt = $title_site_3;
  break;
}

/*
if($_SESSION['sess_id_location']==0 || $_SESSION['sess_id_dept']==0){
  if($module=="howto"){
    $include_module = "module/module_howto/list.inc.php";  
  }else{
    $include_module = "module/module_user/profile.inc.php";
    $title_act = "หน้าหลัก";
    $title_site = "แก้ไขข้อมูลส่วนตัว"; $title_act = "แก้ไขข้อมูลส่วนตัว"; $breadcrumb_txt = "แก้ไขข้อมูลส่วนตัว";
  }
}
*/

$obj = new CRUD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<title><?PHP echo $title_site; ?></title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome -->
<!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">--> <!-- เวอร์ชั่นเก่า -->
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-5.15.4/css/all.min.css">

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<!--<link rel="stylesheet" href="dist/css/adminlte.min.css">-->
<link rel="stylesheet" href="dist/css/adminlte.css">
<!-- Customize Theme style -->
<link rel="stylesheet" href="dist/css/adminlte_cus.css">
<!-- fontface -->
<link rel="stylesheet" href="dist/css/fontface.css">  
<!-- overlayScrollbars -->  
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- jQuery jQuery v3.6.0 -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script> 
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<link rel="stylesheet" href="dist/css/adminlte_pcs.css">
<script src="dist/js/pcs_demo.js"></script>
<script src="dist/js/script.js"></script>

<!-- Script allPage -->

<!-- Script sweetalert popup -->
<script src="plugins/sweetalert/sweetalert.js"></script>
<link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">

<!-- JS, Popper.js, and jQuery ทดลองปิด 12-06-2022-->
<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>-->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<!--<script src="dist/js/jquery.cookie.js"></script>-->

<style>
  @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap');
</style>

<style type="text/css">
  body{
      font-size:0.85rem;
      /*font-family: "Noto Sans Thai",sans-serif;*/
      font-family: 'Sarabun', sans-serif;
      font-style: normal;
      font-weight:500;
  }
</style>

<script type="text/javascript"> 
  $(document).ready(function(){
    $('#pushmenu').click(function(){
      //this.hide();
      $('.text-pcs-ct').html() == "<?PHP echo $title_site_1; ?>" ? $('.text-pcs-ct').html('') : $('.text-pcs-ct').html('<?PHP echo $title_site_1; ?>');
    });

    <?PHP if($_SESSION['sess_popup_howto']==0){ ?>
      //$('#Modalhowto').modal('show');
    <?PHP 
      $_SESSION['sess_popup_howto'] = 1 ;
    } 
    ?>

    /*สกอร์บาร์*/
    $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
    });
    $('.scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 },800);
    return false;
    });		

  });//document
</script>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed"><!--sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed sidebar-closed sidebar-collapse layout-navbar-fixed-->
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-2x fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./" class="nav-link">หน้าหลัก</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?module=howto" class="nav-link">คู่มือการใช้งาน</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><div class="ul-datetime-clock"><ul><li>วัน<?php echo $arr_day_of_week[date('N', strtotime('today'))];?>ที่ <?php echo nowDate(date('Y-m-d H:i:s'));?>&nbsp;</li><li id="css_time_run"> เวลา: <?php echo date("H:i:s");?> นาที</li></ul></div><!--clock--></li>
    </ul>
        
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#00387c;">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
    <img src="dist/img/logo_2.png" alt="JWD Logo" class="w-100 p-0 m-0" >
      <!--<img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image brand-text" >-->
      <span class="font-weight-bold p-1 mt-2 text-pcs-ct"><?PHP echo $title_site_1; ?></span>
    </a>                  
                  
    <!-- Sidebar -->
    <div class="sidebar"><br /><br />
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-1 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?PHP echo $_SESSION['sess_fullname'];?></a>
          <span class="text-white">ระดับ: <?PHP echo $classArr[$_SESSION['sess_class_user']]; ?></span><br />
          <span class="text-white">ไซต์งาน: <?PHP echo $_SESSION['sess_site_initialname'];?> แผนก: <?PHP echo $_SESSION['sess_dept_initialname'];?></span>
          <a href="?module=profile" class="d-block text-yellow">[แก้ไขข้อมูลส่วนตัว]</a>
        </div>
      </div>
 
      <!-- Sidebar Menu active-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"><a href="./" class="nav-link <?PHP echo $active_dashbord;?>"><i class="nav-icon fa fa-solid fa-chalkboard"></i> <p>แดชบอร์ด</p></a></li>
        <li class="nav-item"><a href="?module=create-request" class="nav-link <?PHP echo $active_createrequest;?>"><i class="nav-icon fas fa-tools"></i> <p>แจ้งซ่อม</p></a></li>
        <li class="nav-item"><a href="?module=requestlist" class="nav-link <?PHP echo $active_requestlist;?>"><i class="nav-icon fas fa-file-invoice"></i> <p>ติดตาม-ประเมิน</p> </a></li>
        <li class="nav-item"><a href="?module=news" class="nav-link <?PHP echo $active_news;?>"><i class="nav-icon fas fa-bell"></i> <p>ข่าวประกาศ</p></a></li>
        <!--<li class="nav-item"><a href="?module=news" class="nav-link <?PHP echo $active_news;?>"><i class="nav-icon fas fa-file-excel"></i> <p>ใบบันทึกรายงาน</p></a></li>-->
        <?PHP if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==5){ ?>
          <!--<li class="nav-item"><a href="?module=requisition" class="nav-link <?PHP echo $active_req; ?>"><i class="nav-icon fa fa-fist-raised"></i><p>จ่ายงานซ่อม</p></a></li>-->
        <?PHP } ?>
        <?PHP 
            $query_dept ='';
            if($_SESSION['sess_class_user']==2 || $_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==5){##11
              if($_SESSION['sess_class_user']!=5){
                $query_dept = " AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']."";
              }
              ##$numRow_waitapprove ===== นับงานรออนุมัติ
              $numRow_waitapprove = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request 
              WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site'].$query_dept." AND tb_maintenance_request.status_approved=0 AND tb_maintenance_request.maintenance_request_status=1"); 

              ##$numRow_accept ===== จำนวนงานที่รอกดรับงาน (งานที่ได้รับมอบหมายให้ซ่อม)
              $numRow_accept = $obj->getCount("SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request WHERE  tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site'].$query_dept." AND tb_maintenance_request.status_approved=1 AND tb_maintenance_request.maintenance_request_status=1 AND tb_maintenance_request.status_approved=1 AND tb_maintenance_request.allotted_date IS NOT NULL AND tb_maintenance_request.allotted_accept_date IS NULL"); 

              ##$numRow_handover ===== จำนวนงานที่รอส่งมอบ
              $numRow_handover = $obj->getCount("SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." ".$query_dept." AND tb_maintenance_request.maintenance_request_status=1 AND tb_maintenance_request.allotted_date IS NOT NULL AND tb_maintenance_request.allotted_accept_date IS NOT NULL AND tb_maintenance_request.duration_serv_end IS NOT NULL AND tb_maintenance_request.hand_over_date IS NULL");


              ##$total_alljob ===== จำนวนงานทั้งหมดของคุณ
              $sql_fetch_alljob = "SELECT tb_maintenance_request.*, tb_ref_repairer.* FROM tb_maintenance_request 
              LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request) 
              WHERE (tb_maintenance_request.allotted_accept_date IS NULL OR tb_maintenance_request.duration_serv_start IS NULL OR tb_maintenance_request.hand_over_date IS NULL) ".$query_dept." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']." AND tb_maintenance_request.maintenance_request_status=1 AND tb_ref_repairer.ref_id_user_repairer=".$_SESSION['sess_id_user']." AND tb_ref_repairer.status_repairer=1 ";
              $total_alljob = $obj->countAll($sql_fetch_alljob."");              
          ?>
          <?PHP
            if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==5){?>
          <li class="nav-item"><a href="?module=waitapprove" class="nav-link <?PHP echo $active_waitapprove;?>"><i class="nav-icon fas fa-hourglass-half"></i> <p>งานรออนุมัติซ่อม</p><span class="float-right badge bg-light"><?PHP echo $numRow_waitapprove; ?></span></a></li>
          <li class="nav-item"><a href="?module=waitaccept" class="nav-link <?PHP echo $active_waitaccept;?>"><i class="nav-icon fas fa-handshake"></i> <p>งานรอช่างรับงาน</p><span class="float-right badge bg-light"><?PHP echo $numRow_accept; ?></span></a></li>
          <li class="nav-item"><a href="?module=handover" class="nav-link <?PHP echo $active_handover;?>"><i class="nav-icon fas fa-flag-checkered"></i> <p>งานรอส่งมอบ</p><span class="float-right badge bg-success"><?PHP echo $numRow_handover; ?></span></a></li>
          <li class="nav-item"><a href="?module=allrequestlist" class="nav-link <?PHP echo $active_allrequestlist;?>"><i class="nav-icon fas fa-file-invoice"></i> <p>ใบแจ้งซ่อมทั้งหมด</p></a></li>          
            <?PHP }?>
        <li class="nav-item"><a href="?module=joblist" class="nav-link <?PHP echo $active_joblist;?>"><i class="nav-icon fas fa-wrench"></i> <p>งานซ่อมของคุณ</p><span class="float-right badge bg-warning"><?PHP echo $total_alljob; ?></span></a></li>
        <?PHP }##11 ?>
        <li class="nav-item"><a href="?module=machine-site" class="nav-link <?PHP echo $active_machine_site;?>"><i class="nav-icon fas fa-industry"></i> <p>เครื่องจักร-อุปกรณ์รายไซต์</p></a></li>
        
    
        <li class="nav-item <?PHP echo $active_treeview_2; ?>"><!--ถ้าจะให้เปิดใส่คลาส menu-open-->
            <a href="#" class="nav-link"><i class="nav-icon fa fa-file-alt"></i><p>รายงาน<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="?module=dashboard_report" class="nav-link <?PHP echo $active_dashboard_report;?>"><i class="nav-icon fa fa-solid fa-chalkboard"></i> <p>แดชบอร์ด</p></a></li>
              <li class="nav-item"><a href="?module=report" class="nav-link <?PHP echo $active_report;?>"><i class="nav-icon fa fas fa-file-invoice"></i> <p>รายงานใบแจ้งซ่อม</p></a></li>
              <li class="nav-item"><a href="?module=request_report" class="nav-link <?PHP echo $active_request_report;?>"><i class="nav-icon fa fas fa-chart-pie"></i> <p>สถานะใบแจ้งซ่อม</p></a></li>
              <li class="nav-item"><a href="?module=machine_report" class="nav-link <?PHP echo $active_machine_report;?>"><i class="nav-icon fa fa-chart-bar"></i> <p>รายงานเครื่องจักร-อุปกรณ์</p></a></li>
              <?PHP if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==4 || $_SESSION['sess_class_user']==5){?>
              <li class="nav-item"><a href="?module=user_report" class="nav-link <?PHP echo $active_user_report;?>"><i class="nav-icon fa fas fa-users"></i> <p>สถิติผู้ใช้งานแจ้งซ่อม</p></a></li>
              <?php } ?>
            </ul>
        </li>
    

        <?PHP if($_SESSION['sess_class_user']==3 || $_SESSION['sess_class_user']==5){?>
        <li class="nav-item <?PHP echo $active_treeview_1; ?>"><!--ถ้าจะให้เปิดใส่คลาส menu-open-->
            <a href="#" class="nav-link"><i class="nav-icon fas fa-sitemap"></i><p>จัดการระบบ<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="?module=mtr-setting" class="nav-link <?PHP echo $active_mtr; ?>"><i class="nav-icon fas fa-file-invoice"></i> <p>ตั้งค่าใบแจ้งซ่อม</p></a></li>                
              <li class="nav-item"><a href="?module=machine-master" class="nav-link <?PHP echo $active_machine; ?>"><i class="fa fa-caret-right nav-icon"></i><p>เครื่องจักร-อุปกรณ์ (Master)</p></a></li>
              <li class="nav-item"><a href="?module=category" class="nav-link <?PHP echo $active_category; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ประเภทเครื่องจักร-อุปกรณ์</p></a></li>
              <li class="nav-item"><a href="?module=newslist" class="nav-link <?PHP echo $active_newslist; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ข่าวประกาศ</p></a></li>
              <li class="nav-item"><a href="?module=userlist" class="nav-link <?PHP echo $active_userlist; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ผู้ใช้งาน</p></a></li>
              <li class="nav-item"><a href="?module=permission" class="nav-link <?PHP echo $active_permission; ?>"><i class="fa fa-caret-right nav-icon"></i><p>สิทธิ์การใช้งาน</p></a></li>
              <li class="nav-item"><a href="?module=site" class="nav-link <?PHP echo $active_site; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ไซต์งาน</p></a></li>
              <li class="nav-item"><a href="?module=building" class="nav-link <?PHP echo $active_building; ?>"><i class="fa fa-caret-right nav-icon"></i><p>อาคาร</p></a></li>
              <li class="nav-item"><a href="?module=location" class="nav-link <?PHP echo $active_location; ?>"><i class="fa fa-caret-right nav-icon"></i><p>สถานที่</p></a></li>                            
              <li class="nav-item"><a href="?module=dept" class="nav-link <?PHP echo $active_dept; ?>"><i class="fa fa-caret-right nav-icon"></i><p>แผนก</p></a></li>
              <li class="nav-item"><a href="?module=unit" class="nav-link <?PHP echo $active_unit; ?>"><i class="fa fa-caret-right nav-icon"></i><p>หน่วยนับ</p></a></li>
              <li class="nav-item"><a href="?module=brand" class="nav-link <?PHP echo $active_brand; ?>"><i class="fa fa-caret-right nav-icon"></i><p>แบรนด์</p></a></li>
              <li class="nav-item"><a href="?module=supplier" class="nav-link <?PHP echo $active_supplier; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ซัพพลายเออร์</p></a></li>
            </ul>
          </li>
          <!--<li class="nav-item"><a href="?module=system-setting" class="nav-link"><i class="nav-icon fas fa-cog"></i> <p>ตั้งค่าระบบ</p></a></li>-->
          
          <!--<li class="nav-item"><a href="?module=tabview" class="nav-link <?PHP echo $active_tabview; ?>"><i class="fas fa fa-bars nav-icon"></i> <p> TAB View</p></a></li>-->
          <!--<li class="nav-item"><a href="?module=qrscaner" class="nav-link <?PHP echo $active_qrscaner; ?>"><i class="fas fa fa-qrcode nav-icon"></i> <p> QR Scanner</p></a></li>-->
          <!--<li class="nav-item"><a href="?module=datatable" class="nav-link <?PHP echo $active_datatable; ?>"><i class="fas fa fa-table nav-icon"></i> <p> Datatable</p></a></li>-->
        <?PHP } ?>
          <li class="nav-item"><a href="?module=logout" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p> ออกจากระบบ</p></a></li>          
          <li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <?PHP
    //echo "<pre>".print_r($_SESSION)."</pre>";
    include($include_module);
    ?>
    <!-- Main content -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <strong>Copyright &copy; 2022 <a href="#">jwdcoldchain.com</a>.</strong> All rights reserved.
    <?PHP
    $end   = $Time->End_Time();
    $total = $Time->Total_Time($start,$end);
    $Time->show_msg($total);
    echo print_mem();
    ?>
    <div class="float-right d-none d-sm-inline-block">
      <b>Phase 1 / Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<a href="#" class="scrollup"><i class="fas fa-angle-double-up"></i> เลื่อนขึ้น</a>
</body>
</html>
<?PHP 
//$text;
?>