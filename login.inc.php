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
        padding-top:2rem;
    }
  .logo{ width:200px; margin:0px 0px 15px 35px; text-align:center;}
  </style>


<script type="text/javascript"> 
  $(document).ready(function(){

  });//document
</script>


</head>

<body class="hold-transition login-page" style="background:url(dist/img/bg_login.png) no-repeat; background-position: 58.33325% center;">

<section class="h-100">
		<div class="container h-100 col-md-12">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="dist/img/logo_2.png" alt="logo" class="logo img-responsive" >
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center w-100 text-bold" style="line-height:1.8rem;">เข้าสู่ระบบ E-Service <br />แจ้งซ่อมออนไลน์</h4><br /><br />
              <!--ฟอร์มลงทะเบียน-->
							<form method="POST" id="frm_register" name="frm_register" class="my-login-validation " novalidate=""><br />
              <div class="text-md text-bold text-red mt-2 mb-1 text-center">ลงทะเบียนใช้งานระบบ</div>

            <div class="form-group">  
                <label for="no_user">รหัสพนักงาน</label>  
                <input type="text" maxlength="7" id="no_user" name="no_user" placeholder="รหัสพนักงาน" class="numberonly form-control w-10" onKeyPress="return IsNumeric(event);"  aria-describedby="inputGroupPrepend" autocomplete="off" />  
                <div class="invalid-feedback">กรอกรหัสพนักงาน</div>
            </div>
            
            <div class="form-group">  
                <label for="fullname">ชื่อ-นามสกุล พนักงาน</label>  
                <input type="text" maxlength="40" id="fullname" name="fullname" placeholder="ชื่อ-นามสกุล" class="form-control w-10" autocomplete="off" />  
                <div class="invalid-feedback">กรอกชื่อ-นามสกุล พนักงาน</div>
            </div>            

              <div class="form-group">
									<label for="email">ระบุอีเมล์ที่ใช้งาน</label>
									<input type="email" class="form-control" id="email_regis" name="email_regis" required autofocus>
									<div class="invalid-feedback">Email is invalid</div>
								</div>

								<div class="form-group">
									<label for="password">รหัสผ่าน</label>
									<input id="password_regis" type="password" class="form-control" name="password_regis" autocomplete="off" required>
                <div class="invalid-feedback">Password is required</div>
								</div>

								<div class="form-group">
                <label for="slt_manage_site">ไซต์ที่งาน:</label>  <br />
                    <select class="custom-select custom-select-md rounded-3" id="slt_regis_site" name="slt_regis_site" style="width:260px;">
                        <option value="0">เลือกไซต์งาน</option>
                        <?PHP
                            $rowSite= $obj->fetchRows("SELECT * FROM tb_site WHERE site_status=1 ORDER BY site_initialname DESC");
                            if (count($rowSite)>0) {
                                foreach($rowSite as $key => $value) { 
                                    //$rowSite[$key]['id_site']==1 ? $selected='selected' : $selected='';
                                    echo '<option '.$selected.' value="'.$rowSite[$key]['id_site'].'">'.$rowSite[$key]['site_initialname'].' - '.$rowSite[$key]['site_name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

								<div class="form-group">
                <label for="slt_regis_dept">แผนกของคุณ:</label><br />
                <select class="custom-select" id="slt_regis_dept" name="slt_regis_dept" required>  
                <option value="0" >เลือกแผนก</option>  
                <?PHP
                $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE dept_status=1 ORDER BY id_dept ASC");
                if (count($rowData)!=0) {
                      foreach($rowData as $key => $value) {
                        //$key+1==2 ? $selected='selected' : $selected='';
                          echo '<option '.$selected.' value="'.($key+1).'">'.$rowData[$key]['dept_name'].' ('.$rowData[$key]['dept_initialname'].')</option>';
                      }
                  } 
                  ?>
              </select>
                </div>

								<div class="form-group m-0">
									<button type="button" class="btn btn-success btn-block" id="chk_register">ลงทะเบียนใช้งาน</button>
								</div>
								<div class="mt-4 text-center"><a href="#" class="btn-back text-pimary"><i class="fas fa-undo-alt"></i> คลิกที่นี่เพื่อกลับไปหน้าล็อกอิน</a></div>
                </form>

                <!-------------------------------------------------------------->
							<form method="POST" id="frm_login" name="frm_login" class="my-login-validation" novalidate=""><br />
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">Email is invalid</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" autocomplete="off" required>
                <div class="invalid-feedback">Password is required</div>
								</div>

								<div class="form-group">
                <label for="slt_manage_site">ไซต์ที่งาน:</label>  <br />
                    <select class="custom-select custom-select-md rounded-3" id="slt_manage_site" name="slt_manage_site" style="width:260px;">
                        <option value="0">เลือกไซต์งาน</option>
                        <?PHP
                            $rowDept= $obj->fetchRows("SELECT * FROM tb_site WHERE site_status=1 ORDER BY site_initialname DESC");
                            if (count($rowDept)>0) {
                                foreach($rowDept as $key => $value) { 
                                    //
                                    echo '<option '.$selected.' value="'.$rowDept[$key]['id_site'].'">'.$rowDept[$key]['site_initialname'].' - '.$rowDept[$key]['site_name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" id="chk_login">เข้าระบบ</button>
								</div>
								<div class="mt-4 text-center"><a href="#" class="btn-register text-pimary"><i class="fas fa-user-plus"></i> คลิกที่นี่เพื่อลงทะเบียนใช้งาน</a></div>
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

  $('form#frm_register').hide();
  
  $('.btn-back').click(function(){
        $("form#frm_register").trigger("reset");
        $('form#frm_login').fadeIn(1000).show();
        $('form#frm_register').fadeOut(1000).hide();
  });

  $('.btn-register').click(function(){
        $('form#frm_login').fadeOut(1000).hide();
        $('form#frm_register').fadeIn(1000).show();
  });


  //$("#frm_register").on('click', '#chk_register', function(e){
  $(document).on('click','#chk_register',function(e){    
    //alert('111111111');
    if($("#no_user").val()==""){
      sweetAlert("ผิดพลาด...", "กรุณากรอกรหัสพนักงาน", "error"); //The error will display
      return false;
    }else if($("#no_user").val().length<5){
      sweetAlert("ผิดพลาด...", "รหัสพนักงานไม่ถูกต้อง", "error"); //The error will display
      return false;
    }else if (!isEmail($("#email_regis").val())){
      sweetAlert("ผิดพลาด...", "รูปแบบอีเมล์ไม่ถูกต้อง!", "error"); //The error will display
      return false;
    }else if($("#password_regis").val()==""){
      sweetAlert("ผิดพลาด...", "กรุณากรอกรหัสผ่าน", "error"); //The error will display
      return false;
    }else if($("#fullname").val()==""){
      sweetAlert("ผิดพลาด...", "กรุณากรอกชื่อ-นามสกุล", "error"); //The error will display
      return false;
    }else if($('#slt_regis_site option:selected').val()<=0){
      sweetAlert("ผิดพลาด...", "เลือกไซต์งานของคุณ", "error"); //The error will display
      return false;
    }else if($('#slt_regis_dept option:selected').val()<=0){
      sweetAlert("ผิดพลาด...", "เลือกแผนกของคุณ", "error"); //The error will display
      return false;
    }else{
      //$("#frm_register").submit();
        var frmData = $("form#frm_register").serialize();
        $.ajax({
        url: "module/module_user/ajax_action.php",
        type: "POST",
        //dataType: "json",
        data: {'action':'register_user', data:frmData},
        //processData: false,
        //contentType: false,
        beforeSend: function () {
          //$("#overlay").fadeIn();
          //alert('22222222222');
        },
        success: function (data) {
          console.log(data); 
          data = $.trim(data.replace(/\s+/g," "));
          if(data=='mail_dup'){           
            sweetAlert("อีเมล์นี้ถูกใช้งานแล้ว!", "อีเมล์ "+($('#email_regis').val())+" \r\n ถูกใช้งานแล้ว", "error");
            return false;
          }
          if ($.isNumeric(data)) {
            swal({
              title: "ลงทะเบียนสำเร็จ!",
              text: "กรุณารออนุมัติการใช้งาน. หรือแจ้งอีเมล์ที่ใช้ลงทะเบียน \r\n ในไลน์กลุ่มเพื่อเปิดใช้งาน",
              type: "success",
              //timer: 3000
            }, 
            function(){
              window.location.href = "./";
            })

            //$("body form#needs-validation")[0].reset();
            //sweetAlert("สำเร็จ...", alertmsg, "success");
            //window.location.href = "./";
            //$("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
            //$("#overlay").fadeOut();
          }
        },
        error: function (response) {
          console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!"+response);
          sweetAlert("ไม่สำเร็จ!", 'กรุณาติดต่อฝ่าย IT', "error");
          return false;
        },
      });
    }
    e.preventDefault();
    //You logic here
   //Submit form at the end if you want
   //$("#form_id").submit();
});

 //sweetAlert("ผิดพลาด...", "รูปแบบอีเมล์ไม่ถูกต้อง!", "error"); //The error will display

  $("#chk_login").click(function(){
  if (!isEmail($("#email").val())){
    sweetAlert("ผิดพลาด...", "รูปแบบอีเมล์ไม่ถูกต้อง!", "error"); //The error will display
		return false;
 	}else if($("#password").val()==""){
    sweetAlert("ผิดพลาด...", "กรุณากรอกรหัสผ่าน", "error"); //The error will display
		return false;
  }else if($('#slt_manage_site option:selected').val()<=0){
    sweetAlert("ผิดพลาด...", "เลือกไซต์งานของคุณ", "error"); //The error will display
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
    $_POST['email'] = trim($_POST['email']);
    $_POST['password'] = trim($_POST['password']);
    //ประกาศตัวแปรที่รับค่าจากฟอร์ม 
    //$email = $_POST['email'];
    $password = sha1($keygen.$_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
    /*echo $_POST['email'].'-----------------------'.$password; //เช็คล็อกอินจากฟังก์ชั่น โดยส่งค่า email-pass ไปเช็ค class_crud.php
    echo "<br />";
    echo $_POST['remember'];    die;*/

   /*echo "SELECT tb_user.*, tb_dept.dept_initialname, tb_dept.dept_name, tb_site.site_initialname FROM tb_user 
    LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_id_dept) 
    LEFT JOIN tb_site_responsibility ON (tb_site_responsibility.ref_id_user=".$_POST['slt_manage_site'].") 
    LEFT JOIN tb_site ON (tb_site.id_site=".$_POST['slt_manage_site'].") 
    WHERE tb_user.email='".$_POST['email']."' AND tb_user.password='".$password."'";
    exit();*/


    $query_login = "SELECT tb_user.*, tb_dept.dept_initialname, tb_dept.dept_name, tb_site.site_initialname, tb_site_responsibility.ref_id_site AS chk_ref_id_site FROM tb_user 
    LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_user.ref_id_dept) 
    LEFT JOIN tb_site_responsibility ON (tb_site_responsibility.ref_id_user=tb_user.id_user) 
    LEFT JOIN tb_site ON (tb_site.id_site=".$_POST['slt_manage_site'].") 
    WHERE tb_user.email='".$_POST['email']."' AND tb_user.password='".$password."' AND tb_site_responsibility.ref_id_site=".$_POST['slt_manage_site']."";
    $Row = $obj->customSelect($query_login);   

    if(empty($Row['status_user'])){
      echo '<script>sweetAlert("ผิดพลาด...", "ชื่อผู้ใช้ระบบหรือเลือกไซต์งานไม่ถูกต้อง ", "error");</script>';
      $conn = null; //close connect db
      exit();
    }

    if (((!empty($Row) && $Row['chk_ref_id_site']!='') || $Row['class_user']==5) && $Row['status_user']==1){
      //echo '22222222222'; exit();      
      //$Row['photo_name']
      /*if($_POST['remember']==1){
        setcookie("remember_log",$_POST['remember'],time()+3600*24*356);
        setcookie("email_log",$_POST['email'],time()+3600*24*356);
        setcookie("password_log",$_POST['password'],time()+3600*24*356);
      }*/
      /*
      echo $Row['ref_id_site'];
      if($Row['class_user']!=5 && ($Row['ref_id_site']!=intval($_POST['slt_manage_site']))){
        echo '<script>sweetAlert("ผิดพลาด...", "ผู้ใช้ระบบหรือไซต์งานไม่ถูกต้อง ", "error");</script>';
        exit();
      }
      */

      $_SESSION['sess_id_user'] = $Row['id_user'];
      $_SESSION['sess_no_user'] = $Row['no_user'];
      $_SESSION['sess_email'] = $Row['email'];
      //$_SESSION['sess_ref_id_site'] = $Row['ref_id_site'];
      $_SESSION['sess_ref_id_site'] = intval($_POST['slt_manage_site']);
      $_SESSION['sess_site_initialname'] = $Row['site_initialname'];
      $_SESSION['sess_fullname'] = $Row['fullname'];
      $_SESSION['sess_class_user'] = $Row['class_user'];
      $_SESSION['sess_id_dept'] = $Row['ref_id_dept'];
      $_SESSION['sess_dept_name'] = $Row['dept_name'];
      $_SESSION['sess_dept_initialname'] = $Row['dept_initialname'];      
      //$_SESSION['sess_dept_initialname'] = 'PCS';
      $_SESSION['sess_status_user'] = $Row['status_user'];
      $_SESSION['sess_popup_howto'] = 0;
   
      $fetchPermission= $obj->fetchRows("SELECT tb_permission.* FROM tb_permission WHERE ref_class_user=".$Row['class_user']."");
      foreach($fetchPermission as $key=>$value){
        $_SESSION['module_access'] =  $fetchPermission[$key]['module_name'].'-'.$fetchPermission[$key]['accept_denied'];
        //$fetchPermission[$key]['module_name']
      }

      //echo $_SESSION['sess_id_user']; exit();

    ?>
    <script type="text/javascript">

      //$.cookie("showHowto", "show");    
      //$.cookie("data", $("#cookieData").val());      
    </script>      
    <?PHP
       header('Location:./'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ ?module=dashboard
    }else{
      if($Row['status_user']==2){
        //echo '3333333333333'; exit();        
        echo '<script>sweetAlert("ถูกระงับใช้งาน", "คุณถูกระงับการใช้งาน \r\n กรุณาติดต่อฝ่าย IT เพื่อตรวจสอบ", "error");</script>';
        $conn = null; //close connect db
        exit();
      }else if($Row['status_user']==3){        
        //echo '444444444444';exit();
        echo '<script>sweetAlert("รออนุมัติ...", "ชื่อผู้ใช้งานนี้ \r\nอยู่ระหว่างรออนุมัติการใช้", "error");</script>';
        $conn = null; //close connect db
        exit();
      }else{
        //echo '55555555555';        exit();        
        echo '<script>sweetAlert("ผิดพลาด...", "ชื่อผู้ใช้ระบบหรือเลือกไซต์งานไม่ถูกต้อง ", "error");</script>';
        $conn = null; //close connect db
        exit();
      }
    }

  } //isset 
  ?>


</body>
</html>
