<?PHP
    session_start();
    
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        require_once '../../include/function.inc.php';
        require_once '../../include/setting.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }
  
    
    //echo json_encode($action); exit();

    if ($action == "chk_offsupp_location") {#เรียกข้อมูลทั้งหมดมาแสดง    
        /*
        SELECT * FROM db_requisition.tb_offsupp_location;
        id_offsupp_location, ref_id_offsupp, ref_id_location, total_balance, status_use_offsupp, ref_id_user_add, ref_adddate

        SELECT * FROM db_requisition.tb_office_supplies;
        id_offsupp, ref_id_menu, ref_id_menu_sub, offsupp_code, offsupp_name, ref_id_unit, offsupp_detail, offsupp_status, moq, min_stock, max_req, leadtime, ref_iduser_add, offsupp_adddate, ref_iduser_edit, offsupp_editdate        
        */      

        if(isset($_POST['ref_id_menu']) && intval($_POST['ref_id_menu'])>0){ $query_cate = " AND tb_office_supplies.ref_id_menu=".$_POST['ref_id_menu']." "; }else{ $query_cate = "";}

        if(isset($_POST['ref_id_menu_sub']) && intval($_POST['ref_id_menu_sub'])>0){
            $query_subcate = " AND tb_office_supplies.ref_id_menu_sub=".$_POST['ref_id_menu_sub']." ";
            $query_slt_subcate = " AND ref_id_menu=".$_POST['ref_id_menu_sub']." ";
        }else{
            $query_subcate = "";
            $query_slt_subcate = "";
        }

        /*echo json_encode("SELECT tb_offsupp_location.id_offsupp_location, tb_office_supplies.id_offsupp, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        WHERE tb_offsupp_location.ref_id_location=".$_POST['val_location']."".$query_cate.$query_subcate." ORDER BY tb_office_supplies.offsupp_code ASC;"); exit();*/

        $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.id_offsupp_location, tb_office_supplies.id_offsupp, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name
        FROM tb_offsupp_location
        LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
        WHERE tb_offsupp_location.ref_id_location=".$_POST['val_location']."".$query_cate.$query_subcate." ORDER BY tb_office_supplies.offsupp_code ASC;");

        $listsupp = '<option data-id="0" selected="selected" disabled value="0">เลือกวัสดุ-อุปกรณ์</option>';
        if(count($fetchRow)>0){
            foreach($fetchRow as $key => $value) {
                $listsupp.='<option value="'.$fetchRow[$key]['id_offsupp_location'].'">'.$fetchRow[$key]['offsupp_code'].' : '.$fetchRow[$key]['offsupp_name'].'</option>';
            }
        }else{
            $listsupp.= '';
        }

        $rowSub = $obj->fetchRows("SELECT id_menu, menu_code, name_menu FROM tb_category WHERE level_menu=2 AND ref_id_menu=".$_POST['ref_id_menu']." ORDER BY id_menu ASC");
        $subcate = '<option selected="selected" disabled value="0">เลือกหมวดหลักก่อน</option>';
        if (count($rowSub)!=0) {
          foreach($rowSub as $key => $value) {
            $subcate.='<option value="'.$rowSub[$key]['id_menu'].'">'.$rowSub[$key]['menu_code'].' - '.$rowSub[$key]['name_menu'].'</option>';
          }
        }

        $rowArr = ['listsupp' => $listsupp, 'subcate' => $subcate];
        echo json_encode($rowArr);        
        exit();
    }


    if($action=="inventory") {

        if(isset($_POST['data'])){
            //"slt_location=1&slt_id_offsupp_location=24&period=12%2F19%2F2022%20-%2012%2F19%2F2022"
            parse_str($_POST['data'], $output); //$output['period']
        }

        $ex_period = explode(" - ", $output['period']);

        $startDate = str_replace("/", "-", $ex_period[0]);
        $endDate = str_replace("/", "-", $ex_period[1]);

        ##12-31-2022
        $startDate = $startDate[6].$startDate[7].$startDate[8].$startDate[9].'-'.$startDate[0].$startDate[1].'-'.$startDate[3].$startDate[4];
        $endDate = $endDate[6].$endDate[7].$endDate[8].$endDate[9].'-'.$endDate[0].$endDate[1].'-'.$endDate[3].$endDate[4];

        $transaction =  array();
        $rec =  array();
        
        ####หายอดคงเหลือ
        $bf_rcv = $obj->customSelect("SELECT SUM(rcv_quantity) AS total FROM tb_inven_rcv WHERE ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(rcv_date)<'".$startDate."';"); //รับเข้าก่อน startdate
        $bf_cut = $obj->customSelect("SELECT SUM(cut_quantity) AS total FROM tb_inven_cut WHERE ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(cut_date)<'".$startDate."';"); //จ่ายออกก่อน startdate
        $bf_rtn = $obj->customSelect("SELECT SUM(rtn_quantity) AS total FROM tb_inven_rtn WHERE ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(rtn_date)<'".$startDate."';"); //รับคืนก่อน startdate
        $bf_adj = $obj->customSelect("SELECT 
        SUM(case when adj_quantity >= 0 then adj_quantity else 0 end) as positive,
        SUM(case when adj_quantity < 0 then  adj_quantity else 0 end) as negative
        FROM tb_inven_adj WHERE ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(adj_date)<'".$startDate."';"); //ปรับยอด +/- ก่อน startdate

        $bf_total = (($bf_rcv['total']+$bf_rtn['total']+$bf_adj['positive'])-$bf_cut['total'])-(-$bf_adj['negative']); //ค่ายอดยกมา
        $rec = array(0=>array(
            'id'=>0,
            'id_offsupp_location'=>$output['slt_id_offsupp_location'], //ไอดีวัสดุรายไซต์ที่ส่งมาจากฟอร์ม
            'inven_type'=> 'bf_total',
            'inven_detail'=> 'ยอดยกมา',
            'inven_date'=> $startDate,
            'lot_name'=> null,
            'quantity'=>$bf_total
        ));
        $transaction = array_merge($transaction,$rec); //รวมลงอาร์เรย์ $transaction ไว้ก่อน
        #### จบ หายอดคงเหลือ ####


        #### หายอดรับเข้า ####
        //id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity, unit_price, rcv_adddate, ref_id_user_add, rev_editdate, ref_id_user_edit
        $fetchRow = $obj->fetchRows("SELECT id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity 
        FROM tb_inven_rcv WHERE ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND (DATE(rcv_date)>='".$startDate."' AND DATE(rcv_date)<='".$endDate."');");

        if (count($fetchRow)>0) {                       
            foreach($fetchRow as $key => $value) {
                $rec = array($fetchRow[$key]['id_rcv']=>array(
                    'id'=>$fetchRow[$key]['id_rcv'],
                    'id_offsupp_location'=>$fetchRow[$key]['ref_id_offsupp_location'],
                    'inven_type'=> 'rcv',
                    'inven_detail'=> 'รับเข้า PO เลขที่: '.$fetchRow[$key]['ref_po_no'],
                    'inven_date'=>$fetchRow[$key]['rcv_date'],
                    'lot_name'=>$fetchRow[$key]['rcv_lot'],
                    'quantity'=>$fetchRow[$key]['rcv_quantity']
                ));
                $transaction = array_merge($transaction,$rec); //รวมลงอาร์เรย์ $transaction ไว้ก่อน
            }
        }
        #### จบหายอดรับเข้า ####


        #### หายอดจ่ายออก ####
        //id_cut, ref_id_offsupp_location, cut_date, ref_id_req, ref_id_offsupp, ref_id_rcv, cut_quantity
        $fetchCut = $obj->fetchRows("SELECT tb_inven_cut.id_cut, tb_inven_cut.ref_id_offsupp_location, tb_inven_cut.cut_date, tb_inven_cut.cut_quantity, tb_inven_cut.ref_id_rcv, 
        tb_inven_rcv.rcv_lot, tb_location.location_short, tb_requisition.id_req, tb_requisition.req_no FROM tb_inven_cut 
        LEFT JOIN tb_requisition ON (tb_requisition.id_req=tb_inven_cut.ref_id_req)
        LEFT JOIN tb_location ON (tb_location.id_location=tb_requisition.ref_id_location) 
        LEFT JOIN tb_inven_rcv ON (tb_inven_cut.ref_id_rcv=tb_inven_rcv.id_rcv)
        WHERE tb_inven_cut.ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND (DATE(tb_inven_cut.cut_date)>='".$startDate."' AND DATE(tb_inven_cut.cut_date)<='".$endDate."');");

        if (count($fetchCut)>0) {
            foreach($fetchCut as $key => $value) {
            $rec = array($fetchCut[$key]['id_cut']=>array(
                'id'=>$fetchCut[$key]['id_cut'],
                'id_offsupp_location'=>$fetchCut[$key]['ref_id_offsupp_location'],
                'inven_type'=> 'cut',
                //'inven_detail'=> 'xxxxxxxxxxxxxx'.$fetchCut[$key]['ref_id_offsupp_location'].'-----'.$fetchCut[$key]['id_cut'].'-----'.$fetchCut[$key]['ref_id_rcv'],
                'inven_detail'=> 'จ่ายออก (ใบเบิก: '.$fetchCut[$key]['location_short'].$req_digit.$fetchCut[$key]['req_no'].')',
                'inven_date'=>$fetchCut[$key]['cut_date'],
                'lot_name'=>$fetchCut[$key]['rcv_lot'],
                'quantity'=>$fetchCut[$key]['cut_quantity']
            ));
            $transaction = array_merge($transaction,$rec); //รวมลงอาร์เรย์ $transaction ไว้ก่อน
            }
        }
        #### จบหายอดจ่ายออก ####

        #### หายอดรับคืน ####
        //id_rtn, ref_id_offsupp_location, rtn_date, ref_id_req, ref_id_rcv, rtn_quantity, rtn_remark, rtn_adddate, ref_id_user_add, rtn_editdate, ref_id_user_edit
        $fetchRtn = $obj->fetchRows("SELECT 
        tb_inven_rtn.id_rtn, tb_inven_rtn.ref_id_offsupp_location, tb_inven_rtn.rtn_date, tb_inven_rtn.ref_id_req, tb_inven_rtn.ref_id_rcv, tb_inven_rtn.rtn_quantity, tb_inven_rtn.rtn_remark, 
        tb_inven_rcv.rcv_lot FROM tb_inven_rtn 
        LEFT JOIN tb_inven_rcv ON (tb_inven_rcv.id_rcv=tb_inven_rtn.ref_id_rcv)
        WHERE tb_inven_rtn.ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(tb_inven_rtn.rtn_date)>='".$startDate."' AND DATE(tb_inven_rtn.rtn_date)<='".$endDate."';");    

        if (count($fetchRtn)>0) {
            foreach($fetchRtn as $key => $value) {
            $rec = array($fetchRtn[$key]['id_rtn']=>array(
                'id'=>$fetchRtn[$key]['id_rtn'],
                'id_offsupp_location'=>$fetchRtn[$key]['ref_id_offsupp_location'],
                'inven_type'=> 'rtn',
                'inven_detail'=> 'รับคืนใบเบิก (????)',
                'inven_date'=>$fetchRtn[$key]['rtn_date'],
                'lot_name'=>$fetchRtn[$key]['rcv_lot'],
                'quantity'=>$fetchRtn[$key]['rtn_quantity']
            ));
            $transaction = array_merge($transaction,$rec); //รวมลงอาร์เรย์ $transaction ไว้ก่อน
            }
        }
        #### จบหายอดรับคืน ####

        #### หารายการปรับยอด ####
        //tb_inven_adj.id_adj, tb_inven_adj.ref_id_offsupp_location, tb_inven_adj.adj_date, tb_inven_adj.ref_id_rcv, tb_inven_adj.adj_quantity, tb_inven_adj.adj_adddate
        $fetchAdj = $obj->fetchRows("SELECT tb_inven_adj.id_adj, tb_inven_adj.ref_id_offsupp_location, tb_inven_adj.adj_date, tb_inven_adj.ref_id_rcv, 
        tb_inven_adj.adj_quantity, tb_inven_adj.adj_adddate, tb_inven_rcv.rcv_lot FROM tb_inven_adj 
        LEFT JOIN tb_inven_rcv ON (tb_inven_rcv.id_rcv=tb_inven_adj.ref_id_rcv)
        WHERE tb_inven_adj.ref_id_offsupp_location=".$output['slt_id_offsupp_location']." AND DATE(tb_inven_adj.adj_date)>='".$startDate."' AND DATE(tb_inven_adj.adj_date)<='".$endDate."';");    

        if (count($fetchAdj)>0) {
            foreach($fetchAdj as $key => $value) {
            $rec = array($fetchAdj[$key]['id_adj']=>array(
                'id'=>$fetchAdj[$key]['id_adj'],
                'id_offsupp_location'=>$fetchAdj[$key]['ref_id_offsupp_location'],
                'inven_type'=> 'adj',
                'inven_detail'=> 'ปรับยอด: (สาเหตุ)',
                'inven_date'=>$fetchAdj[$key]['adj_date'],
                'lot_name'=>$fetchAdj[$key]['rcv_lot'],
                'quantity'=>$fetchAdj[$key]['adj_quantity']
            ));
            $transaction = array_merge($transaction,$rec); //รวมลงอาร์เรย์ $transaction ไว้ก่อน
            }
        }        
        #### จบหารายการปรับยอด ####

        $total_balance = 0;
        $tbody = '';
        $sortDate= array_column($transaction, 'inven_date'); //กำหนดตัวแปร sortDate คือคอลัมน์ inven_date
        array_multisort($sortDate, SORT_ASC, $transaction);//SORT_DESC SORT_ASC เรียงอาร์เรย์จากตัวแปร $sortDate

        foreach ($transaction as $item){
        $tbody.='
        <tr>
        <td>'.nowDateShort($item['inven_date']).'</td>
        <td>'.$item['inven_detail'].'</td>
        <td>'.$item['lot_name'].'</td>';
        //<td>'.$item['inven_type'].'</td>
    
            switch ($item['inven_type']){
                case "bf_total" :
                $total_balance+=$item['quantity'];
                $tbody.='
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">'.number_format($total_balance,0).'</td>
                ';
                break;

                case "rcv" :
                $total_balance+=$item['quantity'];
                $tbody.='
                <td class="text-right">'.$item['quantity'].'</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">'.number_format($total_balance,0).'</td>
                ';
                break;
        
                case "cut" :
                $total_balance-=$item['quantity'];
                $tbody.='
                <td>&nbsp;</td>
                <td class="text-right">'.$item['quantity'].'</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">'.number_format($total_balance,0).'</td>
                ';
                break;
        
                case "rtn" :
                $total_balance+=$item['quantity'];
                $tbody.='
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">'.$item['quantity'].'</td>
                <td>&nbsp;</td>
                <td class="text-right">'.number_format($total_balance,0).'</td>
                ';
                break;
        
                case "adj" :
                if($item['quantity']>0){
                    //$qqq ='ยอดเต็ม';
                    $total_balance+=$item['quantity'];
                }else{
                    //$qqq ='ยอดติดลบ';
                    $total_balance+=$item['quantity'];
                }
        
                $tbody.='
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">'.$item['quantity'].'</td>
                <td class="text-right">'.number_format($total_balance,0).'</td>
                ';
                break;
        
                default:
                $tbody.='
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                ';
                break;
                echo'</tr>';
            }
        }
        $tbody.='<tr><td colspan="7" class="text-right text-bold">คงเหลือ:</td><td class="text-right">'.(number_format($total_balance,0)).'</td></tr>';



        $rowArr = ['title' => 'รายการรับ-จ่ายรหัส <span class="offsupps-code"></span> / ช่วงวันที่ '.(nowDateShort($startDate)).' ถึงวันที่ '.(nowDateShort($endDate)).'', 'tbody' => $tbody];
        echo json_encode($rowArr);
        //echo json_encode($period.'----------->'.$startDate.'-------------'.$endDate);
        //echo json_encode($_POST['data'].'-------'.$output['slt_id_offsupp_location'].'-------'.$slt_location.'-------'.$period);
        exit();

    }//if $action=="inventory"

?>