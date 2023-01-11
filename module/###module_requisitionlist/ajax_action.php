<?PHP
    ob_start();
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('Asia/Bangkok');	
    require_once '../../include/function.inc.php';

    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
       
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }

    ##หน้าเพิ่ม/แก้ไขข้อมูลผู้ใช้งาน รับค่ามาจากหน้า frm_add-edit.inc.php
    if ($action=='addData' && !empty($_POST)) {      
        ##เนื่องจากหน้า Add/Edit อยู่หน้าเดียวกันเลยต้องเช็คว่ามีค่า userid ส่งมาด้วยหรือไม่ เพื่อเอาไปเช็คว่าต้องใช้ฟังก์ชั่น Add หรือ Update **ถ้าไม่มี $playerId จะเท่ากับ NULL
        $rowID = (!empty($_POST['id_location'])) ? $_POST['id_location'] : '';
        if(empty($rowID)){
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : '',
                'status_location' => (!empty($_POST['status_location'])) ? $_POST['status_location'] : ''
            ];
            $rowID = $obj->addRow($insertRow, "tb_location");
        }else{
            $insertRow = [
                'location_short' => (!empty($_POST['location_short'])) ? $_POST['location_short'] : '',
                'location_name' => (!empty($_POST['name_location'])) ? $_POST['name_location'] : '',
                'location_remark' => (!empty($_POST['desc_location'])) ? $_POST['desc_location'] : '',
                'status_location' => (!empty($_POST['status_location'])) ? $_POST['status_location'] : ''
            ];
            $obj->update($insertRow, "id_location =".$rowID."", "tb_location");
        }
            echo json_encode($rowID);
            exit();
    }
    
    
    if ($action == "getDataList") {#เรียกข้อมูลทั้งหมดมาแสดง    
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $limit = $limit_perPage; //ดึงตัวแปรมาจาก connect.inc.php **เอาใส่ไว้ที่นั้นก่อนเดี๋ยวค่อยมาจัดระเบียบ
        $start = ($page - 1) * $limit;
        //id_dept, dept_name, initial_name, dept_status
        //id_location, location_short, location_name, location_remark, status_location
        //id_user, no_user, password, email, line_token, fullname, phone, photo, class_user, ref_branch, ref_dept, status_user, create_date, lass_login
        //id_req, req_no, req_datetime, req_date_approve, req_date_paid, ref_id_user, ref_id_approver, ref_id_payer, req_remark, disburse_remark, req_paid, req_status
        //id_location, location_short, location_name, location_remark, status_location        
        /*-------------------------------------------------*/
        $fetchRow = $obj->fetchRows("SELECT tb_requisition.*, tb_user.fullname, tb_user.ref_id_location,
        tb_user_approve.fullname AS appr_fullname, tb_user_approve.ref_id_location AS appr_id_location, 
        tb_user_payer.fullname AS payer_fullname, tb_user_payer.ref_id_location AS payer_id_location, 
        tb_dept.initial_name, tb_location_user.location_short, COUNT(tb_requisition.id_req) AS total_req,
        SUM(tb_requisition_detail.requisition_result) AS sum_requisition_result
        FROM tb_requisition
        LEFT JOIN tb_user ON (tb_user.id_user=tb_requisition.ref_id_user) 
        LEFT JOIN tb_user AS tb_user_approve ON (tb_user_approve.id_user=tb_requisition.ref_id_approver) 
        LEFT JOIN tb_user AS tb_user_payer ON (tb_user_payer.id_user=tb_requisition.ref_id_payer) 
        LEFT JOIN tb_dept ON (tb_user.ref_dept=tb_dept.id_dept) 
        LEFT JOIN tb_location AS tb_location_user  ON (tb_user.ref_id_location=tb_location_user.id_location)         
        LEFT JOIN tb_location AS tb_location_req ON (tb_user.ref_id_location=tb_location_req.id_location) 
        LEFT JOIN tb_requisition_detail ON (tb_requisition_detail.ref_id_req =tb_requisition.id_req)         
        GROUP BY tb_requisition.id_req ORDER BY tb_requisition.id_req DESC LIMIT $start, $limit");

        if (!empty($fetchRow)) {
            foreach($fetchRow as $key=>$value) {
                $fetchRow[$key]['req_datetime'] = nowDate($fetchRow[$key]['req_datetime']);
                $fetchRow[$key]['appr_fullname'] =='' ? $fetchRow[$key]['appr_fullname'] = '-' : $fetchRow[$key]['appr_fullname'];
                $fetchRow[$key]['payer_fullname'] =='' ? $fetchRow[$key]['payer_fullname'] = '-' : $fetchRow[$key]['payer_fullname'];

                if($fetchRow[$key]['req_paid']==2){
                    /*$fetchRow[$key]['total_req'].'x3='.$fetchRow[$key]['sum_requisition_result']*/
                    /*sum_requisition_result คือผลรวมของฟิลด์ requisition_result อธิบายคือเมื่อเริ่มมีการตัดจ่ายระบบจะเทียบว่า
                    จำนวนที่เบิกกับ=จำนวนที่จ่ายแล่วหรือไม่ ถ้าเท่ากัน จะอัพเดท requisition_result ให้เท่ากับ 3 ถ้ายังไม่ครบจะเท่ากับ 2
                    เวลาจะใช้เช็ควิธีคือ เช่น เบิก 3 (total_req) รายการก็เอาฟิลด์ requisition_result ของทุกรายการในใบเบิกนั้นมารวมกัน
                    3+3+3=9 >> ถ้ามีบางรายการยังจ่ายไม่ครบ เช่น 3-3-2=8 ก็คือยังจ่ายไม่ครับ
                    */
                    /*
                    if(($fetchRow[$key]['total_req']*3)==$fetchRow[$key]['sum_requisition_result']){
                        $fetchRow[$key]['req_paid']=5;
                        
                    }elseif(($fetchRow[$key]['total_req']*3)!=$fetchRow[$key]['sum_requisition_result'] && $fetchRow[$key]['sum_requisition_result']>0 && $fetchRow[$key]['req_paid']==2 && $fetchRow[$key]['ref_id_approver']!=0){
                        $fetchRow[$key]['req_paid']=4;

                    } 
                    */                   
                }
            }
            $dataList = $fetchRow;
        } else {
            $dataList = [];
        }
        $total = $obj->getCount("SELECT count(id_req) AS total_row FROM tb_requisition");
        //$total_req = $obj->getCount("SELECT count(id_req_detail) AS total_row FROM tb_requisition_detail WHERE ref_id_req=");
        $rowArr = ['count' => $total, 'row' => $dataList];
        echo json_encode($rowArr);
        exit();
        /*-------------------------------------------------*/
    }


    if ($action=="payitem") {
        //ref_id_req=21&id_offsupp_location=1&total_req=3&total_pay=0&date_cut   //current_pay   //lot_select
        if(isset($_POST['all_data'])){
            //"slt_location=1&slt_id_offsupp_location=24&period=12%2F19%2F2022%20-%2012%2F19%2F2022"
            parse_str($_POST['all_data'], $output); //$output['period']
        }
        
        $Row = $obj->customSelect("SELECT * FROM tb_requisition_detail WHERE ref_id_req=".$output['ref_id_req']." AND id_offsupp_location=".$output['id_offsupp_location']."");

        $inv_balance = $obj->customSelect("SELECT * FROM tb_inven_balance WHERE id_balance=".$_POST['lot_select']."");
                
        if(intval($_POST['current_pay'])==0){
            echo json_encode('error-0');  exit(); //ทำรายการไม่สำเร็จ กรุณากรอกจำนวนที่จะจ่ายออก
        }
        if(empty($Row['id_req_detail'])){
            echo json_encode('error-1');  exit(); //ทำรายการไม่สำเร็จ เนื่องจากไม่พบรายการตามที่ระบุ
        }
        if($_POST['current_pay']>$Row['quantity']){
            echo json_encode('error-2');  exit(); //ทำรายการไม่สำเร็จ ไม่สามารถจ่ายเกินยอดที่เบิกได้
        }        
        if($_POST['current_pay']>$inv_balance['total_balance']){
            echo json_encode('error-3');  exit(); //ทำรายการไม่สำเร็จ กรอกจำนวนเกินยอดคงเหลือของลอตนี้ มี user อื่นตัดงานไปก่อนหน้า
        }
        if(($_POST['current_pay']+$Row['quantity_pay'])>$Row['quantity']){
            echo json_encode('error-4');  exit(); //ทำรายการไม่สำเร็จ ไม่สามารถจ่ายเกินยอดที่เบิกได้
        }
        //ถ้าเช็คเงื่อนไขด้านบนผ่านหมด จะทำการบันทึกลงฐานข้อมูล
        /*
        Complete 7.1 INSERT tb_inven_cut        
        Complete 7.2 UPDATE ฟิลด์ tb_requisition_detail.quantity_pay = จำนวนที่จ่ายออกจริง ($_POST['current_pay']) 
            และเช็คว่าถ้าจำนวนตรงกันกับ ข้อ 5.2 ให้อัพเดทฟิลด์ tb_requisition_detail.requisition_result =3 ถ้าไม่ตรงให้อัพเดทเป็น 2
        7.3 UPDATE tb_inven_balance.total_balance คือให้เอา current_pay-total_balance
        7.4 UPDATE tb_offsupp_location.total_balance =-$current_pay
        */

        ############## 7.1 Complete ############## id_cut, ref_id_offsupp_location, cut_date, ref_id_req, ref_id_offsupp, ref_id_rcv, cut_quantity
        $insertRow = [
            'ref_id_offsupp_location' => $output['id_offsupp_location'],
            'cut_date' => $output['date_cut'],
            'ref_id_req' => $output['ref_id_req'],
            'ref_id_offsupp' => $output['id_offsupp'],
            'ref_id_rcv' => $inv_balance['ref_id_rcv'],
            'cut_quantity' => $_POST['current_pay']
        ];
        $rowID = $obj->addRow($insertRow, "tb_inven_cut");
        ############## END 7.1 ##############

        ############## 7.2 Complete ############## //id_req_detail, ref_id_req, id_offsupp_location, quantity, quantity_pay, ref_id_unit, requisition_result      
        if($rowID){
            $chk_requisition_result = 0;
            ($Row['quantity_pay']+$_POST['current_pay'])==$Row['quantity'] ? $chk_requisition_result=3 : $chk_requisition_result=2; //เช็คว่าจ่ายครบตามใบเบิกหรือยัง       
            $updateRow = [
                'quantity_pay' => ('quantity_pay+'.$_POST['current_pay']),
                'requisition_result' => $chk_requisition_result,
            ];
            $result = $obj->updateV2($updateRow, 'id_req_detail='.$Row['id_req_detail'], 'tb_requisition_detail');
        }
        ############## END 7.2 ##############
        
        ############## 7.3 Complete ##############//
        if($result=='Success'){
            $updateRow = [
                'total_balance' => ('total_balance-'.$_POST['current_pay'])
            ];
            $result = $obj->updateV2($updateRow, 'id_balance='.$inv_balance['id_balance'], 'tb_inven_balance');
        }
        ############## END 7.3 ##############

        ############## 7.4 ##############//
        if($result=='Success'){
            $updateRow = [
                'total_balance' => ('total_balance-'.$_POST['current_pay'])
            ];
            $result = $obj->updateV2($updateRow, 'id_offsupp_location='.$Row['id_offsupp_location'], 'tb_offsupp_location');
        }
        ############## END 7.4 ##############
        $insertRow = [
            'req_date_paid' => date('Y-m-d H:i:s'),
            'ref_id_payer' => $_SESSION['sess_id_user']
        ];
        $result = $obj->update($insertRow, "id_req=".$output['ref_id_req']."", "tb_requisition");
        
        $Update = $obj->customSelect("UPDATE tb_requisition_detail SET requisition_result = IF (quantity=quantity_pay+".$_POST['current_pay'].", 3, requisition_result ) WHERE id_req_detail=".$Row['id_req_detail'].";");
        echo json_encode('Success');
        //echo json_encode($_POST['all_data'].'------------------'.$output['ref_id_req'].'---------------'.$_POST['current_pay']);
        exit();
        
    }


    if ($action=="cutitem") {
        //ref_id_req, id_offsupp_location
        $rowID = (!empty($_POST['id_offsupp_location'])) ? $_POST['id_offsupp_location'] : '';
        if (!empty($rowID)) {        
            $fetchRow = $obj->fetchRows("SELECT tb_requisition.id_req, tb_offsupp_location.ref_id_offsupp, tb_requisition.req_no, tb_requisition_detail.*, tb_unit.unit_name, tb_location_req.location_short, tb_office_supplies.id_offsupp, tb_office_supplies.offsupp_name, tb_office_supplies.offsupp_code
            FROM tb_requisition_detail 
            LEFT JOIN tb_requisition ON (tb_requisition.id_req=tb_requisition_detail.ref_id_req )
            LEFT JOIN tb_offsupp_location ON(tb_offsupp_location.id_offsupp_location=tb_requisition_detail.id_offsupp_location)
            LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
            LEFT JOIN tb_unit ON (tb_unit.id_unit=tb_office_supplies.ref_id_unit)
            LEFT JOIN tb_location AS tb_location_req ON (tb_requisition.ref_id_location=tb_location_req.id_location) 
            WHERE tb_requisition_detail.ref_id_req=".$_POST['ref_id_req']." AND tb_requisition_detail.id_offsupp_location=".$rowID." ");

            $req_detail = '<div class="container">
            <div class="row align-items-end">
                <div class="form-group col-12 col-md-12 ">
                <label for="">ตัดจ่ายใบเบิกเลขที่:</label>
                <div>'.$fetchRow[0]['location_short'].$req_digit.$fetchRow[0]['req_no'].'</div>
                </div>
                                <div class="form-group col-5 col-md-5 ">
                                    <label for="">รหัสวัสดุ-อุปกรณ์:</label>
                                    <div>'.$fetchRow[0]['offsupp_code'].'</div>
                                </div>          
                                <div class="form-group col-xs-5 col-md-5 ">
                                    <label for="">ชื่อวัสดุอุปกรณ์:</label>
                                    <div>'.$fetchRow[0]['offsupp_name'].'</div>
                                </div>          
                            </div>
          <div class="row">
            <div class="col-5"><strong>จำนวนที่เบิก: <h3 class="d-inline total_req text-danger">'.(number_format($fetchRow[0]['quantity'],0)).'</h3> '.$fetchRow[0]['unit_name'].'</strong></div>
            <div class="col-5"><strong>จำนวนที่จ่ายแล้ว: <h3 class="d-inline total_pay text-danger">'.(number_format($fetchRow[0]['quantity_pay'],0)).'</h3> '.$fetchRow[0]['unit_name'].'</strong></div>
          </div>';

            $fetchLot = $obj->fetchRows("SELECT tb_inven_balance.*, tb_inven_rcv.* FROM tb_inven_balance 
            LEFT JOIN tb_inven_rcv ON(tb_inven_rcv.id_rcv=tb_inven_balance.ref_id_rcv)
            WHERE tb_inven_balance.ref_id_offsupp_location=$rowID AND tb_inven_balance.total_balance!=0 ORDER BY tb_inven_rcv.rcv_date ASC");

            //id_balance, ref_id_offsupp_location, ref_id_rcv, total_balance, id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, 
            //rcv_quantity, unit_price, rcv_adddate, ref_id_user_add, rev_editdate, ref_id_user_edit

            $rowLot = '';
            $No = 1;
            $total_balance = 0;
            if(!empty($fetchLot)){
                foreach($fetchLot as $key=>$value) {
                    $rowLot.='<tr class="tr_idlot-'.$fetchLot[$key]['id_balance'].'">
                    <td>'.$No.'</td>
                    <td>'.$fetchLot[$key]['rcv_date'].'</td>
                    <td>'.$fetchLot[$key]['ref_po_no'].'</td>
                    <td>'.$fetchLot[$key]['rcv_lot'].'</td>
                    <td><span class="lot_total_balance">'.number_format($fetchLot[$key]['total_balance'],0).'</span> '.$fetchRow[0]['unit_name'].'</td>
                    <td>
                    <div class="input-group">
                    <input class="form-control width100" type="number" name="current_pay" max="'.$fetchLot[$key]['total_balance'].'" min="0" />
                    <span class="input-group-btn"><a class="btn btn-sm p-1 pt-1 pb-1 btn-success cut_inv" data-code="'.$fetchRow[0]['offsupp_code'].'" data-lot="'.$fetchLot[$key]['id_balance'].'">จ่าย</a></span></div>
                    </td>
                    </tr>';
                    $No++;
                    $total_balance+=$fetchLot[$key]['total_balance'];
                }
                $rowLot.='<tr>
                <td colspan="4">คงเหลือรวม:</td>
                <td><u><span class="sum_total_lot">'.number_format($total_balance,0).'</span> '.$fetchRow[0]['unit_name'].'</u></td>
                <td></td>
                </tr>';
            }else{
                $rowLot.='<tr><td colspan="6" class="text-center text-gray"><h3>สินค้าหมดคลังแล้ว</h3></td></tr>';
            }
            $frm_payitem = '
            <form id="frm_payitem" class="frm_payitem" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="ref_id_req" id="ref_id_req" value="'.$fetchRow[0]['ref_id_req'].'" /><!--id ใบเบิก-->
            <input type="hidden" name="id_req_detail" id="id_req_detail" value="'.$fetchRow[0]['id_req_detail'].'" /><!--idรายการที่เบิก-->
            <input type="hidden" name="id_offsupp" id="id_offsupp" value="'.$fetchRow[0]['ref_id_offsupp'].'" /><!--id วัสดุmaster-->
            <input type="hidden" name="id_offsupp_location" id="id_offsupp_location" value="'.$fetchRow[0]['id_offsupp_location'].'" /><!--id วัสดุรายไซต์-->
            <input type="hidden" name="total_req" id="total_req" value="'.$fetchRow[0]['quantity'].'" /><!--id จำนวนที่เบิก-->
            <input type="hidden" name="total_pay" id="total_pay" value="'.$fetchRow[0]['quantity_pay'].'" /><!--id จำนวนที่จ่ายแล้ว-->
            <div class="col-md-3 float-right pt-3 pb-1">
            <div class="input-group date" id="cutdate" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input input-md mr-0" id="date_cut" name="date_cut" value="'.date('Y-m-d').'" data-target="#cutdate" readonly />
                <div class="input-group-append" data-target="#cutdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div></div></div>
            <div class="col-md w-auto float-right pt-3 pb-1"><label for="po">เลือกวันที่จ่ายออก:<label></div></from><!--frm_payitem end-->                      
            <script type="text/javascript"> $(document).ready(function(){ $("#cutdate").datetimepicker({ format: "YYYY/MM/DD"}); });</script>';
            $rowArr = ['fetchRow' => $req_detail.$frm_payitem, 'fetchLot' => $rowLot];
            echo json_encode($rowArr);
            exit();
        }
    }
    
        
    if ($action=="accept") {
        //req_code, req_id:req_id,        
        $rowID = (!empty($_POST['req_id'])) ? $_POST['req_id'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT id_req, req_no FROM tb_requisition WHERE id_req=".$rowID."");
            if (!empty($rowData)) {
                $insertRow = [
                    'req_paid' => 3,
                    'ref_id_approver' => $_SESSION['sess_id_user'],
                    'req_date_approve' => date('Y-m-d H:i:s')
                ];
                $result = $obj->update($insertRow, "id_req =".$rowID."", "tb_requisition");
            }
            echo json_encode($result);
            exit();
        }
    }


    if ($action=="reject") {
        //req_code, req_id, inputValue
        $rowID = (!empty($_POST['req_id'])) ? $_POST['req_id'] : '';
        if (!empty($rowID)) {        
            $rowData = $obj->customSelect("SELECT id_req, req_no FROM tb_requisition WHERE id_req=".$rowID."");
            if (!empty($rowData)) {
                $insertRow = [
                    'req_paid' => 2,
                    'ref_id_approver' => $_SESSION['sess_id_user'],
                    'cause_disapproval' => $_POST['inputValue'],
                    'req_date_approve' => date('Y-m-d H:i:s')
                ];
                $result = $obj->update($insertRow, "id_req =".$rowID."", "tb_requisition");
            }
            echo json_encode($result);
            exit();
        }
    }


    if ($action == "get_req") {
        $rowID = (!empty($_GET['id_row'])) ? $_GET['id_row'] : '';
        if (!empty($rowID)) {        
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
                    $text_req_paid = "<span class=\"text-black\">".$paidStatusArr[$rowData['req_paid']]."</span>";
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
                $text_req_paid = "<span class=\"text-black\">".$paidStatusArr[$rowData['req_paid']]."</span>";
                break;
            }

            $itemData='';
            $No = 1;
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
                    if($rowItem[$key]['req_paid']==3){
                        $itemData.='<td><a class="btn-sm btn-success pt-1 pb-2 mr-1 cutitem" data-toggle="modal" data-target="#cutViewModal" title="ตัดจ่ายวัสดุ-อุปกรณ์" data-backdrop="static" data-keyboard="false" data-id="'.$rowItem[$key]['ref_id_req'].':'.$rowItem[$key]['id_offsupp_location'].'">จ่าย</a></td></tr>';
                    }else if($rowItem[$key]['req_paid']==2){
                        $itemData.='<td>-</td></tr>';
                    }else if($rowItem[$key]['req_paid']==4){
                        $itemData.='<td>จ่ายแล้ว</td></tr>';
                    }else{
                        $itemData.='<td>-</td></tr>';
                    }
                    $No++;
                }
            } else {
                $itemData='';
            }

            $htmlFootter= '
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

                $htmlFootter='<div class="bill-footer col-2 border border-gray border-right-0 p-2">
                <div class="title">ผู้เบิก:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">'.$rowData['fullname'].'</div>
                <div class="w-100 text-center">(ผู้เบิก)</div>
            </div>
        
            <div class="bill-footer col-2 border border-gray border-right-0 p-2">
                <div class="title">ผู้อนุมัติ:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">'.$rowData['approve_fullname'].'</div>
                <div class="w-100 text-center">(ผู้อนุมัติ)</div>
            </div>
        
            <div class="bill-footer col-2 border border-gray p-2">
                <div class="title">ผู้จ่าย:</div>
                <div class="w-100 text-center">_________________________</div>
                <div></div>
                <div class="w-100 text-center">___________________</div>
                <div class="w-100 text-center">(ผู้จ่าย)</div>
            </div>';
            
            $linkprint = '?module=print-req&id='.$rowData['id_req'].'';
            //echo json_encode($rowData);
            $rowArr = ['htmlData' => $htmlData, 'htmlFootter' => $htmlFootter, 'approve' => $text_req_paid, 'itemData' => $itemData, 'linkprint' => $linkprint];
            echo json_encode($rowArr);
            exit();
        }
    }

    
    if ($action == "deleterow") {       
        $rowId = (!empty($_GET['id'])) ? $_GET['id'] : '';
        if (!empty($rowId)) {
            $isDeleted = $obj->deleteRow($rowId, "tb_location", "id_location=$rowId");
            if ($isDeleted) {
                $message = ['deleted' => 1];
            } else {
                $message = ['deleted' => 0];
            }
            echo json_encode(1);
            exit();
        }
    }
    
    if ($action == 'search') {
        $searchText = (!empty($_GET['searchText'])) ? trim($_GET['searchText']) : '';
        $conditionSearch = "location_name LIKE :search";
        $results = $obj->searchRow($searchText, $conditionSearch, "tb_location", "location_name DESC");
        $rowArr = ['count' => '0', 'row' => $results];
        echo json_encode($rowArr);
        //echo json_encode($results);
        exit();
    }
        

?>