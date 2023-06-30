<?php
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
require_once '../../include/function.inc.php';
require_once '../../include/class_crud.inc.php';
$obj = new CRUD();

$action = $_REQUEST['action'];
$outputData = '';

switch ($action) {

    case 'get_menu':
        if ($_POST['data'] != 0) {

            $fetchCategory = $obj->fetchRows("SELECT DISTINCT(tb_category.name_menu), tb_category.id_menu
            FROM tb_category
            LEFT JOIN tb_machine_master ON (tb_category.id_menu = tb_machine_master.ref_id_menu)
            LEFT JOIN tb_machine_site ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
            LEFT JOIN tb_maintenance_request ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
            WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . "
            AND tb_maintenance_request.ref_id_dept_responsibility=" . $_POST['data'] . ";");

            $outputData .= '<option value="total">ทั้งหมด</option>';
            foreach ($fetchCategory as $key => $value) {

                if (empty($value['id_menu'])) {
                    $outputData .= '<option value="none">ไม่ระบุ</option>';
                } else {
                    $outputData .= '<option value="' . $value['id_menu'] . '">' . $value['name_menu'] . '</option>';
                }

            }
            $outputData .= '<option value="none">ไม่ระบุ</option>';
            echo $outputData;
            exit();
        } else {

            $outputData .= '<option selected="selected" value="total">ทั้งหมด</option>
          <option id="menu" disabled="disabled">เลือกแผนก</option>';
            echo $outputData;
            exit();
        }

        break;

    case 'get_chart';

        parse_str($_POST['data'], $data);
        // echo $_POST['data'];
        // exit();

        $exp_reservation = explode(" - ", $data['reservationtime']);

        //16/03/2023
        $start_yyyy = substr($exp_reservation[0], 6, 4); //YYYY
        $start_mm = substr($exp_reservation[0], 3, 2); //MM
        $start_dd = substr($exp_reservation[0], 0, 2); //DD

        $end_yyyy = substr($exp_reservation[1], 6, 4); //YYYY
        $end_mm = substr($exp_reservation[1], 3, 2); //MM
        $end_dd = substr($exp_reservation[1], 0, 2); //DD

        $dateStart = $start_yyyy . '-' . $start_mm . '-' . $start_dd . ' 00:00:00';
        $dateEnd = $end_yyyy . '-' . $end_mm . '-' . $end_dd . ' 23:59:59';
        $addRow = '';
        $sumData=0;

        switch ($_SESSION['sess_class_user']) {

            case 1:
            case 2:
            case 3:

                $dept = '  AND tb_maintenance_request.ref_id_dept_responsibility=' . $_SESSION['sess_id_dept'] . '  ';
                $menu = '';
                if ($data['menu'] == 'total') {
                    $menu = '';
                } else if ($data['menu'] == 'none') {
                    $menu = ' AND tb_maintenance_request.ref_id_machine_site=0 ';
                } else {
                    $menu = ' AND tb_machine_master.ref_id_menu=' . $data['menu'] . ' ';
                }

                $fetchID = $obj->fetchRows("SELECT DISTINCT(tb_maintenance_request.ref_id_machine_site), tb_category.id_menu, tb_category.name_menu
                  FROM tb_maintenance_request
                  LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
                  LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
                  LEFT JOIN tb_category ON (tb_machine_master.ref_id_menu = tb_category.id_menu)
                  WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "");

                foreach ($fetchID as $key => $value) {

                    $countData = $obj->countAll("SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine
                      FROM tb_maintenance_request
                      LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site)
                      LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine)
                      WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                      AND tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . "
                      AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");

                    if ($countData != 0) {
                      $RowData = $obj->customSelect("SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine
                        FROM tb_maintenance_request
                        LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site)
                        LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine)
                        WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                        AND tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . "
                        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");

                        if ($RowData['Name_machine'] == "") {
                            $titleName = 'ไม่ระบุุ ';
                        } else {
                            $titleName = $RowData['Name_machine'];
                        }
                        $addRow .= '["' . $titleName . '",' . $countData . '],';
                        $sumData += $countData;
                    }
                }

            break;

            case 4:
            case 5:
                $dept = '';
                $menu = '';
                if ($data['dept'] != 0) {
                    $dept = '  AND tb_maintenance_request.ref_id_dept_responsibility=' . $data['dept'] . '  ';
                }
                if ($data['menu'] == 'total') {
                    $menu = '';
                } else if ($data['menu'] == 'none') {
                    $menu = ' AND tb_maintenance_request.ref_id_machine_site=0 ';
                } else {
                    $menu = ' AND tb_machine_master.ref_id_menu=' . $data['menu'] . ' ';
                }

                $fetchID = $obj->fetchRows("SELECT DISTINCT(tb_maintenance_request.ref_id_machine_site), tb_category.id_menu, tb_category.name_menu
                  FROM tb_maintenance_request
                  LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
                  LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
                  LEFT JOIN tb_category ON (tb_machine_master.ref_id_menu = tb_category.id_menu)
                  WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "");

                foreach ($fetchID as $key => $value) {

                    $countData = $obj->countAll("SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine
                      FROM tb_maintenance_request
                      LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site)
                      LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine)
                      WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                      AND tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . "
                      AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");
                      
                    if ($countData != 0) {
                      $RowData = $obj->customSelect("SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine
                        FROM tb_maintenance_request
                        LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site)
                        LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine)
                        WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                        AND tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . "
                        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");

                        
                        // echo "SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine
                        // FROM tb_maintenance_request
                        // LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site)
                        // LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine)
                        // WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                        // AND tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . "
                        // AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'";
                        
                        // SELECT tb_maintenance_request.ref_id_machine_site, tb_machine_master.name_machine AS Name_machine ,tb_maintenance_type.name_mt_type ,tb_maintenance_request.ref_id_mt_type
                        // FROM tb_maintenance_request 
                        // LEFT JOIN tb_machine_site ON (tb_maintenance_request.ref_id_machine_site = tb_machine_site.id_machine_site) 
                        // LEFT JOIN tb_machine_master ON (tb_machine_site.ref_id_machine_master = tb_machine_master.id_machine) 
                        // LEFT JOIN tb_maintenance_type ON (tb_maintenance_request.ref_id_mt_type = tb_maintenance_type.id_mt_type)
                        // WHERE tb_maintenance_request.ref_id_site_request=1 
                        // AND tb_maintenance_request.ref_id_dept_responsibility=13 
                        // AND tb_maintenance_request.ref_id_machine_site=0 
                        // AND tb_maintenance_request.mt_request_date BETWEEN '2023-01-21 00:00:00' AND '2023-06-21 23:59:59';
                        

                      if ($RowData['Name_machine'] == "") {

                          $titleName = 'ไม่ระบุุหมวดหมู่ ';
                      } else {
                          $titleName = $RowData['Name_machine'];
                      }
                      $addRow .= '["' . $titleName . '",' . $countData . '],';
                      $sumData += $countData;
                      }                    

                }
            break;
        }

        if (!empty($addRow)) {
        $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages': ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStuff);
      
        function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['เครื่องจักร-อุปกรณ์','จำนวนใบแจ้งซ่อม'],
          " . $addRow . "
      
        ]);
      
        var options = {
          bar: { groupWidth: '85%' },
          chartArea: {'width': '80%', 'height': '90%'},
          height: 700,
          fontName:'Arial',
          fontSize:'11',
          bars: 'horizontal', // Required for Material Bar Charts. vertical
          vAxis: {
              title: 'เครื่องจักร-อุปกรณ์',
            },
            hAxis: {
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . " (".$sumData." รายการ)',
              minValue: 0,
              format: '0',
              titleTextStyle: {italic: false},
              viewWindow: {
                min: 0
              },
            },
            legend: {position: 'none'},
            animation: {
              duration: 1000,
              easing: 'in',
             startup: true
       }
        };
      
        var chart = new google.visualization.BarChart(document.getElementById('barChart'));
        chart.draw(data, options);
        };
        </script>
        ";
          echo $outputData;
          exit();
      } else {
          $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages': ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStuff);
      
        function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['เครื่องจักร-อุปกรณ์','จำนวนใบแจ้งซ่อม'],
         ['ไม่มีข้อมูล',0]
      
        ]);
      
        var options = {
          height: 600,
          fontName:'Arial',
          fontSize:'11',
          bars: 'horizontal', // Required for Material Bar Charts. vertical
          vAxis: {
              title: 'เครื่องจักร-อุปกรณ์',
            },
          hAxis: {
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . "',
              minValue: 0,
              format: '0',
              maxValue: 100,
              titleTextStyle: {italic: false},
              viewWindow: {
                min: 0
              },
          },
          legend: {position: 'none'}
        };
      
        var chart = new google.visualization.BarChart(document.getElementById('barChart'));
        chart.draw(data, options);
        };
        </script>
        ";
      
          echo $outputData;
          exit();
      }
    break;
        
    case 'user_chart';

      parse_str($_POST['data'], $data);

      $exp_reservation = explode(" - ", $data['reservationtime']);

      //16/03/2023
      $start_yyyy = substr($exp_reservation[0], 6, 4); //YYYY
      $start_mm = substr($exp_reservation[0], 3, 2); //MM
      $start_dd = substr($exp_reservation[0], 0, 2); //DD

      $end_yyyy = substr($exp_reservation[1], 6, 4); //YYYY
      $end_mm = substr($exp_reservation[1], 3, 2); //MM
      $end_dd = substr($exp_reservation[1], 0, 2); //DD

      $dateStart = $start_yyyy . '-' . $start_mm . '-' . $start_dd;
      $dateEnd = $end_yyyy . '-' . $end_mm . '-' . $end_dd;

      $dateRange = dateRange($dateStart,$dateEnd);

      $addRow='';
      $dept='';
      $mydept='';
      
      if($data['dept']!=0){
        $dept = " AND tb_maintenance_request.ref_id_dept_request=".$data['dept']." ";
      }

      if($_SESSION['sess_class_user'] == 3){
        $mydept= " AND tb_maintenance_request.ref_id_dept_responsibility=".$_SESSION['sess_id_dept']." ";
      }

      $sumData = 0;

      foreach($dateRange as $key => $value){

        $countData = $obj->countAll("SELECT *
        FROM tb_maintenance_request
        WHERE tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site'].$dept.$mydept."
        AND tb_maintenance_request.mt_request_date LIKE '".$value."%' ");
    
        if($countData!=0){
          $addRow.= "[new Date('".$value."'), ".$countData."],";
          $sumData += $countData;
        }

      }

      if ($addRow!='') {
      $outputData = "<script type=\"text/javascript\">
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'วันที่');
        data.addColumn('number', 'จำนวนใบแจ้งซ่อม');
          
        data.addRows([
          " . $addRow . "
        ]);
      
      
        var options = {
          bar: { groupWidth: '80%' },
          chartArea: {'width': '90%', 'height': '90%'},
          height: 600,
          fontName:'Arial',
          fontSize:'11',
          bars: 'vertical', // Required for Material Bar Charts. vertical
          hAxis: {
              
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . " (".$sumData." รายการ)',
              format: 'dd/MM/yy',
              gridlines: {count: 15},
              titleTextStyle: {italic: false},
            },
            vAxis: {
              title: 'จำนวนใบแจ้งซ่อม',
              
              format: '0',
              minValue: 0,
              viewWindow: {
                min: 0
              }
            },
            legend: {position: 'none'},
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
          }
        };
      
            var chart = new google.visualization.ColumnChart(document.getElementById('barChart'));
      
            chart.draw(data, options);
          }
      </script>";
        }else{
        $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages': ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStuff);
      
        function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['วันที่','จำนวนใบแจ้งซ่อม'],
         ['ไม่มีข้อมูล',0]
      
        ]);
      
        var options = {
          bar: { groupWidth: '80%' },
          chartArea: {'width': '90%', 'height': '90%'},
          height: 600,
          fontName:'Arial',
          fontSize:'11',
          bars: 'vertical', // Required for Material Bar Charts. vertical
          vAxis: {
              title: 'จำนวนใบแจ้งซ่อม',
              minValue: 0,
              maxValue: 100,
            },
          hAxis: {
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . "',
              format: '0',
              minValue: 0,
              maxValue: 100,
              titleTextStyle: {italic: false},
              viewWindow: {
                min: 0
              },
             
          },
          legend: {position: 'none'}
        };
      
        var chart = new google.visualization.ColumnChart(document.getElementById('barChart'));
        chart.draw(data, options);
        };
        </script>
        ";
      
          echo $outputData;
          exit();

        }


      // $outputData = "<script type=\"text/javascript\">
      // google.charts.load('current', {packages: ['corechart', 'line']});
      // google.charts.setOnLoadCallback(drawBasic);
      
      // function drawBasic() {
      
      //       var data = new google.visualization.DataTable();
      //       data.addColumn('date', 'ช่วงเวลา');
      //       data.addColumn('number', 'ใบแจ้งซ่อม');
      
      //       data.addRows([
      //         ".$addRow."
      //       ]);
      
      //       var options = {
      //         height: 400,
      //         pointSize: 5,
      //         hAxis: {
      //           title: 'ข้อมูลวันที่ ".$data['reservationtime']."',
      //           titleTextStyle: {italic: false},
      //           format: 'dd/MM/yy',
      //           gridlines: {count: 15}
      //         },
      //         vAxis: {
      //           title: 'ใบแจ้งซ่อม',
      //           format: '0',  
      //           titleTextStyle: {color: '#333'},
      //           minValue: 0,
      //           viewWindow: {
      //             min: 0
      //          }

      //         },
      //         legend: 'none',
      //         strokeWidth: 2,
      //         axisTitlesPosition:'out',
      //         fontName:'Arial',
      //         fontSize:'11',
      //         curveType: 'function',
             
      //       };
      
      //       var chart = new google.visualization.AreaChart(document.getElementById('barChart'));
      
      //       chart.draw(data, options);
      //     }
      // </script>";

      echo $outputData;
      exit();
    break;

    case 'pie_chart':

      parse_str($_POST['data'], $data);

      $exp_reservation = explode(" - ", $data['reservationtime']);

      //16/03/2023
      $start_yyyy = substr($exp_reservation[0], 6, 4); //YYYY
      $start_mm = substr($exp_reservation[0], 3, 2); //MM
      $start_dd = substr($exp_reservation[0], 0, 2); //DD

      $end_yyyy = substr($exp_reservation[1], 6, 4); //YYYY
      $end_mm = substr($exp_reservation[1], 3, 2); //MM
      $end_dd = substr($exp_reservation[1], 0, 2); //DD

      $dateStart = $start_yyyy . '-' . $start_mm . '-' . $start_dd . ' 00:00:00';
      $dateEnd = $end_yyyy . '-' . $end_mm . '-' . $end_dd . ' 23:59:59';

      $query_status = " AND (
        (tb_maintenance_request.status_approved=1
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.allotted_accept_date IS NULL
        AND tb_maintenance_request.ref_user_id_accept_request IS NULL
        AND tb_maintenance_request.duration_serv_start IS NULL
        AND tb_maintenance_request.duration_serv_end IS NULL
        AND tb_maintenance_request.hand_over_date IS NULL) 
         OR 
        (tb_maintenance_request.status_approved=1
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.allotted_accept_date IS NOT NULL
        AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
        AND tb_maintenance_request.duration_serv_start IS NULL
        AND tb_maintenance_request.duration_serv_end IS NULL
        AND tb_maintenance_request.hand_over_date IS NULL)
         OR 
        (tb_maintenance_request.status_approved=1
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.allotted_accept_date IS NOT NULL
        AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
        AND tb_maintenance_request.duration_serv_start IS NOT NULL
        AND tb_maintenance_request.duration_serv_end IS NULL
        AND tb_maintenance_request.hand_over_date IS NULL)
         OR 
        (tb_maintenance_request.status_approved=1
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.allotted_accept_date IS NOT NULL
        AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
        AND tb_maintenance_request.duration_serv_start IS NOT NULL
        AND tb_maintenance_request.duration_serv_end IS NOT NULL
        AND tb_maintenance_request.hand_over_date IS NOT NULL
        AND tb_maintenance_request.survay_date IS NULL)
         OR 
        (tb_maintenance_request.status_approved=1
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.duration_serv_start IS NOT NULL
        AND tb_maintenance_request.duration_serv_end IS NOT NULL
        AND tb_maintenance_request.survay_date IS NOT NULL) 
         OR 
        (tb_maintenance_request.status_approved=2
        AND tb_maintenance_request.allotted_date IS NOT NULL
        AND tb_maintenance_request.maintenance_request_status=1
        AND tb_maintenance_request.duration_serv_end IS NULL
        AND tb_maintenance_request.hand_over_date IS NULL) 
         OR 
        (tb_maintenance_request.maintenance_request_status=2)
        ) ";

        if (!empty($data['radio'])) {
          if ($data['radio'] == 'all') {
              $query_req = "(tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " OR tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . ")";
              if ($_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5) {
                  $query_req = " tb_maintenance_request.id_maintenance_request IS NOT NULL ";
              }
          } else if ($data['radio'] == 'person') {
              $query_req = " tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . " ";
          } else if ($data['radio'] == 'dept') {
              $query_req = " tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " ";
          } else if ($data['radio'] == 'responsible') {
              $query_req = " tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . " ";
          } else {
              $query_req = '';
          }
      }

        $TotalWait_approved = 0;
        $TotalNo_approved = 0;
        $TotalRepairing = 0;
        $TotalWait_repair = 0;
        $TotalWait_accept = 0;
        $TotalWait_hand_over = 0;
        $TotalHand_over = 0;
        $TotalCancel = 0;

      if($_SESSION['sess_class_user'] == 1){

        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' " . $query_status;

      }else if($_SESSION['sess_class_user'] == 2 || $_SESSION['sess_class_user'] == 3 || $_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5){

        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE " . $query_req . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' 
        AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " " . $query_status;


      }else {

        $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' " . $query_status;


      }

      $fetchRowTotal = $obj->fetchRows($sql_fetchRow);

      if(!empty($fetchRowTotal)){
        foreach($fetchRowTotal as $key => $value){

          if ($fetchRowTotal[$key]['status_approved'] == 0 && $fetchRowTotal[$key]['allotted_date'] == null && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
            $TotalWait_approved++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 2 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
            $TotalNo_approved++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_start'] != null && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['survay_date'] == null
          && $fetchRowTotal[$key]['hand_over_date'] == null && $fetchRowTotal[$key]['ref_user_id_accept_request'] != null) {
            $TotalRepairing++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null && $fetchRowTotal[$key]['ref_user_id_accept_request'] != '') {
            $TotalWait_repair++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_start'] == null && $fetchRowTotal[$key]['duration_serv_end'] == null && $fetchRowTotal[$key]['hand_over_date'] == null) {
            $TotalWait_accept++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_end'] != null && $fetchRowTotal[$key]['hand_over_date'] != null && $fetchRowTotal[$key]['survay_date'] == null) {
            $TotalWait_hand_over++;
          } else if ($fetchRowTotal[$key]['status_approved'] == 1 && $fetchRowTotal[$key]['allotted_date'] != '' && $fetchRowTotal[$key]['maintenance_request_status'] == 1
          && $fetchRowTotal[$key]['duration_serv_end'] != null && $fetchRowTotal[$key]['hand_over_date'] != null && $fetchRowTotal[$key]['survay_date'] != null) {
            $TotalHand_over++;
          } else if ($fetchRowTotal[$key]['maintenance_request_status'] == 2) {
            $TotalCancel++;
          }

        }

        $TotalSum = $TotalWait_approved+$TotalWait_accept+$TotalWait_repair+$TotalRepairing+$TotalWait_hand_over
        +$TotalHand_over
        +$TotalNo_approved
        +$TotalCancel;

        $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
  
          var data = google.visualization.arrayToDataTable([
            ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
            ['รออนุมัติ/จ่ายงาน',     ".$TotalWait_approved."],
            ['รอช่างรับงานซ่อม',      ".$TotalWait_accept."],
            ['รอซ่อม',  ".$TotalWait_repair."],
            ['กำลังซ่อม', ".$TotalRepairing."],
            ['งานรอส่งมอบ',    ".$TotalWait_hand_over."],
            ['ปิดงานและส่งมอบแล้ว',    ".$TotalHand_over."],
            ['ไม่อนุมัติ',    ".$TotalNo_approved."],
            ['ยกเลิกใบแจ้งซ่อม',    ".$TotalCancel."],
           
          ]);
  
          var options = {
            title: 'สถานะใบแจ้งซ่อม (".$TotalSum." รายการ)',
            chartArea: {'width': '90%', 'height': '90%'},
            fontName:'Arial',
            animation: {
              duration: 1000, 
              easing: 'in',
              startup: true
            },
            sliceVisibilityThreshold:0,
            colors: [
              {color: '#FF0000', darker: '#800000'},    
            {color: '#FF7F00', darker: '#804000'},  
            {color: '#FFB300', darker: '#CC7A00'}, 
            {color: '#304FFE', darker: '#1A237E'}, 
            {color: '#00796B', darker: '#004C40'},     
    {color: '#00FF00', darker: '#009F00'},      
            {color: '#9E9E9E', darker: '#424242'},   
            {color: '#616161', darker: '#424242'},
            ],
            pieSliceBorderColor: 'transparent',   
            pieSliceText: 'percentage',
            pieSliceTextStyle: {
              color: 'white',
              bold: true,
              fontSize: 16
            },
            pieSliceBorderColor: 'transparent'          
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('dashboard'));
          chart.draw(data, options)
                 
        }
        </script>";
      
      }else {

        $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
  
          var data = google.visualization.arrayToDataTable([
            ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
            ['ไม่มีข้อมูล',    75],
      
          ]);
  
          var options = {
            title: 'สถานะใบแจ้งซ่อม',
            chartArea: {'width': '90%', 'height': '90%'},
            pieSliceText: 'none',
            tooltip: { trigger: 'none' },
            slices: {
              0: { color: 'grey' },
            }
           
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('dashboard'));
          chart.draw(data, options)
          
        }
        </script>";

      }

      

          echo $outputData;
    break;

}

exit();


?>