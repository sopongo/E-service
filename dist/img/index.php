<?PHP
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');	

require_once ('include/connect_db.inc.php');
require_once ('include/function.inc.php');
require_once ('include/setting.inc.php');
require_once ('include/class_crud.inc.php');
//require_once ('include/timer.inc.php');
require_once ('include/query_class.inc.php');
error_reporting(error_reporting() & ~E_NOTICE);

//$stmt = new CRUD();

if($_SESSION['sess_id_user']==NULL && $_SESSION['sess_status_user']==NULL){ 
  $_SESSION = []; //empty array. 
  session_destroy(); die(include('login.inc.php')); 
}


/*เช็คการรับค่าโมดูลต่างๆ เพื่อดึงไฟล์มา include โฟลเดอร์ module_xxxx*/
isset($_REQUEST['module']) ? $module = $_REQUEST['module'] : $module = '';


switch($module){  
  case 'adddept':
    $title_site = "เพิ่มแผนก"; $title_act = "เพิ่มแผนก"; $ico_act = "ico32_xxxx";
    $include_module = "module/dept/add.inc.php";
  break;

  case 'offsupp-master':
    $title_site = "วัสดุ-อุปกรณ์ (Master Data)"; $title_act = "วัสดุ-อุปกรณ์ (Master Data)";
    $include_module = "module/module_offsup_master/list.inc.php";
    $module=="offsupp-master" ? ($active_offsupp_master="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'userlist':
    $title_site = "ผู้ใช้งานทั้งหมด"; $title_act = "ผู้ใช้งานทั้งหมด";
    $include_module = "module/module_user/list.inc.php";
    $module=="userlist" ? ($active_userlist="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'category':
    $title_site = "หมวดวัสดุ-อุปกรณ์"; $title_act = "หมวดวัสดุ-อุปกรณ์";
    $include_module = "module/module_category/list.inc.php";
    $module=="category" ? ($active_category="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'requisition':
    $title_site = "เบิกวัสดุ-อุปกรณ์"; $title_act = "เบิกวัสดุ-อุปกรณ์";
    $include_module = "module/module_requisition/requisition.inc.php";
    $module=="requisition" ? ($active_req="active") : ""; #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'requisitionlist':
    $title_site = "ใบเบิกวัสดุ-อุปกรณ์"; $title_act = "ใบเบิกวัสดุ-อุปกรณ์";
    $include_module = "module/module_requisitionlist/list.inc.php";
    $module=="requisition" ? ($active_req="active") : ""; #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'checkout':
    $title_site = "สรุปรายการเบิกวัสดุ-อุปกรณ์"; $title_act = "สรุปรายการเบิกวัสดุ-อุปกรณ์";
    $include_module = "module/module_requisition/checkout.inc.php";
    $module=="requisition" ? ($active_req="active") : ""; #ไฮไลท์เมนูด้านซ้าย
  break;  

  case 'warehouse':
    $title_site = "คลังวัสดุ-อุปกรณ์"; $title_act = "คลังวัสดุ-อุปกรณ์";
    $include_module = "module/module_warehouse/list.inc.php";
    $module=="warehouse" ? ($active_warehouse="active") : ""; #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'site':
    $title_site = "ไซต์งาน"; $title_act = "ไซต์งาน";
    $include_module = "module/module_site/list.inc.php";
    $module=="site" ? ($active_site="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;

  case 'dept':
    $title_site = "แผนก"; $title_act = "แผนก";
    $include_module = "module/module_dept/list.inc.php";
    $module=="dept" ? ($active_dept="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;  

  case 'unit':
    $title_site = "หน่วยนับ"; $title_act = "หน่วยนับ"; $breadcrumb_txt = "หน่วยนับ";
    $include_module = "module/module_unit/list.inc.php";
    $module=="unit" ? ($active_unit="active") && ($active_treeview_1="menu-open") : ($active_treeview_1="menu-close") && ($active_userlist=""); #ไฮไลท์เมนูด้านซ้าย
  break;
  
  case 'logout':
    $title_site = "กำลังทำงาน"; $title_act = "กำลังทำงาน"; $ico_act = "ico32_loading";
    //$include_page = "logout.inc.php";
    include('logout.inc.php');
  break;

  case 'dashboard':
  default :
    $include_module = "dashboard.inc.php";
    $title_site = "หน้าหลัก - PCS - CENTRAL STORE | Dashboard";
    $module=="dashboard" || $module=="" ? $active_dashbord="active" : $active_dashbord=""; #ไฮไลท์เมนูด้านซ้าย
    $title_act = "หน้าหลัก";
  break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <script src="dist/js/pcs_demo.js"></script>

  <!-- Pagination -->
  <script src="dist/js/pagination.js"></script>  
  
  <!-- Script allPage -->
  
  <!-- Script sweetalert popup -->
  <script src="plugins/sweetalert/sweetalert.js"></script>
  <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>    
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap');
  </style>

  <style type="text/css">
    body{
        font-size:0.85rem;
        /*font-family: "Noto Sans Thai",sans-serif;*/
        font-family: 'Sarabun', sans-serif;
        font-style: normal;
        font-weight: 500;
    }
  </style>


<script type="text/javascript"> 
  $(document).ready(function(){

  });//document
</script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-2x fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./" class="nav-link">หน้าหลัก</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">คู่มือการใช้งาน</a>
      </li>
    </ul>



  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#00387c;">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image" >
      <span class="brand-text font-weight-bold">PCS Store Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?PHP echo $_SESSION['sess_fullname'];?></a>
          <a href="#" class="d-block text-yellow">[แก้ไขข้อมูลส่วนตัว]</a>
        </div>
      </div>


      <!-- Sidebar Menu active-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"><a href="./" class="nav-link <?PHP echo $active_dashbord;?>"><i class="nav-icon fa fa-solid fa-chalkboard"></i><p>แดชบอร์ด</p></a></li>
        <li class="nav-item"><a href="?module=warehouse" class="nav-link <?PHP echo $active_warehouse;?>"><i class="nav-icon fa fa-warehouse"></i><p>คลังวัสดุ-อุปกรณ์</p></a></li>
        <li class="nav-item"><a href="?module=requisition" class="nav-link <?PHP echo $active_req; ?>"><i class="nav-icon fa fa-hand-holding"></i><p>เบิก วัสดุ-อุปกรณ์</p></a></li>
        <li class="nav-item"><a href="?module=requisitionlist" class="nav-link <?PHP echo $active_reqlist; ?>"><i class="nav-icon fa fa-file-alt"></i><p>ใบเบิกวัสดุ-อุปกรณ์</p></a></li>
        <li class="nav-item"><a href="?module=inventory" class="nav-link <?PHP echo $active_inven;?>"><i class="nav-icon fa fa-dolly-flatbed"></i> <p>รายการรับ-จ่ายวัสดุ-อุปกรณ์</p></a></li>
        <li class="nav-item"><a href="?module=report" class="nav-link <?PHP echo $active_report;?>"><i class="nav-icon fa fa-file-pdf"></i><p>รายงาน</p></a></li>

          <li class="nav-item <?PHP echo $active_treeview_1; ?>"><!--ถ้าจะให้เปิดใส่คลาส menu-open-->
            <a href="#" class="nav-link"><i class="nav-icon fas fa-sitemap"></i><p>จัดการระบบ<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
            <li class="nav-item"><a href="?module=offsupp-master" class="nav-link <?PHP echo $active_offsupp_master; ?>"><i class="fa fa-caret-right nav-icon"></i><p>วัสดุ-อุปกรณ์ (Master Data)</p></a></li>
              <li class="nav-item"><a href="?module=userlist" class="nav-link <?PHP echo $active_userlist; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ผู้ใช้งาน</p></a></li>
              <li class="nav-item"><a href="?module=site" class="nav-link <?PHP echo $active_site; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ไซต์งาน</p></a></li>
              <li class="nav-item"><a href="?module=dept" class="nav-link <?PHP echo $active_dept; ?>"><i class="fa fa-caret-right nav-icon"></i><p>แผนก</p></a></li>
              <li class="nav-item"><a href="?module=category" class="nav-link <?PHP echo $active_category; ?>"><i class="fa fa-caret-right nav-icon"></i><p>หมวดวัสดุ-อุปกรณ์</p></a></li>
              <li class="nav-item"><a href="?module=unit" class="nav-link <?PHP echo $active_unit; ?>"><i class="fa fa-caret-right nav-icon"></i><p>หน่วยนับ</p></a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="./" class="nav-link"><i class="nav-icon fas fa-cog"></i> <p>ตั้งค่าระบบ</p></a></li>
          <li class="nav-item"><a href="?module=logout" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p> ออกจากระบบ</p></a></li>          
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
        include($include_module);
    ?>
    <!-- Main content -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <strong>Copyright &copy; 2022 <a href="#">jwdcoldchain.com</a>.</strong> All rights reserved.<div class="float-right d-none d-sm-inline-block">
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

</body>
</html>
