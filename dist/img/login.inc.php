<?PHP
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');	
error_reporting(error_reporting() & ~E_NOTICE);

require_once ('include/class_crud.inc.php');

$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
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
  .logo{ width:200px; margin:0px 0px 15px 35px; text-align:center;}
  </style>


<script type="text/javascript"> 
  $(document).ready(function(){

  });//document
</script>


</head>

<body class="hold-transition login-page" style="background:url(dist/img/bg_login.png) no-repeat; background-position: 58.33325% center;">

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<section class="h-100">
		<div class="container h-100 col-md-16">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="dist/img/logo_2.png" alt="logo" class="logo img-responsive" >
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">เข้าสู่ระบบ Central Store Online</h4><br /><br />
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">จำรหัสผ่าน</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										เข้าระบบ
									</button>
								</div>
								<div class="mt-4 text-center">
									หากไม่มีอีเมล์เข้าใช้งาน ติดต่อแผนก IT
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2022 &mdash; JWD Pacific Cold Storage
					</div>
				</div>
			</div>
		</div>
	</section>


<script>

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$(document).ready(function () { //When the page has loaded
  //sweetAlert("ผิดพลาด...", "รูปแบบอีเมล์ไม่ถูกต้อง!", "error"); //The error will display
  <?PHP 
    if(isset($_COOKIE["remember_log"])==1){
      echo "$('#remember').prop('checked', true);";
    }
  ?>

  $("#chk_login").click(function(){
  if (!isEmail($("#email").val())){
    sweetAlert("ผิดพลาด...", "รูปแบบอีเมล์ไม่ถูกต้อง!", "error"); //The error will display
		return false;
 	}else if($("#password").val()==""){
    sweetAlert("ผิดพลาด...", "กรุณากรอกรหัสผ่าน", "error"); //The error will display
		return false;
  }else{
		return true;  
  }
    
  });


});

</script>


<?PHP
//print_r($_POST); //ตรวจสอบมี input อะไรบ้าง และส่งอะไรมาบ้าง 
//ถ้ามีค่าส่งมาจากฟอร์ม
  if(isset($_POST['email']) && isset($_POST['password']) ){

    //ประกาศตัวแปรที่รับค่าจากฟอร์ม 
    //$email = $_POST['email'];
    $password = sha1($_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
    /*echo $_POST['email'].'-----------------------'.$password; //เช็คล็อกอินจากฟังก์ชั่น โดยส่งค่า email-pass ไปเช็ค class_crud.php
    echo "<br />";
    echo $_POST['remember'];    die;*/


    $fetchRow = $obj->fetchRows("SELECT tb_user.*,
    tb_location.location_short, tb_location.location_name,
    tb_dept.dept_name, tb_dept.initial_name FROM tb_user
    LEFT JOIN tb_location ON (tb_location.id_location=tb_user.ref_branch) 
    LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_dept) 
    WHERE email='".$_POST['email']."' AND password='".$password."'");



    if (!empty($fetchRow) && count($fetchRow)==1){
      //$fetchRow[0]['photo_name']

      if($_POST['remember']==1){
        setcookie("remember_log",$_POST['remember'],time()+3600*24*356);
        setcookie("email_log",$_POST['email'],time()+3600*24*356);
        setcookie("password_log",$_POST['password'],time()+3600*24*356);
      }

      $_SESSION['sess_id_user'] = $fetchRow[0]['id_user'];
      $_SESSION['sess_no_user'] = $fetchRow[0]['no_user'];
      $_SESSION['sess_email'] = $fetchRow[0]['email'];
      $_SESSION['sess_ref_branch'] = $fetchRow[0]['ref_branch'];
      $_SESSION['sess_fullname'] = $fetchRow[0]['fullname'];
      $_SESSION['sess_class_user'] = $fetchRow[0]['class_user'];
      $_SESSION['sess_location_name'] = $fetchRow[0]['location_name'];
      $_SESSION['sess_dept_name'] = $fetchRow[0]['dept_name'];            
      $_SESSION['sess_status_user'] = $fetchRow[0]['status_user'];
      header('Location:?module=branch'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ ?module=dashboard
    }else{
      echo '<script>sweetAlert("ผิดพลาด...", "ไม่พบผู้ใช้งานที่ระบุ ", "error");</script>';
      $conn = null; //close connect db
    }

  } //isset 
  ?>


</body>
</html>
