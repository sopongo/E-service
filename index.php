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

if($_SESSION['sess_id_user']==NULL && $_SESSION['sess_status_user']==NULL){ 
  $_SESSION = []; //empty array. 
  session_destroy(); die(include('login.inc.php')); 
}

//เริ่มต้นการใช้งาน แทรกส่วนนี้ไว้ตอนต้นๆของเพจ ก่อนการประมวลผล
$Time = new Processing(); // instance to class processing
$start = $Time->Start_Time(); // inits time		


/*เช็คการรับค่าโมดูลต่างๆ เพื่อดึงไฟล์มา include โฟลเดอร์ module_xxxx*/
isset($_REQUEST['module']) ? $module = $_REQUEST['module'] : $module = '';

switch($module){  
 
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
    $module=="mtr-setting" ? ($active_mtr="active") && ($active_treeview_1="menu-close") : ($active_treeview_1="menu-close") && ($active_mtr=""); #ไฮไลท์เมนูด้านซ้าย    
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

if($_SESSION['sess_id_location']==0 || $_SESSION['sess_id_dept']==0){
  if($module=="howto"){
    $include_module = "module/module_howto/list.inc.php";  
  }else{
    $include_module = "module/module_user/profile.inc.php";
    $title_act = "หน้าหลัก";
    $title_site = "แก้ไขข้อมูลส่วนตัว"; $title_act = "แก้ไขข้อมูลส่วนตัว"; $breadcrumb_txt = "แก้ไขข้อมูลส่วนตัว";
  }
}

$obj = new CRUD();
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

<body class="hold-transition sidebar-mini layout-fixed"><!--sidebar-collapse-->
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


  
  <?PHP include('howto.inc.php'); ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#00387c;">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
    <img src="dist/img/logo_2.png" alt="JWD Logo" class="w-100 p-0 m-0" >
      <!--<img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image brand-text" >-->
      <span class="font-weight-bold p-1 mt-2 text-pcs-ct"><?PHP echo $title_site_1; ?></span>
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
          <span class="text-white">ระดับ: <?PHP echo $classUserArr[$_SESSION['sess_class_user']]; ?></span>
          <a href="?module=profile" class="d-block text-yellow">[แก้ไขข้อมูลส่วนตัว]</a>
        </div>
      </div>


      <!-- Sidebar Menu active-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"><a href="./" class="nav-link <?PHP echo $active_dashbord;?>"><i class="nav-icon fa fa-solid fa-chalkboard"></i> <p>แดชบอร์ด</p></a></li>
        <li class="nav-item"><a href="?module=warehouse" class="nav-link <?PHP echo $active_warehouse;?>"><i class="nav-icon fas fa-tools"></i> <p>แจ้งซ่อม</p></a></li>
        <li class="nav-item"><a href="?module=warehouse" class="nav-link <?PHP echo $active_warehouse;?>"><i class="nav-icon fas fa-file-invoice"></i> <p>ใบแจ้งซ่อม</p></a></li>
        <li class="nav-item"><a href="?module=requisition" class="nav-link <?PHP echo $active_req; ?>"><i class="nav-icon fa fa-fist-raised"></i><p>จ่ายงานซ่อม</p></a></li>
        <li class="nav-item"><a href="?module=warehouse" class="nav-link <?PHP echo $active_warehouse;?>"><i class="nav-icon fas fa-wrench"></i> <p>ใบแจ้งซ่อมของคุณ</p></a></li>
        <li class="nav-item"><a href="?module=warehouse" class="nav-link <?PHP echo $active_warehouse;?>"><i class="nav-icon fas fa-industry"></i> <p>เครื่องจักร-อุปกรณ์</p></a></li>

        <?PHP if($_SESSION['sess_class_user']==4){?>
        <li class="nav-item <?PHP echo $active_treeview_1; ?>"><!--ถ้าจะให้เปิดใส่คลาส menu-open-->
            <a href="#" class="nav-link"><i class="nav-icon fas fa-sitemap"></i><p>จัดการระบบ<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="?module=offsupp-master" class="nav-link <?PHP echo $active_offsupp_master; ?>"><i class="fa fa-caret-right nav-icon"></i><p>เครื่องจักร-อุปกรณ์ (Master)</p></a></li>
              <li class="nav-item"><a href="?module=category" class="nav-link <?PHP echo $active_category; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ประเภทเครื่องจักร-อุปกรณ์</p></a></li>
              <li class="nav-item"><a href="?module=userlist" class="nav-link <?PHP echo $active_userlist; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ผู้ใช้งาน</p></a></li>
              <li class="nav-item"><a href="?module=site" class="nav-link <?PHP echo $active_site; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ไซต์งาน</p></a></li>
              <li class="nav-item"><a href="?module=building" class="nav-link <?PHP echo $active_building; ?>"><i class="fa fa-caret-right nav-icon"></i><p>อาคาร</p></a></li>
              <li class="nav-item"><a href="?module=location" class="nav-link <?PHP echo $active_location; ?>"><i class="fa fa-caret-right nav-icon"></i><p>สถานที่</p></a></li>                            
              <li class="nav-item"><a href="?module=dept" class="nav-link <?PHP echo $active_dept; ?>"><i class="fa fa-caret-right nav-icon"></i><p>แผนก</p></a></li>
              <li class="nav-item"><a href="?module=unit" class="nav-link <?PHP echo $active_unit; ?>"><i class="fa fa-caret-right nav-icon"></i><p>หน่วยนับ</p></a></li>
              <li class="nav-item"><a href="?module=brand" class="nav-link <?PHP echo $active_brand; ?>"><i class="fa fa-caret-right nav-icon"></i><p>แบรนด์</p></a></li>
              <li class="nav-item"><a href="?module=supplier" class="nav-link <?PHP echo $active_supplier; ?>"><i class="fa fa-caret-right nav-icon"></i><p>ซัพพลายเออร์</p></a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="?module=mtr-setting" class="nav-link <?PHP echo $active_mtr; ?>"><i class="nav-icon fas fa-file-invoice"></i> <p>ตั้งค่าใบแจ้งซ่อม</p></a></li>
          <li class="nav-item"><a href="?module=system-setting" class="nav-link"><i class="nav-icon fas fa-cog"></i> <p>ตั้งค่าระบบ</p></a></li>
          
          <!--<li class="nav-item"><a href="?module=tabview" class="nav-link <?PHP echo $active_tabview; ?>"><i class="fas fa fa-bars nav-icon"></i> <p> TAB View</p></a></li>-->
          <li class="nav-item"><a href="?module=qrscaner" class="nav-link <?PHP echo $active_qrscaner; ?>"><i class="fas fa fa-qrcode nav-icon"></i> <p> QR Scanner</p></a></li>
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
        include($include_module);
    ?>

    <?PHP
    
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
<?PHP //$text;?>