<?PHP
    session_start();
    require_once ('../../include/function.inc.php');

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    @$id_row = intval($_REQUEST['id_row']); #รับค่า action มาจากหน้าจัดการ

    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once ('../../include/class_crud.inc.php');
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    /*echo $action; exit();*/   
    if ($action=='view_news' && !empty($id_row)) {
        //echo $id_row;
        //id_news, ref_id_site, ref_id_dept, ref_id_user_post, datetime_post, news_title, news_detail, showall_site, datetime_edit, ref_id_user_edit, status_news
        $rowNews = $obj->customSelect("SELECT tb_news.*, tb_user.fullname FROM tb_news 
        LEFT JOIN tb_user ON (tb_user.id_user=tb_news.ref_id_user_post) WHERE tb_news.id_news=".$id_row."");
        if(!empty($rowNews['id_news'])){
            $rowNews['datetime_post'] = nowDate($rowNews['datetime_post']);
            $rowNews['fullname'] = $rowNews['fullname'].' วันที่ประกาศ: '.$rowNews['datetime_post'];
            //$rowArr = ['id_news' => $rowNews['id_news'], 'news_title' => $rowNews['news_title'], 'news_detail' => $rowNews['news_detail']];
            echo json_encode($rowNews);
            exit();
        }
        exit();
    }

    if ($action=='adddata' && !empty($_POST)) {
        //tb_news id_news, ref_id_site, ref_id_dept, ref_id_user_post, datetime_post, news_title, news_detail, showall_site, datetime_edit, ref_id_user_edit

        if(isset($_POST['data'])){
            parse_str($_POST['data'], $output); //$output['period']
        }

        //$rowID = "";
        !empty($output['id_row']) ? ($rowID = $output["id_row"]) && ($query_id = " AND id_news!=".$output["id_row"]."") : ($query_id = "") && ($output["id_row"]='');
               
        if(empty($rowID)){
            $insertRow = [
                'ref_id_site' =>$_SESSION['sess_ref_id_site'],
                'ref_id_dept' => $_SESSION['sess_id_dept'],
                'ref_id_user_post' => $_SESSION['sess_id_user'],
                'datetime_post' =>  (date('Y-m-d H:i:s')),
                'news_title' => (!empty($output['news_title'])) ? $output['news_title'] : '',
                'news_detail' => (!empty($output['news_detail'])) ? $output['news_detail'] : '',
                'showall_site' => (!empty($output['showall_site'])) ? $output['showall_site'] : NULL,
                'pin_allpage' => (!empty($output['pin_allpage'])) ? $output['pin_allpage'] : 1,
                'status_news' => (!empty($output['status_news'])) ? $output['status_news'] : '',
                'datetime_edit' => NULL,
                'ref_id_user_edit' => NULL,
            ];
            $rowID = $obj->addRow($insertRow, "tb_news");
        }else{
            $insertRow = [
                'news_title' => (!empty($output['news_title'])) ? $output['news_title'] : '',
                'news_detail' => (!empty($output['news_detail'])) ? $output['news_detail'] : '',
                'status_news' => (!empty($output['status_news'])) ? $output['status_news'] : '',
                'pin_allpage' => (!empty($output['pin_allpage'])) ? $output['pin_allpage'] : 1, 
                'datetime_edit' => (date('Y-m-d H:i:s')),
                'ref_id_user_edit' => $_SESSION['sess_ref_id_site'],
            ];
            //print_r($insertRow);
            $obj->update($insertRow, "id_news=".$rowID."", "tb_news");
        }
        echo json_encode($rowID);
        exit();
    }

    if (($action=='update_pinpage' || $action=='update_status') && !empty($id_row)) {
        if($action=='update_pinpage'){
            $insertRow = ['pin_allpage' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : '',];
        }else if($action=='update_status'){
            $insertRow = ['status_news' => (!empty($_POST['chk_box_value'])) ? $_POST['chk_box_value'] : '',];
        }else{
            exit(0);
        }
        /*echo json_encode($id_row.$action);
        print_r($insertRow); exit();*/
        $result = $obj->update($insertRow, "id_news=".$id_row."", "tb_news");
        echo json_encode(1);
        exit();
    }

    if ($action=='edit_news' && !empty($id_row)) {
        //echo $id_row;
        //id_news, ref_id_site, ref_id_dept, ref_id_user_post, datetime_post, news_title, news_detail, showall_site, datetime_edit, ref_id_user_edit, status_news
        $rowNews = $obj->customSelect("SELECT tb_news.*, tb_user.fullname FROM tb_news 
        LEFT JOIN tb_user ON (tb_user.id_user=tb_news.ref_id_user_post) WHERE tb_news.id_news=".$id_row."");
        if(!empty($rowNews['id_news'])){
            $rowNews['datetime_post'] = nowDate($rowNews['datetime_post']);
            $rowNews['fullname'] = $rowNews['fullname'].' วันที่ประกาศ: '.$rowNews['datetime_post'];
            //$rowArr = ['id_news' => $rowNews['id_news'], 'news_title' => $rowNews['news_title'], 'news_detail' => $rowNews['news_detail']];
            echo json_encode($rowNews);
            exit();
        }
        exit();
    }

?>