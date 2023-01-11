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

    $office_supplies_Arr = array();
    $itemArray = array();
    $itemByCode = array();

    switch($action)
    {
      case "save-requisition":
        if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){


          foreach($_SESSION["cart_item"] as $item){##เช็คก่อนว่าสินค้าแต่ละรายการคงเหลือพอจ่ายหรือไม่ เนื่องจากอาจจะมี user อื่นกดเบิก+บันทึกตัดหน้า
            $chk_waitPay = $obj->customSelect("SELECT SUM(tb_requisition_detail.quantity) AS wait_pay, tb_offsupp_location.total_balance,
            tb_office_supplies.offsupp_code FROM tb_requisition_detail  
            LEFT JOIN tb_offsupp_location ON (tb_offsupp_location.id_offsupp_location=tb_requisition_detail.id_offsupp_location)
            LEFT JOIN tb_office_supplies ON (tb_offsupp_location.id_offsupp_location=tb_office_supplies.id_offsupp)
            WHERE tb_requisition_detail.id_offsupp_location=".$item['id_offsupp_location']." AND tb_requisition_detail.requisition_result=1;");

            //echo $chk_waitPay['wait_pay'].'------------------'.$chk_waitPay['total_balance'];
            if($chk_waitPay['offsupp_code']!=null){
              if($item['quantity']>($chk_waitPay['total_balance']-$chk_waitPay['wait_pay'])){
                $rowArr = ['error' => 'over_req', 'offsupps_code' => $chk_waitPay['offsupp_code']];
                echo json_encode($rowArr);
                exit();
              }
            }
          }

          $rowNo['total_row'] = $obj->getCount("SELECT COUNT(id_req) AS total_row FROM tb_requisition WHERE LEFT(req_no,4)='".date('ym')."' AND ref_id_location=".$_SESSION['sess_id_location']."");
          $rowNo['total_row']==0 ? $rowNo['total_row']=1 : $rowNo['total_row']=$rowNo['total_row']+1;
             
            $req_no = date("ym")."-".str_pad($rowNo['total_row'],4,"0",STR_PAD_LEFT);

            /*id_req, ref_id_location, req_no, req_datetime, req_date_approve, req_date_paid, ref_id_user, ref_id_approver, ref_id_payer, 
            req_remark, disburse_remark, req_paid, cause_disapproval, req_status*/
            $insertRow = [
              'ref_id_location' => $_SESSION['sess_id_location'],
              'req_no' => $req_no,
              'req_datetime' => date('Y-m-d H:i:s'),
              'req_date_approve' => null,
              'req_date_paid' => null,
              'ref_id_user' => $_SESSION['sess_id_user'],
              'ref_id_approver' => 0,
              'ref_id_payer' => 0,
              'req_remark' => (!empty($_POST['req_remark'])) ? $_POST['req_remark'] : null,
              'disburse_remark' => null,
              'req_paid' => 1,
              'cause_disapproval' => null,
              'req_status' => 1
            ];

           $rowID = $obj->addRow($insertRow, "tb_requisition");

          if(isset($rowID)){         
            /*id_req_detail, ref_id_req, id_offsupp_location, quantity, quantity_pay, ref_id_unit, requisition_result*/
            foreach($_SESSION["cart_item"] as $item){            
              $insertDetail = [
                'ref_id_req' => $rowID,
                'id_offsupp_location' => $item['id_offsupp_location'],
                'quantity' => $item['quantity'],
                'quantity_pay' => 0,
                'ref_id_unit' => $item['id_unit'],
                'requisition_result' => 1
              ];
              $rowDetail = $obj->addRow($insertDetail, "tb_requisition_detail");
            }

            if(isset($rowDetail)){
              /*ส่งอีเมล์+แจ้งไลน์ตรงนี้*/
              /*จบส่งอีเมล์+แจ้งไลน์ตรงนี้*/
              unset($_SESSION['cart_item']);
              echo json_encode($rowDetail);
              exit();
            }
          }else{
            echo json_encode('error');
            exit();
          }
        }else{//ถ้าไม่มีรายการเบิก
          echo json_encode('error');
          exit();
        }
      break;


      case "increment-item":
        $itemcode = (!empty($_POST['itemcode'])) ? $_POST['itemcode'] : '';
        $_SESSION["cart_item"][$itemcode]["quantity"]+=1;
        echo json_encode(1);
        exit();
      break;

      case "decrement-item":
        $itemcode = (!empty($_POST['itemcode'])) ? $_POST['itemcode'] : '';
        $_SESSION["cart_item"][$itemcode]["quantity"]-=1;
        echo json_encode(1);
        exit();
      break;
      
      case "clear-item":
        $itemcode = (!empty($_POST['itemcode'])) ? $_POST['itemcode'] : '';
        unset($_SESSION['cart_item'][$itemcode]);
        echo json_encode($itemcode);
        exit();
      break;

      case "clear-cart":
        unset($_SESSION['cart_item']);
        echo json_encode(1);
        exit();
      break;

      case "additem":
          $chk_sesItem='';
          header('Content-Type: application/json');
          $item_id = (!empty($_POST['item_id'])) ? $_POST['item_id'] : '';


          $fetchRow = $obj->fetchRows("SELECT tb_offsupp_location.*, tb_office_supplies.*, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, 
          tb_office_supplies_photo.photo_name, tb_unit.unit_name, tb_location.location_short, tb_unit.id_unit, tb_unit.unit_name
          FROM tb_offsupp_location
          LEFT JOIN tb_office_supplies ON (tb_office_supplies.id_offsupp=tb_offsupp_location.ref_id_offsupp)
          LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
          LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
          LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
          LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) 
          LEFT JOIN tb_location ON (tb_location.id_location=tb_offsupp_location.ref_id_location)
          WHERE tb_offsupp_location.id_offsupp_location=$item_id ORDER BY tb_office_supplies.id_offsupp DESC, tb_office_supplies_photo.ref_id_offsupp ASC");

          /*$fetchRow = $obj->fetchRows("SELECT tb_office_supplies_photo.photo_name, tb_office_supplies.id_offsupp, tb_location.location_name, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
          tb_office_supplies.offsupp_status, tb_office_supplies.total_balance, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.id_unit, tb_unit.unit_name FROM tb_office_supplies
          LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
          LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
          LEFT JOIN tb_location ON (tb_location.id_location=tb_office_supplies.ref_id_branch)
          LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
          LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) WHERE tb_office_supplies.id_offsupp=$item_id 
          GROUP BY tb_office_supplies.id_offsupp ORDER BY tb_office_supplies.id_offsupp ASC, tb_office_supplies_photo.ref_id_offsupp ASC");
          */

          if (!empty($fetchRow)) {
            $fetchRow[0]['photo_name']=='' ? $fetchRow[0]['photo_name'] = $pathOffsuppDefault : $fetchRow[0]['photo_name']=$pathOffsupp.$fetchRow[0]['photo_name'];
            
            $text_cate= $fetchRow[0]['mainName'];
            $fetchRow[0]['SubName']!='' ? $text_cate.='&nbsp;&nbsp;หมวดย่อย:&nbsp;'.$fetchRow[0]['SubName'] : '';
            
            $itemArray = array($fetchRow[0]['offsupp_code']=>array('id_offsupp_location'=>$fetchRow[0]['id_offsupp_location'],'ref_id_offsupp'=>$fetchRow[0]['ref_id_offsupp'], 'name'=>$fetchRow[0]['offsupp_name'],'cate'=>$text_cate, 'id_unit'=>$fetchRow[0]['id_unit'], 'unit'=>$fetchRow[0]['unit_name'],'itemCode'=>$fetchRow[0]['offsupp_code'],'quantity'=>$_POST["quantity"], 'image'=>$fetchRow[0]['photo_name']));
            //print_r($itemArray);

            $htmlappend='';                   
           

            if(!empty($_SESSION["cart_item"])){

              $No = count($_SESSION["cart_item"]);

                if(searchArray($_SESSION["cart_item"],'id_offsupp_location', $fetchRow[0]['id_offsupp_location'])==1){ //ถ้ามีใน $_SESSION["offsupp_code"] แล้ว 0000

                foreach($_SESSION["cart_item"] as $k => $v) {

                  if($fetchRow[0]['offsupp_code'] == $k) {
                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                      $_SESSION["cart_item"][$k]["quantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                  }
                  
                }
                $chk_sesItem = 1;
                $htmlappend='';
              }else{ // ถ้าไม่มี 0000 จะรวมอาร์เรย์ $itemArray เข้ากับ $_SESSION["cart_item"]
                $chk_sesItem = 2;
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                $htmlappend='<tr class="tr_'.$fetchRow[0]['offsupp_code'].'"><td class="text-center td-no">'.($No+1).'.</td><td class="p-1"><div class="media align-items-center"><img src="'.$fetchRow[0]['photo_name'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                    <div class="media-body font-1r"><a href="#" class="d-block text-dark">'.$fetchRow[0]['offsupp_name'].'</a><small><span class="text-muted">รหัสวัสดุอุปกรณ์:</span> &nbsp;'.$fetchRow[0]['offsupp_code'].'
                      <span class="text-muted">หมวด: </span> &nbsp; '.$text_cate.'</small></div></div></td><td class="align-middle p-1">
                  <div class="btn btn-default btn-decrement d-inline-block"><i class="fas fa-minus-circle"></i></div>
                  <input class="form-control text-center input-quantity col-sm-4 d-inline-block" id="input-qty-'.$fetchRow[0]['id_offsupp_location'].'" readonly value="'.$_POST["quantity"].'">
                  <div class="btn btn-default btn-increment d-inline-block"><i class="fas fa-plus-circle"></i></div></td>
                  <td class="text-right font-weight-semibold align-middle p-1"><span class="input-qty-'.$fetchRow[0]['id_offsupp_location'].'">'.$_POST["quantity"].'</span> '.$fetchRow[0]['unit_name'].'</td>
                <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-itemcode="'.$fetchRow[0]['offsupp_code'].'" data-original-title="Remove">×</a></td></tr>';
              }//0000  
            } else {//ถ้ายังไม่มีอาร์เรย์ $_SESSION["cart_item"] เลย
              $_SESSION["cart_item"] = $itemArray;
              $chk_sesItem = 3;
              $htmlappend='<tr class="tr_'.$fetchRow[0]['offsupp_code'].'"><td class="text-center td-no">1.</td><td class="p-1"><div class="media align-items-center"><img src="'.$fetchRow[0]['photo_name'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
              <div class="media-body font-1r"><a href="#" class="d-block text-dark">'.$fetchRow[0]['offsupp_name'].'</a><small><span class="text-muted">รหัสวัสดุอุปกรณ์:</span> &nbsp;'.$fetchRow[0]['offsupp_code'].'
                <span class="text-muted">หมวด: </span> &nbsp; '.$text_cate.'</small></div></div></td><td class="align-middle p-1">
            <div class="btn btn-default btn-decrement d-inline-block"><i class="fas fa-minus-circle"></i></div>
            <input class="form-control text-center input-quantity col-sm-4 d-inline-block" id="input-qty-'.$fetchRow[0]['id_offsupp_location'].'" readonly value="'.$_POST["quantity"].'">
            <div class="btn btn-default btn-increment d-inline-block"><i class="fas fa-plus-circle"></i></div></td>
            <td class="text-right font-weight-semibold align-middle p-1"><span class="input-qty-'.$fetchRow[0]['id_offsupp_location'].'">'.$_POST["quantity"].'</span> '.$fetchRow[0]['unit_name'].'</td>
          <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-itemcode="'.$fetchRow[0]['offsupp_code'].'" data-original-title="Remove">×</a></td></tr>';
            }
          } else {
              $htmlappend=0;
          }
          $rowArr = ['chk_sesItem' => $chk_sesItem, 'htmlappend' => $htmlappend];
          echo json_encode($rowArr);
          exit();
      break;

      default:
          exit();
      break;
    }

?>