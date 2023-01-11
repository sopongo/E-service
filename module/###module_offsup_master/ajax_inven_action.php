<?PHP
    //ob_start();
    session_start();
    $action = $_REQUEST['action']; #รับค่า action มาจากหน้าจัดการ
    
    if (!empty($action)) { ##ถ้า $action มีการส่งค่ามาจะดึงไฟล์ class.inc.php (ไฟล์ class+function) มาใช้งาน
        require_once '../../include/class_crud.inc.php';
        $obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
    }


    if ($action == "adj") {
        $id_offsupp = (!empty($_GET['id_offsupp'])) ? $_GET['id_offsupp'] : '';
        if (!empty($id_offsupp)) {

            
            $offsupp = $obj->customSelect("SELECT tb_office_supplies_photo.*, tb_office_supplies.id_offsupp, tb_location.location_name, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
            tb_office_supplies.offsupp_status, tb_office_supplies.total_balance, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name FROM tb_office_supplies
            LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
            LEFT JOIN tb_location ON (tb_location.id_location=tb_office_supplies.ref_id_branch)
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
            LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) WHERE tb_office_supplies.id_offsupp=".$id_offsupp."
            GROUP BY tb_office_supplies.id_offsupp ORDER BY tb_office_supplies.id_offsupp ASC, tb_office_supplies_photo.ref_id_offsupp ASC");

            $fetchRow_Lot = $obj->fetchRows("SELECT tb_inven_rcv.* FROM tb_inven_rcv WHERE tb_inven_rcv.ref_id_offsupp=$id_offsupp ORDER BY rcv_date ASC, id_rcv DESC");
            
            
            $table_lot='';
            $y = 1; $d=0;
            for($no=0;$no<count($fetchRow_Lot);$no++){ //$fetchRow_Lot[1]['rcv_date']; //Ex.
                $table_lot.='<tr>
                <td>'.$y.'</td>
                <td>'.$fetchRow_Lot[$d]['rcv_date'].'</td>
                <td>'.$fetchRow_Lot[$d]['ref_po_no'].'</td>
                <td>'.$fetchRow_Lot[$d]['rcv_lot'].'</td>
                <td>'.$fetchRow_Lot[$d]['quantity'].'</td>
                <td>'.$fetchRow_Lot[$d]['unit_price'].'</td>
                <td>xxx</td>
                </tr>';
                $y++; $d++;
            }
            $json = '[
                {
                    "categories": "10,11",
                    "title": "Promos",
                    "columns": "col-md-3"
                },
                {
                    "categories": "10,12",
                    "title": "Instructional",
                    "columns": "col-md-4"
                },
                {
                    "categories": "10,13",
                    "title": "Performance",
                    "columns": "col-md-4 col-lg-3"
                }
                ]';
                $queries = json_decode($json);
            
            
            $rowArr = ['lot' => $table_lot, 'row' => $offsupp];

            $dataList = $fetchRow_Lot;            

            echo json_encode($rowArr);
            exit();
        }
    }    

    if ($action == "rcv") {
        $id_offsupp = (!empty($_GET['id_offsupp'])) ? $_GET['id_offsupp'] : '';
        if (!empty($id_offsupp)) {
            $offsupp = $obj->customSelect("SELECT tb_office_supplies_photo.*, tb_office_supplies.id_offsupp, tb_location.location_name, tb_office_supplies.offsupp_code, tb_office_supplies.offsupp_name, 
            tb_office_supplies.offsupp_status, tb_office_supplies.total_balance, mainCate.name_menu AS mainName, subCate.name_menu AS SubName, tb_unit.unit_name FROM tb_office_supplies
            LEFT JOIN tb_category AS mainCate ON (tb_office_supplies.ref_id_menu=mainCate.id_menu) 
            LEFT JOIN tb_category AS subCate ON (tb_office_supplies.ref_id_menu_sub=subCate.id_menu) 
            LEFT JOIN tb_location ON (tb_location.id_location=tb_office_supplies.ref_id_branch)
            LEFT JOIN tb_office_supplies_photo ON (tb_office_supplies_photo.ref_id_offsupp=tb_office_supplies.id_offsupp)
            LEFT JOIN tb_unit ON (tb_unit.id_unit =tb_office_supplies.ref_id_unit) WHERE tb_office_supplies.id_offsupp=".$id_offsupp."
            GROUP BY tb_office_supplies.id_offsupp ORDER BY tb_office_supplies.id_offsupp ASC, tb_office_supplies_photo.ref_id_offsupp ASC");
            echo json_encode($offsupp);
            exit();
        }
    }

    
    if ($action == "addrcv") {

            $ref_id_offsupp = (!empty($_POST['ref_id_offsupp'])) ? $_POST['ref_id_offsupp'] : '';                    
            $ref_po_no = (!empty($_POST['po_no'])) ? $_POST['po_no'] : '';
            $rcv_lot = (!empty($_POST['lot_name'])) ? $_POST['lot_name'] : '';          
            $rcv_date = (!empty(str_replace("/","-",$_POST['date_rcv']))) ? $_POST['date_rcv'] : '';

            $_POST['rcv_qty'] = str_replace(",","",$_POST['rcv_qty']);
            $quantity = (!empty($_POST['rcv_qty'])) ? intval($_POST['rcv_qty']) : '';

            $_POST['unit_price'] = str_replace(",","",$_POST['unit_price']);
            $unit_price = (!empty($_POST['unit_price'])) ? $_POST['unit_price'] : '';

    /*id_rcv	ref_id_equip    ref_po_no   rcv_date	rcv_lot     quantity    unit_price rcv_adddate	
    ref_id_user_add	rev_editdate	ref_id_user_edit*/


        $insertRow = [
            'ref_id_offsupp' => $ref_id_offsupp,
            'ref_po_no' => $ref_po_no,
            'rcv_date' => $rcv_date,
            'rcv_lot' => $rcv_lot,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'rcv_adddate' => date('Y-m-d H:i:s'),
            'ref_id_user_add' => $_SESSION['sess_id_user']
        ];
       
        $rowID = $obj->addRow($insertRow, "tb_inven_rcv");

        //id_balance, ref_id_rcv, total_balance
        $row_inven_balance= [
            'ref_id_rcv' => $rowID,
            'total_balance' => $quantity
        ];
        
        $obj->addRow($row_inven_balance, "tb_inven_balance");

        $rowID = $obj->updateBalance($quantity, $ref_id_offsupp);
        echo json_encode($rowID);
        exit();
    }    




?>