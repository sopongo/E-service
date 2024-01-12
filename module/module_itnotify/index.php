<?PHP
ob_start();
session_start();
require_once __DIR__ . "/../../include/setting.inc.php";
require_once __DIR__ . "/../../include/function.inc.php";
require_once __DIR__ . "/../../include/class_crud.inc.php";

require_once __DIR__ . "/function/f-list.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set(Setting::$AppTimeZone);

isset($_REQUEST['date']) ? $date = $_REQUEST['date'] : $date = date('dmY');

$dateObject = DateTime::createFromFormat('dmY', $date);
$formattedDate = $dateObject->format('Y-m-d H:i:s');

$call = new Table($date);
$c    = $call->getData();
// echo $c;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        สรุปงานแจ้งซ่อม
    </title>
    <?php 
        include( __DIR__ . "/component/link.php"); 
        include( __DIR__ . "/component/style.php"); 
    ?>
</head>

<!-- Script -->
<?php include( __DIR__ . "/component/script.php"); ?>

<body class="hold-transition layout-top-nav">
    <!--sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed sidebar-closed sidebar-collapse layout-navbar-fixed-->

    <div class="wrapper">

        <!-- Main Navbar Container -->

        <!-- Main content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper content-gradient" >
           
        <div class="card-body" id="picture" style="background-color:white">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th colspan="15" class="text-center"><h3><strong>สรุปงานแจ้งซ่อม IT/MIS <?php echo nowDate($formattedDate) ?></strong></h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- <td colspan="5" rowspan="9" class="justify-content-center text-center align-middle"><div class="text-center" id="donutchart" style="height: 400px;width: 400px;"></div></td> -->
                        <td rowspan="2" class="text-center align-middle bg-info"><strong>รายการ</strong></td>
                        <td rowspan="2" class="text-center align-middle bg-info"><strong>จำนวนงาน</strong></td>
                        <td colspan="8" class="text-center bg-info"><strong>รายละเอียด</strong></td>
                    </tr>
                    <tr>
                        <td class="bg-info text-center"><strong>อุปกรณ์แผนก IT</strong></td>
                        <td class="bg-info text-center"><strong>งานจัดการระบบ</strong></td>
                        <td class="bg-info text-center"><strong>Printer</strong></td>
                        <td class="bg-info text-center"><strong>กล้องวงจรปิด</strong></td>
                        <td class="bg-info text-center"><strong>Network/LAN/WIFI</strong></td>
                        <td class="bg-info text-center"><strong>Hardware</strong></td>
                        <td class="bg-info text-center"><strong>Software</strong></td>
                        <td class="bg-info text-center"><strong>อื่นๆ</strong></td>
                    </tr>
                    <tr>
                        <td>งานใหม่เมื่อวาน</td>
                        <td class="text-center"><strong><?php echo $c['yesterdayNew']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['System']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['Printer']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['Net']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['Software']?></td>
                        <td class="text-center"><?php echo $c['yesterdayNew']['Non']?></td>
                    </tr>
                    <tr>
                        <td>งานใหม่วันนี้</td>
                        <td class="text-center"><strong><?php echo $c['todayNew']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['todayNew']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['System']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['Printer']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['Net']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['Software']?></td>
                        <td class="text-center"><?php echo $c['todayNew']['Non']?></td>
                    </tr>
                    <tr class="bg-warning">
                        <td>งานรอซ่อม</td>
                        <td class="text-center"><strong><?php echo $c['wait']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['wait']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['wait']['System']?></td>
                        <td class="text-center"><?php echo $c['wait']['Printer']?></td>
                        <td class="text-center"><?php echo $c['wait']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['wait']['Net']?></td>
                        <td class="text-center"><?php echo $c['wait']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['wait']['Software']?></td>
                        <td class="text-center"><?php echo $c['wait']['Non']?></td>
                    </tr>
                    <tr class="bg-warning">
                        <td>งานที่กำลังซ่อม</td>
                        <td class="text-center"><strong><?php echo $c['working']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['working']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['working']['System']?></td>
                        <td class="text-center"><?php echo $c['working']['Printer']?></td>
                        <td class="text-center"><?php echo $c['working']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['working']['Net']?></td>
                        <td class="text-center"><?php echo $c['working']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['working']['Software']?></td>
                        <td class="text-center"><?php echo $c['working']['Non']?></td>
                    </tr>
                    <tr>
                        <td>รวมงานที่ยังไม่ส่งมอบ</td>
                        <td class="text-center"><strong><?php echo $c['all']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['all']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['all']['System']?></td>
                        <td class="text-center"><?php echo $c['all']['Printer']?></td>
                        <td class="text-center"><?php echo $c['all']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['all']['Net']?></td>
                        <td class="text-center"><?php echo $c['all']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['all']['Software']?></td>
                        <td class="text-center"><?php echo $c['all']['Non']?></td>
                    </tr>
                    <tr class="bg-success">
                        <td>งานที่ส่งมอบเมื่อวาน</td>
                        <td class="text-center"><strong><?php echo $c['yesterdayClose']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['System']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['Printer']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['Net']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['Software']?></td>
                        <td class="text-center"><?php echo $c['yesterdayClose']['Non']?></td>
                    </tr>
                    <tr class="bg-success">
                        <td>งานที่ส่งมอบวันนี้</td>
                        <td class="text-center"><strong><?php echo $c['todayClose']['Sum']?></strong></td>
                        <td class="text-center"><?php echo $c['todayClose']['ITDevice']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['System']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['Printer']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['CCTV']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['Net']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['Hardware']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['Software']?></td>
                        <td class="text-center"><?php echo $c['todayClose']['Non']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
           

        </div>
        <!-- /.content-wrapper -->

        <?php include( __DIR__ . "/component/script_canvas.php"); ?>
        <!-- Main Footer Container -->
   

    </div>

 
</body>

</html>