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

      case "clear-cart":
        unset($_SESSION['cart_item']);
        echo json_encode(1);
        exit();
      break;

      case "additem":
          header('Content-Type: application/json');
          $item_id = (!empty($_POST['item_id'])) ? $_POST['item_id'] : '';

          $fetchRow = $obj->fetchRows("SELECT tb_office_supplies_photo.photo_name, tb_office_supplies.id_offsupp, tb_location.location_name, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
          tb_office_supplies.offsupp_status, tb_office_supplies.total_balance, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name FROM tb_office_supplies
          LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
          LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
          LEFT JOIN tb_location ON (tb_location.id_location=tb_office_supplies.ref_id_branch)
          LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
          LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) WHERE tb_office_supplies.id_offsupp=$item_id GROUP BY tb_office_supplies.id_offsupp ORDER BY tb_office_supplies.id_offsupp ASC, tb_office_supplies_photo.ref_id_offsupp ASC");

          if (!empty($fetchRow)) {
            $fetchRow[0]['photo_name']=='' ? $fetchRow[0]['photo_name'] = $pathImgDefault : $fetchRow[0]['photo_name']=$fetchRow[0]['photo_name'];
            
            $text_cate= $fetchRow[0]['mainName'];
            $fetchRow[0]['SubName']!='' ? $text_cate.='&nbsp;&nbsp;หมวดย่อย:&nbsp;'.$fetchRow[0]['SubName'] : '';
            
            $itemArray = array($fetchRow[0]['offsupp_code']=>array('id_offsupp'=>$fetchRow[0]['id_offsupp'],'name'=>$fetchRow[0]['offsupp_name'],'cate'=>$text_cate, 'unit'=>$fetchRow[0]['unit_name'],'itemCode'=>$fetchRow[0]['offsupp_code'],'quantity'=>$_POST["quantity"], 'image'=>$fetchRow[0]['photo_name']));
            //print_r($itemArray);



            if(!empty($_SESSION["cart_item"])) {
              if(in_array($fetchRow[0]['offsupp_code'],array_keys($_SESSION["cart_item"]))==true) { //ถ้ามีใน $_SESSION["offsupp_code"] แล้ว 0000

                $a = 1;

              }else{ // ถ้าไม่มี 0000


                $a = 2;
              }//0000  
              echo json_encode($a);
              exit();


                if(in_array($fetchRow[0]['offsupp_code'],array_keys($_SESSION["cart_item"]))) {
                  foreach($_SESSION["cart_item"] as $k => $v) {
                    if($fetchRow[0]['offsupp_code'] == $k) {
                      if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                      }
                      $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                    }
                  }
                } else {
                  $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
              $_SESSION["cart_item"] = $itemArray;
            }


            foreach ($_SESSION["cart_item"] as $item){
              $htmlappend='<tr>
              <td class="p-1">
                <div class="media align-items-center">
                  <img src="'.$item['image'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                  <div class="media-body font-1r">
                    <a href="#" class="d-block text-dark">'.$item['name'].'</a>
                    <small>
                    <span class="text-muted">รหัสวัสดุอุปกรณ์:</span> &nbsp;'.$item['itemCode'].'
                    <span class="text-muted">หมวด: </span> &nbsp; '.$item['cate'].'
                  </small>
                  </div>
                </div>
              </td>
              <td class="align-middle p-1">
                <div class="btn btn-default btn-increment-decrement d-inline-block" onClick="decrement_quantity(1, \'1000\')"><i class="fas fa-minus-circle"></i></div>
                <input class="form-control text-center input-quantity col-sm-4 d-inline-block" id="input-quantity-1" readonly value="'.$item['quantity'].'">
                <div class="btn btn-default btn-increment-decrement d-inline-block" onClick="increment_quantity(1, \'1000\')"><i class="fas fa-plus-circle"></i></div>
              </td>
              <td class="text-right font-weight-semibold align-middle p-1">'.$item['quantity'].' '.$item['unit'].'</td>
              <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
              </tr>';
            }
          } else {
              $htmlappend="ไม่พบข้อมูล";
          }

          echo json_encode($htmlappend);
          exit();
      break;

      default:
          exit();
      break;
    }

?>