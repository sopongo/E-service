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
$TotalWait_approved = 0;
$TotalNo_approved = 0;
$TotalRepairing = 0;
$TotalWait_repair = 0;
$TotalWait_accept = 0;
$TotalWait_hand_over = 0;
$TotalHand_over = 0;
$TotalCancel = 0;

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
                    $outputData .= '<option value="none">ไม่ทราบชื่อ, ไม่ระบุ</option>';
                } else {
                    $outputData .= '<option value="' . $value['id_menu'] . '">' . $value['name_menu'] . '</option>';
                }
            }
            $outputData .= '<option value="none">ไม่ทราบชื่อ, ไม่ระบุ</option>';
            echo $outputData;
            exit();
        } else {

            $outputData .= '<option selected="selected" value="total">ทั้งหมด</option>
          <option id="menu" disabled="disabled">เลือกแผนก</option>';
            echo $outputData;
            exit();
        }

        break;

    case 'menu_dept':
        if ($_POST['data'] != 0) {
            $sqlGrouprow = $obj->fetchRows("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); ");

            $fetchDept = $obj->fetchRows("SELECT tb_maintenance_request.ref_id_dept_responsibility, tb_dept.dept_initialname
        FROM tb_maintenance_request
        LEFT JOIN tb_dept ON (tb_maintenance_request.ref_id_dept_responsibility = tb_dept.id_dept)
        WHERE tb_maintenance_request.ref_id_site_request=" . $_POST['data'] . "
        GROUP BY tb_maintenance_request.ref_id_dept_responsibility");

            $outputData .= '<option value="0">ทั้งหมด</option>';
            foreach ($fetchDept as $key => $value) {
                if (!empty($value['ref_id_dept_responsibility'])) {
                    $outputData .= '<option value="' . $value['ref_id_dept_responsibility'] . '">' . $value['dept_initialname'] . '</option>';
                }
            }
            echo $outputData;
            exit();
        } else {

            $outputData .= '<option selected="selected" value="total">ทั้งหมด</option>
      <option id="menu" disabled="disabled">เลือกแผนก</option>';
            echo $outputData;
            exit();
        }

        break;

    case 'get_chart':

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
        $addRow = '';
        $sumData = 0;

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
                            $titleName = 'ไม่ทราบชื่อ, ไม่ระบุ';
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

                            $titleName = 'ไม่ทราบชื่อ, ไม่ระบุ';
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
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . " (" . $sumData . " รายการ)',
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

        $dateRange = dateRange($dateStart, $dateEnd);

        $addRow = '';
        $dept = '';
        $mydept = '';

        if ($_POST['dept'] != 0) {
            $dept = " AND tb_maintenance_request.ref_id_dept_request=" . $_POST['dept'] . " ";
        }

        if ($_SESSION['sess_class_user'] == 3) {
            $mydept = " AND tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " ";
        }

        $sumData = 0;

        foreach ($dateRange as $key => $value) {

            $countData = $obj->countAll("SELECT *
        FROM tb_maintenance_request
        WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $mydept . "
        AND tb_maintenance_request.mt_request_date LIKE '" . $value . "%' ");

            if ($countData != 0) {
                $addRow .= "[new Date('" . $value . "'), " . $countData . "],";
                $sumData += $countData;
            }

        }

        if ($addRow != '') {
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

        var ticks = [];
        for (var i = 0; i < data.getNumberOfRows(); i++) {
          ticks.push(data.getValue(i, 0));
        }

        var options = {
          bar: { groupWidth: '80%' },
          chartArea: {'width': '90%', 'height': '90%'},
          height: 600,
          fontName:'Arial',
          fontSize:'11',
          bars: 'vertical', // Required for Material Bar Charts. vertical
          hAxis: {
              title: 'สถิติใบแจ้งซ่อม ช่วงวันที่ " . $data['reservationtime'] . " (" . $sumData . " รายการ)',
              format: 'dd/MM/yy',
              gridlines: {count: 15},
              titleTextStyle: {italic: false},
              ticks: ticks
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
        } else {
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

        }
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

        $query_req = '';

        if (!empty($data['selectType'])) {
            if ($data['selectType'] == 'all') {
                switch ($_SESSION['sess_class_user']) {
                    case 2:
                        $query_req = "(tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . " OR tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . ")";
                        break;
                    case 3:
                        $query_req = "(tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . " OR tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . " OR tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . ")";
                        break;
                    case 4:
                    case 5:
                        $query_req = " tb_maintenance_request.id_maintenance_request IS NOT NULL ";
                        break;
                }
            } else if ($data['selectType'] == 'person') {
                $query_req = "tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "";
            } else if ($data['selectType'] == 'responsible') {
                switch ($_SESSION['sess_class_user']) {
                    case 2:
                        $query_req = "tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . "";
                        break;
                    case 3:
                        $query_req = " tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . "";
                        break;
                }
            } else if ($data['selectType'] == 'dept') {
                if ($_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5) {
                    if ($data['selectDept_responsible'] == 0) {
                        $query_req .= " tb_maintenance_request.id_maintenance_request IS NOT NULL AND ";
                    } else {
                        $query_req .= " tb_maintenance_request.ref_id_dept_responsibility=" . $data['selectDept_responsible'] . " AND ";
                    }
                }
                if ($data['selectDept_request'] == 0) {
                    switch ($_SESSION['sess_class_user']) {
                        case 3:
                            $query_req = " tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " ";
                            break;
                        case 4:
                        case 5:
                            $query_req .= " tb_maintenance_request.ref_id_user_request IS NOT NULL ";
                            break;
                    }
                } else {
                    switch ($_SESSION['sess_class_user']) {
                        case 3:
                            $query_req = " (tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . "
                            AND tb_maintenance_request.ref_id_dept_request=" . $data['selectDept_request'] . ") ";
                            break;
                        case 4:
                        case 5:
                            $query_req .= " tb_maintenance_request.ref_id_dept_request=" . $data['selectDept_request'] . "";
                            break;
                    }
                }
            }
        }

        if ($_SESSION['sess_class_user'] == 1) {

            $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

        } else if ($_SESSION['sess_class_user'] == 2 || $_SESSION['sess_class_user'] == 3 || $_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5) {

            $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE " . $query_req . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'
        AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " ";

        } else {

            $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

        }

        $fetchRowTotal = $obj->fetchRows($sql_fetchRow);

        if (!empty($fetchRowTotal)) {
          $getStatus = SortStatus($fetchRowTotal);

          $TotalWait_approved = $getStatus['Wait_approved'];
          $TotalNo_approved = $getStatus['No_approved'];
          $TotalRepairing = $getStatus['Repairing'];
          $TotalWait_repair = $getStatus['Wait_repair'];
          $TotalWait_accept = $getStatus['Wait_accept'];
          $TotalWait_hand_over = $getStatus['Wait_hand_over'];
          $TotalHand_over = $getStatus['Hand_over'];
          $TotalCancel = $getStatus['Cancel'];

            $TotalSum = $TotalWait_approved + $TotalWait_accept + $TotalWait_repair + $TotalRepairing + $TotalWait_hand_over
                 + $TotalHand_over
                 + $TotalNo_approved
                 + $TotalCancel;

            $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
            ['รออนุมัติ/จ่ายงาน',     " . $TotalWait_approved . "],
            ['รอช่างรับงานซ่อม',      " . $TotalWait_accept . "],
            ['รอซ่อม',  " . $TotalWait_repair . "],
            ['กำลังซ่อม', " . $TotalRepairing . "],
            ['งานรอส่งมอบ',    " . $TotalWait_hand_over . "],
            ['ปิดงานและส่งมอบแล้ว',    " . $TotalHand_over . "],
            ['ไม่อนุมัติ',    " . $TotalNo_approved . "],
            ['ยกเลิกใบแจ้งซ่อม',    " . $TotalCancel . "],
            ['รวมทั้งหมด " . $TotalSum . " รายการ', 0]

          ]);

          var options = {
            title: 'สถานะใบแจ้งซ่อม " . $data['reservationtime'] . "',
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
              {color: '#000000', darker: '#424242'},
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

        } else {

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

    case 'dashboard':
        parse_str($_POST['data'], $data);
        
        
        if (empty($data['site']) || empty($data['dropdownYear']) || empty($data['dropdownMonth'])) {
            $outputData = "<script type=\"text/javascript\">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          
          var Donutdata = google.visualization.arrayToDataTable([
            ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
            ['ไม่มีข้อมูล',    75],
          ]);
          var Repairdata = new google.visualization.DataTable();
          Repairdata.addColumn('string', 'แผนก');
          Repairdata.addColumn('number', 'รออนุมัติ/จ่ายงาน');
          Repairdata.addColumn('number', 'กำลังซ่อม');
          Repairdata.addColumn('number', 'ปิดงานและส่งมอบแล้ว');
          Repairdata.addRows([
            ['ไม่มีข้อมูล',0,0,0]
          ]);
          var Userdata =  new google.visualization.arrayToDataTable([
            ['แผนก','จำนวนใบแจ้งซ่อม'],
            ['ไม่มีข้อมูล',0]
          ]);
          var Avgdata = new google.visualization.DataTable();
          Avgdata.addColumn('string', 'แผนก');
          Avgdata.addColumn('number', 'เวลาเฉลี่ย (ชั่วโมง)');
          Avgdata.addRows([
            ['ไม่มีข้อมูล', 0]
          ]);
          var Machinedata =  new google.visualization.arrayToDataTable([
            ['แผนก','จำนวนใบแจ้งซ่อม'],
            ['ไม่มีข้อมูล',0]
          ]);
          var Donutoptions = {
            chartArea: {'width': '99%', 'height': '99%'},
            pieSliceText: 'none',
            tooltip: { trigger: 'none' },
            slices: {
              0: { color: 'grey' },
            },
            pieHole: 0.35,
            legend: 'none',
          };
          var Baroptions = {
            bar: { groupWidth: '85%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            bars: 'horizontal', // Required for Material Bar Charts. vertical
            hAxis: {
              minValue: 0,
              maxValue: 100,
              format: '0',
              viewWindow: {
                min: 0
              },
            },
            legend: {position: 'none'},
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            },
          };
          var Columnoptions = {
            bar: { groupWidth: '80%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            legend: 'none',
            colors: [
              {color: '#FF0000', darker: '#800000'},
              {color: '#FFB300', darker: '#CC7A00'},
              {color: '#00a336'},
            ],
            bars: 'vertical', // Required for Material Bar Charts. vertical
            hAxis: {
              gridlines: {count: 15},
            },
            vAxis: {
              format: '0',
              minValue: 0,
              maxValue: 100,
              viewWindow: {
                min: 0
              }
            },
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            }
          };
            
          var donutchart = new google.visualization.PieChart(document.getElementById('donutchart'));
          var repairchart = new google.visualization.ColumnChart(document.getElementById('repairchart'));
          var userchart = new google.visualization.BarChart(document.getElementById('userchart'));
          var avgchart = new google.visualization.ColumnChart(document.getElementById('averagechart'));
          var machinechart = new google.visualization.BarChart(document.getElementById('machinechart'));
          google.visualization.events.addListener(donutchart, 'ready', function () {
            function adjustTextSize() {

              var svgElement = document.querySelector('#donutchart svg');
              var chartWidth = svgElement.clientWidth;
              var chartHeight = svgElement.clientHeight;
              var totalSumText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
              var fontSize = Math.min(chartWidth, chartHeight) * 0.1;
              var fontSize2 = Math.min(chartWidth, chartHeight) * 0.05;

              totalSumText.setAttribute('x', '50%');
              totalSumText.setAttribute('y', '45%');
              totalSumText.setAttribute('text-anchor', 'middle');
              totalSumText.setAttribute('dominant-baseline', 'central');
              totalSumText.setAttribute('font-size', fontSize);
              totalSumText.setAttribute('font-weight', 'bold');
              totalSumText.textContent = 0;
              svgElement.appendChild(totalSumText);

              var totalText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
              totalText.setAttribute('x', '50%');
              totalText.setAttribute('y', '55%');
              totalText.setAttribute('text-anchor', 'middle');
              totalText.setAttribute('dominant-baseline', 'middle');
              totalText.setAttribute('font-size', fontSize2);
              totalText.textContent = 'ทั้งหมด';
              svgElement.appendChild(totalText);
            }

          adjustTextSize();

          // Add an event listener to recalculate font size on window resize
          window.addEventListener('resize', function () {
            var svgElement = document.querySelector('#donutchart svg');
            svgElement.removeChild(svgElement.lastChild); // Remove the existing text
            adjustTextSize();
          });

          });
          donutchart.draw(Donutdata, Donutoptions);
          repairchart.draw(Repairdata, Columnoptions);
          userchart.draw(Userdata, Baroptions);
          avgchart.draw(Avgdata, Columnoptions);
          machinechart.draw(Machinedata, Baroptions);

        }

        google.charts.load('current', {packages: ['table']});
        google.charts.setOnLoadCallback(drawTable);

    function drawTable() {

          var Table1data = new google.visualization.DataTable();
            Table1data.addColumn('string', 'แผนก');
            Table1data.addColumn('string', 'ชื่อ');
            Table1data.addColumn('string', 'ระดับ');
            Table1data.addColumn('number', 'งานที่กำลังซ่อม');
            Table1data.addRows([
              ['ไม่มีข้อมูล','ไม่มีข้อมูล','ไม่มีข้อมูล',0]
          ]);
          
          var Table2data = new google.visualization.DataTable();
          Table2data.addColumn('string', 'แผนก');
          Table2data.addColumn('string', 'หัวหน้าช่าง');
            Table2data.addColumn('string', 'ช่างซ่อม');
            Table2data.addColumn('number', 'งานที่กำลังซ่อม');
            Table2data.addRows([
              ['ไม่มีข้อมูล','ไม่มีข้อมูล','ไม่มีข้อมูล',0]
          ]);

          var Tableoptions = { showRowNumber: true,
              width: '100%',
              sortColumn: 3,
              sortAscending: false,
              cssClassNames: {
                headerCell: 'center-text',
                tableCell: 'center-text' // CSS class for non-header cells
              },
              autoWidth: true
          };

                var table1 = new google.visualization.Table(document.getElementById('table1chart'));
                var table2 = new google.visualization.Table(document.getElementById('table2chart'));

                table1.draw(Table1data, Tableoptions);
                table2.draw(Table2data, Tableoptions);

                var tableTitle = 'ช่างซ่อมที่มีงานมากที่สุด';
                var tableTitleHtml = '<div class=\"table-title \"><h6 style=\"margin-bottom: 0%; padding-bottom: 1%;padding-top: 0%;font-weight: bold;\">' + tableTitle + '</h6></div>';
                document.getElementById('table1chart').insertAdjacentHTML('afterbegin', tableTitleHtml);

                var tableTitle2 = 'อัตรากำลังพลช่างซ่อม';
                var tableTitleHtml2 = '<div class=\"table-title \"><h6 style=\"margin-bottom: 0%; padding-bottom: 1%;padding-top: 0%;font-weight: bold;\">' + tableTitle2 + '</h6></div>';
                document.getElementById('table2chart').insertAdjacentHTML('afterbegin', tableTitleHtml2);

                var cellsTable1 = document.querySelectorAll('#table1chart tr td:nth-child(5)');
              for (var i = 0; i < cellsTable1.length; i++) {
                cellsTable1[i].classList.add('centered-cell');
              }
              var cellsTable2 = document.querySelectorAll('#table2chart tr td:nth-child(n+3):nth-child(-n+5)');
              for (var i = 0; i < cellsTable2.length; i++) {
                cellsTable2[i].classList.add('centered-cell');
              }
              }
        </script>";

            echo $outputData;
            exit();
        }

        $mt_date = array();
        $mt_month = array();
        foreach ($data['dropdownYear'] as $key => $value) {
            $Year = $value;
            foreach ($data['dropdownMonth'] as $key => $values) {
                $dateReq = $Year . '-' . $values;
                $mt_date[] = $dateReq;
            }
        }
        foreach ($data['dropdownYear'] as $key => $value) {
            $Year = $value;
            if ($Year == date('Y')) {
                for ($i = 1; $i <= date('m'); $i++) {
                    $MonthReq = $Year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT);
                    $mt_month[] = $MonthReq;
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $MonthReq = $Year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT);
                    $mt_month[] = $MonthReq;
                }
            }
        }

        $text_query = '';
        foreach ($mt_date as $key => $value) {

            $text_query .= count($mt_date) > 1 && $key == 0 ? '(' : '';

            $text_query .= count($mt_date) > 1 && $key == 0 ? 'tb_maintenance_request.mt_request_date LIKE "%' . $value . '%"' : ' OR tb_maintenance_request.mt_request_date LIKE "%' . $value . '%"';

            $text_query .= count($mt_date) > 1 && array_key_last($mt_date) == $key ? ')' : '';

        }
        count($mt_date) == 1 ? $text_query = str_replace('OR', '', $text_query) : $text_query;

        $_POST['dept'] != 0 ? $text_dept = "AND tb_maintenance_request.ref_id_dept_responsibility=" . $_POST['dept'] . " " : $text_dept = "";

        $sql_Donut = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
      tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
      LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
      LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
      LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
      LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
      WHERE tb_maintenance_request.ref_id_site_request = " . $data['site'] . "
      AND " . $text_query . $text_dept . "";
      
        $sql_Dept = "SELECT tb_maintenance_request.ref_id_dept_responsibility, tb_dept.dept_initialname
      FROM tb_maintenance_request
      LEFT JOIN tb_dept ON (tb_maintenance_request.ref_id_dept_responsibility = tb_dept.id_dept)
      WHERE tb_maintenance_request.ref_id_site_request=" . $data['site'] . "
      GROUP BY tb_maintenance_request.ref_id_dept_responsibility";

        $sql_User = "SELECT tb_maintenance_request.ref_id_dept_request, COUNT(*) as count, dept_initialname, tb_dept.dept_name
      FROM tb_maintenance_request
      LEFT JOIN tb_dept ON tb_maintenance_request.ref_id_dept_request = tb_dept.id_dept
      WHERE tb_maintenance_request.ref_id_site_request=" . $data['site'] . " AND " . $text_query . $text_dept . "
      GROUP BY tb_maintenance_request.ref_id_dept_request
      ORDER BY count DESC LIMIT 5";

        $sql_Machine = "SELECT tb_maintenance_request.ref_id_machine_site, COUNT(*) as count, tb_machine_master.name_machine
      FROM tb_maintenance_request
      LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
      LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
      WHERE tb_maintenance_request.ref_id_site_request=" . $data['site'] . " AND ref_id_machine_site != 0 AND " . $text_query . $text_dept . "
      GROUP BY tb_maintenance_request.ref_id_machine_site
      ORDER BY count DESC LIMIT 5";
      
        $sqlGrouprow = $obj->fetchRows("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); ");

        $fetchRowDonut = $obj->fetchRows($sql_Donut);

        $fetchRowDept = $obj->fetchRows($sql_Dept);
        
        $fetchRowUser = $obj->fetchRows($sql_User);

        $fetchRowMachine = $obj->fetchRows($sql_Machine);

        $TotalWait_approved = 0;
        $TotalNo_approved = 0;
        $TotalRepairing = 0;
        $TotalWait_repair = 0;
        $TotalWait_accept = 0;
        $TotalWait_hand_over = 0;
        $TotalHand_over = 0;
        $TotalCancel = 0;
        
        // DonutChart /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (!empty($fetchRowDonut)) {

            $getStatus = SortStatus($fetchRowDonut);

            $TotalWait_approved = $getStatus['Wait_approved'];
            $TotalNo_approved = $getStatus['No_approved'];
            $TotalRepairing = $getStatus['Repairing'];
            $TotalWait_repair = $getStatus['Wait_repair'];
            $TotalWait_accept = $getStatus['Wait_accept'];
            $TotalWait_hand_over = $getStatus['Wait_hand_over'];
            $TotalHand_over = $getStatus['Hand_over'];
            $TotalCancel = $getStatus['Cancel'];

            $TotalSumD = $TotalWait_approved + $TotalWait_accept + $TotalWait_repair + $TotalRepairing + $TotalWait_hand_over + $TotalHand_over + $TotalNo_approved + $TotalCancel;
            $Total1 = $TotalWait_approved + $TotalWait_accept;
            $Total2 = $TotalWait_repair + $TotalRepairing;
            $Total3 = $TotalWait_hand_over + $TotalHand_over;
            $Total4 = $TotalNo_approved + $TotalCancel;

            $DonutData = " var Donutdata = google.visualization.arrayToDataTable([
          ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
          ['อยู่ระหว่างอนุมัติ/ช่างรับงาน',     " . $Total1 . "],
          ['อยู่ระหว่างการซ่อม',      " . $Total2 . "],
          ['ซ่อมสำเร็จ',  " . $Total3 . "],
          ['ยกเลิก/ไม่อนุมัติ', " . $Total4 . "],
        ]);";

            $DonutOptions = " var Donutoptions = {
          chartArea: {'width': '95%', 'height': '95%'},
          fontName:'Arial',
          animation: {
            duration: 1000,
            easing: 'in',
            startup: true
          },
          colors :[
            {color: '#FF0000', darker: '#800000'},
            {color: '#FFB300', darker: '#CC7A00'},
            {color: '#00a336'},
            {color: '#808080'}
          ],
          pieSliceBorderColor: 'transparent',
          pieSliceText: 'value-and-percentage',
          legend: 'none',
          pieSliceTextStyle: {
            color: 'white',
            bold: true,
            fontSize: 16
          },
          pieSliceBorderColor: 'transparent',
          pieHole: 0.35,
        };";
      
        } else {
            $TotalSumD = 0;

            $DonutData = " var Donutdata = google.visualization.arrayToDataTable([
          ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
          ['ไม่มีข้อมูล',    75],
        ]);";

            $DonutOptions = "var Donutoptions = {
          chartArea: {'width': '99%', 'height': '99%'},
          pieSliceText: 'none',
          tooltip: { trigger: 'none' },
          slices: {
            0: { color: 'grey' },
          },
          pieHole: 0.35,
          legend: 'none',

        };";

        }

        // BarOptions ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $BarMOptions = "var BarMoptions = {
          bar: { groupWidth: '85%' },
          chartArea: {'width': '80%', 'height': '80%'},
          fontName:'Arial',
          fontSize:'11',
          bars: 'horizontal', // Required for Material Bar Charts. vertical
          hAxis: {
            minValue: 0,
            format: '0',
            viewWindow: {
              min: 0
            },
          },
          legend: {position: 'none'},
          animation: {
               duration: 1000,
               easing: 'in',
              startup: true
          },
          annotations: {
            textStyle: {
              fontName:'Arial',
              fontSize: 11,
              color: '#000',
              auraColor: 'none'
            }
          },
        };";

        $BarUOptions = "var BarUoptions = {
          bar: { groupWidth: '85%' },
          chartArea: {'width': '80%', 'height': '80%'},
          fontName:'Arial',
          fontSize:'11',
          bars: 'horizontal', // Required for Material Bar Charts. vertical
          hAxis: {
            minValue: 0,
            format: '0',
            viewWindow: {
              min: 0
            },
          },
          legend: {position: 'none'},
          animation: {
               duration: 1000,
               easing: 'in',
              startup: true
          },
          annotations: {
            textStyle: {
              fontName:'Arial',
              fontSize: 11,
              color: '#000',
              auraColor: 'none'
            }
          },
        };";
        
        // UserChart ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (!empty($fetchRowUser)) {
            $addRow = '';
            $Barcolor = array(
                "#3459B8", // Dark Blue
                "#5077C6",
                "#6D94D4",
                "#89B2E2",
                "#A6CFF0", // Pale Blue
            );
            $i = 0;
            foreach ($fetchRowUser as $key => $value) {
                $addRow .= "['" . $value['dept_initialname'] . "', " . $value['count'] . ", ". $value['count'] .", '" . $Barcolor[$i] . "'],";
                $i++;
            }

            $UserData = "var Userdata =  new google.visualization.arrayToDataTable([
          ['แผนก','จำนวนใบแจ้งซ่อม', {type: 'string', role: 'annotation'}, { role: 'style' }],
          " . $addRow . "
          ]);";
        } else {
            $UserData = "var Userdata =  new google.visualization.arrayToDataTable([
          ['แผนก','จำนวนใบแจ้งซ่อม'],
          ['ไม่มีข้อมูล',0]
          ]);";

          $BarUOptions = "var BarUoptions = {
            bar: { groupWidth: '85%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            bars: 'horizontal', // Required for Material Bar Charts. vertical
            hAxis: {
              minValue: 0,
              maxValue: 100,
              format: '0',
              viewWindow: {
                min: 0
              },
            },
            legend: {position: 'none'},
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            },
            annotations: {
              textStyle: {
                fontName:'Arial',
                fontSize: 11,
                color: '#000',
                auraColor: 'none'
              }
            },
          };";
        }

        // MachineChart ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (!empty($fetchRowMachine)) {
            $addRow = '';
            $Barcolor = array(
                "#3459B8", // Dark Blue
                "#5077C6",
                "#6D94D4",
                "#89B2E2",
                "#A6CFF0", // Pale Blue
            );
            $i = 0;
            foreach ($fetchRowMachine as $key => $value) {
                $addRow .= "['" . $value['name_machine'] . "', " . $value['count'] . ", ".$value['count'].", '" . $Barcolor[$i] . "'],";
                $i++;
            }

            $MachineData = "var Machinedata =  new google.visualization.arrayToDataTable([
          ['เครื่องจักร-อุปกรณ์','จำนวนใบแจ้งซ่อม', {type: 'string', role: 'annotation'}, { role: 'style' }],
          " . $addRow . "
          ]);";

        } else {
            $MachineData = "var Machinedata =  new google.visualization.arrayToDataTable([
          ['เครื่องจักร-อุปกรณ์','จำนวนใบแจ้งซ่อม'],
          ['ไม่มีข้อมูล',0]
          ]);";
          $BarMOptions = "var BarMoptions = {
            bar: { groupWidth: '85%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            bars: 'horizontal', // Required for Material Bar Charts. vertical
            hAxis: {
              minValue: 0,
              maxValue: 100,
              format: '0',
              viewWindow: {
                min: 0
              },
            },
            legend: {position: 'none'},
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            },
            annotations: {
              textStyle: {
                fontName:'Arial',
                fontSize: 11,
                color: '#000',
                auraColor: 'none'
              }
            },
          };";
        }

        // FetchDept /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $addRow = "";
        $addRowAvg = "";
        $addRowTable1 = "";
        $addRowTable2 = "";
        $i = 0;
        if (!empty($fetchRowDept)) {
            
            foreach ($fetchRowDept as $key => $value) {

                $sqlDataRepair = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
          tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
          LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
          LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
          LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
          LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
          WHERE tb_maintenance_request.ref_id_site_request = " . $data['site'] . "
          AND tb_maintenance_request.ref_id_dept_responsibility=" . $value['ref_id_dept_responsibility'] . "
          AND " . $text_query . $text_dept . "";

                $sqlDataAverage = "SELECT tb_maintenance_request.*, tb_dept.dept_initialname
          FROM tb_maintenance_request
          LEFT JOIN tb_dept ON (tb_maintenance_request.ref_id_dept_responsibility = tb_dept.id_dept)
          WHERE tb_maintenance_request.ref_id_site_request = " . $data['site'] . "
          AND tb_maintenance_request.ref_id_dept_responsibility = " . $value['ref_id_dept_responsibility'] . "
          AND " . $text_query . $text_dept . "
          AND tb_maintenance_request.duration_serv_start IS NOT NULL
          AND tb_maintenance_request.duration_serv_end IS NOT NULL";

                $fetchDataRepair = $obj->fetchRows($sqlDataRepair);

                $fetchDataAverage = $obj->fetchRows($sqlDataAverage);

                $TotalWait_approved = 0;
                $TotalNo_approved = 0;
                $TotalRepairing = 0;
                $TotalWait_repair = 0;
                $TotalWait_accept = 0;
                $TotalWait_hand_over = 0;
                $TotalHand_over = 0;
                $TotalCancel = 0;

                // RepaiChart /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $getStatus = SortStatus($fetchDataRepair);

                $TotalWait_approved = $getStatus['Wait_approved'];
                $TotalNo_approved = $getStatus['No_approved'];
                $TotalRepairing = $getStatus['Repairing'];
                $TotalWait_repair = $getStatus['Wait_repair'];
                $TotalWait_accept = $getStatus['Wait_accept'];
                $TotalWait_hand_over = $getStatus['Wait_hand_over'];
                $TotalHand_over = $getStatus['Hand_over'];
                $TotalCancel = $getStatus['Cancel'];
                
                $Total1 = $TotalWait_approved + $TotalWait_accept;
                $Total2 = $TotalWait_repair + $TotalRepairing;
                $Total3 = $TotalWait_hand_over + $TotalHand_over;
                if ($Total1 != 0 || $Total2 != 0 || $Total3 != 0) {
                    $addRow .= "['" . $fetchRowDept[$key]['dept_initialname'] . "', " . $Total1 . ", " . $Total1 . ", " . $Total2 . ", " . $Total2 . ", " . $Total3 . ", " . $Total3 . "],";
                }
               
                // AvgChart //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (!empty($fetchDataAverage)) {

                    $sum = 0;
                    
                    foreach ($fetchDataAverage as $keys => $values) {

                        $datetime1 = $values['duration_serv_start']; //start time
                        $datetime2 = $values['duration_serv_end']; //end time
                        $diff = timeDifference($datetime2, $datetime1);
                        $sum += $diff;

                    }
                    $avgSum = $sum / count($fetchDataAverage);
                    $AVGSum = round($avgSum, 2);
                    $RowHour = round($AVGSum / 60, 2);
                    $NumHour = $RowHour;
                    if($RowHour <= 1){
                      $RowMinute = floor($RowHour * 60);
                      $RowHour = $RowMinute.' นาที';
                      $fRowHour = $RowHour;
                      if($RowHour <= 15){
                        $RowHour = 'น้อยกว่า 15 นาที';
                        $fRowHour = $RowHour;
                      }
                      if($RowMinute == 60){
                        $RowHour = '1 ชั่วโมง';
                        $fRowHour = $RowHour;
                      }
                    }else{
                      $minute = $RowHour - floor($RowHour);
                      $RowMinute = floor($minute * 60);
                      $fRowHour = floor($RowHour).' ชั่วโมง '.$RowMinute.' นาที';
                      $RowHour = floor($RowHour).'.'.$RowMinute.' ชั่วโมง';
                    }
                    $Barcolor = array(
                        "#3459B8", // Dark Blue
                        "#5077C6",
                        "#6D94D4",
                        "#89B2E2",
                        "#A6CFF0", // Pale Blue
                    );
                    $addRowAvg .= "['" . $fetchRowDept[$key]['dept_initialname'] . "', {v:" . $NumHour . ",f:'" . $fRowHour . "'}, '" . $RowHour . "', '" . $Barcolor[$i] . "'],";
                    $i++;
                }

                // TableChart (ALL)//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($_POST['dept'] == 0) {
                    $sqlDataTable1 = "SELECT tb_user.id_user,  COUNT(id_maintenance_request) as request, tb_user.fullname, tb_user.class_user, tb_dept.dept_initialname
                  FROM tb_maintenance_request
                  LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request = tb_maintenance_request.id_maintenance_request)
                  LEFT JOIN tb_user ON (tb_user.id_user = tb_ref_repairer.ref_id_user_repairer)
                  LEFT JOIN tb_dept ON (tb_dept.id_dept = tb_user.ref_id_dept)
                  WHERE tb_maintenance_request.ref_id_site_request=" . $data['site'] . "
                  AND tb_maintenance_request.status_approved = 1
                  AND tb_maintenance_request.maintenance_request_status = 1
                  AND tb_maintenance_request.ref_id_dept_responsibility=" . $value['ref_id_dept_responsibility'] . "
                  AND tb_maintenance_request.allotted_date IS NOT NULL
                  AND tb_maintenance_request.duration_serv_end IS NULL
                  AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
                  AND tb_user.status_user = 1
                  GROUP by tb_user.id_user
                  ORDER by request DESC
                  LIMIT 1";

                    $sqlDataTable2 = "SELECT tb_user.ref_id_dept, tb_dept.dept_initialname,
                  (SELECT COUNT(*) FROM tb_user WHERE ref_id_dept = " . $value['ref_id_dept_responsibility'] . " AND ref_id_site = " . $data['site'] . " AND class_user = 2 AND status_user = 1) AS Count2,
                  (SELECT COUNT(*) FROM tb_user WHERE ref_id_dept = " . $value['ref_id_dept_responsibility'] . " AND ref_id_site = " . $data['site'] . " AND class_user = 3 AND status_user = 1) AS Count3,
                  (SELECT count(*)
                    FROM tb_maintenance_request
                    WHERE tb_maintenance_request.duration_serv_end IS NULL
                    AND tb_maintenance_request.allotted_date IS NOT NULL
                    AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
                    AND tb_maintenance_request.maintenance_request_status = 1
                    AND tb_maintenance_request.ref_id_dept_responsibility=" . $value['ref_id_dept_responsibility'] . "
                    AND tb_maintenance_request.ref_id_site_request=" . $data['site'] . "
                    AND tb_maintenance_request.status_approved=1) as mt_req
                FROM
                  tb_user
                LEFT JOIN tb_dept ON (tb_user.ref_id_dept = tb_dept.id_dept)
                WHERE
                  ref_id_dept = " . $value['ref_id_dept_responsibility'] . "
                  AND ref_id_site = " . $data['site'] . "
                  AND status_user = 1
                GROUP BY ref_id_dept;";

                    $fetchDataTable1 = $obj->fetchRows($sqlDataTable1);

                    $fetchDataTable2 = $obj->fetchRows($sqlDataTable2);

                    if (!empty($fetchDataTable1)) {

                        foreach ($fetchDataTable1 as $Table1Key => $Table1Value) {
                            $addRowTable1 .= "['" . $Table1Value['dept_initialname'] . "', '" . $Table1Value['fullname'] . "', '" . $classArr[$Table1Value['class_user']] . "', " . $Table1Value['request'] . "],";
                        }
                    }

                    if (!empty($fetchDataTable2)) {

                        foreach ($fetchDataTable2 as $Table2Key => $Table2Value) {
                            $addRowTable2 .= "['" . $Table2Value['dept_initialname'] . "', " . $Table2Value['Count3'] . ", " . $Table2Value['Count2'] . ", " . $Table2Value['mt_req'] . "],";
                        }

                    }
                }
            }

            // TableChart (Each Dept)///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if($_POST['dept'] != 0){
              $sqlDataTable1 = "SELECT tb_user.id_user,  COUNT(id_maintenance_request) as request, tb_user.fullname, tb_user.class_user, tb_dept.dept_initialname
              FROM tb_maintenance_request
              LEFT JOIN tb_ref_repairer ON (tb_ref_repairer.ref_id_maintenance_request = tb_maintenance_request.id_maintenance_request)
              LEFT JOIN tb_user ON (tb_user.id_user = tb_ref_repairer.ref_id_user_repairer)
              LEFT JOIN tb_dept ON (tb_dept.id_dept = tb_user.ref_id_dept)
              WHERE tb_maintenance_request.ref_id_site_request=" . $data['site'] . "
              AND tb_maintenance_request.status_approved = 1
              AND tb_maintenance_request.maintenance_request_status = 1
              AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
              AND tb_maintenance_request.ref_id_dept_responsibility=" . $_POST['dept'] . "
              AND tb_maintenance_request.allotted_date IS NOT NULL
              AND tb_maintenance_request.duration_serv_end IS NULL
              AND tb_maintenance_request.ref_id_user_cancel IS NULL
              AND tb_user.status_user = 1
              GROUP by tb_user.id_user
              ORDER by request DESC
              LIMIT 5";

                $sqlDataTable2 = "SELECT tb_user.ref_id_dept, tb_dept.dept_initialname,
              (SELECT COUNT(*) FROM tb_user WHERE ref_id_dept = " . $_POST['dept'] . " AND ref_id_site = " . $data['site'] . " AND class_user = 2 AND status_user = 1) AS Count2,
              (SELECT COUNT(*) FROM tb_user WHERE ref_id_dept = " . $_POST['dept'] . " AND ref_id_site = " . $data['site'] . " AND class_user = 3 AND status_user = 1) AS Count3,
              (SELECT count(*)
                FROM tb_maintenance_request
                WHERE tb_maintenance_request.duration_serv_end IS NULL
                AND tb_maintenance_request.allotted_date IS NOT NULL  
                AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
                AND tb_maintenance_request.maintenance_request_status = 1
                AND tb_maintenance_request.ref_id_dept_responsibility=" . $_POST['dept'] . "
                AND tb_maintenance_request.ref_id_site_request=" . $data['site'] . "
                AND tb_maintenance_request.status_approved=1) as mt_req
              FROM tb_user
              LEFT JOIN tb_dept ON (tb_user.ref_id_dept = tb_dept.id_dept)
              WHERE ref_id_dept = " . $_POST['dept'] . "
              AND ref_id_site = " . $data['site'] . "
              AND status_user = 1
              GROUP BY ref_id_dept;";

                $fetchDataTable1 = $obj->fetchRows($sqlDataTable1);

                $fetchDataTable2 = $obj->fetchRows($sqlDataTable2);

                if (!empty($fetchDataTable1)) {

                    foreach ($fetchDataTable1 as $Table1Key => $Table1Value) {
                        $addRowTable1 .= "['" . $Table1Value['dept_initialname'] . "', '" . $Table1Value['fullname'] . "', '" . $classArr[$Table1Value['class_user']] . "', " . $Table1Value['request'] . "],";
                    }
                }

                if (!empty($fetchDataTable2)) {

                    foreach ($fetchDataTable2 as $Table2Key => $Table2Value) {
                        $addRowTable2 .= "['" . $Table2Value['dept_initialname'] . "', " . $Table2Value['Count3'] . ", " . $Table2Value['Count2'] . ", " . $Table2Value['mt_req'] . "],";
                    }
                }
            }

            // DrawChart /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $RepairData = "var Repairdata = new google.visualization.DataTable();
          Repairdata.addColumn('string', 'แผนก');
          Repairdata.addColumn('number', 'อยู่ระหว่างอนุมัติ/ช่างรับงาน');
          Repairdata.addColumn({type: 'number', role: 'annotation'});
          Repairdata.addColumn('number', 'อยู่ระหว่างการซ่อม');
          Repairdata.addColumn({type: 'number', role: 'annotation'});
          Repairdata.addColumn('number', 'ซ่อมสำเร็จ');
          Repairdata.addColumn({type: 'number', role: 'annotation'});
          Repairdata.addRows([
            " . $addRow . "
          ]);";          
            $AvgData = "var Avgdata = new google.visualization.DataTable();
          Avgdata.addColumn('string', 'แผนก');
          Avgdata.addColumn('number', 'เวลาเฉลี่ย');
          Avgdata.addColumn({type: 'string', role: 'annotation'});
          Avgdata.addColumn({type: 'string', role: 'style'});
          Avgdata.addRows([
            " . $addRowAvg . "
          ]);";
            $Table1Data = "var Table1data = new google.visualization.DataTable();
          Table1data.addColumn('string', 'แผนก');
          Table1data.addColumn('string', 'ชื่อ');
          Table1data.addColumn('string', 'ระดับ');
          Table1data.addColumn('number', 'งานที่กำลังซ่อมทั้งหมด');
          Table1data.addRows([
            " . $addRowTable1 . "
        ]);";
            $Table2Data = "var Table2data = new google.visualization.DataTable();
          Table2data.addColumn('string', 'แผนก');
          Table2data.addColumn('number', 'หัวหน้าช่าง');
          Table2data.addColumn('number', 'ช่างซ่อม');
          Table2data.addColumn('number', 'งานที่กำลังซ่อมทั้งหมด');
          Table2data.addRows([
            " . $addRowTable2 . "
          ]);";
            $ColumnOptions = "var Columnoptions = {
            bar: { groupWidth: '80%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            colors: [
              {color: '#FF0000', darker: '#800000'},
              {color: '#FFB300', darker: '#CC7A00'},
              {color: '#00a336'},
            ],
            bars: 'vertical', // Required for Material Bar Charts. vertical
            hAxis: {
              gridlines: {count: 15},
            
            },
            vAxis: {
              format: '0',
              minValue: 0,
              viewWindow: {
                min: 0
              }
            },
            legend: {position: 'top',
              alignment: 'center'
            },
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            },
            annotations: {
              textStyle: {
                fontName:'Arial',
                fontSize: 11,
                color: '#000',
                auraColor: 'none'
              }
            },
          };";
          $AvgOptions = "var Avgoptions = {
            bar: { groupWidth: '50%' },
            chartArea: {'width': '80%', 'height': '80%'},
            fontName:'Arial',
            fontSize:'11',
            bars: 'vertical', // Required for Material Bar Charts. vertical
            hAxis: {
              gridlines: {count: 15},
            },
            vAxis: {
              format: '0',
              viewWindow: {
                min: 0
              }
            },
            legend: 'none',
            animation: {
                 duration: 1000,
                 easing: 'in',
                startup: true
            },
            annotations: {
              textStyle: {
                fontName:'Arial',
                fontSize: 11,
                color: '#000',
                auraColor: 'none'
              }
            },
          };";
          $Tableoptions = "var Tableoptions = { showRowNumber: true,
            width: '100%',
            sortColumn: 3,
            sortAscending: false,
            cssClassNames: {
              headerCell: 'center-text', // CSS class for header cells
              tableCell: 'left-text' // CSS class for non-header cells
            },
            autoWidth: true
        };";
        }
  
        // Check Empty Data ////////////////////////////////////////////////////////////////////////////////////////////
        if(empty($fetchRowDept) || $addRow=='' || $addRowAvg=='' || $addRowTable1 == "" || $addRowTable2 == ""){
          if($addRow==''){
            $RepairData = "var Repairdata = new google.visualization.DataTable();
            Repairdata.addColumn('string', 'แผนก');
            Repairdata.addColumn('number', 'รออนุมัติ/จ่ายงาน');
            Repairdata.addColumn('number', 'กำลังซ่อม');
            Repairdata.addColumn('number', 'ปิดงานและส่งมอบแล้ว');
            Repairdata.addRows([
              ['ไม่มีข้อมูล',0,0,0]
            ]);";
            $ColumnOptions = "var Columnoptions = {
              bar: { groupWidth: '80%' },
              chartArea: {'width': '80%', 'height': '80%'},
              fontName:'Arial',
              fontSize:'11',
              colors: [
                {color: '#FF0000', darker: '#800000'},
                {color: '#FFB300', darker: '#CC7A00'},
                {color: '#00a336'},
              ],
              bars: 'vertical', // Required for Material Bar Charts. vertical
              hAxis: {
                gridlines: {count: 15},
              },
              vAxis: {
                format: '0',
                minValue: 0,
                maxValue: 100,
                viewWindow: {
                  min: 0
                }
              },
              legend: 'none',
              animation: {
                   duration: 1000,
                   easing: 'in',
                  startup: true
              }
            };";
          }
          if(($addRowAvg=='')){
            $AvgData = "var Avgdata = new google.visualization.DataTable();
            Avgdata.addColumn('string', 'แผนก');
            Avgdata.addColumn('number', 'เวลาเฉลี่ย (ชั่วโมง)');
            Avgdata.addRows([
              ['ไม่มีข้อมูล',0]
            ]);";
            $AvgOptions = "var Avgoptions = {
              bar: { groupWidth: '80%' },
              chartArea: {'width': '80%', 'height': '80%'},
              fontName:'Arial',
              fontSize:'11',
              colors: [
                {color: '#FF0000', darker: '#800000'},
                {color: '#FFB300', darker: '#CC7A00'},
                {color: '#00a336'},
              ],
              bars: 'vertical', // Required for Material Bar Charts. vertical
              hAxis: {
                gridlines: {count: 15},
              },
              vAxis: {
                format: '0',
                minValue: 0,
                maxValue: 24,
                viewWindow: {
                  min: 0
                }
              },
              legend: 'none',
              animation: {
                   duration: 1000,
                   easing: 'in',
                  startup: true
              }
            };";  
          }
          if($addRowTable1 == ""){
            $Table1Data = "var Table1data = new google.visualization.DataTable();
          Table1data.addColumn('string', 'แผนก');
          Table1data.addColumn('string', 'ชื่อ');
          Table1data.addColumn('string', 'ระดับ');
          Table1data.addColumn('number', 'งานที่กำลังซ่อม');
          Table1data.addRows([
            ['ไม่มีข้อมูล','ไม่มีข้อมูล','ไม่มีข้อมูล',0]
          ]);";
          }
          if($addRowTable2 == ""){
            $Table2Data = "var Table2data = new google.visualization.DataTable();
          Table2data.addColumn('string', 'แผนก');
          Table2data.addColumn('string', 'หัวหน้าช่าง');
          Table2data.addColumn('string', 'ช่างซ่อม');
          Table2data.addColumn('number', 'งานที่กำลังซ่อม');
          Table2data.addRows([
            ['ไม่มีข้อมูล','ไม่มีข้อมูล','ไม่มีข้อมูล',0]
          ]);";
          }
          $Tableoptions = "var Tableoptions = { showRowNumber: true,
            width: '100%',
            sortColumn: 3,
            sortAscending: false,
            cssClassNames: {
              headerCell: 'center-text',
              tableCell: 'center-text' // CSS class for non-header cells
            },
            autoWidth: true
          }";
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // DrawChart ///////////////////////////////////////////////////////////////////////////////////////////////////
        $outputData = "<script type=\"text/javascript\">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        " . $DonutData . "
        " . $DonutOptions . "

        " . $UserData . "

        " . $MachineData . "
        " . $BarMOptions . "
        " . $BarUOptions . "

        " . $RepairData . "

        " . $AvgData . "
        " . $AvgOptions . "
        
        " . $ColumnOptions . "

        var donutchart = new google.visualization.PieChart(document.getElementById('donutchart'));
        var userchart = new google.visualization.BarChart(document.getElementById('userchart'));
        var machinechart = new google.visualization.BarChart(document.getElementById('machinechart'));
        var repairchart = new google.visualization.ColumnChart(document.getElementById('repairchart'));
        var avgchart = new google.visualization.ColumnChart(document.getElementById('averagechart'));

        google.visualization.events.addListener(donutchart, 'ready', function () {

          function adjustTextSize() {

            var svgElement = document.querySelector('#donutchart svg');
            var chartWidth = svgElement.clientWidth;
            var chartHeight = svgElement.clientHeight;
            var totalSumText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            var fontSize = Math.min(chartWidth, chartHeight) * 0.1;
            var fontSize2 = Math.min(chartWidth, chartHeight) * 0.05;

            totalSumText.setAttribute('x', '50%');
            totalSumText.setAttribute('y', '45%');
            totalSumText.setAttribute('text-anchor', 'middle');
            totalSumText.setAttribute('dominant-baseline', 'central');
            totalSumText.setAttribute('font-size', fontSize);
            totalSumText.setAttribute('font-weight', 'bold');
            totalSumText.textContent = " . $TotalSumD . ";
            svgElement.appendChild(totalSumText);

            var totalText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            totalText.setAttribute('x', '50%');
            totalText.setAttribute('y', '55%');
            totalText.setAttribute('text-anchor', 'middle');
            totalText.setAttribute('dominant-baseline', 'middle');
            totalText.setAttribute('font-size', fontSize2);
            totalText.textContent = 'ทั้งหมด';
            svgElement.appendChild(totalText);
          }

        adjustTextSize();

        // Add an event listener to recalculate font size on window resize
        window.addEventListener('resize', function () {
          var svgElement = document.querySelector('#donutchart svg');
          svgElement.removeChild(svgElement.lastChild); // Remove the existing text
          adjustTextSize();
        });

        });

        donutchart.draw(Donutdata, Donutoptions);
        userchart.draw(Userdata, BarUoptions);
        machinechart.draw(Machinedata, BarMoptions);
        repairchart.draw(Repairdata, Columnoptions);
        avgchart.draw(Avgdata, Avgoptions);

      }

      google.charts.load('current', {packages: ['table']});
      google.charts.setOnLoadCallback(drawTable);

            function drawTable() {

             " . $Table1Data . "
             " . $Table2Data . "
             " . $Tableoptions . "

              var table1 = new google.visualization.Table(document.getElementById('table1chart'));
              var table2 = new google.visualization.Table(document.getElementById('table2chart'));

              table1.draw(Table1data, Tableoptions);
              table2.draw(Table2data, Tableoptions);

              var tableTitle = 'ช่างซ่อมที่มีงานมากที่สุด';
              var tableTitleHtml = '<div class=\"table-title \"><h6 style=\"margin-bottom: 0%; padding-bottom: 1%;padding-top: 0%;font-weight: bold;\">' + tableTitle + '</h6></div>';
              document.getElementById('table1chart').insertAdjacentHTML('afterbegin', tableTitleHtml);

              var tableTitle2 = 'อัตรากำลังพลช่างซ่อม';
              var tableTitleHtml2 = '<div class=\"table-title \"><h6 style=\"margin-bottom: 0%; padding-bottom: 1%;padding-top: 0%;font-weight: bold;\">' + tableTitle2 + '</h6></div>';
              document.getElementById('table2chart').insertAdjacentHTML('afterbegin', tableTitleHtml2);

              var cellsTable1 = document.querySelectorAll('#table1chart tr td:nth-child(5)');
              for (var i = 0; i < cellsTable1.length; i++) {
                cellsTable1[i].classList.add('centered-cell');
              }
              var cellsTable2 = document.querySelectorAll('#table2chart tr td:nth-child(n+3):nth-child(-n+5)');
              for (var i = 0; i < cellsTable2.length; i++) {
                cellsTable2[i].classList.add('centered-cell');
              }

            }
    </script>";
        echo $outputData;
        break;

}

exit();
