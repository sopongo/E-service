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

$obj = new CRUD();

$rowID = (!empty($_GET['id'])) ? $_GET['id'] : '';
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
  <script src="dist/js/script.js"></script>


  <!-- Pagination -->
  <script src="dist/js/pagination.js"></script>  
  
  <!-- Script allPage -->
  
  <!-- Script sweetalert popup -->
  <script src="plugins/sweetalert/sweetalert.js"></script>
  <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">

  <!-- JS, Popper.js, and jQuery ทดลองปิด 12-06-2022-->
  <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>-->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap');
  </style>

<style type="text/css">
    body{
    font-size:0.75rem;
    /*font-family: "Noto Sans Thai",sans-serif;*/
    font-family: 'Sarabun', sans-serif;
    font-style: normal;
    font-weight:500;
    }

    table tr td{ color:#333;
    font-style: normal;
    font-weight:500;
    }
    a.page-link{
            font-style: normal;
            font-weight:500;	
    }
    .pagination-input{ position: relative; float:left; width:10%; }
    input.form-control{ width: auto; background:#fff; margin-right:10px;}

    .text-muted{ font-size:0.9rem; color:#ff4f68;}

    a{ cursor:pointer;}


    input[placeholder="ระบุสาเหตุที่ไม่อนุมัติ"]{ margin:auto; width:100%; padding:10px 10px; text-indent:10px;}
    input[placeholder="ระบุสาเหตุที่ยกเลิกใบเบิก"]{ margin:auto; width:100%; padding:10px 10px; text-indent:10px;}

    .text-color1{ color:#993366;}

    .w-40 {
        width:30px !important;
        height: auto;
    }

    @media print {
    .req_remark{ 
        border:0px;background-color:#FFF;
    }
    }
</style>


<script type="text/javascript"> 
  $(document).ready(function(){
    window.print(); 
  });//document
</script>

</head>

<body>

<?PHP

            //$rowData = $obj->customSelect("SELECT * FROM tb_location WHERE tb_location.id_location=".$rowID."");

            $rowData = $obj->customSelect("SELECT tb_requisition.*, tb_user.fullname, tb_user.no_user, tb_user.ref_id_location,
            tb_user.email, tb_dept.initial_name AS user_initial_name, tb_location_user.location_short, COUNT(tb_requisition.id_req) AS total_req,
            tb_user_approve.fullname AS approve_fullname, tb_user_approve.email AS approve_email, tb_user_approve.no_user AS approve_no_user,
            tb_location_approve.location_short AS approve_location_short,
            tb_dept_approve.initial_name AS approve_initial_name,
            tb_location_payer.location_short AS payer_location_short,
            tb_dept_payer.initial_name AS payer_initial_name,
            tb_location_req.location_short AS req_location_short, tb_location_req.location_name AS req_location_name,
            tb_user_payer.fullname AS payer_fullname, tb_user_payer.email AS payer_email, tb_user_payer.no_user AS payer_no_user
            FROM tb_requisition
            LEFT JOIN tb_user ON (tb_user.id_user=tb_requisition.ref_id_user) 
            LEFT JOIN tb_location AS tb_location_user ON (tb_user.ref_id_location=tb_location_user.id_location) 
            LEFT JOIN tb_dept ON (tb_user.ref_dept=tb_dept.id_dept) 
            LEFT JOIN tb_user AS tb_user_approve ON (tb_user_approve.id_user=tb_requisition.ref_id_approver) 
            LEFT JOIN tb_user AS tb_user_payer ON (tb_user_payer.id_user=tb_requisition.ref_id_payer) 
            LEFT JOIN tb_location AS tb_location_approve ON (tb_user_approve.ref_id_location=tb_location_approve.id_location) 
            LEFT JOIN tb_dept AS tb_dept_approve ON (tb_user_approve.ref_dept=tb_dept_approve.id_dept) 
            LEFT JOIN tb_location AS tb_location_payer ON (tb_user_payer.ref_id_location=tb_location_payer.id_location) 
            LEFT JOIN tb_dept AS tb_dept_payer ON (tb_user_payer.ref_dept=tb_dept_payer.id_dept) 
            LEFT JOIN tb_location AS tb_location_req ON (tb_user.ref_id_location=tb_location_req.id_location) 
            LEFT JOIN tb_requisition_detail ON (tb_requisition_detail.ref_id_req =tb_requisition.id_req)
            WHERE id_req=$rowID;");


            $htmlData = '<div class="col-sm-3 invoice-col">
            <strong>ผู้เบิก ('.($rowData['no_user']=="" ? "-" : $rowData['no_user']).')</strong>
            <address>
            <strong>'.$rowData['fullname'].'</strong><br>
            ไซต์งาน: '.$rowData['location_short'].'<br />
            แผนก: '.$rowData['user_initial_name'].'<br />
            อีเมล์: '.$rowData['email'].'
            </address>
            </div>

            <div class="col-sm-3 invoice-col">
            <strong>ผู้'.($rowData['req_paid']==2 ? 'ไม่' : '').'อนุมัติ ('.($rowData['approve_no_user']=="" ? "-" : $rowData['approve_no_user']).')</strong>
            <address>
            <strong>'.($rowData['approve_fullname']=="" ? "-" : $rowData['approve_fullname']).'</strong><br>
            ไซต์งาน: '.($rowData['approve_location_short']=="" ? "-" : $rowData['approve_location_short']).'<br />
            แผนก: '.($rowData['approve_initial_name']=="" ? "-" : $rowData['approve_initial_name']).'<br />
            อีเมล์: '.($rowData['approve_email']=="" ? "-" : $rowData['approve_email']).'
            </address>
            </div>

            <div class="col-sm-3 invoice-col">
            <strong>ผู้จ่าย ('.($rowData['payer_no_user']=="" ? "-" : $rowData['payer_no_user']).')</strong>
            <address>
            <strong>'.$rowData['payer_fullname'].'</strong><br>
            ไซต์งาน: '.$rowData['payer_location_short'].'<br />
            แผนก: '.$rowData['payer_initial_name'].'<br />
            อีเมล์: '.$rowData['payer_email'].'
            </address>
            </div>

            <div class="col-sm-3 invoice-col">
            <b>ไซต์งาน: '.($rowData['req_location_short'].' ('.$rowData['req_location_name']).')</b><br>            
            <b>เลขที่ใบเบิก: '.($rowData['req_location_short'].$req_digit.$rowData['req_no']).'</b><br>
            <b style="width:23%; display:inline-block;">วันที่เบิก:</b>'.nowDate($rowData['req_datetime']).'<br />
            <b style="width:25%; display:inline-block;">วันที่อนุมัติ:</b> '.($rowData['req_date_approve']=="" || $rowData['req_date_approve']=='0000-00-00 00:00:00' ? "-" : nowDate($rowData['req_date_approve'])).'<br />
            <b style="width:23%; display:inline-block;">วันที่จ่าย:</b> '.($rowData['req_date_paid']=="" || $rowData['req_date_paid']=='0000-00-00 00:00:00' ? "-" : nowDate($rowData['req_date_paid'])).'<br />
            </div>';
           
            switch($rowData['req_paid']){//1-รออนุมัติ/2-ไม่อนุมัติ/3-อนุมัติ(รอจ่าย)/4-จ่ายแล้ว
                case 1:
                    $text_req_paid = "<span class=\"text-dark\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break;

                case 2:
                    $text_req_paid = "<span class=\"text-danger\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break; 

                case 3:
                    $text_req_paid = "<span class=\"text-info\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break;

                case 4:
                    $text_req_paid = "<span class=\"text-success\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break;

                case 0:
                default:
                $text_req_paid = "<span class=\"text-dark\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break;
            }

            $itemData='';
            $No = 1;
            $htmlFootter = '';
            $rowItem = $obj->fetchRows("SELECT tb_requisition_detail.* , tb_offsupp_location.*, tb_office_supplies.*, tb_office_supplies_photo.*,
            tb_unit.unit_name, tb_requisition.req_paid FROM tb_requisition_detail 
            
            LEFT JOIN tb_requisition ON (tb_requisition.id_req=tb_requisition_detail.ref_id_req)
            LEFT JOIN tb_offsupp_location ON (tb_offsupp_location.id_offsupp_location =tb_requisition_detail.id_offsupp_location )
            LEFT JOIN tb_office_supplies ON (tb_offsupp_location.ref_id_offsupp =tb_office_supplies.id_offsupp)
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp =tb_office_supplies.id_offsupp)
            LEFT JOIN tb_unit ON (tb_unit.id_unit=tb_office_supplies.ref_id_unit)
            WHERE ref_id_req=".$rowData['id_req']." ");

            if(!empty($rowItem)){
                foreach($rowItem as $key=>$value) {
                    $rowItem[$key]['photo_name']!=null ? $img = $pathOffsupp.$rowItem[$key]['photo_name'] : $img = $pathOffsuppDefault;
                    
                $itemData.='<tr class="'.$rowItem[$key]['offsupp_code'].'"><td>'.$No.'.</td><td>'.$rowItem[$key]['offsupp_code'].'</td>
                <td><img src="'.$img.'" class="w-40" /></td><td>'.$rowItem[$key]['offsupp_name'].'</td>
                <td>'.number_format($rowItem[$key]['quantity'],0).' '.$rowItem[$key]['unit_name'].'</td>
                <td><span class="span_total_pay">'.number_format($rowItem[$key]['quantity_pay'],0).'</span> '.$rowItem[$key]['unit_name'].'</td>';
                $No++;
                }
            } else {
                $itemData='';
            }

            $htmlFootter.= '
                <div class="col-6">
                    <p class="text-md"><strong>หมายเหตุ (จากผู้เบิก):</strong></p>
                    <div class="col-sm-0">
                    <div class="form-group">
                        <p class="req_remark">'.($rowData['req_remark']!='' ? $rowData['req_remark'] : '-').'</p>
                        <p class="text-md"><strong>หมายเหตุ (ผู้จ่าย):</strong></p>
                        <p class="cause_disapproval">'.($rowData['disburse_remark']!='' ? $rowData['disburse_remark'] : '-').'</p>
                        <p class="text-md"><strong>สาเหตุที่ไม่อนุมัติ:</strong></p>
                        <p class="cause_disapproval text-danger">'.($rowData['cause_disapproval']!='' ? $rowData['cause_disapproval'] : '-').'</p>
                    </div>
                    </div>
                </div>
                <div class="col-6">
                    <p class="lead">รวมรายการเบิก:</p>
                    <div class="table-responsive">
                    <table class="table table-border">
                    <tbody><tr>
                    <th style="width:55%">รวม:</th>
                    <td>'.($No-1).' รายการ</td>
                    </tr>
                    </table>
                    </div>
                </div>';

                $htmlFootter.='<div class="bill-footer col-2 border border-dark border-right-0 p-2">
                <div class="title">ผู้เบิก:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">'.$rowData['fullname'].'</div>
                <div class="w-100 text-center">(ผู้เบิก)</div>
            </div>
        
            <div class="bill-footer col-2 border border-dark border-right-0 p-2">
                <div class="title">ผู้อนุมัติ:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">'.$rowData['approve_fullname'].'</div>
                <div class="w-100 text-center">(ผู้อนุมัติ)</div>
            </div>
        
            <div class="bill-footer col-2 border border-dark p-2">
                <div class="title">ผู้จ่าย:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">___________________</div>
                <div class="w-100 text-center">(ผู้จ่าย)</div>
            </div>';
            
            $linkprint = '?module=print-req&id='.$rowData['id_req'].'';
            //echo json_encode($rowData);
            $rowArr = ['htmlData' => $htmlData, 'htmlFootter' => $htmlFootter, 'approve' => $text_req_paid, 'itemData' => $itemData, 'linkprint' => $linkprint];
            //echo json_encode($rowArr);
            //exit();


?>

<div class="invoice p-3 pt-0 mb-3">

<div class="row">
<div class="col-12 mt-0">
<h4>
<img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image" width="120" /> <strong>ใบเบิกวัสดุ-อุปกรณ์สำนักงาน</strong><small class="float-right txt-approve"><strong></strong></small>
</h4>
</div>

</div>



<div class="row invoice-info mt-4"><!--invoice-info-->
<?PHP echo $htmlData; ?>
</div><!--invoice-info end-->


<div class="row">
<div class="col-12 table-responsive">
<table class="table table-striped border-dark" id="table-req">
<thead>
<tr>
<th>#</th>
<th>รหัสวัสดุอุปกรณ์</th>
<th>รูป</th>
<th>ชื่อวัสดุอุปกรณ์</th>
<th>จำนวนที่เบิก</th>
<th>จ่ายแล้ว</th>
</tr>
</thead>

<tbody><!-- row item -->
<?PHP echo $itemData; ?>
</tbody><!-- row item end-->
</table>
<hr />
</div><!-- col-12 table-responsive end -->
</div><!-- row end -->

<div class="row row-footer"><!-- row-footer -->
<?PHP echo $htmlFootter;?>
</div><!-- row-footer end -->
</body>

</body>
</html>