<?php
	//$_SESSION = []; //empty array. 
	//session_destroy();
	//echo $_SESSION["class_sess"]==3 || $_SESSION["class_sess"]==0 ? "<div class=\"error\"><img src=\"images/ajax-loader.gif\" width=\"126\" height=\"22\"><span>กำลังออกจากระบบโปรดรอ...</span></div>" : "<div class=\"error\"><img src=\"images/ajax-loader.gif\" width=\"126\" height=\"22\"><span>กำลังออกจากระบบโปรดรอ...</span></div>";
	//echo "<meta Http-equiv=\"refresh\" Content=\"0.5; Url=/ \">";

	
//session_start(); //ประกาศใช้ session
session_destroy(); //เคลียร์ค่า session
header('Location:./'); //Logout เรียบร้อยและกระโดดไปหน้าตามที่ต้องการ

?>


<script type="text/javascript">
$(document).ready(function(){
	$.removeCookie("showHowto");
});
</script>

