<?PHP
ob_start();
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once '../../include/class_crud.inc.php';
require_once '../../include/setting.inc.php';
require_once '../../include/function.inc.php';
$obj = new CRUD();

$action = $_REQUEST['action'];

switch ($action) {

    case 'module_list':

        empty($_POST['formData']) ? $_POST['formData'] = null : $_POST['formData'];

        parse_str($_POST['formData'], $formData);

        if (empty($formData['wait_approved']) && empty($formData['wait_accept']) && empty($formData['wait_repair']) && empty($formData['repairing'])
            && empty($formData['wait_hand_over']) && empty($formData['hand_over']) && empty($formData['no_approved']) && empty($formData['cancel'])) {
            $arrData = null;
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => intval(0),
                "recordsFiltered" => intval(0),
                "data" => $arrData,
            );
            echo json_encode($output);
            exit();
        }
        ;

        $exp_reservation = explode(" - ", $formData['reservationtime']);

        //16/03/2023
        $start_yyyy = substr($exp_reservation[0], 6, 4); //YYYY
        $start_mm = substr($exp_reservation[0], 3, 2); //MM
        $start_dd = substr($exp_reservation[0], 0, 2); //DD

        $end_yyyy = substr($exp_reservation[1], 6, 4); //YYYY
        $end_mm = substr($exp_reservation[1], 3, 2); //MM
        $end_dd = substr($exp_reservation[1], 0, 2); //DD

        $dateStart = $start_yyyy . '-' . $start_mm . '-' . $start_dd . ' 00:00:00';
        //echo "-------------";
        $dateEnd = $end_yyyy . '-' . $end_mm . '-' . $end_dd . ' 23:59:59';

        $wait_approved = '';
        $wait_accept = '';
        $wait_repair = '';
        $repairing = '';
        $wait_hand_over = '';
        $hand_over = '';
        $no_approved = '';
        $cancel = '';
        $and = '';
        $query_status = '';

        if (!empty($formData['radio'])) {
            if ($formData['radio'] == 'all') {
                $query_req = "(tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " OR tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . ")";
                if ($_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5) {
                    $query_req = " tb_maintenance_request.id_maintenance_request IS NOT NULL ";
                }
            } else if ($formData['radio'] == 'person') {
                $query_req = " tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . " ";
            } else if ($formData['radio'] == 'dept') {
                $query_req = " tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " ";
            } else if ($formData['radio'] == 'responsible') {
                $query_req = " tb_ref_repairer.ref_id_user_repairer=" . $_SESSION['sess_id_user'] . " ";
            } else {
                $query_req = '';
            }
        }

        // รออนุมัติ /จ่ายงาน
        if (!empty($formData['wait_approved'])) {
            $wait_approved = ' (tb_maintenance_request.status_approved=0
            AND tb_maintenance_request.allotted_date IS NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.duration_serv_end IS NULL
            AND tb_maintenance_request.hand_over_date IS NULL)';
            $and = ' AND';
        };

        // รอช่างรับงานซ่อม
        if (!empty($formData['wait_accept'])) {
            $wait_accept = ' (tb_maintenance_request.status_approved=1
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.allotted_accept_date IS NULL
            AND tb_maintenance_request.ref_user_id_accept_request IS NULL
            AND tb_maintenance_request.duration_serv_start IS NULL
            AND tb_maintenance_request.duration_serv_end IS NULL
            AND tb_maintenance_request.hand_over_date IS NULL)';
            $and = ' AND';
        };
        // รอซ่อม
        if (!empty($formData['wait_repair'])) {
            $wait_repair = ' (tb_maintenance_request.status_approved=1
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.allotted_accept_date IS NOT NULL
            AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
            AND tb_maintenance_request.duration_serv_start IS NULL
            AND tb_maintenance_request.duration_serv_end IS NULL
            AND tb_maintenance_request.hand_over_date IS NULL)';
            $and = ' AND';
        };

        // กำลังซ่อม
        if (!empty($formData['repairing'])) {
            $repairing = ' (tb_maintenance_request.status_approved=1
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.allotted_accept_date IS NOT NULL
            AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
            AND tb_maintenance_request.duration_serv_start IS NOT NULL
            AND tb_maintenance_request.duration_serv_end IS NULL
            AND tb_maintenance_request.hand_over_date IS NULL)';
            $and = ' AND';
        };
        // งานรอส่งมอบ
        if (!empty($formData['wait_hand_over'])) {
            $wait_hand_over = ' (tb_maintenance_request.status_approved=1
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.allotted_accept_date IS NOT NULL
            AND tb_maintenance_request.ref_user_id_accept_request IS NOT NULL
            AND tb_maintenance_request.duration_serv_start IS NOT NULL
            AND tb_maintenance_request.duration_serv_end IS NOT NULL
            AND tb_maintenance_request.hand_over_date IS NOT NULL
            AND tb_maintenance_request.survay_date IS NULL)';
            $and = ' AND';
        };

        // ปิดงานซ่อมแล้ว
        if (!empty($formData['hand_over'])) {
            $hand_over = ' (tb_maintenance_request.status_approved=1
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.duration_serv_start IS NOT NULL
            AND tb_maintenance_request.duration_serv_end IS NOT NULL
            AND tb_maintenance_request.survay_date IS NOT NULL)';
            $and = ' AND';
        };

        // ไม่อนุมัติ
        if (!empty($formData['no_approved'])) {
            $no_approved = ' (tb_maintenance_request.status_approved=2
            AND tb_maintenance_request.allotted_date IS NOT NULL
            AND tb_maintenance_request.maintenance_request_status=1
            AND tb_maintenance_request.duration_serv_end IS NULL
            AND tb_maintenance_request.hand_over_date IS NULL)';
            $and = ' AND';
        };

        // ยกเลิกใบแจ้งซ่อม
        if (!empty($formData['cancel'])) {
            $cancel = ' (tb_maintenance_request.maintenance_request_status=2)';
            $and = ' AND';
        };

        ($wait_accept != '') ? ($wait_approved == '' ? $wait_accept : $wait_accept = ' OR' . $wait_accept) : '';
        ($wait_repair != '') ? (($wait_approved == '') && ($wait_accept == '') ? $wait_repair : $wait_repair = ' OR' . $wait_repair) : '';
        ($repairing != '') ? (($wait_approved == '') && ($wait_accept == '') && ($wait_repair == '') && ($wait_repair == '') ? $repairing : $repairing = ' OR' . $repairing) : '';
        ($wait_hand_over != '') ? (($wait_approved == '') && ($wait_accept == '') && ($wait_repair == '') && ($repairing == '') ? $wait_hand_over : $wait_hand_over = ' OR' . $wait_hand_over) : '';
        ($hand_over != '') ? (($wait_approved == '') && ($wait_accept == '') && ($wait_repair == '') && ($repairing == '') && ($wait_hand_over == '') ? $hand_over : $hand_over = ' OR' . $hand_over) : '';
        ($no_approved != '') ? (($wait_approved == '') && ($wait_accept == '') && ($wait_repair == '') && ($repairing == '') && ($wait_hand_over == '') && ($hand_over == '') ? $no_approved : $no_approved = ' OR' . $no_approved) : '';
        ($cancel != '') ? (($wait_approved == '') && ($wait_accept == '') && ($wait_repair == '') && ($repairing == '') && ($wait_hand_over == '') && ($hand_over == '') && ($no_approved == '') ? $cancel : $cancel = ' OR' . $cancel) : '';

        $query_status = $and . ' ( ' . $wait_approved . $wait_accept . $wait_repair . $repairing . $wait_hand_over . $hand_over . $no_approved . $cancel . ' )';

        $_POST['order']['0']['column'] = $_POST['order']['0']['column'] + 1;

        $search = $_POST["search"]["value"];

        $query_search = "";
        if (!empty($search)) {
            $query_search = " AND (tb_machine_master.name_machine LIKE '%" . $search . "%' OR tb_maintenance_request.maintenance_request_no LIKE '%" . $search . "%') ";
        } else {
            $query_search = "";
        }

        if ($_POST["start"] == 0) {
            $length = $_POST['length'];
        } else {
            $length = $_POST['length'];
        }

        $start = ($_POST["start"] - 1) * $_POST['length'];

        $limit = "LIMIT " . $_POST['start'] . ", " . $length . "";

        $length == -1 ? $limit = "" : '';

        empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] = 0 : $_POST['order']['0']['column'];

        $colunm_sort = array( //ใช้เรียงข้อมูล
            0 => "tb_maintenance_request.id_maintenance_request",
            1 => "tb_maintenance_request.id_maintenance_request",
            2 => "tb_maintenance_request.maintenance_request_no",
            3 => "tb_maintenance_request.mt_request_date",
            4 => "tb_machine_site.status_approved",
            5 => "tb_machine_site.code_machine_site",
            6 => "tb_machine_master.name_machine",
            7 => "tb_category.name_menu",
            8 => "tb_maintenance_request.problem_statement",
            9 => "tb_maintenance_request.problem_statement",
            10 => "tb_dept_responsibility.dept_initialname",
            11 => "tb_maintenance_request.ref_id_job_type",
            12 => "tb_maintenance_request.related_to_safty",
        );

        $orderBY = $colunm_sort[$_POST['order']['0']['column']];

        $arrData = array();

        // $_SESSION['sess_class_user'] != 4 ? $query_class = ' WHERE tb_dept_responsibility.id_dept=' . $_SESSION['sess_id_dept'] . '' : $query_class = '';

        $sqlGrouprow = $obj->fetchRows("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); ");

        switch ($_SESSION['sess_class_user']) {
            case 1:
            case 0:
            default:

                $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' " . $query_status . $query_search;

                $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");

                $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE tb_maintenance_request.ref_id_user_request=" . $_SESSION['sess_id_user'] . " AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' " . $query_status . $query_search);
                
            break;

            case 2:
            
                $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " " . $query_status . $query_search;

                $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");

                $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . " AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " " . $query_status . $query_search);
                
            break;

            case 3:
                $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'
                AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . " " . $query_status . $query_search;

                $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");
                
                $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'
                AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . "" . $query_status . $query_search); //ถ้าจำนวน Row ทั้งหมด
                
            break;

            // case 4:
            //     $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
            //     tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
            //     LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
            //     LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
            //     LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
            //     LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
            //     LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
            //     WHERE  ".$query_req." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."
            //     AND tb_maintenance_request.mt_request_date BETWEEN '".$dateStart."' AND '".$dateEnd."'
            //     AND tb_maintenance_request.maintenance_request_status!=0".$query_status.$query_search;
            //     //$query_class.' '.$query_search
            //     $fetchRow = $obj->fetchRows($sql_fetchRow." ORDER BY ".$orderBY." ".$_POST['order']['0']['dir']." ".$limit."");
            //     //$sql_numRow = "SELECT count(id_maintenance_request) AS total_row FROM tb_maintenance_request ";
            //     //$numRow = $obj->getCount($sql_numRow);    //ถ้าจำนวน Row ทั้งหมด
            //     //$numRow = count($fetchRow);
            //     $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request
            //     WHERE ".$query_req." AND tb_maintenance_request.ref_id_site_request=".$_SESSION['sess_ref_id_site']."
            //     AND tb_maintenance_request.maintenance_request_status!=0
            //     AND tb_maintenance_request.mt_request_date BETWEEN '".$dateStart."' AND '".$dateEnd."' ".$query_status.$query_search);

            // break;
            case 4:
            case 5:
            
                $sql_fetchRow = "SELECT tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . " AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'
                " . $query_status . $query_search;

                $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");
                
                $numRow = $obj->getCount("SELECT count(tb_maintenance_request.id_maintenance_request) AS total_row FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE " . $query_req . " AND tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'
                " . $query_status . $query_search);
                
            break;
        
        }

        if (count($fetchRow) > 0) {
            $No = ($numRow - $_POST['start']);
            foreach ($fetchRow as $key => $value) {

                //&& $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['hand_over_date']==NULL
                if ($fetchRow[$key]['status_approved'] == 0 && $fetchRow[$key]['allotted_date'] == null && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';
                } else if ($fetchRow[$key]['status_approved'] == 2 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">ไม่อนุมัติ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] != null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['survay_date'] == null
                    && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != null) {
                    $req_textstatus = '<span class="text-bold text-success">กำลังซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != '') {
                    $req_textstatus = '<span class="text-bold text-danger">รอซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] == null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-success"> งานรอส่งมอบ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] != null) {
                    $req_textstatus = '<span class="text-bold text-success"> ปิดงานและส่งมอบแล้ว</span>';
                } else if ($fetchRow[$key]['maintenance_request_status'] == 2) {
                    $req_textstatus = '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
                } else {
                    $req_textstatus = '-';
                }
                $dataRow = array();
                $dataRow[] = $No . '.';
                //$dataRow[] = $No.'.'.(count($fetchRow)).'---'.$search.'--------'.$query_class.'-------------'.$query_search.$fetchRow[$key]['dept_request'];
                $dataRow[] = ($fetchRow[$key]['maintenance_request_no'] == '' ? '-' : $fetchRow[$key]['maintenance_request_no']); //.'----'.$slt_search.'-------'.$keyword
                $dataRow[] = ($fetchRow[$key]['mt_request_date'] == '' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']));
                $dataRow[] = $req_textstatus;
                $dataRow[] = ($fetchRow[$key]['code_machine_site'] == '' ? '-' : $fetchRow[$key]['code_machine_site']);
                $dataRow[] = (!empty($fetchRow[$key]['name_machine']) == '' ? 'ไม่ทราบชื่อ, ไม่ระบุ' : $fetchRow[$key]['name_machine']);
                $dataRow[] = ($fetchRow[$key]['name_menu'] == '' ? '-' : $fetchRow[$key]['name_menu']);
                //$dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : $fetchRow[$key]['problem_statement']);
                $dataRow[] = ($fetchRow[$key]['problem_statement'] == '' ? '-' : mb_substr($fetchRow[$key]['problem_statement'], 0, 50, "utf8"));
                $dataRow[] = (!empty($fetchRow[$key]['path_attachment_name']) ? '<a href="' . $pathReq . $fetchRow[$key]['path_attachment_name'] . '" data-toggle="lightbox" data-title="ใบแจ้งซ่อมเลขที่: ' . $fetchRow[$key]['maintenance_request_no'] . '" data-gallery="gallery" class="link-danger"><i class="fas fa-images"></i> คลิกดูภาพ</a>' : '-');
                $dataRow[] = ($fetchRow[$key]['dept_responsibility'] == '' ? '-' : $fetchRow[$key]['dept_responsibility']);
                $dataRow[] = ($fetchRow[$key]['ref_id_job_type'] == '' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']]);
                $dataRow[] = ($fetchRow[$key]['related_to_safty'] == 1 ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>');
                $arrData[] = $dataRow;
                $No--;
            }
        } else {
            $arrData = null;
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => intval(0),
                "recordsFiltered" => intval(0),
                "data" => $arrData,
            );
            echo json_encode($output);
            exit();
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => intval($numRow),
            "recordsFiltered" => intval($numRow),
            "data" => $arrData,
        );
        echo json_encode($output);
        exit();
        break;

    case 'module_user':

        empty($_POST['formData']) ? $_POST['formData'] = null : $_POST['formData'];

        parse_str($_POST['formData'], $formData);

        $exp_reservation = explode(" - ", $formData['reservationtime']);

        //16/03/2023
        $start_yyyy = substr($exp_reservation[0], 6, 4); //YYYY
        $start_mm = substr($exp_reservation[0], 3, 2); //MM
        $start_dd = substr($exp_reservation[0], 0, 2); //DD

        $end_yyyy = substr($exp_reservation[1], 6, 4); //YYYY
        $end_mm = substr($exp_reservation[1], 3, 2); //MM
        $end_dd = substr($exp_reservation[1], 0, 2); //DD

        $dateStart = $start_yyyy . '-' . $start_mm . '-' . $start_dd . ' 00:00:00';
        //echo "-------------";
        $dateEnd = $end_yyyy . '-' . $end_mm . '-' . $end_dd . ' 23:59:59';
//////////////////////////////////////////////////////////////////////////////
        $dept = '';
        $mydept = '';
        if ($formData['dept'] != 0) {
            $dept = " AND tb_maintenance_request.ref_id_dept_request=" . $formData['dept'] . " ";
        }

        if ($_SESSION['sess_class_user'] == 3) {
            $mydept = " AND tb_maintenance_request.ref_id_dept_responsibility=" . $_SESSION['sess_id_dept'] . " ";
        }

//////////////////////////////////////////////////////////////////////////////

        $_POST['order']['0']['column'] = $_POST['order']['0']['column'] + 1;

        $search = $_POST["search"]["value"];

        $query_search = "";
        if (!empty($search)) {
            $query_search = " AND (tb_machine_master.name_machine LIKE '%" . $search . "%' OR tb_maintenance_request.maintenance_request_no LIKE '%" . $search . "%') ";
        } else {
            $query_search = "";
        }
        if ($_POST["start"] == 0) {
            $length = $_POST['length'];
        } else {
            $length = $_POST['length'];
        }
        $start = ($_POST["start"] - 1) * $_POST['length'];

        $limit = "LIMIT " . $_POST['start'] . ", " . $length . "";

        $length == -1 ? $limit = "" : '';

        empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] = 0 : $_POST['order']['0']['column'];

        $colunm_sort = array( //ใช้เรียงข้อมูล
            0 => "tb_maintenance_request.id_maintenance_request",
            1 => "tb_maintenance_request.id_maintenance_request",
            2 => "tb_dept_request.dept_initialname",
            3 => "tb_maintenance_request.maintenance_request_no",
            4 => "tb_maintenance_request.mt_request_date",
            5 => "tb_machine_site.status_approved",
            6 => "tb_machine_site.code_machine_site",
            7 => "tb_machine_master.name_machine",
            8 => "tb_category.name_menu",
            9 => "tb_maintenance_request.problem_statement",
            10 => "tb_maintenance_request.problem_statement",
            11 => "tb_dept_responsibility.dept_initialname",
            12 => "tb_maintenance_request.ref_id_job_type",
            13 => "tb_maintenance_request.related_to_safty",

        );

        $orderBY = $colunm_sort[$_POST['order']['0']['column']];

        $arrData = array();

        $sql_fetchRow = "SELECT DISTINCT(tb_maintenance_request.id_maintenance_request),tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
        tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine, tb_dept_request.dept_initialname AS dept_request
        FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_dept AS tb_dept_request ON (tb_dept_request.id_dept = tb_maintenance_request.ref_id_dept_request)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $mydept . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'";

        // print_r($sql_fetchRow);
        // exit();

        $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");

        $numRow = $obj->getCount("SELECT count(DISTINCT(tb_maintenance_request.id_maintenance_request)) AS total_row FROM tb_maintenance_request
        LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
        LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
        LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
        LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
        LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
        WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $mydept . "
        AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");

        if (count($fetchRow) > 0) {
            $No = ($numRow - $_POST['start']);
            foreach ($fetchRow as $key => $value) {

                //&& $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['hand_over_date']==NULL
                if ($fetchRow[$key]['status_approved'] == 0 && $fetchRow[$key]['allotted_date'] == null && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';
                } else if ($fetchRow[$key]['status_approved'] == 2 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">ไม่อนุมัติ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] != null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['survay_date'] == null
                    && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != null) {
                    $req_textstatus = '<span class="text-bold text-success">กำลังซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != '') {
                    $req_textstatus = '<span class="text-bold text-danger">รอซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] == null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-success"> งานรอส่งมอบ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] != null) {
                    $req_textstatus = '<span class="text-bold text-success"> ปิดงานและส่งมอบแล้ว</span>';
                } else if ($fetchRow[$key]['maintenance_request_status'] == 2) {
                    $req_textstatus = '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
                } else {
                    $req_textstatus = '-';
                }
                $dataRow = array();
                $dataRow[] = $No . '.';
                //$dataRow[] = $No.'.'.(count($fetchRow)).'---'.$search.'--------'.$query_class.'-------------'.$query_search.$fetchRow[$key]['dept_request'];
                $dataRow[] = ($fetchRow[$key]['dept_request'] == '' ? '-' : $fetchRow[$key]['dept_request']);
                $dataRow[] = ($fetchRow[$key]['maintenance_request_no'] == '' ? '-' : $fetchRow[$key]['maintenance_request_no']); //.'----'.$slt_search.'-------'.$keyword
                $dataRow[] = ($fetchRow[$key]['mt_request_date'] == '' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']));
                $dataRow[] = $req_textstatus;
                $dataRow[] = ($fetchRow[$key]['code_machine_site'] == '' ? '-' : $fetchRow[$key]['code_machine_site']);
                $dataRow[] = (!empty($fetchRow[$key]['name_machine']) == '' ? 'ไม่ทราบชื่อ, ไม่ระบุ' : $fetchRow[$key]['name_machine']);
                $dataRow[] = ($fetchRow[$key]['name_menu'] == '' ? '-' : $fetchRow[$key]['name_menu']);
                //$dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : $fetchRow[$key]['problem_statement']);
                $dataRow[] = ($fetchRow[$key]['problem_statement'] == '' ? '-' : mb_substr($fetchRow[$key]['problem_statement'], 0, 50, "utf8"));
                $dataRow[] = (!empty($fetchRow[$key]['path_attachment_name']) ? '<a href="' . $pathReq . $fetchRow[$key]['path_attachment_name'] . '" data-toggle="lightbox" data-title="ใบแจ้งซ่อมเลขที่: ' . $fetchRow[$key]['maintenance_request_no'] . '" data-gallery="gallery" class="link-danger"><i class="fas fa-images"></i> คลิกดูภาพ</a>' : '-');
                $dataRow[] = ($fetchRow[$key]['dept_responsibility'] == '' ? '-' : $fetchRow[$key]['dept_responsibility']);
                $dataRow[] = ($fetchRow[$key]['ref_id_job_type'] == '' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']]);
                $dataRow[] = ($fetchRow[$key]['related_to_safty'] == 1 ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>');
                $arrData[] = $dataRow;
                $No--;
            }
        } else {
            $arrData = null;
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => intval(0),
                "recordsFiltered" => intval(0),
                "data" => $arrData,
            );
            echo json_encode($output);
            exit();
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => intval($numRow),
            "recordsFiltered" => intval($numRow),
            "data" => $arrData,
        );
        echo json_encode($output);
        exit();

        break;

    case 'module_machine':

        parse_str($_POST['formData'], $data);

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

        $dept = '';
        $menu = '';
        /////เช็คเซสชั่น, เช็คเมนูว่าเป็น Total none หรือไอดีของเมนู ลิมิตปฏิทิน

///////////////////////Datatable//////////////////////////////////////////
        $_POST['order']['0']['column'] = $_POST['order']['0']['column'] + 1;

        $search = $_POST["search"]["value"];

        $query_search = "";
        if (!empty($search)) {
            $query_search = " AND (tb_machine_master.name_machine LIKE '%" . $search . "%' OR tb_maintenance_request.maintenance_request_no LIKE '%" . $search . "%') ";
        } else {
            $query_search = "";
        }

        if ($_POST["start"] == 0) {
            $length = $_POST['length'];
        } else {
            $length = $_POST['length'];
        }

        $start = ($_POST["start"] - 1) * $_POST['length'];

        $limit = "LIMIT " . $_POST['start'] . ", " . $length . "";

        $length == -1 ? $limit = "" : '';

        empty($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] = 0 : $_POST['order']['0']['column'];

        $colunm_sort = array( //ใช้เรียงข้อมูล
            0 => "tb_maintenance_request.id_maintenance_request",
            1 => "tb_maintenance_request.id_maintenance_request",
            2 => "tb_maintenance_request.maintenance_request_no",
            3 => "tb_maintenance_request.mt_request_date",
            4 => "tb_machine_site.status_approved",
            5 => "tb_machine_site.code_machine_site",
            6 => "tb_machine_master.name_machine",
            7 => "tb_category.name_menu",
            8 => "tb_maintenance_request.problem_statement",
            9 => "tb_maintenance_request.problem_statement",
            10 => "tb_dept_responsibility.dept_initialname",
            11 => "tb_maintenance_request.ref_id_job_type",
            12 => "tb_maintenance_request.related_to_safty",
        );
        $orderBY = $colunm_sort[$_POST['order']['0']['column']];

        $arrData = array();
///////////////////////Datatable//////////////////////////////////

        if ($_SESSION['sess_class_user'] == 1 || $_SESSION['sess_class_user'] == 2 || $_SESSION['sess_class_user'] == 3) {

            $dept = '  AND tb_maintenance_request.ref_id_dept_responsibility=' . $_SESSION['sess_id_dept'] . '  ';
            $menu = '';
            if ($data['menu'] == 'total') {
                $menu = '';
            } else if ($data['menu'] == 'none') {
                $menu = ' AND tb_maintenance_request.ref_id_machine_site=0 ';
            } else {
                $menu = ' AND tb_machine_master.ref_id_menu=' . $data['menu'] . ' ';
            }

        } else if ($_SESSION['sess_class_user'] == 4 || $_SESSION['sess_class_user'] == 5) {

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
        }

        $fetchID = $obj->fetchRows("SELECT DISTINCT(tb_maintenance_request.ref_id_machine_site), tb_category.id_menu, tb_category.name_menu
                                    FROM tb_maintenance_request
                                    LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site = tb_maintenance_request.ref_id_machine_site)
                                    LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine = tb_machine_site.ref_id_machine_master)
                                    LEFT JOIN tb_category ON (tb_machine_master.ref_id_menu = tb_category.id_menu)
                                    WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "");
        $idMachine_site = "";

        foreach ($fetchID as $key => $value) {

            $idMachine_site .= count($fetchID) > 1 && $key == 0 ? '(' : '';
            $idMachine_site .= count($fetchID) > 1 && $key == 0 ? " tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . " " : " OR tb_maintenance_request.ref_id_machine_site=" . $value['ref_id_machine_site'] . " ";

            $idMachine_site .= count($fetchID) > 1 && array_key_last($fetchID) == $key ? ')' : '';
        }

        count($fetchID) == 1 ? $idMachine_site = str_replace('OR', '', $idMachine_site) : $idMachine_site;

        $sql_fetchRow = "SELECT  DISTINCT(tb_maintenance_request.id_maintenance_request),tb_maintenance_request.*, tb_dept_responsibility.dept_initialname AS dept_responsibility,
                tb_machine_site.code_machine_site, tb_category.name_menu, tb_machine_master.name_machine FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                AND " . $idMachine_site . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'";

        $fetchRow = $obj->fetchRows($sql_fetchRow . " ORDER BY " . $orderBY . " " . $_POST['order']['0']['dir'] . " " . $limit . "");

        $numRow = $obj->getCount("SELECT count(DISTINCT(tb_maintenance_request.id_maintenance_request)) AS total_row FROM tb_maintenance_request
                LEFT JOIN tb_machine_site ON (tb_machine_site.id_machine_site=tb_maintenance_request.ref_id_machine_site)
                LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
                LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)
                LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
                LEFT JOIN tb_ref_repairer ON (tb_maintenance_request.id_maintenance_request = tb_ref_repairer.ref_id_maintenance_request)
                WHERE tb_maintenance_request.ref_id_site_request=" . $_SESSION['sess_ref_id_site'] . $dept . $menu . "
                AND " . $idMachine_site . "
                AND tb_maintenance_request.mt_request_date BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'");

        if (count($fetchRow) > 0) {
            $No = ($numRow - $_POST['start']);
            foreach ($fetchRow as $key => $value) {

                //&& $fetchRow[$key]['duration_serv_end']==NULL && $fetchRow[$key]['hand_over_date']==NULL
                if ($fetchRow[$key]['status_approved'] == 0 && $fetchRow[$key]['allotted_date'] == null && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';
                } else if ($fetchRow[$key]['status_approved'] == 2 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">ไม่อนุมัติ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] != null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['survay_date'] == null
                    && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != null) {
                    $req_textstatus = '<span class="text-bold text-success">กำลังซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null && $fetchRow[$key]['ref_user_id_accept_request'] != '') {
                    $req_textstatus = '<span class="text-bold text-danger">รอซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_start'] == null && $fetchRow[$key]['duration_serv_end'] == null && $fetchRow[$key]['hand_over_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] == null) {
                    $req_textstatus = '<span class="text-bold text-success"> งานรอส่งมอบ</span>';
                } else if ($fetchRow[$key]['status_approved'] == 1 && $fetchRow[$key]['allotted_date'] != '' && $fetchRow[$key]['maintenance_request_status'] == 1
                    && $fetchRow[$key]['duration_serv_end'] != null && $fetchRow[$key]['hand_over_date'] != null && $fetchRow[$key]['survay_date'] != null) {
                    $req_textstatus = '<span class="text-bold text-success"> ปิดงานและส่งมอบแล้ว</span>';
                } else if ($fetchRow[$key]['maintenance_request_status'] == 2) {
                    $req_textstatus = '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
                } else {
                    $req_textstatus = '-';
                }
                $dataRow = array();
                $dataRow[] = $No . '.';
                //$dataRow[] = $No.'.'.(count($fetchRow)).'---'.$search.'--------'.$query_class.'-------------'.$query_search.$fetchRow[$key]['dept_request'];
                $dataRow[] = ($fetchRow[$key]['maintenance_request_no'] == '' ? '-' : $fetchRow[$key]['maintenance_request_no']); //.'----'.$slt_search.'-------'.$keyword
                $dataRow[] = ($fetchRow[$key]['mt_request_date'] == '' ? '-' : shortDateEN($fetchRow[$key]['mt_request_date']));
                $dataRow[] = $req_textstatus;
                $dataRow[] = ($fetchRow[$key]['code_machine_site'] == '' ? '-' : $fetchRow[$key]['code_machine_site']);
                $dataRow[] = (!empty($fetchRow[$key]['name_machine']) == '' ? 'ไม่ทราบชื่อ, ไม่ระบุ' : $fetchRow[$key]['name_machine']);
                $dataRow[] = ($fetchRow[$key]['name_menu'] == '' ? '-' : $fetchRow[$key]['name_menu']);
                //$dataRow[] = ($fetchRow[$key]['problem_statement']=='' ? '-' : $fetchRow[$key]['problem_statement']);
                $dataRow[] = ($fetchRow[$key]['problem_statement'] == '' ? '-' : mb_substr($fetchRow[$key]['problem_statement'], 0, 50, "utf8"));
                $dataRow[] = (!empty($fetchRow[$key]['path_attachment_name']) ? '<a href="' . $pathReq . $fetchRow[$key]['path_attachment_name'] . '" data-toggle="lightbox" data-title="ใบแจ้งซ่อมเลขที่: ' . $fetchRow[$key]['maintenance_request_no'] . '" data-gallery="gallery" class="link-danger"><i class="fas fa-images"></i> คลิกดูภาพ</a>' : '-');
                $dataRow[] = ($fetchRow[$key]['dept_responsibility'] == '' ? '-' : $fetchRow[$key]['dept_responsibility']);
                $dataRow[] = ($fetchRow[$key]['ref_id_job_type'] == '' ? '-' : $ref_id_job_typeArr[$fetchRow[$key]['ref_id_job_type']]);
                $dataRow[] = ($fetchRow[$key]['related_to_safty'] == 1 ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>');
                $arrData[] = $dataRow;
                $No--;
            }
        } else {
            $arrData = null;
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => intval(0),
                "recordsFiltered" => intval(0),
                "data" => $arrData,
            );
            echo json_encode($output);
            exit();
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => intval($numRow),
            "recordsFiltered" => intval($numRow),
            "data" => $arrData,
        );
        echo json_encode($output);
        exit();

        break;
}
